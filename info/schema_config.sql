CREATE TABLE IF NOT EXISTS `config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_name` varchar(80) NOT NULL,
  `from_name` varchar(80) NOT NULL,
  `from_address` varchar(80) NOT NULL,
  `bcc_address` varchar(80) NOT NULL,
  `topic` varchar(80) NOT NULL,
  `line1` varchar(80) NOT NULL,
  `age_line` varchar(80) NOT NULL,
  `noage_line` varchar(80) NOT NULL,
  `picture_file` varchar(80) NOT NULL,
  PRIMARY KEY (`config_id`),
  UNIQUE KEY `config_name` (`config_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
