-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2026 at 08:24 PM
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
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `created_by` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_lists`
--

INSERT INTO `admin_lists` (`adminID`, `profile_image`, `user_role`, `service_no`, `rank`, `gender`, `fullname`, `admin_email`, `phone_number`, `username`, `password`, `unit_dept`, `code`, `status`, `update_date`, `datetime`, `reset_token`, `token_expiry`, `created_by`) VALUES
(2, '69d0d166a52914.22988217.jpg', 'Armourer', '45232', 'INSPR', 'Male', 'Richard Boampong', 'richardboappng13@gmail.com', '0246846556', 'boampong', '532e6d0a3a420e4168e46df1db4359e9', 'CTD', '882165', 'Verified', 'April 4, 2026, 8:52 am', '2026-04-04 08:52:54', NULL, NULL, ''),
(3, 'avatar_placeholder.png', 'Armourer', '60544', 'C/Inspr', 'Male', 'Ntisem William', 'williamntisem123@gmail.com', '0246076373', 'willies', '532e6d0a3a420e4168e46df1db4359e9', 'CTD', '', 'Verified', '', '2026-05-12 06:50:18', NULL, NULL, ''),
(4, 'avatar_placeholder.png', 'Armourer', '58459', 'L/CPL', 'Male', 'William Ntisem', 'lawrencejay19@yahoo.com', '0241752325', 'william', 'e6526e1c72e65e38ab5674d0e4be419c', 'CTD', '688025', 'Verified', 'March 25, 2026, 9:02 am', '2026-05-09 17:39:17', NULL, NULL, ''),
(5, 'ARM_1778479215_6a01706fa1562.jpg', 'Administrator', '12345', 'C/INSPR', '', 'William NTI', 'william12@gmail.com', '0246076371', 'williams', '7e55000bb06fd285304339db46418142', '', '', '', '', '2026-05-11 17:53:02', NULL, NULL, ''),
(6, 'ARM_1778479215_6a01706fa1562.jpg', 'Armourer', '123456', 'COP', '', 'William Ntisem', 'william@hot.com', '0235553982', 'Willie', '6f7aaa441fee759714355949f9902456', 'NCTD', '385701', 'Active', '', '2026-05-11 06:00:15', NULL, NULL, '');

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

--
-- Dumping data for table `ammo_bookings`
--

INSERT INTO `ammo_bookings` (`book_ammoID`, `bookingCode`, `ammoID`, `officerID`, `armourer_issuer`, `officer_image`, `to_officer`, `booking_time`, `ammo_name`, `ammo_rounds`, `ammo_returned`, `ammo_state`, `no_faulty_ammo`, `duty_type`, `duty_location`, `duty_duration`, `ammo_comment`, `ammo_returns`, `returned_time`, `datetime`) VALUES
(3, '', '6', '1148', '45232 INSPR Richard Boampong', '69b2d17a2b8438.44320500.jpg', '67304 CONST Baba Osman ', 'March 27, 2026, 6:22 am', '9MM', 20, 0, ' ', 0, 'Guide Duty', 'Armed Guide', '12', '', 'Not-Return', ' ', '2026-03-27 06:22:16'),
(4, '', '6', '1190', '45232 INSPR Richard Boampong', '69c5125608d7e1.61040660.jpg', '56140 L/CPL Samuel Ntim', 'March 27, 2026, 6:22 am', '9MM', 20, 0, ' ', 0, 'Guide Duty', 'Armed Guide', '', '', 'Not-Return', ' ', '2026-03-27 11:53:47');

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
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ammunitions`
--

