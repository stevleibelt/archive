-- mysql

﻿SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `location` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `is_all_day_event` smallint(6) NOT NULL,
  `color` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `recurring_rule` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

-- sqlite

CREATE TABLE IF NOT EXISTS `event` (
  `id` INTEGER PRIMARY KEY,
  `subject` varchar(1000) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `is_all_day_event` smallint(6) NOT NULL,
  `color` varchar(200) DEFAULT NULL,
  `recurring_rule` varchar(500) DEFAULT NULL
);