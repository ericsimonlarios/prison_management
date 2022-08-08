-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2022 at 03:52 AM
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
-- Table structure for table `action_list`
--

CREATE TABLE `action_list` (
  `id` int(30) NOT NULL,
  `action_name` text NOT NULL,
  `status_action` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `action_list`
--

INSERT INTO `action_list` (`id`, `action_name`, `status_action`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Solitary Confinement', 1, 0, '2022-07-05 12:31:05', '2022-07-05 12:31:05'),
(2, 'Transported for Trial', 1, 0, '2022-07-05 12:31:28', '2022-07-06 16:38:18'),
(3, 'Infirmary Confinement', 1, 0, '2022-07-06 16:37:53', '2022-07-06 16:37:53'),
(4, 'Demonstrated act of Good Behavior', 1, 0, '2022-07-06 16:40:22', '2022-07-06 16:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_pic` varchar(256) NOT NULL,
  `admin_name` varchar(256) NOT NULL,
  `admin_pass` varchar(256) NOT NULL,
  `fname` varchar(256) NOT NULL,
  `mname` varchar(256) NOT NULL,
  `lname` varchar(256) NOT NULL,
  `date_created` varchar(256) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_pic`, `admin_name`, `admin_pass`, `fname`, `mname`, `lname`, `date_created`) VALUES
(1, 'admin_pic/admin-Arnling.png', 'admin', '$2y$10$XkRRT./O3xMYL0AIl5YM/OLzTjof2Kl79TNt7deegkh31/TfdpS5y', 'Adalbrand', 'Arn', 'Arnling', '2022-07-05 12:13:58'),
(2, 'admin_pic/geoffrey.png', 'geoffrey', '$2y$10$l7ehtQcYKAY0QEGrHSLETuc.TxnrR9kfdlZfbe/tFD9181E0HZd3K', 'Godfrey', 'Javed', 'Vagrant', '2022-07-07 09:23:01');

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
  `stats` varchar(256) NOT NULL,
  `relation` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `vname`, `vemail`, `vcontact`, `vadd`, `pfirst`, `plast`, `pdate`, `appointment_added`, `stats`, `relation`) VALUES
(1, 'Mary ', 'mary@gmail.com', '08768678673', 'B12 L106 Ph 1A Suburban', 'Charlene', 'Mingoa', '2022-12-25', '2022-07-05', 'Approved', 'Sister'),
(2, 'Andy Bautista', 'andy@gmail.com', '09123456789', '1031 B Sta. Cruz St. Sampaloc, Manila', 'Erin', 'Madia', '2022-11-15', '2022-07-05', 'Declined', 'Mother'),
(3, 'Maria Leonora  Cruz', 'maria@gmail.com', '09123456789', '4554 Guadal Canal St. Brgy 587-A Sta Mesa Manila', 'Christian Manuel', 'Valentino', '2023-10-25', '2022-07-06', 'Pending', 'Father');

-- --------------------------------------------------------

--
-- Table structure for table `block_list`
--

CREATE TABLE `block_list` (
  `id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `cell_name` varchar(256) NOT NULL,
  `status_cell` varchar(256) NOT NULL,
  `date_created` varchar(256) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `block_list`
--

INSERT INTO `block_list` (`id`, `building_id`, `cell_name`, `status_cell`, `date_created`) VALUES
(1, 1, 'Block 1 Cell 1002', '1', '2022-07-05 12:16:32'),
(3, 2, 'Block 1 Cell 1009', '1', '2022-07-06 16:47:08'),
(4, 1, 'Block 1 Cell 1040', '1', '2022-07-06 16:47:25'),
(5, 1, 'Block 1 Cell 1076', '1', '2022-07-06 16:49:20'),
(6, 2, 'Block 1 Cell 1098', '1', '2022-07-06 16:52:10'),
(7, 1, 'Block 2 Cell 1010', '1', '2022-07-06 16:52:26'),
(8, 2, 'Block 2 Cell 1045', '1', '2022-07-06 16:55:19'),
(9, 1, 'Block 2 Cell 1101', '1', '2022-07-06 16:55:46'),
(10, 1, 'Block 2 Cell 1105', '1', '2022-07-06 17:09:54'),
(11, 2, 'Block 2 Cell 1110', '1', '2022-07-06 17:10:18'),
(12, 1, 'Block 3 Cell 1003', '1', '2022-07-06 17:10:39'),
(13, 1, 'Block 3 Cell 1005', '1', '2022-07-06 17:11:17'),
(14, 1, 'Block 3 Cell 1106', '1', '2022-07-06 17:14:41'),
(15, 2, 'Block 3 Cell 1115', '1', '2022-07-06 17:15:07'),
(16, 2, 'Block 3 Cell 1201', '1', '2022-07-06 17:16:00'),
(17, 1, 'Block 4 Cell 1006', '1', '2022-07-06 17:17:26'),
(18, 2, 'Block 4 Cell 1212', '1', '2022-07-06 17:17:43'),
(19, 2, 'Block 4 Cell 1314', '1', '2022-07-06 17:18:03'),
(20, 1, 'Block 4 Cell 1331', '1', '2022-07-06 17:18:33'),
(21, 1, 'Block 4 Cell 1400', '1', '2022-07-06 17:18:46');

-- --------------------------------------------------------

--
-- Table structure for table `fam_directory`
--

CREATE TABLE `fam_directory` (
  `dir_id` int(11) NOT NULL,
  `fam_id` int(11) NOT NULL,
  `prisoner_id` int(11) NOT NULL,
  `date_created` varchar(256) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fam_directory`
--

INSERT INTO `fam_directory` (`dir_id`, `fam_id`, `prisoner_id`, `date_created`) VALUES
(1, 1, 1, '2022-07-05 12:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `fam_record`
--

CREATE TABLE `fam_record` (
  `fam_id` int(11) NOT NULL,
  `fam_name` varchar(256) NOT NULL,
  `fam_age` varchar(256) NOT NULL,
  `fam_sex` varchar(256) NOT NULL,
  `fam_relation` varchar(256) NOT NULL,
  `fam_occ` varchar(256) NOT NULL,
  `date_created` varchar(256) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fam_record`
--

INSERT INTO `fam_record` (`fam_id`, `fam_name`, `fam_age`, `fam_sex`, `fam_relation`, `fam_occ`, `date_created`) VALUES
(1, 'Theodwyn', '20', 'Female', 'Sister', 'Duchess', '2022-07-05 12:30:41');

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
(1, 1, 'simon', '$2y$10$UWO9ApP.M5xygoQb2lDsU.yhJK1YOqq.uTE0T6KiU1YFfr3LyMPzm'),
(2, 2, 'sabrinasnts', '$2y$10$fZJVZ6ByW4H/fegNMRo5/e9jpBxrqDTIQS.2djwAaRciXdfff0Wb2');

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
  `contact_no` varchar(256) NOT NULL,
  `officer_sex` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `police`
--

INSERT INTO `police` (`police_id`, `police_pic`, `first_name`, `middle_name`, `last_name`, `rank`, `badge_no`, `address`, `date_started`, `status`, `officer_id`, `contact_no`, `officer_sex`) VALUES
(1, 'police_pic/555661-Dela Cruz.jpg', 'Juan', 'Miguel', 'Dela Cruz', 'Jail Inspector', '555661', 'Tondo Manila', '2022-07-05', 'Employed', 1, '09123456789', 'Male'),
(2, 'police_pic/099846-Santos.jpg', 'Sabrina', 'Andrea', 'Santos', 'General', '099846', 'Nueva Ecija', '2022-07-06', 'Employed', 2, '09123456787', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `prisoner`
--

CREATE TABLE `prisoner` (
  `prisoner_id` int(11) NOT NULL,
  `code` varchar(256) NOT NULL,
  `cell_id` int(11) NOT NULL,
  `prisoner_pic` varchar(256) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `middle_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `alias` varchar(256) NOT NULL,
  `birthdate` varchar(256) NOT NULL,
  `marital_status` varchar(256) NOT NULL,
  `sex` varchar(256) NOT NULL,
  `complexion` varchar(256) NOT NULL,
  `eye_color` varchar(256) NOT NULL,
  `crime` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `emergency_name` varchar(256) NOT NULL,
  `emergency_contact` varchar(256) NOT NULL,
  `emergency_relation` varchar(256) NOT NULL,
  `date_jailed` date NOT NULL DEFAULT current_timestamp(),
  `discharge_date` varchar(256) NOT NULL,
  `sentence` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prisoner`
--

INSERT INTO `prisoner` (`prisoner_id`, `code`, `cell_id`, `prisoner_pic`, `first_name`, `middle_name`, `last_name`, `alias`, `birthdate`, `marital_status`, `sex`, `complexion`, `eye_color`, `crime`, `address`, `emergency_name`, `emergency_contact`, `emergency_relation`, `date_jailed`, `discharge_date`, `sentence`, `status`) VALUES
(1, '123456', 1, 'prisoner_pic/Arn-Theodstan.jpg', 'Theo', 'Arn', 'Theodstan', 'Batumbakal', '2000-12-20', 'Single', 'Male', 'Brown', 'Brown', 'Treason', 'B12 L106 Ph 1A Suburban', 'Theodwyn', '09992312321', 'Sister', '2022-07-05', '2024-02-23', '2 years', 'Jailed');

-- --------------------------------------------------------

--
-- Table structure for table `prison_list`
--

CREATE TABLE `prison_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `status_prison` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prison_list`
--

INSERT INTO `prison_list` (`id`, `name`, `status_prison`, `date_created`, `date_updated`) VALUES
(1, 'Men\'s Prison', 1, '2022-07-05 12:16:10', '2022-07-05 12:16:10'),
(2, 'Women\'s Prison', 1, '2022-07-05 12:18:02', '2022-07-05 12:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `record_list`
--

CREATE TABLE `record_list` (
  `record_id` int(30) NOT NULL,
  `inmate_id` int(30) NOT NULL,
  `action_id` int(30) NOT NULL,
  `remarks` text NOT NULL,
  `date` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `record_list`
--

INSERT INTO `record_list` (`record_id`, `inmate_id`, `action_id`, `remarks`, `date`, `date_created`, `date_updated`) VALUES
(1, 1, 2, 'The floor is lego\r\n', '2022-07-05', '2022-07-05 12:31:46', '2022-07-05 12:31:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_list`
--
ALTER TABLE `action_list`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `block_list`
--
ALTER TABLE `block_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fam_directory`
--
ALTER TABLE `fam_directory`
  ADD PRIMARY KEY (`dir_id`);

--
-- Indexes for table `fam_record`
--
ALTER TABLE `fam_record`
  ADD PRIMARY KEY (`fam_id`);

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
  ADD PRIMARY KEY (`prisoner_id`),
  ADD KEY `cell_id` (`cell_id`);

--
-- Indexes for table `prison_list`
--
ALTER TABLE `prison_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `record_list`
--
ALTER TABLE `record_list`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `inmate_id` (`inmate_id`),
  ADD KEY `action_id` (`action_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_list`
--
ALTER TABLE `action_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `block_list`
--
ALTER TABLE `block_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `fam_directory`
--
ALTER TABLE `fam_directory`
  MODIFY `dir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fam_record`
--
ALTER TABLE `fam_record`
  MODIFY `fam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `officer`
--
ALTER TABLE `officer`
  MODIFY `officer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `police`
--
ALTER TABLE `police`
  MODIFY `police_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prisoner`
--
ALTER TABLE `prisoner`
  MODIFY `prisoner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prison_list`
--
ALTER TABLE `prison_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `record_list`
--
ALTER TABLE `record_list`
  MODIFY `record_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
