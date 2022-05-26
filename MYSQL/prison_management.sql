
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;



CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(256) NOT NULL,
  `admin_pass` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_pass`) VALUES
(1, 'admin', '$2y$10$FwsrJtfO/dWu.HIdGr1ywOEyMjhfINSWy2bjreCBQCQxjQtJfOHZe');



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



INSERT INTO `appointment` (`appointment_id`, `vname`, `vemail`, `vcontact`, `vadd`, `pfirst`, `plast`, `pdate`, `appointment_added`, `stats`) VALUES
(1, 'Eric Simon Larios', 'zagreuscreen@gmail.com', '09995668770', 'Somewhere', 'Kyle Isaas', 'Mendoza', '2021-12-25', '0000-00-00', 'Pending'),
(2, 'Eric Simon Larios', 'zagreuscreen@gmail.com', '09995668770', 'Somewhere', 'Kyle Isaac', 'Mendoza', '2022-12-25', '2022-05-06', 'Pending'),
(3, 'Eric Simon Larios', 'asdasdas@gmail.com', '0995668770', 'Somewhere', 'Kyle Isaac', 'Mendoza', '2022-12-25', '2022-05-12', 'Approved'),
(4, 'Eric Simon Larios', 'asdsaf@gmail.com', '09995668770', 'Somewhere', 'Kyle Isaac', 'Mendoza', '2023-12-25', '2022-05-12', 'Approved'),
(5, 'Eric Simon Larios', 'dfglkjdfgljkdf@gmail.com', '09995668770', 'Somewhere', 'Kyle Isaac', 'Mendoza', '2025-12-25', '2022-05-12', 'Approved'),
(6, 'Eric Larios', 'asljkfjkgsahk@gmail.com', '09995668770', 'Somewhere', 'Kyle Isaac', 'Mendoza', '2022-02-05', '2022-05-12', 'Declined'),
(7, 'Simon Larios', 'aslkjglk@gmail.com', '09995668770', 'Somewhere', 'Kyle Isaac', 'Mendoza', '2022-05-12', '2022-05-12', 'Pending');



CREATE TABLE `officer` (
  `officer_id` int(11) NOT NULL,
  `officer_name` varchar(256) NOT NULL,
  `officer_pass` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `officer` (`officer_id`, `officer_name`, `officer_pass`) VALUES
(2, 'Jeff', '$2y$10$MfRuQCjVnQlpUq8C/DJAsOTczRiNCZr5d/pMXEEUeRcLC4bmCAZCG');


ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);


ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`);


ALTER TABLE `officer`
  ADD PRIMARY KEY (`officer_id`);


ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


ALTER TABLE `officer`
  MODIFY `officer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;
