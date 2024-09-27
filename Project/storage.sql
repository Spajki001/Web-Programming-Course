-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 27, 2024 at 06:00 AM
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
-- Database: `storage`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(5) NOT NULL,
  `article` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `amount` int(5) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `article`, `description`, `amount`, `price`, `image_path`) VALUES
(1, 'Samsung Galaxy S24', 'Galaxy AI je ovdje\r\n\r\nDobro došli u eru mobilne umjetne inteligencije. Uz Galaxy S24 u Vašim rukama, možete osloboditi potpuno nove razine kreativnosti, produktivnosti i mogućnosti – počevši od najvažnijeg uređaja u Vašem životu. Vašeg pametnog telefona.\r\n\r\nPrihvatite svaku krivulju\r\nJednostavno držanje. Zadovoljavajuće držanje. Sa svojim unificiranim dizajnom i satenskom završnom obradom, Galaxy S24 uređaji glatki su baš onako kako i izgledaju.\r\n\r\nVelik, veći i brži\r\n\r\nTo su nadogradnje koje ste čekali. Veći zaslon. Više baterije. Više procesorske snage. Toliko toga što ćete voljeti na Galaxy S24 uređaju.\r\n\r\nOsnažite detalje s ProVisual tehnologijom\r\n\r\n50MP. Mega mega pikseli\r\nPrava snaga piksela koja Vas neće razočarati. Nikad. Snimite slike visoke rezolucije koje će bez sumnje izdržati test vremena u godinama koje dolaze.\r\n\r\nSnimajte daleko. Čak i u mraku\r\nSnimite svijetle, šarene i jasne fotografije, čak i u mraku uz AI ISP. Napokon, portreti o kojima ste sanjali.', 23, '931.00', 'article_images/SamsungGalaxyS24.jpg'),
(2, 'Samsung Galaxy S23 5G', 'Mobitel Samsung Galaxy S23 5G, 6.1\", Octa-core, 8GB/128GB, 50MP+10MP+12MP/12MP, Android 13, crni (SM-S911BZKDEUE)', 150, '820.00', 'article_images/SamsungGalaxyS23.webp'),
(4, 'Dell XPS 13 9320', 'Laptop Dell XPS 13 9320, 13.4\" InfinityEdge FHD+, Intel Core i7-1185G7, 16GB/512GB, Windows 11 Home, Platinum Silver (9320-D701P)', 20, '1399.00', 'article_images/DellXPS139320.jpg'),
(5, 'LG Ultrafine 5K 27-inch', 'Monitor LG Ultrafine 5K 27-inch, 27\" 5120x2880px, IPS, Thunderbolt 3, Space Gray (27MD5K-B)', 8, '1299.00', 'article_images/LgUltrafine5k27.jpg'),
(6, 'Samsung Odyssey Neo G9', 'Monitor Samsung Odyssey Neo G9, 49\" 5120x1440px, Mini-LED, 240Hz, Quantum Dot, Black (LC49AG950NRXEN)', 12, '1999.00', 'article_images/SamsungOdysseyNeoG9.jpeg'),
(7, 'Google Pixel 7 Pro', 'Smartphone Google Pixel 7 Pro, 6.7\" LTPO OLED 1440x3120px, Google Tensor G2, 12GB/128GB, 50MP+48MP+12MP/12MP, Android 13, Obsidian (GA0487-4NA)', 30, '899.00', 'article_images/GooglePixel7Pro.jpg'),
(8, 'OnePlus 11', 'Smartphone OnePlus 11, 6.7\" LTPO AMOLED 1440x3216px, Qualcomm Snapdragon 8 Gen 2, 16GB/256GB, 50MP+48MP+32MP/16MP, Android 13, Eternal Green (PHK1001)', 25, '799.00', 'article_images/OnePlus11.png'),
(9, 'Apple Watch Series 8', 'Smartwatch Apple Watch Series 8, 45mm, Always-On Retina LTPO OLED, S8 SiP, WatchOS 9, Midnight (MNKJ3LL/A)', 40, '449.00', 'article_images/AppleWatchSeries8.jpg'),
(10, 'Samsung Galaxy Watch 5 Pro', 'Smartwatch Samsung Galaxy Watch 5 Pro, 45mm, Super AMOLED, Exynos W920, Wear OS 3, Black (SM-R915NZSAXAR)', 35, '399.00', 'article_images/SamsungGalaxyWatch5Pro.avif'),
(11, 'Sony WH-1000XM5', 'Headphones Sony WH-1000XM5, Noise-Cancelling, Bluetooth, 360 Reality Audio, Black (WH-1000XM5/B)', 28, '349.00', 'article_images/SonyWH-1000XM5.avif'),
(12, 'Sonos Roam', 'Speaker Sonos Roam, Portable, Bluetooth, Wi-Fi, IP67 water/dust resistance, Black (103971)', 18, '179.00', 'article_images/SonosRoam.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `e_mail` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `e_mail`, `username`, `password`, `role`) VALUES
(3, 'User', 'User', 'user@ferit.hr', 'user', '$2y$12$c65hLbCUUne/UDoTSRM.oOZZF14zb9QXXzmFsX1k9u6QyuxQ7XSiS', 'user'),
(4, 'Admin', 'Admin', 'admin@ferit.hr', 'admin', '$2y$12$ClVBL1dN89yT4aKCQG2Dv.rf8aBstnhudPcDlXTGVEX0Uu0h.R1dG', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
