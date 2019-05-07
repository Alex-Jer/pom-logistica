-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07-Maio-2019 às 13:13
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
(3, 'Armazem A(Altas)', 51, '19.99', '17.99'),
(4, 'Armazem B(Baixas)', 94, '14.99', '12.99'),
(5, 'Armazem C(Fria)', 24, '29.99', '27.49'),
(6, 'Armazem D(Altas e baixas)', 75, '12.99', '14.99'),
(7, 'Armazem de paletes para o Frio', 20, '7.00', '8.00'),
(8, 'Armazem F', 25, '9.00', '7.00');

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
(6, 'João', 123123123, 'Rua Principal', 'Marinha Grande');

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
(2, 5, NULL, 1, 2, 2, 3, 1, '2019-05-01 11:45:00', '0000-00-00 00:00:00', 7, 'REQ-042', NULL, NULL, NULL),
(23, 5, NULL, 1, 3, 3, 5, 1, '2019-05-21 11:45:00', '0000-00-00 00:00:00', 3, 'REQ-025', NULL, NULL, NULL),
(24, 6, NULL, 1, 1, 1, 4, 1, '2019-05-07 14:30:00', '0000-00-00 00:00:00', 10, 'REQ-987', NULL, NULL, NULL),
(25, 5, NULL, 1, 2, 2, 8, 1, '2019-05-11 11:11:00', '0000-00-00 00:00:00', 21, 'REQ-742', NULL, NULL, NULL),
(26, 5, NULL, 1, 1, 1, 6, 1, '2019-05-11 11:45:00', '0000-00-00 00:00:00', 2, 'REQ-554', NULL, NULL, NULL),
(27, 5, NULL, 1, 2, 2, 6, 1, '2019-05-11 11:45:00', '0000-00-00 00:00:00', 4, 'REQ-117', NULL, NULL, NULL),
(28, 5, 26, 3, 1, 1, 6, 1, '2019-05-06 18:25:45', '0000-00-00 00:00:00', 2, 'REQ-554', NULL, NULL, NULL),
(29, 5, NULL, 3, NULL, NULL, NULL, NULL, '2019-02-22 11:11:00', '2019-02-22 11:11:00', NULL, '', 'Obidos', NULL, '10-RT-22');

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
  `zona_id` int(11) DEFAULT NULL,
  `referencia` text NOT NULL,
  `data_entrada` date DEFAULT NULL,
  `data_saida` date DEFAULT NULL,
  `hasPalete` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `localizacao`
--

