-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2022 at 08:07 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistema-atm`
--

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `cl_cod` int(11) NOT NULL,
  `cl_nome` varchar(50) DEFAULT NULL,
  `cl_apelido` varchar(30) DEFAULT NULL,
  `cl_BI` varchar(30) DEFAULT NULL,
  `cl_morada` varchar(150) DEFAULT NULL,
  `cl_sexo` enum('M','F') DEFAULT NULL,
  `cl_celular` int(11) DEFAULT NULL,
  `cl_email` varchar(100) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`cl_cod`, `cl_nome`, `cl_apelido`, `cl_BI`, `cl_morada`, `cl_sexo`, `cl_celular`, `cl_email`, `username`, `password`) VALUES
(1, 'Angel Elias', 'Banze', '11030065784P', 'Marracuene-Guava', 'M', 841543733, 'angelebanze@gmail.com', 'Angel', 'anjo1102'),
(2, 'Isaias', 'Ruben', '11054789648K', 'Matola-Gare', 'M', 852060721, 'isaiasruben@hotmail.com', 'Isaias', 'isa2504'),
(3, 'Geraldo', 'Mundlovo', '11078496532L', 'Magoanine-CMC', 'M', 825867516, 'geraldom@gmail.com', 'Geraldo', 'GMulhovo');

-- --------------------------------------------------------

--
-- Table structure for table `conta`
--

CREATE TABLE `conta` (
  `id_cliente` int(11) NOT NULL,
  `tipo` enum('Normal','Debito') DEFAULT NULL,
  `saldo` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conta`
--

INSERT INTO `conta` (`id_cliente`, `tipo`, `saldo`) VALUES
(1, 'Debito', 89850),
(2, 'Normal', 80000),
(3, 'Normal', 95784);

-- --------------------------------------------------------

--
-- Table structure for table `conta_credelec`
--

CREATE TABLE `conta_credelec` (
  `id_user` int(11) NOT NULL,
  `contador_nr` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conta_credelec`
--

INSERT INTO `conta_credelec` (`id_user`, `contador_nr`) VALUES
(1, 121478566212),
(2, 785469512354),
(3, 32478897814);

-- --------------------------------------------------------

--
-- Table structure for table `movimentos`
--

CREATE TABLE `movimentos` (
  `cliente_id` int(11) DEFAULT NULL,
  `actividade` varchar(50) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `custo` decimal(10,0) DEFAULT NULL,
  `data` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tentativas_login`
--

CREATE TABLE `tentativas_login` (
  `id` int(11) NOT NULL,
  `endereco_ip` varchar(50) NOT NULL,
  `tempo` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cl_cod`);

--
-- Indexes for table `conta`
--
ALTER TABLE `conta`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `conta_credelec`
--
ALTER TABLE `conta_credelec`
  ADD PRIMARY KEY (`id_user`,`contador_nr`);

--
-- Indexes for table `movimentos`
--
ALTER TABLE `movimentos`
  ADD KEY `fk_cliente_id` (`cliente_id`);

--
-- Indexes for table `tentativas_login`
--
ALTER TABLE `tentativas_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cl_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tentativas_login`
--
ALTER TABLE `tentativas_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conta`
--
ALTER TABLE `conta`
  ADD CONSTRAINT `fk_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`cl_cod`);

--
-- Constraints for table `conta_credelec`
--
ALTER TABLE `conta_credelec`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `cliente` (`cl_cod`);

--
-- Constraints for table `movimentos`
--
ALTER TABLE `movimentos`
  ADD CONSTRAINT `fk_cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cl_cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
