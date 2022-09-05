-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2022 at 02:04 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `def`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbos`
--

CREATE TABLE `tbos` (
  `id_os` int(11) NOT NULL,
  `data_os` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_os` varchar(50) NOT NULL DEFAULT 'aberto',
  `session` varchar(200) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbos`
--

INSERT INTO `tbos` (`id_os`, `data_os`, `status_os`, `session`, `id_user`) VALUES
(1, '2022-09-05 00:03:25', 'aberto', 'egaifaeipfaop#24141waofio#', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbprodutos`
--

CREATE TABLE `tbprodutos` (
  `id_prod` int(11) NOT NULL,
  `data_reg` timestamp NOT NULL DEFAULT current_timestamp(),
  `price` varchar(200) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `desc` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbprodutos`
--

INSERT INTO `tbprodutos` (`id_prod`, `data_reg`, `price`, `nome`, `foto`, `desc`) VALUES
(1, '2022-09-05 00:03:25', 'price_129341489129841294', 'Cabobó do Norte', '/assets/teste.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbusuarios`
--

CREATE TABLE `tbusuarios` (
  `id_user` int(11) NOT NULL,
  `data_user` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_user` varchar(150) NOT NULL DEFAULT 'ativo',
  `nome` varchar(150) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pontos` decimal(10,0) DEFAULT NULL,
  `chave` varchar(220) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sits_usuario_id` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbusuarios`
--

INSERT INTO `tbusuarios` (`id_user`, `data_user`, `status_user`, `nome`, `endereco`, `telefone`, `email`, `senha`, `pontos`) VALUES
(1, '2022-09-05 00:03:25', 'ativo', 'TESTE', 'Rua Cabobó do Norte', '(21)24242-4242', 'teste@usario.com', 'macazinha123', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbos`
--
ALTER TABLE `tbos`
  ADD PRIMARY KEY (`id_os`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbprodutos`
--
ALTER TABLE `tbprodutos`
  ADD PRIMARY KEY (`id_prod`);

--
-- Indexes for table `tbusuarios`
--
ALTER TABLE `tbusuarios`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbos`
--
ALTER TABLE `tbos`
  MODIFY `id_os` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbprodutos`
--
ALTER TABLE `tbprodutos`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbusuarios`
--
ALTER TABLE `tbusuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbos`
--
ALTER TABLE `tbos`
  ADD CONSTRAINT `tbos_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbusuarios` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
