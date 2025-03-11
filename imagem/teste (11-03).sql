-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/03/2025 às 19:35
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

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

CREATE TABLE `pedidosp` (
  `contadorpf` int(11) NOT NULL,
  `idpedidos` varchar(50) NOT NULL,
  `cliente` varchar(35) NOT NULL,
  `nomePedido` varchar(60) NOT NULL,
  `numF` int(2) DEFAULT NULL,
  `numeM` int(2) DEFAULT NULL,
  `descricaoPedido` text NOT NULL,
  `descricaoAlianca` text DEFAULT NULL,
  `largura` varchar(5) NOT NULL,
  `gravacaoInterna` varchar(250) DEFAULT NULL,
  `gravacaoExterna` varchar(250) DEFAULT NULL,
  `outrosClientes` varchar(60) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `parEstoqueF` varchar(30) DEFAULT NULL,
  `parEstoqueM` varchar(30) DEFAULT NULL,
  `parPedra` varchar(30) DEFAULT NULL,
  `parSemPedra` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidosp`
--

INSERT INTO `pedidosp` (`contadorpf`, `idpedidos`, `cliente`, `nomePedido`, `numF`, `numeM`, `descricaoPedido`, `descricaoAlianca`, `largura`, `gravacaoInterna`, `gravacaoExterna`, `outrosClientes`, `imagem`, `parEstoqueF`, `parEstoqueM`, `parPedra`, `parSemPedra`) VALUES
(0, 'PF00-2025-03-11', 'teste', 'teste', 20, 20, 'teste', 'teste', '2mm', '', '', '', '../', '', '', '', ''),
(0, 'PF1-2025-03-11', 'Mercado_Livre', 'nao sei', 10, 10, '10', '10', '2mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', ''),
(0, 'PF2-2025-03-11', 'Mercado_Livre', 'Jade', 10, 10, '10', '10', '2mm', '', '', '', '../imagem/Jade.png', '', '', '', ''),
(0, 'PF5-2025-03-11', 'Mercado_Livre', 'Chanfrada', 10, 10, '10', '10', '2mm', '', '', '', '../imagem/aliança com tres frisos2_ACD_0.jpg', '', '', '', ''),
(0, 'PF6-2025-03-11', 'Mercado_Livre', 'Chanfrada', 10, 10, '10', '10', '2mm', '', '', '', '../imagem/aliança com tres frisos2_ACD_0.jpg', '', '', '', ''),
(0, 'PF7-2025-03-11', 'Mercado_Livre', 'Chanfrada', 10, 10, '10', '10', '2mm', '', '', '', '../imagem/aliança com tres frisos2_ACD_0.jpg', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidospe`
--

CREATE TABLE `pedidospe` (
  `contadorpe` int(11) NOT NULL,
  `idpedidos` varchar(50) NOT NULL,
  `cliente` varchar(35) NOT NULL,
  `nomePedido` varchar(60) NOT NULL,
  `numF` int(2) DEFAULT NULL,
  `numeM` int(2) DEFAULT NULL,
  `descricaoPedido` text NOT NULL,
  `descricaoAlianca` text DEFAULT NULL,
  `largura` varchar(5) NOT NULL,
  `gravacaoInterna` varchar(250) DEFAULT NULL,
  `gravacaoExterna` varchar(250) DEFAULT NULL,
  `outrosClientes` varchar(60) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `parEstoqueF` varchar(30) DEFAULT NULL,
  `parEstoqueM` varchar(30) DEFAULT NULL,
  `parPedra` varchar(30) DEFAULT NULL,
  `parSemPedra` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidospg`
--

CREATE TABLE `pedidospg` (
  `contadorpg` int(11) NOT NULL,
  `idpedidos` varchar(50) NOT NULL,
  `cliente` varchar(35) NOT NULL,
  `nomePedido` varchar(60) NOT NULL,
  `numF` int(2) DEFAULT NULL,
  `numeM` int(2) DEFAULT NULL,
  `descricaoPedido` text NOT NULL,
  `descricaoAlianca` text DEFAULT NULL,
  `largura` varchar(5) NOT NULL,
  `gravacaoInterna` varchar(250) DEFAULT NULL,
  `gravacaoExterna` varchar(250) DEFAULT NULL,
  `outrosClientes` varchar(60) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `parEstoqueF` varchar(30) DEFAULT NULL,
  `parEstoqueM` varchar(30) DEFAULT NULL,
  `parPedra` varchar(30) DEFAULT NULL,
  `parSemPedra` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `pedidosp`
--
ALTER TABLE `pedidosp`
  ADD PRIMARY KEY (`idpedidos`);

--
-- Índices de tabela `pedidospe`
--
ALTER TABLE `pedidospe`
  ADD PRIMARY KEY (`idpedidos`);

--
-- Índices de tabela `pedidospg`
--
ALTER TABLE `pedidospg`
  ADD PRIMARY KEY (`idpedidos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
