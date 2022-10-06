-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2021 at 11:35 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wms`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocation_plan`
--

CREATE TABLE `allocation_plan` (
  `plan_id` varchar(20) NOT NULL,
  `customer_id` varchar(20) DEFAULT NULL,
  `material_id` varchar(20) DEFAULT NULL,
  `wh_tujuan` varchar(20) DEFAULT NULL,
  `plan_date` date DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `plan_qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allocation_plan`
--

INSERT INTO `allocation_plan` (`plan_id`, `customer_id`, `material_id`, `wh_tujuan`, `plan_date`, `create_by`, `create_date`, `update_by`, `update_date`, `status`, `plan_qty`) VALUES
('PLN2100001', 'CUS2100001', 'MTR2100001', 'WHS2100001', '2021-05-31', 'NINDY OKTA NOVIANTI', '2021-05-04 14:08:47', NULL, NULL, 1, 200);

-- --------------------------------------------------------

--
-- Table structure for table `area_blok`
--

CREATE TABLE `area_blok` (
  `blok_id` varchar(20) NOT NULL,
  `wh_area_id` varchar(20) DEFAULT NULL,
  `blok_name` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `blok_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area_blok`
--

INSERT INTO `area_blok` (`blok_id`, `wh_area_id`, `blok_name`, `status`, `create_by`, `create_date`, `update_by`, `update_date`, `blok_code`) VALUES
('WHB2100001', 'WHA2100001', 'Blok 01', 1, 'NINDY OKTA NOVIANTI', '2021-04-15 13:50:23', 'NINDY OKTA NOVIANTI', '2021-04-18 13:35:05', 'B001');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` varchar(20) NOT NULL,
  `customer_extid` varchar(20) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_cluster` varchar(20) DEFAULT NULL,
  `customer_area` varchar(20) DEFAULT NULL,
  `customer_city` varchar(20) DEFAULT NULL,
  `customer_pic` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(16) DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` year(4) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `customer_email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_extid`, `customer_name`, `customer_cluster`, `customer_area`, `customer_city`, `customer_pic`, `customer_phone`, `customer_address`, `status`, `create_by`, `create_date`, `update_by`, `update_date`, `customer_email`) VALUES
('CUS2100001', NULL, 'PT Jaya Baru 1', NULL, 'O1808000002', '3275', 'Amelia Citra', '084642544434', 'Jalan Raya Bekasi no. 8', 1, 'NINDY OKTA NOVIANTI', '2021-04-14 07:45:37', 0000, '2021-04-14 09:01:28', 'amelia@test.co.id'),
('CUS2100002', NULL, 'PT Berkah', NULL, 'O1808000002', '3275', 'Karina', '084642544434', 'Jl. Raya bekasi', 0, 'NINDY OKTA NOVIANTI', '2021-05-17 11:46:47', NULL, NULL, 'karina@test.co.id');

-- --------------------------------------------------------

--
-- Table structure for table `inbound`
--

CREATE TABLE `inbound` (
  `inbound_id` varchar(20) NOT NULL,
  `inbound_location` varchar(20) DEFAULT NULL,
  `inbound_doc` varchar(50) DEFAULT NULL,
  `inbound_po` varchar(50) DEFAULT NULL,
  `inbound_doc_date` varchar(20) DEFAULT NULL,
  `inbound_rcv_date` datetime DEFAULT NULL,
  `inbound_rcv_by` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `inbound_extdid` varchar(20) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `inbound_type` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inbound`
--

INSERT INTO `inbound` (`inbound_id`, `inbound_location`, `inbound_doc`, `inbound_po`, `inbound_doc_date`, `inbound_rcv_date`, `inbound_rcv_by`, `status`, `inbound_extdid`, `create_by`, `create_date`, `update_by`, `update_date`, `inbound_type`, `description`) VALUES
('INB2100001', 'WHS2100001', 'AA1234', 'PO2100001', '2021-05-14', '2021-05-14 15:47:32', 'nindy', 3, NULL, 'NINDY OKTA NOVIANTI', '2021-05-14 15:12:24', 'NINDY OKTA NOVIANTI', '2021-05-14 15:48:08', 'TY001', 'tes'),
('INB2100002', 'WHS2100001', 'AA12345', 'PO2100002', '2021-05-14', '2021-05-14 16:14:13', 'nindy', 2, NULL, 'NINDY OKTA NOVIANTI', '2021-05-14 15:15:22', 'NINDY OKTA NOVIANTI', '2021-05-14 16:14:36', 'TY001', 'tes'),
('INB2100003', 'WHS2100001', 'AA123', 'PO2100003', '2021-05-24', '2021-05-24 14:09:03', 'nindy', 2, NULL, 'NINDY OKTA NOVIANTI', '2021-05-24 14:08:43', 'NINDY OKTA NOVIANTI', '2021-05-24 14:10:02', 'TY001', 'tes'),
('INB2100004', 'WHS2100001', 'AA123', 'PO2100004', '2021-05-24', '2021-05-24 15:14:45', 'rizky', 2, NULL, 'NINDY OKTA NOVIANTI', '2021-05-24 15:14:14', 'NINDY OKTA NOVIANTI', '2021-05-24 15:23:19', 'TY001', 'tes'),
('INB2100005', 'WHS2100001', 'AA12345', 'PO2100005', '2021-05-24', NULL, NULL, 1, NULL, 'NINDY OKTA NOVIANTI', '2021-05-24 16:05:00', NULL, NULL, 'TY001', 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `inbound_detail`
--

CREATE TABLE `inbound_detail` (
  `det_inbound_id` varchar(20) NOT NULL,
  `inbound_id` varchar(20) DEFAULT NULL,
  `po_detail_id` varchar(20) DEFAULT NULL,
  `qty_good_in` int(11) DEFAULT NULL,
  `qty_notgood_in` int(11) DEFAULT NULL,
  `qty_lebih` int(11) DEFAULT NULL,
  `koli` int(11) DEFAULT NULL,
  `idx_po` int(11) DEFAULT NULL,
  `idx` int(11) DEFAULT NULL,
  `cek` int(11) DEFAULT NULL,
  `inbound_weight` double DEFAULT NULL,
  `inbound_length` double DEFAULT NULL,
  `inbound_height` double DEFAULT NULL,
  `inbound_width` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `qty_realization` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inbound_detail`
--

INSERT INTO `inbound_detail` (`det_inbound_id`, `inbound_id`, `po_detail_id`, `qty_good_in`, `qty_notgood_in`, `qty_lebih`, `koli`, `idx_po`, `idx`, `cek`, `inbound_weight`, `inbound_length`, `inbound_height`, `inbound_width`, `status`, `qty_realization`) VALUES
('IBD2100001', 'INB2100001', 'POD2100001', 10, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 3, 10),
('IBD2100002', 'INB2100002', 'POD2100003', 100, 100, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 2, 200),
('IBD2100003', 'INB2100003', 'POD2100004', 100, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 2, 100),
('IBD2100004', 'INB2100003', 'POD2100005', 100, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 3, 100),
('IBD2100005', 'INB2100004', 'POD2100007', 10, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 2, 10),
('IBD2100006', 'INB2100004', 'POD2100006', 100, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 3, 100),
('IBD2100007', 'INB2100005', 'POD2100008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `jenis_id` int(11) NOT NULL,
  `jenis_name` varchar(100) DEFAULT NULL,
  `jenis_status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`jenis_id`, `jenis_name`, `jenis_status`) VALUES
(1, 'Makanan', 1),
(2, 'Non Makanan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `material_id` varchar(20) NOT NULL,
  `material_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `mat_group_id` int(11) DEFAULT NULL,
  `mat_uom` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `create_by` varchar(10) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` varchar(10) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `material_code` varchar(50) DEFAULT NULL,
  `material_weight` double DEFAULT NULL,
  `material_height` double DEFAULT NULL,
  `material_length` double DEFAULT NULL,
  `material_width` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`material_id`, `material_name`, `description`, `mat_group_id`, `mat_uom`, `status`, `create_by`, `create_date`, `update_by`, `update_date`, `material_code`, `material_weight`, `material_height`, `material_length`, `material_width`) VALUES
('MTR2100001', 'Gulaku', 'afagsfhs', 2, 1, 1, 'NINDY OKTA', '2021-04-14 15:08:12', 'NINDY OKTA', '2021-04-14 15:23:19', 'MTR001', NULL, NULL, NULL, NULL),
('MTR2100002', 'Beras Merah', 'beras merah', 1, 1, 1, NULL, '2021-04-20 08:36:34', NULL, '2021-04-20 08:39:44', 'MTR002', 7, 50, 30, 5),
('MTR2100003', 'Aqua 600 ml', 'Aqua Botol 600 ml', 6, 3, 1, 'NINDY OKTA', '2021-05-24 14:56:01', NULL, NULL, 'A01', 600, 25, 5, 12);

-- --------------------------------------------------------

--
-- Table structure for table `material_detail`
--

CREATE TABLE `material_detail` (
  `mat_detail_id` varchar(20) NOT NULL,
  `owner_id` varchar(20) DEFAULT NULL,
  `material_id` varchar(20) DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `batch_no` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `create_by` varchar(20) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` varchar(20) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material_detail`
--

INSERT INTO `material_detail` (`mat_detail_id`, `owner_id`, `material_id`, `expired_date`, `batch_no`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
('MTD2100001', 'OWN2100001', 'MTR2100001', '2023-07-05', '123456', 1, 'NINDY OKTA NOVIANTI', '2021-05-14 15:48:08', NULL, NULL),
('MTD2100002', 'OWN2100001', 'MTR2100001', '2025-07-10', '1234567', 1, 'NINDY OKTA NOVIANTI', '2021-05-14 16:14:36', NULL, NULL),
('MTD2100003', 'OWN2100001', 'MTR2100001', '2025-02-05', '1151', 1, 'NINDY OKTA NOVIANTI', '2021-05-24 14:10:02', NULL, NULL),
('MTD2100004', 'OWN2100001', 'MTR2100002', '2025-02-04', '1152', 1, 'NINDY OKTA NOVIANTI', '2021-05-24 14:10:02', NULL, NULL),
('MTD2100005', 'OWN2100001', 'MTR2100002', '2023-05-17', '1', 1, 'NINDY OKTA NOVIANTI', '2021-05-24 15:23:19', NULL, NULL),
('MTD2100006', 'OWN2100001', 'MTR2100003', '2025-02-05', '1', 1, 'NINDY OKTA NOVIANTI', '2021-05-24 15:23:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `material_group`
--

CREATE TABLE `material_group` (
  `mat_group_id` int(11) NOT NULL,
  `jenis_id` int(11) DEFAULT NULL,
  `mat_group_name` varchar(150) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material_group`
--

INSERT INTO `material_group` (`mat_group_id`, `jenis_id`, `mat_group_name`, `status`) VALUES
(1, 1, 'Beras', 1),
(2, 1, 'Gula', 1),
(3, 1, 'Tepung', 1),
(4, 2, 'Sabun', 1),
(5, 2, 'Shampoo', 1),
(6, 1, 'Air Mineral', 1);

-- --------------------------------------------------------

--
-- Table structure for table `material_location`
--

CREATE TABLE `material_location` (
  `location_id` varchar(20) NOT NULL,
  `material_detail_id` varchar(20) DEFAULT NULL,
  `shelf_id` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material_location`
--

INSERT INTO `material_location` (`location_id`, `material_detail_id`, `shelf_id`, `qty`, `status`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES
('LOC2100001', 'MTD2100001', 'SLF2100001', 0, 1, 'NINDY OKTA NOVIANTI', '2021-05-14 16:07:50', NULL, NULL),
('LOC2100002', 'MTD2100002', 'SLF2100002', 50, 1, 'NINDY OKTA NOVIANTI', '2021-05-12 08:48:59', NULL, NULL),
('LOC2100003', 'MTD2100002', 'SLF2100001', 40, 1, 'NINDY OKTA NOVIANTI', '2021-05-13 09:48:31', NULL, NULL),
('LOC2100004', 'MTD2100004', 'SLF2100001', 100, 1, 'NINDY OKTA NOVIANTI', '2021-05-24 14:11:47', NULL, NULL),
('LOC2100005', 'MTD2100006', 'SLF2100001', 100, 1, 'NINDY OKTA NOVIANTI', '2021-05-24 15:34:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `outbound`
--

CREATE TABLE `outbound` (
  `outbound_id` varchar(20) NOT NULL,
  `outbound_type` varchar(20) DEFAULT NULL,
  `penerima` varchar(20) DEFAULT NULL,
  `outbound_doc` varchar(100) DEFAULT NULL,
  `outbound_extid` varchar(20) DEFAULT NULL,
  `outbound_doc_date` date DEFAULT NULL,
  `outbound_wh_asal` varchar(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `out_date` date DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outbound`
--

INSERT INTO `outbound` (`outbound_id`, `outbound_type`, `penerima`, `outbound_doc`, `outbound_extid`, `outbound_doc_date`, `outbound_wh_asal`, `status`, `out_date`, `create_date`, `create_by`, `update_date`, `update_by`, `description`) VALUES
('OTB2100001', 'TY003', 'CUS2100001', 'AA1234', NULL, '2021-05-21', 'WHS2100001', 2, '2021-05-25', '2021-05-21 15:30:16', 'NINDY OKTA NOVIANTI', NULL, NULL, 'tes'),
('OTB2100002', 'TY003', 'CUS2100001', 'AA123', NULL, '2021-05-24', 'WHS2100001', 1, '2021-05-27', '2021-05-24 11:18:11', 'NINDY OKTA NOVIANTI', NULL, NULL, 'tes'),
('OTB2100003', 'TY003', 'CUS2100001', 'AA12345', NULL, '2021-05-24', 'WHS2100001', 1, '2021-05-28', '2021-05-24 16:19:04', 'NINDY OKTA NOVIANTI', NULL, NULL, 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `outbound_detail`
--

CREATE TABLE `outbound_detail` (
  `det_outbound_id` varchar(20) NOT NULL,
  `material_detail_id` varchar(20) DEFAULT NULL,
  `outbound_qty` int(11) DEFAULT NULL,
  `koli` int(11) DEFAULT NULL,
  `cek` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `outbound_id` varchar(20) DEFAULT NULL,
  `qty_realization` int(11) DEFAULT NULL,
  `location_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outbound_detail`
--

INSERT INTO `outbound_detail` (`det_outbound_id`, `material_detail_id`, `outbound_qty`, `koli`, `cek`, `status`, `outbound_id`, `qty_realization`, `location_id`) VALUES
('OBD2100001', 'MTD2100001', 15, NULL, 1, 2, 'OTB2100001', 15, 'LOC2100001'),
('OBD2100002', 'MTD2100002', 10, NULL, 1, 2, 'OTB2100001', 10, 'LOC2100003'),
('OBD2100003', 'MTD2100002', 20, NULL, NULL, 1, 'OTB2100002', NULL, 'LOC2100003'),
('OBD2100004', 'MTD2100002', 20, NULL, NULL, 1, 'OTB2100002', NULL, 'LOC2100002'),
('OBD2100005', 'MTD2100002', 40, NULL, NULL, 1, 'OTB2100003', NULL, 'LOC2100003'),
('OBD2100006', 'MTD2100006', 100, NULL, NULL, 1, 'OTB2100003', NULL, 'LOC2100005');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `owners_id` varchar(20) NOT NULL,
  `owners_extid` varchar(20) DEFAULT NULL,
  `owners_name` varchar(255) NOT NULL,
  `owners_status` tinyint(4) NOT NULL,
  `create_date` datetime NOT NULL,
  `create_by` varchar(100) NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`owners_id`, `owners_extid`, `owners_name`, `owners_status`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
('OWN2100001', NULL, 'Nindy Okta', 1, '2021-04-12 14:29:26', 'NINDY OKTA', '2021-04-28 09:05:45', 'NINDY OKTA NOVIANTI');

-- --------------------------------------------------------

--
-- Table structure for table `po_detail`
--

CREATE TABLE `po_detail` (
  `po_detail_id` varchar(20) NOT NULL,
  `po_id` varchar(20) DEFAULT NULL,
  `material_id` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `koli` int(11) DEFAULT NULL,
  `po_weight` double DEFAULT NULL,
  `po_length` double DEFAULT NULL,
  `po_height` double DEFAULT NULL,
  `po_width` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_detail`
--

INSERT INTO `po_detail` (`po_detail_id`, `po_id`, `material_id`, `qty`, `koli`, `po_weight`, `po_length`, `po_height`, `po_width`, `status`) VALUES
('POD2100001', 'PO2100001', 'MTR2100001', 10, NULL, NULL, NULL, NULL, NULL, 2),
('POD2100002', 'PO2100001', 'MTR2100002', 10, NULL, NULL, NULL, NULL, NULL, 2),
('POD2100003', 'PO2100002', 'MTR2100001', 100, NULL, NULL, NULL, NULL, NULL, 2),
('POD2100004', 'PO2100003', 'MTR2100001', 100, NULL, NULL, NULL, NULL, NULL, 2),
('POD2100005', 'PO2100003', 'MTR2100002', 100, NULL, NULL, NULL, NULL, NULL, 2),
('POD2100006', 'PO2100004', 'MTR2100003', 100, NULL, NULL, NULL, NULL, NULL, 2),
('POD2100007', 'PO2100004', 'MTR2100002', 10, NULL, NULL, NULL, NULL, NULL, 2),
('POD2100008', 'PO2100005', 'MTR2100003', 100, NULL, NULL, NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `po_id` varchar(20) NOT NULL,
  `po_number` varchar(50) DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `po_status` tinyint(4) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `supplier_id` varchar(20) DEFAULT NULL,
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`po_id`, `po_number`, `po_date`, `po_status`, `description`, `create_by`, `create_date`, `update_by`, `update_date`, `supplier_id`, `due_date`) VALUES
('PO2100001', '1234345AA', '2021-04-20', 3, 'test', 'NINDY OKTA NOVIANTI', '2021-04-20 13:26:38', NULL, NULL, 'SUP2100001', '2021-04-30'),
('PO2100002', '1234345AB', '2021-04-21', 3, 'dfsgsg', 'NINDY OKTA NOVIANTI', '2021-04-21 13:13:21', NULL, NULL, 'SUP2100001', '2021-04-30'),
('PO2100003', '1234345AC', '2021-05-04', 3, 'tes', 'NINDY OKTA NOVIANTI', '2021-05-04 14:48:42', NULL, NULL, 'SUP2100001', '2021-05-21'),
('PO2100004', '1234345AB', '2021-05-24', 3, 'tes', 'NINDY OKTA NOVIANTI', '2021-05-24 15:07:45', NULL, NULL, 'SUP2100001', '2021-05-12'),
('PO2100005', '1234345AA', '2021-05-24', 3, 'tes', 'NINDY OKTA NOVIANTI', '2021-05-24 16:03:07', NULL, NULL, 'SUP2100001', '2021-05-27');

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `rak_id` varchar(20) NOT NULL,
  `blok_id` varchar(20) DEFAULT NULL,
  `rak_name` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `rak_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`rak_id`, `blok_id`, `rak_name`, `status`, `create_by`, `create_date`, `update_by`, `update_date`, `rak_code`) VALUES
('RCK2100001', 'WHB2100001', 'Rack 01', 1, 'NINDY OKTA NOVIANTI', '2021-04-16 08:55:56', 'NINDY OKTA NOVIANTI', '2021-04-18 13:42:04', 'R001');

-- --------------------------------------------------------

--
-- Table structure for table `shelf`
--

CREATE TABLE `shelf` (
  `shelf_id` varchar(20) NOT NULL,
  `rak_id` varchar(20) DEFAULT NULL,
  `shelf_name` varchar(50) DEFAULT NULL,
  `shelf_max` int(11) DEFAULT NULL,
  `shelf_availability` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `shelf_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shelf`
--

INSERT INTO `shelf` (`shelf_id`, `rak_id`, `shelf_name`, `shelf_max`, `shelf_availability`, `status`, `create_by`, `create_date`, `update_by`, `update_date`, `shelf_code`) VALUES
('SLF2100001', 'RCK2100001', 'Shelf 1', 50, NULL, 1, 'NINDY OKTA NOVIANTI', '2021-04-16 11:33:20', NULL, NULL, 'S01'),
('SLF2100002', 'RCK2100001', 'Shelf 02', 100, NULL, 0, 'NINDY OKTA NOVIANTI', '2021-04-18 14:47:51', 'NINDY OKTA NOVIANTI', '2021-04-18 14:51:47', 'S002');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` varchar(20) NOT NULL,
  `supplier_extid` varchar(20) DEFAULT NULL,
  `supplier_name` varchar(255) DEFAULT NULL,
  `supplier_address` text DEFAULT NULL,
  `supplier_city` varchar(20) DEFAULT NULL,
  `supplier_pic` varchar(100) DEFAULT NULL,
  `supplier_phone` varchar(16) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `supplier_email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_extid`, `supplier_name`, `supplier_address`, `supplier_city`, `supplier_pic`, `supplier_phone`, `status`, `create_by`, `create_date`, `update_by`, `update_date`, `supplier_email`) VALUES
('SUP2100001', NULL, 'PT Burung Merak 2', 'Jalan Raya Madiun-Ponorogo', '3577', 'Nindy Okta', '085693391737', 1, 'NINDY OKTA NOVIANTI', '2021-04-13 11:49:49', 'NINDY OKTA NOVIANTI', '2021-04-16 14:18:26', 'nindyoktaa10@gmail.com'),
('SUP2100002', NULL, 'PT Karunia', 'Jl. Raya', '3671', 'Kayla', '084642544434', 0, 'NINDY OKTA NOVIANTI', '2021-05-17 08:21:45', 'NINDY OKTA NOVIANTI', '2021-05-17 08:22:03', 'kayla@test.co.id');

-- --------------------------------------------------------

--
-- Table structure for table `trans_type`
--

CREATE TABLE `trans_type` (
  `trans_type_id` varchar(20) NOT NULL,
  `trans_type_name` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trans_type`
--

INSERT INTO `trans_type` (`trans_type_id`, `trans_type_name`, `status`) VALUES
('TY001', 'Beli', 1),
('TY002', 'Pinjam', 1),
('TY003', 'Jual', 2);

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE `uom` (
  `uom_id` int(11) NOT NULL,
  `uom_name` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`uom_id`, `uom_name`, `status`) VALUES
(1, 'Kg', 1),
(2, 'Botol', 1),
(3, 'Pcs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(10) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `company` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level_id` varchar(10) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `password` varchar(256) NOT NULL,
  `status` int(11) NOT NULL,
  `email_verification` int(11) NOT NULL,
  `created_time` date NOT NULL,
  `updated_time` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `company`, `email`, `level_id`, `phone`, `password`, `status`, `email_verification`, `created_time`, `updated_time`) VALUES
('LOG2100001', 'Nindy Okta Novianti', 'PT Pos', 'nindy.novianti@poslogistics.co.id', 'LVL-003', '085693391737', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 1, 1, '2021-04-07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `level_id` varchar(20) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `level_id` varchar(20) NOT NULL,
  `level_name` varchar(100) NOT NULL,
  `level_role` text NOT NULL,
  `level_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`level_id`, `level_name`, `level_role`, `level_status`) VALUES
('LV001', 'Superadmin', 'superadmin', 1),
('LV002', 'Admin Inbound', 'inbound', 1),
('LV003', 'Admin Outbound', 'outbound', 1),
('LV004', 'Admin Warehouse', 'admin warehouse', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Dashboard'),
(2, 'Master Data');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `warehouse_id` varchar(20) NOT NULL,
  `wh_code` varchar(20) DEFAULT NULL,
  `wh_name` varchar(100) DEFAULT NULL,
  `wh_city` varchar(50) DEFAULT NULL,
  `wh_address` text DEFAULT NULL,
  `wh_pic` varchar(100) DEFAULT NULL,
  `wh_pic_phone` varchar(14) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `wh_pic_email` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`warehouse_id`, `wh_code`, `wh_name`, `wh_city`, `wh_address`, `wh_pic`, `wh_pic_phone`, `status`, `create_by`, `create_date`, `update_by`, `update_date`, `wh_pic_email`) VALUES
('WHS2100001', 'WH001', 'Warehouse Cakung 1', '3275', 'Jl. raya cakung', 'Kayla', '084642544434', 1, 'NINDY OKTA', '2021-04-14 10:44:02', 'NINDY OKTA NOVIANTI', '2021-04-14 11:08:27', 'karla@test.co.id'),
('WHS2100002', 'WH002', 'Warehouse Jakarta', '3175', 'jl. jakarta', 'Kayla', '084642544434', 1, 'NINDY OKTA NOVIANTI', '2021-05-14 17:00:00', NULL, NULL, 'kayla@test.co.id');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_soh`
--

CREATE TABLE `warehouse_soh` (
  `soh_id` varchar(20) NOT NULL,
  `mat_detail_id` varchar(20) DEFAULT NULL,
  `stock_ok` int(11) DEFAULT NULL,
  `stock_nok` int(11) DEFAULT NULL,
  `material_in` int(11) DEFAULT NULL,
  `material_out` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `mat_batas_bawah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse_soh`
--

INSERT INTO `warehouse_soh` (`soh_id`, `mat_detail_id`, `stock_ok`, `stock_nok`, `material_in`, `material_out`, `status`, `mat_batas_bawah`) VALUES
('SOH2100001', 'MTD2100001', 0, 0, NULL, NULL, 1, NULL),
('SOH2100002', 'MTD2100002', 90, 100, NULL, NULL, 1, NULL),
('SOH2100003', 'MTD2100003', 100, 0, NULL, NULL, 1, NULL),
('SOH2100004', 'MTD2100004', 100, 0, NULL, NULL, 1, NULL),
('SOH2100005', 'MTD2100005', 10, 0, NULL, NULL, 1, NULL),
('SOH2100006', 'MTD2100006', 100, 0, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wh_area`
--

CREATE TABLE `wh_area` (
  `area_id` varchar(20) NOT NULL,
  `wh_id` varchar(20) DEFAULT NULL,
  `wh_area_name` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `create_by` varchar(20) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` varchar(20) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `wh_area_code` varchar(20) DEFAULT NULL,
  `jenis_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wh_area`
--

INSERT INTO `wh_area` (`area_id`, `wh_id`, `wh_area_name`, `status`, `create_by`, `create_date`, `update_by`, `update_date`, `wh_area_code`, `jenis_id`) VALUES
('WHA2100001', 'WHS2100001', 'Area 1', 1, 'NINDY OKTA NOVIANTI', '2021-04-15 09:10:24', 'NINDY OKTA NOVIANTI', '2021-04-15 09:21:05', 'A001', 1),
('WHA2100002', 'WHS2100001', 'Area 2', 1, 'NINDY OKTA NOVIANTI', '2021-04-15 09:21:28', NULL, NULL, 'A002', 2),
('WHA2100003', 'WHS2100002', 'Area 1 Jakarta', 1, 'NINDY OKTA NOVIANTI', '2021-05-14 17:00:28', NULL, NULL, 'A001', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocation_plan`
--
ALTER TABLE `allocation_plan`
  ADD PRIMARY KEY (`plan_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `wh_tujuan` (`wh_tujuan`),
  ADD KEY `allocation_plan_ibfk_2` (`material_id`);

--
-- Indexes for table `area_blok`
--
ALTER TABLE `area_blok`
  ADD PRIMARY KEY (`blok_id`),
  ADD KEY `blok_area` (`wh_area_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `inbound`
--
ALTER TABLE `inbound`
  ADD PRIMARY KEY (`inbound_id`),
  ADD KEY `inbound_location` (`inbound_location`),
  ADD KEY `inbound_type` (`inbound_type`),
  ADD KEY `inbound_po` (`inbound_po`);

--
-- Indexes for table `inbound_detail`
--
ALTER TABLE `inbound_detail`
  ADD PRIMARY KEY (`det_inbound_id`),
  ADD KEY `inbound_id` (`inbound_id`),
  ADD KEY `inbound_detail_ibfk_2` (`po_detail_id`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`jenis_id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_id`),
  ADD KEY `mat_group_material` (`mat_group_id`),
  ADD KEY `mat_uom_material` (`mat_uom`);

--
-- Indexes for table `material_detail`
--
ALTER TABLE `material_detail`
  ADD PRIMARY KEY (`mat_detail_id`),
  ADD KEY `mat_detail_owner` (`owner_id`),
  ADD KEY `mat_detail_material` (`material_id`);

--
-- Indexes for table `material_group`
--
ALTER TABLE `material_group`
  ADD PRIMARY KEY (`mat_group_id`),
  ADD KEY `fk_group_jenis` (`jenis_id`);

--
-- Indexes for table `material_location`
--
ALTER TABLE `material_location`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `material_detail_id` (`material_detail_id`),
  ADD KEY `shelf_id` (`shelf_id`);

--
-- Indexes for table `outbound`
--
ALTER TABLE `outbound`
  ADD PRIMARY KEY (`outbound_id`),
  ADD KEY `outbound_type` (`outbound_type`),
  ADD KEY `penerima` (`penerima`),
  ADD KEY `outbound_wh_asal` (`outbound_wh_asal`);

--
-- Indexes for table `outbound_detail`
--
ALTER TABLE `outbound_detail`
  ADD PRIMARY KEY (`det_outbound_id`),
  ADD KEY `outbound_id` (`outbound_id`),
  ADD KEY `outbound_detail_ibfk_3` (`material_detail_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`owners_id`);

--
-- Indexes for table `po_detail`
--
ALTER TABLE `po_detail`
  ADD PRIMARY KEY (`po_detail_id`),
  ADD KEY `po_id` (`po_id`),
  ADD KEY `po_detail_ibfk_2` (`material_id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`po_id`),
  ADD KEY `suplier_id` (`supplier_id`);

--
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`rak_id`),
  ADD KEY `fk_blok_rak` (`blok_id`);

--
-- Indexes for table `shelf`
--
ALTER TABLE `shelf`
  ADD PRIMARY KEY (`shelf_id`),
  ADD KEY `fk_shelf_rak` (`rak_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `trans_type`
--
ALTER TABLE `trans_type`
  ADD PRIMARY KEY (`trans_type_id`);

--
-- Indexes for table `uom`
--
ALTER TABLE `uom`
  ADD PRIMARY KEY (`uom_id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `level_id` (`level_id`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`warehouse_id`);

--
-- Indexes for table `warehouse_soh`
--
ALTER TABLE `warehouse_soh`
  ADD PRIMARY KEY (`soh_id`),
  ADD KEY `mat_detail_id` (`mat_detail_id`);

--
-- Indexes for table `wh_area`
--
ALTER TABLE `wh_area`
  ADD PRIMARY KEY (`area_id`),
  ADD KEY `area_warehouse` (`wh_id`),
  ADD KEY `jenis_id` (`jenis_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `jenis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `material_group`
--
ALTER TABLE `material_group`
  MODIFY `mat_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `uom`
--
ALTER TABLE `uom`
  MODIFY `uom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allocation_plan`
--
ALTER TABLE `allocation_plan`
  ADD CONSTRAINT `allocation_plan_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `allocation_plan_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `allocation_plan_ibfk_3` FOREIGN KEY (`wh_tujuan`) REFERENCES `warehouse` (`warehouse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `area_blok`
--
ALTER TABLE `area_blok`
  ADD CONSTRAINT `blok_area` FOREIGN KEY (`wh_area_id`) REFERENCES `wh_area` (`area_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inbound`
--
ALTER TABLE `inbound`
  ADD CONSTRAINT `inbound_ibfk_1` FOREIGN KEY (`inbound_location`) REFERENCES `warehouse` (`warehouse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inbound_ibfk_3` FOREIGN KEY (`inbound_type`) REFERENCES `trans_type` (`trans_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inbound_ibfk_4` FOREIGN KEY (`inbound_po`) REFERENCES `purchase_order` (`po_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inbound_detail`
--
ALTER TABLE `inbound_detail`
  ADD CONSTRAINT `inbound_detail_ibfk_1` FOREIGN KEY (`inbound_id`) REFERENCES `inbound` (`inbound_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inbound_detail_ibfk_2` FOREIGN KEY (`po_detail_id`) REFERENCES `po_detail` (`po_detail_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `mat_group_material` FOREIGN KEY (`mat_group_id`) REFERENCES `material_group` (`mat_group_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mat_uom_material` FOREIGN KEY (`mat_uom`) REFERENCES `uom` (`uom_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `material_detail`
--
ALTER TABLE `material_detail`
  ADD CONSTRAINT `mat_detail_material` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mat_detail_owner` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`owners_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `material_group`
--
ALTER TABLE `material_group`
  ADD CONSTRAINT `fk_group_jenis` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`jenis_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `material_location`
--
ALTER TABLE `material_location`
  ADD CONSTRAINT `material_location_ibfk_1` FOREIGN KEY (`material_detail_id`) REFERENCES `material_detail` (`mat_detail_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `material_location_ibfk_2` FOREIGN KEY (`shelf_id`) REFERENCES `shelf` (`shelf_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `outbound`
--
ALTER TABLE `outbound`
  ADD CONSTRAINT `outbound_ibfk_1` FOREIGN KEY (`outbound_type`) REFERENCES `trans_type` (`trans_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `outbound_ibfk_2` FOREIGN KEY (`penerima`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `outbound_ibfk_3` FOREIGN KEY (`outbound_wh_asal`) REFERENCES `warehouse` (`warehouse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `outbound_detail`
--
ALTER TABLE `outbound_detail`
  ADD CONSTRAINT `outbound_detail_ibfk_2` FOREIGN KEY (`outbound_id`) REFERENCES `outbound` (`outbound_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `outbound_detail_ibfk_3` FOREIGN KEY (`material_detail_id`) REFERENCES `material_detail` (`mat_detail_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `outbound_detail_ibfk_4` FOREIGN KEY (`location_id`) REFERENCES `material_location` (`location_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `po_detail`
--
ALTER TABLE `po_detail`
  ADD CONSTRAINT `po_detail_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `purchase_order` (`po_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `po_detail_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `purchase_order_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rak`
--
ALTER TABLE `rak`
  ADD CONSTRAINT `fk_blok_rak` FOREIGN KEY (`blok_id`) REFERENCES `area_blok` (`blok_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shelf`
--
ALTER TABLE `shelf`
  ADD CONSTRAINT `fk_shelf_rak` FOREIGN KEY (`rak_id`) REFERENCES `rak` (`rak_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `warehouse_soh`
--
ALTER TABLE `warehouse_soh`
  ADD CONSTRAINT `warehouse_soh_ibfk_1` FOREIGN KEY (`mat_detail_id`) REFERENCES `material_detail` (`mat_detail_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wh_area`
--
ALTER TABLE `wh_area`
  ADD CONSTRAINT `area_warehouse` FOREIGN KEY (`wh_id`) REFERENCES `warehouse` (`warehouse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `wh_area_ibfk_1` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`jenis_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
