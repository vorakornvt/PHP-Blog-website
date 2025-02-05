-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 10, 2024 at 10:45 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artifymember`
--

-- --------------------------------------------------------

--
-- Table structure for table `artReview`
--

CREATE TABLE `artReview` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `imageurl` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `artistName` varchar(255) DEFAULT NULL,
  `idUsers` int(11) NOT NULL,
  `years` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artReview`
--

INSERT INTO `artReview` (`id`, `title`, `imageurl`, `description`, `artistName`, `idUsers`, `years`) VALUES
(8, 'Michael Angelo\'s painting ', 'https://images.unsplash.com/flagged/photo-1572392640988-ba48d1a74457?q=80&w=2160&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Michael Angelo\'s painting on top of the Palace of Versailles', 'Michael Angelo', 1, 2019),
(9, 'Mountain mocking bird', 'https://images.unsplash.com/photo-1579762715118-a6f1d4b934f1?q=80&w=2184&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Mountain mocking bird,Varied thrush, male & female,Orpheus montanus. ', 'Audubon, John James', 1, 1785),
(10, 'black haired woman', 'https://images.unsplash.com/photo-1554139681-1adb48e035cb?q=80&w=2865&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'black haired woman painting on wall', 'Raghav Modi', 1, 2019),
(11, 'Portrait of a Woman', 'https://images.unsplash.com/photo-1576503918400-0b982e6a98bf?q=80&w=2273&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Portrait of a Woman, 1638-39 by Guido Reni. The subject may represent Artemisia II of Caria (d.350 BC) wife of Mausolus, the governor of Caria in Asia Minor. After the death of her husband, she mixed his ashes in liquid which she drank, making herself a living tomb. The story was used as a symbol of a widow\'s devotion to her husband\'s memory.', 'Guido Reni', 3, 1638),
(12, 'L\'Eau 221', 'https://images.unsplash.com/photo-1583325033548-1eeacdb0b16e?q=80&w=2596&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Art Deco - A colour plate entitled \"L\'Eau\" from Falbalas & fanfreluches : almanach des modes présentes, passées et futures.', 'Falbalas & fanfreluches ', 4, 2020),
(13, 'A Girl with Flowers on the Grass.', 'https://images.unsplash.com/photo-1579783928621-7a13d66a62d1?q=80&w=2790&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'A Girl with Flowers on the Grass. Creator: Maris. Creation Date: 1878. Institution: Rijksmuseum. Provider: Rijksmuseum. Providing Country: Netherlands. PD for Public Domain Mark 2', ' Maris', 1, 1878);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `uidUsers` varchar(128) NOT NULL,
  `emailUsers` varchar(128) NOT NULL,
  `pwdUsers` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsers`, `uidUsers`, `emailUsers`, `pwdUsers`) VALUES
(1, 'SparkleUnicorn23', 'sparkleunicorn23@example.com', '$2y$10$rklHJ5lBmcIznwzg26tzEeMh801vSZQK4HFFfFuhLecVmFFAVN.ke'),
(2, 'lin', 'lin@lin.com', '$2y$10$69uGPs.lshLVVFkW/u/5zu4.g0TNsICEgLfGFFU1IuKsNt6DeeXLa'),
(3, 'HadidModel180', 'HadidModel180@test.com', '$2y$10$pW4aQtwQ9/lLp4AAL8cq.eZWhNgfzSrtIAKNQSL3sa.zZBI6k6V9W'),
(4, 'frankFicton1996', 'frankFicton1996@test.com', '$2y$10$eiMfvCQlJj.qbn0cC76ci.Yw7p3iWeBTSzyzpCl.FvDNz0yH3Ekzu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artReview`
--
ALTER TABLE `artReview`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsers` (`idUsers`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artReview`
--
ALTER TABLE `artReview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artReview`
--
ALTER TABLE `artReview`
  ADD CONSTRAINT `artreview_ibfk_1` FOREIGN KEY (`idUsers`) REFERENCES `users` (`idUsers`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
