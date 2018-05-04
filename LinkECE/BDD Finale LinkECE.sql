-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  ven. 04 mai 2018 à 15:35
-- Version du serveur :  5.6.38
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `linkece`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_commentaire` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_post` int(10) NOT NULL,
  `commenatire` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `date_commentaire` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_commentaire`, `id_user`, `id_post`, `commenatire`, `date_commentaire`) VALUES
(16, 33, 29, 'Félicitation !', '2018-05-04 15:18:36'),
(17, 42, 31, 'Je connais peut-être quelqu\'un, je te tiens au courant !', '2018-05-04 15:21:02');

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`id`, `user_one`, `user_two`) VALUES
(10, 33, 42),
(11, 42, 43);

-- --------------------------------------------------------

--
-- Structure de la table `emploi`
--

CREATE TABLE `emploi` (
  `id_emploi` int(10) NOT NULL,
  `date_emploi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `entreprise` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `type_offre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `descriptif_emploi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `intitule_offre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `disponibilite` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emploi`
--

INSERT INTO `emploi` (`id_emploi`, `date_emploi`, `entreprise`, `type_offre`, `descriptif_emploi`, `intitule_offre`, `disponibilite`) VALUES
(1, '2018-04-30 18:00:00', 'AXA Banque', 'CDI', 'Agent administratif\r\nSalaire : 300k\r\nComp', 'Agent administratif bien pay', 1),
(2, '2018-05-04 15:10:09', 'Aviva', 'Job etudiant', 'Agent administratif pour juillet et aout 2018\r\nSalaire de 1000 euros par mois', 'Agent administratif', 1),
(3, '2018-05-04 15:10:09', 'Orange', 'Stage', 'Stage de 6 mois dans le domaine des telecom et r', 'Stage Orange remunere', 1);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id_event` int(10) NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `lieu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `like`
--

