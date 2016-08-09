-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 27, 2016 at 08:34 AM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `astaff`
--

-- --------------------------------------------------------

--
-- Table structure for table `assescriteria`
--

CREATE TABLE IF NOT EXISTS `assescriteria` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `coverag` int(60) DEFAULT NULL,
  `originality` int(30) NOT NULL,
  `Contribut` int(30) NOT NULL,
  `academic_discipline` int(50) NOT NULL,
  `specialize` int(60) NOT NULL,
  `presentation` int(40) NOT NULL,
  `overall_quality` int(58) NOT NULL,
  `average` int(11) NOT NULL,
  `grade` char(1) NOT NULL,
  `point` decimal(4,1) NOT NULL,
  `assedby` varchar(100) NOT NULL,
  `remark` text NOT NULL,
  `publication_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `assescriteria`
--

INSERT INTO `assescriteria` (`id`, `coverag`, `originality`, `Contribut`, `academic_discipline`, `specialize`, `presentation`, `overall_quality`, `average`, `grade`, `point`, `assedby`, `remark`, `publication_id`) VALUES
(14, 34, 40, 90, 56, 40, 45, 40, 49, 'B', 1.0, '14', 'Yes', 15),
(15, 34, 78, 90, 56, 34, 40, 34, 52, 'B', 1.0, '17', 'iohgugf', 15);

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE IF NOT EXISTS `college` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`id`, `name`) VALUES
(4, 'CoICT'),
(5, 'CoET'),
(6, 'UDBS'),
(7, 'CoSS'),
(8, 'UDSoL'),
(9, 'CoNAS'),
(10, 'Cohu'),
(11, 'SJMC');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(10) NOT NULL AUTO_INCREMENT,
  `publication_quality` varchar(200) NOT NULL,
  `merit_promotion` varchar(200) NOT NULL,
  `other_comment` text NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `publication_quality`, `merit_promotion`, `other_comment`) VALUES
(1, 'Yes', 'Yes', 'Nothing he did'),
(2, 'Yes', 'Not quite', 'Good work'),
(3, 'Yes', 'Yes', 'Good work'),
(4, 'Yes', 'Yes', 'Good work'),
(5, 'Yes', 'Yes', 'Good work'),
(6, 'Yes', 'Yes', 'somehow'),
(7, 'Yes', 'Yes', 'eee'),
(8, 'Yes', 'Yes', 'Mambo gani haya'),
(9, 'Yes', 'Yes', 'ffg');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `staff_id` int(200) NOT NULL,
  `college_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `staff_id`, `college_id`) VALUES
(10, 'CSE', 25, '4'),
(11, 'ETE', 27, '4');

-- --------------------------------------------------------

--
-- Table structure for table `extreview`
--

CREATE TABLE IF NOT EXISTS `extreview` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `qualification` text NOT NULL,
  `department_id` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `extreview`
--

INSERT INTO `extreview` (`id`, `username`, `qualification`, `department_id`, `first_name`, `middle_name`, `last_name`, `user_id`) VALUES
(1, 'amos', 'Physics Specialist', 'CSE', 'Felician', 'Amos', 'Kuj', 0),
(2, 'eeer', 'W', 'ER', 'Q3WQQE', 'EEE', 'EERW', 0),
(3, 'www', 'wqw', 'ww', 'ww', 'www', 'eeee', 23),
(4, 'e', 'e', 'e', 'e', 'EEE', 'eeee', 26),
(5, 'mimi', 'mimi', '10', 'mimi', 'mimi', 'mimi', 27),
(6, 't', 'rrtyitt', '11', 'ew', 'www', 'ww', 28);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  `created_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `content` text,
  `staff_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_notification_staff1_idx` (`staff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `type`, `content`, `staff_id`, `status`) VALUES
(2, 'OVERSTAYED', 'Stevene G George has overstayed', 26, 1),
(3, 'OVERSTAYED', 'ssas aa aas has overstayed', 31, 1);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(45) DEFAULT NULL,
  `staff_id` int(11) NOT NULL,
  `descrp` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_position_staff1_idx` (`staff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `position_name`, `staff_id`, `descrp`) VALUES
