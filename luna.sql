-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2024 at 07:08 AM
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
-- Database: `luna`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `AmenitiesID` int(11) NOT NULL,
  `AmenitiesIcon` varchar(255) NOT NULL,
  `AmenitiesName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`AmenitiesID`, `AmenitiesIcon`, `AmenitiesName`) VALUES
(41, 'IMG_38654.svg', 'WiFi'),
(42, 'IMG_36739.svg', 'AC'),
(43, 'IMG_85017.svg', 'Message Bed'),
(44, 'IMG_37199.svg', 'Radio'),
(45, 'IMG_51555.svg', 'TV'),
(46, 'IMG_78451.svg', 'Refrigerator'),
(47, 'IMG_39508.svg', 'Microwave'),
(48, 'IMG_58140.svg', 'Exhaust'),
(49, 'IMG_29966.svg', 'Electice Teapot'),
(50, 'IMG_18009.svg', 'Cup'),
(51, 'IMG_48024.svg', 'Toaster'),
(52, 'IMG_26838.svg', 'Gas'),
(53, 'IMG_61823.svg', 'Iron'),
(54, 'IMG_86323.svg', 'Sink and Shower'),
(55, 'IMG_20109.svg', 'Shower'),
(56, 'IMG_32861.svg', 'Toiletries'),
(57, 'IMG_71375.svg', 'Hair Dryer and Comb'),
(58, 'IMG_19305.svg', 'Bathrobes'),
(59, 'IMG_79028.svg', 'Slippers'),
(60, 'IMG_49895.svg', 'Cleaning Services'),
(61, 'IMG_16095.svg', 'Coffee Maker'),
(62, 'IMG_25761.svg', 'Mini Bar'),
(64, 'IMG_39277.svg', 'Pet Amenities'),
(65, 'IMG_95671.svg', 'Games'),
(66, 'IMG_93490.svg', 'Premium Amenities ');

-- --------------------------------------------------------

--
-- Table structure for table `checkin`
--

CREATE TABLE `checkin` (
  `CheckInID` int(11) NOT NULL,
  `CheckInDate` date NOT NULL,
  `CheckInTime` time NOT NULL,
  `CheckInStatus` varchar(100) NOT NULL DEFAULT 'Pending',
  `CustomerID` int(11) NOT NULL,
  `ReservationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkin`
--

INSERT INTO `checkin` (`CheckInID`, `CheckInDate`, `CheckInTime`, `CheckInStatus`, `CustomerID`, `ReservationID`) VALUES
(29, '2024-04-01', '22:26:54', 'Checked In', 13, 32),
(30, '2024-04-01', '22:33:27', 'Checked In', 13, 33),
(31, '2024-04-06', '16:41:31', 'Checked In', 13, 34),
(32, '2024-04-14', '00:00:00', 'Pending', 17, 35),
(33, '2024-04-24', '00:00:00', 'Pending', 17, 36),
(34, '2024-04-27', '15:56:28', 'Checked In', 17, 37),
(35, '2024-05-11', '00:00:00', 'Pending', 17, 38),
(36, '2024-04-25', '00:00:00', 'Pending', 17, 39),
(37, '2024-04-27', '15:41:58', 'Checked In', 24, 40),
(38, '2024-05-11', '09:42:20', 'Checked In', 24, 41),
(39, '2024-04-28', '00:00:00', 'Pending', 13, 42),
(40, '2024-04-28', '00:00:00', 'Pending', 24, 43),
(41, '2024-05-01', '00:00:00', 'Pending', 17, 44),
(42, '2024-04-28', '00:00:00', 'Pending', 17, 45),
(43, '2024-04-30', '00:00:00', 'Pending', 13, 46),
(44, '2024-05-11', '00:00:00', 'Pending', 17, 47),
(45, '2024-05-11', '00:00:00', 'Pending', 13, 48),
(46, '2024-04-29', '00:00:00', 'Pending', 13, 49);

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `CheckOutID` int(11) NOT NULL,
  `CheckOutDate` date NOT NULL,
  `CheckOutTime` time NOT NULL,
  `CheckOutStatus` varchar(100) NOT NULL DEFAULT 'pending',
  `ReservationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`CheckOutID`, `CheckOutDate`, `CheckOutTime`, `CheckOutStatus`, `ReservationID`) VALUES