CREATE TABLE `like` (
  `id_like` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_post` int(10) NOT NULL,
  `date_like` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `like`
--

INSERT INTO `like` (`id_like`, `id_user`, `id_post`, `date_like`) VALUES
(12, 33, 29, '2018-05-04 15:18:11'),
(13, 42, 31, '2018-05-04 15:20:42'),
(14, 43, 30, '2018-05-04 15:23:40');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `user_from`, `user_to`, `message`) VALUES
(17, 10, 33, 42, 'Bonjour Pierre-Louis, comment vas-tu ?'),
(18, 10, 33, 42, 'Tu as trouvÃ© un travail pour cet Ã©tÃ© ?'),
(19, 10, 42, 33, 'Ca va super et toi ?'),
(20, 10, 42, 33, 'Oui j\'ai fini par trouvÃ© et toi ?'),
(21, 11, 42, 43, 'On sera pas dans la mÃªme majeure l\'annÃ©e prochaine, je suis dÃ©Ã§u'),
(22, 11, 43, 42, 'Oui j\'ai vu Ã§a, t\'inquiÃ¨te pas on aura d\'autres occasions de travailler ensemble ;)');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id_notification` int(10) NOT NULL,
  `id_post` int(10) NOT NULL,
  `label` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date_notification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id_notification`, `id_post`, `label`, `date_notification`, `id_user`) VALUES
(4, 11, 'Nouvelle mention \"J\'aime\"', '2018-05-03 19:05:59', 33),
(5, 17, 'Nouvelle mention \"J\'aime\"', '2018-05-03 19:12:25', 36),
(8, 29, 'Nouvelle mention \"J\'aime\"', '2018-05-04 15:18:11', 33),
(9, 31, 'Nouvelle mention \"J\'aime\"', '2018-05-04 15:20:42', 42),
(10, 30, 'Nouvelle mention \"J\'aime\"', '2018-05-04 15:23:39', 43),
(11, 29, 'Nouveau commentaire', '2018-05-04 15:54:12', 0);

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE `participant` (
  `id_participant` int(10) NOT NULL,
  `id_event` int(10) NOT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id_post` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `document` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `date_post` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visibilite` tinyint(1) NOT NULL,
  `lieu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `descriptif` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `humeur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `id_user`, `document`, `date_post`, `visibilite`, `lieu`, `descriptif`, `humeur`) VALUES
(28, 42, '', '2018-05-04 15:13:25', 1, 'Paris', 'Bonjour, je recherche un stage pour cet été. Auriez-vous des contacts ?', 'Dubitatif'),
(29, 42, '', '2018-05-04 15:14:18', 1, 'Paris', 'J\'ai enfin trouvé un stage pour cet été chez Ariane. ', 'Heureux'),
(30, 43, '', '2018-05-04 15:17:16', 1, 'Paris', 'L\'année prochaine je me spéciale dans l\'énergie et environnement. Hâte de commencer.', 'Cool'),
(31, 33, '', '2018-05-04 15:19:41', 1, 'Carrières sur Seine', 'Bonjour,\r\nJe cherche un stage de fin d\'étude dans le domaine des objets connectés, quelqu\'un aurait des informations ?', 'Enerve');

-- --------------------------------------------------------

--
-- Structure de la table `relation`
--

CREATE TABLE `relation` (
  `id_relation` int(10) NOT NULL,
  `id_user1` int(10) NOT NULL,
  `id_user2` int(10) NOT NULL,
  `date_relation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `relation`
--

INSERT INTO `relation` (`id_relation`, `id_user1`, `id_user2`, `date_relation`) VALUES
(10, 33, 42, '2018-05-04 15:18:06'),
(11, 42, 43, '2018-05-04 15:22:10');

-- --------------------------------------------------------

--
-- Structure de la table `requeteami`
--

CREATE TABLE `requeteami` (
  `id_requete` int(10) NOT NULL,
  `id_from` int(10) NOT NULL,
  `id_to` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `requeteami`
--

INSERT INTO `requeteami` (`id_requete`, `id_from`, `id_to`) VALUES
(3, 33, 40),
(6, 43, 33);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'img/avatar.svg',
  `background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT 'img/back.png',
  `cv` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT 'img/cv.pdf',
  `hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `active` smallint(6) NOT NULL,
  `adresse` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `resume` text CHARACTER SET utf8 COLLATE utf8_bin,
  `promotion` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `admin`, `email`, `username`, `password`, `nom`, `prenom`, `avatar`, `background`, `cv`, `hash`, `active`, `adresse`, `resume`, `promotion`) VALUES
(33, 1, 'ql@gmail.com', 'ql152012', '$2y$10$rospGWcodoeS52FnoKsMCOrYOZ9IKqcO2R6o76eK2jgVqdbRYzakS', 'Lemerle', 'Quentin', 'img/test.jpg', 'img/sku.jpg', 'img/cv.pdf', '559cb990c9dffd8675f6bc2186971dc2', 0, 'Carrières sur Seine', 'Je m\'appelles Quentin Lemerle.', 2020),
(42, 0, 'pl@gmail.com', 'PLG', '$2y$10$FPsG2Z.VdWtmySFw/SIaOurG1PaRyajrsmA/R/Cp2IFuAZkio8VwO', 'Gounod', 'Pierre-Louis', 'img/mec2.png', 'img/back.png', 'img/cv.pdf', '7c590f01490190db0ed02a5070e20f01', 1, 'Verrieres le Buisson', 'Etudiant en ingénierie, actuellement a la recherche de stage pour juillet 2018 ', 2020),
(43, 0, 'vic@gmail.com', 'Vic', '$2y$10$7p5XbhMklZKchEZy1Jr5A.LdzpmcoVAAD88fk01Iy7evHal1TnX62', 'Botrel', 'Victor', 'img/photo.png', 'img/back3.png', 'img/cv.pdf', '25ddc0f8c9d3e22e03d3076f98d83cb2', 1, 'Saint Nom La Breteche', 'Je suis étudiant à l\'ECE Paris, école d\'ingénieurs.', 2020);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_commentaire`);

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `emploi`
--
ALTER TABLE `emploi`
  ADD PRIMARY KEY (`id_emploi`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_event`);

--
-- Index pour la table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id_like`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id_notification`);

--
-- Index pour la table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id_participant`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`);

--
-- Index pour la table `relation`
--
ALTER TABLE `relation`
  ADD PRIMARY KEY (`id_relation`);

