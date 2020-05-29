-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 27-Maio-2020 às 20:37
-- Versão do servidor: 10.1.39-MariaDB
-- versão do PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE bd_na_medida;

USE bd_na_medida;
 
--
-- Database: `bd_na_medida`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `Base`
--

CREATE TABLE `Base` (
  `idBase` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `idProjeto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `Base`
--

INSERT INTO `Base` (`idBase`, `nome`, `descricao`, `idProjeto`) VALUES
(1, 'Basiquinha', 'Minha base', 1),
(6, 'asdasd', 'Plano de Projeto', 2),
(7, 'Baseline editada', 'Nova base para baseline editada', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Indicador`
--

CREATE TABLE `Indicador` (
  `idIndicador` int(11) NOT NULL,
  `idBase` int(11) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `aceitavel` double DEFAULT NULL,
  `requer_atencao` double DEFAULT NULL,
  `tomar_providencia` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `Indicador`
--

INSERT INTO `Indicador` (`idIndicador`, `idBase`, `nome`, `descricao`, `aceitavel`, `requer_atencao`, `tomar_providencia`) VALUES
(1, NULL, 'indica', 'indicado como indicador', 10, 15, 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Indicador_medida_associada`
--

CREATE TABLE `Indicador_medida_associada` (
  `idIndicador_medida_associada` int(11) NOT NULL,
  `idMedida` int(11) DEFAULT NULL,
  `idIndicador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Indicador_modificacoes`
--

CREATE TABLE `Indicador_modificacoes` (
  `idIndicador_modificacoes` int(11) NOT NULL,
  `data_modificacao` datetime DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `idIndicador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Medida`
--

CREATE TABLE `Medida` (
  `idMedida` int(11) NOT NULL,
  `idBase` int(11) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `unidade_padrao` varchar(45) DEFAULT NULL,
  `responsavel` varchar(45) DEFAULT NULL,
  `tipo` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `Medida`
--

INSERT INTO `Medida` (`idMedida`, `idBase`, `nome`, `descricao`, `unidade_padrao`, `responsavel`, `tipo`) VALUES
(1, 1, 'Número de linhas', 'Número de linhas por dia', 'inteiro', 'Pedro da Silva', 0),
(2, 1, 'Horas trabalhadas', 'Quantidade de horas trabalhadas', 'minutos', 'Homer', 1),
(3, 1, 'Funções por projeto', 'Quantas funções são desenvolvidas por projeto', 'inteiro', 'Pedro Pedreira', 0),
(4, 1, 'Número de bugs por componente', 'Número de erros', 'inteiro', 'Guilherme', 0),
(5, 1, 'Número de Bugs por componente por mês', 'Erros por mês', 'inteiro', 'Kelly', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Medida_medida_associada`
--

CREATE TABLE `Medida_medida_associada` (
  `idMedida_derivada` int(11) NOT NULL,
  `idMedida_associada` int(11) DEFAULT NULL,
  `idMedida` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `Medida_medida_associada`
--

INSERT INTO `Medida_medida_associada` (`idMedida_derivada`, `idMedida_associada`, `idMedida`) VALUES
(1, 2, 1),
(2, 1, 2),
(3, 3, 2),
(4, 2, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Medida_modificacoes`
--

CREATE TABLE `Medida_modificacoes` (
  `idMedida_modificacoes` int(11) NOT NULL,
  `valor` double DEFAULT NULL,
  `responsavel` varchar(255) DEFAULT NULL,
  `data_modificacao` datetime DEFAULT NULL,
  `idMedida` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `Medida_modificacoes`
--

INSERT INTO `Medida_modificacoes` (`idMedida_modificacoes`, `valor`, `responsavel`, `data_modificacao`, `idMedida`) VALUES
(1, 100, 'Um cara qualquer', '2020-05-25 02:25:11', 2),
(2, 200, 'Outro cara', '2020-05-25 03:00:00', 2),
(3, 150, 'Guilherme', '2020-05-25 11:39:55', 1),
(4, 40, 'Kelly', '2020-05-25 11:38:30', 3),
(5, 3.4, 'Regina', '2020-05-25 11:38:47', 2),
(6, 20, 'Guilherme', '2020-05-25 11:41:41', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ObjEstrategico`
--

CREATE TABLE `ObjEstrategico` (
  `idObjEstrategico` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `idOrganizacao` int(11) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ObjEstrategico`
--

INSERT INTO `ObjEstrategico` (`idObjEstrategico`, `nome`, `idOrganizacao`, `descricao`) VALUES
(1, 'Produtividade', 10, 'Queremos aumentar a produtividade'),
(3, 'Rentabilidade', 1, 'Aumentar a produtividade da nossa organização');

-- --------------------------------------------------------

--
-- Estrutura da tabela `Organizacao`
--

CREATE TABLE `Organizacao` (
  `idOrganizacao` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `Organizacao`
--

INSERT INTO `Organizacao` (`idOrganizacao`, `idUsuario`, `nome`, `descricao`) VALUES
(1, 1, 'Minha', 'Minha Organização'),
(7, 1, 'Opa', 'Opa Opa'),
(10, 1, 'Tabajara', 'Tem os produtos mais revolucionários'),
(11, 2, 'Indigena', 'Só os caciques ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `Pergunta`
--

CREATE TABLE `Pergunta` (
  `idPergunta` int(11) NOT NULL,
  `idObjEstrategico` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `Pergunta`
--

INSERT INTO `Pergunta` (`idPergunta`, `idObjEstrategico`, `nome`, `descricao`) VALUES
(1, 1, 'Como ser mais produtivo?', 'Fazer mais com menos'),
(3, 3, 'Como aumenta o lucro?', 'Queremos mais dinheiro'),
(4, 3, 'Como fazer mais com menos?', 'Queremos mais usando menos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `PerguntaMedida`
--

CREATE TABLE `PerguntaMedida` (
  `idPerguntaMedida` int(11) NOT NULL,
  `idMedida` int(11) DEFAULT NULL,
  `idPergunta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `PerguntaMedida`
--

INSERT INTO `PerguntaMedida` (`idPerguntaMedida`, `idMedida`, `idPergunta`) VALUES
(8, 2, 4),
(10, 2, 3),
(11, 1, 4),
(12, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Projeto`
--

CREATE TABLE `Projeto` (
  `idProjeto` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `responsavel` varchar(45) DEFAULT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `data_termino` datetime DEFAULT NULL,
  `idOrganizacao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `Projeto`
--

INSERT INTO `Projeto` (`idProjeto`, `nome`, `descricao`, `responsavel`, `data_inicio`, `data_termino`, `idOrganizacao`) VALUES
(1, 'PIBIC', 'Teste do banco', 'João', '2020-07-05 23:09:10', '2020-07-06 23:09:10', 1),
(2, 'Novo', 'Nosso novo projeto', 'EuMesmo', '2020-05-18 00:00:00', '2020-05-25 00:00:00', 7),
(4, 'asdasdasd', 'asdaslj kljfaklj flkja kaj klsj fljlkajlkajksj', 'Regina', '2020-05-18 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Usuario`
--

CREATE TABLE `Usuario` (
  `idUsuario` int(11) NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `Usuario`
--

INSERT INTO `Usuario` (`idUsuario`, `login`, `senha`, `nome`) VALUES
(1, 'guilherme', '1234', 'Guilherme Miranda'),
(2, 'maria', '4321', 'Maria'),
(3, 'pedro', '12345', 'Pedro dos Santos');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Base`
--
ALTER TABLE `Base`
  ADD PRIMARY KEY (`idBase`),
  ADD KEY `fk_Base_Projeto1_idx` (`idProjeto`);

--
-- Indexes for table `Indicador`
--
ALTER TABLE `Indicador`
  ADD PRIMARY KEY (`idIndicador`),
  ADD KEY `fk_Indicador_Base1_idx` (`idBase`);

--
-- Indexes for table `Indicador_medida_associada`
--
ALTER TABLE `Indicador_medida_associada`
  ADD PRIMARY KEY (`idIndicador_medida_associada`),
  ADD KEY `fk_Indicador_medida_associada_Indicador1_idx` (`idIndicador`);

--
-- Indexes for table `Indicador_modificacoes`
--
ALTER TABLE `Indicador_modificacoes`
  ADD PRIMARY KEY (`idIndicador_modificacoes`),
  ADD KEY `fk_Indicador_modificacoes_Indicador1_idx` (`idIndicador`);

--
-- Indexes for table `Medida`
--
ALTER TABLE `Medida`
  ADD PRIMARY KEY (`idMedida`),
  ADD KEY `fk_Medida_Base1_idx` (`idBase`);

--
-- Indexes for table `Medida_medida_associada`
--
ALTER TABLE `Medida_medida_associada`
  ADD PRIMARY KEY (`idMedida_derivada`),
  ADD KEY `fk_Medida_derivada_Medida1_idx` (`idMedida`);

--
-- Indexes for table `Medida_modificacoes`
--
ALTER TABLE `Medida_modificacoes`
  ADD PRIMARY KEY (`idMedida_modificacoes`),
  ADD KEY `fk_Medida_modificacoes_Medida1_idx` (`idMedida`);

--
-- Indexes for table `ObjEstrategico`
--
ALTER TABLE `ObjEstrategico`
  ADD PRIMARY KEY (`idObjEstrategico`),
  ADD KEY `fk_ObjEstrategico_Organizacao1_idx` (`idOrganizacao`);

--
-- Indexes for table `Organizacao`
--
ALTER TABLE `Organizacao`
  ADD PRIMARY KEY (`idOrganizacao`),
  ADD KEY `fk_Organizacao_Usuario1_idx` (`idUsuario`);

--
-- Indexes for table `Pergunta`
--
ALTER TABLE `Pergunta`
  ADD PRIMARY KEY (`idPergunta`),
  ADD KEY `fk_Pergunta_ObjEstrategico1_idx` (`idObjEstrategico`);

--
-- Indexes for table `PerguntaMedida`
--
ALTER TABLE `PerguntaMedida`
  ADD PRIMARY KEY (`idPerguntaMedida`),
  ADD KEY `fk_PerguntaMedida_Medida1_idx` (`idMedida`),
  ADD KEY `fk_PerguntaMedida_Pergunta1_idx` (`idPergunta`);

--
-- Indexes for table `Projeto`
--
ALTER TABLE `Projeto`
  ADD PRIMARY KEY (`idProjeto`),
  ADD KEY `fk_Projeto_Organizacao1_idx` (`idOrganizacao`);

--
-- Indexes for table `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Base`
--
ALTER TABLE `Base`
  MODIFY `idBase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Indicador`
--
ALTER TABLE `Indicador`
  MODIFY `idIndicador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Indicador_medida_associada`
--
ALTER TABLE `Indicador_medida_associada`
  MODIFY `idIndicador_medida_associada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Indicador_modificacoes`
--
ALTER TABLE `Indicador_modificacoes`
  MODIFY `idIndicador_modificacoes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Medida`
--
ALTER TABLE `Medida`
  MODIFY `idMedida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Medida_medida_associada`
--
ALTER TABLE `Medida_medida_associada`
  MODIFY `idMedida_derivada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Medida_modificacoes`
--
ALTER TABLE `Medida_modificacoes`
  MODIFY `idMedida_modificacoes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ObjEstrategico`
--
ALTER TABLE `ObjEstrategico`
  MODIFY `idObjEstrategico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Organizacao`
--
ALTER TABLE `Organizacao`
  MODIFY `idOrganizacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Pergunta`
--
ALTER TABLE `Pergunta`
  MODIFY `idPergunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `PerguntaMedida`
--
ALTER TABLE `PerguntaMedida`
  MODIFY `idPerguntaMedida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Projeto`
--
ALTER TABLE `Projeto`
  MODIFY `idProjeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `Base`
--
ALTER TABLE `Base`
  ADD CONSTRAINT `fk_Base_Projeto1` FOREIGN KEY (`idProjeto`) REFERENCES `Projeto` (`idProjeto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Indicador`
--
ALTER TABLE `Indicador`
  ADD CONSTRAINT `fk_Indicador_Base1` FOREIGN KEY (`idBase`) REFERENCES `Base` (`idBase`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Indicador_medida_associada`
--
ALTER TABLE `Indicador_medida_associada`
  ADD CONSTRAINT `fk_Indicador_medida_associada_Indicador1` FOREIGN KEY (`idIndicador`) REFERENCES `Indicador` (`idIndicador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Indicador_modificacoes`
--
ALTER TABLE `Indicador_modificacoes`
  ADD CONSTRAINT `fk_Indicador_modificacoes_Indicador1` FOREIGN KEY (`idIndicador`) REFERENCES `Indicador` (`idIndicador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Medida`
--
ALTER TABLE `Medida`
  ADD CONSTRAINT `fk_Medida_Base1` FOREIGN KEY (`idBase`) REFERENCES `Base` (`idBase`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Medida_medida_associada`
--
ALTER TABLE `Medida_medida_associada`
  ADD CONSTRAINT `fk_Medida_derivada_Medida1` FOREIGN KEY (`idMedida`) REFERENCES `Medida` (`idMedida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Medida_modificacoes`
--
ALTER TABLE `Medida_modificacoes`
  ADD CONSTRAINT `fk_Medida_modificacoes_Medida1` FOREIGN KEY (`idMedida`) REFERENCES `Medida` (`idMedida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ObjEstrategico`
--
ALTER TABLE `ObjEstrategico`
  ADD CONSTRAINT `fk_ObjEstrategico_Organizacao1` FOREIGN KEY (`idOrganizacao`) REFERENCES `Organizacao` (`idOrganizacao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Organizacao`
--
ALTER TABLE `Organizacao`
  ADD CONSTRAINT `fk_Organizacao_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Pergunta`
--
ALTER TABLE `Pergunta`
  ADD CONSTRAINT `fk_Pergunta_ObjEstrategico1` FOREIGN KEY (`idObjEstrategico`) REFERENCES `ObjEstrategico` (`idObjEstrategico`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `PerguntaMedida`
--
ALTER TABLE `PerguntaMedida`
  ADD CONSTRAINT `fk_PerguntaMedida_Medida1` FOREIGN KEY (`idMedida`) REFERENCES `Medida` (`idMedida`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PerguntaMedida_Pergunta1` FOREIGN KEY (`idPergunta`) REFERENCES `Pergunta` (`idPergunta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Projeto`
--
ALTER TABLE `Projeto`
  ADD CONSTRAINT `fk_Projeto_Organizacao1` FOREIGN KEY (`idOrganizacao`) REFERENCES `Organizacao` (`idOrganizacao`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
