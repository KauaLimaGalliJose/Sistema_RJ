-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/03/2025 às 14:51
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
  `id` int(11) NOT NULL,
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

INSERT INTO `pedidosp` (`id`, `idpedidos`, `cliente`, `nomePedido`, `numF`, `numeM`, `descricaoPedido`, `descricaoAlianca`, `largura`, `gravacaoInterna`, `gravacaoExterna`, `outrosClientes`, `imagem`, `parEstoqueF`, `parEstoqueM`, `parPedra`, `parSemPedra`) VALUES
(1, 'PF1-2025-03-10', 'Mercado_Livre', '10', 10, 10, '10', '', '2mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', ''),
(2, 'PF2-2025-03-10', 'Mercado_Livre', '10', 10, 10, '10', '', '2mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', ''),
(4, 'PF3-2025-03-10', 'Mercado_Livre', '10', 10, 10, '10', '', '2mm', '', '', '', '../imagem/aliança com tres frisos.jpg', '', '', '', ''),
(7, 'PF4-2025-03-10', 'Mercado_Livre', '.jk.jk.j', 12, 15, 'fhdfh', 'hdfhdf', '2mm', '25/01/2022\r\n\r\n', '', '', '../imagem/chanfrada.png', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidospe`
--

CREATE TABLE `pedidospe` (
  `id` int(11) NOT NULL,
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
  `id` int(11) NOT NULL,
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idpedidos` (`idpedidos`);

--
-- Índices de tabela `pedidospe`
--
ALTER TABLE `pedidospe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idpedidos` (`idpedidos`);

--
-- Índices de tabela `pedidospg`
--
ALTER TABLE `pedidospg`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idpedidos` (`idpedidos`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pedidosp`
--
ALTER TABLE `pedidosp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `pedidospe`
--
ALTER TABLE `pedidospe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedidospg`
--
ALTER TABLE `pedidospg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
