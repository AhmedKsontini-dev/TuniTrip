-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 30 nov. 2025 à 19:20
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `nom`, `prenom`, `commentaire`, `etoiles`, `date_creation`) VALUES
(9, 'ahmed', 'maghrbi', 'tttttttttttttttttttttttttyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', 4, '2025-11-28 12:46:32'),
(10, 'fergferg', 'LINA', 'ergzregrtgh\'rth', 5, '2025-11-30 19:12:47');

-- --------------------------------------------------------

--
-- Structure de la table `avis_excursion`
--

DROP TABLE IF EXISTS `avis_excursion`;
CREATE TABLE IF NOT EXISTS `avis_excursion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `excursion_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `note` int NOT NULL,
  `commentaire` longtext COLLATE utf8mb3_unicode_ci,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3D5DF8EE4AB4296F` (`excursion_id`),
  KEY `IDX_3D5DF8EEA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `avis_excursion`
--

INSERT INTO `avis_excursion` (`id`, `excursion_id`, `user_id`, `note`, `commentaire`, `created_at`) VALUES
(1, 14, 1, 4, 'test ', '2025-11-18 14:18:11');

-- --------------------------------------------------------

--
-- Structure de la table `contact_message`
--

DROP TABLE IF EXISTS `contact_message`;
CREATE TABLE IF NOT EXISTS `contact_message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb3_unicode_ci NOT NULL,
  `sujet` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_envoi` datetime NOT NULL,
  `lus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `contact_message`
--

INSERT INTO `contact_message` (`id`, `nom`, `email`, `sujet`, `message`, `date_envoi`, `lus`) VALUES
(16, 'ksontini', 'ahmed@gmail.com', 'efzf', 'zefefzef', '2025-10-28 16:50:11', 1),
(20, 'najmedin', 'najmedin@gmail.com', 're7la', 'sgdfhfdhh', '2025-11-23 21:00:59', 1);

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
('DoctrineMigrations\\Version20251130142606', '2025-11-30 14:26:19', 84);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `excursion`
--

INSERT INTO `excursion` (`id`, `titre`, `description`, `categorie`, `duree`, `cancellation`, `localisation`, `a_propos`, `prix_par_personne`, `image_principale`, `actif`, `created_at`, `updated_at`, `ages`, `max_pers`, `guide`) VALUES
(14, 'Excursion Sahara', 'Découvrez le riche patrimoine tunisien lors de cette excursion d\'une journée, en explorant les ruines antiques de Carthage, classées au patrimoine mondial de l\'UNESCO, le charmant village de Sidi Bou Said, le fascinant musée du Bardo et la vibrante médina de Tunis.\r\n\r\nFaits saillants : \r\n\r\n• Découvrez les ruines classées au patrimoine mondial de l\'UNESCO, en visitant des sites emblématiques comme les thermes antonins et les ports puniques.\r\n\r\n• Promenez-vous dans les rues pittoresques bleues et blanches de ce village côtier, avec une vue imprenable sur la Méditerranée et une atmosphère détendue.\r\n\r\n• Plongez dans l’histoire de la Tunisie dans ce musée renommé, qui abrite une impressionnante collection de mosaïques et d’artefacts romains.\r\n\r\n• Découvrez le cœur animé de Tunis, en explorant des marchés animés et des ruelles historiques.', 'Day Trip', '4 Heures / 1 jour', 'Annulation gratuite jusqu\'à 48h avant', 'Douz, Tunisie', 'bbbbbbbbb', '450', 'excursion1.jpg', 1, '2025-11-16 17:11:51', '2025-11-17 02:26:44', '0-99', 12, 'Anglais'),
(16, 'De Hammamet ou Tunis: Carthage, Bardo, Sidi Bou said et Médine', 'Découvrez le riche patrimoine tunisien lors de cette excursion d\'une journée, en explorant les ruines antiques de Carthage, classées au patrimoine mondial de l\'UNESCO, le charmant village de Sidi Bou Said, le fascinant musée du Bardo et la vibrante médina de Tunis.\r\n\r\nFaits saillants : \r\n\r\n• Découvrez les ruines classées au patrimoine mondial de l\'UNESCO, en visitant des sites emblématiques comme les thermes antonins et les ports puniques.\r\n\r\n• Promenez-vous dans les rues pittoresques bleues et blanches de ce village côtier, avec une vue imprenable sur la Méditerranée et une atmosphère détendue.\r\n\r\n• Plongez dans l’histoire de la Tunisie dans ce musée renommé, qui abrite une impressionnante collection de mosaïques et d’artefacts romains.\r\n\r\n• Découvrez le cœur animé de Tunis, en explorant des marchés animés et des ruelles historiques.', 'Day Trip', '8 h', 'Annulation gratuite jusqu\'à 48h avant', 'Tunis', 'Itinéraire\r\nCeci est un itinéraire typique pour ce produit\r\n\r\nArrêt à : Site Archeologique de Carthage, Carthage Tunisia\r\n\r\nExplorez le site archéologique de Carthage, admirant d\'anciens monuments avec une vue imprenable sur la côte environnante. Carthage a été détruite par les Romains en 146 avant JC, mais les fouilles ont révélé des maisons à cinq étages, des systèmes d\'égouts et les restes des murs de la ville qui s\'étalaient autrefois sur 21 km (34 km) sur la colline de Byrsa.\r\n\r\nDurée : 2 heures\r\n\r\nArrêt à : Baths of Antoninus, Impasse des Thermes d\'Antonin Site Archoologique de Carthage, Carthage 2016 Tunisia\r\n\r\nExplorez le site archéologique de Carthage, admirant d\'anciens monuments avec une vue imprenable sur la côte environnante. Carthage a été détruite par les Romains en 146 avant JC, mais les fouilles ont révélé des maisons à cinq étages, des systèmes d\'égouts et les restes des murs de la ville qui s\'étalaient autrefois sur 21 km (34 km) sur la colline de Byrsa.\r\n\r\nDurée : 30 minutes\r\n\r\nArrêt à : Tophet de Carthage, Rue de Hannibal, Carthage 7016 Tunisia\r\n\r\nExplorez le site archéologique de Carthage, admirant d\'anciens monuments avec une vue imprenable sur la côte environnante. Carthage a été détruite par les Romains en 146 avant JC, mais les fouilles ont révélé des maisons à cinq étages, des systèmes d\'égouts et les restes des murs de la ville qui s\'étalaient autrefois sur 21 km (34 km) sur la colline de Byrsa.\r\n\r\nDurée : 1 heure\r\n\r\nArrêt à : Carthage  Aqueduct, Carthage Tunisia\r\n\r\nExplorez le site archéologique de Carthage, admirant d\'anciens monuments avec une vue imprenable sur la côte environnante. Carthage a été détruite par les Romains en 146 avant JC, mais les fouilles ont révélé des maisons à cinq étages, des systèmes d\'égouts et les restes des murs de la ville qui s\'étalaient autrefois sur 21 km (34 km) sur la colline de Byrsa.\r\n\r\nDurée : 30 minutes\r\n\r\nArrêt à : Centro storico, Avenue 14 Janvier, Sidi Bou Said 2026 Tunisia\r\n\r\nDécouvrez Sidi Bou Said, un village pittoresque bleu et blanc qui surplombe la mer Méditerranée.\r\n\r\nDurée : 1 heure\r\n\r\nArrêt à : Bardo National Museum, Bardo center, RN 7, Tunis, Tunisia\r\n\r\nDécouvrez l\'une des plus grandes collections de mosaïques romaines au monde, le musée du Bardo représente « la première destination pour explorer et comprendre la vaste et riche histoire de la Tunisie ».\r\n\r\nDurée : 1 heure\r\n\r\nArrêt à : Beb Bhar, Tunis Tunisia\r\n\r\nDécouvrez les portes célèbres de la médina de Tunis\r\n\r\nDurée : 15 minutes\r\n\r\nPasse devant : EzZitouna Mosque, 30 Rue Jamaa Ezzitouna, Tunis Tunisia\r\n\r\nVisitez la mosquée Zitouna de Tunis\r\n\r\nArrêt à : Medina of Tunis, Tunis Tunisia\r\n\r\nDécouvrez la médina de Tunis, la vieille ville classée au patrimoine mondial de l\'UNESCO. Suivez votre guide à travers les rues étroites jusqu\'à la mosquée Zitouna, un marché traditionnel des fabricants de casquettes et le marché aux parfums colorés de Tunis.\r\n\r\nDurée : 1 heure', '140', '2a-691c99b4db1cc.jpg', 1, '2025-11-18 16:07:16', '2025-11-18 16:07:16', '0-99', 10, 'Français');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `excursion_detail`
--

INSERT INTO `excursion_detail` (`id`, `excursion_id`, `titre`, `description`, `ordre`) VALUES
(14, 16, 'Aide', 'Si vous avez des questions sur cette visite ou besoin d\'aide pour réserver, \r\nnous nous ferons une joie de vous aider. \r\nAppelez-nous simplement au numéro 93312378.\r\ntesterr', 1),
(15, 16, 'Conditions d\'annulation', '• Pour recevoir un remboursement complet, vous devez annuler plus de 24 heures avant l\'heure de début de l\'expérience.\r\n• Si vous annulez moins de 24 heures avant l\'heure de début de l\'expérience, le montant que vous avez payé ne sera pas remboursé.\r\n• Aucune modification effectuée moins de 24 heures avant l\'heure de début de l\'expérience ne sera acceptée.\r\n• Les heures limites de réservation sont basées sur le fuseau horaire de l\'expérience.\r\n• Pour avoir lieu, cette expérience requiert un nombre minimum de voyageurs. Si elle est annulée car cette condition n\'est pas remplie, nous vous proposerons une autre date/activité ou le remboursement complet.\r\n\r\nteeessssst', 1),
(16, 16, '', '', 1),
(17, 16, '', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `faqexcursion`
--

DROP TABLE IF EXISTS `faqexcursion`;
CREATE TABLE IF NOT EXISTS `faqexcursion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `excursion_id` int NOT NULL,
  `question` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `reponse` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `ordre` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_496A5B584AB4296F` (`excursion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
