-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 26 oct. 2020 à 17:32
-- Version du serveur :  10.3.25-MariaDB
-- Version de PHP : 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `kgsexpress_pfe`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  `ville` varchar(30) DEFAULT NULL,
  `codePostale` varchar(8) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `nom`, `prenom`, `email`, `telephone`, `adresse`, `ville`, `codePostale`, `image`, `password`, `created_at`, `updated_at`) VALUES
(1, 'hssini', 'med amine k', 'hamza.dammak@gmail.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$3ahanhSK6gCSRs/FZ69vQ.ErkuVPpabslMjjbFzA/BthQaNdLR9H2', '2020-02-10 13:05:13', '2020-04-10 12:44:33'),
(12, 'Houssem', 'Hammami', 'houssem.Hammami@gmail.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$yn3B/DeHL294ZBQNpDlTL.x5vwvFzhQhMV7c3JWA8xAdL7gDdURHy', '2020-06-17 12:09:12', '2020-06-17 12:09:34'),
(5, 'hssini', 'med amine', 'ssinih@hssini.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$XFcwiVEYXTmvJdKh4Zljbec/M8MpVETCegNdzRSHT8oZ38U0qs6HO', '2020-02-15 15:00:41', '2020-06-11 14:06:12'),
(6, 'hssini', 'med amine', 'hssini@hssini.com', '29472994', 'rte manzel chaker kl 12', 'Sfax', '3059', 'uploads/img/profile/1592257507.jpeg', '$2y$10$ckPDk237O/I7VACp1tYDvesrS0Hz.Yss99jrpSccMcZOSgafYgOLG', '2020-02-15 15:01:25', '2020-06-15 20:45:07'),
(11, 'Rim', 'Walha', 'rima.walha@gmail.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$liwguEYdAhaHed/fs3IxlOZzNsqWRKRzGyaJGT3Yh1zMNc7b4D.Ha', '2020-06-11 14:05:34', '2020-06-11 14:05:34');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_transporteur` int(11) DEFAULT NULL,
  `prix` double NOT NULL,
  `adresse` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ville` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_coupon` int(11) DEFAULT NULL,
  `statut` int(11) NOT NULL DEFAULT 0,
  `lat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `lng` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `temps` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `distance` double DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `id_user`, `id_transporteur`, `prix`, `adresse`, `ville`, `id_coupon`, `statut`, `lat`, `lng`, `temps`, `distance`, `updated_at`, `created_at`) VALUES
(1, 9, 2, 83.812, NULL, 'Sfax', NULL, 3, '34.799760060019', '10.64299012382', '01:00:08', 30.344, '2020-06-15 20:34:28', '2020-06-15 20:16:32'),
(2, 11, 2, 59.829, NULL, 'Sfax', 2, 3, '34.747270843592', '10.739991998094', '00:29:50', 10.458, '2020-06-16 22:24:26', '2020-06-16 21:10:06'),
(3, 12, 2, 39.4075, NULL, 'Sfax', 2, 3, '34.74591075721', '10.752716127722', '00:28:54', 10.019, '2020-06-16 22:25:04', '2020-06-16 22:20:52'),
(4, 13, 2, 20.353, NULL, 'Sfax', 2, 3, '34.8082201', '10.7055174', '00:44:03', 23.234, '2020-06-17 09:38:35', '2020-06-17 09:33:08'),
(5, 13, 2, 64.5565, NULL, 'sfax', NULL, 3, '34.8082201', '10.7055174', '00:47:32', 25.113, '2020-06-17 12:07:36', '2020-06-17 12:02:39'),
(6, 14, NULL, 6.238, NULL, 'Sfax', 2, 1, '34.74026085361', '10.753448978539', '00:15:03', 4.104, '2020-06-19 13:01:29', '2020-06-18 12:34:15'),
(7, 17, NULL, 46.8465, NULL, 'Sfax', NULL, 1, '34.797993320062', '10.644381607879', '01:01:34', 31.293, '2020-06-19 13:01:57', '2020-06-18 17:18:17'),
(8, 17, NULL, 46.4045, NULL, 'Sfax', 2, 1, '34.797993320062', '10.644381607879', '01:01:34', 31.293, '2020-06-19 13:01:58', '2020-06-19 13:00:00'),
(9, 18, NULL, 2188.2955, NULL, 'sfax', NULL, 1, '51.330942', '12.4078572', '71:26:56', 4319.391, '2020-06-19 13:07:20', '2020-06-19 13:06:07'),
(10, 17, NULL, 55.171, NULL, 'Sfax', 2, 1, '34.797993320062', '10.644381607879', '01:00:23', 36.814, '2020-06-19 13:12:54', '2020-06-19 13:12:15'),
(11, 17, NULL, 33.655, NULL, 'Sfax Sud', 4, 1, '34.797993320062', '10.644381607879', '00:58:57', 29.87, '2020-06-19 13:14:50', '2020-06-19 13:13:32'),
(12, 17, NULL, 21.397, NULL, 'Sfax Sud', 2, 1, '34.794853075328', '10.648097537867', '00:57:02', 28.234, '2020-06-19 13:17:30', '2020-06-19 13:16:45'),
(13, 17, NULL, 38.3665, NULL, 'Sfax Sud', 2, 1, '34.794853075328', '10.648097537867', '01:02:53', 30.505, '2020-06-19 13:25:06', '2020-06-19 13:24:18');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_repas` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `id_user`, `id_repas`, `note`, `updated_at`, `created_at`) VALUES
(2, 9, 10, 4, '2020-06-08 21:44:07', '2020-06-08 19:48:02'),
(3, 9, 6, 4, '2020-06-08 22:09:24', '2020-06-08 19:49:57'),
(4, 9, 11, 3, '2020-06-08 22:09:23', '2020-06-08 19:49:58'),
(5, 9, 8, 5, '2020-06-09 20:12:29', '2020-06-09 20:12:29'),
(6, 9, 9, 5, '2020-06-09 20:12:47', '2020-06-09 20:12:31'),
(7, 10, 6, 5, '2020-06-11 14:43:34', '2020-06-11 14:43:34'),
(8, 10, 8, 2, '2020-06-11 14:43:35', '2020-06-11 14:43:35'),
(9, 10, 9, 4, '2020-06-11 14:43:36', '2020-06-11 14:43:36'),
(10, 12, 6, 3, '2020-06-16 22:25:24', '2020-06-16 22:25:24'),
(11, 12, 10, 5, '2020-06-16 22:25:25', '2020-06-16 22:25:25'),
(12, 12, 16, 3, '2020-06-16 22:25:28', '2020-06-16 22:25:28'),
(13, 12, 14, 5, '2020-06-16 22:25:29', '2020-06-16 22:25:29'),
(14, 13, 8, 5, '2020-06-17 12:08:03', '2020-06-17 09:39:35'),
(15, 13, 10, 5, '2020-06-17 12:07:59', '2020-06-17 12:07:59'),
(16, 13, 6, 3, '2020-06-17 12:07:59', '2020-06-17 12:07:59');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sujet` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `prenom`, `email`, `sujet`, `message`, `telephone`, `created_at`) VALUES
(1, 'Barga', 'Richard', 'kilkil123@yopmail.com', 'eded', 'zzzzzzzzzzzzzzzzzzz', '015224730470', '2020-03-14 20:42:44'),
(2, 'Barga', 'Richard', 'kilkil123@yopmail.com', 'eded', 'zzzzzzzzzzzzzzzzzzzz', '015224730470', '2020-03-14 20:57:05'),
(3, 'Barga', 'Richard', 'kilkil123@yopmail.com', 'eded', '&&&&&&&&&&&&&&&&&&', '015224730470', '2020-03-14 20:58:28'),
(4, 'yyyyy', 'yyyyy', 'yyyyyyyyyy@hg', 'gggg', 'ggggggggggggggggggggggggggg', 'yyyyyyyyy', '2020-03-15 15:36:18'),
(5, 'Barga', 'Richard', 'kilkil123@yopmail.com', 'eded', 'zzzzzzzzzzz', '015224730470', '2020-03-15 15:48:26'),
(6, 'chila', 'kila', 'alee@saabscania.tk', 'zzzzzz', 'zzzzzzzzzzz', '0987671325', '2020-03-18 15:51:41'),
(7, 'chila', 'kila', 'alee@saabscania.tk', 'eded', 'aaaaaaaaaaaaaaaaaaaaa', '+33987671325', '2020-03-18 18:18:41'),
(8, 'Barga', 'Richard', 'kilkil123@yopmail.com', 'ffff', 'ffffffffffffff', '015224730470', '2020-05-27 12:27:12'),
(9, 'dzdz', 'zdzd', 'zdzdz@hgfd', 'gfdsq', 'zdddddddddddddddddddddd', '20154214', '2020-06-11 13:55:45');

