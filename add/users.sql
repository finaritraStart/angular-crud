


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(80) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;



INSERT INTO `users` (`id`, `username`, `fname`, `lname`) VALUES
(1, 'yssyogesh', 'Yogesh', 'singh'),
(2, 'bsonarika', 'Sonarika', 'Bhadoria'),
(3, 'vishal', 'Vishal', 'sahu'),
(4, 'jiten', 'jitendra', 'singh');