(1, 'Tutorial Assistant', 0, 'Minimum GPA of 4+, is one of the criteria'),
(2, 'Senior Lecturer', 0, ' Requires a good\r\nprogress report on the PhD program and at least 1 point\r\nfrom papers published in '),
(3, 'Lecturer', 0, 'blaa blaa'),
(4, 'Assitant Lecture', 0, 'bla bsj jsks'),
(5, 'Proffessor', 0, 'gdydy dge'),
(6, 'gsys', 0, 'isi9');

-- --------------------------------------------------------

--
-- Table structure for table `progreport`
--

CREATE TABLE IF NOT EXISTS `progreport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `report` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `uploader` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `progreport`
--

INSERT INTO `progreport` (`id`, `name`, `report`, `description`, `uploader`) VALUES
(4, 'Final', 'Illegal Contracts-LLB.pdf', 'Nothing', '10'),
(5, 'dsdd', 'Full page photo.pdf', 'wqdasqw', '15');

-- --------------------------------------------------------

--
-- Table structure for table `publication`
--

CREATE TABLE IF NOT EXISTS `publication` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` varchar(800) NOT NULL,
  `docupload` varchar(100) NOT NULL,
  `uplooadedby` int(11) NOT NULL,
  `year` int(45) NOT NULL,
  `staff_id` int(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `publication`
--

INSERT INTO `publication` (`id`, `name`, `type`, `docupload`, `uplooadedby`, `year`, `staff_id`) VALUES
(15, 'Book1', 'Journal Paper', '1466586622.pdf', 10, 1990, 24),
(16, 'myresearch', 'Consultancy Reports', '1466586655.pdf', 10, 2005, 25),
(17, 'pub2', 'Conference Papers', '1466615179.pdf', 18, 1990, 23),
(18, 'pub3', 'Book & Books Chapters', '1466615220.pdf', 18, 2016, 23),
(19, 'myresearch', 'Book & Books Chapters', '1466680497.pdf', 18, 1990, 27),
(20, 'Book1', 'Journal Paper', '1466680611.pdf', 18, 2016, 27);

-- --------------------------------------------------------

--
-- Table structure for table `receiver`
--

CREATE TABLE IF NOT EXISTS `receiver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_receiver_message1_idx` (`message_id`),
  KEY `fk_receiver_user1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reviewer`
--

CREATE TABLE IF NOT EXISTS `reviewer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publication_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `reviewer`
--

INSERT INTO `reviewer` (`id`, `publication_id`, `staff_id`) VALUES
(5, 15, 17),
(4, 15, 14),
(6, 15, 27),
(7, 18, 28);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'administrator'),
(2, 'staff'),
(3, 'hod'),
(4, 'training_officer'),
(5, 'recruitment_officer'),
(6, 'hr'),
(7, 'reviewer');

-- --------------------------------------------------------

--
-- Table structure for table `sender`
--

CREATE TABLE IF NOT EXISTS `sender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sender_message1_idx` (`message_id`),
  KEY `fk_sender_user1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `middle_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `DOB` date NOT NULL,
  `college_id` int(10) NOT NULL,
  `department_id` varchar(200) NOT NULL,
  `phone` int(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `imagepath` varchar(100) NOT NULL,
  `education` varchar(100) NOT NULL,
  `phone2` int(12) NOT NULL,
  `email2` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `first_name`, `middle_name`, `last_name`, `start_date`, `DOB`, `college_id`, `department_id`, `phone`, `email`, `imagepath`, `education`, `phone2`, `email2`, `title`, `status`, `username`, `user_id`) VALUES
(20, 'Amos', 'S.', 'Felician', '2016-06-01', '2016-06-05', 4, '10', 768565432, 'amos@gmail.com', '1466938818.png', 'diploma', 768565432, 'amos@gmail.com', 'Mr.', 'on work', 'senyoni', 13),
(23, 'Abas', 'Abdalah', 'Abas', '2016-06-01', '2016-06-02', 4, '11', 768565432, 'amos@gmail.com', '1466938832.png', 'degree', 768565432, 'amos@gmail.com', 'Mr.', 'on work', 'aba', 14),
(24, 'Juma', 'F', 'Uled', '2016-06-01', '2016-06-01', 4, '10', 768565432, 'amos@gmail.com', '1466939048.jpg', 'degree', 768565432, 'amos@gmail.com', 'Dr.', 'on work', 'juma', 15),
(25, 'Gelard', 'F', 'Nganda', '2016-06-01', '2016-04-03', 4, '10', 768565432, 'amos@gmail.com', '1466939061.jpg', 'degree', 768565432, 'amos@gmail.com', 'Dr.', 'on work', 'nganda', 16),
(26, 'Stevene', 'G', 'George', '2016-01-01', '2015-04-05', 4, '10', 768565432, 'amos@gmail.com', '1466938885.png', 'degree', 768565432, 'amos@gmail.com', 'Mr.', 'on work', 'ste', 17),
(27, 'Monica', 'N', 'Felician', '2016-06-01', '2015-01-04', 4, '11', 768565432, 'amos@gmail.com', '1466938873.png', 'masters', 768565432, 'amos@gmail.com', 'Ms.', 'on work', 'monie', 18),
(28, 'Danger', 'N', 'Nyahila', '2016-06-01', '2016-06-02', 4, '10', 768565432, 'amos@gmail.com', '1466938897.png', 'degree', 768565432, 'amos@gmail.com', 'Mr.', 'on studies', 'danger', 19),
(31, 'e', 'd', 'd', '2016-06-06', '2016-06-01', 4, '10', 1234567, 'a@gmail.com', '1466938911.png', 'degree', 23456788, 'a@gmail.com', 'Mr.', 'on work', 'don', 25);

-- --------------------------------------------------------

--
-- Table structure for table `study`
--

CREATE TABLE IF NOT EXISTS `study` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(45) DEFAULT NULL,
  `staff_id` int(11) NOT NULL,
  `university` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `year_of_study` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_studylevel_staff1_idx` (`staff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `study`
--

INSERT INTO `study` (`id`, `level`, `staff_id`, `university`, `status`, `year_of_study`) VALUES
(3, 'Phd', 23, 'Havard Unversity', 'Good', 2),
(4, 'Masters', 25, 'Uganda University', 'Continue', 3),
(5, 'Masters', 24, 'Uganda University', 'on studies', 2),
(6, 'Masters', 24, 'Uganda University', 'on studies', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role_id` int(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role_id`, `created_at`) VALUES
(10, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 1, '2016-06-17 12:41:33'),
(13, 'senyoni', '827ccb0eea8a706c4c34a16891f84e7b', 2, '2016-06-19 11:45:33'),
(14, 'aba', '827ccb0eea8a706c4c34a16891f84e7b', 2, '2016-06-19 14:14:56'),
(15, 'juma', '827ccb0eea8a706c4c34a16891f84e7b', 2, '2016-06-19 18:26:53'),
(16, 'nganda', '827ccb0eea8a706c4c34a16891f84e7b', 3, '2016-06-19 18:28:10'),
(17, 'stev', '827ccb0eea8a706c4c34a16891f84e7b', 7, '2016-06-19 18:29:34'),
(18, 'monie', '827ccb0eea8a706c4c34a16891f84e7b', 3, '2016-06-19 18:30:56'),
(19, 'danger', '827ccb0eea8a706c4c34a16891f84e7b', 2, '2016-06-19 18:32:02'),
(22, 'w', '827ccb0eea8a706c4c34a16891f84e7b', 7, '2016-06-19 18:35:29'),
(24, 'user', '827ccb0eea8a706c4c34a16891f84e7b', 2, '2016-06-25 10:46:36'),
(25, 'don', '827ccb0eea8a706c4c34a16891f84e7b', 2, '2016-06-25 10:54:08'),
(26, 'e', '827ccb0eea8a706c4c34a16891f84e7b', 7, '2016-06-25 10:55:31'),
(27, 'mimi', '827ccb0eea8a706c4c34a16891f84e7b', 7, '2016-06-25 11:54:41'),
(28, 't', '827ccb0eea8a706c4c34a16891f84e7b', 7, '2016-06-25 11:55:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  KEY `fk_user_group_user_idx` (`user_id`),
  KEY `fk_user_group_group1_idx` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
