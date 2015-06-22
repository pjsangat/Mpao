-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2015 at 08:03 PM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mpao`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insernewchargesevent`(IN `natureid` INT(11), IN `rentspaceid` INT(11), IN `rateid` INT(11), IN `regnumber` INT(11), IN `regprice` INT(11), IN `sucnumber` INT(11), IN `sucprice` INT(11), IN `aircon` VARCHAR(255))
    NO SQL
Begin


if aircon = 'Yes' then

SET @aircon = (SELECT true from charges_eventtype where rent_spaceid =  rentspaceid AND aircontype = 'YES');

elseif aircon = 'No' then

SET @aircon = (SELECT true from charges_eventtype where rent_spaceid =  rentspaceid AND aircontype = 'No');


end if ;

if @aircon then

	SELECT 'true' result;

else

   INSERT INTO charges_eventtype (natureactivity_id,rent_spaceid,rate_typeid,regular_number_per_rate,regular_price,succeeding_number_per_rate,succeeding_price,aircontype,date_created) VALUES(natureid,rentspaceid,rateid,regnumber,regprice,sucnumber,sucprice,aircon,CURDATE());

		SELECT 'false' result ;
	
end if ;



End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertnewrentspaces`(IN `name` VARCHAR(255), IN `facilityid` INT(11), IN `maxperson` INT(11), IN `gender` VARCHAR(255), IN `maleperson` INT(11), IN `femaleperson` INT(11), IN `otherfacility` VARCHAR(255))
    NO SQL
Begin

SET @male = 0;

SET @female = 0;

SET @both = 0;

SET @gender = gender;

if @gender = 'female' then

	SET @female = true;
    
elseif @gender = 'male' then

	SET @male = true;

else

SET @both = true;

end if ;


INSERT INTO trentspace (Name,Facility_ID,No_person_Max,Male_Max_Person,
                       Female_Max_Person,is_female,is_male,is_both_gender
                       ,is_otherfacility,Date_Created)
                       VALUES(name,facilityid,maxperson
                                               ,maleperson,femaleperson,
                                               @female,@male,@both,
                                               otherfacility,CURDATE());
                                               
                      

End$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE IF NOT EXISTS `charges` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `rent_space_id` int(50) NOT NULL,
  `amount` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`id`, `rent_space_id`, `amount`) VALUES
(1, 1, '250'),
(2, 1, '350'),
(3, 3, '500'),
(4, 3, '1000'),
(5, 3, '1500'),
(6, 15, '2000'),
(7, 16, '1000'),
(8, 16, '2000'),
(9, 2, '350'),
(10, 2, '250'),
(11, 0, '185');

-- --------------------------------------------------------

--
-- Table structure for table `charges_eventtype`
--

CREATE TABLE IF NOT EXISTS `charges_eventtype` (
  `chargesevent_id` int(11) NOT NULL AUTO_INCREMENT,
  `natureactivity_id` int(11) NOT NULL,
  `rent_spaceid` int(11) NOT NULL,
  `rate_typeid` int(11) NOT NULL,
  `regular_number_per_rate` int(11) NOT NULL,
  `regular_price` int(11) NOT NULL,
  `succeeding_number_per_rate` int(11) NOT NULL,
  `succeeding_price` int(11) NOT NULL,
  `aircontype` varchar(3) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`chargesevent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `charges_eventtype`
--