(29, '2024-04-03', '22:27:36', 'Confirmed', 32),
(30, '2024-04-11', '14:59:07', 'Confirmed', 33),
(31, '2024-04-24', '01:07:08', 'Confirmed', 34),
(32, '2024-04-19', '00:00:00', 'pending', 35),
(33, '2024-04-26', '00:00:00', 'pending', 36),
(34, '2024-04-27', '16:03:15', 'Confirmed', 37),
(35, '2024-05-14', '00:00:00', 'pending', 38),
(36, '2024-04-27', '00:00:00', 'pending', 39),
(37, '2024-04-29', '09:42:48', 'Confirmed', 40),
(38, '2024-05-17', '00:00:00', 'pending', 41),
(39, '2024-04-30', '00:00:00', 'pending', 42),
(40, '2024-04-30', '00:00:00', 'pending', 43),
(41, '2024-05-04', '00:00:00', 'pending', 44),
(42, '2024-05-02', '00:00:00', 'pending', 45),
(43, '2024-05-04', '00:00:00', 'pending', 46),
(44, '2024-05-17', '00:00:00', 'pending', 47),
(45, '2024-05-24', '00:00:00', 'pending', 48),
(46, '2024-05-03', '00:00:00', 'pending', 49);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `ContactID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `UserEmail` varchar(100) NOT NULL,
  `Subject` varchar(100) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `QueryDateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `Seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`ContactID`, `UserName`, `UserEmail`, `Subject`, `Message`, `QueryDateTime`, `Seen`) VALUES
(53, 'Sam', 'sam212@gmail.com', 'Dining', 'I also would like to reserve a table in 24.4.2024 at 7pm,', '2024-04-25 21:14:44', 1),
(54, 'Lucia', 'khinezarthwin21st@gmail.com', 'Wedding', 'Is there wedding packages ', '2024-04-26 10:50:10', 1),
(55, 'Lucia', 'khinezarthwin21st@gmail.com', 'Wedding', 'Is there wedding packages ', '2024-04-26 12:07:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `CustomerFullName` varchar(50) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `CustomerEmail` varchar(50) NOT NULL,
  `CustomerPhoneNo` varchar(50) NOT NULL,
  `CustomerDOB` date NOT NULL,
  `CustomerNRC` varchar(50) DEFAULT NULL,
  `PassportNo` varchar(100) DEFAULT NULL,
  `Street` varchar(50) NOT NULL,
  `Township` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `PostalCode` int(11) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `ProfilePic` varchar(255) NOT NULL,
  `Is_Verified` tinyint(11) NOT NULL DEFAULT 0,
  `Token` varchar(200) DEFAULT NULL,
  `T_Expire` date DEFAULT NULL,
  `CustomerStatus` tinyint(11) NOT NULL DEFAULT 1,
  `DateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `CustomerFullName`, `Gender`, `CustomerEmail`, `CustomerPhoneNo`, `CustomerDOB`, `CustomerNRC`, `PassportNo`, `Street`, `Township`, `City`, `Country`, `PostalCode`, `Password`, `ProfilePic`, `Is_Verified`, `Token`, `T_Expire`, `CustomerStatus`, `DateTime`) VALUES
(13, 'Khine Zar Thwin', 'Female', 'khinezarthwin21st@gmail.com', '09960487618', '2000-02-10', '', 'zm1289', 'Lay Dauk Kan Road', 'Yangon', 'Yangon', 'Myanmar', 11211, '$2y$10$txjVEAKqFyb9zpx7TYBLHeg0pEKFaflIOveNsY.nSlQ.IYlOs6jvO', 'IMG_67089.jpeg', 1, NULL, NULL, 0, '2024-01-03 16:55:38'),
(17, 'Lucia', 'Female', 'luciaharu01@gmail.com', '0996048741', '1994-08-07', '12/TAMANA(N)7412358', '', 'Lay Dauk Kan Road', 'Yangon', 'Yangon', 'Myanmar (Burma)', 11211, '$2y$10$P3fKeXoJdRE1xDYYQtdIO.Cih.nzdpbRd1QSFg5J1zVHa.vth0A4y', 'IMG_77611.jpeg', 1, '08ed6ad0741fc7160ae271db7e0ccf94', NULL, 1, '2024-04-14 14:09:26'),
(24, 'Alex Key', 'Male', 'khinezarthwin18th@gmail.com', '09960487654', '1999-02-12', '', 'ak7896', 'Brroklyn Road', 'Brooklyn', 'New York', 'USA', 11856, '$2y$10$d.4m0FV6fDSxv/T84jqtSOz2FiNNF9jqHNUVbzJrtAEiCFN.IGS0.', 'IMG_74775.jpeg', 1, '59741d505bea31722e3bf5f9c1b5dd94', NULL, 1, '2024-04-27 11:48:24'),
(25, 'Khine Zar Thwin', 'Female', 'galaxyiris16@gmail.com', '09960487674', '2000-04-30', '', 'ff854++', 'Lay Dauk Kan Road', 'Yangon', 'Yangon', 'Myanmar (Burma)', 11211, '$2y$10$LavzKxrmvsyoH7U/mHHGm.J.tj8hVXJ2OGE9Wo.y2SJln2jJrzpGm', 'IMG_21401.jpeg', 0, '583fc97fb14ff4967b8dda409c73c66a', NULL, 1, '2024-04-29 09:59:54');

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

