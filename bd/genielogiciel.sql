-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 09 sep. 2021 à 14:03
-- Version du serveur :  10.1.29-MariaDB
-- Version de PHP :  7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `genielogiciel`
--

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `idequipe` int(11) NOT NULL,
  `nom` varchar(300) DEFAULT NULL,
  `logo` varchar(300) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`idequipe`, `nom`, `logo`, `created_at`) VALUES
(1, 'fc fidba graphics', '1081963132.png', '2021-09-06 17:56:18'),
(2, 'as la patrona', 'logo.jpg', '2021-09-06 17:56:34'),
(3, 'manchester united', '1575031197.png', '2021-09-07 15:56:58'),
(4, 'Barcelone fc', '1872843680.jpg', '2021-09-07 15:57:30'),
(5, 'real madrid', '1043422144.png', '2021-09-07 15:57:48'),
(6, 'Paris saint germain', '972139284.jpg', '2021-09-07 15:58:53'),
(9, 'simba', '267054423.jpg', '2021-09-09 12:52:59');

-- --------------------------------------------------------

--
-- Structure de la table `matchs`
--

CREATE TABLE `matchs` (
  `idmath` int(11) NOT NULL,
  `nomMatch` varchar(300) DEFAULT NULL,
  `equipe1` int(11) DEFAULT NULL,
  `equipe2` varchar(300) DEFAULT NULL,
  `jour` date DEFAULT NULL,
  `heure` varchar(300) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `matchs`
--

INSERT INTO `matchs` (`idmath`, `nomMatch`, `equipe1`, `equipe2`, `jour`, `heure`, `created_at`) VALUES
(1, 'match fc fidba vs as dream', 1, 'as la patrona', '2021-09-09', '15:12', '2021-09-07 15:12:26'),
(5, 'match PSG vs as manchester united', 6, 'manchester united', '2021-09-10', '20:00', '2021-09-07 16:00:39'),
(6, 'match fc Real madrid vs fc Barcelone', 5, 'Barcelone fc', '2021-09-11', '21:00', '2021-09-07 16:02:13'),
(8, 'psg vs man', 6, 'manchester united', '2021-09-08', '16:06', '2021-09-09 13:04:05');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `message` varchar(800) DEFAULT NULL,
  `url` varchar(800) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `icone` varchar(300) DEFAULT NULL,
  `titre` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id`, `message`, `url`, `id_user`, `created_at`, `icone`, `titre`) VALUES
(25, 'yuma kayanda Vient de rejoindre la plateforme ', 'admin/users', 8, '2021-04-12 13:29:13', 'fa fa-user', 'Nouvelle inscription'),
(27, 'kasumba kipundula Vient de rejoindre la plateforme ', 'admin/users', 7, '2021-04-12 13:30:58', 'fa fa-user', 'Nouvelle inscription'),
(28, 'kasumba kipundula Vient de rejoindre la plateforme ', 'admin/users', 8, '2021-04-12 13:30:58', 'fa fa-user', 'Nouvelle inscription'),
(29, 'kasumba kipundula Vient de rejoindre la plateforme ', 'admin/users', 9, '2021-04-12 13:30:58', 'fa fa-user', 'Nouvelle inscription'),
(30, 'mikah kalume Vient de rejoindre la plateforme ', 'admin/users', 7, '2021-04-12 13:33:19', 'fa fa-user', 'Nouvelle inscription'),
(31, 'mikah kalume Vient de rejoindre la plateforme ', 'admin/users', 8, '2021-04-12 13:33:19', 'fa fa-user', 'Nouvelle inscription'),
(32, 'steven Vient de rejoindre la plateforme ', 'admin/users', 7, '2021-09-09 12:33:02', 'fa fa-user', 'Nouvelle inscription'),
(33, 'steven Vient de rejoindre la plateforme ', 'admin/users', 8, '2021-09-09 12:33:02', 'fa fa-user', 'Nouvelle inscription'),
(34, 'shekinah Vient de rejoindre la plateforme ', 'admin/users', 7, '2021-09-09 12:33:50', 'fa fa-user', 'Nouvelle inscription'),
(35, 'shekinah Vient de rejoindre la plateforme ', 'admin/users', 8, '2021-09-09 12:33:50', 'fa fa-user', 'Nouvelle inscription'),
(36, 'Providencia Vient de rejoindre la plateforme ', 'admin/users', 7, '2021-09-09 12:34:01', 'fa fa-user', 'Nouvelle inscription'),
(37, 'Providencia Vient de rejoindre la plateforme ', 'admin/users', 8, '2021-09-09 12:34:01', 'fa fa-user', 'Nouvelle inscription'),
(38, 'Arsene Vient de rejoindre la plateforme ', 'admin/users', 7, '2021-09-09 12:34:30', 'fa fa-user', 'Nouvelle inscription'),
(39, 'Arsene Vient de rejoindre la plateforme ', 'admin/users', 8, '2021-09-09 12:34:30', 'fa fa-user', 'Nouvelle inscription'),
(40, 'Andre Vient de rejoindre la plateforme ', 'admin/users', 7, '2021-09-09 12:36:19', 'fa fa-user', 'Nouvelle inscription'),
(41, 'Andre Vient de rejoindre la plateforme ', 'admin/users', 8, '2021-09-09 12:36:19', 'fa fa-user', 'Nouvelle inscription'),
(42, 'Paul Vient de rejoindre la plateforme ', 'admin/users', 7, '2021-09-09 12:38:31', 'fa fa-user', 'Nouvelle inscription'),
(43, 'Paul Vient de rejoindre la plateforme ', 'admin/users', 8, '2021-09-09 12:38:31', 'fa fa-user', 'Nouvelle inscription'),
(44, 'Paul Vient de rejoindre la plateforme ', 'admin/users', 38, '2021-09-09 12:38:31', 'fa fa-user', 'Nouvelle inscription'),
(45, 'MOISE Vient de rejoindre la plateforme ', 'admin/users', 7, '2021-09-09 12:39:17', 'fa fa-user', 'Nouvelle inscription'),
(46, 'MOISE Vient de rejoindre la plateforme ', 'admin/users', 8, '2021-09-09 12:39:18', 'fa fa-user', 'Nouvelle inscription'),
(47, 'MOISE Vient de rejoindre la plateforme ', 'admin/users', 38, '2021-09-09 12:39:18', 'fa fa-user', 'Nouvelle inscription'),
(48, 'siwa Vient de rejoindre la plateforme ', 'admin/users', 7, '2021-09-09 12:39:36', 'fa fa-user', 'Nouvelle inscription'),
(49, 'siwa Vient de rejoindre la plateforme ', 'admin/users', 8, '2021-09-09 12:39:36', 'fa fa-user', 'Nouvelle inscription'),
(50, 'siwa Vient de rejoindre la plateforme ', 'admin/users', 38, '2021-09-09 12:39:36', 'fa fa-user', 'Nouvelle inscription'),
(51, 'Admin siwa Vient de rejoindre la plateforme ', 'admin/users', 7, '2021-09-09 12:54:21', 'fa fa-user', 'Nouvelle inscription'),
(52, 'Admin siwa Vient de rejoindre la plateforme ', 'admin/users', 8, '2021-09-09 12:54:21', 'fa fa-user', 'Nouvelle inscription'),
(53, 'Admin siwa Vient de rejoindre la plateforme ', 'admin/users', 38, '2021-09-09 12:54:21', 'fa fa-user', 'Nouvelle inscription'),
(54, 'Admin siwa Vient de rejoindre la plateforme ', 'admin/users', 42, '2021-09-09 12:54:21', 'fa fa-user', 'Nouvelle inscription'),
(55, 'Admin siwa Vient de rejoindre la plateforme ', 'admin/users', 44, '2021-09-09 12:54:21', 'fa fa-user', 'Nouvelle inscription'),
(56, 'Admin siwa Vient de rejoindre la plateforme ', 'admin/users', 45, '2021-09-09 12:54:21', 'fa fa-user', 'Nouvelle inscription'),
(57, 'shady Vient de rejoindre la plateforme ', 'admin/users', 7, '2021-09-09 13:18:05', 'fa fa-user', 'Nouvelle inscription'),
(58, 'shady Vient de rejoindre la plateforme ', 'admin/users', 8, '2021-09-09 13:18:06', 'fa fa-user', 'Nouvelle inscription'),
(59, 'shady Vient de rejoindre la plateforme ', 'admin/users', 38, '2021-09-09 13:18:06', 'fa fa-user', 'Nouvelle inscription'),
(60, 'shady Vient de rejoindre la plateforme ', 'admin/users', 42, '2021-09-09 13:18:06', 'fa fa-user', 'Nouvelle inscription'),
(61, 'shady Vient de rejoindre la plateforme ', 'admin/users', 44, '2021-09-09 13:18:06', 'fa fa-user', 'Nouvelle inscription'),
(62, 'shady Vient de rejoindre la plateforme ', 'admin/users', 45, '2021-09-09 13:18:06', 'fa fa-user', 'Nouvelle inscription'),
(63, 'olivier Vient de rejoindre la plateforme ', 'admin/users', 7, '2021-09-09 13:19:39', 'fa fa-user', 'Nouvelle inscription'),
(64, 'olivier Vient de rejoindre la plateforme ', 'admin/users', 8, '2021-09-09 13:19:39', 'fa fa-user', 'Nouvelle inscription'),
(65, 'olivier Vient de rejoindre la plateforme ', 'admin/users', 38, '2021-09-09 13:19:39', 'fa fa-user', 'Nouvelle inscription'),
(66, 'olivier Vient de rejoindre la plateforme ', 'admin/users', 42, '2021-09-09 13:19:40', 'fa fa-user', 'Nouvelle inscription'),
(67, 'olivier Vient de rejoindre la plateforme ', 'admin/users', 44, '2021-09-09 13:19:40', 'fa fa-user', 'Nouvelle inscription'),
(68, 'olivier Vient de rejoindre la plateforme ', 'admin/users', 45, '2021-09-09 13:19:40', 'fa fa-user', 'Nouvelle inscription'),
(69, 'alain Vient de rejoindre la plateforme ', 'admin/users', 7, '2021-09-09 13:26:35', 'fa fa-user', 'Nouvelle inscription'),
(70, 'alain Vient de rejoindre la plateforme ', 'admin/users', 8, '2021-09-09 13:26:35', 'fa fa-user', 'Nouvelle inscription'),
(71, 'alain Vient de rejoindre la plateforme ', 'admin/users', 38, '2021-09-09 13:26:35', 'fa fa-user', 'Nouvelle inscription'),
(72, 'alain Vient de rejoindre la plateforme ', 'admin/users', 42, '2021-09-09 13:26:35', 'fa fa-user', 'Nouvelle inscription'),
(73, 'alain Vient de rejoindre la plateforme ', 'admin/users', 44, '2021-09-09 13:26:35', 'fa fa-user', 'Nouvelle inscription'),
(74, 'alain Vient de rejoindre la plateforme ', 'admin/users', 45, '2021-09-09 13:26:35', 'fa fa-user', 'Nouvelle inscription'),
(75, 'Josue isamuna Vient de rejoindre la plateforme ', 'admin/users', 7, '2021-09-09 13:30:36', 'fa fa-user', 'Nouvelle inscription'),
(76, 'Josue isamuna Vient de rejoindre la plateforme ', 'admin/users', 8, '2021-09-09 13:30:36', 'fa fa-user', 'Nouvelle inscription'),
(77, 'Josue isamuna Vient de rejoindre la plateforme ', 'admin/users', 38, '2021-09-09 13:30:36', 'fa fa-user', 'Nouvelle inscription'),
(78, 'Josue isamuna Vient de rejoindre la plateforme ', 'admin/users', 42, '2021-09-09 13:30:37', 'fa fa-user', 'Nouvelle inscription'),
(79, 'Josue isamuna Vient de rejoindre la plateforme ', 'admin/users', 44, '2021-09-09 13:30:37', 'fa fa-user', 'Nouvelle inscription'),
(80, 'Josue isamuna Vient de rejoindre la plateforme ', 'admin/users', 45, '2021-09-09 13:30:37', 'fa fa-user', 'Nouvelle inscription');

-- --------------------------------------------------------

--
-- Structure de la table `online`
--

CREATE TABLE `online` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `online`
--

INSERT INTO `online` (`id`, `id_user`, `created_at`) VALUES
(8, 39, '2021-09-09 12:34:48'),
(13, 43, '2021-09-09 12:39:29'),
(14, 44, '2021-09-09 12:41:33'),
(18, 47, '2021-09-09 12:54:33'),
(24, 40, '2021-09-09 13:16:09'),
(25, 45, '2021-09-09 13:16:20'),
(28, 42, '2021-09-09 13:25:31'),
(34, 38, '2021-09-09 13:33:08'),
(37, 53, '2021-09-09 13:38:48'),
(38, 7, '2021-09-09 13:40:13');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `idp` int(11) NOT NULL,
  `idpersonne` int(11) DEFAULT NULL,
  `date_paie` date DEFAULT NULL,
  `montant` float DEFAULT NULL,
  `motif` text,
  `token` varchar(300) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `codeFacture` varchar(300) DEFAULT NULL,
  `etat_paiement` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `place`
--

CREATE TABLE `place` (
  `idplace` int(11) NOT NULL,
  `idstade` int(11) DEFAULT NULL,
  `nomPlace` varchar(300) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `place`
--

INSERT INTO `place` (`idplace`, `idstade`, `nomPlace`, `created_at`) VALUES
(4, 4, 'A1', '2021-09-08 11:23:07'),
(5, 5, 'Rang A place 2', '2021-09-08 11:31:55'),
(6, 4, 'A2', '2021-09-08 11:47:31'),
(7, 4, 'A3', '2021-09-08 11:47:44'),
(8, 4, 'A4', '2021-09-08 11:47:53'),
(9, 4, 'A5', '2021-09-08 11:48:02'),
(11, 5, 'Rang A place 1', '2021-09-08 16:39:35'),
(12, 5, 'Rang A place 3', '2021-09-08 16:39:44'),
(13, 5, 'Rang A place 4', '2021-09-08 16:39:52'),
(14, 5, 'Rang A place 5', '2021-09-08 16:40:08'),
(15, 5, 'Rang A place 6', '2021-09-08 16:40:18'),
(16, 4, 'A6', '2021-09-09 03:41:28'),
(17, 7, 'Rang A place 1', '2021-09-09 09:42:31'),
(18, 7, 'Rang A place 2', '2021-09-09 09:42:43'),
(19, 7, 'Rang A place 33', '2021-09-09 09:42:53'),
(21, 7, 'vip place 3', '2021-09-09 10:06:49'),
(22, 8, 'Lumumba 1', '2021-09-09 12:44:07'),
(23, 8, 'Rang B VIP  Place 1', '2021-09-09 12:54:14'),
(26, 13, 'MoyenneA', '2021-09-09 13:54:02'),
(27, 13, 'MoyenneB', '2021-09-09 13:54:28');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `profile_client`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `profile_client` (
`id` int(11)
,`first_name` varchar(300)
,`last_name` varchar(300)
,`email` varchar(300)
,`image` varchar(300)
,`telephone` varchar(300)
,`full_adresse` text
,`biographie` text
,`date_nais` date
,`idrole` int(11)
,`sexe` varchar(30)
,`facebook` varchar(900)
,`linkedin` varchar(900)
,`twitter` varchar(900)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `profile_match`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `profile_match` (
`idmath` int(11)
,`nomMatch` varchar(300)
,`equipe1` int(11)
,`equipe2` varchar(300)
,`jour` date
,`heure` varchar(300)
,`created_at` datetime
,`nom_equipe1` varchar(300)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `profile_paiement`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `profile_paiement` (
`idp` int(11)
,`idpersonne` int(11)
,`date_paie` date
,`montant` float
,`motif` text
,`token` varchar(300)
,`created_at` datetime
,`codeFacture` varchar(300)
,`etat_paiement` int(11)
,`first_name` varchar(300)
,`last_name` varchar(300)
,`email` varchar(300)
,`telephone` varchar(300)
,`image` varchar(300)
,`id` int(11)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `profile_place`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `profile_place` (
`idplace` int(11)
,`idstade` int(11)
,`nomPlace` varchar(300)
,`created_at` datetime
,`nom` varchar(300)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `profile_reservation`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `profile_reservation` (
`idreservation` int(11)
,`idclient` int(11)
,`idmath` int(11)
,`montant` int(11)
,`created_at` datetime
,`idstade` int(11)
,`idplace` int(11)
,`etat_reservation` int(11)
,`first_name` varchar(300)
,`last_name` varchar(300)
,`image` varchar(300)
,`codeReservation` varchar(300)
,`telephone` varchar(300)
,`email` varchar(300)
,`nomMatch` varchar(300)
,`equipe1` int(11)
,`jour` date
,`equipe2` varchar(300)
,`heure` varchar(300)
,`nomStade` varchar(300)
,`nomPlace` varchar(300)
,`nomEquipe` varchar(300)
);

-- --------------------------------------------------------

--
-- Structure de la table `recupere`
--

CREATE TABLE `recupere` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `verification_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `recupere`
--

INSERT INTO `recupere` (`id`, `email`, `verification_key`) VALUES
(3, 'alpha@gmail.com', '6aea3cee4087269ebea90ae4229698c7'),
(4, 'alpha@gmail.com', '1123adb273b435474c75f16e4b408015');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `idreservation` int(11) NOT NULL,
  `idclient` int(11) DEFAULT NULL,
  `idmath` int(11) DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `idstade` int(11) DEFAULT NULL,
  `idplace` int(11) DEFAULT NULL,
  `etat_reservation` int(11) DEFAULT '0',
  `codeReservation` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`idreservation`, `idclient`, `idmath`, `montant`, `created_at`, `idstade`, `idplace`, `etat_reservation`, `codeReservation`) VALUES
