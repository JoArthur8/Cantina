-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/11/2025 às 01:23
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
-- Banco de dados: `cantina`
--
CREATE DATABASE IF NOT EXISTS `cantina` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cantina`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `item`
--

CREATE TABLE `item` (
  `Cod_item` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Descricao` text NOT NULL,
  `Preco` decimal(5,2) NOT NULL,
  `Tipo` varchar(50) NOT NULL,
  `Quantidade_Estoque` int(11) NOT NULL,
  `Imagem` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `item`
--

INSERT INTO `item` (`Cod_item`, `Nome`, `Descricao`, `Preco`, `Tipo`, `Quantidade_Estoque`, `Imagem`) VALUES
(1, 'Coxinha de Frango', 'Salgado com recheio de frango', 5.50, 'Salgado', 40, 'assets/img/menu/coxinha-frango.png'),
(2, 'Refrigerante Lata', 'Coca-Cola, Guaraná ou Fanta', 4.00, 'Bebida', 100, 'assets/img/menu/coca-latinha.png'),
(3, 'Brigadeiro', 'Doce de chocolate tradicional', 2.50, 'Doce', 30, 'assets/img/menu/brigadeiro.png'),
(4, 'Enroladinho de Salsicha', 'Uma salsicha muito gostosa', 10.00, 'Salgado', 10, 'assets/img/menu/enroladinho-salsicha.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `item_pedido`
--

CREATE TABLE `item_pedido` (
  `Quantidade` int(11) NOT NULL,
  `Pedido_Cod_pedido` int(11) DEFAULT NULL,
  `Item_Cod_item` int(11) DEFAULT NULL,
  `valor_total` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `item_pedido`
--

INSERT INTO `item_pedido` (`Quantidade`, `Pedido_Cod_pedido`, `Item_Cod_item`, `valor_total`) VALUES
(2, 1, 1, 20.49),
(1, 1, 2, 15.99);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `Cod_pedido` int(11) NOT NULL,
  `Data_Hora` datetime NOT NULL,
  `Status` varchar(100) DEFAULT NULL,
  `Usuario_CPF` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedido`
--

INSERT INTO `pedido` (`Cod_pedido`, `Data_Hora`, `Status`, `Usuario_CPF`) VALUES
(1, '0000-00-00 00:00:00', NULL, '11122233344');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `CPF` varchar(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `Tipo_Usuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`CPF`, `Nome`, `Email`, `Senha`, `Tipo_Usuario`) VALUES
('11122233344', 'João da Silva', 'joao.silva@aluno.com', 'senha_123', 'consumidor'),
('55566677788', 'Maria Oliveira', 'maria.adm@cantina.com', 'senha_456', 'administrador');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`Cod_item`);

--
-- Índices de tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD KEY `Pedido_Cod_pedido` (`Pedido_Cod_pedido`),
  ADD KEY `Item_Cod_item` (`Item_Cod_item`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`Cod_pedido`),
  ADD KEY `Usuario_CPF` (`Usuario_CPF`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`CPF`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `item`
--
ALTER TABLE `item`
  MODIFY `Cod_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `Cod_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD CONSTRAINT `item_pedido_ibfk_1` FOREIGN KEY (`Pedido_Cod_pedido`) REFERENCES `pedido` (`Cod_pedido`),
  ADD CONSTRAINT `item_pedido_ibfk_2` FOREIGN KEY (`Item_Cod_item`) REFERENCES `item` (`Cod_item`);

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`Usuario_CPF`) REFERENCES `usuario` (`CPF`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
