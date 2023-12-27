-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2023 at 03:02 PM
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
-- Database: `golderp`
--

-- --------------------------------------------------------

--
-- Table structure for table `amount_tbl`
--

CREATE TABLE `amount_tbl` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `amount_tbl`
--

INSERT INTO `amount_tbl` (`id`, `order_id`, `amount`, `start_date`, `end_date`) VALUES
(1, 7, -10000, '18-12-2023', '18-12-2023'),
(2, 7, -1000, '18-12-2023', '18-12-2023'),
(3, 7, -1000, '18-12-2023', '20-12-2023'),
(4, 7, -1000, '20-12-2023', '20-12-2023'),
(5, 7, -2000, '20-12-2023', '20-12-2023'),
(6, 7, -100, '20-12-2023', '20-12-2023'),
(7, 7, -10, '20-12-2023', '20-12-2023'),
(8, 7, -10, '20-12-2023', '20-12-2023'),
(9, 7, -10, '20-12-2023', ''),
(10, 8, -10000, '18-12-2023', ''),
(11, 9, -10000, '19-12-2023', ''),
(12, 10, -10000, '20-12-2023', '11-01-2024'),
(13, 10, -10000, '11-01-2024', '14-01-2024'),
(14, 10, -10000, '14-01-2024', '16-01-2024'),
(15, 10, -1000, '16-01-2024', '20-07-2024'),
(16, 11, -10000, '19-12-2023', '31-12-2023'),
(17, 11, -2000, '31-12-2023', '31-12-2023'),
(18, 11, -1000, '31-12-2023', '31-12-2023'),
(19, 11, -1000, '31-12-2023', '31-12-2023'),
(20, 11, -1000, '31-12-2023', '31-12-2023'),
(21, 11, -1000, '31-12-2023', '31-12-2023'),
(22, 11, -1000, '31-12-2023', '31-12-2023'),
(23, 11, -1000, '31-12-2023', ''),
(24, 10, -10000, '20-07-2024', '');

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
  `packet_reciving_date` varchar(255) NOT NULL,
  `approval_status` int(11) NOT NULL DEFAULT 0,
  `approver_id` int(11) DEFAULT NULL,
  `approver_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign_investor_list`
--

INSERT INTO `assign_investor_list` (`assign_investor_id`, `order_id`, `client_id`, `investor_id`, `total_interest`, `investor_name`, `remark`, `packet_name`, `start_date`, `end_date`, `status`, `interest_rate`, `amount`, `client_name`, `store_name`, `store_id`, `creator_type`, `name`, `insert_date`, `store_type`, `creator_id`, `totalPrincipalPaid`, `totalInterestPaid`, `totalInterestTillDate`, `totalPrincipalReceived`, `packet_given_date`, `packet_reciving_date`, `approval_status`, `approver_id`, `approver_name`) VALUES
(1, 2, 50, 1, 0, 'jaipur Investor', '2', '1321455555555555555555', '2023-12-19', '', 'active', 1, 10000, 'dfadfasdf', '', 3, '', '', '19-12-2023 21:30:52', 'store', 5, 0, 0, 3.33, 10000, '', '', 0, 5, 'shubham'),
(2, 11, 50, 1, 0, 'jaipur Investor', '', 'dhghsghs', '', '', 'active', 1, 10000, 'dfadfasdf', '', 3, '', '', '20-12-2023 19:28:33', 'store', 5, 0, 0, 65700, 10000, '', '', 1, 5, 'shubham');

-- --------------------------------------------------------

--
-- Table structure for table `item_list`
--

CREATE TABLE `item_list` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `short_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_list`
--

INSERT INTO `item_list` (`item_id`, `item_name`, `short_name`) VALUES
(1, 'Gold', 'gold'),
(2, 'Silver', 'silver'),
(3, 'Gold + Silver', 'gold + silver');

-- --------------------------------------------------------

--
-- Table structure for table `narration_tbl`
--

CREATE TABLE `narration_tbl` (
  `narration_id` int(11) NOT NULL,
  `narration_type` varchar(255) NOT NULL,
  `narration_text` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `created_on` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `narration_tbl`
--

INSERT INTO `narration_tbl` (`narration_id`, `narration_type`, `narration_text`, `order_id`, `creator_id`, `created_on`) VALUES
(1, 'Loan Closing', 'loan closed by', 11, 5, '20-07-2024 19:45:12');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `loan_amount` float NOT NULL DEFAULT 0,
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
  `status` int(11) NOT NULL DEFAULT 1,
  `LastPrincipalRecivedDate` varchar(50) DEFAULT NULL,
  `discount` float NOT NULL,
  `loan_aprovided_by` varchar(255) DEFAULT NULL,
  `jewellery_purchased_from` varchar(255) DEFAULT NULL,
  `jewellery_purchased_from_hindi` varchar(255) DEFAULT NULL,
  `owner_of_jewellery` varchar(255) DEFAULT NULL,
  `owner_of_jewellery_hindi` varchar(255) DEFAULT NULL,
  `gold_details` varchar(255) DEFAULT NULL,
  `silver_details` varchar(255) DEFAULT NULL,
  `gold_purity` varchar(255) DEFAULT NULL,
  `silver_purity` varchar(255) DEFAULT NULL,
  `loan_close_narration` varchar(255) NOT NULL,
  `loanTopUpAmount` float NOT NULL DEFAULT 0,
  `loanTopUpdate` varchar(50) DEFAULT NULL,
  `3dayinstrest` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`order_id`, `client_id`, `user_id`, `create_date_time`, `loan_date`, `remark`, `loan_amount`, `loan_interest`, `weight_kg_silver`, `weight_gm_silver`, `weight_mlgm_silver`, `weight_gm_gold`, `weight_mlgm_gold`, `weight_kg_gold`, `total_weight_gram_gold`, `net_weight_gram_gold`, `total_weight_gram_silver`, `net_weight_gram_silver`, `purity`, `item_id`, `item_name`, `investor_id`, `terms_condition_pic`, `overall_pic`, `store_id`, `store_type`, `creater_id`, `loan_finish_date`, `loan_validity_day`, `loan_period_month`, `client_name`, `investor_name`, `creator_name`, `creator_type`, `gold_approx_weight`, `silver_approx_weight`, `item_pic`, `packet_pic`, `is_finish`, `purity_checked_by`, `totalPrincipalPayToInvestor`, `totalInterestReceived`, `totalInvestorIntrestPay`, `totalPrincipalReceivedFromInvestor`, `totalPrincipalReceived`, `totalInterestTillDate`, `status`, `LastPrincipalRecivedDate`, `discount`, `loan_aprovided_by`, `jewellery_purchased_from`, `jewellery_purchased_from_hindi`, `owner_of_jewellery`, `owner_of_jewellery_hindi`, `gold_details`, `silver_details`, `gold_purity`, `silver_purity`, `loan_close_narration`, `loanTopUpAmount`, `loanTopUpdate`, `3dayinstrest`) VALUES
