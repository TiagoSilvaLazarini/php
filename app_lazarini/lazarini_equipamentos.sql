-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 17/10/2022 às 09:47
-- Versão do servidor: 10.1.47-MariaDB
-- Versão do PHP: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lazarini_equipamentos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrador`
--

CREATE TABLE `administrador` (
  `id_administrador` int(4) NOT NULL,
  `nome_admin` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefone_admin` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `email_admin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `administrador`
--


-- --------------------------------------------------------

--
-- Estrutura para tabela `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `comentario` text COLLATE utf8_unicode_ci NOT NULL,
  `data` date NOT NULL,
  `data_futura` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `agenda`
--


-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `id_administrador` int(4) NOT NULL,
  `nome_cliente` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_cliente` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefone_celu` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefone_fixo` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `razao_social` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cnpj` varchar(18) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inscricao_estadual` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rg` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cidade` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cep` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `aniversario` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome_fantasia` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `cliente`
--


-- --------------------------------------------------------

--
-- Estrutura para tabela `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `data_ini` date NOT NULL,
  `limite` int(10) NOT NULL,
  `nome_curso` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `preco_curso` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `curso`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso_cliente`
--

CREATE TABLE `curso_cliente` (
  `id_curso_cliente` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `preco_venda_curso` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `forma_pagamento` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `n_parcela` int(11) NOT NULL,
  `nome_aluno_curso` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email_aluno_curso` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `telefone_aluno_curso` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `curso_cliente`
--



--
-- Estrutura para tabela `curso_custos`
--