CREATE TABLE `feature` (
  `FeatureID` int(11) NOT NULL,
  `FeatureName` varchar(50) NOT NULL,
  `FeatureDescription` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feature`
--

INSERT INTO `feature` (`FeatureID`, `FeatureName`, `FeatureDescription`) VALUES
(7, 'City View', 'Stunning views of the city skyline from rooms and common areas.'),
(8, 'Historic Charm', 'Housed in a beautifully restored historic building with unique architectural features and character.'),
(9, 'Pet-Friendly', 'Accommodations and amenities welcoming to pets, such as pet-friendly rooms and designated pet areas.'),
(11, 'Private Balconies', 'Guest rooms or suites equipped with private balconies offering outdoor seating and views of the surrounding area.'),
(12, 'Fitness Classes', 'Complimentary or instructor-led fitness classes available to guests, such as yoga, Pilates, or cardio workouts.'),
(13, '24 Hours', '24 hours Room Services, Electricity, Wifi  Stand By'),
(14, 'Breakfast', 'Breakfast Buffet'),
(15, 'Private Pool', 'Rooms with a private pool or plunge pool for exclusive use by guests staying in Premium accommodations.'),
(16, 'Hypoallergenic Options', 'Rooms with hypoallergenic bedding, flooring, and air purification systems for guests with allergies or sensitivities.'),
(17, 'Soundproofing', 'Rooms that are equipped with soundproofing materials to minimize noise from neighboring rooms or external sources.'),
(18, 'Smart Room Technology', 'Equipped with smart technology, allowing guests to control lighting, temperature, and entertainment systems through a mobile app or voice commands.'),
(19, 'Jacuzzi or Hot Tub', 'A private Jacuzzi or hot tub for guests to unwind.'),
(20, 'Steam Room or Sauna', 'Private steam rooms or saunas for relaxation.'),
(21, 'Fireplace', 'A fireplace, adding warmth and ambiance.'),
(22, 'Kitchenette or Full Kitchen', 'Include a kitchenette or full kitchen with appliances like a stove, refrigerator, microwave, and cooking utensils.'),
(23, 'Separate Living Area', 'A separate living area with additional seating, enhancing comfort and space.'),
(24, 'Work Desk', 'A dedicated workspace with a desk and chair for guests who need to work during their stay.'),
(25, 'Personalized Amenities', 'Personalized amenities or services tailored to guests&#039; preferences, such as a choice of pillows, aromatherapy options, or preferred snacks.'),
(26, 'Private Bar or Wine Cellar', 'Include a private bar stocked with a selection of beverages or a small wine cellar for connoisseurs.'),
(29, 'laundry', 'laundry  service');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `PaymentDateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `TransactionNo` varchar(200) NOT NULL,
  `TransactionDate` date NOT NULL,
  `TransactionStatus` varchar(100) NOT NULL DEFAULT 'Pending',
  `TotalAmount` int(11) NOT NULL,
  `Tax_Service_Charges` int(11) NOT NULL,
  `GrandTotal` int(11) NOT NULL,
  `RefundAmount` int(11) DEFAULT NULL,
  `RefundDateTime` datetime DEFAULT NULL,
  `RefundStatus` varchar(50) DEFAULT NULL,
  `CheckOutID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `PaymentDateTime`, `TransactionNo`, `TransactionDate`, `TransactionStatus`, `TotalAmount`, `Tax_Service_Charges`, `GrandTotal`, `RefundAmount`, `RefundDateTime`, `RefundStatus`, `CheckOutID`) VALUES
(29, '2024-04-01 22:26:33', '1E577207CC988544D', '2024-04-01', 'COMPLETED', 368, 36, 404, NULL, NULL, NULL, 29),
(30, '2024-04-01 22:33:12', '0X7867701W3745000', '2024-04-01', 'COMPLETED', 110000, 11000, 121000, NULL, NULL, NULL, 30),
(31, '2024-04-06 16:40:37', '1RW71722FP401615D', '2024-04-06', 'COMPLETED', 254, 25, 279, NULL, NULL, NULL, 31),
(32, '2024-04-14 14:11:32', '434233501T029690A', '2024-04-14', 'COMPLETED', 1785, 178, 1983, 1428, '2024-04-14 14:12:25', 'REFUNDED', 32),
(33, '2024-04-24 10:42:47', '7X398832D7896602E', '2024-04-24', 'COMPLETED', 368, 36, 424, 294, '2024-04-24 16:03:42', 'REFUNDED', 33),
(34, '2024-04-24 10:52:27', '7JY41739RV2782603', '2024-04-24', 'COMPLETED', 1428, 142, 1570, NULL, NULL, NULL, 34),
(35, '2024-04-24 16:01:22', '28261668HF7364714', '2024-04-24', 'COMPLETED', 762, 76, 858, 609, '2024-04-25 23:03:38', 'REFUNDED', 35),
(36, '2024-04-25 22:43:09', '2NY07511KV108131S', '2024-04-25', 'COMPLETED', 712, 71, 783, 0, NULL, NULL, 36),
(37, '2024-04-27 15:28:18', '7WW729198B943191C', '2024-04-27', 'COMPLETED', 712, 71, 783, NULL, NULL, NULL, 37),
(38, '2024-04-27 15:29:12', '53623985VN171382G', '2024-04-27', 'COMPLETED', 5376, 537, 5913, NULL, NULL, NULL, 38),
(39, '2024-04-28 06:43:48', '29R35133RR950105G', '2024-04-28', 'COMPLETED', 712, 71, 783, NULL, NULL, NULL, 39),
(40, '2024-04-28 08:22:36', '9T145003E96903745', '2024-04-28', 'COMPLETED', 1792, 179, 1971, NULL, NULL, NULL, 40),
(41, '2024-04-28 15:21:42', '08575949780023150', '2024-04-28', 'COMPLETED', 33000, 3300, 36300, NULL, NULL, NULL, 41),
(42, '2024-04-28 15:22:19', '49J861913G153615T', '2024-04-28', 'COMPLETED', 736, 73, 829, NULL, NULL, NULL, 42),
(43, '2024-04-28 15:25:21', '21E47120S5912150T', '2024-04-28', 'COMPLETED', 1956, 195, 2151, NULL, NULL, NULL, 43),
(44, '2024-04-28 15:28:24', '1W149937WS653204D', '2024-04-28', 'COMPLETED', 1524, 152, 1676, NULL, NULL, NULL, 44),
(45, '2024-04-28 16:31:04', '19B54833T0592141V', '2024-04-28', 'COMPLETED', 2392, 239, 2631, NULL, NULL, NULL, 45),
(46, '2024-04-29 09:39:47', '6JT00656BM285210A', '2024-04-29', 'COMPLETED', 1956, 195, 2171, 1564, '2024-04-29 09:43:09', 'REFUNDED', 46);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `PositionNo` int(11) NOT NULL,
  `PositionName` varchar(50) NOT NULL,
  `DepartmentName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`PositionNo`, `PositionName`, `DepartmentName`) VALUES
