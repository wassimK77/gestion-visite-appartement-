-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 20 mars 2025 à 13:49
-- Version du serveur : 8.0.36
-- Version de PHP : 8.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `location`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartements`
--

CREATE TABLE `appartements` (
  `NUMAPPART` int NOT NULL,
  `RUE` varchar(50) DEFAULT NULL,
  `ARRONDISSE` varchar(50) DEFAULT NULL,
  `ETAGE` int DEFAULT NULL,
  `PRIX_LOC` decimal(15,2) DEFAULT NULL,
  `PRIX_CHARG` decimal(15,2) DEFAULT NULL,
  `ASCENSEUR` tinyint(1) DEFAULT NULL,
  `PREAVIS` tinyint(1) DEFAULT NULL,
  `DATE_LIBRE` date DEFAULT NULL,
  `NUMEROPROP` int NOT NULL,
  `PAYS` varchar(255) NOT NULL,
  `VILLE` varchar(255) NOT NULL,
  `REGION` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `appartements`
--

INSERT INTO `appartements` (`NUMAPPART`, `RUE`, `ARRONDISSE`, `ETAGE`, `PRIX_LOC`, `PRIX_CHARG`, `ASCENSEUR`, `PREAVIS`, `DATE_LIBRE`, `NUMEROPROP`, `PAYS`, `VILLE`, `REGION`) VALUES
(1, ' 8 rue petite', '15', 2, 500.00, 150.00, 1, 2, '2024-12-12', 3, 'France', 'Vaudoy-en-Brie', 'Ile-De-France\r\n'),
(2, '25 rue des jeuneurs', '15', 4, 150.00, 20.00, 2, 3, '2024-10-09', 1245, 'France', 'Bordeaux', 'Nouvelle-Aquitaine'),
(26, 'rue des boulets', '03', 2, 250.00, 50.00, 1, 1, '2024-04-23', 661514754, 'France', 'Paris', 'Ile-De-France'),
(29, 'rue ptite', '01', 1, 100.00, 100.00, 1, 1, '2025-02-25', 661514754, 'france', 'vaudoy-en-brie', 'Ile-De-France');

-- --------------------------------------------------------

--
-- Structure de la table `arrondissement`
--

CREATE TABLE `arrondissement` (
  `ARRONDISS_DEM` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `NUM_CLI` int NOT NULL,
  `NOM_CLI` varchar(50) DEFAULT NULL,
  `PRENOM_CLI` varchar(50) DEFAULT NULL,
  `ADRESSE_CLI` varchar(50) DEFAULT NULL,
  `CODEVILLE_CLI` varchar(50) DEFAULT NULL,
  `TEL_CLI` varchar(50) DEFAULT NULL,
  `login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`NUM_CLI`, `NOM_CLI`, `PRENOM_CLI`, `ADRESSE_CLI`, `CODEVILLE_CLI`, `TEL_CLI`, `login`, `mdp`) VALUES
(37, 'kaouachi', 'wassim', '8 TER rue petite', '77141', '0661514754', 'wassim77', '$2y$10$IxjBGdWo4/8XViXy29Wxc.u/VODCwiZlzjnPJVuTD.GdjLHmTJ4Wq'),
(39, 'kaouachi', 'iliass', '8 TER rue petite', '77141', '0661514754', 'iliass771', '$2y$10$JCMu02tUbUOzfs.NXBP5bu/03.0CctiQcZYSu1nUE.MAPmH02Nkr.'),
(38, 'kaouachi', 'isam', '8 TER rue petite', '77141', '0661514754', 'isam77', '$2y$10$9eP3xeArf8xyJ5tqc1Z/oOSbXwrBXiyj5kfJLON/uW12O.jRIdxaW'),
(50, 'kaouachi', 'wassim', '8 ter rue petite', '77141', '0661514754', 'exemple', '$2y$10$cxTvnyQuuKWmk5Fus3aqYemgDvC/5fiTsFdHuhNKzWVjOfHS7WEGe'),
(43, 'kaouachi', 'sabah', '8 TER rue petite', '77141', '0661514754', 'sabah la plus belle', '$2y$10$6ZQMP988Uvog5bGvyMT9/OBDcjqDjfHzxFqg4aTf8X18Px9GzH5wq'),
(45, 'synn', 'synn', '8 TER rue petite', '77141', '0661514754', 'synn11', '$2y$10$61z7lBGQNowZFW.Tx2yUc.9IqFmTeg6p0uwn9/LsHrQcZKMmgDUuq'),
(47, 'monNom', 'monPrénom', '8 TER rue petite', '77141', '0661514754', 'userTest', '$2y$10$BHU/CJLsdsaWXI2P6QmC1eAgnyM6fNA7axnnA1l7BTGMY0pRegeK.'),
(48, 'abeille', 'isaura', '5 allé des frenes', '77141', '06 ', 'isau', '$2y$10$EfbSS/g.TPZPE9Qtrgco/eJFgvS.Pqy/KWoEPRW7AitkE4Hk89HZG');

-- --------------------------------------------------------

--
-- Structure de la table `concerner`
--