(1, 11, 1, 1, '2021-09-08 17:13:03', 5, 11, 1, 'ihfajcdebg'),
(2, 12, 1, 1, '2021-09-08 17:27:01', 5, 5, 1, 'dhiaebjfgc'),
(3, 13, 1, 1, '2021-09-08 17:28:56', 5, 12, 1, 'bdijghecfa'),
(5, 35, 5, 1, '2021-09-08 17:37:22', 5, 11, 1, 'hfjdcgbaei'),
(7, 36, 1, 1, '2021-09-08 17:40:06', 5, 14, 1, 'fdgcjhbiae'),
(8, 35, 1, 1, '2021-09-09 00:47:52', 5, 15, 1, 'higedfbacj'),
(13, 46, 1, 10, '2021-09-09 12:54:37', 7, 21, 1, 'bgiefahcjd'),
(14, 48, 6, 1000, '2021-09-09 12:59:22', 8, 9, 1, 'gcedbjaifh'),
(15, 48, 6, 2, '2021-09-09 13:00:37', 4, 22, 1, 'higfcdebaj'),
(16, 11, 1, 1, '2021-09-09 13:55:42', 13, 26, 0, 'bcegifjhda');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `idrole` int(11) NOT NULL,
  `nom` varchar(300) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`idrole`, `nom`, `created_at`) VALUES