INSERT INTO `ammunitions` (`ammoID`, `manufacturer`, `ammo_type`, `ammo_name`, `ammo_application`, `ammo_rounds`, `booking_status`, `datetime`, `is_deleted`) VALUES
(6, 'Sellier & Bellot', '', '9MM', 'Duty', 10923, 'Not-Available', '2026-05-09 09:25:09', 0),
(8, 'Kidma Tech', '', '7.62x39 ', 'Duty', 21430, 'Available', '2026-05-05 06:27:21', 0),
(9, 'Sellier & Bellot', '', '5.56X45', 'Duty', 30, 'Available', '2024-09-30 20:39:29', 0);

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
  `firearm_serial_no` varchar(200) NOT NULL,
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
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bookingID`, `bookingCode`, `firearmID`, `ammoID`, `officerID`, `booking_time`, `armourer_issuer`, `officer_image`, `to_officer`, `firearm_name`, `firearm_serial_no`, `firearm_class`, `quantity_issued`, `firearm_state`, `ammunition_name`, `number_of_rounds`, `ammo_returned`, `ammo_state`, `no_faulty_ammo`, `duty_type`, `duty_location`, `duty_duration`, `returns`, `comment`, `returned_time`, `datetime`, `is_deleted`) VALUES
(11, '', '13', '8', '4', 'March 25, 2026, 9:09 am', '58459 L/CPL Lawrence Acheampong', '67041579c4d831.81684806.jpg', '58473 L/CPL Eugene Bronya', 'CZ807', 'C326913', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 20, 'guide duty', 'Airporthills', '12', 'Returned', '', 'March 25, 2026, 11:32 am', '2026-03-25 11:32:16', 0),
(12, '', '18', '8', '1120', 'March 25, 2026, 11:31 am', '58459 L/CPL Lawrence Acheampong', '69b28705873187.89831585.jpg', '66046 CONST Samuel Zogli', 'CZ807', 'C326965', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'March 26, 2026, 8:21 am', '2026-03-26 08:21:43', 0),
(13, '', '21', '8', '1160', 'March 25, 2026, 11:34 am', '58459 L/CPL Lawrence Acheampong', '69b42aa1ef4329.51153481.jpg', '66124 CONST Osei Bismark', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'March 26, 2026, 8:22 am', '2026-03-26 08:22:26', 0),
(14, '', '16', '8', '1156', 'March 25, 2026, 11:36 am', '58459 L/CPL Lawrence Acheampong', '69b3cb1a952059.88393048.jpg', '66407 CONST Obeng Joseph Konadu', 'CZ807', 'E021880', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'March 25, 2026, 6:36 pm', '2026-03-25 18:36:14', 0),
(15, '', '', '8', '1129', 'March 25, 2026, 11:39 am', '58459 L/CPL Lawrence Acheampong', '69b2b2125deac3.56142041.jpg', '15815 CONST Nancy Agyei', 'CZ807', 'C402178', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'March 25, 2026, 6:36 pm', '2026-03-25 18:36:48', 0),
(16, '', '', '6', '1166', 'March 25, 2026, 3:31 pm', '58459 L/CPL Lawrence Acheampong', '69c38834ba6b50.29334719.jpg', '56082 L/CPL Frank Asamoah Appeakorang', 'CZ-SCORPION', 'D-174853', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '24 hours', 'Returned', '', 'March 26, 2026, 5:50 am', '2026-03-26 05:50:56', 0),
(17, '', '', '6', '36', 'March 25, 2026, 3:33 pm', '58459 L/CPL Lawrence Acheampong', '6707dc04e99862.44989633.jpg', '57976 L/CPL Richmond  Agyei Yeboah ', 'CZ-SCORPION', 'D-174878', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '24 hours', 'Returned', '', 'March 26, 2026, 5:52 am', '2026-03-26 05:52:13', 0),
(18, '', '', '6', '127', 'March 25, 2026, 3:34 pm', '58459 L/CPL Lawrence Acheampong', '670fca9cde93d6.18099682.jpg', '58331  L/CPL Philip Sakah ', 'CZ-SCORPION', 'D-280014', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '24 hours', 'Returned', '', 'March 26, 2026, 5:53 am', '2026-03-26 05:53:01', 0),
(19, '', '', '8', '1135', 'March 25, 2026, 6:43 pm', '58459 L/CPL Lawrence Acheampong', '69b2b95193a3d8.56421490.jpg', '67049 CONST Awudu Ali', 'CZ807', 'C402178', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'March 26, 2026, 8:22 am', '2026-03-26 08:22:52', 0),
(20, '', '', '8', '1140', 'March 25, 2026, 6:44 pm', '58459 L/CPL Lawrence Acheampong', '69b2bfe98bc695.49146455.jpg', '66394 CONST Samuel Laweh Teye ', 'CZ807', 'E021880', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'March 26, 2026, 8:20 am', '2026-03-26 08:20:57', 0),
(21, '', '', '6', '1161', 'March 25, 2026, 6:46 pm', '58459 L/CPL Lawrence Acheampong', '69b442eed55d23.65814209.jpg', '67156 CONST Tenadu Asiedu', 'CZ-SCORPION', 'D-174828', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'March 26, 2026, 5:53 am', '2026-03-26 05:53:29', 0),
(22, '', '13', '6', '1155', 'March 25, 2026, 6:47 pm', '58459 L/CPL Lawrence Acheampong', '69b3c9592099d1.82925269.jpg', '67232 CONST Seth Woolley', 'CZ-SCORPION', 'D-145292', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'March 26, 2026, 5:54 am', '2026-03-26 05:54:05', 0),
(23, '', '', '6', '1148', 'March 25, 2026, 6:48 pm', '58459 L/CPL Lawrence Acheampong', '69b2d17a2b8438.44320500.jpg', '67304 CONST Baba Osman ', 'CZ-SCORPION', 'D-279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'March 26, 2026, 5:51 am', '2026-03-26 05:51:43', 0),
(24, '', '16', '8', '1129', 'March 26, 2026, 6:13 am', '58459 L/CPL Lawrence Acheampong', '69b2b2125deac3.56142041.jpg', '15815 CONST Nancy Agyei', 'CZ807', 'E021880', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39mm', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'March 26, 2026, 6:55 pm', '2026-03-26 18:55:26', 0),
(25, '', '', '8', '1156', 'March 26, 2026, 8:24 am', '58459 L/CPL Lawrence Acheampong', '69b3cb1a952059.88393048.jpg', '66407 CONST Obeng Joseph Konadu', 'CZ807', 'C402178', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'March 26, 2026, 6:55 pm', '2026-03-26 18:55:55', 0),
(26, '', '', '8', '1116', 'March 26, 2026, 8:25 am', '58459 L/CPL Lawrence Acheampong', '69b24df2e50153.09990062.jpg', '66855 CONST Bawah Abdul Isumaila ', 'CZ807', 'C326965', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'March 27, 2026, 12:26 pm', '2026-03-27 12:26:39', 0),
(27, '', '', '6', '21', 'March 26, 2026, 8:26 am', '58459 L/CPL Lawrence Acheampong', '670532ff162947.50573292.jpg', '58516 L/CPL Ernest Yeboah', 'CZ-SCORPION', 'D-176116', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '24 hours', 'Returned', '', 'March 27, 2026, 1:01 pm', '2026-03-27 13:01:54', 0),
(28, '', '', '8', '1131', 'March 26, 2026, 8:28 am', '58459 L/CPL Lawrence Acheampong', '69b2b489043f43.52712900.jpg', '66792 CONST Haruna Abdulai ', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'March 27, 2026, 12:27 pm', '2026-03-27 12:27:27', 0),
(29, '', '', '6', '46', 'March 26, 2026, 8:30 am', '58459 L/CPL Lawrence Acheampong', '670974a6ebcdc9.60476512.jpg', '58239 L/CPL Enerst Anim ', 'CZ-SCORPION', 'D-406084', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '24 hours', 'Returned', '', 'March 27, 2026, 1:02 pm', '2026-03-27 13:02:48', 0),
(30, '', '', '8', '1135', 'March 26, 2026, 6:56 pm', '58459 L/CPL Lawrence Acheampong', '69b2b95193a3d8.56421490.jpg', '67049 CONST Awudu Ali', 'CZ807', 'E021880', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'March 27, 2026, 12:28 pm', '2026-03-27 12:28:28', 0),
(31, '', '', '8', '1140', 'March 26, 2026, 6:57 pm', '58459 L/CPL Lawrence Acheampong', '69b2bfe98bc695.49146455.jpg', '66394 CONST Samuel Laweh Teye ', 'CZ807', 'C402178', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'March 27, 2026, 12:29 pm', '2026-03-27 12:29:26', 0),
(32, '', '', '6', '1161', 'March 26, 2026, 6:58 pm', '58459 L/CPL Lawrence Acheampong', '69b442eed55d23.65814209.jpg', '67156 CONST Tenadu Asiedu', 'CZ-SCORPION', 'D-174853', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'March 27, 2026, 1:00 pm', '2026-03-27 13:00:44', 0),
(33, '', '', '6', '1148', 'March 26, 2026, 6:59 pm', '58459 L/CPL Lawrence Acheampong', '69b2d17a2b8438.44320500.jpg', '67304 CONST Baba Osman ', 'CZ-SCORPION', 'D-281536', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'March 27, 2026, 12:19 pm', '2026-03-27 12:19:57', 0),
(34, '', '', '6', '1155', 'March 26, 2026, 7:02 pm', '58459 L/CPL Lawrence Acheampong', '69b3c9592099d1.82925269.jpg', '67232 CONST Seth Woolley', 'CZ-SCORPION', 'D-145292', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'March 27, 2026, 12:22 pm', '2026-03-27 12:22:04', 0),
(35, '', '537', '8', '1120', 'March 27, 2026, 12:34 pm', '45232 INSPR Richard Boampong', '69b28705873187.89831585.jpg', '66046 CONST Samuel Zogli', 'CZ807', 'C326965', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'March 29, 2026, 7:31 am', '2026-03-29 07:31:36', 0),
(36, '', '532', '8', '1160', 'March 27, 2026, 12:40 pm', '45232 INSPR Richard Boampong', '69b42aa1ef4329.51153481.jpg', '66124 CONST Osei Bismark', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'March 29, 2026, 7:31 am', '2026-03-29 07:31:58', 0),
(37, '', '547', '8', '1156', 'March 27, 2026, 12:44 pm', '45232 INSPR Richard Boampong', '69b3cb1a952059.88393048.jpg', '66407 CONST Obeng Joseph Konadu', 'CZ807', 'E021880', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '12', 'Returned', '', 'March 27, 2026, 6:34 pm', '2026-03-27 18:34:03', 0),
(38, '', '549', '8', '1129', 'March 27, 2026, 12:46 pm', '45232 INSPR Richard Boampong', '69b2b2125deac3.56142041.jpg', '15815 CONST Nancy Agyei', 'CZ807', 'C402178', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'March 27, 2026, 6:33 pm', '2026-03-27 18:33:15', 0),
(39, '', '437', '6', '36', 'March 27, 2026, 12:50 pm', '45232 INSPR Richard Boampong', '6707dc04e99862.44989633.jpg', '57976 L/CPL Richmond  Agyei Yeboah ', 'CZ-SCORPION', 'D-406084', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'March 29, 2026, 7:30 am', '2026-03-29 07:30:58', 0),
(40, '', '399', '6', '127', 'March 27, 2026, 12:52 pm', '45232 INSPR Richard Boampong', '670fca9cde93d6.18099682.jpg', '58331  L/CPL Philip Sakah ', 'CZ-SCORPION', 'D-145292', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'March 29, 2026, 7:32 am', '2026-03-29 07:32:22', 0),
(41, '', '381', '6', '1185', 'March 27, 2026, 12:53 pm', '45232 INSPR Richard Boampong', '69c41825edcc14.61652171.jpg', '56082 L/CPL Frank Asamoah Appeakorang', 'CZ-SCORPION', 'D-145304', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'March 29, 2026, 7:32 am', '2026-03-29 07:32:51', 0),
(42, '', '414', '6', '', 'March 27, 2026, 12:56 pm', '45232 INSPR Richard Boampong', '', 'Opoku samuel', 'CZ-SCORPION', 'D-279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'March 29, 2026, 7:33 am', '2026-03-29 07:33:11', 0),
(43, '', '', '8', '1130', 'April 13, 2026, 6:14 pm', '58459 L/CPL Lawrence Acheampong', '69b2b35c6d4509.23082572.jpg', '67255 CONST Abdul- Rauf Abdul- Rahaman', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 14, 2026, 6:11 am', '2026-04-14 06:11:07', 0),
(44, '', '', '6', '1123', 'April 13, 2026, 6:18 pm', '58459 L/CPL Lawrence Acheampong', '69b28aba198b96.79213544.jpg', '65808 CONST Prosper Dagadu', 'CZ-SCORPION', 'D-135518', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 14, 2026, 6:08 am', '2026-04-14 06:08:50', 0),
(45, '', '', '6', '1161', 'April 13, 2026, 6:21 pm', '58459 L/CPL Lawrence Acheampong', '69b442eed55d23.65814209.jpg', '67156 CONST Tenadu Asiedu', 'CZ-SCORPION', 'D-174828', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 14, 2026, 6:09 am', '2026-04-14 06:09:10', 0),
(46, '', '', '8', '1148', 'April 13, 2026, 6:22 pm', '58459 L/CPL Lawrence Acheampong', '69b2d17a2b8438.44320500.jpg', '67304 CONST Baba Osman ', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 14, 2026, 6:26 am', '2026-04-14 06:26:32', 0),
(47, '', '', '6', '1116', 'April 13, 2026, 6:25 pm', '58459 L/CPL Lawrence Acheampong', '69b24df2e50153.09990062.jpg', '66855 CONST Bawah Abdul Isumaila ', 'CZ-SCORPION', 'D-406078', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 14, 2026, 6:11 am', '2026-04-14 06:11:32', 0),
(48, '', '', '8', '1125', 'April 14, 2026, 6:10 am', '58459 L/CPL Lawrence Acheampong', '69b2aa991b1001.24627116.jpg', '15866 CONST Patience Issajoulun', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 14, 2026, 6:36 pm', '2026-04-14 18:36:53', 0),
(49, '', '', '6', '13', 'April 14, 2026, 6:18 am', '58459 L/CPL Lawrence Acheampong', '67042def908e34.16990129.jpg', '54669 CPL Felix Appiah', 'CZ-SCORPION', 'D-406078', 'Duty-Weapon', 0, 'Not-Faulty', '9mm', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 15, 2026, 6:05 am', '2026-04-15 06:05:20', 0),
(50, '', '', '8', '1117', 'April 14, 2026, 6:30 am', '58459 L/CPL Lawrence Acheampong', '69b251142e0b44.85058804.jpg', '67163 CONST Jeffery Boakye', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 15, 2026, 6:15 am', '2026-04-15 06:15:55', 0),
(51, '', '', '8', '1135', 'April 14, 2026, 6:54 am', '58459 L/CPL Lawrence Acheampong', '69b2b95193a3d8.56421490.jpg', '67049 CONST Awudu Ali', 'CZ807', 'E013855', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39mm', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 14, 2026, 6:37 pm', '2026-04-14 18:37:29', 0),
(52, '', '', '8', '1162', 'April 14, 2026, 6:55 am', '58459 L/CPL Lawrence Acheampong', '69b550add89769.58634026.jpg', '66500 CONST Yakubu Amadu', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 15, 2026, 6:11 am', '2026-04-15 06:11:22', 0),
(53, '', '', '6', '84', 'April 14, 2026, 6:57 am', '58459 L/CPL Lawrence Acheampong', '670ad384951d08.94188639.jpg', '58339 L/CPL Emmanuel Painstsil', 'CZ-SCORPION', 'D-280014', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 15, 2026, 6:08 am', '2026-04-15 06:08:21', 0),
(54, '', '', '6', '36', 'April 14, 2026, 6:58 am', '58459 L/CPL Lawrence Acheampong', '6707dc04e99862.44989633.jpg', '57976 L/CPL Richmond  Agyei Yeboah ', 'CZ-SCORPION', 'D-281556', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 15, 2026, 6:08 am', '2026-04-15 06:08:51', 0),
(55, '', '', '6', '1185', 'April 14, 2026, 6:59 am', '58459 L/CPL Lawrence Acheampong', '69c41825edcc14.61652171.jpg', '56082 L/CPL Frank Asamoah Appeakorang', 'CZ-SCORPION', 'D-279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 15, 2026, 6:09 am', '2026-04-15 06:09:15', 0),
(56, '', '', '8', '1148', 'April 14, 2026, 6:38 pm', '58459 L/CPL Lawrence Acheampong', '69b2d17a2b8438.44320500.jpg', '67304 CONST Baba Osman ', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 15, 2026, 6:16 am', '2026-04-15 06:16:23', 0),
(57, '', '', '8', '1130', 'April 14, 2026, 6:39 pm', '58459 L/CPL Lawrence Acheampong', '69b2b35c6d4509.23082572.jpg', '67255 CONST Abdul- Rauf Abdul- Rahaman', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 15, 2026, 6:18 am', '2026-04-15 06:18:27', 0),
(58, '', '', '6', '1116', 'April 14, 2026, 6:51 pm', '58459 L/CPL Lawrence Acheampong', '69b24df2e50153.09990062.jpg', '66855 CONST Bawah Abdul Isumaila ', 'CZ-SCORPION', 'D-135518', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 15, 2026, 6:09 am', '2026-04-15 06:09:49', 0),
(59, '', '', '6', '1123', 'April 14, 2026, 6:52 pm', '58459 L/CPL Lawrence Acheampong', '69b28aba198b96.79213544.jpg', '65808 CONST Prosper Dagadu', 'CZ-SCORPION', 'D-174828', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 15, 2026, 6:10 am', '2026-04-15 06:10:09', 0),
(60, '', '', '6', '1161', 'April 14, 2026, 6:53 pm', '58459 L/CPL Lawrence Acheampong', '69b442eed55d23.65814209.jpg', '67156 CONST Tenadu Asiedu', 'CZ-SCORPION', 'D-174871', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 15, 2026, 6:06 am', '2026-04-15 06:06:43', 0),
(61, '', '', '6', '44', 'April 14, 2026, 6:54 pm', '58459 L/CPL Lawrence Acheampong', '67096c20261ed8.73226717.jpg', '58213 L/CPL Abraham  Nkumdow ', 'CZ-SCORPION', 'D-138572', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '12', 'Returned', '', 'April 15, 2026, 6:06 am', '2026-04-15 06:06:15', 0),
(62, '', '', '6', '1194', 'April 15, 2026, 6:07 am', '58459 L/CPL Lawrence Acheampong', '69c9aac0bd6f59.62327774.jpg', '56277 L/CPL Benjamin Antwi-Kusi', 'CZ-SCORPION', 'D-174871', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 16, 2026, 5:47 am', '2026-04-16 05:47:51', 0),
(63, '', '', '8', '1126', 'April 15, 2026, 6:17 am', '58459 L/CPL Lawrence Acheampong', '69b2abc99108b8.01318054.jpg', '65827 CONST Raymond Asimah', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 16, 2026, 6:42 am', '2026-04-16 06:42:41', 0),
(64, '', '', '8', '1194', 'April 15, 2026, 6:25 am', '58459 L/CPL Lawrence Acheampong', '69c9aac0bd6f59.62327774.jpg', '56140 L/CPL Samuel Ntim', 'F102305 CZ807 ( Rifle) - [Caliber: 7.62x39mm] ', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 0, ' ', 0, 'Guide Duty', 'DG/NAPD', '', 'Not-Return', '', ' ', '2026-04-15 06:28:27', 0),
(65, '', '', '8', '1125', 'April 15, 2026, 6:26 am', '58459 L/CPL Lawrence Acheampong', '69b2aa991b1001.24627116.jpg', '15866 CONST Patience Issajoulun', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 15, 2026, 6:26 pm', '2026-04-15 18:26:09', 0),
(66, '', '', '8', '1162', 'April 15, 2026, 6:30 am', '58459 L/CPL Lawrence Acheampong', '69b550add89769.58634026.jpg', '66500 CONST Yakubu Amadu', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 15, 2026, 6:14 pm', '2026-04-15 18:14:03', 0),
(67, '', '', '8', '1131', 'April 15, 2026, 6:31 am', '58459 L/CPL Lawrence Acheampong', '69b2b489043f43.52712900.jpg', '66792 CONST Haruna Abdulai ', 'CZ807', 'E013855', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 16, 2026, 6:43 am', '2026-04-16 06:43:38', 0),
(68, '', '', '6', '46', 'April 15, 2026, 6:33 am', '58459 L/CPL Lawrence Acheampong', '670974a6ebcdc9.60476512.jpg', '58239 L/CPL Enerst Anim ', 'CZ-SCORPION', 'D-279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 15, 2026, 6:34 am', '2026-04-15 06:34:17', 0),
(69, '', '', '6', '46', 'April 15, 2026, 6:35 am', '58459 L/CPL Lawrence Acheampong', '670974a6ebcdc9.60476512.jpg', '58239 L/CPL Enerst Anim ', 'CZ-SCORPION', 'D-406078', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 16, 2026, 5:48 am', '2026-04-16 05:48:32', 0),
(70, '', '', '6', '127', 'April 15, 2026, 6:58 am', '58459 L/CPL Lawrence Acheampong', '670fca9cde93d6.18099682.jpg', '58331  L/CPL Philip Sakah ', 'CZ-SCORPION', 'D-279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 16, 2026, 5:49 am', '2026-04-16 05:49:01', 0),
(71, '', '', '8', '1130', 'April 15, 2026, 6:15 pm', '58459 L/CPL Lawrence Acheampong', '69b2b35c6d4509.23082572.jpg', '67255 CONST Abdul- Rauf Abdul- Rahaman', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 16, 2026, 6:34 am', '2026-04-16 06:34:35', 0),
(72, '', '', '8', '1148', 'April 15, 2026, 6:25 pm', '58459 L/CPL Lawrence Acheampong', '69b2d17a2b8438.44320500.jpg', '67304 CONST Baba Osman ', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 16, 2026, 6:44 am', '2026-04-16 06:44:17', 0),
(73, '', '', '6', '1161', 'April 15, 2026, 6:29 pm', '58459 L/CPL Lawrence Acheampong', '69b442eed55d23.65814209.jpg', '67156 CONST Tenadu Asiedu', 'CZ-SCORPION', 'D-135518', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 16, 2026, 5:49 am', '2026-04-16 05:49:29', 0),
(74, '', '', '6', '44', 'April 15, 2026, 6:35 pm', '58459 L/CPL Lawrence Acheampong', '67096c20261ed8.73226717.jpg', '58213 L/CPL Abraham  Nkumdow ', 'CZ-SCORPION', 'D-138572', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '12', 'Returned', '', 'April 16, 2026, 5:49 am', '2026-04-16 05:49:55', 0),
(75, '', '', '6', '1116', 'April 15, 2026, 6:40 pm', '58459 L/CPL Lawrence Acheampong', '69b24df2e50153.09990062.jpg', '66855 CONST Bawah Abdul Isumaila ', 'CZ-SCORPION', 'D-280014', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 16, 2026, 5:50 am', '2026-04-16 05:50:16', 0),
(76, '', '', '6', '1123', 'April 15, 2026, 6:41 pm', '58459 L/CPL Lawrence Acheampong', '69b28aba198b96.79213544.jpg', '65808 CONST Prosper Dagadu', 'CZ-SCORPION', 'D-281556', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 16, 2026, 5:51 am', '2026-04-16 05:51:02', 0),
(77, '', '', '8', '1125', 'April 16, 2026, 6:34 am', '58459 L/CPL Lawrence Acheampong', '69b2aa991b1001.24627116.jpg', '15866 CONST Patience Issajoulun', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 16, 2026, 5:43 pm', '2026-04-16 17:43:15', 0),
(78, '', '', '6', '13', 'April 16, 2026, 6:35 am', '58459 L/CPL Lawrence Acheampong', '67042def908e34.16990129.jpg', '54669 CPL Felix Appiah', 'CZ-SCORPION', 'D280014', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 17, 2026, 5:45 am', '2026-04-17 05:45:45', 0),
(79, '', '', '6', '36', 'April 16, 2026, 6:40 am', '58459 L/CPL Lawrence Acheampong', '6707dc04e99862.44989633.jpg', '57976 L/CPL Richmond  Agyei Yeboah ', 'CZ-SCORPION', 'D281556', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 17, 2026, 5:46 am', '2026-04-17 05:46:14', 0),
(80, '', '', '6', '1185', 'April 16, 2026, 6:41 am', '58459 L/CPL Lawrence Acheampong', '69c41825edcc14.61652171.jpg', '56082 L/CPL Frank Asamoah Appeakorang', 'CZ-SCORPION', 'D279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 17, 2026, 5:46 am', '2026-04-17 05:46:50', 0),
(81, '', '', '6', '84', 'April 16, 2026, 6:42 am', '58459 L/CPL Lawrence Acheampong', '670ad384951d08.94188639.jpg', '58339 L/CPL Emmanuel Painstsil', 'CZ-SCORPION', 'D138572', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', -1, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 17, 2026, 5:47 am', '2026-04-17 05:47:40', 0),
(82, '', '', '8', '1162', 'April 16, 2026, 6:45 am', '58459 L/CPL Lawrence Acheampong', '69b550add89769.58634026.jpg', '66500 CONST Yakubu Amadu', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 16, 2026, 5:43 pm', '2026-04-16 17:43:44', 0),
(83, '', '', '8', '1117', 'April 16, 2026, 6:46 am', '58459 L/CPL Lawrence Acheampong', '69b251142e0b44.85058804.jpg', '67163 CONST Jeffery Boakye', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', -1, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 17, 2026, 5:53 am', '2026-04-17 05:53:04', 0),
(84, '', '', '8', '1135', 'April 16, 2026, 6:47 am', '58459 L/CPL Lawrence Acheampong', '69b2b95193a3d8.56421490.jpg', '67049 CONST Awudu Ali', 'CZ807', 'E013855', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', -3, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 17, 2026, 6:01 am', '2026-04-17 06:01:12', 0),
(85, '', '', '8', '1130', 'April 16, 2026, 5:44 pm', '58459 L/CPL Lawrence Acheampong', '69b2b35c6d4509.23082572.jpg', '67255 CONST Rauf Abdul - Rahaman', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 17, 2026, 6:01 am', '2026-04-17 06:01:37', 0),
(86, '', '', '8', '1148', 'April 16, 2026, 5:45 pm', '58459 L/CPL Lawrence Acheampong', '69b2d17a2b8438.44320500.jpg', '67304 CONST Baba Osman ', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 17, 2026, 6:02 am', '2026-04-17 06:02:01', 0),
(87, '', '', '6', '1195', 'April 16, 2026, 6:18 pm', '58459 L/CPL Lawrence Acheampong', '69e082268d9ea2.33187317.jpg', '55104 CPL Samuel Opoku', 'CZ-SCORPION', 'D135518', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '12', 'Returned', '', 'April 17, 2026, 5:49 am', '2026-04-17 05:49:08', 0),
(88, '', '', '6', '1195', 'April 16, 2026, 6:23 pm', '58459 L/CPL Lawrence Acheampong', '69e082268d9ea2.33187317.jpg', '56140 L/CPL Samuel Ntim', 'CZ-SCORPION', 'D174828', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '', 'Returned', '', 'April 16, 2026, 6:26 pm', '2026-04-16 18:26:53', 0),
(89, '', '', '6', '1195', 'April 16, 2026, 6:25 pm', '58459 L/CPL Lawrence Acheampong', '69e082268d9ea2.33187317.jpg', '56140 L/CPL Samuel Ntim', 'CZ-SCORPION', 'D406078', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '', 'Returned', '', 'April 16, 2026, 6:27 pm', '2026-04-16 18:27:23', 0),
(90, '', '', '6', '1195', 'April 16, 2026, 6:29 pm', '58459 L/CPL Lawrence Acheampong', '69e082268d9ea2.33187317.jpg', '56140 L/CPL Samuel Ntim', 'CZ-SCORPION', 'D174828', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '', 'Returned', '', 'April 17, 2026, 5:50 am', '2026-04-17 05:50:33', 0),
(91, '', '', '6', '1116', 'April 16, 2026, 6:30 pm', '58459 L/CPL Lawrence Acheampong', '69b24df2e50153.09990062.jpg', '66855 CONST Bawah Abdul Isumaila ', 'CZ-SCORPION', 'D174871', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', -1, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 17, 2026, 5:51 am', '2026-04-17 05:51:07', 0),
(92, '', '', '6', '44', 'April 16, 2026, 6:31 pm', '58459 L/CPL Lawrence Acheampong', '67096c20261ed8.73226717.jpg', '58213 L/CPL Abraham  Nkumdow ', 'CZ-SCORPION', 'D406078', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', -1, 'Guide Duty', 'Airporthills', '12', 'Returned', '', 'April 17, 2026, 5:51 am', '2026-04-17 05:51:33', 0),
(93, '', '', '8', '1126', 'April 17, 2026, 6:03 am', '58459 L/CPL Lawrence Acheampong', '69b2abc99108b8.01318054.jpg', '65827 CONST Raymond Asimah', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 18, 2026, 6:08 am', '2026-04-18 06:08:00', 0),
(94, '', '', '8', '1162', 'April 17, 2026, 6:04 am', '58459 L/CPL Lawrence Acheampong', '69b550add89769.58634026.jpg', '66500 CONST Yakubu Amadu', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 17, 2026, 5:46 pm', '2026-04-17 17:46:55', 0),
(95, '', '', '8', '1131', 'April 17, 2026, 6:05 am', '58459 L/CPL Lawrence Acheampong', '69b2b489043f43.52712900.jpg', '66792 CONST Haruna Abdulai ', 'CZ807', 'E013855', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 18, 2026, 1:59 pm', '2026-04-18 13:59:31', 0),
(96, '', '', '8', '1125', 'April 17, 2026, 6:08 am', '58459 L/CPL Lawrence Acheampong', '69b2aa991b1001.24627116.jpg', '15866 CONST Patience Issajoulun', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 17, 2026, 5:47 pm', '2026-04-17 17:47:21', 0),
(97, '', '', '6', '46', 'April 17, 2026, 6:09 am', '58459 L/CPL Lawrence Acheampong', '670974a6ebcdc9.60476512.jpg', '58239 L/CPL Enerst Anim ', 'CZ-SCORPION', 'D174828', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 18, 2026, 5:49 am', '2026-04-18 05:49:34', 0),
(98, '', '', '6', '1194', 'April 17, 2026, 6:32 am', '58459 L/CPL Lawrence Acheampong', '69c9aac0bd6f59.62327774.jpg', '56277 L/CPL Benjamin Antwi-Kusi', 'CZ-SCORPION', 'D174871', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 18, 2026, 5:52 am', '2026-04-18 05:52:05', 0),
(99, '', '', '6', '1195', 'April 17, 2026, 6:41 am', '58459 L/CPL Lawrence Acheampong', '69e082268d9ea2.33187317.jpg', '56140 L/CPL Samuel Ntim', 'CZ-SCORPION', 'D406078', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '', 'Returned', '', 'April 18, 2026, 5:59 am', '2026-04-18 05:59:05', 0),
(100, '', '42', '8', '1148', 'April 17, 2026, 5:48 pm', '58459 L/CPL Lawrence Acheampong', '69b2d17a2b8438.44320500.jpg', '67304 CONST Baba Osman ', 'CZ807', 'f141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 18, 2026, 6:08 am', '2026-04-18 06:08:41', 0),
(101, '', '', '8', '1130', 'April 17, 2026, 5:49 pm', '58459 L/CPL Lawrence Acheampong', '69b2b35c6d4509.23082572.jpg', '67255 CONST Rauf Abdul - Rahaman', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 18, 2026, 6:09 am', '2026-04-18 06:09:18', 0),
(102, '', '', '6', '1195', 'April 17, 2026, 6:38 pm', '58459 L/CPL Lawrence Acheampong', '69e082268d9ea2.33187317.jpg', '56140 L/CPL Samuel Ntim', 'CZ-SCORPION', 'D280014', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 19, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '', 'Returned', '', 'April 18, 2026, 5:59 am', '2026-04-18 05:59:41', 0),
(103, '', '', '6', '1195', 'April 17, 2026, 6:39 pm', '58459 L/CPL Lawrence Acheampong', '69e082268d9ea2.33187317.jpg', '56140 L/CPL Samuel Ntim', 'CZ-SCORPION', 'D281556', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '', 'Returned', '', 'April 18, 2026, 6:00 am', '2026-04-18 06:00:13', 0),
(104, '', '', '6', '1195', 'April 17, 2026, 6:39 pm', '58459 L/CPL Lawrence Acheampong', '69e082268d9ea2.33187317.jpg', '55104 CPL Samuel Opoku', 'CZ-SCORPION', 'D135518', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '12', 'Returned', '', 'April 18, 2026, 5:49 am', '2026-04-18 05:49:07', 0),
(105, '', '', '8', '1135', 'April 18, 2026, 6:11 am', '58459 L/CPL Lawrence Acheampong', '69b2b95193a3d8.56421490.jpg', '67049 CONST Awudu Ali', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 19, 2026, 5:53 am', '2026-04-19 05:53:48', 0),
(106, '', '', '8', '1162', 'April 18, 2026, 6:12 am', '58459 L/CPL Lawrence Acheampong', '69b550add89769.58634026.jpg', '66500 CONST Yakubu Amadu', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '24 hours', 'Returned', '', 'April 18, 2026, 5:55 pm', '2026-04-18 17:55:42', 0),
(107, '', '', '8', '1125', 'April 18, 2026, 6:13 am', '58459 L/CPL Lawrence Acheampong', '69b2aa991b1001.24627116.jpg', '15866 CONST Patience Issajoulun', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 18, 2026, 5:58 pm', '2026-04-18 17:58:38', 0),
(108, '', '', '6', '13', 'April 18, 2026, 6:19 am', '58459 L/CPL Lawrence Acheampong', '67042def908e34.16990129.jpg', '54669 CPL Felix Appiah', 'CZ-SCORPION', 'D280014', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '12', 'Returned', '', 'April 18, 2026, 5:59 pm', '2026-04-18 17:59:14', 0),
(109, '', '', '6', '36', 'April 18, 2026, 6:22 am', '58459 L/CPL Lawrence Acheampong', '6707dc04e99862.44989633.jpg', '57976 L/CPL Richmond  Agyei Yeboah ', 'CZ-SCORPION', 'D281556', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '12', 'Returned', '', 'April 18, 2026, 5:59 pm', '2026-04-18 17:59:49', 0),
(110, '', '', '6', '84', 'April 18, 2026, 6:27 am', '58459 L/CPL Lawrence Acheampong', '670ad384951d08.94188639.jpg', '58339 L/CPL Emmanuel Painstsil', 'CZ-SCORPION', 'D135518', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '12', 'Returned', '', 'April 18, 2026, 6:02 pm', '2026-04-18 18:02:03', 0),
(111, '', '', '6', '1185', 'April 18, 2026, 6:29 am', '58459 L/CPL Lawrence Acheampong', '69c41825edcc14.61652171.jpg', '56082 L/CPL Frank Asamoah Appeakorang', 'CZ-SCORPION', 'D174871', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '12', 'Returned', '', 'April 18, 2026, 6:03 pm', '2026-04-18 18:03:32', 0),
(112, '', '', '8', '1130', 'April 18, 2026, 6:04 pm', '58459 L/CPL Lawrence Acheampong', '69b2b35c6d4509.23082572.jpg', '67255 CONST Rauf Abdul - Rahaman', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 19, 2026, 5:59 am', '2026-04-19 05:59:20', 0),
(113, '', '', '8', '1148', 'April 18, 2026, 6:05 pm', '58459 L/CPL Lawrence Acheampong', '69b2d17a2b8438.44320500.jpg', '67304 CONST Baba Osman ', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 19, 2026, 6:12 am', '2026-04-19 06:12:45', 0),
(114, '', '', '6', '127', 'April 18, 2026, 6:06 pm', '58459 L/CPL Lawrence Acheampong', '670fca9cde93d6.18099682.jpg', '58331  L/CPL Philip Sakah ', 'CZ-SCORPION', 'D135518', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '12', 'Returned', '', 'April 19, 2026, 6:15 am', '2026-04-19 06:15:35', 0),
(115, '', '', '6', '46', 'April 18, 2026, 6:08 pm', '58459 L/CPL Lawrence Acheampong', '670974a6ebcdc9.60476512.jpg', '58239 L/CPL Enerst Anim ', 'CZ-SCORPION', 'D280014', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '12', 'Returned', '', 'April 19, 2026, 6:16 am', '2026-04-19 06:16:15', 0),
(116, '', '', '6', '1194', 'April 18, 2026, 6:09 pm', '58459 L/CPL Lawrence Acheampong', '69c9aac0bd6f59.62327774.jpg', '56277 L/CPL Benjamin Antwi-Kusi', 'CZ-SCORPION', 'D174871', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '12', 'Returned', '', 'April 19, 2026, 6:16 am', '2026-04-19 06:16:58', 0),
(117, '', '', '6', '1116', 'April 18, 2026, 6:19 pm', '58459 L/CPL Lawrence Acheampong', '69b24df2e50153.09990062.jpg', '66855 CONST Bawah Abdul Isumaila ', 'CZ-SCORPION', 'D281556', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 19, 2026, 6:17 am', '2026-04-19 06:17:34', 0),
(118, '', '', '6', '44', 'April 18, 2026, 6:57 pm', '58459 L/CPL Lawrence Acheampong', '67096c20261ed8.73226717.jpg', '58213 L/CPL Abraham  Nkumdow ', 'CZ-SCORPION', 'D174828', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '12', 'Returned', '', 'April 19, 2026, 6:18 am', '2026-04-19 06:18:12', 0),
(119, '', '', '8', '1155', 'April 19, 2026, 6:00 am', '58459 L/CPL Lawrence Acheampong', '69b3c9592099d1.82925269.jpg', '67232 CONST Seth Woolley', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 20, 2026, 6:13 am', '2026-04-20 06:13:13', 0),
(120, '', '', '8', '1164', 'April 19, 2026, 6:01 am', '58459 L/CPL Lawrence Acheampong', '69bce39d3b06a5.99956353.jpg', '15769 CONST Asante Jessica Afful ', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 19, 2026, 6:01 pm', '2026-04-19 18:01:15', 0),
(121, '', '', '8', '1128', 'April 19, 2026, 6:02 am', '58459 L/CPL Lawrence Acheampong', '69b2b12bde6fe0.29997882.jpg', '66741 CONST Abdulai Sualisu', 'CZ807', 'E013855', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 20, 2026, 6:14 am', '2026-04-20 06:14:18', 0),
(122, '', '', '8', '1122', 'April 19, 2026, 6:14 am', '58459 L/CPL Lawrence Acheampong', '69b2894147e6f0.79616494.jpg', '66837 CONST Francis Atuobi', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 19, 2026, 5:17 pm', '2026-04-19 17:17:27', 0),
(123, '', '', '6', '1190', 'April 19, 2026, 6:24 am', '58459 L/CPL Lawrence Acheampong', '69c5125608d7e1.61040660.jpg', '58249 L/CPL Evans Ofosu', 'CZ-SCORPION', 'D174828', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 20, 2026, 6:12 am', '2026-04-20 06:12:09', 0),
(124, '', '', '6', '26', 'April 19, 2026, 6:29 am', '58459 L/CPL Lawrence Acheampong', '67053feeb2b394.69718031.jpg', '57914 L/CPL Kenny Adarkwah ', 'CZ-SCORPION', 'D135518', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 19, 2026, 5:59 pm', '2026-04-19 17:59:56', 0),
(125, '', '42', '6', '13', 'April 19, 2026, 6:33 am', '58459 L/CPL Lawrence Acheampong', '67042def908e34.16990129.jpg', '54669 CPL Felix Appiah', 'CZ-SCORPION', 'D174871', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 20, 2026, 6:12 am', '2026-04-20 06:12:35', 0),
(126, '', '', '8', '1120', 'April 19, 2026, 5:18 pm', '58459 L/CPL Lawrence Acheampong', '69b28705873187.89831585.jpg', '66046 CONST Samuel Zogli', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', -1, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 20, 2026, 6:14 am', '2026-04-20 06:14:55', 0),
(127, '', '', '6', '1116', 'April 19, 2026, 5:58 pm', '58459 L/CPL Lawrence Acheampong', '69b24df2e50153.09990062.jpg', '66855 CONST Bawah Abdul Isumaila ', 'CZ-SCORPION', 'D281556', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 20, 2026, 6:22 am', '2026-04-20 06:22:57', 0),
(128, '', '', '6', '1141', 'April 19, 2026, 5:59 pm', '58459 L/CPL Lawrence Acheampong', '69b2c14ae3f559.34963057.jpg', '66942 CONST Apreku Felix', 'CZ-SCORPION', 'D406078', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 20, 2026, 6:23 am', '2026-04-20 06:23:37', 0),
(129, '', '', '8', '1161', 'April 19, 2026, 6:02 pm', '58459 L/CPL Lawrence Acheampong', '69b442eed55d23.65814209.jpg', '67156 CONST Tenadu Asiedu', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 20, 2026, 6:15 am', '2026-04-20 06:15:38', 0),
(130, '', '', '6', '1121', 'April 19, 2026, 6:14 pm', '58459 L/CPL Lawrence Acheampong', '69b28830d5ea93.99641637.jpg', '66138 CONST Isaac Appiah', 'CZ-SCORPION', 'D135518', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 20, 2026, 6:24 am', '2026-04-20 06:24:18', 0),
(131, '', '', '8', '1118', 'April 20, 2026, 6:16 am', '58459 L/CPL Lawrence Acheampong', '69b251f1773cf9.61070979.jpg', '65851 CONST Gabriel Ahiable', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 21, 2026, 6:02 am', '2026-04-21 06:02:55', 0),
(132, '', '', '8', '1127', 'April 20, 2026, 6:18 am', '58459 L/CPL Lawrence Acheampong', '69b2ae62c20632.37644830.jpg', '66519 CONST Eugene Ayirebi Okyere', 'CZ807', 'E013855', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 21, 2026, 6:15 am', '2026-04-21 06:15:00', 0),
(133, '', '', '8', '1122', 'April 20, 2026, 6:20 am', '58459 L/CPL Lawrence Acheampong', '69b2894147e6f0.79616494.jpg', '66837 CONST Francis Atuobi', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 20, 2026, 5:32 pm', '2026-04-20 17:32:49', 0),
(134, '', '', '8', '1164', 'April 20, 2026, 6:21 am', '58459 L/CPL Lawrence Acheampong', '69bce39d3b06a5.99956353.jpg', '15769 CONST Asante Jessica Afful ', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 20, 2026, 5:54 pm', '2026-04-20 17:54:11', 0),
(135, '', '', '6', '29', 'April 20, 2026, 6:34 am', '58459 L/CPL Lawrence Acheampong', '670543f75f17e1.72713618.jpg', '55931 L/CPL George  Osei Agyemang ', 'CZ-SCORPION', 'D174871', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', -2, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 21, 2026, 6:06 am', '2026-04-21 06:06:39', 0),
(136, '', '', '6', '1168', 'April 20, 2026, 6:44 am', '58459 L/CPL Lawrence Acheampong', '69c3a7c099b0e9.68472705.jpg', '49742 SGT Edward Ayendago', 'CZ-SCORPION', 'D135518', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 21, 2026, 6:08 am', '2026-04-21 06:08:44', 0),
(137, '', '', '6', '55', 'April 20, 2026, 6:52 am', '58459 L/CPL Lawrence Acheampong', '670a788174fa91.75312494.jpg', '10569 L/CPL Alberta Asieduwaa', 'CZ-SCORPION', 'D406078', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 21, 2026, 6:09 am', '2026-04-21 06:09:35', 0),
(138, '', '', '8', '1120', 'April 20, 2026, 5:33 pm', '58459 L/CPL Lawrence Acheampong', '69b28705873187.89831585.jpg', '66046 CONST Samuel Zogli', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 21, 2026, 6:03 am', '2026-04-21 06:03:47', 0),
(139, '', '', '8', '1161', 'April 20, 2026, 5:56 pm', '58459 L/CPL Lawrence Acheampong', '69b442eed55d23.65814209.jpg', '67156 CONST Tenadu Asiedu', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 21, 2026, 6:16 am', '2026-04-21 06:16:17', 0),
(140, '', '', '6', '1196', 'April 20, 2026, 5:57 pm', '58459 L/CPL Lawrence Acheampong', '69e31f9a5b5769.06168966.jpg', '55104 CPL Samuel Opoku', 'CZ-SCORPION', 'D174828', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '12', 'Returned', '', 'April 21, 2026, 6:30 am', '2026-04-21 06:30:56', 0),
(141, '', '', '6', '1116', 'April 20, 2026, 6:21 pm', '58459 L/CPL Lawrence Acheampong', '69b24df2e50153.09990062.jpg', '66855 CONST Bawah Abdul Isumaila ', 'CZ-SCORPION', 'D280014', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 21, 2026, 5:50 am', '2026-04-21 05:50:22', 0),
(142, '', '', '6', '1141', 'April 20, 2026, 6:22 pm', '58459 L/CPL Lawrence Acheampong', '69b2c14ae3f559.34963057.jpg', '66942 CONST Apreku Felix', 'CZ-SCORPION', 'D279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 21, 2026, 5:49 am', '2026-04-21 05:49:58', 0),
(143, '', '', '8', '1128', 'April 21, 2026, 6:05 am', '58459 L/CPL Lawrence Acheampong', '69b2b12bde6fe0.29997882.jpg', '66741 CONST Abdulai Sualisu', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 22, 2026, 6:00 am', '2026-04-22 06:00:04', 0),
(144, '', '', '8', '1164', 'April 21, 2026, 6:05 am', '58459 L/CPL Lawrence Acheampong', '69bce39d3b06a5.99956353.jpg', '15769 CONST Asante Jessica Afful ', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', -1, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 21, 2026, 5:24 pm', '2026-04-21 17:24:27', 0),
(145, '', '', '8', '1122', 'April 21, 2026, 6:17 am', '58459 L/CPL Lawrence Acheampong', '69b2894147e6f0.79616494.jpg', '66837 CONST Francis Atuobi', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 21, 2026, 5:42 pm', '2026-04-21 17:42:36', 0),
(146, '', '', '8', '1155', 'April 21, 2026, 6:19 am', '58459 L/CPL Lawrence Acheampong', '69b3c9592099d1.82925269.jpg', '67232 CONST Seth Woolley', 'CZ807', 'E013855', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 22, 2026, 6:00 am', '2026-04-22 06:00:54', 0),
(147, '', '', '6', '13', 'April 21, 2026, 6:25 am', '58459 L/CPL Lawrence Acheampong', '67042def908e34.16990129.jpg', '54669 CPL Felix Appiah', 'CZ-SCORPION', 'D280014', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 22, 2026, 6:10 am', '2026-04-22 06:10:45', 0),
(148, '', '', '6', '26', 'April 21, 2026, 6:30 am', '58459 L/CPL Lawrence Acheampong', '67053feeb2b394.69718031.jpg', '57914 L/CPL Kenny Adarkwah ', 'CZ-SCORPION', 'D406078', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 22, 2026, 6:11 am', '2026-04-22 06:11:34', 0),
(149, '', '', '6', '59', 'April 21, 2026, 6:40 am', '58459 L/CPL Lawrence Acheampong', '670a7d13d26c27.84839470.jpg', '10048 CPL Elizabet Appiah', 'CZ-SCORPION', 'D279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 21, 2026, 6:20 pm', '2026-04-21 18:20:27', 0),
(150, '', '', '6', '1190', 'April 21, 2026, 6:41 am', '58459 L/CPL Lawrence Acheampong', '69c5125608d7e1.61040660.jpg', '58249 L/CPL Evans Ofosu', 'CZ-SCORPION', 'D281556', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', -1, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 22, 2026, 6:12 am', '2026-04-22 06:12:26', 0),
(151, '', '', '8', '1120', 'April 21, 2026, 5:25 pm', '58459 L/CPL Lawrence Acheampong', '69b28705873187.89831585.jpg', '66046 CONST Samuel Zogli', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 22, 2026, 6:02 am', '2026-04-22 06:02:19', 0),
(152, '', '', '8', '1161', 'April 21, 2026, 5:43 pm', '58459 L/CPL Lawrence Acheampong', '69b442eed55d23.65814209.jpg', '67156 CONST Tenadu Asiedu', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 22, 2026, 6:03 am', '2026-04-22 06:03:00', 0),
(153, '', '', '6', '1123', 'April 21, 2026, 5:45 pm', '58459 L/CPL Lawrence Acheampong', '69b28aba198b96.79213544.jpg', '65808 CONST Prosper Dagadu', 'CZ-SCORPION', 'D174828', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'None', 0, 'Guide Duty', 'Escort', '12', 'Returned', '', 'April 22, 2026, 8:29 am', '2026-04-22 08:29:54', 0);
INSERT INTO `bookings` (`bookingID`, `bookingCode`, `firearmID`, `ammoID`, `officerID`, `booking_time`, `armourer_issuer`, `officer_image`, `to_officer`, `firearm_name`, `firearm_serial_no`, `firearm_class`, `quantity_issued`, `firearm_state`, `ammunition_name`, `number_of_rounds`, `ammo_returned`, `ammo_state`, `no_faulty_ammo`, `duty_type`, `duty_location`, `duty_duration`, `returns`, `comment`, `returned_time`, `datetime`, `is_deleted`) VALUES
(154, '', '', '6', '1160', 'April 21, 2026, 5:46 pm', '58459 L/CPL Lawrence Acheampong', '69b42aa1ef4329.51153481.jpg', '66124 CONST Osei Bismark', 'CZ-SCORPION', 'D138572', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Escort', '12', 'Returned', '', 'April 22, 2026, 8:30 am', '2026-04-22 08:30:25', 0),
(155, '', '', '6', '39', 'April 21, 2026, 5:47 pm', '58459 L/CPL Lawrence Acheampong', '67095d077b5231.06692709.jpg', '53616  CPL Richard  Asare', 'CZ-SCORPION', 'D176116', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Escort', '12', 'Returned', '', 'April 22, 2026, 8:31 am', '2026-04-22 08:31:17', 0),
(156, '', '', '6', '1196', 'April 21, 2026, 6:21 pm', '58459 L/CPL Lawrence Acheampong', '69e31f9a5b5769.06168966.jpg', '55104 CPL Samuel Opoku', 'CZ-SCORPION', 'D279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '12', 'Returned', '', 'April 22, 2026, 6:13 am', '2026-04-22 06:13:57', 0),
(157, '', '', '6', '1116', 'April 21, 2026, 6:23 pm', '58459 L/CPL Lawrence Acheampong', '69b24df2e50153.09990062.jpg', '66855 CONST Bawah Abdul Isumaila ', 'CZ-SCORPION', 'D135518', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 22, 2026, 6:14 am', '2026-04-22 06:14:56', 0),
(158, '', '', '6', '1141', 'April 21, 2026, 6:24 pm', '58459 L/CPL Lawrence Acheampong', '69b2c14ae3f559.34963057.jpg', '66942 CONST Apreku Felix', 'CZ-SCORPION', 'D145304', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'None', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 22, 2026, 6:15 am', '2026-04-22 06:15:56', 0),
(159, '', '', '8', '1118', 'April 22, 2026, 6:06 am', '58459 L/CPL Lawrence Acheampong', '69b251f1773cf9.61070979.jpg', '65851 CONST Gabriel Ahiable', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 23, 2026, 5:55 am', '2026-04-23 05:55:12', 0),
(160, '', '', '8', '1122', 'April 22, 2026, 6:07 am', '58459 L/CPL Lawrence Acheampong', '69b2894147e6f0.79616494.jpg', '66837 CONST Francis Atuobi', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 22, 2026, 5:27 pm', '2026-04-22 17:27:42', 0),
(161, '', '', '8', '1127', 'April 22, 2026, 6:08 am', '58459 L/CPL Lawrence Acheampong', '69b2ae62c20632.37644830.jpg', '66519 CONST Eugene Ayirebi Okyere', 'CZ807', 'E013855', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 23, 2026, 6:14 am', '2026-04-23 06:14:55', 0),
(162, '', '', '8', '1164', 'April 22, 2026, 6:09 am', '58459 L/CPL Lawrence Acheampong', '69bce39d3b06a5.99956353.jpg', '15769 CONST Asante Jessica Afful ', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 22, 2026, 5:29 pm', '2026-04-22 17:29:25', 0),
(163, '', '', '6', '29', 'April 22, 2026, 6:49 am', '58459 L/CPL Lawrence Acheampong', '670543f75f17e1.72713618.jpg', '55931 L/CPL George  Osei Agyemang ', 'CZ-SCORPION', 'D281556', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 23, 2026, 5:57 am', '2026-04-23 05:57:15', 0),
(164, '', '', '6', '55', 'April 22, 2026, 7:01 am', '58459 L/CPL Lawrence Acheampong', '670a788174fa91.75312494.jpg', '10569 L/CPL Alberta Asieduwaa', 'CZ-SCORPION', 'D279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 23, 2026, 5:58 am', '2026-04-23 05:58:17', 0),
(165, '', '', '8', '1120', 'April 22, 2026, 5:28 pm', '58459 L/CPL Lawrence Acheampong', '69b28705873187.89831585.jpg', '66046 CONST Samuel Zogli', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 23, 2026, 6:38 am', '2026-04-23 06:38:41', 0),
(166, '', '', '8', '1161', 'April 22, 2026, 5:30 pm', '58459 L/CPL Lawrence Acheampong', '69b442eed55d23.65814209.jpg', '67156 CONST Tenadu Asiedu', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 23, 2026, 6:16 am', '2026-04-23 06:16:10', 0),
(167, '', '', '6', '1141', 'April 22, 2026, 6:10 pm', '58459 L/CPL Lawrence Acheampong', '69b2c14ae3f559.34963057.jpg', '66942 CONST Apreku Felix', 'CZ-SCORPION', 'D406078', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 23, 2026, 5:59 am', '2026-04-23 05:59:13', 0),
(168, '', '', '6', '1116', 'April 22, 2026, 6:11 pm', '58459 L/CPL Lawrence Acheampong', '69b24df2e50153.09990062.jpg', '66855 CONST Bawah Abdul Isumaila ', 'CZ-SCORPION', 'D406070', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 23, 2026, 6:00 am', '2026-04-23 06:00:06', 0),
(169, '', '', '6', '44', 'April 22, 2026, 6:12 pm', '58459 L/CPL Lawrence Acheampong', '67096c20261ed8.73226717.jpg', '58213 L/CPL Abraham  Nkumdow ', 'CZ-SCORPION', 'D135518', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '12', 'Returned', '', 'April 23, 2026, 6:01 am', '2026-04-23 06:01:04', 0),
(170, '', '', '8', '1128', 'April 23, 2026, 5:56 am', '58459 L/CPL Lawrence Acheampong', '69b2b12bde6fe0.29997882.jpg', '66741 CONST Abdulai Sualisu', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 24, 2026, 5:49 am', '2026-04-24 05:49:53', 0),
(171, '', '', '6', '1190', 'April 23, 2026, 6:37 am', '58459 L/CPL Lawrence Acheampong', '69c5125608d7e1.61040660.jpg', '58249 L/CPL Evans Ofosu', 'CZ-SCORPION', 'D281556', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 24, 2026, 5:57 am', '2026-04-24 05:57:54', 0),
(172, '', '', '8', '1122', 'April 23, 2026, 6:40 am', '58459 L/CPL Lawrence Acheampong', '69b2894147e6f0.79616494.jpg', '66837 CONST Francis Atuobi', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 23, 2026, 5:39 pm', '2026-04-23 17:39:55', 0),
(173, '', '', '8', '1155', 'April 23, 2026, 6:41 am', '58459 L/CPL Lawrence Acheampong', '69b3c9592099d1.82925269.jpg', '67232 CONST Seth Woolley', 'CZ807', 'E013855', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 24, 2026, 5:50 am', '2026-04-24 05:50:53', 0),
(174, '', '', '8', '1164', 'April 23, 2026, 6:43 am', '58459 L/CPL Lawrence Acheampong', '69bce39d3b06a5.99956353.jpg', '15769 CONST Asante Jessica Afful ', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 23, 2026, 5:41 pm', '2026-04-23 17:41:04', 0),
(175, '', '', '6', '13', 'April 23, 2026, 6:45 am', '58459 L/CPL Lawrence Acheampong', '67042def908e34.16990129.jpg', '54669 CPL Felix Appiah', 'CZ-SCORPION', 'D406070', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 24, 2026, 6:09 am', '2026-04-24 06:09:30', 0),
(176, '', '', '8', '1161', 'April 23, 2026, 5:42 pm', '58459 L/CPL Lawrence Acheampong', '69b442eed55d23.65814209.jpg', '67156 CONST Tenadu Asiedu', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 24, 2026, 6:10 am', '2026-04-24 06:10:31', 0),
(177, '', '', '8', '1120', 'April 23, 2026, 5:43 pm', '58459 L/CPL Lawrence Acheampong', '69b28705873187.89831585.jpg', '66046 CONST Samuel Zogli', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 24, 2026, 6:11 am', '2026-04-24 06:11:52', 0),
(178, '', '', '6', '1196', 'April 23, 2026, 5:44 pm', '58459 L/CPL Lawrence Acheampong', '69e31f9a5b5769.06168966.jpg', '55104 CPL Samuel Opoku', 'CZ-SCORPION', 'D135518', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '12', 'Returned', '', 'April 24, 2026, 5:59 am', '2026-04-24 05:59:11', 0),
(179, '', '', '6', '1141', 'April 23, 2026, 6:14 pm', '58459 L/CPL Lawrence Acheampong', '69b2c14ae3f559.34963057.jpg', '66942 CONST Apreku Felix', 'CZ-SCORPION', 'D406078', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 24, 2026, 5:55 am', '2026-04-24 05:55:15', 0),
(180, '', '', '6', '1116', 'April 23, 2026, 6:15 pm', '58459 L/CPL Lawrence Acheampong', '69b24df2e50153.09990062.jpg', '66855 CONST Bawah Abdul Isumaila ', 'CZ-SCORPION', 'D279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 24, 2026, 6:00 am', '2026-04-24 06:00:29', 0),
(181, '', '', '6', '44', 'April 23, 2026, 6:17 pm', '58459 L/CPL Lawrence Acheampong', '67096c20261ed8.73226717.jpg', '58213 L/CPL Abraham  Nkumdow ', 'CZ-SCORPION', 'D280014', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '12', 'Returned', '', 'April 24, 2026, 6:02 am', '2026-04-24 06:02:57', 0),
(182, '', '', '8', '1118', 'April 24, 2026, 5:53 am', '58459 L/CPL Lawrence Acheampong', '69b251f1773cf9.61070979.jpg', '65851 CONST Gabriel Ahiable', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 24, 2026, 5:35 pm', '2026-04-24 17:35:16', 0),
(183, '', '', '8', '1127', 'April 24, 2026, 5:54 am', '58459 L/CPL Lawrence Acheampong', '69b2ae62c20632.37644830.jpg', '66519 CONST Eugene Ayirebi Okyere', 'CZ807', 'E013855', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 25, 2026, 5:52 am', '2026-04-25 05:52:29', 0),
(184, '', '', '8', '1122', 'April 24, 2026, 6:13 am', '58459 L/CPL Lawrence Acheampong', '69b2894147e6f0.79616494.jpg', '66837 CONST Francis Atuobi', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 24, 2026, 6:14 pm', '2026-04-24 18:14:22', 0),
(185, '', '', '8', '1164', 'April 24, 2026, 6:14 am', '58459 L/CPL Lawrence Acheampong', '69bce39d3b06a5.99956353.jpg', '15769 CONST Asante Jessica Afful ', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 24, 2026, 6:15 pm', '2026-04-24 18:15:41', 0),
(186, '', '', '6', '1196', 'April 24, 2026, 6:46 am', '58459 L/CPL Lawrence Acheampong', '69e31f9a5b5769.06168966.jpg', '56140 L/CPL Samuel Ntim', 'D406070 CZ-SCORPION ( Rifle) - [Caliber: 9x19mm] ', 'D406070', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '', 'Returned', '', 'April 24, 2026, 6:50 am', '2026-04-24 06:50:43', 0),
(187, '', '', '6', '29', 'April 24, 2026, 6:47 am', '58459 L/CPL Lawrence Acheampong', '670543f75f17e1.72713618.jpg', '55931 L/CPL George  Osei Agyemang ', 'CZ-SCORPION', 'D281556', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 25, 2026, 5:56 am', '2026-04-25 05:56:50', 0),
(188, '', '', '6', '55', 'April 24, 2026, 6:52 am', '58459 L/CPL Lawrence Acheampong', '670a788174fa91.75312494.jpg', '10569 L/CPL Alberta Asieduwaa', 'CZ-SCORPION', 'D406070', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 25, 2026, 5:58 am', '2026-04-25 05:58:00', 0),
(189, '', '', '6', '34', 'April 24, 2026, 9:22 am', '58459 L/CPL Lawrence Acheampong', '670697d72147b2.04817119.jpg', '55637 L/Cpl.  Prince Amponsah', 'BERETTA-M9', 'M9-213813', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 15, 15, 'Not-Faulty', 0, 'Guide Duty', 'Escort', '12', 'Returned', '', 'April 29, 2026, 5:59 pm', '2026-04-29 17:59:00', 0),
(190, '', '', '8', '1120', 'April 24, 2026, 6:17 pm', '58459 L/CPL Lawrence Acheampong', '69b28705873187.89831585.jpg', '66046 CONST Samuel Zogli', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 25, 2026, 6:07 am', '2026-04-25 06:07:23', 0),
(191, '', '', '8', '1161', 'April 24, 2026, 6:18 pm', '58459 L/CPL Lawrence Acheampong', '69b442eed55d23.65814209.jpg', '67156 CONST Tenadu Asiedu', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 25, 2026, 6:11 am', '2026-04-25 06:11:44', 0),
(192, '', '', '6', '1196', 'April 24, 2026, 6:27 pm', '58459 L/CPL Lawrence Acheampong', '69e31f9a5b5769.06168966.jpg', '55104 CPL Samuel Opoku', 'CZ-SCORPION', 'D279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 25, 2026, 5:59 am', '2026-04-25 05:59:13', 0),
(193, '', '', '6', '1116', 'April 24, 2026, 6:28 pm', '58459 L/CPL Lawrence Acheampong', '69b24df2e50153.09990062.jpg', '66855 CONST Bawah Abdul Isumaila ', 'CZ-SCORPION', 'D135518', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'May 1, 2026, 5:32 am', '2026-05-01 05:32:21', 0),
(194, '', '', '6', '1141', 'April 24, 2026, 6:29 pm', '58459 L/CPL Lawrence Acheampong', '69b2c14ae3f559.34963057.jpg', '66942 CONST Apreku Felix', 'CZ-SCORPION', 'D406078', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 25, 2026, 5:40 am', '2026-04-25 05:40:38', 0),
(195, '', '', '8', '1128', 'April 25, 2026, 5:54 am', '58459 L/CPL Lawrence Acheampong', '69b2b12bde6fe0.29997882.jpg', '66741 CONST Abdulai Sualisu', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 26, 2026, 6:32 am', '2026-04-26 06:32:15', 0),
(196, '', '', '8', '1122', 'April 25, 2026, 6:06 am', '58459 L/CPL Lawrence Acheampong', '69b2894147e6f0.79616494.jpg', '66837 CONST Francis Atuobi', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 25, 2026, 5:49 pm', '2026-04-25 17:49:43', 0),
(197, '', '', '8', '1164', 'April 25, 2026, 6:09 am', '58459 L/CPL Lawrence Acheampong', '69bce39d3b06a5.99956353.jpg', '15769 CONST Asante Jessica Afful ', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 25, 2026, 6:00 pm', '2026-04-25 18:00:25', 0),
(198, '', '', '8', '1155', 'April 25, 2026, 6:10 am', '58459 L/CPL Lawrence Acheampong', '69b3c9592099d1.82925269.jpg', '67232 CONST Seth Woolley', 'CZ807', 'E013855', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 26, 2026, 6:34 am', '2026-04-26 06:34:30', 0),
(199, '', '', '6', '1190', 'April 25, 2026, 6:19 am', '58459 L/CPL Lawrence Acheampong', '69c5125608d7e1.61040660.jpg', '58249 L/CPL Evans Ofosu', 'CZ-SCORPION', 'D406070', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '12', 'Returned', '', 'April 25, 2026, 5:53 pm', '2026-04-25 17:53:41', 0),
(200, '', '', '6', '13', 'April 25, 2026, 6:20 am', '58459 L/CPL Lawrence Acheampong', '67042def908e34.16990129.jpg', '54669 CPL Felix Appiah', 'CZ-SCORPION', 'D279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '12', 'Returned', '', 'April 26, 2026, 6:30 am', '2026-04-26 06:30:25', 0),
(201, '', '', '8', '1120', 'April 25, 2026, 5:52 pm', '58459 L/CPL Lawrence Acheampong', '69b28705873187.89831585.jpg', '66046 CONST Samuel Zogli', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 26, 2026, 6:10 am', '2026-04-26 06:10:21', 0),
(202, '', '', '8', '1161', 'April 25, 2026, 6:03 pm', '58459 L/CPL Lawrence Acheampong', '69b442eed55d23.65814209.jpg', '67156 CONST Tenadu Asiedu', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 26, 2026, 6:11 am', '2026-04-26 06:11:40', 0),
(203, '', '238', '8', '84', 'April 25, 2026, 6:24 pm', '58459 L/CPL Lawrence Acheampong', '670ad384951d08.94188639.jpg', '58339 L/CPL Emmanuel Painstsil', 'CZ807', '578978', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 30, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 26, 2026, 5:41 am', '2026-04-26 05:41:41', 0),
(204, '', '', '6', '44', 'April 25, 2026, 6:32 pm', '58459 L/CPL Lawrence Acheampong', '67096c20261ed8.73226717.jpg', '58213 L/CPL Abraham  Nkumdow ', 'CZ-SCORPION', 'D279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '12', 'Returned', '', 'April 26, 2026, 6:35 am', '2026-04-26 06:35:55', 0),
(205, '', '', '6', '55', 'April 25, 2026, 6:34 pm', '58459 L/CPL Lawrence Acheampong', '670a788174fa91.75312494.jpg', '10569 L/CPL Alberta Asieduwaa', 'CZ-SCORPION', 'D406070', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '12', 'Returned', '', 'April 26, 2026, 6:37 am', '2026-04-26 06:37:28', 0),
(206, '', '', '8', '1119', 'April 26, 2026, 6:13 am', '58459 L/CPL Lawrence Acheampong', '69b2597f9064b9.89473236.jpg', '65848 CONST Ebenezer Aidoo', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 26, 2026, 6:03 pm', '2026-04-26 18:03:46', 0),
(207, '', '', '8', '1152', 'April 26, 2026, 6:16 am', '58459 L/CPL Lawrence Acheampong', '69b2fc8cb94e66.84077538.jpg', '15994 CONST Bafanayah Dennis Helena ', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 26, 2026, 6:06 pm', '2026-04-26 18:06:22', 0),
(208, '', '', '6', '1194', 'April 26, 2026, 6:20 am', '58459 L/CPL Lawrence Acheampong', '69c9aac0bd6f59.62327774.jpg', '56277 L/CPL Benjamin Antwi-Kusi', 'CZ-SCORPION', 'D279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 27, 2026, 6:03 am', '2026-04-27 06:03:01', 0),
(209, '', '', '6', '56', 'April 26, 2026, 6:21 am', '58459 L/CPL Lawrence Acheampong', '670a7a37a5ed83.64890035.jpg', '10706 L/CPL Emelia Akyamaa', 'CZ-SCORPION', 'D406070', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 26, 2026, 6:08 pm', '2026-04-26 18:08:30', 0),
(210, '', '', '8', '1156', 'April 26, 2026, 6:25 am', '58459 L/CPL Lawrence Acheampong', '69b3cb1a952059.88393048.jpg', '66407 CONST Obeng Joseph Konadu', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 27, 2026, 6:11 am', '2026-04-27 06:11:49', 0),
(211, '', '', '8', '1162', 'April 26, 2026, 6:26 am', '58459 L/CPL Lawrence Acheampong', '69b550add89769.58634026.jpg', '66500 CONST Yakubu Amadu', 'CZ807', 'E013855', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 27, 2026, 6:13 am', '2026-04-27 06:13:02', 0),
(212, '', '', '6', '36', 'April 26, 2026, 6:28 am', '58459 L/CPL Lawrence Acheampong', '6707dc04e99862.44989633.jpg', '57976 L/CPL Richmond  Agyei Yeboah ', 'CZ-SCORPION', 'D406078', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 27, 2026, 5:50 am', '2026-04-27 05:50:52', 0),
(213, '', '', '8', '1123', 'April 26, 2026, 6:10 pm', '58459 L/CPL Lawrence Acheampong', '69b28aba198b96.79213544.jpg', '65808 CONST Prosper Dagadu', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 27, 2026, 6:15 am', '2026-04-27 06:15:10', 0),
(214, '', '', '8', '1121', 'April 26, 2026, 6:11 pm', '58459 L/CPL Lawrence Acheampong', '69b28830d5ea93.99641637.jpg', '66138 CONST Isaac Appiah', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 27, 2026, 6:16 am', '2026-04-27 06:16:23', 0),
(215, '', '', '8', '84', 'April 26, 2026, 6:12 pm', '58459 L/CPL Lawrence Acheampong', '670ad384951d08.94188639.jpg', '58339 L/CPL Emmanuel Painstsil', 'AK47', '232084', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Armed Guide', '12', 'Returned', '', 'April 27, 2026, 6:03 am', '2026-04-27 06:03:55', 0),
(216, '', '', '8', '1119', 'April 27, 2026, 6:05 am', '58459 L/CPL Lawrence Acheampong', '69b2597f9064b9.89473236.jpg', '65848 CONST Ebenezer Aidoo', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 27, 2026, 6:06 pm', '2026-04-27 18:06:14', 0),
(217, '', '', '8', '1152', 'April 27, 2026, 6:07 am', '58459 L/CPL Lawrence Acheampong', '69b2fc8cb94e66.84077538.jpg', '15994 CONST Bafanayah Dennis Helena ', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 27, 2026, 6:07 pm', '2026-04-27 18:07:35', 0),
(218, '', '', '8', '1131', 'April 27, 2026, 6:09 am', '58459 L/CPL Lawrence Acheampong', '69b2b489043f43.52712900.jpg', '66792 CONST Haruna Abdulai ', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 28, 2026, 6:34 am', '2026-04-28 06:34:37', 0),
(219, '', '', '8', '1148', 'April 27, 2026, 6:10 am', '58459 L/CPL Lawrence Acheampong', '69b2d17a2b8438.44320500.jpg', '67304 CONST Baba Osman ', 'CZ807', 'E013855', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 28, 2026, 6:36 am', '2026-04-28 06:36:08', 0),
(220, '', '', '6', '1196', 'April 27, 2026, 6:21 am', '58459 L/CPL Lawrence Acheampong', '69e31f9a5b5769.06168966.jpg', '56140 L/CPL Samuel Ntim', 'D406078 CZ-SCORPION ( Rifle) - [Caliber: 9x19mm] ', 'D406070', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 0, ' ', 0, 'Patrol duty', 'Airporthills', '', 'Not-Return', '', ' ', '2026-04-27 06:25:13', 0),
(221, '', '', '6', '29', 'April 27, 2026, 6:23 am', '58459 L/CPL Lawrence Acheampong', '670543f75f17e1.72713618.jpg', '55931 L/CPL George  Osei Agyemang ', 'CZ-SCORPION', 'D406070', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 28, 2026, 6:18 am', '2026-04-28 06:18:29', 0),
(222, '', '', '6', '1185', 'April 27, 2026, 6:29 am', '58459 L/CPL Lawrence Acheampong', '69c41825edcc14.61652171.jpg', '56082 L/CPL Frank Asamoah Appeakorang', 'CZ-SCORPION', 'D406078', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 28, 2026, 6:42 am', '2026-04-28 06:42:25', 0),
(223, '', '', '6', '46', 'April 27, 2026, 6:38 am', '58459 L/CPL Lawrence Acheampong', '670974a6ebcdc9.60476512.jpg', '58239 L/CPL Enerst Anim ', 'CZ-SCORPION', 'D279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 28, 2026, 6:45 am', '2026-04-28 06:45:34', 0),
(224, '', '', '8', '1123', 'April 27, 2026, 6:04 pm', '58459 L/CPL Lawrence Acheampong', '69b28aba198b96.79213544.jpg', '65808 CONST Prosper Dagadu', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 28, 2026, 6:37 am', '2026-04-28 06:37:36', 0),
(225, '', '', '8', '1121', 'April 27, 2026, 6:05 pm', '58459 L/CPL Lawrence Acheampong', '69b28830d5ea93.99641637.jpg', '66138 CONST Isaac Appiah', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 28, 2026, 6:40 am', '2026-04-28 06:40:02', 0),
(226, '', '', '6', '44', 'April 27, 2026, 6:27 pm', '58459 L/CPL Lawrence Acheampong', '67096c20261ed8.73226717.jpg', '58213 L/CPL Abraham  Nkumdow ', 'CZ-SCORPION', 'D280014', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '12', 'Returned', '', 'April 28, 2026, 6:47 am', '2026-04-28 06:47:19', 0),
(227, '', '', '8', '1152', 'April 28, 2026, 6:22 am', '58459 L/CPL Lawrence Acheampong', '69b2fc8cb94e66.84077538.jpg', '15994 CONST Bafanayah Dennis Helena ', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 28, 2026, 6:02 pm', '2026-04-28 18:02:22', 0),
(228, '', '', '8', '1119', 'April 28, 2026, 6:26 am', '58459 L/CPL Lawrence Acheampong', '69b2597f9064b9.89473236.jpg', '65848 CONST Ebenezer Aidoo', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 28, 2026, 6:03 pm', '2026-04-28 18:03:38', 0),
(229, '', '', '8', '1156', 'April 28, 2026, 6:28 am', '58459 L/CPL Lawrence Acheampong', '69b3cb1a952059.88393048.jpg', '66407 CONST Obeng Joseph Konadu', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 29, 2026, 6:52 am', '2026-04-29 06:52:49', 0),
(230, '', '', '8', '1162', 'April 28, 2026, 6:29 am', '58459 L/CPL Lawrence Acheampong', '69b550add89769.58634026.jpg', '66500 CONST Yakubu Amadu', 'CZ807', 'E013855', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 29, 2026, 6:55 am', '2026-04-29 06:55:19', 0),
(231, '', '', '6', '36', 'April 28, 2026, 6:30 am', '58459 L/CPL Lawrence Acheampong', '6707dc04e99862.44989633.jpg', '57976 L/CPL Richmond  Agyei Yeboah ', 'CZ-SCORPION', 'D406078', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 29, 2026, 7:21 am', '2026-04-29 07:21:53', 0),
(232, '', '', '6', '1194', 'April 28, 2026, 6:32 am', '58459 L/CPL Lawrence Acheampong', '69c9aac0bd6f59.62327774.jpg', '56277 L/CPL Benjamin Antwi-Kusi', 'CZ-SCORPION', 'D280014', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 29, 2026, 7:22 am', '2026-04-29 07:22:34', 0),
(233, '', '', '6', '56', 'April 28, 2026, 6:33 am', '58459 L/CPL Lawrence Acheampong', '670a7a37a5ed83.64890035.jpg', '10706 L/CPL Emelia Akyamaa', 'CZ-SCORPION', 'D279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 29, 2026, 7:24 am', '2026-04-29 07:24:24', 0),
(234, '', '', '8', '1121', 'April 28, 2026, 5:59 pm', '58459 L/CPL Lawrence Acheampong', '69b28830d5ea93.99641637.jpg', '66138 CONST Isaac Appiah', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 29, 2026, 6:57 am', '2026-04-29 06:57:04', 0),
(235, '', '', '8', '1123', 'April 28, 2026, 6:00 pm', '58459 L/CPL Lawrence Acheampong', '69b28aba198b96.79213544.jpg', '65808 CONST Prosper Dagadu', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 29, 2026, 6:58 am', '2026-04-29 06:58:30', 0),
(236, '', '', '6', '1196', 'April 28, 2026, 6:01 pm', '58459 L/CPL Lawrence Acheampong', '69e31f9a5b5769.06168966.jpg', '55104 CPL Samuel Opoku', 'CZ-SCORPION', 'D406070', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '12', 'Returned', '', 'April 29, 2026, 7:34 am', '2026-04-29 07:34:09', 0),
(237, '', '', '8', '1148', 'April 29, 2026, 7:36 am', '58459 L/CPL Lawrence Acheampong', '69b2d17a2b8438.44320500.jpg', '67304 CONST Baba Osman ', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 30, 2026, 6:14 am', '2026-04-30 06:14:14', 0),
(238, '', '', '8', '1131', 'April 29, 2026, 7:37 am', '58459 L/CPL Lawrence Acheampong', '69b2b489043f43.52712900.jpg', '66792 CONST Haruna Abdulai ', 'CZ807', 'E013855', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'April 30, 2026, 6:15 am', '2026-04-30 06:15:46', 0),
(239, '', '', '8', '1152', 'April 29, 2026, 7:39 am', '58459 L/CPL Lawrence Acheampong', '69b2fc8cb94e66.84077538.jpg', '15994 CONST Bafanayah Dennis Helena ', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 29, 2026, 5:32 pm', '2026-04-29 17:32:18', 0),
(240, '', '', '8', '1119', 'April 29, 2026, 7:41 am', '58459 L/CPL Lawrence Acheampong', '69b2597f9064b9.89473236.jpg', '65848 CONST Ebenezer Aidoo', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 29, 2026, 5:57 pm', '2026-04-29 17:57:52', 0),
(241, '', '', '6', '1185', 'April 29, 2026, 7:48 am', '58459 L/CPL Lawrence Acheampong', '69c41825edcc14.61652171.jpg', '56082 L/CPL Frank Asamoah Appeakorang', 'CZ-SCORPION', 'D406078', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 30, 2026, 5:55 am', '2026-04-30 05:55:20', 0),
(242, '', '', '6', '46', 'April 29, 2026, 7:49 am', '58459 L/CPL Lawrence Acheampong', '670974a6ebcdc9.60476512.jpg', '58239 L/CPL Enerst Anim ', 'CZ-SCORPION', 'D406070', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 30, 2026, 5:56 am', '2026-04-30 05:56:46', 0),
(243, '', '', '6', '29', 'April 29, 2026, 7:52 am', '58459 L/CPL Lawrence Acheampong', '670543f75f17e1.72713618.jpg', '55931 L/CPL George  Osei Agyemang ', 'CZ-SCORPION', 'D279990', 'None', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'April 30, 2026, 5:58 am', '2026-04-30 05:58:10', 0),
(244, '', '', '8', '1123', 'April 29, 2026, 5:31 pm', '58459 L/CPL Lawrence Acheampong', '69b28aba198b96.79213544.jpg', '65808 CONST Prosper Dagadu', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 30, 2026, 6:18 am', '2026-04-30 06:18:33', 0),
(245, '', '', '8', '1121', 'April 29, 2026, 5:56 pm', '58459 L/CPL Lawrence Acheampong', '69b28830d5ea93.99641637.jpg', '66138 CONST Isaac Appiah', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 30, 2026, 6:18 pm', '2026-04-30 18:18:19', 0),
(246, '', '', '6', '1196', 'April 29, 2026, 6:19 pm', '58459 L/CPL Lawrence Acheampong', '69e31f9a5b5769.06168966.jpg', '55104 CPL Samuel Opoku', 'CZ-SCORPION', 'D280014', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '12', 'Returned', '', 'April 30, 2026, 5:59 am', '2026-04-30 05:59:40', 0),
(247, '', '', '8', '1119', 'April 30, 2026, 6:04 am', '58459 L/CPL Lawrence Acheampong', '69b2597f9064b9.89473236.jpg', '65848 CONST Ebenezer Aidoo', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'April 30, 2026, 6:25 pm', '2026-04-30 18:25:58', 0),
(248, '', '', '8', '1156', 'April 30, 2026, 6:06 am', '58459 L/CPL Lawrence Acheampong', '69b3cb1a952059.88393048.jpg', '66407 CONST Obeng Joseph Konadu', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'May 1, 2026, 6:07 am', '2026-05-01 06:07:57', 0),
(249, '', '', '6', '36', 'April 30, 2026, 6:07 am', '58459 L/CPL Lawrence Acheampong', '6707dc04e99862.44989633.jpg', '57976 L/CPL Richmond  Agyei Yeboah ', 'CZ-SCORPION', 'D406070', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'May 1, 2026, 6:04 am', '2026-05-01 06:04:29', 0),
(250, '', '', '8', '1162', 'April 30, 2026, 6:12 am', '58459 L/CPL Lawrence Acheampong', '69b550add89769.58634026.jpg', '66500 CONST Yakubu Amadu', 'CZ807', 'E103855', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'May 1, 2026, 6:09 am', '2026-05-01 06:09:43', 0),
(251, '', '', '6', '1194', 'April 30, 2026, 6:36 am', '58459 L/CPL Lawrence Acheampong', '69c9aac0bd6f59.62327774.jpg', '56277 L/CPL Benjamin Antwi-Kusi', 'CZ-SCORPION', 'D406078', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'May 1, 2026, 6:06 am', '2026-05-01 06:06:16', 0),
(252, '', '', '8', '1121', 'April 30, 2026, 6:22 pm', '58459 L/CPL Lawrence Acheampong', '69b28830d5ea93.99641637.jpg', '66138 CONST Isaac Appiah', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'May 1, 2026, 6:11 am', '2026-05-01 06:11:27', 0),
(253, '', '', '8', '1123', 'April 30, 2026, 6:24 pm', '58459 L/CPL Lawrence Acheampong', '69b28aba198b96.79213544.jpg', '65808 CONST Prosper Dagadu', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'May 1, 2026, 5:48 pm', '2026-05-01 17:48:13', 0),
(254, '', '', '8', '1119', 'May 1, 2026, 5:59 am', '58459 L/CPL Lawrence Acheampong', '69b2597f9064b9.89473236.jpg', '65848 CONST Ebenezer Aidoo', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'May 1, 2026, 5:52 pm', '2026-05-01 17:52:39', 0),
(255, '', '', '8', '1148', 'May 1, 2026, 6:00 am', '58459 L/CPL Lawrence Acheampong', '69b2d17a2b8438.44320500.jpg', '67304 CONST Baba Osman ', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'May 2, 2026, 6:21 am', '2026-05-02 06:21:15', 0),
(256, '', '', '8', '1131', 'May 1, 2026, 6:01 am', '58459 L/CPL Lawrence Acheampong', '69b2b489043f43.52712900.jpg', '66792 CONST Haruna Abdulai ', 'CZ807', 'E013855', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Returned', '', 'May 2, 2026, 6:23 am', '2026-05-02 06:23:20', 0),
(257, '', '', '6', '1185', 'May 1, 2026, 6:28 am', '58459 L/CPL Lawrence Acheampong', '69c41825edcc14.61652171.jpg', '56082 L/CPL Frank Asamoah Appeakorang', 'CZ-SCORPION', 'D135518', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'May 2, 2026, 6:03 am', '2026-05-02 06:03:26', 0),
(258, '', '', '6', '29', 'May 1, 2026, 6:48 am', '58459 L/CPL Lawrence Acheampong', '670543f75f17e1.72713618.jpg', '55931 L/CPL George  Osei Agyemang ', 'CZ-SCORPION', 'D280014', 'None', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'May 2, 2026, 6:05 am', '2026-05-02 06:05:16', 0),
(259, '', '', '6', '46', 'May 1, 2026, 6:58 am', '58459 L/CPL Lawrence Acheampong', '670974a6ebcdc9.60476512.jpg', '58239 L/CPL Enerst Anim ', 'CZ-SCORPION', 'D406070', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', '', 'May 2, 2026, 6:06 am', '2026-05-02 06:06:59', 0),
(260, '', '', '8', '1123', 'May 1, 2026, 5:50 pm', '58459 L/CPL Lawrence Acheampong', '69b28aba198b96.79213544.jpg', '65808 CONST Prosper Dagadu', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'May 2, 2026, 6:24 am', '2026-05-02 06:24:55', 0),
(261, '', '', '8', '1121', 'May 1, 2026, 5:51 pm', '58459 L/CPL Lawrence Acheampong', '69b28830d5ea93.99641637.jpg', '66138 CONST Isaac Appiah', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'DG/NAPD', '12', 'Returned', '', 'May 3, 2026, 6:15 am', '2026-05-03 06:15:12', 0),
(262, '', '', '6', '1196', 'May 1, 2026, 6:55 pm', '58459 L/CPL Lawrence Acheampong', '69e31f9a5b5769.06168966.jpg', '55104 CPL Samuel Opoku', 'CZ-SCORPION', 'D279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, 'Not-Faulty', 0, 'Guide Duty', 'Airporthills', '12', 'Returned', '', 'May 2, 2026, 6:08 am', '2026-05-02 06:08:37', 0),
(263, '', '', '6', '', 'May 3, 2026, 3:14 pm', '58459 L/CPL Lawrence Acheampong', '', '47738 G/Sgt Elikem Adzawla', 'BERETTA-M9', 'm9-211709', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 15, 0, ' ', 0, 'Guide Duty', 'Escort', '24 hours', 'Not-Return', '', ' ', '2026-05-03 15:14:00', 0),
(264, '', '', '8', '1122', 'May 5, 2026, 6:20 am', '58459 L/CPL Lawrence Acheampong', '69b2894147e6f0.79616494.jpg', '66837 CONST Francis Atuobi', 'CZ807', 'D418901', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 0, ' ', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Not-Return', '', ' ', '2026-05-05 06:20:16', 0),
(265, '', '', '8', '1121', 'May 5, 2026, 6:23 am', '58459 L/CPL Lawrence Acheampong', '69b28830d5ea93.99641637.jpg', '66138 CONST Isaac Appiah', 'CZ807', 'EO13855', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 0, ' ', 0, 'Guide Duty', 'F. Interior', '24 hours', 'Not-Return', '', ' ', '2026-05-05 06:23:33', 0),
(266, '', '', '8', '1129', 'May 5, 2026, 6:26 am', '58459 L/CPL Lawrence Acheampong', '69b2b2125deac3.56142041.jpg', '15815 CONST Nancy Agyei', 'CZ807', 'F102305', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 0, ' ', 0, 'Guide Duty', 'DG/NAPD', '12', 'Not-Return', '', ' ', '2026-05-05 06:26:01', 0),
(267, '', '', '8', '1130', 'May 5, 2026, 6:27 am', '58459 L/CPL Lawrence Acheampong', '69b2b35c6d4509.23082572.jpg', '67255 CONST Rauf Abdul - Rahaman', 'CZ807', 'F141249', 'Duty-Weapon', 0, 'Not-Faulty', '7.62x39 ', 20, 0, ' ', 0, 'Guide Duty', 'DG/NAPD', '12', 'Not-Return', '', ' ', '2026-05-05 06:27:21', 0),
(268, '', '', '6', '13', 'May 5, 2026, 6:29 am', '58459 L/CPL Lawrence Acheampong', '67042def908e34.16990129.jpg', '54669 CPL Felix Appiah', 'CZ-SCORPION', 'D279990', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 0, ' ', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Not-Return', '', ' ', '2026-05-09 09:25:27', 1),
(269, '', '', '6', '104', 'May 5, 2026, 6:36 am', '58459 L/CPL Lawrence Acheampong', '670b0b12d75bf7.81499515.jpg', '54253 CPL Wisdom  Adzasu', 'CZ-SCORPION', 'D406070', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 0, ' ', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Not-Return', '', ' ', '2026-05-05 06:36:18', 0),
(270, '', '', '6', '59', 'May 5, 2026, 6:37 am', '58459 L/CPL Lawrence Acheampong', '670a7d13d26c27.84839470.jpg', '10048 CPL Elizabet Appiah', 'CZ-SCORPION', 'D135518', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 20, ' ', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Returned', 'gdsgdgdh', 'May 9, 2026, 11:25 am', '2026-05-09 09:25:09', 0),
(271, '', '', '6', '1190', 'May 5, 2026, 6:43 am', '58459 L/CPL Lawrence Acheampong', '69c5125608d7e1.61040660.jpg', '58249 L/CPL Evans Ofosu', 'CZ-SCORPION', 'D176116', 'Duty-Weapon', 0, 'Not-Faulty', '9MM', 20, 0, ' ', 0, 'Patrol duty', 'Airporthills', '24 hours', 'Not-Return', '', ' ', '2026-05-09 09:03:40', 1);

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
  `firearm_serial_no` varchar(200) NOT NULL,
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
  `activityID` int(11) NOT NULL,
  `adminID` int(11) NOT NULL,
  `armourer_admin_name` varchar(255) NOT NULL,
  `user_role` varchar(100) NOT NULL,
  `action_taken` text NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daily_activities`
