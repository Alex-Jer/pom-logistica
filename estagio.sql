-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03-Maio-2019 às 11:24
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estagio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `armazem`
--

CREATE TABLE `armazem` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL,
  `espaco` int(5) NOT NULL,
  `custo_carga` decimal(5,2) NOT NULL,
  `custo_descarga` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `armazem`
--

INSERT INTO `armazem` (`id`, `nome`, `espaco`, `custo_carga`, `custo_descarga`) VALUES
(3, 'Armazem A(Altas)', 50, '19.99', '17.99'),
(4, 'Armazem B(Baixas)', 100, '14.99', '12.99'),
(5, 'Armazem C(Fria)', 25, '29.99', '27.49'),
(6, 'Armazem D(Altas e baixas)', 80, '12.99', '14.99');

-- --------------------------------------------------------

--
-- Estrutura da tabela `artigo`
--

CREATE TABLE `artigo` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `referencia` text NOT NULL,
  `nome` text NOT NULL,
  `peso` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `artigo`
--

INSERT INTO `artigo` (`id`, `cliente_id`, `referencia`, `nome`, `peso`) VALUES
(1, 6, 'PRA-123', 'Pratos', '429.75');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL,
  `nif` int(9) NOT NULL,
  `morada` text NOT NULL,
  `localidade` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `nif`, `morada`, `localidade`) VALUES