-- --------------------------------------------------------

--
-- Structure de la table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `remise` int(11) NOT NULL,
  `date_fin` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `remise`, `date_fin`, `created_at`) VALUES
(4, 'KgsExprese2020', 10, '2020-06-30', '2020-06-11 14:06:16'),
(2, 'HssiniRemisePFE', 65, '2020-07-08', '2020-05-05 13:25:44');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` int(20) UNSIGNED NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `codePostale` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `image` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `nom`, `prenom`, `email`, `email_verified_at`, `password`, `adresse`, `telephone`, `ville`, `codePostale`, `type`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Hssini', 'med amine', 'hssini1@hssini.com', NULL, '$2y$10$3T1CJzgr1I05iykRMRw2Ve7SwPY.7.JERJILcTCLH52mHXLuxRUd.', 'rte manzel chakir klm 12', '+21629472994', 'sfax', 3059, 0, 'uploads/img/profile/1590526201.jpg', '2020-04-15 13:20:11', '2020-06-21 21:52:08'),
(2, 'walid', 'kraim', 'walid.kraim@gmail.com', NULL, '$2y$10$3T1CJzgr1I05iykRMRw2Ve7SwPY.7.JERJILcTCLH52mHXLuxRUd.', 'sfax', '25147856', 'sfax', 3020, 1, 'uploads/img/profile/1592256608.jpg', NULL, '2020-06-15 20:30:08');

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `id_repas` int(11) NOT NULL,
  `etat` int(11) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id`, `id_commande`, `id_repas`, `etat`, `updated_at`, `created_at`) VALUES
(1, 1, 9, 1, '2020-06-15 20:25:34', '2020-06-15 21:16:32'),
(2, 1, 8, 1, '2020-06-15 20:25:34', '2020-06-15 21:16:32'),
(3, 1, 10, 1, '2020-06-15 20:30:59', '2020-06-15 21:16:32'),
(4, 1, 6, 1, '2020-06-15 20:30:59', '2020-06-15 21:16:32'),
(5, 2, 10, 1, '2020-06-16 21:12:51', '2020-06-16 22:10:06'),
(6, 2, 14, 1, '2020-06-16 21:12:51', '2020-06-16 22:10:06'),
(7, 2, 28, 1, '2020-06-16 21:12:51', '2020-06-16 22:10:06'),
(8, 2, 9, 1, '2020-06-16 21:10:55', '2020-06-16 22:10:06'),
(9, 3, 6, 1, '2020-06-16 22:22:16', '2020-06-16 23:20:52'),
(10, 3, 14, 1, '2020-06-16 22:22:16', '2020-06-16 23:20:52'),
(11, 3, 16, 1, '2020-06-16 22:21:39', '2020-06-16 23:20:52'),
(12, 3, 10, 1, '2020-06-16 22:22:16', '2020-06-16 23:20:52'),
(13, 4, 8, 1, '2020-06-17 09:34:46', '2020-06-17 10:33:09'),
(14, 5, 6, 1, '2020-06-17 12:04:33', '2020-06-17 13:02:39'),
(15, 5, 10, 1, '2020-06-17 12:04:33', '2020-06-17 13:02:39'),
(16, 5, 8, 1, '2020-06-17 12:03:58', '2020-06-17 13:02:39'),
(17, 6, 13, 1, '2020-06-19 13:01:29', '2020-06-18 13:34:15'),
(18, 6, 8, 1, '2020-06-19 13:01:29', '2020-06-18 13:34:15'),
(19, 7, 6, 1, '2020-06-19 13:01:57', '2020-06-18 18:18:17'),
(20, 7, 8, 1, '2020-06-19 13:01:29', '2020-06-18 18:18:17'),
(21, 7, 11, 1, '2020-06-19 13:01:57', '2020-06-18 18:18:17'),
(22, 8, 6, 1, '2020-06-19 13:01:58', '2020-06-19 14:00:00'),
(23, 8, 12, 1, '2020-06-19 13:01:58', '2020-06-19 14:00:00'),
(24, 8, 9, 1, '2020-06-19 13:01:28', '2020-06-19 14:00:00'),
(25, 8, 8, 1, '2020-06-19 13:01:28', '2020-06-19 14:00:00'),
(26, 8, 10, 1, '2020-06-19 13:01:58', '2020-06-19 14:00:00'),
(27, 8, 16, 1, '2020-06-19 13:01:28', '2020-06-19 14:00:00'),
(28, 9, 6, 1, '2020-06-19 13:07:20', '2020-06-19 14:06:07'),
(29, 9, 28, 1, '2020-06-19 13:07:20', '2020-06-19 14:06:07'),
(30, 10, 6, 1, '2020-06-19 13:12:54', '2020-06-19 14:12:15'),
(31, 10, 11, 1, '2020-06-19 13:12:54', '2020-06-19 14:12:15'),
(32, 10, 12, 1, '2020-06-19 13:12:54', '2020-06-19 14:12:15'),
(33, 10, 15, 1, '2020-06-19 13:12:54', '2020-06-19 14:12:15'),
(34, 10, 18, 1, '2020-06-19 13:12:54', '2020-06-19 14:12:15'),
(35, 10, 17, 1, '2020-06-19 13:12:54', '2020-06-19 14:12:15'),
(36, 11, 6, 1, '2020-06-19 13:13:45', '2020-06-19 14:13:32'),
(37, 11, 8, 1, '2020-06-19 13:14:50', '2020-06-19 14:13:32'),
(38, 12, 6, 1, '2020-06-19 13:17:30', '2020-06-19 14:16:45'),
(39, 12, 8, 1, '2020-06-19 13:17:13', '2020-06-19 14:16:45'),
(40, 13, 6, 1, '2020-06-19 13:25:05', '2020-06-19 14:24:18'),
(41, 13, 8, 1, '2020-06-19 13:24:41', '2020-06-19 14:24:18'),
(42, 13, 10, 1, '2020-06-19 13:25:06', '2020-06-19 14:24:18'),
(43, 13, 11, 1, '2020-06-19 13:25:06', '2020-06-19 14:24:18'),
(44, 13, 13, 1, '2020-06-19 13:24:42', '2020-06-19 14:24:18');

