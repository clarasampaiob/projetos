

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sys_unopar`
--
CREATE DATABASE IF NOT EXISTS `sys_unopar` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sys_unopar`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `calcado`
--

CREATE TABLE `calcado` (
  `id_calcado` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_colecao` int(11) NOT NULL,
  `nome_calcado` varchar(150) NOT NULL,
  `cor_calcado` varchar(150) NOT NULL,
  `tam_max` smallint(2) DEFAULT NULL,
  `tam_min` smallint(2) DEFAULT NULL,
  `preco_custo` decimal(5,2) DEFAULT NULL,
  `preco_venda` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `calcado`
--

INSERT INTO `calcado` (`id_calcado`, `id_tipo`, `id_colecao`, `nome_calcado`, `cor_calcado`, `tam_max`, `tam_min`, `preco_custo`, `preco_venda`) VALUES
(1, 1, 2, 'All Star', 'Preto', 42, 27, '15.00', '90.00'),
(2, 1, 1, 'Tenis Adidas', 'Preto', 45, 25, '30.00', '190.00'),
(3, 1, 1, 'Adidas', 'Branco', 45, 25, '40.00', '230.00'),
(4, 2, 5, 'Bota Salto Fino', 'Marrom', 39, 33, '25.00', '290.00'),
(5, 3, 3, 'Sandália', 'Preto', 40, 34, '15.00', '120.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE `cidade` (
  `id_cidade` int(11) NOT NULL,
  `nome_cidade` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cidade`
--

INSERT INTO `cidade` (`id_cidade`, `nome_cidade`) VALUES
(1, 'Assis'),
(2, 'Londrina'),
(3, 'Bauru'),
(4, 'Campo Grande'),
(5, 'Cornélio Procópio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome_principal` varchar(150) NOT NULL,
  `cpf_proprietario` int(11) DEFAULT NULL,
  `cnpj_principal` int(11) NOT NULL,
  `email_principal` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome_principal`, `cpf_proprietario`, `cnpj_principal`, `email_principal`) VALUES
(1, 'Skate House', 1215191715, 555444123, 'toyshouse@email.com'),
(2, 'Botinão', 847231640, 23115478, 'botinao@email.com'),
(3, 'My Shoes', 75412366, 1122548563, 'myshoes@email.com'),
(4, 'Nike', 554212588, 333654128, 'nikebrasil@email.com'),
(5, 'Adidas', 89995456, 45662278, 'adidasbra@email.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `colecao`
--

CREATE TABLE `colecao` (
  `id_colecao` int(11) NOT NULL,
  `nome_colecao` varchar(100) NOT NULL,
  `ano_colecao` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `colecao`
--

INSERT INTO `colecao` (`id_colecao`, `nome_colecao`, `ano_colecao`) VALUES
(1, 'Inverno', 2017),
(2, 'Verão', 2017),
(3, 'Outono', 2017),
(4, 'Primavera', 2017),
(5, 'Style', 2017);

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `id_endereco` int(11) NOT NULL,
  `id_cidade` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `logradouro` varchar(150) NOT NULL,
  `numero` smallint(4) NOT NULL,
  `bairro` varchar(150) DEFAULT NULL,
  `cep` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id_endereco`, `id_cidade`, `id_estado`, `id_pais`, `logradouro`, `numero`, `bairro`, `cep`) VALUES
(1, 2, 2, 1, 'Rua A', 10, 'Bairro A', 1111000),
(2, 1, 1, 1, 'Rua B', 20, 'Bairro B', 2222000),
(3, 3, 1, 1, 'Rua C', 30, 'Bairro C', 3333000),
(4, 5, 2, 1, 'Rua D', 40, 'Bairro D', 4444000),
(5, 4, 3, 1, 'Rua E', 50, 'Bairro E', 5555000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrega_pedido`
--

CREATE TABLE `entrega_pedido` (
  `id_entrega` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `endereço_entrega` varchar(150) NOT NULL,
  `entregue` tinyint(1) DEFAULT NULL,
  `daata` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `nome_estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estado`
--

INSERT INTO `estado` (`id_estado`, `nome_estado`) VALUES
(1, 'SP'),
(2, 'PR'),
(3, 'MS'),
(4, 'RS'),
(5, 'RJ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE `estoque` (
  `id_estoque` int(11) NOT NULL,
  `nome_estoque` varchar(100) NOT NULL,
  `id_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estoque`
--

INSERT INTO `estoque` (`id_estoque`, `nome_estoque`, `id_tipo`) VALUES
(1, 'Estoque 1: SN', 1),
(2, 'Estoque 2: BT', 2),
(6, 'Estoque 3: SD', 3),
(7, 'Estoque 4: SO', 4),
(8, 'Estoque 5: CH', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_entrega`
--

CREATE TABLE `item_entrega` (
  `id_item_entrega` int(11) NOT NULL,
  `id_entrega` int(11) NOT NULL,
  `id_item_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_pedido`
--

CREATE TABLE `item_pedido` (
  `id_item_pedido` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_calcado` int(11) NOT NULL,
  `tamanho` smallint(2) NOT NULL,
  `qtdd` int(11) NOT NULL,
  `valor_unidade` decimal(5,2) DEFAULT NULL,
  `valor_tot` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja`
--

CREATE TABLE `loja` (
  `cnpj_loja` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_endereco` int(11) NOT NULL,
  `id_tel_cel` int(11) NOT NULL,
  `nome_loja` varchar(200) NOT NULL,
  `email_loja` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `loja`
--

INSERT INTO `loja` (`cnpj_loja`, `id_cliente`, `id_endereco`, `id_tel_cel`, `nome_loja`, `email_loja`) VALUES
(6655978, 3, 3, 3, 'MyShoes1', 'myshoes1@email.com'),
(11001122, 4, 4, 4, 'NIkeL1', 'nikebr1@email.com'),
(33554488, 2, 2, 2, 'Botinao1', 'botnao1@email.com'),
(55661122, 1, 1, 1, 'SktHouse1', 'skth1@email.com'),
(99663314, 5, 5, 5, 'AdidasL1', 'adbr1@email.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

CREATE TABLE `pais` (
  `id_pais` int(11) NOT NULL,
  `nome_pais` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pais`
--

INSERT INTO `pais` (`id_pais`, `nome_pais`) VALUES
(1, 'BRASIL'),
(2, 'CANADA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `cnpj_loja` int(11) NOT NULL,
  `daata` datetime DEFAULT NULL,
  `soma_valor_itens` decimal(10,2) DEFAULT NULL,
  `desconto` decimal(5,2) DEFAULT NULL,
  `valor_final` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `producao`
--

CREATE TABLE `producao` (
  `id_lote` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_estoque` int(11) NOT NULL,
  `numeracao_calcado` smallint(2) NOT NULL,
  `cor_calcado` varchar(100) NOT NULL,
  `qtdd_prod` int(11) NOT NULL,
  `data_prod` date DEFAULT NULL,
  `baixa` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `producao`
--

INSERT INTO `producao` (`id_lote`, `id_tipo`, `id_estoque`, `numeracao_calcado`, `cor_calcado`, `qtdd_prod`, `data_prod`, `baixa`) VALUES
(41, 1, 1, 35, 'branco', 600, '2017-10-12', 0),
(42, 2, 2, 37, 'vinho', 300, '2017-02-22', 0),
(43, 4, 7, 40, 'preto', 100, '2017-09-12', 0),
(46, 1, 1, 35, 'branco', 100, '1990-03-13', 0),
(47, 2, 2, 41, 'preto', 200, '1990-03-13', 1),
(49, 3, 6, 35, 'vinho', 900, '2017-10-20', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefone_celular`
--

CREATE TABLE `telefone_celular` (
  `id_tel_cel` int(11) NOT NULL,
  `tel_1` int(30) DEFAULT NULL,
  `tel_2` int(30) DEFAULT NULL,
  `cel_1` int(30) DEFAULT NULL,
  `cel_2` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `telefone_celular`
--

INSERT INTO `telefone_celular` (`id_tel_cel`, `tel_1`, `tel_2`, `cel_1`, `cel_2`) VALUES
(1, 3326, NULL, NULL, NULL),
(2, 5510, NULL, NULL, NULL),
(3, 1155, NULL, NULL, NULL),
(4, 5522, NULL, NULL, NULL),
(5, 1212, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_calcado`
--

CREATE TABLE `tipo_calcado` (
  `id_tipo` int(11) NOT NULL,
  `nome_tipo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_calcado`
--

INSERT INTO `tipo_calcado` (`id_tipo`, `nome_tipo`) VALUES
(1, 'Sneakers'),
(2, 'Botas'),
(3, 'Sandalhas'),
(4, 'Social'),
(5, 'Chinelo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calcado`
--
ALTER TABLE `calcado`
  ADD PRIMARY KEY (`id_calcado`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_colecao` (`id_colecao`);

--
-- Indexes for table `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`id_cidade`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `colecao`
--
ALTER TABLE `colecao`
  ADD PRIMARY KEY (`id_colecao`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id_endereco`),
  ADD KEY `id_cidade` (`id_cidade`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_pais` (`id_pais`);

--
-- Indexes for table `entrega_pedido`
--
ALTER TABLE `entrega_pedido`
  ADD PRIMARY KEY (`id_entrega`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indexes for table `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id_estoque`),
  ADD KEY `fk_idtipo` (`id_tipo`);

--
-- Indexes for table `item_entrega`
--
ALTER TABLE `item_entrega`
  ADD PRIMARY KEY (`id_item_entrega`),
  ADD KEY `id_entrega` (`id_entrega`),
  ADD KEY `id_item_pedido` (`id_item_pedido`);

--
-- Indexes for table `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD PRIMARY KEY (`id_item_pedido`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_calcado` (`id_calcado`);

--
-- Indexes for table `loja`
--
ALTER TABLE `loja`
  ADD PRIMARY KEY (`cnpj_loja`),
  ADD UNIQUE KEY `nome_loja` (`nome_loja`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_endereco` (`id_endereco`),
  ADD KEY `id_tel_cel` (`id_tel_cel`);

--
-- Indexes for table `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `cnpj_loja` (`cnpj_loja`);

--
-- Indexes for table `producao`
--
ALTER TABLE `producao`
  ADD PRIMARY KEY (`id_lote`),
  ADD KEY `id_estoque` (`id_estoque`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Indexes for table `telefone_celular`
--
ALTER TABLE `telefone_celular`
  ADD PRIMARY KEY (`id_tel_cel`);

--
-- Indexes for table `tipo_calcado`
--
ALTER TABLE `tipo_calcado`
  ADD PRIMARY KEY (`id_tipo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calcado`
--
ALTER TABLE `calcado`
  MODIFY `id_calcado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cidade`
--
ALTER TABLE `cidade`
  MODIFY `id_cidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `colecao`
--
ALTER TABLE `colecao`
  MODIFY `id_colecao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id_endereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `entrega_pedido`
--
ALTER TABLE `entrega_pedido`
  MODIFY `id_entrega` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id_estoque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `item_entrega`
--
ALTER TABLE `item_entrega`
  MODIFY `id_item_entrega` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_pedido`
--
ALTER TABLE `item_pedido`
  MODIFY `id_item_pedido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `producao`
--
ALTER TABLE `producao`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `telefone_celular`
--
ALTER TABLE `telefone_celular`
  MODIFY `id_tel_cel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tipo_calcado`
--
ALTER TABLE `tipo_calcado`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `calcado`
--
ALTER TABLE `calcado`
  ADD CONSTRAINT `calcado_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_calcado` (`id_tipo`),
  ADD CONSTRAINT `calcado_ibfk_2` FOREIGN KEY (`id_colecao`) REFERENCES `colecao` (`id_colecao`);

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`id_cidade`) REFERENCES `cidade` (`id_cidade`),
  ADD CONSTRAINT `endereco_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `endereco_ibfk_3` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id_pais`);

--
-- Limitadores para a tabela `entrega_pedido`
--
ALTER TABLE `entrega_pedido`
  ADD CONSTRAINT `entrega_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`);

--
-- Limitadores para a tabela `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `fk_idtipo` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_calcado` (`id_tipo`);

--
-- Limitadores para a tabela `item_entrega`
--
ALTER TABLE `item_entrega`
  ADD CONSTRAINT `item_entrega_ibfk_1` FOREIGN KEY (`id_entrega`) REFERENCES `entrega_pedido` (`id_entrega`),
  ADD CONSTRAINT `item_entrega_ibfk_2` FOREIGN KEY (`id_item_pedido`) REFERENCES `item_pedido` (`id_item_pedido`);

--
-- Limitadores para a tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD CONSTRAINT `item_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`),
  ADD CONSTRAINT `item_pedido_ibfk_2` FOREIGN KEY (`id_calcado`) REFERENCES `calcado` (`id_calcado`);

--
-- Limitadores para a tabela `loja`
--
ALTER TABLE `loja`
  ADD CONSTRAINT `loja_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `loja_ibfk_2` FOREIGN KEY (`id_endereco`) REFERENCES `endereco` (`id_endereco`),
  ADD CONSTRAINT `loja_ibfk_3` FOREIGN KEY (`id_tel_cel`) REFERENCES `telefone_celular` (`id_tel_cel`);

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`cnpj_loja`) REFERENCES `loja` (`cnpj_loja`);

--
-- Limitadores para a tabela `producao`
--
ALTER TABLE `producao`
  ADD CONSTRAINT `producao_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `calcado` (`id_calcado`),
  ADD CONSTRAINT `producao_ibfk_2` FOREIGN KEY (`id_estoque`) REFERENCES `estoque` (`id_estoque`),
  ADD CONSTRAINT `producao_ibfk_3` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_calcado` (`id_tipo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