CREATE TABLE `curso_custos` (
  `id_curso_custos` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `nome_curso_custo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `custo` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso_parcela`
--

CREATE TABLE `curso_parcela` (
  `id_curso_parcela` int(11) NOT NULL,
  `id_curso_cliente` int(11) NOT NULL,
  `parcela` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pago` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `curso_parcela`
--



-- --------------------------------------------------------

--
-- Estrutura para tabela `produto_n`
--

CREATE TABLE `produto_n` (
  `id_produto` int(11) NOT NULL,
  `nome_produto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `preco_produto` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `categoria` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `produto_n`
--

INSERT INTO `produto_n` (`id_produto`, `nome_produto`, `descricao`, `preco_produto`, `categoria`) VALUES
(1, ' CABO ADAPTADOR ETHERNET ', 'CABO ADAPTADOR ETHERNET', '1.190,00', 'diagnostico'),
(2, '(AMP-100) PDF40', '(AMP-100) PDF40 - Midtronics', '0,01', 'midtronics'),
(3, '0120-9222-99', 'KIT FIXAÇÃO RODAS CITROEN (REQUER A KFU 516B)\r\n', '0,01', 'equipamentos'),
(4, '0120-9311-99', 'KIT PARA DESMONTAGEM DE PNEUS RUN FLAT PARA STC-340PLUS\r\n', '0,01', 'equipamentos'),
(5, '0120-9355-99', 'KIT ANÁLISE DE MOTOR PDL (MALETA / PONTAS DE PROVA / PINÇA AMP. / IGNIÇÃO)', '5.010,00', 'diagnostico'),
(6, '0120-9376-99', 'Kit de rampas laterais móveis para elevador S3000MID ', '0,01', 'procut'),
(7, '0671-0854', 'MALETA NYLON COMPACTA P/ PDL + CABOS', '0,01', 'diagnostico'),
(8, '1-12085A', 'ESTOJO PARA ACESSÓRIOS', '0,01', 'diagnostico'),
(9, '2-06433A1', 'GARRA JACARÉ ISOLADA (PRETA)', '0,01', 'diagnostico'),
(10, '2-06433A4', 'GARRA JACARÉ ISOLADA (AMARELA)', '0,01', 'diagnostico'),
(11, '2-06433A5', 'GARRA JACARÉ ISOLADA (VERDE)', '0,01', 'diagnostico'),
(12, '2-09542A1', 'PONTA DE PROVAS (PRETA)', '0,01', 'diagnostico'),
(13, '2-09542A2', 'PONTA DE PROVAS (VERMELHA)', '0,01', 'diagnostico'),
(14, '2-68466A', 'FONTE DE ALIMENTAÇÃO 2-PINOS PDL', '0,01', 'diagnostico'),
(15, '2RS-3-3 ', 'Bomba de vácuo de 7cfm ', '0,01', 'procut'),
(16, '2RS-4-4 ', 'Bomba de vácuo de 10cfm', '0,01', 'procut'),
(17, '30-791', 'Anel espaçador grande.', '0,01', 'procut'),
(18, '37-034K', 'Ganchos suporte para pinças de freio. ', '0,01', 'procut'),
(19, '37-1900 ', 'Óculos de segurança com logo ProCut', '0,01', 'procut'),
(20, '50-046', 'Flange de extensão. ', '0,01', 'procut'),
(21, '50-049 ', 'Flange de extensão dupla. ', '0,01', 'procut'),
(22, '50-179', 'Jogo de porcas e parafusos p/ adapt. de rodas.', '0,01', 'procut'),
(23, '50-246', 'Anel espaçador pequno p/ cubos de 4 e 5 furos. ', '0,01', 'procut'),
(24, '50-660 ', 'Caixa de ferramentas básicas p/ manut. Procut.', '0,01', 'procut'),
(25, '50-681', 'Adaptador Toyota, adapta-se a maioria das caminhonetes \r\nJaponesas. ', '0,01', 'procut'),
(26, '50-687', 'Adaptador p/ aplicação em cubos de 4 furos.', '0,01', 'procut'),
(27, '50-688', 'Adaptador p/ aplicação em cubos de 5 furos.', '0,01', 'procut'),
(28, '50-693 ', 'Adaptador p/ aplicação em cubos de 5 furos.', '0,01', 'procut'),
(29, '50-694', 'Adaptador para caminhonete de 1/2 ton. como F150. ', '0,01', 'procut'),
(31, '50-703', 'Silenciador amarelo padrão. ', '0,01', 'procut'),
(32, '50-742 ', 'Pontas de corte - caixa com 5 pares.', '0,01', 'procut'),
(33, '50-743 ', 'Pontas de Corte PCBN - Caixa c/1 par. ', '0,01', 'procut'),
(34, '50-744 ', 'Silenciador verde p/ discos grandes.', '0,01', 'procut'),
(35, '50-752 ', 'Capa de proteção com logo ProCut. ', '0,01', 'procut'),
(36, '50-754', 'Silenciador laranja de espessura dupla.', '0,01', 'procut'),
(37, '50-778', 'Pontas de Corte Plus (3 pares por caixa). ', '0,01', 'procut'),
(38, '50-946', 'Adaptador p/ cubo de rodas de 6 furos. Veiculos como \r\nFrontier, Transit, Kyron. ', '0,01', 'procut'),
(39, '6-03022A', 'CABO AMARELO OSCILOSCÓPIO (CANAL 1)', '0,01', 'diagnostico'),
(40, '6-03122A', 'CABO VERDE OSCILOSCÓPIO (CANAL 2)', '0,01', 'diagnostico'),
(41, '70024', 'SAPATA PARA NOVA DUCATO (SSL-3500)\r\n', '0,01', 'equipamentos'),
(42, '7109-1035-97 ', 'Rack 3 bandejas para GRX - Snap-on ', '0,01', 'midtronics'),
(43, '7124-1153-98', 'CONE PARA F250 COM RODA DE LIGA LEVE\r\n', '0,01', 'equipamentos'),
(44, '7124-2013-99', 'Adaptador de roda nacionalizado similar ao 50-946', '0,01', 'procut'),
(45, '7124-2053-99', 'Anel espaçador com pino roscado para uso com o \r\napaptador 7124-2055-99 ou com 50-693 p/ fixação em \r\nrodas do Renault Master 2012 e 2013.\r\n', '0,01', 'procut'),
(46, '7124-2054-99', 'Adaptador de rodas nacional p/ Renault Kwid ', '0,01', 'procut'),
(47, '7124-2055-99', 'Adaptador de roda nacionalizado similar ao 50-693 ', '0,01', 'procut'),
(48, '7124-2056-99', 'Adaptador de roda nacionalizado similar ao 50-688 ', '0,01', 'procut'),
(49, '7124-2057-99', 'Adaptador de roda nacionalizado similar ao 50-687 ', '0,01', 'procut'),
(50, '7124-2058-99', 'Adaptador de roda nacionalizado similar ao 50-681', '0,01', 'procut'),
(51, '7124-2059-99', 'Adaptador de roda nacionalizado similar ao 50-694 ', '0,01', 'procut'),
(52, '7309-1/4\"', 'CABEÇA DE CATRACA 9X12 - 1/4\"', '0,01', 'ferramentas'),
(54, '74W9-15', 'TORQUÍMETRO 3 - 15 NM', '0,01', 'ferramentas'),
(55, 'ACT1300B', 'Ferramenta para desmontagem de embreagem de compressores', '0,01', 'procut'),
(56, 'ACT53134A', 'Ferramenta manual para injeção de óleo ', '0,01', 'procut'),
(57, 'ACT73A', 'Termometro analogico de vareta para difusor de ar', '0,01', 'procut'),
(58, 'AEK120-E ', 'Termometro digital de vareta para difusor de ar', '0,01', 'procut'),
(59, 'AEK145', 'Kit de detecção de vazamento de fluido R134a ', '0,01', 'procut'),
(60, 'AEK203', 'Kit para detecção de vazamento de fluido R134a ', '0,01', 'procut'),
(61, 'AEK203-C', 'Contraste p/ detecção de vazamento de fluido R134a', '0,01', 'procut'),
(62, 'AEK207-A', 'Ferramenta para injeção de óleo', '0,01', 'procut'),
(63, 'AEK304 ', 'Kit manual para detecção de vazamento R134a ', '0,01', 'procut'),
(64, 'AEK305', 'Garrafa de Nitrogénio ', '0,01', 'procut'),
(65, 'AEK317 ', 'Ferramenta para remoção da válvula da porta de serviço \r\nde sistemas R134a', '0,01', 'procut'),
(66, 'ATUALIZACAO', 'ATUALIZAÇÃO PDL', '1.420,00', 'diagnostico'),
(67, 'BK6500', 'BOROSCÓPIO AUTOMOTIVO BK6500', '7.820,00', 'diagnostico'),
(68, 'BK8000-55', 'SONDA DE 36\" COM DUAS CÂMERAS (CABEADA DE 5,5 mm)', '0,01', 'diagnostico'),
(69, 'BK8000-UV', 'SONDA ULTRA VIOLETA PARA BK6500 (36\")', '0,01', 'diagnostico'),
(70, 'BREEZE IV', 'EQUIPAMENTO P/ SERVIÇO EM SISTEMAS DE AR CONDICIONADO (R134A)\r\n', '0,01', 'equipamentos'),
(71, 'BREEZE IV - HFO', 'EQUIPAMENTO P/ SERVIÇO EM SISTEMAS DE AR CONDICIONADO (R1234YF)\r\n', '0,01', 'equipamentos'),
(72, 'EAA0355L20C', 'ADAPTADOR FORD-1B (7 pinos)', '250,00', 'diagnostico'),
(73, 'EAA0355L30A', 'ADAPTADOR CHRYSLER-1', '110,00', 'diagnostico'),
(74, 'EAA0355L31A', 'ADAPTADOR CHRYSLER-2', '110,00', 'diagnostico'),
(75, 'EAA0355L49A', 'ADAPTADOR JEEP-1', '150,00', 'diagnostico'),
(76, 'EAA0355L50A', 'ADAPTADOR TOYOTA', '0,01', 'diagnostico'),
(77, 'EAA0355L52A', 'ADAPTADOR TOYOTA-2 (17 pinos)', '260,00', 'diagnostico'),
(78, 'EAA0355L56A', 'ADAPTADOR VW-1 (2 pinos)', '230,00', 'diagnostico'),
(79, 'EAA0355L58A', 'ADAPTADOR NISSAN-2', '0,01', 'diagnostico'),
(80, 'EAA0355L62A', 'ADAPTADOR MB-1 - MERCEDES-BENZ', '0,01', 'diagnostico'),
(81, 'EAA0355L66A', 'ADAPTADOR GM-1 (10 pinos)', '170,00', 'diagnostico'),
(82, 'EAA0355L67A', 'ADAPTADOR FORD-3 (3 pinos)', '120,00', 'diagnostico'),
(83, 'EAA0355L71A', 'ADAPTADOR LRV - LAND ROVER', '0,01', 'diagnostico'),
(84, 'EAA0355L73A1', 'ADAPTADOR DL-14 - SPRINTER', '0,01', 'diagnostico'),
(85, 'EAA0355L74A', 'ADAPTADOR BM-1B - BMW', '0,01', 'diagnostico'),
(86, 'EAA0355L75A', 'ADAPTADOR Mercedes-Benz MB-2A', '150,00', 'diagnostico'),
(87, 'EAA0355L77A', 'ADAPTADOR HONDA 3 PINOS', '0,01', 'diagnostico'),
(88, 'EAA0355L81A', 'ADAPTOR AFL-1 - FIAT', '0,01', 'diagnostico'),
(89, 'EAA0355L92A', 'ADAPTADOR KIA-2', '0,01', 'diagnostico'),
(90, 'EAA0355L93A', 'ADAPTADOR UNIVERSAL (DA-5)', '0,01', 'diagnostico'),
(91, 'EAA0374L20AG', 'ADAPTADOR GM DAE-2 (12 pinos)', '80,00', 'diagnostico'),
(92, 'EAC0056L00A', 'ADAPTADOR IGNIÇÃO UNIVERSAL INDIVIDUAL (Necessário EAK0294B09A)', '0,01', 'diagnostico'),
(93, 'EAC0069B26A', 'ADAPTADOR DB26 PARA CONEXÃO DE FONTE 2.5mm', '0,01', 'diagnostico'),
(94, 'EAC0111L76A3', 'PELÍCULA PROTETORA PARA TELA PDL 4100 / 5500 / 5600 (3 UNIDADES)', '0,01', 'diagnostico'),
(95, 'EAC0111L82A', 'MALETA PLÁSTICA', '0,01', 'diagnostico'),
(96, 'EAK0294B09A', 'KIT DE TESTE DE IGNIÇÃO', '0,01', 'diagnostico'),
(97, 'EAK0307B31A', 'KIT ADAPTADOR 1 (GM, Toyota, Honda, Kia, Nissan e cabo de alimentação)', '790,00', 'diagnostico'),
(98, 'EAK0307B32A', 'KIT ADAPTADOR 2 (Mercedes, Sprinter, BMW e Land Rover)', '1.200,00', 'diagnostico'),
(99, 'EAK0307B33A', 'KIT ADAPTADOR 3 (Sprinter)', '990,00', 'diagnostico'),
(100, 'EAP0234E20A', 'CHAVE S40 PARA ADAPTADOR MB-1 / DL-14', '0,01', 'diagnostico'),
(101, 'EAP0268L35A', 'CHAVE S51 PARA ADAPTADOR MB-1', '0,01', 'diagnostico'),
(102, 'EAP0268L70A', 'CHAVE S64 PARA ADAPTADOR MB-1', '0,01', 'diagnostico'),
(103, 'EAP0293L00A', 'CHAVE S74 PARA ADAPTADOR MB-1', '0,01', 'diagnostico'),
(104, 'EAX0024B30A', 'EXTENÇÃO PARA TRANSDUTORES DE PRESSÃO', '0,01', 'diagnostico'),
(105, 'EAX0066L04B', 'EAX0066L04B', '0,01', 'diagnostico'),
(106, 'EAX0066L05B', 'CABO USB', '0,01', 'diagnostico'),
(107, 'EAX0066L10B', ' CABO DE ALIMENTACAO C/ PLUG CIGARETTE', '0,01', 'diagnostico'),
(108, 'EAX0068L26A', 'CABO UNIVERSAL OBD-II 2,8m C/ FUSÍVEL INTERNO E LED (DA-4)', '0,01', 'diagnostico'),
(109, 'EAX0072L15A', 'CABO ADAPTADOR IVECO 38 PINOS', '90,00', 'diagnostico'),
(110, 'EAX0072L16A', 'CABO ADAPTADOR IVECO 30 PINOS', '100,00', 'diagnostico'),
(111, 'EAX0072L17A', 'CABO ADAPTADOR ETHERNET', '0,01', 'diagnostico'),
(112, 'ECARB042', 'LANTERNA AUTOMOTIVA HÍBRIDA', '1.010,00', 'diagnostico'),
(113, 'ECK BUS PRO', 'Reciclador aplicável em ónibus e trens que utilizem \r\nsistemas de refrigeração equipados com R134a.', '0,01', 'procut'),
(114, 'ECK FLAG HFO', 'Reciclador para veículos agrícolas e pesados equipados com fluído refrigerante HFO 1234yf', '0,01', 'procut'),
(115, 'ECK FLAG R134', 'Reciclador para veículos agrícolas e pesados equipados com fluído refrigerante R134a. ', '0,01', 'procut'),
(116, 'ECK LAND HFO', 'Reciclador móvel para veículos agrícolas e pesados \r\nequipados com fluído refrigerante HFO1234YF ', '0,01', 'procut'),
(117, 'ECK LAND R134', 'Reciclador móvel para veículos agrícolas e pesados \r\nequipados com fluído refrigerante R134a. ', '0,01', 'procut'),
(118, 'ECK NEXT HFO', 'Reciclador para veículos agrícolas e pesados equipados com fluído refrigerante HFO 1234yf', '0,01', 'procut'),
(119, 'ECK NEXT R134', 'Reciclador para veículos agrícolas e pesados equipados com fluído refrigerante R134a. ', '0,01', 'procut'),
(120, 'ECK TWIN 12', 'Reciclador contendo duas unidades recicladoras \r\nautonomas sendo uma para sistemas R134a e outra para \r\nsistemas HFO1234yf. Pode operar em dois veículos ao \r\nmesmo tempo.', '0,01', 'procut'),
(121, 'EEBC100A ', 'EEBC100A - Blue Point (apenas 110V) ', '0,01', 'midtronics'),
(122, 'EEBC500B-BR', 'EEBC500B-BR - Snap-on ', '0,01', 'midtronics'),
(123, 'EECS150', 'EECS150 - Snap-on', '0,01', 'midtronics'),
(124, 'EECS350', 'EECS350 - Snap-on', '0,01', 'midtronics'),
(125, 'EECS5MEM', ' Cabo mantenedor memória para uso com EEJP600 - \r\nTomada 12V', '0,01', 'midtronics'),
(126, 'EECS750', 'EECS750 - Snap-on', '0,01', 'midtronics'),
(127, 'EECT900', 'TESTADOR MULTIFUNCIONAL MULT-PROBE ULTRA', '5.600,00', ''),
(128, 'EEDM5030', 'TRANSDUTOR PRESSÃO (-14 - 500 psi) / (-1 - 34 bar)', '0,01', 'diagnostico'),
(129, 'EEDM503D', 'EEDM503D - Snap-on ', '0,01', 'midtronics'),
(130, 'EEDM504D', 'EEDM504D - Snap-on', '0,01', 'midtronics'),
(131, 'EEDM506D', 'ADAPTADOR PARA MEDIÇÃO TEMPERATURA', '0,01', 'diagnostico'),
(132, 'EEDM596FK', 'EEDM596FK - Snap-on', '0,01', 'midtronics'),
(133, 'EEJP200M-4', 'Cabo Mantenedor memória para uso com \r\nEEJP201MBK', '0,01', 'midtronics'),
(134, 'EEJP201MBK', 'EEJP201MBK - Snap-on', '0,01', 'midtronics'),
(135, 'EEJP600-E', 'EEJP600-E - Snap-on', '0,01', 'midtronics'),
(136, 'EEMS324PSA', 'ADAPTADOR PARA TRANSDUTORES DE PRESSÃO', '0,01', 'diagnostico'),
(137, 'EEPV302AH', 'TRANSDUTOR PRESSÃO (0 - 5000 psi) / (0 - 345 bar) (Necessário EEMS324PSA)', '0,01', 'diagnostico'),
(138, 'EEPV302AL', 'TRANSDUTOR PRESSÃO (0 - 100 psi) / (0 - 7 bar) (Necessário EEMS324PSA)', '0,01', 'diagnostico'),
(139, 'EEPV302AT', 'TRANSDUTOR PRESSÃO (0 - 500 psi) / (0 - 34 bar) (Necessário EEMS324PSA)', '0,01', 'diagnostico'),
(140, 'EESX306A', 'PLACA DE DEMONSTRAÇÃO E TREINAMENTO OSCILOSCÓPIO 3 SINAIS', '0,01', 'diagnostico'),
(141, 'EESX306SP', 'PLACA DE DEMONSTRAÇÃO E TREINAMENTO OSCILOSCÓPIO 5 SINAIS', '0,01', 'diagnostico'),
(142, 'EETA113D', 'INTERFACE PASS THRU PRO IV J2534', '12.050,00', 'diagnostico'),
(143, 'EETA308D', 'PINÇA AMPERIMÉTRICA 60A', '2.760,00', 'diagnostico'),
(144, 'EETA309A15', 'TESTE DE IGNIÇÃO ATÉ 8 CILINDROS', '0,01', 'diagnostico'),
(145, 'EETA502C', 'PINÇA AMPERIMÉTRICA 2.000A', '0,01', 'diagnostico'),
(146, 'EETH111', 'TERMOVISOR LASER', '5.500,00', 'diagnostico'),
(147, 'EETHHBR310', 'TERMOVISOR AUTOMOTIVO ELITE', '6.200,00', 'diagnostico'),
(148, 'EETM306A05', 'ADAPTADOR DE IGNIÇÃO Toyota (CIC-2) (Necessário EAK0294B09A)', '0,01', 'diagnostico'),
(149, 'EETM306A07', 'ADAPTADOR DE IGNIÇÃO Volkswagen/Audi (COP-3) (Necessário EAK0294B09A)', '0,01', 'diagnostico'),
(150, 'EETM306A09', 'ADAPTADOR DE IGNIÇÃO Volvo/BMW (COP-5) (Necessário EAK0294B09A)', '0,01', 'diagnostico'),
(151, 'EETM306A11', 'ADAPTADOR DE IGNIÇÃO Mercedes-Benz (COP-7) (Necessário EAK0294B09A)', '0,01', 'diagnostico'),
(152, 'EETM306A12', 'ADAPTADOR DE IGNIÇÃO BMW (COP-8) (Necessário EAK0294B09A)', '0,01', 'diagnostico'),
(153, 'EETM306A14', 'ADAPTADOR DE IGNIÇÃO Chrysler/Jeep/Toyota (COP-11) (Necessário EAK0294B09A)', '0,01', 'diagnostico'),
(154, 'EQ-7880 - Homologado Rede', 'RAMPA PANTOGRÁFICA HIDRÁULICA ATÉ 4 TONS. COMPLETA - HOMOLOGADA PARA VOLKSWAGEN\r\n', '0,01', 'equipamentos'),
(155, 'EQ-7881- Homologado Rede ', 'RAMPA PNEUMÁTICA PARA 3.500 KGS COMPLETA HOMOLOGADA PARA VOLKSWAGEN\r\n', '0,01', 'equipamentos'),
(156, 'EQ7894/2', 'SAPATA APOIO AMAROK V6 (HL4000)\r\n', '0,01', 'equipamentos'),
(157, 'EXP-717HD ', 'EXP-717HD - Mercedes Benz - Midtronics', '0,01', 'midtronics'),
(158, 'EXP-800BR', 'EXP-800BR - Moura - Midtronics', '0,01', 'midtronics'),
(159, 'EXP-803P', 'EXP-803P - TOYOTA - Midtronics', '0,01', 'midtronics'),
(160, 'EXP-853P - Midtronics', 'EXP-853P - Midtronics', '0,01', 'midtronics'),
(161, 'EXP-925', 'EXP-925 - PSA - Midtronics', '0,01', 'midtronics'),
(162, 'GRCAR01.13', 'Estrutura com 4 rodizios para ECK LAND (OPCIONAL) ', '0,01', 'procut'),
(163, 'GRX-3003P', 'GRX-3003P - TOYOTA - Midtronics (Rack n/ incluso)', '0,01', 'midtronics'),
(164, 'GRX-3003P - Midtronics', 'GRX-3003P - Midtronics (Rack n/ incluso) ', '0,01', 'midtronics'),
(165, 'GRX-3003P em GRX-3717', 'Software para transformação: GRX-3003P em GRX-3717 \r\n(Mercedes Benz) - Midtronics ***', '0,01', 'midtronics'),
(166, 'GRX-3023P - Midtronics ', 'GRX-3023P - Midtronics (Rack n/ incluso)', '0,01', 'midtronics'),
(167, 'GRX-3110 HD', 'GRX-3110 HD - Harley Davidson - Midtronics (Rack n/ incluso)', '0,01', 'midtronics'),
(168, 'GRX-3673H', 'GRX-3673H - Hyundai - Midtronics (Rack n/ incluso)', '0,01', 'midtronics'),
(169, 'GRX-3717', 'GRX-3717 - Mercedes Benz - Midtronics (Rack n/ incluso)', '0,01', 'midtronics'),
(170, 'HBS-1A-1 ', 'Máquina para recuperação de fluído refrigerante ', '0,01', 'procut'),
(171, 'HBS-30-1', 'Tanque de armazenagem p/ fluidos refrigerantes com \r\ncapacidade de 13.6kg ', '0,01', 'procut'),
(172, 'KFU-516B', 'KIT DE FLANGE UNIVERSAL\r\n', '0,01', 'equipamentos'),
(173, 'KIT Flushing', 'KIT FLUSHING\r\n', '0,01', 'equipamentos'),
(174, 'KIT GAS ID', 'KIT ANALISE DE GASES HFO\r\n', '0,01', 'equipamentos'),
(175, 'KIT HYBRID', 'KIT HYBRIDO PARA BREZZE IV\r\n', '0,01', 'equipamentos'),
(176, 'KIT HYBRID.', 'Kit de conversão Hibrido para ECK NEXT', '0,01', 'procut'),
(177, 'KPD-200-1', 'PAR DE PRATOS TRASEIROS LONGO\r\n', '0,01', 'equipamentos'),
(178, 'KRL-3500-2 (NOVO)', 'KIT RODA LIVRE P/LEVANTAMENTO DE VEÍCULOS C/ AJ , CAPACIDADE 2000 KG\r\n', '0,01', 'equipamentos'),
(179, 'KRL-9004', 'KIT RODA LIVRE P/LEVANTAMENTO DE VEÍCULOS C/ CBT-022, CSM-022 E AJ-1800, INCLUINDO CONJ. DE FILTRO LUBRIFICADOR CFL-025\r\n', '0,01', 'equipamentos'),
(180, 'MDX-630P', 'MDX-630P - RENAULT - Midtronics', '0,01', 'midtronics'),
(181, 'MDX-653P', 'MDX-653P - FORD / Outros - Midtronics', '0,01', 'midtronics'),
(182, 'MDX-653P - Midtronics', 'MDX-653P - Midtronics', '0,01', 'midtronics'),
(183, 'MDX-670P', 'MDX-670P - HYUNDAI - Midtronics ', '0,01', 'midtronics'),
(184, 'MT2500S17', 'CHAVE S17 PARA ADAPTADOR MB-1', '0,01', 'diagnostico'),
(185, 'MT2500S20', 'CHAVE S20 PARA ADAPTADOR MB-1 / DL-14', '0,01', 'diagnostico'),
(186, 'MT2500S21', 'CHAVE S21 PARA ADAPTADOR MB-1', '0,01', 'diagnostico'),
(187, 'MT2500S27', 'CHAVE S27 PARA ADAPTADOR MB-1', '0,01', 'diagnostico'),
(188, 'MT2500S33', 'CHAVE S33 PARA ADAPTADOR MB-1', '0,01', 'diagnostico'),
(189, 'MT2500S34', 'CHAVE S34 PARA ADAPTADOR MB-1 / DL-14', '0,01', 'diagnostico'),
(190, 'MT586B1', 'MEDIDOR DE TEMPERATURA (Usado com EEDM506D)', '0,01', 'diagnostico'),
(191, 'MTTL7005PK', 'PONTAS DE PROVA (5 UNIDADES)', '370,00', 'diagnostico'),
(192, 'MTTL800', 'KIT DE PONTAS DE PROVA (16 ITENS)', '1.510,00', 'diagnostico'),
(193, 'PDL 3100', 'SCANNER PDL 3100', '0,01', 'diagnostico'),
(194, 'PDL 3200 PLUS', 'SCANNER PDL 3200 PLUS', '9.750,00', 'diagnostico'),
(195, 'PDL 4100', 'SCANNER PDL 4100', '14.900,00', 'diagnostico'),
(196, 'PDL 5600', 'SCANNER PDL 5600', '17.900,00', 'diagnostico'),
(197, 'PRO3', 'PRO3 - Midtronics', '0,01', 'midtronics'),
(198, 'Procut PFM 9.2', 'Torno computadorizado para discos de freio', '0,01', 'procut'),
(199, 'QPG-016T', 'PAR DE QUADROS P/PRATOS DIANTEIROS\r\n', '0,01', 'equipamentos'),
(200, 'QTECH', 'EQUIPAMENTO P/ SERVIÇO EM SISTEMAS DE AR CONDICIONADO (R134A)\r\n', '0,01', 'equipamentos'),
(201, 'QTECH - HFO', 'EQUIPAMENTO P/ SERVIÇO EM SISTEMAS DE AR CONDICIONADO (R1234YF)\r\n', '0,01', 'equipamentos'),
(202, 'RLD-1 ', 'Detector Eletrônico para fluido refrigerante R134a', '0,01', 'procut'),
(203, 'S3000 - MID', 'Elevador móvel de meia altura para veículos de até \r\n3 toneladas. ', '0,01', 'procut'),
(204, 'SAR-3500 PLUS', 'RAMPA PNEUMÁTICA ALONGADA P/ 3.500 KGS COM ESCADA BANQUETA, PRATO TRASEIRO LONGO C/KIT RODA LIVRE\r\n', '0,01', 'equipamentos'),
(205, 'SAR-3500A-1', 'RAMPA PNEUMÁTICA P/ 3.500 KGS COM ESCADA BANQUETA, PRATO TRASEIRO LONGO C/KIT RODA LIVRE\r\n', '0,01', 'equipamentos'),
(206, 'SAR-9004A', 'RAMPA PANTOGRÁFICA HIDRÁULICA ATÉ 4 TONS. COMPLETA COM KIT RODA LIVRE\r\n', '0,01', 'equipamentos'),
(207, 'SHA-700', 'ALINHADOR DE FARÓIS P/AUTOS, ÓNIBUS E CAMINHÕES E RODIZIOS PARA FÁCIL ALINHAMENTO\r\n', '0,01', 'equipamentos'),
(208, 'SHA-900', 'ALINHADOR DE FAROIS\r\n', '0,01', 'equipamentos'),
(210, 'SSL 3100', 'ELEVADOR PANTOGRÁFICO 3100 KG\r\n', '0,01', 'equipamentos'),
(211, 'SSL-3500', 'ELEVADOR HIDRÁULICO COM CAPACIDADE DE ELEVAÇÃO PARA 3.500 KGS\r\n', '0,01', 'equipamentos'),
(212, 'SSL-3500P', 'ELEVADOR HIDRÁULICO COM CAPACIDADE DE ELEVAÇÃO PARA 3.500KGS - PÓRTICO\r\n', '0,01', 'equipamentos'),
(213, 'STC-210K', 'DESMONTADORA E MONTADORA DE PNEUS SEMIAUTOMATICO C/4 GARRAS, PARA AROS DE 10\" A 21\"\r\n', '0,01', 'equipamentos'),
(214, 'STC-340 PLUS', 'DESMONTADORA/MONTADORA DE PNEUS COM AROS DE 10\" A 24\", PARA VEÍCULOS LEVES E CAMIONETAS', '0,01', 'equipamentos'),
(215, 'STC-5345', 'DESMONTADORA/MONTADORA DE PNEUS PARA AROS 12\" A 24\"\r\n', '0,01', 'equipamentos'),
(216, 'STC-7700', 'DESMONTADORA DE PNEUS\r\n', '0,01', 'equipamentos'),
(217, 'SUNB231', 'CHAVE DE IMPACTO SUN\r\n', '0,01', 'equipamentos'),
(218, 'SVB 13101 - Homologado VW', 'DESMONTADORA E MONTADORA DE PNEUS SEMI AUTOMATICO C/4 GARRAS, PATIM DE ALMA PLASTICA HOMOLOGADO VOLKSWAGEN\r\n', '0,01', 'equipamentos'),
(219, 'SVB 13102 - VW', 'BALANCEADOR COMPUTADORIZADO DE RODAS DE COLUNA MOTORIZADO COM CAPA PROTETORA\r\n', '0,01', 'equipamentos'),
(220, 'SVB 13103 - VW', 'DESMONTADORA/MONTADORA DE PNEUS COM AROS DE 10\" A 24\", PARA VEÍCULOS LEVES E CAMIONETAS.\r\n', '0,01', 'equipamentos'),
(221, 'SVB 13104 - VW', 'BALANCEADOR COMPUTADORIZADO DE RODAS C/CAPA PROTETORA,CONES PARA CENTRALIZAÇÃO DE RODAS COM FURO CENTRAL E COM PORCA RÁPIDA.\r\n', '0,01', 'equipamentos'),
(222, 'SVB-14201', 'SVB-14201 - VW (FEM-000-064) - Midtronics (Rack n/ incluso)', '0,01', 'midtronics'),
(223, 'SWA 2100 - R ou S', 'ALINHADOR COMPUTADORIZADO DE RODAS COM IMAGEM TRIDIMENSIONAL PARA USO EM RAMPA SAR 3500 OU SAR 9004\r\n', '0,01', 'equipamentos'),
(224, 'SWA 2100 - V', 'ALINHADOR COMPUTADORIZADO DE RODAS COM IMAGEM TRIDIMENSIONAL PARA USO EM VALA\r\n', '0,01', 'equipamentos'),
(225, 'SWA 2200EL - R ou S', 'ALINHADOR COMPUTADORIZADO DE RODAS COM IMAGEM TRIDIMENSIONAL PARA USO EM RAMPA SAR 3500 OU SAR 9004\r\n', '0,01', 'equipamentos'),
(226, 'SWA 2200EL - V', 'ALINHADOR COMPUTADORIZADO DE RODAS COM IMAGEM TRIDIMENSIONAL PARA USO EM VALA\r\n', '0,01', 'equipamentos'),
(227, 'SWA 2300 - R ou S', 'ALINHADOR COMPUTADORIZADO DE RODAS COM IMAGEM TRIDIMENSIONAL PARA USO EM RAMPA SAR 3500 OU SAR 9004\r\n', '0,01', 'equipamentos'),
(228, 'SWA 2300 - V', 'ALINHADOR COMPUTADORIZADO DE RODAS COM IMAGEM TRIDIMENSIONAL PARA USO EM RAMPA VALA\r\n', '0,01', 'equipamentos'),
(229, 'SWA 3300', 'ALINHADOR COMPUTADORIZADO DE RODAS COM IMAGEM TRIDIMENSIONAL\r\n', '0,01', 'equipamentos'),
(230, 'SWB 100', 'BALANCEADOR COMPUTADORIZADO DE RODAS C/CAPA PROTETORA,CONES PARA CENTRALIZAÇÃO DE RODAS COM FURO CENTRAL E COM PORCA RÁPIDA.\r\n', '0,01', 'equipamentos'),
(231, 'SWB 200', 'BALANCEADOR COMPUTADORIZADO DE RODAS C/CAPA PROTETORA, CONES PARA CENTRALIZAÇÃO DE RODAS\r\n', '0,01', 'equipamentos'),
(232, 'SWB 400', 'BALANCEADOR COMPUTADORIZADO DE RODAS C/CAPA PROTETORA, CONES PARA CENTRALIZAÇÃO DE RODAS\r\n', '0,01', 'equipamentos'),
(233, 'SWB 50', 'BALANCEADOR COMPUTADORIZADO DE RODAS DE COLUNA MOTORIZADO COM CAPA PROTETORA\r\n', '0,01', 'equipamentos'),
(234, 'SWB-2000', 'BALANCEADOR COMPUTADORIZADO DE RODAS C/CAPA PROTETORA, CONES PARA CENTRALIZAÇÃO DE RODAS, IMPRESSORA\r\n', '0,01', 'equipamentos'),
(235, 'SWB-600', 'BALANCEADOR COMPUTADORIZADO DE RODAS C/ CAPA PROTETORA, CONES PARA CENTRALIZAÇÃO DE\r\nRODAS', '0,01', 'equipamentos'),
(236, 'TEMP10 ', 'Termômetro digital de vareta', '0,01', 'procut'),
(237, 'TPMX', 'PROGRAMADOR DE SENSORES DE PRESSÃO DE PNEUS', '6.100,00', 'diagnostico'),
(238, 'VAS 6331 - R', 'ALINHADOR COMPUTADORIZADO DE RODAS COM IMAGEM TRIDIMENSIONAL - HOMOLOGADO VW PARA USO EM RAMPAS\r\n', '0,01', 'equipamentos'),
(239, 'VAS-6161 ', 'VAS-6161 - VW (FEM-000-007) - Midtronics', '0,01', 'midtronics'),
(243, 'BH1A2500', 'MACACO TIPO JACARE DE ALUMINIO 2.5 TONS MARCA BAHCO', '0,00', 'ferramentas'),
(244, '2503TAA', 'TORQUÍMETRO TORQUE ÂNGULO', '0,00', 'ferramentas'),
(245, 'L21', 'LANTERNA IRIMO - L21', '0,00', 'ferramentas'),
(246, 'PDL 3200', 'SCANNER PDL 3200', '0,01', 'diagnostico'),
(247, 'BK 3000', 'BOROSCÓPIO AUTOMOTIVO BK 3000', '0,01', 'diagnostico'),
(248, '459-6-B', 'JOGO DE CHAVES DE FENDA E PHILLIPS COM 6 PEÇAS - IRIMO', '0,01', 'ferramentas'),
(249, '109-35-4', 'JOGO DE SOQUETES E ACESSORIOS ENCAIXE DE 1/4 POL. 35 PEÇAS - IRIMO', '0,01', 'ferramentas'),
(250, '1002TAA', 'TORQUIMETRO DIGITAL - TORQUE ÂNGULO COM CATRACA 13/8\"', '0,00', 'ferramentas'),
(251, '180-05X-1', 'CHAVE SOQUETE 1/2 HEXAGONAL LONGO 5 100MM', '0,00', 'ferramentas'),
(252, '180-06X-1', 'CHAVE SOQUETE 1/2 HEXAGONAL LONGO 6 100MM', '0,00', 'ferramentas'),
(253, '180-07X-1', 'CHAVE SOQUETE 1/2 HEXAGONAL LONGO 7 100MM', '0,00', 'ferramentas'),
(254, '180-08X-1', 'CHAVE SOQUETE 1/2 HEXAGONAL LONGO 8 100MM', '0,00', 'ferramentas'),
(255, '180-10X-1', 'CHAVE SOQUETE 1/2 HEXAGONAL LONGO 10 100MM', '0,00', 'ferramentas'),
(256, '180-12X-1', 'CHAVE SOQUETE 1/2 HEXAGONAL LONGO 12 100MM', '0,00', 'ferramentas'),
(257, '183-40X-1', 'CHAVE SOQUETE 1/2 TORX LONGO T40 120MM', '0,00', 'ferramentas'),
(258, '183-45X-1', 'CHAVE SOQUETE 1/2 TORX LONGO T45 120MM', '0,00', 'ferramentas'),
(259, '183-50X-1', 'CHAVE SOQUETE 1/2 TORX LONGO T50 120MM', '0,00', 'ferramentas'),
(260, '183-55X-1', 'CHAVE SOQUETE 1/2 TORX LONGO T55 120MM', '0,00', 'ferramentas'),
(261, '5272A', 'MARTELETE PNEUMATICO USA CINZEL REDONDO 0.401\" - PESO 2.600 GRAMAS - 4.000 IPM', '0,00', 'ferramentas'),
(262, 'CTR768K2', 'CHAVE CATRACA C/ BATERIA RECARREGAVEL 3/8 14.4 VOLTS ', '0,01', 'ferramentas'),
(263, 'EAX0072L22A', 'CABO CAN FD', '0,01', 'diagnostico');

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

CREATE TABLE `venda` (
  `id_venda` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `data` date NOT NULL,
  `preco` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `entrega_tecnica` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nota_fiscal` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `venda`
--

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_administrador`);

--
-- Índices de tabela `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_administrador` (`id_administrador`);

--
-- Índices de tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Índices de tabela `curso_cliente`
--
ALTER TABLE `curso_cliente`
  ADD PRIMARY KEY (`id_curso_cliente`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Índices de tabela `curso_custos`
--
ALTER TABLE `curso_custos`
  ADD PRIMARY KEY (`id_curso_custos`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Índices de tabela `curso_parcela`
--
ALTER TABLE `curso_parcela`
  ADD PRIMARY KEY (`id_curso_parcela`),
  ADD KEY `id_curso_cliente` (`id_curso_cliente`);

--
-- Índices de tabela `produto_n`
--
ALTER TABLE `produto_n`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id_venda`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_produto` (`id_produto`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_administrador` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=338;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `curso_cliente`
--
ALTER TABLE `curso_cliente`
  MODIFY `id_curso_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `curso_custos`
--
ALTER TABLE `curso_custos`
  MODIFY `id_curso_custos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `curso_parcela`
--
ALTER TABLE `curso_parcela`
  MODIFY `id_curso_parcela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT de tabela `produto_n`
--
ALTER TABLE `produto_n`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=695;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Restrições para tabelas `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_administrador`) REFERENCES `administrador` (`id_administrador`);

--
-- Restrições para tabelas `curso_cliente`
--
ALTER TABLE `curso_cliente`
  ADD CONSTRAINT `curso_cliente_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `curso_cliente_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Restrições para tabelas `curso_custos`
--
ALTER TABLE `curso_custos`
  ADD CONSTRAINT `curso_custos_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Restrições para tabelas `curso_parcela`
--
ALTER TABLE `curso_parcela`
  ADD CONSTRAINT `curso_parcela_ibfk_1` FOREIGN KEY (`id_curso_cliente`) REFERENCES `curso_cliente` (`id_curso_cliente`);

--
-- Restrições para tabelas `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `venda_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto_n` (`id_produto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
