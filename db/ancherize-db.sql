-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 02 mai 2021 à 22:14
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ancherize-db`
--
CREATE DATABASE IF NOT EXISTS `ancherize-db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ancherize-db`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `idArticle` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `libel` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `chImage` varchar(255) NOT NULL,
  `startPrice` int UNSIGNED NOT NULL,
  `hightPrice` int UNSIGNED NOT NULL,
  `countBidder` int UNSIGNED NOT NULL,
  `state` int NOT NULL DEFAULT '0',
  `datePub` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hightDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `endDate` datetime NOT NULL,
  `owner` varchar(255) NOT NULL,
  PRIMARY KEY (`idArticle`),
  KEY `owner` (`owner`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`idArticle`, `libel`, `description`, `chImage`, `startPrice`, `hightPrice`, `countBidder`, `state`, `datePub`, `hightDate`, `endDate`, `owner`) VALUES
(1, 'C\'est de l\'or. Lorem ipsum dolor sit amet consectetur, adipisici ng elit. Mole', 'C\'est de l\'or. Lorem ipsum dolor sit amet consectetur, adipisici ng elit. Molestiae quos velit voluptas a ipsam minus faci lis, obcaecati eligendi enim voluptatibus alias quo poss imus eveniet voluptatum? Numquam iusto nulla distinctio officia! Lorem ipsum dolor sit amet consectetur adipisic ing elit. Quos assumenda rerum aut maxime aspernatur expl icabo ratione voluptatum repellat amet distinctio illum magni quis nulla nemo in, placeat, nam reprehenderit num quam ', 'img/article/or001.jpg', 1000, 10000, 3, 1, '2021-03-29 07:44:56', '2021-04-01 14:10:02', '0000-00-00 00:00:00', 'maurice'),
(2, 'Diamant', 'C\'est du diamant. Lorem ipsum dolor sit amet consectetur, adipisici ng elit. Molestiae quos velit voluptas a ipsam minus faci lis, obcaecati eligendi enim voluptatibus alias quo poss imus eveniet voluptatum? Numquam iusto nulla distinctio officia! Lorem ipsum dolor sit amet consectetur adipisic ing elit. Quos assumenda rerum aut maxime aspernatur expl icabo ratione voluptatum repellat amet distinctio illum magni quis nulla nemo in, placeat, nam reprehenderit num quam ', 'img/article/diamant002.png', 2000, 6000, 3, 1, '2021-03-29 07:53:01', '2021-03-30 09:57:38', '0000-00-00 00:00:00', 'maurice'),
(12, 'Hand', 'C\'est une main de Dieu.', 'img/article/anch_article_6c1577530b7d8ac8c65cc139f0e7b016.png', 1000, 3000, 1, 1, '2021-03-30 13:14:37', '2021-04-27 11:33:34', '0000-00-00 00:00:00', 'maurice'),
(13, 'Fumée', 'C\'est de la fumée.', 'img/article/anch_article_83d8e54b1ae6d2e2c3c884e0962f4c17.png', 2000, 30000, 2, 1, '2021-03-30 13:15:04', '2021-04-01 15:23:56', '0000-00-00 00:00:00', 'maurice'),
(14, 'Etilisat a vendre', 'Batiment a vendre', 'img/article/anch_article_55498094729cc13db7314802ede85606.jpg', 100, 500, 0, 1, '2021-03-30 13:29:40', '2021-04-01 14:20:32', '0000-00-00 00:00:00', 'maurice'),
(15, 'Robot tueur', 'Robot tueur de peuple', 'img/article/anch_article_4be5276f87cd0766d122de08aba3ae6a.jpg', 1000, 5000, 1, 1, '2021-04-01 15:06:14', '2021-04-01 16:51:54', '0000-00-00 00:00:00', 'ominouz'),
(16, 'Robot medecin', 'Juste comme cela', 'img/article/anch_article_d73279a895d0ec17f15bac15a8ed3213.jpg', 100, 1000, 1, 1, '2021-04-15 17:10:36', '2021-04-15 17:10:51', '0000-00-00 00:00:00', 'maurice'),
(19, 'AFRIKING', 'C\'est un site réalisé par KHADAR.\r\nC\'est un site de présentation des rois de l\'AFRIQUE...', 'img/article/anch_article_dd86c09a8e86c5b29a7bf94e66fcb9c3.png', 1500, 3500, 1, 1, '2021-04-27 11:31:14', '2021-04-27 14:10:06', '0000-00-00 00:00:00', 'maurice'),
(20, 'LOGO', 'C\'est un logo d\'un site d\'avenir...', 'img/article/anch_article_b8750980f0fed5829bcca3d7e9cd9778.png', 3, 8, 2, 1, '2021-04-27 11:53:36', '2021-04-27 12:03:07', '0000-00-00 00:00:00', 'paulsmith'),
(26, 'Windows', 'C\'est un systeme d\'exploitation...', 'img/article/anch_article_2adc50c27253a28e82693ce1ad0295aa.png', 4000, 4000, 0, 0, '2021-05-02 23:00:11', '2021-05-02 23:15:22', '2021-05-04 23:55:00', 'paulsmith');

-- --------------------------------------------------------

--
-- Structure de la table `root`
--

DROP TABLE IF EXISTS `root`;
CREATE TABLE IF NOT EXISTS `root` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `special_word` varchar(255) NOT NULL,
  `access` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sale` int UNSIGNED NOT NULL DEFAULT '100000',
  `bidSale` int UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `root`
