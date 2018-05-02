-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 02 Mai 2018 à 08:04
-- Version du serveur :  5.7.9
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `linkece`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id_commentaire` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `id_post` int(10) NOT NULL,
  `commenatire` text NOT NULL,
  `date_commentaire` datetime NOT NULL,
  PRIMARY KEY (`id_commentaire`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

DROP TABLE IF EXISTS `conversation`;
CREATE TABLE IF NOT EXISTS `conversation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `emploi`
--

DROP TABLE IF EXISTS `emploi`;
CREATE TABLE IF NOT EXISTS `emploi` (
  `id_emploi` int(10) NOT NULL AUTO_INCREMENT,
  `date_emploi` datetime NOT NULL,
  `entreprise` varchar(255) NOT NULL,
  `type_offre` varchar(255) NOT NULL,
  `descriptif_emploi` text NOT NULL,
  `intitule_offre` varchar(255) NOT NULL,
  `disponibilite` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_emploi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `emploi`
--

INSERT INTO `emploi` (`id_emploi`, `date_emploi`, `entreprise`, `type_offre`, `descriptif_emploi`, `intitule_offre`, `disponibilite`) VALUES
(1, '2018-04-30 18:00:00', 'AXA Banque', 'CDI', 'Agent administratif\r\nSalaire : 300k\r\nCompétences requises : C++/Java/HTML', 'Agent administratif bien payé', 1);

-- --------------------------------------------------------

--
-- Structure de la table `like`
--

DROP TABLE IF EXISTS `like`;
CREATE TABLE IF NOT EXISTS `like` (
  `id_like` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `id_post` int(10) NOT NULL,
  `date_like` datetime NOT NULL,
  PRIMARY KEY (`id_like`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `like`
--

INSERT INTO `like` (`id_like`, `id_user`, `id_post`, `date_like`) VALUES
(1, 1, 2, '2018-04-30 00:33:00'),
(2, 2, 1, '2018-04-30 19:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversation_id` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id_notification` int(10) NOT NULL AUTO_INCREMENT,
  `id_post` int(10) NOT NULL,
  `expire` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_notification`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `notification`
--

INSERT INTO `notification` (`id_notification`, `id_post`, `expire`) VALUES
(1, 1, 0),
(2, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `date_post` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visibilite` tinyint(1) NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `descriptif` text NOT NULL,
  `humeur` varchar(255) NOT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `post`
--

INSERT INTO `post` (`id_post`, `id_user`, `document`, `date_post`, `visibilite`, `lieu`, `descriptif`, `humeur`) VALUES
(1, 33, 'Rien', '2018-05-17 00:00:00', 1, 'Carrieres sur Seine', 'Bonjour a tous :)', 'Content'),
(2, 33, 'Rien', '2018-05-02 00:00:00', 1, 'Houilles', 'Une bonne journee', 'Triste'),
(3, 33, 'Rien', '2018-05-06 00:00:00', 1, 'Cannes', 'Bonne vacances a tous', 'Joyeux'),
(4, 33, 'Rien', '2018-05-02 07:55:19', 1, 'Partout', 'Salut', 'Heureux'),
(5, 33, 'Rien', '2018-05-02 08:16:47', 1, 'CarriÃ¨res sur Seine', 'Bonjour', 'Triste'),
(6, 33, 'CV-Quentin Lemerle-2018.pdf', '2018-05-02 09:00:44', 1, 'Ici', 'ouloulou', 'Enerve'),
(7, 33, '', '2018-05-02 09:02:11', 1, 'La', 'Oui', 'Triste'),
(8, 37, '', '2018-05-02 09:59:07', 1, 'St Germain en laye', 'Je cherche un stage', 'Dubitatif'),
(9, 37, '', '2018-05-02 09:59:33', 1, 'Paris', 'Bonjour Ã  tous', 'Heureux'),
(10, 36, '', '2018-05-02 10:00:23', 1, 'Issy-Les-Moulineaux', 'Cherche un CDI', 'Enerve'),
(11, 36, '', '2018-05-02 10:00:46', 1, 'Paris', 'Enfin les vacances', 'Cool'),
(12, 35, '', '2018-05-02 10:01:20', 1, 'Anthony', 'Enfin trouvÃ© un stage ', 'Dubitatif');

-- --------------------------------------------------------

--
-- Structure de la table `relation`
--

DROP TABLE IF EXISTS `relation`;
CREATE TABLE IF NOT EXISTS `relation` (
  `id_relation` int(10) NOT NULL AUTO_INCREMENT,
  `id_user1` int(10) NOT NULL,
  `id_user2` int(10) NOT NULL,
  `date_relation` datetime NOT NULL,
  PRIMARY KEY (`id_relation`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `relation`
--

INSERT INTO `relation` (`id_relation`, `id_user1`, `id_user2`, `date_relation`) VALUES
(1, 33, 35, '2018-05-02 00:00:00'),
(2, 33, 36, '2018-05-01 00:00:00'),
(3, 33, 37, '2018-05-02 00:00:00'),
(4, 35, 36, '2018-05-01 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'img/avatar.svg',
  `background` varchar(255) DEFAULT 'img/back.png',
  `cv` varchar(255) DEFAULT 'img/cv.pdf',
  `hash` varchar(255) NOT NULL,
  `active` smallint(6) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_user`, `admin`, `email`, `username`, `password`, `nom`, `prenom`, `avatar`, `background`, `cv`, `hash`, `active`) VALUES
(33, 0, 'ql@gmail.com', 'ql152012', '$2y$10$rospGWcodoeS52FnoKsMCOrYOZ9IKqcO2R6o76eK2jgVqdbRYzakS', 'Lemerle ', 'Quentin', 'img/avatar.svg', 'img/back.png', 'img/cv.pdf', '559cb990c9dffd8675f6bc2186971dc2', 1),
(34, 0, 'qlus@gmail.com', 'feujus', '$2y$10$/GqPVc9NEdg71WpRsfctkuiOlQLdFg5DKy13ni8jhFvVT.tTGV.le', 'quentinus', 'lemerlus', 'LinkECE/img/avatar.svg', 'LinkECE/img/back.png', NULL, 'e07413354875be01a996dc560274708e', 1),
(35, 0, 'plg@gmail.com', 'PLG', '$2y$10$FjtXnpBgc0NEnX6CF/dPr.DX7eBIa/09DomadvaShh8kyDnGohAxW', 'Gounod', 'PL', 'img/avatar.svg', 'img/back.png', 'img/cv.pdf', '8fecb20817b3847419bb3de39a609afe', 1),
(36, 0, 'vicb@gmail.com', 'Vicky', '$2y$10$gBawMB5WME.wvdK2ll2WCuH7In2pWQl18AgQep.kVKHVMxm4s9MAa', 'Botrel', 'Victor', 'img/avatar.svg', 'img/back.png', 'img/cv.pdf', '10a5ab2db37feedfdeaab192ead4ac0e', 1),
(37, 0, 'brue@gmail.com', 'Bruuh', '$2y$10$TIovYyNsWnxpif65xGfIS.mWe7aSDgAP4fDKCvQ4iMaMmdwYbUMS6', 'Brue', 'Hugo', 'img/avatar.svg', 'img/back.png', 'img/cv.pdf', 'a4f23670e1833f3fdb077ca70bbd5d66', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