(1, 'admin', '2021-04-12 16:10:38'),
(2, 'Client', '2021-04-12 16:12:38'),
(3, 'Membre', '2021-04-12 13:54:16');

-- --------------------------------------------------------

--
-- Structure de la table `stade`
--

CREATE TABLE `stade` (
  `idstade` int(11) NOT NULL,
  `nom` varchar(300) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stade`
--

INSERT INTO `stade` (`idstade`, `nom`, `created_at`) VALUES
(4, 'De l\'unité', '2021-09-08 10:13:52'),
(5, 'Homni sport', '2021-09-08 10:14:03'),
(7, 'kamalondo', '2021-09-09 09:41:39'),
(8, 'lupopo', '2021-09-09 12:43:14'),
(13, 'NTOTO POLE', '2021-09-09 13:53:02');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_info`
--

CREATE TABLE `tbl_info` (
  `idinfo` int(11) NOT NULL,
  `nom_site` varchar(300) DEFAULT NULL,
  `icone` varchar(300) DEFAULT NULL,
  `tel1` varchar(300) DEFAULT NULL,
  `tel2` varchar(300) DEFAULT NULL,
  `adresse` text,
  `facebook` varchar(600) DEFAULT NULL,
  `twitter` varchar(600) DEFAULT NULL,
  `linkedin` varchar(600) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `termes` text,
  `confidentialite` text,
  `description` text,
  `mission` text,
  `objectif` text,
  `blog` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tbl_info`
--

INSERT INTO `tbl_info` (`idinfo`, `nom_site`, `icone`, `tel1`, `tel2`, `adresse`, `facebook`, `twitter`, `linkedin`, `email`, `termes`, `confidentialite`, `description`, `mission`, `objectif`, `blog`) VALUES
(1, 'Match compétition', '594671978.jpg', '+243817883541', '+243970524665', 'RDC Nord-kivu goma quartier  1 km temoin', 'https://facebook.com/', 'https://twitter.com/', 'https://linkedin.com/', 'info@match-professionnel.com', 'Notre Politique de protection des données personnelles décrit la manière dont #devtech traite les données à caractère personnel des visiteurs et des utilisateurs (ci- après les « Utilisateurs ») lors de leur navigation sur notre site. La Politique de protection des données personnelles fait partie intégrante des Conditions Générales d\'Utilisation du Site.\r\n#devtech accorde en permanence une attention aux données de nos Utilisateurs. Nous pouvons ainsi être amenés à modifier, compléter ou mettre à jour périodiquement la Politique de protection des données personnelles. Nous pourrons aussi apporter des modifications nécessaires afin de respecter les changements de la législation et règlementation en vigueur. Dans la mesure du possible, nous vous notifierons tout changement important. Nous vous encourageons toutefois à consulter régulièrement la dernière version en vigueur, accessible sur notre Site.\r\n', 'Conditions Générales d\'Utilisation\r\nDéfinitions\r\nLes Parties conviennent et acceptent que les termes suivants utilisés avec une majuscule, au singulier et/ou au pluriel, auront, dans le cadre des présentes Conditions Générales d\'Utilisation, la signification définie ci-après :\r\n?« Contrat » : désigne les présentes Conditions Générales d\'Utilisation ainsi que la Politique de protection des données personnelles ;\r\n?« Membre » : désigne indifféremment le Membre Freemium et le Membre Premium ;\r\n?« Membre Freemium » désigne le membre ayant un compte sur notre Plateforme pour accéder aux fonctionnalités gratuites de notre Plateforme ;\r\n?« Membre Premium » désigne le membre ayant un compte sur notre Plateforme pour accéder aux services Premium Solo ou Plus ;\r\n?« Plateforme » : plateforme numérique de type site Web et/ou application mobile permettant l\'accès au Service ainsi que son utilisation ;\r\n?« Utilisateur » : désigne toute personne qui utilise la Plateforme, qu\'elle soit un Visiteur ou un Membre ;\r\n?« Visiteur » : désigne toute personne, internaute, naviguant sur la Plateforme sans création de compte associé.\r\nLes présentes Conditions Générales d\'Utilisation (ci-après les \"CGU\") régissent nos rapports avec vous, personne accédant à la Plateforme, applicables durant votre utilisation de la Plateforme et, si vous êtes un Membre jusqu\'à désactivation de votre compte. Si vous n\'êtes pas d\'accord avec les termes des CGU il vous est vivement recommandé de ne pas utiliser notre Plateforme et nos services.\r\nEn naviguant sur la Plateforme, si vous êtes un Visiteur, vous reconnaissez avoir pris connaissance et accepté l\'intégralité des présentes CGU et notre Politique de protection des données personnelles.\r\nEn créant un compte en cliquant sur le bouton « S\'inscrire avec Facebook » ou « Inscription avec un email » ou « S\'inscrire avec Google » pour devenir Membre, vous êtes invité à lire et accepter les présentes CGU et la Politique de protection des données personnelles, en cochant la case prévue à cet effet.\r\nNous vous encourageons à consulter les « Conditions Générales d\'Utilisation et la Politique de protection des données personnelles » avant votre première utilisation de notre Plateforme et régulièrement lors de leurs mises à jour. Nous pouvons en effet être amenés à modifier les présentes CGU. Si des modifications sont apportées, nous vous informerons par email ou via notre Plateforme pour vous permettre d\'examiner les modifications avant qu\'elles ne prennent effet. Si vous continuez à utiliser notre Plateforme après la publication ou l\'envoi d\'un avis concernant les modifications apportées aux présentes conditions, cela signifie que vous acceptez les mises à jour. Les CGU qui vous seront opposables seront celles en vigueur lors de votre utilisation de la Plateforme.\r\nArticle 1. Inscription au service\r\n1.1 Conditions d\'inscription à la Plateforme\r\nCertaines fonctionnalités de la Plateforme nécessitent d\'être inscrit et d\'obtenir un compte. Avant de pouvoir vous inscrire sur la Plateforme vous devez avoir lu et accepté les présentes CGU et la Politique de protection des données personnelles.\r\nVous déclarez avoir la capacité d\'accepter les présentes conditions générales d\'utilisation, c\'est-à-dire avoir plus de 16 ans et ne pas faire l\'objet d\'une mesure de protection juridique des majeurs (mise sous sauvegarde de justice, sous tutelle ou sous curatelle).\r\nAvant d\'accéder à notre Plateforme, le consentement des mineurs de moins de 16 ans doit être donné par le titulaire de l\'autorité parentale.\r\nNotre Plateforme ne prévoit aucunement l\'inscription, la collecte ou le stockage de renseignement relatifs à toute personne âgée de 15 ans ou moins.\r\n1.2 Création de compte\r\nVous pourrez créer un compte des deux manières suivantes :\r\n?Soit remplir manuellement, sur notre Plateforme, les champs obligatoires figurant sur le formulaire d\'inscription, à l\'aide d\'informations complètes et exactes. ', 'Développeurs des technologies(#devtech) est une startup qui vise à promouvoir l\'intégrité de la jeunesse en appliquant la technologie afin de permettre  l\'émergence  de la société.', 'la startup devetech vise à apporter des solutions efficaces grâce à la nouvelle  technologie pour palier contre les différents  problèmes que rencontre la société  suite au manquement d\'une meilleure technologie adaptée à leur besoin.', 'Réduire le taux des difficultés que rencontre  la société suite au manquement d\'une  meilleure solution technologique appropriée à leur problématique au pourcentage le plus bas possible jamais atteint!', 'Devetech est une  startup qui vise à promouvoir  l\'intégrité des jeunes en appliquant la technologie  pour permettre l\'avancement de la société.\r\nNotre contribution dans la société est le faite de voir comment la jeunesse progresse  mieux  en contribuant  aux différents aspects qui aident la société  à s\'en sortir dans le Cao.\r\nLa technologie dont nous parlons fera en sorte de contribuer  à l\'émergence de toute la jeunesse et la société en particulier.\r\nNous devons considérer la technologie actuelle comme une arme  efficace pour changer le monde.\r\n \r\n');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(300) DEFAULT NULL,
  `last_name` varchar(300) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `image` varchar(300) DEFAULT NULL,
  `telephone` varchar(300) DEFAULT NULL,
  `full_adresse` text,
  `biographie` text,
  `date_nais` date DEFAULT NULL,
  `passwords` varchar(300) DEFAULT NULL,
  `idrole` int(11) NOT NULL,
  `sexe` varchar(30) DEFAULT NULL,
  `facebook` varchar(900) DEFAULT NULL,
  `linkedin` varchar(900) DEFAULT NULL,
  `twitter` varchar(900) DEFAULT NULL,
  `idposte` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `image`, `telephone`, `full_adresse`, `biographie`, `date_nais`, `passwords`, `idrole`, `sexe`, `facebook`, `linkedin`, `twitter`, `idposte`) VALUES
(7, 'sumaili shabani', 'roger patrona', 'sumailiroger681@gmail.com', '1959189535.jpg', '+243817883541', 'tmk goma avenue mushanganya n°59', '<b>                                    Développeur</b> et <b>entrepreneur</b> en temps plein!                                    ', '1998-08-12', '9db09d6ae665e42340ef0b1ef1eb95b4', 1, 'M', 'https://www.facebook.com/patronat.shabanisumaili.9/', 'https://www.linkedin.com/in/sumaili-shabani-roger-patr%C3%B4na-7426a71a1/', 'https://twitter.com/RogerPatrona', 1),
(8, 'siwa', 'carlin', 'admin@gmail.com', 'icone-user.png', '', 'Goma himbi', NULL, '2000-09-07', 'e10adc3949ba59abbe56e057f20f883e', 1, 'M', '', '', '', 1),
(9, 'alpha blonde', 'cubaka', 'alpha@gmail.com', '475946374.jpg', '0998765432', 'Nord-kivu goma', 'Le gars de la planète', '1997-04-13', 'e10adc3949ba59abbe56e057f20f883e', 3, 'M', 'https://facebook.com/', 'https://linkedin.com/', 'https://twitter.com/', 1),
(11, 'yuma kayanda', 'françois', 'yuma@gmail.com', '1354714945.JPG', '+243817883541', 'goma katoyi', 'Dieu est grand!', '2021-09-07', 'e10adc3949ba59abbe56e057f20f883e', 2, 'M', 'https://facebook.com/', 'https://linkedin.com/', 'https://twitter.com/', 1),
(12, 'kasumba kipundula', 'bertin', 'kasumba@gmail.com', 'icone-user.png', '+243810409151', 'Quartier birere', NULL, '1999-04-13', 'e10adc3949ba59abbe56e057f20f883e', 2, 'M', 'https://facebook.com/', 'https://linkedin.com/', 'https://twitter.com/', 1),
(13, 'mikah kalume', 'sefu', 'mikah@gmail.com', 'icone-user.png', '+243810409151', 'quartier katoyi avenue konde', NULL, '2021-04-13', 'e10adc3949ba59abbe56e057f20f883e', 2, 'M', '', '', '', 1),
(35, 'dembo pataule', 'apoline', 'apoline345@gmail.com', 'icone-user.png', '+243810409151', 'Goma quartier 2 lampes', NULL, '2000-09-07', NULL, 2, 'F', NULL, NULL, NULL, 1),
(36, 'cubaka mulume', 'alpha', 'alpha10@gmail.com', 'icone-user.png', '+243971061810', 'Goma quartier tmk', NULL, '1996-09-07', NULL, 2, 'M', NULL, NULL, NULL, 1),
(37, 'Gaëtan ', 'abiyo', 'abio@gmail.com', 'icone-user.png', '+243810409151', 'Goma quartier Mugunga', NULL, '2000-09-09', NULL, 2, 'M', NULL, NULL, NULL, 1),
(38, 'steven', NULL, 'stevenzambali@gmail.com', '102510396.jpg', NULL, NULL, NULL, NULL, '25d55ad283aa400af464c76d713c07ad', 1, NULL, NULL, NULL, NULL, 1),
(39, 'shekinah', NULL, 'shekinahmalekani@gmail.com', '1361120401.jpeg', NULL, NULL, NULL, NULL, '81dc9bdb52d04dc20036dbd8313ed055', 2, NULL, NULL, NULL, NULL, 1),
(40, 'Providencia', NULL, 'monadresse@gmail.com', 'icone-user.png', NULL, NULL, NULL, NULL, 'e807f1fcf82d132f9bb018ca6738a19f', 2, NULL, NULL, NULL, NULL, 1),
(41, 'Arsene', NULL, 'kikwayaarsene@gmail.com', 'icone-user.png', NULL, NULL, NULL, NULL, '81dc9bdb52d04dc20036dbd8313ed055', 3, NULL, NULL, NULL, NULL, 1),
(42, 'Andre', '', 'safariandre66@gmail.com', 'icone-user.png', '', '', '                  	                  ', '0000-00-00', '19984dcaea13176bbb694f62ba6b5b35', 1, NULL, '', '', '', 1),
(43, 'Paul', NULL, 'paulm@gmail.com', 'icone-user.png', NULL, NULL, NULL, NULL, '6c63212ab48e8401eaf6b59b95d816a9', 2, NULL, NULL, NULL, NULL, 1),
(44, 'MOISE', NULL, 'tmngango@gmail.com', 'icone-user.png', NULL, NULL, NULL, NULL, '8f64b81d1312158bae9618645c591ff8', 1, NULL, NULL, NULL, NULL, 1),
(45, 'siwa', NULL, 'siwamumberecarin1998@gmail.com', 'icone-user.png', NULL, NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, NULL, NULL, NULL, 1),
(46, 'BUGALE', 'CIRUHULA ', 'jehdaibg@gmail.com ', 'icone-user.png', '0991900843', 'ndosho\r\n', NULL, '1991-09-23', NULL, 2, 'M', NULL, NULL, NULL, 1),
(47, 'Admin siwa', NULL, 'admin1@gmail.com', 'icone-user.png', NULL, NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 2, NULL, NULL, NULL, NULL, 1),
(48, 'Arsene', 'Kikwaya', 'kik@gmail', 'icone-user.png', '+243995903051', 'Goma', NULL, '1995-07-08', NULL, 2, 'M', NULL, NULL, NULL, 1),
(49, 'Jean', 'Marc', 'arc@gmail.com', 'icone-user.png', '+24399899878', '', NULL, '1990-02-11', NULL, 2, 'M', '', '', '', 1),
(50, 'shady', NULL, 'shady@gnail.com', 'icone-user.png', NULL, NULL, NULL, NULL, '81dc9bdb52d04dc20036dbd8313ed055', 2, NULL, NULL, NULL, NULL, 1),
(51, 'olivier', NULL, 'olivier@gmail.com', 'icone-user.png', NULL, NULL, NULL, NULL, '81dc9bdb52d04dc20036dbd8313ed055', 2, NULL, NULL, NULL, NULL, 1),
(52, 'alain', NULL, 'alain@gmail.com', '2063661822.jpg', NULL, NULL, NULL, NULL, '81dc9bdb52d04dc20036dbd8313ed055', 2, NULL, NULL, NULL, NULL, 1),
(53, 'Josue isamuna', NULL, 'josamuna2009@gmail.com', '1536368378.html', NULL, NULL, NULL, NULL, '81dc9bdb52d04dc20036dbd8313ed055', 1, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la vue `profile_client`
--
DROP TABLE IF EXISTS `profile_client`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `profile_client`  AS  select `users`.`id` AS `id`,`users`.`first_name` AS `first_name`,`users`.`last_name` AS `last_name`,`users`.`email` AS `email`,`users`.`image` AS `image`,`users`.`telephone` AS `telephone`,`users`.`full_adresse` AS `full_adresse`,`users`.`biographie` AS `biographie`,`users`.`date_nais` AS `date_nais`,`users`.`idrole` AS `idrole`,`users`.`sexe` AS `sexe`,`users`.`facebook` AS `facebook`,`users`.`linkedin` AS `linkedin`,`users`.`twitter` AS `twitter` from `users` where (`users`.`idrole` = 2) ;

-- --------------------------------------------------------

--
-- Structure de la vue `profile_match`
--
DROP TABLE IF EXISTS `profile_match`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `profile_match`  AS  select `matchs`.`idmath` AS `idmath`,`matchs`.`nomMatch` AS `nomMatch`,`matchs`.`equipe1` AS `equipe1`,`matchs`.`equipe2` AS `equipe2`,`matchs`.`jour` AS `jour`,`matchs`.`heure` AS `heure`,`matchs`.`created_at` AS `created_at`,`equipe`.`nom` AS `nom_equipe1` from (`matchs` join `equipe` on((`matchs`.`equipe1` = `equipe`.`idequipe`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `profile_paiement`
--
DROP TABLE IF EXISTS `profile_paiement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `profile_paiement`  AS  select `paiement`.`idp` AS `idp`,`paiement`.`idpersonne` AS `idpersonne`,`paiement`.`date_paie` AS `date_paie`,`paiement`.`montant` AS `montant`,`paiement`.`motif` AS `motif`,`paiement`.`token` AS `token`,`paiement`.`created_at` AS `created_at`,`paiement`.`codeFacture` AS `codeFacture`,`paiement`.`etat_paiement` AS `etat_paiement`,`users`.`first_name` AS `first_name`,`users`.`last_name` AS `last_name`,`users`.`email` AS `email`,`users`.`telephone` AS `telephone`,`users`.`image` AS `image`,`users`.`id` AS `id` from (`paiement` join `users` on((`paiement`.`idpersonne` = `users`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `profile_place`
--
DROP TABLE IF EXISTS `profile_place`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `profile_place`  AS  select `place`.`idplace` AS `idplace`,`place`.`idstade` AS `idstade`,`place`.`nomPlace` AS `nomPlace`,`place`.`created_at` AS `created_at`,`stade`.`nom` AS `nom` from (`place` join `stade` on((`place`.`idstade` = `stade`.`idstade`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `profile_reservation`
--
DROP TABLE IF EXISTS `profile_reservation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `profile_reservation`  AS  select `reservation`.`idreservation` AS `idreservation`,`reservation`.`idclient` AS `idclient`,`reservation`.`idmath` AS `idmath`,`reservation`.`montant` AS `montant`,`reservation`.`created_at` AS `created_at`,`reservation`.`idstade` AS `idstade`,`reservation`.`idplace` AS `idplace`,`reservation`.`etat_reservation` AS `etat_reservation`,`users`.`first_name` AS `first_name`,`users`.`last_name` AS `last_name`,`users`.`image` AS `image`,`reservation`.`codeReservation` AS `codeReservation`,`users`.`telephone` AS `telephone`,`users`.`email` AS `email`,`matchs`.`nomMatch` AS `nomMatch`,`matchs`.`equipe1` AS `equipe1`,`matchs`.`jour` AS `jour`,`matchs`.`equipe2` AS `equipe2`,`matchs`.`heure` AS `heure`,`stade`.`nom` AS `nomStade`,`place`.`nomPlace` AS `nomPlace`,`equipe`.`nom` AS `nomEquipe` from (((((`reservation` join `users` on((`reservation`.`idclient` = `users`.`id`))) join `matchs` on((`reservation`.`idmath` = `matchs`.`idmath`))) join `stade` on((`reservation`.`idstade` = `stade`.`idstade`))) join `place` on((`reservation`.`idplace` = `place`.`idplace`))) join `equipe` on((`matchs`.`equipe1` = `equipe`.`idequipe`))) ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`idequipe`);

--
-- Index pour la table `matchs`
--
ALTER TABLE `matchs`
  ADD PRIMARY KEY (`idmath`),
  ADD KEY `equipe1` (`equipe1`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `online`
--
ALTER TABLE `online`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`idp`),
  ADD KEY `idpersonne` (`idpersonne`);

--
-- Index pour la table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`idplace`),
  ADD KEY `idstade` (`idstade`);

--
-- Index pour la table `recupere`
--
ALTER TABLE `recupere`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`idreservation`),
  ADD KEY `idclient` (`idclient`),
  ADD KEY `idmath` (`idmath`),
  ADD KEY `idstade` (`idstade`),
  ADD KEY `idplace` (`idplace`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idrole`);

--
-- Index pour la table `stade`
--
ALTER TABLE `stade`
  ADD PRIMARY KEY (`idstade`);

--
-- Index pour la table `tbl_info`
--
ALTER TABLE `tbl_info`
  ADD PRIMARY KEY (`idinfo`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idrole` (`idrole`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `idequipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `matchs`
--
ALTER TABLE `matchs`
  MODIFY `idmath` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT pour la table `online`
--
ALTER TABLE `online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `place`
--
ALTER TABLE `place`
  MODIFY `idplace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `recupere`
--
ALTER TABLE `recupere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `idreservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `idrole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `stade`
--
ALTER TABLE `stade`
  MODIFY `idstade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `tbl_info`
--
ALTER TABLE `tbl_info`
  MODIFY `idinfo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `matchs`
--
ALTER TABLE `matchs`
  ADD CONSTRAINT `matchs_ibfk_1` FOREIGN KEY (`equipe1`) REFERENCES `equipe` (`idequipe`) ON DELETE CASCADE;

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `online`
--
ALTER TABLE `online`
  ADD CONSTRAINT `online_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`idpersonne`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `place`
--
ALTER TABLE `place`
  ADD CONSTRAINT `place_ibfk_1` FOREIGN KEY (`idstade`) REFERENCES `stade` (`idstade`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`idmath`) REFERENCES `matchs` (`idmath`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`idstade`) REFERENCES `stade` (`idstade`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_4` FOREIGN KEY (`idplace`) REFERENCES `place` (`idplace`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`idrole`) REFERENCES `role` (`idrole`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
