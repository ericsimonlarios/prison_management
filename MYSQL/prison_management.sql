-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2022 at 02:43 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prison_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(256) NOT NULL,
  `admin_pass` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_pass`) VALUES
(1, 'admin', '$2y$10$9J4LNZ6VOqs0Vty176QxVeUq1KU9UmBhG1/qpgkkyurZI7yXf2qQa'),
(2, 'zagreus', '$2y$10$1aLMMnpYQpbYmYkyLhVUo.Olf8jRO/53NlHR8s6gorPkuM7RsSkRC');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `vname` varchar(256) NOT NULL,
  `vemail` varchar(256) NOT NULL,
  `vcontact` varchar(256) NOT NULL,
  `vadd` varchar(256) NOT NULL,
  `pfirst` varchar(256) NOT NULL,
  `plast` varchar(256) NOT NULL,
  `pdate` varchar(256) NOT NULL,
  `appointment_added` date NOT NULL DEFAULT current_timestamp(),
  `stats` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `vname`, `vemail`, `vcontact`, `vadd`, `pfirst`, `plast`, `pdate`, `appointment_added`, `stats`) VALUES
(1, 'Eric Simon Larios', 'zagreuscreen@gmail.com', '09995668770', 'Somewhere', 'Kyle Isaas', 'Mendoza', '2021-12-25', '0000-00-00', 'Pending'),
(2, 'Eric Simon Larios', 'zagreuscreen@gmail.com', '09995668770', 'Somewhere', 'Kyle Isaac', 'Mendoza', '2022-12-25', '2022-05-06', 'Pending'),
(3, 'Eric Simon Larios', 'asdasdas@gmail.com', '0995668770', 'Somewhere', 'Kyle Isaac', 'Mendoza', '2022-12-25', '2022-05-12', 'Approved'),
(4, 'Eric Simon Larios', 'asdsaf@gmail.com', '09995668770', 'Somewhere', 'Kyle Isaac', 'Mendoza', '2023-12-25', '2022-05-12', 'Approved'),
(5, 'Eric Simon Larios', 'dfglkjdfgljkdf@gmail.com', '09995668770', 'Somewhere', 'Kyle Isaac', 'Mendoza', '2025-12-25', '2022-05-12', 'Approved'),
(6, 'Eric Larios', 'asljkfjkgsahk@gmail.com', '09995668770', 'Somewhere', 'Kyle Isaac', 'Mendoza', '2022-02-05', '2022-05-12', 'Declined'),
(7, 'Simon Larios', 'aslkjglk@gmail.com', '09995668770', 'Somewhere', 'Kyle Isaac', 'Mendoza', '2022-05-12', '2022-05-12', 'Pending'),
(8, 'Eric Simon Larios', 'larios.ericsimon.122@gmail.com', '00000000000', 'Somewhere', 'Kyle Isaac', 'Mendoza', '2022-12-25', '2022-06-01', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `officer`
--

CREATE TABLE `officer` (
  `officer_id` int(11) NOT NULL,
  `police_id` int(11) NOT NULL,
  `officer_name` varchar(256) NOT NULL,
  `officer_pass` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `officer`
--

INSERT INTO `officer` (`officer_id`, `police_id`, `officer_name`, `officer_pass`) VALUES
(2, 0, 'Jeff', '$2y$10$MfRuQCjVnQlpUq8C/DJAsOTczRiNCZr5d/pMXEEUeRcLC4bmCAZCG'),
(3, 3, 'Larios', '696961'),
(4, 4, 'Larios', '$2y$10$D9D.l9wSZPGpciyjswaIMOBsQaPLnqcVgrThtRIl2nkm726PkCgM.'),
(5, 5, 'Larios', '$2y$10$RW7NYUpoaxNHqA3qAfgK/.iFiUagAdRNz6OYQyv0PEykBIygbrpki'),
(6, 6, 'Larios', '$2y$10$pNil9hsyWh2jj2trBFaCe.MP0RAf6cyszNgizq9XpIpPMulbwlLmW'),
(7, 7, '091257-Larios', '$2y$10$wI.VO8aUBmMcwcZb3mNHoOWJt29Fzv1/6kJ/cT5K0C4Z6gO1ewwRK');

-- --------------------------------------------------------

--
-- Table structure for table `police`
--

CREATE TABLE `police` (
  `police_id` int(11) NOT NULL,
  `police_pic` varchar(256) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `middle_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `rank` varchar(256) NOT NULL,
  `badge_no` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `date_started` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(256) NOT NULL,
  `officer_id` int(11) NOT NULL,
  `contact_no` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `police`
