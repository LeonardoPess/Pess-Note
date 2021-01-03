-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Jan-2021 às 06:00
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pess_note`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.listas`
--

CREATE TABLE `tb_site.listas` (
  `id` int(11) NOT NULL,
  `nome` varchar(12) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_site.listas`
--

INSERT INTO `tb_site.listas` (`id`, `nome`, `slug`) VALUES
(17, 'Atividades', 'atividades'),
(19, 'Compras', 'compras'),
(20, 'Filmes', 'filmes'),
(21, 'Series', 'series');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.notes`
--

CREATE TABLE `tb_site.notes` (
  `id` int(11) NOT NULL,
  `lista_id` int(11) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_site.listas`
--
ALTER TABLE `tb_site.listas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.notes`
--
ALTER TABLE `tb_site.notes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_site.listas`
--
ALTER TABLE `tb_site.listas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `tb_site.notes`
--
ALTER TABLE `tb_site.notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
