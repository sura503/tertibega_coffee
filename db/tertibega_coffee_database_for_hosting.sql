-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2025 at 03:19 PM
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
-- Database: `tertibega_coffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `EmployeeID` int(11) NOT NULL,
  `Emp_First_Name` varchar(100) NOT NULL,
  `PhoneNo` int(11) NOT NULL,
  `Position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employeessalary`
--

CREATE TABLE `employeessalary` (
  `Rec_No` int(11) NOT NULL,
  `employeeID` int(11) DEFAULT NULL,
  `Date_of_Payment` date DEFAULT curdate(),
  `Reminder_info` varchar(255) NOT NULL,
  `Salary_Month` varchar(225) NOT NULL,
  `Salary_Year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_tbl`
--

CREATE TABLE `expense_tbl` (
  `Expense_ID` int(11) NOT NULL,
  `Expense_Category` varchar(100) DEFAULT 'other',
  `Prod_Name` varchar(255) NOT NULL,
  `Prod_Unit_Price` double(10,4) DEFAULT NULL,
  `Prod_Total_Price` double(10,4) DEFAULT NULL,
  `Amount` varchar(100) DEFAULT NULL,
  `date_of_rec` timestamp NOT NULL DEFAULT current_timestamp(),
  `remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_user`
--

CREATE TABLE `login_user` (
  `user_id` int(11) NOT NULL,
  `User_Name` varchar(100) NOT NULL,
  `User_Pass` varchar(255) NOT NULL,
  `User_Status` int(11) NOT NULL,
  `Usr_First_Name` varchar(100) NOT NULL,
  `Usr_Last_Name` varchar(100) NOT NULL,
  `Phone_No` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_user`
--

INSERT INTO `login_user` (`user_id`, `User_Name`, `User_Pass`, `User_Status`, `Usr_First_Name`, `Usr_Last_Name`, `Phone_No`) VALUES
(1, 'admin', 'P@ssw0rd', 1000, 'Surafel', 'Setegn', 912656302),
(2, 'sura503', '$2y$10$DGlbt.LxOZoYPr/E4EgJJeSMQEBxKnHfZjPN4.oHIYt.vz6I6uu1S', 1000, 'surafel', 'setegne', 912656302),
(3, 'mikyas', '$2y$10$qgVlfucqmjcFIyoJ4RU2Verh8KaeeaxqfJrNGBxQHozcL5VxodEfy', 1000, 'Mikiyas', 'Gashaw', 913211387);

-- --------------------------------------------------------

--
-- Table structure for table `product_list_rec`
--

CREATE TABLE `product_list_rec` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Product_Type` int(11) NOT NULL DEFAULT 0,
  `Unit_Price` double(10,2) NOT NULL,
  `Catagory` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `Sales_ID` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT 1,
  `ProductID` int(11) DEFAULT NULL,
  `SaleTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `Unit_Price` double(10,4) DEFAULT NULL,
  `TotalAmount` double(10,4) DEFAULT NULL,
  `SaleDate` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `employeessalary`
--
ALTER TABLE `employeessalary`
  ADD PRIMARY KEY (`Rec_No`);

--
-- Indexes for table `expense_tbl`
--
ALTER TABLE `expense_tbl`
  ADD PRIMARY KEY (`Expense_ID`);

--
-- Indexes for table `login_user`
--
ALTER TABLE `login_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `unique_username` (`User_Name`);

--
-- Indexes for table `product_list_rec`
--
ALTER TABLE `product_list_rec`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`Sales_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employeessalary`
--
ALTER TABLE `employeessalary`
  MODIFY `Rec_No` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_tbl`
--
ALTER TABLE `expense_tbl`
  MODIFY `Expense_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_user`
--
ALTER TABLE `login_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_list_rec`
--
ALTER TABLE `product_list_rec`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `Sales_ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
