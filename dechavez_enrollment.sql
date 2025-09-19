-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2025 at 12:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dechavez_enrollment`
--

-- --------------------------------------------------------

--
-- Table structure for table `institute_tbl`
--

CREATE TABLE `institute_tbl` (
  `ins_id` int(11) NOT NULL,
  `ins_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `institute_tbl`
--

INSERT INTO `institute_tbl` (`ins_id`, `ins_name`) VALUES
(1, 'College of Engineering'),
(2, 'College of Information System'),
(3, 'College of Business'),
(4, 'College of Education'),
(5, 'College of Arts and Sciences');

-- --------------------------------------------------------

--
-- Table structure for table `program_tbl`
--

CREATE TABLE `program_tbl` (
  `program_id` int(11) NOT NULL,
  `program_name` varchar(100) DEFAULT NULL,
  `ins_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `program_tbl`
--

INSERT INTO `program_tbl` (`program_id`, `program_name`, `ins_id`) VALUES
(1, 'BS Civil Engineering', 1),
(2, 'BS Computer Science', 2),
(3, 'BS Information Systems', 2),
(4, 'BS Accountancy', 3),
(5, 'BSEd Major in Math', 4),
(6, 'BS Information Technology', 1);

-- --------------------------------------------------------

--
-- Table structure for table `semester_tbl`
--

CREATE TABLE `semester_tbl` (
  `sem_id` int(11) NOT NULL,
  `sem_name` varchar(50) DEFAULT NULL,
  `year_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `semester_tbl`
--

INSERT INTO `semester_tbl` (`sem_id`, `sem_name`, `year_id`) VALUES
(1, '1st Semester', 1),
(2, '2nd Semester', 1),
(3, '1st Semester', 2),
(4, '2nd Semester', 2),
(5, '3rd Semester', 2),
(6, '4th semester', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_load`
--

CREATE TABLE `student_load` (
  `load_id` int(11) NOT NULL,
  `stud_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student_load`
--

INSERT INTO `student_load` (`load_id`, `stud_id`, `subject_id`) VALUES
(1, 1, 3),
(3, 2, 3),
(4, 3, 1),
(5, 4, 4),
(6, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `stud_id` int(11) NOT NULL,
  `Last_Name` varchar(60) NOT NULL,
  `First_Name` varchar(60) NOT NULL,
  `Middle_Name` varchar(30) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `Allowance` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`stud_id`, `Last_Name`, `First_Name`, `Middle_Name`, `program_id`, `Allowance`) VALUES
(1, 'Ramos', 'Jenny Rose', 'Laguerta', 2, 1008),
(2, 'Espiritu', 'Reya', 'Echon', 2, 2000),
(3, 'Cantos', 'Ivan Jonas', 'Santos', 1, 2300),
(4, 'Villanueva', 'Irish', 'Alda', 4, 1500),
(5, 'De Torres', 'Niezl Skye', 'Ballest', 5, 3100),
(7, 'Andal', 'Kassandra', 'Malabanan', 2, 1200),
(8, 'Sapeda', 'Trisha Mae Angel', 'Cadiz', 3, 6200),
(9, 'Cajara', 'Janeth', 'Santos', 4, 6210),
(10, 'De Chavez', 'Jade Patrick', 'Magtibay', 5, 1200),
(11, 'Duenas', 'Monique', 'De Chavez', 1, 1000),
(12, 'Nefiel', 'Icie', 'Flotado', 2, 1100),
(13, 'Jusay', 'Ruth Joyce', 'De Chavez', 3, 1200),
(14, 'De Chavez', 'Pollene Joy', 'Magtibay', 4, 1300),
(15, 'Gallano', 'Fred ', 'Claveria', 5, 1400),
(16, 'Bautista', 'Deifrich', 'Goda', 1, 1500),
(17, 'De Acosta', 'Kobe', 'Algire', 2, 1600),
(18, 'Tegio', 'Ivy', 'Cagalfin', 3, 1700),
(19, 'Flotado', 'Joshua', 'Magtibay', 4, 1800),
(20, 'Conejos', 'Arwen Claire', 'Magtibay', 5, 1900),
(21, 'Fajardo', 'Janelle', 'Mendoza', 1, 2000),
(22, 'Borsoto', 'Hannah Trisha', 'Torilisa', 2, 2100),
(23, 'Malabanan', 'Gia Cassandra', 'Ginito', 3, 2200),
(24, 'Laguerta', 'Nathan Jay', 'Ramos', 4, 2300),
(25, 'Maranan', 'Anthony', 'De Chavez', 5, 2400),
(27, 'De Chavez', 'Imelda', 'Magtibay', 1, 5000),
(28, 'Aranas', 'John Paul', 'Garcia', 3, 2000000),
(30, 'Ramos', 'Kheyjay', 'Magtibay', 4, 1800),
(47, 'Teves', 'Art', 'Hapa', 1, 2345);

-- --------------------------------------------------------

--
-- Table structure for table `subject_tbl`
--

CREATE TABLE `subject_tbl` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) DEFAULT NULL,
  `sem_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subject_tbl`
--

INSERT INTO `subject_tbl` (`subject_id`, `subject_name`, `sem_id`) VALUES
(1, 'Introduction to Programming', 1),
(2, 'Data Structures', 2),
(3, 'Database Management', 3),
(4, 'Accounting ', 4),
(5, 'Educational Psychology', 5);

-- --------------------------------------------------------

--
-- Table structure for table `year_tbl`
--

CREATE TABLE `year_tbl` (
  `year_id` int(11) NOT NULL,
  `year_from` int(11) DEFAULT NULL,
  `year_to` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `year_tbl`
--

INSERT INTO `year_tbl` (`year_id`, `year_from`, `year_to`) VALUES
(1, 2023, 2025),
(2, 2024, 2025),
(3, 2025, 2026),
(4, 2026, 2027),
(5, 2027, 2028);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `institute_tbl`
--
ALTER TABLE `institute_tbl`
  ADD PRIMARY KEY (`ins_id`);

--
-- Indexes for table `program_tbl`
--
ALTER TABLE `program_tbl`
  ADD PRIMARY KEY (`program_id`),
  ADD KEY `ins_id` (`ins_id`);

--
-- Indexes for table `semester_tbl`
--
ALTER TABLE `semester_tbl`
  ADD PRIMARY KEY (`sem_id`),
  ADD KEY `year_id` (`year_id`);

--
-- Indexes for table `student_load`
--
ALTER TABLE `student_load`
  ADD PRIMARY KEY (`load_id`),
  ADD KEY `stud_id` (`stud_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`stud_id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indexes for table `subject_tbl`
--
ALTER TABLE `subject_tbl`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `sem_id` (`sem_id`);

--
-- Indexes for table `year_tbl`
--
ALTER TABLE `year_tbl`
  ADD PRIMARY KEY (`year_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `institute_tbl`
--
ALTER TABLE `institute_tbl`
  MODIFY `ins_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `program_tbl`
--
ALTER TABLE `program_tbl`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `semester_tbl`
--
ALTER TABLE `semester_tbl`
  MODIFY `sem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_load`
--
ALTER TABLE `student_load`
  MODIFY `load_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `stud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `subject_tbl`
--
ALTER TABLE `subject_tbl`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `year_tbl`
--
ALTER TABLE `year_tbl`
  MODIFY `year_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `program_tbl`
--
ALTER TABLE `program_tbl`
  ADD CONSTRAINT `program_tbl_ibfk_1` FOREIGN KEY (`ins_id`) REFERENCES `institute_tbl` (`ins_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
