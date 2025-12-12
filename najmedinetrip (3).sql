-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 12 déc. 2025 à 00:29
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `najmedinetrip`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `commentaire` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `etoiles` smallint NOT NULL,
  `date_creation` datetime NOT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F91ABF0A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `nom`, `prenom`, `commentaire`, `etoiles`, `date_creation`, `user_id`) VALUES
(9, 'ahmed', 'maghrbi', 'tttttttttttttttttttttttttyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', 4, '2025-11-28 12:46:32', NULL),
(10, 'fergferg', 'LINA', 'ergzregrtgh\'rth', 5, '2025-11-30 19:12:47', NULL),
(11, 'beji', 'amin', 'test 3', 3, '2025-12-03 10:14:36', NULL),
(12, 'fewgfweg', 'wrgregerg', 'ergegerg', 5, '2025-12-03 10:22:43', NULL),
(13, 'admin', 'admin', 'srgergergte', 4, '2025-12-03 10:54:28', 2),
(14, 'admin', 'admin', 'ttt', 3, '2025-12-07 17:22:32', 2),
(15, 'admin', 'admin', 'gdgergwrgerg', 3, '2025-12-10 20:38:15', 2);

-- --------------------------------------------------------

--
-- Structure de la table `avis_excursion`
--

DROP TABLE IF EXISTS `avis_excursion`;
CREATE TABLE IF NOT EXISTS `avis_excursion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `excursion_id` int NOT NULL,
  `note` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `commentaire` longtext COLLATE utf8mb3_unicode_ci,
  `created_at` datetime NOT NULL,
  `compagnon` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3D5DF8EE4AB4296F` (`excursion_id`),
  KEY `IDX_3D5DF8EEA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `avis_excursion`
--

INSERT INTO `avis_excursion` (`id`, `excursion_id`, `note`, `user_id`, `commentaire`, `created_at`, `compagnon`) VALUES
(24, 16, 4, 2, 'tt', '2025-12-04 12:48:31', 'Couples'),
(25, 16, 2, 2, 'gfefg', '2025-12-04 12:49:50', 'Amis'),
(26, 16, 3, 2, 'bbbb', '2025-12-04 12:50:00', 'Affaires'),
(27, 16, 2, 2, 'bb', '2025-12-04 12:50:08', 'Famille'),
(28, 16, 3, 2, 'oui', '2025-12-04 12:53:55', 'Couples'),
(29, 16, 2, 2, 'hhfhf', '2025-12-06 14:54:58', 'Couples'),
(30, 19, 5, 2, 'najmedin yatek asba', '2025-12-10 20:36:26', 'Solo');

-- --------------------------------------------------------

--
-- Structure de la table `chat_message`
--

DROP TABLE IF EXISTS `chat_message`;
CREATE TABLE IF NOT EXISTS `chat_message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `message` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FAB3FC16A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `chat_message`
--

INSERT INTO `chat_message` (`id`, `user_id`, `message`, `created_at`) VALUES
(13, 2, 'ahla', '2025-12-06 13:17:45'),
(14, 2, 'cc', '2025-12-06 13:27:19'),
(15, 2, 'sdgsdg', '2025-12-10 20:37:35');

-- --------------------------------------------------------

--
-- Structure de la table `contact_message`
--

DROP TABLE IF EXISTS `contact_message`;
CREATE TABLE IF NOT EXISTS `contact_message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sujet` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `message` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_envoi` datetime NOT NULL,
  `lus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `contact_message`
--

INSERT INTO `contact_message` (`id`, `nom`, `email`, `sujet`, `message`, `date_envoi`, `lus`) VALUES
(24, 'ksontini', 'sahbi@gmail.com', 'test', 'adazdazd', '2025-12-11 22:44:44', 1),
(25, 'ksontini', 'najmedin@gmail.com', 'test', 'azfezefzef zef zef zef zef azdf zef erg sdv xcv zef sdc', '2025-12-11 23:19:17', 1),
(26, 'ksontini', 'ahmed@gmail.com', 'test', 'fdgergergqergq', '2025-12-12 00:15:49', 0);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20251030165016', '2025-10-30 16:50:25', 78),
('DoctrineMigrations\\Version20251102110538', '2025-11-02 11:05:47', 82),
('DoctrineMigrations\\Version20251102114427', '2025-11-02 11:44:30', 22),
('DoctrineMigrations\\Version20251108100820', '2025-11-08 10:08:29', 71),
('DoctrineMigrations\\Version20251108104058', '2025-11-08 10:41:04', 25),
('DoctrineMigrations\\Version20251113000743', '2025-11-13 00:07:46', 42),
('DoctrineMigrations\\Version20251113132329', '2025-11-13 13:23:31', 40),
('DoctrineMigrations\\Version20251113135733', '2025-11-13 13:57:34', 9),
('DoctrineMigrations\\Version20251113140352', '2025-11-13 14:03:54', 20),
('DoctrineMigrations\\Version20251116132904', '2025-11-16 13:29:41', 250),
('DoctrineMigrations\\Version20251116142332', '2025-11-16 14:23:34', 23),
('DoctrineMigrations\\Version20251117125058', '2025-11-17 12:51:36', 42),
('DoctrineMigrations\\Version20251117135206', '2025-11-17 13:52:53', 36),
('DoctrineMigrations\\Version20251117142402', '2025-11-17 14:24:03', 42),
('DoctrineMigrations\\Version20251118002659', '2025-11-18 00:27:01', 69),
('DoctrineMigrations\\Version20251118011745', '2025-11-18 01:17:47', 15),
('DoctrineMigrations\\Version20251118154858', '2025-11-18 15:49:01', 41),
('DoctrineMigrations\\Version20251125000639', '2025-11-25 00:06:48', 16),
('DoctrineMigrations\\Version20251125000941', '2025-11-25 00:09:46', 29),
('DoctrineMigrations\\Version20251125001115', '2025-11-25 00:11:18', 29),
('DoctrineMigrations\\Version20251125001531', '2025-11-25 00:15:34', 23),
('DoctrineMigrations\\Version20251127160246', '2025-11-27 16:02:48', 23),
('DoctrineMigrations\\Version20251129144520', '2025-11-29 14:45:42', 86),
('DoctrineMigrations\\Version20251130142606', '2025-11-30 14:26:19', 84),
('DoctrineMigrations\\Version20251201183055', '2025-12-01 18:32:18', 40),
('DoctrineMigrations\\Version20251203105215', '2025-12-03 10:52:21', 91),
('DoctrineMigrations\\Version20251203110436', '2025-12-03 11:04:41', 118),
('DoctrineMigrations\\Version20251203130254', '2025-12-03 13:02:58', 63),
('DoctrineMigrations\\Version20251203130629', '2025-12-03 13:06:33', 93),
('DoctrineMigrations\\Version20251203144854', '2025-12-03 14:48:56', 33),
('DoctrineMigrations\\Version20251203154632', '2025-12-03 15:47:44', 42),
('DoctrineMigrations\\Version20251204133404', '2025-12-04 13:34:10', 85),
('DoctrineMigrations\\Version20251206122700', '2025-12-06 12:27:08', 75),
('DoctrineMigrations\\Version20251210152430', '2025-12-10 15:24:35', 50);

-- --------------------------------------------------------

--
-- Structure de la table `excursion`
--

DROP TABLE IF EXISTS `excursion`;
CREATE TABLE IF NOT EXISTS `excursion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb3_unicode_ci,
  `categorie` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `duree` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cancellation` longtext COLLATE utf8mb3_unicode_ci,
  `localisation` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `a_propos` longtext COLLATE utf8mb3_unicode_ci,
  `prix_par_personne` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `image_principale` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `actif` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `ages` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `max_pers` int DEFAULT NULL,
  `guide` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `excursion`
--

