-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 14 mars 2024 à 14:05
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `materials_management`
--

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

CREATE TABLE `materiel` (
  `numMateriel` int(5) NOT NULL,
  `design` varchar(50) DEFAULT NULL,
  `etat` varchar(30) NOT NULL,
  `quantite` int(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`numMateriel`, `design`, `etat`, `quantite`) VALUES
(10001, 'Ordinateur portable', 'BON', 256),
(10002, 'Imprimante laser', 'MAUVAIS', 348),
(10003, 'Projecteur vidéo', 'BON', 214),
(10004, 'Scanner de documents', 'ABIME', 120),
(10005, 'Casque audio sans fil', 'BON', 493),
(10006, 'Souris optique', 'ABIME', 78),
(10007, 'Clavier ergonomique', 'BON', 844),
(10008, 'Écran LCD', 'MAUVAIS', 929),
(10009, 'Routeur Wi-Fi', 'BON', 764),
(10010, 'Webcam HD', 'ABIME', 56),
(10011, 'Téléphone IP', 'BON', 372),
(10012, 'Tablette graphique', 'ABIME', 601),
(10013, 'Disque dur externe', 'BON', 247),
(10014, 'Enceinte Bluetooth', 'MAUVAIS', 840),
(10015, 'Lampe de bureau LED', 'BON', 698),
(10016, 'Câble HDMI', 'ABIME', 409),
(10017, 'Adaptateur USB-C', 'BON', 221),
(10018, 'Carte mémoire SD', 'MAUVAIS', 17),
(10019, 'Batterie externe', 'BON', 592),
(10020, 'Câble Ethernet', 'ABIME', 991),
(11000, 'Écran tactile', 'BON', 752),
(11001, 'Câble DisplayPort', 'BON', 150),
(11002, 'Chargeur de téléphone', 'ABIME', 100),
(11003, 'Câble audio jack', 'MAUVAIS', 200),
(11004, 'Imprimante jet d\'encre', 'BON', 50),
(11005, 'Disque SSD', 'BON', 80),
(11006, 'Webcam HD', 'ABIME', 75);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD PRIMARY KEY (`numMateriel`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `numMateriel` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11007;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
