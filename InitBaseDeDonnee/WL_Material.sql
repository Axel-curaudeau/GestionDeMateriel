-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 02 déc. 2022 à 03:29
-- Version du serveur : 10.3.36-MariaDB-0+deb10u2
-- Version de PHP : 7.3.31-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `thoma1981418`
--

-- --------------------------------------------------------

--
-- Structure de la table `WL_Material`
--

CREATE TABLE `WL_Material` (
  `MaterialId` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Version` varchar(50) DEFAULT NULL,
  `Reference` varchar(50) DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `WL_Material`
--
ALTER TABLE `WL_Material`
  ADD PRIMARY KEY (`MaterialId`),
  ADD KEY `UserId` (`UserId`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `WL_Material`
--
ALTER TABLE `WL_Material`
  ADD CONSTRAINT `WL_Material_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `WL_Users` (`UserId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
