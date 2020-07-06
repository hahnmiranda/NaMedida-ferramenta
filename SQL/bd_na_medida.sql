-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 06-Jul-2020 às 14:10
-- Versão do servidor: 10.1.39-MariaDB
-- versão do PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_na_medida`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `base`
--

CREATE TABLE `base` (
  `idBase` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `idProjeto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `base`
--

INSERT INTO `base` (`idBase`, `nome`, `descricao`, `idProjeto`) VALUES
(1, 'Basiquinha', 'Minha base', 2),
(6, 'asdasd', 'Plano de Projeto', 1),
(7, 'Baseline editada', 'Nova base para baseline editada', 1),
(8, 'Cursos', 'asdasdas', 4),
(9, 'Base Teste', 'Teste da Base', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `indicador`
--

CREATE TABLE `indicador` (
  `idIndicador` int(11) NOT NULL,
  `idBase` int(11) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `aceitavel` double DEFAULT NULL,
  `requer_atencao` double DEFAULT NULL,
  `tomar_providencia` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `indicador`
--

INSERT INTO `indicador` (`idIndicador`, `idBase`, `nome`, `descricao`, `aceitavel`, `requer_atencao`, `tomar_providencia`) VALUES
(1, 9, 'indica', 'indicado como indicador', 10, 15, 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `indicador_medida_associada`
--

CREATE TABLE `indicador_medida_associada` (
  `idIndicador_medida_associada` int(11) NOT NULL,
  `idMedida` int(11) DEFAULT NULL,
  `idIndicador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `indicador_medida_associada`
--

INSERT INTO `indicador_medida_associada` (`idIndicador_medida_associada`, `idMedida`, `idIndicador`) VALUES
(19, 15, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `indicador_modificacoes`
--

CREATE TABLE `indicador_modificacoes` (
  `idIndicador_modificacoes` int(11) NOT NULL,
  `data_modificacao` datetime DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `idIndicador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `medida`
--

CREATE TABLE `medida` (
  `idMedida` int(11) NOT NULL,
  `idBase` int(11) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `unidade_padrao` varchar(45) DEFAULT NULL,
  `responsavel` varchar(45) DEFAULT NULL,
  `tipo` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `medida`
--

INSERT INTO `medida` (`idMedida`, `idBase`, `nome`, `descricao`, `unidade_padrao`, `responsavel`, `tipo`) VALUES
(1, 1, 'Número de linhas', 'Número de linhas por dia', 'inteiro', 'Pedro da Silva', 0),
(2, 1, 'Horas trabalhadas', 'Quantidade de horas trabalhadas', 'minutos', 'Homer', 0),
(3, 1, 'Funções por projeto', 'Quantas funções são desenvolvidas por projeto', 'inteiro', 'Pedro Pedreira', 0),
(4, 1, 'Número de bugs por componente', 'Número de erros', 'inteiro', 'Guilherme', 0),
(5, 1, 'Número de Bugs por componente por mês', 'Erros por mês', 'inteiro', 'Kelly', 0),
(6, 7, 'Medidaça', 'Essa medida é grande', 'léguas', 'Romeu', 0),
(7, 1, 'Aquela medida', 'Medida daquelas', 'linhas', 'Creuza', 0),
(8, 8, 'Número de estudantes', 'Total de estudantes ', 'inteiro', 'Kelly', 0),
(9, 8, 'Cursos', 'Nome dos cursos', 'String', 'Kelly', 0),
(10, 8, 'Número de estudantes por curso', 'Número de estudantes por curso', 'inteiro', 'Kelly', 0),
(11, 1, 'Número de botões', 'asdasdasd', 'inteiro', 'Kelly', 0),
(12, 1, 'Número de telas', 'asdasdasd', 'inteiro', 'Kelly', 0),
(14, 1, 'Número de botões por tela', 'asdasdasd', 'inteiro', 'Kelly', 0),
(15, 9, 'Medida Teste 1', 'Teste da medida 1', 'inteiro', 'Guilherme', 0),
(16, 9, 'Medida Teste 2', 'Teste da medida 2', 'inteiro', 'Guilherme', 0),
(17, 9, 'Medida Teste 3', 'Teste da medida 3', 'float', 'Guilherme', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medida_medida_associada`
--

CREATE TABLE `medida_medida_associada` (
  `idMedida_derivada` int(11) NOT NULL,
  `idMedida_associada` int(11) DEFAULT NULL,
  `idMedida` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `medida_medida_associada`
--

INSERT INTO `medida_medida_associada` (`idMedida_derivada`, `idMedida_associada`, `idMedida`) VALUES
(1, 2, 1),
(2, 1, 2),
(3, 3, 2),
(4, 2, 5),
(5, 8, 10),
(6, 9, 10),
(7, 11, 14),
(8, 12, 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medida_modificacoes`
--

CREATE TABLE `medida_modificacoes` (
  `idMedida_modificacoes` int(11) NOT NULL,
  `valor` varchar(255) DEFAULT NULL,
  `responsavel` varchar(255) DEFAULT NULL,
  `data_modificacao` datetime DEFAULT NULL,
  `idMedida` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `medida_modificacoes`
--

INSERT INTO `medida_modificacoes` (`idMedida_modificacoes`, `valor`, `responsavel`, `data_modificacao`, `idMedida`) VALUES
(1, '100', 'Um cara qualquer', '2020-05-25 02:25:11', 2),
(2, '200', 'Outro cara', '2020-05-25 03:00:00', 2),
(3, '150', 'Guilherme', '2020-05-25 11:39:55', 1),
(4, '40', 'Kelly', '2020-05-25 11:38:30', 3),
(5, '3.4', 'Regina', '2020-05-25 11:38:47', 2),
(6, '20', 'Guilherme', '2020-05-25 11:41:41', 4),
(7, '35', 'Kelly', '2020-06-18 18:37:19', 8),
(8, 'Engenharia de Software', 'Kelly', '2020-06-18 18:29:08', 9),
(9, 'Engenharia de Software = 35', 'Kelly', '2020-06-18 18:31:18', 10),
(10, '10', 'Kelly', '2020-06-18 18:53:36', 11),
(11, '5', 'Kelly', '2020-06-18 18:53:50', 12),
(12, '2', 'Kelly', '2020-06-18 18:54:03', 14),
(13, '124', 'Guilherme', '2020-06-29 08:02:50', 15);

-- --------------------------------------------------------

--
-- Estrutura da tabela `objestrategico`
--

CREATE TABLE `objestrategico` (
  `idObjEstrategico` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `idOrganizacao` int(11) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `objestrategico`
--

INSERT INTO `objestrategico` (`idObjEstrategico`, `nome`, `idOrganizacao`, `descricao`) VALUES
(1, 'Produtividade', NULL, 'Queremos aumentar a produtividade'),
(3, 'Rentabilidade', 1, 'Aumentar a produtividade da nossa organização');

-- --------------------------------------------------------

--
-- Estrutura da tabela `organizacao`
--

CREATE TABLE `organizacao` (
  `idOrganizacao` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `organizacao`
--

INSERT INTO `organizacao` (`idOrganizacao`, `idUsuario`, `nome`, `descricao`) VALUES
(1, 1, 'Minha', 'Minha Organização'),
(7, 1, 'Opa', 'Opa Opa'),
(11, 2, 'Indigena', 'Só os caciques '),
(12, 1, 'PUCPR', 'PUC'),
(13, 1, 'Organização Teste', 'Teste da organização');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pergunta`
--

CREATE TABLE `pergunta` (
  `idPergunta` int(11) NOT NULL,
  `idObjEstrategico` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pergunta`
--

INSERT INTO `pergunta` (`idPergunta`, `idObjEstrategico`, `nome`, `descricao`) VALUES
(1, 1, 'Como ser mais produtivo?', 'Fazer mais com menos'),
(3, 3, 'Como aumenta o lucro?', 'Queremos mais dinheiro'),
(4, 3, 'Como fazer mais com menos?', 'Queremos mais usando menos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perguntamedida`
--

CREATE TABLE `perguntamedida` (
  `idPerguntaMedida` int(11) NOT NULL,
  `idMedida` int(11) DEFAULT NULL,
  `idPergunta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `perguntamedida`
--

INSERT INTO `perguntamedida` (`idPerguntaMedida`, `idMedida`, `idPergunta`) VALUES
(8, 2, 4),
(10, 2, 3),
(11, 1, 4),
(12, 1, 1),
(14, 15, 3),
(15, 16, 3),
(16, 15, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

CREATE TABLE `projeto` (
  `idProjeto` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `responsavel` varchar(45) DEFAULT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `data_termino` datetime DEFAULT NULL,
  `idSetor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `projeto`
--

INSERT INTO `projeto` (`idProjeto`, `nome`, `descricao`, `responsavel`, `data_inicio`, `data_termino`, `idSetor`) VALUES
(1, 'PIBIC', 'Teste do banco', 'João', '2020-07-05 23:09:10', '2020-07-06 23:09:10', 1),
(2, 'Novo', 'Nosso novo projeto', 'EuMesmo', '2020-05-18 00:00:00', '2020-05-25 00:00:00', 1),
(4, 'asdasdasd', 'asdaslj kljfaklj flkja kaj klsj fljlkajlkajksj', 'Regina', '2020-05-18 00:00:00', '0000-00-00 00:00:00', 3),
(9, 'Projeto Teste', 'Teste do projeto', 'Guilherme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `setor`
--

CREATE TABLE `setor` (
  `idSetor` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `responsavel` varchar(255) DEFAULT NULL,
  `idOrganizacao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `setor`
--

INSERT INTO `setor` (`idSetor`, `nome`, `descricao`, `responsavel`, `idOrganizacao`) VALUES
(1, 'Almoxarifado', 'Armazenar itens', 'Silvio Santos', 1),
(2, 'Financeiro', 'Aumentar os números', 'Faustão', 7),
(3, 'Diretoria Acadêmica', 'adsasfgsgdf', 'Kelly', 12),
(4, 'Setor Teste', 'Teste do setor', 'Guilherme', 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `login`, `senha`, `nome`) VALUES
(1, 'guilherme', '1234', 'Guilherme Miranda'),
(2, 'maria', '4321', 'Maria'),
(3, 'pedro', '12345', 'Pedro dos Santos');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `base`
--
ALTER TABLE `base`
  ADD PRIMARY KEY (`idBase`),
  ADD KEY `fk_Base_Projeto1_idx` (`idProjeto`);

--
-- Indexes for table `indicador`
--
ALTER TABLE `indicador`
  ADD PRIMARY KEY (`idIndicador`),
  ADD KEY `fk_Indicador_Base1_idx` (`idBase`);

--
-- Indexes for table `indicador_medida_associada`
--
ALTER TABLE `indicador_medida_associada`
  ADD PRIMARY KEY (`idIndicador_medida_associada`),
  ADD KEY `fk_Indicador_medida_associada_Indicador1_idx` (`idIndicador`);

--
-- Indexes for table `indicador_modificacoes`
--
ALTER TABLE `indicador_modificacoes`
  ADD PRIMARY KEY (`idIndicador_modificacoes`),
  ADD KEY `fk_Indicador_modificacoes_Indicador1_idx` (`idIndicador`);

--
-- Indexes for table `medida`
--
ALTER TABLE `medida`
  ADD PRIMARY KEY (`idMedida`),
  ADD KEY `fk_Medida_Base1_idx` (`idBase`);

--
-- Indexes for table `medida_medida_associada`
--
ALTER TABLE `medida_medida_associada`
  ADD PRIMARY KEY (`idMedida_derivada`),
  ADD KEY `fk_Medida_derivada_Medida1_idx` (`idMedida`);

--
-- Indexes for table `medida_modificacoes`
--
ALTER TABLE `medida_modificacoes`
  ADD PRIMARY KEY (`idMedida_modificacoes`),
  ADD KEY `fk_Medida_modificacoes_Medida1_idx` (`idMedida`);

--
-- Indexes for table `objestrategico`
--
ALTER TABLE `objestrategico`
  ADD PRIMARY KEY (`idObjEstrategico`),
  ADD KEY `fk_ObjEstrategico_Organizacao1_idx` (`idOrganizacao`);

--
-- Indexes for table `organizacao`
--
ALTER TABLE `organizacao`
  ADD PRIMARY KEY (`idOrganizacao`),
  ADD KEY `fk_Organizacao_Usuario1_idx` (`idUsuario`);

--
-- Indexes for table `pergunta`
--
ALTER TABLE `pergunta`
  ADD PRIMARY KEY (`idPergunta`),
  ADD KEY `fk_Pergunta_ObjEstrategico1_idx` (`idObjEstrategico`);

--
-- Indexes for table `perguntamedida`
--
ALTER TABLE `perguntamedida`
  ADD PRIMARY KEY (`idPerguntaMedida`),
  ADD KEY `fk_PerguntaMedida_Medida1_idx` (`idMedida`),
  ADD KEY `fk_PerguntaMedida_Pergunta1_idx` (`idPergunta`);

--
-- Indexes for table `projeto`
--
ALTER TABLE `projeto`
  ADD PRIMARY KEY (`idProjeto`),
  ADD KEY `fk_setor_projeto` (`idSetor`);

--
-- Indexes for table `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`idSetor`),
  ADD KEY `fk_OrgSetor` (`idOrganizacao`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `base`
--
ALTER TABLE `base`
  MODIFY `idBase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `indicador`
--
ALTER TABLE `indicador`
  MODIFY `idIndicador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `indicador_medida_associada`
--
ALTER TABLE `indicador_medida_associada`
  MODIFY `idIndicador_medida_associada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `indicador_modificacoes`
--
ALTER TABLE `indicador_modificacoes`
  MODIFY `idIndicador_modificacoes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medida`
--
ALTER TABLE `medida`
  MODIFY `idMedida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `medida_medida_associada`
--
ALTER TABLE `medida_medida_associada`
  MODIFY `idMedida_derivada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `medida_modificacoes`
--
ALTER TABLE `medida_modificacoes`
  MODIFY `idMedida_modificacoes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `objestrategico`
--
ALTER TABLE `objestrategico`
  MODIFY `idObjEstrategico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `organizacao`
--
ALTER TABLE `organizacao`
  MODIFY `idOrganizacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pergunta`
--
ALTER TABLE `pergunta`
  MODIFY `idPergunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `perguntamedida`
--
ALTER TABLE `perguntamedida`
  MODIFY `idPerguntaMedida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `projeto`
--
ALTER TABLE `projeto`
  MODIFY `idProjeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `setor`
--
ALTER TABLE `setor`
  MODIFY `idSetor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `base`
--
ALTER TABLE `base`
  ADD CONSTRAINT `fk_projeto_base` FOREIGN KEY (`idProjeto`) REFERENCES `projeto` (`idProjeto`);

--
-- Limitadores para a tabela `indicador`
--
ALTER TABLE `indicador`
  ADD CONSTRAINT `fk_Indicador_Base1` FOREIGN KEY (`idBase`) REFERENCES `base` (`idBase`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `indicador_medida_associada`
--
ALTER TABLE `indicador_medida_associada`
  ADD CONSTRAINT `fk_Indicador_medida_associada_Indicador1` FOREIGN KEY (`idIndicador`) REFERENCES `indicador` (`idIndicador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `indicador_modificacoes`
--
ALTER TABLE `indicador_modificacoes`
  ADD CONSTRAINT `fk_Indicador_modificacoes_Indicador1` FOREIGN KEY (`idIndicador`) REFERENCES `indicador` (`idIndicador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `medida`
--
ALTER TABLE `medida`
  ADD CONSTRAINT `fk_Medida_Base1` FOREIGN KEY (`idBase`) REFERENCES `base` (`idBase`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `medida_medida_associada`
--
ALTER TABLE `medida_medida_associada`
  ADD CONSTRAINT `fk_Medida_derivada_Medida1` FOREIGN KEY (`idMedida`) REFERENCES `medida` (`idMedida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `medida_modificacoes`
--
ALTER TABLE `medida_modificacoes`
  ADD CONSTRAINT `fk_Medida_modificacoes_Medida1` FOREIGN KEY (`idMedida`) REFERENCES `medida` (`idMedida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `objestrategico`
--
ALTER TABLE `objestrategico`
  ADD CONSTRAINT `fk_ObjEstrategico_Organizacao1` FOREIGN KEY (`idOrganizacao`) REFERENCES `organizacao` (`idOrganizacao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `organizacao`
--
ALTER TABLE `organizacao`
  ADD CONSTRAINT `fk_Organizacao_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pergunta`
--
ALTER TABLE `pergunta`
  ADD CONSTRAINT `fk_Pergunta_ObjEstrategico1` FOREIGN KEY (`idObjEstrategico`) REFERENCES `objestrategico` (`idObjEstrategico`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `perguntamedida`
--
ALTER TABLE `perguntamedida`
  ADD CONSTRAINT `fk_PerguntaMedida_Medida1` FOREIGN KEY (`idMedida`) REFERENCES `medida` (`idMedida`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PerguntaMedida_Pergunta1` FOREIGN KEY (`idPergunta`) REFERENCES `pergunta` (`idPergunta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `projeto`
--
ALTER TABLE `projeto`
  ADD CONSTRAINT `fk_setor_projeto` FOREIGN KEY (`idSetor`) REFERENCES `setor` (`idSetor`);

--
-- Limitadores para a tabela `setor`
--
ALTER TABLE `setor`
  ADD CONSTRAINT `fk_OrgSetor` FOREIGN KEY (`idOrganizacao`) REFERENCES `organizacao` (`idOrganizacao`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
