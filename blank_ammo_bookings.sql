-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2026 at 05:28 PM
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
-- Table structure for table `blank_ammo_bookings`
--

CREATE TABLE `blank_ammo_bookings` (
  `blank_ammoID` int(11) NOT NULL,
  `officerID` varchar(200) NOT NULL,
  `faulty_ammoID` varchar(100) NOT NULL,
  `armourer_issuer` varchar(500) NOT NULL,
  `officer_image` varchar(500) NOT NULL,
  `to_officer` varchar(500) NOT NULL,
  `booking_time` varchar(200) NOT NULL,
  `faulty_ammo_name` varchar(500) NOT NULL,
  `faulty_ammo_rounds` int(11) NOT NULL,
  `faulty_ammo_returned` int(11) NOT NULL DEFAULT 0,
  `duty_type` varchar(200) NOT NULL,
  `duty_location` varchar(500) NOT NULL,
  `duty_duration` varchar(200) NOT NULL,
  `faulty_ammo_comment` text DEFAULT NULL,
  `faulty_returns_state` varchar(100) NOT NULL DEFAULT 'Not-Return',
  `returned_time` varchar(200) NOT NULL DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blank_ammo_bookings`
--
ALTER TABLE `blank_ammo_bookings`
  ADD PRIMARY KEY (`blank_ammoID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blank_ammo_bookings`
--
ALTER TABLE `blank_ammo_bookings`
  MODIFY `blank_ammoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
