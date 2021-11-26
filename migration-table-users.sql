-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `age` smallint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `status`, `age`) VALUES
(1,	'Ivan',	'Ivanov',	'c4ca4238a0b923820dcc509a6f75849b',	'active',	34),
(2,	'Oleg',	'Olegov',	'c81e728d9d4c2f636f067f89cc14862c',	'active',	22),
(3,	'Ivan',	'Lorem',	'eccbc87e4b5ce2fe28308fd9f2a7baf3',	'active',	16);

-- 2021-11-26 10:56:14