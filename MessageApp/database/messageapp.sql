-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 09 Mar 2021, 12:49:56
-- Sunucu sürümü: 10.4.17-MariaDB
-- PHP Sürümü: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `messageapp`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `friends`
--

CREATE TABLE `friends` (
  `FriendShipId` int(10) NOT NULL,
  `MemberID` int(10) NOT NULL,
  `FriendID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `friends`
--

INSERT INTO `friends` (`FriendShipId`, `MemberID`, `FriendID`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 1, 3),
(4, 2, 4),
(5, 4, 2),
(6, 3, 4),
(7, 4, 3),
(8, 3, 1),
(9, 2, 3),
(10, 3, 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `members`
--

CREATE TABLE `members` (
  `MemberID` int(3) NOT NULL,
  `FirstName` varchar(33) NOT NULL,
  `LastName` varchar(33) NOT NULL,
  `Title` varchar(33) NOT NULL,
  `ImagePath` varchar(50) DEFAULT NULL,
  `Email` varchar(33) NOT NULL,
  `Password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `members`
--

INSERT INTO `members` (`MemberID`, `FirstName`, `LastName`, `Title`, `ImagePath`, `Email`, `Password`) VALUES
(1, 'Thomas', 'Edison', 'Engineer', 'thomas_edison.png', 'thomas@edison.bom', '1234'),
(2, 'Nikola', 'Tesla', 'Engineer', 'nikola_tesla.png', 'nikola@tesla.bom', '1234'),
(3, 'Albert', 'Einstein', 'Physicist', 'albert_einstein.png', 'albert@einstein.bom', '1234'),
(4, 'Alan', 'Turing', 'Programmer', 'alan_turing.png', 'alan@turing.bom', '1234');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messages`
--

CREATE TABLE `messages` (
  `MessageId` int(10) NOT NULL,
  `Sender` int(10) NOT NULL,
  `Receiver` int(10) NOT NULL,
  `Content` text NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`FriendShipId`);

--
-- Tablo için indeksler `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`MemberID`) USING BTREE;

--
-- Tablo için indeksler `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MessageId`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `friends`
--
ALTER TABLE `friends`
  MODIFY `FriendShipId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `members`
--
ALTER TABLE `members`
  MODIFY `MemberID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `messages`
--
ALTER TABLE `messages`
  MODIFY `MessageId` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
