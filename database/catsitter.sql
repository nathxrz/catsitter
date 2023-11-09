-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/11/2023 às 02:20
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `catsitter`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `cod_agendamento` int(11) NOT NULL,
  `dt_inicio` datetime NOT NULL DEFAULT current_timestamp(),
  `dt_fim` datetime NOT NULL DEFAULT current_timestamp(),
  `cod_servico` int(11) DEFAULT NULL,
  `cod_usuario` int(11) DEFAULT NULL,
  `cod_catsitter` int(11) DEFAULT NULL,
  `cod_pet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamento_pets`
--

CREATE TABLE `agendamento_pets` (
  `cod_agendamento` int(11) NOT NULL,
  `cod_pet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cat_sitters`
--

CREATE TABLE `cat_sitters` (
  `cod_catsitter` int(11) NOT NULL,
  `preco` varchar(100) DEFAULT NULL,
  `cod_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cat_sitters`
--

INSERT INTO `cat_sitters` (`cod_catsitter`, `preco`, `cod_usuario`) VALUES
(1, NULL, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `chat`
--

CREATE TABLE `chat` (
  `cod_mensagem` int(11) NOT NULL,
  `mensagem` varchar(500) NOT NULL,
  `data_hora` datetime NOT NULL DEFAULT current_timestamp(),
  `cod_usuario` int(11) DEFAULT NULL,
  `cod_catsitter` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `distintivos`
--

CREATE TABLE `distintivos` (
  `cod_distintivo` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `distintivo_catsitter`
--

CREATE TABLE `distintivo_catsitter` (
  `cod_catsitter` int(11) NOT NULL,
  `cod_distintivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fotos`
--

CREATE TABLE `fotos` (
  `cod_foto` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `caminho` varchar(50) NOT NULL,
  `dt_criacao` datetime NOT NULL DEFAULT current_timestamp(),
  `cod_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `galeria_pet`
--

CREATE TABLE `galeria_pet` (
  `cod_galeria` int(11) NOT NULL,
  `cod_foto` int(11) DEFAULT NULL,
  `cod_pet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `galeria_sitter`
--

CREATE TABLE `galeria_sitter` (
  `cod_galeria` int(11) NOT NULL,
  `cod_foto` int(11) DEFAULT NULL,
  `cod_catsitter` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `gatos`
--

CREATE TABLE `gatos` (
  `cod_pet` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `dt_nascimento` varchar(10) DEFAULT NULL,
  `sexo` varchar(20) NOT NULL,
  `raca` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL DEFAULT 'foto.png',
  `rotina` varchar(500) DEFAULT NULL,
  `ficha_medica` varchar(500) DEFAULT NULL,
  `cod_usuario` int(11) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `recuperacao_senha`
--

CREATE TABLE `recuperacao_senha` (
  `email` varchar(255) NOT NULL,
  `confirmacao` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `recuperacao_senha`
--

INSERT INTO `recuperacao_senha` (`email`, `confirmacao`) VALUES
('nathyrezendemachado@gmail.com', '4fc2d9aa4e20e4512a45c6cc54c98edd1e4095ce');

-- --------------------------------------------------------

--
-- Estrutura para tabela `relatorios`
--

CREATE TABLE `relatorios` (
  `cod_relatorio` int(11) NOT NULL,
  `check_in` datetime NOT NULL DEFAULT current_timestamp(),
  `check_out` datetime NOT NULL DEFAULT current_timestamp(),
  `descricao` varchar(500) NOT NULL,
  `foto_tipo` varchar(20) NOT NULL,
  `caminho` varchar(20) NOT NULL,
  `cod_agendamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `cod_servico` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `telefones`
--

CREATE TABLE `telefones` (
  `telefone` varchar(14) NOT NULL,
  `cod_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `cod_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `dt_nascimento` varchar(100) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `foto` varchar(50) NOT NULL DEFAULT 'foto.png',
  `reg_date` date NOT NULL DEFAULT curdate(),
  `cep` varchar(10) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `adm` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `confirma_email` int(11) NOT NULL DEFAULT 0,
  `senha` varchar(255) NOT NULL
) ;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`cod_usuario`, `nome`, `sobrenome`, `dt_nascimento`, `genero`, `cpf`, `foto`, `reg_date`, `cep`, `rua`, `numero`, `cidade`, `estado`, `pais`, `complemento`, `adm`, `email`, `confirma_email`, `senha`) VALUES
(2, '2', '2', '2023-11-05', 'Masculino', '2', 'foto.png', '2023-11-08', '2', '2', '2', '2', '2', '2', '2', 0, '2@gmail.com', 0, '$2y$10$Oq4tBJj0AaXCVMJa1B7fmO96r2Ng1856Eb4FMyA8QZNhVA6t7eAYS'),
(5, 'Nathalia', 'Machado', '1999-03-20', 'Feminino', '123123', 'foto.png', '2023-11-08', '96010-430', 'Avenida Bento Martins', '353', 'CAPAO DO LEAO', 'Rio Grande do Sul', 'Brasil', '', 0, 'nathyrezendemachado@gmail.com', 1, '$2y$10$bzJ1elxkoYbKuE4qRW/6s.j4KH/acT3oWe7H.Tqcptn5nzLnVEwvS');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`cod_agendamento`),
  ADD KEY `fk_agend_servico` (`cod_servico`),
  ADD KEY `fk_agend_usuario` (`cod_usuario`),
  ADD KEY `fk_agend_sitter` (`cod_catsitter`);

--
-- Índices de tabela `agendamento_pets`
--
ALTER TABLE `agendamento_pets`
  ADD PRIMARY KEY (`cod_agendamento`,`cod_pet`),
  ADD KEY `fk_pet` (`cod_pet`);

--
-- Índices de tabela `cat_sitters`
--
ALTER TABLE `cat_sitters`
  ADD PRIMARY KEY (`cod_catsitter`,`cod_usuario`),
  ADD KEY `fk_cat_sitters` (`cod_usuario`);

--
-- Índices de tabela `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`cod_mensagem`),
  ADD KEY `fk_chat_usuario` (`cod_usuario`),
  ADD KEY `fk_chat_sitter` (`cod_catsitter`);

--
-- Índices de tabela `distintivos`
--
ALTER TABLE `distintivos`
  ADD PRIMARY KEY (`cod_distintivo`);

--
-- Índices de tabela `distintivo_catsitter`
--
ALTER TABLE `distintivo_catsitter`
  ADD PRIMARY KEY (`cod_catsitter`,`cod_distintivo`),
  ADD KEY `fk_relacao_distintivo` (`cod_distintivo`);

--
-- Índices de tabela `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`cod_foto`),
  ADD KEY `fk_cod_usuario` (`cod_usuario`);

--
-- Índices de tabela `galeria_pet`
--
ALTER TABLE `galeria_pet`
  ADD PRIMARY KEY (`cod_galeria`),
  ADD KEY `fk_cod_foto` (`cod_foto`),
  ADD KEY `fk_cod_pet` (`cod_pet`);

--
-- Índices de tabela `galeria_sitter`
--
ALTER TABLE `galeria_sitter`
  ADD PRIMARY KEY (`cod_galeria`),
  ADD KEY `fk_cod_foto_sitter` (`cod_foto`),
  ADD KEY `fk_codsitter` (`cod_catsitter`);

--
-- Índices de tabela `gatos`
--
ALTER TABLE `gatos`
  ADD PRIMARY KEY (`cod_pet`),
  ADD KEY `fk_gatos` (`cod_usuario`);

--
-- Índices de tabela `recuperacao_senha`
--
ALTER TABLE `recuperacao_senha`
  ADD KEY `utilizador` (`email`,`confirmacao`);

--
-- Índices de tabela `relatorios`
--
ALTER TABLE `relatorios`
  ADD PRIMARY KEY (`cod_relatorio`),
  ADD KEY `fk_relatorio_agend` (`cod_agendamento`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`cod_servico`);

--
-- Índices de tabela `telefones`
--
ALTER TABLE `telefones`
  ADD PRIMARY KEY (`telefone`,`cod_usuario`),
  ADD KEY `fk_telefones` (`cod_usuario`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cod_usuario`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `cod_agendamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cat_sitters`
--
ALTER TABLE `cat_sitters`
  MODIFY `cod_catsitter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `chat`
--
ALTER TABLE `chat`
  MODIFY `cod_mensagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `distintivos`
--
ALTER TABLE `distintivos`
  MODIFY `cod_distintivo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fotos`
--
ALTER TABLE `fotos`
  MODIFY `cod_foto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `galeria_pet`
--
ALTER TABLE `galeria_pet`
  MODIFY `cod_galeria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `galeria_sitter`
--
ALTER TABLE `galeria_sitter`
  MODIFY `cod_galeria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `gatos`
--
ALTER TABLE `gatos`
  MODIFY `cod_pet` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `relatorios`
--
ALTER TABLE `relatorios`
  MODIFY `cod_relatorio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `cod_servico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `fk_agend_servico` FOREIGN KEY (`cod_servico`) REFERENCES `servicos` (`cod_servico`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_agend_sitter` FOREIGN KEY (`cod_catsitter`) REFERENCES `cat_sitters` (`cod_catsitter`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_agend_usuario` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `agendamento_pets`
--
ALTER TABLE `agendamento_pets`
  ADD CONSTRAINT `fk_agend` FOREIGN KEY (`cod_agendamento`) REFERENCES `agendamentos` (`cod_agendamento`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pet` FOREIGN KEY (`cod_pet`) REFERENCES `gatos` (`cod_pet`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `cat_sitters`
--
ALTER TABLE `cat_sitters`
  ADD CONSTRAINT `fk_cat_sitters` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk_chat_sitter` FOREIGN KEY (`cod_catsitter`) REFERENCES `cat_sitters` (`cod_catsitter`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_chat_usuario` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `distintivo_catsitter`
--
ALTER TABLE `distintivo_catsitter`
  ADD CONSTRAINT `fk_relacao_distintivo` FOREIGN KEY (`cod_distintivo`) REFERENCES `distintivos` (`cod_distintivo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_relacao_sitter` FOREIGN KEY (`cod_catsitter`) REFERENCES `cat_sitters` (`cod_catsitter`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fk_cod_usuario` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `galeria_pet`
--
ALTER TABLE `galeria_pet`
  ADD CONSTRAINT `fk_cod_foto` FOREIGN KEY (`cod_foto`) REFERENCES `fotos` (`cod_foto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cod_pet` FOREIGN KEY (`cod_pet`) REFERENCES `gatos` (`cod_pet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `galeria_sitter`
--
ALTER TABLE `galeria_sitter`
  ADD CONSTRAINT `fk_cod_foto_sitter` FOREIGN KEY (`cod_foto`) REFERENCES `fotos` (`cod_foto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_codsitter` FOREIGN KEY (`cod_catsitter`) REFERENCES `cat_sitters` (`cod_catsitter`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `gatos`
--
ALTER TABLE `gatos`
  ADD CONSTRAINT `fk_gatos` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `relatorios`
--
ALTER TABLE `relatorios`
  ADD CONSTRAINT `fk_relatorio_agend` FOREIGN KEY (`cod_agendamento`) REFERENCES `agendamentos` (`cod_agendamento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `telefones`
--
ALTER TABLE `telefones`
  ADD CONSTRAINT `fk_telefones` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