(1, 17, 0, '18-12-2023 20:01:24', '2023-11-01', '', 10000, 2, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0, 0, 1, 'Gold', 0, '', '', 3, 'store', 5, '', 0, 5, 'test', '', 'shubham', 'admin', '', '', '', '', 0, 'mukesh', 0, 300, 0, 0, 0, 33.33, 1, '18-12-2023', 0, 'mukesh', 'mukesh', 'मुकेश', 'mukesh', 'मुकेश', 'mukeshmukesh mukeshmukeshmukesh', '', '', '', '', 0, NULL, 0),
(2, 50, 0, '18-12-2023 20:03:23', '2023-10-01', '', 11000, 2, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0, 0, 1, 'Gold', 1, '', '', 3, 'store', 5, '', 0, 12, 'dfadfasdf', 'jaipur Investor', 'shubham', 'admin', '', '', '', '', 0, 'mukesh', 0, 460, 0, 10000, 0, 0, 1, '18-12-2023', 0, 'mukesh', 'mukesh', 'मुकेश', 'mukesh', 'मुकेश', 'mukeshmukeshmukeshmukeshmukesh', '', 'mukesh', 'mukesh', '', 1000, '18-12-2023', 0),
(3, 50, 0, '18-12-2023 20:21:43', '2023-08-01', '', 10000, 2, 0, 0, 0, 0, 0, 0, 0, 11, 0, 0, 0, 1, 'Gold', 0, '', '', 3, 'store', 5, '', 0, 12, 'dfadfasdf', '', 'shubham', 'admin', '', '', '', '', 0, 'nhcgncbn', 0, 0, 0, 0, 1000, 926.67, 1, '18-12-2023', 0, 'nvbnb', 'vbncvbn', 'vbncvbn', 'mukesh', 'मुकेश', '', '', '', '', '', 0, NULL, 0),
(4, 50, 0, '18-12-2023 21:22:36', '2023-12-01', '', 10000, 1, 0, 0, 0, 0, 0, 0, 0, 11, 0, 0, 0, 1, 'Gold', 0, '', '', 3, 'store', 5, '', 0, 5, 'dfadfasdf', '', 'shubham', 'admin', '', '', '', '', 0, 'dfasdfasdf', 0, 0, 0, 0, 0, 0, 1, NULL, 0, 'fasdfasdf', 'asdfasd', 'asdfasd', 'sdfadfa', 'sdfadfa', '', '', '', '', '', 0, NULL, 0),
(5, 50, 0, '18-12-2023 21:23:11', '2023-12-01', '', 10000, 1, 0, 0, 0, 0, 0, 0, 0, 11, 0, 0, 0, 1, 'Gold', 0, '', '', 3, 'store', 5, '', 0, 5, 'dfadfasdf', '', 'shubham', 'admin', '', '', '', '', 0, 'dfasdfasdf', 0, 0, 0, 0, 0, 0, 1, NULL, 0, 'fasdfasdf', 'asdfasd', 'asdfasd', 'sdfadfa', 'sdfadfa', '', '', '', '', '', 0, NULL, 0),
(6, 50, 0, '18-12-2023 21:23:55', '2023-12-01', '', 10000, 1, 0, 0, 0, 0, 0, 0, 0, 11, 0, 0, 0, 1, 'Gold', 0, '', '', 3, 'store', 5, '', 0, 5, 'dfadfasdf', '', 'shubham', 'admin', '', '', '', '', 0, 'dfasdfasdf', 0, 0, 0, 0, 1000, 0, 1, '20-12-2023', 0, 'fasdfasdf', 'asdfasd', 'asdfasd', 'sdfadfa', 'sdfadfa', '', '', '', '', '', 0, NULL, 10),
(7, 50, 0, '18-12-2023 21:25:33', '2023-12-01', '', 10000, 1, 0, 0, 0, 0, 0, 0, 0, 11, 0, 0, 0, 1, 'Gold', 0, '', '', 3, 'store', 5, '', 0, 5, 'dfadfasdf', '', 'shubham', 'admin', '', '', '', '', 0, 'dfasdfasdf', 0, 56.67, 0, 0, 21, 56.67, 1, '18-12-2023', 0, 'fasdfasdf', 'asdfasd', 'asdfasd', 'sdfadfa', 'sdfadfa', '', '', '', '', '', 0, NULL, 0),
(8, 50, 0, '18-12-2023 22:04:32', '2023-07-01', '', 10000, 1, 0, 0, 0, 0, 0, 0, 0, 11, 0, 0, 0, 1, 'Gold', 0, '', '', 3, 'store', 5, '', 0, 5, 'dfadfasdf', '', 'shubham', 'admin', '', '', '', '', 0, 'mukesh', 0, 101, 0, 0, 7000, 6.67, 1, '20-12-2023', 0, 'mukesh', 'mukesh', 'मुकेश', 'mukesh', 'मुकेश', 'vvvvvvvv', '', '', '', '', 0, NULL, 3),
(9, 17, 0, '19-12-2023 18:29:07', '2023-11-01', '', 10000, 1, 0, 0, 0, 0, 0, 0, 0, 11, 0, 0, 0, 1, 'Gold', 0, '', '', 3, 'store', 5, '', 0, 12, 'test', '', 'shubham', 'admin', '', '', '', '', 0, 'mukesh', 0, 0, 0, 0, 0, 0, 1, NULL, 0, 'mukesh', 'mukesh', 'मुकेश', 'mukesh', 'मुकेश', 'gsfdgsdfgsfdg', '', 'fsdgfg', 'sf', '', 0, NULL, 0),
(10, 50, 0, '20-12-2023 18:41:12', '2023-12-19', '', 21000, 1, 0, 0, 0, 0, 0, 0, 0, 11, 0, 0, 0, 1, 'Gold', 0, '', '', 3, 'store', 5, '', 0, 12, 'dfadfasdf', '', 'shubham', 'admin', '', '', '', '', 0, 'mukesh', 0, 0, 0, 0, 5000, 2051.33, 1, '20-07-2024', 0, 'mukesh', 'mukesh', 'मुकेश', 'mukesh', 'मुकेश', 'etyet', '', 'mukesh', '', '', 0, NULL, 16),
(11, 50, 0, '19-12-2023 19:21:03', '2023-12-19', '', 18000, 2, 0, 0, 0, 0, 0, 0, 0, 11, 0, 0, 0, 1, 'Gold', 1, '', '', 3, 'store', 5, '20-07-2024', 0, 5, 'dfadfasdf', 'jaipur Investor', 'shubham', 'admin', '', '', '', '', 1, 'mukesh', 0, 2568, 0, 10000, 18000, 2568, 1, '20-07-2024', 0, 'mukesh', 'mukesh', 'मुकेश', 'mukesh', 'मुकेश', 'fgrrrrrrrrrrrrg', '', '', '', 'loan closed by', 0, NULL, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `new_amount` float NOT NULL,
  `creator_id` int(11) NOT NULL,
  `customer_remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_log`
--

INSERT INTO `transaction_log` (`log_id`, `amount`, `user_id`, `user_type`, `date_time`, `remark`, `overall_type`, `order_id`, `date`, `old_amount`, `new_amount`, `creator_id`, `customer_remark`) VALUES
(1, -10000, 17, 'client', '18-12-2023 20:01:25', 'Initially Debit By Company', 'principal', 1, '', 0, -10000, 0, ''),
(3, -10000, 50, 'client', '18-12-2023 20:03:23', 'Initially Debit By Company', 'principal', 2, '', 0, -10000, 0, ''),
(5, -1000, 50, 'client', '18-12-2023 20:08:23', 'principalTopUp  by Customer ', 'principal', 2, '18-12-2023', 0, 0, 5, ''),
(6, 460, 50, 'client', '18-12-2023 20:17:14', 'interestdeposited  by Customer ', 'interest', 2, '18-12-2023', 0, 0, 5, ''),
(7, -10000, 50, 'client', '18-12-2023 20:21:43', 'Initially Debit By Company', 'principal', 3, '', 0, -10000, 0, ''),
(8, 1000, 50, 'client', '18-12-2023 20:21:55', 'principaldeposited  by Customer ', 'principal', 3, '18-12-2023', 0, 0, 5, ''),
(9, -10000, 50, 'client', '18-12-2023 21:22:48', 'Initially Debit By Company', 'principal', 4, '', 0, -10000, 0, ''),
(10, -10000, 50, 'client', '18-12-2023 21:23:12', 'Initially Debit By Company', 'principal', 5, '', 0, -10000, 0, ''),
(11, -10000, 50, 'client', '18-12-2023 21:24:15', 'Initially Debit By Company', 'principal', 6, '', 0, -10000, 0, ''),
(12, -10000, 50, 'client', '18-12-2023 21:25:33', 'Initially Debit By Company', 'principal', 7, '', 0, -10000, 0, ''),
(13, -1000, 50, 'client', '18-12-2023 21:36:15', 'principalTopUp  by Customer ', 'principal', 7, '18-12-2023', 0, 0, 5, ''),
(14, -1000, 50, 'client', '18-12-2023 21:36:21', 'principalTopUp  by Customer ', 'principal', 7, '18-12-2023', 0, 0, 5, ''),
(15, -1000, 50, 'client', '20-12-2023 21:37:04', 'principalTopUp  by Customer ', 'principal', 7, '20-12-2023', 0, 0, 5, ''),
(16, -2000, 50, 'client', '20-12-2023 21:39:20', 'principalTopUp  by Customer ', 'principal', 7, '20-12-2023', 0, 0, 5, ''),
(17, 10, 50, 'client', '20-12-2023 21:39:58', 'principaldeposited  by Customer ', 'principal', 7, '20-12-2023', 0, 0, 5, ''),
(18, 1, 50, 'client', '20-12-2023 21:41:29', 'principaldeposited  by Customer ', 'principal', 7, '20-12-2023', 0, 0, 5, ''),
(19, -100, 50, 'client', '20-12-2023 21:42:22', 'principalTopUp  by Customer ', 'principal', 7, '20-12-2023', 0, 0, 5, ''),
(20, 10, 50, 'client', '20-12-2023 21:42:33', 'principaldeposited  by Customer ', 'principal', 7, '20-12-2023', 0, 0, 5, ''),
(21, -10, 50, 'client', '20-12-2023 21:42:36', 'principalTopUp  by Customer ', 'principal', 7, '20-12-2023', 0, 0, 5, ''),
(22, -10, 50, 'client', '20-12-2023 21:43:24', 'principalTopUp  by Customer ', 'principal', 7, '20-12-2023', 0, 0, 5, ''),
(23, -10, 50, 'client', '20-12-2023 21:45:36', 'principalTopUp  by Customer ', 'principal', 7, '20-12-2023', 0, 0, 5, ''),
(24, 56.67, 50, 'client', '18-12-2023 21:51:55', 'interestdeposited  by Customer ', 'interest', 7, '18-12-2023', 0, 0, 5, ''),
(25, -10000, 50, 'client', '18-12-2023 22:04:32', 'Initially Debit By Company', 'principal', 8, '', 0, -10000, 0, ''),
(26, -10000, 17, 'client', '19-12-2023 18:29:07', 'Initially Debit By Company', 'principal', 9, '', 0, -10000, 0, ''),
(27, -10000, 50, 'client', '20-12-2023 18:41:12', 'Initially Debit By Company', 'principal', 10, '', 0, -10000, 0, ''),
(28, -10000, 50, 'client', '11-01-2024 18:46:23', 'principalTopUp  by Customer ', 'principal', 10, '11-01-2024', 0, 0, 5, ''),
(29, 1000, 50, 'client', '14-01-2024 18:59:08', 'principaldeposited  by Customer ', 'principal', 10, '14-01-2024', 0, 0, 5, ''),
(30, -10000, 50, 'client', '14-01-2024 18:59:55', 'principalTopUp  by Customer ', 'principal', 10, '14-01-2024', 0, 0, 5, ''),
(31, 1000, 50, 'client', '16-01-2024 19:06:21', 'principaldeposited  by Customer ', 'principal', 10, '16-01-2024', 0, 0, 5, ''),
(32, 1000, 50, 'client', '16-01-2024 19:12:50', 'principaldeposited  by Customer ', 'principal', 10, '16-01-2024', 0, 0, 5, ''),
(33, -1000, 50, 'client', '16-01-2024 19:13:03', 'principalTopUp  by Customer ', 'principal', 10, '16-01-2024', 0, 0, 5, ''),
(34, 1000, 50, 'client', '16-01-2024 19:13:45', 'principaldeposited  by Customer ', 'principal', 10, '16-01-2024', 0, 0, 5, ''),
(35, 1000, 50, 'client', '16-01-2024 19:15:53', 'principaldeposited  by Customer ', 'principal', 10, '16-01-2024', 0, 0, 5, ''),
(36, -10000, 50, 'client', '19-12-2023 19:21:03', 'Initially Debit By Company', 'principal', 11, '', 0, -10000, 0, ''),
(37, -2000, 50, 'client', '31-12-2023 19:21:45', 'principalTopUp  by Customer ', 'principal', 11, '31-12-2023', 0, 0, 5, ''),
(38, 1000, 50, 'client', '31-12-2023 19:22:38', 'principaldeposited  by Customer ', 'principal', 11, '31-12-2023', 0, 0, 5, ''),
(39, 1000, 50, 'client', '31-12-2023 19:23:08', 'principaldeposited  by Customer ', 'principal', 11, '31-12-2023', 0, 0, 5, ''),
(40, 1000, 50, 'client', '31-12-2023 19:24:38', 'principaldeposited  by Customer ', 'principal', 11, '31-12-2023', 0, 0, 5, ''),
(41, 1000, 50, 'client', '31-12-2023 19:27:26', 'principaldeposited  by Customer ', 'principal', 11, '31-12-2023', 0, 0, 5, ''),
(42, 1000, 50, 'client', '31-12-2023 19:27:50', 'principaldeposited  by Customer ', 'principal', 11, '31-12-2023', 0, 0, 5, ''),
(43, 1000, 50, 'client', '31-12-2023 19:39:34', 'principaldeposited  by Customer ', 'principal', 11, '31-12-2023', 0, 0, 5, ''),
(44, -1000, 50, 'client', '31-12-2023 19:40:42', 'principalTopUp  by Customer ', 'principal', 11, '31-12-2023', 0, 0, 5, ''),
(45, -1000, 50, 'client', '31-12-2023 19:40:54', 'principalTopUp  by Customer ', 'principal', 11, '31-12-2023', 0, 0, 5, ''),
(46, 1000, 50, 'client', '31-12-2023 19:41:08', 'principaldeposited  by Customer ', 'principal', 11, '31-12-2023', 0, 0, 5, ''),
(47, -1000, 50, 'client', '31-12-2023 19:41:49', 'principalTopUp  by Customer ', 'principal', 11, '31-12-2023', 0, 0, 5, ''),
(48, -1000, 50, 'client', '31-12-2023 19:42:00', 'principalTopUp  by Customer ', 'principal', 11, '31-12-2023', 0, 0, 5, ''),
(49, -1000, 50, 'client', '31-12-2023 19:43:13', 'principalTopUp  by Customer ', 'principal', 11, '31-12-2023', 0, 0, 5, ''),
(50, -1000, 50, 'client', '31-12-2023 19:43:33', 'principalTopUp  by Customer ', 'principal', 11, '31-12-2023', 0, 0, 5, ''),
(51, 100, 50, 'client', '31-12-2023 19:45:41', 'principaldeposited  by Customer ', 'principal', 11, '31-12-2023', 0, 0, 5, ''),
(52, 100, 50, 'client', '31-12-2023 19:45:57', 'principaldeposited  by Customer ', 'principal', 11, '31-12-2023', 0, 0, 5, ''),
(53, 100, 50, 'client', '31-12-2023 19:47:04', 'interestdeposited  by Customer ', 'interest', 11, '31-12-2023', 0, 0, 5, ''),
(54, 60, 50, 'client', '31-12-2023 19:47:23', 'principaldeposited  by Customer ', 'principal', 11, '31-12-2023', 0, 0, 5, ''),
(55, 50, 50, 'client', '31-12-2023 19:47:45', 'interestdeposited  by Customer ', 'interest', 11, '31-12-2023', 0, 0, 5, ''),
(56, 10, 50, 'client', '31-12-2023 19:48:21', 'interestdeposited  by Customer ', 'interest', 11, '31-12-2023', 0, 0, 5, ''),
(57, 10000, 1, 'investor', '19-12-2023 21:30:52', 'Amount taken by praksh second', 'investorAmount', 2, '19-12-2023', 0, 0, 0, ''),
(58, 1000, 50, 'client', '20-12-2023 17:58:20', 'principaldeposited  by Customer ', 'principal', 11, '20-12-2023', 0, 0, 5, ''),
(59, 1000, 50, 'client', '20-12-2023 17:58:31', 'principaldeposited  by Customer ', 'principal', 11, '20-12-2023', 0, 0, 5, ''),
(60, 1000, 50, 'client', '20-12-2023 18:00:35', 'principaldeposited  by Customer ', 'principal', 11, '20-12-2023', 0, 0, 5, ''),
(61, 1000, 50, 'client', '20-12-2023 18:01:03', 'principaldeposited  by Customer ', 'principal', 11, '20-12-2023', 0, 0, 5, ''),
(62, 1000, 50, 'client', '20-12-2023 18:03:18', 'principaldeposited  by Customer ', 'principal', 11, '20-12-2023', 0, 0, 5, ''),
(63, 1000, 50, 'client', '20-12-2023 18:03:52', 'principaldeposited  by Customer ', 'principal', 11, '20-12-2023', 0, 0, 5, ''),
(64, 1000, 50, 'client', '20-12-2023 18:04:53', 'principaldeposited  by Customer ', 'principal', 11, '20-12-2023', 0, 0, 5, ''),
(65, 100, 50, 'client', '20-12-2023 18:06:30', 'principaldeposited  by Customer ', 'principal', 11, '20-12-2023', 0, 0, 5, ''),
(66, 1000, 50, 'client', '20-12-2023 18:06:40', 'principaldeposited  by Customer ', 'principal', 11, '20-12-2023', 0, 0, 5, ''),
(67, 100, 50, 'client', '20-12-2023 18:08:05', 'principaldeposited  by Customer ', 'principal', 11, '20-12-2023', 0, 0, 5, ''),
(68, 100, 50, 'client', '20-12-2023 18:09:51', 'principaldeposited  by Customer ', 'principal', 11, '20-12-2023', 0, 0, 5, ''),
(69, 100, 50, 'client', '20-12-2023 18:10:03', 'principaldeposited  by Customer ', 'principal', 11, '20-12-2023', 0, 0, 5, ''),
(70, 100, 50, 'client', '20-12-2023 18:11:41', 'principaldeposited  by Customer ', 'principal', 11, '20-12-2023', 0, 0, 5, ''),
(71, 100, 50, 'client', '20-12-2023 18:36:55', 'principaldeposited  by Customer ', 'principal', 11, '20-12-2023', 0, 0, 5, ''),
(72, 100, 50, 'client', '20-12-2023 18:37:23', 'principaldeposited  by Customer ', 'principal', 11, '20-12-2023', 0, 0, 5, ''),
(73, 10000, 1, 'investor', '20-12-2023 19:28:34', 'Amount taken by praksh second', 'investorAmount', 11, '20-12-2023', 0, 0, 0, ''),
(74, 1000, 50, 'client', '20-12-2023 19:33:17', 'principaldeposited  by Customer ', 'principal', 6, '20-12-2023', 0, 0, 5, ''),
(75, 1000, 50, 'client', '20-01-2024 19:34:11', 'principaldeposited  by Customer ', 'principal', 8, '20-01-2024', 0, 0, 5, ''),
(76, 1000, 50, 'client', '20-07-2024 19:43:54', 'principaldeposited  by Customer ', 'principal', 11, '20-07-2024', 0, 0, 5, ''),
(77, 1040, 50, 'client', '20-07-2024 19:44:25', 'principaldeposited  by Customer ', 'principal', 11, '20-07-2024', 0, 0, 5, ''),
(78, 54.67, 50, 'client', '20-07-2024 19:44:49', 'interestdeposited  by Customer ', 'interest', 11, '20-07-2024', 0, 0, 5, ''),
(79, 2353.33, 50, 'client', '20-07-2024 19:46:01', 'interestdeposited  by Customer ', 'interest', 11, '20-07-2024', 0, 0, 5, ''),
(80, -10000, 50, 'client', '20-07-2024 19:50:10', 'principalTopUp  by Customer ', 'principal', 10, '20-07-2024', 0, 0, 5, ''),
(81, 1000, 50, 'client', '20-07-2024 19:52:08', 'principaldeposited  by Customer ', 'principal', 10, '20-07-2024', 0, 0, 5, ''),
(82, 1000, 50, 'client', '20-07-2024 19:54:51', 'principaldeposited  by Customer ', 'principal', 8, '20-07-2024', 0, 0, 5, ''),
(83, 1000, 50, 'client', '30-07-2024 19:57:38', 'principaldeposited  by Customer ', 'principal', 8, '30-07-2024', 0, 0, 5, ''),
(84, 100, 50, 'client', '30-07-2024 19:58:19', 'interestdeposited  by Customer ', 'interest', 8, '30-07-2024', 0, 0, 5, ''),
(85, 1000, 50, 'client', '30-07-2024 19:58:32', 'principaldeposited  by Customer ', 'principal', 8, '30-07-2024', 0, 0, 5, ''),
(86, 1000, 50, 'client', '20-12-2023 20:58:42', 'principaldeposited  by Customer ', 'principal', 8, '20-12-2023', 0, 0, 5, ''),
(87, 1000, 50, 'client', '20-12-2023 21:01:18', 'principaldeposited  by Customer ', 'principal', 8, '20-12-2023', 0, 0, 5, ''),
(88, 1000, 50, 'client', '20-12-2023 21:01:34', 'principaldeposited  by Customer ', 'principal', 8, '20-12-2023', 0, 0, 5, ''),
(89, 1, 50, 'client', '20-12-2023 21:04:11', 'interestdeposited  by Customer ', 'interest', 8, '20-12-2023', 0, 0, 5, '');

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
  `status` int(11) NOT NULL DEFAULT 1,
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
  `aadhar_card_pic_front` varchar(255) DEFAULT NULL,
  `aadhar_card_pic_back` varchar(255) DEFAULT NULL,
  `pan_card_pic` varchar(255) NOT NULL,
  `jewellery_bill_pic` varchar(255) NOT NULL,
  `purity_checked_by` varchar(255) NOT NULL,
  `client_occupation` varchar(255) NOT NULL,
  `name_hindi` varchar(255) DEFAULT NULL,
  `father_name_hindi` varchar(255) DEFAULT NULL,
  `address_hindi` varchar(255) DEFAULT NULL,
  `city_hindi` varchar(255) DEFAULT NULL,
  `state_hindi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `store_id`, `name`, `short_name`, `username`, `email`, `password`, `user_type`, `status`, `mobile`, `alter_mobile`, `total_coins`, `nomination`, `address`, `city`, `state`, `create_date`, `aadhar_card`, `pan_card`, `voter_id`, `other_doc`, `remark`, `father_name`, `mother_name`, `husband_name`, `dob`, `creater_id`, `creater_type`, `client_pic`, `client_signature_pic`, `aadhar_card_pic`, `aadhar_card_pic_front`, `aadhar_card_pic_back`, `pan_card_pic`, `jewellery_bill_pic`, `purity_checked_by`, `client_occupation`, `name_hindi`, `father_name_hindi`, `address_hindi`, `city_hindi`, `state_hindi`) VALUES
(1, 1, 'jaipur Investor', '', '', '', '18498', 'investor', 1, '', '', 0, '', '', '', '', '24-10-2023 00:17:40', '', '', '', '', '', '', '', '', '', 13, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'जयपुर निवेशक', '', '', '', ''),
(2, 1, 'indore investor', '', '', '', '83201', 'investor', 1, '', '', 0, '', '', '', '', '24-10-2023 00:19:52', '', '', '', '', '', '', '', '', '', 13, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'इंदौर निवेशक', '', '', '', ''),
(3, 1, 'TANVI YADAV', '', 'TANVIYADAV 123@GAMIL.COM', 'TANVIYADAV 123@GAMIL.COM', '123456', 'employee', 1, '1234567891', '3216549871', 0, '', '', 'INDORE', 'MADHYA PRADESH', '24-10-2023 00:20:58', '2564355426321', '', '', '', '', 'ASHISH YADAV', '', '', '2000-09-17', 13, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'तन्वी यादव', 'आशीष यादव', '', 'इंदौर', 'मध्य प्रदेश'),
(4, 1, 'shubham gupta', '', 'admin', 'shubham@gmail.com', '123456', 'superadmin', 1, '9630083266', '', 0, 'test', 'choti gwal toli', 'indore', 'mp', '24-10-2023 00:22:26', '123456', '', '', '', '  j j xremark', '123456', '', '', '2023-09-07', 13, 'admin', '1698087145606238.webp', '1698087145872764.jpg', '1698087145186016.jpeg', NULL, NULL, '1698087145832919.jpg', '1698087145128872.png', 'hbhb', 'xsgvcg', 'शुभम गुप्ता', '123456', 'छोटी ग्वाल टोली', 'इंदौर', 'एमपी'),
(5, 3, 'shubham', '', 'shubham@gmail.com', 'shubham@gmail.com', '123456', 'admin', 1, '12345678', '', 0, '', 'geetabhawan', 'indore', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, '', '', '', '', 'शुभम', '', 'गीताभवन', 'इंदौर', ''),
(6, 4, 'prakh@gmail.com', '', 'prakh@gmail.com', 'prakh@gmail.com', '123456', 'admin', 1, '98765423211', '', 0, '', 'jaipur', 'jaipur', 'rajasthan', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, '', '', '', '', 'prakh@gmail.com', '', 'जयपुर', 'जयपुर', 'राजस्थान Rajasthan'),
(7, 4, 'AS', '', '', '', '60880', 'investor', 1, '', '', 0, '', '', '', '', '16-11-2023 19:04:10', '', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'जैसा', '', '', '', ''),
(8, 4, 'ANUBHAV VERMA ', '', '', '', '38606', 'client', 1, '8889996555', '', 0, '', '196, KALANI NAGAR SABJI  MANDI  ', 'INDORE ', 'MADHYA PRADESH ', '16-11-2023 19:10:27', '2323256223', '', '', '', '', 'PRADEEP VERMA ', '', '', '1999-01-04', 6, 'admin', '1700142027899312.jpeg', '1700227427205914.jpg', '1700142027381377.jpeg', NULL, NULL, '1700142027221695.jpeg', '', '', '', 'अनुभव वर्मा', 'प्रदीप वर्मा', '196, कालानी नगर सब्जी मंडी', 'इंदौर', 'मध्य प्रदेश'),
(9, 4, 'GSS ', '', '', '', '27467', 'investor', 1, '', '', 0, '', '', '', '', '16-11-2023 19:29:54', '', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'जीएसएस', '', '', '', ''),
(10, 4, 'RISHIKA AGRAWAL ', '', '', '', '96949', 'client', 1, '7898900448', '123456', 0, 'PRACHI AGRAWAL', 'KALANI NAGAR  INDORE ', 'INDORE ', 'MP ', '16-11-2023 19:33:31', '4565644123', '', '', '', '', 'PANKAJ AGRAWAL ', '', '', '2000-09-17', 6, 'admin', '', '1700143411343252.jpeg', '', NULL, NULL, '', '', '', '', 'ऋषिका अग्रवाल', 'पंकज अग्रवाल', 'कालानी नगर इंदौर', 'इंदौर', 'एमपी'),
(11, 4, 'ADITI VERMA ', '', '', '', '79604', 'client', 1, '7999831911', '3232323232', 0, 'ANUBHAV VERMA ', '196 KALANI NAGAR  ', 'INDORE ', 'madhya pradesh ', '16-11-2023 19:49:04', '34565655', '', '', '', '', 'ASHOK VERMA ', '', '', '1998-04-27', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'अदिति वर्मा', 'अशोक वर्मा', '196 कालानी नगर', 'इंदौर', 'मध्य प्रदेश'),
(12, 3, 'ABC', '', 'ABC@gmail.com', 'ABC@gmail.com', '40970', 'investor', 1, '', '', 0, '', '', '', '', '17-11-2023 11:28:34', '', '', '', '', '', '', '', '', '', 5, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'एबीसी', '', '', '', ''),
(13, 4, 'TANVI YADAV', '', 'TANVIYADAV 123@GAMIL.COM', 'TANVIYADAV 123@GAMIL.COM', '23690', 'client', 1, '8889996555', '9301522335', 0, '', '', 'INDORE', 'MADHYA PRADESH', '17-11-2023 15:17:11', '2564355426321', '', '', '', '', 'ASHISH YADAV', '', '', '', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'तन्वी यादव', 'आशीष यादव', '', 'इंदौर', 'मध्य प्रदेश'),
(14, 3, 'XYZ', '', 'XX', 'XX', '8427', 'investor', 1, '1234567890', '', 0, '', '', '', '', '18-11-2023 11:39:31', '123', '', '', '', '', '', '', '', '', 5, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'XYZ', '', '', '', ''),
(15, 4, 'vedant sharma', '', 'vs123@gmail.com', 'vs123@gmail.com', '47268', 'client', 1, '9258147963', '8527419634', 0, 'jyoti sharma (mother)', 'vyas nagar , chetan school ke pass me.', 'INDORE', 'MADHYA PRADESH', '18-11-2023 19:22:18', '256435542222', '', '', '', 'refered by self', 'chetan', '', '', '1990-07-30', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'वेदांत शर्मा', 'चेतन', 'व्यास नगर, चेतन स्कूल के पास मुझे।', 'इंदौर', 'मध्य प्रदेश'),
(16, 4, 'SHELLY SAHU', '', '', '', '41587', 'client', 1, '1234567891', '', 0, '', '', 'INDORE', 'MADHYA PRADESH', '21-11-2023 11:19:47', '2564355422189', '', '', '', '', 'RITESH', '', '', '2002-10-16', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'शैली साहू', 'रितेश', '', 'इंदौर', 'मध्य प्रदेश'),
(17, 3, 'test', '', 'test@gmail.com', 'test@gmail.com', '123456', 'client', 1, '9988776655', '123', 0, '', 'vaishali', 'jaipur', 'rajasthan', '21-11-2023 22:24:20', '1234567891234', '', '', '', '', 'testing', '', '', '1990-05-21', 5, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'परीक्षा', 'परिक्षण', 'वैशाली', 'जयपुर', 'राजस्थान Rajasthan'),
(18, 4, 'BHAWANA BODKHE', '', 'BODKHEBHAWANA2545@GMAIL.COM', 'BODKHEBHAWANA2545@GMAIL.COM', '49756', 'client', 1, '7894563251', '2587145555', 0, 'JOSHITA', '60 FEET ROAD (INDORE)', 'INDORE', 'MADHYA PRADESH', '22-11-2023 11:35:27', '25814736974', '', '', '', 'REFERENCE BY-- SELF ', 'RAO', '', '', '1976-10-26', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'भावना बोडखे', 'राव', '60 फीट रोड (इंदौर)', 'इंदौर', 'मध्य प्रदेश'),
(19, 4, 'SNEH SUMAN ', '', '', '', '23316', 'client', 1, '9111133111', '', 0, 'SANJANA SUMAN ', 'CHOURASIYA NAGAR INDORE ', 'INDORE ', 'MADHYA PRADESH ', '22-11-2023 12:13:37', '56598953563', '', '', '', '', 'AJAY SUMAN ', '', '', '1996-01-01', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'स्नेह सुमन', 'अजय सुमन', 'चौरसिया नगर इंदौर', 'इंदौर', 'मध्य प्रदेश'),
(20, 4, 'MINAKSHI AGRAWAL', '', '', '', '56713', 'client', 1, '8889996555', '', 0, 'RISHIKA AGRAWAL', 'VIJAY SHREE NAGAR', 'BHOPAL', 'MADHYA PRADESH', '23-11-2023 11:55:16', '47859654123', '', '', '', 'REFERED BY RISHIKA AGRAWAL', 'PANKAJ', '', '', '2022-11-11', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'मिनाक्षी अग्रवाल', 'पंकज', 'विजय श्री नगर', 'भोपाल', 'मध्य प्रदेश'),
(21, 4, 'PRADEEP VERMA ', '', '', '', '21724', 'client', 1, '9301522335', '7999831911', 0, '', '196 KALANI NAGAR SABJI MANDI ', 'INDORE ', 'MADHYA PRADESH ', '23-11-2023 13:35:04', '123456789', '', '', '', '', 'MANSUKH LAL VERMA ', '', '', '1960-01-11', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'प्रदीप वर्मा', 'मनसुख लाल वर्मा', '196 कालानी नगर सब्जी मंडी', 'इंदौर', 'मध्य प्रदेश'),
(22, 4, 'AJAY SUMAN ', '', '', '', '18075', 'client', 1, '9111133111', '', 0, '', '', '', '', '24-11-2023 14:35:57', '', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'अजय सुमन', '', '', '', ''),
(23, 4, 'RISHIKA AGRAWAL ', '', '', '', '98225', 'client', 1, '8889996444', '12', 0, '', '', '', '', '24-11-2023 14:36:32', '', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'ऋषिका अग्रवाल', '', '', '', ''),
(24, 4, 'TANVI YADAV', '', 'UYFA2545@GMAIL.COM', 'UYFA2545@GMAIL.COM', '8730034', 'client', 1, '7456858937', '', 0, '', '', '', '', '24-11-2023 16:28:58', '25643554000001', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'तन्वी यादव', '', '', '', ''),
(25, 4, 'TANVI YADAV', '', 'UYFA2545@GMAIL.COM', 'UYFA2545@GMAIL.COM', '49413', 'client', 1, '7456858937', '5498645682', 0, 'RISHIKA AGRAWAL', '', 'BHOPAL', 'MADHYA PRADESH', '24-11-2023 16:28:58', '25643554000001', '', '', '', '', 'RITESH', '', '', '2023-01-01', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'तन्वी यादव', 'रितेश', '', 'भोपाल', 'मध्य प्रदेश'),
(26, 4, 'ARUNA  CHOUHAN', '', 'CHOUHANARUNA154@GMAIL.COM', 'CHOUHANARUNA154@GMAIL.COM', '4574', 'client', 1, '8770633585', '9575038297', 0, 'FATHER (   ABHISHEK)', 'GANJIPUR ROAD', 'JABALPUR', 'MADHYA PRADESH', '24-11-2023 16:59:58', '456478942514', '', '', '', 'REFERENCE--- VEDANT SHUKLA', 'ABHISHEK', '', '', '1985-11-11', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'अरुणा चौहान', 'अभिषेक', 'गंजीपुर रोड', 'जबलपुर', 'मध्य प्रदेश'),
(27, 3, 'ram kumar saini', '', 'ram@gmail.com', 'ram@gmail.com', '123456', 'client', 1, '9660123456', '6350111111', 0, 'll', 'plot no 12, vaishali nagar, jaipur', 'jaipur', 'Rajasthan', '24-11-2023 20:05:51', '123465789123', '', '', '', 'testing data hai ye ', 'radheshayam saini', '', '', '1993-07-10', 5, 'admin', '', '1702053458280543.jpg', '', NULL, NULL, '', '', '', 'dfa', 'राम कुमार सैनी', 'राधेशयाम सैनी', 'प्लॉट नंबर 12, वैशाली नगर, जयपुर', 'जयपुर', 'राजस्थान Rajasthan'),
(28, 4, 'SNEHA AGRAWAL', '', 'SNEHA4561@GAMIL.COM', 'SNEHA4561@GAMIL.COM', '68255', 'client', 1, '8817065845', '', 0, 'DHEERAJ AGRAWAL', '22, AMBIKAPURI MAIN', 'INDORE', 'MADHYA PRADESH', '29-11-2023 12:54:11', '857496123123', '', '', '', 'REFERED BY RISHIKA AGRAWAL', 'DHEERAJ', '', '', '2004-04-15', 6, 'admin', '', '', '', NULL, NULL, '', '', '', 'STUDENT', 'स्नेहा अग्रवाल', 'धीरज', '22, अंबिकापुरी मुख्य', 'इंदौर', 'मध्य प्रदेश'),
(29, 4, 'SNEHA AGRAWAL', '', 'SNEHA4561@GAMIL.COM', 'SNEHA4561@GAMIL.COM', '20014', 'client', 1, '8817065845', '', 0, 'DHEERAJ AGRAWAL', '22, AMBIKAPURI MAIN', 'INDORE', 'MADHYA PRADESH', '29-11-2023 12:54:16', '857496123123', '', '', '', 'REFERED BY RISHIKA AGRAWAL', 'DHEERAJ', '', '', '2004-04-15', 6, 'admin', '', '', '', NULL, NULL, '', '', '', 'STUDENT', 'स्नेहा अग्रवाल', 'धीरज', '22, अंबिकापुरी मुख्य', 'इंदौर', 'मध्य प्रदेश'),
(30, 4, 'DEEPALI SAINI', '', 'DEEPALISAINI0280@GMAIL.COM', 'DEEPALISAINI0280@GMAIL.COM', '95551', 'client', 1, '7974248488', '7828854425', 0, 'BABITA SAINI', 'NAGIN NAGAR 83/B', 'INDORE', 'MADHYA PRADESH', '30-11-2023 12:19:59', '456478942514', '', '', '', 'SELF (REFERENCE)', 'VINOD', '', '', '2003-12-11', 6, 'admin', '1701326996793780.jpeg', '', '1701327133172832.jpeg', NULL, NULL, '1701327133781445.jpeg', '', '', 'STUDENT', 'दीपाली सैनी', 'विनोद', 'नागिन नगर 83/बी', 'इंदौर', 'मध्य प्रदेश'),
(31, 4, 'SANJAY CHOUHAN', '', '', '', '80363', 'client', 1, '9977114455', '', 0, 'AJAY CHOUHAN ', '88,LAKSHMI NAGAR ', 'INDORE ', 'MADHYA PRADESH', '01-12-2023 16:11:37', '123456', '', '', '', '', 'AJAY CHOUHAN ', '', '', '1980-01-01', 6, 'admin', '', '', '', NULL, NULL, '', '', '', 'BUSINESS ', 'संजय चौहान', 'अजय चौहान', '88, लक्ष्मी नगर', 'इंदौर', 'मध्य प्रदेश'),
(32, 4, 'NARAYAN YADAV ', '', '', '', '67125', 'client', 1, '9754814646', '7828854425', 0, 'BABULAL YADAV ', '46 PARIHAR COLONY ', 'INDORE', 'MADHYA PRADESH', '01-12-2023 16:23:45', '123456', '', '', '', '', 'BABULAL YADAV ', '', '', '1985-12-01', 6, 'admin', '', '', '', NULL, NULL, '', '', '', 'DRIVER ', 'नारायण यादव', 'बाबूलाल यादव', '46 परिहार कॉलोनी', 'इंदौर', 'मध्य प्रदेश'),
(33, 4, 'MOHMMAD IKRAM ', '', '', '', ' ', 'client', 1, '9907354713', '', 0, 'ABRAR ', '346, SECTOR S NANDAN NAGAR ', 'INDORE ', 'MADHYA PRADESH', '01-12-2023 16:29:38', '12345678', '', '', '', '', 'ABRAR ', '', '', '1970-01-01', 6, 'admin', '', '', '', NULL, NULL, '', '', '', 'CONSTRUCTION', 'मोहम्मद इकराम', 'अबरार', '346, सेक्टर एस नंदन नगर', 'इंदौर', 'मध्य प्रदेश'),
(34, 4, 'DEEPALI PRAJAPAT ', '', '', '', '95087', 'client', 1, '8889996555', '123456', 0, '', '', '', '', '01-12-2023 16:56:38', '', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'दीपाली प्रजापत', '', '', '', ''),
(35, 4, 'shubham gupta', '', '', '', '57167', 'client', 1, '', '4e234', 0, '', '', '', '', '01-12-2023 17:44:56', '', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'शुभम गुप्ता', '', '', '', ''),
(36, 4, 'test ', '', '', '', '2210', 'client', 1, '', '', 0, '', '', '', '', '01-12-2023 17:59:19', '', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'परीक्षा', '', '', '', ''),
(37, 4, 'DLKJSDS', '', '', '', '24834', 'client', 1, '8889996555', '8889996888', 0, 'LKKS', 'SSSSADASAS', '', 'MAD', '01-12-2023 20:32:26', '123456', '', '', '', '', 'KSKJS', '', '', '1980-11-02', 6, 'admin', '', '', '', NULL, NULL, '', '', '', 'BUSINESS ', 'डीएलकेजेएसडीएस', 'केएसकेजेएस', 'ssssadasas', '', 'पागल'),
(38, 4, 'radhe thakur', '', 'radhethakur123@gmail.com', 'radhethakur123@gmail.com', '16169', 'client', 1, '', '', 0, '', '', '', '', '04-12-2023 13:39:52', '852', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'राधे ठाकुर', '', '', '', ''),
(39, 4, 'radhe thakur', '', 'radhethakur123@gmail.com', 'radhethakur123@gmail.com', '11501', 'client', 1, '', '', 0, '', '', '', '', '04-12-2023 13:39:55', '852', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'राधे ठाकुर', '', '', '', ''),
(40, 4, 'radhe thakur', '', 'radhethakur123@gmail.com', 'radhethakur123@gmail.com', '60743', 'client', 1, '', '', 0, '', '', '', '', '04-12-2023 13:39:58', '852', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'राधे ठाकुर', '', '', '', ''),
(41, 4, 'radhe thakur', '', 'radhethakur123@gmail.com', 'radhethakur123@gmail.com', '28856', 'client', 1, '', '', 0, '', '', '', '', '04-12-2023 13:40:00', '852', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'राधे ठाकुर', '', '', '', ''),
(42, 4, 'radhe thakur', '', 'radhethakur123@gmail.com', 'radhethakur123@gmail.com', '45135', 'client', 1, '', '', 0, '', '', '', '', '04-12-2023 13:40:03', '852', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'राधे ठाकुर', '', '', '', ''),
(43, 4, 'radhe thakur 14', '', 'radhethakur123@gmail.com', 'radhethakur123@gmail.com', '12754', 'client', 1, '6261452525', '963852741', 0, 'dhansingh ', '1247  , GOMTESH CITY (ARIHANT NAGAR)', 'indore', 'mp', '04-12-2023 13:40:05', '852741963374', '', '', '', 'SELF (  RAKAM KHAREEDNA NHI HE)', 'dhansingh', '', '', '1998-01-04', 6, 'admin', '1701678561677266.jpeg', '', '1701678561492927.jpeg', NULL, NULL, '1701678561913132.jpeg', '', '', 'property', 'राधे ठाकुर 14', 'धनसिंह', '1247, गोमटेश सिटी (अरिहंत नगर)', 'इंदौर', 'एमपी'),
(44, 4, 'RISHIKA ', '', '', '', '88831', 'employee', 1, '', '', 0, '', '', '', '', '04-12-2023 15:38:44', '', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'रिषिका', '', '', '', ''),
(45, 4, 'VEDANT SHARMA ', '', '', '', '18080', 'client', 1, '', '', 0, '', '', '', '', '04-12-2023 19:17:33', '', '', '', '', '', '', '', '', '', 6, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'वेदांत शर्मा', '', '', '', ''),
(46, 4, 'VEDANT SHARMA ', '', 'vs123@gmail.com', 'vs123@gmail.com', '41523', 'client', 1, '8770633585', '7828854425', 0, 'chetan JI ', '66.VYAS  NAGAR ', 'INDORE', 'MADHYA PRADESH', '04-12-2023 19:17:35', '456478942514', '', '', '', '', 'chetan JI ', '', '', '2001-02-01', 6, 'admin', '1701705039268714.jpeg', '', '1701705039520947.jpeg', NULL, NULL, '', '', '', 'WORK ON JEWELLERY SHOP ', 'वेदांत शर्मा', 'चेतन जी', '66.व्यास नगर', 'इंदौर', 'मध्य प्रदेश'),
(47, 4, 'RUPALI INGLE', '', '', '', '66360', 'client', 1, '124673.3468', '1597538520', 0, 'ROSHAN INGLE', '60 FEET ROAD', 'INDORE', 'MP', '04-12-2023 21:01:46', '123456987123', '', '', '', '', 'ROSHAN', '', '', '2000-01-01', 6, 'admin', '', '', '', NULL, NULL, '', '', '', 'SILAI', 'रूपाली इंगले', 'रोशन', '60 फीट रोड', 'इंदौर', 'एमपी'),
(48, 4, 'HUSSAIN ', '', '', '', '21863', 'client', 1, '', '', 0, '', '', '', '', '06-12-2023 18:07:34', '', '', '', '', '', '', '', '', '', 6, 'admin', '', '1701866252694643.jpg', '1701866252951001.jpg', NULL, NULL, '', '', '', '', 'हुसैन', '', '', '', ''),
(49, 3, 'mukesh', '', 'mukesh@gmail.com', 'mukesh@gmail.com', '123456', 'employee', 1, '453', '5', 0, '4765', '456', '456', '456', '08-12-2023 21:35:01', '34123433', '', '', '', '465', '565', '', '', '0064-05-04', 5, 'admin', '', '', '', NULL, NULL, '', '', '', '', 'मुकेश', '565', '456', '456', '456'),
(50, 3, 'dfadfasdf', '', 'dsfaasdfasdfasd', 'dsfaasdfasdfasd', 'sdfasdfas', 'client', 1, 'dfasd', 'dfasdfa', 0, 'asdfasd', 'asdfasd', 'sdfasdfa', 'sdfas', '08-12-2023 21:59:11', 'fasdfasdfas', '', '', '', 'fasdfasd', 'sdfa', '', '', '275760-03-31', 5, 'admin', '1702052948246377.jpg', '1702052948469739.jpg', '', '1702052948485564.jpg', '1702053043429614.jpg', '1702052948280534.jpg', '', 'fasdf', 'fasdf', 'dfadfasdf', 'sdfa', 'asdfasd', 'sdfasdfa', 'sdfas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amount_tbl`
--
ALTER TABLE `amount_tbl`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `narration_tbl`
--
ALTER TABLE `narration_tbl`
  ADD PRIMARY KEY (`narration_id`);

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
-- AUTO_INCREMENT for table `amount_tbl`
--
ALTER TABLE `amount_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `assign_investor_list`
--
ALTER TABLE `assign_investor_list`
  MODIFY `assign_investor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_list`
--
ALTER TABLE `item_list`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `narration_tbl`
--
ALTER TABLE `narration_tbl`
  MODIFY `narration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_item_list`
--
ALTER TABLE `order_item_list`
  MODIFY `order_item_list_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `store_tbl`
--
ALTER TABLE `store_tbl`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaction_log`
--
ALTER TABLE `transaction_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
