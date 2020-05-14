-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 17 fév. 2020 à 09:50
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fjrcinema`
--

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE `films` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `synopsis` text NOT NULL,
  `duree` varchar(20) NOT NULL,
  `realisateur` varchar(50) NOT NULL,
  `acteurs` text NOT NULL,
  `affiche` text NOT NULL,
  `b_annonce` varchar(50) NOT NULL,
  `mise_en_avant` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`id`, `titre`, `synopsis`, `duree`, `realisateur`, `acteurs`, `affiche`, `b_annonce`, `mise_en_avant`) VALUES
(49, 'Avengers', 'Nick Fury, le directeur du S.H.I.E.L.D., l\'organis...', '3 heures 20', 'Joss Whedon', 'Robert Downey Jr. Chris Evans Mark Ruffalo', 'bt.png', 'wV-Q0o2OQjQ', 4),
(50, 'Escobar', 'Impitoyable et cruel chef du cartel de Medellin, P...', '2 heures 30', 'Fernando León de Aranoa', 'Javier Bardem, Penélope Cruz, Peter Sarsgaard', 'film4.png', 'ltngHWsbiYc', 4),
(51, 'Joker', 'Dans les années 1980, à Gotham City, Arthur Fleck,...', '1 heure 45', 'Todd Phillips', 'Joaquin Phoenix Robert De Niro Zazie Beetz Frances Conroy', 'film3.png', 'OoTx1cYC5u8', 5),
(52, 'Manhattan', 'Isaac Davis est un auteur de sketches comiques new...', '1 heure 45', 'Castelano le jongleur', 'Woody Allen', 'film5.png', 'yt3cGMqtqyA', 2),
(54, 'Kin le commencement', 'Eli, jeune adolescent de Detroit, erre dans une usine désaffectée où il découvre par hasard une arme surpuissante, d\'origine inconnue, qu\'il ramène chez lui. Passé l\'amusement, Eli réalise qu\'on ne soustrait pas impunément une arme aussi redoutable : il se retrouve recherché par des criminels, par le FBI, et par ceux qui semblent être les propriétaires légitimes de l\'arme futuriste.', '2 heures 30', 'Josh Baker, Jonathan Baker', 'James Franco, Zoë Kravitz, Dennis Quaid, Jack Rey', 'film2.jpg', 'GZk_2326r4', 3);

-- --------------------------------------------------------

--
-- Structure de la table `formulaire`
--

CREATE TABLE `formulaire` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `messages` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `note` int(11) NOT NULL,
  `id_film` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `formulaire`
--

INSERT INTO `formulaire` (`id`, `name`, `messages`, `email`, `note`, `id_film`) VALUES
(1, 'toto', 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm', 'toto@live.fr', 2, 2),
(2, 'toto', 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm', 'toto@live.fr', 3, 1),
(3, 'toto', 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm', 'toto@live.fr', 3, 1),
(4, 'toto', 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm', 'toto@live.fr', 3, 1),
(5, 'toto', 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm', 'toto@live.fr', 3, 1),
(6, 'toto', 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm', 'toto@live.fr', 3, 1),
(7, 'mes couilles', 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'test@test.com', 3, 1),
(8, 'doudou', 'mzkljdfazlkbnazmljfmazbcmazljfzmaknflazkbn', 'fabien@fabien.com', 3, 51),
(9, 'doudou', 'mzkljdfazlkbnazmljfmazbcmazljfzmaknflazkbn', 'fabien@fabien.com', 3, 51),
(10, 'doudou', 'mzkljdfazlkbnazmljfmazbcmazljfzmaknflazkbn', 'fabien@fabien.com', 3, 51),
(11, 'doudou', 'mzkljdfazlkbnazmljfmazbcmazljfzmaknflazkbn', 'fabien@fabien.com', 3, 51),
(12, 'doudou', 'mzkljdfazlkbnazmljfmazbcmazljfzmaknflazkbn', 'fabien@fabien.com', 3, 51),
(13, 'doudou', 'mzkljdfazlkbnazmljfmazbcmazljfzmaknflazkbn', 'fabien@fabien.com', 3, 51),
(14, 'doudou', 'mzkljdfazlkbnazmljfmazbcmazljfzmaknflazkbn', 'fabien@fabien.com', 3, 51),
(15, 'doudou', 'mzkljdfazlkbnazmljfmazbcmazljfzmaknflazkbn', 'fabien@fabien.com', 3, 51),
(16, 'doudou', 'mzkljdfazlkbnazmljfmazbcmazljfzmaknflazkbn', 'fabien@fabien.com', 3, 51),
(17, 'doudou', 'mzkljdfazlkbnazmljfmazbcmazljfzmaknflazkbn', 'fabien@fabien.com', 3, 51),
(18, 'doudou', 'mzkljdfazlkbnazmljfmazbcmazljfzmaknflazkbn', 'fabien@fabien.com', 3, 51),
(19, 'doudou', 'mzkljdfazlkbnazmljfmazbcmazljfzmaknflazkbn', 'fabien@fabien.com', 3, 51);

-- --------------------------------------------------------

--
-- Structure de la table `planningouverture`
--

CREATE TABLE `planningouverture` (
  `id` int(11) NOT NULL,
  `jours` text NOT NULL,
  `ouverture` varchar(20) NOT NULL,
  `fermeture` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `planningouverture`
--

INSERT INTO `planningouverture` (`id`, `jours`, `ouverture`, `fermeture`) VALUES
(1, 'Lundi', '10 H 30', '02 H 00'),
(2, 'Mardi', '10 H 30', '02 H 00'),
(3, 'Mercredi', '10 H 30', '02 H 00'),
(4, 'Jeudi', '10 H 30', '02 H 00'),
(5, 'Vendredi', '10 H 30', '03 H 00'),
(6, 'Samedi', '10 H 30', '03 H 00'),
(7, 'Dimanche', '10 H 30', '21 H 00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `register_date` datetime NOT NULL,
  `password` varchar(255) NOT NULL,
  `access` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `register_date`, `password`, `access`) VALUES
(1, 'testing', 'testing@test.com', '2020-01-27 16:41:10', '$2y$10$n4N1gfWmz/wLavZXYxIBEuEoaROZ07ztCRFjO87RoYAeEc0w08h7.', ''),
(2, 'fabien', 'dedieufabien@gmail.com', '2020-01-27 16:54:32', '$2y$10$sY288mxx5h2/q48IhckIHOYrHrx.hmcGZ7hP3Lg83U4BdqYq.CtJq', 'admin'),
(3, 'aaaaaaa', 'testing2@test.com', '2020-01-28 16:44:53', '$2y$10$GtuHNtLxC0e500mddb19Q.6cd5hSIra7KHNCny4Uc1x8A62b0/BN2', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `formulaire`
--
ALTER TABLE `formulaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `planningouverture`
--
ALTER TABLE `planningouverture`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `films`
--
ALTER TABLE `films`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `formulaire`
--
ALTER TABLE `formulaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `planningouverture`
--
ALTER TABLE `planningouverture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
