-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 25/03/2025 às 01:35
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
  `parPedra` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parSemPedra` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pdf` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idpedidos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`idpedidos`, `cliente`, `nomePedido`, `numF`, `numeM`, `descricaoPedido`, `descricaoAlianca`, `largura`, `gravacaoInterna`, `gravacaoExterna`, `outrosClientes`, `imagem`, `parEstoqueF`, `parEstoqueM`, `parPedra`, `parSemPedra`, `pdf`) VALUES
('-10125285-2025-03-23', 'Outros', '', 10, 10, '10', '10', '3mm', '', '', '', '../imagem/34-Logo-80x80.png', '', '', '', '', 'naoTemPdf'),
('-5353-2025-03-22', 'Outros', '', 13, 16, '2542', '', '3mm', '', '', '', '../imagem/Jade.png', '', '', '', '', 'naoTemPdf'),
('-63635-2025-03-22', 'Outros', '', 22, 25, '25252', '', '3mm', '', '', '', '../imagem/Jade.png', '', '', '', '', 'naoTemPdf'),
('-89689-2025-03-22', 'Outros', '', 10, 10, '10', '01', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', 'naoTemPdf'),
('-gdfgdfg-2025-03-22', 'Outros', '24242', 20, 15, '543543', '', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', 'naoTemPdf'),
('45456-63635-2025-03-22', 'Outros', '', 22, 25, '25252', '', '3mm', '', '', '45456', '../imagem/Jade.png', '', '', '', '', 'naoTemPdf'),
('Centro_Alianca-101-2025-03-22', 'Centro_Alianca', '', 10, 10, '101', '0', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', 'naoTemPdf'),
('Centro_Alianca-1010-2025-03-22', 'Centro_Alianca', '', 10, 10, '101', '0', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', 'naoTemPdf'),
('Centro_Alianca-101010-2025-03-22', 'Centro_Alianca', '', 10, 10, '1010', '1010', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', 'naoTemPdf'),
('Centro_Alianca-sdf-2025-03-22', 'Centro_Alianca', '', 10, 15, '1010', '1010', '3mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', '', 'naoTemPdf'),
('Centro_Alianca-zsc-2025-03-22', 'Centro_Alianca', '', 10, 10, '1010', '1010', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', 'naoTemPdf'),
('Centro_Alianca-zscasc-2025-03-22', 'Centro_Alianca', '', 10, 10, '1010', '1010', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', 'naoTemPdf'),
('fcbfcb-89689-2025-03-22', 'Outros', '', 10, 10, '10', '01', '3mm', '', '', 'fcbfcb', '../imagem/chanfrada.png', '', '', '', '', 'naoTemPdf'),
('showroom-1010-2025-03-22', 'showroom', '', 10, 10, '10', '10', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', 'naoTemPdf'),
('showroom-101010-2025-03-22', 'showroom', '', 10, 10, '1010105', '1010105', '3mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', '', 'naoTemPdf'),
('showroom-1010532-2025-03-22', 'showroom', '', 10, 25, '10', '101010', '3mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', '', 'naoTemPdf'),
('showroom-10125285-2025-03-23', 'showroom', '', 10, 10, '10', '10', '3mm', '', '', '', '../imagem/34-Logo-80x80.png', '', '', '', '', 'naoTemPdf'),
('showroom-10252-2025-03-22', 'showroom', '', 10, 7, '25424', '54245', '3mm', '', '', '', '../imagem/Jade.png', '', '', '', '', 'naoTemPdf'),
('showroom-25252-2025-03-22', 'showroom', '', 25, 20, '247242', '424242', '3mm', '', '', '', '../imagem/Jade.png', '', '', '', '', 'naoTemPdf'),
('showroom-252521-2025-03-22', 'showroom', '7575', 25, 20, '24724201', '42424210', '3mm', '', '', '', '../imagem/Jade.png', '', '', '', '', 'naoTemPdf'),
('showroom-2542-2025-03-22', 'showroom', '', 20, 21, '2', '', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', 'naoTemPdf'),
('showroom-25825-2025-03-22', 'showroom', '1010', 10, 10, '1010', '1010', '3mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', '', 'naoTemPdf'),
('showroom-5353-2025-03-22', 'showroom', '', 13, 16, '2542', '', '3mm', '', '', '', '../imagem/Jade.png', '', '', '', '', 'naoTemPdf'),
('showroom-7575896-2025-03-22', 'showroom', '10542', 15, 10, '5252', '12124', '3mm', '', '', '', '../imagem/Jade.png', '', '', '', '', 'naoTemPdf'),
('showroom-786786-2025-03-22', 'showroom', 'hrthrh', 25, 25, '5252', '52525454', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', 'naoTemPdf'),
('showroom-873676-2025-03-22', 'showroom', '152', 20, 18, '20202', '528', '3mm', '', '', '', '../imagem/Jade.png', '', '', '', '', 'naoTemPdf'),
('showroom-gdfgdfg-2025-03-22', 'showroom', '24242', 20, 15, '543543', '', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', 'naoTemPdf'),
('showroom-sdfsdf-2025-03-22', 'showroom', '', 10, 10, '10', '10', '3mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', '', 'naoTemPdf'),
('zxczxc-zscasc-2025-03-22', 'Outros', '', 10, 10, '1010', '1010', '3mm', '', '', 'zxczxc', '../imagem/chanfrada.png', '', '', '', '', 'naoTemPdf');

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
(0, 'PF00-2025-03-23', 'teste', 'teste', 0, 0, 'teste', 'teste', '2mm', '', '', '', '../', '', '', '', '', ''),
(1, 'PF1-2025-03-23', 'Mercado_Livre', '10', 10, 8, '10', '10', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', './pedidos/PDF/PF1-2025-03-23.pdf'),
(2, 'PF2-2025-03-23', 'Mercado_Livre', '10', 10, 8, '10', '10', '3mm', '', '', '', '../imagem/chanfrada.png', '', '', '', '', './pedidos/PDF/PF2-2025-03-23.pdf');

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
(0, 'PE00-2025-03-23', 'teste', 'teste', 0, 0, 'teste', 'teste', '2mm', '', '', '', '../', '', '', '', '', '');

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
(0, 'PG00-2025-03-23', 'teste', 'teste', 0, 0, 'teste', 'teste', '2mm', '', '', '', '../', '', '', '', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
