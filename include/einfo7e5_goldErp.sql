-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2023 at 10:22 PM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `einfo7e5_goldErp`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_investor_list`
--

CREATE TABLE `assign_investor_list` (
  `assign_investor_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `investor_id` int(11) NOT NULL,
  `total_interest` float NOT NULL,
  `investor_name` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `packet_name` varchar(250) NOT NULL,
  `start_date` varchar(250) NOT NULL,
  `end_date` varchar(250) NOT NULL,
  `status` varchar(255) NOT NULL,
  `interest_rate` float NOT NULL,
  `amount` float NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `store_id` int(11) NOT NULL,
  `creator_type` varchar(250) NOT NULL,
  `name` varchar(255) NOT NULL,
  `insert_date` varchar(255) NOT NULL,
  `store_type` varchar(250) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `totalPrincipalPaid` float NOT NULL,
  `totalInterestPaid` float NOT NULL,
  `totalInterestTillDate` float NOT NULL,
  `totalPrincipalReceived` float NOT NULL,
  `packet_given_date` varchar(255) NOT NULL,
  `packet_reciving_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_investor_list`
--

INSERT INTO `assign_investor_list` (`assign_investor_id`, `order_id`, `client_id`, `investor_id`, `total_interest`, `investor_name`, `remark`, `packet_name`, `start_date`, `end_date`, `status`, `interest_rate`, `amount`, `client_name`, `store_name`, `store_id`, `creator_type`, `name`, `insert_date`, `store_type`, `creator_id`, `totalPrincipalPaid`, `totalInterestPaid`, `totalInterestTillDate`, `totalPrincipalReceived`, `packet_given_date`, `packet_reciving_date`) VALUES
(1, 1, 8, 7, 0, 'AS', '', 'ANUBHAV VERMA', '2023-01-05', '', 'active', 1, 20000, 'ANUBHAV VERMA ', '', 4, '', '', '16-11-2023 19:24:24', 'store', 6, 0, 0, 2100, 20000, '', ''),
(2, 2, 10, 9, 0, 'GSS ', '', 'RISHIKA', '2023-01-10', '', 'active', 1, 6000, 'RISHIKA AGRAWAL ', '', 4, '', '', '16-11-2023 19:40:15', 'store', 6, 0, 0, 620, 6000, '', ''),
(3, 3, 11, 9, 0, 'GSS ', '', 'ADITI', '2023-10-02', '', 'active', 1.25, 1500, 'ADITI VERMA ', '', 4, '', '', '16-11-2023 19:54:18', 'store', 6, 0, 0, 28.75, 1500, '', ''),
(4, 8, 17, 1, 0, 'jaipur Investor', '', 'test packet', '2023-11-21', '24-11-2023', 'active', 1, 10000, 'test', '', 3, '', '', '21-11-2023 22:27:29', 'store', 5, 0, 0, 3.33, 10000, '23-11-2023', '21-11-2023');

-- --------------------------------------------------------

--
-- Table structure for table `item_list`
--

CREATE TABLE `item_list` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `short_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_list`
--

INSERT INTO `item_list` (`item_id`, `item_name`, `short_name`) VALUES
(1, 'Gold', 'gold'),
(2, 'Silver', 'silver'),
(3, 'Gold + Silver', 'gold + silver');

-- --------------------------------------------------------

--
-- Table structure for table `order_item_list`
--

