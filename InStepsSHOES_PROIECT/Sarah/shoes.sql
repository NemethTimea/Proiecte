-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2020 at 06:24 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoes`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorii`
--

CREATE TABLE `categorii` (
  `id` int(11) NOT NULL,
  `nume` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorii`
--

INSERT INTO `categorii` (`id`, `nume`) VALUES
(1, 'Sport'),
(2, 'Bocanci'),
(3, 'Sandale/Papuci');

-- --------------------------------------------------------

--
-- Table structure for table `marimi`
--

CREATE TABLE `marimi` (
  `id` int(11) NOT NULL,
  `idprodus` int(11) NOT NULL,
  `marime` varchar(10) NOT NULL,
  `bucati` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marimi`
--

INSERT INTO `marimi` (`id`, `idprodus`, `marime`, `bucati`) VALUES
(1, 2, 'S', 10),
(2, 2, 'M', 15),
(3, 2, 'L', 15),
(4, 2, 'XL', 21),
(5, 3, 'S', 15),
(6, 3, 'M', 3),
(7, 3, 'L', 10),
(8, 6, 'S', 10),
(9, 6, 'L', 15),
(10, 6, 'XL', 3),
(11, 5, 'S', 14),
(12, 5, 'L', 15),
(13, 7, 'S', 10),
(14, 7, 'M', 10),
(15, 7, 'L', 5),
(16, 7, 'XL', 3),
(17, 11, 'S', 9),
(18, 11, 'M', 15),
(19, 11, 'L', 15),
(20, 11, 'XL', 5),
(21, 12, 'S', 10),
(22, 12, 'L', 15),
(23, 12, 'XL', 10),
(24, 12, 'S', 10),
(25, 12, 'M', 10),
(26, 12, 'L', 15),
(27, 12, 'XL', 4),
(28, 15, 'M', 10),
(29, 15, 'L', 5),
(30, 15, 'XL', 10),
(31, 17, 'S', 5),
(32, 17, 'M', 10),
(33, 17, 'XL', 12),
(34, 21, 'S', 10),
(35, 21, 'M', 5),
(36, 21, 'L', 15),
(37, 21, 'XL', 5),
(38, 22, 'S', 10),
(39, 22, 'M', 10),
(40, 22, 'L', 15),
(41, 24, 'S', 10),
(42, 24, 'M', 5),
(43, 24, 'L', 15),
(44, 24, 'XL', 3),
(45, 26, 'S', 10),
(46, 26, 'M', 15),
(47, 26, 'L', 15),
(48, 26, 'XL', 4),
(49, 29, 'S', 10),
(50, 29, 'M', 10),
(51, 29, 'L', 15),
(52, 29, 'XL', 4),
(53, 31, 'S', 10),
(54, 31, 'M', 10),
(55, 31, 'L', 15),
(56, 31, 'XL', 4),
(57, 32, 'S', 10),
(58, 32, 'M', 10),
(59, 32, 'L', 15),
(60, 32, 'XL', 4),
(61, 34, 'S', 10),
(62, 34, 'M', 10),
(63, 34, 'L', 15),
(64, 34, 'XL', 4),
(65, 35, 'S', 10),
(66, 35, 'M', 10),
(67, 35, 'L', 15),
(68, 35, 'XL', 4),
(69, 36, 'S', 10),
(70, 36, 'M', 10),
(71, 36, 'L', 15),
(72, 36, 'XL', 4),
(73, 37, 'S', 10),
(74, 37, 'M', 10),
(75, 37, 'L', 15),
(76, 37, 'XL', 4),
(77, 38, 'S', 10),
(78, 38, 'M', 10),
(79, 38, 'L', 15),
(80, 38, 'XL', 4),
(81, 39, 'S', 10),
(82, 39, 'M', 10),
(83, 39, 'L', 15),
(84, 39, 'XL', 4),
(85, 40, 'S', 10),
(86, 40, 'M', 10),
(87, 40, 'L', 15),
(88, 40, 'XL', 4),
(89, 41, 'S', 10),
(90, 41, 'M', 10),
(91, 41, 'L', 15),
(92, 41, 'XL', 4),
(93, 42, 'S', 10),
(94, 42, 'M', 10),
(95, 42, 'L', 15),
(96, 42, 'XL', 4),
(97, 43, 'S', 10),
(98, 43, 'M', 10),
(99, 43, 'L', 15),
(100, 43, 'XL', 4),
(101, 44, 'S', 10),
(102, 44, 'M', 10),
(103, 44, 'L', 15),
(104, 44, 'XL', 4),
(105, 45, 'S', 10),
(106, 45, 'M', 10),
(107, 45, 'L', 15),
(108, 45, 'XL', 4),
(109, 46, 'S', 10),
(110, 46, 'M', 10),
(111, 46, 'L', 15),
(112, 46, 'XL', 4),
(113, 47, 'S', 10),
(114, 47, 'M', 10),
(115, 47, 'L', 15),
(116, 47, 'XL', 4),
(117, 48, 'S', 10),
(118, 48, 'M', 10),
(119, 48, 'L', 15),
(120, 48, 'XL', 4),
(121, 49, 'S', 10),
(122, 49, 'M', 10),
(123, 49, 'L', 15),
(124, 49, 'XL', 4),
(125, 50, 'S', 10),
(126, 50, 'M', 10),
(127, 50, 'L', 15),
(128, 50, 'XL', 4),
(129, 51, 'S', 10),
(130, 51, 'M', 10),
(131, 51, 'L', 15),
(132, 51, 'XL', 4),
(133, 52, 'S', 10),
(134, 52, 'M', 10),
(135, 52, 'L', 15),
(136, 52, 'XL', 4),
(137, 53, 'S', 10),
(138, 53, 'M', 10),
(139, 53, 'L', 15),
(140, 53, 'XL', 4),
(141, 54, 'S', 10),
(142, 54, 'M', 10),
(143, 54, 'L', 15),
(144, 54, 'XL', 4),
(153, 64, 'L', 25),
(154, 65, 'S', 13),
(155, 66, 'M', 15);

-- --------------------------------------------------------

--
-- Table structure for table `produse`
--

CREATE TABLE `produse` (
  `id` int(11) NOT NULL,
  `categorie` int(11) NOT NULL,
  `nume` varchar(200) NOT NULL,
  `pret` int(11) NOT NULL,
  `poza` varchar(100) NOT NULL,
  `poza2` varchar(200) NOT NULL,
  `nou` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produse`
--

INSERT INTO `produse` (`id`, `categorie`, `nume`, `pret`, `poza`, `poza2`, `nou`) VALUES
(1, 1, 'Adidas Neo', 400, 'Adidas_Neo.jpg', 'Adidas_Neo2.jpg', 0),
(2, 1, 'Adidas Originals', 200, 'Adidas_Originals.jpg', 'Adidas_Originals2.jpg', 1),
(3, 1, 'Adidas Performance', 350, 'Adidas_Performance.jpg', 'Adidas_Performance2.jpg', 0),
(5, 1, 'Adidas Ultraboost', 268, 'Adidas_Ultraboost.jpg', 'Adidas_Ultraboost2.jpg', 1),
(6, 1, 'Calvin Klein', 356, 'Calvin_Klein_.jpg', 'Calvin_Klein_.jpg', 1),
(7, 1, 'Calvin Klein White', 425, 'Calvin_Klein_feher.jpg', 'Calvin_Klein_feher.jpg', 0),
(11, 1, 'Calvin Klein Black', 450, 'Calvin_Klein_l.jpg', 'Calvin_Klein_l.jpg', 0),
(12, 1, 'Converse All Star', 250, 'Converse_All_Star.jpg', 'Converse_All_Star2.jpg', 0),
(15, 1, 'Converse Chuck', 200, 'Converse_Chuck.jpg', 'Converse_Chuck2.jpg', 0),
(17, 1, 'Converse Chuck Taylor', 270, 'Converse_Chuck_Taylor.jpg', 'Converse_Chuck_Taylor2.jpg', 0),
(21, 1, 'Nike Air Vapormax', 499, 'Nike Air Vapormax.jpg', 'Nike Air Vapormax2.jpg', 1),
(22, 1, 'Nike Air Max', 299, 'Nike_WMNS_Air_Max.jpg', 'Nike_WMNS_Air_Max2.jpg', 0),
(24, 1, 'Adidas Campus', 360, 'Pantofi_Adidas_Campus.jpg', 'Pantofi_Adidas_Campus2.jpg', 0),
(26, 1, ' Adidas Superstar', 290, 'Pantofi_Adidas_Superstar.jpg', 'Pantofi_Adidas_Superstar2.jpg', 1),
(29, 1, 'Pantofi Nike Classic Cortez', 390, 'Pantofi_Nike_Classic_Cortez.jpg', 'Pantofi_Nike_Classic_Cortez2.jpg', 1),
(31, 1, 'Converse Chuck', 290, 'Tenisi_Converse_Chuck.jpg', 'Tenisi_Converse_Chuck2.jpg', 0),
(32, 1, 'New Balance', 250, 'New_Balance.jpg', 'New_Balance2.jpg', 0),
(34, 1, 'Chuck Taylor', 460, 'Chuck_Taylor.jpg', 'Chuck_Taylor2.jpg', 1),
(35, 1, 'Puma Muse Maia', 390, 'Puma_Muse_Maia.jpg', 'Puma_Muse_Maia2.jpg', 1),
(36, 1, 'Puma White Gold', 490, 'Puma_WhiteGold.jpg', 'Puma_WhiteGold2.jpg', 1),
(37, 3, 'Slides Calvin Klein', 250, 'Papucs_CalvinKlein.jpg', 'Papucs_CalvinKlein2.jpg', 0),
(38, 3, 'Adidas Slides Pink', 200, 'Papucs_Adidas.jpg', 'Papucs_Adidas2.jpg', 0),
(39, 3, 'Nike Slides ', 230, 'Papucs_Nike.jpg', 'Papucs_Nike2.jpg', 1),
(40, 3, 'Slides Pink Puff', 290, 'Papucs_Pink_Puff.jpg', 'Papucs_Puma_Puff2.jpg', 1),
(41, 3, 'Slides Puma Pink', 300, 'Papucs_Puma_Pink.jpg', 'Papucs_Puma_Pink.jpg', 0),
(42, 3, 'Sandal Nike Grey', 390, 'Szanda_Nike_Grey.jpg', 'Szanda_Nike_Grey2.jpg', 1),
(43, 3, 'Sandal Calvin Klein Red', 260, 'Szandal_CalvinKlein_Bordo.jpg', 'Szandal_CalvinKlein_Bordo2.jpeg', 0),
(44, 3, 'Sandal Clavin Klein Grey', 360, 'Szandal_ClavinKlein.jpg', 'Szandal_ClavinKlein2.jpg', 0),
(45, 3, 'Sandal Nike Pink', 220, 'Szandal_Nike_Pink.jpg', 'Szandal_Nike_Pink2.jpg', 0),
(46, 1, 'Converse All Star Purple', 260, 'Converse_All_Star_Purple2.jpg', 'Converse_All_Star_Purple.jpg', 0),
(47, 2, 'Boots Nike Yellow', 300, 'Boots_Nike_Yellow2.jpg', 'Boots_Nike_Yellow.jpg', 1),
(48, 2, 'Calvin Klein Boots Black', 280, 'CalvinKlein_Boots_Black2.jpg', 'CalvinKlein_Boots_Black.jpg', 0),
(49, 2, 'Calvin Klein Boots LightBlue', 370, 'CalvinKlein_Boots_LightBlue2.jpg', 'CalvinKlein_Boots_LightBlue.jpg', 0),
(50, 2, 'Calvin Klein Boots White', 300, 'CalvinKlein_Boots_White.jpg', 'CalvinKlein_Boots_White2.jpg', 0),
(51, 2, 'NewBalance Brown', 290, 'NewBalance_Brown.jpg', 'NewBalance_Brown2.jpg', 0),
(52, 2, 'Nike Boots DSD232', 360, 'Nike_Boots_DSD232.jpg', 'Nike_Boots_DSD23.jpg', 0),
(53, 2, 'Adidas_Boots_344', 280, 'Adidas_Boots.jpg', 'Adidas_Boots.jpg', 0),
(54, 2, 'Adidas_Boots_Yellow', 380, 'Adidas_Boots_Yellow.jpg', 'Adidas_Boots_Yellow.jpg', 0),
(66, 1, 'Nike Black', 156, 'Pantofi_Nike_Black.jpg', 'Pantofi_Nike_Black2.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori`
--

CREATE TABLE `utilizatori` (
  `id` int(11) NOT NULL,
  `tipus` varchar(200) NOT NULL,
  `nev` varchar(200) NOT NULL,
  `keresztnev` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `varos` varchar(200) NOT NULL,
  `megye` varchar(200) NOT NULL,
  `datum` date NOT NULL,
  `fnev` varchar(200) NOT NULL,
  `kod` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilizatori`
--

INSERT INTO `utilizatori` (`id`, `tipus`, `nev`, `keresztnev`, `email`, `varos`, `megye`, `datum`, `fnev`, `kod`) VALUES
(3, 'fiz', 'Horvath', 'Brigitta', 'horvathbrigita@gmail.com', 'Arad', 'Arad', '2000-11-15', 'brigi', '1234'),
(4, 'fiz', 'Nemeth', 'Timea', 'srh.nemeth@gmail.com', 'Timisoara', 'Timis', '2000-11-21', 'timi', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `vanzari`
--

CREATE TABLE `vanzari` (
  `id` int(11) NOT NULL,
  `numeprodus` varchar(200) NOT NULL,
  `numar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vanzari`
--

INSERT INTO `vanzari` (`id`, `numeprodus`, `numar`) VALUES
(8, 'Adidas Originals', 6),
(9, 'Calvin Klein', 9),
(10, ' Adidas Superstar', 18),
(11, 'Puma Muse Maia', 18),
(12, 'Puma White Gold', 54),
(13, 'Nike Air Vapormax', 4),
(14, 'Slides Pink Puff', 6),
(15, 'Sandal Nike Grey', 14),
(16, 'Boots Nike Yellow', 8),
(17, 'Pantofi Nike Classic Cortez', 5),
(18, 'Nike Air Max', 20),
(19, 'Sandal Nike Pink', 14),
(20, 'Sandal Calvin Klein Red', 66),
(21, 'Calvin Klein Boots LightBlue', 40),
(22, 'Adidas Performance', 68),
(23, 'Adidas Campus', 24),
(24, 'NewBalance Brown', 56),
(25, 'Slides Puma Pink', 60),
(26, 'Converse All Star', 88),
(27, 'Converse Chuck', 104),
(28, 'Converse Chuck Taylor', 210),
(30, 'Nike Black', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorii`
--
ALTER TABLE `categorii`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `marimi`
--
ALTER TABLE `marimi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `produse`
--
ALTER TABLE `produse`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `utilizatori`
--
ALTER TABLE `utilizatori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `vanzari`
--
ALTER TABLE `vanzari`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorii`
--
ALTER TABLE `categorii`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `marimi`
--
ALTER TABLE `marimi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `produse`
--
ALTER TABLE `produse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `utilizatori`
--
ALTER TABLE `utilizatori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vanzari`
--
ALTER TABLE `vanzari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
drop table incos;
create table if not exists incos(
	id int not null AUTO_INCREMENT,
  uid int not null,
  username varchar(32) not null,
  nume varchar(32) not null,
  poza varchar(300) not null,
  pret int not null,
  marime varchar(2) not null,
  bucati int not null,
  primary key(id)
);
