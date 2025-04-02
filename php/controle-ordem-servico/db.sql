-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03-Maio-2018 às 04:30
-- Versão do servidor: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sys_unopar_2`
-- [ATENÇÃO]: TODOS OS DADOS DESSA BASE SÃO ILUSTRATIVOS APENAS PARA TESTES
--
CREATE DATABASE IF NOT EXISTS `sys_unopar_2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sys_unopar_2`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividade`
--

CREATE TABLE `atividade` (
  `id_atividade` int(11) NOT NULL,
  `id_especialidade` varchar(4) NOT NULL,
  `nome_atividade` varchar(250) NOT NULL,
  `tempo_estimado_min` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `atividade`
--

INSERT INTO `atividade` (`id_atividade`, `id_especialidade`, `nome_atividade`, `tempo_estimado_min`) VALUES
(1, '1M', 'ALTO CONSUMO DE ÓLEO LUBRIFICANTE', 190),
(2, '1M', 'EXCESSO DE FUMAÇA EXPELIDA PELO ESCAPAMENTO', 340),
(3, '1M', 'BAIXA POTÊNCIA', 380),
(4, '2S', 'RUÍDOS E BATIDAS NAS RODAS', 150),
(5, '2S', 'VIBRAÇÕES E DIREÇÃO PUXANDO', 200),
(6, '2S', 'RUÍDOS E BATIDAS NAS RODAS', 120),
(7, '2S', 'DESGASTE IRREGULAR DOS PNEUS', 250),
(8, '3F', 'VIBRAÇÃO DO CARRO OU PEDAL AO PISAR NO PEDAL DO FREIO', 130),
(9, '3F', 'CARRO PUXANDO AO FREIAR', 170),
(10, '3F', 'CHIADO OU RONCO AO PISAR NO FREIO', 180),
(11, '4E', 'LAMPADAS E FARÓIS QUEIMADOS', 180),
(12, '4E', 'BATERIA', 70),
(13, '4E', 'VIDROS ELÉTRICOS', 160),
(14, '4E', 'TRAVAS ELÉTRICAS', 230),
(15, '4E', 'DIREÇÃO ELÉTRICA', 330),
(16, '4E', 'ALARME', 190),
(17, '5I', 'PERDA DE POTÊNCIA NO MOTOR', 300),
(18, '5I', 'FALHA NA INJEÇÃO ELETRÔNICA', 360),
(19, '5I', 'LIMPEZA BICOS INJETORES', 90),
(20, '5I', 'MAPEAMENTO BICO INJETOR', 150),
(21, '5I', 'MAPEAMENTO CENTRAL ELETRÔNICA', 190);

-- --------------------------------------------------------

--
-- Estrutura da tabela `automovel`
--

CREATE TABLE `automovel` (
  `id_automovel` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `chassi` varchar(250) NOT NULL,
  `modelo` varchar(250) NOT NULL,
  `marca` varchar(250) NOT NULL,
  `cor` varchar(20) DEFAULT NULL,
  `ano` year(4) DEFAULT NULL,
  `local` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `automovel`
--

INSERT INTO `automovel` (`id_automovel`, `id_cliente`, `chassi`, `modelo`, `marca`, `cor`, `ano`, `local`) VALUES
(1, 1, 'AB2257TH832', 'KA', 'FORD', 'branco', 2002, 'OURINHOS - SP'),
(2, 2, '42II49JK667', 'SIENA', 'FIAT', 'preto', 2012, 'SAO CARLOS - SP'),
(3, 6, '36298850010', 'ONIX', 'CHEVROLET', 'vermelho', 2017, 'BAURU SP'),
(4, 5, '32698745110', 'UNO', 'FIAT', 'amarelo', 2016, 'LONDRINA PR'),
(5, 13, '98885200160', 'CRONOS', 'FIAT', 'preto', 2018, 'ASSIS SP'),
(7, 2, '32265900701', 'GOL', 'VOLKSWAGEN', 'preto', 2014, 'PARAGUAÃ‡U PAULISTA - SP'),
(8, 14, '554879622031', 'PRISMA', 'CHEVROLET', 'branco', 2017, 'ASSIS-SP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome_cliente` varchar(250) NOT NULL,
  `cpf_cnpj` bigint(20) NOT NULL,
  `endereco` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `tel1` bigint(20) NOT NULL,
  `tel2` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome_cliente`, `cpf_cnpj`, `endereco`, `email`, `tel1`, `tel2`) VALUES
(1, 'CLARA', 2147483647, 'AVENIDA ABC 122, BAURU - SP', 'CLARA@OUTLOOK.COM', 19999999777, NULL),
(2, 'ELEANDER', 2147483647, 'RUA XYZ 236, PARAGAUÇU PTA - SP', 'EL@GMAIL.COM', 19996661111, NULL),
(5, 'RENATA', 2147483647, 'RUA PALHARES, 28', 'RENATA.SANTOS@HOTMAIL.COM', 1333255554, NULL),
(6, 'LOJAS AMERICANAS', 85412697821, 'AV. RUI BARBOSA, 1500', 'AMERICANAS@YAHOO.COM', 1833225566, 19999994612),
(13, '    MARCOPLAST', 254659812000, '    AVENIDA CENTRAL,401', '    MARCOPLAST@OUTLOOK.COM', 1833336669, 199977777722),
(14, ' BRYAN MORAES', 99654122007, ' RUA 14', ' BRYAN.M@GMAIL.COM', 1833222225, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `desconto`
--

CREATE TABLE `desconto` (
  `id_desconto` int(11) NOT NULL,
  `regra_desconto` varchar(250) NOT NULL,
  `valor_desc` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `desconto`
--

INSERT INTO `desconto` (`id_desconto`, `regra_desconto`, `valor_desc`) VALUES
(1, 'DE R$ 200,00 - 1000,00', 5),
(2, 'ACIMA DE R$ 1000,00', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `especialidade`
--

CREATE TABLE `especialidade` (
  `id_especialidade` varchar(4) NOT NULL,
  `nome_especialidade` varchar(150) NOT NULL,
  `valor_hora` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `especialidade`
--

INSERT INTO `especialidade` (`id_especialidade`, `nome_especialidade`, `valor_hora`) VALUES
('1M', 'MOTOR', '100.00'),
('2S', 'SUSPENSÃO', '200.00'),
('3F', 'FREIO', '300.00'),
('4E', 'ELÉTRICA', '150.00'),
('5I', 'ELETRÔNICA', '350.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE `estoque` (
  `id_estoque` int(11) NOT NULL,
  `id_peca` int(11) NOT NULL,
  `qtdd` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estoque`
--

INSERT INTO `estoque` (`id_estoque`, `id_peca`, `qtdd`) VALUES
(1, 1, 100),
(2, 2, 100),
(3, 3, 50),
(4, 4, 80),
(5, 5, 200),
(6, 6, 20),
(7, 7, 70);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id_funcionario` int(11) NOT NULL,
  `nome_funcionario` varchar(250) NOT NULL,
  `cpf` bigint(20) NOT NULL,
  `endereco` varchar(250) DEFAULT NULL,
  `tel1` bigint(20) NOT NULL,
  `tel2` bigint(20) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `cargo` varchar(250) NOT NULL,
  `salario_fixo` decimal(5,2) NOT NULL,
  `senha` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id_funcionario`, `nome_funcionario`, `cpf`, `endereco`, `tel1`, `tel2`, `email`, `cargo`, `salario_fixo`, `senha`) VALUES
(1, 'ANDRÉ FERREIRA', 39445812306, 'RUA SDF 20, ARAÇATUBA - SP', 1833222222, NULL, 'ANDREFERR@YAHOO.COM.BR', 'MECÂNICO', '600.00', 'root'),
(3, '    LUAN TAVARES', 65519900009, '    AVENIDA PRINCIPAL, 300 BAURU - SP', 1833225555, 18990031111, '    TAVARES.LUAN@HOTMAIL.COM', '    MECANICO', '600.00', 'root'),
(4, ' PAULO FERREIRA', 98566300102, ' AVENIDA PRINCIPAL, 804', 0, 18981544222, ' PAULO.F@YAHOO.COM', ' MECANICO', '600.00', 'root');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista_pedido`
--

CREATE TABLE `lista_pedido` (
  `id_list_ped` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_ordem_servico` int(11) NOT NULL,
  `id_atividade` int(11) NOT NULL,
  `data_abertura` datetime DEFAULT NULL,
  `temp_min` smallint(4) DEFAULT NULL,
  `valor_hora` decimal(5,2) DEFAULT NULL,
  `valor_tot` decimal(5,2) DEFAULT NULL,
  `conclusao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lista_pedido`
--

INSERT INTO `lista_pedido` (`id_list_ped`, `id_status`, `id_ordem_servico`, `id_atividade`, `data_abertura`, `temp_min`, `valor_hora`, `valor_tot`, `conclusao`) VALUES
(95, 1, 55, 1, '2018-04-08 16:08:00', NULL, '100.00', NULL, NULL),
(119, 3, 67, 2, '2018-04-22 17:10:00', 100, '100.00', '166.67', '2018-04-23 15:00:00'),
(155, 3, 75, 14, '2018-04-15 15:59:00', 60, '150.00', '150.00', '2018-04-15 18:00:00'),
(164, 3, 75, 19, '2018-04-15 17:53:00', 200, '350.00', '999.99', '2018-04-16 10:10:00'),
(174, 4, 82, 2, '2018-04-22 17:00:00', 90, '100.00', '150.00', '2018-04-24 10:50:00'),
(175, 3, 82, 1, '2018-04-22 17:23:00', 80, '100.00', '133.33', '2018-04-24 08:40:00'),
(178, 3, 83, 18, '2018-04-22 16:57:00', 30, '350.00', '175.00', '2018-04-23 12:30:00'),
(179, 3, 83, 8, '2018-04-22 16:58:00', 120, '300.00', '600.00', '2018-04-24 09:00:00'),
(180, 3, 84, 18, '2018-04-22 20:59:00', 80, '350.00', '466.67', '2018-04-24 12:00:00'),
(182, 3, 84, 5, '2018-04-22 21:00:00', 60, '200.00', '200.00', '2018-04-25 08:20:00'),
(183, 3, 85, 20, '2018-04-22 21:04:00', 60, '350.00', '350.00', '2018-04-23 10:00:00'),
(184, 3, 85, 19, '2018-04-22 21:06:00', 60, '350.00', '350.00', '2018-04-23 11:30:00'),
(185, 3, 86, 2, '2018-04-22 21:10:00', 60, '100.00', '100.00', '2018-04-23 14:00:00'),
(187, 3, 86, 10, '2018-04-22 21:11:00', 120, '300.00', '600.00', '2018-04-24 08:30:00'),
(188, 1, 55, 14, '2018-04-25 21:14:00', NULL, '150.00', NULL, NULL),
(189, 2, 87, 2, '2018-04-25 21:21:00', 0, '100.00', '0.00', '0000-00-00 00:00:00'),
(190, 4, 87, 6, '2018-04-25 21:20:00', 0, '200.00', '0.00', '0000-00-00 00:00:00'),
(191, 1, 87, 13, '2018-04-25 21:18:00', NULL, '150.00', NULL, NULL),
(192, 3, 87, 16, '2018-04-25 21:19:00', 120, '150.00', '300.00', '2018-04-26 14:00:00'),
(194, 2, 88, 16, '2018-05-02 23:21:00', 60, '150.00', '150.00', '2018-05-03 11:30:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem_servico`
--

CREATE TABLE `ordem_servico` (
  `id_ordem_servico` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_automovel` int(11) NOT NULL,
  `data_abertura` datetime NOT NULL,
  `data_agendamento` datetime NOT NULL,
  `conclusao_os` datetime DEFAULT NULL,
  `valor_tot` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ordem_servico`
--

INSERT INTO `ordem_servico` (`id_ordem_servico`, `id_status`, `id_cliente`, `id_automovel`, `data_abertura`, `data_agendamento`, `conclusao_os`, `valor_tot`) VALUES
(55, 1, 1, 1, '2018-04-08 16:08:00', '2018-04-26 01:00:00', NULL, '0.00'),
(67, 3, 1, 1, '2018-04-08 16:55:00', '2018-04-11 10:00:00', '2018-04-23 15:00:00', '166.67'),
(75, 3, 2, 2, '2018-04-15 17:18:00', '2018-04-15 15:00:00', '2018-04-20 10:10:00', '999.99'),
(82, 3, 2, 7, '2018-04-22 16:08:00', '2018-04-23 14:00:00', '2018-04-24 08:40:00', '133.33'),
(83, 3, 5, 4, '2018-04-22 16:57:00', '2018-04-23 12:00:00', '2018-04-24 09:00:00', '775.00'),
(84, 3, 2, 2, '2018-04-22 20:57:00', '2018-04-24 10:00:00', '2018-04-25 08:20:00', '666.67'),
(85, 3, 13, 5, '2018-04-22 21:02:00', '2018-04-23 09:00:00', '2018-04-23 11:30:00', '700.00'),
(86, 3, 1, 1, '2018-04-22 21:09:00', '2018-04-23 10:00:00', '2018-04-24 08:30:00', '700.00'),
(87, 1, 5, 4, '2018-04-25 21:20:00', '2018-04-26 11:00:00', '0000-00-00 00:00:00', '0.00'),
(88, 1, 14, 8, '2018-05-02 23:19:00', '2018-05-03 10:00:00', '0000-00-00 00:00:00', '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `id_pagamento` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_ordem_servico` int(11) NOT NULL,
  `id_desconto` int(11) NOT NULL,
  `valor_tot` decimal(5,2) NOT NULL,
  `valor_final` decimal(5,2) NOT NULL,
  `parcelamento` tinyint(1) DEFAULT NULL,
  `num_parcelas` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento_status`
--

CREATE TABLE `pagamento_status` (
  `id_pg_status` int(11) NOT NULL,
  `nome_pg_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pagamento_status`
--

INSERT INTO `pagamento_status` (`id_pg_status`, `nome_pg_status`) VALUES
(1, 'AGUARDANDO PAGAMENTO'),
(2, 'PAGO'),
(3, 'VENCIDO'),
(4, 'CANCELADO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `parcela_pg_status`
--

CREATE TABLE `parcela_pg_status` (
  `id_parc_pg_status` int(11) NOT NULL,
  `id_pagamento` int(11) NOT NULL,
  `id_pg_status` int(11) NOT NULL,
  `valor_parcela` decimal(5,2) DEFAULT NULL,
  `pg_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `peca`
--

CREATE TABLE `peca` (
  `id_peca` int(11) NOT NULL,
  `nome_peca` varchar(250) NOT NULL,
  `custo_unit` decimal(5,2) DEFAULT NULL,
  `valor_venda` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `peca`
--

INSERT INTO `peca` (`id_peca`, `nome_peca`, `custo_unit`, `valor_venda`) VALUES
(1, 'BICOS INJETORES', '130.00', '260.00'),
(2, 'BATERIA', '180.00', '300.00'),
(3, 'ALARME', '200.00', '400.00'),
(4, 'FARÓIS', '400.00', '700.00'),
(5, 'PNEUS', '130.00', '200.00'),
(6, 'ÓLEO LUBRIFICANTE', '60.00', '150.00'),
(7, 'ESCAPAMENTO', '120.00', '300.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `peca_pedido`
--

CREATE TABLE `peca_pedido` (
  `id_peca_pedido` int(11) NOT NULL,
  `id_list_ped` int(11) NOT NULL,
  `id_peca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `peca_pedido`
--

INSERT INTO `peca_pedido` (`id_peca_pedido`, `id_list_ped`, `id_peca`) VALUES
(20, 155, 3),
(26, 175, 6),
(27, 174, 7),
(30, 119, 7),
(31, 178, 1),
(32, 179, 6),
(33, 180, 1),
(34, 182, 5),
(35, 183, 6),
(36, 184, 1),
(37, 185, 7),
(38, 187, 5),
(39, 192, 3),
(40, 194, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_funcionario`
--

CREATE TABLE `pedido_funcionario` (
  `id_pedido_func` int(11) NOT NULL,
  `id_list_ped` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedido_funcionario`
--

INSERT INTO `pedido_funcionario` (`id_pedido_func`, `id_list_ped`, `id_funcionario`) VALUES
(31, 119, 1),
(33, 175, 1),
(34, 174, 3),
(37, 178, 1),
(38, 179, 3),
(39, 180, 1),
(40, 180, 3),
(41, 182, 1),
(42, 183, 1),
(43, 184, 4),
(44, 185, 3),
(45, 187, 4),
(46, 192, 3),
(47, 190, 3),
(48, 189, 4),
(49, 194, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `salario_funcionario`
--

CREATE TABLE `salario_funcionario` (
  `id_sal_func` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `mes` varchar(20) NOT NULL,
  `salario_fixo` decimal(5,2) DEFAULT NULL,
  `tot_serv_func` decimal(5,2) DEFAULT NULL,
  `tot_salario` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico_funcionario`
--

CREATE TABLE `servico_funcionario` (
  `id_serv_func` int(11) NOT NULL,
  `id_sal_func` int(11) NOT NULL,
  `id_pedido_func` int(11) NOT NULL,
  `tot_valor` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `nome_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`id_status`, `nome_status`) VALUES
(1, 'AGENDADO'),
(2, 'EM EXECUÇÃO'),
(3, 'CONCLUÍDO'),
(4, 'CANCELADO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atividade`
--
ALTER TABLE `atividade`
  ADD PRIMARY KEY (`id_atividade`),
  ADD KEY `id_especialidade` (`id_especialidade`);

--
-- Indexes for table `automovel`
--
ALTER TABLE `automovel`
  ADD PRIMARY KEY (`id_automovel`),
  ADD KEY `automovel_ibfk_1` (`id_cliente`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `desconto`
--
ALTER TABLE `desconto`
  ADD PRIMARY KEY (`id_desconto`);

--
-- Indexes for table `especialidade`
--
ALTER TABLE `especialidade`
  ADD PRIMARY KEY (`id_especialidade`);

--
-- Indexes for table `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id_estoque`),
  ADD KEY `id_peca` (`id_peca`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id_funcionario`);

--
-- Indexes for table `lista_pedido`
--
ALTER TABLE `lista_pedido`
  ADD PRIMARY KEY (`id_list_ped`),
  ADD KEY `lista_pedido_ibfk_1` (`id_ordem_servico`),
  ADD KEY `lista_pedido_ibfk_3` (`id_atividade`),
  ADD KEY `lista_pedido_ibfk_4` (`id_status`);

--
-- Indexes for table `ordem_servico`
--
ALTER TABLE `ordem_servico`
  ADD PRIMARY KEY (`id_ordem_servico`),
  ADD KEY `ordem_servico_ibfk_1` (`id_cliente`),
  ADD KEY `ordem_servico_ibfk_2` (`id_automovel`),
  ADD KEY `ordem_servico_ibfk_3` (`id_status`);

--
-- Indexes for table `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`id_pagamento`),
  ADD KEY `id_ordem_servico` (`id_ordem_servico`),
  ADD KEY `id_desconto` (`id_desconto`),
  ADD KEY `pagamento_ibfk_3` (`id_cliente`);

--
-- Indexes for table `pagamento_status`
--
ALTER TABLE `pagamento_status`
  ADD PRIMARY KEY (`id_pg_status`);

--
-- Indexes for table `parcela_pg_status`
--
ALTER TABLE `parcela_pg_status`
  ADD PRIMARY KEY (`id_parc_pg_status`),
  ADD KEY `id_pagamento` (`id_pagamento`),
  ADD KEY `id_pg_status` (`id_pg_status`);

--
-- Indexes for table `peca`
--
ALTER TABLE `peca`
  ADD PRIMARY KEY (`id_peca`);

--
-- Indexes for table `peca_pedido`
--
ALTER TABLE `peca_pedido`
  ADD PRIMARY KEY (`id_peca_pedido`),
  ADD KEY `peca_pedido_ibfk_2` (`id_peca`),
  ADD KEY `peca_pedido_ibfk_3` (`id_list_ped`);

--
-- Indexes for table `pedido_funcionario`
--
ALTER TABLE `pedido_funcionario`
  ADD PRIMARY KEY (`id_pedido_func`),
  ADD KEY `pedido_funcionario_ibfk_2` (`id_funcionario`),
  ADD KEY `pedido_funcionario_ibfk_3` (`id_list_ped`);

--
-- Indexes for table `salario_funcionario`
--
ALTER TABLE `salario_funcionario`
  ADD PRIMARY KEY (`id_sal_func`),
  ADD KEY `id_funcionario` (`id_funcionario`);

--
-- Indexes for table `servico_funcionario`
--
ALTER TABLE `servico_funcionario`
  ADD PRIMARY KEY (`id_serv_func`),
  ADD KEY `id_sal_func` (`id_sal_func`),
  ADD KEY `id_pedido_func` (`id_pedido_func`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atividade`
--
ALTER TABLE `atividade`
  MODIFY `id_atividade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `automovel`
--
ALTER TABLE `automovel`
  MODIFY `id_automovel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `desconto`
--
ALTER TABLE `desconto`
  MODIFY `id_desconto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id_estoque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lista_pedido`
--
ALTER TABLE `lista_pedido`
  MODIFY `id_list_ped` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `ordem_servico`
--
ALTER TABLE `ordem_servico`
  MODIFY `id_ordem_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `id_pagamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pagamento_status`
--
ALTER TABLE `pagamento_status`
  MODIFY `id_pg_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `parcela_pg_status`
--
ALTER TABLE `parcela_pg_status`
  MODIFY `id_parc_pg_status` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peca`
--
ALTER TABLE `peca`
  MODIFY `id_peca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `peca_pedido`
--
ALTER TABLE `peca_pedido`
  MODIFY `id_peca_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pedido_funcionario`
--
ALTER TABLE `pedido_funcionario`
  MODIFY `id_pedido_func` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `salario_funcionario`
--
ALTER TABLE `salario_funcionario`
  MODIFY `id_sal_func` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servico_funcionario`
--
ALTER TABLE `servico_funcionario`
  MODIFY `id_serv_func` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `atividade`
--
ALTER TABLE `atividade`
  ADD CONSTRAINT `atividade_ibfk_1` FOREIGN KEY (`id_especialidade`) REFERENCES `especialidade` (`id_especialidade`);

--
-- Limitadores para a tabela `automovel`
--
ALTER TABLE `automovel`
  ADD CONSTRAINT `automovel_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `estoque_ibfk_1` FOREIGN KEY (`id_peca`) REFERENCES `peca` (`id_peca`);

--
-- Limitadores para a tabela `lista_pedido`
--
ALTER TABLE `lista_pedido`
  ADD CONSTRAINT `lista_pedido_ibfk_1` FOREIGN KEY (`id_ordem_servico`) REFERENCES `ordem_servico` (`id_ordem_servico`) ON DELETE CASCADE,
  ADD CONSTRAINT `lista_pedido_ibfk_3` FOREIGN KEY (`id_atividade`) REFERENCES `atividade` (`id_atividade`) ON DELETE CASCADE,
  ADD CONSTRAINT `lista_pedido_ibfk_4` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `ordem_servico`
--
ALTER TABLE `ordem_servico`
  ADD CONSTRAINT `ordem_servico_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `ordem_servico_ibfk_2` FOREIGN KEY (`id_automovel`) REFERENCES `automovel` (`id_automovel`) ON DELETE CASCADE,
  ADD CONSTRAINT `ordem_servico_ibfk_3` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD CONSTRAINT `pagamento_ibfk_1` FOREIGN KEY (`id_ordem_servico`) REFERENCES `ordem_servico` (`id_ordem_servico`),
  ADD CONSTRAINT `pagamento_ibfk_2` FOREIGN KEY (`id_desconto`) REFERENCES `desconto` (`id_desconto`),
  ADD CONSTRAINT `pagamento_ibfk_3` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `parcela_pg_status`
--
ALTER TABLE `parcela_pg_status`
  ADD CONSTRAINT `parcela_pg_status_ibfk_1` FOREIGN KEY (`id_pagamento`) REFERENCES `pagamento` (`id_pagamento`),
  ADD CONSTRAINT `parcela_pg_status_ibfk_2` FOREIGN KEY (`id_pg_status`) REFERENCES `pagamento_status` (`id_pg_status`);

--
-- Limitadores para a tabela `peca_pedido`
--
ALTER TABLE `peca_pedido`
  ADD CONSTRAINT `peca_pedido_ibfk_2` FOREIGN KEY (`id_peca`) REFERENCES `peca` (`id_peca`) ON DELETE CASCADE,
  ADD CONSTRAINT `peca_pedido_ibfk_3` FOREIGN KEY (`id_list_ped`) REFERENCES `lista_pedido` (`id_list_ped`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `pedido_funcionario`
--
ALTER TABLE `pedido_funcionario`
  ADD CONSTRAINT `pedido_funcionario_ibfk_2` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedido_funcionario_ibfk_3` FOREIGN KEY (`id_list_ped`) REFERENCES `lista_pedido` (`id_list_ped`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `salario_funcionario`
--
ALTER TABLE `salario_funcionario`
  ADD CONSTRAINT `salario_funcionario_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`);

--
-- Limitadores para a tabela `servico_funcionario`
--
ALTER TABLE `servico_funcionario`
  ADD CONSTRAINT `servico_funcionario_ibfk_1` FOREIGN KEY (`id_sal_func`) REFERENCES `salario_funcionario` (`id_sal_func`),
  ADD CONSTRAINT `servico_funcionario_ibfk_2` FOREIGN KEY (`id_pedido_func`) REFERENCES `pedido_funcionario` (`id_pedido_func`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
