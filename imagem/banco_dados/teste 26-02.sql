-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3316
-- Tempo de geração: 26/02/2025 às 20:57
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
-- Estrutura para tabela `pedidospe`
--

CREATE TABLE `pedidospe` (
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