--

INSERT INTO `daily_activities` (`activityID`, `adminID`, `armourer_admin_name`, `user_role`, `action_taken`, `category`, `ip_address`, `datetime`) VALUES
(1, 0, 'William NTI', 'Administrator', 'INDUCTED_ASSET: [AK6767 | SN: 123FGH]', 'Asset Management', '', '2026-05-12 16:58:04'),
(2, 0, 'William NTI', 'Administrator', 'INDUCTED_ASSET: [AK6767 | SN: WEGHA]', 'Asset Management', '', '2026-05-12 17:11:27'),
(3, 0, 'William NTI', 'Administrator', 'INDUCTED_NEW_ASSET: [ NP-22 | SN: 4623 ]', 'Asset Management', '', '2026-05-12 17:18:08'),
(4, 0, 'William NTI', 'Administrator', 'INDUCTED_NEW_ASSET: [ NP-18 | SN: R1234 ]', 'Asset Management', '', '2026-05-12 17:19:48'),
(5, 0, 'William NTI', 'Administrator', 'Deleted Firearm Name [  ]', 'Firearm Management', '', '2026-05-12 18:02:23'),
(6, 5, '12345 C/INSPR William NTI', 'Administrator', 'SOFT_DELETE_PERFORMED on Asset ID: 576', 'Firearm Management', '', '2026-05-12 18:04:40');

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
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0
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
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faulty_weapons`
--

INSERT INTO `faulty_weapons` (`faulty_weaponID`, `faulty_firearm_serial_no`, `faulty_firearm_type`, `faulty_firearm_name`, `faulty_firearm_class`, `faulty_type`, `faulty_nature`, `faulty_firearm_image`, `faulty_firearm_comment`, `datetime`, `is_deleted`) VALUES
(1, '198630-2', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae1ea9d2301.71027147.jpeg', '', '2024-09-30 17:37:46', 0),
(2, 'HA-3907', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae29e155507.52951122.png', '', '2024-09-30 17:40:46', 0),
(3, '0070-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae2c5c947b1.58326814.jpg', '', '2024-09-30 17:41:25', 0),
(4, '0022-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae2dfeb2aa1.43677299.jpg', '', '2024-09-30 17:41:51', 0),
(5, '0019-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae3119c0085.43071970.jpeg', '', '2024-09-30 17:42:41', 0),
(6, '0011-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae3396f18f6.49948013.jpeg', '', '2024-09-30 17:43:21', 0),
(7, '0005-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae3588cad75.85646023.jpg', '', '2024-09-30 17:43:52', 0),
(8, '0064-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae380f13346.45458335.jpeg', '', '2024-09-30 17:44:32', 0),
(9, '0035-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae3a459c2a9.65662021.jpg', '', '2024-09-30 17:45:08', 0),
(10, '0025-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Unserviceable', '66fae3c996e9a3.81115654.jpg', '', '2024-09-30 17:45:45', 0),
(11, '0027-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Unserviceable', '66fae3f2a53846.47659020.jpeg', '', '2024-09-30 17:46:26', 0),
(12, '0009-19', 'Rifle', 'AK47', 'Duty Weapon', 'Breakage', 'Serviceable', '66fae4156570f4.13374582.jpeg', '', '2024-09-30 17:47:01', 0),
(13, 'M9-211856', 'Side-Arm', 'BERETTA-M9', 'Duty Weapon', 'Trigger issue', 'Serviceable', '66fc1c8259f0d5.93980816.jpg', '', '2024-10-01 16:00:02', 0);

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
  `booking_status` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0,
  `adminID` int(100) NOT NULL,
  `recorded_by` varchar(200) NOT NULL,
  `remarks` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `firearms`
--

INSERT INTO `firearms` (`firearmID`, `firearm_serial_no`, `manufacturer`, `firearm_type`, `firearm_name`, `firearm_caliber`, `firearm_capacity`, `quantity`, `firearm_class`, `firearm_state`, `booking_status`, `datetime`, `is_deleted`, `adminID`, `recorded_by`, `remarks`) VALUES
(42, 'C069621', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-04-20 06:12:35', 0, 0, '', ''),
(43, ' C065685', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-30 17:50:39', 0, 0, '', ''),
(44, 'C056439', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:01:01', 0, 0, '', ''),
(45, 'C052873', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:05:00', 0, 0, '', ''),
(46, 'C068428', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 14:27:27', 0, 0, '', ''),
(47, 'C068408', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-02 17:35:43', 0, 0, '', ''),
(48, 'C082027', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:09:17', 0, 0, '', ''),
(49, 'C069641', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:11:04', 0, 0, '', ''),
(50, 'C081998', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:13:34', 0, 0, '', ''),
(51, 'C082001', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:15:04', 0, 0, '', ''),
(52, 'C071864', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-02 17:32:12', 0, 0, '', ''),
(54, 'C061894', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:20:29', 0, 0, '', ''),
(55, 'C052885', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-30 17:50:35', 0, 0, '', ''),
(56, 'C056437', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:24:00', 0, 0, '', ''),
(57, 'C085120', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:26:39', 0, 0, '', ''),
(58, 'C082009', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-02 17:31:51', 0, 0, '', ''),
(59, 'C061893', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-30 17:50:24', 0, 0, '', ''),
(60, 'C069628', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:37:29', 0, 0, '', ''),
(61, 'C082026', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:40:18', 0, 0, '', ''),
(62, 'C061901', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 14:05:19', 0, 0, '', ''),
(63, 'AZ -4233', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-30 17:50:11', 0, 0, '', ''),
(64, 'AZ-4543', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:20:35', 0, 0, '', ''),
(65, 'AL-0548', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:22:11', 0, 0, '', ''),
(66, '0087', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:24:00', 0, 0, '', ''),
(67, 'NA-201147', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 14:22:49', 0, 0, '', ''),
(68, '0066', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:27:56', 0, 0, '', ''),
(69, '0028', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:29:23', 0, 0, '', ''),
(70, '1155', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:31:54', 0, 0, '', ''),
(72, '0044', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:38:42', 0, 0, '', ''),
(73, '0084', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:39:55', 0, 0, '', ''),
(75, '0024', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:43:04', 0, 0, '', ''),
(76, '198630-2', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-30 23:53:29', 0, 0, '', ''),
(77, 'HA-3907', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-30 23:57:36', 0, 0, '', ''),
(78, '0070-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-09-30 20:57:08', 0, 0, '', ''),
(79, '0022-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-31 00:00:34', 0, 0, '', ''),
(80, '0019-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-31 00:01:52', 0, 0, '', ''),
(81, '0011-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-09-30 20:57:48', 0, 0, '', ''),
(82, '0005-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-31 00:04:34', 0, 0, '', ''),
(83, '0064-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-31 00:06:28', 0, 0, '', ''),
(84, '0035-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-31 00:10:20', 0, 0, '', ''),
(85, '0025-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-31 00:13:45', 0, 0, '', ''),
(86, '0027-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-31 00:15:24', 0, 0, '', ''),
(87, '0009-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-31 00:16:59', 0, 0, '', ''),
(88, 'M9-211881', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 22:47:11', 0, 0, '', ''),
(89, 'M9-215369', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 22:49:36', 0, 0, '', ''),
(90, 'M9-212792', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 22:57:50', 0, 0, '', ''),
(91, 'M9-211838', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-30 17:49:03', 0, 0, '', ''),
(92, 'M9-211868', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 23:04:44', 0, 0, '', ''),
(93, 'M9-215359', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, '', 'Not Faulty', 'Available', '2026-03-20 18:12:00', 0, 0, '', ''),
(94, 'M9-211681', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 23:08:21', 0, 0, '', ''),
(95, 'M9-215349', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 23:09:55', 0, 0, '', ''),
(96, 'M9-212993', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 23:11:20', 0, 0, '', ''),
(97, 'M9-215368', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 23:13:07', 0, 0, '', ''),
(98, 'M9-211873', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 23:16:45', 0, 0, '', ''),
(99, 'M9-213825', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 23:18:13', 0, 0, '', ''),
(100, 'M9-211709', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:10:18', 0, 0, '', ''),
(101, 'M9-211749', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:13:57', 0, 0, '', ''),
(102, 'M9-211649', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:16:24', 0, 0, '', ''),
(103, 'M9-213818', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:18:36', 0, 0, '', ''),
(104, 'M9-212982', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:20:11', 0, 0, '', ''),
(105, 'M9-213958', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:21:38', 0, 0, '', ''),
(106, 'M9-213345', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:24:00', 0, 0, '', ''),
(107, 'M9-212759', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:25:35', 0, 0, '', ''),
(108, 'M9-212795', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:26:56', 0, 0, '', ''),
(109, 'M9-212757', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:28:36', 0, 0, '', ''),
(110, 'M9-213956', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:29:50', 0, 0, '', ''),
(111, 'M9-211865', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:31:12', 0, 0, '', ''),
(112, 'M9-211869', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 14:22:56', 0, 0, '', ''),
(113, 'M9-211859', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:35:56', 0, 0, '', ''),
(114, 'M9-211697', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:39:35', 0, 0, '', ''),
(115, 'M9-213961', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:40:55', 0, 0, '', ''),
(116, 'M9-213820', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:42:22', 0, 0, '', ''),
(117, 'M9-213934', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:45:54', 0, 0, '', ''),
(118, 'M9-212990', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:47:43', 0, 0, '', ''),
(119, 'M9-212789', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:50:07', 0, 0, '', ''),
(120, 'M9-211703', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 13:57:56', 0, 0, '', ''),
(121, 'M9-215337', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 13:59:48', 0, 0, '', ''),
(122, 'M9-211690', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:00:57', 0, 0, '', ''),
(123, 'M9-213002', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:02:48', 0, 0, '', ''),
(124, 'M9-215326', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:18:43', 0, 0, '', ''),
(125, 'M9-211854', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:20:41', 0, 0, '', ''),
(126, 'M9-213034', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:43:16', 0, 0, '', ''),
(127, 'M9-211884', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:45:02', 0, 0, '', ''),
(128, 'M9-211855', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:48:52', 0, 0, '', ''),
(129, 'M9-211672', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:50:33', 0, 0, '', ''),
(130, 'M9-212791', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:52:45', 0, 0, '', ''),
(131, 'M9-211704', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:55:05', 0, 0, '', ''),
(133, 'M9-212740', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 15:01:17', 0, 0, '', ''),
(134, 'M9-211856', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-10-01 15:54:57', 0, 0, '', ''),
(135, 'M9-211706', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 15:07:29', 0, 0, '', ''),
(136, 'H78756Z', 'BERETTA', 'Side-Arm', 'BERETTA-92', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-02 17:26:38', 0, 0, '', ''),
(137, 'H78691Z', 'BERETTA', 'Side-Arm', 'BERETTA-92', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 16:21:53', 0, 0, '', ''),
(138, 'A13006529', 'NORINCO PISTOL', 'Side-Arm', 'NP-22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 11:37:01', 0, 0, '', ''),
(139, 'A13006661', 'NORINCO PISTOL', 'Side-Arm', 'NP-22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 11:37:11', 0, 0, '', ''),
(140, 'A13005682', 'NORINCO PISTOL', 'Side-Arm', 'NP-22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 11:37:36', 0, 0, '', ''),
(141, 'A13005725', 'NORINCO PISTOL', 'Side-Arm', 'NP-22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 11:37:08', 0, 0, '', ''),
(142, 'A13006212', 'NORINCO PISTOL', 'Side-Arm', 'NP-22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 11:37:16', 0, 0, '', ''),
(143, 'A13005759', 'NORINCO PISTOL', 'Side-Arm', 'NP-22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 11:37:19', 0, 0, '', ''),
(144, 'A13006646', 'NORINCO PISTOL', 'Side-Arm', 'NP-22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 11:37:24', 0, 0, '', ''),
(145, 'A13005667', 'NORINCO PISTOL', 'Side-Arm', 'NP-22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 11:37:27', 0, 0, '', ''),
(146, 'A13005672', 'NORINCO PISTOL', 'Side-Arm', 'NP-22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 11:37:30', 0, 0, '', ''),
(148, '11501846-6', 'NORINCO PISTOL', 'Side-Arm', 'NP-18', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 11:36:50', 0, 0, '', ''),
(153, 'SP-1036911', 'SIGPRO', 'Side-Arm', 'SIGPRO', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 11:35:01', 0, 0, '', ''),
(154, 'SP-0136960', 'SIGPRO', 'Side-Arm', 'SIGPRO', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 11:35:19', 0, 0, '', ''),
(155, 'SP-0137312', 'SIGPRO', 'Side-Arm', 'SIGPRO', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 11:35:26', 0, 0, '', ''),
(190, 'F129898', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 14:27:31', 0, 0, '', ''),
(191, 'AZ-4233', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 16:56:13', 0, 0, '', ''),
(192, '        8378', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:01:41', 0, 0, '', ''),
(193, ' 371903', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:03:11', 0, 0, '', ''),
(194, '117545', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:04:06', 0, 0, '', ''),
(195, '154368', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:04:43', 0, 0, '', ''),
(196, '207176', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:05:27', 0, 0, '', ''),
(197, 'A-15747', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:06:29', 0, 0, '', ''),
(198, '153872', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:07:56', 0, 0, '', ''),
(199, '153829', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:09:59', 0, 0, '', ''),
(200, '330102', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:12:37', 0, 0, '', ''),
(201, '639544', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:17:53', 0, 0, '', ''),
(202, '639542', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:20:08', 0, 0, '', ''),
(203, '117541', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:21:45', 0, 0, '', ''),
(204, '639549', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:22:56', 0, 0, '', ''),
(205, '639547', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:23:53', 0, 0, '', ''),
(206, '244055', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:25:08', 0, 0, '', ''),
(207, '639964', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:26:00', 0, 0, '', ''),
(208, '639978', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:26:47', 0, 0, '', ''),
(209, '335643', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:27:45', 0, 0, '', ''),
(210, '335644', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:28:38', 0, 0, '', ''),
(211, '335649', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:29:36', 0, 0, '', ''),
(212, '335645', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:30:24', 0, 0, '', ''),
(213, '335641', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:31:08', 0, 0, '', ''),
(214, '574444', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:32:05', 0, 0, '', ''),
(215, '385944', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:33:02', 0, 0, '', ''),
(216, '152290', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:33:55', 0, 0, '', ''),
(217, '639170', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:34:43', 0, 0, '', ''),
(218, '153420', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:35:31', 0, 0, '', ''),
(219, '153685', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:36:23', 0, 0, '', ''),
(220, '574804', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:37:17', 0, 0, '', ''),
(221, '401153', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:39:50', 0, 0, '', ''),
(222, '154233', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:40:49', 0, 0, '', ''),
(223, '574812', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:41:36', 0, 0, '', ''),
(224, '574802', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:42:27', 0, 0, '', ''),
(225, '574808', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:43:38', 0, 0, '', ''),
(226, '403976', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:44:31', 0, 0, '', ''),
(227, '519242', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:45:24', 0, 0, '', ''),
(228, '403782', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:46:13', 0, 0, '', ''),
(229, '90498', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:47:03', 0, 0, '', ''),
(230, '576667', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:48:14', 0, 0, '', ''),
(231, '282982', 'CZ', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:49:11', 0, 0, '', ''),
(232, '571137', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:51:57', 0, 0, '', ''),
(233, '335650', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:52:57', 0, 0, '', ''),
(234, '640563', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 14:23:21', 0, 0, '', ''),
(235, '564353', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 05:58:03', 0, 0, '', ''),
(236, '578972', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 05:59:07', 0, 0, '', ''),
(237, '578978', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:00:13', 0, 0, '', ''),
(238, '578975', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-04-26 05:41:41', 0, 0, '', ''),
(239, '438631', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:04:48', 0, 0, '', ''),
(240, '621645', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:07:37', 0, 0, '', ''),
(241, '602581', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:08:46', 0, 0, '', ''),
(242, '574367', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:09:58', 0, 0, '', ''),
(243, '573550', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:10:49', 0, 0, '', ''),
(244, '64359', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:12:33', 0, 0, '', ''),
(245, '175643', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:13:57', 0, 0, '', ''),
(246, '330277', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:14:47', 0, 0, '', ''),
(247, '417630', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:15:35', 0, 0, '', ''),
(248, '330682', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:16:40', 0, 0, '', ''),
(249, '330274', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:17:29', 0, 0, '', ''),
(250, '303849', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:18:41', 0, 0, '', ''),
(251, '210306', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:19:34', 0, 0, '', ''),
(252, '213452', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:20:50', 0, 0, '', ''),
(253, '269721', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:23:19', 0, 0, '', ''),
(254, 'B-95960', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:24:16', 0, 0, '', ''),
(255, '209423', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:25:14', 0, 0, '', ''),
(256, '283092', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:26:13', 0, 0, '', ''),
(257, '213645', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:27:24', 0, 0, '', ''),
(258, '338059', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:28:17', 0, 0, '', ''),
(259, 'B-96793', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:29:42', 0, 0, '', ''),
(260, '283054', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:31:47', 0, 0, '', ''),
(261, '215972', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:32:45', 0, 0, '', ''),
(262, 'AE-405929', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:33:51', 0, 0, '', ''),
(263, 'AL-2577', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:35:04', 0, 0, '', ''),
(264, 'AE-405827', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:36:51', 0, 0, '', ''),
(265, 'NK-405037', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:38:47', 0, 0, '', ''),
(266, '191496', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:40:31', 0, 0, '', ''),
(267, '60199', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:42:42', 0, 0, '', ''),
(268, '146979', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:43:54', 0, 0, '', ''),
(269, '229281', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:44:58', 0, 0, '', ''),
(270, '190440', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:45:55', 0, 0, '', ''),
(271, 'KP-236696', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:47:16', 0, 0, '', ''),
(272, '190337', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:51:52', 0, 0, '', ''),
(273, 'BA-405468', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:53:07', 0, 0, '', ''),
(274, '0058', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:55:22', 0, 0, '', ''),
(275, '0071-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:56:38', 0, 0, '', ''),
(276, '0073-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 14:28:07', 0, 0, '', ''),
(277, '0047', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 14:28:03', 0, 0, '', ''),
(278, 'AK-371903', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:28:47', 0, 0, '', ''),
(279, '8378', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:35:02', 0, 0, '', ''),
(280, '434339-4', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:38:30', 0, 0, '', ''),
(281, 'AE-406219', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:40:16', 0, 0, '', ''),
(282, 'NK-6114', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:41:51', 0, 0, '', ''),
(283, 'AE-405403', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:43:08', 0, 0, '', ''),
(284, 'KP-231772', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:44:43', 0, 0, '', ''),
(285, '190339', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:46:38', 0, 0, '', ''),
(286, '0104-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:47:48', 0, 0, '', ''),
(287, '0072-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:49:28', 0, 0, '', ''),
(288, '0080-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:50:48', 0, 0, '', ''),
(289, '0103-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:52:18', 0, 0, '', ''),
(290, '0026-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:53:40', 0, 0, '', ''),
(291, '0089-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:54:51', 0, 0, '', ''),
(292, '0076-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:56:07', 0, 0, '', ''),
(293, '0063-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:58:10', 0, 0, '', ''),
(294, '578971', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:59:56', 0, 0, '', ''),
(295, '117602', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:01:11', 0, 0, '', ''),
(296, '564358', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:04:54', 0, 0, '', ''),
(297, '571283', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:06:06', 0, 0, '', ''),
(298, '524354', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:11:54', 0, 0, '', ''),
(299, 'B-96411', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:14:52', 0, 0, '', ''),
(300, '445411', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:16:49', 0, 0, '', ''),
(301, '302614', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:18:13', 0, 0, '', ''),
(302, '576669', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:19:30', 0, 0, '', ''),
(303, '146142', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:20:51', 0, 0, '', ''),
(304, '232650', 'AK', 'Rifle', 'AK47', '', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:30:23', 0, 0, '', ''),
(305, 'B-104299', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:32:29', 0, 0, '', ''),
(306, '328640', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:35:36', 0, 0, '', ''),
(307, '328070', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:36:44', 0, 0, '', ''),
(308, '236033', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:37:54', 0, 0, '', ''),
(309, '269746', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:39:26', 0, 0, '', ''),
(310, '288684', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:40:33', 0, 0, '', ''),
(311, '479374', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:42:40', 0, 0, '', ''),
(312, '335642', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:43:52', 0, 0, '', ''),
(313, '335648', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:45:19', 0, 0, '', ''),
(314, '90825', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:47:28', 0, 0, '', ''),
(315, 'B-96419', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:48:50', 0, 0, '', ''),
(316, '90561', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:50:00', 0, 0, '', ''),
(317, '492035', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:52:43', 0, 0, '', ''),
(318, '0106', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:53:56', 0, 0, '', ''),
(319, 'AE-406184', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:55:09', 0, 0, '', ''),
(320, 'AL-2555', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:56:23', 0, 0, '', ''),
(321, 'AE-405367', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:00:12', 0, 0, '', ''),
(322, '283091', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:01:17', 0, 0, '', ''),
(323, '563290', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:02:29', 0, 0, '', ''),
(324, '0059-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:03:47', 0, 0, '', ''),
(325, 'A-31251', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:05:28', 0, 0, '', ''),
(326, 'BA-405540', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:06:41', 0, 0, '', ''),
(327, '0029-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:07:56', 0, 0, '', ''),
(328, 'KG-232084', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:10:01', 0, 0, '', ''),
(329, '0088-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:11:14', 0, 0, '', ''),
(330, '0044-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:12:25', 0, 0, '', ''),
(331, 'AZ-5201', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:16:29', 0, 0, '', ''),
(332, 'B-96415', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:19:35', 0, 0, '', ''),
(333, 'AL-1956', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:20:53', 0, 0, '', ''),
(334, 'AZ-2600', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:29:18', 0, 0, '', ''),
(335, 'HT-5493', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:30:30', 0, 0, '', ''),
(336, '90446', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:31:57', 0, 0, '', ''),
(337, 'KP-236862', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:35:37', 0, 0, '', ''),
(338, 'AE-405421', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:36:55', 0, 0, '', ''),
(339, '551894', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:38:52', 0, 0, '', ''),
(340, '335647', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:40:07', 0, 0, '', ''),
(341, 'AZ-4315', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:41:37', 0, 0, '', ''),
(342, '229284', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 14:25:24', 0, 0, '', ''),
(343, 'KP-231869', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 14:25:27', 0, 0, '', ''),
(344, 'KP-230476', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 14:25:31', 0, 0, '', ''),
(345, '190854', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:54:09', 0, 0, '', ''),
(346, '38957', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 14:25:34', 0, 0, '', ''),
(347, '189864', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 14:25:37', 0, 0, '', ''),
(348, 'NF-9973-57', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 14:25:41', 0, 0, '', ''),
(349, '191282', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 14:25:43', 0, 0, '', ''),
(350, '0558', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 14:25:46', 0, 0, '', ''),
(351, '0102', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:05:04', 0, 0, '', ''),
(352, '0033', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:06:24', 0, 0, '', ''),
(353, '0025', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:08:52', 0, 0, '', ''),
(354, '0101', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:10:25', 0, 0, '', ''),
(355, '0027', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:11:37', 0, 0, '', ''),
(356, '0070', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:15:12', 0, 0, '', ''),
(357, '0019', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:17:39', 0, 0, '', ''),
(358, '0055', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:19:04', 0, 0, '', ''),
(359, '0035', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:20:24', 0, 0, '', ''),
(360, '0065', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:24:49', 0, 0, '', ''),
(361, '0022', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:26:08', 0, 0, '', ''),
(362, '0011', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:27:29', 0, 0, '', ''),
(363, '0005', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:28:55', 0, 0, '', ''),
(364, '0064', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:30:41', 0, 0, '', ''),
(365, ' D135518', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 05:51:47', 0, 0, '', ''),
(366, 'D146198', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 05:58:26', 0, 0, '', ''),
(367, 'D138536', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 05:54:49', 0, 0, '', ''),
(368, 'D146193', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 05:57:50', 0, 0, '', ''),
(369, ' D147201', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 05:59:21', 0, 0, '', ''),
(370, 'D146208', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 05:58:36', 0, 0, '', ''),
(371, ' D147243', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:00:22', 0, 0, '', ''),
(372, 'D176116', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:10:07', 0, 0, '', ''),
(373, 'D174853', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:07:22', 0, 0, '', ''),
(377, 'D176064', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:09:42', 0, 0, '', ''),
(378, 'D176088', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:09:57', 0, 0, '', ''),
(379, 'D147196', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 05:58:50', 0, 0, '', ''),
(380, 'D145322', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 05:57:09', 0, 0, '', ''),
(381, 'D145304', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 05:56:31', 0, 0, '', ''),
(382, 'D135522', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 05:52:51', 0, 0, '', ''),
(383, 'D138488', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 05:54:36', 0, 0, '', ''),
(384, 'D174880', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:09:24', 0, 0, '', ''),
(385, 'D174879', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:09:03', 0, 0, '', ''),
(386, 'D174832', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:02:57', 0, 0, '', ''),
(387, 'D174878', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:08:47', 0, 0, '', ''),
(388, 'D174811', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:01:29', 0, 0, '', ''),
(389, 'D174828', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:02:09', 0, 0, '', ''),
(390, 'D174820', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:01:58', 0, 0, '', ''),
(391, 'D174871', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:08:12', 0, 0, '', ''),
(392, 'D174874', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:08:28', 0, 0, '', ''),
(393, 'D174835', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:07:08', 0, 0, '', ''),
(394, 'D174867', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:07:59', 0, 0, '', ''),
(395, 'D174816', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:01:41', 0, 0, '', ''),
(396, 'D406050', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:25:32', 0, 0, '', ''),
(397, 'D147264', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:00:35', 0, 0, '', ''),
(398, 'D151830', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:01:01', 0, 0, '', ''),
(399, 'D145292', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 05:56:19', 0, 0, '', ''),
(400, 'D147275', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:00:51', 0, 0, '', ''),
(401, 'D145310', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 05:56:57', 0, 0, '', ''),
(402, 'D145283', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 05:55:55', 0, 0, '', ''),
(403, 'D147217', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 05:59:37', 0, 0, '', ''),
(404, 'D406044', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:24:54', 0, 0, '', ''),
(405, 'D147223', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 05:59:55', 0, 0, '', ''),
(406, 'D146181', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 05:57:35', 0, 0, '', ''),
(407, 'D406046', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:25:07', 0, 0, '', ''),
(408, 'D281590', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:23:33', 0, 0, '', ''),
(409, 'D280002', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:11:30', 0, 0, '', ''),
(410, 'D279984', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:10:40', 0, 0, '', ''),
(411, 'D279985', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:10:53', 0, 0, '', ''),
(412, 'D280006', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:11:53', 0, 0, '', ''),
(413, 'D279982', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:10:24', 0, 0, '', ''),
(414, 'D279990', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:11:07', 0, 0, '', ''),
(415, 'D281579', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:21:29', 0, 0, '', ''),
(416, 'D281529', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:20:01', 0, 0, '', ''),
(417, 'D281528', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:19:46', 0, 0, '', ''),
(418, 'D281584', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:21:46', 0, 0, '', ''),
(419, 'D281527', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not Faulty', 'Available', '2026-04-16 06:18:53', 0, 0, '', ''),
(420, 'D153753', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:01:17', 0, 0, '', ''),
(421, 'D138577', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 05:55:33', 0, 0, '', ''),
(422, 'D138569', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 05:55:02', 0, 0, '', ''),
(423, 'D132848', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 05:52:07', 0, 0, '', ''),
(424, 'D132859', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 05:52:22', 0, 0, '', ''),
(425, 'D135537', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 05:53:57', 0, 0, '', ''),
(426, 'D135541', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 05:54:10', 0, 0, '', ''),
(427, 'D135530', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 05:53:04', 0, 0, '', ''),
(428, 'D138572', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 05:55:18', 0, 0, '', ''),
(429, 'D135536', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 05:53:44', 0, 0, '', ''),
(430, 'D135513', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 05:52:36', 0, 0, '', ''),
(431, 'D135548', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 05:54:22', 0, 0, '', ''),
(432, 'D145305', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 05:56:45', 0, 0, '', ''),
(433, 'D406070', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 05:58:13', 0, 0, '', ''),
(434, 'D146178', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 05:57:21', 0, 0, '', ''),
(435, 'D406085', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:26:37', 0, 0, '', ''),
(436, 'D147230', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:00:08', 0, 0, '', ''),
(437, 'D406084', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:26:21', 0, 0, '', ''),
(438, 'D406100', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:26:51', 0, 0, '', ''),
(439, 'D406014', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:24:37', 0, 0, '', ''),
(440, 'D406066', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:07:48', 0, 0, '', ''),
(441, 'D406078', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:26:06', 0, 0, '', ''),
(442, 'D406064', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:25:47', 0, 0, '', '');
INSERT INTO `firearms` (`firearmID`, `firearm_serial_no`, `manufacturer`, `firearm_type`, `firearm_name`, `firearm_caliber`, `firearm_capacity`, `quantity`, `firearm_class`, `firearm_state`, `booking_status`, `datetime`, `is_deleted`, `adminID`, `recorded_by`, `remarks`) VALUES
(443, 'D406083', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 05:53:28', 0, 0, '', ''),
(444, 'D280017', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:12:49', 0, 0, '', ''),
(445, 'D280035', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:14:28', 0, 0, '', ''),
(446, 'D280024', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:14:14', 0, 0, '', ''),
(447, 'D280013', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:12:23', 0, 0, '', ''),
(448, 'D280010', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:12:08', 0, 0, '', ''),
(449, 'D280018', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:13:12', 0, 0, '', ''),
(450, 'D280019', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:13:27', 0, 0, '', ''),
(451, 'D279994', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:11:17', 0, 0, '', ''),
(452, 'D280014', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:12:36', 0, 0, '', ''),
(453, 'D280023', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:14:01', 0, 0, '', ''),
(454, 'D280036', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:14:43', 0, 0, '', ''),
(455, 'D280021', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:13:43', 0, 0, '', ''),
(456, 'D281567', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:20:48', 0, 0, '', ''),
(457, 'D281500', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:18:28', 0, 0, '', ''),
(458, 'D281556', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:20:30', 0, 0, '', ''),
(459, 'D281588', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:23:14', 0, 0, '', ''),
(460, 'D281592', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:23:43', 0, 0, '', ''),
(461, 'D315838', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:24:18', 0, 0, '', ''),
(462, 'D281536', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:20:17', 0, 0, '', ''),
(463, 'D281506', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:18:40', 0, 0, '', ''),
(464, 'D315760', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:23:56', 0, 0, '', ''),
(465, 'D281573', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:21:18', 0, 0, '', ''),
(466, 'D281569', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:21:03', 0, 0, '', ''),
(467, 'D281497', 'CZ', 'Rifle', 'CZ-SCORPION', '9x19mm', '30', 1, '', 'Not-Faulty', 'Available', '2026-04-16 06:17:41', 0, 0, '', ''),
(468, 'M9-211694', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:12', 0, 0, '', ''),
(469, 'M9-211713', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:15', 0, 0, '', ''),
(470, 'M9-215316', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:16', 0, 0, '', ''),
(471, 'M9-212154', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:20', 0, 0, '', ''),
(473, 'M9-211716', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:24', 0, 0, '', ''),
(474, 'M9-211864', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:26', 0, 0, '', ''),
(475, 'M9-212766', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:28', 0, 0, '', ''),
(476, 'M9-213927', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:32', 0, 0, '', ''),
(477, 'M9-211892', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:34', 0, 0, '', ''),
(478, 'M9-212749', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:36', 0, 0, '', ''),
(479, 'M9-212910', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:38', 0, 0, '', ''),
(480, 'M9-211693', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:41', 0, 0, '', ''),
(481, 'M9-215353', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:43', 0, 0, '', ''),
(482, 'M9-212183', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:46', 0, 0, '', ''),
(483, 'M9-213012', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:49', 0, 0, '', ''),
(484, 'M9-211682', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:52', 0, 0, '', ''),
(485, 'M9-213995', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:54', 0, 0, '', ''),
(486, 'M9-212977', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:56', 0, 0, '', ''),
(487, 'M9-212991', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:09:59', 0, 0, '', ''),
(488, 'M9-215367', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:10:02', 0, 0, '', ''),
(489, 'M9-212989', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:10:04', 0, 0, '', ''),
(490, 'H78755Z', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-92', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:10:23', 0, 0, '', ''),
(491, 'H78690Z', 'Sellier & Bellot', 'Side-Arm', 'BERETTA-92', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:10:25', 0, 0, '', ''),
(492, '11501827', 'Sellier & Bellot', 'Side-Arm', 'NP-18', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:10:33', 0, 0, '', ''),
(493, '11501616-5', 'Sellier & Bellot', 'Side-Arm', 'NP-18', '9x19mm', '15', 1, '', 'Not-Faulty', 'Available', '2026-03-20 17:55:55', 0, 0, '', ''),
(494, '11501276', 'Sellier & Bellot', 'Side-Arm', 'NP-18', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:10:46', 0, 0, '', ''),
(495, 'A13005780', 'Sellier & Bellot', 'Side-Arm', 'NP-22', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:10:51', 0, 0, '', ''),
(496, 'A13006651', 'Sellier & Bellot', 'Side-Arm', 'NP-22', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:11:00', 0, 0, '', ''),
(502, 'SP-0136866', 'Sellier & Bellot', 'Side-Arm', 'SIGPRO', '9x19mm', '15', 1, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 15:05:07', 0, 0, '', ''),
(503, 'SP-0137277', 'Sellier & Bellot', 'Side-Arm', 'SIGPRO', '9x19mm', '15', 1, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 15:05:59', 0, 0, '', ''),
(504, 'SP-0136845', 'Sellier & Bellot', 'Side-Arm', 'SIGPRO', '9x19mm', '15', 1, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 15:07:07', 0, 0, '', ''),
(505, 'A13005679', 'Sellier & Bellot', 'Side-Arm', 'NP-22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 15:08:06', 0, 0, '', ''),
(506, 'A13006542', 'Sellier & Bellot', 'Side-Arm', 'NP-22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 15:08:54', 0, 0, '', ''),
(507, 'H78688Z', 'BERETTA', 'Side-Arm', 'BERETTA-92', '9x19mm', '15', 1, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-20 18:00:40', 0, 0, '', ''),
(509, 'C061858', 'CZ', 'Rifle', 'CZ805', '5.56x45mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-25 13:10:08', 0, 0, '', ''),
(510, 'C065683', 'CZ', 'Rifle', 'CZ805', '5.56x45mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-25 13:10:47', 0, 0, '', ''),
(511, 'C065686', 'CZ', 'Rifle', 'CZ805', '5.56x45mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-25 13:12:50', 0, 0, '', ''),
(512, 'C064616', 'CZ', 'Rifle', 'CZ805', '5.56x45mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-25 13:13:24', 0, 0, '', ''),
(513, 'C082013', 'CZ', 'Rifle', 'CZ805', '5.56x45mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-25 13:13:50', 0, 0, '', ''),
(514, 'C402150', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:15:18', 0, 0, '', ''),
(515, 'C326917', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:25:55', 0, 0, '', ''),
(516, 'F141289', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:26:36', 0, 0, '', ''),
(517, 'C306823', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:27:56', 0, 0, '', ''),
(518, 'E021859', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:28:33', 0, 0, '', ''),
(519, 'E004799', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:29:14', 0, 0, '', ''),
(520, 'E021858', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:30:29', 0, 0, '', ''),
(521, 'C367557', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:31:41', 0, 0, '', ''),
(522, 'C402201', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:32:33', 0, 0, '', ''),
(523, 'E021864', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:33:26', 0, 0, '', ''),
(524, 'E013895', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:36:44', 0, 0, '', ''),
(525, 'E021885', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:37:19', 0, 0, '', ''),
(526, 'C326989', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:38:18', 0, 0, '', ''),
(527, 'C425816', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:39:03', 0, 0, '', ''),
(528, 'C326913', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:39:45', 0, 0, '', ''),
(529, 'E013946', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:40:32', 0, 0, '', ''),
(530, 'C329819', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:41:21', 0, 0, '', ''),
(531, 'C326935', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:41:59', 0, 0, '', ''),
(532, 'D418901', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-29 07:31:58', 0, 0, '', ''),
(533, 'C402184', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:44:12', 0, 0, '', ''),
(534, 'C402202', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:44:58', 0, 0, '', ''),
(535, 'E021823', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:45:37', 0, 0, '', ''),
(536, 'C364551', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:46:17', 0, 0, '', ''),
(537, 'C326965', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-29 07:31:36', 0, 0, '', ''),
(538, 'C402183', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:47:44', 0, 0, '', ''),
(539, 'C306840', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:48:34', 0, 0, '', ''),
(540, 'E013943', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:49:39', 0, 0, '', ''),
(541, 'E013906', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:50:16', 0, 0, '', ''),
(542, 'E004836', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:54:56', 0, 0, '', ''),
(543, 'E004810', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:55:35', 0, 0, '', ''),
(544, 'C422089', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:57:14', 0, 0, '', ''),
(545, 'F102326', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:00:16', 0, 0, '', ''),
(546, 'E021888', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:00:55', 0, 0, '', ''),
(547, 'E021880', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-27 18:34:03', 0, 0, '', ''),
(548, 'F141249', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:02:05', 0, 0, '', ''),
(549, 'C402178', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-27 18:30:44', 0, 0, '', ''),
(550, 'C422042', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:03:20', 0, 0, '', ''),
(551, 'F141276', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:03:54', 0, 0, '', ''),
(552, 'C402187', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:04:40', 0, 0, '', ''),
(553, 'C326975', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:05:35', 0, 0, '', ''),
(554, 'C326973', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:06:11', 0, 0, '', ''),
(555, 'F102305', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:06:55', 0, 0, '', ''),
(556, 'C304844', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:07:26', 0, 0, '', ''),
(557, 'E021812', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:08:01', 0, 0, '', ''),
(558, 'E021806', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:08:33', 0, 0, '', ''),
(559, 'F141270', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:09:22', 0, 0, '', ''),
(560, 'C326952', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:09:54', 0, 0, '', ''),
(561, 'E021804', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:10:32', 0, 0, '', ''),
(562, 'E013932', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:11:10', 0, 0, '', ''),
(563, 'E021871', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:13:54', 0, 0, '', ''),
(564, 'E021841', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:14:32', 0, 0, '', ''),
(565, 'C306822', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:15:07', 0, 0, '', ''),
(566, 'F211131', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:16:10', 0, 0, '', ''),
(567, 'F211106', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:16:37', 0, 0, '', ''),
(568, 'F211117', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:17:33', 0, 0, '', ''),
(569, 'F211092', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:18:15', 0, 0, '', ''),
(570, 'F213060', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:18:55', 0, 0, '', ''),
(571, 'F129876', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:19:34', 0, 0, '', ''),
(572, 'E013855', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-04-14 06:53:19', 0, 0, '', ''),
(573, '123FGH', 'AK', 'PISTOL', 'AK6767', '5.56X45MM', '30', 1, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-05-12 16:58:04', 0, 5, '12345 C/INSPR William NTI', 'GOOD'),
(574, 'WEGHA', 'BERETTA', 'PISTOL', 'AK6767', '5.56X45MM', '23', 1, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-05-12 17:11:27', 0, 5, '12345 C/INSPR William NTI', 'DADSADADADA'),
(575, '4623', 'AK', 'PUMP ACTION', 'NP-22', '5.56X45MM', '30', 1, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-05-12 17:18:08', 0, 5, '12345 C/INSPR William NTI', 'adadssadad'),
(576, 'R1234', 'BERETTA', 'PUMP ACTION', 'NP-18', '5.56X45MM', '30', 1, 'Duty-Weapon', 'Not-Faulty', 'Archived', '2026-05-12 18:04:40', 1, 5, '12345 C/INSPR William NTI', 'GHANADADADAD');

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
  `booking_status` varchar(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `firearms2`
--

INSERT INTO `firearms2` (`firearmID`, `firearm_serial_no`, `manufacturer`, `firearm_type`, `firearm_name`, `firearm_caliber`, `firearm_capacity`, `quantity`, `firearm_class`, `firearm_state`, `booking_status`, `datetime`) VALUES
(7, '0011', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-28 23:39:14'),
(8, '00123', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 10, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-28 23:40:19'),
(9, 'E004836-4', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-28 23:43:56'),
(10, 'E004810-1', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-28 23:50:51'),
(11, 'c326913', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 00:25:08'),
(12, 'c326913', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 00:25:08'),
(13, 'f141289', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 00:31:06'),
(14, 'E021864', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 00:56:09'),
(15, 'E402183', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 00:59:41'),
(16, 'C326965', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:04:51'),
(17, 'D418901', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:08:06'),
(18, 'C402202', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:09:32'),
(19, 'D418901', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:15:36'),
(20, 'D402150', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:21:00'),
(21, 'C425816', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:22:30'),
(22, 'E021885', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:24:07'),
(23, 'E013906', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:25:22'),
(24, 'C402201', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:26:28'),
(25, 'F129876', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:27:49'),
(26, 'F211131', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:29:05'),
(27, 'F211106', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:30:24'),
(28, 'F213060', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:31:42'),
(29, 'F211092', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:33:25'),
(30, 'F211092', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:33:25'),
(31, 'F211117', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:34:39'),
(32, 'E013895', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:36:05'),
(33, 'E012823', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Spare-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:38:16'),
(34, 'E021858', 'CZ', 'Rifle', 'CZ807', '9x19mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:40:33'),
(35, 'E013943', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:41:48'),
(36, 'E004799', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:43:37'),
(37, 'C326917', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:44:47'),
(38, 'E021859', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:45:52'),
(39, 'E021864', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 01:47:10'),
(40, 'C069621', 'CZ', 'Rifle', '805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 17:53:50'),
(41, ' C065685', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'None', 'Available', '2024-08-29 17:59:23'),
(42, 'C056439', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:01:01'),
(43, 'C052873', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:05:00'),
(44, 'C068428', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Spare-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:06:18'),
(45, 'CC068408', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:07:59'),
(46, 'C082027', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:09:17'),
(47, 'C069641', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:11:04'),
(48, 'C081998', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:13:34'),
(49, 'C082001', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:15:04'),
(50, 'C071864', 'CZ', 'Rifle', 'CZ805', '', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:17:35'),
(51, 'C071864', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:19:01'),
(52, 'C061894', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:20:29'),
(53, 'C052885', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'None', 'Available', '2024-08-29 18:22:35'),
(54, 'C056437', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:24:00'),
(55, 'C085120', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:26:39'),
(56, 'C082009', 'CZ', 'Rifle', '805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:28:42'),
(57, 'C061893', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'None', 'Available', '2024-08-29 18:30:48'),
(58, 'C069628', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:37:29'),
(59, 'C082026', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-29 18:40:18'),
(60, 'C061901', 'CZ', 'Rifle', 'CZ805', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 14:05:19'),
(61, 'AZ -4233', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'None', 'Available', '2024-08-30 16:17:38'),
(62, 'AZ-4543', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:20:35'),
(63, 'AL-0548', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:22:11'),
(64, '0087', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:24:00'),
(65, 'NA-201147', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:26:15'),
(66, '0066', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:27:56'),
(67, '0028', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:29:23'),
(68, '1155', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:31:54'),
(69, '1155', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:35:02'),
(70, '0044', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:38:42'),
(71, '0084', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:39:55'),
(72, '0084', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:41:16'),
(73, '0024', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-30 16:43:04'),
(74, '198630-2', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-30 23:53:30'),
(75, 'HA-3907', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-30 23:57:36'),
(76, '0070', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-30 23:58:54'),
(77, '0022-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-31 00:00:34'),
(78, '0019-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-31 00:01:52'),
(79, '0011-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'None', 'Available', '2024-08-31 00:03:04'),
(80, '0005-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-31 00:04:34'),
(81, '0064-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-31 00:06:28'),
(82, '0035-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-31 00:10:20'),
(83, '0025-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-31 00:13:45'),
(84, '0027-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-31 00:15:24'),
(85, '0009-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-08-31 00:16:59'),
(86, 'M9-211881', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 22:47:11'),
(87, 'M9-215369', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 22:49:36'),
(88, 'M9-212792', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 22:57:50'),
(89, 'M9-211838', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'None', 'Available', '2024-08-31 23:01:35'),
(90, 'M9-211868', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 23:04:44'),
(91, 'M9-215339', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 23:06:54'),
(92, 'M9-211681', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 23:08:21'),
(93, 'M9-215349', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 23:09:55'),
(94, 'M9-212993', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 23:11:20'),
(95, 'M9-215368', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 23:13:07'),
(96, 'M9-211873', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 23:16:45'),
(97, 'M9-213825', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-08-31 23:18:13'),
(98, 'M9-211709', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:10:18'),
(99, 'M9-211749', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:13:58'),
(100, 'M9-211649', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:16:24'),
(101, 'M9-213818', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:18:36'),
(102, 'M9-212982', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:20:11'),
(103, 'M9-213958', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:21:38'),
(104, 'M9-213345', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:24:00'),
(105, 'M9-212759', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:25:35'),
(106, 'M9-212795', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:26:56'),
(107, 'M9-212757', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:28:37'),
(108, 'M9-213956', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:29:50'),
(109, 'M9-211865', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:31:12'),
(110, 'M9-211689', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:32:44'),
(111, 'M9-211859', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:35:56'),
(112, 'M9-211697', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:39:35'),
(113, 'M9-213961', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:40:55'),
(114, 'M9-213820', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:42:22'),
(115, 'M9-213934', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:45:55'),
(116, 'M9-212990', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:47:43'),
(117, 'M9-212789', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 01:50:07'),
(118, 'M9-211703', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 13:57:56'),
(119, 'M9-215337', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 13:59:49'),
(120, 'M9-211690', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:00:57'),
(121, 'M9-213002', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:02:49'),
(122, 'M9-215326', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:18:43'),
(123, 'M9-211854', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:20:41'),
(124, 'M9-213034', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:43:16'),
(125, 'M9-211884', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:45:02'),
(126, 'M9-211855', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:48:52'),
(127, 'M9-211672', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:50:33'),
(128, 'M9-212791', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:52:45'),
(129, 'M9-211704', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 14:55:05'),
(130, 'M9-211704', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-09-01 14:58:11'),
(131, 'M9-212740', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 15:01:17'),
(132, 'M9-211856', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Faulty', 'Available', '2024-09-01 15:04:58'),
(133, 'M9-211706', 'BERETTA', 'Side-Arm', 'BERETTA-M9', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 15:07:29'),
(134, 'H78756Z', 'BERETTA', 'Side-Arm', 'BERETTA-92', '9x19mm', '', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 16:18:50'),
(135, 'H78691Z', 'BERETTA', 'Side-Arm', 'BERETTA-92', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 16:21:53'),
(136, 'A13006529', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 16:32:46'),
(137, 'A13006661', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 16:44:50'),
(138, 'A13005682', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 16:47:02'),
(139, 'A13005725', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 16:48:32'),
(140, 'A13006212', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 16:51:02'),
(141, 'A13005759', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 16:53:07'),
(142, 'A13006646', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 16:55:06'),
(143, 'A13005667', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 16:56:45'),
(144, 'A13005672', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 16:58:10'),
(145, '11501846', 'NORINCO PISTOL', 'Side-Arm', 'NP22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 17:00:47'),
(146, '11501846-6', 'NORINCO PISTOL', 'Side-Arm', '18', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 17:05:35'),
(147, '115012-7', 'NORINCO PISTOL', 'Side-Arm', 'NP-18', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 17:09:37'),
(148, '11501827', 'NORINCO PISTOL', 'Side-Arm', 'NP-18', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 17:13:11'),
(149, '11501276-7', 'NORINCO PISTOL', 'Side-Arm', 'NP-18', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 17:17:13'),
(150, '11501616-5', 'NORINCO PISTOL', 'Side-Arm', 'NP-18', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 17:19:18'),
(151, 'SP-1036911', 'SIGPRO', 'Side-Arm', 'SP', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 17:23:10'),
(152, 'SP-0136960', 'SIGPRO', 'Side-Arm', 'SP', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 17:26:29'),
(153, 'SP-0137312', 'SIGPRO', 'Side-Arm', 'SP', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 17:30:04'),
(154, 'SP-0137157', 'SIGPRO', 'Side-Arm', 'SP', '9x19mm', '15', 1, 'Duty-Weapon', 'Not Faulty', 'Available', '2024-09-01 17:32:34'),
(155, 'C306823', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 14:39:16'),
(156, 'C3657557', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 14:41:55'),
(157, 'C326989', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 14:43:12'),
(158, 'E013946', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 14:44:11'),
(159, 'C329819', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 14:45:06'),
(160, 'C326935', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 14:46:00'),
(161, 'C402184', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 14:50:23'),
(162, 'C364551', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 14:51:27'),
(163, 'C306840', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 14:54:11'),
(164, 'E4004836', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 14:55:03'),
(165, 'E4004810', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'None', 'Available', '2026-03-11 14:55:55'),
(166, 'C422089', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 14:56:44'),
(167, 'F102326', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 14:57:32'),
(168, 'E021888', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 14:58:14'),
(169, 'F141249', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 14:59:03'),
(170, 'E021880', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 14:59:52'),
(171, 'C4023178', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 15:00:33'),
(172, 'C422042', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 15:01:40'),
(173, 'F141276', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 15:03:25'),
(174, 'C402187', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 15:04:35'),
(175, 'C3269783', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 15:05:31'),
(176, 'C326973', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 15:06:30'),
(177, 'F102305', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 15:09:59'),
(178, 'C304844', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 15:31:48'),
(179, 'E021812', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 15:32:41'),
(180, 'E021806', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 15:34:03'),
(181, 'F141270', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 15:35:04'),
(182, 'C326952', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 15:36:34'),
(183, 'E021804', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 15:37:39'),
(184, 'E013932', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 15:38:44'),
(185, 'E021871', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 15:39:33'),
(186, 'E021841', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-11 15:40:50'),
(187, 'C306822', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'None', 'Available', '2026-03-11 15:42:33'),
(188, 'F129898', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Spare-Weapon', 'Not Faulty', 'Available', '2026-03-11 15:43:57'),
(189, 'AZ-4233', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 16:56:13'),
(190, '        8378', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:01:41'),
(191, ' 371903', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:03:11'),
(192, '117545', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:04:06'),
(193, '154368', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:04:43'),
(194, '207176', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:05:27'),
(195, 'A-15747', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:06:29'),
(196, '153872', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:07:56'),
(197, '153829', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:09:59'),
(198, '330102', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:12:37'),
(199, '639544', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:17:53'),
(200, '639542', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:20:08'),
(201, '117541', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:21:45'),
(202, '639549', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:22:56'),
(203, '639547', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:23:53'),
(204, '244055', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:25:08'),
(205, '639964', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:26:00'),
(206, '639978', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:26:47'),
(207, '335643', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:27:45'),
(208, '335644', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:28:38'),
(209, '335649', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:29:36'),
(210, '335645', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:30:24'),
(211, '335641', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:31:08'),
(212, '574444', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:32:05'),
(213, '385944', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:33:02'),
(214, '152290', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:33:55'),
(215, '639170', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:34:43'),
(216, '153420', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:35:31'),
(217, '153685', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:36:23'),
(218, '574804', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:37:17'),
(219, '401153', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:39:50'),
(220, '154233', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:40:49'),
(221, '574812', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:41:36'),
(222, '574802', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:42:27'),
(223, '574808', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:43:38'),
(224, '403976', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:44:31'),
(225, '519242', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:45:24'),
(226, '403782', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:46:13'),
(227, '90498', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:47:03'),
(228, '576667', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:48:14'),
(229, '282982', 'CZ', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:49:11'),
(230, '571137', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:51:57'),
(231, '335650', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-16 17:52:57'),
(232, '640563', 'AK', '', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 05:50:58'),
(233, '564353', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 05:58:03'),
(234, '578972', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 05:59:07'),
(235, '578978', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:00:13'),
(236, '578975', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:01:03'),
(237, '438631', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:04:48'),
(238, '621645', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:07:37'),
(239, '602581', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:08:46'),
(240, '574367', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:09:58'),
(241, '573550', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:10:49'),
(242, '64359', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:12:33'),
(243, '175643', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:13:57'),
(244, '330277', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:14:47'),
(245, '417630', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:15:35'),
(246, '330682', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:16:40'),
(247, '330274', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:17:29'),
(248, '303849', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:18:41'),
(249, '210306', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:19:34'),
(250, '213452', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:20:50'),
(251, '269721', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:23:19'),
(252, 'B-95960', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:24:16'),
(253, '209423', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:25:14'),
(254, '283092', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:26:13'),
(255, '213645', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:27:24'),
(256, '338059', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:28:17'),
(257, 'B-96793', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:29:42'),
(258, '283054', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:31:47'),
(259, '215972', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:32:45'),
(260, 'AE-405929', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:33:51'),
(261, 'AL-2577', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:35:04'),
(262, 'AE-405827', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:36:51'),
(263, 'NK-405037', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:38:47'),
(264, '191496', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:40:31'),
(265, '60199', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:42:42'),
(266, '146979', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:43:54'),
(267, '229281', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:44:58'),
(268, '190440', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:45:55'),
(269, 'KP-236696', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:47:16'),
(270, '190337', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:51:52'),
(271, 'BA-405468', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:53:07'),
(272, '0058', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:55:22'),
(273, '0071-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:56:38'),
(274, '0073-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:58:30'),
(275, '0047', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 06:59:42'),
(276, 'AK-371903', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:28:47'),
(277, '8378', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:35:02'),
(278, '434339-4', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:38:30'),
(279, 'AE-406219', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:40:16'),
(280, 'NK-6114', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:41:51'),
(281, 'AE-405403', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:43:08'),
(282, 'KP-231772', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:44:43'),
(283, '190339', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:46:38'),
(284, '0104-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:47:48'),
(285, '0072-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:49:28'),
(286, '0080-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:50:48'),
(287, '0103-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:52:18'),
(288, '0026-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:53:40'),
(289, '0089-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:54:51'),
(290, '0076-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:56:07'),
(291, '0063-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:58:10'),
(292, '578971', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 08:59:56'),
(293, '117602', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:01:11'),
(294, '564358', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:04:54'),
(295, '571283', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:06:06'),
(296, '524354', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:11:54'),
(297, 'B-96411', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:14:52'),
(298, '445411', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:16:49'),
(299, '302614', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:18:13'),
(300, '576669', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:19:30'),
(301, '146142', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:20:51'),
(302, '232650', 'AK', 'Rifle', 'AK47', '', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:30:23'),
(303, 'B-104299', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:32:29'),
(304, '328640', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:35:36'),
(305, '328070', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:36:44'),
(306, '236033', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:37:54'),
(307, '269746', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:39:26'),
(308, '288684', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:40:33'),
(309, '479374', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:42:40'),
(310, '335642', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:43:52'),
(311, '335648', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:45:19'),
(312, '90825', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:47:28'),
(313, 'B-96419', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:48:50'),
(314, '90561', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:50:00'),
(315, '492035', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:52:43'),
(316, '0106', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:53:56'),
(317, 'AE-406184', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:55:09'),
(318, 'AL-2555', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 09:56:23'),
(319, 'AE-405367', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:00:12'),
(320, '283091', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:01:17'),
(321, '563290', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:02:29'),
(322, '0059-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:03:47'),
(323, 'A-31251', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:05:28'),
(324, 'BA-405540', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:06:41'),
(325, '0029-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:07:56'),
(326, 'KG-232084', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:10:01'),
(327, '0088-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:11:14'),
(328, '0044-19', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:12:25'),
(329, 'AZ-5201', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:16:29'),
(330, 'B-96415', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:19:35'),
(331, 'AL-1956', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:20:53'),
(332, 'AZ-2600', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:29:18'),
(333, 'HT-5493', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:30:30'),
(334, '90446', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:31:57'),
(335, 'KP-236862', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:35:37'),
(336, 'AE-405421', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:36:55'),
(337, '551894', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:38:52'),
(338, '335647', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:40:07'),
(339, 'AZ-4315', 'AK', 'Rifle', 'AK47', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:41:37'),
(340, '229284', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Spare-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:49:00'),
(341, 'KP-231869', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Spare-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:51:15'),
(342, 'KP-230476', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Spare-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:52:37'),
(343, '190854', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:54:09'),
(344, '38957', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Spare-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:57:43'),
(345, '189864', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Spare-Weapon', 'Not Faulty', 'Available', '2026-03-17 10:59:08'),
(346, 'NF-9973-57', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Spare-Weapon', 'Not Faulty', 'Available', '2026-03-17 11:00:41'),
(347, '191282', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Spare-Weapon', 'Not Faulty', 'Available', '2026-03-17 11:02:05'),
(348, '0558', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Spare-Weapon', 'Not Faulty', 'Available', '2026-03-17 11:03:39'),
(349, '0102', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:05:04'),
(350, '0033', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:06:24'),
(351, '0025', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:08:52'),
(352, '0101', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:10:25'),
(353, '0027', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:11:37'),
(354, '0070', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:15:12'),
(355, '0019', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:17:39'),
(356, '0055', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:19:04'),
(357, '0035', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:20:24'),
(358, '0065', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:24:49'),
(359, '0022', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:26:08'),
(360, '0011', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:27:29'),
(361, '0005', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:28:55'),
(362, '0064', 'AK', 'Rifle', 'AK47', '7.62x39mm', '0', 0, 'Duty-Weapon', 'Faulty', 'Available', '2026-03-17 11:30:41'),
(363, ' D-135518', 'Sellier & Bellot', 'Rifle', 'SCORPION EVO 3', '', '', 0, 'Duty-Weapon', 'None', 'Available', '2026-03-17 11:43:02'),
(364, 'D-146198', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 11:46:25'),
(365, 'D-138536', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 11:47:40'),
(366, 'D-146193', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 11:49:01'),
(367, ' D-147201', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 11:50:17'),
(368, 'D-146208', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 11:51:38'),
(369, ' D-147243', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 11:53:16'),
(370, 'D-176116', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 11:54:39'),
(371, 'D-174853', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 11:56:17'),
(372, 'D-135518', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 12:04:06'),
(373, 'D-147201', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 12:07:16'),
(374, 'D-147243', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 12:09:09'),
(375, 'D-176064', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 12:11:02'),
(376, 'D-176088', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 12:12:28'),
(377, 'D-147196', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 12:14:23'),
(378, 'D-145322', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 12:16:11'),
(379, 'D-145304', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 12:17:46'),
(380, 'D-135522', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 12:19:37'),
(381, 'D-138488', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 12:21:20'),
(382, 'D-174880', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 12:26:07'),
(383, 'D-174879', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 12:38:40'),
(384, 'D-174832', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 12:40:25'),
(385, 'D-174878', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 12:42:31'),
(386, 'D-174811', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 12:44:26'),
(387, 'D-174828', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 12:47:19'),
(388, 'D-174820', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 12:49:14'),
(389, 'D-174871', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 12:52:10'),
(390, 'D-174874', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 13:00:18'),
(391, 'D-174835', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 13:02:36'),
(392, 'D-174867', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 13:04:48'),
(393, 'D-174816', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 13:07:43'),
(394, 'D-406050', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 13:09:39');
INSERT INTO `firearms2` (`firearmID`, `firearm_serial_no`, `manufacturer`, `firearm_type`, `firearm_name`, `firearm_caliber`, `firearm_capacity`, `quantity`, `firearm_class`, `firearm_state`, `booking_status`, `datetime`) VALUES
(395, 'D-147264', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 13:17:06'),
(396, 'D-151830', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 13:19:36'),
(397, 'D-145292', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 13:21:28'),
(398, 'D-147275', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 13:24:39'),
(399, 'D-145310', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 13:26:32'),
(400, 'D-145283', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 13:28:30'),
(401, 'D-147217', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 13:30:35'),
(402, 'D-406044', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 13:32:52'),
(403, 'D-147223', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 13:34:40'),
(404, 'D-146181', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 13:36:30'),
(405, 'D-406046', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-17 13:38:18'),
(406, 'D-281590', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 05:51:29'),
(407, 'D-280002', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 05:53:04'),
(408, 'D-279984', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 05:55:06'),
(409, 'D-279985', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 05:57:44'),
(410, 'D-280006', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 05:59:30'),
(411, 'D-279982', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 06:01:28'),
(412, 'D-279990', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 06:04:46'),
(413, 'D-281579', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 06:09:45'),
(414, 'D-281529', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 06:13:00'),
(415, 'D-281528', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 06:14:48'),
(416, 'D-281584', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 06:16:47'),
(417, 'D-281527', 'CZ', 'Rifle', 'SCORPION EVO 3', '9x19mm', '30', 0, 'Duty-Weapon', 'Not Faulty', 'Available', '2026-03-18 06:18:51'),
(418, 'D-153753', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 11:52:54'),
(419, 'D-138577', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 11:53:53'),
(420, 'D-138569', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 11:54:53'),
(421, 'D-132848', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 11:56:06'),
(422, 'D-132859', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 11:57:05'),
(423, 'D-135537', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 11:57:51'),
(424, 'D-135541', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 11:58:49'),
(425, 'D-135530', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 11:59:32'),
(426, 'D-138572', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:00:30'),
(427, 'D-135536', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:02:15'),
(428, 'D-135513', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:03:12'),
(429, 'D-135548', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:04:00'),
(430, 'D-145305', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:04:50'),
(431, 'D-406070', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:05:33'),
(432, 'D-146178', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:06:30'),
(433, 'D-406085', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:11:21'),
(434, 'D-147230', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:12:25'),
(435, 'D-406084', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:13:07'),
(436, 'D-406100', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:13:56'),
(437, 'D-406014', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:17:11'),
(438, 'D-406066', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:17:58'),
(439, 'D-406078', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:18:52'),
(440, 'D-406064', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:19:37'),
(441, 'D-406083', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:20:17'),
(442, 'D-280017', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:21:03'),
(443, 'D-280035', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:21:46'),
(444, 'D-280024', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:22:30'),
(445, 'D-280013', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:23:17'),
(446, 'D-280010', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:23:58'),
(447, 'D-280018', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:26:18'),
(448, 'D-280019', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:27:09'),
(449, 'D-279994', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:27:55'),
(450, 'D-280014', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:28:59'),
(451, 'D-280023', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:29:40'),
(452, 'D-280036', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:30:27'),
(453, 'D-280021', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:31:10'),
(454, 'D-281567', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:32:09'),
(455, 'D-281500', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:32:59'),
(456, 'D-281556', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:33:53'),
(457, 'D-281588', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:36:54'),
(458, 'D-281592', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:37:49'),
(459, 'D-315838', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:39:01'),
(460, 'D-281536', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:39:49'),
(461, 'D-281506', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:40:57'),
(462, 'D-315760', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:41:58'),
(463, 'D-281573', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:43:33'),
(464, 'D-281569', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:44:20'),
(465, 'D-281497', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:45:08'),
(466, 'M9-211694', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:53:40'),
(467, 'M9-211713', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:57:10'),
(468, 'M9-215316', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:58:06'),
(469, 'M9-212154', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 12:59:14'),
(470, 'M9-215359', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:02:08'),
(471, 'M9-211716', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:03:30'),
(472, 'M9-211864', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:04:46'),
(473, 'M9-212766', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:06:30'),
(474, 'M9-213927', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:07:39'),
(475, 'M9-211892', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:08:54'),
(476, 'M9-212749', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:09:40'),
(477, 'M9-212910', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:10:36'),
(478, 'M9-211693', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:11:56'),
(479, 'M9-215353', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:13:10'),
(480, 'M9-212183', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:14:01'),
(481, 'M9-213012', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:14:53'),
(482, 'M9-211682', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:16:10'),
(483, 'M9-213995', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:17:14'),
(484, 'M9-212977', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:18:48'),
(485, 'M9-212991', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:19:37'),
(486, 'M9-215367', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:20:36'),
(487, 'M9-212989', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:21:48'),
(488, 'H78755Z', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:24:30'),
(489, 'H78690Z', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:25:26'),
(490, '11501827', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:27:40'),
(491, '11501846', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:28:35'),
(492, '11501276', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:31:34'),
(493, 'A13005780', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:32:42'),
(494, 'A13006651', 'Sellier & Bellot', 'Side-Arm', '', '9x19mm', '15', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:33:44'),
(495, 'AZ-3054', 'AK', 'Rifle', '', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 13:52:58'),
(496, '3054', 'CZ', 'Rifle', '', '9x19mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:01:15'),
(497, 'CZ1234', 'CZ', 'Rifle', 'CZ-SCORPION', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:35:10'),
(498, 'CZ2222', 'CZ', 'Rifle', 'CZ-SCORPION', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:36:18'),
(499, 'CZX1234', 'CZ', 'Rifle', 'CZ-SCORPION', '7.62x39mm', '30', 1, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 14:58:52'),
(500, 'SP-0136866', 'Sellier & Bellot', 'Side-Arm', 'SIGPRO', '9x19mm', '15', 1, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 15:05:07'),
(501, 'SP-0137277', 'Sellier & Bellot', 'Side-Arm', 'SIGPRO', '9x19mm', '15', 1, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 15:05:59'),
(502, 'SP-0136845', 'Sellier & Bellot', 'Side-Arm', 'SIGPRO', '9x19mm', '15', 1, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 15:07:07'),
(503, 'A13005679', 'Sellier & Bellot', 'Side-Arm', 'NP-22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 15:08:06'),
(504, 'A13006542', 'Sellier & Bellot', 'Side-Arm', 'NP-22', '9x19mm', '15', 1, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-18 15:08:54'),
(505, 'H78688Z', 'BERETTA', 'Side-Arm', 'BERETTA-92', '9x19mm', '15', 1, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-20 18:00:40'),
(506, 'C402178', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-25 11:40:44'),
(507, 'C061858', 'CZ', 'Rifle', 'CZ805', '5.56x45mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-25 13:10:08'),
(508, 'C065683', 'CZ', 'Rifle', 'CZ805', '5.56x45mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-25 13:10:47'),
(509, 'C065686', 'CZ', 'Rifle', 'CZ805', '5.56x45mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-25 13:12:50'),
(510, 'C064616', 'CZ', 'Rifle', 'CZ805', '5.56x45mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-25 13:13:24'),
(511, 'C082013', 'CZ', 'Rifle', 'CZ805', '5.56x45mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-25 13:13:50'),
(512, 'C402150', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:15:18'),
(513, 'C326917', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:25:55'),
(514, 'F141289', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:26:36'),
(515, 'C306823', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:27:56'),
(516, 'E021859', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:28:33'),
(517, 'E004799', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:29:14'),
(518, 'E021858', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:30:29'),
(519, 'C367557', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:31:41'),
(520, 'C402201', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:32:33'),
(521, 'E021864', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:33:26'),
(522, 'E013895', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:36:44'),
(523, 'E021885', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:37:19'),
(524, 'C326989', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:38:18'),
(525, 'C425816', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:39:03'),
(526, 'C326913', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:39:45'),
(527, 'E013946', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:40:32'),
(528, 'C329819', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:41:21'),
(529, 'C326935', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:41:59'),
(530, 'D418901', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:42:30'),
(531, 'C402184', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:44:12'),
(532, 'C402202', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:44:58'),
(533, 'E021823', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:45:37'),
(534, 'C364551', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:46:17'),
(535, 'C326965', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:47:01'),
(536, 'C402183', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:47:44'),
(537, 'C306840', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:48:34'),
(538, 'E013943', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:49:39'),
(539, 'E013906', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:50:16'),
(540, 'E004836', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:54:56'),
(541, 'E004810', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:55:35'),
(542, 'C422089', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 07:57:14'),
(543, 'F102326', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:00:16'),
(544, 'E021888', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:00:55'),
(545, 'E021880', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:01:30'),
(546, 'F141249', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:02:05'),
(547, 'C402178', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:02:38'),
(548, 'C422042', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:03:20'),
(549, 'F141276', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:03:54'),
(550, 'C402187', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:04:40'),
(551, 'C326975', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:05:35'),
(552, 'C326973', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:06:11'),
(553, 'F102305', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:06:55'),
(554, 'C304844', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:07:26'),
(555, 'E021812', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:08:01'),
(556, 'E021806', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:08:33'),
(557, 'F141270', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:09:22'),
(558, 'C326952', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:09:54'),
(559, 'E021804', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:10:32'),
(560, 'E013932', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:11:10'),
(561, 'E021871', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:13:54'),
(562, 'E021841', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:14:32'),
(563, 'C306822', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:15:07'),
(564, 'F211131', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:16:10'),
(565, 'F211106', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:16:37'),
(566, 'F211117', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:17:33'),
(567, 'F211092', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:18:15'),
(568, 'F213060', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:18:55'),
(569, 'F129876', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-03-26 08:19:34'),
(570, 'E013855', 'CZ', 'Rifle', 'CZ807', '7.62x39mm', '30', 0, 'Duty-Weapon', 'Not-Faulty', 'Available', '2026-04-14 06:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `firearm_calibers`
--

CREATE TABLE `firearm_calibers` (
  `firearm_caliberID` int(100) NOT NULL,
  `firearm_caliber` varchar(200) NOT NULL,
  `adminID` int(100) NOT NULL,
  `armourer_admin_name` varchar(200) NOT NULL,
  `datetime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `firearm_calibers`
