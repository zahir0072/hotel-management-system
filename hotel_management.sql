-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2025 at 06:25 AM
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
-- Database: `hotel_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_pass`) VALUES
(1, 'hoteladmin@gmail.com', '@12345');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`sr_no`, `booking_id`, `room_name`, `price`, `total_pay`, `room_no`, `user_name`, `phonenum`, `address`) VALUES
(1, 1, 'Deluxe Room', 2000, 2000, 'a1', 'Zahir kaida', '6353751864', 'Daiya'),
(2, 2, 'Deluxe Room', 2000, 4000, 'D1', 'Zahir kaida', '6353751864', 'Daiya'),
(3, 3, 'Supreme Deluxe Room', 5000, 5000, 'SD1', 'Zahir kaida', '6353751864', 'Daiya'),
(4, 4, 'Supreme Deluxe Room', 5000, 20000, NULL, 'Zahir kaida', '6353751864', 'Daiya'),
(5, 5, 'Luxury Room', 3000, 42000, 'L1', 'Zahir kaida', '6353751864', 'Daiya'),
(6, 6, 'Luxury Room', 3000, 27000, NULL, 'Zahir kaida', '6353751864', 'Daiya'),
(7, 7, 'Luxury Room', 3000, 33000, NULL, 'Zahir kaida', '6353751864', 'Daiya'),
(8, 8, 'Simple Room', 1000, 1000, 'a2', 'Zahir kaida', '6353751864', 'Daiya'),
(9, 9, 'Deluxe Room', 2000, 6000, NULL, 'Zahir kaida', '6353751864', 'Daiya'),
(10, 10, 'Supreme Deluxe Room', 5000, 5000, NULL, 'Zahir kaida', '6353751864', 'Daiya'),
(11, 11, 'Simple Room', 1000, 4000, NULL, 'Zahir kaida', '6353751864', 'Daiya');

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `arrival` int(11) NOT NULL DEFAULT 0,
  `booking_status` varchar(100) NOT NULL DEFAULT 'booking',
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `room_id`, `check_in`, `check_out`, `arrival`, `booking_status`, `datentime`) VALUES
(1, 8, 17, '2025-08-14', '2025-08-15', 1, 'booking', '2025-08-14 18:48:42'),
(2, 8, 17, '2025-08-14', '2025-08-16', 1, 'booking', '2025-08-14 18:52:28'),
(3, 8, 19, '2025-08-14', '2025-08-15', 1, 'booking', '2025-08-14 18:57:03'),
(4, 8, 19, '2025-08-27', '2025-08-31', 0, 'cancelled', '2025-08-14 19:01:23'),
(5, 8, 18, '2025-08-14', '2025-08-28', 1, 'booking', '2025-08-14 19:36:56'),
(6, 8, 18, '2025-08-19', '2025-08-28', 0, 'cancelled', '2025-08-14 19:40:56'),
(7, 8, 18, '2025-08-17', '2025-08-28', 0, 'cancelled', '2025-08-14 19:41:22'),
(8, 8, 16, '2025-08-19', '2025-08-20', 1, 'booking', '2025-08-16 15:12:02'),
(9, 8, 17, '2025-08-28', '2025-08-31', 0, 'cancelled', '2025-08-17 17:56:08'),
(10, 8, 19, '2025-08-28', '2025-08-29', 0, 'cancelled', '2025-08-17 18:07:57'),
(11, 8, 16, '2025-08-20', '2025-08-24', 0, 'cancelled', '2025-08-17 18:09:45');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(4, 'IMG_49369.jpg'),
(5, 'IMG_92289.jpg'),
(6, 'IMG_37752.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` bigint(30) NOT NULL,
  `pn2` bigint(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`, `insta`, `fb`, `tw`, `iframe`) VALUES
(1, 'Rajkot, Gujarat', 'https://maps.app.goo.gl/YzEFuyjJZoHpVrYu5', 91656526654, 916353751844, 'royalhotelrajkot123@gamil.com', 'https://www.instagram.com/', 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d236295.60693852534!2d70.821296!3d22.273487!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959c98ac71cdf0f%3A0x76dd15cfbe93ad3b!2sRajkot%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1752483090412!5m2!1sen!2sin');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(16, 'IMG_18195.svg', 'WiFi', 'Wi-Fi provides wireless internet access, enabling devices to connect to networks and the internet without cables. It utilizes radio waves for communication and is widely used in homes, businesses, and public spaces.'),
(17, 'IMG_19429.svg', 'Spa', 'A spa facility offers services like massages, beauty treatments, and hydrotherapy pools to promote relaxation and well-being. It\'s a place for rejuvenation and pampering, often found in hotels or resorts.'),
(18, 'IMG_60306.svg', 'Car parking', 'Hotels typically offer parking facilities, either free or paid, to accommodate guests\' vehicles. Some hotels may also provide valet parking for added convenience.'),
(19, 'IMG_39899.svg', 'Public computer', 'Public computer facilities in hotels offer guests internet access, printing, and potentially other services like faxing or scanning, often located in a business center or lobby area. These facilities enhance guest experience, particularly for those n'),
(20, 'IMG_72856.svg', 'TV', 'Hotel televisions, often free, offer local and premium channels, and sometimes interactive services like video on demand. Some hotels provide in-room entertainment, including streaming services, and information portals with local attractions.'),
(21, 'IMG_27658.svg', 'Laundry service', 'Hotels typically offer laundry service for guest clothing and hotel linens, including washing, drying, and ironing, ensuring clean and fresh items are available. Some hotels also provide dry cleaning services.'),
(23, 'IMG_45614.svg', 'CCTV', 'CCTV services for hotels include camera installation, recording, and monitoring to enhance security and deter theft or vandalism, ensuring a safe environment for guests and staff.'),
(24, 'IMG_45160.svg', 'Security Guards', 'Security guards protect hotel guests, staff, and property, ensuring safety and deterring crime through vigilant monitoring and access control. They respond to emergencies, enforce rules, and maintain a secure environment.'),
(25, 'IMG_25669.svg', '24-Hour room service', 'A hotel\'s 24-hour room service provides guests with food and beverages delivered to their rooms at any time, offering convenience and comfort. This service is a hallmark of upscale hotels, allowing guests to dine in privacy and avoid the constraints '),
(26, 'IMG_89187.svg', 'Bar', 'A hotel bar is a facility offering alcoholic and sometimes non-alcoholic beverages, often with light food, for guests and visitors. It provides a social space for relaxation and enjoyment within the hotel.');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(24, 'Cocktail kits'),
(25, 'Balcony'),
(26, 'Digital Concierge Tablets'),
(27, 'Mobile Check-in/Keyless Entry');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`, `removed`) VALUES
(10, 'Simple Room', 10, 1000, 5, 2, 2, 'zakfsdjhk;', 1, 1),
(16, 'Simple Room', 250, 1000, 10, 5, 3, 'ABCD', 1, 0),
(17, 'Deluxe Room', 300, 2000, 10, 3, 2, 'XYZ', 0, 1),
(18, 'Luxury Room', 600, 3000, 5, 4, 4, 'dadfdfdff', 1, 0),
(19, 'Supreme Deluxe Room', 500, 5000, 12, 4, 3, 'Aksdjskadsda', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rooms_facilities`
--

CREATE TABLE `rooms_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms_facilities`
--

INSERT INTO `rooms_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(50, 16, 16),
(51, 16, 18),
(52, 16, 20),
(53, 16, 23),
(54, 16, 25),
(55, 19, 16),
(56, 19, 17),
(57, 19, 19),
(58, 19, 20),
(59, 19, 21),
(60, 19, 23),
(61, 19, 24),
(62, 19, 25),
(63, 19, 26),
(64, 18, 17),
(65, 18, 18),
(66, 18, 21),
(67, 18, 23),
(68, 18, 25),
(69, 18, 26);

-- --------------------------------------------------------

--
-- Table structure for table `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(42, 16, 24),
(43, 16, 25),
(44, 19, 24),
(45, 19, 25),
(46, 19, 26),
(47, 19, 27),
(48, 18, 24),
(49, 18, 25),
(50, 18, 26),
(51, 18, 27);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
(14, 18, 'IMG_27413.jpg', 1),
(15, 16, 'IMG_72700.jpg', 1),
(16, 19, 'IMG_38102.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(250) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'Royal Hotel', 'A hotel bar is a facility offering alcoholic and sometimes non-alcoholic beverages, often with light food, for guests and visitors. It provides a social space for relaxation and enjoyment within the hotel.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team_details`
--

CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_details`
--

INSERT INTO `team_details` (`sr_no`, `name`, `picture`) VALUES
(16, 'Servais Team', 'IMG_54302.jpg'),
(17, 'Cooking Team', 'IMG_19199.jpg'),
(18, 'Reception team', 'IMG_57240.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(120) NOT NULL,
  `phonenum` bigint(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(200) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `is_verified`, `token`, `t_expire`, `status`, `datentime`) VALUES
(8, 'Zahir', 'zahirkaida72@gmail.com', 'Daiya', 6353751864, 360311, '2002-08-25', 'IMG_97970.jpeg', '$2y$10$7w6jUHbEdPFq7acMCuhIkedTY5X7Z.J0raWbBIEkEHG0NHGvuBzoC', 1, NULL, NULL, 1, '2025-08-07 13:22:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`sr_no`, `name`, `email`, `subject`, `message`, `date`, `seen`) VALUES
(10, 'Zahir', 'zahirkaida72@gamil.com', 'Projrct', 'def', '2025-07-23', 0),
(11, 'Kripal', 'Kripale67@gmail.com', 'wf', 'ef', '2025-07-23', 0),
(12, 'Zahir', 'zahirkaida72@gamil.com', 'Projrct', 'def', '2025-07-23', 0),
(13, 'Kripal', 'Kripale67@gmail.com', 'wf', 'ef', '2025-07-23', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms_facilities`
--
ALTER TABLE `rooms_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `facilities id` (`facilities_id`),
  ADD KEY `room id` (`room_id`);

--
-- Indexes for table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `features id` (`features_id`),
  ADD KEY `rm id` (`room_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `rooms_facilities`
--
ALTER TABLE `rooms_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team_details`
--
ALTER TABLE `team_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`);

--
-- Constraints for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`),
  ADD CONSTRAINT `booking_order_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `rooms_facilities`
--
ALTER TABLE `rooms_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `rm id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
