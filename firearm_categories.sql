-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2026 at 08:22 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `firearm_categories`
--
ALTER TABLE `firearm_categories`
  ADD PRIMARY KEY (`firearm_categoryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `firearm_categories`
--
ALTER TABLE `firearm_categories`
  MODIFY `firearm_categoryID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
