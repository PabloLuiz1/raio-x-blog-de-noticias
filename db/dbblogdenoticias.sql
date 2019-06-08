-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 14-Jan-2019 às 14:04
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbblogdenoticias`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbassinante`
--

DROP TABLE IF EXISTS `tbassinante`;
CREATE TABLE IF NOT EXISTS `tbassinante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `celular` varchar(12) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbnoticia`
--

DROP TABLE IF EXISTS `tbnoticia`;
CREATE TABLE IF NOT EXISTS `tbnoticia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_publicacao` datetime NOT NULL,
  `titulo` varchar(60) COLLATE utf8_bin NOT NULL,
  `resumo` varchar(200) COLLATE utf8_bin NOT NULL,
  `estado` varchar(20) COLLATE utf8_bin NOT NULL,
  `unidade` varchar(150) COLLATE utf8_bin NOT NULL,
  `imagem` varchar(50) COLLATE utf8_bin NOT NULL,
  `arquivo` varchar(50) COLLATE utf8_bin NOT NULL,
  `video` varchar(100) COLLATE utf8_bin NOT NULL,
  `autor` int(11) NOT NULL,
  `ativo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_usuario` (`autor`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario`
--

DROP TABLE IF EXISTS `tbusuario`;
CREATE TABLE IF NOT EXISTS `tbusuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8_bin NOT NULL,
  `email` varchar(70) COLLATE utf8_bin NOT NULL,
  `whatsapp` varchar(11) COLLATE utf8_bin NOT NULL,
  `login` varchar(20) COLLATE utf8_bin NOT NULL,
  `senha` varchar(100) COLLATE utf8_bin NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  `ativo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`id`, `nome`, `email`, `whatsapp`, `login`, `senha`, `admin`, `ativo`) VALUES
(1, 'Admin', 'admin@gmail.com', '11912345678', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tbnoticia`
--
ALTER TABLE `tbnoticia`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`autor`) REFERENCES `tbusuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