CREATE TABLE `order_item_list` (
  `order_item_list_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `investor_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_name_by_user` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_wt` float NOT NULL,
  `grade` varchar(50) NOT NULL,
  `gross_wt` float NOT NULL,
  `less_wt` float NOT NULL,
  `net_wt` float NOT NULL,
  `tunch` float NOT NULL,
  `fine` float NOT NULL,
  `rate` float NOT NULL,
  `total_value` float NOT NULL,
  `item_details` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `item_pic` varchar(250) NOT NULL,
  `store_id` int(11) NOT NULL,
  `store_type` varchar(50) NOT NULL,
  `creator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item_list`
--

INSERT INTO `order_item_list` (`order_item_list_id`, `order_id`, `client_id`, `investor_id`, `item_name`, `item_name_by_user`, `item_id`, `item_wt`, `grade`, `gross_wt`, `less_wt`, `net_wt`, `tunch`, `fine`, `rate`, `total_value`, `item_details`, `remark`, `item_pic`, `store_id`, `store_type`, `creator_id`) VALUES
(1, 8, 17, 1, 'Gold', 'dads', 1, 0, 'Gold', 12, 1, 11, 0, 0, 0, 0, 'asdfads', 'dasfasdf', '', 3, 'store', 5),
(2, 15, 27, 0, '', '', 1, 0, '', 0, 0, 0, 0, 0, 0, 0, '', '', '', 3, 'store', 5),
(3, 0, 17, 0, '', '', 1, 0, '', 0, 0, 0, 0, 0, 0, 0, '', '', '', 3, 'store', 5),
(4, 18, 27, 0, '', 'fghd', 1, 0, '', 0, 0, 0, 0, 0, 0, 0, '', '', '', 3, 'store', 5),
(5, 19, 17, 0, '', 'gold+silver', 3, 0, '', 0, 0, 0, 0, 0, 0, 0, '', '', '', 3, 'store', 5);

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `order_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_date_time` varchar(50) NOT NULL,
  `loan_date` varchar(50) NOT NULL,
  `remark` text NOT NULL,
  `loan_amount` float NOT NULL DEFAULT '0',
  `loan_interest` float NOT NULL,
  `weight_kg_silver` float NOT NULL,
  `weight_gm_silver` float NOT NULL,
  `weight_mlgm_silver` float NOT NULL,
  `weight_gm_gold` float NOT NULL,
  `weight_mlgm_gold` float NOT NULL,
  `weight_kg_gold` float NOT NULL,
  `total_weight_gram_gold` float NOT NULL,
  `net_weight_gram_gold` float NOT NULL,
  `total_weight_gram_silver` float NOT NULL,
  `net_weight_gram_silver` float NOT NULL,
  `purity` float NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `investor_id` int(11) NOT NULL,
  `terms_condition_pic` varchar(255) NOT NULL,
  `overall_pic` varchar(255) NOT NULL,
  `store_id` int(11) NOT NULL,
  `store_type` varchar(50) NOT NULL,
  `creater_id` int(11) NOT NULL,
  `loan_finish_date` varchar(50) NOT NULL,
  `loan_validity_day` int(11) NOT NULL,
  `loan_period_month` int(11) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `investor_name` varchar(50) NOT NULL,
  `creator_name` varchar(50) NOT NULL,
  `creator_type` varchar(50) NOT NULL,
  `gold_approx_weight` text NOT NULL,
  `silver_approx_weight` text NOT NULL,
  `item_pic` varchar(255) NOT NULL,
  `packet_pic` varchar(255) NOT NULL,
  `is_finish` int(11) NOT NULL,
  `purity_checked_by` varchar(100) NOT NULL,
  `totalPrincipalPayToInvestor` float NOT NULL,
  `totalInterestReceived` float NOT NULL,
  `totalInvestorIntrestPay` float NOT NULL,
  `totalPrincipalReceivedFromInvestor` float NOT NULL,
  `totalPrincipalReceived` float NOT NULL,
  `totalInterestTillDate` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `LastPrincipalRecivedDate` varchar(50) DEFAULT NULL,
  `discount` float NOT NULL,
  `loan_aprovided_by` varchar(255) DEFAULT NULL,
  `jewellery_purchased_from` varchar(255) DEFAULT NULL,
  `owner_of_jewellery` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`order_id`, `client_id`, `user_id`, `create_date_time`, `loan_date`, `remark`, `loan_amount`, `loan_interest`, `weight_kg_silver`, `weight_gm_silver`, `weight_mlgm_silver`, `weight_gm_gold`, `weight_mlgm_gold`, `weight_kg_gold`, `total_weight_gram_gold`, `net_weight_gram_gold`, `total_weight_gram_silver`, `net_weight_gram_silver`, `purity`, `item_id`, `item_name`, `investor_id`, `terms_condition_pic`, `overall_pic`, `store_id`, `store_type`, `creater_id`, `loan_finish_date`, `loan_validity_day`, `loan_period_month`, `client_name`, `investor_name`, `creator_name`, `creator_type`, `gold_approx_weight`, `silver_approx_weight`, `item_pic`, `packet_pic`, `is_finish`, `purity_checked_by`, `totalPrincipalPayToInvestor`, `totalInterestReceived`, `totalInvestorIntrestPay`, `totalPrincipalReceivedFromInvestor`, `totalPrincipalReceived`, `totalInterestTillDate`, `status`, `LastPrincipalRecivedDate`, `discount`, `loan_aprovided_by`, `jewellery_purchased_from`, `owner_of_jewellery`) VALUES