--

INSERT INTO `root` (`id`, `pseudo`, `pwd`, `special_word`, `access`, `email`, `sale`, `bidSale`) VALUES
(1, 'paulsmith', 'oklm2021', 'anch-root', 'admin', 'pzannou511@gmail.com', 100000, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tobid`
--

DROP TABLE IF EXISTS `tobid`;
CREATE TABLE IF NOT EXISTS `tobid` (
  `idBid` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `bidder` varchar(255) NOT NULL,
  `idArticle` int UNSIGNED NOT NULL,
  `priceBid` int UNSIGNED NOT NULL,
  `dateBid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idBid`,`bidder`,`idArticle`),
  KEY `bidder` (`bidder`),
  KEY `idArticle` (`idArticle`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tobid`
--

INSERT INTO `tobid` (`idBid`, `bidder`, `idArticle`, `priceBid`, `dateBid`) VALUES
(1, 'maurice', 1, 2000, '2021-04-01 00:55:40'),
(2, 'maurice', 1, 4000, '2021-04-01 00:55:40'),
(3, 'maurice', 2, 3000, '2021-04-01 00:55:40'),
(4, 'maurice', 2, 6000, '2021-04-01 00:55:40'),
(7, 'maurice', 14, 100, '2021-04-01 14:13:24'),
(6, 'maurice', 1, 10000, '2021-04-01 14:10:02'),
(8, 'maurice', 14, 100, '2021-04-01 14:19:48'),
(9, 'maurice', 14, 500, '2021-04-01 14:20:32'),
(10, 'ominouz', 13, 3000, '2021-04-01 15:22:01'),
(11, 'ominouz', 13, 30000, '2021-04-01 15:23:56'),
(12, 'maurice', 15, 5000, '2021-04-01 16:51:54'),
(13, 'maurice', 16, 1000, '2021-04-15 17:10:51'),
(14, 'maurice', 12, 3000, '2021-04-27 11:33:34'),
(15, 'paulsmith', 17, 40000, '2021-04-27 11:54:17'),
(16, 'maurice', 20, 5, '2021-04-27 12:02:13'),
(17, 'paulsmith', 20, 8, '2021-04-27 12:03:07'),
(18, 'maurice', 19, 3500, '2021-04-27 14:10:06'),
(19, 'maurice', 17, 35000, '2021-04-27 14:30:07');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sale` int UNSIGNED NOT NULL DEFAULT '100000',
  `bidSale` int UNSIGNED NOT NULL DEFAULT '0',
  `confirm_token` varchar(255) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `pwd`, `email`, `sale`, `bidSale`, `confirm_token`, `confirmed_at`, `reset_token`, `reset_at`) VALUES
(4, 'paul', '$2y$10$B2MqzXWPm.FLB5wn4nFyoe70a0OsQz.8Zy5LWSrWbM2626wq54KKG', 'zannou@gmail.com', 100000, 0, NULL, '2021-03-27 19:02:41', NULL, NULL),
(3, 'sylva', '$2y$10$7LraPccYSugeAiYhNIw2ue6WC8iqNmaTXbsjB5gEIk6hD3jGlf.0.', 'sylva@sounouvo.nrt', 100000, 0, 'aPntSXkQr3MaFuoiZxlshxBKrFHQpXoehmLBOXLCLvQ74246HzFTUB2I4CFr', NULL, NULL, NULL),
(5, 'khaled', '$2y$10$1KTk6UVd74dxdDiS9A59KOZO3hug8dCfShi6g/kN73hYKo/ShTG5C', 'khaledsannyaml@gmail.com', 100000, 0, NULL, '2021-03-28 15:37:06', 'zgAFLoaeX0dieVWFU8hSUksPn9PU2ZttktJIDHdZgCJ4Vkr1i7bXH6pRJ9t0', '2021-04-15 09:51:14'),
(7, 'maurice', '$2y$10$BJb55tSovkbrJYsDnwptXO1BmWQSlOoJpUFoxuXuzaFbwAwiT7352', 'maurice@mail.com', 3930000, 0, NULL, '2021-03-28 17:46:15', NULL, '2021-04-01 08:40:50'),
(25, 'paulsmith', '$2y$10$HcO1j57HCn32tVLkIg9HdubNq/Lw9tkpUEqjzqhH0tejp5HGH4gT2', 'pzannou511@gmail.com', 104200, 40008, NULL, '2021-04-27 11:48:21', NULL, NULL),
(21, 'ominouz', '$2y$10$TrUkNBJQFLAUgoXertW0ROEMikaknPz7dMpAMbwTinBE8thUOSzrG', 'ominouz@desk.gmail', 100000, 33000, NULL, '2021-04-14 15:00:31', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