CREATE TABLE `concerner` (
  `NUM_DEM` int NOT NULL,
  `ARRONDISS_DEM` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `locataires`
--

CREATE TABLE `locataires` (
  `NUMEROLOC` int NOT NULL,
  `NOM_LOC` varchar(50) DEFAULT NULL,
  `PRENOM_LOC` varchar(50) DEFAULT NULL,
  `DATENAISS` date DEFAULT NULL,
  `TEL_LOC` varchar(50) DEFAULT NULL,
  `R_I_B` int DEFAULT NULL,
  `TEL_BANQUE` varchar(50) DEFAULT NULL,
  `NUMAPPART` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `maison`
--

CREATE TABLE `maison` (
  `NUM_MAISON` int NOT NULL,
  `RUE` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ARRONDISSE` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ETAGE` int NOT NULL,
  `PRIX_LOC` decimal(10,2) NOT NULL,
  `PRIX_CHARG` decimal(10,2) NOT NULL,
  `PREAVIS` tinyint NOT NULL,
  `DATE_LIBRE` date NOT NULL,
  `NUMEROPROP` int NOT NULL,
  `JARDIN` tinyint(1) NOT NULL,
  `SUPERFICIE` int NOT NULL,
  `PISCINE` tinyint(1) NOT NULL,
  `GARAGE` tinyint(1) NOT NULL,
  `PAYS` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `VILLE` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `REGION` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `maison`
--

INSERT INTO `maison` (`NUM_MAISON`, `RUE`, `ARRONDISSE`, `ETAGE`, `PRIX_LOC`, `PRIX_CHARG`, `PREAVIS`, `DATE_LIBRE`, `NUMEROPROP`, `JARDIN`, `SUPERFICIE`, `PISCINE`, `GARAGE`, `PAYS`, `VILLE`, `REGION`) VALUES
(1, 'rue turbigot', '03', 2, 159.00, 20.00, 2, '2024-05-11', 661514754, 1, 150, 1, 0, 'France', 'Paris', 'Ile-De-France'),
(2, 'allé des frenes', '01', 1, 5000.00, 1000.00, 12, '2024-12-23', 142, 1, 150, 1, 1, 'france', 'chanteloup', 'Ile-De-France');

-- --------------------------------------------------------

--
-- Structure de la table `proprietaires`
--

CREATE TABLE `proprietaires` (
  `NUMEROPROP` int NOT NULL,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(50) DEFAULT NULL,
  `ADRESSE` varchar(50) DEFAULT NULL,
  `CODE_VILLE` varchar(50) DEFAULT NULL,
  `TEL` varchar(50) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `mdp` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `proprietaires`
--

INSERT INTO `proprietaires` (`NUMEROPROP`, `NOM`, `PRENOM`, `ADRESSE`, `CODE_VILLE`, `TEL`, `login`, `mdp`) VALUES
(1, 'test', 'test', '8 TER rue petite', '77141', '0661514754', 'proprio1', '$2y$10$pDWM/R49gImLzxADKnz1kOyKfCgIqXOqZTz244eosEjz1XlJBXr/i'),
(2, 'kaouachi', 'wassim', '8 TER rue petite', '77141', '0661514754', 'philippe62', '$2y$10$mIEREWxc3Qzm4n.prPU.n.dkLgEzt/WzDVqO6vPpDO.pSnTmfZinm'),
(3, 'abeille', 'denis', 'chez moi', '77', '1', 'denisdu77', '$2y$10$uym.c6lwEiP6zWralJrS/OVQbufYXFTgXKXFGAQmxPCjKh3bTOWzC');

-- --------------------------------------------------------

--
-- Structure de la table `visiter`
--

CREATE TABLE `visiter` (
  `NUMAPPART` int NOT NULL,
  `NUM_CLI` int NOT NULL,
  `DATE_VISITE` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appartements`
--
ALTER TABLE `appartements`
  ADD PRIMARY KEY (`NUMAPPART`),
  ADD KEY `NUMEROPROP` (`NUMEROPROP`);

--
-- Index pour la table `arrondissement`
--
ALTER TABLE `arrondissement`
  ADD PRIMARY KEY (`ARRONDISS_DEM`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`NUM_CLI`);

--
-- Index pour la table `concerner`
--
ALTER TABLE `concerner`
  ADD PRIMARY KEY (`NUM_DEM`,`ARRONDISS_DEM`),
  ADD KEY `ARRONDISS_DEM` (`ARRONDISS_DEM`);

--
-- Index pour la table `locataires`
--
ALTER TABLE `locataires`
  ADD PRIMARY KEY (`NUMEROLOC`),
  ADD UNIQUE KEY `NUMAPPART` (`NUMAPPART`);

--
-- Index pour la table `maison`
--
ALTER TABLE `maison`
  ADD PRIMARY KEY (`NUM_MAISON`);

--
-- Index pour la table `proprietaires`
--
ALTER TABLE `proprietaires`
  ADD PRIMARY KEY (`NUMEROPROP`);

--
-- Index pour la table `visiter`
--
ALTER TABLE `visiter`
  ADD PRIMARY KEY (`NUMAPPART`,`NUM_CLI`),
  ADD KEY `NUM_CLI` (`NUM_CLI`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appartements`
--
ALTER TABLE `appartements`
  MODIFY `NUMAPPART` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `arrondissement`
--
ALTER TABLE `arrondissement`
  MODIFY `ARRONDISS_DEM` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `NUM_CLI` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `locataires`
--
ALTER TABLE `locataires`
  MODIFY `NUMEROLOC` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `maison`
--
ALTER TABLE `maison`
  MODIFY `NUM_MAISON` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `proprietaires`
--
ALTER TABLE `proprietaires`
  MODIFY `NUMEROPROP` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