INSERT INTO `charges_eventtype` (`chargesevent_id`, `natureactivity_id`, `rent_spaceid`, `rate_typeid`, `regular_number_per_rate`, `regular_price`, `succeeding_number_per_rate`, `succeeding_price`, `aircontype`, `date_created`) VALUES
(1, 1, 18, 3, 1, 1000, 1, 500, 'Yes', '2015-05-18'),
(2, 1, 18, 3, 1, 500, 1, 250, 'No', '2015-05-18');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE IF NOT EXISTS `gender` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `gender_name`) VALUES
(1, 'Male'),
(2, 'Female'),
(3, 'Both');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'student', 'General User'),
(3, 'non-student', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `natureactivity`
--

CREATE TABLE IF NOT EXISTS `natureactivity` (
  `natureactivity_id` int(11) NOT NULL AUTO_INCREMENT,
  `natureactivity_name` varchar(255) NOT NULL,
  `natureactivity_description` text NOT NULL,
  PRIMARY KEY (`natureactivity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `natureactivity`
--

INSERT INTO `natureactivity` (`natureactivity_id`, `natureactivity_name`, `natureactivity_description`) VALUES
(1, 'Weekend ( Sat - Sun, Holidays, Non 8-5 Weekdays )First Hour', 'This is a test');

-- --------------------------------------------------------

--
-- Table structure for table `other_charges`
--

CREATE TABLE IF NOT EXISTS `other_charges` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `cost` varchar(30) NOT NULL,
  `unit_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `other_charges`
--

INSERT INTO `other_charges` (`id`, `title`, `cost`, `unit_id`) VALUES
(1, 'Whole Day(8am - 5pm)', '60', 9),
(2, 'Half Day(4 Hours)', '55', 9),
(3, 'Overnight with Lodging', '400', 8);

-- --------------------------------------------------------

--
-- Table structure for table `ratereferrence`
--

CREATE TABLE IF NOT EXISTS `ratereferrence` (
  `ratereferrenceID` int(11) NOT NULL AUTO_INCREMENT,
  `referrenceName` varchar(255) NOT NULL,
  PRIMARY KEY (`ratereferrenceID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ratereferrence`
--

INSERT INTO `ratereferrence` (`ratereferrenceID`, `referrenceName`) VALUES
(1, 'Totaldays'),
(2, 'Totalpersons'),
(3, 'Totalhours'),
(4, 'Totalminutes'),
(5, 'Totalseconds'),
(6, 'Totalmonths'),
(7, 'Totalyears');

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE IF NOT EXISTS `room_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `room_type_name` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id`, `room_type_name`) VALUES
(1, 'Aircon'),
(2, 'Non-Aircon');

-- --------------------------------------------------------

--
-- Table structure for table `tactivity`
--

CREATE TABLE IF NOT EXISTS `tactivity` (
  `activityID` int(11) NOT NULL AUTO_INCREMENT,
  `Activity` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `facility_id` int(50) NOT NULL,
  PRIMARY KEY (`activityID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tactivity`
--

INSERT INTO `tactivity` (`activityID`, `Activity`, `Description`, `facility_id`) VALUES
(1, 'Logging', 'Sample Description Here', 2),
(2, 'Sleep Over', 'Sample Description Here', 2),
(3, 'Meeting/Seminar/Conference/Graduation', 'Sample Description Here', 2),
(4, ' Live-in / night', 'Sample Description Here', 0),
(5, 'Main Mass', 'Main Mass for Gesu facility', 3),
(6, 'High Mass', 'This is a test for description', 3),
(7, 'Short Mass', 'this is a test for mass', 3),
(8, 'Rehearsal', 'This is a test for gesu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tcity`
--

CREATE TABLE IF NOT EXISTS `tcity` (
  `CityID` int(11) NOT NULL AUTO_INCREMENT,
  `City` varchar(255) NOT NULL,
  PRIMARY KEY (`CityID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tcity`
--

INSERT INTO `tcity` (`CityID`, `City`) VALUES
(1, 'Quezon City'),
(2, 'Caloocan City'),
(3, 'Bulacan City'),
(4, 'Manila City'),
(5, 'Pasig City'),
(6, 'Cavite City');

-- --------------------------------------------------------

--
-- Table structure for table `temporary_cart_pending`
--

CREATE TABLE IF NOT EXISTS `temporary_cart_pending` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `rentpromo_ID` int(11) NOT NULL,
  `reservationID` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `stime` time NOT NULL,
  `etime` time NOT NULL,
  `stime_type` varchar(5) NOT NULL,
  `etime_type` varchar(5) NOT NULL,
  `Aircon_Avail` int(11) NOT NULL,
  `rent_space_id` int(50) NOT NULL,
  `number_of_guest` int(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gender` int(10) NOT NULL,
  `other_charge_id` int(10) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `date_created` (`date_created`),
  KEY `gender` (`gender`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `temporary_cart_pending`
--

INSERT INTO `temporary_cart_pending` (`ID`, `rentpromo_ID`, `reservationID`, `startdate`, `enddate`, `stime`, `etime`, `stime_type`, `etime_type`, `Aircon_Avail`, `rent_space_id`, `number_of_guest`, `date_created`, `gender`, `other_charge_id`) VALUES
(27, 0, 47, '2015-06-02', '2015-06-02', '03:00:00', '02:30:00', 'am', 'am', 0, 1, 1, '2015-06-02 10:00:12', 1, 0),
(36, 0, 47, '2015-06-02', '2015-06-02', '10:30:00', '10:00:00', 'am', 'am', 0, 2, 1, '2015-06-02 17:00:42', 1, 0),
(38, 0, 47, '2015-06-03', '2015-06-03', '10:30:00', '04:30:00', 'am', 'am', 0, 9, 10, '2015-06-02 17:54:45', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tfacility`
--

CREATE TABLE IF NOT EXISTS `tfacility` (
  `facility_iD` int(11) NOT NULL AUTO_INCREMENT,
  `facilitytypeID` int(11) NOT NULL,
  `Facility_name` varchar(255) NOT NULL,
  `Facility_Description` varchar(255) NOT NULL,
  `Control_Number_Header` varchar(255) NOT NULL,
  `Date_Created` date NOT NULL,
  `PDF_File` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`facility_iD`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tfacility`
--

INSERT INTO `tfacility` (`facility_iD`, `facilitytypeID`, `Facility_name`, `Facility_Description`, `Control_Number_Header`, `Date_Created`, `PDF_File`) VALUES
(2, 2, 'John Pollock SJ Renewal Center', 'This is sample description for Jpollock', 'JPRC', '2015-01-10', 'irwin1.pdf'),
(3, 1, 'Gesu', 'This is sample description for Gesu', 'GESU', '2015-01-18', NULL),
(4, 1, 'Irwin', 'This is a description', 'IRWIN', '2015-05-17', 'irwin2.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `trate_type`
--

CREATE TABLE IF NOT EXISTS `trate_type` (
  `rate_typeID` int(11) NOT NULL AUTO_INCREMENT,
  `rate_name` varchar(255) NOT NULL,
  `ratereferrenceID` int(11) NOT NULL,
  PRIMARY KEY (`rate_typeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `trate_type`
--

INSERT INTO `trate_type` (`rate_typeID`, `rate_name`, `ratereferrenceID`) VALUES
(1, 'head', 2),
(3, 'hour', 3),
(6, 'minute', 4),
(7, 'day', 1),
(8, 'month', 6);

-- --------------------------------------------------------

--
-- Table structure for table `trentpromo`
--

CREATE TABLE IF NOT EXISTS `trentpromo` (
  `rentPromoID` int(11) NOT NULL AUTO_INCREMENT,
  `rate_typeID` int(11) NOT NULL,
  `Rent_spaceID` int(11) NOT NULL,
  `ratereferrenceID` int(11) NOT NULL,
  `Activity_ID` int(11) NOT NULL,
  `PromoID` int(11) NOT NULL,
  `is_NoAircon` tinyint(1) NOT NULL,
  `NoAircon_Number` double(11,2) NOT NULL,
  `NoAircon_Usecost` double(11,2) NOT NULL,
  `Succeding_Number_NoAircon` double(11,2) NOT NULL,
  `Succeding_Price_NoAircon` double(11,2) NOT NULL,
  `Is_Aircon` tinyint(1) NOT NULL,
  `Aircon_Number` double(11,2) NOT NULL,
  `AirCon_UseCost` double(11,2) NOT NULL,
  `Succeding_Number_Aircon` double(11,2) NOT NULL,
  `Succeding_Price_Aircon` double(11,2) NOT NULL,
  PRIMARY KEY (`rentPromoID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `trentpromo`
--

INSERT INTO `trentpromo` (`rentPromoID`, `rate_typeID`, `Rent_spaceID`, `ratereferrenceID`, `Activity_ID`, `PromoID`, `is_NoAircon`, `NoAircon_Number`, `NoAircon_Usecost`, `Succeding_Number_NoAircon`, `Succeding_Price_NoAircon`, `Is_Aircon`, `Aircon_Number`, `AirCon_UseCost`, `Succeding_Number_Aircon`, `Succeding_Price_Aircon`) VALUES
(1, 1, 14, 2, 1, 1, 0, 0.00, 0.00, 0.00, 0.00, 1, 1.00, 340.00, 1.00, 250.00),
(2, 1, 15, 2, 1, 1, 0, 0.00, 0.00, 0.00, 0.00, 1, 1.00, 350.00, 1.00, 250.00),
(3, 1, 16, 2, 2, 1, 0, 0.00, 0.00, 0.00, 0.00, 1, 1.00, 350.00, 1.00, 250.00),
(4, 1, 17, 2, 2, 2, 1, 1.00, 250.00, 1.00, 100.00, 0, 0.00, 0.00, 0.00, 0.00),
(5, 1, 20, 2, 1, 2, 1, 1.00, 250.00, 1.00, 150.00, 0, 0.00, 0.00, 0.00, 0.00),
(6, 3, 19, 3, 3, 4, 1, 1.00, 2000.00, 2.00, 1200.00, 0, 0.00, 0.00, 0.00, 0.00),
(7, 3, 23, 3, 3, 4, 1, 1.00, 2000.00, 1.00, 1500.00, 1, 3.00, 3000.00, 1.00, 2000.00),
(8, 3, 18, 3, 5, 4, 1, 1.00, 4125.00, 1.00, 1200.00, 0, 0.00, 0.00, 0.00, 0.00),
(9, 3, 18, 3, 6, 4, 0, 0.00, 0.00, 0.00, 0.00, 1, 1.00, 2000.00, 1.00, 1500.00),
(10, 3, 21, 3, 7, 4, 1, 1.00, 1500.00, 1.00, 500.00, 1, 1.00, 1800.00, 1.00, 500.00),
(11, 0, 30, 0, 0, 0, 1, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `trentspace`
--

CREATE TABLE IF NOT EXISTS `trentspace` (
  `rentspace_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Facility_ID` int(11) NOT NULL,
  `No_person_Max` int(11) NOT NULL,
  `Male_Max_Person` int(11) NOT NULL,
  `Female_Max_Person` int(11) NOT NULL,
  `is_female` tinyint(1) NOT NULL,
  `is_male` tinyint(1) NOT NULL,
  `is_both_gender` tinyint(1) NOT NULL,
  `is_otherfacility` tinyint(1) NOT NULL,
  `gender_id` int(10) NOT NULL,
  `room_type_id` int(10) NOT NULL,
  `Date_Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rentspace_ID`),
  KEY `gender_id` (`gender_id`),
  KEY `room_type_id` (`room_type_id`),
  KEY `Facility_ID` (`Facility_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `trentspace`
--

INSERT INTO `trentspace` (`rentspace_ID`, `Name`, `Facility_ID`, `No_person_Max`, `Male_Max_Person`, `Female_Max_Person`, `is_female`, `is_male`, `is_both_gender`, `is_otherfacility`, `gender_id`, `room_type_id`, `Date_Created`) VALUES
(1, 'Room 201', 2, 10, 0, 0, 0, 0, 0, 0, 1, 1, '2015-05-30 21:16:40'),
(2, 'Room 202', 2, 10, 0, 0, 0, 0, 0, 0, 1, 1, '2015-05-30 21:16:40'),
(3, 'Room 203', 2, 10, 0, 0, 0, 0, 0, 0, 2, 1, '2015-05-30 21:16:40'),
(4, 'Room 204 Non aircon', 2, 10, 0, 0, 0, 0, 0, 0, 1, 2, '2015-05-30 21:16:40'),
(5, 'Room 205 Non aircon', 2, 10, 0, 0, 0, 0, 0, 0, 1, 2, '2015-05-30 21:16:40'),
(6, 'Room 206 Non aircon', 2, 10, 0, 0, 0, 0, 0, 0, 2, 2, '2015-05-30 21:16:40'),
(8, 'Campion Hall - Ground Floor(Max capacity 60px)', 2, 60, 0, 0, 0, 0, 0, 1, 1, 1, '2015-06-02 07:52:56'),
(9, 'Faber Hall - 2nd Floor(MAX capacity 40px)', 2, 40, 0, 0, 0, 0, 0, 1, 1, 1, '2015-06-02 07:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `trequirements`
--

CREATE TABLE IF NOT EXISTS `trequirements` (
  `requirement_ID` int(11) NOT NULL AUTO_INCREMENT,
  `requirement_name` varchar(255) NOT NULL,
  PRIMARY KEY (`requirement_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `trequirements`
--

INSERT INTO `trequirements` (`requirement_ID`, `requirement_name`) VALUES
(1, 'Microphone'),
(2, 'Kumot'),
(6, 'Dynamic Microphone ( regular ) & Stand'),
(7, 'Speaker'),
(8, 'Speaker101'),
(9, 'Chair'),
(10, 'Chair'),
(11, 'Table'),
(12, 'Electric Fan');

-- --------------------------------------------------------

--
-- Table structure for table `trequirement_forrent`
--

CREATE TABLE IF NOT EXISTS `trequirement_forrent` (
  `R_ForRentID` int(11) NOT NULL AUTO_INCREMENT,
  `requirement_ID` int(11) NOT NULL,
  `facility_ID` int(11) NOT NULL,
  `Unit_typeID` int(11) NOT NULL,
  `Price` double(11,2) NOT NULL,
  `Available_Item` int(11) NOT NULL,
  PRIMARY KEY (`R_ForRentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `trequirement_forrent`
--

INSERT INTO `trequirement_forrent` (`R_ForRentID`, `requirement_ID`, `facility_ID`, `Unit_typeID`, `Price`, `Available_Item`) VALUES
(1, 2, 2, 1, 120.00, 1),
(2, 1, 2, 2, 150.00, 50),
(3, 6, 3, 1, 120.00, 10),
(4, 7, 3, 2, 100.00, 12),
(5, 8, 3, 1, 200.00, 4),
(6, 12, 2, 2, 1.00, 10),
(7, 11, 3, 1, 500.00, 7);

-- --------------------------------------------------------

--
-- Table structure for table `treservation`
--

CREATE TABLE IF NOT EXISTS `treservation` (
  `reservationID` int(11) NOT NULL AUTO_INCREMENT,
  `user_ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `activityID` int(11) NOT NULL,
  `date_activity` date NOT NULL,
  `organizer` varchar(255) NOT NULL,
  `authorized_Person` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `st_brgy` varchar(255) NOT NULL,
  `cityID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `landline` varchar(255) NOT NULL,
  `number_person` int(11) NOT NULL,
  `DATE_Created` date NOT NULL,
  `facilityID` int(11) NOT NULL,
  `statusID` int(11) NOT NULL,
  PRIMARY KEY (`reservationID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `treservation`
--

INSERT INTO `treservation` (`reservationID`, `user_ID`, `name`, `activityID`, `date_activity`, `organizer`, `authorized_Person`, `position`, `st_brgy`, `cityID`, `email`, `mobile`, `landline`, `number_person`, `DATE_Created`, `facilityID`, `statusID`) VALUES
(32, 1, 'test', 1, '2015-05-07', 'test', 'test', 'test', 'test', 0, 'classicgm@rocketmail.com', 'test', '1212', 121212, '0000-00-00', 2, 1),
(33, 1, 'test', 1, '2015-05-07', 'Classicgm Classicgm Classicgm', 'Vincent Armedilla', 'Manager', 'test', 0, 'classicgm@rocketmail.com', '1212', '1212', 12, '0000-00-00', 2, 1),
(34, 1, 'test', 1, '2015-05-07', 'Vincent Michael Armedilla', 'Vincent Armedilla', 'Manager', 'ttest', 0, 'classicgm@rocketmail.com', '1212', '1212', 12, '0000-00-00', 2, 1),
(35, 1, 'test', 1, '2015-05-07', 'test', 'tet', 'test', 'test', 0, 'classicgm@rocketmail.com', '1212', '121', 12, '0000-00-00', 2, 1),
(36, 1, 'test', 2, '2015-05-07', 'test', 'test', 'test', 'test', 0, 'test@yahoo.com', '21212', '121212', 1212, '0000-00-00', 2, 1),
(37, 1, 'test', 1, '2015-05-07', 'Vincent Michael Armedilla', 'Vincent Armedilla', 'Manager', 'test', 0, 'classicgm@rocketmail.com', '1212', '121', 12, '0000-00-00', 2, 1),
(38, 1, 'test', 1, '2015-05-07', 'test', 'test', 'test', 'test', 0, 'test@yahoo.com', '12', '12', 12, '0000-00-00', 2, 1),
(39, 1, 'test', 1, '2015-05-07', 'Vincent Michael Armedilla', 'Vincent Armedilla', 'Manager', 'test', 0, 'test@yahoo.com', 'test', '121212', 1212, '0000-00-00', 2, 1),
(40, 1, 'test', 1, '2015-05-07', 'Vincent Michael Armedilla', 'Vincent Armedilla', 'Manager', 'test', 0, 'classicgm@rocketmail.com', '1212', '1212', 1212, '0000-00-00', 2, 1),
(41, 1, 'test', 1, '2015-05-07', 'Vincent Michael Armedilla', 'Vincent Armedilla', 'Manager', 'test', 0, 'test@yahoo.com', '1212', '1212', 12, '0000-00-00', 2, 1),
(42, 1, 'test', 2, '2015-05-07', 'test', 'test', 'test', 'test', 0, 'test@yahoo.com', '1212', '121212', 12, '0000-00-00', 2, 1),
(43, 1, 'test', 2, '2015-05-07', 'Vincent Michael Armedilla', 'Vincent Armedilla', 'Manager', 'test', 0, 'vincent.michael.armedilla@gmail.com', '09178880850', '212', 121212, '0000-00-00', 2, 1),
(44, 1, 'PHP Seminar', 1, '2015-05-21', 'Vincent Michael Armedilla', 'Vincent Armedilla', 'Web Developer', 'Test', 0, 'vincent.michael.armedilla@gmail.com', '091111111', '12', 12, '0000-00-00', 2, 1),
(45, 1, 'Web Semina', 2, '2015-05-21', 'IT Company', 'Vincent Armedilla', 'Web Developer', 'Concepcion Dos', 0, 'test@yahoo.com', '1212', '12', 12, '0000-00-00', 2, 2),
(46, 1, 'test', 1, '2015-05-21', 'test', 'test', 'test', 'test', 0, 'test@yahoo.com', '1212', '12', 12, '0000-00-00', 2, 1),
(47, 1, 'Web Activity', 1, '2015-05-21', 'Vincent Michael Armedilla', 'Vincent Armedilla', 'Manager', 'Concepcion Dos', 0, 'vincent.michael.armedilla@gmail.com', '1212', '12', 12, '0000-00-00', 2, 1),
(48, 1, 'Web', 1, '2015-05-22', 'Vincent Michael Armedilla', 'Vincent Armedilla', 'Manager', 'Marikina', 0, 'vincent.michael.armedilla@gmail.com', '09178880850', '12', 12, '0000-00-00', 2, 1),
(49, 1, 'Web Development Seminar', 3, '2015-05-24', 'Vincent Armedilla', 'Vincent Armedilla', 'Web Developer', 'Concepcion Dos', 0, 'vincent@instructionalfitness.com', '1212', '12', 0, '0000-00-00', 2, 2),
(50, 1, 'test', 1, '2015-05-25', 'test', 'test', 'test', 'test', 0, 'test@yahoo.com', '1212', '1212', 0, '0000-00-00', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `treservationcartpending`
--

CREATE TABLE IF NOT EXISTS `treservationcartpending` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `rentpromo_ID` int(11) NOT NULL,
  `reservationID` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `stime` time NOT NULL,
  `etime` time NOT NULL,
  `stime_type` varchar(5) NOT NULL,
  `etime_type` varchar(5) NOT NULL,
  `male` int(11) NOT NULL,
  `female` int(11) NOT NULL,
  `Both_Gender` int(11) NOT NULL,
  `Aircon_Avail` int(11) NOT NULL,
  `rent_space_id` int(50) NOT NULL,
  `number_of_guest` int(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `treservationcartpending`
--

INSERT INTO `treservationcartpending` (`ID`, `rentpromo_ID`, `reservationID`, `startdate`, `enddate`, `stime`, `etime`, `stime_type`, `etime_type`, `male`, `female`, `Both_Gender`, `Aircon_Avail`, `rent_space_id`, `number_of_guest`, `date_created`) VALUES
(1, 0, 47, '2015-06-01', '2015-06-01', '03:30:00', '02:30:00', 'am', 'am', 0, 0, 0, 0, 2, 2, '2015-06-01 09:50:55'),
(2, 0, 47, '2015-06-01', '2015-06-02', '03:00:00', '02:30:00', 'am', 'am', 0, 0, 0, 0, 3, 3, '2015-06-01 09:51:18'),
(3, 0, 47, '2015-06-01', '2015-06-10', '03:30:00', '02:30:00', 'am', 'am', 0, 0, 0, 0, 1, 1, '2015-06-01 09:51:35'),
(4, 0, 47, '2015-06-01', '2015-06-10', '03:30:00', '02:30:00', 'am', 'am', 0, 0, 0, 0, 1, 2, '2015-06-01 09:51:43');

-- --------------------------------------------------------

--
-- Table structure for table `treserverequirement`
--

CREATE TABLE IF NOT EXISTS `treserverequirement` (
  `reserverequireID` int(11) NOT NULL AUTO_INCREMENT,
  `R_ForRentID` int(11) NOT NULL,
  `reservationID` int(11) NOT NULL,
  `Unit_requested` int(11) NOT NULL,
  `Datefrom` date NOT NULL,
  `Dateto` date NOT NULL,
  `Timefrom` time NOT NULL,
  `Timeto` time NOT NULL,
  PRIMARY KEY (`reserverequireID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `treserverequirement`
--

INSERT INTO `treserverequirement` (`reserverequireID`, `R_ForRentID`, `reservationID`, `Unit_requested`, `Datefrom`, `Dateto`, `Timefrom`, `Timeto`) VALUES
(1, 2, 45, 0, '2015-05-21', '2015-05-21', '12:10:00', '12:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `tstatus`
--

CREATE TABLE IF NOT EXISTS `tstatus` (
  `status_ID` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(255) NOT NULL,
  PRIMARY KEY (`status_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tstatus`
--

INSERT INTO `tstatus` (`status_ID`, `status_name`) VALUES
(1, 'Pending'),
(2, 'Approved'),
(3, 'Dis-Approved');

-- --------------------------------------------------------

--
-- Table structure for table `tunit_type`
--

CREATE TABLE IF NOT EXISTS `tunit_type` (
  `Unit_typeID` int(11) NOT NULL AUTO_INCREMENT,
  `Unit_typename` varchar(255) NOT NULL,
  PRIMARY KEY (`Unit_typeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tunit_type`
--

INSERT INTO `tunit_type` (`Unit_typeID`, `Unit_typename`) VALUES
(1, 'set'),
(2, 'piece'),
(3, 'dozen'),
(4, 'case'),
(5, ''),
(6, 'baggage'),
(7, ''),
(8, 'Group'),
(9, 'head');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `resume` varchar(255) NOT NULL,
  `profile_picture_thumbnail` varchar(200) NOT NULL DEFAULT 'profile_images/photo.jpg',
  `profile_pic_big` varchar(200) NOT NULL DEFAULT 'profile_images/photo.jpg',
  `profession` varchar(120) NOT NULL,
  `user_summary` text NOT NULL,
  `user_title` varchar(120) NOT NULL,
  `gender` int(1) NOT NULL,
  `url` varchar(256) NOT NULL,
  `bio` text NOT NULL,
  `birthday` date NOT NULL,
  `location` varchar(56) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `resume`, `profile_picture_thumbnail`, `profile_pic_big`, `profession`, `user_summary`, `user_title`, `gender`, `url`, `bio`, `birthday`, `location`) VALUES
(1, '', 'vincentmichaelarmedilla1', '2cc076b99ba5182d56e3a3a9fa3258a21cba739e', NULL, 'vincent.michael.armedilla@gmail.com', NULL, NULL, NULL, NULL, 1430719596, 1433261096, 1, 'Vincent Michael', 'Armedilla', NULL, '', 'profile_images/photo.jpg', 'profile_images/photo.jpg', '', '', '', 0, '', '', '0000-00-00', ''),
(2, '', 'vincentmichaelarmedilla122', '2cc076b99ba5182d56e3a3a9fa3258a21cba739e', NULL, 'vincent.michael.armedilla12@gmail.com', NULL, NULL, NULL, NULL, 1430780510, 1433175735, 1, 'Vincent Michael', 'Armedilla', NULL, '', 'profile_images/photo.jpg', 'profile_images/photo.jpg', '', '', '', 0, '', '', '0000-00-00', ''),
(3, '', 'vincentmichaelarmedilla111113', 'feee199b53e3baa35c7104c94d3ba6af36fd3618', NULL, 'vincent.michael.armedilla11111@gmail.com', NULL, NULL, NULL, NULL, 1430844181, 1432115056, 1, 'Vincent Michael', 'Armedilla', NULL, '', 'profile_images/photo.jpg', 'profile_images/photo.jpg', '', '', '', 0, '', '', '0000-00-00', ''),
(4, '', 'admin46', 'a426166dc15c031791766401ee22b6513babf27c', NULL, 'admin@gmail.com', NULL, NULL, NULL, NULL, 1431042432, 1433003114, 1, 'admin', 'admin', NULL, '', 'profile_images/photo.jpg', 'profile_images/photo.jpg', '', '', '', 0, '', '', '0000-00-00', ''),
(5, '', 'vincentmichaelarmedilla2222325', '17f2048227645564bfbdaa561b70db3eb951cd45', NULL, 'vincent.michael.armedilla222232@gmail.com', NULL, NULL, NULL, NULL, 1431327486, NULL, 1, 'Vincent Michael', 'Armedilla', NULL, '', 'profile_images/photo.jpg', 'profile_images/photo.jpg', '', '', '', 0, '', '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 2),
(4, 4, 1),
(5, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_basicinformation`
--

CREATE TABLE IF NOT EXISTS `user_basicinformation` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) unsigned NOT NULL,
  `age` int(20) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `birthday` int(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `vcharges_eventtype`
--
CREATE TABLE IF NOT EXISTS `vcharges_eventtype` (
`chargesevent_id` int(11)
,`natureactivity_name` varchar(255)
,`name` varchar(255)
,`rate_name` varchar(255)
,`regular_number_per_rate` int(11)
,`regular_price` int(11)
,`succeeding_number_per_rate` int(11)
,`succeeding_price` int(11)
,`aircontype` varchar(3)
,`date_created` date
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vrate_type`
--
CREATE TABLE IF NOT EXISTS `vrate_type` (
`rate_typeID` int(11)
,`rate_name` varchar(255)
,`referrenceName` varchar(255)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vrentspaces`
--
CREATE TABLE IF NOT EXISTS `vrentspaces` (
`rentspace_ID` int(11)
,`name` varchar(255)
,`facility_name` varchar(255)
,`No_person_Max` int(11)
,`Male_Max_Person` varchar(11)
,`Female_Max_Person` varchar(11)
,`is_female` varchar(3)
,`is_male` varchar(3)
,`both_gender` varchar(3)
,`Is_Otherfacility` varchar(3)
,`date_created` timestamp
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vrequirementforrent`
--
CREATE TABLE IF NOT EXISTS `vrequirementforrent` (
`R_ForRentID` int(11)
,`requirement_name` varchar(255)
,`facility_ID` int(11)
,`facility` varchar(255)
,`unit_typename` varchar(255)
,`price` double(11,2)
,`available_item` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vtreservationapproval`
--
CREATE TABLE IF NOT EXISTS `vtreservationapproval` (
`reservationcartpending_ID` int(11)
,`startdate` varchar(40)
,`enddate` varchar(40)
,`stime` time
,`etime` time
,`reservationID` int(11)
,`facilityID` int(11)
,`facility_Name` varchar(255)
,`control` varchar(255)
,`user_id` int(11)
,`Client_Name` varchar(101)
,`name` varchar(255)
,`activity` varchar(255)
,`date_activity` date
,`organizer` varchar(255)
,`authorized_person` varchar(255)
,`position` varchar(255)
,`st_brgy` varchar(255)
,`city` varchar(255)
,`email` varchar(255)
,`mobile` varchar(255)
,`landline` varchar(255)
,`number_person` int(11)
,`date_created` date
,`status` varchar(255)
,`statusID` int(11)
);
-- --------------------------------------------------------

--
-- Structure for view `vcharges_eventtype`
--
DROP TABLE IF EXISTS `vcharges_eventtype`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vcharges_eventtype` AS select `a`.`chargesevent_id` AS `chargesevent_id`,`b`.`natureactivity_name` AS `natureactivity_name`,`c`.`Name` AS `name`,`d`.`rate_name` AS `rate_name`,`a`.`regular_number_per_rate` AS `regular_number_per_rate`,`a`.`regular_price` AS `regular_price`,`a`.`succeeding_number_per_rate` AS `succeeding_number_per_rate`,`a`.`succeeding_price` AS `succeeding_price`,`a`.`aircontype` AS `aircontype`,`a`.`date_created` AS `date_created` from (((`charges_eventtype` `a` left join `natureactivity` `b` on((`a`.`natureactivity_id` = `b`.`natureactivity_id`))) left join `trentspace` `c` on((`a`.`rent_spaceid` = `c`.`rentspace_ID`))) left join `trate_type` `d` on((`a`.`rate_typeid` = `d`.`rate_typeID`)));

-- --------------------------------------------------------

--
-- Structure for view `vrate_type`
--
DROP TABLE IF EXISTS `vrate_type`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vrate_type` AS select `a`.`rate_typeID` AS `rate_typeID`,`a`.`rate_name` AS `rate_name`,`b`.`referrenceName` AS `referrenceName` from (`trate_type` `a` left join `ratereferrence` `b` on((`a`.`ratereferrenceID` = `b`.`ratereferrenceID`)));

-- --------------------------------------------------------

--
-- Structure for view `vrentspaces`
--
DROP TABLE IF EXISTS `vrentspaces`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vrentspaces` AS select `a`.`rentspace_ID` AS `rentspace_ID`,`a`.`Name` AS `name`,`b`.`Facility_name` AS `facility_name`,`a`.`No_person_Max` AS `No_person_Max`,(case when (`a`.`Male_Max_Person` > 0) then `a`.`Male_Max_Person` else '---' end) AS `Male_Max_Person`,(case when (`a`.`Female_Max_Person` > 0) then `a`.`Female_Max_Person` else '---' end) AS `Female_Max_Person`,(case when (`a`.`is_female` > 0) then 'Yes' else 'No' end) AS `is_female`,(case when (`a`.`is_male` > 0) then 'Yes' else 'No' end) AS `is_male`,(case when (`a`.`is_both_gender` > 0) then 'Yes' else 'No' end) AS `both_gender`,(case when (`a`.`is_otherfacility` > 0) then 'Yes' else 'No' end) AS `Is_Otherfacility`,`a`.`Date_Created` AS `date_created` from (`trentspace` `a` left join `tfacility` `b` on((`a`.`Facility_ID` = `b`.`facility_iD`)));

-- --------------------------------------------------------

--
-- Structure for view `vrequirementforrent`
--
DROP TABLE IF EXISTS `vrequirementforrent`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vrequirementforrent` AS select `a`.`R_ForRentID` AS `R_ForRentID`,`b`.`requirement_name` AS `requirement_name`,`c`.`facility_iD` AS `facility_ID`,`c`.`Facility_name` AS `facility`,`d`.`Unit_typename` AS `unit_typename`,`a`.`Price` AS `price`,`a`.`Available_Item` AS `available_item` from (((`trequirement_forrent` `a` left join `tfacility` `c` on((`a`.`facility_ID` = `c`.`facility_iD`))) left join `trequirements` `b` on((`a`.`requirement_ID` = `b`.`requirement_ID`))) left join `tunit_type` `d` on((`a`.`Unit_typeID` = `d`.`Unit_typeID`)));

-- --------------------------------------------------------

--
-- Structure for view `vtreservationapproval`
--
DROP TABLE IF EXISTS `vtreservationapproval`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vtreservationapproval` AS select `g`.`ID` AS `reservationcartpending_ID`,date_format(`g`.`startdate`,'%b %d %Y') AS `startdate`,date_format(`g`.`enddate`,'%b %d %Y') AS `enddate`,`g`.`stime` AS `stime`,`g`.`etime` AS `etime`,`a`.`reservationID` AS `reservationID`,`a`.`facilityID` AS `facilityID`,`d`.`Facility_name` AS `facility_Name`,`d`.`Control_Number_Header` AS `control`,`a`.`user_ID` AS `user_id`,concat(`e`.`first_name`,' ',`e`.`last_name`) AS `Client_Name`,`a`.`name` AS `name`,`b`.`Activity` AS `activity`,`a`.`date_activity` AS `date_activity`,`a`.`organizer` AS `organizer`,`a`.`authorized_Person` AS `authorized_person`,`a`.`position` AS `position`,`a`.`st_brgy` AS `st_brgy`,`c`.`City` AS `city`,`a`.`email` AS `email`,`a`.`mobile` AS `mobile`,`a`.`landline` AS `landline`,`a`.`number_person` AS `number_person`,`a`.`DATE_Created` AS `date_created`,`f`.`status_name` AS `status`,`a`.`statusID` AS `statusID` from (`treservationcartpending` `g` left join (((((`treservation` `a` left join `tactivity` `b` on((`a`.`activityID` = `b`.`activityID`))) left join `tcity` `c` on((`a`.`cityID` = `c`.`CityID`))) left join `tfacility` `d` on((`a`.`facilityID` = `d`.`facility_iD`))) left join `users` `e` on((`a`.`user_ID` = `e`.`id`))) left join `tstatus` `f` on((`a`.`statusID` = `f`.`status_ID`))) on((`a`.`reservationID` = `g`.`reservationID`)));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `temporary_cart_pending`
--
ALTER TABLE `temporary_cart_pending`
  ADD CONSTRAINT `temporary_cart_pending_ibfk_1` FOREIGN KEY (`gender`) REFERENCES `gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trentspace`
--
ALTER TABLE `trentspace`
  ADD CONSTRAINT `trentspace_ibfk_1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trentspace_ibfk_2` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trentspace_ibfk_3` FOREIGN KEY (`Facility_ID`) REFERENCES `tfacility` (`facility_iD`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
