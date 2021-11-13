<!doctype html>
<html>
    <head>
        <title>Add and remove record from MySQL Database with AngularJS</title>
        <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
        <script src="angular.min.js"></script>
        <script src="bootstrap.min.js"></script>
        <script src="jquery.min.js"></script>
        
    </head>
    <body >

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">G élèves</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
    <div class="panel-heading">
      <h1>
        Les élèves de l'INSTITUT SUPERIEUR "RLG"
        <a href="#!" id="bouton-ajouter" class="pull-right btn btn-success btn-lg">
          <i class="fa fa-plus"></i> Ajouter un élève
        </a>
      </h1>
    </div>
        <div ng-app='myapp' ng-controller="userCtrl">

           <div id="but" style="display: none;">

           
                    prenom
                   <input class="form-control" type='text' id='txt_prenom' ng-model='prenom'>
                
                
                    nom
                    <input class="form-control" type='text' id='txt_nom' ng-model='nom'>
                
                
                    Username
                    <input class="form-control" type='text' id='txt_username' ng-model='username'><br>
                
                
                    &nbsp;
                    <input class="btn btn-primary" type='button' id='but_save' value='enregistrer' ng-click="add()" ></td><br><br>
                </div>
       
            <table class="table table-hover" border="1">
                
                <tr>
                    <th>prenom</th>
                    <th>nom</th>
                    <th>Username</th>
                    <th>&nbsp;</th>
                </tr>
                
                <tr ng-repeat="user in users">
                <td>{{user.prenom}}</td>
                <td>{{user.nom}}</td>
                <td>{{user.username}}</td>
                <td><input class="btn btn-danger" type='button' ng-click='remove($index,user.id);' value='Delete'></td>
                </tr>
                
            </table>
        </div>
        
    </div>
        <script>
          $(document).ready(function(){
            $('#but_save').click(function(){
              $('#but').show();
              $('#but').css('display:block;')
            });
             
          });


        var fetch = angular.module('myapp', []);

        fetch.controller('userCtrl', ['$scope', '$http', function ($scope, $http) {

         
            $http({
                method: 'post',
                url: 'addremove.php',
                data: {request_type:1},

            }).then(function successCallback(response) {
                $scope.users = response.data;
            });

           
            $scope.add = function(){

                var len = $scope.users.length;
                $http({
                method: 'post',
                url: 'addremove.php',
                data: {prenom:$scope.prenom,nom:$scope.nom,username:$scope.username,request_type:2,len:len},
                }).then(function successCallback(response) {
                    if(response.data.length > 0)
                        $scope.users.push(response.data[0]);
                    else
                        alert('Record not inserted.');
                });
            }

          
            $scope.remove = function(index,userid){
               
                $http({
                method: 'post',
                url: 'addremove.php',
                data: {userid:userid,request_type:3},
                }).then(function successCallback(response) {
                    if(response.data == 1)
                        $scope.users.splice(index, 1);
                    else
                        alert('Record not deleted.');
                }); 
            }
            
        }]);

        </script>
    </body>

</html>
