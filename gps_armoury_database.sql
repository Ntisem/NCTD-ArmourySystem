-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2024 at 12:37 AM
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
-- Database: `gps_armoury_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_lists`
--

CREATE TABLE `admin_lists` (
  `adminID` int(100) NOT NULL,
  `profile_image` varchar(500) NOT NULL,
  `user_role` varchar(100) NOT NULL,
  `service_no` varchar(100) NOT NULL,
  `rank` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `fullname` varchar(500) NOT NULL,
  `admin_email` varchar(500) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `unit_dept` varchar(500) NOT NULL,
  `code` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `update_date` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_lists`
--

INSERT INTO `admin_lists` (`adminID`, `profile_image`, `user_role`, `service_no`, `rank`, `gender`, `fullname`, `admin_email`, `phone_number`, `username`, `password`, `unit_dept`, `code`, `status`, `update_date`, `datetime`) VALUES
(2, '66faf37504ff88.51637953.jpg', 'Armourer', '45232', 'SGT', 'Male', 'Richard Boampong', 'kofiboampong541@gamil.com', '0246846556', 'boampong', '532e6d0a3a420e4168e46df1db4359e9', 'CTD', '882165', 'Not-Verified', 'September 30, 2024, 6:52 pm', '2024-10-01 15:46:27'),
(3, 'tzgdONjWx.JxlO0pFV1DpYN.jpg', 'armourer', '60544', 'Inspr', 'Male', 'Ntisem William', 'williamntisem123@gmail.com', '0246076373', 'william', 'da6323f18608d4e26f562320fca718ca', 'CTD', '', '', '', '2024-10-01 15:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `admin_lists2`
--

CREATE TABLE `admin_lists2` (
  `adminID` int(100) NOT NULL,
  `profile_image` varchar(500) NOT NULL,
  `user_role` varchar(100) NOT NULL,
  `service_no` varchar(100) NOT NULL,
  `rank` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `fullname` varchar(500) NOT NULL,
  `admin_email` varchar(500) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `unit_dept` varchar(500) NOT NULL,
  `code` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `update_date` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_lists2`
--

INSERT INTO `admin_lists2` (`adminID`, `profile_image`, `user_role`, `service_no`, `rank`, `gender`, `fullname`, `admin_email`, `phone_number`, `username`, `password`, `unit_dept`, `code`, `status`, `update_date`, `datetime`) VALUES
(1, 'tzgdONjWx.JxlO0pFV1DpYN.jpg', 'Administrator', '12345', 'SGT', 'Male', 'Ntisem William', 'williamntisem123@gmail.com', '0246076373', 'William', 'da6323f18608d4e26f562320fca718ca', 'NPD', '0', 'Not-Verified', '', '2024-07-21 14:17:06'),
(2, '66cf7b9bbed359.05913040.png', 'Armourer', '45232', 'SGT', 'Male', 'Richard Boampong', 'kofiboampong541@gamil.com', '0246846556', 'boampong', '532e6d0a3a420e4168e46df1db4359e9', 'CTD', '882165', 'Not-Verified', '', '2024-08-28 19:33:47');

-- --------------------------------------------------------

--
-- Table structure for table `ammo_bookings`
--

CREATE TABLE `ammo_bookings` (
  `book_ammoID` int(200) NOT NULL,
  `bookingCode` varchar(200) NOT NULL,
  `ammoID` varchar(200) NOT NULL,
  `officerID` varchar(200) NOT NULL,
  `armourer_issuer` varchar(500) NOT NULL,
  `officer_image` varchar(500) NOT NULL,
  `to_officer` varchar(500) NOT NULL,
  `booking_time` varchar(200) NOT NULL,
  `ammo_name` varchar(500) NOT NULL,
  `ammo_rounds` int(200) NOT NULL,
  `ammo_returned` int(200) NOT NULL,
  `ammo_state` varchar(200) NOT NULL,
  `no_faulty_ammo` int(200) NOT NULL,
  `duty_type` varchar(200) NOT NULL,
  `duty_location` varchar(500) NOT NULL,
  `duty_duration` varchar(200) NOT NULL,
  `ammo_comment` varchar(1000) NOT NULL,
  `ammo_returns` varchar(200) NOT NULL,
  `returned_time` varchar(500) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ammo_bookings2`
--

CREATE TABLE `ammo_bookings2` (
  `book_ammoID` int(200) NOT NULL,
  `bookingCode` varchar(200) NOT NULL,
  `ammoID` varchar(200) NOT NULL,
  `officerID` varchar(200) NOT NULL,
  `armourer_issuer` varchar(500) NOT NULL,
  `officer_image` varchar(500) NOT NULL,
  `to_officer` varchar(500) NOT NULL,
  `booking_time` varchar(200) NOT NULL,
  `ammo_name` varchar(500) NOT NULL,
  `ammo_rounds` int(200) NOT NULL,
  `ammo_returned` int(200) NOT NULL,
  `ammo_state` varchar(200) NOT NULL,
  `no_faulty_ammo` int(200) NOT NULL,
  `duty_type` varchar(200) NOT NULL,
  `duty_location` varchar(500) NOT NULL,
  `duty_duration` varchar(200) NOT NULL,
  `ammo_comment` varchar(1000) NOT NULL,
  `ammo_returns` varchar(200) NOT NULL,
  `returned_time` varchar(500) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ammunitions`
--

CREATE TABLE `ammunitions` (
  `ammoID` int(200) NOT NULL,
  `manufacturer` varchar(500) NOT NULL,
  `ammo_type` varchar(200) NOT NULL,
  `ammo_name` varchar(500) NOT NULL,
  `ammo_application` varchar(200) NOT NULL,
  `ammo_rounds` int(255) NOT NULL,
  `booking_status` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ammunitions`
--

INSERT INTO `ammunitions` (`ammoID`, `manufacturer`, `ammo_type`, `ammo_name`, `ammo_application`, `ammo_rounds`, `booking_status`, `datetime`) VALUES
(6, 'Sellier & Bellot', '', '9MM', 'Duty', 100, 'Available', '2024-09-30 20:37:46'),
(8, 'Kidma Tech', '', '7.62x39 ', 'Duty', 520, 'Available', '2024-09-30 20:37:20'),
(9, 'Sellier & Bellot', '', '5.56X45', 'Duty', 30, 'Available', '2024-09-30 20:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `ammunitions2`
--

CREATE TABLE `ammunitions2` (
  `ammoID` int(200) NOT NULL,
  `manufacturer` varchar(500) NOT NULL,
  `ammo_type` varchar(200) NOT NULL,
  `ammo_name` varchar(500) NOT NULL,
  `ammo_application` varchar(200) NOT NULL,
  `ammo_rounds` int(255) NOT NULL,
  `booking_status` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ammunitions2`
--

INSERT INTO `ammunitions2` (`ammoID`, `manufacturer`, `ammo_type`, `ammo_name`, `ammo_application`, `ammo_rounds`, `booking_status`, `datetime`) VALUES
(5, 'FIOCCHI', '', '9MM', 'Duty', 100, 'Available', '2024-09-30 20:38:33'),
(7, 'Kidma Tech', '', '7.62x39 ', 'Duty', 520, 'Available', '2024-09-30 20:37:20'),
(8, 'Sellier & Bellot', '', '5.56X45', 'Duty', 30, 'Available', '2024-09-30 20:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `asset_bookings`
--

CREATE TABLE `asset_bookings` (
  `bookAssetID` int(200) NOT NULL,
  `bookingCode` varchar(200) NOT NULL,
  `assetID` varchar(200) NOT NULL,
  `officerID` varchar(200) NOT NULL,
  `booking_time` varchar(200) NOT NULL,
  `armourer_issuer` varchar(500) NOT NULL,
  `officer_image` varchar(500) NOT NULL,
  `to_officer` varchar(500) NOT NULL,
  `asset_name` varchar(500) NOT NULL,
  `asset_quantity` int(200) NOT NULL,
  `asset_state` varchar(200) NOT NULL,
  `no_faulty_asset` int(200) NOT NULL,
  `duty_type` varchar(200) NOT NULL,
  `duty_location` varchar(500) NOT NULL,
  `duty_duration` varchar(200) NOT NULL,
  `asset_returns` varchar(200) NOT NULL,
  `asset_comment` varchar(1000) NOT NULL,
  `returned_time` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_bookings2`
--

CREATE TABLE `asset_bookings2` (
  `bookAssetID` int(200) NOT NULL,
  `bookingCode` varchar(200) NOT NULL,
  `assetID` varchar(200) NOT NULL,
  `officerID` varchar(200) NOT NULL,
  `booking_time` varchar(200) NOT NULL,
  `armourer_issuer` varchar(500) NOT NULL,
  `officer_image` varchar(500) NOT NULL,
  `to_officer` varchar(500) NOT NULL,
  `asset_name` varchar(500) NOT NULL,
  `asset_quantity` int(200) NOT NULL,
  `asset_state` varchar(200) NOT NULL,
  `no_faulty_asset` int(200) NOT NULL,
  `duty_type` varchar(200) NOT NULL,
  `duty_location` varchar(500) NOT NULL,
  `duty_duration` varchar(200) NOT NULL,
  `asset_returns` varchar(200) NOT NULL,
  `asset_comment` varchar(1000) NOT NULL,
  `returned_time` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bookingID` int(100) NOT NULL,
  `bookingCode` varchar(100) NOT NULL,
  `firearmID` varchar(100) NOT NULL,
  `ammoID` varchar(100) NOT NULL,
  `officerID` varchar(100) NOT NULL,
  `booking_time` varchar(200) NOT NULL,
  `armourer_issuer` varchar(500) NOT NULL,
  `officer_image` varchar(500) NOT NULL,
  `to_officer` varchar(500) NOT NULL,
  `firearm_name` varchar(500) NOT NULL,
  `firearm_class` varchar(200) NOT NULL,
  `quantity_issued` int(100) NOT NULL,
  `firearm_state` varchar(200) NOT NULL,
  `ammunition_name` varchar(500) NOT NULL,
  `number_of_rounds` int(200) NOT NULL,
  `ammo_returned` int(200) NOT NULL,
  `ammo_state` varchar(200) NOT NULL,
  `no_faulty_ammo` int(200) NOT NULL,
  `duty_type` varchar(500) NOT NULL,
  `duty_location` varchar(500) NOT NULL,
  `duty_duration` varchar(200) NOT NULL,
  `returns` varchar(200) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `returned_time` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings2`
--

CREATE TABLE `bookings2` (
  `bookingID` int(100) NOT NULL,
  `bookingCode` varchar(100) NOT NULL,
  `firearmID` varchar(100) NOT NULL,
  `ammoID` varchar(100) NOT NULL,
  `officerID` varchar(100) NOT NULL,
  `booking_time` varchar(200) NOT NULL,
  `armourer_issuer` varchar(500) NOT NULL,
  `officer_image` varchar(500) NOT NULL,
  `to_officer` varchar(500) NOT NULL,
  `firearm_name` varchar(500) NOT NULL,
  `firearm_class` varchar(200) NOT NULL,
  `quantity_issued` int(100) NOT NULL,
  `firearm_state` varchar(200) NOT NULL,
  `ammunition_name` varchar(500) NOT NULL,
  `number_of_rounds` int(200) NOT NULL,
  `ammo_returned` int(200) NOT NULL,
  `ammo_state` varchar(200) NOT NULL,
  `no_faulty_ammo` int(200) NOT NULL,
  `duty_type` varchar(500) NOT NULL,
  `duty_location` varchar(500) NOT NULL,
  `duty_duration` varchar(200) NOT NULL,
  `returns` varchar(200) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `returned_time` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daily_activities`
--

CREATE TABLE `daily_activities` (
  `daily_ActivitiesID` int(200) NOT NULL,
  `adminID` varchar(100) NOT NULL,
  `armourer_admin_name` varchar(500) NOT NULL,
  `action_taken` varchar(500) NOT NULL,
  `user_role` varchar(500) NOT NULL,
  `booking_check` varchar(200) NOT NULL,
  `seen_status` int(200) NOT NULL,
  `bookings` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daily_activities`
--

INSERT INTO `daily_activities` (`daily_ActivitiesID`, `adminID`, `armourer_admin_name`, `action_taken`, `user_role`, `booking_check`, `seen_status`, `bookings`, `datetime`) VALUES
(9, '1', '12345 SGT Ntisem William', 'Added New Armourer [ SGT Richard Boampong ]', 'Armourer', 'No', 0, 'Inventory', '2024-08-28 19:33:47'),
(10, '2', '45232 SGT Richard Boampong', 'Added New Officer [ SGT Kwadwo Mensah ]', 'Armourer', '', 0, '', '2024-08-28 20:13:35'),
(11, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 12345 Revolver CZ807 ]', 'Armourer', '', 0, '', '2024-08-28 20:42:14'),
(12, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 00112 ShortGun AK47 ]', 'Armourer', '', 0, '', '2024-08-28 20:48:34'),
(13, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0012 Side-Arm M9 ]', 'Armourer', '', 0, '', '2024-08-28 21:18:39'),
(14, '2', '45232 SGT Richard Boampong', 'Added New Ammo [ 0000 9mm (Open-Tip-Match ) ]', 'Armourer', '', 0, '', '2024-08-28 21:19:53'),
(15, '2', '45232 SGT Richard Boampong', 'Added New Ammo [ 00112 9mm (Full-Metal-Jacket ) ]', 'Armourer', '', 0, '', '2024-08-28 22:27:29'),
(16, '2', '45232 SGT Richard Boampong', 'Issued a Firearm [ AK47(with number of Rounds: 15 ]', 'Armourer', '', 0, '', '2024-08-28 22:30:33'),
(17, '2', '45232 SGT Richard Boampong', 'Issued a Firearm [ AK47(with number of Rounds: 15 ]', 'Armourer', '', 0, '', '2024-08-28 22:40:13'),
(18, '2', '45232 SGT Richard Boampong', 'Issued a Firearm [ AK47(with number of Rounds: 15 ]', 'Armourer', '', 0, '', '2024-08-28 22:42:05'),
(19, '2', '45232 SGT Richard Boampong', 'Issued a Firearm [ M9(with number of Rounds: 5 ]', 'Armourer', '', 0, '', '2024-08-28 22:48:57'),
(20, '2', '45232 SGT Richard Boampong', 'Issued an Ammo [ 0000 9mm [Open-Tip-Match](Number of Rounds: 10 ]', 'Armourer', '', 0, '', '2024-08-28 22:49:48'),
(21, '2', '45232 SGT Richard Boampong', 'Issued an Ammo [ 0000 9mm [Open-Tip-Match](Number of Rounds: 10 ]', 'Armourer', '', 0, '', '2024-08-28 22:50:18'),
(22, '2', '45232 SGT Richard Boampong', 'Issued an Ammo [ 0000 9mm [Open-Tip-Match](Number of Rounds: 10 ]', 'Armourer', '', 0, '', '2024-08-28 22:52:10'),
(23, '2', '45232 SGT Richard Boampong', 'Issued an Ammo [ 0000 9mm [Open-Tip-Match](Number of Rounds: 10 ]', 'Armourer', '', 0, '', '2024-08-28 22:56:06'),
(24, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Peter Bannor ]', 'Armourer', '', 0, '', '2024-08-28 23:35:06'),
(25, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Mary Aso ]', 'Armourer', '', 0, '', '2024-08-28 23:35:48'),
(26, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0011 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-28 23:39:15'),
(27, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 00123 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-28 23:40:19'),
(28, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ E004836-4 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-28 23:43:56'),
(29, '2', '45232 SGT Richard Boampong', 'Added New Officer [ SGT Ernest Appiah ]', 'Armourer', '', 0, '', '2024-08-28 23:45:25'),
(30, '2', '45232 SGT Richard Boampong', 'Added New Ammo [ 0000 7.62X39 (Full-Metal-Jacket ) ]', 'Armourer', '', 0, '', '2024-08-28 23:47:39'),
(31, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ E004810-1 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-28 23:50:52'),
(32, '2', '45232 SGT Richard Boampong', 'Issued a Firearm [ E004836-4-CZ807(with number of Rounds: 30 ]', 'Armourer', '', 0, '', '2024-08-28 23:59:01'),
(33, '', '', 'Returned a Firearm [ E004836-4-CZ807 With (30) rounds of Ammunition ]', '', '', 0, '', '2024-08-29 00:07:07'),
(34, '2', '45232 SGT Richard Boampong', 'Issued a Firearm [ E004810-1-CZ807(with number of Rounds: 20 ]', 'Armourer', '', 0, '', '2024-08-29 00:10:26'),
(35, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ c326913 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 00:25:08'),
(36, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ c326913 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 00:25:08'),
(37, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ f141289 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 00:31:06'),
(38, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ E021864 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 00:56:09'),
(39, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ E402183 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 00:59:41'),
(40, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C326965 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:04:51'),
(41, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ D418901 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:08:06'),
(42, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C402202 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:09:32'),
(43, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ D418901 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:15:36'),
(44, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ D402150 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:21:00'),
(45, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C425816 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:22:30'),
(46, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ E021885 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:24:07'),
(47, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ E013906 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:25:22'),
(48, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C402201 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:26:28'),
(49, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ F129876 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:27:49'),
(50, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ F211131 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:29:05'),
(51, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ F211106 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:30:24'),
(52, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ F213060 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:31:42'),
(53, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ F211092 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:33:25'),
(54, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ F211092 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:33:25'),
(55, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ F211117 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:34:39'),
(56, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ E013895 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:36:05'),
(57, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ E012823 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:38:16'),
(58, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ E021858 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:40:33'),
(59, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ E013943 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:41:48'),
(60, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ E004799 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:43:37'),
(61, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C326917 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:44:47'),
(62, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ E021859 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:45:52'),
(63, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ E021864 Rifle CZ807 ]', 'Armourer', '', 0, '', '2024-08-29 01:47:10'),
(64, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C069621 Rifle 805 ]', 'Armourer', '', 0, '', '2024-08-29 17:53:50'),
(65, '2', '45232 SGT Richard Boampong', 'Added New Firearm [  C065685 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-29 17:59:23'),
(66, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C056439 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-29 18:01:01'),
(67, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C052873 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-29 18:05:00'),
(68, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C068428 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-29 18:06:19'),
(69, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ CC068408 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-29 18:07:59'),
(70, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C082027 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-29 18:09:17'),
(71, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C069641 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-29 18:11:04'),
(72, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C081998 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-29 18:13:35'),
(73, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C082001 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-29 18:15:04'),
(74, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C071864 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-29 18:17:35'),
(75, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C071864 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-29 18:19:01'),
(76, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C061894 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-29 18:20:29'),
(77, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C052885 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-29 18:22:36'),
(78, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C056437 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-29 18:24:00'),
(79, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C085120 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-29 18:26:39'),
(80, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C082009 Rifle 805 ]', 'Armourer', '', 0, '', '2024-08-29 18:28:42'),
(81, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C061893 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-29 18:30:48'),
(82, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C069628 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-29 18:37:29'),
(83, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C082026 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-29 18:40:18'),
(84, '', '', 'Returned a Firearm [ E004810-1-CZ807 With (30) rounds of Ammunition ]', '', '', 0, '', '2024-08-30 01:10:41'),
(85, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ C061901 Rifle CZ805 ]', 'Armourer', '', 0, '', '2024-08-30 14:05:19'),
(86, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ AZ -4233 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-30 16:17:38'),
(87, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ AZ-4543 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-30 16:20:35'),
(88, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ AL-0548 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-30 16:22:11'),
(89, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0087 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-30 16:24:00'),
(90, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ NA-201147 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-30 16:26:15'),
(91, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0066 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-30 16:27:56'),
(92, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0028 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-30 16:29:23'),
(93, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 1155 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-30 16:31:54'),
(94, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 1155 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-30 16:35:02'),
(95, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0044 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-30 16:38:42'),
(96, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0084 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-30 16:39:55'),
(97, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0084 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-30 16:41:16'),
(98, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0024 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-30 16:43:04'),
(99, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 198630-2 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-30 23:53:30'),
(100, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ HA-3907 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-30 23:57:36'),
(101, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0070 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-30 23:58:54'),
(102, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0022-19 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-31 00:00:34'),
(103, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0019-19 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-31 00:01:52'),
(104, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0011-19 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-31 00:03:04'),
(105, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0005-19 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-31 00:04:34'),
(106, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0064-19 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-31 00:06:28'),
(107, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0035-19 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-31 00:10:20'),
(108, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0025-19 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-31 00:13:46'),
(109, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0027-19 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-31 00:15:24'),
(110, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 0009-19 Rifle AK47 ]', 'Armourer', '', 0, '', '2024-08-31 00:16:59'),
(111, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211881 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-08-31 22:47:11'),
(112, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-215369 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-08-31 22:49:36'),
(113, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-212792 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-08-31 22:57:50'),
(114, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211838 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-08-31 23:01:35'),
(115, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211868 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-08-31 23:04:44'),
(116, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-215339 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-08-31 23:06:55'),
(117, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211681 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-08-31 23:08:21'),
(118, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-215349 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-08-31 23:09:55'),
(119, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-212993 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-08-31 23:11:20'),
(120, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-215368 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-08-31 23:13:07'),
(121, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211873 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-08-31 23:16:45'),
(122, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-213825 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-08-31 23:18:13'),
(123, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211709 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:10:18'),
(124, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211749 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:13:58'),
(125, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211649 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:16:24'),
(126, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-213818 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:18:36'),
(127, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-212982 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:20:11'),
(128, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-213958 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:21:38'),
(129, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-213345 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:24:00'),
(130, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-212759 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:25:35'),
(131, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-212795 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:26:56'),
(132, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-212757 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:28:37'),
(133, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-213956 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:29:50'),
(134, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211865 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:31:12'),
(135, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211689 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:32:44'),
(136, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211859 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:35:56'),
(137, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211697 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:39:35'),
(138, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-213961 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:40:55'),
(139, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-213820 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:42:22'),
(140, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-213934 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:45:55'),
(141, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-212990 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:47:43'),
(142, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-212789 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 01:50:07'),
(143, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211703 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 13:57:56'),
(144, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-215337 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 13:59:49'),
(145, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211690 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 14:00:57'),
(146, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-213002 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 14:02:49'),
(147, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-215326 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 14:18:43'),
(148, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211854 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 14:20:41'),
(149, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-213034 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 14:43:16'),
(150, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211884 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 14:45:02'),
(151, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211855 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 14:48:52'),
(152, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211672 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 14:50:33'),
(153, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-212791 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 14:52:45'),
(154, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211704 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 14:55:05'),
(155, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211704 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 14:58:11'),
(156, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-212740 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 15:01:18'),
(157, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211856 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 15:04:59'),
(158, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ M9-211706 Side-Arm BERETTA-M9 ]', 'Armourer', '', 0, '', '2024-09-01 15:07:29'),
(159, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ H78756Z Side-Arm BERETTA-92 ]', 'Armourer', '', 0, '', '2024-09-01 16:18:50'),
(160, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ H78691Z Side-Arm BERETTA-92 ]', 'Armourer', '', 0, '', '2024-09-01 16:21:53'),
(161, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ A13006529 Side-Arm NP22 ]', 'Armourer', '', 0, '', '2024-09-01 16:32:46'),
(162, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ A13006661 Side-Arm NP22 ]', 'Armourer', '', 0, '', '2024-09-01 16:44:50'),
(163, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ A13005682 Side-Arm NP22 ]', 'Armourer', '', 0, '', '2024-09-01 16:47:02'),
(164, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ A13005725 Side-Arm NP22 ]', 'Armourer', '', 0, '', '2024-09-01 16:48:32'),
(165, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ A13006212 Side-Arm NP22 ]', 'Armourer', '', 0, '', '2024-09-01 16:51:02'),
(166, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ A13005759 Side-Arm NP22 ]', 'Armourer', '', 0, '', '2024-09-01 16:53:07'),
(167, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ A13006646 Side-Arm NP22 ]', 'Armourer', '', 0, '', '2024-09-01 16:55:06'),
(168, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ A13005667 Side-Arm NP22 ]', 'Armourer', '', 0, '', '2024-09-01 16:56:45'),
(169, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ A13005672 Side-Arm NP22 ]', 'Armourer', '', 0, '', '2024-09-01 16:58:10'),
(170, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 11501846 Side-Arm NP22 ]', 'Armourer', '', 0, '', '2024-09-01 17:00:47'),
(171, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 11501846-6 Side-Arm 18 ]', 'Armourer', '', 0, '', '2024-09-01 17:05:35'),
(172, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 115012-7 Side-Arm NP-18 ]', 'Armourer', '', 0, '', '2024-09-01 17:09:38'),
(173, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 11501827 Side-Arm NP-18 ]', 'Armourer', '', 0, '', '2024-09-01 17:13:11'),
(174, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 11501276-7 Side-Arm NP-18 ]', 'Armourer', '', 0, '', '2024-09-01 17:17:13'),
(175, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ 11501616-5 Side-Arm NP-18 ]', 'Armourer', '', 0, '', '2024-09-01 17:19:18'),
(176, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ SP-1036911 Side-Arm SP ]', 'Armourer', '', 0, '', '2024-09-01 17:23:10'),
(177, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ SP-0136960 Side-Arm SP ]', 'Armourer', '', 0, '', '2024-09-01 17:26:29'),
(178, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ SP-0137312 Side-Arm SP ]', 'Armourer', '', 0, '', '2024-09-01 17:30:04'),
(179, '2', '45232 SGT Richard Boampong', 'Added New Firearm [ SP-0137157 Side-Arm SP ]', 'Armourer', '', 0, '', '2024-09-01 17:32:35'),
(180, '2', '45232 SGT Richard Boampong', 'Updated Armourer [ SGT Richard Boampong ]', 'Armourer', '', 0, '', '2024-09-03 13:55:20'),
(181, '2', '45232 SGT Richard Boampong', 'Deleted an [ Administrator SGT  Ntisem William (William) ]', 'Armourer', '', 0, '', '2024-09-04 22:07:16'),
(182, '2', '45232 SGT Richard Boampong', 'Updated Armourer [ SGT Richard Boampong ]', 'Armourer', '', 0, '', '2024-09-11 23:46:37'),
(183, '2', '45232 SGT Richard Boampong', 'Updated Armourer [ SGT Richard Boampong ]', 'Armourer', '', 0, '', '2024-09-11 23:54:14'),
(184, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Alex Pwatiu ]', 'Armourer', '', 0, '', '2024-09-30 18:57:11'),
(185, '2', '45232 SGT Richard Boampong', 'Added New Officer [ SGT Richard Boampong ]', 'Armourer', '', 0, '', '2024-09-30 19:38:35'),
(186, '2', '45232 SGT Richard Boampong', 'Issued a Firearm [ f141289-CZ807(with number of Rounds: 20 ]', 'Armourer', '', 0, '', '2024-09-30 19:45:49'),
(187, '2', '45232 SGT Richard Boampong', 'Issued a Firearm [ f141289-CZ807(with number of Rounds: 20 ]', 'Armourer', '', 0, '', '2024-09-30 19:46:11'),
(188, '2', '45232 SGT Richard Boampong', 'Updated an Ammo [7.62X39 ( 190 ) ]', 'Armourer', '', 0, '', '2024-09-30 20:11:53'),
(189, '2', '45232 SGT Richard Boampong', 'Added New Ammo [ 9MM ]', 'Armourer', '', 0, '', '2024-09-30 20:20:12'),
(190, '2', '45232 SGT Richard Boampong', 'Updated an Ammo [9MM ( 50 ) ]', 'Armourer', '', 0, '', '2024-09-30 20:24:11'),
(191, '2', '45232 SGT Richard Boampong', 'Updated an Ammo [9M0 ( 50 ) ]', 'Armourer', '', 0, '', '2024-09-30 20:29:09'),
(192, '2', '45232 SGT Richard Boampong', 'Updated an Ammo [9MM ( 50 ) ]', 'Armourer', '', 0, '', '2024-09-30 20:29:23'),
(193, '2', '45232 SGT Richard Boampong', 'Added New Ammo [ 9MM ]', 'Armourer', '', 0, '', '2024-09-30 20:31:23'),
(194, '2', '45232 SGT Richard Boampong', 'Added New Ammo [ 7.62x39  ]', 'Armourer', '', 0, '', '2024-09-30 20:37:20'),
(195, '2', '45232 SGT Richard Boampong', 'Updated an Ammo [9MM ( 100 ) ]', 'Armourer', '', 0, '', '2024-09-30 20:37:46'),
(196, '2', '45232 SGT Richard Boampong', 'Added New Ammo [ 5.56X45 ]', 'Armourer', '', 0, '', '2024-09-30 20:39:29'),
(197, '2', '45232 SGT Richard Boampong', 'Added Faulty Firearm [ AK47 (Rifle ) ]', 'Armourer', '', 0, '', '2024-09-30 17:37:46'),
(198, '2', '45232 SGT Richard Boampong', 'Added Faulty Firearm [ AK47 (Rifle ) ]', 'Armourer', '', 0, '', '2024-09-30 17:40:46'),
(199, '2', '45232 SGT Richard Boampong', 'Added Faulty Firearm [ AK47 (Rifle ) ]', 'Armourer', '', 0, '', '2024-09-30 17:41:25'),
(200, '2', '45232 SGT Richard Boampong', 'Added Faulty Firearm [ AK47 (Rifle ) ]', 'Armourer', '', 0, '', '2024-09-30 17:41:51'),
(201, '2', '45232 SGT Richard Boampong', 'Added Faulty Firearm [ AK47 (Rifle ) ]', 'Armourer', '', 0, '', '2024-09-30 17:42:41'),
(202, '2', '45232 SGT Richard Boampong', 'Added Faulty Firearm [ AK47 (Rifle ) ]', 'Armourer', '', 0, '', '2024-09-30 17:43:21'),
(203, '2', '45232 SGT Richard Boampong', 'Added Faulty Firearm [ AK47 (Rifle ) ]', 'Armourer', '', 0, '', '2024-09-30 17:43:52'),
(204, '2', '45232 SGT Richard Boampong', 'Added Faulty Firearm [ AK47 (Rifle ) ]', 'Armourer', '', 0, '', '2024-09-30 17:44:32'),
(205, '2', '45232 SGT Richard Boampong', 'Added Faulty Firearm [ AK47 (Rifle ) ]', 'Armourer', '', 0, '', '2024-09-30 17:45:08'),
(206, '2', '45232 SGT Richard Boampong', 'Added Faulty Firearm [ AK47 (Rifle ) ]', 'Armourer', '', 0, '', '2024-09-30 17:45:45'),
(207, '2', '45232 SGT Richard Boampong', 'Added Faulty Firearm [ AK47 (Rifle ) ]', 'Armourer', '', 0, '', '2024-09-30 17:46:26'),
(208, '2', '45232 SGT Richard Boampong', 'Added Faulty Firearm [ AK47 (Rifle ) ]', 'Armourer', '', 0, '', '2024-09-30 17:47:01'),
(209, '2', '45232 SGT Richard Boampong', 'Added Faulty Firearm [ BERETTA-M9 (Side-Arm ) ]', 'Armourer', '', 0, '', '2024-10-01 16:00:02'),
(210, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Mumin fuseni Abdul  ]', 'Armourer', '', 0, '', '2024-10-07 15:24:05'),
(211, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Samuel Ntim ]', 'Armourer', '', 0, '', '2024-10-07 16:59:46'),
(212, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Stephen Owusu ]', 'Armourer', '', 0, '', '2024-10-07 17:04:53'),
(213, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Eugene Bronya ]', 'Armourer', '', 0, '', '2024-10-07 17:08:09'),
(214, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Stephen Darko ]', 'Armourer', '', 0, '', '2024-10-07 17:11:36'),
(215, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Gehead Yeboah ]', 'Armourer', '', 0, '', '2024-10-07 17:15:57'),
(216, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Bismark Mills ]', 'Armourer', '', 0, '', '2024-10-07 17:21:38'),
(217, '2', '45232 SGT Richard Boampong', 'Added New Officer [ SGT Gordwin Afenyo ]', 'Armourer', '', 0, '', '2024-10-07 18:25:10'),
(218, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Lawrence Acheampong ]', 'Armourer', '', 0, '', '2024-10-07 18:29:50'),
(219, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Abudu Abubakari ]', 'Armourer', '', 0, '', '2024-10-07 18:35:11'),
(220, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Aikins Emmanuel ]', 'Armourer', '', 0, '', '2024-10-07 18:39:31'),
(221, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Ebenezer Aning Nti ]', 'Armourer', '', 0, '', '2024-10-07 18:46:40'),
(222, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Felix Appiah ]', 'Armourer', '', 0, '', '2024-10-07 18:52:31'),
(223, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Abdul Malik  Yussif ]', 'Armourer', '', 0, '', '2024-10-07 20:15:24'),
(224, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Paul Opolibi Yegben ]', 'Armourer', '', 0, '', '2024-10-07 20:21:24'),
(225, '2', '45232 SGT Richard Boampong', 'Updated an Ammo [5.56X45 ( 30 ) ]', 'Armourer', '', 0, '', '2024-10-07 20:25:46'),
(226, '2', '45232 SGT Richard Boampong', 'Updated an Ammo [9MM ( 100 ) ]', 'Armourer', '', 0, '', '2024-10-07 20:26:07'),
(227, '2', '45232 SGT Richard Boampong', 'Updated an Ammo [7.62x39  ( 520 ) ]', 'Armourer', '', 0, '', '2024-10-07 20:26:16'),
(228, '2', '45232 SGT Richard Boampong', 'Added New Officer [ INSPR Roland Tetteh ]', 'Armourer', '', 0, '', '2024-10-07 20:34:41'),
(229, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Alex Pwatiu ]', 'Armourer', '', 0, '', '2024-10-08 00:31:39'),
(230, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Benjamin Asiedu  ]', 'Armourer', '', 0, '', '2024-10-08 01:22:10'),
(231, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Paul Father Tsibuah ]', 'Armourer', '', 0, '', '2024-10-08 01:34:20'),
(232, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Bright OPoku Agyei ]', 'Armourer', '', 0, '', '2024-10-08 13:21:19'),
(233, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Ernest Yeboah ]', 'Armourer', '', 0, '', '2024-10-08 13:26:23'),
(234, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Hubert Osei Boamteng  ]', 'Armourer', '', 0, '', '2024-10-08 13:31:44'),
(235, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Benjamin Sarpong  ]', 'Armourer', '', 0, '', '2024-10-08 13:36:13'),
(236, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST David Sedem ]', 'Armourer', '', 0, '', '2024-10-08 13:42:03'),
(237, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Francis Kyei ]', 'Armourer', '', 0, '', '2024-10-08 13:47:48'),
(238, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Kenny Adarkwah  ]', 'Armourer', '', 0, '', '2024-10-08 14:21:34'),
(239, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Biney Alex Mensah ]', 'Armourer', '', 0, '', '2024-10-08 14:28:36'),
(240, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Benjamin Addy  ]', 'Armourer', '', 0, '', '2024-10-08 14:32:03'),
(241, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL George  Osei Agyemang  ]', 'Armourer', '', 0, '', '2024-10-08 14:38:47'),
(242, '2', '45232 SGT Richard Boampong', 'Added New Officer [ SGT Solomon Mensah Kojo  ]', 'Armourer', '', 0, '', '2024-10-08 14:46:44'),
(243, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CPL Rpbert Azamati  ]', 'Armourer', '', 0, '', '2024-10-08 15:16:07'),
(244, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CPL Samuel Quaicoe  ]', 'Armourer', '', 0, '', '2024-10-09 13:43:01'),
(245, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Solomon Asomani  ]', 'Armourer', '', 0, '', '2024-10-09 14:41:34'),
(246, '2', '45232 SGT Richard Boampong', 'Added New Officer [ SGT Richard Boampong ]', 'Armourer', '', 0, '', '2024-10-09 14:48:55'),
(247, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Fred  Agyekum  ]', 'Armourer', '', 0, '', '2024-10-10 13:38:07'),
(248, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Richmond  Agyei Yeboah  ]', 'Armourer', '', 0, '', '2024-10-10 13:52:04'),
(249, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Maxwel  Darko  ]', 'Armourer', '', 0, '', '2024-10-11 17:05:37'),
(250, '2', '45232 SGT Richard Boampong', 'Added New Officer [ SGT Simon Bryan  Tibila  ]', 'Armourer', '', 0, '', '2024-10-11 17:10:32'),
(251, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Richard  Asare ]', 'Armourer', '', 0, '', '2024-10-11 17:14:47'),
(252, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Richard  Ntiamoah ]', 'Armourer', '', 0, '', '2024-10-11 17:20:37'),
(253, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Anthony Darko  ]', 'Armourer', '', 0, '', '2024-10-11 17:25:09'),
(254, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CPL Gyamfi Adu  ]', 'Armourer', '', 0, '', '2024-10-11 18:08:51'),
(255, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Thomas Abu ]', 'Armourer', '', 0, '', '2024-10-11 18:15:12'),
(256, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Abraham  Nkumdow  ]', 'Armourer', '', 0, '', '2024-10-11 18:19:12'),
(257, '2', '45232 SGT Richard Boampong', 'Added New Officer [ SGT Fred Akafo Sena  ]', 'Armourer', '', 0, '', '2024-10-11 18:49:32'),
(258, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Enerst Anim  ]', 'Armourer', '', 0, '', '2024-10-11 18:55:34'),
(259, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Alhassan Titia  ]', 'Armourer', '', 0, '', '2024-10-11 19:05:40'),
(260, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Erick Acquah ]', 'Armourer', '', 0, '', '2024-10-11 19:10:44'),
(261, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Samuel  Fianko  ]', 'Armourer', '', 0, '', '2024-10-11 19:15:22'),
(262, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Yakubu  Abdul Majeed  ]', 'Armourer', '', 0, '', '2024-10-11 19:30:53'),
(263, '2', '45232 SGT Richard Boampong', 'Added New Officer [ SGT Wilson Agbley Selorm  ]', 'Armourer', '', 0, '', '2024-10-11 20:59:27'),
(264, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Jonathanthn1@gmail.com Tansang  ]', 'Armourer', '', 0, '', '2024-10-11 21:05:18'),
(265, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Reuben Ayivi  ]', 'Armourer', '', 0, '', '2024-10-11 21:11:06'),
(266, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Kamaldeen  Awudu ]', 'Armourer', '', 0, '', '2024-10-12 01:39:19'),
(267, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Alberta Asieduwaa ]', 'Armourer', '', 0, '', '2024-10-12 13:24:17'),
(268, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Emelia Akyamaa ]', 'Armourer', '', 0, '', '2024-10-12 13:31:35'),
(269, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST David Mpanga Tamanja ]', 'Armourer', '', 0, '', '2024-10-12 13:35:33'),
(270, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Bismark Kyeremeh  ]', 'Armourer', '', 0, '', '2024-10-12 13:39:40'),
(271, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Elizabet Appiah ]', 'Armourer', '', 0, '', '2024-10-12 13:43:47'),
(272, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Foster Asante ]', 'Armourer', '', 0, '', '2024-10-12 13:47:54'),
(273, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Ebenezer Mortey  ]', 'Armourer', '', 0, '', '2024-10-12 13:54:48'),
(274, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Robert Owusu  ]', 'Armourer', '', 0, '', '2024-10-12 14:18:04'),
(275, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Emmanuel Quarshie Acquah ]', 'Armourer', '', 0, '', '2024-10-12 14:26:29'),
(276, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CPL Selorm Awuku ]', 'Armourer', '', 0, '', '2024-10-12 14:30:04'),
(277, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Wisdom Aglili  ]', 'Armourer', '', 0, '', '2024-10-12 14:36:48'),
(278, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Isaac Owusu Antwi ]', 'Armourer', '', 0, '', '2024-10-12 14:44:00'),
(279, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Braimah  Winitor Amissah  ]', 'Armourer', '', 0, '', '2024-10-12 16:41:39'),
(280, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Issac Osei Bonsu ]', 'Armourer', '', 0, '', '2024-10-12 16:48:21'),
(281, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Clement Aryeetey  ]', 'Armourer', '', 0, '', '2024-10-12 17:01:16'),
(282, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Nicholas Awum,bila  ]', 'Armourer', '', 0, '', '2024-10-12 17:15:19'),
(283, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Degraft Appiah Kwadwo  ]', 'Armourer', '', 0, '', '2024-10-12 17:22:25'),
(284, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Bright Nkrumah ]', 'Armourer', '', 0, '', '2024-10-12 17:25:59'),
(285, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST John Kojo Aggrey  ]', 'Armourer', '', 0, '', '2024-10-12 17:38:54'),
(286, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Francis Osei ]', 'Armourer', '', 0, '', '2024-10-12 17:45:06'),
(287, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CPL Ebenezer Oti  ]', 'Armourer', '', 0, '', '2024-10-12 17:48:16'),
(288, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Justice Ankah  ]', 'Armourer', '', 0, '', '2024-10-12 17:53:23'),
(289, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Patrick Togobo ]', 'Armourer', '', 0, '', '2024-10-12 18:32:22'),
(290, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Julius Sewordo ]', 'Armourer', '', 0, '', '2024-10-12 18:38:16'),
(291, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Isaac Obeng  ]', 'Armourer', '', 0, '', '2024-10-12 18:43:16'),
(292, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Attuquaye Nii Clottey ]', 'Armourer', '', 0, '', '2024-10-12 18:50:24'),
(293, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Ibrahim Seidu  ]', 'Armourer', '', 0, '', '2024-10-12 18:55:25'),
(294, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Isaac Oberko  ]', 'Armourer', '', 0, '', '2024-10-12 18:59:55'),
(295, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Emmanuel Owusu Ntow  ]', 'Armourer', '', 0, '', '2024-10-12 19:04:50'),
(296, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Emmanuel Painstsil ]', 'Armourer', '', 0, '', '2024-10-12 19:52:36'),
(297, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Micheal Baah ]', 'Armourer', '', 0, '', '2024-10-12 19:57:27'),
(298, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Ambrose Lier ]', 'Armourer', '', 0, '', '2024-10-12 20:03:26'),
(299, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Peter Adu  ]', 'Armourer', '', 0, '', '2024-10-12 20:06:53'),
(300, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Oxford Owusu  ]', 'Armourer', '', 0, '', '2024-10-12 20:15:34'),
(301, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Clement Oteng  ]', 'Armourer', '', 0, '', '2024-10-12 20:20:21'),
(302, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Karim Abass Abdul ]', 'Armourer', '', 0, '', '2024-10-12 20:26:01'),
(303, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Emmanuel Annor  ]', 'Armourer', '', 0, '', '2024-10-12 20:31:06'),
(304, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Winfred Afewu  ]', 'Armourer', '', 0, '', '2024-10-12 20:36:29'),
(305, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL James  Akotto Baffour  ]', 'Armourer', '', 0, '', '2024-10-12 20:41:15'),
(306, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Sadique Abubakar  ]', 'Armourer', '', 0, '', '2024-10-12 20:46:50'),
(307, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Daniel Korto ]', 'Armourer', '', 0, '', '2024-10-12 20:51:51'),
(308, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Francis Ofori  ]', 'Armourer', '', 0, '', '2024-10-12 20:55:33'),
(309, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Tetteh Addo  ]', 'Armourer', '', 0, '', '2024-10-12 21:01:22'),
(310, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Philip Glakpe ]', 'Armourer', '', 0, '', '2024-10-12 21:05:38'),
(311, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Isaac Mensah  ]', 'Armourer', '', 0, '', '2024-10-12 21:11:35'),
(312, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Magnus Ediem Yankson ]', 'Armourer', '', 0, '', '2024-10-12 21:16:14'),
(313, '2', '45232 SGT Richard Boampong', 'Added New Officer [ INSPR Seidu Issah ]', 'Armourer', '', 0, '', '2024-10-12 23:19:20'),
(314, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Emmanuel  Kokwa  ]', 'Armourer', '', 0, '', '2024-10-12 23:27:53'),
(315, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Laud Kpodo Kwaku  ]', 'Armourer', '', 0, '', '2024-10-12 23:38:23'),
(316, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Wisdom  Adzasu ]', 'Armourer', '', 0, '', '2024-10-12 23:49:38'),
(317, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Ibrahim Abubakari ]', 'Armourer', '', 0, '', '2024-10-13 00:03:25'),
(318, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Clement  Ofori  ]', 'Armourer', '', 0, '', '2024-10-13 00:08:04'),
(319, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Emmanuel Appiah Agyei  ]', 'Armourer', '', 0, '', '2024-10-13 00:13:11'),
(320, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Godwill  Kyereme ]', 'Armourer', '', 0, '', '2024-10-13 00:21:23'),
(321, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Junior Asare Isaac ]', 'Armourer', '', 0, '', '2024-10-14 17:20:12'),
(322, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Micheal Arlloo ]', 'Armourer', '', 0, '', '2024-10-14 23:16:42'),
(323, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Mohammed Nkrumah  ]', 'Armourer', '', 0, '', '2024-10-14 23:22:52'),
(324, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST David Gmakikubi Tabil ]', 'Armourer', '', 0, '', '2024-10-14 23:28:53'),
(325, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Samuel  Asante Antwi  ]', 'Armourer', '', 0, '', '2024-10-14 23:34:44'),
(326, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Mohammed  Laryea Nuredeen  ]', 'Armourer', '', 0, '', '2024-10-15 16:22:33'),
(327, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Micheal  Antwi George  ]', 'Armourer', '', 0, '', '2024-10-15 16:37:43'),
(328, '2', '45232 SGT Richard Boampong', 'Added New Officer [ SGT Ernerst  Appiah ]', 'Armourer', '', 0, '', '2024-10-15 16:43:54'),
(329, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Samuel  Owusu  ]', 'Armourer', '', 0, '', '2024-10-15 16:49:58'),
(330, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Williams  Kwoffie  ]', 'Armourer', '', 0, '', '2024-10-15 16:55:43'),
(331, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Richard  Ankamah  ]', 'Armourer', '', 0, '', '2024-10-15 17:01:38'),
(332, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL David  Midzodzi Cudjoe  ]', 'Armourer', '', 0, '', '2024-10-15 17:08:37'),
(333, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CPL Bernard Balig  ]', 'Armourer', '', 0, '', '2024-10-15 17:16:36'),
(334, '2', '45232 SGT Richard Boampong', 'Added New Officer [ INSPR Mathias Nwaaro  ]', 'Armourer', '', 0, '', '2024-10-15 17:48:38'),
(335, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Benjamin  Osei Owusu  ]', 'Armourer', '', 0, '', '2024-10-15 23:42:15'),
(336, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Collins  Agyei ]', 'Armourer', '', 0, '', '2024-10-16 01:17:19'),
(337, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Ezekiel  Wayo A.  ]', 'Armourer', '', 0, '', '2024-10-16 14:07:51'),
(338, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Richard  Amankwah  ]', 'Armourer', '', 0, '', '2024-10-16 14:12:16'),
(339, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Philip Sakah  ]', 'Armourer', '', 0, '', '2024-10-16 14:15:56'),
(340, '2', '45232 SGT Richard Boampong', 'Added New Officer [ SGT Peter Owusu Mensah ]', 'Armourer', '', 0, '', '2024-10-16 14:19:34'),
(341, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Fredrick  Owusu Ansah  ]', 'Armourer', '', 0, '', '2024-10-16 14:24:19'),
(342, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Joe  Nakojah M.  ]', 'Armourer', '', 0, '', '2024-10-16 14:29:33'),
(343, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CPL Eugene Odame Debrah ]', 'Armourer', '', 0, '', '2024-10-16 14:34:25'),
(344, '2', '45232 SGT Richard Boampong', 'Added New Officer [ SGT Daniel Kitiaku ]', 'Armourer', '', 0, '', '2024-10-16 14:40:07'),
(345, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Kingsford Ansere  ]', 'Armourer', '', 0, '', '2024-10-16 14:46:10'),
(346, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Sampson Otoo ]', 'Armourer', '', 0, '', '2024-10-16 14:52:51'),
(347, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Humphrey  Eduah B. ]', 'Armourer', '', 0, '', '2024-10-16 14:58:59'),
(348, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Godwin Mensah ]', 'Armourer', '', 0, '', '2024-10-16 15:04:48'),
(349, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Esther  Agyei  ]', 'Armourer', '', 0, '', '2024-10-16 21:22:35'),
(350, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Nancy Fuseini  ]', 'Armourer', '', 0, '', '2024-10-17 00:39:01'),
(351, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Emmanuel Appau ]', 'Armourer', '', 0, '', '2024-10-17 00:41:59'),
(352, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Clinton Boakye Yiadom ]', 'Armourer', '', 0, '', '2024-10-17 00:48:15'),
(353, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Bridgette Asor Anokye ]', 'Armourer', '', 0, '', '2024-10-17 00:54:28'),
(354, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Evans Boakye  ]', 'Armourer', '', 0, '', '2024-10-17 01:02:58'),
(355, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Williams Ansah ]', 'Armourer', '', 0, '', '2024-10-17 01:07:38'),
(356, '2', '45232 SGT Richard Boampong', 'Added New Officer [ L/CPL Emmanuel Aidoo ]', 'Armourer', '', 0, '', '2024-10-17 01:16:10'),
(357, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Jacob Agyei ]', 'Armourer', '', 0, '', '2024-10-17 01:22:06'),
(358, '2', '45232 SGT Richard Boampong', 'Added New Officer [ CONST Mankuyali Kofi Dawuni ]', 'Armourer', '', 0, '', '2024-10-17 01:33:22');

-- --------------------------------------------------------

--
-- Table structure for table `daily_activities2`
--

CREATE TABLE `daily_activities2` (
  `activityLogID` int(100) NOT NULL,
  `adminID` varchar(100) NOT NULL,
  `armourer_admin_name` varchar(500) NOT NULL,
  `action_taken` varchar(500) NOT NULL,
  `user_role` varchar(500) NOT NULL,
  `booking_check` varchar(200) NOT NULL,
  `seen_status` int(200) NOT NULL,
  `bookings` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faulty_ammo`
--

CREATE TABLE `faulty_ammo` (
  `faulty_ammoID` int(200) NOT NULL,
  `faulty_ammo_serial_no` varchar(200) NOT NULL,
  `faulty_ammo_type` varchar(200) NOT NULL,
  `faulty_ammo_quantity` int(200) NOT NULL,
  `faulty_type` varchar(200) NOT NULL,
  `faulty_ammo_image` varchar(500) NOT NULL,
  `faulty_ammo_comment` varchar(1000) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faulty_ammo2`
--

CREATE TABLE `faulty_ammo2` (
  `faulty_ammoID` int(200) NOT NULL,
  `faulty_ammo_serial_no` varchar(200) NOT NULL,
  `faulty_ammo_type` varchar(200) NOT NULL,
  `faulty_ammo_quantity` int(200) NOT NULL,
  `faulty_type` varchar(200) NOT NULL,
  `faulty_ammo_image` varchar(500) NOT NULL,
  `faulty_ammo_comment` varchar(1000) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faulty_asset`
--

CREATE TABLE `faulty_asset` (
  `faulty_assetID` int(200) NOT NULL,
  `faulty_asset_serial_no` varchar(200) NOT NULL,
  `faulty_asset_quantity` int(200) NOT NULL,
  `faulty_type` varchar(200) NOT NULL,
  `faulty_nature` varchar(200) NOT NULL,
  `faulty_asset_image` varchar(500) NOT NULL,
  `faulty_asset_comment` varchar(1000) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faulty_asset2`
--

CREATE TABLE `faulty_asset2` (
  `faulty_assetID` int(200) NOT NULL,
  `faulty_asset_serial_no` varchar(200) NOT NULL,
  `faulty_asset_quantity` int(200) NOT NULL,
  `faulty_type` varchar(200) NOT NULL,
  `faulty_nature` varchar(200) NOT NULL,
  `faulty_asset_image` varchar(500) NOT NULL,
  `faulty_asset_comment` varchar(1000) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faulty_weapons`
--

CREATE TABLE `faulty_weapons` (
  `faulty_weaponID` int(100) NOT NULL,
  `faulty_firearm_serial_no` varchar(500) NOT NULL,
  `faulty_firearm_type` varchar(500) NOT NULL,
  `faulty_firearm_name` varchar(500) NOT NULL,
  `faulty_firearm_class` varchar(200) NOT NULL,
  `faulty_type` varchar(200) NOT NULL,
  `faulty_nature` varchar(200) NOT NULL,
  `faulty_firearm_image` varchar(500) NOT NULL,
  `faulty_firearm_comment` varchar(1000) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faulty_weapons`
--

INSERT INTO `faulty_weapons` (`faulty_weaponID`, `faulty_firearm_serial_no`, `faulty_firearm_type`, `faulty_firearm_name`, `faulty_firearm_class`, `faulty_type`, `faulty_nature`, `faulty_firearm_image`, `faulty_firearm_comment`, `datetime`) VALUES
(1, '198630-2', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae1ea9d2301.71027147.jpeg', '', '2024-09-30 17:37:46'),
(2, 'HA-3907', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae29e155507.52951122.png', '', '2024-09-30 17:40:46'),
(3, '0070-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae2c5c947b1.58326814.jpg', '', '2024-09-30 17:41:25'),
(4, '0022-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae2dfeb2aa1.43677299.jpg', '', '2024-09-30 17:41:51'),
(5, '0019-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae3119c0085.43071970.jpeg', '', '2024-09-30 17:42:41'),
(6, '0011-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae3396f18f6.49948013.jpeg', '', '2024-09-30 17:43:21'),
(7, '0005-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae3588cad75.85646023.jpg', '', '2024-09-30 17:43:52'),
(8, '0064-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae380f13346.45458335.jpeg', '', '2024-09-30 17:44:32'),
(9, '0035-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae3a459c2a9.65662021.jpg', '', '2024-09-30 17:45:08'),
(10, '0025-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Unserviceable', '66fae3c996e9a3.81115654.jpg', '', '2024-09-30 17:45:45'),
(11, '0027-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Unserviceable', '66fae3f2a53846.47659020.jpeg', '', '2024-09-30 17:46:26'),
(12, '0009-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae4156570f4.13374582.jpeg', '', '2024-09-30 17:47:01'),
(13, 'M9-211856', 'Side-Arm', 'BERETTA-M9', 'Duty Weapon', 'Trigger issue', 'Serviceable', '66fc1c8259f0d5.93980816.jpg', '', '2024-10-01 16:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `faulty_weapons2`
--

CREATE TABLE `faulty_weapons2` (
  `faulty_weaponID` int(100) NOT NULL,
  `faulty_firearm_serial_no` varchar(500) NOT NULL,
  `faulty_firearm_type` varchar(500) NOT NULL,
  `faulty_firearm_name` varchar(500) NOT NULL,
  `faulty_firearm_class` varchar(200) NOT NULL,
  `faulty_type` varchar(200) NOT NULL,
  `faulty_nature` varchar(200) NOT NULL,
  `faulty_firearm_image` varchar(500) NOT NULL,
  `faulty_firearm_comment` varchar(1000) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faulty_weapons2`
--

INSERT INTO `faulty_weapons2` (`faulty_weaponID`, `faulty_firearm_serial_no`, `faulty_firearm_type`, `faulty_firearm_name`, `faulty_firearm_class`, `faulty_type`, `faulty_nature`, `faulty_firearm_image`, `faulty_firearm_comment`, `datetime`) VALUES
(1, '198630-2', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae1ea9d2301.71027147.jpeg', '', '2024-09-30 17:37:46'),
(2, 'HA-3907', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae29e155507.52951122.png', '', '2024-09-30 17:40:46'),
(3, '0070-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae2c5c947b1.58326814.jpg', '', '2024-09-30 17:41:25'),
(4, '0022-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae2dfeb2aa1.43677299.jpg', '', '2024-09-30 17:41:51'),
(5, '0019-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae3119c0085.43071970.jpeg', '', '2024-09-30 17:42:41'),
(6, '0011-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae3396f18f6.49948013.jpeg', '', '2024-09-30 17:43:21'),
(7, '0005-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae3588cad75.85646023.jpg', '', '2024-09-30 17:43:52'),
(8, '0064-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae380f13346.45458335.jpeg', '', '2024-09-30 17:44:32'),
(9, '0035-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae3a459c2a9.65662021.jpg', '', '2024-09-30 17:45:08'),
(10, '0025-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Unserviceable', '66fae3c996e9a3.81115654.jpg', '', '2024-09-30 17:45:45'),
(11, '0027-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Unserviceable', '66fae3f2a53846.47659020.jpeg', '', '2024-09-30 17:46:26'),
(12, '0009-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae4156570f4.13374582.jpeg', '', '2024-09-30 17:47:01'),
(13, 'M9-211856', 'Side-Arm', 'BERETTA-M9', 'Duty Weapon', 'Trigger issue', 'Serviceable', '66fc1c8259f0d5.93980816.jpg', '', '2024-10-01 16:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `firearms`
--

CREATE TABLE `firearms` (
  `firearmID` int(200) NOT NULL,
  `firearm_serial_no` varchar(200) NOT NULL,
  `manufacturer` varchar(500) NOT NULL,
  `firearm_type` varchar(200) NOT NULL,
  `firearm_name` varchar(500) NOT NULL,
  `firearm_caliber` varchar(200) NOT NULL,
  `firearm_capacity` varchar(200) NOT NULL,
  `quantity` int(200) NOT NULL,
  `firearm_class` varchar(200) NOT NULL,
  `firearm_state` varchar(200) NOT NULL,
  `firearm_image` varchar(500) NOT NULL,
  `booking_status` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `firearms`
--

INSERT INTO `firearms` (`firearmID`, `firearm_serial_no`, `manufacturer`, `firearm_type`, `firearm_name`, `firearm_caliber`, `firearm_capacity`, `quantity`, `firearm_class`, `firearm_state`, `firearm_image`, `booking_status`, `datetime`) VALUES
(13, 'C326913', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfbfe4755140.66881686.png', 'Available', '2024-09-30 20:42:50'),
(15, 'F141289', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfc14ad4ae27.26225527.png', 'Not-Available', '2024-09-30 20:43:06'),
(16, 'E021864', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfc7299c84b6.89076101.jpeg', 'Available', '2024-08-29 00:56:09'),
(17, 'E402183', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfc7fd763e99.53322831.jpeg', 'Available', '2024-08-29 00:59:41'),
(18, 'C326965', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfc933d93fd8.70301685.jpeg', 'Available', '2024-08-29 01:04:51'),
(20, 'C402202', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfca4c46d308.83436628.jpeg', 'Available', '2024-08-29 01:09:32'),
(21, 'D418901', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfcbb8931422.75463289.jpeg', 'Available', '2024-08-29 01:15:36'),
(22, 'D402150', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfccfcbbf8e9.31394456.jpeg', 'Available', '2024-08-29 01:21:00'),
(23, 'C425816', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfcd565286a7.61596841.jpeg', 'Available', '2024-08-29 01:22:30'),
(24, 'E021885', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfcdb75cc5c3.57071975.jpeg', 'Available', '2024-08-29 01:24:07'),
(25, 'E013906', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfce028ca1a4.19676845.jpeg', 'Available', '2024-08-29 01:25:22'),
(26, 'C402201', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfce4421ed89.14814400.jpeg', 'Available', '2024-08-29 01:26:28'),
(27, 'F129876', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfce956bd039.63122511.jpeg', 'Available', '2024-08-29 01:27:49'),
(28, 'F211131', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfcee0ee1650.68866418.jpeg', 'Available', '2024-08-29 01:29:04'),
(29, 'F211106', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfcf30836318.73174216.jpeg', 'Available', '2024-08-29 01:30:24'),
(30, 'F213060', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfcf7e580ff0.31140858.jpeg', 'Available', '2024-08-29 01:31:42'),
(31, 'F211092', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfcfe5426288.06797960.jpeg', 'Available', '2024-08-29 01:33:25'),
(33, 'F211117', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfd02fb32ce1.42094325.jpeg', 'Available', '2024-08-29 01:34:39'),
(34, 'E013895', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfd08507a009.54559093.jpeg', 'Available', '2024-08-29 01:36:05'),
(35, 'E012823', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Spare-Weapon', 'Not Faulty', '66cfd108cd1d24.69736399.jpeg', 'Available', '2024-08-29 01:38:16'),
(36, 'E021858', 'CZ', 'Rifle', 'CZ807', '9x19mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfd191573981.88196126.jpeg', 'Available', '2024-08-29 01:40:33'),
(37, 'E013943', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfd1dc876482.80212334.jpeg', 'Available', '2024-08-29 01:41:48'),
(38, 'E004799', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfd248d3e3d7.76734919.jpeg', 'Available', '2024-08-29 01:43:36'),
(39, 'C326917', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfd28f949808.27458720.jpeg', 'Available', '2024-08-29 01:44:47'),
(40, 'E021859', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfd2d0a9ae12.16554830.jpeg', 'Available', '2024-08-29 01:45:52'),
(41, 'E021864', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfd31deba667.88558210.jpeg', 'Available', '2024-08-29 01:47:09'),
(42, 'C069621', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0b5ae10e7f8.97921415.jpeg', 'Available', '2024-09-02 17:31:56'),
(43, ' C065685', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0b6fb050e10.80523229.jpeg', 'Available', '2024-09-30 17:50:39'),
(44, 'C056439', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0b75dac3759.82343596.jpeg', 'Available', '2024-08-29 18:01:01'),
(45, 'C052873', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0b84c6bfad8.95816065.jpeg', 'Available', '2024-08-29 18:05:00'),
(46, 'C068428', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Spare-Weapon', 'Not Faulty', '66d0b89ae42661.47221660.jpeg', 'Available', '2024-08-29 18:06:18'),
(47, 'C068408', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0b8ff3a4599.32110883.jpeg', 'Available', '2024-09-02 17:35:43'),
(48, 'C082027', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0b94dbb1941.06283563.jpeg', 'Available', '2024-08-29 18:09:17'),
(49, 'C069641', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0b9b8b95827.24393084.jpeg', 'Available', '2024-08-29 18:11:04'),
(50, 'C081998', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0ba4ed626d0.47049725.jpeg', 'Available', '2024-08-29 18:13:34'),
(51, 'C082001', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0baa88e1eb9.12670229.jpeg', 'Available', '2024-08-29 18:15:04'),
(52, 'C071864', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0bb3f04e301.95644659.jpeg', 'Available', '2024-09-02 17:32:12'),
(54, 'C061894', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0bbed9f7308.92130086.jpeg', 'Available', '2024-08-29 18:20:29'),
(55, 'C052885', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0bc6be33e50.88582666.jpeg', 'Available', '2024-09-30 17:50:35'),
(56, 'C056437', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0bcc076fd43.78040625.jpeg', 'Available', '2024-08-29 18:24:00'),
(57, 'C085120', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0bd5fab8d19.23817725.jpeg', 'Available', '2024-08-29 18:26:39'),
(58, 'C082009', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0bddad01469.67222047.jpeg', 'Available', '2024-09-02 17:31:51'),
(59, 'C061893', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0be580a1c16.86090868.jpeg', 'Available', '2024-09-30 17:50:24'),
(60, 'C069628', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0bfe938f105.82133605.jpeg', 'Available', '2024-08-29 18:37:29'),
(61, 'C082026', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0c09247c266.66471715.jpeg', 'Available', '2024-08-29 18:40:18'),
(62, 'C061901', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1d19fcc2043.63150876.jpeg', 'Available', '2024-08-30 14:05:19'),
(63, 'AZ -4233', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f0a201ea33.40898642.jpg', 'Available', '2024-09-30 17:50:11'),
(64, 'AZ-4543', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f153796454.83638529.jpg', 'Available', '2024-08-30 16:20:35'),
(65, 'AL-0548', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f1b37049a2.51805012.jpg', 'Available', '2024-08-30 16:22:11'),
(66, '0087', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f220c2dd39.52109399.jpg', 'Available', '2024-08-30 16:24:00'),
(67, 'NA-201147', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f2a7b8d215.78705853.jpg', 'Available', '2024-08-30 16:26:15'),
(68, '0066', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f30c019977.36143893.jpg', 'Available', '2024-08-30 16:27:56'),
(69, '0028', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f362f416c4.04831736.jpg', 'Available', '2024-08-30 16:29:23'),
(70, '1155', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f3fabb38a3.02565722.jpg', 'Available', '2024-08-30 16:31:54'),
(72, '0044', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f592961899.65505316.jpg', 'Available', '2024-08-30 16:38:42'),
(73, '0084', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f5db2d0670.90151772.jpg', 'Available', '2024-08-30 16:39:55'),
(75, '0024', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f698bb66d9.01862666.jpg', 'Available', '2024-08-30 16:43:04'),
(76, '198630-2', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d25b79eae2f9.57944796.jpg', 'Available', '2024-08-30 23:53:29'),
(77, 'HA-3907', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d25c70702885.44301722.jpg', 'Available', '2024-08-30 23:57:36'),
(78, '0070-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d25cbe0ce179.51805759.jpg', 'Available', '2024-09-30 20:57:08'),
(79, '0022-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d25d22a55ee2.32241738.jpg', 'Available', '2024-08-31 00:00:34'),
(80, '0019-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d25d700613b8.45928260.jpg', 'Available', '2024-08-31 00:01:52'),
(81, '0011-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d25db8503c69.91389916.jpg', 'Available', '2024-09-30 20:57:48'),
(82, '0005-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d25e125bb057.52275666.jpg', 'Available', '2024-08-31 00:04:34'),
(83, '0064-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d25e84ca44c5.42528910.jpg', 'Available', '2024-08-31 00:06:28'),
(84, '0035-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d25f6c7bcfb9.25752561.jpg', 'Available', '2024-08-31 00:10:20'),
(85, '0025-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d26039dae8e2.21923313.jpg', 'Available', '2024-08-31 00:13:45'),
(86, '0027-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d2609cb576b7.75349841.jpg', 'Available', '2024-08-31 00:15:24'),
(87, '0009-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d260fb94cd26.10149777.jpg', 'Available', '2024-08-31 00:16:59'),
(88, 'M9-211881', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d39d6fc9bfa8.33912917.jpg', 'Available', '2024-08-31 22:47:11'),
(89, 'M9-215369', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d39e005f48c5.21112526.jpg', 'Available', '2024-08-31 22:49:36'),
(90, 'M9-212792', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d39fee1b0748.74526952.jpg', 'Available', '2024-08-31 22:57:50'),
(91, 'M9-211838', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3a0cf9e6483.89185858.jpg', 'Available', '2024-09-30 17:49:03'),
(92, 'M9-211868', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3a18c6d5446.29428067.jpg', 'Available', '2024-08-31 23:04:44'),
(93, 'M9-215339', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3a20edb5ed7.07385351.jpg', 'Available', '2024-08-31 23:06:54'),
(94, 'M9-211681', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3a26513d052.60247744.jpg', 'Available', '2024-08-31 23:08:21'),
(95, 'M9-215349', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3a2c3459d21.58686921.jpg', 'Available', '2024-08-31 23:09:55'),
(96, 'M9-212993', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3a318931a69.70397982.jpg', 'Available', '2024-08-31 23:11:20'),
(97, 'M9-215368', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3a38358a583.34717475.jpg', 'Available', '2024-08-31 23:13:07'),
(98, 'M9-211873', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3a45d42e040.43106087.jpg', 'Available', '2024-08-31 23:16:45'),
(99, 'M9-213825', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3a4b57ffc63.76658030.jpg', 'Available', '2024-08-31 23:18:13'),
(100, 'M9-211709', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3befa7d1d85.59564717.jpg', 'Available', '2024-09-01 01:10:18'),
(101, 'M9-211749', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3bfd5eacfb8.87107230.jpg', 'Available', '2024-09-01 01:13:57'),
(102, 'M9-211649', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c068184674.53106528.jpg', 'Available', '2024-09-01 01:16:24'),
(103, 'M9-213818', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c0ecce91b1.77595297.jpg', 'Available', '2024-09-01 01:18:36'),
(104, 'M9-212982', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c14b923d27.85596688.jpg', 'Available', '2024-09-01 01:20:11'),
(105, 'M9-213958', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c1a224e618.51651861.jpg', 'Available', '2024-09-01 01:21:38'),
(106, 'M9-213345', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c2306ff478.30383808.jpg', 'Available', '2024-09-01 01:24:00'),
(107, 'M9-212759', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c28f086d70.38633707.jpg', 'Available', '2024-09-01 01:25:35'),
(108, 'M9-212795', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c2e00c02e0.22012759.jpg', 'Available', '2024-09-01 01:26:56'),
(109, 'M9-212757', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c344e47039.07676934.jpg', 'Available', '2024-09-01 01:28:36'),
(110, 'M9-213956', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c38e7cc9d9.66512742.jpg', 'Available', '2024-09-01 01:29:50'),
(111, 'M9-211865', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c3e09418f4.90501891.jpg', 'Available', '2024-09-01 01:31:12'),
(112, 'M9-211689', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c43c4e8a87.06321220.jpg', 'Available', '2024-09-01 01:32:44'),
(113, 'M9-211859', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c4fc03a801.38929675.jpg', 'Available', '2024-09-01 01:35:56'),
(114, 'M9-211697', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c5d75084e8.64551651.jpg', 'Available', '2024-09-01 01:39:35'),
(115, 'M9-213961', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c62788f335.42061340.jpg', 'Available', '2024-09-01 01:40:55'),
(116, 'M9-213820', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c67ecc1df4.20597045.jpg', 'Available', '2024-09-01 01:42:22'),
(117, 'M9-213934', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c752f00c64.51963719.jpg', 'Available', '2024-09-01 01:45:54'),
(118, 'M9-212990', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c7bf6ed930.23451658.jpg', 'Available', '2024-09-01 01:47:43'),
(119, 'M9-212789', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c84f4e89b1.02792936.jpg', 'Available', '2024-09-01 01:50:07'),
(120, 'M9-211703', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d472e41bf110.85151777.jpg', 'Available', '2024-09-01 13:57:56'),
(121, 'M9-215337', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d47354e17e57.91391628.jpg', 'Available', '2024-09-01 13:59:48'),
(122, 'M9-211690', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d473997e3a25.81454846.jpg', 'Available', '2024-09-01 14:00:57'),
(123, 'M9-213002', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d47408eb8476.75526865.jpg', 'Available', '2024-09-01 14:02:48'),
(124, 'M9-215326', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d477c38f6d94.01182599.jpg', 'Available', '2024-09-01 14:18:43'),
(125, 'M9-211854', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d4783923ffe7.52604315.jpg', 'Available', '2024-09-01 14:20:41'),
(126, 'M9-213034', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d47d84cc58c0.29757520.jpg', 'Available', '2024-09-01 14:43:16'),
(127, 'M9-211884', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d47dee24d642.75977991.jpg', 'Available', '2024-09-01 14:45:02'),
(128, 'M9-211855', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d47ed48f2c33.00295390.jpg', 'Available', '2024-09-01 14:48:52'),
(129, 'M9-211672', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d47f395dd078.81963681.jpg', 'Available', '2024-09-01 14:50:33'),
(130, 'M9-212791', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d47fbdd3bff2.75528819.jpg', 'Available', '2024-09-01 14:52:45'),
(131, 'M9-211704', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d480498c0470.59859176.jpg', 'Available', '2024-09-01 14:55:05'),
(133, 'M9-212740', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d481bdd31c45.31790184.jpg', 'Available', '2024-09-01 15:01:17'),
(134, 'M9-211856', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Faulty', '66d4829adcc134.77233569.jpg', 'Available', '2024-10-01 15:54:57'),
(135, 'M9-211706', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d483312cdb63.43760949.jpg', 'Available', '2024-09-01 15:07:29'),
(136, 'H78756Z', 'BERETTA', 'Side-Arm', 'BERETTA-92', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d493ea1fcaf3.84425387.jpg', 'Available', '2024-09-02 17:26:38'),
(137, 'H78691Z', 'BERETTA', 'Side-Arm', 'BERETTA-92', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d494a14b6af2.38197188.jpg', 'Available', '2024-09-01 16:21:53'),
(138, 'A13006529', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d4972dec6588.61635073.jpg', 'Available', '2024-09-01 16:32:45'),
(139, 'A13006661', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49a02a5bbd6.52764885.jpg', 'Available', '2024-09-01 16:44:50'),
(140, 'A13005682', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49a86b3dc17.09134661.jpg', 'Available', '2024-09-01 16:47:02'),
(141, 'A13005725', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49ae0c50e57.24158162.jpg', 'Available', '2024-09-01 16:48:32'),
(142, 'A13006212', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49b763954d7.44576343.jpg', 'Available', '2024-09-01 16:51:02'),
(143, 'A13005759', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49bf2eb4bc5.64787272.jpg', 'Available', '2024-09-01 16:53:06'),
(144, 'A13006646', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49c69f15b01.12386905.jpg', 'Available', '2024-09-01 16:55:05'),
(145, 'A13005667', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49ccdbe2295.57538842.jpg', 'Available', '2024-09-01 16:56:45'),
(146, 'A13005672', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49d2251ec69.80136179.jpg', 'Available', '2024-09-01 16:58:10'),
(148, '11501846-6', 'NORINCO PISTOL', 'Side-Arm', '18', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49edeeab637.13972208.jpg', 'Available', '2024-09-01 17:05:34'),
(151, '11501276-7', 'NORINCO PISTOL', 'Side-Arm', 'NP-18', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d4a1999a2250.61327886.jpg', 'Available', '2024-09-01 17:17:13'),
(152, '11501616-5', 'NORINCO PISTOL', 'Side-Arm', 'NP-18', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d4a215e46fa9.61339651.jpg', 'Available', '2024-09-01 17:19:17'),
(153, 'SP-1036911', 'SIGPRO', 'Side-Arm', 'SP', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d4a2fde77d91.80806722.jpg', 'Available', '2024-09-01 17:23:09'),
(154, 'SP-0136960', 'SIGPRO', 'Side-Arm', 'SP', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d4a3c5458e81.97422126.jpg', 'Available', '2024-09-01 17:26:29'),
(155, 'SP-0137312', 'SIGPRO', 'Side-Arm', 'SP', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d4a49c93c591.03263650.jpg', 'Available', '2024-09-01 17:30:04'),
(156, 'SP-0137157', 'SIGPRO', 'Side-Arm', 'SP', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d4a532d358d6.69024945.jpg', 'Available', '2024-09-01 17:32:34');

-- --------------------------------------------------------

--
-- Table structure for table `firearms2`
--

CREATE TABLE `firearms2` (
  `firearmID` int(200) NOT NULL,
  `firearm_serial_no` varchar(200) NOT NULL,
  `manufacturer` varchar(500) NOT NULL,
  `firearm_type` varchar(200) NOT NULL,
  `firearm_name` varchar(500) NOT NULL,
  `firearm_caliber` varchar(200) NOT NULL,
  `firearm_capacity` varchar(200) NOT NULL,
  `quantity` int(200) NOT NULL,
  `firearm_class` varchar(200) NOT NULL,
  `firearm_state` varchar(200) NOT NULL,
  `firearm_image` varchar(500) NOT NULL,
  `booking_status` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `firearms2`
--

INSERT INTO `firearms2` (`firearmID`, `firearm_serial_no`, `manufacturer`, `firearm_type`, `firearm_name`, `firearm_caliber`, `firearm_capacity`, `quantity`, `firearm_class`, `firearm_state`, `firearm_image`, `booking_status`, `datetime`) VALUES
(7, '0011', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfb522e799a3.98213346.jpg', 'Available', '2024-08-28 23:39:14'),
(8, '00123', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 10, 'Duty-Weapon', 'Not Faulty', '66cfb563c405a7.34475276.jpg', 'Available', '2024-08-28 23:40:19'),
(9, 'E004836-4', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfb63c944ae1.31277321.jpg', 'Available', '2024-08-28 23:43:56'),
(10, 'E004810-1', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfb7dbe251d0.37137602.jpg', 'Available', '2024-08-28 23:50:51'),
(11, 'c326913', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfbfe4755140.66881686.png', 'Available', '2024-08-29 00:25:08'),
(12, 'c326913', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfbfe4ad4773.23421840.png', 'Available', '2024-08-29 00:25:08'),
(13, 'f141289', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfc14ad4ae27.26225527.png', 'Available', '2024-08-29 00:31:06'),
(14, 'E021864', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfc7299c84b6.89076101.jpeg', 'Available', '2024-08-29 00:56:09'),
(15, 'E402183', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfc7fd763e99.53322831.jpeg', 'Available', '2024-08-29 00:59:41'),
(16, 'C326965', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfc933d93fd8.70301685.jpeg', 'Available', '2024-08-29 01:04:51'),
(17, 'D418901', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfc9f604e9d3.79874046.jpeg', 'Available', '2024-08-29 01:08:06'),
(18, 'C402202', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfca4c46d308.83436628.jpeg', 'Available', '2024-08-29 01:09:32'),
(19, 'D418901', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfcbb8931422.75463289.jpeg', 'Available', '2024-08-29 01:15:36'),
(20, 'D402150', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfccfcbbf8e9.31394456.jpeg', 'Available', '2024-08-29 01:21:00'),
(21, 'C425816', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfcd565286a7.61596841.jpeg', 'Available', '2024-08-29 01:22:30'),
(22, 'E021885', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfcdb75cc5c3.57071975.jpeg', 'Available', '2024-08-29 01:24:07'),
(23, 'E013906', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfce028ca1a4.19676845.jpeg', 'Available', '2024-08-29 01:25:22'),
(24, 'C402201', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfce4421ed89.14814400.jpeg', 'Available', '2024-08-29 01:26:28'),
(25, 'F129876', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfce956bd039.63122511.jpeg', 'Available', '2024-08-29 01:27:49'),
(26, 'F211131', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfcee0ee1650.68866418.jpeg', 'Available', '2024-08-29 01:29:05'),
(27, 'F211106', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfcf30836318.73174216.jpeg', 'Available', '2024-08-29 01:30:24'),
(28, 'F213060', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfcf7e580ff0.31140858.jpeg', 'Available', '2024-08-29 01:31:42'),
(29, 'F211092', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfcfe5426288.06797960.jpeg', 'Available', '2024-08-29 01:33:25'),
(30, 'F211092', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfcfe58e8075.68481551.jpeg', 'Available', '2024-08-29 01:33:25'),
(31, 'F211117', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfd02fb32ce1.42094325.jpeg', 'Available', '2024-08-29 01:34:39'),
(32, 'E013895', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfd08507a009.54559093.jpeg', 'Available', '2024-08-29 01:36:05'),
(33, 'E012823', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Spare-Weapon', 'Not Faulty', '66cfd108cd1d24.69736399.jpeg', 'Available', '2024-08-29 01:38:16'),
(34, 'E021858', 'CZ', 'Rifle', 'CZ807', '9x19mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfd191573981.88196126.jpeg', 'Available', '2024-08-29 01:40:33'),
(35, 'E013943', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfd1dc876482.80212334.jpeg', 'Available', '2024-08-29 01:41:48'),
(36, 'E004799', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfd248d3e3d7.76734919.jpeg', 'Available', '2024-08-29 01:43:37'),
(37, 'C326917', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfd28f949808.27458720.jpeg', 'Available', '2024-08-29 01:44:47'),
(38, 'E021859', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfd2d0a9ae12.16554830.jpeg', 'Available', '2024-08-29 01:45:52'),
(39, 'E021864', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66cfd31deba667.88558210.jpeg', 'Available', '2024-08-29 01:47:10'),
(40, 'C069621', 'CZ', 'Rifle', '805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0b5ae10e7f8.97921415.jpeg', 'Available', '2024-08-29 17:53:50'),
(41, ' C065685', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'None', '66d0b6fb050e10.80523229.jpeg', 'Available', '2024-08-29 17:59:23'),
(42, 'C056439', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0b75dac3759.82343596.jpeg', 'Available', '2024-08-29 18:01:01'),
(43, 'C052873', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0b84c6bfad8.95816065.jpeg', 'Available', '2024-08-29 18:05:00'),
(44, 'C068428', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Spare-Weapon', 'Not Faulty', '66d0b89ae42661.47221660.jpeg', 'Available', '2024-08-29 18:06:18'),
(45, 'CC068408', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0b8ff3a4599.32110883.jpeg', 'Available', '2024-08-29 18:07:59'),
(46, 'C082027', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0b94dbb1941.06283563.jpeg', 'Available', '2024-08-29 18:09:17'),
(47, 'C069641', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0b9b8b95827.24393084.jpeg', 'Available', '2024-08-29 18:11:04'),
(48, 'C081998', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0ba4ed626d0.47049725.jpeg', 'Available', '2024-08-29 18:13:34'),
(49, 'C082001', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0baa88e1eb9.12670229.jpeg', 'Available', '2024-08-29 18:15:04'),
(50, 'C071864', 'CZ', 'Rifle', 'CZ805', '', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0bb3f04e301.95644659.jpeg', 'Available', '2024-08-29 18:17:35'),
(51, 'C071864', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0bb95748593.63256673.jpeg', 'Available', '2024-08-29 18:19:01'),
(52, 'C061894', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0bbed9f7308.92130086.jpeg', 'Available', '2024-08-29 18:20:29'),
(53, 'C052885', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'None', '66d0bc6be33e50.88582666.jpeg', 'Available', '2024-08-29 18:22:35'),
(54, 'C056437', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0bcc076fd43.78040625.jpeg', 'Available', '2024-08-29 18:24:00'),
(55, 'C085120', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0bd5fab8d19.23817725.jpeg', 'Available', '2024-08-29 18:26:39'),
(56, 'C082009', 'CZ', 'Rifle', '805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0bddad01469.67222047.jpeg', 'Available', '2024-08-29 18:28:42'),
(57, 'C061893', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'None', '66d0be580a1c16.86090868.jpeg', 'Available', '2024-08-29 18:30:48'),
(58, 'C069628', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0bfe938f105.82133605.jpeg', 'Available', '2024-08-29 18:37:29'),
(59, 'C082026', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d0c09247c266.66471715.jpeg', 'Available', '2024-08-29 18:40:18'),
(60, 'C061901', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1d19fcc2043.63150876.jpeg', 'Available', '2024-08-30 14:05:19'),
(61, 'AZ -4233', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'None', '66d1f0a201ea33.40898642.jpg', 'Available', '2024-08-30 16:17:38'),
(62, 'AZ-4543', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f153796454.83638529.jpg', 'Available', '2024-08-30 16:20:35'),
(63, 'AL-0548', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f1b37049a2.51805012.jpg', 'Available', '2024-08-30 16:22:11'),
(64, '0087', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f220c2dd39.52109399.jpg', 'Available', '2024-08-30 16:24:00'),
(65, 'NA-201147', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f2a7b8d215.78705853.jpg', 'Available', '2024-08-30 16:26:15'),
(66, '0066', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f30c019977.36143893.jpg', 'Available', '2024-08-30 16:27:56'),
(67, '0028', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f362f416c4.04831736.jpg', 'Available', '2024-08-30 16:29:23'),
(68, '1155', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f3fabb38a3.02565722.jpg', 'Available', '2024-08-30 16:31:54'),
(69, '1155', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f4b6a740a1.87205853.jpg', 'Available', '2024-08-30 16:35:02'),
(70, '0044', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f592961899.65505316.jpg', 'Available', '2024-08-30 16:38:42'),
(71, '0084', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f5db2d0670.90151772.jpg', 'Available', '2024-08-30 16:39:55'),
(72, '0084', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f62c6ed731.86519514.jpg', 'Available', '2024-08-30 16:41:16'),
(73, '0024', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', '66d1f698bb66d9.01862666.jpg', 'Available', '2024-08-30 16:43:04'),
(74, '198630-2', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d25b79eae2f9.57944796.jpg', 'Available', '2024-08-30 23:53:30'),
(75, 'HA-3907', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d25c70702885.44301722.jpg', 'Available', '2024-08-30 23:57:36'),
(76, '0070', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d25cbe0ce179.51805759.jpg', 'Available', '2024-08-30 23:58:54'),
(77, '0022-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d25d22a55ee2.32241738.jpg', 'Available', '2024-08-31 00:00:34'),
(78, '0019-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d25d700613b8.45928260.jpg', 'Available', '2024-08-31 00:01:52'),
(79, '0011-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'None', '66d25db8503c69.91389916.jpg', 'Available', '2024-08-31 00:03:04'),
(80, '0005-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d25e125bb057.52275666.jpg', 'Available', '2024-08-31 00:04:34'),
(81, '0064-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d25e84ca44c5.42528910.jpg', 'Available', '2024-08-31 00:06:28'),
(82, '0035-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d25f6c7bcfb9.25752561.jpg', 'Available', '2024-08-31 00:10:20'),
(83, '0025-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d26039dae8e2.21923313.jpg', 'Available', '2024-08-31 00:13:45'),
(84, '0027-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d2609cb576b7.75349841.jpg', 'Available', '2024-08-31 00:15:24'),
(85, '0009-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', '66d260fb94cd26.10149777.jpg', 'Available', '2024-08-31 00:16:59'),
(86, 'M9-211881', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d39d6fc9bfa8.33912917.jpg', 'Available', '2024-08-31 22:47:11'),
(87, 'M9-215369', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d39e005f48c5.21112526.jpg', 'Available', '2024-08-31 22:49:36'),
(88, 'M9-212792', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d39fee1b0748.74526952.jpg', 'Available', '2024-08-31 22:57:50'),
(89, 'M9-211838', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'None', '66d3a0cf9e6483.89185858.jpg', 'Available', '2024-08-31 23:01:35'),
(90, 'M9-211868', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3a18c6d5446.29428067.jpg', 'Available', '2024-08-31 23:04:44'),
(91, 'M9-215339', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3a20edb5ed7.07385351.jpg', 'Available', '2024-08-31 23:06:54'),
(92, 'M9-211681', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3a26513d052.60247744.jpg', 'Available', '2024-08-31 23:08:21'),
(93, 'M9-215349', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3a2c3459d21.58686921.jpg', 'Available', '2024-08-31 23:09:55'),
(94, 'M9-212993', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3a318931a69.70397982.jpg', 'Available', '2024-08-31 23:11:20'),
(95, 'M9-215368', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3a38358a583.34717475.jpg', 'Available', '2024-08-31 23:13:07'),
(96, 'M9-211873', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3a45d42e040.43106087.jpg', 'Available', '2024-08-31 23:16:45'),
(97, 'M9-213825', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3a4b57ffc63.76658030.jpg', 'Available', '2024-08-31 23:18:13'),
(98, 'M9-211709', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3befa7d1d85.59564717.jpg', 'Available', '2024-09-01 01:10:18'),
(99, 'M9-211749', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3bfd5eacfb8.87107230.jpg', 'Available', '2024-09-01 01:13:58'),
(100, 'M9-211649', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c068184674.53106528.jpg', 'Available', '2024-09-01 01:16:24'),
(101, 'M9-213818', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c0ecce91b1.77595297.jpg', 'Available', '2024-09-01 01:18:36'),
(102, 'M9-212982', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c14b923d27.85596688.jpg', 'Available', '2024-09-01 01:20:11'),
(103, 'M9-213958', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c1a224e618.51651861.jpg', 'Available', '2024-09-01 01:21:38'),
(104, 'M9-213345', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c2306ff478.30383808.jpg', 'Available', '2024-09-01 01:24:00'),
(105, 'M9-212759', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c28f086d70.38633707.jpg', 'Available', '2024-09-01 01:25:35'),
(106, 'M9-212795', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c2e00c02e0.22012759.jpg', 'Available', '2024-09-01 01:26:56'),
(107, 'M9-212757', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c344e47039.07676934.jpg', 'Available', '2024-09-01 01:28:37'),
(108, 'M9-213956', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c38e7cc9d9.66512742.jpg', 'Available', '2024-09-01 01:29:50'),
(109, 'M9-211865', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c3e09418f4.90501891.jpg', 'Available', '2024-09-01 01:31:12'),
(110, 'M9-211689', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c43c4e8a87.06321220.jpg', 'Available', '2024-09-01 01:32:44'),
(111, 'M9-211859', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c4fc03a801.38929675.jpg', 'Available', '2024-09-01 01:35:56'),
(112, 'M9-211697', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c5d75084e8.64551651.jpg', 'Available', '2024-09-01 01:39:35'),
(113, 'M9-213961', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c62788f335.42061340.jpg', 'Available', '2024-09-01 01:40:55'),
(114, 'M9-213820', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c67ecc1df4.20597045.jpg', 'Available', '2024-09-01 01:42:22'),
(115, 'M9-213934', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c752f00c64.51963719.jpg', 'Available', '2024-09-01 01:45:55'),
(116, 'M9-212990', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c7bf6ed930.23451658.jpg', 'Available', '2024-09-01 01:47:43'),
(117, 'M9-212789', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d3c84f4e89b1.02792936.jpg', 'Available', '2024-09-01 01:50:07'),
(118, 'M9-211703', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d472e41bf110.85151777.jpg', 'Available', '2024-09-01 13:57:56'),
(119, 'M9-215337', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d47354e17e57.91391628.jpg', 'Available', '2024-09-01 13:59:49'),
(120, 'M9-211690', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d473997e3a25.81454846.jpg', 'Available', '2024-09-01 14:00:57'),
(121, 'M9-213002', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d47408eb8476.75526865.jpg', 'Available', '2024-09-01 14:02:49'),
(122, 'M9-215326', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d477c38f6d94.01182599.jpg', 'Available', '2024-09-01 14:18:43'),
(123, 'M9-211854', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d4783923ffe7.52604315.jpg', 'Available', '2024-09-01 14:20:41'),
(124, 'M9-213034', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d47d84cc58c0.29757520.jpg', 'Available', '2024-09-01 14:43:16'),
(125, 'M9-211884', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d47dee24d642.75977991.jpg', 'Available', '2024-09-01 14:45:02'),
(126, 'M9-211855', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d47ed48f2c33.00295390.jpg', 'Available', '2024-09-01 14:48:52'),
(127, 'M9-211672', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d47f395dd078.81963681.jpg', 'Available', '2024-09-01 14:50:33'),
(128, 'M9-212791', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d47fbdd3bff2.75528819.jpg', 'Available', '2024-09-01 14:52:45'),
(129, 'M9-211704', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d480498c0470.59859176.jpg', 'Available', '2024-09-01 14:55:05'),
(130, 'M9-211704', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Faulty', '66d48103afcbd0.48610555.jpg', 'Available', '2024-09-01 14:58:11'),
(131, 'M9-212740', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d481bdd31c45.31790184.jpg', 'Available', '2024-09-01 15:01:17'),
(132, 'M9-211856', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Faulty', '66d4829adcc134.77233569.jpg', 'Available', '2024-09-01 15:04:58'),
(133, 'M9-211706', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d483312cdb63.43760949.jpg', 'Available', '2024-09-01 15:07:29'),
(134, 'H78756Z', 'BERETTA', 'Side-Arm', 'BERETTA-92', '9x19mm', '', 1, 'Duty-Weapon', 'Not Faulty', '66d493ea1fcaf3.84425387.jpg', 'Available', '2024-09-01 16:18:50'),
(135, 'H78691Z', 'BERETTA', 'Side-Arm', 'BERETTA-92', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d494a14b6af2.38197188.jpg', 'Available', '2024-09-01 16:21:53'),
(136, 'A13006529', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d4972dec6588.61635073.jpg', 'Available', '2024-09-01 16:32:46'),
(137, 'A13006661', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49a02a5bbd6.52764885.jpg', 'Available', '2024-09-01 16:44:50'),
(138, 'A13005682', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49a86b3dc17.09134661.jpg', 'Available', '2024-09-01 16:47:02'),
(139, 'A13005725', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49ae0c50e57.24158162.jpg', 'Available', '2024-09-01 16:48:32'),
(140, 'A13006212', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49b763954d7.44576343.jpg', 'Available', '2024-09-01 16:51:02'),
(141, 'A13005759', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49bf2eb4bc5.64787272.jpg', 'Available', '2024-09-01 16:53:07'),
(142, 'A13006646', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49c69f15b01.12386905.jpg', 'Available', '2024-09-01 16:55:06'),
(143, 'A13005667', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49ccdbe2295.57538842.jpg', 'Available', '2024-09-01 16:56:45'),
(144, 'A13005672', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49d2251ec69.80136179.jpg', 'Available', '2024-09-01 16:58:10'),
(145, '11501846', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49dbf899a64.14833423.jpg', 'Available', '2024-09-01 17:00:47'),
(146, '11501846-6', 'NORINCO PISTOL', 'Side-Arm', '18', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49edeeab637.13972208.jpg', 'Available', '2024-09-01 17:05:35'),
(147, '115012-7', 'NORINCO PISTOL', 'Side-Arm', 'NP-18', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d49fd1d75e13.06868889.jpg', 'Available', '2024-09-01 17:09:37'),
(148, '11501827', 'NORINCO PISTOL', 'Side-Arm', 'NP-18', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d4a0a7c5e621.57958153.jpg', 'Available', '2024-09-01 17:13:11'),
(149, '11501276-7', 'NORINCO PISTOL', 'Side-Arm', 'NP-18', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d4a1999a2250.61327886.jpg', 'Available', '2024-09-01 17:17:13'),
(150, '11501616-5', 'NORINCO PISTOL', 'Side-Arm', 'NP-18', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d4a215e46fa9.61339651.jpg', 'Available', '2024-09-01 17:19:18'),
(151, 'SP-1036911', 'SIGPRO', 'Side-Arm', 'SP', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d4a2fde77d91.80806722.jpg', 'Available', '2024-09-01 17:23:10'),
(152, 'SP-0136960', 'SIGPRO', 'Side-Arm', 'SP', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d4a3c5458e81.97422126.jpg', 'Available', '2024-09-01 17:26:29'),
(153, 'SP-0137312', 'SIGPRO', 'Side-Arm', 'SP', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d4a49c93c591.03263650.jpg', 'Available', '2024-09-01 17:30:04'),
(154, 'SP-0137157', 'SIGPRO', 'Side-Arm', 'SP', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', '66d4a532d358d6.69024945.jpg', 'Available', '2024-09-01 17:32:34');

-- --------------------------------------------------------

--
-- Table structure for table `login_activity`
--

CREATE TABLE `login_activity` (
  `loginID` int(200) NOT NULL,
  `admin_username` varchar(500) NOT NULL,
  `user_role` varchar(200) NOT NULL,
  `last_login_time` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_activity`
--

INSERT INTO `login_activity` (`loginID`, `admin_username`, `user_role`, `last_login_time`, `datetime`) VALUES
(121, 'boampong', 'Armourer', 'Tuesday 1st of October 2024 03:51:44 PM', '2024-10-01 15:51:44'),
(122, 'boampong', 'Armourer', 'Wednesday 2nd of October 2024 10:16:56 AM', '2024-10-02 10:16:56'),
(123, 'boampong', 'Armourer', 'Wednesday 2nd of October 2024 10:17:19 AM', '2024-10-02 10:17:19'),
(124, 'boampong', 'Armourer', 'Wednesday 2nd of October 2024 10:18:17 AM', '2024-10-02 10:18:17'),
(125, 'boampong', 'Armourer', 'Sunday 6th of October 2024 08:49:17 AM', '2024-10-06 08:49:17'),
(126, 'boampong', 'Armourer', 'Sunday 6th of October 2024 08:49:39 AM', '2024-10-06 08:49:39'),
(127, 'boampong', 'Armourer', 'Sunday 6th of October 2024 08:55:38 AM', '2024-10-06 08:55:38'),
(128, 'boampong', 'Armourer', 'Sunday 6th of October 2024 09:18:59 AM', '2024-10-06 09:18:59'),
(129, 'boampong', 'Armourer', 'Sunday 6th of October 2024 09:19:51 AM', '2024-10-06 09:19:51'),
(130, 'boampong', 'Armourer', 'Monday 7th of October 2024 02:46:57 PM', '2024-10-07 14:46:57'),
(131, 'boampong', 'Armourer', 'Monday 7th of October 2024 03:15:27 PM', '2024-10-07 15:15:27'),
(132, 'boampong', 'Armourer', 'Monday 7th of October 2024 03:53:23 PM', '2024-10-07 15:53:23'),
(133, 'boampong', 'Armourer', 'Monday 7th of October 2024 04:38:06 PM', '2024-10-07 16:38:06'),
(134, 'boampong', 'Armourer', 'Monday 7th of October 2024 06:21:10 PM', '2024-10-07 18:21:10'),
(135, 'boampong', 'Armourer', 'Monday 7th of October 2024 08:10:49 PM', '2024-10-07 20:10:49'),
(136, 'boampong', 'Armourer', 'Tuesday 8th of October 2024 12:27:02 AM', '2024-10-08 00:27:02'),
(137, 'boampong', 'Armourer', 'Tuesday 8th of October 2024 01:18:46 AM', '2024-10-08 01:18:46'),
(138, 'boampong', 'Armourer', 'Tuesday 8th of October 2024 01:18:09 PM', '2024-10-08 13:18:09'),
(139, 'boampong', 'Armourer', 'Tuesday 8th of October 2024 01:51:51 PM', '2024-10-08 13:51:51'),
(140, 'boampong', 'Armourer', 'Tuesday 8th of October 2024 02:18:51 PM', '2024-10-08 14:18:51'),
(141, 'boampong', 'Armourer', 'Tuesday 8th of October 2024 02:40:26 PM', '2024-10-08 14:40:26'),
(142, 'boampong', 'Armourer', 'Tuesday 8th of October 2024 03:11:38 PM', '2024-10-08 15:11:38'),
(143, 'boampong', 'Armourer', 'Tuesday 8th of October 2024 03:18:47 PM', '2024-10-08 15:18:47'),
(144, 'boampong', 'Armourer', 'Tuesday 8th of October 2024 11:14:03 PM', '2024-10-08 23:14:03'),
(145, 'boampong', 'Armourer', 'Wednesday 9th of October 2024 01:38:29 PM', '2024-10-09 13:38:29'),
(146, 'boampong', 'Armourer', 'Wednesday 9th of October 2024 02:38:18 PM', '2024-10-09 14:38:18'),
(147, 'boampong', 'Armourer', 'Wednesday 9th of October 2024 03:25:53 PM', '2024-10-09 15:25:53'),
(148, 'boampong', 'Armourer', 'Thursday 10th of October 2024 01:33:31 PM', '2024-10-10 13:33:31'),
(149, 'boampong', 'Armourer', 'Thursday 10th of October 2024 02:17:05 PM', '2024-10-10 14:17:05'),
(150, 'boampong', 'Armourer', 'Friday 11th of October 2024 01:48:28 PM', '2024-10-11 13:48:28'),
(151, 'boampong', 'Armourer', 'Friday 11th of October 2024 04:56:53 PM', '2024-10-11 16:56:53'),
(152, 'boampong', 'Armourer', 'Friday 11th of October 2024 06:04:08 PM', '2024-10-11 18:04:08'),
(153, 'boampong', 'Armourer', 'Friday 11th of October 2024 06:43:01 PM', '2024-10-11 18:43:01'),
(154, 'boampong', 'Armourer', 'Friday 11th of October 2024 08:52:14 PM', '2024-10-11 20:52:14'),
(155, 'boampong', 'Armourer', 'Saturday 12th of October 2024 12:52:38 AM', '2024-10-12 00:52:38'),
(156, 'boampong', 'Armourer', 'Saturday 12th of October 2024 01:39:35 AM', '2024-10-12 01:39:35'),
(157, 'boampong', 'Armourer', 'Saturday 12th of October 2024 01:17:35 PM', '2024-10-12 13:17:35'),
(158, 'boampong', 'Armourer', 'Saturday 12th of October 2024 01:26:33 PM', '2024-10-12 13:26:33'),
(159, 'boampong', 'Armourer', 'Saturday 12th of October 2024 03:48:09 PM', '2024-10-12 15:48:09'),
(160, 'boampong', 'Armourer', 'Saturday 12th of October 2024 04:30:13 PM', '2024-10-12 16:30:13'),
(161, 'boampong', 'Armourer', 'Saturday 12th of October 2024 06:23:53 PM', '2024-10-12 18:23:53'),
(162, 'boampong', 'Armourer', 'Saturday 12th of October 2024 07:47:21 PM', '2024-10-12 19:47:21'),
(163, 'boampong', 'Armourer', 'Saturday 12th of October 2024 11:14:40 PM', '2024-10-12 23:14:40'),
(164, 'boampong', 'Armourer', 'Saturday 12th of October 2024 11:57:12 PM', '2024-10-12 23:57:12'),
(165, 'boampong', 'Armourer', 'Monday 14th of October 2024 05:16:19 PM', '2024-10-14 17:16:19'),
(166, 'boampong', 'Armourer', 'Monday 14th of October 2024 10:16:12 PM', '2024-10-14 22:16:12'),
(167, 'boampong', 'Armourer', 'Monday 14th of October 2024 11:17:09 PM', '2024-10-14 23:17:09'),
(168, 'boampong', 'Armourer', 'Tuesday 15th of October 2024 01:51:19 PM', '2024-10-15 13:51:19'),
(169, 'boampong', 'Armourer', 'Tuesday 15th of October 2024 04:12:00 PM', '2024-10-15 16:12:00'),
(170, 'boampong', 'Armourer', 'Tuesday 15th of October 2024 05:58:28 PM', '2024-10-15 17:58:28'),
(171, 'boampong', 'Armourer', 'Tuesday 15th of October 2024 11:38:16 PM', '2024-10-15 23:38:16'),
(172, 'boampong', 'Armourer', 'Wednesday 16th of October 2024 01:07:11 AM', '2024-10-16 01:07:11'),
(173, 'boampong', 'Armourer', 'Wednesday 16th of October 2024 01:53:10 PM', '2024-10-16 13:53:10'),
(174, 'boampong', 'Armourer', 'Wednesday 16th of October 2024 04:05:54 PM', '2024-10-16 16:05:54'),
(175, 'boampong', 'Armourer', 'Wednesday 16th of October 2024 08:55:59 PM', '2024-10-16 20:55:59'),
(176, 'boampong', 'Armourer', 'Wednesday 16th of October 2024 09:23:12 PM', '2024-10-16 21:23:12'),
(177, 'boampong', 'Armourer', 'Thursday 17th of October 2024 12:04:37 AM', '2024-10-17 00:04:37'),
(178, 'boampong', 'Armourer', 'Thursday 17th of October 2024 12:39:11 AM', '2024-10-17 00:39:11'),
(179, 'boampong', 'Armourer', 'Wednesday 23rd of October 2024 08:35:30 PM', '2024-10-23 20:35:31'),
(180, 'boampong', 'Armourer', 'Thursday 24th of October 2024 12:04:44 AM', '2024-10-24 00:04:44'),
(181, 'boampong', 'Armourer', 'Thursday 24th of October 2024 08:36:10 PM', '2024-10-24 20:36:10'),
(182, 'boampong', 'Armourer', 'Thursday 24th of October 2024 09:04:46 PM', '2024-10-24 21:04:46'),
(183, 'boampong', 'Armourer', 'Thursday 24th of October 2024 09:24:17 PM', '2024-10-24 21:24:17'),
(184, 'boampong', 'Armourer', 'Thursday 24th of October 2024 10:14:54 PM', '2024-10-24 22:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `login_activity2`
--

CREATE TABLE `login_activity2` (
  `loginID` int(200) NOT NULL,
  `admin_username` varchar(500) NOT NULL,
  `user_role` varchar(200) NOT NULL,
  `last_login_time` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logout_activity`
--

CREATE TABLE `logout_activity` (
  `logoutID` int(200) NOT NULL,
  `loginID` int(200) NOT NULL,
  `admin_username` varchar(500) NOT NULL,
  `user_role` varchar(200) NOT NULL,
  `last_logout_time` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logout_activity`
--

INSERT INTO `logout_activity` (`logoutID`, `loginID`, `admin_username`, `user_role`, `last_logout_time`, `datetime`) VALUES
(71, 121, 'boampong', 'Armourer', 'Wednesday 2nd of October 2024 10:16:14 AM', '2024-10-02 10:16:14'),
(72, 121, 'boampong', 'Armourer', 'Sunday 6th of October 2024 09:18:29 AM', '2024-10-06 09:18:29'),
(73, 121, 'boampong', 'Armourer', 'Monday 7th of October 2024 02:46:45 PM', '2024-10-07 14:46:45'),
(74, 121, 'boampong', 'Armourer', 'Monday 7th of October 2024 03:15:03 PM', '2024-10-07 15:15:03'),
(75, 121, 'boampong', 'Armourer', 'Monday 7th of October 2024 03:53:04 PM', '2024-10-07 15:53:04'),
(76, 121, 'boampong', 'Armourer', 'Monday 7th of October 2024 06:20:14 PM', '2024-10-07 18:20:14'),
(77, 121, 'boampong', 'Armourer', 'Monday 7th of October 2024 07:18:17 PM', '2024-10-07 19:18:17'),
(78, 121, 'boampong', 'Armourer', 'Tuesday 8th of October 2024 12:26:51 AM', '2024-10-08 00:26:51'),
(79, 121, 'boampong', 'Armourer', 'Tuesday 8th of October 2024 01:18:35 AM', '2024-10-08 01:18:35'),
(80, 121, 'boampong', 'Armourer', 'Tuesday 8th of October 2024 01:17:57 PM', '2024-10-08 13:17:57'),
(81, 121, 'boampong', 'Armourer', 'Tuesday 8th of October 2024 02:18:39 PM', '2024-10-08 14:18:39'),
(82, 121, 'boampong', 'Armourer', 'Tuesday 8th of October 2024 03:11:27 PM', '2024-10-08 15:11:27'),
(83, 121, 'boampong', 'Armourer', 'Tuesday 8th of October 2024 11:13:41 PM', '2024-10-08 23:13:41'),
(84, 121, 'boampong', 'Armourer', 'Wednesday 9th of October 2024 01:38:16 PM', '2024-10-09 13:38:16'),
(85, 121, 'boampong', 'Armourer', 'Wednesday 9th of October 2024 02:38:08 PM', '2024-10-09 14:38:08'),
(86, 121, 'boampong', 'Armourer', 'Wednesday 9th of October 2024 03:25:39 PM', '2024-10-09 15:25:39'),
(87, 121, 'boampong', 'Armourer', 'Thursday 10th of October 2024 01:33:18 PM', '2024-10-10 13:33:18'),
(88, 121, 'boampong', 'Armourer', 'Thursday 10th of October 2024 02:16:26 PM', '2024-10-10 14:16:26'),
(89, 121, 'boampong', 'Armourer', 'Friday 11th of October 2024 01:48:14 PM', '2024-10-11 13:48:14'),
(90, 121, 'boampong', 'Armourer', 'Friday 11th of October 2024 04:56:37 PM', '2024-10-11 16:56:37'),
(91, 121, 'boampong', 'Armourer', 'Friday 11th of October 2024 06:03:58 PM', '2024-10-11 18:03:58'),
(92, 121, 'boampong', 'Armourer', 'Friday 11th of October 2024 06:42:42 PM', '2024-10-11 18:42:42'),
(93, 121, 'boampong', 'Armourer', 'Friday 11th of October 2024 08:52:03 PM', '2024-10-11 20:52:03'),
(94, 121, 'boampong', 'Armourer', 'Saturday 12th of October 2024 12:52:26 AM', '2024-10-12 00:52:26'),
(95, 121, 'boampong', 'Armourer', 'Saturday 12th of October 2024 01:39:19 AM', '2024-10-12 01:39:19'),
(96, 121, 'boampong', 'Armourer', 'Saturday 12th of October 2024 01:17:10 PM', '2024-10-12 13:17:10'),
(97, 121, 'boampong', 'Armourer', 'Saturday 12th of October 2024 03:47:56 PM', '2024-10-12 15:47:56'),
(98, 121, 'boampong', 'Armourer', 'Saturday 12th of October 2024 04:29:59 PM', '2024-10-12 16:29:59'),
(99, 121, 'boampong', 'Armourer', 'Saturday 12th of October 2024 06:23:32 PM', '2024-10-12 18:23:32'),
(100, 121, 'boampong', 'Armourer', 'Saturday 12th of October 2024 07:47:08 PM', '2024-10-12 19:47:08'),
(101, 121, 'boampong', 'Armourer', 'Saturday 12th of October 2024 11:14:27 PM', '2024-10-12 23:14:27'),
(102, 121, 'boampong', 'Armourer', 'Monday 14th of October 2024 05:16:11 PM', '2024-10-14 17:16:11'),
(103, 121, 'boampong', 'Armourer', 'Monday 14th of October 2024 10:16:00 PM', '2024-10-14 22:16:00'),
(104, 121, 'boampong', 'Armourer', 'Monday 14th of October 2024 11:16:42 PM', '2024-10-14 23:16:42'),
(105, 121, 'boampong', 'Armourer', 'Tuesday 15th of October 2024 01:50:47 PM', '2024-10-15 13:50:47'),
(106, 121, 'boampong', 'Armourer', 'Tuesday 15th of October 2024 04:11:32 PM', '2024-10-15 16:11:32'),
(107, 121, 'boampong', 'Armourer', 'Tuesday 15th of October 2024 11:38:05 PM', '2024-10-15 23:38:05'),
(108, 121, 'boampong', 'Armourer', 'Wednesday 16th of October 2024 01:06:56 AM', '2024-10-16 01:06:56'),
(109, 121, 'boampong', 'Armourer', 'Wednesday 16th of October 2024 01:53:01 PM', '2024-10-16 13:53:01'),
(110, 121, 'boampong', 'Armourer', 'Wednesday 16th of October 2024 04:05:14 PM', '2024-10-16 16:05:14'),
(111, 121, 'boampong', 'Armourer', 'Wednesday 16th of October 2024 08:55:43 PM', '2024-10-16 20:55:43'),
(112, 121, 'boampong', 'Armourer', 'Wednesday 16th of October 2024 09:22:35 PM', '2024-10-16 21:22:35'),
(113, 121, 'boampong', 'Armourer', 'Thursday 17th of October 2024 12:04:25 AM', '2024-10-17 00:04:25'),
(114, 121, 'boampong', 'Armourer', 'Thursday 17th of October 2024 12:39:01 AM', '2024-10-17 00:39:01'),
(115, 121, 'boampong', 'Armourer', 'Thursday 24th of October 2024 12:04:29 AM', '2024-10-24 00:04:29'),
(116, 121, 'boampong', 'Armourer', 'Thursday 24th of October 2024 08:35:01 PM', '2024-10-24 20:35:01'),
(117, 121, 'boampong', 'Armourer', 'Thursday 24th of October 2024 09:04:35 PM', '2024-10-24 21:04:35'),
(118, 121, 'boampong', 'Armourer', 'Thursday 24th of October 2024 09:24:06 PM', '2024-10-24 21:24:06'),
(119, 121, 'boampong', 'Armourer', 'Thursday 24th of October 2024 10:14:30 PM', '2024-10-24 22:14:30');

-- --------------------------------------------------------

--
-- Table structure for table `logout_activity2`
--

CREATE TABLE `logout_activity2` (
  `logoutID` int(200) NOT NULL,
  `admin_username` varchar(500) NOT NULL,
  `user_role` varchar(200) NOT NULL,
  `last_logout_time` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(200) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages2`
--

CREATE TABLE `messages2` (
  `msg_id` int(200) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(100) NOT NULL,
  `noti_user_uniqueid` varchar(100) NOT NULL,
  `noti_status` varchar(100) NOT NULL,
  `noti_date` varchar(100) NOT NULL,
  `noti_type` varchar(100) NOT NULL,
  `noti_url` varchar(100) NOT NULL,
  `noti_uniqueid` varchar(100) NOT NULL,
  `noti_table` varchar(100) NOT NULL,
  `noti_seen` varchar(100) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `noti_user_uniqueid`, `noti_status`, `noti_date`, `noti_type`, `noti_url`, `noti_uniqueid`, `noti_table`, `noti_seen`, `datetime`) VALUES
(1, '12345', 'active', '02/072024', 'Going', 'https://www.wonderglory.com', '1234567', 'Toyota', 'Yes', '2024-07-22 02:31:12'),
(2, '12345', 'active', '02/072024', 'Going', 'https://www.wonderglory.com', '1234567', 'Toyota', 'Yes', '2024-07-22 02:31:17');

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `officerID` int(100) NOT NULL,
  `officer_status` varchar(100) NOT NULL,
  `officer_image` varchar(500) NOT NULL,
  `officer_service_no` varchar(500) NOT NULL,
  `rank` varchar(500) NOT NULL,
  `full_name` varchar(500) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `dept_unit` varchar(500) NOT NULL,
  `phone_no` varchar(100) NOT NULL,
  `officer_email` varchar(500) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officers`
--

INSERT INTO `officers` (`officerID`, `officer_status`, `officer_image`, `officer_service_no`, `rank`, `full_name`, `gender`, `dept_unit`, `phone_no`, `officer_email`, `datetime`) VALUES
(1, 'Active In Service', '6703fd151a37c3.14771957.jpg', '58553', 'CONST', 'Mumin fuseni Abdul ', 'Male', 'CTD', '0242937844', 'fuseniabdulmuni62@gmail.com', '2024-10-24 20:51:15'),
(2, 'Active In Service', '670413824bd6d9.66769177.jpg', '56140', 'L/CPL', 'Samuel Ntim', 'Male', 'CTD', '0558110251', 'dreevil200@gmail.com', '2024-10-24 20:51:20'),
(3, 'Active In Service', '670414b5f1c316.79734802.jpg', '56530', 'L/CPL', 'Stephen Owusu', 'Male', 'CTD', '0559536194', 'stephenwusu018@gmail.com', '2024-10-24 20:51:23'),
(4, 'Active In Service', '67041579c4d831.81684806.jpg', '58473', 'CONST', 'Eugene Bronya', 'Male', 'CTD', '0547582507', 'bronyaeugene@gmail.com', '2024-10-24 20:51:25'),
(5, 'Active In Service', '67041648580437.44530840.jpg', '58330', 'CONST', 'Stephen Darko', 'Male', 'CTD', '0549052144', 'ember7@gmail.com', '2024-10-24 20:51:27'),
(6, 'Active In Service', '6704174d634f39.73322795.jpg', '58595', 'CONST', 'Gehead Yeboah', 'Male', 'CTD', '0543100787', 'Geheady@gmail.com', '2024-10-24 20:51:29'),
(7, 'Active In Service', '670418a21a45d6.39486442.jpg', '57863', 'CONST', 'Bismark Mills', 'Male', 'CTD', '0545382372', 'mllsb1995@gmail.com', '2024-10-24 20:51:34'),
(8, 'Active In Service', '67042786b8ea45.90840463.jpg', '46522', 'SGT', 'Gordwin Afenyo', 'Male', 'CTD', '0246419071', 'estoppelgodwin@yahoo.com', '2024-10-24 20:51:37'),
(9, 'Active In Service', '6704289ec91cf0.11312930.jpg', '58459', 'CONST', 'Lawrence Acheampong', 'Male', 'CTD', '0241752325', 'lawrencejay19@yahoo.com', '2024-10-24 20:51:39'),
(10, 'Active In Service', '670429df5240a6.06880408.jpg', '58547', 'CONST', 'Abudu Abubakari', 'Male', 'CTD', '0267085827', 'abubakariWd@gmai.com', '2024-10-24 20:51:44'),
(11, 'Active In Service', '67042ae3572ec4.98068389.jpg', '53894', 'L/CPL', 'Aikins Emmanuel', 'Male', 'CTD', '0538054793.', 'aikinsemmanuel597@gmail.com', '2024-10-24 20:51:49'),
(12, 'Active In Service', '67042c90164ed9.78428298.jpg', '53606', 'L/CPL', 'Ebenezer Aning Nti', 'Male', 'CTD', '0554676667', 'aningnti100@gmail.com', '2024-10-24 20:51:52'),
(13, 'Active In Service', '67042def908e34.16990129.jpg', '54669', 'L/CPL', 'Felix Appiah', 'Male', 'CTD', '0547296972', 'Appiahfelix36@gmail.com', '2024-10-24 20:51:58'),
(14, 'Active In Service', '6704415cc86bd6.27878216.jpg', '57569', 'CONST', 'Abdul Malik  Yussif', 'Male', 'CTD', '0546771101', 'malikabduyussif@gmail.com', '2024-10-24 20:52:06'),
(15, 'Active In Service', '670442c4111208.16560713.jpg', '54551', 'L/CPL', 'Paul Opolibi Yegben', 'Male', 'CTD', '0244196398', 'paulopo402@gmail.com', '2024-10-24 20:52:10'),
(16, 'Active In Service', '670445e19dc7f3.40837212.jpg', '22455', 'INSPR', 'Roland Tetteh', 'Male', 'CTD', '0243518867', 'rolandcole2000@gmail.com', '2024-10-24 20:52:15'),
(17, 'Active In Service', '67047d6b7f6336.57061364.jpg', '58460', 'CONST', 'Alex Pwatiu', 'Male', 'CTD', '0244939364', 'PWATIU@gmail.com', '2024-10-24 20:52:18'),
(18, 'Active In Service', '67048942aa7eb4.33246253.jpg', '58125', 'CONST', 'Benjamin Asiedu ', 'Male', 'CTD', '0244806120', 'kwekumensahadiepena@gmail.com', '2024-10-24 20:52:22'),
(19, 'Active In Service', '67048c1cbb2b82.22334787.jpg', '58353', 'CONST', 'Paul Father Tsibuah', 'Male', 'CTD', '0243016905', 'paulfathertsiboah@gmail.com', '2024-10-24 20:52:27'),
(20, 'Active In Service', '670531cf0db154.03197498.jpg', '58551', 'CONST', 'Bright OPoku Agyei', 'Male', 'CTD', '05582962533', 'Brightopuku2010@gmail.com', '2024-10-24 20:52:32'),
(21, 'Active In Service', '670532ff162947.50573292.jpg', '58516', 'CONST', 'Ernest Yeboah', 'Male', 'CTD', '0550249176', 'ernestyeboah484@gmail.com', '2024-10-24 20:52:35'),
(22, 'Active In Service', '6705344089fe95.00990441.jpg', '58571', 'CONST', 'Hubert Osei Boamteng ', 'Male', 'CTD', '0558750440', 'hubert.oseiboateng111@gmail.com', '2024-10-24 20:52:38'),
(23, 'Active In Service', '6705354df1c810.04457986.jpg', '58092', 'CONST', 'Benjamin Sarpong ', 'Male', 'CTD', '0249270443', 'sarpongbenjamin000@gmail.com', '2024-10-24 20:52:42'),
(24, 'Active In Service', '670536abe9c706.72689736.jpg', '58442', 'CONST', 'David Sedem', 'Male', 'CTD', '0243505841', 'sedemreal@gmail.com', '2024-10-24 20:52:46'),
(25, 'Active In Service', '670538041656d2.46636766.jpg', '58515', 'CONST', 'Francis Kyei', 'Male', 'CTD', '0245955040', 'fkyei65@gmail.com', '2024-10-24 20:52:49'),
(26, 'Active In Service', '67053feeb2b394.69718031.jpg', '57914', 'CONST', 'Kenny Adarkwah ', 'Male', 'CTD', '0245620209', 'sirkenny44@gmail.com', '2024-10-24 20:52:53'),
(27, 'Active In Service', '67054194c8c660.32184331.jpg', '58214', 'CONST', 'Biney Alex Mensah', 'Male', 'CTD', '0207393654', 'mensahbineyalex001@gmail.com', '2024-10-24 20:52:59'),
(28, 'Active In Service', '67054263363cb2.26951630.jpg', '58463', 'CONST', 'Benjamin Addy ', 'Male', 'CTD', '0241441803', 'addybenjamin78@gmail.com', '2024-10-24 20:53:01'),
(29, 'Active In Service', '670543f75f17e1.72713618.jpg', '5593', 'L/CPL', 'George  Osei Agyemang ', 'Male', 'CTD', '0554143127', 'oseiagyemenggeorge5076@gmail.com', '2024-10-24 22:31:22'),
(30, 'Active In Service', '670545d449f8b8.81272890.jpg', '46035', 'SGT', 'Solomon Mensah Kojo ', 'Male', 'CTD', '0243056464', 'solomonkojomensah1985@gmail.com', '2024-10-24 20:53:10'),
(31, 'Active In Service', '67054cb706d9d9.70134585.jpg', '49749', 'CPL', 'Rpbert Azamati ', 'Male', 'CTD', '0244156972', 'azamatirobert18@gmail.com', '2024-10-24 20:53:13'),
(32, 'Active In Service', '6706886537d993.29867182.jpg', '50128', 'CPL', 'Samuel Quaicoe ', 'Male', 'CTD', '0240447273', 'samuelquaicoe462@gmail.com', '2024-10-24 20:53:16'),
(33, 'Active In Service', '6706961e416552.04808775.jpg', '58198', 'CONST', 'Solomon Asomani ', 'Male', 'CTD', '0249900151', 'asomanisolomon939@gmail.com', '2024-10-24 20:53:20'),
(34, 'Active In Service', '670697d72147b2.04817119.jpg', '45232', 'SGT', 'Richard Boampong', 'Male', 'CTD', '0246846556', 'kofiboampong541@gmail.com', '2024-10-24 20:53:26'),
(35, 'Active In Service', '6707d8bf931f64.46150517.jpg', '55044 ', 'CONST', 'Fred  Agyekum ', 'Male', 'CTD', '0205084186', 'Fredagyekum83@gmail.com', '2024-10-24 20:53:29'),
(36, 'Active In Service', '6707dc04e99862.44989633.jpg', '57976', 'CONST', 'Richmond  Agyei Yeboah ', 'Male', 'CTD', '0505204123', 'Agyeiyeboah123@gmail.com', '2024-10-24 20:53:33'),
(37, 'Active In Service', '67095ae1ebd535.45336542.jpg', '56462', 'L/CPL', 'Maxwel  Darko ', 'Male', 'CTD', '0241271891', 'darkomaxwrll@gmail.com', '2024-10-24 20:53:37'),
(38, 'Active In Service', '67095c08ceab31.21111925.jpg', '46462', 'SGT', 'Simon Bryan  Tibila ', 'Male', 'CTD', '0241084244', 'simontbryan.stb@gmail.com', '2024-10-24 22:35:17'),
(39, 'Active In Service', '67095d077b5231.06692709.jpg', '53616 ', 'L/CPL', 'Richard  Asare', 'Male', 'CTD', '0247966351', 'asarevuga41@gmail.com', '2024-10-24 20:53:43'),
(40, 'Active In Service', '67095e65d81f22.13401100.jpg', '58604', 'CONST', 'Richard  Ntiamoah', 'Male', 'CTD', '0242586566', 'richntiamoah07@gmail.com', '2024-10-24 20:53:46'),
(41, 'Active In Service', '67095f75266453.32938529.jpg', '55068', 'L/CPL', 'Anthony Darko ', 'Male', 'CTD', '0247041041', 'tonydarko31@gmail.com', '2024-10-24 20:53:51'),
(42, 'Active In Service', '670969b38c1b62.57633076.jpg', '51727', 'CPL', 'Gyamfi Adu ', 'Male', 'CTD', '0243564537', 'soldiersoldierss674@gmail.com', '2024-10-24 20:53:54'),
(43, 'Active In Service', '67096b307bc127.62073914.jpg', '54296', 'L/CPL', 'Thomas Abu', 'Male', 'CTD', '0244060406', 'nanaabu156@gmail.com', '2024-10-24 20:53:57'),
(44, 'Active In Service', '67096c20261ed8.73226717.jpg', '58213', 'CONST', 'Abraham  Nkumdow ', 'Male', 'CTD', '0243786382', 'nkumdowa@gmail.com', '2024-10-24 20:54:01'),
(45, 'Active In Service', '6709733c1bdde0.34082951.jpg', '49546', 'SGT', 'Fred Akafo Sena ', 'Male', 'CTD', '0246264161', 'akafofredsena@gmail.com', '2024-10-24 20:54:06'),
(46, 'Active In Service', '670974a6ebcdc9.60476512.jpg', '58239', 'CONST', 'Enerst Anim ', 'Male', 'CTD', '0241020547', 'animernerst2646@gmail.com', '2024-10-24 20:54:10'),
(47, 'Active In Service', '6709770413fd45.59674583.jpg', '57889', 'CONST', 'Alhassan Titia ', 'Male', 'CTD', '0243907377', 'titiaalhassan90@gmail.com', '2024-10-24 20:54:13'),
(48, 'Active In Service', '670978348f1886.12923791.jpg', '55363', 'L/CPL', 'Erick Acquah', 'Male', 'CTD', '0240339746', 'acquahkojo3@gmail.com', '2024-10-24 20:54:18'),
(49, 'Active In Service', '6709794af04955.95178375.jpg', '55103', 'L/CPL', 'Samuel  Fianko ', 'Male', 'CTD', '0240508231', 'nanadomprehgolgi7449@gmai.com', '2024-10-24 20:54:23'),
(50, 'Active In Service', '67097ced866503.04367163.jpg', '54309', 'L/CPL', 'Yakubu  Abdul Majeed ', 'Male', 'CTD', '044478856', 'abdulmajeedyakubu@gmail.com', '2024-10-24 20:54:27'),
(51, 'Active In Service', '670991afc3be08.69093032.jpg', '49665', 'SGT', 'Wilson Agbley Selorm ', 'Male', 'CTD', '024794954799', 'nanayaowilson@gmail.com', '2024-10-24 20:54:30'),
(52, 'Active In Service', '6709930ecb00a7.47826854.jpg', '53906', 'L/CPL', 'Jonathanthn1@gmail.com Tansang ', 'Male', 'CTD', '0540116494', 'tansangjn@gmail.com', '2024-10-24 20:54:34'),
(53, 'Active In Service', '6709946aaa8ea4.72606989.jpg', '55101', 'L/CPL', 'Reuben Ayivi ', 'Male', 'CTD', '0542464600', 'reubenselasi19@gmailk.com', '2024-10-24 22:35:41'),
(54, 'Active In Service', '6709d347ed8bc6.57513439.jpg', '55933', 'L/CPL', 'Kamaldeen  Awudu', 'Male', 'CTD', '0549269235', 'kamaldeen.999k@gmail.com', '2024-10-24 20:54:58'),
(55, 'Active In Service', '670a788174fa91.75312494.jpg', '10569', 'CONST', 'Alberta Asieduwaa', 'Male', 'CTD', '0540417582', 'amoakoalberta49@gmail.com', '2024-10-24 20:55:01'),
(56, 'Active In Service', '670a7a37a5ed83.64890035.jpg', '10706', 'L/CPL', 'Emelia Akyamaa', 'Female', 'CTD', '0247656515', 'glakpeemelia8@gmail.com', '2024-10-24 20:55:06'),
(57, 'Active In Service', '670a7b25510500.45378903.jpg', '58443', 'CONST', 'David Mpanga Tamanja', 'Male', 'CTD', '0547301280', 'mpangatamanja@gmail.com', '2024-10-24 20:55:09'),
(58, 'Active In Service', '670a7c1c5ceac9.61008012.jpg', '58461', 'CONST', 'Bismark Kyeremeh ', 'Male', 'CTD', '0556074895', 'kyeremehb82@gmail.com', '2024-10-24 20:55:14'),
(59, 'Active In Service', '670a7d13d26c27.84839470.jpg', '10048', 'L/CPL', 'Elizabet Appiah', 'Female', 'CTD', '0247138046', 'appiaelizabet496@gmail.com', '2024-10-24 20:55:21'),
(60, 'Active In Service', '670a7e0a6529a5.53658237.jpg', '53610', 'L/CPL', 'Foster Asante', 'Male', 'CTD', '0545215780', 'asantefoster720@gmail.com', '2024-10-24 20:55:26'),
(61, 'Active In Service', '670a7fa8700e36.74567968.jpg', '58283', 'L/CPL', 'Ebenezer Mortey ', 'Male', 'CTD', '0552792323', 'ebenezermortey1@gmail.com', '2024-10-24 20:55:35'),
(62, 'Active In Service', '670a851cc27c22.41754167.jpg', '53589', 'L/CPL', 'Robert Owusu ', 'Male', 'CTD', '0554494169', 'st.owusu9494@gmail.com', '2024-10-24 20:55:38'),
(63, 'Active In Service', '670a8715558cb9.30761193.jpg', '58113', 'CONST', 'Emmanuel Quarshie Acquah', 'Male', 'CTD', '0549564963', 'flexibee22@gmail.com', '2024-10-24 20:55:43'),
(64, 'Active In Service', '670a87ec729e25.33018494.jpg', '48463', 'CPL', 'Selorm Awuku', 'Male', 'CTD', '0246887020', 'selormawuku12@gmail.com', '2024-10-24 20:55:47'),
(65, 'Active In Service', '670a8980872d51.88148350.jpg', '54302', 'L/CPL', 'Wisdom Aglili ', 'Male', 'CTD', '0548117289', 'aglili10@gmail.com', '2024-10-24 20:55:50'),
(66, 'Active In Service', '670a8b3005c3e4.93267699.jpg', '58387', 'CONST', 'Isaac Owusu Antwi', 'Male', 'CTD', '0243685312', 'paajoe667@gmail.com', '2024-10-24 20:55:54'),
(67, 'Active In Service', '670aa6c3e17112.83450091.jpg', '56529', 'L/CPL', 'Braimah  Winitor Amissah ', 'Male', 'CTD', '0546482791', 'winitoramissabraimah@gmail.com', '2024-10-24 20:55:58'),
(68, 'Active In Service', '670aa85533dd36.36976861.jpg', '57984', 'CONST', 'Issac Osei Bonsu', 'Male', 'CTD', '0241045801', 'isaacoseibnsu7732@gmail.com', '2024-10-24 20:56:04'),
(69, 'Active In Service', '670aab5c426928.37810581.jpg', '58039', 'CONST', 'Clement Aryeetey ', 'Male', 'CTD', '0558270613', 'cleair101@gmail.com', '2024-10-24 20:56:10'),
(70, 'Active In Service', '670aaea75d7490.66417044.jpg', '56599', 'L/CPL', 'Nicholas Awum,bila ', 'Male', 'CTD', '0240670007', 'awumbilanicholas36@gmail.com', '2024-10-24 20:56:17'),
(71, 'Active In Service', '670ab0510bdb64.64060199.jpg', '53631', 'L/CPL', 'Degraft Appiah Kwadwo ', 'Male', 'CTD', '0245745772', 'Degraftappiah18@gmail.com', '2024-10-24 20:56:24'),
(72, 'Active In Service', '670ab127615669.03921218.jpg', '56091', 'L/CPL', 'Bright Nkrumah', 'Male', 'CTD', '0241449009', 'Brightnkrumah18@gmail.com', '2024-10-24 20:56:27'),
(73, 'Active In Service', '670ab42e2616e8.61771138.jpg', '53888', 'CONST', 'John Kojo Aggrey ', 'Male', 'CTD', '0241105981', 'kojoaggrey99@gmail.com', '2024-10-24 20:56:30'),
(74, 'Active In Service', '670ab5a24c8953.16320159.jpg', '53671', 'L/CPL', 'Francis Osei', 'Male', 'CTD', '0550161564', 'oseiy660@gmail.com', '2024-10-24 20:56:35'),
(75, 'Active In Service', '670ab6609f0a80.70525852.jpg', '48725', 'CPL', 'Ebenezer Oti ', 'Male', 'CTD', '0245023676', 'Otiebenezer686@gmail.com', '2024-10-24 22:36:02'),
(76, 'Active In Service', '670ab7932da7e3.88717539.jpg', '53887', 'L/CPL', 'Justice Ankah ', 'Male', 'CTD', '0544122908', 'kofiankah75@gmail.com', '2024-10-24 20:56:43'),
(77, 'Active In Service', '670ac0b641edb5.29866001.jpg', '55065', 'L/CPL', 'Patrick Togobo', 'Male', 'CTD', '0241476070', 'liltyme95@gmail.com', '2024-10-24 20:57:22'),
(78, 'Active In Service', '670ac218c13706.05787201.jpg', '47143', 'L/CPL', 'Julius Sewordo', 'Male', 'CTD', '0243622999', 'juliusheyman2015@gmail.com', '2024-10-24 20:57:28'),
(79, 'Active In Service', '670ac34473f1e2.40200754.jpg', '54664', 'L/CPL', 'Isaac Obeng ', 'Male', 'CTD', '0248204201', 'obengisaac301@gmail.com', '2024-10-24 20:57:33'),
(80, 'Active In Service', '670ac4f0bcb576.09985468.jpg', '56139', 'L/CPL', 'Attuquaye Nii Clottey', 'Male', 'CTD', '0541120424', 'clotteyjoel18@gmail.com', '2024-10-24 20:57:38'),
(81, 'Active In Service', '670ac61da09a43.12621180.jpg', '54678', 'L/CPL', 'Ibrahim Seidu ', 'Male', 'CTD', '0549462670', 'seidu.ibrahim10000@gmail.com', '2024-10-24 20:57:43'),
(82, 'Active In Service', '670ac72b992a43.86282595.jpg', '55996', 'L/CPL', 'Isaac Oberko ', 'Male', 'CTD', '0244349008', 'Abilityagyei@gmail.com', '2024-10-24 20:58:04'),
(83, 'Active In Service', '670ac852744c44.93605111.jpg', '56297', 'L/CPL', 'Emmanuel Owusu Ntow ', 'Male', 'CTD', '0241245625', 'owusuntow18@gmail.com', '2024-10-24 20:58:09'),
(84, 'Active In Service', '670ad384951d08.94188639.jpg', '58339', 'CONST', 'Emmanuel Painstsil', 'Male', 'CTD', '0245138073', 'emmanuelpainstsil02@gmail.com', '2024-10-24 20:58:14'),
(85, 'Active In Service', '670ad4a7d285e4.09754654.jpg', '53900', 'L/CPL', 'Micheal Baah', 'Male', 'CTD', '0243209811', 'michealbaahhanson@gmail.com', '2024-10-24 20:58:18'),
(86, 'Active In Service', '670ad60e995dc5.86438225.jpg', '55864', 'L/CPL', 'Ambrose Lier', 'Male', 'CTD', '0248672121', 'ambroselier21@gmail.com', '2024-10-24 20:58:21'),
(87, 'Active In Service', '670ad6ddef2d01.25590632.jpg', '56213', 'L/CPL', 'Peter Adu ', 'Male', 'CTD', '0541614101', 'adupeterr@gmail.com', '2024-10-24 20:58:26'),
(88, 'Active In Service', '670ad8e6cea4b1.70198742.jpg', '56337', 'L/CPL', 'Oxford Owusu ', 'Male', 'CTD', '0558341356', 'oxfordgyimah19@gmail.com', '2024-10-24 20:58:30'),
(89, 'Active In Service', '670ada05d2f565.68256574.jpg', '58416', 'CONST', 'Clement Oteng ', 'Male', 'CTD', '0532371094', 'clementoteng8@gmail.com', '2024-10-24 20:58:32'),
(90, 'Active In Service', '670adb5973df83.05469489.jpg', '54668', 'L/CPL', 'Karim Abass Abdul', 'Male', 'CTD', '0249535523', 'abasskarim321@gmail.com', '2024-10-24 20:58:36'),
(91, 'Active In Service', '670adc8a819672.08670500.jpg', '56216', 'L/CPL', 'Emmanuel Annor ', 'Male', 'CTD', '0541383646', 'annoremmanuel063@gmali.com', '2024-10-24 20:58:38'),
(92, 'Active In Service', '670addcd1feb23.40568844.jpg', '54312', 'L/CPL', 'Winfred Afewu ', 'Male', 'CTD', '0507296427', 'yaowinfred78@gmail.com', '2024-10-24 20:58:41'),
(93, 'Active In Service', '670adeeb140c29.45500728.jpg', '56062', 'L/CPL', 'James  Akotto Baffour ', 'Male', 'CTD', '0251960417', 'jbafour122@gmail.com', '2024-10-24 20:58:55'),
(94, 'Active In Service', '670ae03a4d0604.03854794.jpg', '57935', 'CONST', 'Sadique Abubakar ', 'Male', 'CTD', '0552338383', 'abubakarsadique2623@gmail.com', '2024-10-24 20:58:59'),
(95, 'Active In Service', '670ae167040ab7.17350822.jpg', '56247', 'L/CPL', 'Daniel Korto', 'Male', 'CTD', '0241699424', 'kortodaniel@gmail.com', '2024-10-24 20:59:03'),
(96, 'Active In Service', '670ae245348c63.88837686.jpg', '58487', 'CONST', 'Francis Ofori ', 'Male', 'CTD', '0242324278', 'Oforifrancis864@gmasil.com', '2024-10-24 20:59:07'),
(97, 'Active In Service', '670ae3a26186c5.95821787.jpg', '54284', 'L/CPL', 'Tetteh Addo ', 'Male', 'CTD', '0543604447', 'Holysam654@gmail.com', '2024-10-24 20:59:10'),
(98, 'Active In Service', '670ae4a224aad6.70461340.jpg', '56014', 'L/CPL', 'Philip Glakpe', 'Male', 'CTD', '0240133404', 'mck777e@gmail.com', '2024-10-24 20:59:14'),
(99, 'Active In Service', '670ae607928de3.09545957.jpg', '56350', 'L/CPL', 'Isaac Mensah ', 'Male', 'CTD', '0240204534', 'Christikemenz072@gmail.com', '2024-10-24 20:59:20'),
(100, 'Active In Service', '670ae71e96e904.47633737.jpg', '58068', 'CONST', 'Magnus Ediem Yankson', 'Male', 'CTD', '0547099126', 'magnusyankson90@gmail.com', '2024-10-24 20:59:26'),
(101, 'Active In Service', '670b03f835e4a4.06242592.jpg', '4422', 'INSPR', 'Seidu Issah', 'Male', 'CTD', '0244870265', 'seidudollar4@gmail.com', '2024-10-24 20:59:32'),
(102, 'Active In Service', '670b05f9101409.52035554.jpg', '54666', 'L/CPL', 'Emmanuel  Kokwa ', 'Male', 'CTD', '0547092530', 'kokwaemmanuel@gmail.com', '2024-10-24 20:59:35'),
(103, 'Active In Service', '670b086f9fd9a3.75123873.jpg', '54660', 'L/CPL', 'Laud Kpodo Kwaku ', 'Male', 'CTD', '0550662014', 'kweku.banini@gmail.com', '2024-10-24 20:59:40'),
(104, 'Active In Service', '670b0b12d75bf7.81499515.jpg', '54253', 'L/CPL', 'Wisdom  Adzasu', 'Male', 'CTD', '02426501744', 'wisdomonej@gmai.com', '2024-10-24 20:59:44'),
(105, 'Active In Service', '670b0e4de89b78.04704670.jpg', '58192', 'CONST', 'Ibrahim Abubakari', 'Male', 'CTD', '0209240782', 'iabubakari1994@gmail.com', '2024-10-24 20:59:48'),
(106, 'Active In Service', '670b0f642ad830.10357336.jpg', '58414', 'CONST', 'Clement  Ofori ', 'Male', 'CTD', '0244599805', 'Oforiclement66@gmail.com', '2024-10-24 20:59:52'),
(107, 'Active In Service', '670b109763c445.83896096.jpg', '58578', 'CONST', 'Emmanuel Appiah Agyei ', 'Male', 'CTD', '0544697741', 'appiaagyeiemmanuel96@gmail.com', '2024-10-24 20:59:57'),
(108, 'Active In Service', '670b1283ce2595.34242330.jpg', '54663', 'L/CPL', 'Godwill  Kyereme', 'Male', 'CTD', '0543643401', 'godwillkyereme@gmail.com', '2024-10-24 21:00:02'),
(109, 'Active In Service', '670d52cc85ef84.62698389.jpg', '53634', 'L/CPL', 'Junior Asare Isaac', 'Male', 'CTD', '0242343147', 'asareisaac474@gmail.com', '2024-10-24 21:00:13'),
(110, 'Active In Service', '670da65a50ed80.41477792.jpg', '51977', 'L/CPL', 'Micheal Arlloo', 'Male', 'CTD', '0248259370', 'yawmichealarlloo@gmail.com', '2024-10-24 21:00:19'),
(111, 'Active In Service', '670da7cc028bb3.05153100.jpg', '56468', 'L/CPL', 'Mohammed Nkrumah ', 'Male', 'CTD', '0555522171', 'nkrumahmohammed1956@gmail.com', '2024-10-24 21:00:28'),
(112, 'Active In Service', '670da935ee7401.13602923.jpg', '58173', 'CONST', 'David Gmakikubi Tabil', 'Male', 'CTD', '0543592166', 'tdmgmakikubi12@gmail.com', '2024-10-24 21:00:30'),
(113, 'Active In Service', '670daa943fab19.34119200.jpg', '53629', 'L/CPL', 'Samuel  Asante Antwi ', 'Male', 'CTD', '0548583917', 'samuelantwiasante1992@gmail.com', '2024-10-24 21:00:37'),
(114, 'Active In Service', '670e96c98a31a9.37399505.jpg', '57955', 'CONST', 'Mohammed  Laryea Nuredeen ', 'Male', 'CTD', '0557458370', 'Kingnuredeenlaryea@gmail.com', '2024-10-24 21:00:43'),
(115, 'Active In Service', '670e9a5707ac50.56725284.jpg', '55932', 'L/CPL', 'Micheal  Antwi George ', 'Male', 'CTD', '0504641395', 'GeargeAntwiMicheal@gmail.com', '2024-10-24 21:00:54'),
(116, 'Active In Service', '670e9bca6aa497.94327449.jpg', '44842', 'SGT', 'Ernerst  Appiah', 'Male', 'CTD', '0244973310', 'ernerstnick310@gmaii.com', '2024-10-24 21:01:07'),
(117, 'Active In Service', '670e9d362d9503.60323358.jpg', '54675', 'L/CPL', 'Samuel  Owusu ', 'Male', 'CTD', '0248058550', 'getsavioula16@gmail.com', '2024-10-24 21:01:13'),
(118, 'Active In Service', '670e9e8f112572.82339985.jpg', '58585', 'CONST', 'Williams  Kwoffie ', 'Male', 'CTD', '0591056732', 'WilliamsonKwoffie@gmail.com', '2024-10-24 21:01:17'),
(119, 'Active In Service', '670e9ff297ae84.16146429.jpg', '58532 ', 'CONST', 'Richard  Ankamah ', 'Male', 'CTD', '0558405524', 'richardankamah222@gmail.com', '2024-10-24 21:01:25'),
(120, 'Active In Service', '670ea1955af439.95203150.jpg', '58549', 'L/CPL', 'David  Midzodzi Cudjoe ', 'Male', 'CTD', '0287495827', 'Cudjoedavid74@gmail.com', '2024-10-24 21:01:34'),
(121, 'Active In Service', '670ea374472154.55132401.jpg', '47808', 'CPL', 'Bernard Balig ', 'Male', 'CTD', '0546959690', 'bernardbalig@gmail.com', '2024-10-24 21:01:38'),
(122, 'Active In Service', '670eaaf6eea390.74345655.jpg', '22139', 'INSPR', 'Mathias Nwaaro ', 'Male', 'CTD', '0269474394', 'humbletiger6868@gmail.com', '2024-10-24 21:01:42'),
(123, 'Active In Service', '670efdd7079978.67363791.jpg', '56503', 'L/CPL', 'Benjamin  Osei Owusu ', 'Male', 'CTD', '0553369882', 'oseiowusubenjamin22@gmail.com', '2024-10-24 21:01:46'),
(124, 'Active In Service', '670f141f8f5cf4.81811940.jpg', '58636', 'CONST', 'Collins  Agyei', 'Male', 'CTD', '0541783579', 'temperature467@gmail.com', '2024-10-24 21:01:54'),
(125, 'Active In Service', '670fc8b77b4539.14632392.jpg', '58049 ', 'CONST', 'Ezekiel  Wayo A. ', 'Male', 'CTD', '0541054160', 'WAYORANKING90@GMAIL.COM', '2024-10-24 21:02:03'),
(126, 'Active In Service', '670fc9c0ded073.95799658.jpg', '58431', 'CONST', 'Richard  Amankwah ', 'Male', 'CTD', '0244602812', 'RICHARDAMANKWAH2019@GMAIL.COM', '2024-10-24 21:02:08'),
(127, 'Active In Service', '670fca9cde93d6.18099682.jpg', '58331 ', 'CONST', 'Philip Sakah ', 'Male', 'CTD', '0534957494', 'SAKAH27@GMAIL.COM', '2024-10-24 21:02:13'),
(128, 'Active In Service', '670fcb76e29b28.13122470.jpg', '45323', 'SGT', 'Peter Owusu Mensah', 'Male', 'CTD', '0542746146', 'PETEROWUSU222@GMAIL.COM', '2024-10-24 21:02:16'),
(129, 'Active In Service', '670fcc9348a5e5.56365837.jpg', '53889', 'L/CPL', 'Fredrick  Owusu Ansah ', 'Male', 'CTD', '0209104547', 'OWUSUANSAHFREDRICK807@GMAIL.COM', '2024-10-24 21:02:21'),
(130, 'Active In Service', '670fcdcdc6ae86.95719341.jpg', '55948', 'L/CPL', 'Joe  Nakojah M. ', 'Male', 'CTD', '0558818568', 'NAKOJAH0011@GMAIL.COM', '2024-10-24 21:02:28'),
(131, 'Active In Service', '670fcef185c541.02107135.jpg', '46896', 'CPL', 'Eugene Odame Debrah', 'Male', 'CTD', '0240233318', 'KOLIKOBAAKO@GTMAIL.COM', '2024-10-24 21:02:32'),
(132, 'Active In Service', '670fd0477d9141.75726054.jpg', '44534', 'SGT', 'Daniel Kitiaku', 'Male', 'CTD', '0591474939', 'KIKIATUTETTEH@GMAIL.COM', '2024-10-24 21:02:35'),
(133, 'Active In Service', '670fd1b2d22ca9.13432080.jpg', '55984', 'L/CPL', 'Kingsford Ansere ', 'Male', 'CTD', '0540780767', 'KINGSFORDANSERE2@GMAIL.COM', '2024-10-24 21:02:40'),
(134, 'Active In Service', '670fd34369cb21.44909681.jpg', '53890', 'L/CPL', 'Sampson Otoo', 'Male', 'CTD', '0248307380', 'IDEASOTOO@GMAIL.COM', '2024-10-24 21:02:46'),
(135, 'Active In Service', '670fd4b3aee4d9.94687653.jpg', '58306', 'CONST', 'Humphrey  Eduah B.', 'Male', 'CTD', '0596876814', 'HUMPHREYNANAEDUAH@GMAIL.COM', '2024-10-24 21:02:49'),
(136, 'Active In Service', '670fd610966c88.94983645.jpg', '56493', 'L/CPL', 'Godwin Mensah', 'Male', 'CTD', '0591989567', 'GODWINB13@GMAIL.COM', '2024-10-24 21:03:00'),
(137, 'Active In Service', '67102e9ba84e35.21649175.jpg', '11916', 'CONST', 'Esther  Agyei ', 'Male', 'CTD', '0244754637', 'adepaagyei40@gmail.com', '2024-10-24 21:03:04'),
(138, 'Active In Service', '67105ca5b1ba30.08382331.jpg', '11904', 'CONST', 'Nancy Fuseini ', 'Male', 'CTD', '0532598389', 'Nancyfuseini24@gmail.com', '2024-10-24 21:03:07'),
(139, 'Active In Service', '67105d576c1de4.91825395.jpg', '56382', 'L/CPL', 'Emmanuel Appau', 'Male', 'CTD', '0453164389', 'EAPPAU17@GMAIL.COM', '2024-10-24 21:03:14'),
(140, 'Active In Service', '67105ecf0dce67.96627026.jpg', '58270', 'CONST', 'Clinton Boakye Yiadom', 'Male', 'CTD', '0240735757', 'BYIADOM762@GMAIL.COM', '2024-10-24 21:03:18'),
(141, 'Active In Service', '67106044468c99.30415501.jpg', '10049', 'L/CPL', 'Bridgette Asor Anokye', 'Female', 'CTD', '0553626125', 'BRIDGETTE.ANNOKYE@GMAIL.COM', '2024-10-24 21:03:21'),
(142, 'Active In Service', '67106242c07bd2.82366560.jpg', '53892', 'L/CPL', 'Evans Boakye ', 'Male', 'CTD', '0241083650', 'BBOAKYEEVI@GMAIL.COM', '2024-10-24 21:03:25'),
(143, 'Active In Service', '6710635aac50c3.80618134.jpg', '58029', 'CONST', 'Williams Ansah', 'Male', 'CTD', '0547365406', 'AKWO22@GMAIL.COM', '2024-10-24 21:03:31'),
(144, 'Active In Service', '6710655ac0cad5.87332520.jpg', '53903', 'L/CPL', 'Emmanuel Aidoo', 'Male', 'CTD', '0531119455', 'AIDOOEMMA1166@GMAIL.COM', '2024-10-24 21:03:35'),
(145, 'Active In Service', '671066be0594f1.65799854.jpg', '58630', 'CONST', 'Jacob Agyei', 'Male', 'CTD', '0550798563', 'AGYEIJACOB88@GMAIL.COM', '2024-10-24 21:03:43'),
(146, 'Active In Service', '671069627df518.15753064.jpg', '58598', 'CONST', 'Mankuyali Kofi Dawuni', 'Male', 'CTD', '0247382090', 'MANKUYALID@GMAIL.COM', '2024-10-24 21:03:52');

-- --------------------------------------------------------

--
-- Table structure for table `officers2`
--

CREATE TABLE `officers2` (
  `officerID` int(100) NOT NULL,
  `officer_status` varchar(100) NOT NULL,
  `officer_image` varchar(500) NOT NULL,
  `officer_service_no` varchar(500) NOT NULL,
  `rank` varchar(500) NOT NULL,
  `full_name` varchar(500) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `dept_unit` varchar(500) NOT NULL,
  `phone_no` varchar(100) NOT NULL,
  `officer_email` varchar(500) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officers2`
--

INSERT INTO `officers2` (`officerID`, `officer_status`, `officer_image`, `officer_service_no`, `rank`, `full_name`, `gender`, `dept_unit`, `phone_no`, `officer_email`, `datetime`) VALUES
(8, 'Active In Service', '6703fd151a37c3.14771957.jpg', '58553', 'CONST', 'Mumin fuseni Abdul ', 'Male', 'CTD', '0242937844', 'fuseniabdulmuni62@gmail.com', '2024-10-07 15:24:05'),
(9, 'Active In Service', '670413824bd6d9.66769177.jpg', '56140', 'L/CPL', 'Samuel Ntim', 'Male', 'CTD', '0558110251', 'dreevil200@gmail.com', '2024-10-07 16:59:46'),
(10, 'Active In Service', '670414b5f1c316.79734802.jpg', '56530', 'L/CPL', 'Stephen Owusu', 'Male', 'CTD', '0559536194', 'stephenwusu018@gmail.com', '2024-10-07 17:04:53'),
(11, 'Active In Service', '67041579c4d831.81684806.jpg', '58473', 'CONST', 'Eugene Bronya', 'Male', 'CTD', '0547582507', 'bronyaeugene@gmail.com', '2024-10-07 17:08:09'),
(12, 'Active In Service', '67041648580437.44530840.jpg', '58330', 'CONST', 'Stephen Darko', 'Male', 'CTD', '0549052144', 'ember7@gmail.com', '2024-10-07 17:11:36'),
(13, 'Active In Service', '6704174d634f39.73322795.jpg', '58595', 'CONST', 'Gehead Yeboah', 'Male', 'CTD', '0543100787', 'Geheady@gmail.com', '2024-10-07 17:15:57'),
(14, 'Active In Service', '670418a21a45d6.39486442.jpg', '57863', 'CONST', 'Bismark Mills', 'Male', 'CTD', '0545382372', 'mllsb1995@gmail.com', '2024-10-07 17:21:38'),
(15, 'Active In Service', '67042786b8ea45.90840463.jpg', '46522', 'SGT', 'Gordwin Afenyo', 'Male', 'CTD', '0246419071', 'estoppelgodwin@yahoo.com', '2024-10-07 18:25:10'),
(16, 'Active In Service', '6704289ec91cf0.11312930.jpg', '58459', 'CONST', 'Lawrence Acheampong', 'Male', 'CTD', '0241752325', 'lawrencejay19@yahoo.com', '2024-10-07 18:29:50'),
(17, 'Active In Service', '670429df5240a6.06880408.jpg', '58547', 'CONST', 'Abudu Abubakari', 'Male', 'CTD', '0267085827', 'abubakariWd@gmai.com', '2024-10-07 18:35:11'),
(18, 'Active In Service', '67042ae3572ec4.98068389.jpg', '53894', 'L/CPL', 'Aikins Emmanuel', 'Male', 'CTD', '0538054793.', 'aikinsemmanuel597@gmail.com', '2024-10-07 18:39:31'),
(19, 'Active In Service', '67042c90164ed9.78428298.jpg', '53606', 'L/CPL', 'Ebenezer Aning Nti', 'Male', 'CTD', '0554676667', 'aningnti100@gmail.com', '2024-10-07 18:46:40'),
(20, 'Active In Service', '67042def908e34.16990129.jpg', '54669', 'L/CPL', 'Felix Appiah', 'Male', 'CTD', '0547296972', 'Appiahfelix36@gmail.com', '2024-10-07 18:52:31'),
(21, 'Active In Service', '6704415cc86bd6.27878216.jpg', '57569', 'CONST', 'Abdul Malik  Yussif', 'Male', 'CTD', '0546771101', 'malikabduyussif@gmail.com', '2024-10-07 20:15:24'),
(22, 'Active In Service', '670442c4111208.16560713.jpg', '54551', 'L/CPL', 'Paul Opolibi Yegben', 'Male', 'CTD', '0244196398', 'paulopo402@gmail.com', '2024-10-07 20:21:24'),
(23, 'Active In Service', '670445e19dc7f3.40837212.jpg', '22455', 'INSPR', 'Roland Tetteh', 'Male', 'CTD', '0243518867', 'rolandcole2000@gmail.com', '2024-10-07 20:34:41'),
(24, 'Active In Service', '67047d6b7f6336.57061364.jpg', '58460', 'CONST', 'Alex Pwatiu', 'Male', 'CTD', '0244939364', 'PWATIU@gmail.com', '2024-10-08 00:31:39'),
(25, 'Active In Service', '67048942aa7eb4.33246253.jpg', '58125', 'CONST', 'Benjamin Asiedu ', 'Male', 'CTD', '0244806120', 'kwekumensahadiepena@gmail.com', '2024-10-08 01:22:10'),
(26, 'Active In Service', '67048c1cbb2b82.22334787.jpg', '58353', 'CONST', 'Paul Father Tsibuah', 'Male', 'CTD', '0243016905', 'paulfathertsiboah@gmail.com', '2024-10-08 01:34:20'),
(27, 'Active In Service', '670531cf0db154.03197498.jpg', '58551', 'CONST', 'Bright OPoku Agyei', 'Male', 'CTD', '05582962533', 'Brightopuku2010@gmail.com', '2024-10-08 13:21:19'),
(28, 'Active In Service', '670532ff162947.50573292.jpg', '58516', 'CONST', 'Ernest Yeboah', 'Male', 'CTD', '0550249176', 'ernestyeboah484@gmail.com', '2024-10-08 13:26:23'),
(29, 'Active In Service', '6705344089fe95.00990441.jpg', '58571', 'CONST', 'Hubert Osei Boamteng ', 'Male', 'CTD', '0558750440', 'hubert.oseiboateng111@gmail.com', '2024-10-08 13:31:44'),
(30, 'Active In Service', '6705354df1c810.04457986.jpg', '58092', 'CONST', 'Benjamin Sarpong ', 'Male', 'CTD', '0249270443', 'sarpongbenjamin000@gmail.com', '2024-10-08 13:36:13'),
(31, 'Active In Service', '670536abe9c706.72689736.jpg', '58442', 'CONST', 'David Sedem', 'Male', 'CTD', '0243505841', 'sedemreal@gmail.com', '2024-10-08 13:42:03'),
(32, 'Active In Service', '670538041656d2.46636766.jpg', '58515', 'CONST', 'Francis Kyei', 'Male', 'CTD', '0245955040', 'fkyei65@gmail.com', '2024-10-08 13:47:48'),
(33, 'Active In Service', '67053feeb2b394.69718031.jpg', '57914', 'CONST', 'Kenny Adarkwah ', 'Male', 'CTD', '0245620209', 'sirkenny44@gmail.com', '2024-10-08 14:21:34'),
(34, 'Active In Service', '67054194c8c660.32184331.jpg', '58214', 'CONST', 'Biney Alex Mensah', 'Male', 'CTD', '0207393654', 'mensahbineyalex001@gmail.com', '2024-10-08 14:28:36'),
(35, 'Active In Service', '67054263363cb2.26951630.jpg', '58463', 'CONST', 'Benjamin Addy ', 'Male', 'CTD', '0241441803', 'addybenjamin78@gmail.com', '2024-10-08 14:32:03'),
(36, 'Active In Service', '670543f75f17e1.72713618.jpg', '5593.1', 'L/CPL', 'George  Osei Agyemang ', 'Male', 'CTD', '0554143127', 'oseiagyemenggeorge5076@gmail.com', '2024-10-08 14:38:47'),
(37, 'Active In Service', '670545d449f8b8.81272890.jpg', '46035', 'SGT', 'Solomon Mensah Kojo ', 'Male', 'CTD', '0243056464', 'solomonkojomensah1985@gmail.com', '2024-10-08 14:46:44'),
(38, 'Active In Service', '67054cb706d9d9.70134585.jpg', '49749', 'CPL', 'Rpbert Azamati ', 'Male', 'CTD', '0244156972', 'azamatirobert18@gmail.com', '2024-10-08 15:16:07'),
(39, 'Active In Service', '6706886537d993.29867182.jpg', '50128', 'CPL', 'Samuel Quaicoe ', 'Male', 'CTD', '0240447273', 'samuelquaicoe462@gmail.com', '2024-10-09 13:43:01'),
(40, 'Active In Service', '6706961e416552.04808775.jpg', '58198', 'CONST', 'Solomon Asomani ', 'Male', 'CTD', '0249900151', 'asomanisolomon939@gmail.com', '2024-10-09 14:41:34'),
(41, 'Active In Service', '670697d72147b2.04817119.jpg', '45232', 'SGT', 'Richard Boampong', 'Male', 'CTD', '0246846556', 'kofiboampong541@gmail.com', '2024-10-09 14:48:55'),
(42, 'Active In Service', '6707d8bf931f64.46150517.jpg', '55044 ', 'CONST', 'Fred  Agyekum ', 'Male', 'CTD', '0205084186', 'Fredagyekum83@gmail.com', '2024-10-10 13:38:07'),
(43, 'Active In Service', '6707dc04e99862.44989633.jpg', '57976', 'CONST', 'Richmond  Agyei Yeboah ', 'Male', 'CTD', '0505204123', 'Agyeiyeboah123@gmail.com', '2024-10-10 13:52:04'),
(44, 'Active In Service', '67095ae1ebd535.45336542.jpg', '56462', 'L/CPL', 'Maxwel  Darko ', 'Male', 'CTD', '0241271891', 'darkomaxwrll@gmail.com', '2024-10-11 17:05:37'),
(45, 'Active In Service', '67095c08ceab31.21111925.jpg', '46462', 'SGT', 'Simon Bryan  Tibila ', 'Male', 'NVU', '0241084244', 'simontbryan.stb@gmail.com', '2024-10-11 17:10:32'),
(46, 'Active In Service', '67095d077b5231.06692709.jpg', '53616 ', 'L/CPL', 'Richard  Asare', 'Male', 'CTD', '0247966351', 'asarevuga41@gmail.com', '2024-10-11 17:14:47'),
(47, 'Active In Service', '67095e65d81f22.13401100.jpg', '58604', 'CONST', 'Richard  Ntiamoah', 'Male', 'CTD', '0242586566', 'richntiamoah07@gmail.com', '2024-10-11 17:20:37'),
(48, 'Active In Service', '67095f75266453.32938529.jpg', '55068', 'L/CPL', 'Anthony Darko ', 'Male', 'CTD', '0247041041', 'tonydarko31@gmail.com', '2024-10-11 17:25:09'),
(49, 'Active In Service', '670969b38c1b62.57633076.jpg', '51727', 'CPL', 'Gyamfi Adu ', 'Male', 'CTD', '0243564537', 'soldiersoldierss674@gmail.com', '2024-10-11 18:08:51'),
(50, 'Active In Service', '67096b307bc127.62073914.jpg', '54296', 'L/CPL', 'Thomas Abu', 'Male', 'CTD', '0244060406', 'nanaabu156@gmail.com', '2024-10-11 18:15:12'),
(51, 'Active In Service', '67096c20261ed8.73226717.jpg', '58213', 'CONST', 'Abraham  Nkumdow ', 'Male', 'CTD', '0243786382', 'nkumdowa@gmail.com', '2024-10-11 18:19:12'),
(52, 'Active In Service', '6709733c1bdde0.34082951.jpg', '49546', 'SGT', 'Fred Akafo Sena ', 'Male', 'CTD', '0246264161', 'akafofredsena@gmail.com', '2024-10-11 18:49:32'),
(53, 'Active In Service', '670974a6ebcdc9.60476512.jpg', '58239', 'CONST', 'Enerst Anim ', 'Male', 'CTD', '0241020547', 'animernerst2646@gmail.com', '2024-10-11 18:55:34'),
(54, 'Active In Service', '6709770413fd45.59674583.jpg', '57889', 'CONST', 'Alhassan Titia ', 'Male', 'CTD', '0243907377', 'titiaalhassan90@gmail.com', '2024-10-11 19:05:40'),
(55, 'Active In Service', '670978348f1886.12923791.jpg', '55363', 'L/CPL', 'Erick Acquah', 'Male', 'CTD', '0240339746', 'acquahkojo3@gmail.com', '2024-10-11 19:10:44'),
(56, 'Active In Service', '6709794af04955.95178375.jpg', '55103', 'L/CPL', 'Samuel  Fianko ', 'Male', 'CTD', '0240508231', 'nanadomprehgolgi7449@gmai.com', '2024-10-11 19:15:22'),
(57, 'Active In Service', '67097ced866503.04367163.jpg', '54309', 'L/CPL', 'Yakubu  Abdul Majeed ', 'Male', 'CTD', '044478856', 'abdulmajeedyakubu@gmail.com', '2024-10-11 19:30:53'),
(58, 'Active In Service', '670991afc3be08.69093032.jpg', '49665', 'SGT', 'Wilson Agbley Selorm ', 'Male', 'CTD', '024794954799', 'nanayaowilson@gmail.com', '2024-10-11 20:59:27'),
(59, 'Active In Service', '6709930ecb00a7.47826854.jpg', '53906', 'L/CPL', 'Jonathanthn1@gmail.com Tansang ', 'Male', 'CTD', '0540116494', 'tansangjn@gmail.com', '2024-10-11 21:05:18'),
(60, 'Active In Service', '6709946aaa8ea4.72606989.jpg', '55101', 'L/CPL', 'Reuben Ayivi ', 'Male', 'NVU', '0542464600', 'reubenselasi19@gmailk.com', '2024-10-11 21:11:06'),
(61, 'Active In Service', '6709d347ed8bc6.57513439.jpg', '55933', 'L/CPL', 'Kamaldeen  Awudu', 'Male', 'CTD', '0549269235', 'kamaldeen.999k@gmail.com', '2024-10-12 01:39:19'),
(62, 'Active In Service', '670a788174fa91.75312494.jpg', '10569', 'CONST', 'Alberta Asieduwaa', 'Male', 'CTD', '0540417582', 'amoakoalberta49@gmail.com', '2024-10-12 13:24:17'),
(63, 'Active In Service', '670a7a37a5ed83.64890035.jpg', '10706', 'L/CPL', 'Emelia Akyamaa', 'Female', 'CTD', '0247656515', 'glakpeemelia8@gmail.com', '2024-10-12 13:31:35'),
(64, 'Active In Service', '670a7b25510500.45378903.jpg', '58443', 'CONST', 'David Mpanga Tamanja', 'Male', 'CTD', '0547301280', 'mpangatamanja@gmail.com', '2024-10-12 13:35:33'),
(65, 'Active In Service', '670a7c1c5ceac9.61008012.jpg', '58461', 'CONST', 'Bismark Kyeremeh ', 'Male', 'CTD', '0556074895', 'kyeremehb82@gmail.com', '2024-10-12 13:39:40'),
(66, 'Active In Service', '670a7d13d26c27.84839470.jpg', '10048', 'L/CPL', 'Elizabet Appiah', 'Female', 'CTD', '0247138046', 'appiaelizabet496@gmail.com', '2024-10-12 13:43:47'),
(67, 'Active In Service', '670a7e0a6529a5.53658237.jpg', '53610', 'L/CPL', 'Foster Asante', 'Male', 'CTD', '0545215780', 'asantefoster720@gmail.com', '2024-10-12 13:47:54'),
(68, 'Active In Service', '670a7fa8700e36.74567968.jpg', '58283', 'L/CPL', 'Ebenezer Mortey ', 'Male', 'CTD', '0552792323', 'ebenezermortey1@gmail.com', '2024-10-12 13:54:48'),
(69, 'Active In Service', '670a851cc27c22.41754167.jpg', '53589', 'L/CPL', 'Robert Owusu ', 'Male', 'CTD', '0554494169', 'st.owusu9494@gmail.com', '2024-10-12 14:18:04'),
(70, 'Active In Service', '670a8715558cb9.30761193.jpg', '58113', 'CONST', 'Emmanuel Quarshie Acquah', 'Male', 'CTD', '0549564963', 'flexibee22@gmail.com', '2024-10-12 14:26:29'),
(71, 'Active In Service', '670a87ec729e25.33018494.jpg', '48463', 'CPL', 'Selorm Awuku', 'Male', 'CTD', '0246887020', 'selormawuku12@gmail.com', '2024-10-12 14:30:04'),
(72, 'Active In Service', '670a8980872d51.88148350.jpg', '54302', 'L/CPL', 'Wisdom Aglili ', 'Male', 'CTD', '0548117289', 'aglili10@gmail.com', '2024-10-12 14:36:48'),
(73, 'Active In Service', '670a8b3005c3e4.93267699.jpg', '58387', 'CONST', 'Isaac Owusu Antwi', 'Male', 'CTD', '0243685312', 'paajoe667@gmail.com', '2024-10-12 14:44:00'),
(74, 'Active In Service', '670aa6c3e17112.83450091.jpg', '56529', 'L/CPL', 'Braimah  Winitor Amissah ', 'Male', 'CTD', '0546482791', 'winitoramissabraimah@gmail.com', '2024-10-12 16:41:39'),
(75, 'Active In Service', '670aa85533dd36.36976861.jpg', '57984', 'CONST', 'Issac Osei Bonsu', 'Male', 'CTD', '0241045801', 'isaacoseibnsu7732@gmail.com', '2024-10-12 16:48:21'),
(76, 'Active In Service', '670aab5c426928.37810581.jpg', '58039', 'CONST', 'Clement Aryeetey ', 'Male', 'CTD', '0558270613', 'cleair101@gmail.com', '2024-10-12 17:01:16'),
(77, 'Active In Service', '670aaea75d7490.66417044.jpg', '56599', 'L/CPL', 'Nicholas Awum,bila ', 'Male', 'CTD', '0240670007', 'awumbilanicholas36@gmail.com', '2024-10-12 17:15:19'),
(78, 'Active In Service', '670ab0510bdb64.64060199.jpg', '53631', 'L/CPL', 'Degraft Appiah Kwadwo ', 'Male', 'CTD', '0245745772', 'Degraftappiah18@gmail.com', '2024-10-12 17:22:25'),
(79, 'Active In Service', '670ab127615669.03921218.jpg', '56091', 'L/CPL', 'Bright Nkrumah', 'Male', 'CTD', '0241449009', 'Brightnkrumah18@gmail.com', '2024-10-12 17:25:59'),
(80, 'Active In Service', '670ab42e2616e8.61771138.jpg', '53888', 'CONST', 'John Kojo Aggrey ', 'Male', 'CTD', '0241105981', 'kojoaggrey99@gmail.com', '2024-10-12 17:38:54'),
(81, 'Active In Service', '670ab5a24c8953.16320159.jpg', '53671', 'L/CPL', 'Francis Osei', 'Male', 'CTD', '0550161564', 'oseiy660@gmail.com', '2024-10-12 17:45:06'),
(82, 'Active In Service', '670ab6609f0a80.70525852.jpg', '48725', 'CPL', 'Ebenezer Oti ', 'Male', 'NVU', '0245023676', 'Otiebenezer686@gmail.com', '2024-10-12 17:48:16'),
(83, 'Active In Service', '670ab7932da7e3.88717539.jpg', '53887', 'L/CPL', 'Justice Ankah ', 'Male', 'CTD', '0544122908', 'kofiankah75@gmail.com', '2024-10-12 17:53:23'),
(84, 'Active In Service', '670ac0b641edb5.29866001.jpg', '55065', 'L/CPL', 'Patrick Togobo', 'Male', 'CTD', '0241476070', 'liltyme95@gmail.com', '2024-10-12 18:32:22'),
(85, 'Active In Service', '670ac218c13706.05787201.jpg', '47143', 'L/CPL', 'Julius Sewordo', 'Male', 'CTD', '0243622999', 'juliusheyman2015@gmail.com', '2024-10-12 18:38:16'),
(86, 'Active In Service', '670ac34473f1e2.40200754.jpg', '54664', 'L/CPL', 'Isaac Obeng ', 'Male', 'CTD', '0248204201', 'obengisaac301@gmail.com', '2024-10-12 18:43:16'),
(87, 'Active In Service', '670ac4f0bcb576.09985468.jpg', '56139', 'L/CPL', 'Attuquaye Nii Clottey', 'Male', 'CTD', '0541120424', 'clotteyjoel18@gmail.com', '2024-10-12 18:50:24'),
(88, 'Active In Service', '670ac61da09a43.12621180.jpg', '54678', 'L/CPL', 'Ibrahim Seidu ', 'Male', 'CTD', '0549462670', 'seidu.ibrahim10000@gmail.com', '2024-10-12 18:55:25'),
(89, 'Active In Service', '670ac72b992a43.86282595.jpg', '55996', 'L/CPL', 'Isaac Oberko ', 'Male', 'CTD', '0244349008', 'Abilityagyei@gmail.com', '2024-10-12 18:59:55'),
(90, 'Active In Service', '670ac852744c44.93605111.jpg', '56297', 'L/CPL', 'Emmanuel Owusu Ntow ', 'Male', 'CTD', '0241245625', 'owusuntow18@gmail.com', '2024-10-12 19:04:50'),
(91, 'Active In Service', '670ad384951d08.94188639.jpg', '58339', 'CONST', 'Emmanuel Painstsil', 'Male', 'CTD', '0245138073', 'emmanuelpainstsil02@gmail.com', '2024-10-12 19:52:36'),
(92, 'Active In Service', '670ad4a7d285e4.09754654.jpg', '53900', 'L/CPL', 'Micheal Baah', 'Male', 'CTD', '0243209811', 'michealbaahhanson@gmail.com', '2024-10-12 19:57:27'),
(93, 'Active In Service', '670ad60e995dc5.86438225.jpg', '55864', 'L/CPL', 'Ambrose Lier', 'Male', 'CTD', '0248672121', 'ambroselier21@gmail.com', '2024-10-12 20:03:26'),
(94, 'Active In Service', '670ad6ddef2d01.25590632.jpg', '56213', 'L/CPL', 'Peter Adu ', 'Male', 'CTD', '0541614101', 'adupeterr@gmail.com', '2024-10-12 20:06:53'),
(95, 'Active In Service', '670ad8e6cea4b1.70198742.jpg', '56337', 'L/CPL', 'Oxford Owusu ', 'Male', 'CTD', '0558341356', 'oxfordgyimah19@gmail.com', '2024-10-12 20:15:34'),
(96, 'Active In Service', '670ada05d2f565.68256574.jpg', '58416', 'CONST', 'Clement Oteng ', 'Male', 'CTD', '0532371094', 'clementoteng8@gmail.com', '2024-10-12 20:20:21'),
(97, 'Active In Service', '670adb5973df83.05469489.jpg', '54668', 'L/CPL', 'Karim Abass Abdul', 'Male', 'CTD', '0249535523', 'abasskarim321@gmail.com', '2024-10-12 20:26:01'),
(98, 'Active In Service', '670adc8a819672.08670500.jpg', '56216', 'L/CPL', 'Emmanuel Annor ', 'Male', 'CTD', '0541383646', 'annoremmanuel063@gmali.com', '2024-10-12 20:31:06'),
(99, 'Active In Service', '670addcd1feb23.40568844.jpg', '54312', 'L/CPL', 'Winfred Afewu ', 'Male', 'CTD', '0507296427', 'yaowinfred78@gmail.com', '2024-10-12 20:36:29'),
(100, 'Active In Service', '670adeeb140c29.45500728.jpg', '56062', 'L/CPL', 'James  Akotto Baffour ', 'Male', 'CTD', '0251960417', 'jbafour122@gmail.com', '2024-10-12 20:41:15'),
(101, 'Active In Service', '670ae03a4d0604.03854794.jpg', '57935', 'CONST', 'Sadique Abubakar ', 'Male', 'CTD', '0552338383', 'abubakarsadique2623@gmail.com', '2024-10-12 20:46:50'),
(102, 'Active In Service', '670ae167040ab7.17350822.jpg', '56247', 'L/CPL', 'Daniel Korto', 'Male', 'CTD', '0241699424', 'kortodaniel@gmail.com', '2024-10-12 20:51:51'),
(103, 'Active In Service', '670ae245348c63.88837686.jpg', '58487', 'CONST', 'Francis Ofori ', 'Male', 'CTD', '0242324278', 'Oforifrancis864@gmasil.com', '2024-10-12 20:55:33'),
(104, 'Active In Service', '670ae3a26186c5.95821787.jpg', '54284', 'L/CPL', 'Tetteh Addo ', 'Male', 'CTD', '0543604447', 'Holysam654@gmail.com', '2024-10-12 21:01:22'),
(105, 'Active In Service', '670ae4a224aad6.70461340.jpg', '56014', 'L/CPL', 'Philip Glakpe', 'Male', 'CTD', '0240133404', 'mck777e@gmail.com', '2024-10-12 21:05:38'),
(106, 'Active In Service', '670ae607928de3.09545957.jpg', '56350', 'L/CPL', 'Isaac Mensah ', 'Male', 'CTD', '0240204534', 'Christikemenz072@gmail.com', '2024-10-12 21:11:35'),
(107, 'Active In Service', '670ae71e96e904.47633737.jpg', '58068', 'CONST', 'Magnus Ediem Yankson', 'Male', 'CTD', '0547099126', 'magnusyankson90@gmail.com', '2024-10-12 21:16:14'),
(108, 'Active In Service', '670b03f835e4a4.06242592.jpg', '4422', 'INSPR', 'Seidu Issah', 'Male', 'CTD', '0244870265', 'seidudollar4@gmail.com', '2024-10-12 23:19:20'),
(109, 'Active In Service', '670b05f9101409.52035554.jpg', '54666', 'L/CPL', 'Emmanuel  Kokwa ', 'Male', 'CTD', '0547092530', 'kokwaemmanuel@gmail.com', '2024-10-12 23:27:53'),
(110, 'Active In Service', '670b086f9fd9a3.75123873.jpg', '54660', 'L/CPL', 'Laud Kpodo Kwaku ', 'Male', 'CTD', '0550662014', 'kweku.banini@gmail.com', '2024-10-12 23:38:23'),
(111, 'Active In Service', '670b0b12d75bf7.81499515.jpg', '54253', 'L/CPL', 'Wisdom  Adzasu', 'Male', 'CTD', '02426501744', 'wisdomonej@gmai.com', '2024-10-12 23:49:38'),
(112, 'Active In Service', '670b0e4de89b78.04704670.jpg', '58192', 'CONST', 'Ibrahim Abubakari', 'Male', 'CTD', '0209240782', 'iabubakari1994@gmail.com', '2024-10-13 00:03:25'),
(113, 'Active In Service', '670b0f642ad830.10357336.jpg', '58414', 'CONST', 'Clement  Ofori ', 'Male', 'CTD', '0244599805', 'Oforiclement66@gmail.com', '2024-10-13 00:08:04'),
(114, 'Active In Service', '670b109763c445.83896096.jpg', '58578', 'CONST', 'Emmanuel Appiah Agyei ', 'Male', 'CTD', '0544697741', 'appiaagyeiemmanuel96@gmail.com', '2024-10-13 00:13:11'),
(115, 'Active In Service', '670b1283ce2595.34242330.jpg', '54663', 'L/CPL', 'Godwill  Kyereme', 'Male', 'CTD', '0543643401', 'godwillkyereme@gmail.com', '2024-10-13 00:21:23'),
(116, 'Active In Service', '670d52cc85ef84.62698389.jpg', '53634', 'L/CPL', 'Junior Asare Isaac', 'Male', 'CTD', '0242343147', 'asareisaac474@gmail.com', '2024-10-14 17:20:12'),
(117, 'Active In Service', '670da65a50ed80.41477792.jpg', '51977', 'L/CPL', 'Micheal Arlloo', 'Male', 'CTD', '0248259370', 'yawmichealarlloo@gmail.com', '2024-10-14 23:16:42'),
(118, 'Active In Service', '670da7cc028bb3.05153100.jpg', '56468', 'L/CPL', 'Mohammed Nkrumah ', 'Male', 'CTD', '0555522171', 'nkrumahmohammed1956@gmail.com', '2024-10-14 23:22:52'),
(119, 'Active In Service', '670da935ee7401.13602923.jpg', '58173', 'CONST', 'David Gmakikubi Tabil', 'Male', 'CTD', '0543592166', 'tdmgmakikubi12@gmail.com', '2024-10-14 23:28:53'),
(120, 'Active In Service', '670daa943fab19.34119200.jpg', '53629', 'L/CPL', 'Samuel  Asante Antwi ', 'Male', 'CTD', '0548583917', 'samuelantwiasante1992@gmail.com', '2024-10-14 23:34:44'),
(121, 'Active In Service', '670e96c98a31a9.37399505.jpg', '57955', 'CONST', 'Mohammed  Laryea Nuredeen ', 'Male', 'CTD', '0557458370', 'Kingnuredeenlaryea@gmail.com', '2024-10-15 16:22:33'),
(122, 'Active In Service', '670e9a5707ac50.56725284.jpg', '55932', 'L/CPL', 'Micheal  Antwi George ', 'Male', 'CTD', '0504641395', 'GeargeAntwiMicheal@gmail.com', '2024-10-15 16:37:43'),
(123, 'Active In Service', '670e9bca6aa497.94327449.jpg', '44842', 'SGT', 'Ernerst  Appiah', 'Male', 'CTD', '0244973310', 'ernerstnick310@gmaii.com', '2024-10-15 16:43:54'),
(124, 'Active In Service', '670e9d362d9503.60323358.jpg', '54675', 'L/CPL', 'Samuel  Owusu ', 'Male', 'CTD', '0248058550', 'getsavioula16@gmail.com', '2024-10-15 16:49:58'),
(125, 'Active In Service', '670e9e8f112572.82339985.jpg', '58585', 'CONST', 'Williams  Kwoffie ', 'Male', 'CTD', '0591056732', 'WilliamsonKwoffie@gmail.com', '2024-10-15 16:55:43'),
(126, 'Active In Service', '670e9ff297ae84.16146429.jpg', '58532 ', 'CONST', 'Richard  Ankamah ', 'Male', 'CTD', '0558405524', 'richardankamah222@gmail.com', '2024-10-15 17:01:38'),
(127, 'Active In Service', '670ea1955af439.95203150.jpg', '58549', 'L/CPL', 'David  Midzodzi Cudjoe ', 'Male', 'CTD', '0287495827', 'Cudjoedavid74@gmail.com', '2024-10-15 17:08:37'),
(128, 'Active In Service', '670ea374472154.55132401.jpg', '47808', 'CPL', 'Bernard Balig ', 'Male', 'CTD', '0546959690', 'bernardbalig@gmail.com', '2024-10-15 17:16:36'),
(129, 'Active In Service', '670eaaf6eea390.74345655.jpg', '22139', 'INSPR', 'Mathias Nwaaro ', 'Male', 'CTD', '0269474394', 'humbletiger6868@gmail.com', '2024-10-15 17:48:38'),
(130, 'Active In Service', '670efdd7079978.67363791.jpg', '56503', 'L/CPL', 'Benjamin  Osei Owusu ', 'Male', 'CTD', '0553369882', 'oseiowusubenjamin22@gmail.com', '2024-10-15 23:42:15'),
(131, 'Active In Service', '670f141f8f5cf4.81811940.jpg', '58636', 'CONST', 'Collins  Agyei', 'Male', 'CTD', '0541783579', 'temperature467@gmail.com', '2024-10-16 01:17:19'),
(132, 'Active In Service', '670fc8b77b4539.14632392.jpg', '58049 ', 'CONST', 'Ezekiel  Wayo A. ', 'Male', 'CTD', '0541054160', 'WAYORANKING90@GMAIL.COM', '2024-10-16 14:07:51'),
(133, 'Active In Service', '670fc9c0ded073.95799658.jpg', '58431', 'CONST', 'Richard  Amankwah ', 'Male', 'CTD', '0244602812', 'RICHARDAMANKWAH2019@GMAIL.COM', '2024-10-16 14:12:16'),
(134, 'Active In Service', '670fca9cde93d6.18099682.jpg', '58331 ', 'CONST', 'Philip Sakah ', 'Male', 'CTD', '0534957494', 'SAKAH27@GMAIL.COM', '2024-10-16 14:15:56'),
(135, 'Active In Service', '670fcb76e29b28.13122470.jpg', '45323', 'SGT', 'Peter Owusu Mensah', 'Male', 'CTD', '0542746146', 'PETEROWUSU222@GMAIL.COM', '2024-10-16 14:19:34'),
(136, 'Active In Service', '670fcc9348a5e5.56365837.jpg', '53889', 'L/CPL', 'Fredrick  Owusu Ansah ', 'Male', 'CTD', '0209104547', 'OWUSUANSAHFREDRICK807@GMAIL.COM', '2024-10-16 14:24:19'),
(137, 'Active In Service', '670fcdcdc6ae86.95719341.jpg', '55948', 'L/CPL', 'Joe  Nakojah M. ', 'Male', 'CTD', '0558818568', 'NAKOJAH0011@GMAIL.COM', '2024-10-16 14:29:33'),
(138, 'Active In Service', '670fcef185c541.02107135.jpg', '46896', 'CPL', 'Eugene Odame Debrah', 'Male', 'CTD', '0240233318', 'KOLIKOBAAKO@GTMAIL.COM', '2024-10-16 14:34:25'),
(139, 'Active In Service', '670fd0477d9141.75726054.jpg', '44534', 'SGT', 'Daniel Kitiaku', 'Male', 'CTD', '0591474939', 'KIKIATUTETTEH@GMAIL.COM', '2024-10-16 14:40:07'),
(140, 'Active In Service', '670fd1b2d22ca9.13432080.jpg', '55984', 'L/CPL', 'Kingsford Ansere ', 'Male', 'CTD', '0540780767', 'KINGSFORDANSERE2@GMAIL.COM', '2024-10-16 14:46:10'),
(141, 'Active In Service', '670fd34369cb21.44909681.jpg', '53890', 'L/CPL', 'Sampson Otoo', 'Male', 'CTD', '0248307380', 'IDEASOTOO@GMAIL.COM', '2024-10-16 14:52:51'),
(142, 'Active In Service', '670fd4b3aee4d9.94687653.jpg', '58306', 'CONST', 'Humphrey  Eduah B.', 'Male', 'CTD', '0596876814', 'HUMPHREYNANAEDUAH@GMAIL.COM', '2024-10-16 14:58:59'),
(143, 'Active In Service', '670fd610966c88.94983645.jpg', '56493', 'L/CPL', 'Godwin Mensah', 'Male', 'CTD', '0591989567', 'GODWINB13@GMAIL.COM', '2024-10-16 15:04:48'),
(144, 'Active In Service', '67102e9ba84e35.21649175.jpg', '11916', 'CONST', 'Esther  Agyei ', 'Male', 'CTD', '0244754637', 'adepaagyei40@gmail.com', '2024-10-16 21:22:35'),
(145, 'Active In Service', '67105ca5b1ba30.08382331.jpg', '11904', 'CONST', 'Nancy Fuseini ', 'Male', 'CTD', '0532598389', 'Nancyfuseini24@gmail.com', '2024-10-17 00:39:01'),
(146, 'Active In Service', '67105d576c1de4.91825395.jpg', '56382', 'L/CPL', 'Emmanuel Appau', 'Male', 'CTD', '0453164389', 'EAPPAU17@GMAIL.COM', '2024-10-17 00:41:59'),
(147, 'Active In Service', '67105ecf0dce67.96627026.jpg', '58270', 'CONST', 'Clinton Boakye Yiadom', 'Male', 'CTD', '0240735757', 'BYIADOM762@GMAIL.COM', '2024-10-17 00:48:15'),
(148, 'Active In Service', '67106044468c99.30415501.jpg', '10049', 'L/CPL', 'Bridgette Asor Anokye', 'Female', 'CTD', '0553626125', 'BRIDGETTE.ANNOKYE@GMAIL.COM', '2024-10-17 00:54:28'),
(149, 'Active In Service', '67106242c07bd2.82366560.jpg', '53892', 'L/CPL', 'Evans Boakye ', 'Male', 'CTD', '0241083650', 'BBOAKYEEVI@GMAIL.COM', '2024-10-17 01:02:58'),
(150, 'Active In Service', '6710635aac50c3.80618134.jpg', '58029', 'CONST', 'Williams Ansah', 'Male', 'CTD', '0547365406', 'AKWO22@GMAIL.COM', '2024-10-17 01:07:38'),
(151, 'Active In Service', '6710655ac0cad5.87332520.jpg', '53903', 'L/CPL', 'Emmanuel Aidoo', 'Male', 'CTD', '0531119455', 'AIDOOEMMA1166@GMAIL.COM', '2024-10-17 01:16:10'),
(152, 'Active In Service', '671066be0594f1.65799854.jpg', '58630', 'CONST', 'Jacob Agyei', 'Male', 'CTD', '0550798563', 'AGYEIJACOB88@GMAIL.COM', '2024-10-17 01:22:06'),
(153, 'Active In Service', '671069627df518.15753064.jpg', '58598', 'CONST', 'Mankuyali Kofi Dawuni', 'Male', 'CTD', '0247382090', 'MANKUYALID@GMAIL.COM', '2024-10-17 01:33:22');

-- --------------------------------------------------------

--
-- Table structure for table `other_assets`
--

CREATE TABLE `other_assets` (
  `assetID` int(200) NOT NULL,
  `asset_image` varchar(500) NOT NULL,
  `asset_serial_no` varchar(200) NOT NULL,
  `manufacturer` varchar(500) NOT NULL,
  `asset_name` varchar(500) NOT NULL,
  `asset_quantity` varchar(200) NOT NULL,
  `asset_state` varchar(200) NOT NULL,
  `booking_status` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `other_assets2`
--

CREATE TABLE `other_assets2` (
  `assetID` int(200) NOT NULL,
  `asset_image` varchar(500) NOT NULL,
  `asset_serial_no` varchar(200) NOT NULL,
  `manufacturer` varchar(500) NOT NULL,
  `asset_name` varchar(500) NOT NULL,
  `asset_quantity` varchar(200) NOT NULL,
  `asset_state` varchar(200) NOT NULL,
  `booking_status` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(500) NOT NULL,
  `lname` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(200) NOT NULL,
  `img` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`, `datetime`) VALUES
(1, 1415932073, 'William', 'Ntisem', 'williamntisem123@gmail.com', 'da6323f18608d4e26f562320fca718ca', '1721608304face5.jpg', 'Offline now', '2024-07-22 00:32:26');

-- --------------------------------------------------------

--
-- Table structure for table `users2`
--

CREATE TABLE `users2` (
  `user_id` int(100) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(500) NOT NULL,
  `lname` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(200) NOT NULL,
  `img` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_lists`
--
ALTER TABLE `admin_lists`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `admin_lists2`
--
ALTER TABLE `admin_lists2`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `ammo_bookings`
--
ALTER TABLE `ammo_bookings`
  ADD PRIMARY KEY (`book_ammoID`);

--
-- Indexes for table `ammo_bookings2`
--
ALTER TABLE `ammo_bookings2`
  ADD PRIMARY KEY (`book_ammoID`);

--
-- Indexes for table `ammunitions`
--
ALTER TABLE `ammunitions`
  ADD PRIMARY KEY (`ammoID`);

--
-- Indexes for table `ammunitions2`
--
ALTER TABLE `ammunitions2`
  ADD PRIMARY KEY (`ammoID`);

--
-- Indexes for table `asset_bookings`
--
ALTER TABLE `asset_bookings`
  ADD PRIMARY KEY (`bookAssetID`);

--
-- Indexes for table `asset_bookings2`
--
ALTER TABLE `asset_bookings2`
  ADD PRIMARY KEY (`bookAssetID`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bookingID`);

--
-- Indexes for table `bookings2`
--
ALTER TABLE `bookings2`
  ADD PRIMARY KEY (`bookingID`);

--
-- Indexes for table `daily_activities`
--
ALTER TABLE `daily_activities`
  ADD PRIMARY KEY (`daily_ActivitiesID`);

--
-- Indexes for table `daily_activities2`
--
ALTER TABLE `daily_activities2`
  ADD PRIMARY KEY (`activityLogID`);

--
-- Indexes for table `faulty_ammo`
--
ALTER TABLE `faulty_ammo`
  ADD PRIMARY KEY (`faulty_ammoID`);

--
-- Indexes for table `faulty_ammo2`
--
ALTER TABLE `faulty_ammo2`
  ADD PRIMARY KEY (`faulty_ammoID`);

--
-- Indexes for table `faulty_asset`
--
ALTER TABLE `faulty_asset`
  ADD PRIMARY KEY (`faulty_assetID`);

--
-- Indexes for table `faulty_asset2`
--
ALTER TABLE `faulty_asset2`
  ADD PRIMARY KEY (`faulty_assetID`);

--
-- Indexes for table `faulty_weapons`
--
ALTER TABLE `faulty_weapons`
  ADD PRIMARY KEY (`faulty_weaponID`);

--
-- Indexes for table `faulty_weapons2`
--
ALTER TABLE `faulty_weapons2`
  ADD PRIMARY KEY (`faulty_weaponID`);

--
-- Indexes for table `firearms`
--
ALTER TABLE `firearms`
  ADD PRIMARY KEY (`firearmID`);

--
-- Indexes for table `firearms2`
--
ALTER TABLE `firearms2`
  ADD PRIMARY KEY (`firearmID`);

--
-- Indexes for table `login_activity`
--
ALTER TABLE `login_activity`
  ADD PRIMARY KEY (`loginID`);

--
-- Indexes for table `login_activity2`
--
ALTER TABLE `login_activity2`
  ADD PRIMARY KEY (`loginID`);

--
-- Indexes for table `logout_activity`
--
ALTER TABLE `logout_activity`
  ADD PRIMARY KEY (`logoutID`);

--
-- Indexes for table `logout_activity2`
--
ALTER TABLE `logout_activity2`
  ADD PRIMARY KEY (`logoutID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `messages2`
--
ALTER TABLE `messages2`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`officerID`);

--
-- Indexes for table `officers2`
--
ALTER TABLE `officers2`
  ADD PRIMARY KEY (`officerID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_lists`
--
ALTER TABLE `admin_lists`
  MODIFY `adminID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_lists2`
--
ALTER TABLE `admin_lists2`
  MODIFY `adminID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ammo_bookings`
--
ALTER TABLE `ammo_bookings`
  MODIFY `book_ammoID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ammo_bookings2`
--
ALTER TABLE `ammo_bookings2`
  MODIFY `book_ammoID` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ammunitions`
--
ALTER TABLE `ammunitions`
  MODIFY `ammoID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ammunitions2`
--
ALTER TABLE `ammunitions2`
  MODIFY `ammoID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `asset_bookings`
--
ALTER TABLE `asset_bookings`
  MODIFY `bookAssetID` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_bookings2`
--
ALTER TABLE `asset_bookings2`
  MODIFY `bookAssetID` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bookingID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bookings2`
--
ALTER TABLE `bookings2`
  MODIFY `bookingID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily_activities`
--
ALTER TABLE `daily_activities`
  MODIFY `daily_ActivitiesID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=359;

--
-- AUTO_INCREMENT for table `daily_activities2`
--
ALTER TABLE `daily_activities2`
  MODIFY `activityLogID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faulty_ammo`
--
ALTER TABLE `faulty_ammo`
  MODIFY `faulty_ammoID` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faulty_ammo2`
--
ALTER TABLE `faulty_ammo2`
  MODIFY `faulty_ammoID` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faulty_asset`
--
ALTER TABLE `faulty_asset`
  MODIFY `faulty_assetID` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faulty_asset2`
--
ALTER TABLE `faulty_asset2`
  MODIFY `faulty_assetID` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faulty_weapons`
--
ALTER TABLE `faulty_weapons`
  MODIFY `faulty_weaponID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `faulty_weapons2`
--
ALTER TABLE `faulty_weapons2`
  MODIFY `faulty_weaponID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `firearms`
--
ALTER TABLE `firearms`
  MODIFY `firearmID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `firearms2`
--
ALTER TABLE `firearms2`
  MODIFY `firearmID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `login_activity`
--
ALTER TABLE `login_activity`
  MODIFY `loginID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `login_activity2`
--
ALTER TABLE `login_activity2`
  MODIFY `loginID` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logout_activity`
--
ALTER TABLE `logout_activity`
  MODIFY `logoutID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `logout_activity2`
--
ALTER TABLE `logout_activity2`
  MODIFY `logoutID` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages2`
--
ALTER TABLE `messages2`
  MODIFY `msg_id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `officers`
--
ALTER TABLE `officers`
  MODIFY `officerID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1116;

--
-- AUTO_INCREMENT for table `officers2`
--
ALTER TABLE `officers2`
  MODIFY `officerID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