(58, 16, '32-691ca1d0576f6.jpg', 0, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `inclus_excursion`
--

INSERT INTO `inclus_excursion` (`id`, `excursion_id`, `item`, `ordre`) VALUES
(24, 16, 'Frais d\'entrée au musée de Carthage et du Bardo (Si option sélectionnée)', 1),
(25, 16, 'teeesttt', 1);

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
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `duree_visite` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `admission` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `has_photos` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_CD58DB854AB4296F` (`excursion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `itineraire_excursion`
--

INSERT INTO `itineraire_excursion` (`id`, `excursion_id`, `titre_etape`, `description_etape`, `ordre`, `latitude`, `longitude`, `duree_visite`, `admission`, `has_photos`) VALUES
(15, 16, 'Ruines de Carthage', 'Explorez la ville avec votre guide, en admirant des monuments anciens avec une vue imprenable sur le littoral environnant. Carthage a été détruite par les Romains en 146 av. J.-C., mais les fouilles ont révélé des maisons de cinq étages, des systèmes d\'égouts et les vestiges des murs de la ville qui s\'étendaient autrefois sur 34 km à travers la colline de Byrsa.', 1, 36.458840297969, 10.722207114201, '1.50', 'Gratuit', 0),
(24, 16, 'tssfwf', 'ergerthtyjku', 2, 36.458840220926, 10.722207204201, '2h', 'Gratuit', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `itineraire_photo`
--

INSERT INTO `itineraire_photo` (`id`, `itineraire_id`, `image_url`, `legende`, `ordre`) VALUES
(8, 15, '692b20cec1864.jpg', 'contrat', 1),
(15, 24, '692b2aed7479d.jpg', 'ktjrtheg', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
(8, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:28:\\\"Symfony\\\\Component\\\\Mime\\\\Email\\\":6:{i:0;N;i:1;N;i:2;s:81:\\\"<p>Bonjour najmedin,</p><p>asba lik</p><hr><p>Message original :<br>sgdfhfdhh</p>\\\";i:3;s:5:\\\"utf-8\\\";i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:24:\\\"votre-agence@example.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:18:\\\"najmedin@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:33:\\\"Réponse à votre message : re7la\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2025-11-23 21:01:35', '2025-11-23 21:01:35', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `non_inclus_excursion`
--

INSERT INTO `non_inclus_excursion` (`id`, `excursion_id`, `item`, `ordre`) VALUES
(20, 16, 'Entrée – Ruines de Carthage', 1),
(21, 16, 'teeesstttttt', 1);

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
  PRIMARY KEY (`id`),
  KEY `IDX_814F86B04AB4296F` (`excursion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `reservation_excursion`
--

INSERT INTO `reservation_excursion` (`id`, `excursion_id`, `nom`, `prenom`, `adult`, `child`, `date_heure`, `localisation_point`, `date_creation`, `statut`) VALUES
(1, 16, 'ksontini', 'ahmed', 3, 4, '2025-12-04 17:42:00', 'hamamet', '2025-11-30 14:39:00', 'confirmee');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `reservation_transfert`
--

INSERT INTO `reservation_transfert` (`id`, `trajet_transfert_id`, `pickup_date`, `pickup_time`, `pickup_location`, `dropoff_location`, `transfer_type`, `persons`, `return_pickup_date`, `return_pickup_time`, `return_pickup_location`, `return_dropoff_location`, `first_name`, `last_name`, `email`, `tel`, `whatsapp_number`, `flight_number`, `comments`, `prix_total`, `statut`, `created_at`) VALUES
(4, 12, '2025-11-20 00:00:00', '00:01:00', 'Enfidha Airport', 'Sfax', 'return', 4, '2025-11-29 00:00:00', '00:01:00', 'Sfax', 'Enfidha Airport', 'ahmed', 'ksontini', 'ahmedksontini@hmail.com', '12234234', '12323124', '234234', 'teeesstt', 180.00, 'confirmee', '2025-11-11 11:22:39'),
(19, 3, '2025-11-29 00:00:00', '17:17:00', 'Tunis Carthage Airport', 'Tunis', 'one_way', 2, '2025-12-06 00:00:00', '19:19:00', NULL, NULL, 'ahmed', 'ksontini', 'ahmedksontini@hmail.com', '12234234', '12323124', '234234', NULL, 40.00, 'en_attente', '2025-11-25 14:18:45'),
(20, 3, '2025-11-29 00:00:00', '17:17:00', 'Tunis Carthage Airport', 'Tunis', 'return', 2, '2025-12-06 00:00:00', '19:19:00', 'Tunis', 'Tunis Carthage Airport', 'ahmed', 'ksontini', 'ahmedksontini@hmail.com', '12234234', '12323124', '234234', NULL, 80.00, 'en_attente', '2025-11-25 14:18:54'),
(21, 3, '2025-11-29 00:00:00', '17:17:00', 'Tunis Carthage Airport', 'Tunis', 'return', 2, '2025-12-06 00:00:00', '19:19:00', 'Tunis', 'Tunis Carthage Airport', 'ahmed', 'ksontini', 'ahmedksontini@hmail.com', '12234234', '12323124', '234234', NULL, 80.00, 'en_attente', '2025-11-25 14:19:54'),
(22, 3, '2025-11-29 00:00:00', '17:17:00', 'Tunis Carthage Airport', 'Tunis', 'return', 2, '2025-12-06 00:00:00', '19:19:00', 'Tunis', 'Tunis Carthage Airport', 'ahmed', 'ksontini', 'ahmedksontini@hmail.com', '12234234', '12323124', '234234', NULL, 80.00, 'en_attente', '2025-11-25 14:20:39'),
(23, 2, '2025-11-28 00:00:00', '19:01:00', 'Tunis Carthage Airport', 'Hammamet', 'return', 5, '2025-11-30 00:00:00', '20:02:00', 'Hammamet', 'Tunis Carthage Airport', 'ahmed', 'ksontini', 'ahmedksontini@hmail.com', '12234234', '12323124', '234234', NULL, 440.00, 'en_attente', '2025-11-25 16:59:41'),
(24, 8, '2025-12-06 00:00:00', '14:47:00', 'Enfidha Airport', 'Hammamet', 'return', 5, '2025-12-19 00:00:00', '16:49:00', NULL, NULL, 'ahmed', 'ksontini', 'ahmedksontini@hmail.com', '12234234', '12323124', '234234', NULL, 220.00, 'en_attente', '2025-11-28 11:44:24'),
(25, 8, '2025-12-06 00:00:00', '14:47:00', 'Enfidha Airport', 'Hammamet', 'return', 5, '2025-12-19 00:00:00', '16:49:00', NULL, NULL, 'ahmed', 'ksontini', 'ahmedksontini@hmail.com', '12234234', '12323124', '234234', NULL, 220.00, 'en_attente', '2025-11-28 11:54:49'),
(26, 8, '2025-12-06 00:00:00', '14:47:00', 'Enfidha Airport', 'Hammamet', 'return', 5, '2025-12-19 00:00:00', '16:49:00', NULL, NULL, 'ahmed', 'ksontini', 'ahmedksontini@hmail.com', '12234234', '12323124', '234234', NULL, 220.00, 'en_attente', '2025-11-28 11:56:45');

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
  PRIMARY KEY (`id`),
  KEY `IDX_8E773A8A181A8BA` (`voiture_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `reservation_voiture`
--

INSERT INTO `reservation_voiture` (`id`, `voiture_id`, `nom`, `prenom`, `date_naissance`, `lieu_naissance`, `nationalite`, `adresse`, `tel`, `num_cin_passport`, `cin_delivre_le`, `num_permis`, `permis_delivre_le`, `permis_lieu_delivrance`, `created_at`, `updated_at`, `date_debut`, `date_fin`, `prix_total`) VALUES
(23, 1, 'ksontini', 'ahmed', '2007-11-23', 'nabeul', 'tunisien', 'rue taher ben fraj', '93313278', '12546', '2025-11-27', '2591951', '2023-11-23', 'hammaet', '2025-11-27 17:39:19', '2025-11-27 17:39:19', '2025-12-01', '2025-12-30', 1300);

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
(13, 'Enfidha Airport', 'Bizerte', 120.00, 'bizerte-6906010195014.jpg', '2.40 Min', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `adresse`, `tel`) VALUES
(1, 'ahmedksontini@gmail.com', '[]', '$2y$13$xtutIcVK9BouQZJ7WmyrFO1aT/fVPVxPbKMJvja.GBignwP9N4Ltu', 'ksontini', 'ahmed', 'Tunisie', '93313278');

-- --------------------------------------------------------

--
-- Structure de la table `voitures`
--

DROP TABLE IF EXISTS `voitures`;
CREATE TABLE IF NOT EXISTS `voitures` (
  `id` int NOT NULL AUTO_INCREMENT,
  `marque` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `modele` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `immatriculation` varchar(30) COLLATE utf8mb3_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `voitures`
--

INSERT INTO `voitures` (`id`, `marque`, `modele`, `immatriculation`, `prix_jour`, `image`, `disponible`, `description`, `boite_vitesse`, `climatiseur`, `passengers`, `suitcases`, `prix_mois`) VALUES
(1, 'Ford', 'Focus', '140 tu 1234', 120, 'ford-focus-ST-X-mean-green-68f50fef1da7c.jpg', 1, NULL, 'Auto', 1, 2, 1, 1300.00),
(2, 'Suzuki', 'Swift', '220 tu 264', 180, '47300-68f5103ddbf2e.png', 1, NULL, 'Manuelle', 1, 4, 1, 200000.00),
(3, 'Dacia', 'sandero stepway', '241 tu 1257', 150, 'dacia-sandero-stepway-68f5107d96bb9.jpg', 1, NULL, 'Manuelle', 1, 7, 5, 50000.00);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis_excursion`
--
ALTER TABLE `avis_excursion`
  ADD CONSTRAINT `FK_3D5DF8EE4AB4296F` FOREIGN KEY (`excursion_id`) REFERENCES `excursion` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3D5DF8EEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `excursion_detail`
--
ALTER TABLE `excursion_detail`
  ADD CONSTRAINT `FK_BFB0D73B4AB4296F` FOREIGN KEY (`excursion_id`) REFERENCES `excursion` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `faqexcursion`
--
ALTER TABLE `faqexcursion`
  ADD CONSTRAINT `FK_496A5B584AB4296F` FOREIGN KEY (`excursion_id`) REFERENCES `excursion` (`id`) ON DELETE CASCADE;

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