-- --------------------------------------------------------

--
-- Structure de la table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('000a0924926473e1baff4f3ade72ea8b4527a9475dddc139c360cde77b3a9b0a15a5284d5669cd94', 6, 1, 'LoginUser', '[]', 0, '2020-03-18 20:35:49', '2020-03-18 20:35:49', '2021-03-18 21:35:49'),
('02c3b471782529636aee70f6a2d18078641a782caeaaece1da0fb591153b45522d14e80c8a0e3532', 1, 1, 'LoginUser', '[]', 0, '2020-02-15 17:42:05', '2020-02-15 17:42:05', '2021-02-15 18:42:05'),
('06b20983881008938941d815b64a473383d0aef79269e3ce274f6f61a18c6b49efd3af63e6f5ed63', 17, 1, 'LoginUser', '[]', 0, '2020-06-18 17:17:52', '2020-06-18 17:17:52', '2021-06-18 18:17:52'),
('0954b6795d7b70b7bf85cf95229b1e508d4f78ba492ff692fa3e109e0e249ede9160b4084b83beac', 19, 1, 'RegisterToken', '[]', 0, '2020-06-24 14:22:03', '2020-06-24 14:22:03', '2021-06-24 15:22:03'),
('0afd2fb20d617a93f5027cef8d5dd9d9ac0326094ad881df113e3b9ce9195fda470f37dd50f40411', 15, 1, 'RegisterToken', '[]', 0, '2020-06-18 13:12:34', '2020-06-18 13:12:34', '2021-06-18 14:12:34'),
('0cee5244ae6ed4aee2488e2cce01804e09247c0b7a1ec2cc554a1a58fffe89bd6d7cc8c525552cf3', 6, 1, 'LoginUser', '[]', 0, '2020-02-15 16:04:36', '2020-02-15 16:04:36', '2021-02-15 17:04:36'),
('0e38bb5deb79499ccebe95cb3bc0fbe00f30fed16eb086e291127a7835b642943ac514ca79c5d864', 10, 1, 'LoginUser', '[]', 0, '2020-06-11 14:31:10', '2020-06-11 14:31:10', '2021-06-11 15:31:10'),
('0f23bab9cac8937c5fed7608bb4cb764ae957d8de65af80c9605a67c1cf6d4665e8666d9891c62c8', 9, 1, 'LoginUser', '[]', 0, '2020-06-09 11:30:15', '2020-06-09 11:30:15', '2021-06-09 12:30:15'),
('10be8f6cdcc322f021e4fb444c1073a830bb6d5363e55010c06fb0d63b839338b909690b0d07a524', 6, 1, 'RegisterToken', '[]', 0, '2020-02-15 16:01:26', '2020-02-15 16:01:26', '2021-02-15 17:01:26'),
('166b11710ea50fd399d88752bfdbdd0833f6cea799513e373c416bb9f19a1b05e870b8b327ad0bae', 5, 1, 'LoginUser', '[]', 0, '2020-02-15 17:41:35', '2020-02-15 17:41:35', '2021-02-15 18:41:35'),
('187eff8b5c85f0bc857aa3550eedc6f4b8702cc8bc9741b8ab53e708942b72197115fa61dc93c382', 9, 1, 'LoginUser', '[]', 0, '2020-06-13 20:14:37', '2020-06-13 20:14:37', '2021-06-13 21:14:37'),
('18cb0af205c1fe9fc4ea3de23de0ebda7f6cea352b5df23186ab007d007f95483a949a1ace5c8c54', 6, 1, 'LoginUser', '[]', 0, '2020-03-18 19:29:42', '2020-03-18 19:29:42', '2021-03-18 20:29:42'),
('1aa0e2bdfef42a31446f66cbf045faf443a6bae195eb6a274f8120f55fd43337621913f02300cf57', 15, 1, 'LoginUser', '[]', 0, '2020-06-18 13:13:43', '2020-06-18 13:13:43', '2021-06-18 14:13:43'),
('1dba5537291a5777389c613fe15e1a8bbb0a4c09a2577b2c578ec343ee0371e71c04ee7d1b8914f7', 9, 1, 'LoginUser', '[]', 0, '2020-05-31 11:05:49', '2020-05-31 11:05:49', '2021-05-31 12:05:49'),
('2128285e1362c42999b4b6038c5b30c82fde8734918cd4b387d97abefaf1c923a8c16b5b915bf189', 14, 1, 'LoginUser', '[]', 0, '2020-06-18 12:33:27', '2020-06-18 12:33:27', '2021-06-18 13:33:27'),
('238e67350e80714e6fba7a713e9519bd974831462f697889d92d0e655d3889fa7fdff5d01bea9b9a', 5, 1, 'RegisterToken', '[]', 0, '2020-02-15 16:00:44', '2020-02-15 16:00:44', '2021-02-15 17:00:44'),
('2aec6a7bee5f40d4bf17e1158fb0aeec14ca1b1a6ced33e5401915126c9a0df3f04fde184629ca5c', 16, 1, 'RegisterToken', '[]', 0, '2020-06-18 16:26:52', '2020-06-18 16:26:52', '2021-06-18 17:26:52'),
('2d0c79500a13c2fff17a0a5384f1a4c58196c68827c989ec9b0c4c6370b380a03013d12f9b8170e6', 12, 1, 'RegisterToken', '[]', 0, '2020-06-16 22:19:26', '2020-06-16 22:19:26', '2021-06-16 23:19:26'),
('3196e3eaaafe66f737eb68f9b07492ec82fc88ba78b6cbbf98b0a9cc2f8ee7b48c41cca7a2c09d29', 1, 2, NULL, '[]', 0, '2020-02-11 20:45:15', '2020-02-11 20:45:15', '2021-02-11 21:45:15'),
('320d1392b5b47e004eb10ce14ec622de902d13a2f4a3d569bce0f191047dacd1181c62c4dd7f5830', 6, 1, 'LoginUser', '[]', 0, '2020-03-19 11:46:08', '2020-03-19 11:46:08', '2021-03-19 12:46:08'),
('3e0f4b9ea1712ded061cb6a5c54d3567dbc16cd4eec9b63f2cdd05f0eedddac507880016df7b841b', 18, 1, 'RegisterToken', '[]', 0, '2020-06-19 13:01:33', '2020-06-19 13:01:33', '2021-06-19 14:01:33'),
('47473d438b48e9069273ed7f8beeebaba7ca65ff75f2097f7f0b751c931c9de75bff0a6133c5cb6f', 13, 1, 'RegisterToken', '[]', 0, '2020-06-17 09:30:39', '2020-06-17 09:30:39', '2021-06-17 10:30:39'),
('4dba13d1d0cc063da904995f7fdb8ab33e0d02710a127d6e0dcff63bd5751fac6882717170c5103d', 9, 1, 'LoginUser', '[]', 0, '2020-06-11 11:47:48', '2020-06-11 11:47:48', '2021-06-11 12:47:48'),
('5124792b07eb28cec845f5a027a60170a1259e4b489eaf8c7a4def7c21664799fafbaf79031fec01', 4, 2, NULL, '[]', 0, '2020-02-11 21:30:08', '2020-02-11 21:30:08', '2021-02-11 22:30:08'),
('530f09a974bc5d09ab329f69348fff6dd2f395c569080cf6539aa0a4b15bb7e6135d548d38514f86', 9, 1, 'LoginUser', '[]', 0, '2020-06-03 09:22:59', '2020-06-03 09:22:59', '2021-06-03 10:22:59'),
('53c9a34064ea2319de4b30a4f3501033978ec63f49baf684207386ebdfca29efefd9f93af233cc5b', 9, 1, 'LoginUser', '[]', 0, '2020-06-03 09:28:25', '2020-06-03 09:28:25', '2021-06-03 10:28:25'),
('5419493f61b95e454bcee13ea9c7e6ae16527995bdb484cefc7b403ab197c5cefe46dd244377e0bc', 9, 1, 'LoginUser', '[]', 0, '2020-06-09 14:24:54', '2020-06-09 14:24:54', '2021-06-09 15:24:54'),
('5b66cff2e24f1276c51b33b11c5845104a356054c361b29bb928939c49dd99dc7d7afc331b28c426', 10, 1, 'RegisterToken', '[]', 0, '2020-06-11 14:30:35', '2020-06-11 14:30:35', '2021-06-11 15:30:35'),
('635aa6abb18a58816659179ad80132c4a94fc8528c1f5c90d63c7cedeebbc44eaf3a79fb92e74b41', 1, 2, NULL, '[]', 0, '2020-02-12 19:28:07', '2020-02-12 19:28:07', '2021-02-12 20:28:07'),
('6669ea781f3192b203b1e9be8806408e3b9f596727db6256cdf915a07e794a39926c260fb9942a5e', 13, 1, 'LoginUser', '[]', 0, '2020-06-17 09:31:20', '2020-06-17 09:31:20', '2021-06-17 10:31:20'),
('69570b5ef7613e2460b9899811c847a03063463cf8397ffed67af3006233d78e22e57dcf3cbfeb35', 6, 1, 'LoginUser', '[]', 0, '2020-04-06 20:22:48', '2020-04-06 20:22:48', '2021-04-06 21:22:48'),
('73a63f3c7145df04a4ba7243824c2e8fcbc099ae6a24220542b6b5ff9b25fedcae9cb2f825fa85c0', 6, 1, 'LoginUser', '[]', 0, '2020-03-29 18:53:20', '2020-03-29 18:53:20', '2021-03-29 19:53:20'),
('757fc74c074f03c4c925121c6eee485d4686746a5bab4184f69c4e6f19a916684b19b2cb217c58eb', 11, 1, 'LoginUser', '[]', 0, '2020-06-16 21:08:38', '2020-06-16 21:08:38', '2021-06-16 22:08:38'),
('77dbae41d4411ab61d6ded7e20d1d9c67dd08ea21e14379211b217d5512e4d06e2e4a15a504d447d', 17, 1, 'RegisterToken', '[]', 0, '2020-06-18 17:17:35', '2020-06-18 17:17:35', '2021-06-18 18:17:35'),
('8c8346348857eacfd6b19d619854d5a5ab1b77875444cec8eb607b5e1ee7d42f9862ecf362e0c5a7', 13, 1, 'LoginUser', '[]', 0, '2020-06-17 10:37:12', '2020-06-17 10:37:12', '2021-06-17 11:37:12'),
('8d25a6ff3d5d08019b5031b01f47a66fea509f49e79a58f2a12452cc3b78fdb3f9d2771196d83a59', 1, 1, 'LoginUser', '[]', 0, '2020-02-15 17:55:55', '2020-02-15 17:55:55', '2021-02-15 18:55:55'),
('9fe293b56c7755d9c3f8653c075569824e57e1ee0dedbf7cfe43293c18364f37ac4744fe341db4ab', 9, 1, 'LoginUser', '[]', 0, '2020-06-11 13:01:33', '2020-06-11 13:01:33', '2021-06-11 14:01:33'),
('a4181eefe149535badcdf9d9a0f827d2a6d00e8223c1d87c5467b0ac6ef56e53cfcf76683ca4ee2e', 8, 1, 'RegisterToken', '[]', 0, '2020-05-27 12:30:59', '2020-05-27 12:30:59', '2021-05-27 13:30:59'),
('ad53e2bba9007811117e673a82bab791bea7c6671b582fa42c37043a13508cf0d9b9ff3f5f55701e', 9, 1, 'LoginUser', '[]', 0, '2020-06-03 09:49:45', '2020-06-03 09:49:45', '2021-06-03 10:49:45'),
('ae7bb531d5988c54b07080d15aff2116b81dca7b50008731b34eaa835283b7ed5ebe59dd77ee1b17', 1, 2, NULL, '[]', 0, '2020-02-12 11:01:20', '2020-02-12 11:01:20', '2021-02-12 12:01:20'),
('ae978c1a0597adb386204e3707e109e5e57385bf08739fb7f8f2ac62039da911691b7e8edd129eb3', 12, 1, 'LoginUser', '[]', 0, '2020-06-16 22:19:53', '2020-06-16 22:19:53', '2021-06-16 23:19:53'),
('bbba8978014faeaf8b24879e4484181209177eec30216a484b8d6bb66c92473a7a89a7b49e279f2c', 1, 1, 'LoginUser', '[]', 0, '2020-02-15 17:38:20', '2020-02-15 17:38:20', '2021-02-15 18:38:20'),
('be743c181d65434527d89fc6959bf85ca5318006b3e8fc9bdbfd1ce317d27866f57732030fd509d9', 9, 1, 'RegisterToken', '[]', 0, '2020-05-31 11:05:26', '2020-05-31 11:05:26', '2021-05-31 12:05:26'),
('bfc97c488ed0c88ce6af5208f1366ed97e485260d86b13cb34521d7ef7ff881ab59f47cfe7874840', 14, 1, 'RegisterToken', '[]', 0, '2020-06-18 12:33:17', '2020-06-18 12:33:17', '2021-06-18 13:33:17'),
('c5284a2671c20ee105cde5b19f19eb9b1f70da9e18ee50ef2d5392d4d3ea720f79d523896d485c34', 6, 1, 'LoginUser', '[]', 0, '2020-03-19 15:18:08', '2020-03-19 15:18:08', '2021-03-19 16:18:08'),
('c5d41f8d67bc21a8351ad695e729570034dd910cb06d61297961ad8115b7ac7080a24b779d29fc5b', 18, 1, 'LoginUser', '[]', 0, '2020-06-19 13:01:58', '2020-06-19 13:01:58', '2021-06-19 14:01:58'),
('c802ab5350b7596c2ad8d176a6241ab4a15880faae9eec401565205649cb36c0e10be905fe6bb18a', 6, 1, 'LoginUser', '[]', 0, '2020-02-15 16:05:29', '2020-02-15 16:05:29', '2021-02-15 17:05:29'),
('cb81ec6a22bbac21c8dc9f5440a5199ed010d2ef744f086141d06c176c0b14b4c7368d31d0ab4ce2', 1, 1, 'LoginUser', '[]', 0, '2020-02-17 10:35:11', '2020-02-17 10:35:11', '2021-02-17 11:35:11'),
('d6479a56dfe46f139dfef43fe240c8123a623f1b939587d1a0e754179068625ebef7ebd7948fafb9', 11, 1, 'RegisterToken', '[]', 0, '2020-06-16 21:08:11', '2020-06-16 21:08:11', '2021-06-16 22:08:11'),
('d7b5180b60e06cd4209351653eff7eaa0664804cf15adf7affd13d633c33a10b0d58cbbb906e670b', 6, 1, 'LoginUser', '[]', 0, '2020-03-29 18:54:08', '2020-03-29 18:54:08', '2021-03-29 19:54:08'),
('d8d84460227b178ddd6f9cd7b570ba3e82eec1c64a5694fb25d3f6c1251491bc3e55643d07f62675', 1, 2, NULL, '[]', 0, '2020-02-11 20:41:41', '2020-02-11 20:41:41', '2021-02-11 21:41:41'),
('da1ecb51fa26a1734d38f42bf1830dddbfe90f6c5734cec2da178a572e6b6c94405e67f113add336', 3, 2, NULL, '[]', 0, '2020-02-11 21:20:31', '2020-02-11 21:20:31', '2021-02-11 22:20:31'),
('e801588bdb782ea785f739a855e7d63609523e9f1559b21bce7d157878c3553f2783bcd8b7ae7098', 6, 1, 'LoginUser', '[]', 0, '2020-03-19 12:06:57', '2020-03-19 12:06:57', '2021-03-19 13:06:57'),
('ecd3b079ca4caed89ff07d65fe8ca51c9c4bb3e6ea7bd104fa7d9326284acf29a5c760aaa655dbf2', 16, 1, 'LoginUser', '[]', 0, '2020-06-18 16:27:14', '2020-06-18 16:27:14', '2021-06-18 17:27:14'),
('f90a64bfd1173e6438a058abd6aabbdeb0e4dcff11fcd19f6c6ddd9c1f74ad97c4a56fa4a2e9ca68', 9, 1, 'LoginUser', '[]', 0, '2020-06-15 12:35:58', '2020-06-15 12:35:58', '2021-06-15 13:35:58'),
('fa2d5f61961af1e45b3b836b0ed88d93350108cdaa201b9de26dd59d12b5d962bad0cada742e9d67', 1, 2, NULL, '[]', 0, '2020-02-14 12:56:01', '2020-02-14 12:56:01', '2021-02-14 13:56:01'),
('fdea846b682e5a305311e8a256eadbdf1b30da0a46ea98b6001efa6b4b40c1f94864c8dac26af5b8', 6, 1, 'LoginUser', '[]', 0, '2020-03-31 16:35:50', '2020-03-31 16:35:50', '2021-03-31 17:35:50');

