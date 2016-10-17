-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 17, 2016 at 01:21 PM
-- Server version: 5.6.30
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment-portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE IF NOT EXISTS `assignment` (
  `id` int(5) unsigned NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `attachment` varchar(500) DEFAULT NULL,
  `course_id` int(3) NOT NULL,
  `lecturer_id` int(3) NOT NULL,
  `grade` varchar(100) DEFAULT NULL,
  `deadline` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id`, `title`, `description`, `attachment`, `course_id`, `lecturer_id`, `grade`, `deadline`) VALUES
(1, 'Develop An Algorithim to Calculate Number from 1 - 12', 'Nothing, Just a test', 'C:/Program Files (x86)/Ampps/www/AssignmentPortalsNew/uploads/assignments/Develop-An-Algorithim-to-Calculate-Number-from-1-12-1476709925.pdf', 1, 4, '60', '2016-10-18 13:11:38');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(5) unsigned NOT NULL,
  `title` varchar(200) NOT NULL,
  `code` varchar(100) NOT NULL,
  `is_core` tinyint(1) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `units` int(3) NOT NULL,
  `level_id` int(3) NOT NULL,
  `department_id` int(3) NOT NULL,
  `lecturer_id` int(3) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `title`, `code`, `is_core`, `description`, `units`, `level_id`, `department_id`, `lecturer_id`) VALUES
(1, 'Intro To Computer Science', 'COM 101', 1, 'Introduction to computer science course', 2, 1, 1, 4),
(2, 'Intro To Computer Programming', 'COM 121', NULL, 'Introduction to computer programming course', 2, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_material`
--

CREATE TABLE IF NOT EXISTS `course_material` (
  `id` int(5) unsigned NOT NULL,
  `course_id` int(3) NOT NULL,
  `lecturer_id` int(3) NOT NULL,
  `title` varchar(200) NOT NULL,
  `path` varchar(300) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_material`
--

INSERT INTO `course_material` (`id`, `course_id`, `lecturer_id`, `title`, `path`, `file_type`, `description`) VALUES
(1, 1, 4, 'Test Matreial', 'C:/Program Files (x86)/Ampps/www/AssignmentPortalsNew/uploads/course-1-1476709747.png', 'image/png', 'Nothing');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(5) unsigned NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'Computer Science'),
(2, 'Business Administration');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `id` int(5) unsigned NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `name`) VALUES
(1, 'OND 1'),
(2, 'OND 2'),
(3, 'HND 1'),
(4, 'HND 2');

-- --------------------------------------------------------

--
-- Table structure for table `student_assignment`
--

CREATE TABLE IF NOT EXISTS `student_assignment` (
  `id` int(5) unsigned NOT NULL,
  `submitted` datetime NOT NULL,
  `assignment_id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `score` varchar(500) DEFAULT NULL,
  `answer` text,
  `attachment` varchar(500) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_assignment`
--

INSERT INTO `student_assignment` (`id`, `submitted`, `assignment_id`, `user_id`, `score`, `answer`, `attachment`, `remarks`, `notes`) VALUES
(1, '2016-10-17 13:15:12', 1, 2, NULL, '/*\r\n|--------------------------------------------------------------------------\r\n| Index File\r\n|--------------------------------------------------------------------------\r\n|\r\n| Typically this will be your index.php file, unless you''ve renamed it to\r\n| something else. If you are using mod_rewrite to remove the page set this\r\n| variable so that it is blank.\r\n|\r\n*/', 'C:/Program Files (x86)/Ampps/www/AssignmentPortalsNew/uploads/answers/assignment-102-1476710112.pdf', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE IF NOT EXISTS `student_course` (
  `id` int(5) unsigned NOT NULL,
  `user_id` int(3) NOT NULL,
  `course_id` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`id`, `user_id`, `course_id`) VALUES
(1, 2, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(5) unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(300) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `matric` varchar(100) DEFAULT NULL,
  `level_id` int(5) NOT NULL,
  `department_id` int(5) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'student',
  `is_admin` smallint(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `address`, `password`, `sex`, `matric`, `level_id`, `department_id`, `role`, `is_admin`) VALUES
(1, 'Super Admin', 'admin@example.com', NULL, 'admin', 'male', NULL, 0, 0, '', 1),
(2, 'Student One', 'studentone@example.com', '', 'one', 'male', NULL, 1, 1, 'student', NULL),
(3, 'Student Two', 'studenttwo@example.com', NULL, 'two', 'male', NULL, 1, 0, 'student', NULL),
(4, 'Lecturer One', 'lecturer1@example.com', NULL, 'tone', 'male', NULL, 0, 0, 'lecturer', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_material`
--
ALTER TABLE `course_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_assignment`
--
ALTER TABLE `student_assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `course_material`
--
ALTER TABLE `course_material`
  MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `student_assignment`
--
ALTER TABLE `student_assignment`
  MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student_course`
--
ALTER TABLE `student_course`
  MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
