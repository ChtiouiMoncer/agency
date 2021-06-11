-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 14 mars 2020 à 22:00
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.2.27
CREATE DATABASE MONCER;
USE MONCER;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `agency`
--

-- --------------------------------------------------------

--
-- Structure de la table `housing`
--

CREATE TABLE `housing` (
  `id` int(11) NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `medical_city`
--

CREATE TABLE `medical_city` (
  `id` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200311121104', '2020-03-11 12:11:22'),
('20200311150052', '2020-03-11 15:02:12'),
('20200311154531', '2020-03-11 15:45:46');

-- --------------------------------------------------------

--
-- Structure de la table `patient_informations`
--

CREATE TABLE `patient_informations` (
  `id` int(11) NOT NULL,
  `housing_id` int(11) DEFAULT NULL,
  `specialisation_id` int(11) DEFAULT NULL,
  `tourisme_region_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) DEFAULT NULL,
  `sexe` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `demande` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `patient_informations`
--

INSERT INTO `patient_informations` (`id`, `housing_id`, `specialisation_id`, `tourisme_region_id`, `name`, `age`, `sexe`, `country`, `phone`, `email`, `demande`) VALUES
(1, NULL, NULL, NULL, 'ADNEN', NULL, NULL, 'AL', 98248526, 'malek.laatiri73@gmail.com', 'labes 3lyh'),
(2, NULL, NULL, NULL, 'Mamia', NULL, NULL, 'TN', 55434783, 'mamiamarwen1996@gmail.com', 'mridh');

-- --------------------------------------------------------

--
-- Structure de la table `specialisation`
--

CREATE TABLE `specialisation` (
  `id` int(11) NOT NULL,
  `spec` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tourisme_region`
--

CREATE TABLE `tourisme_region` (
  `id` int(11) NOT NULL,
  `medical_city_id` int(11) DEFAULT NULL,
  `arrival_date` date NOT NULL,
  `estimate_period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guide` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `housing`
--
ALTER TABLE `housing`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `medical_city`
--
ALTER TABLE `medical_city`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `patient_informations`
--
ALTER TABLE `patient_informations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_89C53BB7AD5873E3` (`housing_id`),
  ADD KEY `IDX_89C53BB75627D44C` (`specialisation_id`),
  ADD KEY `IDX_89C53BB79FA2126B` (`tourisme_region_id`);

--
-- Index pour la table `specialisation`
--
ALTER TABLE `specialisation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tourisme_region`
--
ALTER TABLE `tourisme_region`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_86EDC08ACDAE8261` (`medical_city_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `housing`
--
ALTER TABLE `housing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `medical_city`
--
ALTER TABLE `medical_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `patient_informations`
--
ALTER TABLE `patient_informations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `specialisation`
--
ALTER TABLE `specialisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tourisme_region`
--
ALTER TABLE `tourisme_region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `patient_informations`
--
ALTER TABLE `patient_informations`
  ADD CONSTRAINT `FK_89C53BB75627D44C` FOREIGN KEY (`specialisation_id`) REFERENCES `specialisation` (`id`),
  ADD CONSTRAINT `FK_89C53BB79FA2126B` FOREIGN KEY (`tourisme_region_id`) REFERENCES `tourisme_region` (`id`),
  ADD CONSTRAINT `FK_89C53BB7AD5873E3` FOREIGN KEY (`housing_id`) REFERENCES `housing` (`id`);

--
-- Contraintes pour la table `tourisme_region`
--
ALTER TABLE `tourisme_region`
  ADD CONSTRAINT `FK_86EDC08ACDAE8261` FOREIGN KEY (`medical_city_id`) REFERENCES `medical_city` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