-- --------------------------------------------------------

--
-- Structure de la table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'XQrayEfifvnJEbngEsylOgRPdhBMpfzFv7TmRvDp', 'http://localhost', 1, 0, 0, '2020-02-10 17:53:57', '2020-02-10 17:53:57'),
(2, NULL, 'Laravel Password Grant Client', 'DlTgR0tUikrIgkiD7FprImKw7ZvveBaUScGPnqOE', 'http://localhost', 0, 1, 0, '2020-02-10 17:53:58', '2020-02-10 17:53:58');

-- --------------------------------------------------------

--
-- Structure de la table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-02-10 17:53:58', '2020-02-10 17:53:58');

-- --------------------------------------------------------

--
-- Structure de la table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('013d2ab18af74e5140af3cc88e969737c17c9685720ee76d8e63836b756c2525d8db5d396dafffce', '3196e3eaaafe66f737eb68f9b07492ec82fc88ba78b6cbbf98b0a9cc2f8ee7b48c41cca7a2c09d29', 0, '2021-02-11 21:45:16'),
('57109172e303ca6cfff43e78a04b08630c65974e1c2bbd83ea44be029e646a6d5e1adebc04aae1be', 'da1ecb51fa26a1734d38f42bf1830dddbfe90f6c5734cec2da178a572e6b6c94405e67f113add336', 0, '2021-02-11 22:20:31'),
('a5aad9747975663c13c1587e1f13b39d0cad0cce0e014bbda68937b63055f69b40f3578a836c1172', 'ae7bb531d5988c54b07080d15aff2116b81dca7b50008731b34eaa835283b7ed5ebe59dd77ee1b17', 0, '2021-02-12 12:01:21'),
('c70cc1c7abb4eff4fd30eee881c4f5b5923c67ec95d2571ec478f8e8fec9bcbb3d49a09df4afecab', 'fa2d5f61961af1e45b3b836b0ed88d93350108cdaa201b9de26dd59d12b5d962bad0cada742e9d67', 0, '2021-02-14 13:56:03'),
('d4c9fd98e75d7fcc7ad1a70a520ac5d36865331caac06c01a5228ba25be45a48db671d1b17f661de', '5124792b07eb28cec845f5a027a60170a1259e4b489eaf8c7a4def7c21664799fafbaf79031fec01', 0, '2021-02-11 22:30:08'),
('e92695385a3271bf0968ec2d45d9b79d6c0369418620b631572dff4284f8295a46c894dbd331cdb3', 'd8d84460227b178ddd6f9cd7b570ba3e82eec1c64a5694fb25d3f6c1251491bc3e55643d07f62675', 0, '2021-02-11 21:41:41'),
('f163db4247b1a55df49ee1df6bdf31e5b3d07136733afe8b53a4303a7762f3f53b1c932cd3e5e2cb', '635aa6abb18a58816659179ad80132c4a94fc8528c1f5c90d63c7cedeebbc44eaf3a79fb92e74b41', 0, '2021-02-12 20:28:08');