--

INSERT INTO `firearm_calibers` (`firearm_caliberID`, `firearm_caliber`, `adminID`, `armourer_admin_name`, `datetime`) VALUES
(25, '9MM', 5, '12345 C/INSPR William NTI', '2026-05-12 13:54:26'),
(26, '7.62X39MM', 5, '12345 C/INSPR William NTI', '2026-05-12 13:55:30'),
(27, '5.56X45MM', 5, '12345 C/INSPR William NTI', '2026-05-12 13:56:10');

-- --------------------------------------------------------

--
-- Table structure for table `firearm_categories`
--

CREATE TABLE `firearm_categories` (
  `firearm_categoryID` int(100) NOT NULL,
  `firearm_category` varchar(200) NOT NULL,
  `adminID` int(100) NOT NULL,
  `armourer_admin_name` varchar(200) NOT NULL,
  `datetime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `firearm_categories`
--

INSERT INTO `firearm_categories` (`firearm_categoryID`, `firearm_category`, `adminID`, `armourer_admin_name`, `datetime`) VALUES
(24, 'PISTOL', 5, '12345 C/INSPR William NTI', '2026-05-12 13:56:22'),
(25, 'RIFLE', 5, '12345 C/INSPR William NTI', '2026-05-12 13:56:32'),
(26, 'PUMP ACTION', 5, '12345 C/INSPR William NTI', '2026-05-12 13:56:40'),
(27, 'SIDEARM', 5, '12345 C/INSPR William NTI', '2026-05-12 13:56:58');

-- --------------------------------------------------------

--
-- Table structure for table `firearm_manufacturers`
--

CREATE TABLE `firearm_manufacturers` (
  `firearm_manufacturerID` int(100) NOT NULL,
  `firearm_manufacturer` varchar(200) NOT NULL,
  `adminID` int(100) NOT NULL,
  `armourer_admin_name` varchar(200) NOT NULL,
  `datetime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `firearm_manufacturers`
--

INSERT INTO `firearm_manufacturers` (`firearm_manufacturerID`, `firearm_manufacturer`, `adminID`, `armourer_admin_name`, `datetime`) VALUES
(25, 'AK', 5, '12345 C/INSPR William NTI', '2026-05-12 13:53:26'),
(26, 'CZ', 5, '12345 C/INSPR William NTI', '2026-05-12 13:53:34'),
(27, 'BERETTA', 5, '12345 C/INSPR William NTI', '2026-05-12 13:53:45'),
(28, 'NP', 5, '12345 C/INSPR William NTI', '2026-05-12 13:53:51'),
(29, 'SIGPRO', 5, '12345 C/INSPR William NTI', '2026-05-12 13:54:14');

-- --------------------------------------------------------

--
-- Table structure for table `firearm_name`
--

CREATE TABLE `firearm_name` (
  `firearm_nameID` int(100) NOT NULL,
  `firearm_name` varchar(100) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `firearm_name`
--

INSERT INTO `firearm_name` (`firearm_nameID`, `firearm_name`, `datetime`, `is_deleted`) VALUES
(1, 'AK47', '2026-05-12 10:43:01', 0),
(2, 'BERETTA-M9', '2026-03-17 17:46:22', 0),
(3, 'CZ-SCORPION', '2026-03-17 21:39:07', 0),
(4, 'BERETTA-92', '2026-03-17 17:47:21', 0),
(5, 'NP-18', '2026-03-17 17:47:42', 0),
(6, 'NP-22', '2026-03-17 17:47:53', 0),
(7, 'SIGPRO', '2026-03-17 17:48:17', 0),
(8, 'CZ807', '2026-03-17 17:48:40', 0),
(9, 'CZ805', '2026-05-11 12:25:44', 0);

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
(184, 'boampong', 'Armourer', 'Thursday 24th of October 2024 10:14:54 PM', '2024-10-24 22:14:54'),
(185, 'boampong', 'Armourer', 'Monday 9th of March 2026 01:24:44 PM', '2026-03-09 13:24:44'),
(186, 'boampong', 'Armourer', 'Monday 9th of March 2026 02:00:30 PM', '2026-03-09 14:00:30'),
(187, 'boampong', 'Armourer', 'Monday 9th of March 2026 02:01:04 PM', '2026-03-09 14:01:04'),
(188, 'boampong', 'Armourer', 'Monday 9th of March 2026 04:18:07 PM', '2026-03-09 16:18:07'),
(189, 'boampong', 'Armourer', 'Monday 9th of March 2026 05:28:58 PM', '2026-03-09 17:28:58'),
(190, 'boampong', 'Armourer', 'Monday 9th of March 2026 05:29:11 PM', '2026-03-09 17:29:11'),
(191, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 09:32:31 AM', '2026-03-11 09:32:31'),
(192, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 09:37:54 AM', '2026-03-11 09:37:54'),
(193, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 09:46:19 AM', '2026-03-11 09:46:19'),
(194, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 09:48:06 AM', '2026-03-11 09:48:06'),
(195, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 10:07:00 AM', '2026-03-11 10:07:00'),
(196, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 11:26:40 AM', '2026-03-11 11:26:40'),
(197, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 11:58:41 AM', '2026-03-11 11:58:41'),
(198, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 12:02:17 PM', '2026-03-11 12:02:17'),
(199, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 01:05:36 PM', '2026-03-11 13:05:36'),
(200, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 01:50:19 PM', '2026-03-11 13:50:19'),
(201, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 02:18:52 PM', '2026-03-11 14:18:52'),
(202, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 02:30:15 PM', '2026-03-11 14:30:15'),
(203, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 03:30:39 PM', '2026-03-11 15:30:39'),
(204, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 05:37:51 PM', '2026-03-11 17:37:51'),
(205, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 07:33:49 PM', '2026-03-11 19:33:49'),
(206, 'boampong', 'Armourer', 'Thursday 12th of March 2026 05:13:00 AM', '2026-03-12 05:13:00'),
(207, 'boampong', 'Armourer', 'Thursday 12th of March 2026 06:09:38 AM', '2026-03-12 06:09:38'),
(208, 'boampong', 'Armourer', 'Thursday 12th of March 2026 07:37:11 AM', '2026-03-12 07:37:11'),
(209, 'boampong', 'Armourer', 'Thursday 12th of March 2026 08:41:23 AM', '2026-03-12 08:41:23'),
(210, 'boampong', 'Armourer', 'Thursday 12th of March 2026 09:02:23 AM', '2026-03-12 09:02:23'),
(211, 'boampong', 'Armourer', 'Thursday 12th of March 2026 10:50:01 AM', '2026-03-12 10:50:01'),
(212, 'boampong', 'Armourer', 'Thursday 12th of March 2026 11:47:32 AM', '2026-03-12 11:47:32'),
(213, 'boampong', 'Armourer', 'Thursday 12th of March 2026 12:02:05 PM', '2026-03-12 12:02:05'),
(214, 'boampong', 'Armourer', 'Thursday 12th of March 2026 12:10:49 PM', '2026-03-12 12:10:49'),
(215, 'boampong', 'Armourer', 'Thursday 12th of March 2026 02:09:52 PM', '2026-03-12 14:09:52'),
(216, 'boampong', 'Armourer', 'Thursday 12th of March 2026 02:10:13 PM', '2026-03-12 14:10:13'),
(217, 'boampong', 'Armourer', 'Thursday 12th of March 2026 05:18:17 PM', '2026-03-12 17:18:17'),
(218, 'boampong', 'Armourer', 'Thursday 12th of March 2026 05:49:21 PM', '2026-03-12 17:49:21'),
(219, 'boampong', 'Armourer', 'Friday 13th of March 2026 07:18:19 AM', '2026-03-13 07:18:19'),
(220, 'boampong', 'Armourer', 'Friday 13th of March 2026 07:51:02 AM', '2026-03-13 07:51:02'),
(221, 'boampong', 'Armourer', 'Friday 13th of March 2026 08:19:19 AM', '2026-03-13 08:19:19'),
(222, 'boampong', 'Armourer', 'Friday 13th of March 2026 08:51:14 AM', '2026-03-13 08:51:14'),
(223, 'boampong', 'Armourer', 'Friday 13th of March 2026 12:54:49 PM', '2026-03-13 12:54:49'),
(224, 'boampong', 'Armourer', 'Friday 13th of March 2026 12:55:08 PM', '2026-03-13 12:55:08'),
(225, 'boampong', 'Armourer', 'Friday 13th of March 2026 01:12:26 PM', '2026-03-13 13:12:26'),
(226, 'boampong', 'Armourer', 'Friday 13th of March 2026 02:59:21 PM', '2026-03-13 14:59:21'),
(227, 'boampong', 'Armourer', 'Friday 13th of March 2026 04:08:45 PM', '2026-03-13 16:08:45'),
(228, 'boampong', 'Armourer', 'Friday 13th of March 2026 04:52:12 PM', '2026-03-13 16:52:12'),
(229, 'boampong', 'Armourer', 'Friday 13th of March 2026 04:59:06 PM', '2026-03-13 16:59:06'),
(230, 'boampong', 'Armourer', 'Saturday 14th of March 2026 12:05:53 PM', '2026-03-14 12:05:53'),
(231, 'boampong', 'Armourer', 'Saturday 14th of March 2026 12:44:48 PM', '2026-03-14 12:44:48'),
(232, 'boampong', 'Armourer', 'Sunday 15th of March 2026 06:06:29 AM', '2026-03-15 06:06:29'),
(233, 'boampong', 'Armourer', 'Sunday 15th of March 2026 06:49:22 AM', '2026-03-15 06:49:22'),
(234, 'boampong', 'Armourer', 'Sunday 15th of March 2026 06:42:46 PM', '2026-03-15 18:42:46'),
(235, 'boampong', 'Armourer', 'Monday 16th of March 2026 04:25:54 PM', '2026-03-16 16:25:54'),
(236, 'boampong', 'Armourer', 'Monday 16th of March 2026 04:53:49 PM', '2026-03-16 16:53:49'),
(237, 'boampong', 'Armourer', 'Tuesday 17th of March 2026 05:51:22 AM', '2026-03-17 05:51:22'),
(238, 'boampong', 'Armourer', 'Tuesday 17th of March 2026 05:51:56 AM', '2026-03-17 05:51:56'),
(239, 'boampong', 'Armourer', 'Tuesday 17th of March 2026 08:25:24 AM', '2026-03-17 08:25:24'),
(240, 'boampong', 'Armourer', 'Tuesday 17th of March 2026 02:19:50 PM', '2026-03-17 14:19:50'),
(241, 'boampong', 'Armourer', 'Tuesday 17th of March 2026 02:44:38 PM', '2026-03-17 14:44:38'),
(242, 'boampong', 'Armourer', 'Wednesday 18th of March 2026 05:49:16 AM', '2026-03-18 05:49:16'),
(243, 'boampong', 'Armourer', 'Wednesday 18th of March 2026 11:08:19 AM', '2026-03-18 11:08:19'),
(244, 'boampong', 'Armourer', 'Friday 20th of March 2026 05:32:40 AM', '2026-03-20 05:32:40'),
(245, 'boampong', 'Armourer', 'Friday 20th of March 2026 05:56:21 AM', '2026-03-20 05:56:21'),
(246, 'boampong', 'Armourer', 'Friday 20th of March 2026 06:47:19 AM', '2026-03-20 06:47:19'),
(247, 'boampong', 'Armourer', 'Friday 20th of March 2026 05:10:51 PM', '2026-03-20 17:10:51'),
(248, 'boampong', 'Armourer', 'Friday 20th of March 2026 05:22:23 PM', '2026-03-20 17:22:23'),
(249, 'boampong', 'Armourer', 'Friday 20th of March 2026 05:29:42 PM', '2026-03-20 17:29:42'),
(250, 'boampong', 'Armourer', 'Saturday 21st of March 2026 05:26:43 AM', '2026-03-21 05:26:43'),
(251, 'boampong', 'Armourer', 'Sunday 22nd of March 2026 05:54:42 AM', '2026-03-22 05:54:42'),
(252, 'boampong', 'Armourer', 'Sunday 22nd of March 2026 07:02:42 AM', '2026-03-22 07:02:42'),
(253, 'boampong', 'Armourer', 'Tuesday 24th of March 2026 06:10:31 AM', '2026-03-24 06:10:31'),
(254, 'boampong', 'Armourer', 'Tuesday 24th of March 2026 11:21:34 AM', '2026-03-24 11:21:34'),
(255, 'boampong', 'Armourer', 'Tuesday 24th of March 2026 03:40:01 PM', '2026-03-24 15:40:01'),
(256, 'owoahene@22', 'Armourer', 'Tuesday 24th of March 2026 06:42:29 PM', '2026-03-24 18:42:29'),
(257, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 06:00:52 AM', '2026-03-25 06:00:52'),
(258, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 06:25:29 AM', '2026-03-25 06:25:29'),
(259, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 06:47:42 AM', '2026-03-25 06:47:42'),
(260, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 06:50:53 AM', '2026-03-25 06:50:53'),
(261, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 07:23:27 AM', '2026-03-25 07:23:27'),
(262, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 07:25:55 AM', '2026-03-25 07:25:55'),
(263, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 08:24:08 AM', '2026-03-25 08:24:08'),
(264, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 08:26:28 AM', '2026-03-25 08:26:28'),
(265, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 08:55:43 AM', '2026-03-25 08:55:43'),
(266, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 08:59:28 AM', '2026-03-25 08:59:28'),
(267, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 10:37:53 AM', '2026-03-25 10:37:53'),
(268, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 11:16:53 AM', '2026-03-25 11:16:53'),
(269, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 11:46:31 AM', '2026-03-25 11:46:31'),
(270, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 11:48:26 AM', '2026-03-25 11:48:26'),
(271, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 12:36:06 PM', '2026-03-25 12:36:06'),
(272, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 01:01:05 PM', '2026-03-25 13:01:05'),
(273, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 02:33:17 PM', '2026-03-25 14:33:17'),
(274, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 03:18:45 PM', '2026-03-25 15:18:45'),
(275, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 03:37:37 PM', '2026-03-25 15:37:37'),
(276, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 03:44:05 PM', '2026-03-25 15:44:05'),
(277, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 03:48:21 PM', '2026-03-25 15:48:21'),
(278, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 05:02:04 PM', '2026-03-25 17:02:04'),
(279, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 05:09:27 PM', '2026-03-25 17:09:27'),
(280, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 06:31:23 PM', '2026-03-25 18:31:23'),
(281, 'boampong', 'Armourer', 'Thursday 26th of March 2026 05:49:53 AM', '2026-03-26 05:49:53'),
(282, 'owoahene@22', 'Armourer', 'Thursday 26th of March 2026 05:50:29 AM', '2026-03-26 05:50:29'),
(283, 'owoahene@22', 'Armourer', 'Thursday 26th of March 2026 06:57:16 AM', '2026-03-26 06:57:16'),
(284, 'owoahene@22', 'Armourer', 'Thursday 26th of March 2026 10:55:05 AM', '2026-03-26 10:55:05'),
(285, 'owoahene@22', 'Armourer', 'Thursday 26th of March 2026 06:55:00 PM', '2026-03-26 18:55:00'),
(286, 'boampong', 'Armourer', 'Friday 27th of March 2026 05:44:23 AM', '2026-03-27 05:44:23'),
(287, 'boampong', 'Armourer', 'Friday 27th of March 2026 11:38:42 AM', '2026-03-27 11:38:42'),
(288, 'boampong', 'Armourer', 'Friday 27th of March 2026 12:15:12 PM', '2026-03-27 12:15:12'),
(289, 'boampong', 'Armourer', 'Friday 27th of March 2026 02:02:43 PM', '2026-03-27 14:02:43'),
(290, 'boampong', 'Armourer', 'Friday 27th of March 2026 06:31:13 PM', '2026-03-27 18:31:13'),
(291, 'boampong', 'Armourer', 'Friday 27th of March 2026 06:32:40 PM', '2026-03-27 18:32:40'),
(292, 'boampong', 'Armourer', 'Saturday 28th of March 2026 02:04:43 PM', '2026-03-28 14:04:43'),
(293, 'owoahene@22', 'Armourer', 'Sunday 29th of March 2026 07:29:13 AM', '2026-03-29 07:29:13'),
(294, 'owoahene@22', 'Armourer', 'Sunday 29th of March 2026 10:39:10 PM', '2026-03-29 22:39:10'),
(295, 'owoahene@22', 'Armourer', 'Monday 30th of March 2026 06:28:24 AM', '2026-03-30 06:28:24'),
(296, 'owoahene@22', 'Armourer', 'Wednesday 1st of April 2026 11:08:38 AM', '2026-04-01 11:08:38'),
(297, 'owoahene@22', 'Armourer', 'Wednesday 1st of April 2026 11:16:56 AM', '2026-04-01 11:16:56'),
(298, 'owoahene@22', 'Armourer', 'Wednesday 1st of April 2026 11:17:17 AM', '2026-04-01 11:17:17'),
(299, 'boampong', 'Armourer', 'Friday 3rd of April 2026 05:43:22 AM', '2026-04-03 05:43:22'),
(300, 'boampong', 'Armourer', 'Friday 3rd of April 2026 05:50:22 AM', '2026-04-03 05:50:22'),
(301, 'boampong', 'Armourer', 'Saturday 4th of April 2026 08:02:54 AM', '2026-04-04 08:02:54'),
(302, 'boampong', 'Armourer', 'Saturday 4th of April 2026 08:39:33 AM', '2026-04-04 08:39:33'),
(303, 'boampong', 'Armourer', 'Saturday 4th of April 2026 08:49:42 AM', '2026-04-04 08:49:42'),
(304, 'boampong', 'Armourer', 'Saturday 4th of April 2026 08:56:39 AM', '2026-04-04 08:56:39'),
(305, 'owoahene@22', 'Armourer', 'Tuesday 7th of April 2026 03:57:56 PM', '2026-04-07 15:57:56'),
(306, 'owoahene@22', 'Armourer', 'Saturday 11th of April 2026 06:27:33 AM', '2026-04-11 06:27:33'),
(307, 'owoahene@22', 'Armourer', 'Monday 13th of April 2026 06:15:24 AM', '2026-04-13 06:15:24'),
(308, 'owoahene@22', 'Armourer', 'Monday 13th of April 2026 06:34:21 AM', '2026-04-13 06:34:21'),
(309, 'owoahene@22', 'Armourer', 'Monday 13th of April 2026 06:06:10 PM', '2026-04-13 18:06:10'),
(310, 'boampong', 'Armourer', 'Monday 13th of April 2026 06:09:45 PM', '2026-04-13 18:09:45'),
(311, 'owoahene@22', 'Armourer', 'Monday 13th of April 2026 06:10:27 PM', '2026-04-13 18:10:27'),
(312, 'owoahene@22', 'Armourer', 'Tuesday 14th of April 2026 06:08:53 AM', '2026-04-14 06:08:53'),
(313, 'owoahene@22', 'Armourer', 'Tuesday 14th of April 2026 06:49:42 AM', '2026-04-14 06:49:42'),
(314, 'owoahene@22', 'Armourer', 'Tuesday 14th of April 2026 08:29:13 AM', '2026-04-14 08:29:13'),
(315, 'owoahene@22', 'Armourer', 'Tuesday 14th of April 2026 09:03:09 AM', '2026-04-14 09:03:09'),
(316, 'owoahene@22', 'Armourer', 'Tuesday 14th of April 2026 09:39:22 AM', '2026-04-14 09:39:22'),
(317, 'owoahene@22', 'Armourer', 'Tuesday 14th of April 2026 06:36:29 PM', '2026-04-14 18:36:29'),
(318, 'owoahene@22', 'Armourer', 'Tuesday 14th of April 2026 07:11:53 PM', '2026-04-14 19:11:53'),
(319, 'owoahene@22', 'Armourer', 'Wednesday 15th of April 2026 05:56:14 AM', '2026-04-15 05:56:14'),
(320, 'owoahene@22', 'Armourer', 'Wednesday 15th of April 2026 06:57:56 AM', '2026-04-15 06:57:56'),
(321, 'owoahene@22', 'Armourer', 'Wednesday 15th of April 2026 11:49:25 AM', '2026-04-15 11:49:25'),
(322, 'owoahene@22', 'Armourer', 'Wednesday 15th of April 2026 06:13:31 PM', '2026-04-15 18:13:31'),
(323, 'owoahene@22', 'Armourer', 'Thursday 16th of April 2026 05:47:55 AM', '2026-04-16 05:47:55'),
(324, 'owoahene@22', 'Armourer', 'Thursday 16th of April 2026 05:42:51 PM', '2026-04-16 17:42:51'),
(325, 'owoahene@22', 'Armourer', 'Thursday 16th of April 2026 06:17:57 PM', '2026-04-16 18:17:57'),
(326, 'owoahene@22', 'Armourer', 'Thursday 16th of April 2026 06:28:23 PM', '2026-04-16 18:28:23'),
(327, 'owoahene@22', 'Armourer', 'Friday 17th of April 2026 05:43:01 AM', '2026-04-17 05:43:01'),
(328, 'owoahene@22', 'Armourer', 'Friday 17th of April 2026 06:31:59 AM', '2026-04-17 06:31:59'),
(329, 'owoahene@22', 'Armourer', 'Friday 17th of April 2026 06:40:58 AM', '2026-04-17 06:40:58'),
(330, 'owoahene@22', 'Armourer', 'Friday 17th of April 2026 05:46:25 PM', '2026-04-17 17:46:25'),
(331, 'owoahene@22', 'Armourer', 'Friday 17th of April 2026 06:37:24 PM', '2026-04-17 18:37:24'),
(332, 'owoahene@22', 'Armourer', 'Saturday 18th of April 2026 05:48:34 AM', '2026-04-18 05:48:34'),
(333, 'owoahene@22', 'Armourer', 'Saturday 18th of April 2026 05:51:14 AM', '2026-04-18 05:51:14'),
(334, 'owoahene@22', 'Armourer', 'Saturday 18th of April 2026 06:05:07 AM', '2026-04-18 06:05:07'),
(335, 'owoahene@22', 'Armourer', 'Saturday 18th of April 2026 01:58:49 PM', '2026-04-18 13:58:49'),
(336, 'owoahene@22', 'Armourer', 'Saturday 18th of April 2026 05:54:55 PM', '2026-04-18 17:54:55'),
(337, 'owoahene@22', 'Armourer', 'Saturday 18th of April 2026 06:56:29 PM', '2026-04-18 18:56:29'),
(338, 'owoahene@22', 'Armourer', 'Sunday 19th of April 2026 05:52:48 AM', '2026-04-19 05:52:48'),
(339, 'owoahene@22', 'Armourer', 'Sunday 19th of April 2026 04:17:57 PM', '2026-04-19 16:17:57'),
(340, 'owoahene@22', 'Armourer', 'Sunday 19th of April 2026 05:16:53 PM', '2026-04-19 17:16:53'),
(341, 'owoahene@22', 'Armourer', 'Sunday 19th of April 2026 05:57:16 PM', '2026-04-19 17:57:16'),
(342, 'owoahene@22', 'Armourer', 'Monday 20th of April 2026 06:12:13 AM', '2026-04-20 06:12:13'),
(343, 'owoahene@22', 'Armourer', 'Monday 20th of April 2026 07:15:03 AM', '2026-04-20 07:15:03'),
(344, 'owoahene@22', 'Armourer', 'Monday 20th of April 2026 05:32:06 PM', '2026-04-20 17:32:06'),
(345, 'owoahene@22', 'Armourer', 'Monday 20th of April 2026 05:54:14 PM', '2026-04-20 17:54:14'),
(346, 'owoahene@22', 'Armourer', 'Monday 20th of April 2026 06:21:02 PM', '2026-04-20 18:21:02'),
(347, 'owoahene@22', 'Armourer', 'Tuesday 21st of April 2026 05:50:01 AM', '2026-04-21 05:50:01'),
(348, 'owoahene@22', 'Armourer', 'Tuesday 21st of April 2026 05:23:57 PM', '2026-04-21 17:23:57'),
(349, 'owoahene@22', 'Armourer', 'Tuesday 21st of April 2026 05:41:58 PM', '2026-04-21 17:41:58'),
(350, 'owoahene@22', 'Armourer', 'Tuesday 21st of April 2026 06:19:35 PM', '2026-04-21 18:19:35'),
(351, 'owoahene@22', 'Armourer', 'Tuesday 21st of April 2026 06:19:41 PM', '2026-04-21 18:19:41'),
(352, 'owoahene@22', 'Armourer', 'Tuesday 21st of April 2026 06:19:45 PM', '2026-04-21 18:19:45'),
(353, 'owoahene@22', 'Armourer', 'Tuesday 21st of April 2026 06:19:53 PM', '2026-04-21 18:19:53'),
(354, 'owoahene@22', 'Armourer', 'Wednesday 22nd of April 2026 05:58:10 AM', '2026-04-22 05:58:10'),
(355, 'owoahene@22', 'Armourer', 'Wednesday 22nd of April 2026 06:45:57 AM', '2026-04-22 06:45:57'),
(356, 'owoahene@22', 'Armourer', 'Wednesday 22nd of April 2026 08:29:57 AM', '2026-04-22 08:29:57'),
(357, 'owoahene@22', 'Armourer', 'Wednesday 22nd of April 2026 05:25:43 PM', '2026-04-22 17:25:43'),
(358, 'owoahene@22', 'Armourer', 'Wednesday 22nd of April 2026 06:09:56 PM', '2026-04-22 18:09:56'),
(359, 'owoahene@22', 'Armourer', 'Thursday 23rd of April 2026 05:54:24 AM', '2026-04-23 05:54:24'),
(360, 'owoahene@22', 'Armourer', 'Thursday 23rd of April 2026 05:04:41 PM', '2026-04-23 17:04:41'),
(361, 'owoahene@22', 'Armourer', 'Thursday 23rd of April 2026 05:36:03 PM', '2026-04-23 17:36:03'),
(362, 'owoahene@22', 'Armourer', 'Thursday 23rd of April 2026 05:36:28 PM', '2026-04-23 17:36:28'),
(363, 'owoahene@22', 'Armourer', 'Thursday 23rd of April 2026 05:36:38 PM', '2026-04-23 17:36:38'),
(364, 'owoahene@22', 'Armourer', 'Thursday 23rd of April 2026 05:36:58 PM', '2026-04-23 17:36:58'),
(365, 'owoahene@22', 'Armourer', 'Thursday 23rd of April 2026 06:13:37 PM', '2026-04-23 18:13:37'),
(366, 'owoahene@22', 'Armourer', 'Friday 24th of April 2026 05:49:09 AM', '2026-04-24 05:49:09'),
(367, 'owoahene@22', 'Armourer', 'Friday 24th of April 2026 06:43:28 AM', '2026-04-24 06:43:28'),
(368, 'owoahene@22', 'Armourer', 'Friday 24th of April 2026 07:09:59 AM', '2026-04-24 07:09:59'),
(369, 'owoahene@22', 'Armourer', 'Friday 24th of April 2026 09:19:17 AM', '2026-04-24 09:19:17'),
(370, 'owoahene@22', 'Armourer', 'Friday 24th of April 2026 05:32:59 PM', '2026-04-24 17:32:59'),
(371, 'owoahene@22', 'Armourer', 'Friday 24th of April 2026 06:13:25 PM', '2026-04-24 18:13:25'),
(372, 'owoahene@22', 'Armourer', 'Saturday 25th of April 2026 05:39:55 AM', '2026-04-25 05:39:55'),
(373, 'owoahene@22', 'Armourer', 'Saturday 25th of April 2026 05:48:42 PM', '2026-04-25 17:48:42'),
(374, 'owoahene@22', 'Armourer', 'Saturday 25th of April 2026 06:22:06 PM', '2026-04-25 18:22:06'),
(375, 'owoahene@22', 'Armourer', 'Sunday 26th of April 2026 05:37:58 AM', '2026-04-26 05:37:58'),
(376, 'owoahene@22', 'Armourer', 'Sunday 26th of April 2026 06:08:35 AM', '2026-04-26 06:08:35'),
(377, 'owoahene@22', 'Armourer', 'Sunday 26th of April 2026 05:54:21 PM', '2026-04-26 17:54:21'),
(378, 'owoahene@22', 'Armourer', 'Monday 27th of April 2026 05:49:56 AM', '2026-04-27 05:49:56'),
(379, 'owoahene@22', 'Armourer', 'Monday 27th of April 2026 06:32:08 AM', '2026-04-27 06:32:08'),
(380, 'owoahene@22', 'Armourer', 'Monday 27th of April 2026 08:53:54 AM', '2026-04-27 08:53:54'),
(381, 'owoahene@22', 'Armourer', 'Monday 27th of April 2026 06:03:30 PM', '2026-04-27 18:03:30'),
(382, 'owoahene@22', 'Armourer', 'Monday 27th of April 2026 06:25:56 PM', '2026-04-27 18:25:56'),
(383, 'owoahene@22', 'Armourer', 'Tuesday 28th of April 2026 06:17:41 AM', '2026-04-28 06:17:41'),
(384, 'owoahene@22', 'Armourer', 'Tuesday 28th of April 2026 05:57:11 PM', '2026-04-28 17:57:11'),
(385, 'owoahene@22', 'Armourer', 'Wednesday 29th of April 2026 06:51:39 AM', '2026-04-29 06:51:39'),
(386, 'owoahene@22', 'Armourer', 'Wednesday 29th of April 2026 07:21:55 AM', '2026-04-29 07:21:55'),
(387, 'owoahene@22', 'Armourer', 'Wednesday 29th of April 2026 05:30:20 PM', '2026-04-29 17:30:20'),
(388, 'owoahene@22', 'Armourer', 'Wednesday 29th of April 2026 05:55:12 PM', '2026-04-29 17:55:12'),
(389, 'owoahene@22', 'Armourer', 'Wednesday 29th of April 2026 06:15:31 PM', '2026-04-29 18:15:31'),
(390, 'owoahene@22', 'Armourer', 'Thursday 30th of April 2026 05:54:27 AM', '2026-04-30 05:54:27'),
(391, 'owoahene@22', 'Armourer', 'Thursday 30th of April 2026 06:34:50 AM', '2026-04-30 06:34:50'),
(392, 'owoahene@22', 'Armourer', 'Thursday 30th of April 2026 06:17:20 PM', '2026-04-30 18:17:20'),
(393, 'owoahene@22', 'Armourer', 'Friday 1st of May 2026 05:30:11 AM', '2026-05-01 05:30:11'),
(394, 'owoahene@22', 'Armourer', 'Friday 1st of May 2026 05:52:44 AM', '2026-05-01 05:52:44'),
(395, 'owoahene@22', 'Armourer', 'Friday 1st of May 2026 06:46:51 AM', '2026-05-01 06:46:51'),
(396, 'owoahene@22', 'Armourer', 'Friday 1st of May 2026 05:47:19 PM', '2026-05-01 17:47:19'),
(397, 'owoahene@22', 'Armourer', 'Friday 1st of May 2026 06:53:47 PM', '2026-05-01 18:53:47'),
(398, 'owoahene@22', 'Armourer', 'Saturday 2nd of May 2026 06:02:23 AM', '2026-05-02 06:02:23'),
(399, 'owoahene@22', 'Armourer', 'Saturday 2nd of May 2026 05:52:12 PM', '2026-05-02 17:52:12'),
(400, 'owoahene@22', 'Armourer', 'Saturday 2nd of May 2026 06:23:45 PM', '2026-05-02 18:23:45'),
(401, 'owoahene@22', 'Armourer', 'Sunday 3rd of May 2026 06:12:00 AM', '2026-05-03 06:12:00'),
(402, 'owoahene@22', 'Armourer', 'Sunday 3rd of May 2026 03:09:36 PM', '2026-05-03 15:09:36'),
(403, 'owoahene@22', 'Armourer', 'Sunday 3rd of May 2026 06:01:08 PM', '2026-05-03 18:01:08'),
(404, 'owoahene@22', 'Armourer', 'Monday 4th of May 2026 07:12:13 AM', '2026-05-04 07:12:13'),
(405, 'owoahene@22', 'Armourer', 'Monday 4th of May 2026 05:05:26 PM', '2026-05-04 17:05:26'),
(406, 'owoahene@22', 'Armourer', 'Monday 4th of May 2026 05:43:17 PM', '2026-05-04 17:43:17'),
(407, 'owoahene@22', 'Armourer', 'Tuesday 5th of May 2026 06:17:32 AM', '2026-05-05 06:17:32'),
(408, 'owoahene@22', 'Armourer', 'Thursday 7th of May 2026 03:27:05 PM', '2026-05-07 15:27:05'),
(409, 'owoahene@22', 'Armourer', 'Thursday 7th of May 2026 04:43:30 PM', '2026-05-07 16:43:30'),
(410, 'owoahene@22', 'Armourer', 'Thursday 7th of May 2026 05:05:23 PM', '2026-05-07 17:05:23'),
(411, 'owoahene@22', 'Armourer', 'Friday 8th of May 2026 06:27:34 AM', '2026-05-08 06:27:34'),
(412, 'owoahene@22', 'Armourer', 'Friday 8th of May 2026 07:02:57 AM', '2026-05-08 07:02:57'),
(413, 'owoahene@22', 'Armourer', 'Saturday 9th of May 2026 08:30:31 AM', '2026-05-09 08:30:31'),
(414, 'owoahene@22', 'Armourer', 'Saturday 9th of May 2026 09:55:05 AM', '2026-05-09 09:55:05'),
(415, 'owoahene@22', 'Armourer', 'Saturday 9th of May 2026 04:37:58 PM', '2026-05-09 16:37:58'),
(416, 'owoahene@22', 'Armourer', 'Saturday 9th of May 2026 05:29:00 PM', '2026-05-09 17:29:00'),
(417, 'owoahene@22', 'Armourer', 'Saturday 9th of May 2026 05:29:45 PM', '2026-05-09 17:29:45'),
(418, 'owoahene@22', 'Armourer', 'Saturday 9th of May 2026 05:38:22 PM', '2026-05-09 17:38:22'),
(419, 'williams', 'Armourer', 'Monday 11th of May 2026 07:41:33 AM', '2026-05-11 07:41:33'),
(420, 'williams', 'Armourer', 'Monday 11th of May 2026 08:47:25 AM', '2026-05-11 08:47:25'),
(421, 'williams', 'Armourer', 'Monday 11th of May 2026 10:24:21 AM', '2026-05-11 10:24:21'),
(422, 'williams', 'Armourer', 'Monday 11th of May 2026 12:24:15 PM', '2026-05-11 12:24:15'),
(423, 'williams', 'Armourer', 'Monday 11th of May 2026 02:50:41 PM', '2026-05-11 14:50:41'),
(424, 'williams', 'Armourer', 'Monday 11th of May 2026 02:51:03 PM', '2026-05-11 14:51:03'),
(425, 'williams', 'Administrator', 'Monday 11th of May 2026 05:54:06 PM', '2026-05-11 17:54:06'),
(426, 'williams', 'Administrator', 'Monday 11th of May 2026 08:25:30 PM', '2026-05-11 20:25:30'),
(427, 'williams', 'Administrator', 'Monday 11th of May 2026 08:27:21 PM', '2026-05-11 20:27:21'),
(428, 'williams', 'Administrator', 'Monday 11th of May 2026 09:19:25 PM', '2026-05-11 21:19:25'),
(429, 'william', 'Armourer', 'Tuesday 12th of May 2026 06:49:22 AM', '2026-05-12 06:49:22'),
(430, 'william', 'Armourer', 'Tuesday 12th of May 2026 07:24:17 AM', '2026-05-12 07:24:17'),
(431, 'william', 'Armourer', 'Tuesday 12th of May 2026 09:28:46 AM', '2026-05-12 09:28:46'),
(432, 'william', 'Armourer', 'Tuesday 12th of May 2026 09:29:51 AM', '2026-05-12 09:29:51'),
(433, 'william', 'Armourer', 'Tuesday 12th of May 2026 10:26:27 AM', '2026-05-12 10:26:27'),
(434, 'williams', 'Administrator', 'Tuesday 12th of May 2026 10:36:47 AM', '2026-05-12 10:36:47'),
(435, 'william', 'Armourer', 'Tuesday 12th of May 2026 11:00:57 AM', '2026-05-12 11:00:57'),
(436, 'william', 'Armourer', 'Tuesday 12th of May 2026 11:01:32 AM', '2026-05-12 11:01:32'),
(437, 'william', 'Armourer', 'Tuesday 12th of May 2026 11:03:00 AM', '2026-05-12 11:03:00'),
(438, 'williams', 'Administrator', 'Tuesday 12th of May 2026 11:10:44 AM', '2026-05-12 11:10:44'),
(439, 'william', 'Armourer', 'Tuesday 12th of May 2026 11:14:36 AM', '2026-05-12 11:14:36'),
(440, 'williams', 'Administrator', 'Tuesday 12th of May 2026 11:45:18 AM', '2026-05-12 11:45:18'),
(441, 'williams', 'Administrator', 'Tuesday 12th of May 2026 11:46:02 AM', '2026-05-12 11:46:02'),
(442, 'william', 'Armourer', 'Tuesday 12th of May 2026 11:48:50 AM', '2026-05-12 11:48:50'),
(443, 'williams', 'Administrator', 'Tuesday 12th of May 2026 01:36:18 PM', '2026-05-12 13:36:18'),
(444, 'williams', 'Administrator', 'Tuesday 12th of May 2026 02:59:40 PM', '2026-05-12 14:59:40'),
(445, 'william', 'Armourer', 'Tuesday 12th of May 2026 03:09:11 PM', '2026-05-12 15:09:11'),
(446, 'williams', 'Administrator', 'Tuesday 12th of May 2026 04:00:51 PM', '2026-05-12 16:00:51'),
(447, 'williams', 'Administrator', 'Tuesday 12th of May 2026 04:48:27 PM', '2026-05-12 16:48:27'),
(448, 'williams', 'Administrator', 'Tuesday 12th of May 2026 06:02:01 PM', '2026-05-12 18:02:01');

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
(119, 121, 'boampong', 'Armourer', 'Thursday 24th of October 2024 10:14:30 PM', '2024-10-24 22:14:30'),
(120, 121, 'boampong', 'Armourer', 'Monday 9th of March 2026 01:55:41 PM', '2026-03-09 13:55:41'),
(121, 121, 'boampong', 'Armourer', 'Monday 9th of March 2026 04:17:59 PM', '2026-03-09 16:17:59'),
(122, 121, 'boampong', 'Armourer', 'Monday 9th of March 2026 05:28:16 PM', '2026-03-09 17:28:16'),
(123, 121, 'boampong', 'Armourer', 'Monday 9th of March 2026 06:24:18 PM', '2026-03-09 18:24:18'),
(124, 121, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 09:33:48 AM', '2026-03-11 09:33:48'),
(125, 121, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 09:46:06 AM', '2026-03-11 09:46:06'),
(126, 121, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 09:47:56 AM', '2026-03-11 09:47:56'),
(127, 121, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 01:49:55 PM', '2026-03-11 13:49:55'),
(128, 121, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 02:16:50 PM', '2026-03-11 14:16:50'),
(129, 121, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 03:30:12 PM', '2026-03-11 15:30:12'),
(130, 121, 'boampong', 'Armourer', 'Wednesday 11th of March 2026 05:37:38 PM', '2026-03-11 17:37:38'),
(131, 121, 'boampong', 'Armourer', 'Thursday 12th of March 2026 05:12:39 AM', '2026-03-12 05:12:39'),
(132, 121, 'boampong', 'Armourer', 'Thursday 12th of March 2026 07:36:56 AM', '2026-03-12 07:36:56'),
(133, 121, 'boampong', 'Armourer', 'Thursday 12th of March 2026 11:46:54 AM', '2026-03-12 11:46:54'),
(134, 121, 'boampong', 'Armourer', 'Thursday 12th of March 2026 05:49:08 PM', '2026-03-12 17:49:08'),
(135, 121, 'boampong', 'Armourer', 'Friday 13th of March 2026 07:50:38 AM', '2026-03-13 07:50:38'),
(136, 121, 'boampong', 'Armourer', 'Friday 13th of March 2026 12:48:07 PM', '2026-03-13 12:48:07'),
(137, 121, 'boampong', 'Armourer', 'Friday 13th of March 2026 01:12:12 PM', '2026-03-13 13:12:12'),
(138, 121, 'boampong', 'Armourer', 'Friday 13th of March 2026 02:58:03 PM', '2026-03-13 14:58:03'),
(139, 121, 'boampong', 'Armourer', 'Friday 13th of March 2026 04:08:11 PM', '2026-03-13 16:08:11'),
(140, 121, 'boampong', 'Armourer', 'Friday 13th of March 2026 04:52:03 PM', '2026-03-13 16:52:03'),
(141, 121, 'boampong', 'Armourer', 'Saturday 14th of March 2026 12:05:35 PM', '2026-03-14 12:05:35'),
(142, 121, 'boampong', 'Armourer', 'Sunday 15th of March 2026 06:48:59 AM', '2026-03-15 06:48:59'),
(143, 121, 'boampong', 'Armourer', 'Sunday 15th of March 2026 06:42:38 PM', '2026-03-15 18:42:38'),
(144, 121, 'boampong', 'Armourer', 'Tuesday 17th of March 2026 05:50:10 AM', '2026-03-17 05:50:10'),
(145, 121, 'boampong', 'Armourer', 'Tuesday 17th of March 2026 08:25:06 AM', '2026-03-17 08:25:06'),
(146, 121, 'boampong', 'Armourer', 'Tuesday 17th of March 2026 02:19:34 PM', '2026-03-17 14:19:34'),
(147, 121, 'boampong', 'Armourer', 'Tuesday 17th of March 2026 02:44:24 PM', '2026-03-17 14:44:24'),
(148, 121, 'boampong', 'Armourer', 'Wednesday 18th of March 2026 05:49:07 AM', '2026-03-18 05:49:07'),
(149, 121, 'boampong', 'Armourer', 'Friday 20th of March 2026 06:47:10 AM', '2026-03-20 06:47:10'),
(150, 121, 'boampong', 'Armourer', 'Friday 20th of March 2026 05:08:56 PM', '2026-03-20 17:08:56'),
(151, 121, 'boampong', 'Armourer', 'Saturday 21st of March 2026 05:26:30 AM', '2026-03-21 05:26:30'),
(152, 121, 'boampong', 'Armourer', 'Sunday 22nd of March 2026 07:02:18 AM', '2026-03-22 07:02:18'),
(153, 121, 'boampong', 'Armourer', 'Tuesday 24th of March 2026 11:21:11 AM', '2026-03-24 11:21:11'),
(154, 121, 'boampong', 'Armourer', 'Tuesday 24th of March 2026 03:39:49 PM', '2026-03-24 15:39:49'),
(155, 121, 'boampong', 'Armourer', 'Tuesday 24th of March 2026 06:35:09 PM', '2026-03-24 18:35:09'),
(156, 256, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 06:00:41 AM', '2026-03-25 06:00:41'),
(157, 256, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 06:25:17 AM', '2026-03-25 06:25:17'),
(158, 256, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 06:50:44 AM', '2026-03-25 06:50:44'),
(159, 256, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 08:23:53 AM', '2026-03-25 08:23:53'),
(160, 256, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 10:37:44 AM', '2026-03-25 10:37:44'),
(161, 256, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 11:16:45 AM', '2026-03-25 11:16:45'),
(162, 256, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 12:35:57 PM', '2026-03-25 12:35:57'),
(163, 256, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 01:00:56 PM', '2026-03-25 13:00:56'),
(164, 256, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 02:33:08 PM', '2026-03-25 14:33:08'),
(165, 256, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 03:18:37 PM', '2026-03-25 15:18:37'),
(166, 256, 'owoahene@22', 'Armourer', 'Wednesday 25th of March 2026 06:31:16 PM', '2026-03-25 18:31:16'),
(167, 121, 'boampong', 'Armourer', 'Thursday 26th of March 2026 05:50:18 AM', '2026-03-26 05:50:18'),
(168, 256, 'owoahene@22', 'Armourer', 'Thursday 26th of March 2026 06:57:04 AM', '2026-03-26 06:57:04'),
(169, 256, 'owoahene@22', 'Armourer', 'Thursday 26th of March 2026 10:54:28 AM', '2026-03-26 10:54:28'),
(170, 121, 'boampong', 'Armourer', 'Friday 27th of March 2026 12:12:03 PM', '2026-03-27 12:12:03'),
(171, 121, 'boampong', 'Armourer', 'Friday 27th of March 2026 02:02:33 PM', '2026-03-27 14:02:33'),
(172, 121, 'boampong', 'Armourer', 'Friday 27th of March 2026 06:30:44 PM', '2026-03-27 18:30:44'),
(173, 121, 'boampong', 'Armourer', 'Saturday 28th of March 2026 06:18:37 AM', '2026-03-28 06:18:37'),
(174, 256, 'owoahene@22', 'Armourer', 'Friday 3rd of April 2026 05:43:03 AM', '2026-04-03 05:43:03'),
(175, 256, 'owoahene@22', 'Armourer', 'Monday 13th of April 2026 06:15:09 AM', '2026-04-13 06:15:09'),
(176, 256, 'owoahene@22', 'Armourer', 'Monday 13th of April 2026 06:34:08 AM', '2026-04-13 06:34:08'),
(177, 121, 'boampong', 'Armourer', 'Monday 13th of April 2026 06:10:15 PM', '2026-04-13 18:10:15'),
(178, 256, 'owoahene@22', 'Armourer', 'Tuesday 14th of April 2026 06:08:50 AM', '2026-04-14 06:08:50'),
(179, 256, 'owoahene@22', 'Armourer', 'Tuesday 14th of April 2026 06:49:41 AM', '2026-04-14 06:49:41'),
(180, 256, 'owoahene@22', 'Armourer', 'Tuesday 14th of April 2026 09:03:07 AM', '2026-04-14 09:03:07'),
(181, 256, 'owoahene@22', 'Armourer', 'Tuesday 14th of April 2026 06:36:27 PM', '2026-04-14 18:36:27'),
(182, 256, 'owoahene@22', 'Armourer', 'Tuesday 14th of April 2026 07:11:52 PM', '2026-04-14 19:11:52'),
(183, 256, 'owoahene@22', 'Armourer', 'Wednesday 15th of April 2026 05:56:11 AM', '2026-04-15 05:56:11'),
(184, 256, 'owoahene@22', 'Armourer', 'Wednesday 15th of April 2026 06:57:54 AM', '2026-04-15 06:57:54'),
(185, 256, 'owoahene@22', 'Armourer', 'Wednesday 15th of April 2026 06:13:30 PM', '2026-04-15 18:13:30'),
(186, 256, 'owoahene@22', 'Armourer', 'Thursday 16th of April 2026 05:47:51 AM', '2026-04-16 05:47:51'),
(187, 256, 'owoahene@22', 'Armourer', 'Thursday 16th of April 2026 06:17:43 PM', '2026-04-16 18:17:43'),
(188, 256, 'owoahene@22', 'Armourer', 'Friday 17th of April 2026 06:37:22 PM', '2026-04-17 18:37:22'),
(189, 256, 'owoahene@22', 'Armourer', 'Saturday 18th of April 2026 01:58:47 PM', '2026-04-18 13:58:47'),
(190, 256, 'owoahene@22', 'Armourer', 'Saturday 18th of April 2026 05:54:54 PM', '2026-04-18 17:54:54'),
(191, 256, 'owoahene@22', 'Armourer', 'Saturday 18th of April 2026 06:56:28 PM', '2026-04-18 18:56:28'),
(192, 256, 'owoahene@22', 'Armourer', 'Sunday 19th of April 2026 05:16:52 PM', '2026-04-19 17:16:52'),
(193, 256, 'owoahene@22', 'Armourer', 'Sunday 19th of April 2026 05:57:15 PM', '2026-04-19 17:57:15'),
(194, 256, 'owoahene@22', 'Armourer', 'Monday 20th of April 2026 06:12:10 AM', '2026-04-20 06:12:10'),
(195, 256, 'owoahene@22', 'Armourer', 'Monday 20th of April 2026 07:15:01 AM', '2026-04-20 07:15:01'),
(196, 256, 'owoahene@22', 'Armourer', 'Monday 20th of April 2026 05:32:05 PM', '2026-04-20 17:32:05'),
(197, 256, 'owoahene@22', 'Armourer', 'Monday 20th of April 2026 05:54:11 PM', '2026-04-20 17:54:11'),
(198, 256, 'owoahene@22', 'Armourer', 'Monday 20th of April 2026 06:21:00 PM', '2026-04-20 18:21:00'),
(199, 256, 'owoahene@22', 'Armourer', 'Tuesday 21st of April 2026 05:49:58 AM', '2026-04-21 05:49:58'),
(200, 256, 'owoahene@22', 'Armourer', 'Tuesday 21st of April 2026 05:23:54 PM', '2026-04-21 17:23:54'),
(201, 256, 'owoahene@22', 'Armourer', 'Tuesday 21st of April 2026 05:41:56 PM', '2026-04-21 17:41:56'),
(202, 256, 'owoahene@22', 'Armourer', 'Tuesday 21st of April 2026 06:19:26 PM', '2026-04-21 18:19:26'),
(203, 256, 'owoahene@22', 'Armourer', 'Wednesday 22nd of April 2026 06:45:55 AM', '2026-04-22 06:45:55'),
(204, 256, 'owoahene@22', 'Armourer', 'Wednesday 22nd of April 2026 08:29:54 AM', '2026-04-22 08:29:54'),
(205, 256, 'owoahene@22', 'Armourer', 'Wednesday 22nd of April 2026 05:25:42 PM', '2026-04-22 17:25:42'),
(206, 256, 'owoahene@22', 'Armourer', 'Wednesday 22nd of April 2026 06:09:55 PM', '2026-04-22 18:09:55'),
(207, 256, 'owoahene@22', 'Armourer', 'Thursday 23rd of April 2026 05:54:23 AM', '2026-04-23 05:54:23'),
(208, 256, 'owoahene@22', 'Armourer', 'Thursday 23rd of April 2026 05:04:39 PM', '2026-04-23 17:04:39'),
(209, 256, 'owoahene@22', 'Armourer', 'Thursday 23rd of April 2026 05:35:42 PM', '2026-04-23 17:35:42'),
(210, 256, 'owoahene@22', 'Armourer', 'Thursday 23rd of April 2026 06:13:36 PM', '2026-04-23 18:13:36'),
(211, 256, 'owoahene@22', 'Armourer', 'Friday 24th of April 2026 06:43:26 AM', '2026-04-24 06:43:26'),
(212, 256, 'owoahene@22', 'Armourer', 'Friday 24th of April 2026 07:09:58 AM', '2026-04-24 07:09:58'),
(213, 256, 'owoahene@22', 'Armourer', 'Friday 24th of April 2026 05:32:57 PM', '2026-04-24 17:32:57'),
(214, 256, 'owoahene@22', 'Armourer', 'Saturday 25th of April 2026 05:48:40 PM', '2026-04-25 17:48:40'),
(215, 256, 'owoahene@22', 'Armourer', 'Saturday 25th of April 2026 06:22:05 PM', '2026-04-25 18:22:05'),
(216, 256, 'owoahene@22', 'Armourer', 'Sunday 26th of April 2026 05:37:56 AM', '2026-04-26 05:37:56'),
(217, 256, 'owoahene@22', 'Armourer', 'Sunday 26th of April 2026 06:08:33 AM', '2026-04-26 06:08:33'),
(218, 256, 'owoahene@22', 'Armourer', 'Monday 27th of April 2026 08:53:52 AM', '2026-04-27 08:53:52'),
(219, 256, 'owoahene@22', 'Armourer', 'Monday 27th of April 2026 06:25:54 PM', '2026-04-27 18:25:54'),
(220, 256, 'owoahene@22', 'Armourer', 'Tuesday 28th of April 2026 06:17:39 AM', '2026-04-28 06:17:39'),
(221, 256, 'owoahene@22', 'Armourer', 'Tuesday 28th of April 2026 05:57:09 PM', '2026-04-28 17:57:09'),
(222, 256, 'owoahene@22', 'Armourer', 'Wednesday 29th of April 2026 07:21:53 AM', '2026-04-29 07:21:53'),
(223, 256, 'owoahene@22', 'Armourer', 'Wednesday 29th of April 2026 05:30:17 PM', '2026-04-29 17:30:17'),
(224, 256, 'owoahene@22', 'Armourer', 'Wednesday 29th of April 2026 05:55:10 PM', '2026-04-29 17:55:10'),
(225, 256, 'owoahene@22', 'Armourer', 'Wednesday 29th of April 2026 06:15:29 PM', '2026-04-29 18:15:29'),
(226, 256, 'owoahene@22', 'Armourer', 'Thursday 30th of April 2026 06:34:48 AM', '2026-04-30 06:34:48'),
(227, 256, 'owoahene@22', 'Armourer', 'Friday 1st of May 2026 05:52:42 AM', '2026-05-01 05:52:42'),
(228, 256, 'owoahene@22', 'Armourer', 'Friday 1st of May 2026 06:46:45 AM', '2026-05-01 06:46:45'),
(229, 256, 'owoahene@22', 'Armourer', 'Friday 1st of May 2026 06:53:46 PM', '2026-05-01 18:53:46'),
(230, 256, 'owoahene@22', 'Armourer', 'Saturday 2nd of May 2026 06:23:44 PM', '2026-05-02 18:23:44'),
(231, 256, 'owoahene@22', 'Armourer', 'Sunday 3rd of May 2026 06:01:06 PM', '2026-05-03 18:01:06'),
(232, 256, 'owoahene@22', 'Armourer', 'Monday 4th of May 2026 05:43:16 PM', '2026-05-04 17:43:16'),
(233, 256, 'owoahene@22', 'Armourer', 'Tuesday 5th of May 2026 06:17:13 AM', '2026-05-05 06:17:13'),
(234, 407, 'owoahene@22', 'Armourer', 'Thursday 7th of May 2026 03:26:12 PM', '2026-05-07 15:26:12'),
(235, 409, 'owoahene@22', 'Armourer', 'Thursday 7th of May 2026 05:04:54 PM', '2026-05-07 17:04:54'),
(236, 410, 'owoahene@22', 'Armourer', 'Friday 8th of May 2026 06:27:21 AM', '2026-05-08 06:27:21'),
(237, 411, 'owoahene@22', 'Armourer', 'Friday 8th of May 2026 07:02:42 AM', '2026-05-08 07:02:42'),
(238, 412, 'owoahene@22', 'Armourer', 'Saturday 9th of May 2026 08:26:11 AM', '2026-05-09 08:26:11'),
(239, 413, 'owoahene@22', 'Armourer', 'Saturday 9th of May 2026 09:54:40 AM', '2026-05-09 09:54:40'),
(240, 414, 'owoahene@22', 'Armourer', 'Saturday 9th of May 2026 04:37:29 PM', '2026-05-09 16:37:29'),
(241, 415, 'owoahene@22', 'Armourer', 'Saturday 9th of May 2026 05:26:07 PM', '2026-05-09 17:26:07'),
(242, 416, 'owoahene@22', 'Armourer', 'Saturday 9th of May 2026 05:29:32 PM', '2026-05-09 17:29:32'),
(243, 417, 'owoahene@22', 'Armourer', 'Saturday 9th of May 2026 05:37:35 PM', '2026-05-09 17:37:35'),
(244, 419, 'williams', 'Armourer', 'Monday 11th of May 2026 08:43:54 AM', '2026-05-11 08:43:54'),
(245, 420, 'williams', 'Armourer', 'Monday 11th of May 2026 09:16:11 AM', '2026-05-11 09:16:11'),
(246, 421, 'williams', 'Armourer', 'Monday 11th of May 2026 12:23:57 PM', '2026-05-11 12:23:57'),
(247, 422, 'williams', 'Armourer', 'Monday 11th of May 2026 02:49:51 PM', '2026-05-11 14:49:51'),
(248, 424, 'williams', 'Armourer', 'Monday 11th of May 2026 04:26:25 PM', '2026-05-11 16:26:25'),
(249, 425, 'williams', 'Administrator', 'Monday 11th of May 2026 08:24:21 PM', '2026-05-11 20:24:21'),
(250, 429, 'william', 'Armourer', 'Tuesday 12th of May 2026 07:23:36 AM', '2026-05-12 07:23:36'),
(251, 432, 'william', 'Armourer', 'Tuesday 12th of May 2026 10:25:59 AM', '2026-05-12 10:25:59'),
(252, 433, 'william', 'Armourer', 'Tuesday 12th of May 2026 10:34:37 AM', '2026-05-12 10:34:37'),
(253, 434, 'williams', 'Administrator', 'Tuesday 12th of May 2026 11:00:28 AM', '2026-05-12 11:00:28'),
(254, 435, 'william', 'Armourer', 'Tuesday 12th of May 2026 11:01:15 AM', '2026-05-12 11:01:15'),
(255, 436, 'william', 'Armourer', 'Tuesday 12th of May 2026 11:02:46 AM', '2026-05-12 11:02:46'),
(256, 443, 'williams', 'Administrator', 'Tuesday 12th of May 2026 02:57:11 PM', '2026-05-12 14:57:11'),
(257, 444, 'williams', 'Administrator', 'Tuesday 12th of May 2026 04:00:30 PM', '2026-05-12 16:00:30'),
(258, 446, 'williams', 'Administrator', 'Tuesday 12th of May 2026 04:48:09 PM', '2026-05-12 16:48:09'),
(259, 447, 'williams', 'Administrator', 'Tuesday 12th of May 2026 06:00:40 PM', '2026-05-12 18:00:40');

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
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officers`
--

INSERT INTO `officers` (`officerID`, `officer_status`, `officer_image`, `officer_service_no`, `rank`, `full_name`, `gender`, `dept_unit`, `phone_no`, `officer_email`, `datetime`, `is_deleted`) VALUES
(2, 'Active In Service', '670413824bd6d9.66769177.jpg', '56140', 'L/CPL', 'Samuel Ntim', 'Male', 'CTD', '0558110251', 'dreevil200@gmail.com', '2024-10-24 20:51:20', 0),
(3, 'Active In Service', '670414b5f1c316.79734802.jpg', '56530', 'L/CPL', 'Stephen Owusu', 'Male', 'CTD', '0559536194', 'stephenwusu018@gmail.com', '2024-10-24 20:51:23', 0),
(4, 'Active In Service', '67041579c4d831.81684806.jpg', '58473', 'L/CPL', 'Eugene Bronya', 'Male', 'CTD', '0547582507', 'bronyaeugene@gmail.com', '2026-03-11 11:27:46', 0),
(5, 'Active In Service', '67041648580437.44530840.jpg', '58330', 'L/CPL', 'Stephen Darko', 'Male', 'CTD', '0549052144', 'ember7@gmail.com', '2026-03-11 10:15:40', 0),
(6, 'Active In Service', '6704174d634f39.73322795.jpg', '58595', 'L/CPL', 'Gehead Yeboah', 'Male', 'CTD', '0543100787', 'Geheady@gmail.com', '2026-03-11 11:34:25', 0),
(7, 'Active In Service', '670418a21a45d6.39486442.jpg', '57863', 'L/CPL', 'Bismark Mills', 'Male', 'CTD', '0545382372', 'mllsb1995@gmail.com', '2026-03-11 11:34:57', 0),
(8, 'Active In Service', '67042786b8ea45.90840463.jpg', '46522', 'SGT', 'Gordwin Afenyo', 'Male', 'CTD', '0246419071', 'estoppelgodwin@yahoo.com', '2024-10-24 20:51:37', 0),
(10, 'Active In Service', '670429df5240a6.06880408.jpg', '58547', 'L/CPL', 'Abudu Abubakari', 'Male', 'CTD', '0267085827', 'abubakariWd@gmai.com', '2026-03-11 11:35:11', 0),
(12, 'Active In Service', '67042c90164ed9.78428298.jpg', '53606', 'CPL', 'Ebenezer Aning Nti', 'Male', 'CTD', '0554676667', 'aningnti100@gmail.com', '2026-03-11 12:23:13', 0),
(13, 'Active In Service', '67042def908e34.16990129.jpg', '54669', 'CPL', 'Felix Appiah', 'Male', 'CTD', '0547296972', 'Appiahfelix36@gmail.com', '2026-03-11 12:24:34', 0),
(14, 'Active In Service', '6704415cc86bd6.27878216.jpg', '57569', 'L/CPL', 'Abdul Malik  Yussif', 'Male', 'CTD', '0546771101', 'malikabduyussif@gmail.com', '2026-03-11 11:35:38', 0),
(17, 'Active In Service', '67047d6b7f6336.57061364.jpg', '58460', 'L/CPL', 'Alex Pwatiu', 'Male', 'CTD', '0244939364', 'PWATIU@gmail.com', '2026-03-11 11:35:55', 0),
(18, 'Active In Service', '67048942aa7eb4.33246253.jpg', '58125', 'L/CPL', 'Benjamin Asiedu ', 'Male', 'CTD', '0244806120', 'kwekumensahadiepena@gmail.com', '2026-03-11 11:36:09', 0),
(19, 'Active In Service', '67048c1cbb2b82.22334787.jpg', '58353', 'L/CPL', 'Paul Father Tsibuah', 'Male', 'CTD', '0243016905', 'paulfathertsiboah@gmail.com', '2026-03-11 11:36:22', 0),
(20, 'Active In Service', '670531cf0db154.03197498.jpg', '58551', 'L/CPL', 'Bright Opoku Agyei', 'Male', 'CTD', '05582962533', 'Brightopuku2010@gmail.com', '2026-03-25 13:32:22', 0),
(21, 'Active In Service', '670532ff162947.50573292.jpg', '58516', 'L/CPL', 'Ernest Yeboah', 'Male', 'CTD', '0550249176', 'ernestyeboah484@gmail.com', '2026-03-11 11:36:54', 0),
(22, 'Active In Service', '6705344089fe95.00990441.jpg', '58571', 'L/CPL', 'Hubert Osei Boamteng ', 'Male', 'CTD', '0558750440', 'hubert.oseiboateng111@gmail.com', '2026-03-11 11:37:12', 0),
(23, 'Active In Service', '6705354df1c810.04457986.jpg', '58092', 'L/CPL', 'Benjamin Sarpong ', 'Male', 'CTD', '0249270443', 'sarpongbenjamin000@gmail.com', '2026-03-11 11:37:29', 0),
(24, 'Active In Service', '670536abe9c706.72689736.jpg', '58442', 'L/CPL', 'David Sedem', 'Male', 'CTD', '0243505841', 'sedemreal@gmail.com', '2026-03-11 11:37:41', 0),
(25, 'Active In Service', '670538041656d2.46636766.jpg', '58515', 'L/CPL', 'Francis Kyei', 'Male', 'CTD', '0245955040', 'fkyei65@gmail.com', '2026-03-11 11:37:53', 0),
(26, 'Active In Service', '67053feeb2b394.69718031.jpg', '57914', 'L/CPL', 'Kenny Adarkwah ', 'Male', 'CTD', '0245620209', 'sirkenny44@gmail.com', '2026-03-11 11:38:05', 0),
(27, 'Active In Service', '67054194c8c660.32184331.jpg', '58214', 'L/CPL', 'Biney Alex Mensah', 'Male', 'CTD', '0207393654', 'mensahbineyalex001@gmail.com', '2026-03-11 11:38:15', 0),
(28, 'Active In Service', '67054263363cb2.26951630.jpg', '58463', 'L/CPL', 'Benjamin Addy ', 'Male', 'CTD', '0241441803', 'addybenjamin78@gmail.com', '2026-03-11 11:38:26', 0),
(29, 'Active In Service', '670543f75f17e1.72713618.jpg', '55931', 'L/CPL', 'George  Osei Agyemang ', 'Male', 'CTD', '0554143127', 'oseiagyemenggeorge5076@gmail.com', '2026-04-20 06:33:01', 0),
(30, 'Active In Service', '670545d449f8b8.81272890.jpg', '46035', 'SGT', 'Solomon Mensah Kojo ', 'Male', 'CTD', '0243056464', 'solomonkojomensah1985@gmail.com', '2024-10-24 20:53:10', 0),
(31, 'Transferred', '67054cb706d9d9.70134585.jpg', '49749', 'SGT', 'Rpbert Azamati ', 'Male', 'CTD', '0244156972', 'azamatirobert18@gmail.com', '2026-03-24 15:42:03', 0),
(32, 'Active In Service', '6706886537d993.29867182.jpg', '50128', 'CPL', 'Samuel Quaicoe ', 'Male', 'CTD', '0240447273', 'samuelquaicoe462@gmail.com', '2024-10-24 20:53:16', 0),
(33, 'Active In Service', '6706961e416552.04808775.jpg', '58198', 'L/CPL', 'Solomon Asomani ', 'Male', 'CTD', '0249900151', 'asomanisolomon939@gmail.com', '2026-03-11 11:38:35', 0),
(34, 'Active In Service', '670697d72147b2.04817119.jpg', 'PN29464', 'INSPR', 'Richard Boampong', 'Male', 'CTD', '0246846556', 'richardboampong13@gmail.com', '2026-03-12 07:36:56', 0),
(35, 'Active In Service', '6707d8bf931f64.46150517.jpg', '55044 ', 'CPL', 'Fred  Agyekum ', 'Male', 'CTD', '0205084186', 'Fredagyekum83@gmail.com', '2026-03-11 17:40:11', 0),
(36, 'Active In Service', '6707dc04e99862.44989633.jpg', '57976', 'L/CPL', 'Richmond  Agyei Yeboah ', 'Male', 'CTD', '0505204123', 'Agyeiyeboah123@gmail.com', '2026-03-11 11:38:56', 0),
(37, 'Active In Service', '67095ae1ebd535.45336542.jpg', '56462', 'L/CPL', 'Maxwel  Darko ', 'Male', 'CTD', '0241271891', 'darkomaxwrll@gmail.com', '2024-10-24 20:53:37', 0),
(38, 'Transferred', '67095c08ceab31.21111925.jpg', '46462', 'SGT', 'Simon Bryan  Tibila ', 'Male', 'CTD', '0241084244', 'simontbryan.stb@gmail.com', '2026-03-24 15:44:10', 0),
(39, 'Active In Service', '67095d077b5231.06692709.jpg', '53616 ', 'CPL', 'Richard  Asare', 'Male', 'CTD', '0247966351', 'asarevuga41@gmail.com', '2026-03-11 13:07:43', 0),
(40, 'Active In Service', '67095e65d81f22.13401100.jpg', '58604', 'L/CPL', 'Richard  Ntiamoah', 'Male', 'CTD', '0242586566', 'richntiamoah07@gmail.com', '2026-03-11 11:39:15', 0),
(41, 'Active In Service', '67095f75266453.32938529.jpg', '55068', 'CPL', 'Anthony Darko ', 'Male', 'CTD', '0247041041', 'tonydarko31@gmail.com', '2026-03-11 17:47:39', 0),
(42, 'Active In Service', '670969b38c1b62.57633076.jpg', '51727', 'SGT', 'Gyamfi Adu ', 'Male', 'CTD', '0243564537', 'soldiersoldierss674@gmail.com', '2026-03-11 12:17:33', 0),
(43, 'Active In Service', '67096b307bc127.62073914.jpg', '54296', 'CPL', 'Thomas Abu', 'Male', 'CTD', '0244060406', 'nanaabu156@gmail.com', '2026-03-11 17:41:37', 0),
(44, 'Active In Service', '67096c20261ed8.73226717.jpg', '58213', 'L/CPL', 'Abraham  Nkumdow ', 'Male', 'CTD', '0243786382', 'nkumdowa@gmail.com', '2026-03-11 11:39:29', 0),
(45, 'Active In Service', '6709733c1bdde0.34082951.jpg', '', 'INSPR', 'Fred Akafo Sena ', 'Male', 'CTD', '0246264161', 'akafofredsena@gmail.com', '2026-03-24 16:10:47', 0),
(46, 'Active In Service', '670974a6ebcdc9.60476512.jpg', '58239', 'L/CPL', 'Enerst Anim ', 'Male', 'CTD', '0241020547', 'animernerst2646@gmail.com', '2026-03-11 11:39:51', 0),
(47, 'Transferred', '6709770413fd45.59674583.jpg', '57889', 'L/CPL', 'Alhassan Titia ', 'Male', 'CTD', '0243907377', 'titiaalhassan90@gmail.com', '2026-03-24 11:42:50', 0),
(48, 'Active In Service', '670978348f1886.12923791.jpg', '55363', 'L/CPL', 'Eric Acquah', 'Male', 'CTD', '0240339746', 'acquahkojo3@gmail.com', '2026-03-25 11:16:45', 0),
(49, 'Active In Service', '6709794af04955.95178375.jpg', '55103', 'CPL', 'Samuel  Fianko ', 'Male', 'CTD', '0240508231', 'nanadomprehgolgi7449@gmai.com', '2026-03-11 17:51:58', 0),
(50, 'Active In Service', '67097ced866503.04367163.jpg', '54309', 'CPL', 'Yakubu  Abdul Majeed ', 'Male', 'CTD', '044478856', 'abdulmajeedyakubu@gmail.com', '2026-03-11 17:53:11', 0),
(51, 'Active In Service', '670991afc3be08.69093032.jpg', '49665', 'SGT', 'Wilson Agbley Selorm ', 'Male', 'CTD', '024794954799', 'nanayaowilson@gmail.com', '2024-10-24 20:54:30', 0),
(52, 'Active In Service', '6709930ecb00a7.47826854.jpg', '53906', 'CPL', 'Tazang Jonathan', 'Male', 'CTD', '0540116494', 'tansangjn@gmail.com', '2026-03-25 13:35:57', 0),
(53, 'Active In Service', '6709946aaa8ea4.72606989.jpg', '55101', 'CPL', 'Reuben Ayivi ', 'Male', 'CTD', '0542464600', 'reubenselasi19@gmailk.com', '2026-03-11 17:57:42', 0),
(54, 'Active In Service', '6709d347ed8bc6.57513439.jpg', '55933', 'L/CPL', 'Kamaldeen  Awudu', 'Male', 'CTD', '0549269235', 'kamaldeen.999k@gmail.com', '2024-10-24 20:54:58', 0),
(55, 'Active In Service', '670a788174fa91.75312494.jpg', '10569', 'L/CPL', 'Alberta Asieduwaa', 'Male', 'CTD', '0540417582', 'amoakoalberta49@gmail.com', '2026-03-11 11:40:23', 0),
(56, 'Active In Service', '670a7a37a5ed83.64890035.jpg', '10706', 'L/CPL', 'Emelia Akyamaa', 'Female', 'CTD', '0247656515', 'glakpeemelia8@gmail.com', '2024-10-24 20:55:06', 0),
(57, 'Transferred', '670a7b25510500.45378903.jpg', '58443', 'L/CPL', 'David Mpanga Tamanja', 'Male', 'CTD', '0547301280', 'mpangatamanja@gmail.com', '2026-03-24 15:59:43', 0),
(58, 'Active In Service', '670a7c1c5ceac9.61008012.jpg', '58461', 'L/CPL', 'Bismark Kyeremeh ', 'Male', 'CTD', '0556074895', 'kyeremehb82@gmail.com', '2026-03-11 11:40:51', 0),
(59, 'Active In Service', '670a7d13d26c27.84839470.jpg', '10048', 'CPL', 'Elizabet Appiah', 'Female', 'CTD', '0247138046', 'appiaelizabet496@gmail.com', '2026-03-11 17:45:30', 0),
(60, 'Active In Service', '670a7e0a6529a5.53658237.jpg', '53610', 'CPL', 'Foster Asante', 'Male', 'CTD', '0545215780', 'asantefoster720@gmail.com', '2026-03-11 17:58:57', 0),
(62, 'Transferred', '670a851cc27c22.41754167.jpg', '53589', 'CPL', 'Robert Owusu ', 'Male', 'CTD', '0554494169', 'st.owusu9494@gmail.com', '2026-03-24 15:46:49', 0),
(63, 'Active In Service', '670a8715558cb9.30761193.jpg', '58113', 'L/CPL', 'Emmanuel Quarshie Acquah', 'Male', 'CTD', '0549564963', 'flexibee22@gmail.com', '2026-03-11 11:41:02', 0),
(64, 'Active In Service', '670a87ec729e25.33018494.jpg', '48463', 'SGT', 'Selorm Awuku', 'Male', 'CTD', '0246887020', 'selormawuku12@gmail.com', '2026-03-11 12:18:24', 0),
(65, 'Active In Service', '670a8980872d51.88148350.jpg', '54302', 'CPL', 'Wisdom Aglili ', 'Male', 'CTD', '0548117289', 'aglili10@gmail.com', '2026-03-11 18:01:11', 0),
(66, 'Active In Service', '670a8b3005c3e4.93267699.jpg', '58387', 'L/CPL', 'Isaac Owusu Antwi', 'Male', 'CTD', '0243685312', 'paajoe667@gmail.com', '2026-03-11 11:41:16', 0),
(67, 'Active In Service', '670aa6c3e17112.83450091.jpg', '56529', 'L/CPL', 'Braimah  Winitor Amissah ', 'Male', 'CTD', '0546482791', 'winitoramissabraimah@gmail.com', '2024-10-24 20:55:58', 0),
(68, 'Active In Service', '670aa85533dd36.36976861.jpg', '57984', 'L/CPL', 'Isaac Osei Bonsu', 'Male', 'CTD', '0241045801', 'isaacoseibnsu7732@gmail.com', '2026-03-24 16:02:15', 0),
(69, 'Active In Service', '670aab5c426928.37810581.jpg', '58039', 'L/CPL', 'Clement Aryeetey ', 'Male', 'CTD', '0558270613', 'cleair101@gmail.com', '2026-03-11 11:41:40', 0),
(70, 'Active In Service', '670aaea75d7490.66417044.jpg', '56599', 'L/CPL', 'Nicholas Awumbila ', 'Male', 'CTD', '0240670007', 'awumbilanicholas36@gmail.com', '2026-03-24 16:00:51', 0),
(71, 'Active In Service', '670ab0510bdb64.64060199.jpg', '53631', 'CPL', 'Degraft Appiah Kwadwo ', 'Male', 'CTD', '0245745772', 'Degraftappiah18@gmail.com', '2026-03-11 18:02:23', 0),
(72, 'Active In Service', '670ab127615669.03921218.jpg', '56091', 'L/CPL', 'Bright Nkrumah', 'Male', 'CTD', '0241449009', 'Brightnkrumah18@gmail.com', '2024-10-24 20:56:27', 0),
(74, 'Active In Service', '670ab5a24c8953.16320159.jpg', '53671', 'CPL', 'Francis Osei', 'Male', 'CTD', '0550161564', 'oseiy660@gmail.com', '2026-03-11 18:04:03', 0),
(75, 'Active In Service', '670ab6609f0a80.70525852.jpg', '48725', 'SGT', 'Ebenezer Oti ', 'Male', 'CTD', '0245023676', 'Otiebenezer686@gmail.com', '2026-03-11 12:18:51', 0),
(77, 'Active In Service', '670ac0b641edb5.29866001.jpg', '55065', 'CPL', 'Patrick Togobo', 'Male', 'CTD', '0241476070', 'liltyme95@gmail.com', '2026-03-11 18:15:55', 0),
(79, 'Active In Service', '670ac34473f1e2.40200754.jpg', '54664', 'CPL', 'Isaac Obeng ', 'Male', 'CTD', '0248204201', 'obengisaac301@gmail.com', '2026-03-11 18:17:35', 0),
(80, 'Active In Service', '670ac4f0bcb576.09985468.jpg', '56139', 'L/CPL', 'Attuquaye Nii Clottey', 'Male', 'CTD', '0541120424', 'clotteyjoel18@gmail.com', '2024-10-24 20:57:38', 0),
(81, 'Active In Service', '670ac61da09a43.12621180.jpg', '54678', 'CPL', 'Ibrahim Seidu ', 'Male', 'CTD', '0549462670', 'seidu.ibrahim10000@gmail.com', '2026-03-11 18:22:01', 0),
(82, 'Active In Service', '670ac72b992a43.86282595.jpg', '55996', 'L/CPL', 'Isaac Oberko ', 'Male', 'CTD', '0244349008', 'Abilityagyei@gmail.com', '2024-10-24 20:58:04', 0),
(83, 'Active In Service', '670ac852744c44.93605111.jpg', '56297', 'L/CPL', 'Emmanuel Owusu Ntow ', 'Male', 'CTD', '0241245625', 'owusuntow18@gmail.com', '2024-10-24 20:58:09', 0),
(84, 'Active In Service', '670ad384951d08.94188639.jpg', '58339', 'L/CPL', 'Emmanuel Painstsil', 'Male', 'CTD', '0245138073', 'emmanuelpainstsil02@gmail.com', '2026-03-11 11:42:17', 0),
(86, 'Active In Service', '670ad60e995dc5.86438225.jpg', '55864', 'L/CPL', 'Ambrose Lier', 'Male', 'CTD', '0248672121', 'ambroselier21@gmail.com', '2024-10-24 20:58:21', 0),
(87, 'Active In Service', '670ad6ddef2d01.25590632.jpg', '56213', 'L/CPL', 'Peter Adu ', 'Male', 'CTD', '0541614101', 'adupeterr@gmail.com', '2024-10-24 20:58:26', 0),
(88, 'Active In Service', '670ad8e6cea4b1.70198742.jpg', '56337', 'L/CPL', 'Oxford Owusu ', 'Male', 'CTD', '0558341356', 'oxfordgyimah19@gmail.com', '2024-10-24 20:58:30', 0),
(89, 'Active In Service', '670ada05d2f565.68256574.jpg', '58416', 'L/CPL', 'Clement Oteng ', 'Male', 'CTD', '0532371094', 'clementoteng8@gmail.com', '2026-03-11 11:42:29', 0),
(90, 'Active In Service', '670adb5973df83.05469489.jpg', '54668', 'CPL', 'Karim Abass Abdul', 'Male', 'CTD', '0249535523', 'abasskarim321@gmail.com', '2026-03-12 06:46:32', 0),
(91, 'Active In Service', '670adc8a819672.08670500.jpg', '56216', 'L/CPL', 'Emmanuel Annor ', 'Male', 'CTD', '0541383646', 'annoremmanuel063@gmali.com', '2024-10-24 20:58:38', 0),
(92, 'Active In Service', '670addcd1feb23.40568844.jpg', '54312', 'CPL', 'Winfred Afewu ', 'Male', 'CTD', '0507296427', 'yaowinfred78@gmail.com', '2026-03-12 06:24:35', 0),
(93, 'Active In Service', '670adeeb140c29.45500728.jpg', '56062', 'L/CPL', 'James  Akoto Baffour ', 'Male', 'CTD', '0251960417', 'jbafour122@gmail.com', '2026-03-24 16:04:17', 0),
(94, 'Active In Service', '670ae03a4d0604.03854794.jpg', '57935', 'L/CPL', 'Sadique Abubakar ', 'Male', 'CTD', '0552338383', 'abubakarsadique2623@gmail.com', '2026-03-11 11:42:45', 0),
(95, 'Active In Service', '670ae167040ab7.17350822.jpg', '56247', 'L/CPL', 'Daniel Korto', 'Male', 'CTD', '0241699424', 'kortodaniel@gmail.com', '2024-10-24 20:59:03', 0),
(96, 'Active In Service', '670ae245348c63.88837686.jpg', '58487', 'L/CPL', 'Francis Ofori ', 'Male', 'CTD', '0242324278', 'Oforifrancis864@gmasil.com', '2026-03-11 11:43:01', 0),
(97, 'Active In Service', '670ae3a26186c5.95821787.jpg', '54284', 'CPL', 'Tetteh Addo ', 'Male', 'CTD', '0543604447', 'Holysam654@gmail.com', '2026-03-12 06:35:09', 0),
(98, 'Active In Service', '670ae4a224aad6.70461340.jpg', '56014', 'L/CPL', 'Philip Glakpe', 'Male', 'CTD', '0240133404', 'mck777e@gmail.com', '2024-10-24 20:59:14', 0),
(99, 'Active In Service', '670ae607928de3.09545957.jpg', '56350', 'L/CPL', 'Isaac Mensah ', 'Male', 'CTD', '0240204534', 'Christikemenz072@gmail.com', '2024-10-24 20:59:20', 0),
(100, 'Active In Service', '670ae71e96e904.47633737.jpg', '58068', 'L/CPL', 'Magnus Ediem Yankson', 'Male', 'CTD', '0547099126', 'magnusyankson90@gmail.com', '2026-03-11 11:43:13', 0),
(101, 'Active In Service', '670b03f835e4a4.06242592.jpg', '4422', 'C/INSPR', 'Seidu Issah', 'Male', 'CTD', '0244870265', 'seidudollar4@gmail.com', '2026-03-11 11:52:04', 0),
(102, 'Active In Service', '670b05f9101409.52035554.jpg', '54666', 'CPL', 'Emmanuel  Kokwa ', 'Male', 'CTD', '0547092530', 'kokwaemmanuel@gmail.com', '2026-03-12 06:42:42', 0),
(104, 'Active In Service', '670b0b12d75bf7.81499515.jpg', '54253', 'CPL', 'Wisdom  Adzasu', 'Male', 'CTD', '02426501744', 'wisdomonej@gmai.com', '2026-03-12 06:49:57', 0),
(105, 'Active In Service', '670b0e4de89b78.04704670.jpg', '58192', 'L/CPL', 'Ibrahim Abubakari', 'Male', 'CTD', '0209240782', 'iabubakari1994@gmail.com', '2026-03-11 11:43:27', 0),
(106, 'Active In Service', '670b0f642ad830.10357336.jpg', '58414', 'L/CPL', 'Clement  Ofori ', 'Male', 'CTD', '0244599805', 'Oforiclement66@gmail.com', '2026-03-11 11:43:39', 0),
(107, 'Active In Service', '670b109763c445.83896096.jpg', '58578', 'L/CPL', 'Emmanuel Appiah Agyei ', 'Male', 'CTD', '0544697741', 'appiaagyeiemmanuel96@gmail.com', '2026-03-11 11:43:52', 0),
(108, 'Active In Service', '670b1283ce2595.34242330.jpg', '54663', 'CPL', 'Godwill  Kyereme', 'Male', 'CTD', '0543643401', 'godwillkyereme@gmail.com', '2026-03-12 06:51:35', 0),
(109, 'Active In Service', '670d52cc85ef84.62698389.jpg', '53634', 'CPL', 'Junior Asare Isaac', 'Male', 'CTD', '0242343147', 'asareisaac474@gmail.com', '2026-03-12 06:53:03', 0),
(110, 'Transferred', '670da65a50ed80.41477792.jpg', '51977', 'L/CPL', 'Micheal Arlloo', 'Male', 'CTD', '0248259370', 'yawmichealarlloo@gmail.com', '2026-03-24 16:05:42', 0),
(111, 'Active In Service', '670da7cc028bb3.05153100.jpg', '56468', 'L/CPL', 'Mohammed Nkrumah ', 'Male', 'CTD', '0555522171', 'nkrumahmohammed1956@gmail.com', '2024-10-24 21:00:28', 0),
(112, 'Active In Service', '670da935ee7401.13602923.jpg', '58173', 'L/CPL', 'David Gmakikubi Tabil', 'Male', 'CTD', '0543592166', 'tdmgmakikubi12@gmail.com', '2026-03-11 11:44:01', 0),
(113, 'Active In Service', '670daa943fab19.34119200.jpg', '53629', 'CPL', 'Samuel  Asante Antwi ', 'Male', 'CTD', '0548583917', 'samuelantwiasante1992@gmail.com', '2026-03-24 16:06:44', 0),
(114, 'Active In Service', '670e96c98a31a9.37399505.jpg', '57955', 'CPL', 'Mohammed  Laryea Nuredeen ', 'Male', 'CTD', '0557458370', 'Kingnuredeenlaryea@gmail.com', '2026-03-11 11:44:16', 0),
(115, 'Active In Service', '670e9a5707ac50.56725284.jpg', '55932', 'L/CPL', 'Micheal  Antwi George ', 'Male', 'CTD', '0504641395', 'GeargeAntwiMicheal@gmail.com', '2024-10-24 21:00:54', 0),
(116, 'Active In Service', '670e9bca6aa497.94327449.jpg', 'PN28936', 'INSPR', 'Ernerst  Appiah', 'Male', 'CTD', '0244973310', 'ernerstnick310@gmaii.com', '2026-03-12 09:19:47', 0),
(117, 'Transferred', '670e9d362d9503.60323358.jpg', '54675', 'L/CPL', 'Samuel  Owusu ', 'Male', 'CTD', '0248058550', 'getsavioula16@gmail.com', '2026-03-24 16:07:49', 0),
(118, 'Active In Service', '670e9e8f112572.82339985.jpg', '58585', 'L/CPL', 'Williams  Kwoffie ', 'Male', 'CTD', '0591056732', 'WilliamsonKwoffie@gmail.com', '2026-03-11 11:44:28', 0),
(119, 'Active In Service', '670e9ff297ae84.16146429.jpg', '58532 ', 'L/CPL', 'Richard  Ankamah ', 'Male', 'CTD', '0558405524', 'richardankamah222@gmail.com', '2026-03-11 11:44:40', 0),
(120, 'Active In Service', '670ea1955af439.95203150.jpg', '58549', 'L/CPL', 'David  Midzodzi Cudjoe ', 'Male', 'CTD', '0287495827', 'Cudjoedavid74@gmail.com', '2024-10-24 21:01:34', 0),
(121, 'Active In Service', '670ea374472154.55132401.jpg', '47808', 'SGT', 'Bernard Balig ', 'Male', 'CTD', '0546959690', 'bernardbalig@gmail.com', '2026-03-24 15:55:27', 0),
(123, 'Active In Service', '670efdd7079978.67363791.jpg', '56503', 'L/CPL', 'Benjamin  Osei Owusu ', 'Male', 'CTD', '0553369882', 'oseiowusubenjamin22@gmail.com', '2024-10-24 21:01:46', 0),
(124, 'Active In Service', '670f141f8f5cf4.81811940.jpg', '58636', 'L/CPL', 'Collins  Agyei', 'Male', 'CTD', '0541783579', 'temperature467@gmail.com', '2026-03-11 11:44:52', 0),
(125, 'Active In Service', '670fc8b77b4539.14632392.jpg', '58049 ', 'L/CPL', 'Ezekiel  Wayo A. ', 'Male', 'CTD', '0541054160', 'WAYORANKING90@GMAIL.COM', '2026-03-11 11:45:30', 0),
(126, 'Active In Service', '670fc9c0ded073.95799658.jpg', '58431', 'L/CPL', 'Richard  Amankwah ', 'Male', 'CTD', '0244602812', 'RICHARDAMANKWAH2019@GMAIL.COM', '2026-03-11 11:45:42', 0),
(127, 'Active In Service', '670fca9cde93d6.18099682.jpg', '58331 ', 'L/CPL', 'Philip Sakah ', 'Male', 'CTD', '0534957494', 'SAKAH27@GMAIL.COM', '2026-03-11 11:45:50', 0),
(128, 'Active In Service', '670fcb76e29b28.13122470.jpg', '', 'INSPR', 'Peter Owusu Mensah', 'Male', 'CTD', '0542746146', 'PETEROWUSU222@GMAIL.COM', '2026-03-24 15:43:17', 0),
(129, 'Active In Service', '670fcc9348a5e5.56365837.jpg', '53889', 'CPL', 'Fredrick  Owusu Ansah ', 'Male', 'CTD', '0209104547', 'OWUSUANSAHFREDRICK807@GMAIL.COM', '2026-03-11 18:23:48', 0),
(130, 'Active In Service', '670fcdcdc6ae86.95719341.jpg', '55948', 'L/CPL', 'Joe  Nakojah M. ', 'Male', 'CTD', '0558818568', 'NAKOJAH0011@GMAIL.COM', '2024-10-24 21:02:28', 0),
(131, 'Transferred', '670fcef185c541.02107135.jpg', '46896', 'CPL', 'Eugene Odame Debrah', 'Male', 'CTD', '0240233318', 'KOLIKOBAAKO@GTMAIL.COM', '2026-03-24 15:56:20', 0),
(132, 'Active In Service', '670fd0477d9141.75726054.jpg', '', 'INSPR', 'Daniel Kitiaku', 'Male', 'CTD', '0591474939', 'KIKIATUTETTEH@GMAIL.COM', '2026-03-24 16:11:34', 0),
(133, 'Active In Service', '670fd1b2d22ca9.13432080.jpg', '55984', 'L/CPL', 'Kingsford Ansere ', 'Male', 'CTD', '0540780767', 'KINGSFORDANSERE2@GMAIL.COM', '2024-10-24 21:02:40', 0),
(134, 'Transferred', '670fd34369cb21.44909681.jpg', '53890', 'CPL', 'Sampson Otoo', 'Male', 'CTD', '0248307380', 'IDEASOTOO@GMAIL.COM', '2026-03-24 15:57:06', 0),
(135, 'Active In Service', '670fd4b3aee4d9.94687653.jpg', '58306', 'L/CPL', 'Humphrey  Eduah B.', 'Male', 'CTD', '0596876814', 'HUMPHREYNANAEDUAH@GMAIL.COM', '2026-03-11 11:46:12', 0),
(136, 'Active In Service', '670fd610966c88.94983645.jpg', '56493', 'L/CPL', 'Godwin Mensah', 'Male', 'CTD', '0591989567', 'GODWINB13@GMAIL.COM', '2024-10-24 21:03:00', 0),
(137, 'Active In Service', '67102e9ba84e35.21649175.jpg', '11916', 'L/CPL', 'Esther  Agyei ', 'Male', 'CTD', '0244754637', 'adepaagyei40@gmail.com', '2026-03-11 11:46:26', 0),
(138, 'Active In Service', '67105ca5b1ba30.08382331.jpg', '11904', 'L/CPL', 'Nancy Fuseini ', 'Male', 'CTD', '0532598389', 'Nancyfuseini24@gmail.com', '2026-03-11 11:46:46', 0),
(139, 'Active In Service', '67105d576c1de4.91825395.jpg', '56382', 'L/CPL', 'Emmanuel Appau', 'Male', 'CTD', '0453164389', 'EAPPAU17@GMAIL.COM', '2024-10-24 21:03:14', 0),
(140, 'Active In Service', '67105ecf0dce67.96627026.jpg', '58270', 'L/CPL', 'Clinton Boakye Yiadom', 'Male', 'CTD', '0240735757', 'BYIADOM762@GMAIL.COM', '2026-03-11 11:47:01', 0),
(141, 'Active In Service', '67106044468c99.30415501.jpg', '10049', 'CPL', 'Bridgette Asor Anokye', 'Female', 'CTD', '0553626125', 'BRIDGETTE.ANNOKYE@GMAIL.COM', '2026-03-11 17:46:19', 0),
(142, 'Active In Service', '67106242c07bd2.82366560.jpg', '53892', 'CPL', 'Evans Boakye ', 'Male', 'CTD', '0241083650', 'BBOAKYEEVI@GMAIL.COM', '2026-03-12 06:56:54', 0),
(143, 'Active In Service', '6710635aac50c3.80618134.jpg', '58029', 'L/CPL', 'Williams Ansah', 'Male', 'CTD', '0547365406', 'AKWO22@GMAIL.COM', '2026-03-11 11:47:14', 0),
(145, 'Active In Service', '671066be0594f1.65799854.jpg', '58630', 'L/CPL', 'Jacob Agyei', 'Male', 'CTD', '0550798563', 'AGYEIJACOB88@GMAIL.COM', '2026-03-11 11:47:27', 0),
(146, 'Transferred', '671069627df518.15753064.jpg', '58598', 'L/CPL', 'Mankuyali Kofi Dawuni', 'Male', 'CTD', '0247382090', 'MANKUYALID@GMAIL.COM', '2026-03-24 16:09:12', 0),
(1116, 'Active In Service', '69b24df2e50153.09990062.jpg', '65855', 'CONST', 'Bawah Abdul Isumaila ', 'Male', 'CTD', '0246810812', 'michealwonderful22@gmail.com', '2026-05-01 06:13:24', 0),
(1117, 'Active In Service', '69b251142e0b44.85058804.jpg', '67163', 'CONST', 'Jeffery Boakye', 'Male', 'CTD', '0556717311', 'nanighjnrnanighjnr@gmail.com', '2026-03-12 05:37:24', 0),
(1118, 'Active In Service', '69b251f1773cf9.61070979.jpg', '65851', 'CONST', 'Gabriel Ahiable', 'Male', 'CTD', '0552888103', 'xylemgabby5@gmail.com', '2026-03-12 05:41:05', 0),
(1119, 'Active In Service', '69b2597f9064b9.89473236.jpg', '65848', 'CONST', 'Ebenezer Aidoo', 'Male', 'CTD', '0592334730', 'ebenezerbracka93@gmail.com', '2026-03-12 06:13:19', 0),
(1120, 'Active In Service', '69b28705873187.89831585.jpg', '66046', 'CONST', 'Samuel Zogli', 'Male', 'CTD', '0571670027', 'zoglisamuel@gmai.com', '2026-03-12 09:27:33', 0),
(1121, 'Active In Service', '69b28830d5ea93.99641637.jpg', '66138', 'CONST', 'Isaac Appiah', 'Male', 'CTD', '0539293015', 'isaacappiah444@gmail.com', '2026-03-12 09:32:32', 0),
(1122, 'Active In Service', '69b2894147e6f0.79616494.jpg', '66837', 'CONST', 'Francis Atuobi', 'Male', 'CTD', '0557800168', 'francisatuobi62@gmail.com', '2026-03-12 09:37:05', 0),
(1123, 'Active In Service', '69b28aba198b96.79213544.jpg', '65808', 'CONST', 'Prosper Dagadu', 'Male', 'CTD', '0555369540', 'shelterdagadu@gmail.com', '2026-03-12 09:43:22', 0),
(1124, 'Active In Service', '69b2a8b5a0b385.86651086.jpg', '66219', 'CONST', 'Joseph Tannor', 'Male', 'CTD', '0538128270', 'okrahjoseph13@gmail.com', '2026-03-12 11:51:17', 0),
(1125, 'Active In Service', '69b2aa991b1001.24627116.jpg', '15866', 'CONST', 'Patience Issajoulun', 'Female', 'CTD', '0554570883', 'issajolunp@gmail.com', '2026-03-12 11:59:21', 0),
(1126, 'Active In Service', '69b2abc99108b8.01318054.jpg', '65827', 'CONST', 'Raymond Asimah', 'Male', 'CTD', '0248184299', 'raymondasimah@gmail.com', '2026-03-12 12:04:55', 0),
(1127, 'Active In Service', '69b2ae62c20632.37644830.jpg', '66519', 'CONST', 'Eugene Ayirebi Okyere', 'Male', 'CTD', '0508935594', 'eugeneokyere3@gmail.com', '2026-03-12 12:15:30', 0),
(1128, 'Active In Service', '69b2b12bde6fe0.29997882.jpg', '66741', 'CONST', 'Abdulai Sualisu', 'Male', 'CTD', '0246378819', 'abdulaisualisu353@gmail.com', '2026-03-12 12:27:23', 0),
(1129, 'Active In Service', '69b2b2125deac3.56142041.jpg', '15815', 'CONST', 'Nancy Agyei', 'Female', 'CTD', '0532856866', 'agyeinancy6866@gmail.com', '2026-03-12 12:31:14', 0),
(1130, 'Active In Service', '69b2b35c6d4509.23082572.jpg', '67255', 'CONST', 'Rauf Abdul - Rahaman', 'Male', 'CTD', '0549242214', 'raufabinchi@gmail.com', '2026-04-16 06:32:13', 0),
(1131, 'Active In Service', '69b2b489043f43.52712900.jpg', '66792', 'CONST', 'Haruna Abdulai ', 'Male', 'CTD', '0550404432', 'haruna0550404432@gmail.com', '2026-03-12 12:41:45', 0),
(1132, 'Active In Service', '69b2b5740c7629.03560368.jpg', '66060', 'CONST', 'Evans Agyampah', 'Male', 'CTD', '0551034576', 'evansagyampah@gmail.com', '2026-03-12 12:50:01', 0),
(1133, 'Active In Service', '69b2b7397ebdf7.67152389.jpg', '66049', 'CONST', 'Prince Amofah ', 'Male', 'CTD', '0558639069', 'amofahprince2030@icloud.com', '2026-03-12 12:53:13', 0),
(1134, 'Active In Service', '69b2b87e86c893.11790425.jpg', '66598', 'CONST', 'Samuel Kwesi Tawiah', 'Male', 'CTD', '0542372180', 'samuelkwasitawiah1926@gmail.com', '2026-03-12 12:58:38', 0),
(1135, 'Active In Service', '69b2b95193a3d8.56421490.jpg', '67049', 'CONST', 'Awudu Ali', 'Male', 'CTD', '0596153167', 'awuduali055@icloud.com', '2026-03-12 13:02:09', 0),
(1136, 'Active In Service', '69b2baf03834b0.04813811.jpg', '65834', 'CONST', 'Rodney Nii Lantey Lamptey ', 'Male', 'CTD', '0558742835', 'rdnlamptey@gmail.com', '2026-03-12 13:09:04', 0),
(1137, 'Active In Service', '69b2bc524662a2.74163110.jpg', '67234', 'CONST', 'Rahaman Wajack Abdul', 'Male', 'CTD', '0592661926', 'wajackabdulrahaman5@gmail.com', '2026-03-12 13:14:58', 0),
(1138, 'Active In Service', '69b2bd3cb037e5.33126265.jpg', '66307', 'CONST', 'Samuel Adyei Nortey', 'Male', 'CTD', '0209341282', 'makonzidc440@gmail.com', '2026-03-12 13:18:52', 0),
(1139, 'Active In Service', '69b2be2c2a1009.79216770.jpg', '65980', 'CONST', 'Emmanuel Amidini ', 'Male', 'CTD', '0246454723', 'amidiniemmanuel@gmail.com', '2026-03-12 13:22:52', 0),
(1140, 'Active In Service', '69b2bfe98bc695.49146455.jpg', '66394', 'CONST', 'Samuel Laweh Teye ', 'Male', 'CTD', '0538308646', 'samuelteye527@gmail.com', '2026-03-12 13:30:17', 0),
(1141, 'Active In Service', '69b2c14ae3f559.34963057.jpg', '66942', 'CONST', 'Apreku Felix', 'Male', 'CTD', '0553487047', 'aprekufelix4@gmail.com', '2026-03-12 13:36:10', 0),
(1142, 'Active In Service', '69b2c2c1658767.20009656.jpg', '15819', 'CONST', 'Boateng Anna', 'Female', 'CTD', '0247165116', 'Boatenganna1102@gmail.com', '2026-03-12 13:42:25', 0),
(1143, 'Active In Service', '69b2c4191e5091.89079150.jpg', '67271', 'CONST', 'Asuikanlow Mark', 'Male', 'CTD', '0240940792', 'asuikanlowm@gmail.com', '2026-03-12 13:48:09', 0),
(1144, 'Active In Service', '69b2c50a361300.94350811.jpg', '66296', 'CONST', 'Arkoh Ebenezer', 'Male', 'CTD', '0558448315', 'ebenezerarkoh@gmail.com', '2026-03-12 13:52:10', 0),
(1145, 'Active In Service', '69b2cbcdd59f45.56974849.jpg', '66791', 'CONST', 'Assana Abdul Rahman Ganiwu', 'Male', 'CTD', '0599328115', 'abdulrahmanganiwuassana@gmail.com', '2026-03-12 14:21:01', 0),
(1146, 'Active In Service', '69b2cd68e94e54.42744321.jpg', '65917', 'CONST', 'Paul Akrong Quaye', 'Male', 'CTD', '0536568552', 'pquaye378@gmail.com', '2026-03-12 14:27:52', 0),
(1147, 'Active In Service', '69b2d06c19e8a5.62502934.jpg', '67199', 'CONST', 'Sule Yahaya', 'Male', 'CTD', '0547170359', 'yahayasule@gmail.com', '2026-03-12 14:40:44', 0),
(1148, 'Active In Service', '69b2d17a2b8438.44320500.jpg', '67304', 'CONST', 'Baba Osman ', 'Male', 'CTD', '0548072080', 'babaosman1986@gmail.com', '2026-03-12 14:45:14', 0),
(1149, 'Active In Service', '69b2d281d64c82.44534104.jpg', '66670', 'CONST', 'Asubonteng Fredrick', 'Male', 'CTD', '0547481399', 'yawmiles1@gmail.com', '2026-03-12 14:49:37', 0),
(1150, 'Active In Service', '69b2d3fa0e8871.83843518.jpg', '65839', 'CONST', 'Felix Addison Adu', 'Male', 'CTD', '0256379156', 'felixaduaddison@gmail.com', '2026-03-12 14:55:54', 0),
(1151, 'Active In Service', '69b2f8a91edce0.97653095.jpg', '66458', 'CONST', 'Anefor Williams', 'Male', 'CTD', '0599288161', 'williamsaneforkhiss70@gmail.com', '2026-03-12 17:32:25', 0),
(1152, 'Active In Service', '69b2fc8cb94e66.84077538.jpg', '15994', 'CONST', 'Bafanayah Dennis Helena ', 'Female', 'CTD', '0203722939', 'hbafanayah@gmail.com', '2026-03-12 17:49:00', 0),
(1153, 'Active In Service', '69b2fdc92e8410.97623710.jpg', '15860', 'CONST', 'Akortia Ursula Arthur', 'Female', 'CTD', '0538025083', 'arthurursula060@gmail.com', '2026-03-12 17:54:17', 0),
(1154, 'Active In Service', '69b3baf9d62454.47629496.jpg', 'PN26827', 'INSPR', 'Asamoah Frank', 'Male', 'CTD', '0241696977', 'asamoahf18@gmail.com', '2026-03-13 07:21:29', 0),
(1155, 'Active In Service', '69b3c9592099d1.82925269.jpg', '67232', 'CONST', 'Seth Woolley', 'Male', 'CTD', '0243822471', 'woollieseth71@gmail.com', '2026-03-13 08:22:49', 0),
(1156, 'Active In Service', '69b3cb1a952059.88393048.jpg', '66407', 'CONST', 'Obeng Joseph Konadu', 'Male', 'CTD', '0547042526', 'obengkonadujoseph@gmail.com', '2026-03-13 08:30:18', 0),
(1157, 'Active In Service', '69b3cd18cfe4f4.37406090.jpg', '66022', 'CONST', 'Ampomah Emmanuel Anyan', 'Male', 'CTD', '0556834853', 'Ampomaanyan@gmail.com', '2026-03-13 08:38:48', 0),
(1158, 'Active In Service', '69b3d189ebcde0.37827881.jpg', '66461', 'CONST', 'Terkpertey Samuel Sappor', 'Male', 'CTD', '0243872876', 'kwameopinion2@gmail.com', '2026-03-13 08:57:45', 0),
(1159, 'Active In Service', '69b42921a9f0b9.40916173.jpg', '61265', 'CONST', 'Fawaz Iddriss', 'Male', 'CTD', '0559917174', 'fawazabdulmugees@gmail.com', '2026-03-13 15:11:29', 0),
(1160, 'Active In Service', '69b42aa1ef4329.51153481.jpg', '66124', 'CONST', 'Osei Bismark', 'Male', 'CTD', '0597763537', 'oseibis106@gmail.com', '2026-03-13 15:17:53', 0),
(1161, 'Active In Service', '69b442eed55d23.65814209.jpg', '67156', 'CONST', 'Tenadu Asiedu', 'Male', 'CTD', '0554260760', 'tenadu3310@icloud.com', '2026-03-13 17:01:34', 0),
(1162, 'Active In Service', '69b550add89769.58634026.jpg', '66500', 'CONST', 'Yakubu Amadu', 'Male', 'CTD', '0555711002', 'amaduy@gmail.com', '2026-03-14 12:12:29', 0),
(1163, 'Active', '69bce289990f39.37091879.jpg', '66769', 'CONST', 'Yankyera Thomas', 'Male', 'CTD', '0558492095', 'yankyerathomas23@gmail.com', '2026-03-20 06:00:41', 0),
(1164, 'Active', '69bce39d3b06a5.99956353.jpg', '15769', 'CONST', 'Asante Jessica Afful ', 'Female', 'CTD', '0244510656', 'jessicaasante74@gmail.com', '2026-03-20 06:05:17', 0),
(1165, 'Active', '69bd84a0a80689.68502703.jpg', '67007', 'CONST', 'Reuben Asumah', 'Male', 'CTD', '0542587059', 'reubenasumah01@gmail.com', '2026-03-20 17:32:16', 0),
(1168, 'Active', '69c3a7c099b0e9.68472705.jpg', '49742', 'SGT', 'Edward Ayendago', 'Male', 'CTD', '0246628571', 'Ayendagoedward3@gmail.com', '2026-03-25 09:15:44', 0),
(1169, 'Active', '69c3a9b8581cc8.62015692.jpg', '27086', 'INSPR', 'Frank Marful', 'Male', 'CTD', '0548285999', 'frankmarful84@gmail.com', '2026-03-25 09:25:07', 0),
(1170, 'Active', '69c3aa91cf7eb5.81512693.png', '55097', 'CPL', 'Emmanuel Aboagye', 'Male', 'CTD', '0242904539', 'blackprophet1985@gmail.com', '2026-03-25 09:27:45', 0),
(1171, 'Active', '69c3ac439acf70.08104489.jpg', '58271', 'L/CPL', 'A. Prosper Kwakye', 'Male', 'CTD', '0243606763', 'aprosper405@gmail.com', '2026-03-25 09:34:59', 0),
(1172, 'Active', '69c3ad1c7201f8.79338066.jpg', '58197', 'L/CPL', 'George Ankomah', 'Male', 'CTD', '0559964341', 'Georgeankomah020@gmail.com', '2026-03-25 09:38:36', 0),
(1173, 'Active', '69c3ae9b2ce9e9.79018434.jpg', '54287', 'CPL', 'Fatawo A. Braimah', 'Male', 'CTD', '0542474114', 'Nanababraimah44@gmail.com', '2026-03-25 10:54:32', 0),
(1174, 'Active', '69c3bbce7f7977.71041849.jpg', '58427', 'L/CPL', 'Jacob Badu', 'Male', 'CTD', '0247703756', 'Jacobamonbadu7@gmail.com', '2026-03-25 10:41:18', 0),
(1175, 'Active', '69c3bced7d1868.43486601.jpg', '56138', 'L/CPL', 'Quayson Eric Asare', 'Male', 'CTD', '0240855167', 'nanaqwame.kawbell@gmail.com', '2026-03-25 10:46:05', 0),
(1176, 'Active', '69c3be922ec201.47863688.png', '55212', 'CPL', ' Paul Fosu Brobbey', 'Male', 'CTD', '0545491866', 'Paulfosubrobbey720@gmaii.com', '2026-03-25 10:53:53', 0),
(1177, 'Active', '69c3c7211d6974.48505792.png', '48825', 'SGT', 'Godfred Zanu', 'Male', 'CTD', '0245178034', 'zanufred@yahoo.com', '2026-03-25 11:29:37', 0),
(1178, 'Active', '69c3e1b9194382.02045786.jpg', '55928', 'L/CPL', 'Mathias Bature ', 'Male', 'CTD', '0248240420', 'batuuremathias49@gmail.com', '2026-03-25 13:23:05', 0),
(1179, 'Active', '69c3e23a112e60.03991408.jpg', '54307', 'CPL', 'Joseph Otu Odonkor', 'Male', 'CTD', '0241716850', 'niiotuu75@gmail.com', '2026-03-25 13:25:14', 0),
(1180, 'Active', '69c3e2a5125c49.34994302.jpg', '54658', 'CPL', 'Albert Cliff Koomson', 'Male', 'CTD', '0546167396', 'ackoomson@gmail.com', '2026-03-25 13:27:01', 0),
(1181, 'Active', '69c3f2a8571a26.20419835.jpg', '57816', 'L/CPL', 'Simon Obeng', 'Male', 'CTD', '0245634560', 'simonobeng@gmail.com', '2026-03-25 14:35:20', 0),
(1182, 'Active', '69c3fe3c5bfaa4.08886840.jpg', '11762', 'L/CPL', 'Patience Cobbinah', 'Female', 'CTD', '0249623271', 'emeldapcobbinah01@gmail.com', '2026-03-25 15:24:44', 0),
(1183, 'Active', '69c3ff72b9bd51.03282168.jpg', '56390', 'L/CPL', 'Yakubu Musah', 'Male', 'CTD', '0249359176', 'everyoungmusahgafaru.mag@gmail.com', '2026-03-25 15:29:54', 0),
(1184, 'Active', '69c4179793acc6.76574488.png', '58459', 'L/CPL', 'Lawrence Acheampong', 'Male', 'CTD', '0241752325', 'lawrencejay19@yahoo.com', '2026-03-25 17:12:55', 0),
(1185, 'Active', '69c41825edcc14.61652171.jpg', '56082', 'L/CPL', 'Frank Asamoah Appeakorang', 'Male', 'CTD', '0240576031', 'frankasamoahapeakorang@gmail.com', '2026-03-25 17:15:17', 0),
(1186, 'Active', '69c418c96b4ec6.93227738.jpg', '58499', 'L/CPL', 'Alexander Owusu', 'Male', 'CTD', '0248818745', 'Alowusu47@gmail.com', '2026-03-25 17:18:01', 0),
(1187, 'Active', '69c4cbec24def5.72052878.jpg', '58503', 'L/CPL', 'Clinton Marfo', 'Male', 'CTD', '0548030754', 'Marfoclintonyaw@gmail.com', '2026-03-26 06:02:20', 0),
(1188, 'Active', '69c4cc9c92ed24.40038970.jpg', '58488', 'L/CPL', 'Nelson Prince Asare', 'Male', 'CTD', '0245800557', 'Asarenelson1999@gmail.com', '2026-03-26 06:05:16', 0),
(1189, 'Active', '69c511ca1873b3.76233401.jpg', '58533', 'L/CPL', 'Darko William Ampem', 'Male', 'CTD', '0548815986', 'Williamdarko327@gmail.com', '2026-03-26 11:00:26', 0),
(1190, 'Active', '69c5125608d7e1.61040660.jpg', '58249', 'L/CPL', 'Evans Ofosu', 'Male', 'CTD', '0546396899', 'ofosuevans6@gmail.com', '2026-03-26 11:02:46', 0),
(1191, 'Active', '69c8da3e8de570.88509270.jpg', '53635', 'CPL', 'Benjamin Fevlo', 'Male', 'CTD', '0246182649', 'fevlobenjamin@gmail.com', '2026-03-29 07:52:30', 0),
(1192, 'Active', '69c8daed8f25d9.41154386.jpg', 'PN', 'INSPR', 'Stephen Nyavor', 'Male', 'CTD', '0245933521', 'Steveposi6@gmail.com', '2026-03-29 07:55:25', 0),
(1193, 'Active', '69c8db9010cc79.91548550.jpg', '56208', 'L/CPL', 'John Tawiah', 'Male', 'CTD', '0241801900', 'johntawiah280@gmail.com', '2026-03-29 07:58:08', 0),
(1194, 'Active', '69c9aac0bd6f59.62327774.jpg', '56277', 'L/CPL', 'Benjamin Antwi-Kusi', 'Male', 'CTD', '0241105215', 'benjaminantwikusi@gmail.com', '2026-03-29 22:42:08', 0),
(1196, 'Active', '69e31f9a5b5769.06168966.jpg', '55104', 'CPL', 'Samuel Opoku', 'Male', 'CTD', '0249737363', 'opokusamuel334@gmail.com', '2026-04-18 06:07:22', 0);

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
(153, 'Active In Service', '671069627df518.15753064.jpg', '58598', 'CONST', 'Mankuyali Kofi Dawuni', 'Male', 'CTD', '0247382090', 'MANKUYALID@GMAIL.COM', '2024-10-17 01:33:22'),
(154, 'Active In Service', '69b24df2e50153.09990062.jpg', '66855', 'CONST', 'Bawah Abdul Isumaila ', 'Male', 'CTD', '0246810812', 'michealwonderful22@gmail.com', '2026-03-12 05:24:02'),
(155, 'Active In Service', '69b251142e0b44.85058804.jpg', '67163', 'CONST', 'Jeffery Boakye', 'Male', 'CTD', '0556717311', 'nanighjnrnanighjnr@gmail.com', '2026-03-12 05:37:24'),
(156, 'Active In Service', '69b251f1773cf9.61070979.jpg', '65851', 'CONST', 'Gabriel Ahiable', 'Male', 'CTD', '0552888103', 'xylemgabby5@gmail.com', '2026-03-12 05:41:05'),
(157, 'Active In Service', '69b2597f9064b9.89473236.jpg', '65848', 'CONST', 'Ebenezer Aidoo', 'Male', 'CTD', '0592334730', 'ebenezerbracka93@gmail.com', '2026-03-12 06:13:19'),
(158, 'Active In Service', '69b28705873187.89831585.jpg', '66046', 'CONST', 'Samuel Zogli', 'Male', 'CTD', '0571670027', 'zoglisamuel@gmai.com', '2026-03-12 09:27:33'),
(159, 'Active In Service', '69b28830d5ea93.99641637.jpg', '66138', 'CONST', 'Isaac Appiah', 'Male', 'CTD', '0539293015', 'isaacappiah444@gmail.com', '2026-03-12 09:32:32'),
(160, 'Active In Service', '69b2894147e6f0.79616494.jpg', '66837', 'CONST', 'Francis Atuobi', 'Male', 'CTD', '0557800168', 'francisatuobi62@gmail.com', '2026-03-12 09:37:05'),
(161, 'Active In Service', '69b28aba198b96.79213544.jpg', '65808', 'CONST', 'Prosper Dagadu', 'Male', 'CTD', '0555369540', 'shelterdagadu@gmail.com', '2026-03-12 09:43:22'),
(162, 'Active In Service', '69b2a8b5a0b385.86651086.jpg', '66219', 'CONST', 'Joseph Tannor', 'Male', 'CTD', '0538128270', 'okrahjoseph13@gmail.com', '2026-03-12 11:51:17'),
(163, 'Active In Service', '69b2aa991b1001.24627116.jpg', '15866', 'CONST', 'Patience Issajoulun', 'Female', 'CTD', '0554570883', 'issajolunp@gmail.com', '2026-03-12 11:59:21'),
(164, 'Active In Service', '69b2abc99108b8.01318054.jpg', '65827', 'CONST', 'Raymond Asimah', 'Male', 'NVU', '0248184299', 'raymondasimah@gmail.com', '2026-03-12 12:04:25'),
(165, 'Active In Service', '69b2ae62c20632.37644830.jpg', '66519', 'CONST', 'Eugene Ayirebi Okyere', 'Male', 'CTD', '0508935594', 'eugeneokyere3@gmail.com', '2026-03-12 12:15:30'),
(166, 'Active In Service', '69b2b12bde6fe0.29997882.jpg', '66741', 'CONST', 'Abdulai Sualisu', 'Male', 'CTD', '0246378819', 'abdulaisualisu353@gmail.com', '2026-03-12 12:27:23'),
(167, 'Active In Service', '69b2b2125deac3.56142041.jpg', '15815', 'CONST', 'Nancy Agyei', 'Female', 'CTD', '0532856866', 'agyeinancy6866@gmail.com', '2026-03-12 12:31:14'),
(168, 'Active In Service', '69b2b35c6d4509.23082572.jpg', '67255', 'CONST', 'Abdul Rauf Abdul Rahaman', 'Male', 'CTD', '0549242214', 'raufabinchi@gmail.com', '2026-03-12 12:36:44'),
(169, 'Active In Service', '69b2b489043f43.52712900.jpg', '66792', 'CONST', 'Haruna Abdulai ', 'Male', 'CTD', '0550404432', 'haruna0550404432@gmail.com', '2026-03-12 12:41:45'),
(170, 'Active In Service', '69b2b5740c7629.03560368.jpg', '66060', 'CONST', 'Evans Agyampah', 'Male', 'CTD', '0551034576', 'EVANSAGYAMPAH@GMAIL.COM', '2026-03-12 12:45:40'),
(171, 'Active In Service', '69b2b7397ebdf7.67152389.jpg', '66049', 'CONST', 'Prince Amofah ', 'Male', 'CTD', '0558639069', 'amofahprince2030@icloud.com', '2026-03-12 12:53:13'),
(172, 'Active In Service', '69b2b87e86c893.11790425.jpg', '66598', 'CONST', 'Samuel Kwesi Tawiah', 'Male', 'CTD', '0542372180', 'samuelkwasitawiah1926@gmail.com', '2026-03-12 12:58:38'),
(173, 'Active In Service', '69b2b95193a3d8.56421490.jpg', '67049', 'CONST', 'Awudu Ali', 'Male', 'CTD', '0596153167', 'awuduali055@icloud.com', '2026-03-12 13:02:09'),
(174, 'Active In Service', '69b2baf03834b0.04813811.jpg', '65834', 'CONST', 'Rodney Nii Lantey Lamptey ', 'Male', 'CTD', '0558742835', 'rdnlamptey@gmail.com', '2026-03-12 13:09:04'),
(175, 'Active In Service', '69b2bc524662a2.74163110.jpg', '67234', 'CONST', 'Rahaman Wajack Abdul', 'Male', 'CTD', '0592661926', 'wajackabdulrahaman5@gmail.com', '2026-03-12 13:14:58'),
(176, 'Active In Service', '69b2bd3cb037e5.33126265.jpg', '66307', 'CONST', 'Samuel Adyei Nortey', 'Male', 'CTD', '0209341282', 'makonzidc440@gmail.com', '2026-03-12 13:18:52'),
(177, 'Active In Service', '69b2be2c2a1009.79216770.jpg', '65980', 'CONST', 'Emmanuel Amidini ', 'Male', 'CTD', '0246454723', 'amidiniemmanuel@gmail.com', '2026-03-12 13:22:52'),
(178, 'Active In Service', '69b2bfe98bc695.49146455.jpg', '66394', 'CONST', 'Samuel Laweh Teye ', 'Male', 'CTD', '0538308646', 'samuelteye527@gmail.com', '2026-03-12 13:30:17'),
(179, 'Active In Service', '69b2c14ae3f559.34963057.jpg', '66942', 'CONST', 'Apreku Felix', 'Male', 'CTD', '0553487047', 'aprekufelix4@gmail.com', '2026-03-12 13:36:10'),
(180, 'Active In Service', '69b2c2c1658767.20009656.jpg', '15819', 'CONST', 'Boateng Anna', 'Female', 'CTD', '0247165116', 'Boatenganna1102@gmail.com', '2026-03-12 13:42:25'),
(181, 'Active In Service', '69b2c4191e5091.89079150.jpg', '67271', 'CONST', 'Asuikanlow Mark', 'Male', 'CTD', '0240940792', 'asuikanlowm@gmail.com', '2026-03-12 13:48:09'),
(182, 'Active In Service', '69b2c50a361300.94350811.jpg', '66296', 'CONST', 'Arkoh Ebenezer', 'Male', 'CTD', '0558448315', 'ebenezerarkoh@gmail.com', '2026-03-12 13:52:10'),
(183, 'Active In Service', '69b2cbcdd59f45.56974849.jpg', '66791', 'CONST', 'Assana Abdul Rahman Ganiwu', 'Male', 'CTD', '0599328115', 'abdulrahmanganiwuassana@gmail.com', '2026-03-12 14:21:01'),
(184, 'Active In Service', '69b2cd68e94e54.42744321.jpg', '65917', 'CONST', 'Paul Akrong Quaye', 'Male', 'CTD', '0536568552', 'pquaye378@gmail.com', '2026-03-12 14:27:52'),
(185, 'Active In Service', '69b2d06c19e8a5.62502934.jpg', '67199', 'CONST', 'Sule Yahaya', 'Male', 'CTD', '0547170359', 'yahayasule@gmail.com', '2026-03-12 14:40:44'),
(186, 'Active In Service', '69b2d17a2b8438.44320500.jpg', '67304', 'CONST', 'Baba Osman ', 'Male', 'CTD', '0548072080', 'babaosman1986@gmail.com', '2026-03-12 14:45:14'),
(187, 'Active In Service', '69b2d281d64c82.44534104.jpg', '66670', 'CONST', 'Asubonteng Fredrick', 'Male', 'CTD', '0547481399', 'yawmiles1@gmail.com', '2026-03-12 14:49:37'),
(188, 'Active In Service', '69b2d3fa0e8871.83843518.jpg', '65839', 'CONST', 'Felix Addison Adu', 'Male', 'CTD', '0256379156', 'felixaduaddison@gmail.com', '2026-03-12 14:55:54'),
(189, 'Active In Service', '69b2f8a91edce0.97653095.jpg', '66458', 'CONST', 'Anefor Williams', 'Male', 'CTD', '0599288161', 'williamsaneforkhiss70@gmail.com', '2026-03-12 17:32:25'),
(190, 'Active In Service', '69b2fc8cb94e66.84077538.jpg', '15994', 'CONST', 'Bafanayah Dennis Helena ', 'Female', 'CTD', '0203722939', 'hbafanayah@gmail.com', '2026-03-12 17:49:00'),
(191, 'Active In Service', '69b2fdc92e8410.97623710.jpg', '15860', 'CONST', 'Akortia Ursula Arthur', 'Female', 'CTD', '0538025083', 'arthurursula060@gmail.com', '2026-03-12 17:54:17'),
(192, 'Active In Service', '69b3baf9d62454.47629496.jpg', 'PN26827', 'INSPR', 'Asamoah Frank', 'Male', 'CTD', '0241696977', 'asamoahf18@gmail.com', '2026-03-13 07:21:29'),
(193, 'Active In Service', '69b3c9592099d1.82925269.jpg', '67232', 'CONST', 'Seth Woolley', 'Male', 'CTD', '0243822471', 'woollieseth71@gmail.com', '2026-03-13 08:22:49'),
(194, 'Active In Service', '69b3cb1a952059.88393048.jpg', '66407', 'CONST', 'Obeng Joseph Konadu', 'Male', 'CTD', '0547042526', 'obengkonadujoseph@gmail.com', '2026-03-13 08:30:18'),
(195, 'Active In Service', '69b3cd18cfe4f4.37406090.jpg', '66022', 'CONST', 'Ampomah Emmanuel Anyan', 'Male', 'CTD', '0556834853', 'Ampomaanyan@gmail.com', '2026-03-13 08:38:48'),
(196, 'Active In Service', '69b3d189ebcde0.37827881.jpg', '66461', 'CONST', 'Terkpertey Samuel Sappor', 'Male', 'CTD', '0243872876', 'kwameopinion2@gmail.com', '2026-03-13 08:57:45'),
(197, 'Active In Service', '69b42921a9f0b9.40916173.jpg', '61265', 'CONST', 'Fawaz Iddriss', 'Male', 'CTD', '0559917174', 'fawazabdulmugees@gmail.com', '2026-03-13 15:11:29'),
(198, 'Active In Service', '69b42aa1ef4329.51153481.jpg', '66124', 'CONST', 'Osei Bismark', 'Male', 'CTD', '0597763537', 'oseibis106@gmail.com', '2026-03-13 15:17:53'),
(199, 'Active In Service', '69b442eed55d23.65814209.jpg', '67156', 'CONST', 'Tenadu Asiedu', 'Male', 'CTD', '0554260760', 'tenadu3310@icloud.com', '2026-03-13 17:01:34'),
(200, 'Active In Service', '69b550add89769.58634026.jpg', '66500', 'CONST', 'Yakubu Amadu', 'Male', 'CTD', '0555711002', 'amaduy@gmail.com', '2026-03-14 12:12:29'),
(201, 'Active', '69bce289990f39.37091879.jpg', '66769', 'CONST', 'Yankyera Thomas', 'Male', 'CTD', '0558492095', 'yankyerathomas23@gmail.com', '2026-03-20 06:00:41'),
(202, 'Active', '69bce39d3b06a5.99956353.jpg', '15769', 'CONST', 'Asante Jessica Afful ', 'Female', 'CTD', '0244510656', 'jessicaasante74@gmail.com', '2026-03-20 06:05:17'),
(203, 'Active', '69bd84a0a80689.68502703.jpg', '67007', 'CONST', 'Reuben Asumah', 'Male', 'CTD', '0542587059', 'reubenasumah01@gmail.com', '2026-03-20 17:32:16'),
(204, 'Active', '69c38834ba6b50.29334719.jpg', '56082', 'L/CPL', 'Frank Asamoah Appeakorang', 'Male', 'CTD', '0240576031', 'frankasamoahapeakorang@gmail.com', '2026-03-25 07:01:08'),
(205, 'Active', '69c38c2ea01995.01356689.png', '58459', 'L/CPL', 'Lawrence Acheampong', 'Male', 'CTD', '0241752325', 'lawrencejay19@yahoo.com', '2026-03-25 07:18:06'),
(206, 'Active', '69c3a7c099b0e9.68472705.jpg', '49742', 'SGT', 'Edward Ayendago', 'Male', 'CTD', '0246628571', 'Ayendagoedward3@gmail.com', '2026-03-25 09:15:44'),
(207, 'Active', '69c3a9b8581cc8.62015692.jpg', 'Pn', 'INSPR', 'Frank Marful', 'Male', 'CTD', '0548285999', 'frankmarful84@gmail.com', '2026-03-25 09:24:08'),
(208, 'Active', '69c3aa91cf7eb5.81512693.png', '55097', 'CPL', 'Emmanuel Aboagye', 'Male', 'CTD', '0242904539', 'blackprophet1985@gmail.com', '2026-03-25 09:27:45'),
(209, 'Active', '69c3ac439acf70.08104489.jpg', '58271', 'L/CPL', 'A. Prosper Kwakye', 'Male', 'CTD', '0243606763', 'aprosper405@gmail.com', '2026-03-25 09:34:59'),
(210, 'Active', '69c3ad1c7201f8.79338066.jpg', '58197', 'L/CPL', 'George Ankomah', 'Male', 'CTD', '0559964341', 'Georgeankomah020@gmail.com', '2026-03-25 09:38:36'),
(211, 'Active', '69c3ae9b2ce9e9.79018434.jpg', '54287', 'CPL', 'A. Fatawo Braimah', 'Male', 'CTD', '0542474114', 'Nanababraimah44@gmail.com', '2026-03-25 09:44:59'),
(212, 'Active', '69c3bbce7f7977.71041849.jpg', '58427', 'L/CPL', 'Jacob Badu', 'Male', 'CTD', '0247703756', 'Jacobamonbadu7@gmail.com', '2026-03-25 10:41:18'),
(213, 'Active', '69c3bced7d1868.43486601.jpg', '56138', 'L/CPL', 'Quayson Eric Asare', 'Male', 'CTD', '0240855167', 'nanaqwame.kawbell@gmail.com', '2026-03-25 10:46:05'),
(214, 'Active', '69c3be922ec201.47863688.png', '55212', 'CPL', 'Fosu Paul Brobbey', 'Male', 'CTD', '0545491866', 'Paulfosubrobbey720@gmaii.com', '2026-03-25 10:53:06'),
(215, 'Active', '69c3c7211d6974.48505792.png', '48825', 'SGT', 'Godfred Zanu', 'Male', 'CTD', '0245178034', 'zanufred@yahoo.com', '2026-03-25 11:29:37'),
(216, 'Active', '69c3e1b9194382.02045786.jpg', '55928', 'L/CPL', 'Mathias Bature ', 'Male', 'CTD', '0248240420', 'batuuremathias49@gmail.com', '2026-03-25 13:23:05'),
(217, 'Active', '69c3e23a112e60.03991408.jpg', '54307', 'CPL', 'Joseph Otu Odonkor', 'Male', 'CTD', '0241716850', 'niiotuu75@gmail.com', '2026-03-25 13:25:14'),
(218, 'Active', '69c3e2a5125c49.34994302.jpg', '54658', 'CPL', 'Albert Cliff Koomson', 'Male', 'CTD', '0546167396', 'ackoomson@gmail.com', '2026-03-25 13:27:01'),
(219, 'Active', '69c3f2a8571a26.20419835.jpg', '57816', 'L/CPL', 'Simon Obeng', 'Male', 'CTD', '0245634560', 'simonobeng@gmail.com', '2026-03-25 14:35:20'),
(220, 'Active', '69c3fe3c5bfaa4.08886840.jpg', '11762', 'L/CPL', 'Patience Cobbinah', 'Female', 'CTD', '0249623271', 'emeldapcobbinah01@gmail.com', '2026-03-25 15:24:44'),
(221, 'Active', '69c3ff72b9bd51.03282168.jpg', '56390', 'L/CPL', 'Yakubu Musah', 'Male', 'CTD', '0249359176', 'everyoungmusahgafaru.mag@gmail.com', '2026-03-25 15:29:54'),
(222, 'Active', '69c4179793acc6.76574488.png', '58459', 'L/CPL', 'Lawrence Acheampong', 'Male', 'CTD', '0241752325', 'lawrencejay19@yahoo.com', '2026-03-25 17:12:55'),
(223, 'Active', '69c41825edcc14.61652171.jpg', '56082', 'L/CPL', 'Frank Asamoah Appeakorang', 'Male', 'CTD', '0240576031', 'frankasamoahapeakorang@gmail.com', '2026-03-25 17:15:17'),
(224, 'Active', '69c418c96b4ec6.93227738.jpg', '58499', 'L/CPL', 'Alexander Owusu', 'Male', 'CTD', '0248818745', 'Alowusu47@gmail.com', '2026-03-25 17:18:01'),
(225, 'Active', '69c4cbec24def5.72052878.jpg', '58503', 'L/CPL', 'Clinton Marfo', 'Male', 'CTD', '0548030754', 'Marfoclintonyaw@gmail.com', '2026-03-26 06:02:20'),
(226, 'Active', '69c4cc9c92ed24.40038970.jpg', '58488', 'L/CPL', 'Nelson Prince Asare', 'Male', 'CTD', '0245800557', 'Asarenelson1999@gmail.com', '2026-03-26 06:05:16'),
(227, 'Active', '69c511ca1873b3.76233401.jpg', '58533', 'L/CPL', 'Darko William Ampem', 'Male', 'CTD', '0548815986', 'Williamdarko327@gmail.com', '2026-03-26 11:00:26'),
(228, 'Active', '69c5125608d7e1.61040660.jpg', '58249', 'L/CPL', 'Evans Ofosu', 'Male', 'CTD', '0546396899', 'ofosuevans6@gmail.com', '2026-03-26 11:02:46'),
(229, 'Active', '69c8da3e8de570.88509270.jpg', '53635', 'CPL', 'Benjamin Fevlo', 'Male', 'CTD', '0246182649', 'fevlobenjamin@gmail.com', '2026-03-29 07:52:30'),
(230, 'Active', '69c8daed8f25d9.41154386.jpg', 'PN', 'INSPR', 'Stephen Nyavor', 'Male', 'CTD', '0245933521', 'Steveposi6@gmail.com', '2026-03-29 07:55:25'),
(231, 'Active', '69c8db9010cc79.91548550.jpg', '56208', 'L/CPL', 'John Tawiah', 'Male', 'CTD', '0241801900', 'johntawiah280@gmail.com', '2026-03-29 07:58:08'),
(232, 'Active', '69c9aac0bd6f59.62327774.jpg', '56277', 'L/CPL', 'Benjamin Antwi-Kusi', 'Male', 'CTD', '0241105215', 'benjaminantwikusi@gmail.com', '2026-03-29 22:42:08'),
(233, 'Active', '69e082268d9ea2.33187317.jpg', '55104', 'CPL', 'Samuel Opoku', 'Male', 'CTD', '0249737363', 'opokusamuel334@gmail.com', '2026-04-16 06:31:02'),
(234, 'Active', '69e31f9a5b5769.06168966.jpg', '55104', 'CPL', 'Samuel Opoku', 'Male', 'CTD', '0249737363', 'opokusamuel334@gmail.com', '2026-04-18 06:07:22');

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
  ADD PRIMARY KEY (`activityID`);

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
-- Indexes for table `firearm_calibers`
--
ALTER TABLE `firearm_calibers`
  ADD PRIMARY KEY (`firearm_caliberID`);

--
-- Indexes for table `firearm_categories`
--
ALTER TABLE `firearm_categories`
  ADD PRIMARY KEY (`firearm_categoryID`);

--
-- Indexes for table `firearm_manufacturers`
--
ALTER TABLE `firearm_manufacturers`
  ADD PRIMARY KEY (`firearm_manufacturerID`);

--
-- Indexes for table `firearm_name`
--
ALTER TABLE `firearm_name`
  ADD PRIMARY KEY (`firearm_nameID`);

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
  MODIFY `adminID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admin_lists2`
--
ALTER TABLE `admin_lists2`
  MODIFY `adminID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ammo_bookings`
--
ALTER TABLE `ammo_bookings`
  MODIFY `book_ammoID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `bookingID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `bookings2`
--
ALTER TABLE `bookings2`
  MODIFY `bookingID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily_activities`
--
ALTER TABLE `daily_activities`
  MODIFY `activityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `firearmID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=577;

--
-- AUTO_INCREMENT for table `firearms2`
--
ALTER TABLE `firearms2`
  MODIFY `firearmID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=571;

--
-- AUTO_INCREMENT for table `firearm_calibers`
--
ALTER TABLE `firearm_calibers`
  MODIFY `firearm_caliberID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `firearm_categories`
--
ALTER TABLE `firearm_categories`
  MODIFY `firearm_categoryID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `firearm_manufacturers`
--
ALTER TABLE `firearm_manufacturers`
  MODIFY `firearm_manufacturerID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `firearm_name`
--
ALTER TABLE `firearm_name`
  MODIFY `firearm_nameID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `login_activity`
--
ALTER TABLE `login_activity`
  MODIFY `loginID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=449;

--
-- AUTO_INCREMENT for table `login_activity2`
--
ALTER TABLE `login_activity2`
  MODIFY `loginID` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logout_activity`
--
ALTER TABLE `logout_activity`
  MODIFY `logoutID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

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
  MODIFY `officerID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1201;

--
-- AUTO_INCREMENT for table `officers2`
--
ALTER TABLE `officers2`
  MODIFY `officerID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
