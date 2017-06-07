CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL DEFAULT 'info@example.org',
  `birthday` date NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `i` (`user_id`,`name`,`email`,`birthday`,`config_id`),
  KEY `c` (`config_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;
