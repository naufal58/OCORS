-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2021 at 04:38 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ocors`
--

-- --------------------------------------------------------

--
-- Table structure for table `manga`
--

CREATE TABLE `manga` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `genre` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`genre`)),
  `visited` int(11) NOT NULL,
  `coverImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manga`
--

INSERT INTO `manga` (`id`, `nama`, `harga`, `deskripsi`, `genre`, `visited`, `coverImage`) VALUES
(2, 'Jujutsu Kaisen Vol 1', 5, 'Yuji Itadori is resolved to save the world from cursed spirits, but he soon learns that the best way to do it is to slowly lose his humanity and become one himself!\r\n\r\nIn a world where cursed spirits feed on unsuspecting humans, fragments of the legendary and feared demon Ryomen Sukuna were lost and scattered about. Should any demon consume Sukuna’s body parts, the power they gain could destroy the world as we know it. Fortunately, there exists a mysterious school of Jujutsu Sorcerers who exist to protect the precarious existence of the living from the supernatural!\r\n\r\nAlthough Yuji Itadori looks like your average teenager, his immense physical strength is something to behold! Every sports club wants him to join, but Itadori would rather hang out with the school outcasts in the Occult Research Club. One day, the club manages to get their hands on a sealed cursed object. Little do they know the terror they’ll unleash when they break the seal…\r\n', '[\"Action\", \"Drama\", \"Horror\", \"School Life\", \"Shounen\", \"Supernatural\"]', 94, '7.png'),
(3, 'Kimetsu no Yaiba Vol 1', 6, 'In Taisho-era Japan, Kamado Tanjiro is a kindhearted boy who makes a living selling charcoal. But his peaceful life is shattered when a demon slaughters his entire family. His little sister Nezuko is the only survivor, but she has been transformed into a demon herself! Tanjiro sets out on a dangerous journey to find a way to return his sister to normal and destroy the demon who ruined his life.\r\n\r\nLearning to slay demons won\'t be easy, and Tanjiro barely knows where to start. The surprise appearance of another boy named Giyu, who seems to know what\'s going on, might provide some answers...but only if Tanjiro can stop Giyu from killing his sister first!', '[\"Action\",\"Adventure\",\"Drama\",\"Fantasy\",\"Historical\"]', 18, 'KNY_vol1.png'),
(11, 'Kaguya-sama wa Kokurasetai Vol 1', 6, 'Two high school geniuses scheme to get the other to confess their love first.\r\n\r\nTwo geniuses. Two brains. Two hearts. One battle. Who will confess their love first…?!\r\n\r\nAs leaders of their prestigious academy’s student council, Kaguya and Miyuki are the elite of the elite! But it’s lonely at the top… Luckily for them, they’ve fallen in love! There’s just one problem—they both have too much pride to admit it. And so begins the daily scheming to get the object of their affection to confess their romantic feelings first…\r\n\r\nLove is a war you win by losing.', '[\"Comedy\",\"Drama\",\"Romance\",\"School Life\",\"Seinen\",\"Slice of Life\"]', 1, '1621952906_74ae46ba0327387250e5.png');

-- --------------------------------------------------------

--
-- Table structure for table `mangachapters`
--

CREATE TABLE `mangachapters` (
  `id` int(11) NOT NULL,
  `mangaId` int(11) NOT NULL,
  `chapters` int(11) NOT NULL,
  `readCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mangachapters`
--

INSERT INTO `mangachapters` (`id`, `mangaId`, `chapters`, `readCount`) VALUES
(1, 2, 1, 0),
(2, 2, 2, 0),
(4, 3, 1, 0),
(11, 11, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usermanga`
--

CREATE TABLE `usermanga` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `mangaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usermanga`
--

INSERT INTO `usermanga` (`id`, `userId`, `mangaId`) VALUES
(1, 4, 2),
(2, 6, 2),
(10, 5, 2),
(14, 4, 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profileImg` varchar(255) NOT NULL,
  `privilege` enum('0','1','2','3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `profileImg`, `privilege`) VALUES
(4, 'admin', '$2y$10$97ZKWY6wHi26IEx3OF7idOTp39Zdb2nt19UGHW0LoRUzNvoZzerG2', 'admin@admin.com', 'admin_60acdfbf35465.jpg', '3'),
(5, 'akun1234', '$2y$10$EIIzJnQ6uo6AbcLVKEcmf.FgDJJYzVReVGgNCy/GZATEI2NYiYcGm', 'akun1@akun1.com', 'akun1234_60aa8a24329a6.png', '0'),
(6, 'Test123', '$2y$10$cyLLoKlUlCwvCDfkE.CIOuWrXHXfvh/LLUzpXg3sltgsWUSRxBY3y', 'test123@test.com', 'Test123_60aa8af922b3f.jpg', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mangachapters`
--
ALTER TABLE `mangachapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mangachapters_ibfk_1` (`mangaId`);

--
-- Indexes for table `usermanga`
--
ALTER TABLE `usermanga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usermanga_ibfk_1` (`mangaId`),
  ADD KEY `usermanga_ibfk_2` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manga`
--
ALTER TABLE `manga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mangachapters`
--
ALTER TABLE `mangachapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `usermanga`
--
ALTER TABLE `usermanga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mangachapters`
--
ALTER TABLE `mangachapters`
  ADD CONSTRAINT `mangachapters_ibfk_1` FOREIGN KEY (`mangaId`) REFERENCES `manga` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `usermanga`
--
ALTER TABLE `usermanga`
  ADD CONSTRAINT `usermanga_ibfk_1` FOREIGN KEY (`mangaId`) REFERENCES `manga` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usermanga_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
