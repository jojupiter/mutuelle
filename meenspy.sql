-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 05 avr. 2019 à 04:53
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `meenspy`
--

-- --------------------------------------------------------

--
-- Structure de la table `exercise`
--

CREATE TABLE `exercise` (
  `id` int(11) NOT NULL COMMENT 'Correspond a l''année de l''exercice',
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `duration` int(11) NOT NULL DEFAULT '12',
  `session_frequency` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `help`
--

CREATE TABLE `help` (
  `id` int(11) NOT NULL,
  `matricule_member` varchar(6) NOT NULL COMMENT 'matricule du membre ayant reçu l''aide',
  `id_session` int(11) NOT NULL COMMENT 'session à laquelle il a perçu cette aide',
  `type` int(11) NOT NULL COMMENT 'le type de l''aide se trouve dans la table parametre. c''est dans cette table qu''on va lire le montant (par membre) de l''aide à donner en fonction du type de l''aide.classification : 6 : deces_parent7 : deces_beau_parent8 : deces_membre  : ici l''aide est versé auprès de la famille du membre9 : deces_conjoint10 : deces_enfant11 : naissance12 : mariage13 : autres évènement joyeux14 : aures évènements malheureux'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `loan`
--

CREATE TABLE `loan` (
  `id` int(11) NOT NULL,
  `matricule_member` varchar(6) NOT NULL COMMENT 'matricule de l''emprunteur',
  `id_session` int(11) NOT NULL COMMENT 'id de la session a laquelle s''est fait l''emprunt',
  `amount` float NOT NULL COMMENT 'montant emprunté'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `member`
--

CREATE TABLE `member` (
  `matricule` varchar(6) NOT NULL COMMENT 'Exemple : 18M00118 signifie que le membre s''est inscrit en 2018001 signifie qu''il est le premier membre à s''inscrire cette année.',
  `firstname` varchar(255) NOT NULL COMMENT 'Exemple : LONLAStocker les noms en majuscule',
  `lastname` varchar(255) NOT NULL COMMENT 'Exemple : Gatien Jordanles premières lettres de chaque prénom en majuscule',
  `phone` varchar(20) NOT NULL COMMENT 'Exemple : +237 695 463 868',
  `email` varchar(255) NOT NULL COMMENT 'Exemple : gatienjordanlonlaep@gmail.comstocker les email en minuscule',
  `photo` varchar(255) DEFAULT NULL,
  `pobox` varchar(50) DEFAULT NULL COMMENT 'Exemple : BP : 8120 Yaoundé',
  `residence` varchar(255) NOT NULL COMMENT 'Exemple : EMANAstocker les quatier résidentiel en majuscule'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `member`
--

INSERT INTO `member` (`matricule`, `firstname`, `lastname`, `phone`, `email`, `photo`, `pobox`, `residence`) VALUES
('19M001', 'BATCHAKUI', 'Bernabé', '695463868', 'bbatchakui@gmail.com', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `registration`
--

CREATE TABLE `registration` (
  `matricule_member` varchar(6) NOT NULL COMMENT 'matricule du membre qui s''inscrit',
  `amount` float NOT NULL COMMENT 'frais d''inscription qui sera lu dans la table paramètre',
  `date_` datetime NOT NULL COMMENT 'date d''inscription'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `registration`
--

INSERT INTO `registration` (`matricule_member`, `amount`, `date_`) VALUES
('19M001', 50000, '2018-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `repayment`
--

CREATE TABLE `repayment` (
  `id` int(11) NOT NULL,
  `id_session` int(11) NOT NULL COMMENT 'session à laquelle le remboursement s''effectue',
  `id_loan` int(11) NOT NULL,
  `amount` float NOT NULL COMMENT 'montant du remboursement'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `saving`
--

CREATE TABLE `saving` (
  `id` int(11) NOT NULL,
  `matricule_member` varchar(6) NOT NULL COMMENT 'matricule de l''épargnant',
  `id_session` int(11) NOT NULL COMMENT 'id de la session à laquelle s''effectue l''epargne',
  `amount` float NOT NULL COMMENT 'montant de l''épargne'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL COMMENT 'numéro de la session',
  `id_exercise` int(11) NOT NULL COMMENT 'annee d''exercice auquel cette session appartient',
  `date_` date NOT NULL COMMENT 'date de la session'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `setting`
--

CREATE TABLE `setting` (
  `id_exercise` int(11) NOT NULL COMMENT 'annee à laquelle correspond ces paramètres',
  `registration_fees` float NOT NULL COMMENT 'montant des frais d''inscription',
  `interest_rate` float NOT NULL COMMENT 'valeur du taux d''interêt pour les emprunts.Exemple : 0.1 pour 10%',
  `amount_sb_om` float NOT NULL COMMENT 'montant du fond social pour les anciens membres (membres s''ayant inscrit avant l''année à laquelle ces paramètres s''appliquent)',
  `amount_sb_nm` float NOT NULL COMMENT 'montant du fond social pour les nouveaux membres (membres s''ayant inscrit lors de l''année à laquelle ces paramètres s''appliquent)',
  `delays_sb` int(11) NOT NULL DEFAULT '6' COMMENT 'nombre de mois octroyés aux membres pour payer le fondsocial de l''exercice correspondant à cette année.Pour les anciens membre : on commence à compter les mois restant à partir de la date de début de l''exercicePour les nouveaux membre : on commence à compter les mois restant à partir de leur date d''inscription',
  `parent_death` float NOT NULL COMMENT 'montant à verser en cas de déces du parent d''un membre',
  `parent_in_law_death` float NOT NULL COMMENT 'montant à verser en cas de déces du beau parent d''un membre',
  `member_death` float NOT NULL COMMENT 'montant à verser à la famille en cas de déces d''un  membre',
  `partner_death` float NOT NULL COMMENT 'montant à verser en cas de déces du conjoint d''un membre',
  `childreen_death` float NOT NULL COMMENT 'montant à verser en cas de déces de l''enfant d''un membre',
  `birth` float NOT NULL COMMENT 'montant à verser en cas de naissance d''un enfant d''un membre',
  `wedding` float NOT NULL COMMENT 'montant à verser en cas de mariage d''un membre',
  `other_happy_events` float NOT NULL COMMENT 'montant à verser en cas d''autres evenement joyeux',
  `other_unfortunate_events` float NOT NULL COMMENT 'montant à verser en cas d''autres evenement malheureux'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `socialbackground`
--

CREATE TABLE `socialbackground` (
  `id` int(11) NOT NULL,
  `id_session` int(11) NOT NULL COMMENT 'session à laquelle s''effectue le versement d''une tranche du fond social',
  `matricule_member` varchar(6) NOT NULL COMMENT 'matricule du membre',
  `amount` float NOT NULL COMMENT 'montant versé'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` varchar(6) NOT NULL COMMENT 'matricule du membre auquel est associé ce compte utilisateur',
  `username` varchar(255) NOT NULL COMMENT 'nom d''utilisateur',
  `auth_key` varchar(32) NOT NULL COMMENT 'clé d''authentification',
  `password_hash` varchar(255) NOT NULL COMMENT 'mot de passe crypté',
  `password_reset_token` varchar(255) NOT NULL COMMENT 'clé permettant la réinitilisation du mot de passe',
  `email` varchar(255) NOT NULL COMMENT 'adresse email du membre auquel correspond ce compte utilisateur',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '10 : pour compte actif\n0 : pour compte désactivé - ici le membre ne peut se connecter à la plateforme',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0 : pour utilisateur \n1 : pour administrateur',
  `created_at` datetime NOT NULL COMMENT 'date de création du compte utilisateur',
  `updated_at` datetime NOT NULL COMMENT 'date de la dernière modification des information du compte'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `type`, `created_at`, `updated_at`) VALUES
('19M001', 'admin', 'pt_YdDpw2I2fx5C6jRVb_UTRB1m7GUpJ', '$2y$13$QRy.is3.9l3uAm3.Qj6H4eAMwoafUlyhMbXwsf1dEnNLwZ6MXs0kq', 'TXIRJDr5H-D2LQyxPaR_cSpB9vMKL-xC_1546711297', 'bbatchakui@gmail.com', 10, 1, '2019-01-05 19:01:37', '2019-01-05 19:01:37');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `annee_UNIQUE` (`id`),
  ADD UNIQUE KEY `identity` (`year`,`month`);

--
-- Index pour la table `help`
--
ALTER TABLE `help`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identity` (`matricule_member`,`id_session`,`id`),
  ADD KEY `fk_aide_session1_idx` (`id_session`),
  ADD KEY `fk_aide_membre1_idx` (`matricule_member`);

--
-- Index pour la table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identity` (`matricule_member`,`id_session`),
  ADD KEY `fk_emprunt_session1_idx` (`id_session`),
  ADD KEY `fk_emprunt_membre1_idx` (`matricule_member`);

--
-- Index pour la table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`matricule`),
  ADD UNIQUE KEY `identity` (`firstname`,`lastname`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `matricule_UNIQUE` (`matricule`),
  ADD UNIQUE KEY `telephone_UNIQUE` (`phone`);

--
-- Index pour la table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`matricule_member`),
  ADD KEY `fk_inscription_membre1_idx` (`matricule_member`);

--
-- Index pour la table `repayment`
--
ALTER TABLE `repayment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identity` (`id_session`,`id_loan`),
  ADD KEY `fk_remboursement_session1_idx` (`id_session`),
  ADD KEY `fk_remboursement_emprunt1_idx` (`id_loan`);

--
-- Index pour la table `saving`
--
ALTER TABLE `saving`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identity` (`matricule_member`,`id_session`),
  ADD KEY `fk_epargne_membre_idx` (`matricule_member`),
  ADD KEY `fk_epargne_session1_idx` (`id_session`);

--
-- Index pour la table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `date__UNIQUE` (`date_`),
  ADD KEY `fk_session_exercice1_idx` (`id_exercise`);

--
-- Index pour la table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_exercise`),
  ADD KEY `fk_parametre_exercice1_idx` (`id_exercise`);

--
-- Index pour la table `socialbackground`
--
ALTER TABLE `socialbackground`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identity` (`id_session`,`matricule_member`),
  ADD KEY `fk_secours_membre1_idx` (`matricule_member`),
  ADD KEY `fk_secours_session1_idx` (`id_session`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD KEY `fk_compte_membre1_idx` (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `exercise`
--
ALTER TABLE `exercise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Correspond a l''année de l''exercice';

--
-- AUTO_INCREMENT pour la table `help`
--
ALTER TABLE `help`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `repayment`
--
ALTER TABLE `repayment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `saving`
--
ALTER TABLE `saving`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'numéro de la session';

--
-- AUTO_INCREMENT pour la table `socialbackground`
--
ALTER TABLE `socialbackground`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `help`
--
ALTER TABLE `help`
  ADD CONSTRAINT `fk_aide_membre1` FOREIGN KEY (`matricule_member`) REFERENCES `member` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_aide_session1` FOREIGN KEY (`id_session`) REFERENCES `session` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `fk_emprunt_membre1` FOREIGN KEY (`matricule_member`) REFERENCES `member` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_emprunt_session1` FOREIGN KEY (`id_session`) REFERENCES `session` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `fk_inscription_membre1` FOREIGN KEY (`matricule_member`) REFERENCES `member` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `repayment`
--
ALTER TABLE `repayment`
  ADD CONSTRAINT `fk_remboursement_emprunt1` FOREIGN KEY (`id_loan`) REFERENCES `loan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_remboursement_session1` FOREIGN KEY (`id_session`) REFERENCES `session` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `saving`
--
ALTER TABLE `saving`
  ADD CONSTRAINT `fk_epargne_membre` FOREIGN KEY (`matricule_member`) REFERENCES `member` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_epargne_session1` FOREIGN KEY (`id_session`) REFERENCES `session` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `fk_session_exercice1` FOREIGN KEY (`id_exercise`) REFERENCES `exercise` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `setting`
--
ALTER TABLE `setting`
  ADD CONSTRAINT `fk_parametre_exercice1` FOREIGN KEY (`id_exercise`) REFERENCES `exercise` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `socialbackground`
--
ALTER TABLE `socialbackground`
  ADD CONSTRAINT `fk_secours_membre1` FOREIGN KEY (`matricule_member`) REFERENCES `member` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_secours_session1` FOREIGN KEY (`id_session`) REFERENCES `session` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_compte_membre1` FOREIGN KEY (`id`) REFERENCES `member` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
