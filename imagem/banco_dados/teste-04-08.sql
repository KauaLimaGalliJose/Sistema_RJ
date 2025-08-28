-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/08/2025 às 19:03
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
-- Estrutura para tabela `estoque`
--

CREATE TABLE `estoque` (
  `nome` varchar(150) NOT NULL,
  `descricaoEstoque` text NOT NULL,
  `imagem` varchar(150) NOT NULL,
  `peso` decimal(4,2) NOT NULL,
  `9` int(4) NOT NULL,
  `10` int(4) NOT NULL,
  `11` int(4) NOT NULL,
  `12` int(4) NOT NULL,
  `13` int(4) NOT NULL,
  `14` int(4) NOT NULL,
  `15` int(4) NOT NULL,
  `16` int(4) NOT NULL,
  `17` int(4) NOT NULL,
  `18` int(4) NOT NULL,
  `19` int(4) NOT NULL,
  `20` int(4) NOT NULL,
  `21` int(4) NOT NULL,
  `22` int(4) NOT NULL,
  `23` int(4) NOT NULL,
  `24` int(4) NOT NULL,
  `25` int(4) NOT NULL,
  `26` int(4) NOT NULL,
  `27` int(4) NOT NULL,
  `28` int(4) NOT NULL,
  `29` int(4) NOT NULL,
  `30` int(4) NOT NULL,
  `31` int(4) NOT NULL,
  `32` int(4) NOT NULL,
  `33` int(4) NOT NULL,
  `34` int(4) NOT NULL,
  `35` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `imagem` varchar(100) DEFAULT NULL,
  `PedraF` varchar(30) DEFAULT NULL,
  `PedraM` varchar(30) DEFAULT NULL,
  `parEstoqueF` varchar(30) DEFAULT NULL,
  `parEstoqueM` varchar(30) DEFAULT NULL,
  `pdf` varchar(250) DEFAULT NULL,
  `data_digitada` varchar(10) NOT NULL,
  `estoque` varchar(150) DEFAULT NULL
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
  `pdf` varchar(250) DEFAULT NULL,
  `data_digitada` varchar(10) NOT NULL,
  `estoque` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `pdf` varchar(250) DEFAULT NULL,
  `data_digitada` varchar(10) NOT NULL,
  `estoque` varchar(150) DEFAULT NULL
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
  `pdf` varchar(250) DEFAULT NULL,
  `data_digitada` varchar(10) NOT NULL,
  `estoque` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `reabastecer_estoque`
--

CREATE TABLE `reabastecer_estoque` (
  `nome` varchar(150) NOT NULL,
  `descricaoEstoque` text NOT NULL,
  `imagem` varchar(150) NOT NULL,
  `peso` decimal(4,2) NOT NULL,
  `9` int(4) NOT NULL,
  `10` int(4) NOT NULL,
  `11` int(4) NOT NULL,
  `12` int(4) NOT NULL,
  `13` int(4) NOT NULL,
  `14` int(4) NOT NULL,
  `15` int(4) NOT NULL,
  `16` int(4) NOT NULL,
  `17` int(4) NOT NULL,
  `18` int(4) NOT NULL,
  `19` int(4) NOT NULL,
  `20` int(4) NOT NULL,
  `21` int(4) NOT NULL,
  `22` int(4) NOT NULL,
  `23` int(4) NOT NULL,
  `24` int(4) NOT NULL,
  `25` int(4) NOT NULL,
  `26` int(4) NOT NULL,
  `27` int(4) NOT NULL,
  `28` int(4) NOT NULL,
  `29` int(4) NOT NULL,
  `30` int(4) NOT NULL,
  `31` int(4) NOT NULL,
  `32` int(4) NOT NULL,
  `33` int(4) NOT NULL,
  `34` int(4) NOT NULL,
  `35` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`nome`);

--
-- Índices de tabela `pedidosp`
--
ALTER TABLE `pedidosp`
  ADD PRIMARY KEY (`idpedidos`),
  ADD KEY `fk_pedidosp_estoque` (`estoque`);

--
-- Índices de tabela `pedidospe`
--
ALTER TABLE `pedidospe`
  ADD PRIMARY KEY (`idpedidos`),
  ADD KEY `fk_pedidospe_estoque` (`estoque`);

--
-- Índices de tabela `pedidospg`
--
ALTER TABLE `pedidospg`
  ADD PRIMARY KEY (`idpedidos`),
  ADD KEY `fk_pedidospg_estoque` (`estoque`);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `pedidosp`
--
ALTER TABLE `pedidosp`
  ADD CONSTRAINT `fk_pedidosp_estoque` FOREIGN KEY (`estoque`) REFERENCES `estoque` (`nome`);

--
-- Restrições para tabelas `pedidospe`
--
ALTER TABLE `pedidospe`
  ADD CONSTRAINT `fk_pedidospe_estoque` FOREIGN KEY (`estoque`) REFERENCES `estoque` (`nome`);

--
-- Restrições para tabelas `pedidospg`
--
ALTER TABLE `pedidospg`
  ADD CONSTRAINT `fk_pedidospg_estoque` FOREIGN KEY (`estoque`) REFERENCES `estoque` (`nome`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
