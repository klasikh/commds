-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 27 mars 2022 à 01:29
-- Version du serveur : 5.7.36
-- Version de PHP : 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `digitcmd`
--

-- --------------------------------------------------------

--
-- Structure de la table `cm_manage`
--

DROP TABLE IF EXISTS `cm_manage`;
CREATE TABLE IF NOT EXISTS `cm_manage` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `ware_house_id` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `conversations_users`
--

DROP TABLE IF EXISTS `conversations_users`;
CREATE TABLE IF NOT EXISTS `conversations_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `conversation_id` bigint(20) DEFAULT NULL,
  `read_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Numériquo Départ', 'Département sur la digitalisation des activités....', 'web', '2022-02-17 17:11:08', '2022-03-02 12:05:01'),
(3, 'Département Nouveau', 'ijioz Descript ih zfiu zfi ui', 'web', '2022-02-17 19:11:54', '2022-02-28 06:48:05'),
(4, 'Fertili', 'Just a descript to test the de depart', NULL, '2022-02-28 06:46:43', '2022-02-28 06:46:43'),
(6, 'hjgvb yugk', 'ykbyu byu uyu yuh', NULL, '2022-03-05 03:42:59', '2022-03-05 03:42:59'),
(7, 'Dépatement Logistique', 'Desciption de ce département', NULL, '2022-03-14 07:11:29', '2022-03-14 07:11:29');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `grades`
--

DROP TABLE IF EXISTS `grades`;
CREATE TABLE IF NOT EXISTS `grades` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `grades`
--

INSERT INTO `grades` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Directeur (CDL)', 'Description pour le directeur (CDL)', '2022-02-28 06:56:01', '2022-03-08 18:07:41'),
(3, 'Chef département (DPAL)', 'Description pour chef département DPAL', '2022-02-28 06:57:10', '2022-03-08 18:06:55'),
(4, 'Référant approvisionnement', 'Description de la fonction de référant approvisionnement.', '2022-02-28 06:58:39', '2022-03-08 18:05:08'),
(5, 'Supérieur Hiérarchique', 'Description pour la fonction du supérieur hiérarchique', '2022-02-28 06:59:06', '2022-03-08 18:09:23'),
(6, 'Sous traitant', 'Description de la fonction pour sous-traitant.', '2022-02-28 10:15:10', '2022-03-08 18:08:55'),
(7, 'Chef entrepôt', 'Description pour la fonction du chef entrepôt.', '2022-03-02 12:07:36', '2022-03-08 18:08:35'),
(8, 'Chef magasinier', 'Fonction pour chef magasinier', '2022-03-08 18:09:59', '2022-03-08 18:09:59'),
(9, 'Approvisionneur', 'Description de la fonction pour approvisionneur.', '2022-03-08 18:10:33', '2022-03-08 18:10:33'),
(10, 'PRMP', 'Fonction de la Personne Responsable des Marchés Publics.', '2022-03-08 18:13:15', '2022-03-08 18:13:15'),
(11, 'Développeur', 'Decription ...........................................................', '2022-03-10 07:00:01', '2022-03-10 07:00:01');

-- --------------------------------------------------------

--
-- Structure de la table `materials`
--

DROP TABLE IF EXISTS `materials`;
CREATE TABLE IF NOT EXISTS `materials` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `request_id` bigint(20) DEFAULT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_count` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asked_quantity` bigint(20) DEFAULT NULL,
  `delivery_quantity` bigint(20) DEFAULT NULL,
  `observations` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `materials`
--

INSERT INTO `materials` (`id`, `request_id`, `designation`, `article_code`, `stock_count`, `asked_quantity`, `delivery_quantity`, `observations`, `created_at`, `updated_at`) VALUES
(27, 31, 'kizkoze,klez,nlze,', 'zkjnzz enk', '97', 56, NULL, NULL, '2022-03-06 08:52:12', '2022-03-06 08:52:12'),
(26, 31, 'oilmzj iojz e,novfize', 'zejbz ozmevio', '97', 87, NULL, NULL, '2022-03-06 08:52:12', '2022-03-06 08:52:12'),
(25, 36, 'kzeof,zekfzeklfz²²', 'bhjezfezljfkje', '67', 890, NULL, NULL, '2022-03-05 11:30:33', '2022-03-05 11:30:33'),
(24, 36, 'nezfkzejnjgfiozep²', 'oiezjhifoezpr²', '9', 87, NULL, NULL, '2022-03-05 11:30:33', '2022-03-05 11:30:33'),
(23, 36, '²nezfkjzenfkjzelnf²', 'ezfkzek nlf', '76', 9, NULL, NULL, '2022-03-05 11:30:33', '2022-03-05 11:30:33'),
(22, 36, 'yuihuzeidijozefjzielfjizel', 'iouhjçop', '72', 78, NULL, NULL, '2022-03-05 11:30:33', '2022-03-05 11:30:33'),
(21, 44, 'Rouleaux de tuyaux', 'KL67', '778', 288, NULL, NULL, '2022-03-05 09:02:52', '2022-03-05 09:02:52'),
(20, 44, 'Véhicules de matériels', 'JZ677', '78', 4, NULL, NULL, '2022-03-05 09:02:52', '2022-03-05 09:02:52'),
(19, 44, 'Fer de drainage', 'YTE89', '772', 199, NULL, NULL, '2022-03-05 09:02:52', '2022-03-05 09:02:52'),
(18, 44, 'Poteaux de lampadaires', 'IUEH', '72', 67, NULL, NULL, '2022-03-05 09:02:52', '2022-03-05 09:02:52'),
(28, 31, 'kh ionzeoizejio', 'zefkjze f', '9', 45, NULL, NULL, '2022-03-06 08:52:12', '2022-03-06 08:52:12'),
(29, 47, 'Rouleaux de fer', 'HZU889', '5678', 88, NULL, NULL, '2022-03-06 09:02:50', '2022-03-06 09:02:50'),
(30, 47, 'Véhicules de transport', 'GH5627', '67', 9, NULL, NULL, '2022-03-06 09:02:50', '2022-03-06 09:02:50'),
(31, 47, 'Grue', 'H878', '87', 9, NULL, NULL, '2022-03-06 09:02:50', '2022-03-06 09:02:50'),
(32, 47, 'Tuyeaux en fer', 'KJE76GF', '78', 67, NULL, NULL, '2022-03-06 09:02:50', '2022-03-06 09:02:50'),
(33, 47, 'Herlik', '987H', '78', 887, NULL, NULL, '2022-03-06 09:02:50', '2022-03-06 09:02:50'),
(34, 47, 'Rouleaux de fer', 'HZU889', '5678', 88, NULL, NULL, '2022-03-06 10:31:18', '2022-03-06 10:31:18'),
(35, 47, 'Véhicules de transport', 'GH5627', '67', 9, NULL, NULL, '2022-03-06 10:31:18', '2022-03-06 10:31:18'),
(36, 47, 'Grue', 'H878', '87', 9, NULL, NULL, '2022-03-06 10:31:18', '2022-03-06 10:31:18'),
(37, 47, 'Tuyeaux en fer', 'KJE76GF', '78', 67, NULL, NULL, '2022-03-06 10:31:18', '2022-03-06 10:31:18'),
(38, 47, 'Herlik', '987H', '78', 887, NULL, NULL, '2022-03-06 10:31:18', '2022-03-06 10:31:18'),
(39, 40, 'hjkvbzajf', 'IU89', '98', 87, NULL, NULL, '2022-03-06 10:35:05', '2022-03-06 10:35:05'),
(40, 35, 'Rouleaux de fer', 'TY7276', '8', 71, 7, 'NKLNkl', '2022-03-07 06:44:59', '2022-03-07 06:44:59'),
(41, 35, 'Tuyeaux en vinyle', 'GDE888', '8', 12, NULL, 'zafn klzafzaf', '2022-03-07 06:44:59', '2022-03-07 06:44:59'),
(42, 35, 'Véhicules de transport', '67UJY', '6', 15, 78, NULL, '2022-03-07 06:44:59', '2022-03-07 06:44:59'),
(43, 35, 'Grue', 'GJUTU', '8', 5, 2, 'JHIUBJkhnikjazfczefc', '2022-03-07 06:44:59', '2022-03-07 06:44:59'),
(44, 35, 'Moulinex', '87UYJ', '6', 4, 5, 'Rien à signaler', '2022-03-07 06:44:59', '2022-03-07 06:44:59'),
(45, 53, 'ujyqfyuzef', 'qlmfkqiuf', '67', 78, NULL, NULL, '2022-03-07 12:49:35', '2022-03-07 12:49:35'),
(46, 53, 'hjuoniuj', 'swdfgdskjf', '67', 66, NULL, NULL, '2022-03-07 12:49:35', '2022-03-07 12:49:35'),
(47, 54, 'Rouleaux de fer', NULL, 'kg', 70, NULL, NULL, '2022-03-07 14:41:57', '2022-03-07 14:41:57'),
(48, 54, 'Vinyle de plesciglasse', NULL, 'Joules', 789, NULL, NULL, '2022-03-07 14:41:57', '2022-03-07 14:41:57'),
(49, 54, 'Ciment pour béton', NULL, 'kg', 80, NULL, NULL, '2022-03-07 14:41:57', '2022-03-07 14:41:57'),
(50, 54, 'Fer', NULL, 'Kg', 920, NULL, NULL, '2022-03-07 14:41:57', '2022-03-07 14:41:57'),
(51, 54, 'Rouleaux de fer', NULL, 'kg', 70, NULL, NULL, '2022-03-07 16:59:21', '2022-03-07 16:59:21'),
(52, 54, 'Vinyle de plesciglasse', NULL, 'L', 789, NULL, NULL, '2022-03-07 16:59:21', '2022-03-07 16:59:21'),
(53, 54, 'jzfizue', NULL, 'kg', 8, NULL, NULL, '2022-03-07 16:59:21', '2022-03-07 16:59:21'),
(54, 54, 'Fer', NULL, 'Kg', 920, NULL, NULL, '2022-03-07 16:59:21', '2022-03-07 16:59:21'),
(55, 55, 'Freaille de terre', 'JHG560', 'Kg', 180, NULL, NULL, '2022-03-07 17:28:00', '2022-03-07 17:28:00'),
(56, 55, 'Draineur', 'UT8778', 'G', 270, NULL, NULL, '2022-03-07 17:28:00', '2022-03-07 17:28:00'),
(57, 55, 'Treuil', '696J', 'Kg', 113, NULL, NULL, '2022-03-07 17:28:00', '2022-03-07 17:28:00'),
(58, 55, 'Rouleaux de barre', 'GT878', 'Kg', 187, NULL, NULL, '2022-03-07 17:28:00', '2022-03-07 17:28:00'),
(59, 56, 'Rouleaux de fer', 'UT8778', 'Kg', 69, 67, 'Rien à signaler', '2022-03-07 21:52:29', '2022-03-07 21:52:29'),
(60, 56, 'Césaille', 'KUYY8', 'Carton', 90, 89, '/', '2022-03-07 21:52:29', '2022-03-07 21:52:29'),
(61, 56, 'Grue', '696J', 'kg', 76, 56, '/', '2022-03-07 21:52:29', '2022-03-07 21:52:29'),
(62, 56, 'Bagnoles', 'JHG568', 'Ka', 787, 230, 'Quantité demandée trop élevée', '2022-03-07 22:20:40', '2022-03-07 22:20:40'),
(63, 56, 'Fertaille', 'IUOOI98', '78', 99, 90, 'Rien à notifier', '2022-03-07 22:26:53', '2022-03-07 22:26:53'),
(64, 57, 'Rouleaux de fer', 'TZ782', 'Kg', 78, 78, 'Rien à notifier', '2022-03-08 11:04:19', '2022-03-08 11:04:19'),
(65, 57, 'Tuyaux de koiore', 'UZ90', 'L', 89, 45, 'Quantité demandée trop élevée', '2022-03-08 11:04:19', '2022-03-08 11:04:19'),
(66, 57, 'kerozène', '7879U', 'Kg', 90, 64, '/', '2022-03-08 11:04:19', '2022-03-08 11:04:19'),
(67, 62, 'zeif,nzeklfnzekfnjh', 'YTJB78', 'kg', 76, 67, 'HJ bzefib', '2022-03-10 03:54:26', '2022-03-10 03:54:26'),
(68, 62, 'zefzehjb', 'HGYH099', 'l', 77, 9, 'uhybze dfzehjif i', '2022-03-10 03:54:26', '2022-03-10 03:54:26'),
(69, 62, 'zeiufhiuzefzueb', '877GHC', 'h', 97, 10, 'ohiuze fuz iefzeui foez', '2022-03-10 03:54:26', '2022-03-10 03:54:26'),
(70, 63, 'Grands tuyaux', 'TZ782', 'kg', 79, 10, 'Rien à notifier', '2022-03-10 07:20:17', '2022-03-10 07:20:17'),
(71, 63, 'Ciment ezfezff ezfze', 'IJHU78', 'jg', 67, 56, 'Quantité demandée trop élevée', '2022-03-10 07:20:17', '2022-03-10 07:20:17'),
(72, 63, 'GHHUJ', '67GH', 'hj', 78, 66, '7GYGHUJBk', '2022-03-10 07:20:17', '2022-03-10 07:20:17'),
(73, 63, 'GFGF7', 'HJ87', 'kg', 90, 54, '/', '2022-03-10 07:20:17', '2022-03-10 07:20:17'),
(74, 61, 'KJHOIHNIO_ç', '76KU', 'jj', 78, 67, 'Rien à notifier', '2022-03-10 14:54:03', '2022-03-10 14:54:03'),
(75, 60, 'fftdtfujtyvgyv gyv yv', 'TZ782', 'Kg', 57, NULL, NULL, '2022-03-10 15:37:53', '2022-03-10 15:37:53'),
(76, 60, 'tred( trftf uy f', '76KU', 'L', 65, NULL, NULL, '2022-03-10 15:37:53', '2022-03-10 15:37:53'),
(77, 64, 'troizjefoize f', NULL, 'io', 89, NULL, NULL, '2022-03-10 17:21:46', '2022-03-10 17:21:46'),
(78, 64, 'ezhzfiureghi', NULL, 'u', 87, NULL, NULL, '2022-03-10 17:21:46', '2022-03-10 17:21:46'),
(79, 65, 'ezn,f', 'J98IU', 'jk', 89, 89, 'jhnefvioez nvfoimez', '2022-03-11 17:23:14', '2022-03-11 17:23:14'),
(80, 65, 'ezkjkfze', 'JG88798', 'kg', 78, 67, '²hz eiufhnzeiufhnze', '2022-03-11 17:23:15', '2022-03-11 17:23:15'),
(81, 66, 'Tuyeaux', 'TZ782', 'kg', 67, 54, 'Rien à notifier', '2022-03-11 18:06:01', '2022-03-11 18:06:01'),
(82, 66, 'Barre de fer', 'HYU6878', 'L', 155, 123, 'Quantité demandée trop élevée', '2022-03-11 18:06:01', '2022-03-11 18:06:01'),
(83, 66, 'Ciment', '78JJKK', 'kg', 78, 67, 'Rien à signaler', '2022-03-11 18:06:01', '2022-03-11 18:06:01'),
(84, 67, 'Freiuezhfi erlgiu heripgu hperm', 'TZ782', 'ih', 89000, 898, '7GYGHUJBkklj', '2022-03-14 16:57:56', '2022-03-14 16:57:56'),
(85, 67, 'gzeifuhikk ezio hiome', '76KU', 'ghzefc', 87, 676, 'Quantité demandée trop élevée', '2022-03-14 16:57:56', '2022-03-14 16:57:56'),
(86, 67, 'kjezi zeufv iuezo', 'JG88798', 'ui', 9000, 9000, '7GYGHUJBklllllll', '2022-03-14 16:57:56', '2022-03-14 16:57:56'),
(87, 67, 'fretayteu', 'IUH8767', 'lz', 996, 800, 'yyfub', '2022-03-14 16:57:56', '2022-03-14 16:57:56'),
(88, 67, 'trftyfy', 'liugliu54', 'rdhtrf', 535, 78, 'Rien à notifier', '2022-03-14 17:46:19', '2022-03-14 17:46:19'),
(89, 67, 'ftyftuf hhjb j ijk', 'liugliu54', '(_', 655, 878, 'ygyuezk²', '2022-03-14 17:47:05', '2022-03-14 17:47:05'),
(90, 68, 'Ordinateur', 'UIGU', 'un', 676, NULL, NULL, '2022-03-16 10:10:59', '2022-03-16 10:10:59'),
(91, 68, 'Ciment', NULL, 'UI', 88, NULL, NULL, '2022-03-16 10:10:59', '2022-03-16 10:10:59'),
(92, 68, 'Ordinateur', NULL, 'kg', 76, NULL, NULL, '2022-03-16 10:10:59', '2022-03-16 10:10:59'),
(93, 69, 'PC DELL ATX7825', 'HJGK89', 'un', 78, 78, 'dskjlzvzev', '2022-03-16 15:08:55', '2022-03-16 15:08:55'),
(94, 69, 'jkliuhg_uiotb', 'HJ98', 'un', 12, 76, 'zefvzevezvze', '2022-03-16 15:08:55', '2022-03-16 15:08:55'),
(95, 69, 'Grue à dents', 'KJ090', 'kg', 17, 66, 'zevzevezvezvezv', '2022-03-16 15:08:55', '2022-03-16 15:08:55'),
(96, 69, 'Mercedes Benz 3290', 'JHHG89', 'kg', 67, 44, 'ioj io h ui ohuiohl', '2022-03-16 15:08:55', '2022-03-16 15:08:55'),
(97, 70, 'PC DELL ATX7825', 'qlmfk', 'pz', 56, NULL, NULL, '2022-03-17 07:43:44', '2022-03-17 07:43:44'),
(98, 70, 'Ciment BUFALO', 'TZ782', 'yu', 4, NULL, NULL, '2022-03-17 07:43:44', '2022-03-17 07:43:44'),
(99, 70, 'Mercedes Benz 3290', '76KU', 'kez', 6, NULL, NULL, '2022-03-17 07:43:44', '2022-03-17 07:43:44'),
(100, 71, 'Mercedes Benz 3290', 'azdazdaz', 'zef', 87, 6, 'Quantité trop élevée', '2022-03-17 08:59:09', '2022-03-17 08:59:09'),
(101, 71, 'PC DELL ATX7825', 'UT8778', 'zef', 65, 7, 'Pfff /', '2022-03-17 08:59:09', '2022-03-17 08:59:09'),
(102, 71, 'Ciment BUFALO', 'JHG568', 'wer', 23, 670, 'Rien à signaler', '2022-03-17 09:02:33', '2022-03-17 09:02:33'),
(103, 74, 'DELL TCX 8738', 'ezefzefze', 'un', 5, 5, 'Rien à signaler', '2022-03-22 14:32:10', '2022-03-22 14:32:10'),
(104, 74, 'Tuyeaux de 100 diamètres', 'IU89789', 'kg', 535, 345, 'Quantité trop élevée', '2022-03-22 14:32:10', '2022-03-22 14:32:10'),
(108, 73, 'Fijustsi GH 2880', 'UT8778', 'un', 45, NULL, NULL, '2022-03-25 14:43:10', '2022-03-25 14:43:10'),
(106, 73, 'Tuyeaux de 100 diamètres', '696J', 'kg', 65, NULL, NULL, '2022-03-25 13:21:16', '2022-03-25 13:21:16'),
(109, 73, 'zefze', 'JHG568', 'ffef', 65, NULL, NULL, '2022-03-25 14:43:10', '2022-03-25 14:43:10'),
(110, 56, 'Ordinateur', NULL, 'kj', 78, NULL, NULL, '2022-03-25 16:57:01', '2022-03-25 16:57:01'),
(111, 75, 'Fijustsi GH 2880', 'qlmfkq', 'kjz', 769, NULL, NULL, '2022-03-26 12:16:45', '2022-03-26 12:16:45'),
(112, 75, 'Tuyeaux de 100 diamètres', 'JG88798', 'kg', 65, NULL, NULL, '2022-03-26 12:16:45', '2022-03-26 12:16:45'),
(113, 75, 'zefze', '76KYE', 'eziu', 98, 55, 'dskjlzvzev', '2022-03-26 12:16:45', '2022-03-26 12:16:45'),
(114, 75, 'Tuyeaux de 100 diamètres', 'TZ782', 'ioer', 68, 67, 'Rien à signaler', '2022-03-26 12:18:06', '2022-03-26 12:18:06');