(1, 8, 0, '16-11-2023 19:14:36', '2023-01-01', '', 20000, 1.8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 0, 3, 'Gold + Silver', 7, '', '', 4, 'store', 6, '', 0, 4, 'ANUBHAV VERMA ', 'AS', 'prakh@gmail.com', 'admin', '2.50', '', '', '', 0, 'RISHIKA ', 0, 0, 0, 20000, 0, 3828, 1, NULL, 0, NULL, NULL, NULL),
(2, 10, 0, '16-11-2023 19:36:48', '2023-01-05', 'KATORI TUTI HUI HAI ', 5000, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'Gold', 9, '', '', 4, 'store', 6, '', 0, 4, 'RISHIKA AGRAWAL ', 'GSS ', 'prakh@gmail.com', 'admin', '1.50', '', '1700143608772979.jpeg', '', 0, 'RISHIKA ', 0, 1255, 0, 6000, 6000, 65431.7, 1, '24-11-2023', 54, NULL, NULL, NULL),
(3, 11, 0, '16-11-2023 19:50:52', '2023-02-01', 'PAYAL TUTI HUI ', 1500, 2.25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 55, 0, 2, 'Silver', 9, '', '', 4, 'store', 6, '', 0, 4, 'ADITI VERMA ', 'GSS ', 'prakh@gmail.com', 'admin', '', '', '', '', 0, 'anubhav verma ', 0, 0, 0, 1500, 0, 324, 1, NULL, 0, NULL, NULL, NULL),
(4, 13, 0, '17-11-2023 15:57:00', '2023-11-17', 'MANGALSUTRA (KALE MOTI SAHIT GATHA HUA HE) ,DANE KI MAKHI CHANDI KE TAAR ME GATHI HUI HE.', 40000, 2, 0, 0, 0, 0, 0, 0, 0, 15, 0, 0, 0, 1, 'Gold', 0, '', '', 4, 'store', 6, '', 0, 4, 'TANVI YADAV', '', 'prakh@gmail.com', 'admin', '', '', '1700216820202434.xlsx', '', 0, 'SHELLY', 0, 0, 0, 0, 0, 0, 1, NULL, 0, NULL, NULL, NULL),
(5, 13, 0, '18-11-2023 12:08:15', '2023-12-11', 'HAR, JHUMKI CHANDI GEDI SAHIT , MANGALSUTRA KALI CHID ME GATHA ( 1.PENDAL,12.DANE FOOTBALL)', 20000, 2, 0, 0, 0, 0, 0, 0, 0, 11, 0, 0, 0, 1, 'Gold', 0, '', '', 4, 'store', 6, '', 0, 4, 'TANVI YADAV', '', 'prakh@gmail.com', 'admin', '6 GRAM', '', '', '', 0, 'SHELLY', 0, 0, 0, 0, 10000, 93.33, 0, '18-11-2023', 0, NULL, NULL, NULL),
(6, 15, 0, '18-11-2023 19:38:22', '2023-11-18', 'silver payal , 1.mangalsutra , chain ( chain ka naka toota hua he)', 17000, 1, 0, 0, 0, 0, 0, 0, 0, 30, 0, 222, 0, 3, 'Gold + Silver', 0, '', '', 4, 'store', 6, '', 0, 2, 'vedant sharma', '', 'prakh@gmail.com', 'admin', '3', '200', '', '', 0, 'rishika', 0, 0, 0, 0, 0, 0, 1, NULL, 0, NULL, NULL, NULL),
(7, 16, 0, '21-11-2023 11:22:38', '2023-09-17', '', 26000, 1.8, 0, 0, 0, 0, 0, 0, 0, 7, 0, 0, 0, 1, 'Gold', 0, '', '', 4, 'store', 6, '', 0, 4, 'SHELLY SAHU', '', 'prakh@gmail.com', 'admin', '', '', '', '', 0, 'rishika', 0, 0, 0, 0, 0, 0, 1, NULL, 0, NULL, NULL, NULL),
(8, 17, 0, '21-11-2023 22:26:11', '2023-11-21', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'Gold', 1, '', '', 3, 'store', 5, '', 0, 0, 'test', 'jaipur Investor', 'shubham', 'admin', '10', '0', '', '', 0, 'test', 0, 0, 0, 30000, 0, 100, 1, NULL, 0, NULL, NULL, NULL),
(9, 18, 0, '22-11-2023 11:42:16', '2023-01-09', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          MANGALSUTRA ( 1.KATORRIB, 10.DANE )  KALI CHID ME GATHA HUA.', 30000, 1.65, 0, 0, 0, 8, 0, 0, 8, 8, 0, 0, 0, 1, 'Gold', 0, '', '', 4, 'store', 6, '', 0, 4, 'BHAWANA BODKHE', '', 'prakh@gmail.com', 'admin', '8', '0', '', '', 0, 'VEDANT', 0, 0, 0, 0, 0, 0, 1, NULL, 0, NULL, NULL, NULL),
(10, 16, 0, '22-11-2023 18:18:14', '22-11-2023', 'TOPS', 4000, 2.25, 0, 0, 0, 2, 0, 0, 2, 2, 0, 0, 0, 1, 'Gold', 0, '', '', 4, 'store', 6, '', 0, 1, 'SHELLY SAHU', '', 'prakh@gmail.com', 'admin', '', '', '', '', 0, '', 0, 0, 0, 0, 0, 0, 1, NULL, 0, NULL, NULL, NULL),
(11, 20, 0, '23-11-2023 12:07:16', '2022-10-10', 'PAYAL KI NAKE ME GHUNGHROO NHI HE', 6000, 1.5, 0, 250, 0, 0, 0, 0, 0, 0, 250, 250, 0, 2, 'Silver', 0, '', '', 4, 'store', 6, '', 0, 1, 'MINAKSHI AGRAWAL', '', 'prakh@gmail.com', 'admin', '0', '0', '', '', 0, 'DEEPALI', 0, 0, 0, 0, 0, 0, 1, NULL, 0, NULL, NULL, NULL),
(12, 21, 0, '23-11-2023 13:40:29', '2023-11-23', '', 4000, 2.25, 0, 100, 0, 0, 0, 0, 0, 0, 100, 100, 0, 2, 'Silver', 0, '', '', 4, 'store', 6, '', 0, 4, 'PRADEEP VERMA ', '', 'prakh@gmail.com', 'admin', '0', '0', '', '', 0, 'RISHIKA ', 0, 0, 0, 0, 0, 0, 1, NULL, 0, NULL, NULL, NULL),
(13, 24, 0, '24-11-2023 16:32:15', '2023-11-24', '', 20000, 1, 0, 0, 0, 30, 505, 0, 30.505, 30.505, 0, 0, 0, 3, 'Gold + Silver', 0, '', '', 4, 'store', 6, '', 0, 4, 'TANVI YADAV', '', 'prakh@gmail.com', 'admin', '', '', '', '', 0, 'rishika', 0, 0, 0, 0, 0, 0, 1, NULL, 0, NULL, NULL, NULL),
(14, 26, 0, '24-11-2023 17:20:07', '2023-01-01', 'MANGALSUTRA GATHA HE ( EK LINE TOOTI HE)', 28000, 1.5, 0, 0, 0, 8, 250, 0, 8.25, 8.25, 0, 0, 0, 1, 'Gold', 0, '', '', 4, 'store', 6, '', 0, 4, 'ARUNA  CHOUHAN', '', 'prakh@gmail.com', 'admin', '8.250', '', '', '', 0, 'SHELLY', 0, 0, 0, 0, 0, 0, 1, NULL, 0, NULL, NULL, NULL),
(15, 27, 0, '24-11-2023 20:06:18', '2023-11-24', '', 1000000, 2, 0, 0, 0, 10, 0, 0, 10, 10, 0, 0, 0, 1, '', 0, '', '', 3, 'store', 5, '', 0, 12, 'ram kumar saini', '', 'shubham', 'admin', '', '', '', '', 0, 'test', 0, 0, 0, 0, 0, 0, 1, NULL, 0, 'mukesh', 'mukesh and sons', 'mukesh wife'),
(16, 26, 0, '24-11-2023 20:36:32', '2023-01-01', '', 45550, 1.8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 'Gold + Silver', 0, '', '', 4, 'store', 6, '', 0, 4, 'ARUNA  CHOUHAN', '', 'prakh@gmail.com', 'admin', '', '', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, NULL, NULL),
(17, 29, 0, '29-11-2023 12:57:26', '2023-11-29', 'PUTLI HAR ( LAL DHAGE ME GATHA HUA )', 75000, 2, 0, 0, 0, 25, 500, 0, 25.5, 25.5, 0, 0, 0, 1, 'Gold', 0, '', '', 4, 'store', 6, '', 0, 4, 'SNEHA AGRAWAL', '', 'prakh@gmail.com', 'admin', '', '', '', '', 0, 'RISHIKA', 0, 0, 0, 0, 0, 0, 1, NULL, 0, 'RISHIKA', 'PARAKH JEWELLERS', 'MOTHER'),
(18, 27, 0, '29-11-2023 22:20:37', '2023-11-29', '', 100000, 1, 0, 0, 0, 10, 0, 0, 10, 10, 0, 0, 0, 1, '', 0, '', '', 3, 'store', 5, '', 0, 15, 'ram kumar saini', '', 'shubham', 'admin', '', '', '', '', 0, 'Purity Checked By', 0, 0, 0, 0, 0, 0, 1, NULL, 0, 'Loan Aprovied By', 'Jewellery Purchased From', 'Owner Of Jewellery'),
(19, 17, 0, '29-11-2023 22:21:13', '2023-11-29', '', 100000, 1, 0, 0, 0, 10, 0, 0, 10, 10, 0, 0, 0, 3, '', 0, '', '', 3, 'store', 5, '', 0, 15, 'test', '', 'shubham', 'admin', '', '', '', '', 0, 'Purity Checked By', 0, 0, 0, 0, 0, 0, 1, NULL, 0, 'Loan Aprovied By', 'Jewellery Purchased From', 'Owner Of Jewellery');

-- --------------------------------------------------------

--
-- Table structure for table `store_tbl`
--

CREATE TABLE `store_tbl` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `store_address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `store_type` varchar(50) NOT NULL DEFAULT 'store',
  `create_date` varchar(50) NOT NULL,
  `is_branch` int(11) NOT NULL,
  `parent_store_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `gst_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store_tbl`
--

INSERT INTO `store_tbl` (`store_id`, `store_name`, `store_address`, `city`, `state`, `store_type`, `create_date`, `is_branch`, `parent_store_id`, `email`, `mobile`, `gst_no`) VALUES
(1, 'Prakh Gold', 'Vijay Nagar Indore', 'indore', 'mp', 'store', '26-06-2023 16:04:09', 0, 0, 'prakh@gmail.com', '8349061881', '123456789'),
(2, 'PrakhBranch', 'indore', 'indore', 'madhya pradesh', 'branch', '26-06-2023 16:07:53', 1, 0, 'prakhbranch@gmail.com', '9630083266', '12345677'),
(3, 'praksh second', 'ac', 'indore', 'madhya pradesh', 'store', '25-10-2023 11:41:13', 0, 0, 'prakh@indore.com', '123456789', 'cbhsdcb'),
(4, 'prakh', 'sfgsf', 'jaipur', 'rajasthan', 'store', '16-11-2023 12:35:21', 0, 0, 'prakh@gmail.com', '9876543211', '5645635656');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_log`
--

CREATE TABLE `transaction_log` (
  `log_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `overall_type` varchar(50) NOT NULL,
  `order_id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `old_amount` float NOT NULL,
  `new_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_log`
--

INSERT INTO `transaction_log` (`log_id`, `amount`, `user_id`, `user_type`, `date_time`, `remark`, `overall_type`, `order_id`, `date`, `old_amount`, `new_amount`) VALUES
(1, -20000, 8, 'client', '16-11-2023 19:14:36', 'Initially Debit By Company', 'principal', 1, '', 0, -20000),
(2, 20000, 7, 'investor', '16-11-2023 19:24:24', 'Amount taken by prakh', 'investorAmount', 1, '16-11-2023', 0, 0),
(3, -5000, 10, 'client', '16-11-2023 19:36:48', 'Initially Debit By Company', 'principal', 2, '', 0, -5000),
(4, 6000, 9, 'investor', '16-11-2023 19:40:15', 'Amount taken by prakh', 'investorAmount', 2, '16-11-2023', 0, 0),
(5, 1000, 10, 'client', '16-11-2023 19:42:05', 'interestdeposited  by Customer ', 'interest', 2, '16-11-2023', 0, 0),
(6, -1500, 11, 'client', '16-11-2023 19:50:52', 'Initially Debit By Company', 'principal', 3, '', 0, -1500),
(7, 1500, 9, 'investor', '16-11-2023 19:54:18', 'Amount taken by prakh', 'investorAmount', 3, '16-11-2023', 0, 0),
(8, -40000, 13, 'client', '17-11-2023 15:57:00', 'Initially Debit By Company', 'principal', 4, '', 0, -40000),
(9, 1000, 10, 'client', '17-11-2023 18:19:17', 'principaldeposited  by Customer ', 'principal', 2, '17-11-2023', 0, 0),
(10, -20000, 13, 'client', '18-11-2023 12:08:15', 'Initially Debit By Company', 'principal', 5, '', 0, -20000),
(11, 5000, 13, 'client', '18-11-2023 12:26:36', 'principalwithdraw  by Customer ', 'principal', 5, '18-11-2023', 0, 0),
(12, 5000, 13, 'client', '18-11-2023 12:26:40', 'principalwithdraw  by Customer ', 'principal', 5, '18-11-2023', 0, 0),
(13, -17000, 15, 'client', '18-11-2023 19:38:22', 'Initially Debit By Company', 'principal', 6, '', 0, -17000),
(14, -26000, 16, 'client', '21-11-2023 11:22:38', 'Initially Debit By Company', 'principal', 7, '', 0, -26000),
(15, -10000, 17, 'client', '21-11-2023 22:26:11', 'Initially Debit By Company', 'principal', 8, '', 0, -10000),
(16, 10000, 1, 'investor', '21-11-2023 22:27:29', 'Amount taken by praksh second', 'investorAmount', 8, '21-11-2023', 0, 0),
(19, -30000, 18, 'client', '22-11-2023 11:42:16', 'Initially Debit By Company', 'principal', 9, '', 0, -30000),
(20, -4000, 16, 'client', '22-11-2023 18:18:14', 'Initially Debit By Company', 'principal', 10, '', 0, -4000),
(21, -6000, 20, 'client', '23-11-2023 12:07:16', 'Initially Debit By Company', 'principal', 11, '', 0, -6000),
(22, -4000, 21, 'client', '23-11-2023 13:40:29', 'Initially Debit By Company', 'principal', 12, '', 0, -4000),
(23, -20000, 24, 'client', '24-11-2023 16:32:15', 'Initially Debit By Company', 'principal', 13, '', 0, -20000),
(24, 255, 10, 'client', '24-11-2023 16:34:11', 'interestdeposited  by Customer ', 'interest', 2, '24-11-2023', 0, 0),
(25, 5000, 10, 'client', '24-11-2023 16:34:38', 'principalwithdraw  by Customer ', 'principal', 2, '24-11-2023', 0, 0),
(26, -28000, 26, 'client', '24-11-2023 17:20:07', 'Initially Debit By Company', 'principal', 14, '', 0, -28000),
(27, -1000000, 27, 'client', '24-11-2023 20:06:18', 'Initially Debit By Company', 'principal', 15, '', 0, -1000000),
(28, -45550, 26, 'client', '24-11-2023 20:36:32', 'Initially Debit By Company', 'principal', 16, '', 0, -45550),
(29, -75000, 29, 'client', '29-11-2023 12:57:26', 'Initially Debit By Company', 'principal', 17, '', 0, -75000),
(30, -10000, 17, 'client', '29-11-2023 22:17:15', 'Initially Debit By Company', 'principal', 0, '', 0, -10000),
(31, -100000, 27, 'client', '29-11-2023 22:20:37', 'Initially Debit By Company', 'principal', 18, '', 0, -100000),
(32, -100000, 17, 'client', '29-11-2023 22:21:13', 'Initially Debit By Company', 'principal', 19, '', 0, -100000);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `mobile` varchar(255) NOT NULL,
  `alter_mobile` varchar(255) NOT NULL,
  `total_coins` float NOT NULL,
  `nomination` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `create_date` varchar(50) NOT NULL,
  `aadhar_card` varchar(255) NOT NULL,
  `pan_card` varchar(255) NOT NULL,
  `voter_id` varchar(255) NOT NULL,
  `other_doc` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `husband_name` varchar(255) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `creater_id` int(11) NOT NULL,
  `creater_type` varchar(255) NOT NULL,
  `client_pic` varchar(255) NOT NULL,
  `client_signature_pic` varchar(255) NOT NULL,
  `aadhar_card_pic` varchar(255) NOT NULL,
  `pan_card_pic` varchar(255) NOT NULL,
  `jewellery_bill_pic` varchar(255) NOT NULL,
  `purity_checked_by` varchar(255) NOT NULL,
  `client_occupation` varchar(255) NOT NULL,
  `name_hindi` varchar(255) DEFAULT NULL,
  `father_name_hindi` varchar(255) DEFAULT NULL,
  `address_hindi` varchar(255) DEFAULT NULL,
  `city_hindi` varchar(255) DEFAULT NULL,
  `state_hindi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `store_id`, `name`, `short_name`, `username`, `email`, `password`, `user_type`, `status`, `mobile`, `alter_mobile`, `total_coins`, `nomination`, `address`, `city`, `state`, `create_date`, `aadhar_card`, `pan_card`, `voter_id`, `other_doc`, `remark`, `father_name`, `mother_name`, `husband_name`, `dob`, `creater_id`, `creater_type`, `client_pic`, `client_signature_pic`, `aadhar_card_pic`, `pan_card_pic`, `jewellery_bill_pic`, `purity_checked_by`, `client_occupation`, `name_hindi`, `father_name_hindi`, `address_hindi`, `city_hindi`, `state_hindi`) VALUES