INSERT INTO `excursion` (`id`, `titre`, `description`, `categorie`, `duree`, `cancellation`, `localisation`, `a_propos`, `prix_par_personne`, `image_principale`, `actif`, `created_at`, `updated_at`, `ages`, `max_pers`, `guide`) VALUES
(14, 'Excursion Sahara', 'Découvrez le riche patrimoine tunisien lors de cette excursion d\'une journée, en explorant les ruines antiques de Carthage, classées au patrimoine mondial de l\'UNESCO, le charmant village de Sidi Bou Said, le fascinant musée du Bardo et la vibrante médina de Tunis.\r\n\r\nFaits saillants : \r\n\r\n• Découvrez les ruines classées au patrimoine mondial de l\'UNESCO, en visitant des sites emblématiques comme les thermes antonins et les ports puniques.\r\n\r\n• Promenez-vous dans les rues pittoresques bleues et blanches de ce village côtier, avec une vue imprenable sur la Méditerranée et une atmosphère détendue.\r\n\r\n• Plongez dans l’histoire de la Tunisie dans ce musée renommé, qui abrite une impressionnante collection de mosaïques et d’artefacts romains.\r\n\r\n• Découvrez le cœur animé de Tunis, en explorant des marchés animés et des ruelles historiques.', 'Day Trip', '4 Heures / 1 jour', 'Annulation gratuite jusqu\'à 48h avant', 'Douz, Tunisie', 'bbbbbbbbb', '450', 'excursion1.jpg', 1, '2025-11-16 17:11:51', '2025-11-17 02:26:44', '0-99', 12, 'Anglais'),
(16, 'De Hammamet ou Tunis: Carthage, Bardo, Sidi Bou said et Médine', 'Découvrez le riche patrimoine tunisien lors de cette excursion d\'une journée, en explorant les ruines antiques de Carthage, classées au patrimoine mondial de l\'UNESCO, le charmant village de Sidi Bou Said, le fascinant musée du Bardo et la vibrante médina de Tunis.\r\n\r\nFaits saillants : \r\n\r\n• Découvrez les ruines classées au patrimoine mondial de l\'UNESCO, en visitant des sites emblématiques comme les thermes antonins et les ports puniques.\r\n\r\n• Promenez-vous dans les rues pittoresques bleues et blanches de ce village côtier, avec une vue imprenable sur la Méditerranée et une atmosphère détendue.\r\n\r\n• Plongez dans l’histoire de la Tunisie dans ce musée renommé, qui abrite une impressionnante collection de mosaïques et d’artefacts romains.\r\n\r\n• Découvrez le cœur animé de Tunis, en explorant des marchés animés et des ruelles historiques.', 'Day Trip', '8 h', 'Annulation gratuite jusqu\'à 48h avant', 'Tunis', 'Itinéraire\r\nCeci est un itinéraire typique pour ce produit\r\n\r\nArrêt à : Site Archeologique de Carthage, Carthage Tunisia\r\n\r\nExplorez le site archéologique de Carthage, admirant d\'anciens monuments avec une vue imprenable sur la côte environnante. Carthage a été détruite par les Romains en 146 avant JC, mais les fouilles ont révélé des maisons à cinq étages, des systèmes d\'égouts et les restes des murs de la ville qui s\'étalaient autrefois sur 21 km (34 km) sur la colline de Byrsa.\r\n\r\nDurée : 2 heures\r\n\r\nArrêt à : Baths of Antoninus, Impasse des Thermes d\'Antonin Site Archoologique de Carthage, Carthage 2016 Tunisia\r\n\r\nExplorez le site archéologique de Carthage, admirant d\'anciens monuments avec une vue imprenable sur la côte environnante. Carthage a été détruite par les Romains en 146 avant JC, mais les fouilles ont révélé des maisons à cinq étages, des systèmes d\'égouts et les restes des murs de la ville qui s\'étalaient autrefois sur 21 km (34 km) sur la colline de Byrsa.\r\n\r\nDurée : 30 minutes\r\n\r\nArrêt à : Tophet de Carthage, Rue de Hannibal, Carthage 7016 Tunisia\r\n\r\nExplorez le site archéologique de Carthage, admirant d\'anciens monuments avec une vue imprenable sur la côte environnante. Carthage a été détruite par les Romains en 146 avant JC, mais les fouilles ont révélé des maisons à cinq étages, des systèmes d\'égouts et les restes des murs de la ville qui s\'étalaient autrefois sur 21 km (34 km) sur la colline de Byrsa.\r\n\r\nDurée : 1 heure\r\n\r\nArrêt à : Carthage  Aqueduct, Carthage Tunisia\r\n\r\nExplorez le site archéologique de Carthage, admirant d\'anciens monuments avec une vue imprenable sur la côte environnante. Carthage a été détruite par les Romains en 146 avant JC, mais les fouilles ont révélé des maisons à cinq étages, des systèmes d\'égouts et les restes des murs de la ville qui s\'étalaient autrefois sur 21 km (34 km) sur la colline de Byrsa.\r\n\r\nDurée : 30 minutes\r\n\r\nArrêt à : Centro storico, Avenue 14 Janvier, Sidi Bou Said 2026 Tunisia\r\n\r\nDécouvrez Sidi Bou Said, un village pittoresque bleu et blanc qui surplombe la mer Méditerranée.\r\n\r\nDurée : 1 heure\r\n\r\nArrêt à : Bardo National Museum, Bardo center, RN 7, Tunis, Tunisia\r\n\r\nDécouvrez l\'une des plus grandes collections de mosaïques romaines au monde, le musée du Bardo représente « la première destination pour explorer et comprendre la vaste et riche histoire de la Tunisie ».\r\n\r\nDurée : 1 heure\r\n\r\nArrêt à : Beb Bhar, Tunis Tunisia\r\n\r\nDécouvrez les portes célèbres de la médina de Tunis\r\n\r\nDurée : 15 minutes\r\n\r\nPasse devant : EzZitouna Mosque, 30 Rue Jamaa Ezzitouna, Tunis Tunisia\r\n\r\nVisitez la mosquée Zitouna de Tunis\r\n\r\nArrêt à : Medina of Tunis, Tunis Tunisia\r\n\r\nDécouvrez la médina de Tunis, la vieille ville classée au patrimoine mondial de l\'UNESCO. Suivez votre guide à travers les rues étroites jusqu\'à la mosquée Zitouna, un marché traditionnel des fabricants de casquettes et le marché aux parfums colorés de Tunis.\r\n\r\nDurée : 1 heure', '140', '2a-691c99b4db1cc.jpg', 1, '2025-11-18 16:07:16', '2025-11-18 16:07:16', '0-99', 10, 'Français'),
(17, 'Médina,Carthage ,Sidi Bou Saïd, musée Bardo', 'Dans le cadre d\'une excursion d\'une journée complète de Tunis qui inclut le déjeuner et le transport aller-retour au départ de votre hôtel. Vous allez visiter quatre sites: Medina, La Goulette, Carthage et Sidi BouSaid.\r\n\r\nLa meilleure façon de découvrir en profondeur la ville de Tunis c’est avec sa vieille Médina classée au patrimoine mondial de l’UNESCO.\r\n\r\nPartez ensuite à la découverte de la Goulette, ce quartier de banlieue est réputé pour la perpétuelle animation qui règne dans ses rues. Faites une pause pour le DEJ dans un restaurant local.\r\n\r\nAprès avoir visité ce quartier, Vous aurez aussi la chance de visiter l’antique cité de Carthage qui comporte des monuments antiques offrant une superbe vue sur la côte environnante. Après avoir visité ce site archéologique classé au patrimoine de l\'UNESCO, vous continuerez jusqu\'à Sidi Bou Saïd, un village pittoresque en bleu et blanc qui surplombe la mer Méditerranée.', 'Tour privée', '8 h', 'Annulation gratuite jusqu\'à 48h avant', 'Tunis centre', 'Itinéraire\r\nCeci est un itinéraire typique pour ce produit\r\n\r\nArrêt à : Medina of Tunis, Tunis Tunisia\r\n\r\nce labyrinthe tentaculaire de rues et ruelles anciennes est l\'une des médinas médiévales les plus impressionnantes d\'Afrique du Nord et l\'un des grands trésors de la Tunisie. Il abrite de nombreux souks couverts vendant de tout, des chaussures aux chicha, ainsi que des cafés animés, des ruelles pleines d\'artisans au travail et des zones résidentielles rythmées par de grandes portes peintes de couleurs vives. Des palais historiques, des hammams, des mosquées et des madrassas (écoles pour l\'étude du Coran) sont dispersés partout, beaucoup sont richement décorés de carreaux, de stuc sculpté et de colonnes de marbre.\r\n\r\nDurée : 1 heure 30 minutes\r\n\r\nArrêt à : La Goulette, La Goulette, Tunis Governorate\r\n\r\nce quartier de banlieue est réputé pour la perpétuelle animation qui règne dans ses rues, à longueur d’année. Les terrasses des cafés et des restaurants se succèdent au bord de la mer\r\n\r\nDurée : 1 heure 30 minutes\r\n\r\nArrêt à : Site Archeologique de Carthage, Carthage Tunisia\r\n\r\nLe site archéologique de Carthage est un site dispersé dans la ville actuelle de Carthage (Tunisie) et classé au patrimoine mondial de l\'Unesco depuis 1979.\r\n\r\n\r\nDurée : 1 heure\r\n\r\nArrêt à : Sidi Bou Said, Sidi Bou Said, Tunis Governorate\r\n\r\nAvec ses couleurs bleu et blanc distinctives, ses rues pavées et ses aperçus époustouflants d\'eaux azurées, le village au sommet d\'une falaise de Sidi Bou Saïd est l\'un des plus beaux endroits de Tunisie. \r\nSon architecture distinctive est un mélange d\'ottoman et d\'andalou, résultat de l\'afflux de musulmans espagnols au XVIe siècle.\r\n\r\nDurée : 2 heures', '120', '4c-693983cc25e9f.jpg', 1, '2025-12-10 14:29:32', '2025-12-10 14:29:32', '0-99', 10, 'Arabe, Français'),
(18, 'Tour à la Médina de Hammamet et au Marché des Épicesde Nabeul', 'Partez à la découverte de Nabeul, « capitale de la céramique et de la poterie », puis laissez-vous séduire par le charme et les superbes plages d\'Hammamet. \r\n\r\n Un guide viendra vous chercher à votre hôtel pour visiter un atelier traditionnel de poterie et de céramique. Vous flânerez ensuite dans la Médina de la ville, où vous pourrez retrouver l\'ensemble de ces objets, mais aussi quantité de productions en provenance d\'autres régions tunisiennes, à l\'image du cuivre, du cuir, des broderies ou encore des couffins. \r\n\r\nPrenez ensuite la route vers Hammamet, surnommé le « Saint-Tropez tunisien » pour une visite guidée de la Médina, construite en front de mer et offrant des vues splendides des toits-terrasses. La balade dans les souks et la visite du vieux port de pêche d’Hammamet vous permettront de vous imprégner de la culture enchanteresse de la ville.\r\n\r\nUne expérience unique et immersive au cœur de la Tunisie !', 'une journée', '4 h', 'Annulation gratuite jusqu\'à 48h avant', 'Hammamet-Nabeul', 'Itinéraire\r\nCeci est un itinéraire typique pour ce produit\r\n\r\nArrêt à : Medina of Yasmine Hammamet, Hammamet Tunisia\r\n\r\nUne visite guidée pour découvrir l\'histoire de la Médina, dévoiler les secrets de l\'architecture et les codes sociaux qui les cachent. Un monde oriental très magique à admirer.\r\n\r\nDurée : 1 heure 30 minutes\r\n\r\nArrêt à : Nabeul Market, Av. Mongi Bali, Nabeul 8000 Tunisia\r\n\r\nVisite du marché des épices, c\'est le marché quotidien des Tunisiens qui nous donne une idée sur le vrai visage du pays. Découvrir le savoir-faire culinaire de la région de Nabeul la capitale de la Harissa et l\'eau de Néroli.\r\n\r\nDurée : 1 heure 30 minutes\r\n\r\nArrêt à : Kerkenis Ceram, 121 Av. Habib Thameur, Nabeul‎ 8000, Tunisia\r\n\r\nVisite de l\'atelier de poterie et admiration du savoir-faire ancestral de l\'artisanat dans la capitale de la poterie. \r\n\r\nDurée : 1 heure', '80', 'd2-69398e68cd379.jpg', 1, '2025-12-10 15:14:48', '2025-12-10 15:14:48', '0-99', 5, 'Arabe, Français'),
(19, 'Visite Privée et Guidée à Kairouan et El Jem et Monastir', 'Depuis votre Hôtel vers la ville de Kairouan la quatrième ville sainte de l’Islam et capitale spirituelle de la Tunisie. Vous visiterez la grande mosquée qui est le plus ancien édifice religieux de l\'Occident musulman Par la suite vous aurez du temps libre dans la médina de Kairouan. Puis El Djem l\'ancienne cité de Thysdrus, l\'une des plus prospères de l\'Afrique romaine pour la visite de son amphithéâtre et finir l’excursion par Monastir ancienne ville punique puis romaine de Ruspina.', 'Day Trip', '8 h', 'Annulation gratuite jusqu\'à 48h avant', 'kairouan-el jam- monastir', 'Itinéraire\r\nCeci est un itinéraire typique pour ce produit\r\n\r\nArrêt à : The Great Mosque of Kairouan, Kairouan 3100 Tunisia\r\n\r\nLa Grande Mosquée est le symbole de Kairouan. C\'est l\'une des plus anciennes mosquées du monde et des plus belles, l\'un des monuments les plus impressionnants de tout le Maghreb ! Son prestige religieux fait de Kairouan la 4ème ville sainte de l\'Islam. On admire son imposant minaret, sa cour majestueuse aux dimensions impressionnantes, entourée d\'arcades superbement dessinées et abritant un cadran solaire, et les hautes portes de bois de cèdre richement sculptées. Elles s\'ouvrent sur les salles de prière, ornées de dizaines de colonnes de marbre. Edifié en 670, ce chef d\'œuvre architectural dont l\'aspect évoque une forteresse en pisé a inspiré les autres mosquées du Maghreb.\r\n\r\nDurée : 45 minutes\r\n\r\nArrêt à : Medina of Kairouan, Rue Bouhaha Houmet Jemmaa la medina de Kairouan, Kairouan 3100 Tunisia\r\n\r\nLa médina de Kairouan est l\'une des plus préservées et authentiques de Tunisie, où vous pourrez jeter un œil dans les souks, déguster les pâtisseries de Kairouan \"Les Mekroudhs\" et sa fabrication artisanale de tapis.\r\n\r\nDurée : 1 heure\r\n\r\nArrêt à : Bassins Aghlabites, Avenue De La Republique, Kairouan 3100 Tunisia\r\n\r\nLes bassins des Aghlabides sont un monument historique tunisien situé à Kairouan.\r\nDatés du début de la seconde moitié du ixe siècle et localisés à l\'extérieur des remparts de la médina de Kairouan, ils sont considérés comme les plus importants ouvrages hydrauliques de l\'histoire du monde musulman\r\n\r\n\r\nDurée : 20 minutes\r\n\r\nArrêt à : Amphitheatre D\'el Jem, Rue Ali Belhareth, El-Jem Tunisia\r\n\r\nUne visite au Colisée romain, fondé au IIIe siècle après JC et classé au patrimoine mondial en 1972, pouvant accueillir 30000 spectateurs, troisième dans le monde romain par sa taille après celui de Rome et celui de Capoue, l\'amphithéâtre d\'El Djem et le monument romain le plus impressionnant d\'Afrique.\r\n\r\nDurée : 1 heure\r\n\r\nArrêt à : Ribat of Monastir, Rte de la Falaise, Monastir Tunisia\r\n\r\nC\'est le plus ancien et le plus important des ouvrages défensifs érigés le long de la côte maghrébine par les conquérants arabes, à l\'aube de l\'islam. Fondé en 796, ce bâtiment a subi plusieurs rénovations au cours de la période médiévale. Initialement, en forme de quadrilatère, il est composé de quatre corps de bâtiments donnant sur deux cours intérieures. Outre les petites cellules des «moines guerriers» qui, tout en assurant leurs fonctions militaires, se consacraient à la prière et à la contemplation, le Ribat abrite deux salles de prière dont la plus spacieuse abrite aujourd\'hui des objets de collection rares de culte et artisanat médiéval. fois. Une centaine de marches en colimaçon permettent d\'accéder à la tour de guet du haut de laquelle des messages lumineux s\'échangeaient la nuit avec les tours des ribats voisins et qui offre au visiteur une superbe vue sur la ville de Monastir et son large.\r\n\r\nDurée : 45 minutes', '120', '0b-69399e6478245.jpg', 1, '2025-12-10 16:23:00', '2025-12-10 16:23:00', '0-99', 20, 'Arabe, Français');