(1, 'CEO', 'Management'),
(2, 'Managing Director', 'Management '),
(3, 'Receptionist', 'Operation'),
(5, 'Database Administrator ', 'Tech'),
(6, 'Tech Lead', 'Tech'),
(7, 'Duty Director', 'Duty'),
(9, 'Sale_Staff', 'Sales_Marketing'),
(12, 'Mechanism', 'Engineering'),
(13, 'Team Leader', 'Duty');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `ReservationID` int(11) NOT NULL,
  `ReservationNo` varchar(200) NOT NULL,
  `ReservationDate` date NOT NULL DEFAULT current_timestamp(),
  `ReservationStatus` varchar(100) NOT NULL DEFAULT 'pending',
  `ArrivalTime` time NOT NULL,
  `SpecialRequest` text DEFAULT NULL,
  `Review_Rate_status` tinyint(4) DEFAULT 0,
  `Room_No` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`ReservationID`, `ReservationNo`, `ReservationDate`, `ReservationStatus`, `ArrivalTime`, `SpecialRequest`, `Review_Rate_status`, `Room_No`) VALUES
(32, 'R_c133078711', '2024-04-01', 'CHECKED OUT', '10:25:00', 'None', 1, 'S-01'),
(33, 'R_c139417114', '2024-04-01', 'CHECKED OUT', '22:33:00', 'None', 1, 'P-01'),
(34, 'R_c135192866', '2024-04-06', 'CHECKED OUT', '16:41:00', 'None', 1, 'D-03'),
(35, 'R_c178981469', '2024-04-14', 'CANCELLED', '14:13:00', 'Extra bed requested.', 0, NULL),
(36, 'R_c178005305', '2024-04-24', 'CANCELLED', '10:45:00', 'Extra bed requested.', 1, NULL),
(37, 'R_c177610255', '2024-04-24', 'CHECKED OUT', '10:56:00', 'None', 1, 'F-01'),
(38, 'R_c174802645', '2024-04-24', 'CANCELLED', '15:14:00', 'Extra bed requested.', 0, NULL),
(39, 'R_c176343265', '2024-04-25', 'CANCELLED', '22:42:00', 'None', 0, NULL),
(40, 'R_c245294565', '2024-04-27', 'CHECKED OUT', '15:28:00', 'None', 1, 'E-01'),
(41, 'R_c246286695', '2024-04-27', 'ASSIGNED', '15:29:00', 'None', 1, 'Su-01'),
(42, 'R_c134445348', '2024-04-28', 'CONFIRMED', '06:44:00', 'None', 1, NULL),
(43, 'R_c24705634', '2024-04-28', 'CONFIRMED', '08:14:00', 'None', 0, NULL),
(44, 'R_c178412733', '2024-04-28', 'CONFIRMED', '15:23:00', 'None', 1, NULL),
(45, 'R_c172111805', '2024-04-28', 'CONFIRMED', '15:23:00', 'Extra bed requested.', 1, NULL),
(46, 'R_c137613527', '2024-04-28', 'CONFIRMED', '15:27:00', 'None', 1, NULL),
(47, 'R_c172262745', '2024-04-28', 'CONFIRMED', '15:30:00', 'None', 1, NULL),
(48, 'R_c13507030', '2024-04-28', 'CONFIRMED', '16:31:00', 'None', 0, NULL),
(49, 'R_c137629504', '2024-04-29', 'CANCELLED', '09:39:00', 'Extra bed requested.', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservationdetails`
--

CREATE TABLE `reservationdetails` (
  `ReservationID` int(11) NOT NULL,
  `RTID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservationdetails`
--

INSERT INTO `reservationdetails` (`ReservationID`, `RTID`) VALUES
(32, 9),
(33, 15),
(34, 10),
(35, 11),
(36, 9),
(37, 11),
(38, 10),
(39, 12),
(40, 12),
(41, 14),
(42, 12),
(43, 14),
(44, 15),
(45, 9),
(46, 13),
(47, 10),
(48, 9),
(49, 13);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ReviewsID` int(11) NOT NULL,
  `Rating` int(11) NOT NULL,
  `Reviews` varchar(255) NOT NULL,
  `seen` tinyint(4) NOT NULL DEFAULT 0,
  `DateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `CustomerID` int(11) NOT NULL,
  `ReservationID` int(11) NOT NULL,
  `RTID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ReviewsID`, `Rating`, `Reviews`, `seen`, `DateTime`, `CustomerID`, `ReservationID`, `RTID`) VALUES
(13, 5, 'Have A great time', 0, '2024-04-28 07:14:10', 13, 42, 12),
(14, 5, 'Great service along with great lay out room design', 0, '2024-04-28 15:19:33', 24, 41, 14),
(15, 4, 'Great service', 0, '2024-04-28 15:22:34', 17, 45, 9),
(16, 5, 'Love the experience', 0, '2024-04-28 15:22:45', 17, 44, 15),
(17, 5, 'This room is a great choice during business trip', 0, '2024-04-28 15:26:59', 13, 46, 13),
(18, 4, 'Enjoyed the time here', 0, '2024-04-28 15:28:39', 17, 47, 10);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `RoomID` int(11) NOT NULL,
  `RoomNumber` varchar(50) NOT NULL,
  `FloorNo` int(11) NOT NULL,
  `RoomStatus` tinyint(4) NOT NULL DEFAULT 1,
  `RTID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`RoomID`, `RoomNumber`, `FloorNo`, `RoomStatus`, `RTID`) VALUES
