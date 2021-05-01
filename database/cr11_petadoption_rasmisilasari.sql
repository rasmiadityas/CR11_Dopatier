-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2021 at 04:47 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11_petadoption_rasmisilasari`
--
CREATE DATABASE IF NOT EXISTS `cr11_petadoption_rasmisilasari` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cr11_petadoption_rasmisilasari`;

-- --------------------------------------------------------

--
-- Table structure for table `adopt`
--

CREATE TABLE `adopt` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `petID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adopt`
--

INSERT INTO `adopt` (`id`, `userID`, `petID`) VALUES
(1, 3, 2),
(2, 4, 5),
(3, 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `picture` text NOT NULL,
  `locStreet` varchar(50) NOT NULL,
  `locZip` int(4) NOT NULL,
  `locCity` varchar(20) NOT NULL,
  `descript` text NOT NULL,
  `age` int(2) NOT NULL,
  `breed` varchar(50) NOT NULL,
  `hobby` text NOT NULL,
  `size` varchar(5) NOT NULL,
  `status` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`id`, `name`, `picture`, `locStreet`, `locZip`, `locCity`, `descript`, `age`, `breed`, `hobby`, `size`, `status`) VALUES
(1, 'Anna', 'https://petkeen.com/wp-content/uploads/2021/02/Light-Gray-German-Angora-Rabbit_Hidden-Springs-Farm_Shutterstock-e1612565280404.jpg', 'Floridusgasse 47', 3124, 'Wetzlarn', 'Always healthy, Alerted around stranger, Needs constant attention', 4, 'Angora Rabbit', 'Sunbathing by the window', 'Small', 'Available'),
(2, 'Beth', 'https://upload.wikimedia.org/wikipedia/commons/7/7a/PhodopusSungorus_1.jpg', 'Fehringer Strasse 30', 3250, 'Marbach', 'Always healthy, Relaxed around stranger, Needs constant attention', 4, 'Dwarf Hamster', 'Running inside the wheel', 'Small', 'Reserved'),
(3, 'Clara', 'https://cdn.shopify.com/s/files/1/0039/4647/9689/articles/Buff-Orpington_d38fa031-73e2-4d6c-af6a-95e004ab3e19_600x.jpg?v=1543593273', 'Kaisergasse 47', 4730, 'Laab', 'Had major illness, Alerted around stranger, Needs constant attention', 6, 'Orpington Chicken', 'Attacking the car', 'Small', 'Available'),
(4, 'Diane', 'https://2.bp.blogspot.com/-dVCuw-NdPMQ/V4z-P9c8oQI/AAAAAAAACGc/J5icJqxPfJ86JJqmtukY4Usplri_rWhvwCLcB/s600/Magpie%2BDuck.jpg', 'Marktgasse 97', 5162, 'Mühlbach', 'Always healthy, Relaxed around stranger, Needs moderate attention', 5, 'Magpie Duck', 'Sleeping in front of the door', 'Small', 'Available'),
(5, 'Emma', 'https://www.petmd.com/sites/default/files/styles/article_image/public/white-persian-cats-picture-id637190306.jpg', 'Stadtplatz 54', 5591, 'Ramingstein', 'Had minor illness, Scared around stranger, Needs minimal attention', 6, 'Persian Cat', 'Playing with mouse doll', 'Small', 'Reserved'),
(6, 'Fanny', 'https://i.pinimg.com/originals/89/06/6d/89066d6a564e7b8a68300945a0fc097a.jpg', 'Kelsenstrasse 25', 4571, 'Klaus', 'Had major illness, Scared around stranger, Needs constant attention', 5, 'Samoyed Dog', 'Charging into guest', 'Large', 'Reserved'),
(7, 'Gina', 'https://www.propferd.at/download/files/%7BCC1FDD8B-E985-48BB-89E8-4C2D192CDF04%7D/Rum-Sattel.jpg', 'Landstrasse 75', 3925, 'Etlas', 'Had major illness, Scared around stranger, Needs minimal attention', 7, 'Highland Pony', 'Watching the sunset', 'Large', 'Available'),
(8, 'Hannah', 'https://upload.wikimedia.org/wikipedia/commons/a/a6/Lincoln_Longwool_Lamb.jpg', 'Wachaustrasse 23', 4624, 'Weissbach', 'Always healthy, Scared around stranger, Needs minimal attention', 7, 'Lincoln Sheep', 'Staring into space', 'Large', 'Available'),
(9, 'Issa', 'https://s3.amazonaws.com/newhobbyfarms.com/wp-content/uploads/04234008/suri-alpaca_JD-Lasica-Flickr-600x338.jpg', 'Bundesstrasse 87', 4293, 'Hinterberg', 'Had minor illness, Scared around stranger, Needs constant attention', 8, 'Suri Alpaca', 'Eating every flower', 'Large', 'Available'),
(10, 'Jane', 'https://cff2.earth.com/uploads/2019/02/04123259/Few-grow-good-The-strange-story-of-the-domestication-of-the-fox-730x410.jpg', 'Glocknerstrasse 19', 8591, 'Hochgössnitz', 'Had minor illness, Alerted around stranger, Needs minimal attention', 6, 'Siberian Fox', 'Chasing the robotic vaccuum cleaner', 'Large', 'Available'),
(11, 'Kenny', 'https://i.pinimg.com/originals/e2/98/e1/e298e195157ed829b90b710a9f9559d2.jpg', 'Bräuhof 60', 4963, 'Aselkam', 'Had minor illness, Alerted around stranger, Needs moderate attention', 11, 'Catalan Donkey', 'Following anyone around', 'Large', 'Available'),
(12, 'Lana', 'https://www.zooroyal.de/magazin/wp-content/uploads/2019/04/shire-horse-760x560.jpg', 'Huttenstrasse 62', 8842, 'Triebendorf', 'Always healthy, Scared around stranger, Needs minimal attention', 11, 'Shire Horse', 'Banging head on to the fence', 'Large', 'Available'),
(13, 'May', 'https://upload.wikimedia.org/wikipedia/commons/f/f3/Hereford_bull_large.jpg', 'Kuefsteinstrasse 18', 8641, 'Sankt Lorenzen', 'Had minor illness, Scared around stranger, Needs moderate attention', 9, 'Hereford Cow', 'Walking in a circle', 'Large', 'Available'),
(14, 'Nina', 'https://www.bethlueders.com/wp-content/uploads/2020/01/1635627-L.jpg', 'Auenweg 70', 4320, 'Pragtal', 'Had minor illness, Alerted around stranger, Needs moderate attention', 10, 'Painted Turtle', 'Meditating at a corner', 'Small', 'Available'),
(15, 'Oliv', 'https://parrotquaker.com/wp-content/uploads/2020/11/508px-Eclectus_Parrot_Eclectus_roratus_-6-4c-Female-e1604610570685.jpg', 'Gumpendorfer Strasse 26', 3141, 'Katzenberg', 'Always healthy, Relaxed around stranger, Needs minimal attention', 9, 'Eclectus Parrot', 'Singing in the morning', 'Small', 'Available'),
(16, 'Penny', 'https://www.koi-garden.at/media/image/product/1511/md/tamasaba-fac-simile_12.jpg', 'Lendplatz 51', 4560, 'Hausmanning', 'Always healthy, Scared around stranger, Needs constant attention', 10, 'Tamasaba Goldfish', 'Hiding behind the aqua plants', 'Small', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `password`, `date_of_birth`, `email`, `picture`, `status`) VALUES
(1, 'Rasmi', 'Silasari', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1988-10-08', 'rasmi@mail.com', '6086b1063c3f3.jpg', 'user'),
(2, 'Toscha', 'Allugrof', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1980-08-09', 'toscha@mail.com', 'avatar.png', 'adm'),
(3, 'Arla', 'Rezqi', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1990-02-04', 'arla@mail.com', '6086b273f24f9.jpg', 'user'),
(4, 'Ulfah', 'Nurjan', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1992-02-12', 'ulfah@mail.com', '608cd3a01bc31.png', 'user'),
(5, 'Evi', 'Mulyan', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1988-07-05', 'evi@mail.com', 'avatar.png', 'user'),
(6, 'Syifa', 'Muller', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1988-09-10', 'syifa@mail.com', '608c2430ad480.jpg', 'user'),
(7, 'Terra', 'Silverion', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1990-08-19', 'terra@mail.com', '608c2b3cea6e8.jpg', 'adm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adopt`
--
ALTER TABLE `adopt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `petID` (`petID`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adopt`
--
ALTER TABLE `adopt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adopt`
--
ALTER TABLE `adopt`
  ADD CONSTRAINT `adopt_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adopt_ibfk_2` FOREIGN KEY (`petID`) REFERENCES `pet` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
