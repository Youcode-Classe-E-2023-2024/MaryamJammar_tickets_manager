-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 20 déc. 2023 à 12:24
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tickets`
--

-- --------------------------------------------------------

--
-- Structure de la table `assignation`
--

CREATE TABLE `assignation` (
  `user_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `assignation`
--

INSERT INTO `assignation` (`user_id`, `ticket_id`) VALUES
(2, 17),
(1, 18),
(2, 18),
(3, 18),
(2, 19),
(3, 19),
(1, 20),
(1, 21),
(2, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `content` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `date_comment` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `statut_id` int(11) NOT NULL,
  `nom_statut` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`statut_id`, `nom_statut`) VALUES
(1, 'To do'),
(2, 'Doing'),
(3, 'Done');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL,
  `tag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`tag_id`, `tag`) VALUES
(1, 'Bug'),
(2, 'Documentation'),
(3, 'Duplication'),
(4, 'Help wanted'),
(5, 'Amélioration'),
(6, 'Questions');

-- --------------------------------------------------------

--
-- Structure de la table `tagg`
--

CREATE TABLE `tagg` (
  `ticket_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tagg`
--

INSERT INTO `tagg` (`ticket_id`, `tag_id`) VALUES
(18, 2),
(18, 3),
(18, 4),
(19, 5),
(19, 6),
(20, 4),
(21, 4),
(31, 6),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `statut` varchar(50) NOT NULL,
  `priority` varchar(50) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `title`, `description`, `statut`, `priority`, `date_creation`, `created_by`) VALUES
(10, 'teyuiop^$', 'defghjklm', '', 'CA', '2023-12-19 19:16:59', 1),
(11, 'teyuiop^$', 'defghjklm', '', 'CA', '2023-12-19 19:23:13', 3),
(12, 'teyuiop^$', 'defghjklm', '', 'CA', '2023-12-19 19:23:54', 3),
(13, 'teyuiop^$', 'defghjklm', '', 'CA', '2023-12-19 19:27:54', 3),
(14, 'teyuiop^$', 'defghjklm', '', 'CA', '2023-12-19 19:32:38', 3),
(15, 'teyuiop^$', 'defghjklm', '', 'CA', '2023-12-19 19:33:08', 3),
(16, 'teyuiop^$', 'defghjklm', '', 'CA', '2023-12-19 19:33:46', 3),
(17, 'teyuiop^$', 'defghjklm', '', 'CA', '2023-12-19 19:36:00', 3),
(18, 'teyuiop^$', 'defghjklm', '', 'CA', '2023-12-19 19:38:23', 3),
(19, 'hellllllllo', 'heeeeeeeeeeeeeeelllllllllllllloooooooooooooooooooo', '', 'Normal', '2023-12-19 22:44:47', 3),
(20, 'heellllo', 'hellllllllllllllllllllllllllllllllllllllllooooooooooenjkbzbdjdnakindkj', '', 'Urgent', '2023-12-19 22:55:56', 3),
(21, 'heellllo', 'hellllllllllllllllllllllllllllllllllllllllooooooooooenjkbzbdjdnakindkj', '', 'Urgent', '2023-12-19 22:58:34', 3),
(22, 'Hello ', 'helllllllllllllllllllllllllllllllooooooooooooooooooooooooooooooooooooo', 'Doing', 'Urgent', '2023-12-19 23:00:41', 3),
(23, 'qqqqqqqqqqqqqqqqqq', 'qsjjjjjjjjjjjjjjjjjjjjjzdjdddddddddddddddddddddddddddd', 'Todo', 'Normal', '2023-12-19 23:04:45', 3),
(24, 'salam', 'salaaaaaaaaaaaaaaaaaaaaaaaamm', 'Todo', 'Urgent', '2023-12-19 23:08:16', 3),
(25, 'salam', 'salaaaaaaaaaaaaaaaaaaaaaaaamm', 'Todo', 'Urgent', '2023-12-19 23:08:19', 3),
(26, 'aaaaaaaaaaaazert', 'aaaaaaaaaaaadfghjkljhgfcgvbn,', 'Todo', 'Urgent', '2023-12-19 23:16:30', 3),
(27, 'azert', 'azertyuiopuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu', 'Todo', 'Normal', '2023-12-19 23:23:34', 2),
(28, 'ccccccccccccccccccccccccc', 'ccccczejnejffjzfnkjfzejnfjzefkfnzf;jsqcwxc, wsjk jdzdzkdjdznk', 'Todo', 'Normal', '2023-12-19 23:25:35', 2),
(29, 'test', 'testtttttttttttttttttttttttttttttt', 'Todo', 'Urgent', '2023-12-20 08:49:03', 2),
(30, 'test', 'testtttttttttttttttttttttttttttttt', 'Todo', 'Urgent', '2023-12-20 09:08:42', 2),
(31, 'test', 'testtttttttttttttttttttttttttttttt', 'Todo', 'Urgent', '2023-12-20 09:18:44', 2),
(32, 'test', 'testtttttttttttttttttttttttttttt', 'Todo', 'Urgent', '2023-12-20 10:25:11', 2),
(33, 'test', 'testtttttttttttttttttttttttttttt', 'Todo', 'Urgent', '2023-12-20 10:25:47', 2),
(34, 'test', 'testtttttttttttttttttttttttttttt', 'Todo', 'Urgent', '2023-12-20 10:25:58', 2),
(35, 'test', 'testtttttttttttttttttttttttttttt', 'Todo', 'Urgent', '2023-12-20 10:26:29', 2),
(36, 'test', 'testtttttttttttttttttttttttttttt', 'Todo', 'Urgent', '2023-12-20 10:26:35', 2),
(37, 'test', 'testtttttttttttttttttttttttttttt', 'Todo', 'Urgent', '2023-12-20 10:26:49', 2),
(38, 'test', 'testtttttttttttttttttttttttttttt', 'Todo', 'Urgent', '2023-12-20 10:27:06', 2),
(39, 'test', 'testtttttttttttttttttttttttttttt', 'Todo', 'Urgent', '2023-12-20 10:27:21', 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pwd` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `profile`, `fullname`, `email`, `pwd`) VALUES
(1, 'profil maryam.jpg', 'a a', 'a@gmail.com', '$2y$10$BS6GzgKtXgDtNRC/Pyu68OI9DfEmPxldINK8M9PNSN4vgX6dS4EZC'),
(2, '1701693372avatar8.jpg', 'anass anass', 'anass@gmail.com', '$2y$10$4T8gbiUtiWdGuzPF/d7ZH.OG9ItboLEcP3wHq3B6Fk5sUpnUx4WcG'),
(3, '1701771972blog22.jpg', 'ana ss', 'maryama@gmail.com', '$2y$10$5PjFNc0P52HtZ8Dh9.L7GeAg.kDH4v9pZ3EcrweKPrfAnhOPILFhO');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `assignation`
--
ALTER TABLE `assignation`
  ADD KEY `fk_assignation_users` (`user_id`) USING BTREE,
  ADD KEY `fk_assignation_tickets` (`ticket_id`) USING BTREE;

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`statut_id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- Index pour la table `tagg`
--
ALTER TABLE `tagg`
  ADD KEY `fk_tagg_tag` (`tag_id`),
  ADD KEY `fk_tag_tickets` (`ticket_id`) USING BTREE;

--
-- Index pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `statut_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `assignation`
--
ALTER TABLE `assignation`
  ADD CONSTRAINT `assignation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `assignation_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`),
  ADD CONSTRAINT `fk_assignation_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`),
  ADD CONSTRAINT `fk_assignation_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`);

--
-- Contraintes pour la table `tagg`
--
ALTER TABLE `tagg`
  ADD CONSTRAINT `fk_tag_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`),
  ADD CONSTRAINT `fk_tagg_tag` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`),
  ADD CONSTRAINT `tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_id` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
