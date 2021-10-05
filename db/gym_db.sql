-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2021 at 08:19 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `available`
--

CREATE TABLE `available` (
  `id` int(11) NOT NULL,
  `days` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `package_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `available`
--

INSERT INTO `available` (`id`, `days`, `start_time`, `end_time`, `package_id`) VALUES
(82, 'monday', '12:00 PM', '2:00 PM', 23),
(83, 'tuesday', '12:00 PM', '2:00 PM', 23),
(88, 'monday', '12:00 PM', '12:55 PM', 22),
(89, 'tuesday', '1:00 PM', '2:30 PM', 22),
(96, 'monday', '12:00 PM', '12:00 PM', 21),
(138, 'monday', '12:00 AM', '1:00 AM', 32);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `emp_fname` varchar(255) NOT NULL,
  `emp_lname` varchar(255) NOT NULL,
  `emp_email` varchar(255) NOT NULL,
  `emp_mobile` varchar(255) NOT NULL,
  `emp_role` varchar(255) NOT NULL,
  `emp_password` varchar(255) NOT NULL,
  `emp_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_fname`, `emp_lname`, `emp_email`, `emp_mobile`, `emp_role`, `emp_password`, `emp_image`) VALUES
(2, 'hello0', 'world', 'hello@gmail.com', '0756242803', 'admin', '123456789', '55417551_6116454915866_2956305141789097984_n.png'),
(5, 'something', 'world', 'hhr@gmail.com', '0756242803', 'trainer', '12345678', '52684873_6113151779371_762149325429014528_n.png'),
(6, 'hello', 'world', 'ww@gmail.com', '0756242803', 'admin', '12345678', '52684873_6113151779371_762149325429014528_n.png'),
(7, 'hello', 'world', 'gfh@gmail.com', '0756242803', 'admin', '12345678', ''),
(8, 'hello', 'world', 'wrts@gmail.com', '0756242803', 'admin', '12345678', ''),
(9, 'dsdd', 'world', 'eews@gmail.com', '0756242803', 'trainer', '12345678', ''),
(10, 'admin', 'admin', 'admin@gmail.com', '0000000000', 'admin', '12345678', '55961031_6117399896666_5367606202463158272_n.png'),
(11, 'trainer', 'trainer', 'trainer@gmail.com', '1111111111', 'trainer', '12345678', '55417551_6116454915866_2956305141789097984_n.png');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `trainer` varchar(255) NOT NULL,
  `plan` varchar(255) NOT NULL,
  `plan_image` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `trainer`, `plan`, `plan_image`, `duration`, `amount`, `status`, `description`) VALUES
(32, '5', '14', '55417551_6116454915866_2956305141789097984_n.png', '3 month', '3000', 'available', '');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `plan_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`plan_id`, `plan_name`, `plan_image`) VALUES
(14, 'Full Body', '55417551_6116454915866_2956305141789097984_n.png'),
(18, 'Chest', '56005489_6117317145866_1155156678602129408_n.png');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `card_holder_name` varchar(255) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `cvv` int(5) NOT NULL,
  `expire_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `package_id`, `trainer_id`, `plan_name`, `duration`, `amount`, `user_id`, `card_holder_name`, `card_number`, `cvv`, `expire_date`) VALUES
(5, 27, 5, 'Full Body', '3month', '3000', 41, 'hello', '1222222222222222', 122, '21222'),
(7, 27, 5, 'Full Body', '3month', '3000', 41, 'hello', '1222222222221212', 211, '12121');

-- --------------------------------------------------------

--
-- Table structure for table `reservedtime`
--

CREATE TABLE `reservedtime` (
  `id` int(11) NOT NULL,
  `days` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `reservation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservedtime`
--

INSERT INTO `reservedtime` (`id`, `days`, `start_time`, `end_time`, `reservation_id`) VALUES
(9, 'monday', '12:00 AM', '2:00 AM', 5),
(10, 'tuesday', '12:00 AM', '2:00 AM', 5),
(13, 'monday', '12:00 AM', '2:00 AM', 7),
(14, 'tuesday', '12:00 AM', '2:00 AM', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `regno` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `regno`, `fname`, `lname`, `email`, `mobile`, `password`, `image`) VALUES
(41, 'GMS#25191214', 'user', 'user', 'user@gmail.com', '0756242805', '12345678', '52684873_6113151779371_762149325429014528_n.png'),
(43, 'GMS#26212274', 'hello', 'world', 'sse@gmail.com', '0756242803', '12345678', '52684873_6113151779371_762149325429014528_n.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `available`
--
ALTER TABLE `available`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservedtime`
--
ALTER TABLE `reservedtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `available`
--
ALTER TABLE `available`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reservedtime`
--
ALTER TABLE `reservedtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
