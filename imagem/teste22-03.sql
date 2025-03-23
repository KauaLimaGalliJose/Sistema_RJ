-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 22/03/2025 às 18:45
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
  `outrosClientes` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagem` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parEstoqueF` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parEstoqueM` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parPedra` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parSemPedra` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pdfp` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idpedidos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidosp`
--

INSERT INTO `pedidosp` (`contadorpf`, `idpedidos`, `cliente`, `nomePedido`, `numF`, `numeM`, `descricaoPedido`, `descricaoAlianca`, `largura`, `gravacaoInterna`, `gravacaoExterna`, `outrosClientes`, `imagem`, `parEstoqueF`, `parEstoqueM`, `parPedra`, `parSemPedra`, `pdfp`) VALUES
(0, 'PF00-2025-03-19', 'teste', 'teste', 20, 20, 'teste', 'teste', '2mm', '', '', '', '../', '', '', '', '', ''),
(0, 'PF00-2025-03-20', 'teste', 'teste', 20, 20, 'teste', 'teste', '2mm', '', '', '', '../', '', '', '', '', ''),
(0, 'PF00-2025-03-21', 'teste', 'teste', 20, 20, 'teste', 'teste', '2mm', '', '', '', '../', '', '', '', '', ''),
(0, 'PF00-2025-03-22', 'teste', 'teste', 0, 0, 'teste', 'teste', '2mm', '', '', '', '../', '', '', '', '', ''),
(1, 'PF1-2025-03-19', 'Mercado_Livre', 'sdvsdv', 10, 10, '101', '01', '2mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', '', ''),
(1, 'PF1-2025-03-20', 'Mercado_Livre', '101010', 10, 10, '10', '10', '3mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', '', ''),
(1, 'PF1-2025-03-21', 'Mercado_Livre', 'jtyjtyjtj', 11, 13, 'yukyukyk', 'kuik', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', ''),
(1, 'PF1-2025-03-22', 'Mercado_Livre', '1010', 10, 10, '10', '10', '3mm', '11010', '', '', '../imagem/kaua foto.jpg', '', '', '', '', ''),
(2, 'PF2-2025-03-19', 'Mercado_Livre', 'nfgfng', 10, 10, '10', '10', '2mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', ''),
(2, 'PF2-2025-03-20', 'Mercado_Livre', '101010', 10, 10, '10', '10', '3mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', '', ''),
(2, 'PF2-2025-03-21', 'Mercado_Livre', 'jtyjtyjtj', 11, 13, 'yukyukyk', 'kuik', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', ''),
(2, 'PF2-2025-03-22', 'Mercado_Livre', '1010', 10, 10, '10', '10', '3mm', '11010', '', '', '../imagem/kaua foto.jpg', '', '', '', '', ''),
(3, 'PF3-2025-03-19', 'Mercado_Livre', 'nfgfng', 10, 10, '10', '10', '2mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', ''),
(3, 'PF3-2025-03-21', 'Mercado_Livre', 'jtyjtyjtj', 11, 13, 'yukyukyk', 'kuik', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', ''),
(3, 'PF3-2025-03-22', 'Mercado_Livre', '1010', 10, 10, '10', '10', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', ''),
(4, 'PF4-2025-03-22', 'Mercado_Livre', '1010', 10, 10, '10', '10', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', ''),
(5, 'PF5-2025-03-22', 'Mercado_Livre', '1010', 10, 10, '10', '10', '3mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', '', '');

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
  `outrosClientes` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagem` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parEstoqueF` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parEstoqueM` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parPedra` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parSemPedra` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pdfpe` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idpedidos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidospe`
--

