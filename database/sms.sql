-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2021 at 01:27 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `admin_id` int(15) NOT NULL,
  `admin_name` varchar(60) NOT NULL,
  `admin_email` varchar(60) NOT NULL,
  `admin_password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Adnan', 'adnan@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `product_id` tinyint(4) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_dop` date NOT NULL,
  `product_ava` int(12) NOT NULL,
  `product_total` int(12) NOT NULL,
  `product_op` int(12) NOT NULL,
  `product_sp` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`product_id`, `product_name`, `product_dop`, `product_ava`, `product_total`, `product_op`, `product_sp`) VALUES
(4, 'Haier AC', '2021-05-29', 17, 20, 70000, 80000),
(5, 'Hand Free', '2021-06-04', 15, 30, 300, 450);

-- --------------------------------------------------------

--
-- Table structure for table `assign_work`
--

CREATE TABLE `assign_work` (
  `a_id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `req_name` varchar(50) NOT NULL,
  `req_email` varchar(20) NOT NULL,
  `req_mobile` smallint(25) NOT NULL,
  `req_address1` varchar(100) NOT NULL,
  `req_address2` varchar(100) NOT NULL,
  `req_city` varchar(20) NOT NULL,
  `req_state` varchar(20) NOT NULL,
  `req_zip` tinyint(6) NOT NULL,
  `req_info` text NOT NULL,
  `tech_name` varchar(60) NOT NULL,
  `req_date` date NOT NULL,
  `req_des` text NOT NULL,
  `updatedon` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_work`
--

INSERT INTO `assign_work` (`a_id`, `req_id`, `req_name`, `req_email`, `req_mobile`, `req_address1`, `req_address2`, `req_city`, `req_state`, `req_zip`, `req_info`, `tech_name`, `req_date`, `req_des`, `updatedon`) VALUES
(12, 11, 'Adnan Zahid', 'adnan@gmail.com', 32767, 'Ghori Plaza', 'Ghori toen phase 4', 'Islamabad', 'Punjab', 127, 'Electricity Meter is Not working', 'ali Rehman', '2021-04-30', 'Electricity meter is not working. This cause tripping in light. Can cause sever problem. it\'s Urgent', '2021-04-29 08:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `customer_sell`
--

CREATE TABLE `customer_sell` (
  `cus_id` smallint(6) NOT NULL,
  `cus_name` varchar(50) NOT NULL,
  `cus_add` varchar(50) NOT NULL,
  `cus_number` int(20) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_qty` int(20) NOT NULL,
  `product_sp` int(20) NOT NULL,
  `total_price` int(20) NOT NULL,
  `product_dos` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_sell`
--

INSERT INTO `customer_sell` (`cus_id`, `cus_name`, `cus_add`, `cus_number`, `product_name`, `product_qty`, `product_sp`, `total_price`, `product_dos`) VALUES
(1, 'Muhammad Ali', 'P/O Mahni Sial teh Kabirwala dist Khanewal', 2147483647, 'Haier AC', 2, 54000, 80000, '2021-06-12'),
(2, 'Muhammad Adnan', 'P/O Mahni Sial teh Kabirwala dist Khanewal', 2147483647, 'Haier AC', 3, 54000, 80000, '2021-06-26'),
(3, 'KAlim', 'ahdkadhk', 2147483647, 'Hand Free', 2, 350, 450, '2021-06-12'),
(4, 'ahmad', 'ahdkadhk', 2147483647, 'Hand Free', 3, 350, 450, '2021-06-15');

-- --------------------------------------------------------

--
-- Table structure for table `requster_login`
--

CREATE TABLE `requster_login` (
  `r_id` int(50) NOT NULL,
  `r_name` varchar(60) NOT NULL,
  `r_email` varchar(60) NOT NULL,
  `r_mobile` int(25) NOT NULL,
  `r_password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requster_login`
--

INSERT INTO `requster_login` (`r_id`, `r_name`, `r_email`, `r_mobile`, `r_password`) VALUES
(3, 'Adnan Zahid', 'rao@gmail.com', 348123456, '123456'),
(8, 'Ahmad', 'admad@gmail.com', 0, '123456'),
(14, 'Ahmad', 'ali@gmail.com', 0, '123456789'),
(16, 'KAlim', 'kalim@gmail.com', 2147483647, '123456'),
(17, 'Anwar Ali', 'anwar@gmail.com', 2147483647, '123456');

-- --------------------------------------------------------

--
-- Table structure for table `submit_request`
--

CREATE TABLE `submit_request` (
  `s_id` int(11) NOT NULL,
  `req_name` varchar(50) NOT NULL,
  `req_email` varchar(20) NOT NULL,
  `req_mobile` smallint(25) NOT NULL,
  `req_address1` varchar(100) NOT NULL,
  `req_address2` varchar(100) NOT NULL,
  `req_city` varchar(20) NOT NULL,
  `req_state` varchar(20) NOT NULL,
  `req_zip` tinyint(6) NOT NULL,
  `req_info` text NOT NULL,
  `req_date` date NOT NULL,
  `req_des` text NOT NULL,
  `updatedon` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submit_request`
--

INSERT INTO `submit_request` (`s_id`, `req_name`, `req_email`, `req_mobile`, `req_address1`, `req_address2`, `req_city`, `req_state`, `req_zip`, `req_info`, `req_date`, `req_des`, `updatedon`) VALUES
(1, 'ahmad', 'raoadnan@gmail.com', 32767, 'ahdkadhk', 'lsdkljsjdlj', 'ldosdjll', 'adjldj', 127, 'sdss', '2021-04-22', 'adsdad', '2021-04-24 17:51:09'),
(2, 'KAlim', 'kalim@gmail.com', 32767, 'ahdkadhk', 'lsdkljsjdlj', 'ldosdjll', 'adjldj', 127, 'sdhkh', '2021-04-14', 'kdkhah', '2021-04-24 18:16:58'),
(3, 'HAMZA', 'hamza@gmail.com', 32767, 'house 1 street 1', 'Z-block', 'Islamabad', 'Punjab', 127, 'DEMO', '2021-04-27', 'DEMO', '2021-04-26 08:05:17'),
(4, 'HAMZA', 'hamza@gmail.com', 32767, 'house 1 street 1', 'Z-block', 'Islamabad', 'Punjab', 127, 'DEMO', '2021-04-27', 'DEMO', '2021-04-26 08:06:22'),
(5, 'HAMZA', 'hamza@gmail.com', 32767, 'house 1 street 1', 'Z-block', 'Islamabad', 'Punjab', 127, 'DEMO', '2021-04-27', 'DEMO', '2021-04-26 08:10:18'),
(11, 'Adnan Zahid', 'adnan@gmail.com', 32767, 'Ghori Plaza', 'Ghori toen phase 4', 'Islamabad', 'Punjab', 127, 'Electricity Meter is Not working', '2021-04-29', 'Electricity meter is not working. This cause tripping in light. Can cause sever problem. it\'s Urgent', '2021-04-29 08:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `technician_emp`
--

CREATE TABLE `technician_emp` (
  `emp_id` int(20) NOT NULL,
  `emp_name` varchar(60) NOT NULL,
  `emp_mobile` int(20) NOT NULL,
  `emp_email` varchar(60) NOT NULL,
  `emp_address` varchar(80) NOT NULL,
  `emp_city` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `technician_emp`
--

INSERT INTO `technician_emp` (`emp_id`, `emp_name`, `emp_mobile`, `emp_email`, `emp_address`, `emp_city`) VALUES
(1, 'Ansar ali', 2147483647, 'ansar@gmail.com', 'green city', 'multan'),
(2, 'Mubashir Ali', 314865492, 'mubashir@gmail.com', 'multan', 'multan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `assign_work`
--
ALTER TABLE `assign_work`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `customer_sell`
--
ALTER TABLE `customer_sell`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `requster_login`
--
ALTER TABLE `requster_login`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `submit_request`
--
ALTER TABLE `submit_request`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `technician_emp`
--
ALTER TABLE `technician_emp`
  ADD PRIMARY KEY (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `admin_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `product_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `assign_work`
--
ALTER TABLE `assign_work`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer_sell`
--
ALTER TABLE `customer_sell`
  MODIFY `cus_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `requster_login`
--
ALTER TABLE `requster_login`
  MODIFY `r_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `submit_request`
--
ALTER TABLE `submit_request`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `technician_emp`
--
ALTER TABLE `technician_emp`
  MODIFY `emp_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
