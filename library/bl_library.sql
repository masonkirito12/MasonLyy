-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2019 年 11 月 10 日 22:51
-- 服务器版本: 5.6.33-log
-- PHP 版本: 5.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `bl_library`
--
CREATE DATABASE IF NOT EXISTS `bl_library` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bl_library`;

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `created_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8 DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `type`, `name`, `email`, `created_by`, `updated_by`, `status`) VALUES
(1, 'superadmin', 'superadmin', 'superadmin', 'superadmin', 'superadmin@superadmin.com', 'superadmin', 'superadmin', 'active'),
(2, 'admin test 1', 'admin', 'admin', 'admin1', 'admin1@admin.com', 'superadmin', NULL, 'active'),
(3, 'admin test 2', 'admin', 'admin', 'admin2', 'admin2@admin.com', 'superadmin', NULL, 'active'),
(4, 'admin test 3', 'admin', 'admin', 'admin3', 'admin3@admin.com', 'superadmin', NULL, 'active');

-- --------------------------------------------------------

--
-- 表的结构 `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `book`
--

INSERT INTO `book` (`id`, `name`, `author`, `price`, `image`, `language`, `status`) VALUES
(1, 'Programming: PHP', 'Rasmus Lerdorf', '139.9', 'img/programphp.jpg', 'programming', 'active'),
(2, 'Programming: MySQL', 'O Reilly Media', '139.9', 'img/programmysql.jpg', 'programming', 'active'),
(3, 'Programming: JavaScript', 'David Flanagan', '129.9', 'img/programjavascript.jpg', 'programming', 'active'),
(4, 'Multimedia: Foundations', 'Vic Costello', '259.9', 'img/multifound.jpg', 'multimedia', 'active'),
(5, 'Multimedia: Applications', 'Ralf Steinmetz', '199.9', 'img/multiappli.jpg', 'multimedia', 'active');

-- --------------------------------------------------------

--
-- 表的结构 `book_detail`
--

CREATE TABLE IF NOT EXISTS `book_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `barcode` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `created_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `created_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `book_detail`
--

INSERT INTO `book_detail` (`id`, `book_id`, `barcode`, `created_date`, `created_by`, `status`) VALUES
(1, '1', '100000001', '2019-11-10', 'admin1', 'return'),
(2, '1', '100000002', '2019-11-10', 'admin1', 'return'),
(3, '1', '100000003', '2019-11-10', 'admin1', 'return'),
(4, '2', '100000004', '2019-11-10', 'admin1', 'return'),
(5, '2', '100000005', '2019-11-10', 'admin1', 'return'),
(6, '2', '100000006', '2019-11-10', 'admin1', 'return'),
(7, '3', '100000007', '2019-11-10', 'admin1', 'return'),
(8, '3', '100000008', '2019-11-10', 'admin1', 'return'),
(9, '3', '100000009', '2019-11-10', 'admin1', 'success'),
(10, '4', '100000010', '2019-11-10', 'admin1', 'success'),
(11, '4', '100000011', '2019-11-10', 'admin1', 'success'),
(12, '4', '100000012', '2019-11-10', 'admin1', 'delete'),
(13, '5', '100000013', '2019-11-10', 'admin1', 'success'),
(14, '5', '100000014', '2019-11-10', 'admin1', 'return'),
(15, '5', '100000015', '2019-11-10', 'admin1', 'success');

-- --------------------------------------------------------

--
-- 表的结构 `book_issue`
--

CREATE TABLE IF NOT EXISTS `book_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` varchar(50) DEFAULT NULL,
  `book_issue` varchar(50) DEFAULT NULL,
  `book_date` varchar(50) DEFAULT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `borrow`
--

