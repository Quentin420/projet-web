-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 30 Avril 2018 à 23:19
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

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
  PRIMARY KEY (`id_commentaire`),
  KEY `id_user` (`id_user`),
  KEY `id_post` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`id_commentaire`, `id_user`, `id_post`, `commenatire`, `date_commentaire`) VALUES
(1, 2, 1, 'Sympa ton post :)', '2018-04-30 00:31:00'),
(2, 1, 2, 'Cool', '2018-05-01 00:30:00'),
(3, 7, 14, 'Tu déchires', '2018-04-16 00:00:00'),
(4, 11, 9, 'Cool', '2018-04-29 00:00:00'),
(5, 11, 5, 'Ouloulou', '2018-04-29 00:00:00'),
(6, 12, 1, 'Bravo', '2018-05-03 00:00:00'),
(7, 1, 13, 'Ok', '2018-05-05 00:00:00'),
(8, 8, 8, 'Bien', '2018-05-07 00:00:00'),
(9, 7, 13, 'Dac', '2018-05-04 00:00:00'),
(10, 11, 12, 'hihi', '2018-05-07 00:00:00'),
(11, 9, 9, 'Yes', '2018-05-13 00:00:00'),
(12, 4, 11, 'ahahah', '2018-05-07 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `emploi`
--

INSERT INTO `emploi` (`id_emploi`, `date_emploi`, `entreprise`, `type_offre`, `descriptif_emploi`, `intitule_offre`, `disponibilite`) VALUES
(1, '2018-04-30 18:00:00', 'AXA Banque', 'CDI', 'Agent administratif\r\nSalaire : 300k\r\nCompétences requises : C++/Java/HTML', 'Agent administratif bien payé', 1),
(2, '2018-05-03 00:00:00', 'Aviva', 'Balayeur', 'Balayeur a temps plein qui a une bonne cadence de balayage', 'Stage - 6 mois', 1),
(3, '2018-05-01 00:00:00', 'Boulangerie', 'CDD', 'Cuiseur de baguettes\r\nBien payé', 'Boulanger - jeune ', 1),
(4, '2018-05-03 00:00:00', 'ECE', 'Stage', 'Aider l''administration, gros travail de fond a realiser\r\nPatiente exigé', 'Agent', 1),
(5, '2018-05-02 00:00:00', 'Orange', 'CDI', 'Vendeur temps plein', 'Vendeur en boutique', 1),
(6, '2018-05-02 00:00:00', 'La main verte', 'CDI', 'Jardinier très cultivé ', 'Jardinier', 1),
(7, '2018-04-30 00:00:00', 'Netflix', 'CDD', 'Besoin de tester nos séries\r\nSuper bien payé', 'Testeur', 1);

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
  PRIMARY KEY (`id_like`),
  KEY `id_user` (`id_user`),
  KEY `id_post` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `like`
--

INSERT INTO `like` (`id_like`, `id_user`, `id_post`, `date_like`) VALUES
(1, 1, 2, '2018-04-30 00:33:00'),
(2, 2, 1, '2018-04-30 19:00:00'),
(3, 10, 5, '2018-05-27 00:00:00'),
(4, 1, 8, '2018-05-06 00:00:00'),
(5, 4, 5, '2018-05-02 00:00:00'),
(6, 7, 1, '2018-05-13 00:00:00'),
(7, 12, 2, '2018-05-07 00:00:00'),
(8, 3, 14, '2018-05-04 00:00:00'),
(9, 3, 13, '2018-05-13 00:00:00'),
(10, 10, 12, '2018-05-07 00:00:00'),
(11, 8, 13, '2018-05-10 00:00:00'),
(12, 7, 5, '2018-05-13 00:00:00'),
(13, 6, 2, '2018-05-08 00:00:00'),
(14, 9, 14, '2018-05-08 00:00:00'),
(15, 11, 14, '2018-05-11 00:00:00'),
(16, 7, 10, '2018-05-07 00:00:00'),
(17, 7, 7, '2018-05-06 00:00:00'),
(18, 9, 4, '2018-05-17 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(10) NOT NULL AUTO_INCREMENT,
  `id_expediteur` int(10) NOT NULL,
  `id_destinataire` int(10) NOT NULL,
  `message` text NOT NULL,
  `date_message` datetime NOT NULL,
  PRIMARY KEY (`id_message`),
  KEY `id_expediteur` (`id_expediteur`),
  KEY `id_destinataire` (`id_destinataire`),
  KEY `id_expediteur_2` (`id_expediteur`),
  KEY `id_expediteur_3` (`id_expediteur`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id_message`, `id_expediteur`, `id_destinataire`, `message`, `date_message`) VALUES
(1, 1, 2, 'Bonjour PL, comment vas tu ?', '2018-05-01 09:18:34'),
(2, 2, 1, 'Salut Quentin, ca va bien et toi ?', '2018-05-01 15:40:44'),
(3, 4, 12, 'Ouloulou', '2018-05-03 00:00:00'),
(4, 9, 12, 'Tchatcheur', '2018-05-09 00:00:00'),
(5, 1, 8, 'Pile ou face ?', '2018-05-03 00:00:00'),
(6, 4, 6, 'Skrt', '2018-05-06 00:00:00'),
(7, 5, 2, 'C''est quoi ton mdp ?', '2018-05-02 00:00:00'),
(8, 2, 5, 'Je sais pas je l''ai oublié ', '2018-05-10 00:00:00'),
(9, 9, 11, 'T''es belle', '2018-05-04 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id_notification` int(10) NOT NULL AUTO_INCREMENT,
  `id_post` int(10) NOT NULL,
  `expire` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_notification`),
  KEY `id_post` (`id_post`)
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
  `document` varchar(255) NOT NULL,
  `date_post` datetime NOT NULL,
  `visibilite` tinyint(1) NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `descriptif` text NOT NULL,
  `humeur` varchar(255) NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `post`
--

INSERT INTO `post` (`id_post`, `id_user`, `document`, `date_post`, `visibilite`, `lieu`, `descriptif`, `humeur`) VALUES
(1, 1, 'CV', '2018-04-30 11:00:00', 1, 'Carrieres sur Seine', 'Un jolie post', 'Happy'),
(2, 2, 'Post', '2018-04-30 13:26:26', 1, 'Verrieres le Buisson', 'Post', 'So anxious'),
(3, 6, 'azerty ', '2018-05-07 00:00:00', 1, 'Paris', 'fhsgsqguqhufdhqhdj', 'good'),
(4, 5, 'Rien', '2018-05-09 00:00:00', 1, 'Paris', 'Coool', 'Sad'),
(5, 6, 'Rien', '2018-05-02 00:00:00', 1, 'Capital du crime', 'Trop fort mon bro', 'Joyeux'),
(7, 10, 'Demande d''echange de rein', '2018-05-02 00:00:00', 1, 'Zoo de Vincennes', 'Du sale', 'Chill'),
(8, 11, 'La squale', '2018-05-06 00:00:00', 1, 'Parc des princes', 'Paris c''est la champions league', 'Champion mon frère'),
(9, 1, 'Congés payés', '2018-05-09 00:00:00', 1, 'Cannes', 'Ca chill au max', 'Posé'),
(10, 8, 'Rien', '2018-05-04 00:00:00', 1, 'Marseille', 'JUL le sang', 'Fais le signe'),
(11, 5, 'Rien', '2018-05-07 00:00:00', 1, 'Nul part', 'Ok', 'Neutre'),
(12, 9, 'Radiographie', '2018-05-05 00:00:00', 1, 'Hopital', 'Savage', 'Mal'),
(13, 3, 'Rien', '2018-05-06 00:00:00', 1, 'Moscou', 'Faut-il vivre pour manger ou manger pour vivre ?', 'Dubitative'),
(14, 8, 'Rien', '2018-05-21 00:00:00', 1, 'Paris', 'Beau gosse', 'Amoureux');

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
  PRIMARY KEY (`id_relation`),
  KEY `id_user1` (`id_user1`),
  KEY `id_user2` (`id_user2`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `relation`
--

INSERT INTO `relation` (`id_relation`, `id_user1`, `id_user2`, `date_relation`) VALUES
(1, 1, 2, '2018-04-30 00:00:00'),
(2, 2, 3, '2018-04-30 04:00:00'),
(3, 1, 3, '2018-04-30 14:00:00'),
(4, 9, 3, '2018-05-01 00:00:00'),
(5, 4, 12, '2018-05-01 00:00:00'),
(6, 12, 7, '2018-05-01 00:00:00'),
(7, 3, 7, '2018-05-30 00:00:00'),
(8, 1, 11, '2018-05-22 00:00:00'),
(9, 1, 9, '2018-05-21 00:00:00'),
(10, 3, 10, '2018-05-29 00:00:00'),
(11, 2, 6, '2018-05-30 00:00:00'),
(12, 1, 7, '2018-05-01 00:00:00'),
(14, 6, 7, '2018-05-08 00:00:00'),
(15, 7, 8, '2018-05-13 00:00:00'),
(17, 10, 4, '2018-05-27 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `admin` tinyint(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `background` varchar(255) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_user`, `admin`, `email`, `username`, `password`, `nom`, `prenom`, `avatar`, `background`, `cv`, `hash`, `active`) VALUES
(1, 1, 'qlemerle@gmail.com', 'ql152012', 'NLJ_2018', 'Lemerle', 'Quentin', 'LinkECE/img/avatar.jpg', 'LinkECE/img/avatar.jpg', 'LinkECE/img/avatar.jpg', '', 0),
(2, 1, 'plgounod@gmail.com', 'PLG', 'NLJ_2018', 'Gounod', 'PL', 'LinkECE/img/avatar.jpg', 'LinkECE/img/avatar.jpg', 'LinkECE/img/avatar.jpg', '', 0),
(3, 1, 'vicky.bot@gmail.com', 'Vickyyyy', 'NLJ_2018', 'Botrel', 'Victor', 'LinkECE/img/avatar.jpg', 'LinkECE/img/avatar.jpg', 'LinkECE/img/avatar.jpg', '', 0),
(4, 0, '', '', '', '', '', '', '', '', '', 1),
(5, 1, 'kou@gmail.com', 'Skrt', 'NLJ', 'oeojf', 'juil', 'LinkECE/img', 'LinkECE/img', 'LinkECE/img', '', 1),
(6, 1, 'pouro@gmail.com', 'jour', 'NLJ', 'por', 'oo', 'LinkECE/img', 'LinkECE/img', 'LinkECE/img', '', 1),
(7, 1, 'jjjj@gmail.com', 'mlkjh', 'NLJ', 'tyui', 'azerty', 'LinkECE/img', 'LinkECE/img', 'LinkECE/img', '', 1),
(8, 1, 'andrej@gmail.com', 'andrew', 'NLJ', 'stanislajevic', 'andrej', 'LinkECE/img', 'LinkECE/img', 'LinkECE/img', '', 1),
(9, 1, 'bboykamer@gmail.com', 'BBoyKamer', 'NLJ', 'Nijchte', 'Lorenzo', 'LinkECE/img', 'LinkECE/img', 'LinkECE/img', '', 1),
(10, 1, 'bruuuuh@gmail.com', 'Hugrocon', 'NLJ', 'Brue', 'Hugo', 'LinkECE/img', 'LinkECE/img', 'LinkECE/img', '', 1),
(11, 1, 'figard@gmail.com', 'Mogo', 'NLJ', 'Figard', 'Morgane', 'LinkECE/img', 'LinkECE/img', 'LinkECE/img', '', 1),
(12, 1, 'gandy@gmail.com', 'gandy', 'NLJ', 'Gandy', 'Lucas', 'LinkECE/img', 'LinkECE/img', 'LinkECE/img', '', 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`);

--
-- Contraintes pour la table `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `like_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `like_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`id_expediteur`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`id_destinataire`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `relation`
--
ALTER TABLE `relation`
  ADD CONSTRAINT `relation_ibfk_1` FOREIGN KEY (`id_user1`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `relation_ibfk_2` FOREIGN KEY (`id_user2`) REFERENCES `users` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
