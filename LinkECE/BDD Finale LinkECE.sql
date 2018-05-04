-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 04 Mai 2018 à 16:04
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
  `date_commentaire` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_commentaire`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`id_commentaire`, `id_user`, `id_post`, `commenatire`, `date_commentaire`) VALUES
(16, 33, 29, 'FÃ©licitation !', '2018-05-04 15:18:36'),
(17, 42, 31, 'Je connais peut-Ãªtre quelqu''un, je te tiens au courant !', '2018-05-04 15:21:02');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `conversation`
--

INSERT INTO `conversation` (`id`, `user_one`, `user_two`) VALUES
(10, 33, 42),
(11, 42, 43);

-- --------------------------------------------------------

--
-- Structure de la table `emploi`
--

DROP TABLE IF EXISTS `emploi`;
CREATE TABLE IF NOT EXISTS `emploi` (
  `id_emploi` int(10) NOT NULL AUTO_INCREMENT,
  `date_emploi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `entreprise` varchar(255) NOT NULL,
  `type_offre` varchar(255) NOT NULL,
  `descriptif_emploi` text NOT NULL,
  `intitule_offre` varchar(255) NOT NULL,
  `disponibilite` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_emploi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `emploi`
--

INSERT INTO `emploi` (`id_emploi`, `date_emploi`, `entreprise`, `type_offre`, `descriptif_emploi`, `intitule_offre`, `disponibilite`) VALUES
(1, '2018-04-30 18:00:00', 'AXA Banque', 'CDI', 'Agent administratif\r\nSalaire : 300k\r\nCompétences requises : C++/Java/HTML', 'Agent administratif bien payé', 1),
(2, '2018-05-04 15:10:09', 'Aviva', 'Job etudiant', 'Agent administratif pour juillet et aout 2018\r\nSalaire de 1000 euros par mois', 'Agent administratif', 1),
(3, '2018-05-04 15:10:09', 'Orange', 'Stage', 'Stage de 6 mois dans le domaine des telecom et réseaux\r\nStage remunere a hauteur de 600 euros par mois', 'Stage Orange remunere', 1);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `id_event` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_event`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `like`
--

DROP TABLE IF EXISTS `like`;
CREATE TABLE IF NOT EXISTS `like` (
  `id_like` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `id_post` int(10) NOT NULL,
  `date_like` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_like`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `like`
--

