-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/07/2024 às 15:52
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
-- Banco de dados: `gestaodespesas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `bases`
--

CREATE TABLE `bases` (
  `id_bases` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `bases`
--

INSERT INTO `bases` (`id_bases`, `nome`) VALUES
(1, 'SINE - CANGUÇU'),
(2, 'SINE - DOM PEDRITO'),
(3, 'SINE - GUAÍBA'),
(4, 'POA / SINE CENTRAL'),
(5, 'FGTAS - SEDE  - POA'),
(6, 'SINE - OSÓRIO'),
(7, 'SINE - SÃO LOURENÇO DO SUL'),
(8, 'SINE - TORRES'),
(9, 'SINE - TRAMANDAÍ'),
(10, 'FGTAS - ARQUIVO GERAL'),
(11, 'CASA DO ARTESÃO - POA'),
(12, 'SINE - CAMAQUÃ'),
(16, 'SINE - CAXIAS DO SUL'),
(17, 'VIDA - CENTRO HUMANÍSTICO / POA'),
(18, 'SINE - ARROIO DO MEIO'),
(19, 'SINE - SÃO LEOPOLDO'),
(20, 'SINE - FREDERICO WESTPHALEN'),
(21, 'SINE - GARIBALDI'),
(22, 'SINE - MONTENEGRO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `credores`
--

CREATE TABLE `credores` (
  `id_credores` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `credores`
--

INSERT INTO `credores` (`id_credores`, `nome`) VALUES
(1, 'IMOBILIARIA BASSANESI LTDA.'),
(2, 'CEEE - COMPANHIA ESTADUAL DE ENERGIA ELÉTRICA'),
(3, 'OI S/A'),
(4, 'SEMAE - SERV. MUNIC. AGUA E ESGOTOS'),
(5, 'CONDOMINIO EDIFICIO IPE'),
(6, 'HELIZ CERUTTI RUARO'),
(7, 'PREDILETA CORRETORA DE IMOVEIS LTDA.'),
(8, 'EGIDIO MULLER'),
(9, 'RICARDO MARQUES MASON'),
(11, 'FLAVIO BRITTO DA SILVA'),
(14, 'RWM - IT EQUIPAMENTOS DE TELEMATICA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `despesas`
--

CREATE TABLE `despesas` (
  `id_despesas` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `despesas`
--

INSERT INTO `despesas` (`id_despesas`, `nome`) VALUES
(1, 'ENERGIA ELÉTRICA'),
(2, 'ASSISTÊNCIA TÉCNICA'),
(3, 'TELEFONE FIXO'),
(4, 'LOCAÇÃO'),
(5, 'ÁGUA / ESGOTO'),
(8, 'CONDOMÍNIO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `lancamentos`
--

CREATE TABLE `lancamentos` (
  `id_lancamentos` int(11) NOT NULL,
  `mes` varchar(10) NOT NULL,
  `credores` int(11) DEFAULT NULL,
  `bases` int(11) DEFAULT NULL,
  `despesas` int(11) DEFAULT NULL,
  `vencimento` date DEFAULT NULL,
  `valor_liquido` double DEFAULT NULL,
  `multa` double DEFAULT NULL,
  `juros` double DEFAULT NULL,
  `correcao` double DEFAULT NULL,
  `valor_total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lancamentos`
--

INSERT INTO `lancamentos` (`id_lancamentos`, `mes`, `credores`, `bases`, `despesas`, `vencimento`, `valor_liquido`, `multa`, `juros`, `correcao`, `valor_total`) VALUES
(1, 'Janeiro', 2, 1, 1, '2023-03-31', 46.94, 0, 0, 0, 46.94),
(2, 'Janeiro', 2, 1, 1, '2023-03-31', 21.03, 0, 0, 0, 21.03),
(3, 'Janeiro', 2, 2, 1, '2023-03-31', 421.8, 5.28, 0.17, 0.1, 427.35),
(4, 'Janeiro', 2, 3, 1, '2023-03-31', 846.07, 9.44, 0.31, 0.17, 855.99),
(5, 'Janeiro', 2, 4, 1, '2023-03-31', 2264.24, 21.03, 0.69, 0.38, 2286.34),
(8, 'Janeiro', 14, 5, 2, '2023-02-10', 475.43, 0, 0, 0, 475.43),
(9, 'Janeiro', 2, 6, 1, '2023-03-31', 607.48, 5.19, 0.17, 0.09, 612.93),
(10, 'Janeiro', 2, 7, 1, '2023-03-31', 142.29, 0, 0, 0, 142.29),
(11, 'Janeiro', 2, 8, 1, '2023-03-31', 143.25, 0, 0, 0, 143.25),
(12, 'Janeiro', 2, 9, 1, '2023-03-31', 290.11, 0, 0, 0, 290.11),
(13, 'Janeiro', 2, 10, 1, '2023-03-31', 101.98, 1.85, 0.05, 0.02, 103.9),
(14, 'Janeiro', 3, 11, 3, '2023-01-30', 75.55, 0, 0, 0, 75.55),
(15, 'Janeiro', 3, 11, 3, '2023-01-30', 222.14, 0, 0, 0, 222.14),
(16, 'Janeiro', 3, 11, 3, '2023-01-30', 75.55, 0, 0, 0, 75.55),
(17, 'Janeiro', 3, 11, 3, '2023-01-30', 75.55, 0, 0, 0, 75.55),
(18, 'Janeiro', 2, 12, 1, '2023-03-31', 796.72, 0, 0, 0, 796.72),
(19, 'Janeiro', 1, 16, 4, '2023-02-10', 11000, 0, 0, 0, 11000),
(20, 'Janeiro', 3, 17, 3, '2023-01-30', 207.63, 0, 0, 0, 207.63),
(21, 'Janeiro', 3, 17, 3, '2023-01-30', 66.37, 0, 0, 0, 66.37),
(22, 'Janeiro', 3, 17, 3, '2023-01-30', 75.55, 0, 0, 0, 75.55),
(23, 'Janeiro', 3, 17, 3, '2023-01-30', 178.12, 0, 0, 0, 178.12),
(24, 'Janeiro', 2, 17, 1, '2023-03-30', 20722.05, 0, 0, 0, 20722.05),
(25, 'Janeiro', 4, 19, 5, '2023-02-05', 350.83, 0, 0, 0, 350.83),
(26, 'Janeiro', 5, 18, 8, '2023-01-10', 84, 0, 0, 0, 84),
(27, 'Janeiro', 6, 20, 8, '2023-02-10', 300, 0, 0, 0, 300),
(28, 'Janeiro', 6, 20, 4, '2023-02-10', 1900, 0, 0, 0, 1900),
(29, 'Janeiro', 7, 21, 4, '2023-02-10', 1853.25, 0, 0, 0, 1853.25),
(30, 'Janeiro', 8, 22, 4, '2023-02-10', 6000, 0, 0, 0, 6000),
(31, 'Janeiro', 9, 6, 4, '2023-02-10', 5440.9, 0, 0, 0, 5440.9),
(32, 'Janeiro', 11, 9, 8, '2023-02-10', 445.5, 0, 0, 0, 445.5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(255) NOT NULL,
  `emailUsuario` varchar(255) NOT NULL,
  `loginUsuario` varchar(255) NOT NULL,
  `senhaUsuario` varchar(255) NOT NULL,
  `telefoneCelular` varchar(45) DEFAULT NULL,
  `ativo` enum('S','N') DEFAULT 'S',
  `criado` timestamp NOT NULL DEFAULT current_timestamp(),
  `editado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nomeUsuario`, `emailUsuario`, `loginUsuario`, `senhaUsuario`, `telefoneCelular`, `ativo`, `criado`, `editado`) VALUES
(15, 'Ana Carolina Mendes', 'anacarol@gmail.com', 'anacarol', 'cf8e37b98b4d6ae2267a4cba1332dd72', '(51)999559191', 'S', '2024-06-26 17:36:44', '2024-06-26 17:36:44'),
(24, 'Leandro da Silva Rodrigues', 'leandrorodrigues@gmail.com', 'leandrosrod', '81dc9bdb52d04dc20036dbd8313ed055', '(51)999588741', 'S', '2024-06-27 11:15:09', '2024-06-27 12:06:46'),
(26, 'Admin FGTAS', 'admin@fgtas.rs.gov.br', 'admin', '843b70846ba0f04578270c4dafa42e69', '51999588756', 'S', '2024-07-09 14:23:21', '2024-07-09 14:23:21'),
(28, 'Tânia Maria da Silva Rodrigues', 'taniarodrigues@gmail.com', 'tania_maria', '19637a4a43e3978a377a14e7c158ac51', '51999559898', 'S', '2024-07-12 12:16:28', '2024-07-12 12:16:28'),
(29, 'Flávio Saviuki Rodrigues', 'flavio_saviuki@gmail.com', 'flavio_saviuki', '75673ed65ef3dd4a9054718fdd331936', '51999559191', 'S', '2024-07-12 12:17:37', '2024-07-12 12:17:37');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `bases`
--
ALTER TABLE `bases`
  ADD PRIMARY KEY (`id_bases`);

--
-- Índices de tabela `credores`
--
ALTER TABLE `credores`
  ADD PRIMARY KEY (`id_credores`);

--
-- Índices de tabela `despesas`
--
ALTER TABLE `despesas`
  ADD PRIMARY KEY (`id_despesas`);

--
-- Índices de tabela `lancamentos`
--
ALTER TABLE `lancamentos`
  ADD PRIMARY KEY (`id_lancamentos`),
  ADD KEY `credores` (`credores`),
  ADD KEY `bases` (`bases`),
  ADD KEY `despesas` (`despesas`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bases`
--
ALTER TABLE `bases`
  MODIFY `id_bases` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `credores`
--
ALTER TABLE `credores`
  MODIFY `id_credores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `despesas`
--
ALTER TABLE `despesas`
  MODIFY `id_despesas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `lancamentos`
--
ALTER TABLE `lancamentos`
  MODIFY `id_lancamentos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `lancamentos`
--
ALTER TABLE `lancamentos`
  ADD CONSTRAINT `lancamentos_ibfk_1` FOREIGN KEY (`credores`) REFERENCES `credores` (`id_credores`),
  ADD CONSTRAINT `lancamentos_ibfk_2` FOREIGN KEY (`bases`) REFERENCES `bases` (`id_bases`),
  ADD CONSTRAINT `lancamentos_ibfk_3` FOREIGN KEY (`despesas`) REFERENCES `despesas` (`id_despesas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
