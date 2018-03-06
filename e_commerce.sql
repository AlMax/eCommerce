-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2018 at 09:30 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `acquisti`
--

CREATE TABLE `acquisti` (
  `codice_acquisto` int(5) NOT NULL,
  `data_ordine` date NOT NULL,
  `data_spedizione` date DEFAULT NULL,
  `quantita` int(11) NOT NULL,
  `prodotto` varchar(5) NOT NULL,
  `cliente` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `acquisti`:
--   `cliente`
--       `clienti` -> `codice_cliente`
--   `prodotto`
--       `prodotti` -> `codice_prodotto`
--

--
-- Dumping data for table `acquisti`
--

INSERT INTO `acquisti` (`codice_acquisto`, `data_ordine`, `data_spedizione`, `quantita`, `prodotto`, `cliente`) VALUES
(5, '2018-02-26', '2018-01-01', 3, '3', '2'),
(16, '2018-02-26', '2018-02-26', 2, '1', '2'),
(19, '2018-02-26', NULL, 3, '2', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acquisti`
--
ALTER TABLE `acquisti`
  ADD PRIMARY KEY (`codice_acquisto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acquisti`
--
ALTER TABLE `acquisti`
  MODIFY `codice_acquisto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Metadata
--
USE `phpmyadmin`;

--
-- Metadata for acquisti
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
