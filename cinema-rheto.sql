-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql:3306
-- Généré le : jeu. 25 avr. 2024 à 19:14
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cinema-rheto`
--

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE `films` (
  `id` int NOT NULL,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `votes` int NOT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `classe` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`id`, `titre`, `votes`, `image`, `classe`) VALUES
(1, 'Américan Nightmare', 8, '/assets/img/AffichesDeFilms/la_purge.webp', '1er'),
(2, 'Le Paquet', 28, '/assets/img/AffichesDeFilms/lepaquet.webp', '1er'),
(3, 'Very Bad Trip', 13, '/assets/img/AffichesDeFilms/verybadtrip.webp', '1er'),
(4, 'Américan Nightmare', 11, '/assets/img/AffichesDeFilms/la_purge.webp', '3ème'),
(5, 'Le Paquet', 8, '/assets/img/AffichesDeFilms/lepaquet.webp', '3ème'),
(7, 'Scream', 27, '/assets/img/AffichesDeFilms/scream.webp', '2ème'),
(8, 'Le Labyrinthe 1', 21, '/assets/img/AffichesDeFilms/labyrinthe.webp', '2ème'),
(9, 'alibi.com', 3, '/assets/img/AffichesDeFilms/alibi.com.webp', '2ème'),
(11, 'jumanji', 39, '/assets/img/AffichesDeFilms/jumanji.webp', '4ème'),
(12, 'Scream', 26, '/assets/img/AffichesDeFilms/scream.webp', '4ème'),
(13, 'Le Labyrinthe 1', 3, '/assets/img/AffichesDeFilms/labyrinthe.webp', '4ème'),
(20, 'alibi.com', 11, '/assets/img/AffichesDeFilms/alibi.com.webp', '3ème');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `films`
--
ALTER TABLE `films`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
