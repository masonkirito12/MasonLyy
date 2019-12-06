-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2019 at 01:48 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bl_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `created_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8 DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `type`, `name`, `email`, `created_by`, `updated_by`, `status`) VALUES
(1, 'superadmin', 'superadmin', 'superadmin', 'superadmin', 'superadmin@superadmin.com', 'superadmin', 'superadmin', 'active'),
(2, 'admin test 1', 'admin', 'admin', 'guan yang', 'admin1@admin.com', 'superadmin', NULL, 'active'),
(3, 'admin test 2', 'admin', 'admin', 'beng leong', 'admin2@admin.com', 'superadmin', NULL, 'active'),
(4, 'admin test 3', 'admin', 'admin', 'yi yang', 'admin3@admin.com', 'superadmin', NULL, 'active'),
(5, 'aa', '123', 'admin', 'mason', 'boboiboy202@gmail.com', 'superadmin', NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `author`, `price`, `image`, `language`, `status`) VALUES
(1, 'Programming: PHPs', 'Rasmus ', '100', 'img/programphp.jpg', 'programming', 'active'),
(2, 'Programming: MySQL', 'O Reilly Media', '168', 'img/programmysql.jpg', 'programming', 'active'),
(3, 'Programming: JavaScript', 'David Flanagan', '180', 'img/programjavascript.jpg', 'programming', 'active'),
(4, 'Multimedia: Foundations', 'Vic Costello', '108', 'img/multifound.jpg', 'multimedia', 'active'),
(5, 'Multimedia: Applications', 'Ralf Steinmetz', '100', 'img/multiappli.jpg', 'multimedia', 'active'),
(6, 'Java:Javascript', 'James Gosling', '100', 'img/download.jfif', 'multimedia', 'active'),
(7, 'Python', ' Guido van Rossum ', '298', 'img/download (1).jfif', 'business', 'active'),
(8, 'HTML 5', 'Tim Berners-Lee', '88', 'img/download (2).jfif', 'programming', 'active'),
(9, 'Css', 'Håkon Wium Lie,', '68', 'img/download (3).jfif', 'programming', 'active'),
(10, 'Programming: MySQL', '1', '100', 'img/101931_798.jpeg', 'programming', 'delete');

-- --------------------------------------------------------

--
-- Table structure for table `book_detail`
--

CREATE TABLE `book_detail` (
  `id` int(11) NOT NULL,
  `book_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `barcode` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `created_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `created_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_detail`
--

INSERT INTO `book_detail` (`id`, `book_id`, `barcode`, `created_date`, `created_by`, `status`) VALUES
(1, '1', '100000001', '2019-11-24', 'guan yang', 'success'),
(2, '1', '100000002', '2019-11-24', 'guan yang', 'success'),
(3, '1', '100000003', '2019-11-24', 'guan yang', 'pending'),
(4, '2', '100000004', '2019-11-24', 'guan yang', 'return'),
(5, '2', '100000005', '2019-11-24', 'guan yang', 'return'),
(6, '2', '100000006', '2019-11-24', 'guan yang', 'return'),
(7, '3', '100000007', '2019-11-24', 'guan yang', 'success'),
(8, '3', '100000008', '2019-11-24', 'guan yang', 'success'),
(9, '3', '100000009', '2019-11-24', 'guan yang', 'return'),
(10, '4', '100000010', '2019-11-19', 'guan yang', 'success'),
(11, '4', '100000011', '2019-11-19', 'guan yang', 'success'),
(12, '4', '100000012', '2019-11-24', 'guan yang', 'pending'),
(13, '5', '100000013', '2019-11-19', 'guan yang', 'success'),
(14, '5', '100000014', '2019-11-19', 'guan yang', 'success'),
(15, '5', '100000015', '2019-11-24', 'guan yang', 'pending'),
(16, '6', '100000016', '2019-11-24', 'guan yang', 'success'),
(17, '6', '100000017', '2019-11-24', 'guan yang', 'success'),
(18, '6', '100000018', '2019-11-24', 'guan yang', 'pending'),
(19, '7', '100000019', '2019-11-24', 'guan yang', 'success'),
(20, '7', '100000020', '2019-11-24', 'guan yang', 'success'),
(21, '7', '100000021', '2019-11-24', 'guan yang', 'pending'),
(22, '8', '100000022', '2019-11-24', 'guan yang', 'delete'),
(23, '8', '100000023', '2019-11-24', 'guan yang', 'delete'),
(24, '8', '100000024', '2019-11-24', 'guan yang', 'delete'),
(25, '9', '100000025', '2019-11-24', 'guan yang', 'return'),
(26, '9', '100000026', '2019-11-24', 'guan yang', 'return'),
(27, '9', '100000027', '2019-11-24', 'guan yang', 'return');

-- --------------------------------------------------------

--
-- Table structure for table `book_issue`
--

CREATE TABLE `book_issue` (
  `id` int(11) NOT NULL,
  `book_id` varchar(50) DEFAULT NULL,
  `book_issue` varchar(50) DEFAULT NULL,
  `book_date` varchar(50) DEFAULT NULL,
  `quantity` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `id` int(11) NOT NULL,
  `member_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `book_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `collect_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `borrow_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `return_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `created_borrow` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `created_return` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `return_days` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `return_status` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `pay_price` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `daypass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`id`, `member_id`, `book_id`, `collect_date`, `borrow_date`, `return_date`, `created_borrow`, `created_return`, `status`, `return_days`, `return_status`, `pay_price`, `daypass`) VALUES
(1, '1', '3', '2019-10-21', '2019-10-21', '2019-11-24', 'guan yang', 'guan yang', 'success', '3', 'late', '135', 0),
(2, '1', '6', '2019-10-21', '2019-10-21', '2019-10-28', 'guan yang', NULL, 'return', NULL, NULL, NULL, 0),
(3, '1', '9', '2019-11-24', '2019-11-24', '2019-12-08', 'guan yang', NULL, 'return', NULL, NULL, NULL, 0),
(4, '1', '21', '2019-11-24', '2019-11-24', '2019-11-24', 'guan yang', 'guan yang', 'success', '0', 'none', '0', 0),
(5, '1', '24', '2019-11-24', '2019-11-24', '2019-11-24', 'guan yang', 'guan yang', 'success', '0', 'missing', '88', 0),
(6, '1', '27', '2019-11-24', '2019-11-24', '2019-12-08', 'guan yang', NULL, 'return', NULL, NULL, NULL, 0),
(7, '2', '2', '2019-10-21', '2019-10-21', '2019-11-24', 'guan yang', 'guan yang', 'success', '3', 'late', '135', 0),
(8, '2', '5', '2019-10-21', '2019-10-21', '2019-10-28', 'guan yang', NULL, 'return', NULL, NULL, NULL, 0),
(9, '2', '8', '2019-11-24', '2019-11-24', '2019-11-24', 'guan yang', 'guan yang', 'success', '', 'none', '0', 0),
(10, '2', '20', '2019-11-24', '2019-11-24', '2019-11-24', 'guan yang', 'guan yang', 'success', '0', 'none', '0', 0),
(11, '2', '23', '2019-11-24', '2019-11-24', '2019-11-24', 'guan yang', 'guan yang', 'success', '0', 'missing', '88', 0),
(12, '2', '26', '2019-11-24', '2019-11-24', '2019-12-08', 'guan yang', NULL, 'return', NULL, NULL, NULL, 0),
(13, '3', '1', '2019-10-21', '2019-10-21', '2019-11-24', 'guan yang', 'guan yang', 'success', '3', 'late', '135', 0),
(14, '3', '4', '2019-10-21', '2019-10-21', '2019-10-28', 'guan yang', NULL, 'return', NULL, NULL, NULL, 0),
(15, '3', '7', '2019-11-24', '2019-11-24', '2019-11-24', 'guan yang', 'guan yang', 'success', '', 'none', '0', 0),
(16, '3', '19', '2019-11-24', '2019-11-24', '2019-11-24', 'guan yang', 'guan yang', 'success', '0', 'none', '0', 0),
(17, '3', '22', '2019-11-24', '2019-11-24', '2019-11-24', 'guan yang', 'guan yang', 'success', '0', 'missing', '88', 0),
(18, '3', '25', '2019-11-24', '2019-11-24', '2019-12-08', 'guan yang', NULL, 'return', NULL, NULL, NULL, 0),
(19, '4', '3', '2019-11-24', NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, 0),
(20, '4', '12', '2019-11-24', NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, 0),
(21, '4', '15', '2019-11-24', NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, 0),
(22, '4', '18', '2019-11-24', NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, 0),
(23, '4', '21', '2019-11-24', NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, 0),
(24, '4', '8', '2019-11-24', NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, 0),
(25, '4', '7', '2019-11-24', NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `member_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `book_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `created_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(11) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `ic` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `created_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8 DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `username`, `password`, `name`, `email`, `phone`, `address`, `ic`, `created_by`, `updated_by`, `status`) VALUES
(1, 'User test 1', 'user', 'yong jeng', 'yongjeng@gmail.com', '0127545179', 'No 8, Lorong Jaya 2, Taman Jaya.14100. Bukit Mertajam. Pulau Pinang.', '991229075749', 'admin1', NULL, 'active'),
(2, 'User test 2', 'user', 'kian nyap', 'kiannyap@gmail.com', '0144218912', 'No 2, Lorong Sentosa 11, Taman Sentosa Jaya, 14000. Bukit Mertajam. Pulau Pinang.', '990712135567', 'admin1', NULL, 'active'),
(3, 'User test 3', 'user', 'peng xin', 'pengxin@gmail.com', '0123456789', 'No 1, Lorong Jaya 2, Taman Jaya.14100. Bukit Mertajam. Pulau Pinang.', '990915075517', 'admin1', NULL, 'active'),
(4, 'User test 4', 'user', 'kenneth', 'kenneth@gmail.com', '0166852343', 'No 3, Lorong Jaya 2, Taman Jaya.14100. Bukit Mertajam. Pulau Pinang.', '990306075167', 'admin1', NULL, 'active'),
(5, 'User test 5', 'user', 'cheng yu', 'chengyu@gmail.com', '0125432345', 'No 6, Lorong Jaya 2, Taman Jaya.14100. Bukit Mertajam. Pulau Pinang.', '971211025999', 'admin1', NULL, 'active'),
(6, 'hihi', '123', 'hi', 'hi@gmail.com', '123', '123', '123123', 'admin1', 'admin1', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE `reserve` (
  `id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reserve`
--

INSERT INTO `reserve` (`id`, `book_id`, `member_id`, `date`, `status`) VALUES
(1, 2, 4, '2019-11-24', 'delete'),
(2, 3, 4, '2019-11-24', 'delete'),
(3, 2, 5, '2019-11-24', 'success'),
(4, 8, 5, '2019-11-24', 'success'),
(5, 9, 5, '2019-11-24', 'success');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_detail`
--
ALTER TABLE `book_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_issue`
--
ALTER TABLE `book_issue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `book_detail`
--
ALTER TABLE `book_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `book_issue`
--
ALTER TABLE `book_issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `reserve`
--
ALTER TABLE `reserve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