-- --------------------------------------------------------

--
-- Structure de la table `materials_categories`
--

DROP TABLE IF EXISTS `materials_categories`;
CREATE TABLE IF NOT EXISTS `materials_categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `materials_categories`
--

INSERT INTO `materials_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(9, 'Ordinateur', 'Description ...................', '2022-03-19 08:55:53', '2022-03-19 08:55:53'),
(6, 'Tuyaux', 'description.............................', '2022-03-16 14:03:53', '2022-03-16 14:03:53'),
(8, 'zefze', 'zefzezefzefezf', '2022-03-17 07:18:30', '2022-03-17 07:18:30');

-- --------------------------------------------------------

--
-- Structure de la table `materials_lists`
--

DROP TABLE IF EXISTS `materials_lists`;
CREATE TABLE IF NOT EXISTS `materials_lists` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `article_code` varchar(255) DEFAULT NULL,
  `description` text,
  `category` varchar(255) DEFAULT NULL,
  `on_use` enum('0','1') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `materials_lists`
--

INSERT INTO `materials_lists` (`id`, `name`, `article_code`, `description`, `category`, `on_use`, `created_at`, `updated_at`) VALUES
(9, 'Tuyeaux de 100 diamètres', NULL, 'zeu hfuiez hf iuo ezhfvuiozezekllkvj zioe v', 'Tuyaux', '1', '2022-03-19 09:24:23', '2022-03-19 09:24:23'),
(7, 'DELL TCX 8738', NULL, 'Description jiovpjeiozvpjiekldslvjmn ieov joierjvierm', 'Ordinateur', '1', '2022-03-19 09:15:18', '2022-03-19 09:15:18'),
(10, 'Fijustsi GH 2880', NULL, 'PC d\'année zefoipzfe uozefo zfio zefpze ofoi', 'Ordinateur', NULL, '2022-03-19 09:26:00', '2022-03-19 09:26:00');

-- --------------------------------------------------------

--
-- Structure de la table `materials_manages`
--

DROP TABLE IF EXISTS `materials_manages`;
CREATE TABLE IF NOT EXISTS `materials_manages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `materials_manages`
--

INSERT INTO `materials_manages` (`id`, `name`, `quantity`, `created_at`, `updated_at`) VALUES
(18, 'DELL TCX 8738', 687669, '2022-03-19 09:39:07', '2022-03-26 12:09:10'),
(16, 'Tuyeaux de 100 diamètres', 53742, '2022-03-19 09:27:16', '2022-03-26 13:37:43');

-- --------------------------------------------------------

--
-- Structure de la table `mat_transferts`
--

DROP TABLE IF EXISTS `mat_transferts`;
CREATE TABLE IF NOT EXISTS `mat_transferts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `request_id` bigint(20) DEFAULT NULL,
  `delivery_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `sens` enum('1','2','3') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leaving_mag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `benef_mag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_refs` text COLLATE utf8mb4_unicode_ci,
  `asker_sign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asker_name` text COLLATE utf8mb4_unicode_ci,
  `rA_sign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rA_name` text COLLATE utf8mb4_unicode_ci,
  `mag_chief_sign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mag_chief_name` text COLLATE utf8mb4_unicode_ci,
  `mag_sign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mag_name` text COLLATE utf8mb4_unicode_ci,
  `taker_sign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taker_name` text COLLATE utf8mb4_unicode_ci,
  `user_sender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_receiver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mat_transferts`
--

INSERT INTO `mat_transferts` (`id`, `request_id`, `delivery_number`, `creation_date`, `sens`, `leaving_mag`, `benef_mag`, `destination`, `other_refs`, `asker_sign`, `asker_name`, `rA_sign`, `rA_name`, `mag_chief_sign`, `mag_chief_name`, `mag_sign`, `mag_name`, `taker_sign`, `taker_name`, `user_sender_id`, `user_receiver_id`, `created_at`, `updated_at`) VALUES
(10, 44, '676', '2022-03-05 10:02:52', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-05 09:02:52', '2022-03-05 09:02:52'),
(11, 36, '678', '2022-03-05 12:30:33', '1', 'egergererger', 'zefzefzef', 'ihjiozjnfoizejnozf', 'uihziuflhzifhnz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-05 11:30:33', '2022-03-05 11:30:33'),
(12, 31, '6586987', '2022-03-06 09:52:12', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-06 08:52:12', '2022-03-06 08:52:12'),
(13, 47, '667', '2022-03-06 10:02:50', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-06 09:02:50', '2022-03-06 09:02:50'),
(14, 47, '667', '2022-03-06 11:29:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-06 10:29:45', '2022-03-06 10:29:45'),
(15, 47, '667', '2022-03-06 11:31:18', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-06 10:31:18', '2022-03-06 10:31:18'),
(16, 40, '6587', '2022-03-06 11:35:05', '1', 'azdfiiazhnf', 'iouaziuh', 'uihiuuiuiubi', 'uiiuooidsji', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-06 10:35:05', '2022-03-06 10:35:05'),
(17, 35, '3455987', '2022-03-07 07:44:59', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-07 06:44:59', '2022-03-07 06:44:59'),
(18, 53, '24565', '2022-03-07 13:49:35', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-07 12:49:35', '2022-03-07 12:49:35'),
(19, 54, '676', '2022-03-07 15:39:30', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-07 14:39:30', '2022-03-07 14:39:30'),
(20, 54, '677', '2022-03-07 15:41:57', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-07 14:41:57', '2022-03-07 14:41:57'),
(21, 55, '7303', '2022-03-07 18:28:00', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-07 17:28:00', '2022-03-07 17:28:00'),
(22, 56, NULL, '2022-03-07 22:52:29', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-07 21:52:29', '2022-03-07 21:52:29'),
(23, 57, NULL, '2022-03-08 12:04:19', '1', 'Détergent CENTER SARL', 'Germano Electro TIC', 'Godomey, Qtier ... .Blablabla ....', 'Fandji, Kpognon ........', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-08 11:04:19', '2022-03-08 11:04:19'),
(24, 62, '2767', '2022-03-10 04:54:26', '1', 'uygvyuvyuvyuhvy', 'ygvygvhjb,ntyèuyohoio  hjj', 'jkze zeggze  zofjn zefçiazn inazfoazfzafjk bffjk ezof', 'zui zf fezfhzeiuf hzefçoezh f ezfh bezfoezf zefzeofiez hezbf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-10 03:54:26', '2022-03-10 03:54:26'),
(25, 63, '65567', '2022-03-10 08:20:17', '1', 'iuonizfenijeznfgijen', 'nijnfijzneifjozne,oif', 'njieznfijzenfgijzeong ezgze', 'ezifonze...................................................', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-10 07:20:17', '2022-03-10 07:20:17'),
(26, 61, '8778', '2022-03-10 15:54:03', '1', 'TFYTiuoiz__', 'kuhuiuih uihfuiezhfiu', 'uhuihuifeuifgeuif g', 'uiuiefhueif yeui feufigueifgoeuifuief', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-10 14:54:03', '2022-03-10 14:54:03'),
(27, 60, '435E55', '2022-03-10 16:37:53', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-10 15:37:53', '2022-03-10 15:37:53'),
(28, 64, '5467', '2022-03-10 18:21:46', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-10 17:21:46', '2022-03-10 17:21:46'),
(29, 65, '78782', '2022-03-11 18:23:14', '1', 'hvjhjb', 'hjhjhhbjkbjkbl', 'b jbhjbjsdbvjkdsvb', 'bhjbsdvhjvbdjhekvbefb', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-11 17:23:14', '2022-03-11 17:23:14'),
(30, 66, '56687', '2022-03-11 19:06:01', '1', 'Germain SARL', 'Franc et Fils', 'Godomey carrefour', 'Calavi ......................', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-11 18:06:01', '2022-03-11 18:06:01'),
(31, 67, '6767', '2022-03-14 17:57:55', '1', 'hzhjg uiog', 'ui oguio000LOOO', 'ui guio guoigcoiupkezv00', 'uèi yuioaz fguzeoiglzefvze', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 16:57:55', '2022-03-14 16:57:55'),
(32, 68, '6778', '2022-03-16 11:10:59', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-16 10:10:59', '2022-03-16 10:10:59'),
(33, 69, '7788', '2022-03-16 16:08:55', '1', 'ytf tyificy', 'ytfvutyviytvyulv;', 'utygfvty vtyi..................................;', 'dfcvt cvty igvyo yikl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-16 15:08:55', '2022-03-16 15:08:55'),
(34, 70, '677', '2022-03-17 08:43:44', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-17 07:43:44', '2022-03-17 07:43:44'),
(35, 71, '56788', '2022-03-17 09:59:09', '3', 'oih jdocdicohjp', 'io phicophdiçcoph', 'i hicovdhijcvudhzvcipou', 'ihcviopdhvcidhjcvidsjcv^n', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-17 08:59:09', '2022-03-17 08:59:09'),
(36, 74, '56568', '2022-03-22 15:32:10', '1', 'RINEL SOCIETY ....', 'GU GUIGUI', 'kjehvk76BYGVUVBu huz vui ezhviuezv', 'uiezhv iuze hvuiezhIUH UIIU HUIk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-22 14:32:10', '2022-03-22 14:32:10'),
(37, 73, '678978', '2022-03-25 14:21:16', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-25 13:21:16', '2022-03-25 13:21:16'),
(38, 56, '67667', '2022-03-25 17:57:01', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-25 16:57:01', '2022-03-25 16:57:01'),
(39, 75, '87683', '2022-03-26 13:16:45', '3', 'Freol ijzoif jzioef jzoi e', 'iozjf ioze fjio zefuio zefioz efioze', 'oieoz fjioze fuizoefueziofpuz eçif o', 'oi zifo zeuiof ezuiof ez pofzefzef', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-26 12:16:45', '2022-03-26 12:16:45');

-- --------------------------------------------------------

--
-- Structure de la table `memos`
--

DROP TABLE IF EXISTS `memos`;
CREATE TABLE IF NOT EXISTS `memos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `author_id` bigint(20) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `receiver_id` bigint(20) DEFAULT NULL,
  `receiver` varchar(255) DEFAULT NULL,
  `request_id` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `memos`
--