INSERT INTO `like` (`id_like`, `id_user`, `id_post`, `date_like`) VALUES
(12, 33, 29, '2018-05-04 15:18:11'),
(13, 42, 31, '2018-05-04 15:20:42'),
(14, 43, 30, '2018-05-04 15:23:40');

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `user_from`, `user_to`, `message`) VALUES
(17, 10, 33, 42, 'Bonjour Pierre-Louis, comment vas-tu ?'),
(18, 10, 33, 42, 'Tu as trouvÃ© un travail pour cet Ã©tÃ© ?'),
(19, 10, 42, 33, 'Ca va super et toi ?'),
(20, 10, 42, 33, 'Oui j''ai fini par trouvÃ© et toi ?'),
(21, 11, 42, 43, 'On sera pas dans la mÃªme majeure l''annÃ©e prochaine, je suis dÃ©Ã§u'),
(22, 11, 43, 42, 'Oui j''ai vu Ã§a, t''inquiÃ¨te pas on aura d''autres occasions de travailler ensemble ;)');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id_notification` int(10) NOT NULL AUTO_INCREMENT,
  `id_post` int(10) NOT NULL,
  `label` varchar(50) NOT NULL,
  `date_notification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(10) NOT NULL,
  PRIMARY KEY (`id_notification`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `notification`
--

INSERT INTO `notification` (`id_notification`, `id_post`, `label`, `date_notification`, `id_user`) VALUES
(4, 11, 'Nouvelle mention "J''aime"', '2018-05-03 19:05:59', 33),
(5, 17, 'Nouvelle mention "J''aime"', '2018-05-03 19:12:25', 36),
(8, 29, 'Nouvelle mention "J''aime"', '2018-05-04 15:18:11', 33),
(9, 31, 'Nouvelle mention "J''aime"', '2018-05-04 15:20:42', 42),
(10, 30, 'Nouvelle mention "J''aime"', '2018-05-04 15:23:39', 43);

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

DROP TABLE IF EXISTS `participant`;
CREATE TABLE IF NOT EXISTS `participant` (
  `id_participant` int(10) NOT NULL AUTO_INCREMENT,
  `id_event` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  PRIMARY KEY (`id_participant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `post`
--

INSERT INTO `post` (`id_post`, `id_user`, `document`, `date_post`, `visibilite`, `lieu`, `descriptif`, `humeur`) VALUES
(28, 42, '', '2018-05-04 15:13:25', 1, 'Paris', 'Bonjour, je recherche un stage pour cet Ã©tÃ©. Auriez-vous des contacts ?', 'Dubitatif'),
(29, 42, '', '2018-05-04 15:14:18', 1, 'Paris', 'J''ai enfin trouvÃ© un stage pour cet Ã©tÃ© chez Ariane. ', 'Heureux'),
(30, 43, '', '2018-05-04 15:17:16', 1, 'Paris', 'L''annÃ©e prochaine je me spÃ©ciale dans l''Ã©nergie et environnement. HÃ¢te de commencer.', 'Cool'),
(31, 33, '', '2018-05-04 15:19:41', 1, 'CarriÃ¨res sur Seine', 'Bonjour,\r\nJe cherche un stage de fin d''Ã©tude dans le domaine des objets connectÃ©s, quelqu''un aurait des informations ?', 'Enerve');

-- --------------------------------------------------------

--
-- Structure de la table `relation`
--

DROP TABLE IF EXISTS `relation`;
CREATE TABLE IF NOT EXISTS `relation` (
  `id_relation` int(10) NOT NULL AUTO_INCREMENT,
  `id_user1` int(10) NOT NULL,
  `id_user2` int(10) NOT NULL,
  `date_relation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_relation`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `relation`
--

INSERT INTO `relation` (`id_relation`, `id_user1`, `id_user2`, `date_relation`) VALUES
(10, 33, 42, '2018-05-04 15:18:06'),
(11, 42, 43, '2018-05-04 15:22:10');

-- --------------------------------------------------------

--
-- Structure de la table `requeteami`
--

DROP TABLE IF EXISTS `requeteami`;
CREATE TABLE IF NOT EXISTS `requeteami` (
  `id_requete` int(10) NOT NULL AUTO_INCREMENT,
  `id_from` int(10) NOT NULL,
  `id_to` int(10) NOT NULL,
  PRIMARY KEY (`id_requete`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `requeteami`
--

INSERT INTO `requeteami` (`id_requete`, `id_from`, `id_to`) VALUES
(3, 33, 40),
(6, 43, 33);

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
  `adresse` varchar(100) DEFAULT NULL,
  `resume` text,
  `promotion` int(4) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_user`, `admin`, `email`, `username`, `password`, `nom`, `prenom`, `avatar`, `background`, `cv`, `hash`, `active`, `adresse`, `resume`, `promotion`) VALUES
(33, 1, 'ql@gmail.com', 'ql152012', '$2y$10$rospGWcodoeS52FnoKsMCOrYOZ9IKqcO2R6o76eK2jgVqdbRYzakS', 'Lemerle', 'Quentin', 'img/test.jpg', 'img/sku.jpg', 'img/cv.pdf', '559cb990c9dffd8675f6bc2186971dc2', 0, 'CarriÃ¨res sur Seine', 'Je m''appelles Quentin Lemerle.', 2020),
(42, 0, 'pl@gmail.com', 'PLG', '$2y$10$FPsG2Z.VdWtmySFw/SIaOurG1PaRyajrsmA/R/Cp2IFuAZkio8VwO', 'Gounod', 'Pierre-Louis', 'img/mec2.png', 'img/back.png', 'img/cv.pdf', '7c590f01490190db0ed02a5070e20f01', 1, 'Verrieres le Buisson', 'Etudiant en ingÃ©nierie, actuellement a la recherche de stage pour juillet 2018 ', 2020),
(43, 0, 'vic@gmail.com', 'Vic', '$2y$10$7p5XbhMklZKchEZy1Jr5A.LdzpmcoVAAD88fk01Iy7evHal1TnX62', 'Botrel', 'Victor', 'img/photo.png', 'img/back3.png', 'img/cv.pdf', '25ddc0f8c9d3e22e03d3076f98d83cb2', 1, 'Saint Nom La Breteche', 'Je suis Ã©tudiant Ã  l''ECE Paris, Ã©cole d''ingÃ©nieurs.', 2020);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
