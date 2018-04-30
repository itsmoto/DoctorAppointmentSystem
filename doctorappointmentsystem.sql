-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 28, 2018 at 08:14 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;



-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE IF NOT EXISTS `appointment` (
  `appid` int(10) NOT NULL AUTO_INCREMENT,
  `patientid` int(10) NOT NULL,
  `doctorid` int(10) NOT NULL,
  `date` date NOT NULL,
  `time` time(6) NOT NULL,
  `prescription` varchar(500) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`appid`),
  KEY `patientid` (`patientid`),
  KEY `doctorid` (`doctorid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appid`, `patientid`, `doctorid`, `date`, `time`, `prescription`, `status`) VALUES
(1, 6000, 2000, '2018-04-08', '10:00:00.000000', 'Take panadol 2x3', 'completed'),
(37, 6000, 2000, '2018-04-20', '09:00:00.000000', '', 'processing'),
(38, 6000, 2000, '2018-04-20', '12:00:00.000000', '', 'pending'),
(39, 6000, 2000, '2018-04-26', '15:00:00.000000', '', 'processing');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
  `doctorid` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `starttime` time(6) NOT NULL,
  `endtime` time(6) NOT NULL,
  `specialization` varchar(50) NOT NULL,
  PRIMARY KEY (`doctorid`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2001 ;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorid`, `email`, `starttime`, `endtime`, `specialization`) VALUES
(2000, 'doc@app.com', '17:00:00.000000', '18:00:00.000000', 'Dentist');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`email`, `password`, `role`) VALUES
('doc@app.com', 'doc', 'doctor'),
('pat2@app.com', 'pat2', 'patient'),
('pat@app.com', 'pat', 'patient'),
('rec2@app.com', 'rec2', 'receptionist'),
('rec@app.com', 'rec', 'receptionist');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(225) NOT NULL,
  `receiver` varchar(225) NOT NULL,
  `message` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `sender`, `receiver`, `message`, `time`) VALUES
(2, '2000', '6000', 'You have a comment from doctor, kindly check it out', '2018-04-18 18:39:09'),
(3, '3', '6000', 'Your order has been processed, kindly check it out', '2018-04-18 18:52:33'),
(4, '6000', '2000', 'You have a new appointment, kindly check it out', '2018-04-18 19:06:51'),
(5, '6000', '2000', 'You have a new appointment, kindly check it out', '2018-04-18 21:20:09'),
(6, '6000', '2000', 'You have a new appointment, kindly check it out', '2018-04-19 15:26:24'),
(7, '2000', '6000', 'You have a comment from doctor, kindly check it out', '2018-04-19 16:35:08'),
(8, '6000', '2000', 'You have a new appointment, kindly check it out', '2018-04-24 18:20:30'),
(9, '3', '6000', 'Your order has been processed, kindly check it out', '2018-04-26 11:44:41'),
(10, '3', '6000', 'Your order has been processed, kindly check it out', '2018-04-26 11:50:21'),
(11, '3', '6000', 'Your order has been processed, kindly check it out', '2018-04-26 12:01:59'),
(12, '3', '6000', 'Your order has been processed, kindly check it out', '2018-04-26 12:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `patientid` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`patientid`),
  KEY `email` (`email`),
  KEY `email_2` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6001 ;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientid`, `email`) VALUES
(6000, 'pat@app.com');

-- --------------------------------------------------------

--
-- Table structure for table `paymenthistory`
--

CREATE TABLE IF NOT EXISTS `paymenthistory` (
  `paymendid` int(50) NOT NULL AUTO_INCREMENT,
  `appid` int(50) NOT NULL,
  `amount` double DEFAULT NULL,
  PRIMARY KEY (`paymendid`),
  KEY `appid` (`appid`),
  KEY `appid_3` (`appid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `paymenthistory`
--

INSERT INTO `paymenthistory` (`paymendid`, `appid`, `amount`) VALUES
(19, 1, 1200),
(24, 39, 4000);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `email` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `phonenumber` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `streetaddress` varchar(200) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `role` varchar(30) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`email`, `fname`, `lname`, `gender`, `phonenumber`, `dob`, `streetaddress`, `city`, `state`, `pincode`, `role`) VALUES
('doc@app.com', 'Marry', 'Shababi', 'Female', '1234345678', '1997-04-07', '9548 UT North', 'Charlotte', 'NC', '45678', 'doctor'),
('pat2@app.com', 'Musa ', 'Hemedi', 'Male', '2557171452', '2018-04-01', 'Kawe', 'Dar es salaam', '', '', 'patient'),
('pat@app.com', 'Chausiku', 'shaka', 'Female', '1234234234', '1993-05-06', '9678 Ut Drice', 'Charlotte', 'NC', '23145', 'patient'),
('rec2@app.com', 'recema', 'juma', 'Female', '123654789', '2018-04-03', 'bn', 'dar', '', '', 'receptionist'),
('rec@app.com', 'Kimweri', 'Kibori', 'Male', '128765432', '1989-05-06', '2345 United Drive', 'Charlotte', 'NC', '34562', 'receptionist');

-- --------------------------------------------------------

--
-- Table structure for table `receptionist`
--

CREATE TABLE IF NOT EXISTS `receptionist` (
  `receptionid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `shift` varchar(10) NOT NULL,
  PRIMARY KEY (`receptionid`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `receptionist`
--

INSERT INTO `receptionist` (`receptionid`, `email`, `shift`) VALUES
(3, 'rec@app.com', 'night'),
(4, 'rec2@app.com', 'afternoon');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`patientid`) REFERENCES `patient` (`patientid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`doctorid`) REFERENCES `doctor` (`doctorid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`email`) REFERENCES `person` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `emai_fk` FOREIGN KEY (`email`) REFERENCES `person` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patiet_person_FK` FOREIGN KEY (`email`) REFERENCES `person` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paymenthistory`
--
ALTER TABLE `paymenthistory`
  ADD CONSTRAINT `paymenthistory_ibfk_1` FOREIGN KEY (`appid`) REFERENCES `appointment` (`appid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receptionist`
--
ALTER TABLE `receptionist`
  ADD CONSTRAINT `receptionist_ibfk_1` FOREIGN KEY (`email`) REFERENCES `person` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