INSERT INTO `localizacao` (`id`, `palete_id`, `zona_id`, `referencia`, `data_entrada`, `data_saida`, `hasPalete`) VALUES
(1, 29, 1, 'A-1', '2019-11-11', NULL, 1),
(2, 2, 1, 'A-2', NULL, NULL, 1),
(3, 27, 1, 'A-3', '2019-11-11', NULL, 1),
(4, 21, 1, 'A-4', '1111-11-11', NULL, 1),
(5, 24, 2, 'A-5', '2019-11-11', NULL, 1),
(6, 25, 1, 'A-6', '2019-11-11', NULL, 1),
(7, 31, 1, 'A-7', '2019-11-11', NULL, 1),
(8, 3, 1, 'A-8', '2019-11-11', NULL, 1),
(9, 28, 1, 'A-9', '2019-11-11', NULL, 1),
(10, 26, 1, 'A-10', '2019-11-11', NULL, 1),
(11, 32, 1, 'A-11', '2019-02-22', NULL, 1),
(12, 3, 1, 'A-12', '2019-11-11', NULL, 1),
(13, 24, 2, 'A-13', '1111-11-11', NULL, 1),
(14, 3, 1, 'A-14', '2019-11-11', NULL, 1),
(15, 3, 1, 'A-15', '2019-11-11', NULL, 1),
(16, 3, 1, 'A-16', '2019-11-11', NULL, 1),
(17, 3, 1, 'A-17', '2019-11-11', NULL, 1),
(18, 3, 1, 'A-18', '2019-11-11', NULL, 1),
(19, 3, 1, 'A-19', '2019-11-11', NULL, 1),
(20, 41, 1, 'A-20', '2019-11-11', NULL, 1),
(21, 42, 2, 'A-21', '2019-11-11', NULL, 1),
(22, 43, 2, 'A-22', '2019-11-11', NULL, 1),
(23, 44, 2, 'A-23', '2019-11-11', NULL, 1),
(24, 45, 2, 'A-24', '2019-11-11', NULL, 1),
(25, 46, 2, 'A-25', '2019-11-11', NULL, 1),
(26, 47, 2, 'A-26', '2019-11-11', NULL, 1),
(27, 48, 2, 'A-27', '2019-11-11', NULL, 1),
(28, 49, 2, 'A-28', '2019-11-11', NULL, 1),
(29, 50, 2, 'A-29', '2019-11-11', NULL, 1),
(30, 51, 1, 'A-30', '2019-11-11', NULL, 1),
(31, 52, 4, 'A-31', '2019-05-07', NULL, 1),
(32, 53, 1, 'A-32', '2019-05-21', NULL, 1),
(33, 54, 1, 'A-33', '2019-11-11', NULL, 1),
(34, 55, 1, 'A-34', '2019-11-11', NULL, 1),
(35, 56, 1, 'A-35', '2019-05-11', NULL, 1),
(36, 57, 5, 'A-36', '2019-05-11', NULL, 1),
(37, 58, 5, 'A-37', '2019-11-11', NULL, 1),
(38, 59, 5, 'A-38', '2019-11-11', NULL, 1),
(39, 60, 1, 'A-39', '2019-11-11', NULL, 1),
(40, 61, 5, 'A-40', '2019-11-11', NULL, 1),
(41, 62, 6, 'A-41', '2019-05-11', NULL, 1),
(42, NULL, NULL, 'A-42', NULL, NULL, 0),
(43, NULL, NULL, 'A-43', NULL, NULL, 0),
(44, NULL, NULL, 'A-44', NULL, NULL, 0),
(45, NULL, NULL, 'A-45', NULL, NULL, 0),
(46, NULL, NULL, 'A-46', NULL, NULL, 0),
(47, NULL, NULL, 'A-47', NULL, NULL, 0),
(48, NULL, NULL, 'A-48', NULL, NULL, 0),
(49, NULL, NULL, 'A-49', NULL, NULL, 0),
(50, NULL, NULL, 'A-50', NULL, NULL, 0),
(51, NULL, NULL, 'A-51', NULL, NULL, 0),
(52, NULL, NULL, 'A-52', NULL, NULL, 0),
(53, NULL, NULL, 'A-53', NULL, NULL, 0),
(54, NULL, NULL, 'A-54', NULL, NULL, 0),
(55, NULL, NULL, 'A-55', NULL, NULL, 0),
(56, NULL, NULL, 'A-56', NULL, NULL, 0),
(57, NULL, NULL, 'A-57', NULL, NULL, 0),
(58, NULL, NULL, 'A-58', NULL, NULL, 0),
(59, NULL, NULL, 'A-59', NULL, NULL, 0),
(60, NULL, NULL, 'A-60', NULL, NULL, 0),
(61, NULL, NULL, 'A-61', NULL, NULL, 0),
(62, NULL, NULL, 'A-62', NULL, NULL, 0),
(63, NULL, NULL, 'A-63', NULL, NULL, 0),
(64, NULL, NULL, 'A-64', NULL, NULL, 0),
(65, NULL, NULL, 'A-65', NULL, NULL, 0),
(66, NULL, NULL, 'A-66', NULL, NULL, 0),
(67, NULL, NULL, 'A-67', NULL, NULL, 0),
(68, NULL, NULL, 'A-68', NULL, NULL, 0),
(69, NULL, NULL, 'A-69', NULL, NULL, 0),
(70, NULL, NULL, 'A-70', NULL, NULL, 0),
(71, NULL, NULL, 'A-71', NULL, NULL, 0),
(72, NULL, NULL, 'A-72', NULL, NULL, 0),
(73, NULL, NULL, 'A-73', NULL, NULL, 0),
(74, NULL, NULL, 'A-74', NULL, NULL, 0),
(75, NULL, NULL, 'A-75', NULL, NULL, 0),
(76, NULL, NULL, 'A-76', NULL, NULL, 0),
(77, NULL, NULL, 'A-77', NULL, NULL, 0),
(78, NULL, NULL, 'A-78', NULL, NULL, 0),
(79, NULL, NULL, 'A-79', NULL, NULL, 0),
(80, NULL, NULL, 'A-80', NULL, NULL, 0),
(81, NULL, NULL, 'A-81', NULL, NULL, 0),
(82, NULL, NULL, 'A-82', NULL, NULL, 0),
(83, NULL, NULL, 'A-83', NULL, NULL, 0),
(84, NULL, NULL, 'A-84', NULL, NULL, 0),
(85, NULL, NULL, 'A-85', NULL, NULL, 0),
(86, NULL, NULL, 'A-86', NULL, NULL, 0),
(87, NULL, NULL, 'A-87', NULL, NULL, 0),
(88, NULL, NULL, 'A-88', NULL, NULL, 0),
(89, NULL, NULL, 'A-89', NULL, NULL, 0),
(90, NULL, NULL, 'A-90', NULL, NULL, 0),
(91, NULL, NULL, 'A-91', NULL, NULL, 0),
(92, NULL, NULL, 'A-92', NULL, NULL, 0),
(93, NULL, NULL, 'A-93', NULL, NULL, 0),
(94, NULL, NULL, 'A-94', NULL, NULL, 0),
(95, NULL, NULL, 'A-95', NULL, NULL, 0),
(96, NULL, NULL, 'A-96', NULL, NULL, 0),
(97, NULL, NULL, 'A-97', NULL, NULL, 0),
(98, NULL, NULL, 'A-98', NULL, NULL, 0),
(99, NULL, NULL, 'A-99', NULL, NULL, 0),
(100, NULL, NULL, 'A-100', NULL, NULL, 0),
(101, NULL, NULL, 'P-1', NULL, NULL, 0),
(102, NULL, NULL, 'P-2', NULL, NULL, 0),
(103, NULL, NULL, 'P-3', NULL, NULL, 0),
(104, NULL, NULL, 'P-4', NULL, NULL, 0),
(105, NULL, NULL, 'P-5', NULL, NULL, 0),
(106, NULL, NULL, 'P-6', NULL, NULL, 0),
(107, NULL, NULL, 'P-7', NULL, NULL, 0),
(108, NULL, NULL, 'P-8', NULL, NULL, 0),
(109, NULL, NULL, 'P-9', NULL, NULL, 0),
(110, NULL, NULL, 'P-10', NULL, NULL, 0),
(111, NULL, NULL, 'P-11', NULL, NULL, 0),
(112, NULL, NULL, 'P-12', NULL, NULL, 0),
(113, NULL, NULL, 'P-13', NULL, NULL, 0),
(114, NULL, NULL, 'P-14', NULL, NULL, 0),
(115, NULL, NULL, 'P-15', NULL, NULL, 0),
(116, NULL, NULL, 'P-16', NULL, NULL, 0),
(117, NULL, NULL, 'P-17', NULL, NULL, 0),
(118, NULL, NULL, 'P-18', NULL, NULL, 0),
(119, NULL, NULL, 'P-19', NULL, NULL, 0),
(120, NULL, NULL, 'P-20', NULL, NULL, 0),
(121, NULL, NULL, 'P-21', NULL, NULL, 0),
(122, NULL, NULL, 'P-22', NULL, NULL, 0),
(123, NULL, NULL, 'P-23', NULL, NULL, 0),
(124, NULL, NULL, 'P-24', NULL, NULL, 0),
(125, NULL, NULL, 'P-25', NULL, NULL, 0),
(126, NULL, NULL, 'P-26', NULL, NULL, 0),
(127, NULL, NULL, 'P-27', NULL, NULL, 0),
(128, NULL, NULL, 'P-28', NULL, NULL, 0),
(129, NULL, NULL, 'P-29', NULL, NULL, 0),
(130, NULL, NULL, 'P-30', NULL, NULL, 0),
(131, NULL, NULL, 'P-31', NULL, NULL, 0),
(132, NULL, NULL, 'P-32', NULL, NULL, 0),
(133, NULL, NULL, 'P-33', NULL, NULL, 0),
(134, NULL, NULL, 'P-34', NULL, NULL, 0),
(135, NULL, NULL, 'P-35', NULL, NULL, 0),
(136, NULL, NULL, 'P-36', NULL, NULL, 0),
(137, NULL, NULL, 'P-37', NULL, NULL, 0),
(138, NULL, NULL, 'P-38', NULL, NULL, 0),
(139, NULL, NULL, 'P-39', NULL, NULL, 0),
(140, NULL, NULL, 'P-40', NULL, NULL, 0),
(141, NULL, NULL, 'P-41', NULL, NULL, 0),
(142, NULL, NULL, 'P-42', NULL, NULL, 0),
(143, NULL, NULL, 'P-43', NULL, NULL, 0),
(144, NULL, NULL, 'P-44', NULL, NULL, 0),
(145, NULL, NULL, 'P-45', NULL, NULL, 0),
(146, NULL, NULL, 'P-46', NULL, NULL, 0),
(147, NULL, NULL, 'P-47', NULL, NULL, 0),
(148, NULL, NULL, 'P-48', NULL, NULL, 0),
(149, NULL, NULL, 'P-49', NULL, NULL, 0),
(150, NULL, NULL, 'P-50', NULL, NULL, 0),
(151, NULL, NULL, 'P-51', NULL, NULL, 0),
(152, NULL, NULL, 'P-52', NULL, NULL, 0),
(153, NULL, NULL, 'P-53', NULL, NULL, 0),
(154, NULL, NULL, 'P-54', NULL, NULL, 0),
(155, NULL, NULL, 'P-55', NULL, NULL, 0),
(156, NULL, NULL, 'P-56', NULL, NULL, 0),
(157, NULL, NULL, 'P-57', NULL, NULL, 0),
(158, NULL, NULL, 'P-58', NULL, NULL, 0),
(159, NULL, NULL, 'P-59', NULL, NULL, 0),
(160, NULL, NULL, 'P-60', NULL, NULL, 0),
(161, NULL, NULL, 'P-61', NULL, NULL, 0),
(162, NULL, NULL, 'P-62', NULL, NULL, 0),
(163, NULL, NULL, 'P-63', NULL, NULL, 0),
(164, NULL, NULL, 'P-64', NULL, NULL, 0),
(165, NULL, NULL, 'P-65', NULL, NULL, 0),
(166, NULL, NULL, 'P-66', NULL, NULL, 0),
(167, NULL, NULL, 'P-67', NULL, NULL, 0),
(168, NULL, NULL, 'P-68', NULL, NULL, 0),
(169, NULL, NULL, 'P-69', NULL, NULL, 0),
(170, NULL, NULL, 'P-70', NULL, NULL, 0),
(171, 2, NULL, 'B-71', '0000-00-00', '0000-00-00', NULL);

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
(3, 1, NULL, 1, 1, 'PAL-454', 'Palete de pratos', '0000-00-00 00:00:00'),
(7, 1, NULL, 1, 1, 'PAL-909', 'Palete de pratos', '0000-00-00 00:00:00'),
(8, 1, NULL, 1, 1, 'PAL-910', 'Palete de pratos', '0000-00-00 00:00:00'),
(9, 1, NULL, 1, 1, 'PAL-978', 'Palete de pratos', '0000-00-00 00:00:00'),
(10, 1, NULL, 1, 1, 'PAL-223', 'Palete de ', '0000-00-00 00:00:00'),
(11, 1, NULL, 1, 1, 'PAL-221', 'Palete de ', '0000-00-00 00:00:00'),
(13, 1, NULL, 1, 1, 'PAL-112', 'Palete de pratos', '0000-00-00 00:00:00'),
(14, 1, NULL, 1, 1, 'PAL-112', 'Palete de pratos', '0000-00-00 00:00:00'),
(16, 1, NULL, 1, 1, 'PAL-11', 'Palete de 111', '0000-00-00 00:00:00'),
(17, 1, NULL, 1, 1, 'PAL-115', 'Palete de 111', '0000-00-00 00:00:00'),
(18, 2, NULL, 1, 2, 'PAL-229', 'Palete de pratos', '0000-00-00 00:00:00'),
(19, 1, NULL, 1, 1, 'PAL-11', 'Palete de pratos', '0000-00-00 00:00:00'),
(20, 1, NULL, 1, 1, 'PAL-787', 'Palete de pratos', '0000-00-00 00:00:00'),
(21, 1, NULL, 1, 1, 'PAL-478', 'Palete de pratos', '0000-00-00 00:00:00'),
(24, 2, NULL, 1, 2, 'PAL-987', 'Palete de pratos', '0000-00-00 00:00:00'),
(25, 1, NULL, 1, 1, 'PAL-365', 'Palete de pratos', '0000-00-00 00:00:00'),
(26, 1, NULL, 1, 1, 'PAL-144', 'Palete de pratos', '0000-00-00 00:00:00'),
(27, 1, NULL, 1, 1, 'PAL-423', 'Palete de pratos', '0000-00-00 00:00:00'),
(28, 1, NULL, 1, 1, 'PAL-113', 'Palete de ', '0000-00-00 00:00:00'),
(29, 1, NULL, 1, 1, 'PAL-117', 'Palete de pratos', '0000-00-00 00:00:00'),
(30, 2, NULL, 1, 2, 'PAL-987', 'Palete de pratos', '0000-00-00 00:00:00'),
(31, 1, NULL, 1, 1, 'PAL-777', 'Palete de pratos', '0000-00-00 00:00:00'),
(32, 1, NULL, 1, 1, 'PAL-999', 'Palete de pratos', '0000-00-00 00:00:00'),
(41, 1, NULL, 1, 1, 'PAL-187', 'Palete de pratos', '0000-00-00 00:00:00'),
(42, 2, NULL, 1, 2, 'PAL-655', 'Palete de ', '0000-00-00 00:00:00'),
(43, 2, NULL, 1, 2, 'PAL-658', 'Palete de ', '0000-00-00 00:00:00'),
(44, 2, NULL, 1, 2, 'PAL-644', 'Palete de ', '0000-00-00 00:00:00'),
(45, 2, NULL, 1, 2, 'PAL-471', 'Palete de ', '0000-00-00 00:00:00'),
(46, 2, NULL, 1, 2, 'PAL-299', 'Palete de ', '0000-00-00 00:00:00'),
(47, 2, NULL, 1, 2, 'PAL-300', 'Palete de pratos', '0000-00-00 00:00:00'),
(48, 2, NULL, 1, 2, 'PAL-301', 'Palete de pratos', '0000-00-00 00:00:00'),
(49, 2, NULL, 1, 2, 'PAL-302', 'Palete de pratos', '0000-00-00 00:00:00'),
(50, 2, NULL, 1, 2, 'PAL-303', 'Palete de pratos', '0000-00-00 00:00:00'),
(51, 1, NULL, 1, 1, 'PAL-678', 'Palete de ', '0000-00-00 00:00:00'),
(52, 23, NULL, 1, 3, 'PAL-078', 'Palete de pratos', '0000-00-00 00:00:00'),
(53, 24, NULL, 1, 1, 'PAL-114', 'Palete de pratos', '0000-00-00 00:00:00'),
(54, 24, NULL, 1, 1, 'PAL-079', 'Palete de pratos', '0000-00-00 00:00:00'),
(55, 24, NULL, 1, 1, 'PAL-103', 'Palete de pratos', '0000-00-00 00:00:00'),
(56, 24, NULL, 1, 1, 'PAL-744', 'Palete de pratos', '0000-00-00 00:00:00'),
(57, 26, NULL, 1, 1, 'PAL-001', 'Palete de pratos', '0000-00-00 00:00:00'),
(58, 27, NULL, 1, 2, 'PAL-002', 'Palete de pratos', '0000-00-00 00:00:00'),
(59, 26, NULL, 1, 1, 'PAL-003', 'Palete de pratos', '0000-00-00 00:00:00'),
(60, 1, NULL, 1, 1, 'PAL-005', 'Palete de pratos', '0000-00-00 00:00:00'),
(61, 26, NULL, 1, 1, 'PAL-006', 'Palete de pratos', '0000-00-00 00:00:00'),
(62, 26, NULL, 1, 1, 'PAL-007', 'Palete de pratos', '0000-00-00 00:00:00');

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
(2, 'Transporte'),
(3, 'Operador');

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
(1, 2, 3, 'a', 'a@a.com', 'aa'),
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
(1, 4, 1, 'Zona de paletes baixas no Armazem B', 5, 94, 1),
(2, 3, 2, 'Zona de paletes altas no Armazem A', 10, 51, 2),
(3, 8, 2, 'Zona de paletes altas no armazem 8', 6, 25, 2),
(4, 5, 3, 'Zona de paletes frias no armazem F', 25, 24, 3),
(5, 6, 2, 'Zona de Paletes altas no Armazem D', 10, 31, 2),
(6, 6, 1, 'Zona de Paletes baixas no Armazem D', 8, 44, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `artigo`
--
ALTER TABLE `artigo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `documento`
--
ALTER TABLE `documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guia`
--
ALTER TABLE `guia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `linha`
--
ALTER TABLE `linha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `localizacao`
--
ALTER TABLE `localizacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `palete`
--
ALTER TABLE `palete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipo_guia`
--
ALTER TABLE `tipo_guia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
