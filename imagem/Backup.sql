-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/04/2025 às 04:03
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.1.25

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

CREATE TABLE `pedidos` (
  `idpedidos` varchar(50) NOT NULL,
  `cliente` varchar(35) NOT NULL,
  `nomePedido` varchar(60) NOT NULL,
  `numF` int(11) DEFAULT NULL,
  `numeM` int(11) DEFAULT NULL,
  `descricaoPedido` text NOT NULL,
  `descricaoAlianca` text DEFAULT NULL,
  `largura` varchar(5) NOT NULL,
  `gravacaoInterna` varchar(250) DEFAULT NULL,
  `gravacaoExterna` varchar(250) DEFAULT NULL,
  `outrosClientes` varchar(60) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `parEstoqueF` varchar(30) DEFAULT NULL,
  `parEstoqueM` varchar(30) DEFAULT NULL,
  `PedraF` varchar(30) DEFAULT NULL,
  `PedraM` varchar(30) DEFAULT NULL,
  `pdf` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidosp`
--

CREATE TABLE `pedidosp` (
  `contadorpf` int(11) NOT NULL,
  `idpedidos` varchar(50) NOT NULL,
  `cliente` varchar(35) NOT NULL,
  `nomePedido` varchar(60) NOT NULL,
  `numF` int(11) DEFAULT NULL,
  `numeM` int(11) DEFAULT NULL,
  `descricaoPedido` text NOT NULL,
  `descricaoAlianca` text DEFAULT NULL,
  `largura` varchar(5) NOT NULL,
  `gravacaoInterna` varchar(250) DEFAULT NULL,
  `gravacaoExterna` varchar(250) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `PedraF` varchar(30) DEFAULT NULL,
  `PedraM` varchar(30) DEFAULT NULL,
  `parEstoqueF` varchar(30) DEFAULT NULL,
  `parEstoqueM` varchar(30) DEFAULT NULL,
  `pdf` varchar(250) NOT NULL,
  `data_digitada` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidosp`
--

INSERT INTO `pedidosp` (`contadorpf`, `idpedidos`, `cliente`, `nomePedido`, `numF`, `numeM`, `descricaoPedido`, `descricaoAlianca`, `largura`, `gravacaoInterna`, `gravacaoExterna`, `imagem`, `PedraF`, `PedraM`, `parEstoqueF`, `parEstoqueM`, `pdf`, `data_digitada`) VALUES
(0, 'PF00-2025-04-25', 'teste', 'teste', 0, 0, 'teste', 'teste', '2mm', '', '', '../', '', '', '', '', '', '2025-04-25');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidospe`
--

CREATE TABLE `pedidospe` (
  `contadorpe` int(11) NOT NULL,
  `idpedidos` varchar(50) NOT NULL,
  `cliente` varchar(35) NOT NULL,
  `nomePedido` varchar(60) NOT NULL,
  `numF` int(11) DEFAULT NULL,
  `numeM` int(11) DEFAULT NULL,
  `descricaoPedido` text NOT NULL,
  `descricaoAlianca` text DEFAULT NULL,
  `largura` varchar(5) NOT NULL,
  `gravacaoInterna` varchar(250) DEFAULT NULL,
  `gravacaoExterna` varchar(250) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `parEstoqueF` varchar(30) DEFAULT NULL,
  `parEstoqueM` varchar(30) DEFAULT NULL,
  `PedraF` varchar(30) DEFAULT NULL,
  `PedraM` varchar(30) DEFAULT NULL,
  `pdf` varchar(250) NOT NULL,
  `data_digitada` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidospe`
--

INSERT INTO `pedidospe` (`contadorpe`, `idpedidos`, `cliente`, `nomePedido`, `numF`, `numeM`, `descricaoPedido`, `descricaoAlianca`, `largura`, `gravacaoInterna`, `gravacaoExterna`, `imagem`, `parEstoqueF`, `parEstoqueM`, `PedraF`, `PedraM`, `pdf`, `data_digitada`) VALUES
(0, 'PE00-2025-04-25', 'teste', 'teste', 0, 0, 'teste', 'teste', '2mm', '', '', '../', '', '', '', '', '', '2025-04-25');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidospg`
--

CREATE TABLE `pedidospg` (
  `contadorpg` int(11) NOT NULL,
  `idpedidos` varchar(50) NOT NULL,
  `cliente` varchar(35) NOT NULL,
  `nomePedido` varchar(60) NOT NULL,
  `numF` int(11) DEFAULT NULL,
  `numeM` int(11) DEFAULT NULL,
  `descricaoPedido` text NOT NULL,
  `descricaoAlianca` text DEFAULT NULL,
  `largura` varchar(5) NOT NULL,
  `gravacaoInterna` varchar(250) DEFAULT NULL,
  `gravacaoExterna` varchar(250) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `parEstoqueF` varchar(30) DEFAULT NULL,
  `parEstoqueM` varchar(30) DEFAULT NULL,
  `PedraF` varchar(30) DEFAULT NULL,
  `PedraM` varchar(30) DEFAULT NULL,
  `pdf` varchar(250) NOT NULL,
  `data_digitada` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidospg`
--

INSERT INTO `pedidospg` (`contadorpg`, `idpedidos`, `cliente`, `nomePedido`, `numF`, `numeM`, `descricaoPedido`, `descricaoAlianca`, `largura`, `gravacaoInterna`, `gravacaoExterna`, `imagem`, `parEstoqueF`, `parEstoqueM`, `PedraF`, `PedraM`, `pdf`, `data_digitada`) VALUES
(0, 'PG00-2025-04-25', 'teste', 'teste', 0, 0, 'teste', 'teste', '2mm', '', '', '../', '', '', '', '', '', '2025-04-25');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idpedidos`);

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
