-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2026 at 11:53 PM
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
-- Database: `land_sales_accounting_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `Commission_ID` int(11) NOT NULL,
  `Sale_ID` int(11) NOT NULL,
  `Staff_ID` int(11) DEFAULT NULL,
  `Commission_Amount` decimal(12,2) DEFAULT NULL,
  `Commission_Date` date DEFAULT NULL,
  `Commission_Status` enum('Paid','Pending') DEFAULT NULL
) ;

--
-- Dumping data for table `commissions`
--

INSERT INTO `commissions` (`Commission_ID`, `Sale_ID`, `Staff_ID`, `Commission_Amount`, `Commission_Date`, `Commission_Status`) VALUES
(1, 1, 10, 500000.00, '2026-05-02', 'Pending'),
(2, 2, 11, 750000.00, '2026-05-03', 'Paid'),
(3, 3, 12, 400000.00, '2026-05-04', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `Expense_ID` int(11) NOT NULL,
  `Expense_Type` enum('Office','Marketing','Transport','Utilities','Others') DEFAULT NULL,
  `Expense_Amount` decimal(12,2) DEFAULT NULL,
  `Expense_Date` date DEFAULT NULL,
  `Description` text DEFAULT NULL
) ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`Expense_ID`, `Expense_Type`, `Expense_Amount`, `Expense_Date`, `Description`) VALUES
(1, 'Office', 500000.00, '2026-05-01', 'Office supplies'),
(2, 'Marketing', 1000000.00, '2026-05-02', 'Social media ads'),
(3, 'Transport', 300000.00, '2026-05-03', 'Site visits');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `Payment_ID` int(11) NOT NULL,
  `Sale_ID` int(11) NOT NULL,
  `Payment_Date` date DEFAULT NULL,
  `Payment_Amount` decimal(12,2) DEFAULT NULL,
  `Payment_Method` enum('Cash','Bank Transfer','Mobile Money') DEFAULT NULL,
  `Receipt_Number` varchar(50) DEFAULT NULL,
  `Transaction_ID` varchar(50) DEFAULT NULL,
  `Payment_Type` enum('Full','Installment') DEFAULT NULL,
  `Installment_Ref_ID` int(11) DEFAULT NULL
) ;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`Payment_ID`, `Sale_ID`, `Payment_Date`, `Payment_Amount`, `Payment_Method`, `Receipt_Number`, `Transaction_ID`, `Payment_Type`, `Installment_Ref_ID`) VALUES
(1, 1, '2026-05-02', 3000000.00, 'Mobile Money', 'RCPT001', 'TXN001', 'Installment', NULL),
(2, 2, '2026-05-03', 5000000.00, 'Bank Transfer', 'RCPT002', 'TXN002', 'Installment', NULL),
(3, 3, '2026-05-04', 8000000.00, 'Cash', 'RCPT003', NULL, 'Full', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `Salary_ID` int(11) NOT NULL,
  `Staff_ID` int(11) DEFAULT NULL,
  `Salary_Amount_Paid` decimal(12,2) DEFAULT NULL,
  `Payment_Date` date DEFAULT NULL,
  `Payment_Status` enum('Paid','Pending') DEFAULT NULL
) ;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`Salary_ID`, `Staff_ID`, `Salary_Amount_Paid`, `Payment_Date`, `Payment_Status`) VALUES
(1, 10, 2000000.00, '2026-05-01', 'Paid'),
(2, 11, 2200000.00, '2026-05-01', 'Paid'),
(3, 12, 1800000.00, '2026-05-01', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `Sale_ID` int(11) NOT NULL,
  `Plot_ID` int(11) DEFAULT NULL,
  `Client_ID` int(11) DEFAULT NULL,
  `Staff_ID` int(11) DEFAULT NULL,
  `Sale_Date` date DEFAULT NULL,
  `Selling_Price` decimal(12,2) DEFAULT NULL,
  `Payment_Status` enum('Fully Paid','Partially Paid','Pending') DEFAULT NULL,
  `Sale_Status` enum('Active','Cancelled') DEFAULT NULL
) ;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`Sale_ID`, `Plot_ID`, `Client_ID`, `Staff_ID`, `Sale_Date`, `Selling_Price`, `Payment_Status`, `Sale_Status`) VALUES
(1, 101, 1, 10, '2026-05-01', 10000000.00, 'Pending', 'Active'),
(2, 102, 2, 11, '2026-05-02', 15000000.00, 'Partially Paid', 'Active'),
(3, 103, 3, 12, '2026-05-03', 8000000.00, 'Fully Paid', 'Active'),
(4, 200, 5, 15, '2026-05-06', 12000000.00, 'Pending', 'Active'),
(5, 200, 5, 15, '2026-05-06', 12000000.00, 'Pending', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `Setting_ID` int(11) NOT NULL,
  `Commission_Percentage` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`Setting_ID`, `Commission_Percentage`) VALUES
(1, 5.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`Commission_ID`),
  ADD UNIQUE KEY `Sale_ID` (`Sale_ID`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`Expense_ID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD UNIQUE KEY `Receipt_Number` (`Receipt_Number`),
  ADD KEY `Sale_ID` (`Sale_ID`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`Salary_ID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`Sale_ID`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`Setting_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `Commission_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `Expense_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `Payment_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `Salary_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `Sale_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `Setting_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commissions`
--
ALTER TABLE `commissions`
  ADD CONSTRAINT `commissions_ibfk_1` FOREIGN KEY (`Sale_ID`) REFERENCES `sales` (`Sale_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`Sale_ID`) REFERENCES `sales` (`Sale_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
