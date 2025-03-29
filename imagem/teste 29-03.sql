-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 29/03/2025 às 22:21
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teste`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `idpedidos` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cliente` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nomePedido` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `numF` int DEFAULT NULL,
  `numeM` int DEFAULT NULL,
  `descricaoPedido` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descricaoAlianca` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `largura` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gravacaoInterna` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gravacaoExterna` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `outrosClientes` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagem` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parEstoqueF` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parEstoqueM` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PedraF` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PedraM` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pdf` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idpedidos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidosp`
--

DROP TABLE IF EXISTS `pedidosp`;
CREATE TABLE IF NOT EXISTS `pedidosp` (
  `contadorpf` int NOT NULL,
  `idpedidos` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `cliente` varchar(35) COLLATE utf8mb4_general_ci NOT NULL,
  `nomePedido` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `numF` int DEFAULT NULL,
  `numeM` int DEFAULT NULL,
  `descricaoPedido` text COLLATE utf8mb4_general_ci NOT NULL,
  `descricaoAlianca` text COLLATE utf8mb4_general_ci,
  `largura` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `gravacaoInterna` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gravacaoExterna` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagem` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PedraF` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PedraM` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parEstoqueF` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parEstoqueM` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pdfp` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idpedidos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidospe`
--

DROP TABLE IF EXISTS `pedidospe`;
CREATE TABLE IF NOT EXISTS `pedidospe` (
  `contadorpe` int NOT NULL,
  `idpedidos` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `cliente` varchar(35) COLLATE utf8mb4_general_ci NOT NULL,
  `nomePedido` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `numF` int DEFAULT NULL,
  `numeM` int DEFAULT NULL,
  `descricaoPedido` text COLLATE utf8mb4_general_ci NOT NULL,
  `descricaoAlianca` text COLLATE utf8mb4_general_ci,
  `largura` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `gravacaoInterna` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gravacaoExterna` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagem` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parEstoqueF` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parEstoqueM` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PedraF` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PedraM` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pdfpe` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idpedidos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidospg`
--

DROP TABLE IF EXISTS `pedidospg`;
CREATE TABLE IF NOT EXISTS `pedidospg` (
  `contadorpg` int NOT NULL,
  `idpedidos` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `cliente` varchar(35) COLLATE utf8mb4_general_ci NOT NULL,
  `nomePedido` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `numF` int DEFAULT NULL,
  `numeM` int DEFAULT NULL,
  `descricaoPedido` text COLLATE utf8mb4_general_ci NOT NULL,
  `descricaoAlianca` text COLLATE utf8mb4_general_ci,
  `largura` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `gravacaoInterna` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gravacaoExterna` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagem` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parEstoqueF` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parEstoqueM` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PedraF` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PedraM` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pdfpg` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idpedidos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