(1, 1, 'jaipur Investor', '', '', '', '18498', 'investor', 1, '', '', 0, '', '', '', '', '24-10-2023 00:17:40', '', '', '', '', '', '', '', '', '', 13, 'admin', '', '', '', '', '', '', '', 'जयपुर निवेशक', '', '', '', ''),
(2, 1, 'indore investor', '', '', '', '83201', 'investor', 1, '', '', 0, '', '', '', '', '24-10-2023 00:19:52', '', '', '', '', '', '', '', '', '', 13, 'admin', '', '', '', '', '', '', '', 'इंदौर निवेशक', '', '', '', ''),
(3, 1, 'TANVI YADAV', '', 'TANVIYADAV 123@GAMIL.COM', 'TANVIYADAV 123@GAMIL.COM', '123456', 'employee', 1, '1234567891', '3216549871', 0, '', '', 'INDORE', 'MADHYA PRADESH', '24-10-2023 00:20:58', '2564355426321', '', '', '', '', 'ASHISH YADAV', '', '', '2000-09-17', 13, 'admin', '', '', '', '', '', '', '', 'तन्वी यादव', 'आशीष यादव', '', 'इंदौर', 'मध्य प्रदेश'),
(4, 1, 'shubham gupta', '', 'admin', 'shubham@gmail.com', '123456', 'superadmin', 1, '9630083266', '', 0, 'test', 'choti gwal toli', 'indore', 'mp', '24-10-2023 00:22:26', '123456', '', '', '', '  j j xremark', '123456', '', '', '2023-09-07', 13, 'admin', '1698087145606238.webp', '1698087145872764.jpg', '1698087145186016.jpeg', '1698087145832919.jpg', '1698087145128872.png', 'hbhb', 'xsgvcg', 'शुभम गुप्ता', '123456', 'छोटी ग्वाल टोली', 'इंदौर', 'एमपी'),
(5, 3, 'shubham', '', 'shubham@gmail.com', 'shubham@gmail.com', '123456', 'admin', 1, '12345678', '', 0, '', 'geetabhawan', 'indore', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', 'शुभम', '', 'गीताभवन', 'इंदौर', ''),
(6, 4, 'prakh@gmail.com', '', 'prakh@gmail.com', 'prakh@gmail.com', '123456', 'admin', 1, '98765423211', '', 0, '', 'jaipur', 'jaipur', 'rajasthan', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', 'prakh@gmail.com', '', 'जयपुर', 'जयपुर', 'राजस्थान Rajasthan'),
(7, 4, 'AS', '', '', '', '60880', 'investor', 1, '', '', 0, '', '', '', '', '16-11-2023 19:04:10', '', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', '', '', '', '', 'जैसा', '', '', '', ''),
(8, 4, 'ANUBHAV VERMA ', '', '', '', '38606', 'client', 1, '8889996555', '', 0, '', '196, KALANI NAGAR SABJI  MANDI  ', 'INDORE ', 'MADHYA PRADESH ', '16-11-2023 19:10:27', '2323256223', '', '', '', '', 'PRADEEP VERMA ', '', '', '1999-01-04', 6, 'admin', '1700142027899312.jpeg', '1700227427205914.jpg', '1700142027381377.jpeg', '1700142027221695.jpeg', '', '', '', 'अनुभव वर्मा', 'प्रदीप वर्मा', '196, कालानी नगर सब्जी मंडी', 'इंदौर', 'मध्य प्रदेश'),
(9, 4, 'GSS ', '', '', '', '27467', 'investor', 1, '', '', 0, '', '', '', '', '16-11-2023 19:29:54', '', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', '', '', '', '', 'जीएसएस', '', '', '', ''),
(10, 4, 'RISHIKA AGRAWAL ', '', '', '', '96949', 'client', 1, '7898900448', '123456', 0, 'PRACHI AGRAWAL', 'KALANI NAGAR  INDORE ', 'INDORE ', 'MP ', '16-11-2023 19:33:31', '4565644123', '', '', '', '', 'PANKAJ AGRAWAL ', '', '', '2000-09-17', 6, 'admin', '', '1700143411343252.jpeg', '', '', '', '', '', 'ऋषिका अग्रवाल', 'पंकज अग्रवाल', 'कालानी नगर इंदौर', 'इंदौर', 'एमपी'),
(11, 4, 'ADITI VERMA ', '', '', '', '79604', 'client', 1, '7999831911', '3232323232', 0, 'ANUBHAV VERMA ', '196 KALANI NAGAR  ', 'INDORE ', 'madhya pradesh ', '16-11-2023 19:49:04', '34565655', '', '', '', '', 'ASHOK VERMA ', '', '', '1998-04-27', 6, 'admin', '', '', '', '', '', '', '', 'अदिति वर्मा', 'अशोक वर्मा', '196 कालानी नगर', 'इंदौर', 'मध्य प्रदेश'),
(12, 3, 'ABC', '', 'ABC@gmail.com', 'ABC@gmail.com', '40970', 'investor', 1, '', '', 0, '', '', '', '', '17-11-2023 11:28:34', '', '', '', '', '', '', '', '', '', 5, 'admin', '', '', '', '', '', '', '', 'एबीसी', '', '', '', ''),
(13, 4, 'TANVI YADAV', '', 'TANVIYADAV 123@GAMIL.COM', 'TANVIYADAV 123@GAMIL.COM', '23690', 'client', 1, '8889996555', '9301522335', 0, '', '', 'INDORE', 'MADHYA PRADESH', '17-11-2023 15:17:11', '2564355426321', '', '', '', '', 'ASHISH YADAV', '', '', '', 6, 'admin', '', '', '', '', '', '', '', 'तन्वी यादव', 'आशीष यादव', '', 'इंदौर', 'मध्य प्रदेश'),
(14, 3, 'XYZ', '', 'XX', 'XX', '8427', 'investor', 1, '1234567890', '', 0, '', '', '', '', '18-11-2023 11:39:31', '123', '', '', '', '', '', '', '', '', 5, 'admin', '', '', '', '', '', '', '', 'XYZ', '', '', '', ''),
(15, 4, 'vedant sharma', '', 'vs123@gmail.com', 'vs123@gmail.com', '47268', 'client', 1, '9258147963', '8527419634', 0, 'jyoti sharma (mother)', 'vyas nagar , chetan school ke pass me.', 'INDORE', 'MADHYA PRADESH', '18-11-2023 19:22:18', '256435542222', '', '', '', 'refered by self', 'chetan', '', '', '1990-07-30', 6, 'admin', '', '', '', '', '', '', '', 'वेदांत शर्मा', 'चेतन', 'व्यास नगर, चेतन स्कूल के पास मुझे।', 'इंदौर', 'मध्य प्रदेश'),
(16, 4, 'SHELLY SAHU', '', '', '', '41587', 'client', 1, '1234567891', '', 0, '', '', 'INDORE', 'MADHYA PRADESH', '21-11-2023 11:19:47', '2564355422189', '', '', '', '', 'RITESH', '', '', '2002-10-16', 6, 'admin', '', '', '', '', '', '', '', 'शैली साहू', 'रितेश', '', 'इंदौर', 'मध्य प्रदेश'),
(17, 3, 'test', '', 'test@gmail.com', 'test@gmail.com', '123456', 'client', 1, '9988776655', '', 0, '', 'vaishali', 'jaipur', 'rajasthan', '21-11-2023 22:24:20', '1234567891234', '', '', '', '', 'testing', '', '', '1990-05-21', 5, 'admin', '', '', '', '', '', '', '', 'परीक्षा', 'परिक्षण', 'वैशाली', 'जयपुर', 'राजस्थान Rajasthan'),
(18, 4, 'BHAWANA BODKHE', '', 'BODKHEBHAWANA2545@GMAIL.COM', 'BODKHEBHAWANA2545@GMAIL.COM', '49756', 'client', 1, '7894563251', '2587145555', 0, 'JOSHITA', '60 FEET ROAD (INDORE)', 'INDORE', 'MADHYA PRADESH', '22-11-2023 11:35:27', '25814736974', '', '', '', 'REFERENCE BY-- SELF ', 'RAO', '', '', '1976-10-26', 6, 'admin', '', '', '', '', '', '', '', 'भावना बोडखे', 'राव', '60 फीट रोड (इंदौर)', 'इंदौर', 'मध्य प्रदेश'),
(19, 4, 'SNEH SUMAN ', '', '', '', '23316', 'client', 1, '9111133111', '', 0, 'SANJANA SUMAN ', 'CHOURASIYA NAGAR INDORE ', 'INDORE ', 'MADHYA PRADESH ', '22-11-2023 12:13:37', '56598953563', '', '', '', '', 'AJAY SUMAN ', '', '', '1996-01-01', 6, 'admin', '', '', '', '', '', '', '', 'स्नेह सुमन', 'अजय सुमन', 'चौरसिया नगर इंदौर', 'इंदौर', 'मध्य प्रदेश'),
(20, 4, 'MINAKSHI AGRAWAL', '', '', '', '56713', 'client', 1, '8889996555', '', 0, 'RISHIKA AGRAWAL', 'VIJAY SHREE NAGAR', 'BHOPAL', 'MADHYA PRADESH', '23-11-2023 11:55:16', '47859654123', '', '', '', 'REFERED BY RISHIKA AGRAWAL', 'PANKAJ', '', '', '2022-11-11', 6, 'admin', '', '', '', '', '', '', '', 'मिनाक्षी अग्रवाल', 'पंकज', 'विजय श्री नगर', 'भोपाल', 'मध्य प्रदेश'),
(21, 4, 'PRADEEP VERMA ', '', '', '', '21724', 'client', 1, '9301522335', '7999831911', 0, '', '196 KALANI NAGAR SABJI MANDI ', 'INDORE ', 'MADHYA PRADESH ', '23-11-2023 13:35:04', '123456789', '', '', '', '', 'MANSUKH LAL VERMA ', '', '', '1960-01-11', 6, 'admin', '', '', '', '', '', '', '', 'प्रदीप वर्मा', 'मनसुख लाल वर्मा', '196 कालानी नगर सब्जी मंडी', 'इंदौर', 'मध्य प्रदेश'),
(22, 4, 'AJAY SUMAN ', '', '', '', '18075', 'client', 1, '9111133111', '', 0, '', '', '', '', '24-11-2023 14:35:57', '', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', '', '', '', '', 'अजय सुमन', '', '', '', ''),
(23, 4, 'RISHIKA AGRAWAL ', '', '', '', '98225', 'client', 1, '8889996444', '12', 0, '', '', '', '', '24-11-2023 14:36:32', '', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', '', '', '', '', 'ऋषिका अग्रवाल', '', '', '', ''),
(24, 4, 'TANVI YADAV', '', 'UYFA2545@GMAIL.COM', 'UYFA2545@GMAIL.COM', '8730034', 'client', 1, '7456858937', '', 0, '', '', '', '', '24-11-2023 16:28:58', '25643554000001', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', '', '', '', '', 'तन्वी यादव', '', '', '', ''),
(25, 4, 'TANVI YADAV', '', 'UYFA2545@GMAIL.COM', 'UYFA2545@GMAIL.COM', '49413', 'client', 1, '7456858937', '5498645682', 0, 'RISHIKA AGRAWAL', '', 'BHOPAL', 'MADHYA PRADESH', '24-11-2023 16:28:58', '25643554000001', '', '', '', '', 'RITESH', '', '', '2023-01-01', 6, 'admin', '', '', '', '', '', '', '', 'तन्वी यादव', 'रितेश', '', 'भोपाल', 'मध्य प्रदेश'),
(26, 4, 'ARUNA  CHOUHAN', '', 'CHOUHANARUNA154@GMAIL.COM', 'CHOUHANARUNA154@GMAIL.COM', '4574', 'client', 1, '8770633585', '9575038297', 0, 'FATHER (   ABHISHEK)', 'GANJIPUR ROAD', 'JABALPUR', 'MADHYA PRADESH', '24-11-2023 16:59:58', '456478942514', '', '', '', 'REFERENCE--- VEDANT SHUKLA', 'ABHISHEK', '', '', '1985-11-11', 6, 'admin', '', '', '', '', '', '', '', 'अरुणा चौहान', 'अभिषेक', 'गंजीपुर रोड', 'जबलपुर', 'मध्य प्रदेश'),
(27, 3, 'ram kumar saini', '', 'ram@gmail.com', 'ram@gmail.com', '123456', 'client', 1, '9660123456', '6350111111', 0, 'll', 'plot no 12, vaishali nagar, jaipur', 'jaipur', 'Rajasthan', '24-11-2023 20:05:51', '123465789123', '', '', '', 'testing data hai ye ', 'radheshayam saini', '', '', '1993-07-10', 5, 'admin', '', '', '', '', '', '', 'dfa', 'राम कुमार सैनी', 'राधेशयाम सैनी', 'प्लॉट नंबर 12, वैशाली नगर, जयपुर', 'जयपुर', 'राजस्थान Rajasthan'),
(28, 4, 'SNEHA AGRAWAL', '', 'SNEHA4561@GAMIL.COM', 'SNEHA4561@GAMIL.COM', '68255', 'client', 1, '8817065845', '', 0, 'DHEERAJ AGRAWAL', '22, AMBIKAPURI MAIN', 'INDORE', 'MADHYA PRADESH', '29-11-2023 12:54:11', '857496123123', '', '', '', 'REFERED BY RISHIKA AGRAWAL', 'DHEERAJ', '', '', '2004-04-15', 6, 'admin', '', '', '', '', '', '', 'STUDENT', 'स्नेहा अग्रवाल', 'धीरज', '22, अंबिकापुरी मुख्य', 'इंदौर', 'मध्य प्रदेश'),
(29, 4, 'SNEHA AGRAWAL', '', 'SNEHA4561@GAMIL.COM', 'SNEHA4561@GAMIL.COM', '20014', 'client', 1, '8817065845', '', 0, 'DHEERAJ AGRAWAL', '22, AMBIKAPURI MAIN', 'INDORE', 'MADHYA PRADESH', '29-11-2023 12:54:16', '857496123123', '', '', '', 'REFERED BY RISHIKA AGRAWAL', 'DHEERAJ', '', '', '2004-04-15', 6, 'admin', '', '', '', '', '', '', 'STUDENT', 'स्नेहा अग्रवाल', 'धीरज', '22, अंबिकापुरी मुख्य', 'इंदौर', 'मध्य प्रदेश');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_investor_list`
--
ALTER TABLE `assign_investor_list`
  ADD PRIMARY KEY (`assign_investor_id`);

--
-- Indexes for table `item_list`
--
ALTER TABLE `item_list`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `order_item_list`
--
ALTER TABLE `order_item_list`
  ADD PRIMARY KEY (`order_item_list_id`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `store_tbl`
--
ALTER TABLE `store_tbl`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `transaction_log`
--
ALTER TABLE `transaction_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_investor_list`
--
ALTER TABLE `assign_investor_list`
  MODIFY `assign_investor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item_list`
--
ALTER TABLE `item_list`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_item_list`
--
ALTER TABLE `order_item_list`
  MODIFY `order_item_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `store_tbl`
--
ALTER TABLE `store_tbl`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaction_log`
--
ALTER TABLE `transaction_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