-- --------------------------------------------------------

--
-- Structure de la table `repas`
--

CREATE TABLE `repas` (
  `id` int(11) NOT NULL,
  `id_specialite` int(11) NOT NULL,
  `id_restaurant` int(11) NOT NULL,
  `libelle` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `remise` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `repas`
--

INSERT INTO `repas` (`id`, `id_specialite`, `id_restaurant`, `libelle`, `description`, `image`, `prix`, `remise`, `type`, `updated_at`, `created_at`) VALUES
(6, 5, 4, 'Plats Escalope', 'Plats Escalope', 'images/repas/6.jpg', 12, 0, 1, '2020-05-14 22:26:19', '2020-02-12 12:54:40'),
(8, 6, 5, 'Salade De Poulpe', 'Salade De Poulpe', 'images/repas/8.jpg', 8, 0, 1, '2018-03-16 11:37:17', '2020-02-12 12:54:40'),
(9, 6, 5, 'Salade Niçoise', 'Salade Niçoise', 'images/repas/9.jpg', 8, 0, 1, '2018-03-16 11:39:31', '2020-02-12 12:54:40'),
(10, 7, 4, 'Grillade De Pécheur', 'Grillade De Pécheur Pour Deux', 'images/repas/10.jpg', 30, 0, 1, '2018-03-16 11:41:09', '2020-02-12 12:54:40'),
(11, 8, 6, 'Pate Fruits De Mer', 'Pate Fruits De Mer', 'images/repas/11.jpg', 10, 0, 1, '2018-03-16 11:46:30', '2020-02-12 12:54:40'),
(12, 8, 6, 'Pate Chevrette', 'Pate Chevrette', 'images/repas/12.jpg', 12, 0, 1, '2018-03-16 11:47:20', '2020-02-12 12:54:40'),
(13, 2, 3, 'Sandwitch Kamel', '', '', 3.5, 0, 1, '2018-03-19 05:05:36', '2020-02-12 12:54:40'),
(14, 5, 8, 'Ballotine De Poulet', 'Ballotine De PouletBallotine De PouletBallotine De PouletBallotine De Poulet', 'images/repas/14.jpg', 20, 0, 1, '2018-03-25 11:44:48', '2020-02-12 12:54:40'),
(15, 1, 8, 'Poulet Chasseur', 'Poulet Chasseur', 'images/repas/15.jpg', 22, 0, 1, '2018-03-25 11:45:28', '2020-02-12 12:54:40'),
(16, 5, 5, 'Filet De Bœuf', 'Filet De Bœuf', 'images/repas/16.jpg', 2.5, 0, 1, '2020-02-15 17:58:42', '2020-02-12 12:54:40'),
(17, 5, 8, 'Filet Stroganoff', 'Filet Stroganoff', 'images/repas/17.jpg', 25, 0, 1, '2018-03-25 11:46:57', '2020-02-12 12:54:40'),
(18, 5, 8, 'Filet De Poisson Farcie Au Chevrette', 'Filet De Poisson Farcie Au Chevrette', 'images/repas/18.jpg', 20, 0, 1, '2018-03-25 11:47:54', '2020-02-12 12:54:40'),
(19, 10, 8, 'Bâtons De Poisson Panné', 'Bâtons De Poisson Panné', 'images/repas/19.jpg', 10, 0, 1, '2018-03-25 11:59:27', '2020-02-12 12:54:40'),
(24, 5, 5, 'test', 'trest sfh test', '', 5.5, 0, 2, '2020-02-17 12:08:13', '2020-02-17 12:08:13'),
(25, 5, 5, 'test', 'trest sfh test', '', 5.5, 0, 2, '2020-02-17 12:09:41', '2020-02-17 12:09:41'),
(26, 5, 5, 'test', 'trest sfh test', '', 5.5, 0, 2, '2020-02-17 12:14:45', '2020-02-17 12:14:45'),
(27, 5, 5, 'test', 'trest sfh test', '', 5.5, 0, 2, '2020-02-17 12:20:06', '2020-02-17 12:20:06'),
(28, 2, 4, 'Sandwich', 'Sandwich', 'uploads/img/repas/1591885663.jpg', 15.5, NULL, 1, '2020-06-11 13:27:43', '2020-05-14 20:17:03'),
(31, 3, 4, 'adadada', 'adadada', 'uploads/img/pack/1589508568.png', 54, NULL, 2, '2020-05-15 02:02:34', '2020-05-15 01:09:28'),
(32, 2, 15, 'Bronco', 'Bronco', 'uploads/img/repas/1592779201.jpg', 6.5, NULL, 1, '2020-06-21 21:40:01', '2020-06-21 21:40:01'),
(33, 2, 15, 'Fajitas', 'Fajitas', 'uploads/img/repas/1592779242.jpg', 6.7, NULL, 1, '2020-06-21 21:40:42', '2020-06-21 21:40:42'),
(34, 2, 15, 'Maximos', 'Maximos', 'uploads/img/repas/1592779284.jpg', 8.5, NULL, 1, '2020-06-21 21:41:24', '2020-06-21 21:41:24'),
(35, 13, 16, 'Omlette', 'Omlette', 'uploads/img/repas/1592779607.jpg', 3.2, NULL, 1, '2020-06-21 21:46:47', '2020-06-21 21:46:47'),
(36, 2, 16, 'Kwika', 'sandich Kwika', 'uploads/img/repas/1592779657.jpg', 3.2, NULL, 1, '2020-06-21 21:47:37', '2020-06-21 21:47:37'),
(37, 2, 16, 'sandwich escalope pannée', 'TONTON', 'uploads/img/repas/1592779762.jpg', 6.8, NULL, 1, '2020-06-21 21:49:22', '2020-06-21 21:49:22'),
(38, 2, 16, 'Escalope panée', 'Escalope panée', 'uploads/img/repas/1592779819.jpg', 5.5, NULL, 1, '2020-06-21 21:50:19', '2020-06-21 21:50:19'),
(39, 2, 16, 'Escalope grillé', 'Escalope grillé', 'uploads/img/repas/1592779875.jpg', 5.5, NULL, 1, '2020-06-21 21:51:15', '2020-06-21 21:51:15');

-- --------------------------------------------------------

--
-- Structure de la table `repas_pack`
--

CREATE TABLE `repas_pack` (
  `id` int(11) NOT NULL,
  `id_repas` int(11) NOT NULL,
  `id_pack` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `repas_pack`
--

INSERT INTO `repas_pack` (`id`, `id_repas`, `id_pack`, `updated_at`, `created_at`) VALUES
(5, 6, 23, '2020-02-17 12:57:31', '2020-02-17 12:57:31'),
(6, 6, 24, '2020-02-17 13:08:13', '2020-02-17 13:08:13'),
(8, 6, 24, '2020-02-17 13:08:13', '2020-02-17 13:08:13'),
(11, 6, 25, '2020-02-17 13:09:41', '2020-02-17 13:09:41'),
(14, 6, 26, '2020-02-17 13:14:46', '2020-02-17 13:14:46'),
(17, 6, 27, '2020-02-17 13:20:06', '2020-02-17 13:20:06'),
(29, 6, 31, '2020-05-15 02:09:28', '2020-05-15 02:09:28'),
(32, 10, 31, '2020-05-15 03:02:34', '2020-05-15 03:02:34');

-- --------------------------------------------------------

--
-- Structure de la table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `id_fournisseur` int(20) UNSIGNED NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `logo` text COLLATE utf8_unicode_ci NOT NULL,
  `adresse` text COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `etat` int(11) NOT NULL DEFAULT 0,
  `note` text COLLATE utf8_unicode_ci DEFAULT '0',
  `lat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `lng` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `notificationStatut` int(11) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `restaurant`
--

INSERT INTO `restaurant` (`id`, `id_fournisseur`, `nom`, `telephone`, `logo`, `adresse`, `ville`, `etat`, `note`, `lat`, `lng`, `notificationStatut`, `updated_at`, `created_at`) VALUES
(3, 1, 'Kamel', '23373920', 'uploads/img/restaurant/1589597919.jpg', 'route nassriya km 11', 'sfax', 2, 'remarque', '34.741837', '10.754982', 2, '2020-06-11 14:10:38', '2020-02-11 16:40:46'),
(4, 2, 'SF FOOD', '22000000', 'images/restaurant/4.png', 'Route Gremda kl 5', 'Sfax Sud', 1, NULL, '34.74519943237445', '10.74464237954436', 2, '2020-06-17 12:57:27', '2020-02-11 16:40:46'),
(5, 1, 'Barbaros', '23000111', 'images/restaurant/5.jpg', 'Route Gremda kl 3.5', 'Sfax Sud', 1, NULL, '34.7473887', '10.7679558', 1, '2020-06-17 12:57:22', '2020-02-11 16:40:46'),
(6, 2, 'SUN & MOON', '515454545', 'images/restaurant/6.jpg', 'Sfax', 'sfax', 1, NULL, '34.7553785', '10.7632529', 1, '2020-06-15 14:59:19', '2020-02-11 16:40:46'),
(7, 1, 'caravana', '25987456', 'uploads/img/restaurant/1591126775.jpg', 'Sfax centre', 'Sfax Sud', 1, NULL, '36.66725715236025', '10.155344425127879', 3, '2020-06-17 12:57:32', '2020-02-11 16:40:46'),
(8, 2, 'HONEY POT', '5555555', 'images/restaurant/8.jpg', 'km 1,5, Route de la Soukra,', 'sfax', 1, NULL, '34.7695048', '10.7606307', 1, '2020-06-15 14:59:22', '2020-02-11 16:40:46'),
(14, 1, 'Restaurant Zitouna 2', '20 513 513', 'uploads/img/restaurant/1589594879.PNG', 'km 1,5, Route de la Soukra,', 'Sfax Sud', 0, '0', '34.67825237316638', '10.64730386388594', 1, '2020-06-03 12:56:37', '2020-05-16 01:07:59'),
(15, 1, 'MAXIMOS', '+21656609060', 'uploads/img/restaurant/1592778924.jpg', 'Avenue Majida Boulila', 'sfax', 1, NULL, '34.7384547', '10.7500906', 1, '2020-06-21 21:58:34', '2020-06-21 21:35:24'),
(16, 1, 'TONTON', '+21622140104', 'uploads/img/restaurant/1592779438.jpg', 'Rue Majida Boulila lmm.', 'Sfax Sud', 1, NULL, '34.7422467', '10.75408', 2, '2020-06-23 05:46:03', '2020-06-21 21:43:58');

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

CREATE TABLE `specialite` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `specialite`
--

INSERT INTO `specialite` (`id`, `libelle`, `description`, `image`, `updated_at`, `created_at`) VALUES
(1, 'Pizza', 'Pizza', 'images/specialite/1.jpg', '2018-03-13 13:35:32', '2020-02-12 12:54:35'),
(2, 'Sandwich', 'Sandwich', 'images/specialite/2.jpg', '2018-03-13 13:35:32', '2020-02-12 12:54:35'),
(3, 'Burger', 'Burger', 'images/specialite/3.jpg', '2018-03-14 19:27:34', '2020-02-12 12:54:35'),
(4, 'Poulet', 'Poulet', 'images/specialite/4.jpg', '2018-03-14 19:41:25', '2020-02-12 12:54:35'),
(5, 'Plats', 'Plats', 'images/specialite/5.jpg', '2018-03-16 10:13:57', '2020-02-12 12:54:35'),
(6, 'Entrées Froides', 'Entrées Froides', 'images/specialite/61.jpg', '2018-03-16 11:36:16', '2020-02-12 12:54:35'),
(7, 'Grillades', 'Grillades', 'images/specialite/71.jpg', '2018-03-16 11:40:07', '2020-02-12 12:54:35'),
(8, 'Pâtes', 'Pâtes', 'images/specialite/81.jpg', '2018-03-16 11:46:01', '2020-02-12 12:54:35'),
(10, 'Menu Enfant', 'Menu Enfant', 'images/specialite/1591103837.png', '2020-06-02 12:17:17', '2020-02-12 12:54:35'),
(13, 'Omlette', 'Omlette', 'images/specialite/1592779554.jpg', '2020-06-21 21:45:54', '2020-06-21 21:45:54');

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `mot` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`id`, `mot`, `number`, `updated_at`, `created_at`) VALUES
(1, 'pe', 19, '2020-06-16 21:03:10', '2020-06-16 22:03:10'),
(5, 'sand', 34, '2020-06-16 20:56:01', '2020-06-16 21:56:01'),
(6, 'pizz', 2, '2020-03-14 12:31:16', '2020-03-14 13:31:16'),
(7, 'Pizza', 12, '2020-06-18 19:54:38', '2020-06-18 20:54:38'),
(8, 'Sandwich', 10, '2020-06-17 10:34:19', '2020-06-17 11:34:19'),
(9, 'plat', 8, '2020-06-16 20:56:05', '2020-06-16 21:56:05'),
(10, 'poul', 5, '2020-06-16 21:03:11', '2020-06-16 22:03:11'),
(11, 'Poulet', 2, '2020-06-16 22:17:12', '2020-06-16 23:17:12');

-- --------------------------------------------------------

--
-- Structure de la table `transporteur`
--

CREATE TABLE `transporteur` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codePostale` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transporteur`
--

INSERT INTO `transporteur` (`id`, `nom`, `prenom`, `email`, `password`, `adresse`, `telephone`, `ville`, `codePostale`, `image`, `created_at`, `updated_at`) VALUES
(2, 'hssini', 'med amine', 'hssini12@hssini.com', '$2y$10$ckPDk237O/I7VACp1tYDvesrS0Hz.Yss99jrpSccMcZOSgafYgOLG', 'rte manzel chakir klm 12', '+21629472994', 'sfax', '3054', 'uploads/img/profile/1591123001.PNG', '2020-05-07 15:30:13', '2020-06-02 17:36:41');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codePostale` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `image` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `email_verified_at`, `password`, `adresse`, `telephone`, `ville`, `codePostale`, `type`, `image`, `lat`, `lang`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'med amine hssini', '', 'hamza.dammak@gmail.com', NULL, '$2y$10$dHZh4pJ49zdl03pQFVsOeePT.geopBqflFrrtTI5QRZW7fW9NB8B.', '', '', '', 0, 2, NULL, NULL, NULL, NULL, '2020-02-10 14:05:13', '2020-02-10 14:05:13'),
(5, 'hssini', 'med amine', 'ssinih@hssini.com', NULL, '$2y$10$XFcwiVEYXTmvJdKh4Zljbec/M8MpVETCegNdzRSHT8oZ38U0qs6HO', 'route grimda klm 5', '+21629472994', 'Sfax', 3059, 2, NULL, NULL, NULL, NULL, '2020-02-15 16:00:41', '2020-02-15 16:00:41'),
(6, 'hssini', 'med ha', 'hssini@hssini.com', NULL, '$2y$10$ckPDk237O/I7VACp1tYDvesrS0Hz.Yss99jrpSccMcZOSgafYgOLG', 'rte manzel chakir klm 12', '+21629472994', 'sfax', 3059, 2, NULL, NULL, NULL, NULL, '2020-02-15 16:01:25', '2020-04-04 17:05:16'),
(7, 'Richard', 'Barga', 'kilkil123@yopmail.com', NULL, '$2y$10$EmN13lkbotSYZnNJGA.riOBRjmgQP8skx6MlB/45Tnuoo9RptGmz.', 'montagne Salvator, 135', '+4915224730470', 'Aachen', 52070, 0, 'uploads/img/client/1586617513.jpg', NULL, NULL, NULL, '2020-04-11 12:58:33', '2020-04-11 14:05:13'),
(8, 'Richard', 'Barga', 'dd@dd.com', NULL, '$2y$10$UJDjPuLuhHLtgZr2w2fdHul2x//wojgGc4TOOq8uzKuFDELHu9LM2', 'montagne Salvator', '+491522gg', 'Aachen', 52070, 0, NULL, NULL, NULL, NULL, '2020-05-27 12:30:58', '2020-05-27 12:30:58'),
(9, 'med amine', 'Hssini', 'medhssinihssini@gmail.com', NULL, '$2y$10$9b.ieUGYG6xOWyNOOiQUduFEhU66vpVfa.u.yb3RFZekBlDmtUtWe', 'route manzel chakir kl 12', '29472994', 'sfax', 3059, 0, NULL, '34.799760060019', '10.64299012382', NULL, '2020-05-31 11:05:25', '2020-06-01 21:03:36'),
(11, 'hssini', 'med', 'med@gmail.com', NULL, '$2y$10$oJUmM331mBDXkBKWnVY0IuS5OZ2N7JIiteCYpuCljM87jmf7lmI9O', 'rte manzel chakir klm 12', '+21629472994', 'sfax', 3059, 0, NULL, '34.747270843592', '10.739991998094', NULL, '2020-06-16 21:08:10', '2020-06-16 21:09:32'),
(12, 'hssini', 'med', 'medhssini1@gmail.com', NULL, '$2y$10$sgtAwcIp5y5tsNPBnzSnguTEQaarTZnDv5ANQCSu4Gd57BNUke/zm', 'rte manzel chakir klm 12', '+21629472994', 'sfax', 3059, 0, NULL, '34.74591075721', '10.752716127722', NULL, '2020-06-16 22:19:26', '2020-06-16 22:20:27'),
(13, 'hssini', 'med', 'siala@gmail.com', NULL, '$2y$10$03aQ.4D8/1RVSxtaucroQu/Pz6U7.SiVU9naaIpe7k80DE6nL7mXe', 'rte manzel chakir klm 12', '+21629472994', 'sfax', 3059, 0, NULL, '34.8082201', '10.7055174', NULL, '2020-06-17 09:30:37', '2020-06-17 09:32:11'),
(14, 'kila', 'chila', 'alee@saabscania.tk', NULL, '$2y$10$iSM0Eq3QbFDabeDm1TJLXu2meNd6adf7FQmDPUP0xdvYUibv4XA56', 'hilz kilz', '+33987671325', 'hawaii', 30254, 0, NULL, '34.74026085361', '10.753448978539', NULL, '2020-06-18 12:33:15', '2020-06-18 12:33:54'),
(15, 'Boussarsar', 'Ahmed', 'Ahmedaminboussarsar@gmail.com', NULL, '$2y$10$b3Dp88QFygKqWYAkWImT6eXOfDJpr170.LCaet8HrVpaf.kuWjwxS', 'Route de taniour km2 boulangerie Kanoun', '95577414', 'Sfax', 3002, 0, NULL, NULL, NULL, NULL, '2020-06-18 13:12:34', '2020-06-18 13:12:34'),
(16, 'Hammami', 'Houssem', 'hammami.houssem@hotmail.fr', NULL, '$2y$10$p8dy6fhiyqceiG84s65WJ.VxqPW5YLqIOHgRqHPI4kNBEtaoG9K4q', 'Avenue cherif eddrisi', '23373920', 'Sfax', 3021, 0, NULL, NULL, NULL, NULL, '2020-06-18 16:26:51', '2020-06-18 16:26:51'),
(17, 'kila', 'chila', 'med@hssini.com', NULL, '$2y$10$.dIHS.zgE93XT.Xjm4kQk.2OJHPLT9PW1AoSmGDuEXM3umaCMAGH2', 'hilz kilz', '+33987671325', 'hawaii', 30254, 0, NULL, '34.794853075328', '10.648097537867', NULL, '2020-06-18 17:17:35', '2020-06-19 13:16:41'),
(18, 'Khaoula', 'Hassini', 'hssini06@gmail.com', NULL, '$2y$10$PudGUomczMtalDW6dhkoFulj7tZHxlRPGOQwh6ypFmlVXV2lxluRW', 'str des 18 oktober 31', '20250793', 'leipzig', 4103, 0, NULL, '51.330942', '12.4078572', NULL, '2020-06-19 13:01:32', '2020-06-19 13:02:55'),
(19, 'Hammami', 'Houssem', 'hammami.houssem@gmail.com', NULL, '$2y$10$dF47NgUmv2/3LRSahCR13OzA3DjXMa6iy9xSeeYDzT7TzSExu1QQ6', 'Avenue cherif eddrisi', '23373920', 'Sfax', 3021, 0, NULL, NULL, NULL, NULL, '2020-06-24 14:22:02', '2020-06-24 14:22:02');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`id_user`),
  ADD KEY `repas_id` (`id_repas`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_commande` (`id_commande`,`id_repas`),
  ADD KEY `repas` (`id_repas`);

--
-- Index pour la table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Index pour la table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Index pour la table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `repas`
--
ALTER TABLE `repas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_specialite` (`id_specialite`),
  ADD KEY `id_restaurant` (`id_restaurant`);

--
-- Index pour la table `repas_pack`
--
ALTER TABLE `repas_pack`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_repas` (`id_repas`),
  ADD KEY `id_pack` (`id_pack`);

--
-- Index pour la table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_fournisseur`);

--
-- Index pour la table `specialite`
--
ALTER TABLE `specialite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transporteur`
--
ALTER TABLE `transporteur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Transporteur_email_unique` (`email`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `repas`
--
ALTER TABLE `repas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `repas_pack`
--
ALTER TABLE `repas_pack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `transporteur`
--
ALTER TABLE `transporteur`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `repas_commentaire` FOREIGN KEY (`id_repas`) REFERENCES `repas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `commande` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `repas` FOREIGN KEY (`id_repas`) REFERENCES `repas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD CONSTRAINT `oauth_clients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `repas`
--
ALTER TABLE `repas`
  ADD CONSTRAINT `repas_ibfk_1` FOREIGN KEY (`id_specialite`) REFERENCES `specialite` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `repas_ibfk_2` FOREIGN KEY (`id_restaurant`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `repas_pack`
--
ALTER TABLE `repas_pack`
  ADD CONSTRAINT `repas_pack_ibfk_1` FOREIGN KEY (`id_repas`) REFERENCES `repas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
