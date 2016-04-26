-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2016 at 12:38 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pocket-advisor`
--

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `college_id` int(255) NOT NULL,
  `college_name` char(255) DEFAULT NULL,
  `institution_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`college_id`, `college_name`, `institution_id`) VALUES
(12, 'College of Engineering', 24),
(13, 'College of Engineering', 26);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(255) NOT NULL,
  `course_name` char(255) DEFAULT NULL,
  `credit_hours` int(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_name`, `credit_hours`, `description`) VALUES
(1, 'Theory of Automata', 3, 'This class is fun!'),
(2, 'Object-Oriented Programming', 3, 'This is fun too!'),
(4, 'Software Engineering I', 3, 'This class is fun. We''re having fun.');

-- --------------------------------------------------------

--
-- Table structure for table `degree plan`
--

CREATE TABLE `degree plan` (
  `id` int(255) NOT NULL,
  `degree_name` char(255) DEFAULT NULL,
  `total_hours` int(255) DEFAULT NULL,
  `dept_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `degree plan`
--

INSERT INTO `degree plan` (`id`, `degree_name`, `total_hours`, `dept_id`) VALUES
(1, 'Computer Engineering', 129, 48),
(2, 'Electrical Engineering', 132, 48);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(255) NOT NULL,
  `dept_name` char(255) DEFAULT NULL,
  `college_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `college_id`) VALUES
(48, 'ECE Department', 24);

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

CREATE TABLE `institution` (
  `institution_id` int(255) NOT NULL,
  `institution_name` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`institution_id`, `institution_name`) VALUES
(24, 'Texas Tech University'),
(26, 'South Plains College');

-- --------------------------------------------------------

--
-- Table structure for table `jnct_degreeplan_course`
--

CREATE TABLE `jnct_degreeplan_course` (
  `DegreePlan_ID_FK` int(255) NOT NULL,
  `Course_ID_FK` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jnct_user_course`
--

CREATE TABLE `jnct_user_course` (
  `User_ID_FK` int(255) NOT NULL,
  `Course_ID_FK` int(255) NOT NULL,
  `grade` int(255) DEFAULT NULL,
  `semester` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jnct_user_course`
--

INSERT INTO `jnct_user_course` (`User_ID_FK`, `Course_ID_FK`, `grade`, `semester`) VALUES
(1, 1, 98, 'Spring 2016'),
(1, 2, 99, 'Spring 2016'),
(2, 2, 97, 'Spring 2016'),
(2, 4, 100, 'Spring 2016');

-- --------------------------------------------------------

--
-- Table structure for table `jnct_user_degreeplan`
--

CREATE TABLE `jnct_user_degreeplan` (
  `User_ID_FK` int(255) NOT NULL,
  `DegreePlan_ID_FK` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prereq`
--

CREATE TABLE `prereq` (
  `courseid` int(255) NOT NULL COMMENT 'course',
  `courseid2` int(255) NOT NULL COMMENT 'course''s prereq'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `login` char(255) DEFAULT NULL,
  `password` char(255) DEFAULT NULL,
  `email` char(255) DEFAULT NULL,
  `first_name` char(255) DEFAULT NULL,
  `middle_name` char(255) DEFAULT NULL,
  `last_name` char(255) DEFAULT NULL,
  `role` char(255) DEFAULT NULL,
  `gpa` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `email`, `first_name`, `middle_name`, `last_name`, `role`, `gpa`) VALUES
(0, 'testtest1', '7a371de86fe43ecbb1b8c27b0bbd59f7', NULL, NULL, NULL, NULL, 'ADMIN', NULL),
(1, 'hernan86', 'friend', 'carlos.p.hernandez@ttu.edu', 'Carlos', 'Paulo', 'Hernandez', 'ADMIN', 4),
(2, 'jpaul', 'password123', 'jerrypaul@ttu.edu', 'Jerry', NULL, 'Paul', 'ADMIN', 4),
(3, 'chernan', 'coffee', 'chernandez6880@gmail.com', 'Daniel', 'Ray', 'Hernandez', 'ADMIN', NULL),
(4, 'qweqweqweqweqwe', 'qweqweqwe', NULL, NULL, NULL, NULL, 'ADMIN', NULL),
(5, 'peeopeeo', '943ee8bef45fc4dc65d33d4363f48a8c', NULL, NULL, NULL, NULL, 'ADMIN', NULL),
(6, 'jerrypaul18', '7b546f93f93f255c9754f7e940f7ea95', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'lhbjhbkjbjh', 'aef3fb131b34d36d4014bb9df9006a46', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'jjjjjjjjjj', 'c71a8da22bf4053760a604897627474c', 'sdfljsdfkspdofk', NULL, NULL, NULL, NULL, NULL),
(9, 'dflkgmlskdfglkj', '6d2b55240a3c121a4ea0f841821ee10a', 'dskjngkjdnfkjnsdf', '''dskjngkjdnfkjnsdf''', 'lksdifji', 'ijfijfijfw', 'ADMIN', NULL),
(10, 'qweqweqwe', 'b26986ceee60f744534aaab928cc12df', '', '''''', '', '', 'ADMIN', NULL),
(11, 'Samqle', '452f2859994b170e6dcadafb7e1650d7', '', '''''', '', '', 'ADMIN', NULL),
(12, 'asdasdasd', 'a3dcb4d229de6fde0db5686dee47145d', '', '''''', '', '', 'REQUEST', NULL),
(13, 'lkdlkflklkrejf', 'e64f744a27a93c00eb8e5181586c2061', '', '''''', '', '', 'REQUEST', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`college_id`),
  ADD KEY `institution_id` (`institution_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `degree plan`
--
ALTER TABLE `degree plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`),
  ADD KEY `college_id` (`college_id`);

--
-- Indexes for table `institution`
--
ALTER TABLE `institution`
  ADD PRIMARY KEY (`institution_id`),
  ADD KEY `institution_id` (`institution_id`);

--
-- Indexes for table `jnct_degreeplan_course`
--
ALTER TABLE `jnct_degreeplan_course`
  ADD PRIMARY KEY (`DegreePlan_ID_FK`,`Course_ID_FK`);

--
-- Indexes for table `jnct_user_course`
--
ALTER TABLE `jnct_user_course`
  ADD PRIMARY KEY (`User_ID_FK`,`Course_ID_FK`);

--
-- Indexes for table `jnct_user_degreeplan`
--
ALTER TABLE `jnct_user_degreeplan`
  ADD PRIMARY KEY (`User_ID_FK`,`DegreePlan_ID_FK`);

--
-- Indexes for table `prereq`
--
ALTER TABLE `prereq`
  ADD PRIMARY KEY (`courseid`),
  ADD KEY `courseid` (`courseid`,`courseid2`),
  ADD KEY `courseid_2` (`courseid`,`courseid2`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `college_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