(5, 'Adriano Horta', 123123123, 'Quinta Nova Lote 3 Ponte Seca', 'Ã“bidos'),
(6, 'João', 123123123, 'Rua Principal', 'Marinha Grande'),
(8, '', 0, '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `documento`
--

CREATE TABLE `documento` (
  `id` int(11) NOT NULL,
  `cliente_id` int(5) NOT NULL,
  `utilizador_id` int(5) NOT NULL,
  `data_emissao` date NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `iva` decimal(7,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `guia`
--

CREATE TABLE `guia` (
  `id` int(11) NOT NULL,
  `cliente_id` int(3) DEFAULT NULL,
  `guia_id` int(3) DEFAULT NULL,
  `tipo_guia_id` int(3) DEFAULT NULL,
  `tipo_palete_id` int(3) DEFAULT NULL,
  `tipo_zona_id` int(3) DEFAULT NULL,
  `armazem_id` int(3) DEFAULT NULL,
  `artigo_id` int(3) DEFAULT NULL,
  `data_prevista` datetime DEFAULT NULL,
  `data_carga` datetime NOT NULL,
  `numero_paletes` int(3) DEFAULT NULL,
  `numero_requisicao` text,
  `morada` text,
  `localidade` text,
  `matricula` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `guia`
--

INSERT INTO `guia` (`id`, `cliente_id`, `guia_id`, `tipo_guia_id`, `tipo_palete_id`, `tipo_zona_id`, `armazem_id`, `artigo_id`, `data_prevista`, `data_carga`, `numero_paletes`, `numero_requisicao`, `morada`, `localidade`, `matricula`) VALUES
(1, 5, 1, 1, 1, 1, 4, 1, '2019-05-03 00:00:00', '0000-00-00 00:00:00', 5, 'REQ-102', 'Òbidos', 'óbidos', '12-ST-76'),
(2, 5, NULL, 1, 2, 2, 3, 1, '2019-05-01 11:45:00', '0000-00-00 00:00:00', 7, 'REQ-042', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `linha`
--

CREATE TABLE `linha` (
  `id` int(11) NOT NULL,
  `documento_id` int(5) NOT NULL,
  `tipo_linha_id` int(5) NOT NULL,
  `guia_id` int(5) NOT NULL,
  `palete_id` int(5) NOT NULL,
  `quantidade` int(4) NOT NULL,
  `valor` decimal(7,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `localizacao`
--

CREATE TABLE `localizacao` (
  `id` int(11) NOT NULL,
  `palete_id` int(11) DEFAULT NULL,
  `zona_id` int(11) NOT NULL,
  `referencia` text NOT NULL,
  `data_entrada` date DEFAULT NULL,
  `data_saida` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `localizacao`
--

INSERT INTO `localizacao` (`id`, `palete_id`, `zona_id`, `referencia`, `data_entrada`, `data_saida`) VALUES
(1, NULL, 1, 'A-1', NULL, NULL),
(2, NULL, 1, 'A-2', NULL, NULL),
(3, NULL, 1, 'A-3', NULL, NULL),
(4, NULL, 1, 'A-4', NULL, NULL),
(5, NULL, 1, 'A-5', NULL, NULL),
(6, NULL, 1, 'A-6', NULL, NULL),
(7, NULL, 1, 'A-7', NULL, NULL),
(8, NULL, 1, 'A-8', NULL, NULL),
(9, NULL, 1, 'A-9', NULL, NULL),
(10, NULL, 1, 'A-10', NULL, NULL),
(11, NULL, 1, 'A-11', NULL, NULL),
(12, NULL, 1, 'A-12', NULL, NULL),
(13, NULL, 1, 'A-13', NULL, NULL),
(14, NULL, 1, 'A-14', NULL, NULL),
(15, NULL, 1, 'A-15', NULL, NULL),
(16, NULL, 1, 'A-16', NULL, NULL),
(17, NULL, 1, 'A-17', NULL, NULL),
(18, NULL, 1, 'A-18', NULL, NULL),
(19, NULL, 1, 'A-19', NULL, NULL),
(20, NULL, 1, 'A-20', NULL, NULL),
(21, NULL, 1, 'A-21', NULL, NULL),
(22, NULL, 1, 'A-22', NULL, NULL),
(23, NULL, 1, 'A-23', NULL, NULL),
(24, NULL, 1, 'A-24', NULL, NULL),
(25, NULL, 1, 'A-25', NULL, NULL),
(26, NULL, 1, 'A-26', NULL, NULL),
(27, NULL, 1, 'A-27', NULL, NULL),
(28, NULL, 1, 'A-28', NULL, NULL),
(29, NULL, 1, 'A-29', NULL, NULL),
(30, NULL, 1, 'A-30', NULL, NULL),
(31, NULL, 1, 'A-31', NULL, NULL),
(32, NULL, 1, 'A-32', NULL, NULL),
(33, NULL, 1, 'A-33', NULL, NULL),
(34, NULL, 1, 'A-34', NULL, NULL),
(35, NULL, 1, 'A-35', NULL, NULL),
(36, NULL, 1, 'A-36', NULL, NULL),
(37, NULL, 1, 'A-37', NULL, NULL),
(38, NULL, 1, 'A-38', NULL, NULL),
(39, NULL, 1, 'A-39', NULL, NULL),
(40, NULL, 1, 'A-40', NULL, NULL),
(41, NULL, 1, 'A-41', NULL, NULL),
(42, NULL, 1, 'A-42', NULL, NULL),
(43, NULL, 1, 'A-43', NULL, NULL),
(44, NULL, 1, 'A-44', NULL, NULL),
(45, NULL, 1, 'A-45', NULL, NULL),
(46, NULL, 1, 'A-46', NULL, NULL),
(47, NULL, 1, 'A-47', NULL, NULL),
(48, NULL, 1, 'A-48', NULL, NULL),
(49, NULL, 1, 'A-49', NULL, NULL),
(50, NULL, 1, 'A-50', NULL, NULL),
(51, NULL, 1, 'A-51', NULL, NULL),
(52, NULL, 1, 'A-52', NULL, NULL),
(53, NULL, 1, 'A-53', NULL, NULL),
(54, NULL, 1, 'A-54', NULL, NULL),
(55, NULL, 1, 'A-55', NULL, NULL),
(56, NULL, 1, 'A-56', NULL, NULL),
(57, NULL, 1, 'A-57', NULL, NULL),
(58, NULL, 1, 'A-58', NULL, NULL),
(59, NULL, 1, 'A-59', NULL, NULL),
(60, NULL, 1, 'A-60', NULL, NULL),
(61, NULL, 1, 'A-61', NULL, NULL),
(62, NULL, 1, 'A-62', NULL, NULL),
(63, NULL, 1, 'A-63', NULL, NULL),
(64, NULL, 1, 'A-64', NULL, NULL),
(65, NULL, 1, 'A-65', NULL, NULL),
(66, NULL, 1, 'A-66', NULL, NULL),
(67, NULL, 1, 'A-67', NULL, NULL),
(68, NULL, 1, 'A-68', NULL, NULL),
(69, NULL, 1, 'A-69', NULL, NULL),
(70, NULL, 1, 'A-70', NULL, NULL),
(71, NULL, 1, 'A-71', NULL, NULL),
(72, NULL, 1, 'A-72', NULL, NULL),
(73, NULL, 1, 'A-73', NULL, NULL),
(74, NULL, 1, 'A-74', NULL, NULL),
(75, NULL, 1, 'A-75', NULL, NULL),
(76, NULL, 1, 'A-76', NULL, NULL),
(77, NULL, 1, 'A-77', NULL, NULL),
(78, NULL, 1, 'A-78', NULL, NULL),
(79, NULL, 1, 'A-79', NULL, NULL),
(80, NULL, 1, 'A-80', NULL, NULL),
(81, NULL, 1, 'A-81', NULL, NULL),
(82, NULL, 1, 'A-82', NULL, NULL),
(83, NULL, 1, 'A-83', NULL, NULL),
(84, NULL, 1, 'A-84', NULL, NULL),
(85, NULL, 1, 'A-85', NULL, NULL),
(86, NULL, 1, 'A-86', NULL, NULL),
(87, NULL, 1, 'A-87', NULL, NULL),
(88, NULL, 1, 'A-88', NULL, NULL),
(89, NULL, 1, 'A-89', NULL, NULL),
(90, NULL, 1, 'A-90', NULL, NULL),
(91, NULL, 1, 'A-91', NULL, NULL),
(92, NULL, 1, 'A-92', NULL, NULL),
(93, NULL, 1, 'A-93', NULL, NULL),
(94, NULL, 1, 'A-94', NULL, NULL),
(95, NULL, 1, 'A-95', NULL, NULL),
(96, NULL, 1, 'A-96', NULL, NULL),
(97, NULL, 1, 'A-97', NULL, NULL),
(98, NULL, 1, 'A-98', NULL, NULL),
(99, NULL, 1, 'A-99', NULL, NULL),
(100, NULL, 1, 'A-100', NULL, NULL),
(101, NULL, 2, 'P-1', NULL, NULL),
(102, NULL, 2, 'P-2', NULL, NULL),
(103, NULL, 2, 'P-3', NULL, NULL),
(104, NULL, 2, 'P-4', NULL, NULL),
(105, NULL, 2, 'P-5', NULL, NULL),
(106, NULL, 2, 'P-6', NULL, NULL),
(107, NULL, 2, 'P-7', NULL, NULL),
(108, NULL, 2, 'P-8', NULL, NULL),
(109, NULL, 2, 'P-9', NULL, NULL),
(110, NULL, 2, 'P-10', NULL, NULL),
(111, NULL, 2, 'P-11', NULL, NULL),
(112, NULL, 2, 'P-12', NULL, NULL),
(113, NULL, 2, 'P-13', NULL, NULL),
(114, NULL, 2, 'P-14', NULL, NULL),
(115, NULL, 2, 'P-15', NULL, NULL),
(116, NULL, 2, 'P-16', NULL, NULL),
(117, NULL, 2, 'P-17', NULL, NULL),
(118, NULL, 2, 'P-18', NULL, NULL),
(119, NULL, 2, 'P-19', NULL, NULL),
(120, NULL, 2, 'P-20', NULL, NULL),
(121, NULL, 2, 'P-21', NULL, NULL),
(122, NULL, 2, 'P-22', NULL, NULL),
(123, NULL, 2, 'P-23', NULL, NULL),
(124, NULL, 2, 'P-24', NULL, NULL),
(125, NULL, 2, 'P-25', NULL, NULL),
(126, NULL, 2, 'P-26', NULL, NULL),
(127, NULL, 2, 'P-27', NULL, NULL),
(128, NULL, 2, 'P-28', NULL, NULL),
(129, NULL, 2, 'P-29', NULL, NULL),
(130, NULL, 2, 'P-30', NULL, NULL),
(131, NULL, 2, 'P-31', NULL, NULL),
(132, NULL, 2, 'P-32', NULL, NULL),
(133, NULL, 2, 'P-33', NULL, NULL),
(134, NULL, 2, 'P-34', NULL, NULL),
(135, NULL, 2, 'P-35', NULL, NULL),
(136, NULL, 2, 'P-36', NULL, NULL),
(137, NULL, 2, 'P-37', NULL, NULL),
(138, NULL, 2, 'P-38', NULL, NULL),
(139, NULL, 2, 'P-39', NULL, NULL),
(140, NULL, 2, 'P-40', NULL, NULL),
(141, NULL, 2, 'P-41', NULL, NULL),
(142, NULL, 2, 'P-42', NULL, NULL),
(143, NULL, 2, 'P-43', NULL, NULL),
(144, NULL, 2, 'P-44', NULL, NULL),
(145, NULL, 2, 'P-45', NULL, NULL),
(146, NULL, 2, 'P-46', NULL, NULL),
(147, NULL, 2, 'P-47', NULL, NULL),
(148, NULL, 2, 'P-48', NULL, NULL),
(149, NULL, 2, 'P-49', NULL, NULL),
(150, NULL, 2, 'P-50', NULL, NULL),
(151, NULL, 2, 'P-51', NULL, NULL),
(152, NULL, 2, 'P-52', NULL, NULL),
(153, NULL, 2, 'P-53', NULL, NULL),
(154, NULL, 2, 'P-54', NULL, NULL),
(155, NULL, 2, 'P-55', NULL, NULL),
(156, NULL, 2, 'P-56', NULL, NULL),
(157, NULL, 2, 'P-57', NULL, NULL),
(158, NULL, 2, 'P-58', NULL, NULL),
(159, NULL, 2, 'P-59', NULL, NULL),
(160, NULL, 2, 'P-60', NULL, NULL),
(161, NULL, 2, 'P-61', NULL, NULL),
(162, NULL, 2, 'P-62', NULL, NULL),
(163, NULL, 2, 'P-63', NULL, NULL),
(164, NULL, 2, 'P-64', NULL, NULL),
(165, NULL, 2, 'P-65', NULL, NULL),
(166, NULL, 2, 'P-66', NULL, NULL),
(167, NULL, 2, 'P-67', NULL, NULL),
(168, NULL, 2, 'P-68', NULL, NULL),
(169, NULL, 2, 'P-69', NULL, NULL),
(170, NULL, 2, 'P-70', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `palete`
--

CREATE TABLE `palete` (
  `id` int(11) NOT NULL,
  `guia_entrada_id` int(3) DEFAULT NULL,
  `guia_saida_id` int(3) DEFAULT NULL,
  `artigo_id` int(3) NOT NULL,
  `tipo_palete_id` int(3) NOT NULL,
  `referencia` text NOT NULL,
  `nome` text NOT NULL,
  `Data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `palete`
--

INSERT INTO `palete` (`id`, `guia_entrada_id`, `guia_saida_id`, `artigo_id`, `tipo_palete_id`, `referencia`, `nome`, `Data`) VALUES
(1, NULL, NULL, 1, 2, 'PAL-1', 'Palete de Pratos', '0000-00-00 00:00:00'),
(2, NULL, NULL, 1, 2, 'PAL-1', 'Palete de Pratos', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`id`, `nome`) VALUES
(1, 'Administrador'),
(2, 'Operador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_guia`
--

CREATE TABLE `tipo_guia` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_guia`
--

INSERT INTO `tipo_guia` (`id`, `nome`) VALUES
(1, 'Entrega'),
(2, 'Transporte');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_linha`
--

CREATE TABLE `tipo_linha` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_palete`
--

CREATE TABLE `tipo_palete` (
  `id` int(3) NOT NULL,
  `nome` text NOT NULL,
  `altura` decimal(5,0) NOT NULL,
  `largura` decimal(5,0) NOT NULL,
  `comprimento` decimal(5,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_palete`
--

INSERT INTO `tipo_palete` (`id`, `nome`, `altura`, `largura`, `comprimento`) VALUES
(1, 'Baixa', '0', '0', '0'),
(2, 'Alta', '0', '0', '0'),
(3, 'Palete Fria', '0', '0', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_zona`
--

CREATE TABLE `tipo_zona` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_zona`
--

INSERT INTO `tipo_zona` (`id`, `nome`) VALUES
(1, 'Baixa'),
(2, 'Alta'),
(3, 'Palete Fria');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
  `id` int(11) NOT NULL,
  `perfil_id` int(4) NOT NULL,
  `armazem_id` int(3) NOT NULL,
  `nome` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`id`, `perfil_id`, `armazem_id`, `nome`, `email`, `password`) VALUES
(1, 2, 3, 'a', 'a@a.com', 'a'),
(2, 1, 3, 'b', 'b@b.com', 'b');

-- --------------------------------------------------------

--
-- Estrutura da tabela `zona`
--

CREATE TABLE `zona` (
  `id` int(11) NOT NULL,
  `armazem_id` int(3) NOT NULL,
  `tipo_zona_id` int(5) NOT NULL,
  `nome` text NOT NULL,
  `preco_zona` int(5) NOT NULL,
  `espaco` int(3) NOT NULL,
  `tipo_palete_id` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `zona`
--

INSERT INTO `zona` (`id`, `armazem_id`, `tipo_zona_id`, `nome`, `preco_zona`, `espaco`, `tipo_palete_id`) VALUES
(1, 4, 1, 'Zona de paletes baixas no Armazem B', 5, 100, 1),
(2, 3, 2, 'Zona de paletes altas no Armazem A', 10, 70, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `armazem`
--
ALTER TABLE `armazem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artigo`
--
ALTER TABLE `artigo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `utilizador_id` (`utilizador_id`);

--
-- Indexes for table `guia`
--
ALTER TABLE `guia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `tipo_guia_id` (`tipo_guia_id`),
  ADD KEY `tipo_palete_id` (`tipo_palete_id`),
  ADD KEY `tipo_zona_id` (`tipo_zona_id`),
  ADD KEY `guia_id` (`guia_id`),
  ADD KEY `armazem_id` (`armazem_id`),
  ADD KEY `guia_ibfk_7` (`artigo_id`);

--
-- Indexes for table `linha`
--
ALTER TABLE `linha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documento_id` (`documento_id`),
  ADD KEY `palete_id` (`palete_id`),
  ADD KEY `guia_id` (`guia_id`),
  ADD KEY `tipo_linha_id` (`tipo_linha_id`);

--
-- Indexes for table `localizacao`
--
ALTER TABLE `localizacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `palete`
--
ALTER TABLE `palete`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artigo_id` (`artigo_id`),
  ADD KEY `tipo_palete_id` (`tipo_palete_id`),
  ADD KEY `guia_entrada_id` (`guia_entrada_id`),
  ADD KEY `guia_saida_id` (`guia_saida_id`);

--
-- Indexes for table `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_guia`
--
ALTER TABLE `tipo_guia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_linha`
--
ALTER TABLE `tipo_linha`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_palete`
--
ALTER TABLE `tipo_palete`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_zona`
--
ALTER TABLE `tipo_zona`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `armazem_id` (`armazem_id`),
  ADD KEY `perfil_id` (`perfil_id`);

--
-- Indexes for table `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `armazem_id` (`armazem_id`),
  ADD KEY `tipo_zona_id` (`tipo_zona_id`),
  ADD KEY `tipo_palete_id` (`tipo_palete_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `armazem`
--
ALTER TABLE `armazem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `artigo`
--
ALTER TABLE `artigo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `documento`
--
ALTER TABLE `documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guia`
--
ALTER TABLE `guia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `linha`
--
ALTER TABLE `linha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `localizacao`
--
ALTER TABLE `localizacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `palete`
--
ALTER TABLE `palete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipo_guia`
--
ALTER TABLE `tipo_guia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipo_linha`
--
ALTER TABLE `tipo_linha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_palete`
--
ALTER TABLE `tipo_palete`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tipo_zona`
--
ALTER TABLE `tipo_zona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zona`
--
ALTER TABLE `zona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `artigo`
--
ALTER TABLE `artigo`
  ADD CONSTRAINT `artigo_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`);

--
-- Limitadores para a tabela `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `documento_ibfk_2` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizador` (`id`);

--
-- Limitadores para a tabela `guia`
--
ALTER TABLE `guia`
  ADD CONSTRAINT `guia_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `guia_ibfk_2` FOREIGN KEY (`tipo_guia_id`) REFERENCES `tipo_guia` (`id`),
  ADD CONSTRAINT `guia_ibfk_3` FOREIGN KEY (`tipo_palete_id`) REFERENCES `tipo_palete` (`id`),
  ADD CONSTRAINT `guia_ibfk_4` FOREIGN KEY (`tipo_zona_id`) REFERENCES `tipo_zona` (`id`),
  ADD CONSTRAINT `guia_ibfk_5` FOREIGN KEY (`guia_id`) REFERENCES `guia` (`id`),
  ADD CONSTRAINT `guia_ibfk_6` FOREIGN KEY (`armazem_id`) REFERENCES `armazem` (`id`),
  ADD CONSTRAINT `guia_ibfk_7` FOREIGN KEY (`artigo_id`) REFERENCES `artigo` (`id`);

--
-- Limitadores para a tabela `linha`
--
ALTER TABLE `linha`
  ADD CONSTRAINT `linha_ibfk_1` FOREIGN KEY (`documento_id`) REFERENCES `documento` (`id`),
  ADD CONSTRAINT `linha_ibfk_2` FOREIGN KEY (`palete_id`) REFERENCES `palete` (`id`),
  ADD CONSTRAINT `linha_ibfk_3` FOREIGN KEY (`guia_id`) REFERENCES `guia` (`id`),
  ADD CONSTRAINT `linha_ibfk_4` FOREIGN KEY (`tipo_linha_id`) REFERENCES `tipo_linha` (`id`);

--
-- Limitadores para a tabela `palete`
--
ALTER TABLE `palete`
  ADD CONSTRAINT `palete_ibfk_1` FOREIGN KEY (`artigo_id`) REFERENCES `artigo` (`id`),
  ADD CONSTRAINT `palete_ibfk_2` FOREIGN KEY (`tipo_palete_id`) REFERENCES `tipo_palete` (`id`),
  ADD CONSTRAINT `palete_ibfk_3` FOREIGN KEY (`guia_entrada_id`) REFERENCES `guia` (`id`),
  ADD CONSTRAINT `palete_ibfk_4` FOREIGN KEY (`guia_saida_id`) REFERENCES `guia` (`guia_id`);

--
-- Limitadores para a tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD CONSTRAINT `utilizador_ibfk_1` FOREIGN KEY (`armazem_id`) REFERENCES `armazem` (`id`),
  ADD CONSTRAINT `utilizador_ibfk_2` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`);

--
-- Limitadores para a tabela `zona`
--
ALTER TABLE `zona`
  ADD CONSTRAINT `zona_ibfk_1` FOREIGN KEY (`armazem_id`) REFERENCES `armazem` (`id`),
  ADD CONSTRAINT `zona_ibfk_2` FOREIGN KEY (`tipo_zona_id`) REFERENCES `tipo_zona` (`id`),
  ADD CONSTRAINT `zona_ibfk_3` FOREIGN KEY (`tipo_palete_id`) REFERENCES `tipo_palete` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