--

INSERT INTO `police` (`police_id`, `police_pic`, `first_name`, `middle_name`, `last_name`, `rank`, `badge_no`, `address`, `date_started`, `status`, `officer_id`, `contact_no`) VALUES
(1, 'police_pic/696969-Lariosa.png', 'Eric Simon', 'Alonzo', 'Lariosa', 'General', '696969', 'Somewhere', '2022-06-01', 'Employed', 0, '12321421412'),
(2, 'police_pic/696961-Larios.png', 'Eric Simon', 'Alonzo', 'Larios', 'General', '696961', 'Somewhere', '2022-06-01', 'Employed', 3, ''),
(3, 'police_pic/696961-Larios.png', 'Eric Simon', 'Alonzo', 'Larios', 'General', '696961', 'Somewhere', '2022-06-01', 'Employed', 3, ''),
(4, 'police_pic/152131-Larios.png', 'Eric Simon', 'Alonzo', 'Larios', 'General', '152131', 'Somewhere', '2022-06-01', 'Employed', 4, ''),
(5, 'police_pic/128753-Larios.png', 'Eric Simon', 'Alonzo', 'Larios', 'General', '128753', 'Somewhere', '2022-06-01', 'Employed', 5, ''),
(6, 'police_pic/012406-Larios.jpg', 'Eric Kayo', 'Mendoza', 'Larios', 'General', '012406', 'Somewhere', '2022-06-01', 'Removed', 6, '09956687702'),
(7, 'police_pic/091257-Larios.png', 'Eric Simon', 'Mendoza', 'Larios', 'General', '091257', 'Somewhere', '2022-06-02', 'Employed', 7, '35883476970');

-- --------------------------------------------------------

--
-- Table structure for table `prisoner`
--

CREATE TABLE `prisoner` (
  `prisoner_id` int(11) NOT NULL,
  `prisoner_pic` varchar(256) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `middle_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `crime` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `date_jailed` date NOT NULL DEFAULT current_timestamp(),
  `parole_date` varchar(256) NOT NULL,
  `discharge_date` varchar(256) NOT NULL,
  `sentence` varchar(256) NOT NULL,
  `remarks` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prisoner`
--

INSERT INTO `prisoner` (`prisoner_id`, `prisoner_pic`, `first_name`, `middle_name`, `last_name`, `crime`, `address`, `date_jailed`, `parole_date`, `discharge_date`, `sentence`, `remarks`, `status`) VALUES
(1, 'prisoner_pic/gasds-Lee.png', 'Ji Eun', 'gasds', 'Lee', 'Stealing someone\'s heart', 'Somewhere over the rainbow there', '2022-06-02', '122121-12-12', '12121-12-12', '500 page of repetition of the word lechonk', 'Extremely Dangerous', 'Released');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `officer`
--
ALTER TABLE `officer`
  ADD PRIMARY KEY (`officer_id`);

--
-- Indexes for table `police`
--
ALTER TABLE `police`
  ADD PRIMARY KEY (`police_id`);

--
-- Indexes for table `prisoner`
--
ALTER TABLE `prisoner`
  ADD PRIMARY KEY (`prisoner_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `officer`
--
ALTER TABLE `officer`
  MODIFY `officer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `police`
--
ALTER TABLE `police`
  MODIFY `police_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prisoner`
--
ALTER TABLE `prisoner`
  MODIFY `prisoner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
