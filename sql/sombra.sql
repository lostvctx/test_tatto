-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 19/03/2026 às 02:26
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
-- Banco de dados: `sombra`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `idAgendamento` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idTatuador` int(11) NOT NULL,
  `tipo` enum('tattoo','orcamento') NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `descricao` text DEFAULT NULL,
  `referencia_imagem` varchar(255) DEFAULT NULL,
  `status` enum('pendente','confirmado','cancelado','concluido') DEFAULT 'pendente',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`idCliente`, `idUsuario`) VALUES
(1, 2),
(2, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `horarios_disponiveis`
--

CREATE TABLE `horarios_disponiveis` (
  `idHorario` int(11) NOT NULL,
  `idTatuador` int(11) NOT NULL,
  `tipo` enum('tattoo','orcamento') NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `disponivel` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `portfolio`
--

CREATE TABLE `portfolio` (
  `idPortfolio` int(11) NOT NULL,
  `idTatuador` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `midia` varchar(255) DEFAULT NULL,
  `tipo` enum('imagem','video') DEFAULT 'imagem',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `referencia_salva`
--

CREATE TABLE `referencia_salva` (
  `idReferencia` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idPortfolio` int(11) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tatuador`
--

CREATE TABLE `tatuador` (
  `idTatuador` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `bio` text DEFAULT NULL,
  `fotoPerfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tatuador`
--

INSERT INTO `tatuador` (`idTatuador`, `idUsuario`, `bio`, `fotoPerfil`) VALUES
(1, 1, NULL, NULL),
(2, 3, NULL, NULL),
(3, 5, NULL, NULL),
(4, 6, NULL, NULL),
(5, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nivel` enum('CLIENTE','TATUADOR') NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nome`, `email`, `senha`, `nivel`, `criado_em`) VALUES
(1, 'sesg', 'sgseg@gmail.com', '$2y$10$CTffHRyxdEQeOZRqPTvT8ewoI/vpyAEtHNnJ.q0VBmpBMVlIXS5Ky', 'TATUADOR', '2026-03-19 00:06:01'),
(2, 'victorluiz', 'dede@gmail.com', '$2y$10$iQMg92GyOKFoBLjUX/d8W.GDyyayJ1UrgJtoaD5JJgmR.Sht3yKn.', 'CLIENTE', '2026-03-19 00:27:50'),
(3, 'dede', 'dedede@gmail.com', '$2y$10$fVJzOh1llvPz/u4Lmf6pue031YSK2rhD98/MiDz3S.cughJ3aGhdW', 'TATUADOR', '2026-03-19 00:28:52'),
(4, 'efewsf', 'sefefesf@gmail.com', '$2y$10$.c6I6CSJiGlyd/Z1d3974.t3YpWQ4IpuVuzq2NwJ2oM2HIGyihnzG', 'CLIENTE', '2026-03-19 00:31:32'),
(5, 'easefs', 'sefsef@gmail.com', '$2y$10$MZH4JKWVzoRdO9KkT8ZCk.rTmFSdt4.wweUAL/yDdYvKZxD6zwx9S', 'TATUADOR', '2026-03-19 01:08:37'),
(6, 'sdsdav', 'sdvsdv@ssdv', '$2y$10$gitrS4Guv7Xle8C8e0hrnO/8NttxMxjwBcjQn.p0m16Rxq7sh246C', 'TATUADOR', '2026-03-19 01:21:39'),
(7, 'vivi', 'vivi5@gmail.com', '$2y$10$m11Q5RvzLyWpWgZ35yGyD.0S3vEV1eXWPegb9sDFZ.0CsHderxBkK', 'TATUADOR', '2026-03-19 01:22:23');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`idAgendamento`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idTatuador` (`idTatuador`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices de tabela `horarios_disponiveis`
--
ALTER TABLE `horarios_disponiveis`
  ADD PRIMARY KEY (`idHorario`),
  ADD KEY `idTatuador` (`idTatuador`);

--
-- Índices de tabela `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`idPortfolio`),
  ADD KEY `idTatuador` (`idTatuador`);

--
-- Índices de tabela `referencia_salva`
--
ALTER TABLE `referencia_salva`
  ADD PRIMARY KEY (`idReferencia`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idPortfolio` (`idPortfolio`);

--
-- Índices de tabela `tatuador`
--
ALTER TABLE `tatuador`
  ADD PRIMARY KEY (`idTatuador`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamento`
--
ALTER TABLE `agendamento`
  MODIFY `idAgendamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `horarios_disponiveis`
--
ALTER TABLE `horarios_disponiveis`
  MODIFY `idHorario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `idPortfolio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `referencia_salva`
--
ALTER TABLE `referencia_salva`
  MODIFY `idReferencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tatuador`
--
ALTER TABLE `tatuador`
  MODIFY `idTatuador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agendamento`
--
ALTER TABLE `agendamento`
  ADD CONSTRAINT `agendamento_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `agendamento_ibfk_2` FOREIGN KEY (`idTatuador`) REFERENCES `tatuador` (`idTatuador`) ON DELETE CASCADE;

--
-- Restrições para tabelas `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE;

--
-- Restrições para tabelas `horarios_disponiveis`
--
ALTER TABLE `horarios_disponiveis`
  ADD CONSTRAINT `horarios_disponiveis_ibfk_1` FOREIGN KEY (`idTatuador`) REFERENCES `tatuador` (`idTatuador`) ON DELETE CASCADE;

--
-- Restrições para tabelas `portfolio`
--
ALTER TABLE `portfolio`
  ADD CONSTRAINT `portfolio_ibfk_1` FOREIGN KEY (`idTatuador`) REFERENCES `tatuador` (`idTatuador`) ON DELETE CASCADE;

--
-- Restrições para tabelas `referencia_salva`
--
ALTER TABLE `referencia_salva`
  ADD CONSTRAINT `referencia_salva_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `referencia_salva_ibfk_2` FOREIGN KEY (`idPortfolio`) REFERENCES `portfolio` (`idPortfolio`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tatuador`
--
ALTER TABLE `tatuador`
  ADD CONSTRAINT `tatuador_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
