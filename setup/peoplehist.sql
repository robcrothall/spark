-- Project: People History
-- Client:  Kowie Museum
-- Author:  Rob Crothall
-- Date written: 2018-07-05
-- Host: localhost    Database: peoplehist
-- ------------------------------------------------------
USE peoplehist;
create user `khm` identified by 'MorseJones';
grant all on peoplehist to khm;
--
-- Structure for table 'people' - details about any person
--
DROP TABLE IF EXISTS `people`;
CREATE TABLE `people` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `surname` varchar(50) NOT NULL,
  `first_name` varchar(50) NULL,
  `other_name` varchar(50) NULL,
  `title` varchar(50) NULL,
  `birth_year` int(4) NULL,
  `occupation` int(10) NULL,
  `ref_no` varchar(10) NULL,
  `party` int(10) NULL,
  `voyage_id` int(10) NULL,
  `user_id` int(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)  
) ENGINE=InnoDB;
--
-- Structure for table 'party' - a group of 1820 settlers
--
DROP TABLE IF EXISTS `party`;
CREATE TABLE `party` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `party_name` varchar(50) NOT NULL,
  `party_leader` varchar(50) NULL,
  `party_notes` text NULL,
  `user_id` int(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)  
) ENGINE=InnoDB;
--
-- Structure for table 'ship' - a ship bringing settlers
--
DROP TABLE IF EXISTS `ship`;
CREATE TABLE `ship` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ship_name` varchar(50) NOT NULL,
  `ship_notes` text NULL,
  `user_id` int(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)  
) ENGINE=InnoDB;
--
-- Structure for table 'voyage' - a particular voyage of a ship bringing settlers
--
DROP TABLE IF EXISTS `voyage`;
CREATE TABLE `voyage` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ship_id` int(10) NOT NULL,
  `origin` int(10) NULL,
  `destination` int(10) NULL,
  `voyage_date` varchar(20) NULL,
  `voyage_notes` text NULL,
  `user_id` int(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)  
) ENGINE=InnoDB;

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `person_id` int(10) NOT NULL,
  `event_date` varchar(8) NOT NULL,
  `event_descr` varchar(255) NOT NULL,
  `linked_person` int(10) NULL,
  `linked_place` int(10) NULL,
  `user_id` int(10) NOT NULL,
  `time_stamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
--
-- Table structure for table `place` - information about a physical location
--

DROP TABLE IF EXISTS `place`;
CREATE TABLE `place` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `region` varchar(50) NULL,
  `country` varchar(50) NULL,
  `notes` text NULL,
  `user_id` int(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
--
-- Table structure for table `occupation` - the profession of the person
--
DROP TABLE IF EXISTS `occupation`;
CREATE TABLE `occupation` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `occupation_name` varchar(50) NOT NULL,
  `notes` text NULL,
  `user_id` int(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `surname` varchar(50) not null,
  `first_name` varchar(50) not null,
  `phone` varchar(20) null,
  `mobile` varchar(20) null,
  `email` varchar(255) null,
  `member_exp` date NOT NULL DEFAULT CURRENT_DATE,
  `search_count` int(10) not null DEFAULT 0,
  `search_date` date not null DEFAULT CURRENT_DATE,
  `user_role` varchar(20) NOT NULL DEFAULT 'VISITOR',
  `user_id` int(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB;
--
-- Table structure for table `synonyms`
--

DROP TABLE IF EXISTS `synonyms`;
CREATE TABLE `synonyms` (
  `word` varchar(50) NOT NULL,
  `synonym` varchar(50) NOT NULL,
  `user_id` int(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`word`)
) ENGINE=InnoDB;
--
-- Table structure for table `sql_log`
--

DROP TABLE IF EXISTS `sql_log`;
CREATE TABLE `sql_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cmd` varchar(255) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  `when` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
--
-- Table structure for table `logon_log`
--

DROP TABLE IF EXISTS `logon_log`;
CREATE TABLE `logon_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name_given` varchar(255) NULL,
  `password_given` varchar(50) NULL,
  `success` tinyint(1) NULL,
  `user_id` int(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
--
-- Table structure for table `search_log`
--

DROP TABLE IF EXISTS `search_log`;
CREATE TABLE `search_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `surname` varchar(50) NULL,
  `first_name` varchar(50) NULL,
  `ref_no` varchar(10) NULL,
  `occupation` int(10) NULL,
  `party` int(10) NULL,
  `ship` int(10) NULL,
  `place` int(10) NULL,
  `user_id` int(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
--
-- Table structure for table `search_log`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NULL,
  `amount` decimal(8,2) NULL,
  `payment_date` date NULL,
  `user_id` int(10) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

