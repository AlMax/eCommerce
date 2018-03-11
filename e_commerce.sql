-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net

-- Host: 127.0.0.1
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
CREATE DATABASE IF NOT EXISTS `e_commerce` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `e_commerce`;

-- --------------------------------------------------------

--
-- Table structure for table `acquisti`
--

DROP TABLE IF EXISTS `acquisti`;
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
(5, '2018-02-26', '2018-01-01', 5, '3', '2'),
(16, '2018-02-26', '2018-02-26', 2, '1', '2'),
(19, '2018-02-26', '2018-03-01', 3, '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `clienti`
--

DROP TABLE IF EXISTS `clienti`;
CREATE TABLE `clienti` (
  `codice_cliente` int(5) NOT NULL,
  `cognome` varchar(10) NOT NULL,
  `nome` varchar(10) NOT NULL,
  `indirizzo` varchar(20) NOT NULL,
  `citta` varchar(10) NOT NULL,
  `CAP` int(5) NOT NULL,
  `telefono` int(10) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `clienti`:
--

--
-- Dumping data for table `clienti`
--

INSERT INTO `clienti` (`codice_cliente`, `cognome`, `nome`, `indirizzo`, `citta`, `CAP`, `telefono`, `username`, `password`) VALUES
(2, 'Maqsood', 'Ali Haider', 'Antonio Bianchi', 'Brescia', 25124, 320014140, 'AlMax', 'maqsood98'),
(11, 'Quare', 'Miky', 'nave', 'nave', 0, 35456511, 'mikelazzo', 'ok'),
(12, 'Murdocca', 'Mirko', 'AAAAAA', 'Caino', 25070, 2147483647, 'thetruemir', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `prodotti`
--

DROP TABLE IF EXISTS `prodotti`;
CREATE TABLE `prodotti` (
  `codice_prodotto` int(5) NOT NULL,
  `denominazione` varchar(15) NOT NULL,
  `descrizione` text NOT NULL,
  `prezzo` decimal(4,0) NOT NULL,
  `quantita` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `prodotti`:
--

--
-- Dumping data for table `prodotti`
--

INSERT INTO `prodotti` (`codice_prodotto`, `denominazione`, `descrizione`, `prezzo`, `quantita`) VALUES
(1, 'Coseh', 'ah boh, sono delle cose', '100', 42),
(2, 'scarpa trash', 'fa schifo', '2', 15),
(3, 'Gioco fygo', 'è stra bello', '80', 68);

-- --------------------------------------------------------

--
-- Table structure for table `responsabili`
--

DROP TABLE IF EXISTS `responsabili`;
CREATE TABLE `responsabili` (
  `id_responsabile` int(11) NOT NULL,
  `dipartimento` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `responsabili`:
--

--
-- Dumping data for table `responsabili`
--

INSERT INTO `responsabili` (`id_responsabile`, `dipartimento`, `password`) VALUES
(1, 'magazzino', 'Mag'),
(2, 'marketing', 'Mark'),
(3, 'spedizioni', 'Spedi'),
(4, 'ordinazioni', 'Ordi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acquisti`
--
ALTER TABLE `acquisti`
  ADD PRIMARY KEY (`codice_acquisto`);

--
-- Indexes for table `clienti`
--
ALTER TABLE `clienti`
  ADD PRIMARY KEY (`codice_cliente`);

--
-- Indexes for table `prodotti`
--
ALTER TABLE `prodotti`
  ADD PRIMARY KEY (`codice_prodotto`);

--
-- Indexes for table `responsabili`
--
ALTER TABLE `responsabili`
  ADD PRIMARY KEY (`id_responsabile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acquisti`
--
ALTER TABLE `acquisti`
  MODIFY `codice_acquisto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `clienti`
--
ALTER TABLE `clienti`
  MODIFY `codice_cliente` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `prodotti`
--
ALTER TABLE `prodotti`
  MODIFY `codice_prodotto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `responsabili`
--
ALTER TABLE `responsabili`
  MODIFY `id_responsabile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Metadata
--
USE `phpmyadmin`;
