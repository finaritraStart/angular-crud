<?php

include 'config.php';

$data = json_decode(file_get_contents("php://input"));

$request_type = $data->request_type;


if($request_type == 1){

    $stmt = $con->prepare("SELECT * FROM users");
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    if($result->num_rows > 0){
       while($row = $result->fetch_assoc()) {
            $data[] = array("id"=>$row['id'],"prenom"=>$row['prenom'],"nom"=>$row['nom'],"username"=>$row['username']); 
        }
    }
    
    $stmt->close();
    echo json_encode($data);
    exit;
}

// Insert record
if($request_type == 2){
    $prenom = $data->prenom;
    $nom = $data->nom;
    $username = $data->uname;
    
    // Check username already exists
    $stmt = $con->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param('s',$username);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $return_arr = array();
    if($result->num_rows == 0){

        // Insert
        $insertSQL = "INSERT INTO users(prenom,nom,username ) values(?,?,?)";
        $stmt = $con->prepare($insertSQL);
        $stmt->bind_param("sss",$prenom,$nom,$username);
        $stmt->execute();

        $lastinsert_id = $stmt->insert_id;
        if($lastinsert_id > 0){
            $return_arr[] = array("id"=>$lastinsert_id,"prenom"=>$prenom,"nom"=>$nom,"username"=>$username);
        }
        $stmt->close();
    }
    
    echo json_encode($return_arr);
    exit;
}

// Delete record
if($request_type == 3){
    $userid = $data->userid;

    // Check userid exists
    $stmt = $con->prepare("SELECT * FROM users WHERE id=?");
    $stmt->bind_param('i',$userid);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    
    if($result->num_rows > 0){

        // Delete
        $deleteSQL = "DELETE FROM users WHERE id=?";
        $stmt = $con->prepare($deleteSQL);
        $stmt->bind_param("i",$userid);
        $stmt->execute();
        $stmt->close();

        echo 1;
        exit;
    }else{
        echo 0;
    }

    exit;
}

