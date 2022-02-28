-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2022 at 03:24 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectfullstack_dotlib_prova`
--

-- --------------------------------------------------------

--
-- Table structure for table `cadastros`
--

DROP TABLE IF EXISTS `cadastros`;
CREATE TABLE `cadastros` (
  `cadastroId` int(11) NOT NULL,
  `cadastroCpf` varchar(45) NOT NULL,
  `cadastroNome` varchar(45) NOT NULL,
  `cadastroEmail` varchar(100) NOT NULL,
  `cadastroSenha` varchar(100) NOT NULL,
  `cadastroAutoridade` tinyint(4) NOT NULL,
  `cadastroToken` varchar(100) NOT NULL,
  `cadastroApiToken` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `carrinhos`
--

DROP TABLE IF EXISTS `carrinhos`;
CREATE TABLE `carrinhos` (
  `carrinhoId` int(11) NOT NULL,
  `carrinhoProdutoId` int(11) NOT NULL,
  `carrinhoQuantidade` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `categoriaId` int(11) NOT NULL,
  `categoriaNome` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`categoriaId`, `categoriaNome`, `created_at`, `updated_at`) VALUES
(1, 'Medicina', '2022-02-26 21:10:04', '2022-02-26 21:10:04'),
(2, 'Direito', '2022-02-26 21:10:04', '2022-02-26 21:10:04'),
(3, 'Ficção', '2022-02-26 21:10:04', '2022-02-26 21:10:04'),
(4, 'Health', '2022-02-26 21:10:04', '2022-02-26 21:10:04'),
(5, 'Biografia', '2022-02-26 21:10:04', '2022-02-26 21:10:04'),
(6, 'Outros', '2022-02-26 21:10:04', '2022-02-26 21:10:04');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `pedidoId` int(11) NOT NULL,
  `pedidoCadastroId` int(11) NOT NULL,
  `pedidoCarrinhoId` int(11) NOT NULL,
  `pedidoAglunitador` int(11) DEFAULT NULL,
  `pedidoStatus` tinyint(4) NOT NULL,
  `pedidoCodBarras` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pedidos_temporarios`
--

DROP TABLE IF EXISTS `pedidos_temporarios`;
CREATE TABLE `pedidos_temporarios` (
  `carrinhoId` int(11) NOT NULL,
  `cadastroId` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `produtoId` int(11) NOT NULL,
  `produtoNome` varchar(100) NOT NULL,
  `produtoAutor` varchar(100) NOT NULL,
  `produtoValorUnitario` varchar(15) NOT NULL,
  `produtoQtdeEstoque` int(11) NOT NULL,
  `produtoFormato` varchar(45) NOT NULL,
  `produtoImagem` varchar(300) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`produtoId`, `produtoNome`, `produtoAutor`, `produtoValorUnitario`, `produtoQtdeEstoque`, `produtoFormato`, `produtoImagem`, `created_at`, `updated_at`) VALUES
(1, 'Homo Deus', 'Yuval Noah Hurari', '32.49', 8, 'ebook', '/storage/imagens/SouUmLivro.jpg', '2022-02-26 19:31:03', '2022-02-26 19:31:03'),
(2, 'Minha História', 'Michelle Obama', '39.90', 12, 'ebook', '/storage/imagens/SouUmLivro.jpg', '2022-02-26 19:38:04', '2022-02-26 19:38:04'),
(3, 'Ada ou Ardor', 'Vladimir Nabokov', '44.90', 45, 'livro', '/storage/imagens/SouUmLivro.jpg', '2022-02-26 19:38:04', '2022-02-26 19:38:04'),
(4, 'Mindset', 'Carol Dweck', '29.90', 102, 'livro', '/storage/imagens/SouUmLivro.jpg', '2022-02-26 19:38:04', '2022-02-26 19:38:04'),
(5, 'Mais Esperto que o Diabo', 'Napoleon Hill', '29.90', 4, 'ebook', '/storage/imagens/SouUmLivro.jpg', '2022-02-26 19:40:27', '2022-02-26 19:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `relacao_produto_categoria`
--

DROP TABLE IF EXISTS `relacao_produto_categoria`;
CREATE TABLE `relacao_produto_categoria` (
  `produtoId` int(11) NOT NULL,
  `categoriaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cadastros`
--
ALTER TABLE `cadastros`
  ADD PRIMARY KEY (`cadastroId`),
  ADD UNIQUE KEY `cadastroToken` (`cadastroToken`),
  ADD UNIQUE KEY `cadastroEmail` (`cadastroEmail`),
  ADD UNIQUE KEY `cadastroCpf` (`cadastroCpf`),
  ADD KEY `cadastroApiToken` (`cadastroApiToken`);

--
-- Indexes for table `carrinhos`
--
ALTER TABLE `carrinhos`
  ADD PRIMARY KEY (`carrinhoId`),
  ADD KEY `carrinhoProdutoId` (`carrinhoProdutoId`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoriaId`),
  ADD UNIQUE KEY `categoriaNome` (`categoriaNome`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`pedidoId`),
  ADD UNIQUE KEY `pedidoCodBarras` (`pedidoCodBarras`),
  ADD KEY `Cadastro-Id_Pedidos_FK` (`pedidoCadastroId`),
  ADD KEY `Carrinho-Id_Pedidos_FK` (`pedidoCarrinhoId`);

--
-- Indexes for table `pedidos_temporarios`
--
ALTER TABLE `pedidos_temporarios`
  ADD PRIMARY KEY (`carrinhoId`,`cadastroId`),
  ADD KEY `cadastro-id_FK` (`cadastroId`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`produtoId`),
  ADD UNIQUE KEY `produtoNome` (`produtoNome`);

--
-- Indexes for table `relacao_produto_categoria`
--
ALTER TABLE `relacao_produto_categoria`
  ADD PRIMARY KEY (`produtoId`,`categoriaId`),
  ADD KEY `categoriaId` (`categoriaId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cadastros`
--
ALTER TABLE `cadastros`
  MODIFY `cadastroId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `carrinhos`
--
ALTER TABLE `carrinhos`
  MODIFY `carrinhoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoriaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `pedidoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produtoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carrinhos`
--
ALTER TABLE `carrinhos`
  ADD CONSTRAINT `carrinhos_ibfk_1` FOREIGN KEY (`carrinhoProdutoId`) REFERENCES `produtos` (`produtoId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `Cadastro-Id_Pedidos_FK` FOREIGN KEY (`pedidoCadastroId`) REFERENCES `cadastros` (`cadastroId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Carrinho-Id_Pedidos_FK` FOREIGN KEY (`pedidoCarrinhoId`) REFERENCES `carrinhos` (`carrinhoId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `pedidos_temporarios`
--
ALTER TABLE `pedidos_temporarios`
  ADD CONSTRAINT `cadastro-id_FK` FOREIGN KEY (`cadastroId`) REFERENCES `cadastros` (`cadastroId`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `carrinho-id_FK` FOREIGN KEY (`carrinhoId`) REFERENCES `carrinhos` (`carrinhoId`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `relacao_produto_categoria`
--
ALTER TABLE `relacao_produto_categoria`
  ADD CONSTRAINT `categoriaId` FOREIGN KEY (`categoriaId`) REFERENCES `categorias` (`categoriaId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `produtoId` FOREIGN KEY (`produtoId`) REFERENCES `produtos` (`produtoId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