(18, 'S-01', 2, 1, 9),
(20, 'S-012', 3, 1, 9),
(21, 'D-03', 5, 1, 10),
(22, 'P-01', 10, 1, 15),
(23, 'P-02', 10, 1, 15),
(24, 'Su-01', 8, 0, 14),
(25, 'J-02', 7, 1, 13),
(26, 'E-01', 4, 1, 12),
(27, 'F-01', 5, 1, 11),
(28, 'F-018', 7, 1, 11),
(32, 'E-02', 5, 1, 12),
(33, 'E-03  ', 6, 1, 12),
(34, 'Su-02', 9, 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE `roomtype` (
  `RTID` int(11) NOT NULL,
  `RTName` varchar(50) NOT NULL,
  `Adult` int(11) NOT NULL,
  `Children` int(11) NOT NULL,
  `Area` int(11) NOT NULL,
  `From_Floor` int(11) NOT NULL,
  `To_Floor` int(11) NOT NULL,
  `RTQuantity` int(11) NOT NULL,
  `PricePerNight` int(11) NOT NULL,
  `RTDescription` varchar(150) NOT NULL,
  `RTStatus` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomtype`
--

INSERT INTO `roomtype` (`RTID`, `RTName`, `Adult`, `Children`, `Area`, `From_Floor`, `To_Floor`, `RTQuantity`, `PricePerNight`, `RTDescription`, `RTStatus`) VALUES
(9, 'Standard Room', 2, 0, 300, 2, 4, 30, 184, 'A basic room offering essential amenities such as a bed, bathroom, and minimal furnishings.', 1),
(10, 'Deluxe Room', 2, 0, 465, 5, 7, 10, 254, 'A larger and more upscale version of the standard room, featuring additional space and upgraded amenities.', 1),
(11, 'Family Room', 4, 4, 541, 5, 7, 10, 357, 'A room specifically designed to accommodate families, offering extra space, kitchen and amenities suitable for children.', 1),
(12, 'Executive Room', 2, 2, 356, 4, 6, 10, 356, 'Executive Room', 1),
(13, 'Junior Suite', 2, 2, 547, 6, 7, 5, 489, 'A smaller version of a suite, offering a separate seating area and bedroom within a single open space.', 1),
(14, 'Suite', 6, 6, 895, 8, 9, 5, 896, 'A spacious and luxurious room featuring separate living and sleeping areas, along with enhanced amenities.', 1),
(15, 'Presidential Suite', 10, 10, 4659, 10, 11, 5, 11000, 'Presidential Suite', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rt_amenities`
--

CREATE TABLE `rt_amenities` (
  `RTID` int(11) NOT NULL,
  `AmenitiesID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rt_amenities`
--

INSERT INTO `rt_amenities` (`RTID`, `AmenitiesID`) VALUES
(9, 41),
(9, 42),
(9, 44),
(9, 45),
(9, 46),
(9, 49),
(9, 50),
(9, 53),
(9, 56),
(9, 57),
(9, 58),
(9, 59),
(9, 60),
(9, 61),
(10, 41),
(10, 42),
(10, 44),
(10, 45),
(10, 46),
(10, 47),
(10, 48),
(10, 49),
(10, 50),
(10, 51),
(10, 52),
(10, 53),
(10, 54),
(10, 55),
(10, 56),
(10, 57),
(10, 58),
(10, 59),
(10, 60),
(10, 61),
(10, 64),
(11, 41),
(11, 42),
(11, 44),
(11, 45),
(11, 46),
(11, 47),
(11, 48),
(11, 49),
(11, 50),
(11, 51),
(11, 52),
(11, 53),
(11, 54),
(11, 55),
(11, 56),
(11, 57),
(11, 58),
(11, 59),
(11, 60),
(11, 61),
(11, 64),
(12, 41),
(12, 42),
(12, 43),
(12, 44),
(12, 45),
(12, 46),
(12, 47),
(12, 48),
(12, 49),
(12, 50),
(12, 51),
(12, 52),
(12, 53),
(12, 54),
(12, 56),
(12, 57),
(12, 58),
(12, 59),
(12, 60),
(12, 61),
(12, 64),
(13, 41),
(13, 42),
(13, 43),
(13, 44),
(13, 45),
(13, 46),
(13, 47),
(13, 48),
(13, 49),
(13, 50),
(13, 51),
(13, 52),
(13, 53),
(13, 54),
(13, 55),
(13, 56),
(13, 57),
(13, 58),
(13, 59),
(13, 60),
(13, 61),
(13, 64),
(13, 66),
(14, 41),
(14, 42),
(14, 43),
(14, 44),
(14, 45),
(14, 46),
(14, 47),
(14, 48),
(14, 49),
(14, 50),
(14, 51),
(14, 52),
(14, 53),
(14, 54),
(14, 55),
(14, 56),
(14, 57),
(14, 58),
(14, 59),
(14, 60),
(14, 61),
(14, 64),
(14, 66),
(15, 41),
(15, 42),
(15, 43),
(15, 44),
(15, 45),
(15, 46),
(15, 47),
(15, 48),
(15, 49),
(15, 50),
(15, 51),
(15, 52),
(15, 53),
(15, 54),
(15, 55),
(15, 56),
(15, 57),
(15, 58),
(15, 59),
(15, 60),
(15, 61),
(15, 62),
(15, 64),
(15, 65),
(15, 66);

-- --------------------------------------------------------

--
-- Table structure for table `rt_features`
--

CREATE TABLE `rt_features` (
  `RTID` int(11) NOT NULL,
  `FeatureID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rt_features`
--

INSERT INTO `rt_features` (`RTID`, `FeatureID`) VALUES
(9, 13),
(9, 14),
(9, 17),
(10, 7),
(10, 9),
(10, 13),
(10, 14),
(10, 16),
(10, 17),
(10, 22),
(10, 24),
(11, 7),
(11, 9),
(11, 13),
(11, 14),
(11, 16),
(11, 17),
(11, 22),
(11, 24),
(12, 7),
(12, 9),
(12, 11),
(12, 12),
(12, 13),
(12, 14),
(12, 16),
(12, 17),
(12, 22),
(12, 23),
(12, 24),
(13, 7),
(13, 9),
(13, 11),
(13, 12),
(13, 13),
(13, 14),
(13, 15),
(13, 16),
(13, 17),
(13, 18),
(13, 21),
(13, 22),
(13, 23),
(13, 24),
(13, 25),
(14, 7),
(14, 8),
(14, 9),
(14, 11),
(14, 12),
(14, 13),
(14, 14),
(14, 15),
(14, 16),
(14, 17),
(14, 18),
(14, 21),
(14, 22),
(14, 23),
(14, 24),
(14, 25),
(15, 7),
(15, 8),
(15, 9),
(15, 11),
(15, 12),
(15, 13),
(15, 14),
(15, 15),
(15, 16),
(15, 17),
(15, 18),
(15, 19),
(15, 20),
(15, 21),
(15, 22),
(15, 23),
(15, 24),
(15, 25),
(15, 26);

-- --------------------------------------------------------

--
-- Table structure for table `rt_images`
--

CREATE TABLE `rt_images` (
  `ImgID` int(11) NOT NULL,
  `RTImages` varchar(255) NOT NULL,
  `RTID` int(11) NOT NULL,
  `Active` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rt_images`
--

INSERT INTO `rt_images` (`ImgID`, `RTImages`, `RTID`, `Active`) VALUES
(22, 'IMG_38945.jpg', 11, 1),
(23, 'IMG_17129.jpg', 10, 1),
(25, 'IMG_65598.jpg', 10, 0),
(37, 'IMG_17309.webp', 14, 1),
(38, 'IMG_28371.jpg', 14, 0),
(39, 'IMG_90361.webp', 14, 0),
(40, 'IMG_42777.jpg', 14, 0),
(41, 'IMG_53711.webp', 14, 0),
(43, 'IMG_63642.jpg', 13, 0),
(44, 'IMG_88193.webp', 13, 0),
(45, 'IMG_11349.jpg', 13, 0),
(47, 'IMG_81123.jpg', 10, 0),
(48, 'IMG_44617.jpg', 10, 0),
(49, 'IMG_76483.jpg', 11, 0),
(50, 'IMG_68286.jpg', 11, 0),
(51, 'IMG_52438.jpg', 11, 0),
(53, 'IMG_41172.jpg', 12, 1),
(54, 'IMG_13579.jpg', 12, 0),
(55, 'IMG_32202.jpg', 12, 0),
(56, 'IMG_85067.jpg', 12, 0),
(57, 'IMG_57316.webp', 12, 0),
(59, 'IMG_17946.jpg', 13, 1),
(63, 'IMG_40257.webp', 15, 1),
(64, 'IMG_55202.webp', 15, 0),
(65, 'IMG_75156.webp', 15, 0),
(66, 'IMG_60346.webp', 15, 0),
(68, 'IMG_66311.jpg', 9, 1),
(71, 'IMG_34588.webp', 9, 0),
(72, 'IMG_23658.jpg', 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `Sr_no` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Mission` varchar(150) NOT NULL,
  `Vision` varchar(150) NOT NULL,
  `Origin` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`Sr_no`, `Title`, `Mission`, `Vision`, `Origin`, `about`, `shutdown`) VALUES
(1, 'LUNA', 'To provide exceptional hospitality experiences that exceed expectations, creating memorable moments for every guest.', 'To be the premier destination for luxury hospitality, setting the standard for excellence and unforgettable experiences.', 'LUNA is one of Majestic Group Cooperation newest hotel destinations. Having been around since the 1980s, Majestic is a well-known and esteemed group of hotels. Majestic, is growing to become a worldwide name by reaching out of Asia.', 'The goal of LUNA, a non-smoking hotel, is to build a brand that deeply resonates with its patrons by continuously offering top-notch amenities and services. We provide our customers with the greatest services offered for their leisure.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `StaffFullName` varchar(50) NOT NULL,
  `StaffNRC` varchar(50) NOT NULL,
  `StaffDOB` date NOT NULL DEFAULT current_timestamp(),
  `StaffPhoneNo` varchar(50) NOT NULL,
  `Street` varchar(50) NOT NULL,
  `Township` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `PositionNo` int(11) NOT NULL,
  `StaffEmail` varchar(50) NOT NULL,
  `StaffPassword` varchar(255) NOT NULL,
  `StaffPic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `StaffFullName`, `StaffNRC`, `StaffDOB`, `StaffPhoneNo`, `Street`, `Township`, `City`, `PositionNo`, `StaffEmail`, `StaffPassword`, `StaffPic`) VALUES
(1, 'Florida Xin', '12/TAMANA(N)7896542', '1996-02-07', '9147822946', 'San Mwe', 'San', 'Yangon', 6, 'florida123@gmail.com', '$2y$10$zPlafp0htBCcM36etmz24eEX3JG2ooQTBcpjFveJA4kyP6Op0FcaS', 'IMG_99043.png'),
(26, 'Xan Mon', '12/TAMANA(N)741258', '1999-02-02', '9365287415', 'Lat Dauck', 'Tamwe', 'Yangon', 3, 'xanmon121@gmail.com', '$2y$10$nTCKqpHhjbRCYMFFRIXq9.Q8Vl46/ZY70YLZkkxmxRDkxfHoYT0Oy', 'IMG_98348.webp'),
(33, 'Khine Zar Thwin', '12/TAMANA(N)741258', '2000-02-10', '9960487618', 'Lay Dauk Kan Road', 'Yangon', 'Yangon', 5, 'khinezarthwin21st@gmail.com', '$2y$10$Vl/O1Uezjcr4mogQbQxJ2uUownSGv/8Hyj0n3kd4C4cqPV4aUdukq', 'IMG_39244.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`AmenitiesID`);

--
-- Indexes for table `checkin`
--
ALTER TABLE `checkin`
  ADD PRIMARY KEY (`CheckInID`),
  ADD KEY `Customer_ID` (`CustomerID`),
  ADD KEY `Reservation_ID` (`ReservationID`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`CheckOutID`),
  ADD KEY `Reservation__ID` (`ReservationID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ContactID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `feature`
--
ALTER TABLE `feature`
  ADD PRIMARY KEY (`FeatureID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `CheckOutID` (`CheckOutID`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`PositionNo`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`ReservationID`);

--
-- Indexes for table `reservationdetails`
--
ALTER TABLE `reservationdetails`
  ADD PRIMARY KEY (`ReservationID`,`RTID`),
  ADD KEY `RT__ID` (`RTID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ReviewsID`),
  ADD KEY `CustomerID_review` (`CustomerID`),
  ADD KEY `Reservation_review` (`ReservationID`),
  ADD KEY `RT_review` (`RTID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`RoomID`),
  ADD KEY `RT_r_ID` (`RTID`);

--
-- Indexes for table `roomtype`
--
ALTER TABLE `roomtype`
  ADD PRIMARY KEY (`RTID`);

--
-- Indexes for table `rt_amenities`
--
ALTER TABLE `rt_amenities`
  ADD PRIMARY KEY (`RTID`,`AmenitiesID`),
  ADD KEY `AmenitiesID` (`AmenitiesID`);

--
-- Indexes for table `rt_features`
--
ALTER TABLE `rt_features`
  ADD PRIMARY KEY (`RTID`,`FeatureID`),
  ADD KEY `FeatureID` (`FeatureID`);

--
-- Indexes for table `rt_images`
--
ALTER TABLE `rt_images`
  ADD PRIMARY KEY (`ImgID`),
  ADD KEY `RT_ImgID` (`RTID`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`Sr_no`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`),
  ADD KEY `PositionName` (`PositionNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `AmenitiesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `checkin`
--
ALTER TABLE `checkin`
  MODIFY `CheckInID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `CheckOutID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `ContactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `feature`
--
ALTER TABLE `feature`
  MODIFY `FeatureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `PositionNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ReviewsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `roomtype`
--
ALTER TABLE `roomtype`
  MODIFY `RTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rt_images`
--
ALTER TABLE `rt_images`
  MODIFY `ImgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `Sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkin`
--
ALTER TABLE `checkin`
  ADD CONSTRAINT `Customer_ID` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Reservation_ID` FOREIGN KEY (`ReservationID`) REFERENCES `reservation` (`ReservationID`) ON UPDATE CASCADE;

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `Reservation__ID` FOREIGN KEY (`ReservationID`) REFERENCES `reservation` (`ReservationID`) ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `CheckOutID` FOREIGN KEY (`CheckOutID`) REFERENCES `checkout` (`CheckOutID`) ON UPDATE CASCADE;

--
-- Constraints for table `reservationdetails`
--
ALTER TABLE `reservationdetails`
  ADD CONSTRAINT `RT__ID` FOREIGN KEY (`RTID`) REFERENCES `roomtype` (`RTID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ReservationID` FOREIGN KEY (`ReservationID`) REFERENCES `reservation` (`ReservationID`) ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `CustomerID_review` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `RT_review` FOREIGN KEY (`RTID`) REFERENCES `roomtype` (`RTID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Reservation_review` FOREIGN KEY (`ReservationID`) REFERENCES `reservation` (`ReservationID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `RT_r_ID` FOREIGN KEY (`RTID`) REFERENCES `roomtype` (`RTID`) ON UPDATE CASCADE;

--
-- Constraints for table `rt_amenities`
--
ALTER TABLE `rt_amenities`
  ADD CONSTRAINT `AmenitiesID` FOREIGN KEY (`AmenitiesID`) REFERENCES `amenities` (`AmenitiesID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `RT_ID` FOREIGN KEY (`RTID`) REFERENCES `roomtype` (`RTID`) ON UPDATE CASCADE;

--
-- Constraints for table `rt_features`
--
ALTER TABLE `rt_features`
  ADD CONSTRAINT `FeatureID` FOREIGN KEY (`FeatureID`) REFERENCES `feature` (`FeatureID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `RTID` FOREIGN KEY (`RTID`) REFERENCES `roomtype` (`RTID`) ON UPDATE CASCADE;

--
-- Constraints for table `rt_images`
--
ALTER TABLE `rt_images`
  ADD CONSTRAINT `RT_ImgID` FOREIGN KEY (`RTID`) REFERENCES `roomtype` (`RTID`) ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `PositionName` FOREIGN KEY (`PositionNo`) REFERENCES `position` (`PositionNo`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
