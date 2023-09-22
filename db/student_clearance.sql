-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2023 at 08:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_clearance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(3) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `designation` varchar(25) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `status` varchar(10) NOT NULL,
  `photo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `faculty_id`, `department_id`, `username`, `password`, `designation`, `fullname`, `email`, `status`, `photo`) VALUES
(4, 0, 0, 'admin', 'admin123', 'Admin', 'EKE, EMMANUEL EFA-EVAL', 'eva_2012@gmail.com', 'Active', 'uploads/default.jpg'),
(9, 1, 1, 'deans', '12345678', 'Academy_head', 'Abubakar H', 'abubakarsd.harunasadiq@gmail.com', 'Active', 'uploads/avatar_nick.png'),
(10, 1, 1, 'Faruq', '12345678', 'faculty', 'Umar Faruq', 'faruq@gmail.com', 'Active', 'uploads/avatar_nick.png');

-- --------------------------------------------------------

--
-- Table structure for table `clearance_apply`
--

CREATE TABLE `clearance_apply` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `is_accademic_head` int(11) NOT NULL,
  `acc_sign_date` date NOT NULL,
  `is_faculty` int(11) NOT NULL,
  `faculty_sign_date` date NOT NULL,
  `is_dip_library` int(11) NOT NULL,
  `dip_library_sign_date` date DEFAULT NULL,
  `is_kill` int(11) NOT NULL,
  `kill_sign_date` date NOT NULL,
  `is_sport` int(11) NOT NULL,
  `sport_sign_date` date NOT NULL,
  `is_hostel` int(11) NOT NULL,
  `hostel_sign_date` date NOT NULL,
  `is_data_add` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clearance_apply`
--

INSERT INTO `clearance_apply` (`id`, `student_id`, `is_accademic_head`, `acc_sign_date`, `is_faculty`, `faculty_sign_date`, `is_dip_library`, `dip_library_sign_date`, `is_kill`, `kill_sign_date`, `is_sport`, `sport_sign_date`, `is_hostel`, `hostel_sign_date`, `is_data_add`) VALUES
(1, 8, 2, '2023-09-20', 2, '2023-09-19', 2, '2023-09-01', 2, '2023-09-19', 2, '2023-09-19', 2, '2023-09-19', '2023-09-18 18:32:07'),
(2, 9, 2, '2023-09-22', 1, '2023-09-22', 1, '2023-09-01', 1, '2023-09-22', 1, '0000-00-00', 1, '0000-00-00', '2023-09-22 16:57:15');

-- --------------------------------------------------------

--
-- Table structure for table `clearance_document`
--

CREATE TABLE `clearance_document` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `prof_type` varchar(100) NOT NULL,
  `proof_doc` varchar(255) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clearance_document`
--

INSERT INTO `clearance_document` (`id`, `student_id`, `prof_type`, `proof_doc`, `date_add`) VALUES
(1, 8, 'Hostel Clearance Slip', 'documents/20220810_115335.jpg', '2023-09-18 22:11:16'),
(2, 9, 'Hostel Clearance Slip', 'documents/01.jpg', '2023-09-22 16:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `department_tb`
--

CREATE TABLE `department_tb` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_tb`
--

INSERT INTO `department_tb` (`id`, `faculty_id`, `department_name`, `date_added`) VALUES
(1, 1, 'Computer Science', '2023-09-22 14:20:03'),
(2, 2, 'Micro-Biology', '2023-09-22 14:20:03'),
(5, 1, 'Geography', '2023-09-22 14:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_tb`
--

CREATE TABLE `faculty_tb` (
  `id` int(11) NOT NULL,
  `faculty_name` varchar(100) NOT NULL,
  `data_add` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_tb`
--

INSERT INTO `faculty_tb` (`id`, `faculty_name`, `data_add`) VALUES
(1, 'Physical Science', '2023-09-22 14:18:05'),
(2, 'Life Science', '2023-09-22 14:18:05'),
(3, 'Engineering', '2023-09-22 14:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `fee`
--

CREATE TABLE `fee` (
  `ID` int(3) NOT NULL,
  `session` varchar(9) NOT NULL,
  `faculty` int(11) NOT NULL,
  `dept` int(11) NOT NULL,
  `amount` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fee`
--

INSERT INTO `fee` (`ID`, `session`, `faculty`, `dept`, `amount`) VALUES
(17, '2021/2022', 1, 1, '3000');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `ID` int(4) NOT NULL,
  `feeID` varchar(25) NOT NULL,
  `studentID` varchar(25) NOT NULL,
  `amount` varchar(25) NOT NULL,
  `datepaid` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`ID`, `feeID`, `studentID`, `amount`, `datepaid`) VALUES
(24, '8FAC46R2579D', '8', '2000', '2022-08-17 13:24:57'),
(26, 'A6D53B279F80', '9', '3000', '2023-09-22 16:55:54');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `ID` int(3) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `matric_no` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `session` varchar(10) NOT NULL,
  `faculty` int(11) NOT NULL,
  `dept` int(11) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `photo` varchar(400) NOT NULL,
  `is_hostel` varchar(50) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `is_stud_affairs_approved` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`ID`, `fullname`, `matric_no`, `password`, `session`, `faculty`, `dept`, `phone`, `photo`, `is_hostel`, `Address`, `is_stud_affairs_approved`) VALUES
(8, 'Eke Emmanuel Efa-eval', '18/132010', '11111111', '2021/2022', 1, 1, '08067361023', 'uploads/eva.jpeg', 'Dangote Hostel: Room A25', 'No 5 school road Kaduna', 1),
(9, 'Abubakar Sd Haruna', 'U19CS2049', '6shmug', '2021/2022', 1, 1, '09068008764', 'uploads/avatar_nick.png', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblsession`
--

CREATE TABLE `tblsession` (
  `ID` int(3) NOT NULL,
  `session` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsession`
--

INSERT INTO `tblsession` (`ID`, `session`) VALUES
(1, '2020/2021'),
(2, '2021/2022');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `clearance_apply`
--
ALTER TABLE `clearance_apply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clearance_document`
--
ALTER TABLE `clearance_document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_tb`
--
ALTER TABLE `department_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_tb`
--
ALTER TABLE `faculty_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee`
--
ALTER TABLE `fee`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblsession`
--
ALTER TABLE `tblsession`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `clearance_apply`
--
ALTER TABLE `clearance_apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clearance_document`
--
ALTER TABLE `clearance_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department_tb`
--
ALTER TABLE `department_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faculty_tb`
--
ALTER TABLE `faculty_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fee`
--
ALTER TABLE `fee`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblsession`
--
ALTER TABLE `tblsession`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