--
-- Index pour la table `requeteami`
--
ALTER TABLE `requeteami`
  ADD PRIMARY KEY (`id_requete`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_commentaire` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `emploi`
--
ALTER TABLE `emploi`
  MODIFY `id_emploi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id_event` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `like`
--
ALTER TABLE `like`
  MODIFY `id_like` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id_notification` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `participant`
--
ALTER TABLE `participant`
  MODIFY `id_participant` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `relation`
--
ALTER TABLE `relation`
  MODIFY `id_relation` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `requeteami`
--
ALTER TABLE `requeteami`
  MODIFY `id_requete` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  ven. 04 mai 2018 à 15:35
-- Version du serveur :  5.6.38
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `linkece`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_commentaire` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_post` int(10) NOT NULL,
  `commenatire` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `date_commentaire` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_commentaire`, `id_user`, `id_post`, `commenatire`, `date_commentaire`) VALUES
(16, 33, 29, 'Félicitation !', '2018-05-04 15:18:36'),
(17, 42, 31, 'Je connais peut-être quelqu\'un, je te tiens au courant !', '2018-05-04 15:21:02');

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`id`, `user_one`, `user_two`) VALUES
(10, 33, 42),
(11, 42, 43);

-- --------------------------------------------------------

--
-- Structure de la table `emploi`
--

CREATE TABLE `emploi` (
  `id_emploi` int(10) NOT NULL,
  `date_emploi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `entreprise` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `type_offre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `descriptif_emploi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `intitule_offre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `disponibilite` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emploi`
--

INSERT INTO `emploi` (`id_emploi`, `date_emploi`, `entreprise`, `type_offre`, `descriptif_emploi`, `intitule_offre`, `disponibilite`) VALUES
(1, '2018-04-30 18:00:00', 'AXA Banque', 'CDI', 'Agent administratif\r\nSalaire : 300k\r\nComp', 'Agent administratif bien pay', 1),
(2, '2018-05-04 15:10:09', 'Aviva', 'Job etudiant', 'Agent administratif pour juillet et aout 2018\r\nSalaire de 1000 euros par mois', 'Agent administratif', 1),
(3, '2018-05-04 15:10:09', 'Orange', 'Stage', 'Stage de 6 mois dans le domaine des telecom et r', 'Stage Orange remunere', 1);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id_event` int(10) NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `lieu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `like`
--

CREATE TABLE `like` (
  `id_like` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_post` int(10) NOT NULL,
  `date_like` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `like`
--

INSERT INTO `like` (`id_like`, `id_user`, `id_post`, `date_like`) VALUES
(12, 33, 29, '2018-05-04 15:18:11'),
(13, 42, 31, '2018-05-04 15:20:42'),
(14, 43, 30, '2018-05-04 15:23:40');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `user_from`, `user_to`, `message`) VALUES
(17, 10, 33, 42, 'Bonjour Pierre-Louis, comment vas-tu ?'),
(18, 10, 33, 42, 'Tu as trouvÃ© un travail pour cet Ã©tÃ© ?'),
(19, 10, 42, 33, 'Ca va super et toi ?'),
(20, 10, 42, 33, 'Oui j\'ai fini par trouvÃ© et toi ?'),
(21, 11, 42, 43, 'On sera pas dans la mÃªme majeure l\'annÃ©e prochaine, je suis dÃ©Ã§u'),
(22, 11, 43, 42, 'Oui j\'ai vu Ã§a, t\'inquiÃ¨te pas on aura d\'autres occasions de travailler ensemble ;)');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id_notification` int(10) NOT NULL,
  `id_post` int(10) NOT NULL,
  `label` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date_notification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id_notification`, `id_post`, `label`, `date_notification`, `id_user`) VALUES
(4, 11, 'Nouvelle mention \"J\'aime\"', '2018-05-03 19:05:59', 33),
(5, 17, 'Nouvelle mention \"J\'aime\"', '2018-05-03 19:12:25', 36),
(8, 29, 'Nouvelle mention \"J\'aime\"', '2018-05-04 15:18:11', 33),
(9, 31, 'Nouvelle mention \"J\'aime\"', '2018-05-04 15:20:42', 42),
(10, 30, 'Nouvelle mention \"J\'aime\"', '2018-05-04 15:23:39', 43),
(11, 29, 'Nouveau commentaire', '2018-05-04 15:54:12', 0);

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE `participant` (
  `id_participant` int(10) NOT NULL,
  `id_event` int(10) NOT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id_post` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `document` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `date_post` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visibilite` tinyint(1) NOT NULL,
  `lieu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `descriptif` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `humeur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `id_user`, `document`, `date_post`, `visibilite`, `lieu`, `descriptif`, `humeur`) VALUES
(28, 42, '', '2018-05-04 15:13:25', 1, 'Paris', 'Bonjour, je recherche un stage pour cet été. Auriez-vous des contacts ?', 'Dubitatif'),
(29, 42, '', '2018-05-04 15:14:18', 1, 'Paris', 'J\'ai enfin trouvé un stage pour cet été chez Ariane. ', 'Heureux'),
(30, 43, '', '2018-05-04 15:17:16', 1, 'Paris', 'L\'année prochaine je me spéciale dans l\'énergie et environnement. Hâte de commencer.', 'Cool'),
(31, 33, '', '2018-05-04 15:19:41', 1, 'Carrières sur Seine', 'Bonjour,\r\nJe cherche un stage de fin d\'étude dans le domaine des objets connectés, quelqu\'un aurait des informations ?', 'Enerve');

-- --------------------------------------------------------

--
-- Structure de la table `relation`
--

CREATE TABLE `relation` (
  `id_relation` int(10) NOT NULL,
  `id_user1` int(10) NOT NULL,
  `id_user2` int(10) NOT NULL,
  `date_relation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `relation`
--

INSERT INTO `relation` (`id_relation`, `id_user1`, `id_user2`, `date_relation`) VALUES
(10, 33, 42, '2018-05-04 15:18:06'),
(11, 42, 43, '2018-05-04 15:22:10');

-- --------------------------------------------------------

--
-- Structure de la table `requeteami`
--

CREATE TABLE `requeteami` (
  `id_requete` int(10) NOT NULL,
  `id_from` int(10) NOT NULL,
  `id_to` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `requeteami`
--

INSERT INTO `requeteami` (`id_requete`, `id_from`, `id_to`) VALUES
(3, 33, 40),
(6, 43, 33);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'img/avatar.svg',
  `background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT 'img/back.png',
  `cv` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT 'img/cv.pdf',
  `hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `active` smallint(6) NOT NULL,
  `adresse` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `resume` text CHARACTER SET utf8 COLLATE utf8_bin,
  `promotion` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `admin`, `email`, `username`, `password`, `nom`, `prenom`, `avatar`, `background`, `cv`, `hash`, `active`, `adresse`, `resume`, `promotion`) VALUES
(33, 1, 'ql@gmail.com', 'ql152012', '$2y$10$rospGWcodoeS52FnoKsMCOrYOZ9IKqcO2R6o76eK2jgVqdbRYzakS', 'Lemerle', 'Quentin', 'img/test.jpg', 'img/sku.jpg', 'img/cv.pdf', '559cb990c9dffd8675f6bc2186971dc2', 0, 'Carrières sur Seine', 'Je m\'appelles Quentin Lemerle.', 2020),
(42, 0, 'pl@gmail.com', 'PLG', '$2y$10$FPsG2Z.VdWtmySFw/SIaOurG1PaRyajrsmA/R/Cp2IFuAZkio8VwO', 'Gounod', 'Pierre-Louis', 'img/mec2.png', 'img/back.png', 'img/cv.pdf', '7c590f01490190db0ed02a5070e20f01', 1, 'Verrieres le Buisson', 'Etudiant en ingénierie, actuellement a la recherche de stage pour juillet 2018 ', 2020),
(43, 0, 'vic@gmail.com', 'Vic', '$2y$10$7p5XbhMklZKchEZy1Jr5A.LdzpmcoVAAD88fk01Iy7evHal1TnX62', 'Botrel', 'Victor', 'img/photo.png', 'img/back3.png', 'img/cv.pdf', '25ddc0f8c9d3e22e03d3076f98d83cb2', 1, 'Saint Nom La Breteche', 'Je suis étudiant à l\'ECE Paris, école d\'ingénieurs.', 2020);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_commentaire`);

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `emploi`
--
ALTER TABLE `emploi`
  ADD PRIMARY KEY (`id_emploi`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_event`);

--
-- Index pour la table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id_like`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id_notification`);

--
-- Index pour la table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id_participant`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`);

--
-- Index pour la table `relation`
--
ALTER TABLE `relation`
  ADD PRIMARY KEY (`id_relation`);

--
-- Index pour la table `requeteami`
--
ALTER TABLE `requeteami`
  ADD PRIMARY KEY (`id_requete`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_commentaire` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `emploi`
--
ALTER TABLE `emploi`
  MODIFY `id_emploi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id_event` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `like`
--
ALTER TABLE `like`
  MODIFY `id_like` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id_notification` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `participant`
--
ALTER TABLE `participant`
  MODIFY `id_participant` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `relation`
--
ALTER TABLE `relation`
  MODIFY `id_relation` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `requeteami`
--
ALTER TABLE `requeteami`
  MODIFY `id_requete` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