CREATE TABLE IF NOT EXISTS `borrow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `daypass` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `borrow`
--

INSERT INTO `borrow` (`id`, `member_id`, `book_id`, `collect_date`, `borrow_date`, `return_date`, `created_borrow`, `created_return`, `status`, `return_days`, `return_status`, `pay_price`, `daypass`) VALUES
(1, '1', '3', '2019-11-10', '2019-11-10', '2019-11-24', 'admin1', NULL, 'return', NULL, NULL, NULL, 0),
(2, '1', '6', '2019-11-10', '2019-11-10', '2019-11-10', 'admin1', 'admin1', 'success', '0', 'none', '0', 0),
(3, '1', '9', '2019-11-10', '2019-11-10', '2019-11-10', 'admin1', 'admin1', 'success', '0', 'none', '0', 0),
(4, '2', '2', '2019-11-10', '2019-11-10', '2019-11-24', 'admin1', NULL, 'return', NULL, NULL, NULL, 0),
(5, '2', '5', '2019-11-10', '2019-11-10', '2019-11-24', 'admin1', NULL, 'return', NULL, NULL, NULL, 0),
(6, '2', '8', '2019-11-10', '2019-11-10', '2019-11-24', 'admin1', NULL, 'return', NULL, NULL, NULL, 0),
(7, '1', '1', '2019-11-10', '2019-11-10', '2019-11-10', 'admin1', 'admin1', 'success', '0', 'none', '0', 0),
(8, '1', '4', '2019-11-10', '2019-11-10', '2019-11-10', 'admin1', 'admin1', 'success', '', 'none', '0', 0),
(9, '1', '7', '2019-11-10', '2019-11-10', '2019-11-24', 'admin1', NULL, 'return', NULL, NULL, NULL, 0),
(10, '3', '1', '2019-11-10', '2019-11-10', '2019-11-24', 'admin1', NULL, 'return', NULL, NULL, NULL, 0),
(11, '3', '6', '2019-11-10', '2019-11-10', '2019-11-24', 'admin1', NULL, 'return', NULL, NULL, NULL, 0),
(12, '3', '9', '2019-10-21', '2019-10-21', '2019-11-10', 'admin1', 'admin1', 'success', '20', 'late', '65', 0),
(13, '4', '12', '2019-11-10', '2019-11-10', '2019-11-10', 'admin1', 'admin1', 'success', '0', 'missing', '259.9', 0),
(14, '4', '15', '2019-10-21', '2019-10-21', '2019-11-10', 'admin1', 'admin1', 'success', '20', 'late', '65', 0),
(15, '5', '14', '2019-10-21', '2019-10-21', '2019-10-28', 'admin1', NULL, 'return', NULL, NULL, NULL, 0),
(16, '4', '4', '2019-11-10', '2019-11-10', '2019-11-24', 'admin1', NULL, 'return', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `book_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `created_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- 表的结构 `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(11) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `ic` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `created_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8 DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `member`
--

INSERT INTO `member` (`id`, `username`, `password`, `name`, `email`, `phone`, `address`, `ic`, `created_by`, `updated_by`, `status`) VALUES
(1, 'User test 1', 'user', 'user1', 'user1@user.com', '0127545179', 'No 8, Lorong Jaya 2, Taman Jaya.14100. Bukit Mertajam. Pulau Pinang.', '970214072491', 'admin1', NULL, 'active'),
(2, 'User test 2', 'user', 'user2', 'user2@user.com', '0144218912', 'No 2, Lorong Sentosa 11, Taman Sentosa Jaya, 14000. Bukit Mertajam. Pulau Pinang.', '980223071385', 'admin1', NULL, 'active'),
(3, 'User test 3', 'user', 'user3', 'user3@user.com', '0123456789', 'No 1, Lorong Jaya 2, Taman Jaya.14100. Bukit Mertajam. Pulau Pinang.', '990310075143', 'admin1', NULL, 'active'),
(4, 'User test 4', 'user', 'user4', 'user4@user.com', '0127545179', 'No 3, Lorong Jaya 2, Taman Jaya.14100. Bukit Mertajam. Pulau Pinang.', '991229000000', 'admin1', NULL, 'active'),
(5, 'User test 5', 'user', 'user5', 'user5@user.com', '0127545149', 'No 6, Lorong Jaya 2, Taman Jaya.14100. Bukit Mertajam. Pulau Pinang.', '991229000121', 'admin1', NULL, 'active');

-- --------------------------------------------------------

--
-- 表的结构 `reserve`
--

CREATE TABLE IF NOT EXISTS `reserve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `reserve`
--

INSERT INTO `reserve` (`id`, `book_id`, `member_id`, `date`, `status`) VALUES
(1, 1, 4, '2019-11-10', 'delete'),
(2, 2, 4, '2019-11-10', 'success'),
(3, 1, 4, '2019-11-10', 'delete'),
(4, 1, 4, '2019-11-10', 'delete');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
