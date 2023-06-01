-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 01 juin 2023 à 09:53
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `proj_ap`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories_questions`
--

CREATE TABLE `categories_questions` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `auteur_id` int(11) NOT NULL,
  `date_creation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories_questions`
--

INSERT INTO `categories_questions` (`id`, `titre`, `description`, `auteur_id`, `date_creation`) VALUES
(1, 'histoire géo', 'questions sur l\'histoire', 3, '1648644405'),
(2, 'maths', 'questions sur les maths', 3, '1648644418'),
(3, 'anglais', 'questions sur l\'anglais', 3, '1648644658'),
(4, 'francais', 'questions sur le francais', 3, '1648646722'),
(5, 'slam', 'questions sur le slam', 3, '1648647387'),
(6, 'sisr', 'questions sur le sisr', 3, '1649226902'),
(7, 'eps', 'questions sur l\'eps', 3, '1649226961'),
(8, 'Culture G', 'Questions relatives &agrave; la culture g&eacute;n&eacute;rale', 3, '1649252082');

-- --------------------------------------------------------

--
-- Structure de la table `categories_test`
--

CREATE TABLE `categories_test` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `auteur_id` int(11) NOT NULL,
  `date_creation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories_test`
--

INSERT INTO `categories_test` (`id`, `titre`, `description`, `auteur_id`, `date_creation`) VALUES
(1, 'culture g 1', 'categ 1 de test', 3, '1648646731'),
(2, 'culture g 2', 'categ 2 de test', 3, '1649226860'),
(3, 'culture g 3', 'categ 3 de test', 3, '1649226945'),
(4, 'culture g 4', 'categ 4 de test', 3, '1649238792');

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

CREATE TABLE `parametres` (
  `nom_site` text NOT NULL,
  `meta_data` text NOT NULL,
  `version` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `parametres`
--

INSERT INTO `parametres` (`nom_site`, `meta_data`, `version`) VALUES
('Tests en ligne', 'form data referencement', '1.0');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `intitule` text NOT NULL,
  `propositions` text NOT NULL,
  `reponses` text NOT NULL,
  `format` int(11) NOT NULL,
  `niveau` int(11) NOT NULL,
  `categorie` int(11) NOT NULL,
  `auteur_id` int(11) NOT NULL,
  `date_creation` text NOT NULL,
  `date_modification` text NOT NULL,
  `valeur_pts` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `intitule`, `propositions`, `reponses`, `format`, `niveau`, `categorie`, `auteur_id`, `date_creation`, `date_modification`, `valeur_pts`) VALUES
(3, 'En combien d\'ann&eacute;es se fait le BTS NISR?', '[\"1 an\",\"2 ans\",\"3 ans\"]', '[\"1\"]', 0, 1, 2, 3, '1649250176', '1649250176', 9),
(12, 'En combien d\'ann&eacute;es se fait le BTS com?', '[\"1 an\",\"2 ans\",\"3 ans\"]', '[\"1\"]', 1, 1, 2, 3, '1649250196', '1649250196', 9),
(13, 'En combien d\'ann&eacute;es se fait le BTS MCO?', '[\"1 an\",\"2 ans\",\"3 ans\"]', '[\"1\"]', 1, 1, 1, 3, '1649251348', '1649251348', 666),
(14, 'calcul de la surface', '[\"lxL\", \"l²\"]', '[\"0\"]', 0, 3, 1, 3, '1649251439', '1649251439', 5),
(15, '4 - 2 = ?', '[\"2\",\"0\"]', '[\"0\"]', 0, 3, 1, 3, '1649251562', '1649251562', 5),
(16, '1 + 1 = ?', '[\"2\",\"0\"]', '[\"0\"]', 0, 3, 1, 3, '1649251633', '1649251633', 5),
(17, 'En combien d\'ann&eacute;es se fait le BTS SIO ?', '[\"1 an\",\"2 ans\",\"3 ans\"]', '[\"1\"]', 2, 0, 8, 3, '1649252370', '1649252370', 5);

-- --------------------------------------------------------

--
-- Structure de la table `tentatives`
--

CREATE TABLE `tentatives` (
  `id` int(11) NOT NULL,
  `auteur_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `tentative_no` int(11) NOT NULL,
  `reponses` text NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tentatives`
--

INSERT INTO `tentatives` (`id`, `auteur_id`, `test_id`, `tentative_no`, `reponses`, `note`) VALUES
(11, 3, 2, 1, '[{\"questionId\":\"3\",\"reponses\":[\"superbe proposition 1\"]},{\"questionId\":\"17\",\"reponses\":[\"1\",\"2\"]}]', ''),
(13, 3, 1, 1, '[{\"questionId\":\"3\",\"reponses\":[\"llllllllllll\"]},{\"questionId\":\"12\",\"reponses\":[\"0\"]},{\"questionId\":\"14\",\"reponses\":[\"bleu\"]},{\"questionId\":\"17\",\"reponses\":[\"1\"]}]', '');

-- --------------------------------------------------------

--
-- Structure de la table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `temps` text NOT NULL,
  `date_max` text NOT NULL,
  `date_creation` text NOT NULL,
  `date_publish` text NOT NULL,
  `tentatives` text NOT NULL,
  `questions` text NOT NULL,
  `publication` text NOT NULL,
  `categorie` text NOT NULL,
  `auteur` text NOT NULL,
  `arrondi_note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tests`
--

INSERT INTO `tests` (`id`, `titre`, `description`, `temps`, `date_max`, `date_creation`, `date_publish`, `tentatives`, `questions`, `publication`, `categorie`, `auteur`, `arrondi_note`) VALUES
(1, 'super test', 'super testsuper testsuper test', '10', '1951098150', '1649845393', '1649845393', '2', '[\"12\",\"14\",\"3\",\"17\"]', '1', '1', '1', '20'),
(2, 'svce', 'lol lol mdr mdr mdr mdr mdr', '20', '1658098150', '1649845393', '1649845393', '2', '[\"3\",\"17\"]', '1', '2', '3', '10');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` char(10) NOT NULL,
  `passwd` varchar(300) NOT NULL,
  `role` int(11) NOT NULL,
  `nom_public` varchar(60) NOT NULL,
  `date_creation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `phone`, `passwd`, `role`, `nom_public`, `date_creation`) VALUES
(1, 'test123', 'prenom123', 'povibiw882@kyrescu.com', '0558789546', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, 'prenom123 test123', '1648016428'),
(2, 'parmm', 'maxime', 't@s.fr', '0552459866', 'f7cb0cf88d8c5a41c1615bf3df53f69a508926e001d55379803d702325000eeae4e4f8006a2c338ec1a180832baf7da392a7b464999f05cba9705416065facc93c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 0, 'maxime parmm', '1648017601'),
(3, 'parmm', 'maxime2', 'a@b.Fr', '0578987456', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 0, 'maxime2 parmm', '1648018316');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories_questions`
--
ALTER TABLE `categories_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorieQuest_userId` (`auteur_id`);

--
-- Index pour la table `categories_test`
--
ALTER TABLE `categories_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorieTest_userId` (`auteur_id`);

--
-- Index pour la table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_userId` (`auteur_id`);

--
-- Index pour la table `tentatives`
--
ALTER TABLE `tentatives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tentative_userId` (`auteur_id`),
  ADD KEY `tentative_testId` (`test_id`);

--
-- Index pour la table `tests`
--
ALTER TABLE `tests`
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
-- AUTO_INCREMENT pour la table `categories_questions`
--
ALTER TABLE `categories_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `categories_test`
--
ALTER TABLE `categories_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `tentatives`
--
ALTER TABLE `tentatives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categories_questions`
--
ALTER TABLE `categories_questions`
  ADD CONSTRAINT `categorieQuest_userId` FOREIGN KEY (`auteur_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `categories_test`
--
ALTER TABLE `categories_test`
  ADD CONSTRAINT `categorieTest_userId` FOREIGN KEY (`auteur_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `question_userId` FOREIGN KEY (`auteur_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `tentatives`
--
ALTER TABLE `tentatives`
  ADD CONSTRAINT `tentative_testId` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`),
  ADD CONSTRAINT `tentative_userId` FOREIGN KEY (`auteur_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