INSERT INTO `memos` (`id`, `title`, `author_id`, `author`, `receiver_id`, `receiver`, `request_id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, 68, NULL, 45, '2022-03-05 04:00:05', '2022-03-05 04:00:05'),
(2, NULL, NULL, NULL, 68, NULL, 45, '2022-03-05 04:01:32', '2022-03-05 04:01:32'),
(3, NULL, 69, NULL, 68, NULL, 46, '2022-03-05 04:08:08', '2022-03-05 04:08:08'),
(4, 'zefzef,zef', 69, NULL, 68, NULL, 47, '2022-03-05 04:29:44', '2022-03-05 04:29:44'),
(5, 'jijezh fiuzeh fipçoze', 69, NULL, 68, NULL, 48, '2022-03-05 04:36:25', '2022-03-05 04:36:25'),
(6, 'zefeznbkflzef iuez fze', 69, NULL, 68, NULL, 49, '2022-03-05 04:39:46', '2022-03-05 04:39:46'),
(7, 'zafkjzeb fze u iu', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 50, '2022-03-05 04:41:04', '2022-03-05 04:41:04'),
(8, 'Demande d\'achat pour manque de matériels', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 52, '2022-03-07 12:20:35', '2022-03-07 12:20:35'),
(9, 'Demande de travaux pour réparation', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 53, '2022-03-07 13:21:47', '2022-03-07 13:21:47'),
(10, 'Delandede hjezbfezj', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 54, '2022-03-07 17:33:13', '2022-03-07 17:33:13'),
(11, 'Demande de frml;ezmfler;gflmer', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 55, '2022-03-07 18:28:34', '2022-03-07 18:28:34'),
(12, 'Demande de fonds pour les travaux à GODOMEY', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 56, '2022-03-07 23:21:39', '2022-03-07 23:21:39'),
(13, 'Achat de matériels de travail pour les rues de FANDJI', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 57, '2022-03-08 12:04:44', '2022-03-08 12:04:44'),
(14, 'Titre de demande', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 62, '2022-03-10 04:55:22', '2022-03-10 04:55:22'),
(15, 'Titre de demande', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 62, '2022-03-10 04:56:11', '2022-03-10 04:56:11'),
(16, 'Achat de matériels de travail', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 63, '2022-03-10 08:21:33', '2022-03-10 08:21:33'),
(17, 'Achat ........................', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 61, '2022-03-10 15:55:54', '2022-03-10 15:55:54'),
(18, 'Travaux dans les rues de Cotonou', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 60, '2022-03-10 16:38:06', '2022-03-10 16:38:06'),
(19, ',;, zekjvn zevjez', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 64, '2022-03-10 18:22:08', '2022-03-10 18:22:08'),
(20, 'Gerozytugiuf zfiu', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 65, '2022-03-11 18:23:26', '2022-03-11 18:23:26'),
(21, 'Demande de fonds pour achat de pièces', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 66, '2022-03-11 19:09:04', '2022-03-11 19:09:04'),
(22, 'Travaux travaux', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 67, '2022-03-14 18:36:15', '2022-03-14 18:36:15'),
(23, 'ezki zeihof ioze fuio pzefm', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 68, '2022-03-16 11:11:12', '2022-03-16 11:11:12'),
(24, 'Yuyzeguifo zepf hiopzefh', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 69, '2022-03-16 16:29:58', '2022-03-16 16:29:58'),
(25, 'Totototofdo do', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 70, '2022-03-17 08:44:42', '2022-03-17 08:44:42'),
(26, 'OPOPOPzeflknzekof,zpoefp,oezfz', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 71, '2022-03-17 10:02:51', '2022-03-17 10:02:51'),
(27, 'Achat pour travaux sur les rues de ?........', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 74, '2022-03-22 15:33:34', '2022-03-22 15:33:34'),
(28, 'Demande d\'achat de matériels pour les travaux à ZOGBO', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 73, '2022-03-25 17:03:57', '2022-03-25 17:03:57'),
(29, 'Achat pour travaux sur les rues de ?........', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 74, '2022-03-26 11:41:32', '2022-03-26 11:41:32'),
(30, 'Gzedzejifdoezmkidfoezjfmd', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 75, '2022-03-26 13:18:35', '2022-03-26 13:18:35'),
(31, 'Yuyzeguifo zepf hiopzefh', 69, 'GOHOUNGO Pierre', 68, 'ABALO Jean', 69, '2022-03-26 22:34:26', '2022-03-26 22:34:26');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=192 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `title`, `content`, `sender_id`, `receiver_id`, `created_at`, `updated_at`) VALUES
(136, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/24\">ici</a>', 69, 68, '2022-03-03 17:58:54', '2022-03-03 17:58:54'),
(135, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/22\">ici</a>', 69, 68, '2022-03-03 16:24:43', '2022-03-03 16:24:43'),
(134, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/21\">ici</a>', 69, 68, '2022-03-03 15:08:13', '2022-03-03 15:08:13'),
(133, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/20\">ici</a>', 69, 68, '2022-03-03 13:54:29', '2022-03-03 13:54:29'),
(132, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/16\">ici</a>', 69, 68, '2022-03-02 20:39:53', '2022-03-02 20:39:53'),
(131, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/16\">ici</a>', 69, 68, '2022-03-02 20:23:27', '2022-03-02 20:23:27'),
(126, NULL, 'Yo', 69, 65, '2022-03-02 15:50:50', '2022-03-02 15:50:50'),
(127, NULL, 'Coucou', 69, 65, '2022-03-02 16:01:20', '2022-03-02 16:01:20'),
(128, NULL, 'Wzfezgf', 69, 65, '2022-03-02 16:02:20', '2022-03-02 16:02:20'),
(129, NULL, 'Bonjour monsieur/madame Bénoît ABALO, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/13\">ici</a>', 69, 67, '2022-03-02 19:34:16', '2022-03-02 19:34:16'),
(130, NULL, 'Bonjour monsieur/madame Bénoît ABALO, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/14\">ici</a>', 69, 67, '2022-03-02 19:44:49', '2022-03-02 19:44:49'),
(137, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/26\">ici</a>', 69, 68, '2022-03-03 18:37:57', '2022-03-03 18:37:57'),
(138, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/27\">ici</a>', 69, 68, '2022-03-03 19:17:22', '2022-03-03 19:17:22'),
(139, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/28\">ici</a>', 69, 68, '2022-03-04 04:48:24', '2022-03-04 04:48:24'),
(140, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/29\">ici</a>', 69, 68, '2022-03-04 05:06:50', '2022-03-04 05:06:50'),
(141, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/30\">ici</a>', 69, 68, '2022-03-04 05:09:12', '2022-03-04 05:09:12'),
(142, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/31\">ici</a>', 69, 68, '2022-03-04 05:34:03', '2022-03-04 05:34:03'),
(143, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/32\">ici</a>', 69, 68, '2022-03-04 05:45:59', '2022-03-04 05:45:59'),
(144, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/33\">ici</a>', 69, 68, '2022-03-04 05:59:18', '2022-03-04 05:59:18'),
(145, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/34', 69, 68, '2022-03-04 06:32:41', '2022-03-04 06:32:41'),
(146, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/35', 69, 68, '2022-03-04 06:35:07', '2022-03-04 06:35:07'),
(147, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/35\">ici</a>', 69, 68, '2022-03-04 06:37:37', '2022-03-04 06:37:37'),
(148, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/36\">ici</a>', 69, 68, '2022-03-04 06:40:45', '2022-03-04 06:40:45'),
(149, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/36\">ici</a>', 69, 68, '2022-03-04 06:41:34', '2022-03-04 06:41:34'),
(150, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/36\">ici</a>', 69, 68, '2022-03-04 06:42:53', '2022-03-04 06:42:53'),
(151, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/36\">ici</a>', 69, 68, '2022-03-04 06:43:29', '2022-03-04 06:43:29'),
(152, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/37\">ici</a>', 69, 68, '2022-03-04 06:45:58', '2022-03-04 06:45:58'),
(153, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant <a :href=\"http://127.0.0.1:8000/user/requests/38\">ici</a>', 69, 68, '2022-03-04 06:51:13', '2022-03-04 06:51:13'),
(154, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant href=\"http://127.0.0.1:8000/user/requests/39', 69, 68, '2022-03-04 06:54:47', '2022-03-04 06:54:47'),
(155, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/40', 69, 68, '2022-03-04 07:02:08', '2022-03-04 07:02:08'),
(156, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/41', 69, 68, '2022-03-04 07:03:45', '2022-03-04 07:03:45'),
(157, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/42', 69, 68, '2022-03-04 07:24:37', '2022-03-04 07:24:37'),
(158, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/43', 69, 68, '2022-03-04 08:09:27', '2022-03-04 08:09:27'),
(159, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/44', 69, 68, '2022-03-04 09:16:55', '2022-03-04 09:16:55'),
(160, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/45', 69, 68, '2022-03-05 02:58:34', '2022-03-05 02:58:34'),
(161, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/45', 69, 68, '2022-03-05 03:00:05', '2022-03-05 03:00:05'),
(162, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/45', 69, 68, '2022-03-05 03:01:32', '2022-03-05 03:01:32'),
(163, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/46', 69, 68, '2022-03-05 03:08:08', '2022-03-05 03:08:08'),
(164, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/47', 69, 68, '2022-03-05 03:29:44', '2022-03-05 03:29:44'),
(165, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/48', 69, 68, '2022-03-05 03:36:25', '2022-03-05 03:36:25'),
(166, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/49', 69, 68, '2022-03-05 03:39:46', '2022-03-05 03:39:46'),
(167, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/50', 69, 68, '2022-03-05 03:41:04', '2022-03-05 03:41:04'),
(168, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/52', 69, 68, '2022-03-07 11:20:35', '2022-03-07 11:20:35'),
(169, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/53', 69, 68, '2022-03-07 12:21:47', '2022-03-07 12:21:47'),
(170, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/54', 69, 68, '2022-03-07 16:33:13', '2022-03-07 16:33:13'),
(171, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/55', 69, 68, '2022-03-07 17:28:34', '2022-03-07 17:28:34'),
(172, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/56', 69, 68, '2022-03-07 22:21:39', '2022-03-07 22:21:39'),
(173, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/57', 69, 68, '2022-03-08 11:04:44', '2022-03-08 11:04:44'),
(174, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/62', 69, 68, '2022-03-10 03:55:22', '2022-03-10 03:55:22'),
(175, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/62', 69, 68, '2022-03-10 03:56:11', '2022-03-10 03:56:11'),
(176, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/63', 69, 68, '2022-03-10 07:21:33', '2022-03-10 07:21:33'),
(177, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/61', 69, 68, '2022-03-10 14:55:54', '2022-03-10 14:55:54'),
(178, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/60', 69, 68, '2022-03-10 15:38:06', '2022-03-10 15:38:06'),
(179, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/64', 69, 68, '2022-03-10 17:22:08', '2022-03-10 17:22:08'),
(180, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/65', 69, 68, '2022-03-11 17:23:26', '2022-03-11 17:23:26'),
(181, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/66', 69, 68, '2022-03-11 18:09:04', '2022-03-11 18:09:04'),
(182, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/67', 69, 68, '2022-03-14 17:36:15', '2022-03-14 17:36:15'),
(183, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/68', 69, 68, '2022-03-16 10:11:12', '2022-03-16 10:11:12'),
(184, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/69', 69, 68, '2022-03-16 15:29:57', '2022-03-16 15:29:57'),
(185, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/70', 69, 68, '2022-03-17 07:44:42', '2022-03-17 07:44:42'),
(186, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/71', 69, 68, '2022-03-17 09:02:51', '2022-03-17 09:02:51'),
(187, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/74', 69, 68, '2022-03-22 14:33:34', '2022-03-22 14:33:34'),
(188, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/73', 69, 68, '2022-03-25 16:03:56', '2022-03-25 16:03:56'),
(189, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/74', 69, 68, '2022-03-26 10:41:32', '2022-03-26 10:41:32'),
(190, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir avec moi si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/75', 69, 68, '2022-03-26 12:18:35', '2022-03-26 12:18:35'),
(191, NULL, 'Bonjour monsieur/madame ABALO Jean, j\'ai redigé une demande que je vous envoie afin que vous puissiez voir si j\'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant http://127.0.0.1:8000/user/requests/69', 69, 68, '2022-03-26 21:34:26', '2022-03-26 21:34:26');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2012_02_17_174923_create_departments_table', 1),
(2, '2012_02_17_185736_create_services_table', 1),
(3, '2012_02_20_185622_create_grades_table', 1),
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2022_02_10_192925_create_sessions_table', 1),
(10, '2022_02_11_121006_create_permission_tables', 1),
(11, '2022_02_21_113119_create_request_types_table', 1),
(12, '2022_02_21_113703_create_requests_table', 1),
(13, '2022_02_21_113820_create_messages_table', 1),
(14, '2022_02_21_113922_create_notifications_table', 1),
(15, '2022_02_21_114009_create_materials_table', 1),
(16, '2022_02_21_114041_create_mat_transferts_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(15, 'App\\Models\\User', 6),
(15, 'App\\Models\\User', 8),
(15, 'App\\Models\\User', 9),
(15, 'App\\Models\\User', 10),
(15, 'App\\Models\\User', 11),
(15, 'App\\Models\\User', 12),
(15, 'App\\Models\\User', 13),
(15, 'App\\Models\\User', 14),
(15, 'App\\Models\\User', 15),
(15, 'App\\Models\\User', 16),
(15, 'App\\Models\\User', 17),
(15, 'App\\Models\\User', 19),
(15, 'App\\Models\\User', 20),
(15, 'App\\Models\\User', 21),
(15, 'App\\Models\\User', 22),
(15, 'App\\Models\\User', 23),
(15, 'App\\Models\\User', 24),
(15, 'App\\Models\\User', 25),
(15, 'App\\Models\\User', 26),
(15, 'App\\Models\\User', 27),
(15, 'App\\Models\\User', 28),
(15, 'App\\Models\\User', 29),
(15, 'App\\Models\\User', 30),
(15, 'App\\Models\\User', 31),
(15, 'App\\Models\\User', 32),
(15, 'App\\Models\\User', 33),
(15, 'App\\Models\\User', 34),
(15, 'App\\Models\\User', 35),
(15, 'App\\Models\\User', 36),
(15, 'App\\Models\\User', 37),
(15, 'App\\Models\\User', 38),
(15, 'App\\Models\\User', 39),
(15, 'App\\Models\\User', 40),
(15, 'App\\Models\\User', 42),
(15, 'App\\Models\\User', 43),
(15, 'App\\Models\\User', 44),
(15, 'App\\Models\\User', 45),
(15, 'App\\Models\\User', 46),
(15, 'App\\Models\\User', 47),
(15, 'App\\Models\\User', 48),
(15, 'App\\Models\\User', 49),
(15, 'App\\Models\\User', 50),
(15, 'App\\Models\\User', 51),
(15, 'App\\Models\\User', 54);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 6),
(5, 'App\\Models\\User', 8),
(5, 'App\\Models\\User', 9),
(5, 'App\\Models\\User', 10),
(5, 'App\\Models\\User', 11),
(5, 'App\\Models\\User', 12),
(5, 'App\\Models\\User', 13),
(5, 'App\\Models\\User', 14),
(5, 'App\\Models\\User', 15),
(5, 'App\\Models\\User', 16),
(5, 'App\\Models\\User', 17),
(5, 'App\\Models\\User', 19),
(5, 'App\\Models\\User', 20),
(5, 'App\\Models\\User', 21),
(5, 'App\\Models\\User', 22),
(5, 'App\\Models\\User', 23),
(5, 'App\\Models\\User', 24),
(5, 'App\\Models\\User', 25),
(5, 'App\\Models\\User', 26),
(5, 'App\\Models\\User', 27),
(5, 'App\\Models\\User', 28),
(5, 'App\\Models\\User', 29),
(5, 'App\\Models\\User', 30),
(5, 'App\\Models\\User', 31),
(5, 'App\\Models\\User', 32),
(5, 'App\\Models\\User', 33),
(5, 'App\\Models\\User', 34),
(5, 'App\\Models\\User', 35),
(5, 'App\\Models\\User', 36),
(5, 'App\\Models\\User', 37),
(5, 'App\\Models\\User', 38),
(5, 'App\\Models\\User', 39),
(5, 'App\\Models\\User', 40),
(5, 'App\\Models\\User', 42),
(5, 'App\\Models\\User', 43),
(5, 'App\\Models\\User', 44),
(5, 'App\\Models\\User', 45),
(5, 'App\\Models\\User', 46),
(5, 'App\\Models\\User', 47),
(5, 'App\\Models\\User', 48),
(5, 'App\\Models\\User', 49),
(5, 'App\\Models\\User', 50),
(5, 'App\\Models\\User', 51),
(2, 'App\\Models\\User', 74),
(5, 'App\\Models\\User', 73),
(5, 'App\\Models\\User', 54),
(5, 'App\\Models\\User', 59),
(5, 'App\\Models\\User', 60),
(5, 'App\\Models\\User', 61),
(5, 'App\\Models\\User', 62),
(5, 'App\\Models\\User', 63),
(5, 'App\\Models\\User', 64),
(5, 'App\\Models\\User', 65),
(5, 'App\\Models\\User', 66),
(5, 'App\\Models\\User', 67),
(5, 'App\\Models\\User', 68),
(5, 'App\\Models\\User', 69),
(5, 'App\\Models\\User', 70),
(5, 'App\\Models\\User', 71),
(2, 'App\\Models\\User', 72),
(5, 'App\\Models\\User', 75),
(5, 'App\\Models\\User', 76),
(2, 'App\\Models\\User', 77),
(5, 'App\\Models\\User', 78),
(5, 'App\\Models\\User', 79),
(5, 'App\\Models\\User', 80);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('angehermel@gmail.com', '$2y$10$hB8JMH6M41qJN3XnuOaineKbuqW6Tl9SPrna3mNhsJ1clUIRaD8IC', '2022-03-10 06:01:20');

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create:user', 'create user', 'web', '2022-02-21 11:47:53', '2022-02-21 11:47:53'),
(2, 'read: user', 'read user', 'web', '2022-02-21 11:47:53', '2022-02-21 11:47:53'),
(3, 'update: user', 'update user', 'web', '2022-02-21 11:47:53', '2022-02-21 11:47:53'),
(4, 'delete: user', 'delete User', 'web', '2022-02-21 11:47:53', '2022-02-21 11:47:53'),
(5, 'create: role', 'create role', 'web', '2022-02-21 11:47:53', '2022-02-21 11:47:53'),
(6, 'read: role', 'read role', 'web', '2022-02-21 11:47:53', '2022-02-21 11:47:53'),
(7, 'update: role', 'update role', 'web', '2022-02-21 11:47:53', '2022-02-21 11:47:53'),
(8, 'delete: role', 'delete role', 'web', '2022-02-21 11:47:53', '2022-02-21 11:47:53'),
(9, 'create: permission', 'create permission', 'web', '2022-02-21 11:47:53', '2022-02-21 11:47:53'),
(10, 'read: permission', 'read permission', 'web', '2022-02-21 11:47:53', '2022-02-21 11:47:53'),
(11, 'update: permission', 'update permission', 'web', '2022-02-21 11:47:53', '2022-02-21 11:47:53'),
(12, 'delete: permission', 'delete permission', 'web', '2022-02-21 11:47:53', '2022-02-21 11:47:53'),
(13, 'read: admin', 'read admin', 'web', '2022-02-21 11:47:53', '2022-02-21 11:47:53'),
(14, 'update: admin', 'update admin', 'web', '2022-02-21 11:47:53', '2022-02-21 11:47:53'),
(15, 'N/A', 'N/A', 'web', '2022-02-21 11:47:53', '2022-02-21 11:47:53');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reject_motions`
--

DROP TABLE IF EXISTS `reject_motions`;
CREATE TABLE IF NOT EXISTS `reject_motions` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `request_id` int(20) DEFAULT NULL,
  `description` longtext,
  `cReject` enum('0','1') DEFAULT '0',
  `author_id` int(20) NOT NULL,
  `user_grade` int(20) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reject_motions`
--

INSERT INTO `reject_motions` (`id`, `request_id`, `description`, `cReject`, `author_id`, `user_grade`, `created_at`, `updated_at`) VALUES
(3, 10, 'Je rejecte cette demande parce que ...............................', '1', 66, 3, '2022-02-28 22:10:25', '2022-02-28 22:10:25'),
(4, 10, 'decsr zfjhzef nzefjkze fez jk', '1', 66, 3, '2022-02-28 22:20:56', '2022-02-28 22:20:56'),
(5, 12, 'je rejète cette demande parce que ............................................................................', '1', 68, 5, '2022-03-02 14:21:37', '2022-03-02 14:21:37'),
(6, 13, 'Rejetée parce que............... Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odio, in totam fugiat nesciunt officiis ad quisquam consequatur distinctio aliquam, dignissimos aspernatur culpa ea corporis vitae natus! Necessitatibus ab dolores repellat.Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odio, in totam fugiat nesciunt officiis ad quisquam consequatur distinctio aliquam, dignissimos aspernatur culpa ea corporis vitae natus! Necessitatibus ab dolores repellat.Lorem', '1', 68, 5, '2022-03-02 20:39:46', '2022-03-02 20:39:46'),
(7, 11, 'ToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToastToast', '1', 68, 5, '2022-03-02 20:42:47', '2022-03-02 20:42:47'),
(8, 14, 'return Inertia::render(\'User/Requests/Traited\', [\n                    // \'requests\' => RequestData::with(\'user_id\', $user_id)->get(),\n                    // \'request_type\' => Request_type::where(\'id\', $reqId),\n                    \'requests\' => RequestData::where(\'status\', \'!=\', \'0\')\n                                                ->where(\'sent_or\', \'1\')\n                                                ->where(\'sH_approval\', \'!=\', null)', '1', 68, 5, '2022-03-02 20:46:06', '2022-03-02 20:46:06'),
(9, 21, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis modi quaerat quam tempora ab distinctio exercitationem id laboriosam minus soluta accusamus similique laborum numquam eaque nam, odio quis voluptates illum?Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis modi quaerat quam tempora ab distinctio exercitationem id laboriosam minus soluta accusamus similique laborum numquam eaque nam, odio quis voluptates illum?', '1', 67, 4, '2022-03-03 16:59:43', '2022-03-03 16:59:43'),
(10, 22, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, assumenda odio! Deserunt, consequuntur aperiam suscipit ratione error, vel expedita molestias consequatur cupiditate tempora, quis assumenda fugiat accusamus adipisci esse veritatis?Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, assumenda odio! Deserunt, consequuntur aperiam suscipit ratione error, vel expedita molestias consequatur cupiditate tempora, quis assumenda fugiat accusamus adipisci esse verita', '0', 68, 5, '2022-03-03 17:25:35', '2022-03-03 17:25:35'),
(11, 24, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem aliquam, facilis rerum architecto iste atque dignissimos dicta temporibus id ullam aperiam cupiditate nisi deleniti animi eos amet! Illum, quod repudiandae?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem aliquam, facilis rerum architecto iste atque dignissimos dicta temporibus id ullam aperiam cupiditate nisi deleniti animi eos amet! Illum, quod repudiandae?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Au', '0', 68, 5, '2022-03-03 19:00:26', '2022-03-03 19:00:26'),
(12, 27, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia veritatis corporis aut aliquid natus quis suscipit ea necessitatibus sint totam? Obcaecati, illum enim voluptatum debitis nesciunt exercitationem molestiae vero numquam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia veritatis corporis aut aliquid natus quis suscipit ea necessitatibus sint totam? Obcaecati, illum enim voluptatum debitis nesciunt exercitationem molestiae vero numquam.Lorem ipsum dolor sit amet, consecte', '0', 68, 5, '2022-03-03 20:22:09', '2022-03-03 20:22:09'),
(13, 27, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia veritatis corporis aut aliquid natus quis suscipit ea necessitatibus sint totam? Obcaecati, illum enim voluptatum debitis nesciunt exercitationem molestiae vero numquam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia veritatis corporis aut aliquid natus quis suscipit ea necessitatibus sint totam? Obcaecati, illum enim voluptatum debitis nesciunt exercitationem molestiae vero numquam.Lorem ipsum dolor sit amet, consecte', '0', 68, 5, '2022-03-03 20:24:32', '2022-03-03 20:24:32'),
(14, 27, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia veritatis corporis aut aliquid natus quis suscipit ea necessitatibus sint totam? Obcaecati, illum enim voluptatum debitis nesciunt exercitationem molestiae vero numquam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia veritatis corporis aut aliquid natus quis suscipit ea necessitatibus sint totam? Obcaecati, illum enim voluptatum debitis nesciunt exercitationem molestiae vero numquam.Lorem ipsum dolor sit amet, consecte', '1', 68, 5, '2022-03-03 20:25:20', '2022-03-03 20:25:20'),
(15, 27, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia veritatis corporis aut aliquid natus quis suscipit ea necessitatibus sint totam? Obcaecati, illum enim voluptatum debitis nesciunt exercitationem molestiae vero numquam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia veritatis corporis aut aliquid natus quis suscipit ea necessitatibus sint totam? Obcaecati, illum enim voluptatum debitis nesciunt exercitationem molestiae vero numquam.Lorem ipsum dolor sit amet, consecte', '0', 67, 4, '2022-03-03 20:27:16', '2022-03-03 20:27:16'),
(16, 42, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero, laboriosam amet recusandae, nisi perferendis exercitationem quaerat non officiis earum officia nihil aspernatur soluta saepe deserunt asperiores dolores maxime atque esse!Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero, laboriosam amet recusandae, nisi perferendis exercitationem quaerat non officiis earum officia nihil aspernatur soluta saepe deserunt asperiores dolores maxime atque esse!Lorem ipsum, dolor sit amet co', '0', 68, 5, '2022-03-04 08:25:19', '2022-03-04 08:25:19'),
(17, 41, 'ero, laboriosam amet recusandae, nisi perferendis exercitationem quaerat non officiis earum officia nihil aspernatur soluta saepe deserunt asperiores dolores maxime atque esse!Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero, laboriosam amet recusandae, nisi perferendis exercitationem quaerat non officiis earum officia nihil aspernatur soluta saepe deserunt asperiores dolores maxime atque esse!Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero, laboriosam amet recusanda', '0', 68, 5, '2022-03-04 08:50:21', '2022-03-04 08:50:21'),
(18, 41, 'return Inertia::render(\'User/Requests/Sent\', [\n                // \'requests\' => RequestData::with(\'user_id\', $user_id)->get(),\n                \'requests\' => RequestData::whereBelongsTo($user)\n                                            ->where(\'status\', \'!=\', \'0\')\n                                            ->where(\'sent_or\', \'1\')\n                                            ->where(\'on_treat\', null)\n                                            ->where(\'token\', \'!=\', null)', '0', 68, 5, '2022-03-04 08:55:22', '2022-03-04 08:55:22'),
(19, 41, 'return Inertia::render(\'User/Requests/Sent\', [\n                // \'requests\' => RequestData::with(\'user_id\', $user_id)->get(),\n                \'requests\' => RequestData::whereBelongsTo($user)\n                                            ->where(\'status\', \'!=\', \'0\')\n                                            ->where(\'sent_or\', \'1\')\n                                            ->where(\'on_treat\', null)\n                                            ->where(\'token\', \'!=\', null)', '0', 68, 5, '2022-03-04 08:57:47', '2022-03-04 08:57:47'),
(20, 43, 'zajkkfdzuiaofoiuzae          return Inertia::render(\'User/Requests/Sent\', [\n                // \'requests\' => RequestData::with(\'user_id\', $user_id)->get(),\n                \'requests\' => RequestData::whereBelongsTo($user)\n                                            ->where(\'status\', \'!=\', \'0\')\n                                            ->where(\'sent_or\', \'1\')\n                                            ->where(\'on_treat\', null)\n                                            ->where(\'token\', \'!=\', n', '0', 68, 5, '2022-03-04 09:10:09', '2022-03-04 09:10:09'),
(21, 43, 'return Inertia::render(\'User/Requests/Sent\', [\n                // \'requests\' => RequestData::with(\'user_id\', $user_id)->get(),\n                \'requests\' => RequestData::whereBelongsTo($user)\n                                            ->where(\'status\', \'!=\', \'0\')\n                                            ->where(\'sent_or\', \'1\')\n                                            ->where(\'on_treat\', null)\n                                            ->where(\'token\', \'!=\', null)', '1', 68, 5, '2022-03-04 09:11:29', '2022-03-04 09:11:29'),
(22, 43, 'Rejeteyuezfuyze          return Inertia::render(\'User/Requests/Sent\', [\n                // \'requests\' => RequestData::with(\'user_id\', $user_id)->get(),\n                \'requests\' => RequestData::whereBelongsTo($user)\n                                            ->where(\'status\', \'!=\', \'0\')\n                                            ->where(\'sent_or\', \'1\')\n                                            ->where(\'on_treat\', null)\n                                            ->where(\'token\', \'!=\', null)', '0', 67, 4, '2022-03-04 09:18:18', '2022-03-04 09:18:18'),
(23, 43, 'FFFFRejet ozefj zeof          return Inertia::render(\'User/Requests/Sent\', [\n                // \'requests\' => RequestData::with(\'user_id\', $user_id)->get(),\n                \'requests\' => RequestData::whereBelongsTo($user)\n                                            ->where(\'status\', \'!=\', \'0\')\n                                            ->where(\'sent_or\', \'1\')\n                                            ->where(\'on_treat\', null)\n                                            ->where(\'token\', \'!=\',', '1', 67, 4, '2022-03-04 09:20:42', '2022-03-04 09:20:42'),
(24, 43, 'yuegzfyuze          return Inertia::render(\'User/Requests/Sent\', [\n                // \'requests\' => RequestData::with(\'user_id\', $user_id)->get(),\n                \'requests\' => RequestData::whereBelongsTo($user)\n                                            ->where(\'status\', \'!=\', \'0\')\n                                            ->where(\'sent_or\', \'1\')\n                                            ->where(\'on_treat\', null)\n                                            ->where(\'token\', \'!=\', null)', '0', 66, 3, '2022-03-04 09:23:45', '2022-03-04 09:23:45'),
(25, 44, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur, sit! Eveniet, dolorem fugit reprehenderit earum ipsum unde necessitatibus, consequuntur illum nesciunt atque veritatis exercitationem quia tempora culpa assumenda! Cupiditate, quae.Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur, sit! Eveniet, dolorem fugit reprehenderit earum ipsum unde necessitatibus, consequuntur illum nesciunt atque veritatis exercitationem quia tempora culpa assumenda! Cupiditate, q', '0', 67, 4, '2022-03-05 10:03:59', '2022-03-05 10:03:59'),
(26, 50, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem quibusdam aliquam vel voluptatibus maiores dolores ad distinctio, blanditiis error sint nisi illo ea a molestiae eaque quaerat dolore aut temporibus.Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem quibusdam aliquam vel voluptatibus maiores dolores ad distinctio, blanditiis error sint nisi illo ea a molestiae eaque quaerat dolore aut temporibus.Lorem ipsum dolor sit amet consectetur adipisicing elit. E', '0', 68, 5, '2022-03-05 14:40:35', '2022-03-05 14:40:35'),
(27, 49, 'this.closeModal()\n                        this.closeModal()\nkajzndjkazdnioazdm jiazodj ioazd', '0', 68, 5, '2022-03-05 14:43:01', '2022-03-05 14:43:01'),
(28, 48, 'hToast.fire({\n                            icon: \'success\',\n                            title: \'Le département a été modifié avec succès !\'\n                        })Toast.fire({\n                            icon: \'success\',\n                            title: \'Le département a été modifié avec succès !\'\n                        })llazioz oizj p', '0', 68, 5, '2022-03-05 14:46:01', '2022-03-05 14:46:01'),
(29, 41, 'return Inertia::render(\'User/Dashboard\', [\n                \'requests\' => RequestData::where(\'status\', \'!=\', \'0\')\n                                            ->where(\'sent_or\', \'1\')\n                                            ->where(\'sH_approval\', \'!=\', null)\n                                            ->where(\'user_service_id\', $user_service)\n                                            ->orderByDesc(\'created_at\')\n                                            ->get(),\n                \'reques', '0', 68, 5, '2022-03-05 14:49:25', '2022-03-05 14:49:25'),
(30, 46, '<ul id=\"menu\">\n      <li><a href=\"index.html\">Accueil</a></li>\n      <li><a href=\"page_a.html\">Page A</a></li>\n      <li><a href=\"page_b.html\">Page B</a></li>\n    </ul>\n    <div id=\"content\">\n      <h1>Accueil</h1>\n    \n      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit', '0', 68, 5, '2022-03-06 07:45:09', '2022-03-06 07:45:09'),
(31, 47, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam magnam autem aspernatur, tempore voluptatibus fuga expedita sed cumque ex illo nam, neque animi, mollitia aliquid officia consequuntur nemo ad praesentium.Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam magnam autem aspernatur, tempore voluptatibus fuga expedita sed cumque ex illo nam, neque animi, mollitia aliquid officia consequuntur nemo ad praesentium.Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam m', '0', 67, 4, '2022-03-07 12:01:34', '2022-03-07 12:01:34'),
(32, 52, 'SH REJECT Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta architecto vitae sed tenetur adipisci quae, ab veniam ipsa quia error accusantium sit deleniti consectetur dolores rem saepe aliquam nostrum. Asperiores!Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta architecto vitae sed tenetur adipisci quae, ab veniam ipsa quia error accusantium sit deleniti consectetur dolores rem saepe aliquam nostrum. Asperiores!Lorem ipsum, dolor sit amet consectetur adipisicing elit', '0', 68, 5, '2022-03-07 12:21:20', '2022-03-07 12:21:20'),
(33, 47, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Architecto magni nisi illo. Culpa aliquid velit tempora exercitationem sequi explicabo autem asperiores necessitatibus natus magnam consequuntur deleniti, sit illum quibusdam. Pariatur!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Architecto magni nisi illo. Culpa aliquid velit tempora exercitationem sequi explicabo autem asperiores necessitatibus natus magnam consequuntur deleniti, sit illum quibusdam. Pariatur!', '0', 66, 3, '2022-03-07 12:38:59', '2022-03-07 12:38:59'),
(34, 53, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero animi voluptatibus, eum odio doloremque dicta. Architecto, deleniti! Voluptate, modi distinctio sit harum, voluptatibus, quia temporibus veniam neque reiciendis amet repellendus.Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero animi voluptatibus, eum odio doloremque dicta. Architecto, deleniti! Voluptate, modi distinctio sit harum, voluptatibus, quia temporibus veniam neque reiciendis amet repellendus.Lorem ipsum dolor,', '0', 68, 5, '2022-03-07 13:29:30', '2022-03-07 13:29:30'),
(35, 53, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero animi voluptatibus, eum odio doloremque dicta. Architecto, deleniti! Voluptate, modi distinctio sit harum, voluptatibus, quia temporibus veniam neque reiciendis amet repellendus.Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero animi voluptatibus, eum odio doloremque dicta. Architecto, deleniti! Voluptate, modi distinctio sit harum, voluptatibus, quia temporibus veniam neque reiciendis amet repellendus.Lorem ipsum dolor,', '0', 67, 4, '2022-03-07 13:41:25', '2022-03-07 13:41:25'),
(36, 54, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum porro magnam perspiciatis eos veritatis totam, iure ullam ducimus ipsa? Quidem ipsum perferendis, voluptate praesentium eligendi ullam iusto inventore sit voluptates.Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum porro magnam perspiciatis eos veritatis totam, iure ullam ducimus ipsa? Quidem ipsum perferendis, voluptate praesentium eligendi ullam iusto inventore sit voluptates.', '0', 68, 5, '2022-03-07 17:35:31', '2022-03-07 17:35:31'),
(37, 54, '<input type=\"hidden\" name=\"mat_id[]\" value=\"<?= $mater->id ?>\">\n                                                    <input type=\"hidden\" name=\"mat_id[]\" value=\"<?= $mater->id ?>\">\n                                                    <input type=\"hidden\" name=\"mat_id[]\" value=\"<?= $mater->id ?>\">', '0', 68, 5, '2022-03-07 18:07:46', '2022-03-07 18:07:46'),
(38, 56, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora temporibus ipsum nihil possimus quidem culpa laborum ipsa, labore ratione ullam vitae non consequuntur perspiciatis in distinctio quos, alias eos itaque!Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora temporibus ipsum nihil possimus quidem culpa laborum ipsa, labore ratione ullam vitae non consequuntur perspiciatis in distinctio quos, alias eos itaque!', '0', 67, 4, '2022-03-07 23:29:26', '2022-03-07 23:29:26'),
(39, 56, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis molestias debitis perferendis fugit corrupti sit autem eos error modi quaerat fuga, totam impedit, animi culpa cumque magni? Voluptatum, reprehenderit repellendus.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis molestias debitis perferendis fugit corrupti sit autem eos error modi quaerat fuga, totam impedit, animi culpa cumque magni? Voluptatum, reprehenderit repellendus.Lorem ipsum, dolor sit amet consectetur', '0', 66, 3, '2022-03-08 00:20:47', '2022-03-08 00:20:47'),
(40, 56, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis consectetur natus rem odit eveniet aperiam nemo omnis nihil qui animi, adipisci quae laudantium, nulla debitis ex excepturi, dolorum labore illo!Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis consectetur natus rem odit eveniet aperiam nemo omnis nihil qui animi, adipisci quae laudantium, nulla debitis ex excepturi, dolorum labore illo!Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis consec', '0', 73, 2, '2022-03-08 00:33:19', '2022-03-08 00:33:19'),
(41, 57, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam quia harum officiis quos, non repudiandae necessitatibus laboriosam fugit dolorum eum deserunt consequuntur recusandae earum doloribus asperiores quam nam! Nihil, porro?Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam quia harum officiis quos, non repudiandae necessitatibus laboriosam fugit dolorum eum deserunt consequuntur recusandae earum doloribus asperiores quam nam! Nihil, porro?', '0', 68, 5, '2022-03-08 12:06:11', '2022-03-08 12:06:11'),
(42, 57, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sed at harum ad qui blanditiis minima quisquam recusandae explicabo, et similique voluptatem labore dolorem quasi dignissimos culpa nisi sunt autem. Necessitatibus!Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sed at harum ad qui blanditiis minima quisquam recusandae explicabo, et similique voluptatem labore dolorem quasi dignissimos culpa nisi sunt autem. Necessitatibus!Lorem ipsum dolor sit amet consectetur, adipisicing elit', '0', 73, 2, '2022-03-08 12:16:45', '2022-03-08 12:16:45'),
(43, 62, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut dolorum nihil id obcaecati vitae facilis doloremque iste, ab laboriosam dicta enim corporis eos saepe incidunt perspiciatis autem eaque unde voluptatem?Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut dolorum nihil id obcaecati vitae facilis doloremque iste, ab laboriosam dicta enim corporis eos saepe incidunt perspiciatis autem eaque unde voluptatem?Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut dolorum nihil', '0', 68, 5, '2022-03-10 04:57:15', '2022-03-10 04:57:15'),
(44, 62, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut dolorum nihil id obcaecati vitae facilis doloremque iste, ab laboriosam dicta enim corporis eos saepe incidunt perspiciatis autem eaque unde voluptatem?Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut dolorum nihil id obcaecati vitae facilis doloremque iste, ab laboriosam dicta enim corporis eos saepe incidunt perspiciatis autem eaque unde voluptatem?Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut dolorum nihil', '0', 73, 2, '2022-03-10 05:08:22', '2022-03-10 05:08:22'),
(45, 63, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo non ex, sit sunt minus beatae necessitatibus debitis laudantium enim tenetur. Facere possimus adipisci quas ipsum laborum accusamus earum, commodi voluptatum.Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo non ex, sit sunt minus beatae necessitatibus debitis laudantium enim tenetur. Facere possimus adipisci quas ipsum laborum accusamus earum, commodi voluptatum.Lorem ipsum dolor sit, amet consectetur adipisicing elit. Qu', '0', 68, 5, '2022-03-10 08:24:55', '2022-03-10 08:24:55'),
(46, 60, '$reqNum = $request->request_number;\n                \n                    $the_user = User::select(\'*\')->where(\'id\', $request->user_id)->first();\n                    $content = \"Bonjour Mr $the_user->surame \" . \" $the_user->name, votre demande vient d\'être rejetée par le supérieur hiérarchique. Veuillez consulter le suivi de votre demande pour voir le motif de ce rejet.\";\n                    $subject = \"Rejet par le supérieur hiérarchique\";\n                    Mail::to($the_user->emai', '0', 68, 5, '2022-03-10 16:40:25', '2022-03-10 16:40:25'),
(47, 60, 'preserveScroll: true,\n                            onSuccess: ()=> {\n                                Swal.fire(\n                                    \'Approuvée !\',\n                                    \'La demande a été bien approuvée\',\n                                    \'success\'\n                                )\n                            }    preserveScroll: true,\n                            onSuccess: ()=> {\n                                Swal.fire(\n                                    \'Ap', '0', 68, 5, '2022-03-10 16:50:18', '2022-03-10 16:50:18'),
(48, 64, 'this.form.post(this.route(\'user.requests.reject\', this.form.id, this.form), {\n                    preserveScroll: true,\n                    onSuccess: ()=> {\n                        Swal.fire(\n                            \'Rejet !\',\n                            \'Demande rejetée\',\n                            \'success\'\n                        )\n                    }\n                }) this.form.post(this.route(\'user.requests.reject\', this.form.id, this.form), {\n                    preserveScroll: t', '0', 67, 4, '2022-03-10 19:01:51', '2022-03-10 19:01:51'),
(49, 64, 'gffujcvgvikyh', '0', 67, 4, '2022-03-10 19:20:16', '2022-03-10 19:20:16'),
(50, 64, 'Route::get(\'/course/{id}\', [CourseController::class, \'show\'])->name(\'courses.show\');\n    Route::get(\'/course/{id}\', [CourseController::class, \'show\'])->name(\'courses.show\');\n    Route::get(\'/course/{id}\', [CourseController::class, \'show\'])->name(\'courses.show\');\n    Route::get(\'/course/{id}\', [CourseController::class, \'show\'])->name(\'courses.show\');\n    Route::get(\'/course/{id}\', [CourseController::class, \'show\'])->name(\'courses.show\');', '0', 67, 4, '2022-03-10 19:42:57', '2022-03-10 19:42:57'),
(51, 64, 'Route::get(\'/course/{id}\', [CourseController::class, \'show\'])->name(\'courses.show\');\n    Route::get(\'/course/{id}\', [CourseController::class, \'show\'])->name(\'courses.show\');\n    Route::get(\'/course/{id}\', [CourseController::class, \'show\'])->name(\'courses.show\');', '0', 67, 4, '2022-03-10 19:51:30', '2022-03-10 19:51:30'),
(52, 64, 'Route::get(\'/course/{id}\', [CourseController::class, \'show\'])->name(\'courses.show\');\n    Route::get(\'/course/{id}\', [CourseController::class, \'show\'])->name(\'courses.show\');', '0', 67, 4, '2022-03-10 19:57:11', '2022-03-10 19:57:11'),
(53, 65, 'zekjfbjzeif uipoeh zifhezioufhpiouez hfpoize', '0', 68, 5, '2022-03-11 18:24:09', '2022-03-11 18:24:09'),
(54, 65, 'jkhf ioezuh fioezfikl ezjfkojzeofmze fze', '0', 68, 5, '2022-03-11 18:35:38', '2022-03-11 18:35:38'),
(55, 66, 'Rejet parce que le montant estimé est trop......', '0', 68, 5, '2022-03-11 19:11:52', '2022-03-11 19:11:52'),
(56, 67, 'hjUI uihzsiufv hzsdviu  hdvip lmdsv', '0', 68, 5, '2022-03-14 18:38:18', '2022-03-14 18:38:18'),
(57, 68, 'Je n\'ai pas tous les articles que tu as demandé. Je n\'ai pas de ciment.', '0', 67, 4, '2022-03-16 15:48:07', '2022-03-16 15:48:07'),
(58, 74, 'Mot sjd  ihwu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_ke', '0', 68, 5, '2022-03-22 15:35:49', '2022-03-22 15:35:49'),
(59, 73, 'ezjiyofhfyezih_çezfbyi_ezçfbypoizheç_p', '0', 67, 4, '2022-03-25 17:27:48', '2022-03-25 17:27:48'),
(60, 73, 'jzjefvbhez jgfuyzegfouiez', '0', 66, 3, '2022-03-25 17:36:00', '2022-03-25 17:36:00'),
(61, 74, 'mkjmsnvio lshvoesv', '0', 68, 5, '2022-03-26 11:42:21', '2022-03-26 11:42:21');

-- --------------------------------------------------------

--
-- Structure de la table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `request_type_id` bigint(20) UNSIGNED NOT NULL,
  `request_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_category_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asked_works` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `trans_mention_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimated_amount` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `command_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_service_id` int(20) DEFAULT NULL,
  `sent_or` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `sent_at` datetime DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sH_approval` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `on_treat` enum('0','1') DEFAULT NULL,
  `rA_treatment` enum('0','1') DEFAULT NULL,
  `wh_treatment` enum('0','1') DEFAULT NULL,
  `cm_treatment` enum('0','1') DEFAULT NULL,
  `prmp_treatment` enum('0','1') DEFAULT NULL,
  `sH_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sH_approvalDate` datetime DEFAULT NULL,
  `rA_approval` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rA_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rA_approvalDate` datetime DEFAULT NULL,
  `deliv_or` enum('0','1') DEFAULT NULL,
  `dPal_approval` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dPal_director_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dPal_approvalDate` datetime DEFAULT NULL,
  `cDL_approval` enum('0','1') DEFAULT NULL,
  `cDL_id` bigint(20) DEFAULT NULL,
  `cDL_approvalDate` datetime DEFAULT NULL,
  `wh_chief_approval` enum('0','1') DEFAULT NULL,
  `wh_chief_sign` varchar(255) DEFAULT NULL,
  `wh_chief_id` bigint(20) DEFAULT NULL,
  `wh_backup` enum('0','1') DEFAULT '0',
  `cm_id` bigint(20) DEFAULT NULL,
  `cm_approval` enum('0','1') DEFAULT NULL,
  `cm_sign` varchar(255) DEFAULT NULL,
  `chief_sign` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taker_sign` varchar(255) DEFAULT NULL,
  `prmp_approval` enum('0','1') DEFAULT NULL,
  `department_sign` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1','2','3','4','5','6','7','8','9','10') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `pw_date` date DEFAULT NULL,
  `final_process_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `requests`
--

INSERT INTO `requests` (`id`, `title`, `description`, `request_type_id`, `request_number`, `reference`, `request_category_id`, `asked_works`, `trans_mention_id`, `estimated_amount`, `command_number`, `user_id`, `user_service_id`, `sent_or`, `sent_at`, `token`, `sH_approval`, `on_treat`, `rA_treatment`, `wh_treatment`, `cm_treatment`, `prmp_treatment`, `sH_id`, `sH_approvalDate`, `rA_approval`, `rA_id`, `rA_approvalDate`, `deliv_or`, `dPal_approval`, `dPal_director_id`, `dPal_approvalDate`, `cDL_approval`, `cDL_id`, `cDL_approvalDate`, `wh_chief_approval`, `wh_chief_sign`, `wh_chief_id`, `wh_backup`, `cm_id`, `cm_approval`, `cm_sign`, `chief_sign`, `taker_sign`, `prmp_approval`, `department_sign`, `status`, `pw_date`, `final_process_date`, `created_at`, `updated_at`) VALUES
(65, 'Gerozytugiuf zfiu', NULL, 1, 'DT/065/2022', 'PRC-110322-DT65', NULL, 'Deyt zeuf upezfioez^jfoizjefopze^kfopîezk^fopzeikpofzekfopzejkfozep', 'EXPERTISE', '1200000', NULL, 69, 2, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '2022-03-11 17:22:35', '2022-03-11 17:22:35'),
(66, 'Demande de fonds pour achat de pièces', 'Demande pour les fonds des travaux à la $(\'#modal-commandNAdd\').modal(\'hide\')$(\'#modal-commandNAdd\').modal(\'hide\')$(\'#modal-commandNAdd\').modal(\'hide\')$(\'#modal-commandNAdd\').modal(\'hide\')$(\'#modal-commandNAdd\').modal(\'hide\')$(\'#modal-commandNAdd\').modal(\'hide\')$(\'#modal-commandNAdd\').modal(\'hide\')$(\'#modal-commandNAdd\').modal(\'hide\')$(\'#modal-commandNAdd\').modal(\'hide\')$(\'#modal-commandNAdd\').modal(\'hide\')$(\'#modal-commandNAdd\').modal(\'hide\')$(\'#modal-commandNAdd\').modal(\'hide\')$(\'#modal-commandNAdd\').modal(\'hide\')$(\'#modal-commandNAdd\').modal(\'hide\')$(\'#modal-commandNAdd\').modal(\'hide\')$(\'#modal-commandNAdd\').modal(\'hide\')$(\'#modal-commandNAdd\').modal(\'hide\')', 2, 'DA/066/2022', 'PRC-110322-DA67', 'ENTRETIEN / REPARATION', NULL, NULL, '120000', NULL, 69, 2, '1', '2022-03-18 17:49:31', '18622b9f7fca3c9', '1', NULL, '0', '0', '0', '1', 68, '2022-03-11 19:14:50', '1', 67, '2022-03-11 19:20:01', '0', '1', 66, '2022-03-11 19:22:08', '1', 73, '2022-03-11 19:23:49', '1', NULL, 65, '0', 60, '1', NULL, NULL, '59', '1', NULL, '9', '2022-03-25', NULL, '2022-03-11 17:53:54', '2022-03-11 17:53:54'),
(54, 'Delandede hjezbfezj', NULL, 1, 'DT/054/2022', 'PRC-070322-DT54', NULL, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates dignissimos pariatur atque, voluptatum deserunt quasi vero placeat suscipit eum natus, repellendus voluptas ratione! Officiis eos velit laboriosam veritatis, tempore minus!Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates dignissimos pariatur atque, voluptatum deserunt quasi vero placeat suscipit eum natus, repellendus voluptas ratione! Officiis eos velit laboriosam veritatis, tempore minus!', '1-', '566778', NULL, 69, 2, '0', '2022-03-07 17:33:13', '2162264c41dfd35', '1', NULL, NULL, NULL, NULL, NULL, 68, '2022-03-07 18:18:36', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, '2022-03-07 14:23:40', '2022-03-07 14:23:40'),
(56, 'Demande de fonds pour les travaux à GODOMEY', NULL, 1, 'DT/056/2022', 'PRC-070322-DT56', NULL, 'Lorem ipsum dolor DPAL CDL sit amet consectetur adipisicing elit. Quae amet quia repudiandae labore sequi. Voluptatibus ullam nesciunt distinctio quae fugiat ducimus maxime repudiandae qui aut dignissimos architecto non, iusto quo.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae amet quia repudiandae labore sequi. Voluptatibus ullam nesciunt distinctio quae fugiat ducimus maxime repudiandae qui aut dignissimos architecto non, iusto quo.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae amet quia repudiandae labore sequi. Voluptatibus ullam nesciunt distinctio quae fugiat ducimus maxime repudiandae qui aut dignissimos architecto non, iusto quo.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae amet quia repudiandae labore sequi. Voluptatibus ullam nesciunt distinctio quae fugiat ducimus maxime repudiandae qui aut dignissimos architecto non, iusto quo.', '1-3-5', '18000000', NULL, 69, 2, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '2022-03-07 21:38:42', '2022-03-07 21:38:42'),
(57, 'Achat de matériels de travail pour les rues de FANDJI', 'Lorem ipsum dolor sit CDL CDL onsectetur adipisicing elit. Veritatis reprehenderit deleniti iusto enim, quisquam facere ex nisi? Praesentium ratione ad, reprehenderit nemo iusto architecto fugit beatae aspernatur enim a quisquam.Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis reprehenderit deleniti iusto enim, quisquam facere ex nisi? Praesentium ratione ad, reprehenderit nemo iusto architecto fugit beatae aspernatur enim a quisquam.Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis reprehenderit deleniti iusto enim, quisquam facere ex nisi? Praesentium ratione ad, reprehenderit nemo iusto architecto fugit beatae aspernatur enim a quisquam.Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis reprehenderit deleniti iusto enim, quisquam facere ex nisi? Praesentium ratione ad, reprehenderit nemo iusto architecto fugit beatae aspernatur enim a quisquam.Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis reprehenderit deleniti iusto enim, quisquam facere ex nisi? Praesentium ratione ad, reprehenderit nemo iusto architecto fugit beatae aspernatur enim a quisquam.Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis reprehenderit deleniti iusto enim, quisquam facere ex nisi? Praesentium ratione ad, reprehenderit nemo iusto architecto fugit beatae aspernatur enim a quisquam.Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis reprehenderit deleniti iusto enim, quisquam facere ex nisi? Praesentium ratione ad, reprehenderit nemo iusto architecto fugit beatae aspernatur enim a quisquam.Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis reprehenderit deleniti iusto enim, quisquam facere ex nisi? Praesentium ratione ad, reprehenderit nemo iusto architecto fugit beatae aspernatur enim a quisquam.Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis reprehenderit deleniti iusto enim, quisquam facere ex nisi? Praesentium ratione ad, reprehenderit nemo iusto architecto fugit beatae aspernatur enim a quisquam.', 2, 'DA/057/2022', 'PRC-080322-DA58', '2-1-3-', NULL, NULL, '800000', 'ezgferoiuopy', 69, 2, '0', '2022-03-08 20:25:25', NULL, NULL, NULL, '0', '0', '0', NULL, 68, '2022-03-08 12:08:18', NULL, 67, '2022-03-08 12:10:45', '0', NULL, 66, '2022-03-08 12:15:20', NULL, 73, '2022-03-08 12:18:38', NULL, NULL, 65, '0', NULL, '1', NULL, NULL, '59', NULL, NULL, '0', '2022-03-31', NULL, '2022-03-08 10:23:09', '2022-03-08 10:23:09'),
(58, 'Achat pour des travaux de réparations.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, labore magni incidunt, quibusdam mollitia aliquam veritatis eveniet, explicabo deleniti ea qui ipsa porro ut praesentium. Dolore veritatis voluptatibus quae odio.Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, labore magni incidunt, quibusdam mollitia aliquam veritatis eveniet, explicabo deleniti ea qui ipsa porro ut praesentium. Dolore veritatis voluptatibus quae odio.Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, labore magni incidunt, quibusdam mollitia aliquam veritatis eveniet, explicabo deleniti ea qui ipsa porro ut praesentium. Dolore veritatis voluptatibus quae odio.Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, labore magni incidunt, quibusdam mollitia aliquam veritatis eveniet, explicabo deleniti ea qui ipsa porro ut praesentium. Dolore veritatis voluptatibus quae odio.', 2, 'DA/058/2022', 'PRC-090322-DA59', 'AMENAGEMENT', NULL, 'ATELIER CENTRAL', '120000', NULL, 69, 2, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '2022-03-09 08:17:42', '2022-03-09 08:17:42'),
(59, 'Achat pour travaux', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis incidunt earum iusto, quisquam aperiam, labore excepturi fugit vel placeat eveniet sunt pariatur ut tempore esse, impedit corporis laudantium eligendi ratione.                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis incidunt earum iusto, quisquam aperiam, labore excepturi fugit vel placeat eveniet sunt pariatur ut tempore esse, impedit corporis laudantium eligendi ratione.                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis incidunt earum iusto, quisquam aperiam, labore excepturi fugit vel placeat eveniet sunt pariatur ut tempore esse, impedit corporis laudantium eligendi ratione.                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis incidunt earum iusto, quisquam aperiam, labore excepturi fugit vel placeat eveniet sunt pariatur ut tempore esse, impedit corporis laudantium eligendi ratione.                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis incidunt earum iusto, quisquam aperiam, labore excepturi fugit vel placeat eveniet sunt pariatur ut tempore esse, impedit corporis laudantium eligendi ratione.', 2, 'DA/059/2022', 'PRC-090322-DA60', 'ENTRETIEN / REPARATION-CONSTRUCTION-EQUIPEMENTS BUREAU OU AUTRES-', NULL, NULL, '600000', NULL, 69, 2, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '2022-03-09 08:28:33', '2022-03-09 08:28:33'),
(60, 'Travaux dans les rues de Cotonou', NULL, 1, 'DT/060/2022', 'PRC-090322-DT60', NULL, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo fugit vero molestias voluptatibus voluptate, quaerat reprehenderit nisi modi sit magnam adipisci, velit autem pariatur possimus tempora maiores, quod magni mollitia?Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo fugit vero molestias voluptatibus voluptate, quaerat reprehenderit nisi modi sit magnam adipisci, velit autem pariatur possimus tempora maiores, quod magni mollitia?Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo fugit vero molestias voluptatibus voluptate, quaerat reprehenderit nisi modi sit magnam adipisci, velit autem pariatur possimus tempora maiores, quod magni mollitia?', 'REPARATION-PROCEDURE A LA PRMP-ATELIER CENTRAL-EXPERTISE', '17000000', NULL, 69, 2, '1', NULL, '20622a2e7f08f7b', '1', NULL, '0', NULL, NULL, NULL, 68, '2022-03-10 16:59:59', '1', 67, '2022-03-10 17:13:49', '0', '1', 66, '2022-03-10 17:17:29', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL, '2022-03-09 09:03:03', '2022-03-09 09:03:03'),
(61, 'Achat ........................', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis inventore incidunt enim ducimus, aspernatur modi quae ut fugiat, odio minima odit excepturi error aliquam, molestias vero nostrum? Harum, cum dicta?Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis inventore incidunt enim ducimus, aspernatur modi quae ut fugiat, odio minima odit excepturi error aliquam, molestias vero nostrum? Harum, cum dicta?Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis inventore incidunt enim ducimus, aspernatur modi quae ut fugiat, odio minima odit excepturi error aliquam, molestias vero nostrum? Harum, cum dicta?Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis inventore incidunt enim ducimus, aspernatur modi quae ut fugiat, odio minima odit excepturi error aliquam, molestias vero nostrum? Harum, cum dicta?', 1, 'DA/061/2022', 'PRC-090322-DA62', 'AMENAGEMENT', 'd,ndzvjzkvlnlkj zi                                        :select-label=\"form.trans_mention_id\"\n                                        :select-label=\"form.trans_mention_id\"\n                                        :select-label=\"form.trans_mention_id\"\n                                        :select-label=\"form.trans_mention_id\"\n                                        :select-label=\"form.trans_mention_id\"\n                                        :select-label=\"form.trans_mention_id\"\n                                        :select-label=\"form.trans_mention_id\"\n                                        :select-label=\"form.trans_mention_id\"\n                                        :select-label=\"form.trans_mention_id\"\n                                        :select-label=\"form.trans_mention_id\"\n                                        :select-label=\"form.trans_mention_id\"\n                                        :select-label=\"form.trans_mention_id\"\n                                        :select-label=\"form.trans_mention_id\"\n                                        :select-label=\"form.trans_mention_id\"\n                                        :select-label=\"form.trans_mention_id\"', 'EXPERTISE', '160000', 'KYGJU8', 69, 2, '0', '2022-03-10 16:28:32', NULL, NULL, NULL, '0', '0', '0', '1', 68, '2022-03-10 15:59:04', NULL, 67, '2022-03-10 16:05:50', '0', NULL, 66, '2022-03-10 16:07:41', NULL, 73, '2022-03-10 16:13:22', NULL, NULL, 65, '0', 60, '1', NULL, NULL, '59', '1', NULL, '0', '2022-04-01', NULL, '2022-03-09 09:20:48', '2022-03-09 09:20:48'),
(62, 'Titre de demande', NULL, 1, 'DT/062/2022', 'PRC-100322-DT62', NULL, 'Lorem TRAVAUX SH adipisicing elit. Ut dolorum nihil id obcaecati vitae facilis doloremque iste, ab laboriosam dicta enim corporis eos saepe incidunt perspiciatis autem eaque unde voluptatem?Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut dolorum nihil id obcaecati vitae facilis doloremque iste, ab laboriosam dicta enim corporis eos saepe incidunt perspiciatis autem eaque unde voluptatem?Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut dolorum nihil id obcaecati vitae facilis doloremque iste, ab laboriosam dicta enim corporis eos saepe incidunt perspiciatis autem eaque unde voluptatem?', 'REPARATION-GARAGE PRIVE-EXPERTISE', '5600000', NULL, 69, 2, '1', NULL, '15622987ea3f42a', '1', NULL, '0', '0', '0', NULL, 68, '2022-03-10 05:01:20', '1', 67, '2022-03-10 05:04:03', '0', '1', 66, '2022-03-10 05:06:20', '1', 73, '2022-03-10 05:09:16', '1', NULL, 65, '0', 60, '1', NULL, NULL, '59', NULL, NULL, '8', NULL, NULL, '2022-03-10 03:53:34', '2022-03-10 03:53:34'),
(63, 'Achat de matériels de travail', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo non ex, sit sunt minus beatae necessitatibus debitis laudantium enim tenetur. Facere possimus adipisci quas ipsum laborum accusamus earum, commodi voluptatum.Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo non ex, sit sunt minus beatae necessitatibus debitis laudantium enim tenetur. Facere possimus adipisci quas ipsum laborum accusamus earum, commodi voluptatum.Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo non ex, sit sunt minus beatae necessitatibus debitis laudantium enim tenetur. Facere possimus adipisci quas ipsum laborum accusamus earum, commodi voluptatum.Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo non ex, sit sunt minus beatae necessitatibus debitis laudantium enim tenetur. Facere possimus adipisci quas ipsum laborum accusamus earum, commodi voluptatum.', 2, 'DA/063/2022', 'PRC-100322-DA64', 'EQUIPEMENTS TECHNIQUES-', NULL, NULL, '12000000', 'U762789', 69, 2, '1', '2022-03-10 09:52:41', '246229b70b478bb', '1', NULL, '0', '0', '0', '1', 68, '2022-03-10 08:30:57', '1', 67, '2022-03-10 08:36:40', '0', '1', 66, '2022-03-10 09:05:16', '1', 73, '2022-03-10 09:07:00', '1', NULL, 65, '0', 60, '1', NULL, NULL, '59', '0', NULL, '8', '2022-03-16', NULL, '2022-03-10 07:09:30', '2022-03-10 07:09:30'),
(64, ',;, zekjvn zevjez', NULL, 1, 'DT/064/2022', 'PRC-100322-DT64', NULL, '$request->request_category_id$request->request_category_id$request->request_category_id$request->request_category_id$request->request_category_id', 'REPARATION', '56800000', NULL, 69, 2, '0', NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, 68, '2022-03-10 18:45:59', NULL, 67, '2022-03-10 19:57:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, '2022-03-10 16:57:56', '2022-03-10 16:57:56'),
(67, 'Travaux travaux', NULL, 1, 'DT/067/2022', 'PRC-140322-DT67', 'AMENAGEMENT', 'AGOSSO AGOSSO <label for=\"request_category_id\" class=\"h5\" >Catégories<span class=\"text-red\">*</span></label>\n                                        <multiselect\n                                            v-model=\"form.request_category_id\"\n                                            :options=\"request_categoryOptions\"\n                                            :multiple=\"false\"\n                                            :taggable=\"true\"\n                                            placeholder=\"Sélectionner\"\n                                            @addRequestCat=\"addRequestCat\"\n                                            label=\"name\"\n                                            track-by=\"id\"\n                                        ></multiselect>\n\n                                        <div class=\"invalid-feedback\" :class=\"{ \'d-block\' : form.errors.request_category_id}\">\n                                            {{ form.errors.request_category_id }}\n                                        </div>\n                                    </div>\n        <label for=\"request_category_id\" class=\"h5\" >Catégories<span class=\"text-red\">*</span></label>\n                                        <multiselect\n                                            v-model=\"form.request_category_id\"\n                                            :options=\"request_categoryOptions\"\n                                            :multiple=\"false\"\n                                            :taggable=\"true\"\n                                            placeholder=\"Sélectionner\"\n                                            @addRequestCat=\"addRequestCat\"\n                                            label=\"name\"\n                                            track-by=\"id\"\n                                        ></multiselect>\n\n                                        <div class=\"invalid-feedback\" :class=\"{ \'d-block\' : form.errors.request_category_id}\">\n                                            {{ form.errors.request_category_id }}\n                                        </div>\n                                    </div>', 'GARAGE PRIVE', '129900', NULL, 69, 2, '1', '2022-03-18 17:47:11', '16622f8c9fd61c3', '1', NULL, '0', '0', '0', '1', 68, '2022-03-14 18:43:08', '1', 67, '2022-03-14 18:47:35', '0', '1', 66, '2022-03-14 18:49:33', '1', 73, '2022-03-14 19:16:29', '1', NULL, 65, '0', 60, '1', NULL, NULL, '59', '1', NULL, '8', NULL, NULL, '2022-03-14 16:20:45', '2022-03-14 16:20:45'),
(68, 'ezki zeihof ioze fuio pzefm', NULL, 1, 'DT/068/2022', 'PRC-160322-DT68', 'AMENAGEMENT', 'ukhz eiufhziue fuipzehfiuyhzeuifphizuefphizepfhpezfze', 'GARAGE PRIVE', '10000', NULL, 69, 2, '0', NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, 68, '2022-03-16 11:12:26', NULL, 67, '2022-03-16 15:48:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, '2022-03-16 09:33:19', '2022-03-16 09:33:19'),
(69, 'Yuyzeguifo zepf hiopzefh', 'kzleh fiophz e fi ouzeiofuçzieàof uçàez ufçàêzuçfuezçàf uizeojdvm dsovj ds nv mdsv oîsdjvdsnjkvdsnvp dsiovj', 2, 'DA/069/2022', 'PRC-160322-DA70', 'AMENAGEMENT', NULL, 'ATELIER CENTRAL', '200000', NULL, 69, 2, '1', NULL, '19623f94f260df1', '1', NULL, '0', '0', '0', NULL, 68, '2022-03-26 23:05:19', '1', 67, '2022-03-26 23:12:44', '0', '1', 66, '2022-03-26 23:21:43', '1', 73, '2022-03-26 23:22:23', '1', NULL, 65, '0', 60, '1', NULL, NULL, '59', NULL, NULL, '6', NULL, NULL, '2022-03-16 15:06:58', '2022-03-16 15:06:58'),
(70, 'Totototofdo do', 'rekih kgioerh giuope hriug heru gyheriupghieropghioerp gmer', 2, 'DA/070/2022', 'PRC-170322-DA71', 'ENTRETIEN / REPARATION', NULL, 'GARAGE PRIVE', '1200000', NULL, 69, 2, '1', NULL, '256232f4f9e7da5', '1', NULL, '0', NULL, NULL, NULL, 68, '2022-03-17 08:47:38', '1', 67, '2022-03-17 09:44:51', '0', '1', 66, '2022-03-17 09:47:17', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', '2022-04-03', NULL, '2022-03-17 07:40:09', '2022-03-17 07:40:09'),
(71, 'OPOPOPzeflknzekof,zpoefp,oezfz', 'zliu uize hviuhzuevuzehviuzehviuzhevuihzeiuzehlv', 2, 'DA/071/2022', 'PRC-170322-DA72', 'CONSTRUCTION', NULL, 'PROCEDURE A LA PRMP', '456879', NULL, 69, 2, '0', '2022-03-18 17:44:45', NULL, NULL, NULL, '0', '0', '0', '1', 68, '2022-03-17 10:03:29', NULL, 67, '2022-03-17 10:05:06', '0', NULL, 66, '2022-03-17 10:05:46', NULL, 73, '2022-03-17 10:06:33', NULL, NULL, 65, '0', 60, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2022-03-27', NULL, '2022-03-17 08:58:09', '2022-03-17 08:58:09'),
(72, 'Gestion des achats......', 'oiez fize fi ezuifo zeif uiezo fuiez ofizeo fopezfezzef', 2, 'DA/072/2022', 'PRC-180322-DA73', 'CONSTRUCTION', NULL, 'ATELIER CENTRAL', '100000', NULL, 69, 2, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2022-04-08', NULL, '2022-03-18 17:05:40', '2022-03-18 17:05:40'),
(73, 'Demande d\'achat de matériels pour les travaux à ZOGBO', 'Juste une simple demande .............................. blabl......\n\nezfjopzej fo joi jvoezivjiozevjpozedu code', 3, 'DA/073/2022', 'PRC-200322-DA74', 'CONSTRUCTION', NULL, 'PROCEDURE A LA PRMP', '1200000', NULL, 69, 2, '1', NULL, '17623dfeef548de', '1', NULL, '0', NULL, NULL, NULL, 68, '2022-03-25 17:06:34', '1', 67, '2022-03-25 17:33:25', '0', NULL, 66, '2022-03-25 17:36:00', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', '2022-03-31', NULL, '2022-03-20 17:47:48', '2022-03-20 17:47:48'),
(74, 'Achat pour travaux sur les rues de ?........', 'descripot JHJHJHJHHJJHHJHJHJJHHJJHJHHJJHJJJJwu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_kewu3EDa3sqy9:_ke', 2, 'DA/074/2022', 'PRC-220322-DA75', 'CONSTRUCTION', NULL, 'ATELIER CENTRAL', '1200000', 'UY/T768/OJIK', 69, 2, '1', '2022-03-26 12:54:31', '20623efc9183ec4', '1', NULL, '0', '0', '0', NULL, 68, '2022-03-26 11:44:48', '1', 67, '2022-03-26 11:46:12', '0', '1', 66, '2022-03-26 11:47:03', '1', 73, '2022-03-26 11:52:37', '1', NULL, 65, '1', 60, '1', NULL, NULL, '1', '1', NULL, '9', NULL, NULL, '2022-03-22 14:21:44', '2022-03-22 14:21:44'),
(75, 'Gzedzejifdoezmkidfoezjfmd', 'ki ezjhfoi ezfjio pzefio pzef io                                <input type=\"hidden\" name=\"user_id\" value=\"<?= $the_request->user_id ?>\">\n                                <input type=\"hidden\" name=\"user_id\" value=\"<?= $the_request->user_id ?>\">\n                                <input type=\"hidden\" name=\"user_id\" value=\"<?= $the_request->user_id ?>\">\n                                <input type=\"hidden\" name=\"user_id\" value=\"<?= $the_request->user_id ?>\">\n                                <input type=\"hidden\" name=\"user_id\" value=\"<?= $the_request->user_id ?>\">\n                                <input type=\"hidden\" name=\"user_id\" value=\"<?= $the_request->user_id ?>\">', 2, 'DA/075/2022', 'PRC-260322-DA76', 'CONSTRUCTION', NULL, 'GARAGE PRIVE', '1872980', '768/JZK/09', 69, 2, '1', '2022-03-26 13:47:08', '25623f12abcd667', '1', NULL, '0', '0', '0', NULL, 68, '2022-03-26 13:20:11', '1', 67, '2022-03-26 13:22:12', '0', '1', 66, '2022-03-26 13:27:41', '1', 73, '2022-03-26 13:29:32', '1', NULL, 65, '1', 60, '1', NULL, NULL, '1', '1', NULL, '9', '2022-04-07', NULL, '2022-03-26 11:57:34', '2022-03-26 11:57:34');

-- --------------------------------------------------------

--
-- Structure de la table `request_types`
--

DROP TABLE IF EXISTS `request_types`;
CREATE TABLE IF NOT EXISTS `request_types` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `request_types`
--

INSERT INTO `request_types` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Demande de travaux', 'Ceci est le type de demande pour les travaux.', '2022-02-22 16:45:00', '2022-02-22 16:45:04'),
(2, 'Demande d\'achat de production', 'Ceci est pour les types de demande d\'achat de production.', '2022-02-22 16:45:06', '2022-02-22 16:45:07'),
(3, 'Demande d\'achat hors production', 'Ceci est pour les types de demande d\'achat hors production.', '2022-02-22 16:45:09', '2022-02-22 16:45:10');

-- --------------------------------------------------------

--
-- Structure de la table `request__categories`
--

DROP TABLE IF EXISTS `request__categories`;
CREATE TABLE IF NOT EXISTS `request__categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `request__categories`
--

INSERT INTO `request__categories` (`id`, `name`, `description`) VALUES
(1, 'ENTRETIEN / REPARATION', 'Description de la catégorie pour entretien et réparation'),
(2, 'AMENAGEMENT', 'Description'),
(3, 'CONSTRUCTION', 'Descrpt'),
(4, 'VEHICULES', 'Descript'),
(5, 'EQUIPEMENTS BUREAU OU AUTRES', 'Descripti'),
(6, 'EQUIPEMENTS TECHNIQUES', 'Descripti');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'web', '2022-02-21 11:47:53', '2022-02-21 11:47:53'),
(2, 'admin', 'web', '2022-02-21 11:47:53', '2022-02-21 11:47:53'),
(5, 'user', 'web', '2022-02-21 11:47:53', '2022-02-21 11:47:53');

-- --------------------------------------------------------

--
-- Structure de la table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(6, 3),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(10, 3),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(13, 3),
(13, 4),
(14, 1),
(14, 2),
(15, 5);

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `department`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Service géo', 'Just a description a of this service', 'Fertili', NULL, '2022-02-28 06:49:47', '2022-03-21 21:01:05'),
(2, 'Service Domotique', 'zefzefze,nv e vemo', NULL, NULL, '2022-02-28 06:51:39', '2022-02-28 06:51:39'),
(3, 'Service Informatique', 'Description de ce service', 'Numériquo Départ', NULL, '2022-03-10 06:56:19', '2022-03-14 16:10:44'),
(5, 'Commercial', 'Description du service commercial.', 'Département Nouveau', NULL, '2022-03-14 16:02:11', '2022-03-14 16:02:11');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('UsjCQh0U4h8K7HoM6pSEc8NHkfPdl3eFo4CVTSjC', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.74 Safari/537.36 Edg/99.0.1150.46', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoieEI2SzIwREg5RGJlUmRjc0ZYSHAzdFVhaHh6dTZkYkY4Q2Nuak1ITSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCREODhoWlFqajJ0ZGhCenp1cjZFOGMuV0MwTi9qSTc4VEhjT1NtdnBwL2ptWU9QdjhERVhhNiI7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkRDg4aFpRamoydGRoQnp6dXI2RThjLldDME4vakk3OFRIY09TbXZwcC9qbVlPUHY4REVYYTYiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vdXNlcnMiO319', 1648340045);

-- --------------------------------------------------------

--
-- Structure de la table `signatures`
--

DROP TABLE IF EXISTS `signatures`;
CREATE TABLE IF NOT EXISTS `signatures` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sign` binary(255) DEFAULT NULL,
  `request_id` bigint(20) DEFAULT NULL,
  `asker_sign` varchar(255) DEFAULT NULL,
  `sH_sign` varchar(255) DEFAULT NULL,
  `rA_sign` varchar(255) DEFAULT NULL,
  `dPal_sign` varchar(255) DEFAULT NULL,
  `cDL_sign` varchar(255) DEFAULT NULL,
  `wH_chief_sign` varchar(255) DEFAULT NULL,
  `cm_sign` varchar(255) DEFAULT NULL,
  `taker_sign` varchar(255) DEFAULT NULL,
  `prmp_sign` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `signatures`
--

INSERT INTO `signatures` (`id`, `sign`, `request_id`, `asker_sign`, `sH_sign`, `rA_sign`, `dPal_sign`, `cDL_sign`, `wH_chief_sign`, `cm_sign`, `taker_sign`, `prmp_sign`, `created_at`, `updated_at`) VALUES
(27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/storage/uploads/1646864648_Web 1920 – 1.jpg', NULL, '2022-03-09 22:24:08', '2022-03-09 22:24:08'),
(26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/storage/uploads/1646864294_Web 1920 – 1.jpg', NULL, '2022-03-09 22:18:14', '2022-03-09 22:18:14'),
(25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/storage/uploads/1646863760_sbee bénin – Recherche Google.jpg', NULL, '2022-03-09 22:09:20', '2022-03-09 22:09:20'),
(24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/storage/uploads/1646859864_Web 1920 – 1.jpg', NULL, '2022-03-09 21:04:24', '2022-03-09 21:04:24'),
(23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/storage/uploads/1646859670_sbee bénin – Recherche Google.jpg', NULL, '2022-03-09 21:01:10', '2022-03-09 21:01:10'),
(21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/storage/uploads/1646854209_sbee bénin – Recherche Google.jpg', NULL, '2022-03-09 19:30:09', '2022-03-09 19:30:09'),
(22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/storage/uploads/1646854462_sbee bénin – Recherche Google.jpg', NULL, '2022-03-09 19:34:22', '2022-03-09 19:34:22'),
(20, NULL, NULL, NULL, '1646853979_sbee bénin – Recherche Google.jpg', NULL, NULL, NULL, NULL, NULL, '/storage/uploads/1646853979_sbee bénin – Recherche Google.jpg', NULL, '2022-03-09 19:26:19', '2022-03-09 19:26:19'),
(19, NULL, NULL, NULL, '1646853896_sbee bénin – Recherche Google.jpg', NULL, NULL, NULL, NULL, NULL, '/storage/uploads/1646853896_sbee bénin – Recherche Google.jpg', NULL, '2022-03-09 19:24:56', '2022-03-09 19:24:56');

-- --------------------------------------------------------

--
-- Structure de la table `trans__mentions`
--

DROP TABLE IF EXISTS `trans__mentions`;
CREATE TABLE IF NOT EXISTS `trans__mentions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `trans__mentions`
--

INSERT INTO `trans__mentions` (`id`, `name`, `description`) VALUES
(1, 'EXPERTISE', 'Descript'),
(2, 'REPARATION', 'Descriptio'),
(3, 'ATELIER CENTRAL', 'Descript'),
(4, 'GARAGE PRIVE', 'Descript'),
(5, 'PROCEDURE A LA PRMP', 'Descripti');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` enum('M','F') COLLATE utf8mb4_unicode_ci DEFAULT 'M',
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_id` int(20) DEFAULT NULL,
  `grade_id` int(20) DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_super` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `sex`, `phone_number`, `email`, `email_verified_at`, `password`, `service_id`, `grade_id`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `is_admin`, `is_super`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'Admin', 'M', NULL, 'super@admin.com', '2022-02-17 16:57:37', '$2y$10$D88hZQjj2tdhBzzur6E8c.WC0N/jI78THcOSmvpp/jmYOPv8DEXa6', NULL, NULL, NULL, NULL, 'uoJjBJZFx51bhCaVEuNs45v13dhq4N3tILVL1xVBkvX1VBIfz6T91SIBHf0C', NULL, NULL, 1, '1', '2022-02-17 17:57:37', '2022-02-28 10:53:16'),
(2, 'admin', NULL, 'M', NULL, 'admin@admin.com', '2022-02-17 16:57:37', '$2y$10$S9.d.JJ3AgYoK2TTvcUIXOTaSOJrO0i9xgbr4/I1xbM/7QDmAcNxK', NULL, NULL, NULL, NULL, 'feav8btFLZ', NULL, NULL, 1, NULL, '2022-02-17 17:57:37', '2022-02-17 17:57:37'),
(3, 'moderator', NULL, 'M', NULL, 'moderator@admin.com', '2022-02-17 16:57:37', '$2y$10$qP8QKwv/BmOJgMgze2yAD.LbXQBfBTkHufhMXZd2b4f3osbI.a0tK', NULL, NULL, NULL, NULL, '05YVh7TtFx', NULL, NULL, 1, NULL, '2022-02-17 17:57:37', '2022-02-17 17:57:37'),
(4, 'Toto', 'Dev', 'M', NULL, 'developer@admin.com', '2022-02-17 16:57:38', '$2y$10$TjzzKpQsCjdUlpytDWp.BemlY8liuaQi17wlniiXV5sMErhrC66uu', NULL, NULL, NULL, NULL, 'q1SxckMV48', NULL, NULL, 1, NULL, '2022-02-17 17:57:38', '2022-03-26 21:22:33'),
(6, 'Test 1', NULL, 'M', NULL, 'angehermel@gmail.com', '2022-02-17 16:57:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'jm5Z0JTR6Z', NULL, NULL, 0, NULL, '2022-02-17 17:57:38', '2022-02-17 17:57:38'),
(7, 'Test 2', NULL, 'M', NULL, 'test2@test.com', '2022-02-17 16:57:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'Te1NfKbepZ', NULL, NULL, 0, NULL, '2022-02-17 17:57:38', '2022-02-17 17:57:38'),
(8, 'Test 3', NULL, 'M', NULL, 'test3@test.com', '2022-02-17 16:57:39', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'NlUZETPtzB', NULL, NULL, 0, NULL, '2022-02-17 17:57:39', '2022-02-17 17:57:39'),
(9, 'Test 4', NULL, 'M', NULL, 'test4@test.com', '2022-02-17 16:57:39', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'gwHIR3dKaO', NULL, NULL, 0, NULL, '2022-02-17 17:57:39', '2022-02-17 17:57:39'),
(10, 'Test 5', NULL, 'M', NULL, 'test5@test.com', '2022-02-17 16:57:39', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'dw4X4gFAF7', NULL, NULL, 0, NULL, '2022-02-17 17:57:39', '2022-02-17 17:57:39'),
(11, 'Test 6', NULL, 'M', NULL, 'test6@test.com', '2022-02-17 16:57:39', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, '48wga9zpEg', NULL, NULL, 0, NULL, '2022-02-17 17:57:39', '2022-02-17 17:57:39'),
(12, 'Test 7', NULL, 'M', NULL, 'test7@test.com', '2022-02-17 16:57:39', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'ZceiXKKUGp', NULL, NULL, 0, NULL, '2022-02-17 17:57:39', '2022-02-17 17:57:39'),
(13, 'Test 8', NULL, 'M', NULL, 'test8@test.com', '2022-02-17 16:57:40', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'qHERPkhhnN', NULL, NULL, 0, NULL, '2022-02-17 17:57:40', '2022-02-17 17:57:40'),
(14, 'Test 9', NULL, 'M', NULL, 'test9@test.com', '2022-02-17 16:57:40', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'n3vNK9sD6i', NULL, NULL, 0, NULL, '2022-02-17 17:57:40', '2022-02-17 17:57:40'),
(15, 'Test 10', NULL, 'M', NULL, 'test10@test.com', '2022-02-17 16:57:40', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'BdCbuzt0Zd', NULL, NULL, 0, NULL, '2022-02-17 17:57:40', '2022-02-17 17:57:40'),
(16, 'Test 11', NULL, 'M', NULL, 'test11@test.com', '2022-02-17 16:57:40', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'znswLJH1zA', NULL, NULL, 0, NULL, '2022-02-17 17:57:40', '2022-02-17 17:57:40'),
(17, 'Test 12', NULL, 'M', NULL, 'test12@test.com', '2022-02-17 16:57:41', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'EqfFZoJehd', NULL, NULL, 0, NULL, '2022-02-17 17:57:41', '2022-02-17 17:57:41'),
(19, 'Test 14', NULL, 'M', NULL, 'test14@test.com', '2022-02-17 16:57:41', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'rVg98aSoWS', NULL, NULL, 0, NULL, '2022-02-17 17:57:41', '2022-02-17 17:57:41'),
(20, 'Test 15', NULL, 'M', NULL, 'test15@test.com', '2022-02-17 16:57:41', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'QABwPj2Bbu', NULL, NULL, 0, NULL, '2022-02-17 17:57:41', '2022-02-17 17:57:41'),
(21, 'Test 16', NULL, 'M', NULL, 'test16@test.com', '2022-02-17 16:57:41', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'IOzqSIT6kZ', NULL, NULL, 0, NULL, '2022-02-17 17:57:41', '2022-02-17 17:57:41'),
(22, 'Test 17', NULL, 'M', NULL, 'test17@test.com', '2022-02-17 16:57:41', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'lOHUMRpYjU', NULL, NULL, 0, NULL, '2022-02-17 17:57:41', '2022-02-17 17:57:41'),
(23, 'Test 18', NULL, 'M', NULL, 'test18@test.com', '2022-02-17 16:57:42', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'nBM5aRcvpJ', NULL, NULL, 0, NULL, '2022-02-17 17:57:42', '2022-02-17 17:57:42'),
(24, 'Test 19', NULL, 'M', NULL, 'test19@test.com', '2022-02-17 16:57:42', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'Sjchs7n2mf', NULL, NULL, 0, NULL, '2022-02-17 17:57:42', '2022-02-17 17:57:42'),
(25, 'Test 20', NULL, 'M', NULL, 'test20@test.com', '2022-02-17 16:57:42', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, '25ey8zDWCd', NULL, NULL, 0, NULL, '2022-02-17 17:57:42', '2022-02-17 17:57:42'),
(26, 'Test 21', NULL, 'M', NULL, 'test21@test.com', '2022-02-17 16:57:42', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'ZIHqco6HlN', NULL, NULL, 0, NULL, '2022-02-17 17:57:42', '2022-02-17 17:57:42'),
(27, 'Test 22', NULL, 'M', NULL, 'test22@test.com', '2022-02-17 16:57:42', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'TB0qNPw1ip', NULL, NULL, 0, NULL, '2022-02-17 17:57:42', '2022-02-17 17:57:42'),
(28, 'Test 23', NULL, 'M', NULL, 'test23@test.com', '2022-02-17 16:57:42', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'bxE80AfVEC', NULL, NULL, 0, NULL, '2022-02-17 17:57:42', '2022-02-17 17:57:42'),
(29, 'Test 24', NULL, 'M', NULL, 'test24@test.com', '2022-02-17 16:57:42', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'CHQLNvBmuw', NULL, NULL, 0, NULL, '2022-02-17 17:57:42', '2022-02-17 17:57:42'),
(30, 'Test 25', NULL, 'M', NULL, 'test25@test.com', '2022-02-17 16:57:43', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, '2LcqzjXy5e', NULL, NULL, 0, NULL, '2022-02-17 17:57:43', '2022-02-17 17:57:43'),
(31, 'Test 26', NULL, 'M', NULL, 'test26@test.com', '2022-02-17 16:57:43', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'hYGAmuSjAN', NULL, NULL, 0, NULL, '2022-02-17 17:57:43', '2022-02-17 17:57:43'),
(32, 'Test 27', NULL, 'M', NULL, 'test27@test.com', '2022-02-17 16:57:43', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'fHY9pMWFoR', NULL, NULL, 0, NULL, '2022-02-17 17:57:43', '2022-02-17 17:57:43'),
(33, 'Test 28', NULL, 'M', NULL, 'test28@test.com', '2022-02-17 16:57:43', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'LRofSOUbfG', NULL, NULL, 0, NULL, '2022-02-17 17:57:43', '2022-02-17 17:57:43'),
(34, 'Test 29', NULL, 'M', NULL, 'test29@test.com', '2022-02-17 16:57:43', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'k0rAfN96p3', NULL, NULL, 0, NULL, '2022-02-17 17:57:43', '2022-02-17 17:57:43'),
(35, 'Test 30', NULL, 'M', NULL, 'test30@test.com', '2022-02-17 16:57:43', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'Y9wE7v0fNL', NULL, NULL, 0, NULL, '2022-02-17 17:57:43', '2022-02-17 17:57:43'),
(36, 'Test 31', NULL, 'M', NULL, 'test31@test.com', '2022-02-17 16:57:44', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'x48yyEPrlQ', NULL, NULL, 0, NULL, '2022-02-17 17:57:44', '2022-02-17 17:57:44'),
(37, 'Test 32', NULL, 'M', NULL, 'test32@test.com', '2022-02-17 16:57:44', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'Vne0WVbPTF', NULL, NULL, 0, NULL, '2022-02-17 17:57:44', '2022-02-17 17:57:44'),
(38, 'Test 33', NULL, 'M', NULL, 'test33@test.com', '2022-02-17 16:57:44', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, '0jbvCTKU2A', NULL, NULL, 0, NULL, '2022-02-17 17:57:44', '2022-02-17 17:57:44'),
(39, 'Test 34', NULL, 'M', NULL, 'test34@test.com', '2022-02-17 16:57:44', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'c3Gb0HYjFC', NULL, NULL, 0, NULL, '2022-02-17 17:57:44', '2022-02-17 17:57:44'),
(40, 'Test 35', NULL, 'M', NULL, 'test35@test.com', '2022-02-17 16:57:44', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'EYu012HF59', NULL, NULL, 0, NULL, '2022-02-17 17:57:44', '2022-02-17 17:57:44'),
(41, 'Test 36', NULL, 'M', NULL, 'test36@test.com', '2022-02-17 16:57:44', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'U33zUSMohB', NULL, NULL, 0, NULL, '2022-02-17 17:57:44', '2022-02-17 17:57:44'),
(42, 'Test 37', NULL, 'M', NULL, 'test37@test.com', '2022-02-17 16:57:44', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'xfMfKa4Vmj', NULL, NULL, 0, NULL, '2022-02-17 17:57:44', '2022-02-17 17:57:44'),
(43, 'Test 38', NULL, 'M', NULL, 'test38@test.com', '2022-02-17 16:57:45', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'Mr6pfrq3i3', NULL, NULL, 0, NULL, '2022-02-17 17:57:45', '2022-02-17 17:57:45'),
(44, 'Test 39', NULL, 'M', NULL, 'test39@test.com', '2022-02-17 16:57:45', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'ydcqJ84EO1', NULL, NULL, 0, NULL, '2022-02-17 17:57:45', '2022-02-17 17:57:45'),
(45, 'Test 40', NULL, 'M', NULL, 'test40@test.com', '2022-02-17 16:57:45', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'A2m2gqB2C6', NULL, NULL, 0, NULL, '2022-02-17 17:57:45', '2022-02-17 17:57:45'),
(46, 'Test 41', NULL, 'M', NULL, 'test41@test.com', '2022-02-17 16:57:45', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'yfbSuOcrce', NULL, NULL, 0, NULL, '2022-02-17 17:57:45', '2022-02-17 17:57:45'),
(47, 'Test 42', NULL, 'M', NULL, 'test42@test.com', '2022-02-17 16:57:45', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'tyTGEmGja1', NULL, NULL, 0, NULL, '2022-02-17 17:57:45', '2022-02-17 17:57:45'),
(48, 'Test 43', NULL, 'M', NULL, 'test43@test.com', '2022-02-17 16:57:45', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, '8p1W6EFeMr', NULL, NULL, 0, NULL, '2022-02-17 17:57:45', '2022-02-17 17:57:45'),
(49, 'Test 44', NULL, 'M', NULL, 'test44@test.com', '2022-02-17 16:57:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, '7JG6z9oUgQ', NULL, NULL, 0, NULL, '2022-02-17 17:57:46', '2022-02-17 17:57:46'),
(50, 'Test 45', NULL, 'M', NULL, 'test45@test.com', '2022-02-17 16:57:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, '5e2GTe7qbU', NULL, NULL, 0, NULL, '2022-02-17 17:57:46', '2022-02-17 17:57:46'),
(51, 'Test 46', NULL, 'M', NULL, 'test46@test.com', '2022-02-17 16:57:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'JcJbXKxlxM', NULL, NULL, 0, NULL, '2022-02-17 17:57:46', '2022-02-17 17:57:46'),
(54, 'Test 49', NULL, 'M', NULL, 'test49@test.com', '2022-02-17 16:57:46', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, 'HAho2RaWag', NULL, NULL, 0, NULL, '2022-02-17 17:57:46', '2022-02-17 17:57:46'),
(58, 'Fanou', 'Jean', 'M', '87867867896', 'fanou@digi.com', NULL, '$2y$10$4CYry963Uwa5.qBzSooIke.zoejWGWF2OjK8OEPExg2e3tlkjvaqi', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-02-28 09:00:28', '2022-02-28 09:47:31'),
(59, 'Fred', 'Rick', 'M', '97876756', 'fred@digi.com', NULL, '$2y$10$4CYry963Uwa5.qBzSooIke.zoejWGWF2OjK8OEPExg2e3tlkjvaqi', 2, 9, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-02-28 10:36:29', '2022-02-28 10:36:29'),
(60, 'ZANNOU', 'Frédéric', 'M', '9876545678', 'frederic@digi.com', NULL, '$2y$10$GjFQIR37CgqxVnYR/FyNAOu2ZxjIa.Zkns9BozKUXt.thtMwrU3qG', 2, 8, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-02-28 10:38:40', '2022-02-28 10:38:40'),
(61, 'regrg', 'erzger', 'M', '77898354768', 'ezfgegz@g.c', NULL, NULL, 2, 3, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-02-28 10:39:33', '2022-02-28 10:39:33'),
(62, 'y-h-h', '-j-jè-jè-j', 'M', '45567890', 'zef@f.c', NULL, NULL, 1, 2, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-02-28 10:42:46', '2022-02-28 10:42:46'),
(63, 'Fre', 'kzjhfzmokz', 'M', '66798680979', 'jio@f.c', NULL, NULL, 1, 4, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-02-28 10:54:41', '2022-02-28 10:54:41'),
(64, 'zefzef', 'zfzef', 'M', '7897687689', 'angehermel@gmail.com', NULL, '$2y$10$QhjgadnFVF.z/.v1A9nvsOOqDo1g9AC5/pA3y6GG4pzSonAifijwq', 1, 3, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-02-28 10:56:11', '2022-02-28 10:56:11'),
(65, 'DOSSOU', 'Mathieu', 'M', '5467890768', 'mathieu@digi.com', NULL, '$2y$10$4CYry963Uwa5.qBzSooIke.zoejWGWF2OjK8OEPExg2e3tlkjvaqi', 2, 7, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-02-28 10:57:17', '2022-03-02 13:03:39'),
(66, 'ZOFOUN', 'Bernard', 'M', '78567890980', 'bernard@digi.com', NULL, '$2y$10$4CYry963Uwa5.qBzSooIke.zoejWGWF2OjK8OEPExg2e3tlkjvaqi', 2, 3, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-02-28 10:58:21', '2022-02-28 10:58:21'),
(67, 'AMANNOU', 'Arnaud', 'M', '34567887', 'aman@digi.com', NULL, '$2y$10$NyTgGmmjW94hHx/tdcBkDOj3LssJZg0HyLzY4orpBcd.aFuaszbo6', 2, 4, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-02-28 11:10:21', '2022-02-28 11:10:21'),
(68, 'ABALO', 'Jean', 'M', '345678908786', 'abalo@digi.com', NULL, '$2y$10$HU4Ws7lrcivJrxWHBModgOqLhVPz34X3Sl/XVA0Yolc3UImP7QIX2', 2, 5, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-02-28 11:13:16', '2022-02-28 11:13:16'),
(69, 'GOHOUNGO', 'Pierre', 'M', '98337373', 'pierreg@digi.com', NULL, '$2y$10$2iAI2akK3VwftB.NPKfY0O/cD3EkHkQMdx2uzrjLgiMWuDAEz5via', 2, 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-02-28 11:17:05', '2022-02-28 11:17:05'),
(70, 'GODONOU', 'Bénoît', 'M', '9087658979', 'benoit@digi.com', NULL, '$2y$10$x9eOkMA2QQRj0ONIsUkPeeWQP2/3UHkrrGmnQs5U8BjNw55ymx.WW', 2, 10, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-03-02 12:53:03', '2022-03-02 12:53:03'),
(71, 'Toto', 'Tata', 'M', '8769876987', 'toto@digi.com', NULL, '$2y$10$VLcwbPJ2TJkfmK27uKve6.f0gUbfvk4RC2Om0LBM1jYutiz1BZxia', 2, 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-03-02 12:58:52', '2022-03-02 12:58:52'),
(72, 'zefez', 'zefze', 'M', NULL, 'eze@dod.c', NULL, '$2y$10$kh5l.EtK6wN6c4N63W0N9uAiTv5GJ3dOZCHpQFdagoCi4uVPdjQhu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-03-02 13:00:44', '2022-03-02 13:00:44'),
(73, 'DANGBENON', 'Didier', 'M', '87896798687', 'didier@digi.com', NULL, '$2y$10$QhjgadnFVF.z/.v1A9nvsOOqDo1g9AC5/pA3y6GG4pzSonAifijwq', 2, 2, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-03-02 13:15:02', '2022-03-02 13:15:02'),
(74, 'ABODE', 'François', 'M', NULL, 'francois@digi.com', NULL, '$2y$10$GjFQIR37CgqxVnYR/FyNAOu2ZxjIa.Zkns9BozKUXt.thtMwrU3qG', 2, 7, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-03-07 10:11:24', '2022-03-07 10:11:24'),
(75, 'FANOU', 'Isidore', 'M', '98782739', 'isidore@digi.com', NULL, '$2y$10$gIT9zkcHFyziDgJmnmtt9OBjkJzSBADJGse.fRTuPmMBO8fM.z1Ja', 2, 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-03-10 07:50:48', '2022-03-10 07:50:48'),
(76, 'TOWANOU', 'Gérard', 'M', '89027879', 'gerard@digi.com', NULL, '$2y$10$lQZOScGZrdrn0bpWFlt7/OlgPZ.rUL2g6S5o5rtSe/3ijSbTi0rhK', 2, 6, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-03-10 07:52:20', '2022-03-10 07:52:20'),
(77, 'Truyzei', 'iuhzuifohzeiuf', 'M', NULL, 'zieoe@digi.com', NULL, '$2y$10$V6OWUz4jmmkhtHcpxKnMGO5WaFIPZOIbUg9RknHeu.aqdRVSIpVtu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2022-03-10 16:45:13', '2022-03-10 16:45:13'),
(78, 'zefzezafez', 'zfezfze', 'M', '876578687', 'ezerfverer@xn--f-wpn.c', NULL, '$2y$10$L.dKocrJ4wLRwnEuZYViZuMcOBJ2DSky51ZLjEqi6X1FLZ/ZfzuLe', 1, 2, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-03-14 08:57:49', '2022-03-14 08:57:49'),
(79, 'RANDJO', 'Dorice', 'F', '7908657576', 'dorice@digi.com', NULL, '$2y$10$Qy5cwqVaNPdZA8WS5tMjReF8Vu7cFHeLHRI2xo053E7LhL6aSxx2S', 3, 5, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-03-14 09:07:45', '2022-03-14 09:07:45'),
(80, 'André', 'GOGAN', 'M', '98786756', 'andre@digi.com', NULL, '$2y$10$zt7989BMS6VDn7VCvJN/IeEiOoWRDJRk3LdW3eXFtyuatfmzPsF6i', 1, 4, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-03-22 15:14:03', '2022-03-22 15:14:03');

-- --------------------------------------------------------

--
-- Structure de la table `ware_houses`
--

DROP TABLE IF EXISTS `ware_houses`;
CREATE TABLE IF NOT EXISTS `ware_houses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `adress` varchar(255) DEFAULT NULL,
  `cm_id` int(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