INSERT INTO `pedidospe` (`contadorpe`, `idpedidos`, `cliente`, `nomePedido`, `numF`, `numeM`, `descricaoPedido`, `descricaoAlianca`, `largura`, `gravacaoInterna`, `gravacaoExterna`, `outrosClientes`, `imagem`, `parEstoqueF`, `parEstoqueM`, `parPedra`, `parSemPedra`, `pdfpe`) VALUES
(0, 'PE00-2025-03-21', 'teste', 'teste', 20, 20, 'teste', 'teste', '2mm', '', '', '', '../', '', '', '', '', ''),
(0, 'PE00-2025-03-22', 'teste', 'teste', 0, 0, 'teste', 'teste', '2mm', '', '', '', '../', '', '', '', '', ''),
(1, 'PE1-2025-03-21', 'Mercado_Livre', 'afasfa', 10, 10, '101', '000', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', ''),
(1, 'PE1-2025-03-22', 'Mercado_Livre', '2024', 10, 10, '101010', '101010', '3mm', '', '', '', '../imagem/pdf.png', '', '', '', '', ''),
(2, 'PE2-2025-03-21', 'Mercado_Livre', 'afasfa', 10, 10, '101', '000', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', ''),
(2, 'PE2-2025-03-22', 'Mercado_Livre', '2024', 10, 10, '101010', '101010', '3mm', '', '', '', '../imagem/pdf.png', '', '', '', '', '');

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
  `outrosClientes` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagem` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parEstoqueF` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parEstoqueM` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parPedra` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parSemPedra` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pdfpg` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idpedidos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidospg`
--

INSERT INTO `pedidospg` (`contadorpg`, `idpedidos`, `cliente`, `nomePedido`, `numF`, `numeM`, `descricaoPedido`, `descricaoAlianca`, `largura`, `gravacaoInterna`, `gravacaoExterna`, `outrosClientes`, `imagem`, `parEstoqueF`, `parEstoqueM`, `parPedra`, `parSemPedra`, `pdfpg`) VALUES
(0, 'PG00-2025-03-15', 'teste', 'teste', 20, 20, 'teste', 'teste', '2mm', '', '', '', '../', '', '', '', '', ''),
(0, 'PG00-2025-03-16', 'teste', 'teste', 20, 20, 'teste', 'teste', '2mm', '', '', '', '../', '', '', '', '', ''),
(0, 'PG00-2025-03-17', 'teste', 'teste', 20, 20, 'teste', 'teste', '2mm', '', '', '', '../', '', '', '', '', ''),
(0, 'PG00-2025-03-19', 'teste', 'teste', 20, 20, 'teste', 'teste', '2mm', '', '', '', '../', '', '', '', '', ''),
(0, 'PG00-2025-03-20', 'teste', 'teste', 20, 20, 'teste', 'teste', '2mm', '', '', '', '../', '', '', '', '', ''),
(0, 'PG00-2025-03-21', 'teste', 'teste', 20, 20, 'teste', 'teste', '2mm', '', '', '', '../', '', '', '', '', ''),
(0, 'PG00-2025-03-22', 'teste', 'teste', 0, 0, 'teste', 'teste', '2mm', '', '', '', '../', '', '', '', '', ''),
(1, 'PG1-2025-03-20', 'Mercado_Livre', '1010', 10, 10, '1010', '1010', '3mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', '', ''),
(1, 'PG1-2025-03-21', 'Mercado_Livre', 'gfnjgf', 20, 15, '1212', '12121', '3mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', '', ''),
(1, 'PG1-2025-03-22', 'Mercado_Livre', '01010', 10, 10, 'hdfhdf', '10110', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', ''),
(2, 'PG2-2025-03-20', 'Mercado_Livre', '1010', 10, 10, '1010', '1010', '3mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', '', ''),
(2, 'PG2-2025-03-21', 'Mercado_Livre', 'gfnjgf', 20, 15, '1212', '12121', '3mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', '', ''),
(2, 'PG2-2025-03-22', 'Mercado_Livre', '1010', 10, 10, '101', '0', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', ''),
(3, 'PG3-2025-03-20', 'Mercado_Livre', '1010', 10, 10, '1010', '1010', '3mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', '', ''),
(3, 'PG3-2025-03-21', 'Mercado_Livre', 'gfnjgf', 20, 15, '1212', '12121', '3mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', '', ''),
(3, 'PG3-2025-03-22', 'Mercado_Livre', '1010', 10, 10, '101', '0', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', ''),
(4, 'PG4-2025-03-21', 'Mercado_Livre', 'asddasd', 10, 10, '10', '10', '3mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', '', ''),
(4, 'PG4-2025-03-22', 'Mercado_Livre', '1010', 10, 10, '101', '0', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', ''),
(5, 'PG5-2025-03-21', 'Mercado_Livre', 'asddasd', 10, 10, '10', '10', '3mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', '', ''),
(5, 'PG5-2025-03-22', 'Mercado_Livre', '1010', 10, 10, '10', '1010', '3mm', '', '', '', '../imagem/pdf.png', '', '', '', '', ''),
(6, 'PG6-2025-03-22', 'Mercado_Livre', '1010', 10, 10, '10', '1010', '3mm', '', '', '', '../imagem/pdf.png', '', '', '', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
