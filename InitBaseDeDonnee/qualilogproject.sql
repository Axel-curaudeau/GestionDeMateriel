-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 09 déc. 2022 à 13:07
-- Version du serveur : 5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `qualilogproject`
--

-- --------------------------------------------------------

--
-- Structure de la table `WL_Equipment`
--

CREATE TABLE `WL_Equipment` (
  `Reference` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Version` varchar(255) NOT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `WL_Reservation`
--

CREATE TABLE `WL_Reservation` (
  `ReservationID` int(11) NOT NULL,
  `BeginDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `UserID` int(11) NOT NULL,
  `Reference` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `WL_Users`
--

CREATE TABLE `WL_Users` (
  `UserID` int(11) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Mail` varchar(255) DEFAULT NULL,
  `RegistrationNumber` char(7) DEFAULT NULL,
  `Pswd` varchar(255) DEFAULT NULL,
  `IsAdmin` tinyint(1) DEFAULT NULL,
  `ResetPswd` varchar(255) DEFAULT NULL,
  `LastResetPswd` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `WL_Users`
--

INSERT INTO `WL_Users` (`UserID`, `FirstName`, `LastName`, `Mail`, `RegistrationNumber`, `Pswd`, `IsAdmin`, `ResetPswd`, `LastResetPswd`) VALUES
(1, 'Thomas', 'Raymond', 'thomas.raymond240@icloud.com', NULL, '$2y$10$Jm1N45fvxaVQ0B7m6lPqSO5ohqzEHT3ASyCj4tomqqx5J7WC7.0KW', NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `WL_Equipment`
--
ALTER TABLE `WL_Equipment`
  ADD PRIMARY KEY (`Reference`);

--
-- Index pour la table `WL_Reservation`
--
ALTER TABLE `WL_Reservation`
  ADD PRIMARY KEY (`ReservationID`),
  ADD KEY `Reference` (`Reference`),
  ADD KEY `UserID` (`UserID`);

--
-- Index pour la table `WL_Users`
--
ALTER TABLE `WL_Users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `WL_Reservation`
--
ALTER TABLE `WL_Reservation`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `WL_Users`
--
ALTER TABLE `WL_Users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `WL_Reservation`
--
ALTER TABLE `WL_Reservation`
  ADD CONSTRAINT `wl_reservation_ibfk_1` FOREIGN KEY (`Reference`) REFERENCES `WL_Equipment` (`Reference`),
  ADD CONSTRAINT `wl_reservation_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `WL_Users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