-- --------------------------------------------------------

--
-- Structure de la table `excursion_detail`
--

DROP TABLE IF EXISTS `excursion_detail`;
CREATE TABLE IF NOT EXISTS `excursion_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `excursion_id` int NOT NULL,
  `titre` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `ordre` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BFB0D73B4AB4296F` (`excursion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `excursion_detail`
--

INSERT INTO `excursion_detail` (`id`, `excursion_id`, `titre`, `description`, `ordre`) VALUES
(14, 16, 'Aide', 'Si vous avez des questions sur cette visite ou besoin d\'aide pour réserver, \r\nnous nous ferons une joie de vous aider. \r\nAppelez-nous simplement au numéro 93312378.\r\ntesterr', 1),
(15, 16, 'Conditions d\'annulation', '• Pour recevoir un remboursement complet, vous devez annuler plus de 24 heures avant l\'heure de début de l\'expérience.\r\n• Si vous annulez moins de 24 heures avant l\'heure de début de l\'expérience, le montant que vous avez payé ne sera pas remboursé.\r\n• Aucune modification effectuée moins de 24 heures avant l\'heure de début de l\'expérience ne sera acceptée.\r\n• Les heures limites de réservation sont basées sur le fuseau horaire de l\'expérience.\r\n• Pour avoir lieu, cette expérience requiert un nombre minimum de voyageurs. Si elle est annulée car cette condition n\'est pas remplie, nous vous proposerons une autre date/activité ou le remboursement complet.\r\n\r\nteeessssst', 1),
(16, 16, '', '', 1),
(17, 16, '', '', 1),
(18, 17, 'Accessibilité', '- Non accessible en fauteuil roulant\r\n- Accessible en poussette\r\n- Animaux aidants acceptés\r\n- Transports publics proches\r\n- Les enfants en bas âge doivent être assis sur les genoux d\'un adulte', 1),
(22, 17, 'Aide', 'Si vous avez des questions sur cette visite ou besoin d\'aide pour réserver, \r\n    nous nous ferons une joie de vous aider. \r\n    Appelez-nous simplement au numéro 93312378.', 1),
(23, 17, 'Conditions d\'annulation', '• Pour recevoir un remboursement complet, vous devez annuler plus de 24 heures avant l\'heure de début de l\'expérience.\r\n    • Si vous annulez moins de 24 heures avant l\'heure de début de l\'expérience, le montant que vous avez payé ne sera pas remboursé.\r\n    • Aucune modification effectuée moins de 24 heures avant l\'heure de début de l\'expérience ne sera acceptée.\r\n    • Les heures limites de réservation sont basées sur le fuseau horaire de l\'expérience.\r\n    • Pour avoir lieu, cette expérience requiert un nombre minimum de voyageurs. Si elle est annulée car cette condition n\'est pas remplie, nous vous proposerons une autre date/activité ou le remboursement complet.', 1),
(24, 17, '', '', 1),
(25, 16, '', '', 1),
(26, 18, 'Accessibilité', '- Accessible en fauteuil roulant\r\n- Accessible en poussette\r\n- Transports publics proches\r\n- Chaises enfant disponibles\r\n- Transport accessible en fauteuil roulant\r\n- Revêtements adaptés aux fauteuils roulants', 1),
(27, 18, 'Aide', '- Si vous avez des questions sur cette visite ou besoin d\'aide pour réserver, \r\n   nous nous ferons une joie de vous aider. \r\n   Appelez-nous simplement au numéro 93312378.', 1),
(28, 18, 'Conditions d\'annulation', '• Pour recevoir un remboursement complet, vous devez annuler plus de 24 heures avant l\'heure de début de l\'expérience.\r\n    • Si vous annulez moins de 24 heures avant l\'heure de début de l\'expérience, le montant que vous avez payé ne sera pas remboursé.\r\n    • Aucune modification effectuée moins de 24 heures avant l\'heure de début de l\'expérience ne sera acceptée.\r\n    • Les heures limites de réservation sont basées sur le fuseau horaire de l\'expérience.\r\n    • Pour avoir lieu, cette expérience requiert un nombre minimum de voyageurs. Si elle est annulée car cette condition n\'est pas remplie, nous vous proposerons une autre date/activité ou le remboursement complet.', 1),
(29, 19, 'Conditions d\'annulation', '• Pour recevoir un remboursement complet, vous devez annuler plus de 24 heures avant l\'heure de début de l\'expérience.\r\n    • Si vous annulez moins de 24 heures avant l\'heure de début de l\'expérience, le montant que vous avez payé ne sera pas remboursé.\r\n    • Aucune modification effectuée moins de 24 heures avant l\'heure de début de l\'expérience ne sera acceptée.\r\n    • Les heures limites de réservation sont basées sur le fuseau horaire de l\'expérience.\r\n    • Pour avoir lieu, cette expérience requiert un nombre minimum de voyageurs. Si elle est annulée car cette condition n\'est pas remplie, nous vous proposerons une autre date/activité ou le remboursement complet.', 1),
(30, 19, 'Aide', 'Si vous avez des questions sur cette visite ou besoin d\'aide pour réserver, \r\n    nous nous ferons une joie de vous aider. \r\n    Appelez-nous simplement au numéro 93312378.', 1),
(31, 19, 'Accessibilité', '- Accessible en fauteuil roulant\r\n- Accessible en poussette\r\n- Animaux aidants acceptés\r\n- Transports publics proches\r\n- Les enfants en bas âge doivent être assis sur les genoux d\'un adulte', 1);

-- --------------------------------------------------------

--
-- Structure de la table `faqexcursion`
--

DROP TABLE IF EXISTS `faqexcursion`;
CREATE TABLE IF NOT EXISTS `faqexcursion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `excursion_id` int NOT NULL,
  `question` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `reponse` longtext COLLATE utf8mb3_unicode_ci,
  `ordre` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_496A5B584AB4296F` (`excursion_id`),
  KEY `IDX_496A5B58A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `faqexcursion`
--

INSERT INTO `faqexcursion` (`id`, `excursion_id`, `question`, `reponse`, `ordre`, `user_id`) VALUES
(12, 16, 'test', 'oui', 1, NULL),
(13, 16, 'test', NULL, 2, NULL),
(14, 16, 'yes', NULL, 3, NULL),
(15, 16, 'tt', NULL, 4, NULL),
(16, 16, 'yy', NULL, 5, NULL),
(17, 16, 'jj', NULL, 6, NULL),
(18, 16, 'qq', NULL, 7, NULL),
(19, 16, 'jj', NULL, 8, 2),
(20, 16, 'hh', NULL, 9, NULL),
(21, 16, 'bb', NULL, 10, NULL),
(22, 19, 'sdfbewdfewdgw', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `favori`
--

DROP TABLE IF EXISTS `favori`;
CREATE TABLE IF NOT EXISTS `favori` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `excursion_id` int NOT NULL,
  `date_ajout` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EF85A2CCA76ED395` (`user_id`),
  KEY `IDX_EF85A2CC4AB4296F` (`excursion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `favori`
--

INSERT INTO `favori` (`id`, `user_id`, `excursion_id`, `date_ajout`) VALUES
(10, 2, 14, '2025-12-03 20:53:59'),
(11, 2, 16, '2025-12-05 14:18:58');

-- --------------------------------------------------------

--
-- Structure de la table `image_excursion`
--

DROP TABLE IF EXISTS `image_excursion`;
CREATE TABLE IF NOT EXISTS `image_excursion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `excursion_id` int NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `is_principale` tinyint(1) NOT NULL,
  `ordre_affichage` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_438A3C7B4AB4296F` (`excursion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `image_excursion`
--

INSERT INTO `image_excursion` (`id`, `excursion_id`, `image_url`, `is_principale`, `ordre_affichage`) VALUES
(50, 14, 'excursion1.jpg', 1, 1),
(51, 14, 'excursion2.jpg', 0, 2),
(53, 16, '2a-691ca1d056173.jpg', 0, NULL),
(54, 16, '2e-691ca1d056785.jpg', 0, NULL),
(55, 16, '27-691ca1d056b0c.jpg', 0, NULL),
(56, 16, '30-691ca1d056ed1.jpg', 0, NULL),
(57, 16, '31-691ca1d0572b0.jpg', 0, NULL),
(58, 16, '32-691ca1d0576f6.jpg', 0, NULL),
(59, 17, '4c-693983e1f0e5a.jpg', 0, NULL),
(60, 17, '50-693983e1f13c9.jpg', 0, NULL),
(61, 17, '51-693983e1f17f2.jpg', 0, NULL),
(62, 17, '53-693983e1f1b72.jpg', 0, NULL),
(63, 17, '54-693983e1f268b.jpg', 0, NULL),
(64, 18, '7a-69398ef37ffaf.jpg', 0, NULL),
(65, 18, '74-69398ef380687.jpg', 0, NULL),
(66, 18, '75-69398ef380a0f.jpg', 0, NULL),
(67, 18, 'd2-69398ef380e68.jpg', 0, NULL),
(68, 19, '0b-6939a29cabbaf.jpg', 0, NULL),
(69, 19, '0c-6939a29cac270.jpg', 0, NULL),
(70, 19, '23-6939a29cac5df.jpg', 0, NULL),
(71, 19, '24-6939a29cac939.jpg', 0, NULL),
(72, 19, 'booking-el-jem-tours-6939a29cacc08.jpg', 0, NULL),
(73, 19, 'caption-6939a29cad07f.jpg', 0, NULL),
(74, 19, 'cisterna-pequena-6939a29cad3d6.jpg', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `inclus_excursion`
--

DROP TABLE IF EXISTS `inclus_excursion`;
CREATE TABLE IF NOT EXISTS `inclus_excursion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `excursion_id` int NOT NULL,
  `item` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `ordre` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2D0EB09F4AB4296F` (`excursion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `inclus_excursion`
--

INSERT INTO `inclus_excursion` (`id`, `excursion_id`, `item`, `ordre`) VALUES
(26, 17, 'La prise en charge est offerte dans tous les hôtels autour de Tunis ', 1),
(27, 17, 'Guide touristique professionnel agréé', 1),
(28, 17, 'Transport privé', 1),
(29, 17, 'Véhicule climatisé', 1),
(30, 17, 'Entrée – Ruines de Carthage', 1),
(31, 17, 'Entrée – Médina de Tunis', 1),
(32, 17, 'Entrée – Ruines de Carthage', 1),
(33, 17, 'test', 1),
(34, 16, 'Frais d\'entrée au musée de Carthage et du Bardo (Si option sélectionnée)', 1),
(37, 19, '- Entrée – Grande Mosquée de Kairouan', 1),
(38, 19, '- Entrée – Médina de Kairouan', 1),
(39, 19, '- Entrée – Amphithéâtre d\'El Jem', 1),
(40, 19, '- Entrée – Forte El Ribat', 1),
(41, 18, 'Café et/ou thé', 1),
(42, 18, 'Véhicule climatisé', 1);

-- --------------------------------------------------------

--
-- Structure de la table `itineraire_excursion`
--

DROP TABLE IF EXISTS `itineraire_excursion`;
CREATE TABLE IF NOT EXISTS `itineraire_excursion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `excursion_id` int NOT NULL,
  `titre_etape` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_etape` longtext COLLATE utf8mb3_unicode_ci,
  `ordre` int DEFAULT NULL,
  `duree_visite` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `admission` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `has_photos` tinyint(1) NOT NULL DEFAULT '0',
  `coordinates` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CD58DB854AB4296F` (`excursion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `itineraire_excursion`
--

INSERT INTO `itineraire_excursion` (`id`, `excursion_id`, `titre_etape`, `description_etape`, `ordre`, `duree_visite`, `admission`, `has_photos`, `coordinates`) VALUES
(15, 16, 'Ruines de Carthage', 'Explorez la ville avec votre guide, en admirant des monuments anciens avec une vue imprenable sur le littoral environnant. Carthage a été détruite par les Romains en 146 av. J.-C., mais les fouilles ont révélé des maisons de cinq étages, des systèmes d\'égouts et les vestiges des murs de la ville qui s\'étendaient autrefois sur 34 km à travers la colline de Byrsa.', 1, '1.50', 'Gratuit', 0, NULL),
(24, 16, 'tssfwf', 'ergerthtyjku', 2, '2h', 'Gratuit', 0, NULL),
(25, 18, 'Tour à la Médina de Hammamet et au Marché des Épicesde Nabeul', 'Une visite guidée pour découvrir l\'histoire de la Médina, dévoiler les secrets de l\'architecture et les codes sociaux qui les cachent. Un monde oriental très magique à admirer.', 1, '90 minutes', 'Gratuit', 0, '36.39597438833566, 10.611612796002648'),
(26, 18, 'Nabeul Market', 'Visite du marché des épices, c\'est le marché quotidien des Tunisiens qui nous donne une idée sur le vrai visage du pays. Découvrir le savoir-faire culinaire de la région de Nabeul la capitale de la Harissa et l\'eau de Néroli.', 2, '90 minutes', 'Gratuit', 0, '36.45249595000152, 10.72808443110571'),
(27, 18, 'Kerkenis Ceram', 'Visite de l\'atelier de poterie et admiration du savoir-faire ancestral de l\'artisanat dans la capitale de la poterie.', 3, '60 minutes', 'Gratuit', 0, '36.4502537449914, 10.724129144931203'),
(28, 19, 'Forte El Ribat', 'C\'est le plus ancien et le plus important des ouvrages défensifs érigés le long de la côte maghrébine par les conquérants arabes, à l\'aube de l\'islam. Fondé en 796, ce bâtiment a subi plusieurs rénovations au cours de la période médiévale. Initialement, en forme de quadrilatère, il est composé de quatre corps de bâtiments donnant sur deux cours intérieures. Outre les petites cellules des «moines guerriers» qui, tout en assurant leurs fonctions militaires, se consacraient à la prière et à la contemplation, le Ribat abrite deux salles de prière dont la plus spacieuse abrite aujourd\'hui des objets de collection rares de culte et artisanat médiéval. fois. Une centaine de marches en colimaçon permettent d\'accéder à la tour de guet du haut de laquelle des messages lumineux s\'échangeaient la nuit avec les tours des ribats voisins et qui offre au visiteur une superbe vue sur la ville de Monastir et son large.', 5, '45 minutes', 'Gratuit', 0, '35.776645050703976, 10.833027300215608'),
(29, 19, 'Médina de Kairouan', 'La médina de Kairouan est l\'une des plus préservées et authentiques de Tunisie, où vous pourrez jeter un œil dans les souks, déguster les pâtisseries de Kairouan \"Les Mekroudhs\" et sa fabrication artisanale de tapis.', 2, '60 minutes', 'Gratuit', 0, '35.676361381285844, 10.098366682315124'),
(30, 19, 'Bassins Aghlabites', 'Les bassins des Aghlabides sont un monument historique tunisien situé à Kairouan. Datés du début de la seconde moitié du ixe siècle et localisés à l\'extérieur des remparts de la médina de Kairouan, ils sont considérés comme les plus importants ouvrages hydrauliques de l\'histoire du monde musulman', 3, '20 minutes', 'Payant', 0, '35.68729366888256, 10.095412166968522'),
(31, 19, 'Amphithéâtre d\'El Jem', 'Une visite au Colisée romain, fondé au IIIe siècle après JC et classé au patrimoine mondial en 1972, pouvant accueillir 30000 spectateurs, troisième dans le monde romain par sa taille après celui de Rome et celui de Capoue, l\'amphithéâtre d\'El Djem et le monument romain le plus impressionnant d\'Afrique.', 4, '60 minutes', 'Payant', 0, '35.29073230966622, 10.707910991505498');

-- --------------------------------------------------------

--
-- Structure de la table `itineraire_photo`
--

DROP TABLE IF EXISTS `itineraire_photo`;
CREATE TABLE IF NOT EXISTS `itineraire_photo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `itineraire_id` int NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `legende` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ordre` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_92D34557A9B853B8` (`itineraire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `itineraire_photo`
--

INSERT INTO `itineraire_photo` (`id`, `itineraire_id`, `image_url`, `legende`, `ordre`) VALUES
(8, 15, '692b20cec1864.jpg', 'contrat', 1),
(15, 24, '692b2aed7479d.jpg', 'ktjrtheg', 1),
(16, 25, '69399b7320ee7.jpg', 'Medina', NULL),
(17, 26, '6939915a5e72e.jpg', 'Nabeul', NULL),
(18, 28, '6939a2368ecb9.jpg', 'Forte El Ribat', NULL),
(19, 29, '69399fb4edd5b.jpg', 'mosqué', NULL),
(20, 30, '6939a13e53612.jpg', 'Bassins Aghlabites', NULL),
(21, 31, '6939a199eed5f.jpg', 'Amphithéâtre d\'El Jem', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `messenger_messages`
--

INSERT INTO `messenger_messages` (`id`, `body`, `headers`, `queue_name`, `created_at`, `available_at`, `delivered_at`) VALUES
(1, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;N;i:1;N;i:2;s:77:\\\"<p>Bonjour aaaaaa,</p><p>test</p><hr><p>Message original :<br>hhkdkdktykd</p>\\\";i:3;s:5:\\\"utf-8\\\";i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:24:\\\"votre-agence@example.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:15:\\\"ahmed@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:34:\\\"Réponse à votre message : hhhhhh\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2025-11-13 00:45:41', '2025-11-13 00:45:41', NULL),
(2, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;N;i:1;N;i:2;s:76:\\\"<p>Bonjour ksontini,</p><p>test</p><hr><p>Message original :<br>zefefzef</p>\\\";i:3;s:5:\\\"utf-8\\\";i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:24:\\\"votre-agence@example.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:15:\\\"ahmed@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:32:\\\"Réponse à votre message : efzf\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2025-11-13 00:48:33', '2025-11-13 00:48:33', NULL),
(3, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;N;i:1;N;i:2;s:77:\\\"<p>Bonjour ksontini,</p><p>tezst</p><hr><p>Message original :<br>zefefzef</p>\\\";i:3;s:5:\\\"utf-8\\\";i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:24:\\\"votre-agence@example.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:15:\\\"ahmed@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:32:\\\"Réponse à votre message : efzf\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2025-11-13 00:48:54', '2025-11-13 00:48:54', NULL),
(4, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;N;i:1;N;i:2;s:78:\\\"<p>Bonjour ksontini,</p><p>fesfef</p><hr><p>Message original :<br>zefefzef</p>\\\";i:3;s:5:\\\"utf-8\\\";i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:24:\\\"votre-agence@example.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:15:\\\"ahmed@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:32:\\\"Réponse à votre message : efzf\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2025-11-13 00:48:56', '2025-11-13 00:48:56', NULL),
(5, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;N;i:1;N;i:2;s:80:\\\"<p>Bonjour ksontini,</p><p>sefsef<f</p><hr><p>Message original :<br>zefefzef</p>\\\";i:3;s:5:\\\"utf-8\\\";i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:24:\\\"votre-agence@example.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:15:\\\"ahmed@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:32:\\\"Réponse à votre message : efzf\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2025-11-13 00:48:58', '2025-11-13 00:48:58', NULL),
(6, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;N;i:1;N;i:2;s:77:\\\"<p>Bonjour ksontini,</p><p>fgugf</p><hr><p>Message original :<br>zefefzef</p>\\\";i:3;s:5:\\\"utf-8\\\";i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:24:\\\"votre-agence@example.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:15:\\\"ahmed@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:32:\\\"Réponse à votre message : efzf\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2025-11-13 00:55:11', '2025-11-13 00:55:11', NULL),
(7, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;N;i:1;N;i:2;s:76:\\\"<p>Bonjour bilel,</p><p>jhnbijbi</p><hr><p>Message original :<br>testttt</p>\\\";i:3;s:5:\\\"utf-8\\\";i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:24:\\\"votre-agence@example.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:15:\\\"ahmed@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:33:\\\"Réponse à votre message : 3asba\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2025-11-13 23:13:57', '2025-11-13 23:13:57', NULL),
(8, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;N;i:1;N;i:2;s:81:\\\"<p>Bonjour najmedin,</p><p>asba lik</p><hr><p>Message original :<br>sgdfhfdhh</p>\\\";i:3;s:5:\\\"utf-8\\\";i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:24:\\\"votre-agence@example.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:18:\\\"najmedin@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:33:\\\"Réponse à votre message : re7la\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2025-11-23 21:01:35', '2025-11-23 21:01:35', NULL),
(9, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;N;i:1;N;i:2;s:71:\\\"<p>Bonjour sahbi,</p><p>DFHFHH</p><hr><p>Message original :<br>TEST</p>\\\";i:3;s:5:\\\"utf-8\\\";i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:24:\\\"votre-agence@example.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:15:\\\"sahbi@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:32:\\\"Réponse à votre message : TEST\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2025-12-10 20:54:47', '2025-12-10 20:54:47', NULL),
(10, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;s:187:\\\"Bonjour ahmed ksontini,\n\nVotre réservation de transfert a été annulée.\n\nRaison :\ntest\n\nNous restons à votre disposition pour toute information supplémentaire.\n\n– Équipe TuniTrip\n\\\";i:1;s:5:\\\"utf-8\\\";i:2;s:432:\\\"<p>Bonjour ahmed ksontini,</p>\n\n<p>Nous sommes au regret de vous informer que votre réservation de transfert a été <strong>annulée</strong>.</p>\n\n<p><strong>Raison :</strong></p>\n<p style=\\\"background:#f8d7da;padding:10px;border-radius:5px;\\\">\n    test\n</p>\n\n<p>Si vous souhaitez reprogrammer un transfert ou obtenir plus d\\\'informations, notre équipe reste à votre disposition.</p>\n\n<p>Cordialement,<br>L’équipe TuniTrip</p>\n\\\";i:3;s:5:\\\"utf-8\\\";i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:20:\\\"contact@tunitrip.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:23:\\\"ahmedksontini@hmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:35:\\\"Votre réservation a été annulée\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2025-12-11 00:06:05', '2025-12-11 00:06:05', NULL),
(11, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;N;i:1;N;i:2;s:1293:\\\"<!DOCTYPE html>\n<html>\n<head>\n    <meta charset=\\\"UTF-8\\\">\n    <title>Confirmation de Réservation</title>\n</head>\n<body style=\\\"font-family: Arial, sans-serif; color: #333;\\\">\n    <div style=\\\"max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee;\\\">\n        <h2 style=\\\"color: #d32f2f; text-align: center;\\\">TuniTrip - Réservation Confirmée ', '[]', 'default', '2025-12-11 15:16:41', '2025-12-11 15:16:41', NULL),
(12, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;N;i:1;N;i:2;s:1650:\\\"<!DOCTYPE html>\n<html>\n<head>\n    <meta charset=\\\"UTF-8\\\">\n    <title>Confirmation de réservation d\\\'excursion</title>\n</head>\n<body style=\\\"font-family: Arial, sans-serif; color: #333;\\\">\n    <div style=\\\"max-width: 600px; margin: 0 auto; border: 1px solid #eee; border-radius: 8px; padding: 20px;\\\">\n        <h2 style=\\\"color: #d8b65d; text-align: center;\\\">TuniTrip - Confirmation</h2>\n        \n        <p>Bonjour <strong>ahmed ksontini</strong>,</p>\n        \n        <p>Nous avons le plaisir de vous confirmer votre réservation pour l\\\'excursion <strong>Visite Privée et Guidée à Kairouan et El Jem et Monastir</strong> ! ', '[]', 'default', '2025-12-11 17:18:27', '2025-12-11 17:18:27', NULL),
(13, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;s:265:\\\"Bonjour ahmed ksontini,\n\nVotre réservation de transfert avec TuniTrip a été confirmée.\n\nDétails :\nDate : 11/12/2025\nHeure : 22:38\nDépart : Enfidha Airport\nArrivée : Hammamet\nPersonnes : 2\nPrix total : 40 €\n\nMerci pour votre confiance.\n– Équipe TuniTrip\n\\\";i:1;s:5:\\\"utf-8\\\";i:2;s:570:\\\"<p>Bonjour ahmed ksontini,</p>\n\n<p>Votre réservation de transfert avec <strong>TuniTrip</strong> a été <strong>confirmée</strong> ! ', '[]', 'default', '2025-12-11 22:30:15', '2025-12-11 22:30:15', NULL),
(14, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;N;i:1;N;i:2;s:1294:\\\"<!DOCTYPE html>\n<html>\n<head>\n    <meta charset=\\\"UTF-8\\\">\n    <title>Confirmation de Réservation</title>\n</head>\n<body style=\\\"font-family: Arial, sans-serif; color: #333;\\\">\n    <div style=\\\"max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee;\\\">\n        <h2 style=\\\"color: #d32f2f; text-align: center;\\\">TuniTrip - Réservation Confirmée ', '[]', 'default', '2025-12-11 22:30:36', '2025-12-11 22:30:36', NULL),
(15, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;N;i:1;N;i:2;s:1650:\\\"<!DOCTYPE html>\n<html>\n<head>\n    <meta charset=\\\"UTF-8\\\">\n    <title>Confirmation de réservation d\\\'excursion</title>\n</head>\n<body style=\\\"font-family: Arial, sans-serif; color: #333;\\\">\n    <div style=\\\"max-width: 600px; margin: 0 auto; border: 1px solid #eee; border-radius: 8px; padding: 20px;\\\">\n        <h2 style=\\\"color: #d8b65d; text-align: center;\\\">TuniTrip - Confirmation</h2>\n        \n        <p>Bonjour <strong>ahmed ksontini</strong>,</p>\n        \n        <p>Nous avons le plaisir de vous confirmer votre réservation pour l\\\'excursion <strong>Visite Privée et Guidée à Kairouan et El Jem et Monastir</strong> ! ', '[]', 'default', '2025-12-11 22:30:55', '2025-12-11 22:30:55', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `non_inclus_excursion`
--

DROP TABLE IF EXISTS `non_inclus_excursion`;
CREATE TABLE IF NOT EXISTS `non_inclus_excursion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `excursion_id` int NOT NULL,
  `item` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `ordre` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A2FCC24A4AB4296F` (`excursion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `non_inclus_excursion`
--

INSERT INTO `non_inclus_excursion` (`id`, `excursion_id`, `item`, `ordre`) VALUES
(22, 17, 'Pourboires', 1),
(23, 17, 'test', 1),
(24, 16, 'Entrée – Ruines de Carthage', 1),
(25, 19, '- Déjeuner', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reservation_excursion`
--

DROP TABLE IF EXISTS `reservation_excursion`;
CREATE TABLE IF NOT EXISTS `reservation_excursion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `excursion_id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `adult` int NOT NULL,
  `child` int NOT NULL,
  `date_heure` datetime NOT NULL,
  `localisation_point` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `statut` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prix_total` double NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tel` varchar(20) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_814F86B04AB4296F` (`excursion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `reservation_excursion`
--

INSERT INTO `reservation_excursion` (`id`, `excursion_id`, `nom`, `prenom`, `adult`, `child`, `date_heure`, `localisation_point`, `date_creation`, `statut`, `prix_total`, `email`, `tel`) VALUES
(10, 19, 'ksontini', 'ahmed', 1, 1, '2025-12-11 17:14:00', 'hammamet', '2025-12-11 17:15:13', 'annulee', 216, 'ahmed@gmail', '+216 93313278'),
(11, 19, 'ksontini', 'ahmed', 1, 2, '2025-12-11 22:36:00', 'hammamet', '2025-12-11 19:34:40', 'confirmee', 312, 'ahmed@gmail.com', '+216 93313278');

-- --------------------------------------------------------

--
-- Structure de la table `reservation_transfert`
--

DROP TABLE IF EXISTS `reservation_transfert`;
CREATE TABLE IF NOT EXISTS `reservation_transfert` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trajet_transfert_id` int NOT NULL,
  `pickup_date` datetime NOT NULL,
  `pickup_time` time NOT NULL,
  `pickup_location` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `dropoff_location` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `transfer_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `persons` int NOT NULL,
  `return_pickup_date` datetime DEFAULT NULL,
  `return_pickup_time` time DEFAULT NULL,
  `return_pickup_location` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `return_dropoff_location` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tel` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `whatsapp_number` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `flight_number` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `comments` longtext COLLATE utf8mb3_unicode_ci,
  `prix_total` decimal(10,2) NOT NULL,
  `statut` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_409CD24556A9926` (`trajet_transfert_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `reservation_transfert`
--

INSERT INTO `reservation_transfert` (`id`, `trajet_transfert_id`, `pickup_date`, `pickup_time`, `pickup_location`, `dropoff_location`, `transfer_type`, `persons`, `return_pickup_date`, `return_pickup_time`, `return_pickup_location`, `return_dropoff_location`, `first_name`, `last_name`, `email`, `tel`, `whatsapp_number`, `flight_number`, `comments`, `prix_total`, `statut`, `created_at`) VALUES
(4, 12, '2025-11-20 00:00:00', '00:01:00', 'Enfidha Airport', 'Sfax', 'return', 4, '2025-11-29 00:00:00', '00:01:00', 'Sfax', 'Enfidha Airport', 'ahmed', 'ksontini', 'ahmedksontini@hmail.com', '12234234', '12323124', '234234', 'teeesstt', 180.00, 'confirmee', '2025-11-11 11:22:39'),
(19, 3, '2025-11-29 00:00:00', '17:17:00', 'Tunis Carthage Airport', 'Tunis', 'one_way', 2, '2025-12-06 00:00:00', '19:19:00', NULL, NULL, 'ahmed', 'ksontini', 'ahmedksontini@hmail.com', '12234234', '12323124', '234234', NULL, 40.00, 'en_attente', '2025-11-25 14:18:45'),
(20, 3, '2025-11-29 00:00:00', '17:17:00', 'Tunis Carthage Airport', 'Tunis', 'return', 2, '2025-12-06 00:00:00', '19:19:00', 'Tunis', 'Tunis Carthage Airport', 'ahmed', 'ksontini', 'ahmedksontini@hmail.com', '12234234', '12323124', '234234', NULL, 80.00, 'en_attente', '2025-11-25 14:18:54'),
(27, 4, '2025-12-27 00:00:00', '17:54:00', 'Tunis Carthage Airport', 'Sousse', 'one_way', 5, NULL, NULL, NULL, NULL, 'ahmed', 'ksontini', 'ahmedksontini@hmail.com', '12234234', '12323124', '234234', NULL, 140.00, 'en_attente', '2025-12-06 14:51:31'),
(28, 11, '2025-12-17 00:00:00', '23:30:00', 'Enfidha Airport', 'Monastir', 'return', 4, '2025-12-26 00:00:00', '23:31:00', NULL, NULL, 'ahmed', 'ksontini', 'ahmedksontini@hmail.com', '93313278', '12323124', '234234', 'gfgdgdgdfgb', 180.00, 'annulee', '2025-12-10 20:28:45'),
(29, 5, '2025-12-18 00:00:00', '22:48:00', 'Tunis Carthage Airport', 'Monastir', 'return', 2, '2025-12-27 00:00:00', '23:48:00', NULL, NULL, 'ahmed', 'ksontini', 'ahmedksontini@hmail.com', '93313278', '12323124', '234234', NULL, 180.00, 'confirmee', '2025-12-10 20:45:33'),
(30, 2, '2025-12-13 00:00:00', '02:11:00', 'Tunis Carthage Airport', 'Hammamet', 'one_way', 1, NULL, NULL, NULL, NULL, 'ahmed', 'ksontini', 'ahmedksontini560@gmail.com', '93313278', '12323124', '234234', NULL, 120.00, 'en_attente', '2025-12-11 00:09:11'),
(31, 8, '2025-12-11 00:00:00', '22:38:00', 'Enfidha Airport', 'Hammamet', 'one_way', 2, NULL, NULL, NULL, NULL, 'ahmed', 'ksontini', 'ahmedksontini@hmail.com', '93313278', '12323124', '234234', 'hvjjkh', 40.00, 'confirmee', '2025-12-11 19:35:23');

-- --------------------------------------------------------

--
-- Structure de la table `reservation_voiture`
--

DROP TABLE IF EXISTS `reservation_voiture`;
CREATE TABLE IF NOT EXISTS `reservation_voiture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `voiture_id` int NOT NULL,
  `nom` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `lieu_naissance` varchar(150) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nationalite` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  `num_cin_passport` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `cin_delivre_le` date DEFAULT NULL,
  `num_permis` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `permis_delivre_le` date DEFAULT NULL,
  `permis_lieu_delivrance` varchar(150) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `prix_total` double NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `statut` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8E773A8A181A8BA` (`voiture_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `reservation_voiture`
--

INSERT INTO `reservation_voiture` (`id`, `voiture_id`, `nom`, `prenom`, `date_naissance`, `lieu_naissance`, `nationalite`, `adresse`, `tel`, `num_cin_passport`, `cin_delivre_le`, `num_permis`, `permis_delivre_le`, `permis_lieu_delivrance`, `created_at`, `updated_at`, `date_debut`, `date_fin`, `prix_total`, `email`, `statut`) VALUES
(29, 6, 'ksontini', 'ahmed', '2007-11-29', 'nabeul', 'tunisien', 'rue taher ben fraj', '93313278', '12546', '2025-12-17', '2591951', '2023-12-08', 'hammaet', '2025-12-11 15:04:47', '2025-12-11 15:04:47', '2025-12-18', '2025-12-20', 360, 'ahmedksontini@gmail.com', 'confirmee'),
(30, 6, 'ksontini', 'ahmed', '2007-12-07', 'nabeul', 'tunisien', 'rue taher ben fraj', '93313278', '12546', '2025-12-11', '2591951', '2023-12-07', 'hammaet', '2025-12-11 15:18:01', '2025-12-11 15:18:01', '2025-12-18', '2025-12-20', 360, 'ahmedksontini@gmail.com', 'annulee'),
(31, 6, 'ksontini', 'ahmed', '2007-12-06', 'nabeul', 'tunisien', 'rue taher ben fraj', '93313278', '12546', '2025-12-11', '2591951', '2023-12-05', 'hammaet', '2025-12-11 19:32:30', '2025-12-11 19:32:30', '2025-12-11', '2025-12-20', 1620, 'ahmedksontini@gmail.com', 'confirmee');

-- --------------------------------------------------------

--
-- Structure de la table `transfere`
--

DROP TABLE IF EXISTS `transfere`;
CREATE TABLE IF NOT EXISTS `transfere` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lieu_depart` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `lieu_arrivee` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `duree` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `actif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `transfere`
--

INSERT INTO `transfere` (`id`, `lieu_depart`, `lieu_arrivee`, `prix`, `image`, `duree`, `actif`) VALUES
(2, 'Tunis Carthage Airport', 'Hammamet', 120.00, 'hammamet-6906000715176.jpg', '0.40 Min', 1),
(3, 'Tunis Carthage Airport', 'Tunis', 40.00, 'tunis-690600265bb34.jpg', '0.20 Min', 1),
(4, 'Tunis Carthage Airport', 'Sousse', 70.00, 'sousse-6906003c2866c.jpg', '1 H', 1),
(5, 'Tunis Carthage Airport', 'Monastir', 90.00, 'monastir-690600544b2f0.jpg', '2.40 Min', 1),
(6, 'Tunis Carthage Airport', 'Sfax', 100.00, 'sfax-69060067358d5.jpg', '0.55 Min', 1),
(7, 'Tunis Carthage Airport', 'Bizerte', 60.00, 'bizerte-6906007d22ea4.jpg', '0.55 Min', 1),
(8, 'Enfidha Airport', 'Hammamet', 40.00, 'hammamet-6906008d60194.jpg', '0.40 Min', 1),
(9, 'Enfidha Airport', 'Tunis', 70.00, 'tunis-6906009c68392.jpg', '0.40 Min', 1),
(10, 'Enfidha Airport', 'Sousse', 60.00, 'sousse-690600ae5b1a5.jpg', '0.55 Min', 1),
(11, 'Enfidha Airport', 'Monastir', 90.00, 'monastir-690600cf180d2.jpg', '0.55 Min', 1),
(12, 'Enfidha Airport', 'Sfax', 90.00, 'sfax-690600e533bd8.jpg', '1 H', 1),
(13, 'Enfidha Airport', 'Bizerte', 180.00, 'bizerte-6906010195014.jpg', '2.40 Min', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb3_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nom` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tel` varchar(20) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `adresse`, `tel`) VALUES
(2, 'admin@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$Iwcysy2IY8K1uVLaILqWqueIACCDK7rg740socDWeSfWXJZTAzvz6', 'admin', 'admin', 'rue taher ben fraj', '93313278'),
(5, 'nidhal@gmail.com', '[]', '$2y$13$hZs54RWLu5WCbTNRgGNYh.xT.hFe5FuvXHz4aS7UrkflsCcuCHykO', 'nidhal', 'safta', 'rue taher ben fraj', '93313278'),
(7, 'ahmedksontini122@gmail.com', '[]', '$2y$13$bBfzw049vW.ORSf.qxLAjOAeFCS6Gn9zYUkcX382.04zxJLbT/0Gy', 'kson', 'kson', 'rue taher ben fraj', '93313278'),
(8, 'ahmedksontini@gmail.com', '[]', '$2y$13$51u5ZLRqSscgD22KH3HZ.e15N6R9gGLDAQLVXvP0feVC.zYMwPHRO', 'habibi', 'med', 'rue taher ben fraj', '93313278');

-- --------------------------------------------------------

--
-- Structure de la table `voitures`
--

DROP TABLE IF EXISTS `voitures`;
CREATE TABLE IF NOT EXISTS `voitures` (
  `id` int NOT NULL AUTO_INCREMENT,
  `marque` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `modele` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prix_jour` decimal(10,0) NOT NULL,
  `image` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `disponible` tinyint(1) NOT NULL,
  `description` longtext COLLATE utf8mb3_unicode_ci,
  `boite_vitesse` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `climatiseur` tinyint(1) NOT NULL,
  `passengers` int NOT NULL,
  `suitcases` int NOT NULL,
  `prix_mois` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `voitures`
--

INSERT INTO `voitures` (`id`, `marque`, `modele`, `prix_jour`, `image`, `disponible`, `description`, `boite_vitesse`, `climatiseur`, `passengers`, `suitcases`, `prix_mois`) VALUES
(2, 'Suzuki', 'Swift', 180, '47300-68f5103ddbf2e.png', 1, NULL, 'Manuelle', 1, 4, 1, 200000.00),
(6, 'Seat', 'Ateca', 180, 'geneva-motor-show-seat-ateca-sport-utility-vehicle-car-seat-removebg-preview-69397aeb8812a.png', 1, NULL, 'Manuelle', 1, 5, 5, 3200.00),
(7, 'Kia', 'Picanto', 120, '587-5872836-kia-picanto-png-2019-transparent-removebg-preview-69397b407e3cb.png', 1, NULL, 'Auto', 1, 4, 2, 2200.00),
(8, 'Dacia', 'Logan', 130, '01JZFVC94YBCJNCSPNB65J14SK-removebg-preview-69397b876f519.png', 1, NULL, 'Auto', 1, 5, 4, 2800.00),
(9, 'Dacia', 'sandero stepway', 150, '6597d19d90854-69397bb785b2e.png', 1, NULL, 'Manuelle', 1, 7, 6, 3000.00),
(10, 'Suzuki', 'Dzire', 150, 'car-6-maruti-suzuki-swift-dzire-new-model-2018-1156290629619yqbgdnjp-removebg-preview-69397be26fa1b.png', 1, NULL, 'Manuelle', 1, 4, 6, 2680.00),
(11, 'Suzuki', 'Maruti', 80, 'maruti-suzuki-ciaz-car-car-removebg-preview-69397c1071d63.png', 1, NULL, 'Auto', 1, 5, 7, 1520.00),
(12, 'Volkswagen', 'Virtus', 160, 'volkswagen-virtus-removebg-preview-69397c5c60faa.png', 1, NULL, 'Auto', 1, 5, 8, 3650.00),
(13, 'Skoda', 'Fabia', 180, 'skoda-fabia-ambition-69397c81551fe.png', 1, NULL, 'Manuelle', 1, 4, 5, 3000.00);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_8F91ABF0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `avis_excursion`
--
ALTER TABLE `avis_excursion`
  ADD CONSTRAINT `FK_3D5DF8EE4AB4296F` FOREIGN KEY (`excursion_id`) REFERENCES `excursion` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3D5DF8EEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `chat_message`
--
ALTER TABLE `chat_message`
  ADD CONSTRAINT `FK_FAB3FC16A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `excursion_detail`
--
ALTER TABLE `excursion_detail`
  ADD CONSTRAINT `FK_BFB0D73B4AB4296F` FOREIGN KEY (`excursion_id`) REFERENCES `excursion` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `faqexcursion`
--
ALTER TABLE `faqexcursion`
  ADD CONSTRAINT `FK_496A5B584AB4296F` FOREIGN KEY (`excursion_id`) REFERENCES `excursion` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_496A5B58A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `favori`
--
ALTER TABLE `favori`
  ADD CONSTRAINT `FK_EF85A2CC4AB4296F` FOREIGN KEY (`excursion_id`) REFERENCES `excursion` (`id`),
  ADD CONSTRAINT `FK_EF85A2CCA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `image_excursion`
--
ALTER TABLE `image_excursion`
  ADD CONSTRAINT `FK_438A3C7B4AB4296F` FOREIGN KEY (`excursion_id`) REFERENCES `excursion` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `inclus_excursion`
--
ALTER TABLE `inclus_excursion`
  ADD CONSTRAINT `FK_2D0EB09F4AB4296F` FOREIGN KEY (`excursion_id`) REFERENCES `excursion` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `itineraire_excursion`
--
ALTER TABLE `itineraire_excursion`
  ADD CONSTRAINT `FK_CD58DB854AB4296F` FOREIGN KEY (`excursion_id`) REFERENCES `excursion` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `itineraire_photo`
--
ALTER TABLE `itineraire_photo`
  ADD CONSTRAINT `FK_92D34557A9B853B8` FOREIGN KEY (`itineraire_id`) REFERENCES `itineraire_excursion` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `non_inclus_excursion`
--
ALTER TABLE `non_inclus_excursion`
  ADD CONSTRAINT `FK_A2FCC24A4AB4296F` FOREIGN KEY (`excursion_id`) REFERENCES `excursion` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservation_excursion`
--
ALTER TABLE `reservation_excursion`
  ADD CONSTRAINT `FK_814F86B04AB4296F` FOREIGN KEY (`excursion_id`) REFERENCES `excursion` (`id`);

--
-- Contraintes pour la table `reservation_transfert`
--
ALTER TABLE `reservation_transfert`
  ADD CONSTRAINT `FK_409CD24556A9926` FOREIGN KEY (`trajet_transfert_id`) REFERENCES `transfere` (`id`);

--
-- Contraintes pour la table `reservation_voiture`
--
ALTER TABLE `reservation_voiture`
  ADD CONSTRAINT `FK_8E773A8A181A8BA` FOREIGN KEY (`voiture_id`) REFERENCES `voitures` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
