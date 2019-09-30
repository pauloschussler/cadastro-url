-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Set-2019 às 02:37
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistemaurl`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `idpessoa` int(11) NOT NULL,
  `nomepessoa` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`idpessoa`, `nomepessoa`) VALUES
(1, 'Paulo Junior Schüssler');

-- --------------------------------------------------------

--
-- Estrutura da tabela `requisicao`
--

CREATE TABLE `requisicao` (
  `idrequisicao` int(11) NOT NULL,
  `url_idurl` int(11) NOT NULL DEFAULT 0,
  `requisicaostatus` tinyint(4) NOT NULL DEFAULT 0,
  `atualizado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `conteudo` mediumtext DEFAULT NULL,
  `statuscode` int(11) DEFAULT NULL,
  `descricaorequisicao` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `requisicao`
--

INSERT INTO `requisicao` (`idrequisicao`, `url_idurl`, `requisicaostatus`, `atualizado`, `conteudo`, `statuscode`, `descricaorequisicao`) VALUES
(12, 34, 1, '2019-09-30 04:45:22', '[{\"DPNSS\":2.3333333333333335},{\"CLXPX\":207.66666666666666},{\"RPPKK\":56.77777777777778},{\"NIAGN\":81.66666666666667},{\"GPGOG\":28},{\"TVPPC\":124.6},{\"CVJYZ\":231},{\"UHLBE\":168},{\"OKVGK\":50.55555555555556},{\"XVXMB\":81.2}]', 200, NULL),
(17, 39, 1, '2019-09-30 05:23:44', '[{\"IXQRY\":930},{\"YYICG\":14},{\"TJZDL\":23.333333333333332},{\"VJAXA\":51.111111111111114},{\"TWPAS\":120},{\"REXFQ\":1},{\"HAURI\":32.22222222222222},{\"ZXRAI\":102},{\"SAVHT\":146.66666666666666},{\"TEURS\":200}]', 200, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipousuario`
--

CREATE TABLE `tipousuario` (
  `idtipousuario` int(11) NOT NULL,
  `tipousuario` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipousuario`
--

INSERT INTO `tipousuario` (`idtipousuario`, `tipousuario`) VALUES
(1, 'Administrador'),
(2, 'Usuário');

-- --------------------------------------------------------

--
-- Estrutura da tabela `url`
--

CREATE TABLE `url` (
  `idurl` int(11) NOT NULL,
  `url` varchar(1000) NOT NULL DEFAULT 'error',
  `finalidadeurl` varchar(200) DEFAULT NULL,
  `descricaourl` varchar(2000) DEFAULT NULL,
  `datacadastro` date NOT NULL,
  `horacadastro` time NOT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  `inserido` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `url`
--

INSERT INTO `url` (`idurl`, `url`, `finalidadeurl`, `descricaourl`, `datacadastro`, `horacadastro`, `usuario_idusuario`, `inserido`) VALUES
(34, 'http://localhost/sistema-url/Dados?valor=7', 'Teste', '1234', '2019-09-30', '01:09:22', 1, '2019-09-30 04:45:22'),
(39, 'http://localhost/sistema-url/Dados?valor=10', '1234', '1234', '2019-09-30', '02:09:44', 1, '2019-09-30 05:23:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `email` varchar(200) NOT NULL DEFAULT '0',
  `senha` varchar(1000) NOT NULL DEFAULT '0',
  `pessoa_idpessoa` int(11) NOT NULL DEFAULT 0,
  `tipousuario_idtipousuario` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `email`, `senha`, `pessoa_idpessoa`, `tipousuario_idtipousuario`) VALUES
(1, 'paulojuniorpjs@hotmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`idpessoa`);

--
-- Índices para tabela `requisicao`
--
ALTER TABLE `requisicao`
  ADD PRIMARY KEY (`idrequisicao`),
  ADD KEY `FK__url` (`url_idurl`);

--
-- Índices para tabela `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`idtipousuario`);

--
-- Índices para tabela `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`idurl`),
  ADD KEY `FK_url_usuario` (`usuario_idusuario`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK__pessoa` (`pessoa_idpessoa`),
  ADD KEY `FK__tipousuario` (`tipousuario_idtipousuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `idpessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `requisicao`
--
ALTER TABLE `requisicao`
  MODIFY `idrequisicao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `idtipousuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `url`
--
ALTER TABLE `url`
  MODIFY `idurl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `requisicao`
--
ALTER TABLE `requisicao`
  ADD CONSTRAINT `FK__url` FOREIGN KEY (`url_idurl`) REFERENCES `url` (`idurl`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `url`
--
ALTER TABLE `url`
  ADD CONSTRAINT `FK_url_usuario` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK__pessoa` FOREIGN KEY (`pessoa_idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK__tipousuario` FOREIGN KEY (`tipousuario_idtipousuario`) REFERENCES `tipousuario` (`idtipousuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
