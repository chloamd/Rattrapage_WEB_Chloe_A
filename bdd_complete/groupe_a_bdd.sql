-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 05 avr. 2024 à 07:39
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `groupe a bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `acquerir`
--

CREATE TABLE `acquerir` (
  `id_etudiant` int(11) NOT NULL,
  `id_competence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `acquerir`
--

INSERT INTO `acquerir` (`id_etudiant`, `id_competence`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(4, 6),
(4, 7);

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id_administrateur` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `id_compte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id_administrateur`, `nom`, `prenom`, `id_compte`) VALUES
(1, 'administrateur', 'numéro_1', 1),
(2, 'administrateur', 'numéro_2', 2);

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE `adresse` (
  `id_adresse` int(11) NOT NULL,
  `nom_rue` varchar(50) NOT NULL,
  `id_centre` int(11) DEFAULT NULL,
  `numero_de_siret` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id_adresse`, `nom_rue`, `id_centre`, `numero_de_siret`) VALUES
(1, '401 Av. de Boufflers', NULL, 10),
(2, '2-6 Av. de la Résistance', NULL, 11),
(3, '3 Rue du Saintois', NULL, 12);

-- --------------------------------------------------------

--
-- Structure de la table `appartenir`
--

CREATE TABLE `appartenir` (
  `id_adresse` int(11) NOT NULL,
  `id_ville` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `appartenir`
--

INSERT INTO `appartenir` (`id_adresse`, `id_ville`) VALUES
(1, 2),
(2, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `centre`
--

CREATE TABLE `centre` (
  `id_centre` int(11) NOT NULL,
  `nom_centre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `centre`
--

INSERT INTO `centre` (`id_centre`, `nom_centre`) VALUES
(1, 'Nancy'),
(2, 'Strasbourg');

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

CREATE TABLE `competences` (
  `id_competence` int(11) NOT NULL,
  `nom_competence` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `competences`
--

INSERT INTO `competences` (`id_competence`, `nom_competence`) VALUES
(1, 'HTML'),
(2, 'CSS'),
(3, 'JavaScript'),
(4, 'SQL'),
(5, 'PHP'),
(6, 'Pathologie du béton'),
(7, ' Mécanique des fluides');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id_compte` int(11) NOT NULL,
  `email_pro` varchar(100) NOT NULL,
  `mot_de_passe` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id_compte`, `email_pro`, `mot_de_passe`) VALUES
(1, 'admin1@admin.fr', '$2y$10$.b1gTXT5Q1.IltL0dM60r.qLjhNJgIwm9RPQ8C631qNKhYPMKtIz6'),
(2, 'admin2@admin.fr', '$2y$10$zxjdcsde75kTrEi.pbnu6.HxMF25LMppCfj.iPWrR6b4uWKYBTx8W'),
(3, 'clement.evangelisti@viacesi.fr', '$2y$10$DwmMGdLh45fPvx1vZ3vereKUok/miqq08LddULdf6X2qT4bOlXgc.'),
(4, 'chloe.armand@viacesi.fr', '$2y$10$o12gH2Uhy5Z/55CcMsFhCegDwzVAFlG5J.kQ0GHXpERDxvsjo94b2'),
(5, 'isra.boudemagh@viacesi.fr', '$2y$10$rAg2l2FPt8NdgUdcaMgdcuZdKIQZAXK4JD7QkTRAikiNaQAHrvnMu'),
(8, 'jeanlou.boughon@viacesi.fr', '$2y$10$CoylT2cii6VwgZBWKd1jVe/1aWN22MYOfu.XPQlb//IAxvaVa90Qi'),
(9, 'alexis.robert@viacesi.fr', '$2y$10$0P7RPY7Ip5orvWz9Wt2CL.tElmC6zFncfeBoSGjKArxo0rnLKcveK'),
(10, 'noah.trebujais@viacesi.fr', '$2y$10$HlyhyTbMntdj.t.GpN/HRef36PjVBu/uYv.5aDbTTRutJkB.RfV9S'),
(11, 'safaa.elyaagoubi@viacesi.fr', '$2y$10$4f4eL/9t76SQGgqFNSvnXeYfyVLxUm2cedTx75QIrdOIJGQ/D1bNi'),
(12, 'baptiste.husson@viacesi.fr', '$2y$10$e1mAwMoqYxXhEBEcq7.WxuFKrifT8stBgD138L/hSoQLyNd4w02Xy'),
(13, 'arthur.bergbauer@viacesi.fr', '$2y$10$3XeTJHk0N6TZhq/eh6HphuJN6IAA2gqsPGLRzjAAuYPE3q8cPC6mC'),
(14, 'liam.legin@viacesi.fr', '$2y$10$Ko9TsDondGrMIHUYBbVNF.UoaXJqGE8ZtzF3oknQphD0xehkSXmqO'),
(15, 'izaidi@cesi.fr', '$2y$10$kqSU3X/qQcXMUAXf1o1T2eqaJrkXCfqaI/Sl.WwE1.P4PqRI5KFhy'),
(16, 'slamige@cesi.fr', '$2y$10$VDSPi4vEvvFU4DlpJSYA7OBmwz1UX2jFdwvIZ0MT6Pdc6ZJUGnfkG');

-- --------------------------------------------------------

--
-- Structure de la table `demander`
--

CREATE TABLE `demander` (
  `id_stage` int(11) NOT NULL,
  `id_competence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id_enseignant` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `id_compte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id_enseignant`, `nom`, `prenom`, `id_compte`) VALUES
(1, 'Zaidi', 'Imene', 15);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `numero_de_siret` int(11) NOT NULL,
  `nom_entreprise` varchar(50) NOT NULL,
  `logo` varchar(500) DEFAULT NULL,
  `etat_entreprise` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`numero_de_siret`, `nom_entreprise`, `logo`, `etat_entreprise`) VALUES
(10, 'Grand Frais', NULL, 1),
(11, 'Renault', NULL, 1),
(12, 'MG Motor', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etudiant` int(11) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `id_compte` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etudiant`, `prenom`, `nom`, `id_compte`) VALUES
(1, 'Clément', 'Evangelisti', 3),
(2, 'Chloé', 'Armand', 4),
(3, 'Arthur', 'Bergbauer', 13),
(4, 'Jean Lou', 'Boughon', 8);


--
-- Déchargement des données de la table `etudiant`
--

ALTER TABLE `etudiant` ADD `is_deleted` `is_deleted` TINYINT(1) NULL DEFAULT '0';

-- --------------------------------------------------------

--
-- Structure de la table `etudier`
--

CREATE TABLE `etudier` (
  `id_etudiant` int(11) NOT NULL,
  `id_promotion` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudier`
--

INSERT INTO `etudier` (`id_etudiant`, `id_promotion`, `date_debut`, `date_fin`) VALUES
(1, 1, '2023-09-25', '2024-07-26'),
(2, 1, '2023-09-25', '2024-07-26'),
(3, 1, '2023-09-25', '2024-07-26'),
(4, 1, '2023-09-25', '2024-07-26');

-- --------------------------------------------------------

--
-- Structure de la table `evaluer`
--

CREATE TABLE `evaluer` (
  `numero_de_siret` int(11) NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  `note_etu` int(11) NOT NULL,
  `commentaire` varchar(50) DEFAULT NULL,
  `date_eval_etu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `interagir`
--

CREATE TABLE `interagir` (
  `id_etudiant` int(11) NOT NULL,
  `id_stage` int(11) NOT NULL,
  `lettre_motivation` varchar(50) DEFAULT NULL,
  `etat_wish_list` tinyint(1) NOT NULL,
  `cv` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `piloter`
--

CREATE TABLE `piloter` (
  `id_enseignant` int(11) NOT NULL,
  `id_promotion` int(11) NOT NULL,
  `date_debut_ens` date NOT NULL,
  `date_fin_ens` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `piloter`
--

INSERT INTO `piloter` (`id_enseignant`, `id_promotion`, `date_debut_ens`, `date_fin_ens`) VALUES
(1, 1, '2023-09-25', '2024-07-26');

-- --------------------------------------------------------

--
-- Structure de la table `posseder`
--

CREATE TABLE `posseder` (
  `numero_de_siret` int(11) NOT NULL,
  `id_secteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `posseder`
--

INSERT INTO `posseder` (`numero_de_siret`, `id_secteur`) VALUES
(10, 1),
(11, 12),
(12, 12);

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `id_promotion` int(11) NOT NULL,
  `nom_promotion` varchar(50) NOT NULL,
  `specialite` varchar(50) NOT NULL,
  `id_centre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`id_promotion`, `nom_promotion`, `specialite`, `id_centre`) VALUES
(1, 'A2', 'Informatique', 1),
(2, 'A2', 'Généraliste', 1);

-- --------------------------------------------------------

--
-- Structure de la table `secteurs_activites`
--

CREATE TABLE `secteurs_activites` (
  `id_secteur` int(11) NOT NULL,
  `nom_secteur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `secteurs_activites`
--

INSERT INTO `secteurs_activites` (`id_secteur`, `nom_secteur`) VALUES
(1, 'Agroalimentaire'),
(2, 'Banque Assurance'),
(3, 'Bois Papier Carton Imprimerie'),
(4, 'BTP Matériaux de construction'),
(5, 'Chimie Parachimie'),
(6, 'Commerce Négoce Distribution'),
(7, 'Édition Communication Multimédia'),
(8, 'Électronique Électricité'),
(9, 'Études et conseils'),
(10, 'Industrie pharmaceutique'),
(11, 'Informatique Télécoms'),
(12, 'Machines et équipements Automobile'),
(13, 'Métallurgie Travail du métal'),
(14, 'Plastique Caoutchouc'),
(15, 'Services aux entreprises'),
(16, 'Textile Habillement Chaussure'),
(17, 'Transports Logistique');

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

CREATE TABLE `stage` (
  `id_stage` int(11) NOT NULL,
  `intitule` varchar(100) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `duree_stage` varchar(50) NOT NULL,
  `remuneration` int(11) NOT NULL,
  `nombre_places` int(11) NOT NULL,
  `type_de_promo` varchar(50) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `statut_offre` tinyint(1) NOT NULL DEFAULT 1,
  `id_adresse` int(11) NOT NULL,
  `numero_de_siret` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `id_ville` int(11) NOT NULL,
  `nom_ville` varchar(50) NOT NULL,
  `code_postal` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id_ville`, `nom_ville`, `code_postal`) VALUES
(2, 'Laxou', 54520),
(3, 'Vandœuvre-lès-Nancy', 54500),
(4, 'Andilly', 54200);

-- --------------------------------------------------------

--
-- Structure de la table `_evaluer_`
--

CREATE TABLE `_evaluer_` (
  `numero_de_siret` int(11) NOT NULL,
  `id_enseignant` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `commentaire` varchar(50) DEFAULT NULL,
  `date_eval` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acquerir`
--
ALTER TABLE `acquerir`
  ADD PRIMARY KEY (`id_etudiant`,`id_competence`),
  ADD KEY `acquerir_ibfk_2` (`id_competence`);

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id_administrateur`),
  ADD UNIQUE KEY `id_compte` (`id_compte`);

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id_adresse`),
  ADD KEY `adresse_ibfk_1` (`id_centre`),
  ADD KEY `adresse_ibfk_2` (`numero_de_siret`);

--
-- Index pour la table `appartenir`
--
ALTER TABLE `appartenir`
  ADD PRIMARY KEY (`id_adresse`,`id_ville`),
  ADD KEY `appartenir_ibfk_2` (`id_ville`);

--
-- Index pour la table `centre`
--
ALTER TABLE `centre`
  ADD PRIMARY KEY (`id_centre`);

--
-- Index pour la table `competences`
--
ALTER TABLE `competences`
  ADD PRIMARY KEY (`id_competence`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id_compte`);

--
-- Index pour la table `demander`
--
ALTER TABLE `demander`
  ADD PRIMARY KEY (`id_stage`,`id_competence`),
  ADD KEY `demander_ibfk_2` (`id_competence`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id_enseignant`),
  ADD UNIQUE KEY `id_compte` (`id_compte`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`numero_de_siret`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etudiant`),
  ADD UNIQUE KEY `id_compte` (`id_compte`);

--
-- Index pour la table `etudier`
--
ALTER TABLE `etudier`
  ADD PRIMARY KEY (`id_etudiant`,`id_promotion`),
  ADD KEY `etudier_ibfk_2` (`id_promotion`);

--
-- Index pour la table `evaluer`
--
ALTER TABLE `evaluer`
  ADD PRIMARY KEY (`numero_de_siret`,`id_etudiant`),
  ADD KEY `evaluer_ibfk_2` (`id_etudiant`);

--
-- Index pour la table `interagir`
--
ALTER TABLE `interagir`
  ADD PRIMARY KEY (`id_etudiant`,`id_stage`),
  ADD KEY `interagir_ibfk_2` (`id_stage`);

--
-- Index pour la table `piloter`
--
ALTER TABLE `piloter`
  ADD PRIMARY KEY (`id_enseignant`,`id_promotion`),
  ADD KEY `piloter_ibfk_2` (`id_promotion`);

--
-- Index pour la table `posseder`
--
ALTER TABLE `posseder`
  ADD PRIMARY KEY (`numero_de_siret`,`id_secteur`),
  ADD KEY `posseder_ibfk_2` (`id_secteur`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id_promotion`),
  ADD KEY `promotion_ibfk_1` (`id_centre`);

--
-- Index pour la table `secteurs_activites`
--
ALTER TABLE `secteurs_activites`
  ADD PRIMARY KEY (`id_secteur`);

--
-- Index pour la table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`id_stage`),
  ADD KEY `stage_ibfk_1` (`id_adresse`),
  ADD KEY `stage_ibfk_2` (`numero_de_siret`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`id_ville`);

--
-- Index pour la table `_evaluer_`
--
ALTER TABLE `_evaluer_`
  ADD PRIMARY KEY (`numero_de_siret`,`id_enseignant`),
  ADD KEY `_evaluer__ibfk_2` (`id_enseignant`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id_administrateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id_adresse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `centre`
--
ALTER TABLE `centre`
  MODIFY `id_centre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `competences`
--
ALTER TABLE `competences`
  MODIFY `id_competence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id_enseignant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `numero_de_siret` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etudiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id_promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `secteurs_activites`
--
ALTER TABLE `secteurs_activites`
  MODIFY `id_secteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `stage`
--
ALTER TABLE `stage`
  MODIFY `id_stage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `id_ville` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `acquerir`
--
ALTER TABLE `acquerir`
  ADD CONSTRAINT `acquerir_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `acquerir_ibfk_2` FOREIGN KEY (`id_competence`) REFERENCES `competences` (`id_competence`);

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `administrateur_ibfk_1` FOREIGN KEY (`id_compte`) REFERENCES `compte` (`id_compte`);

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`id_centre`) REFERENCES `centre` (`id_centre`),
  ADD CONSTRAINT `adresse_ibfk_2` FOREIGN KEY (`numero_de_siret`) REFERENCES `entreprise` (`numero_de_siret`);

--
-- Contraintes pour la table `appartenir`
--
ALTER TABLE `appartenir`
  ADD CONSTRAINT `appartenir_ibfk_1` FOREIGN KEY (`id_adresse`) REFERENCES `adresse` (`id_adresse`),
  ADD CONSTRAINT `appartenir_ibfk_2` FOREIGN KEY (`id_ville`) REFERENCES `ville` (`id_ville`);

--
-- Contraintes pour la table `demander`
--
ALTER TABLE `demander`
  ADD CONSTRAINT `demander_ibfk_1` FOREIGN KEY (`id_stage`) REFERENCES `stage` (`id_stage`),
  ADD CONSTRAINT `demander_ibfk_2` FOREIGN KEY (`id_competence`) REFERENCES `competences` (`id_competence`);

--
-- Contraintes pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD CONSTRAINT `enseignant_ibfk_1` FOREIGN KEY (`id_compte`) REFERENCES `compte` (`id_compte`);

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`id_compte`) REFERENCES `compte` (`id_compte`);

--
-- Contraintes pour la table `etudier`
--
ALTER TABLE `etudier`
  ADD CONSTRAINT `etudier_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `etudier_ibfk_2` FOREIGN KEY (`id_promotion`) REFERENCES `promotion` (`id_promotion`);

--
-- Contraintes pour la table `evaluer`
--
ALTER TABLE `evaluer`
  ADD CONSTRAINT `evaluer_ibfk_1` FOREIGN KEY (`numero_de_siret`) REFERENCES `entreprise` (`numero_de_siret`),
  ADD CONSTRAINT `evaluer_ibfk_2` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`);

--
-- Contraintes pour la table `interagir`
--
ALTER TABLE `interagir`
  ADD CONSTRAINT `interagir_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `interagir_ibfk_2` FOREIGN KEY (`id_stage`) REFERENCES `stage` (`id_stage`);

--
-- Contraintes pour la table `piloter`
--
ALTER TABLE `piloter`
  ADD CONSTRAINT `piloter_ibfk_1` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignant` (`id_enseignant`),
  ADD CONSTRAINT `piloter_ibfk_2` FOREIGN KEY (`id_promotion`) REFERENCES `promotion` (`id_promotion`);

--
-- Contraintes pour la table `posseder`
--
ALTER TABLE `posseder`
  ADD CONSTRAINT `posseder_ibfk_1` FOREIGN KEY (`numero_de_siret`) REFERENCES `entreprise` (`numero_de_siret`),
  ADD CONSTRAINT `posseder_ibfk_2` FOREIGN KEY (`id_secteur`) REFERENCES `secteurs_activites` (`id_secteur`);

--
-- Contraintes pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD CONSTRAINT `promotion_ibfk_1` FOREIGN KEY (`id_centre`) REFERENCES `centre` (`id_centre`);

--
-- Contraintes pour la table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `stage_ibfk_1` FOREIGN KEY (`id_adresse`) REFERENCES `adresse` (`id_adresse`),
  ADD CONSTRAINT `stage_ibfk_2` FOREIGN KEY (`numero_de_siret`) REFERENCES `entreprise` (`numero_de_siret`);

--
-- Contraintes pour la table `_evaluer_`
--
ALTER TABLE `_evaluer_`
  ADD CONSTRAINT `_evaluer__ibfk_1` FOREIGN KEY (`numero_de_siret`) REFERENCES `entreprise` (`numero_de_siret`),
  ADD CONSTRAINT `_evaluer__ibfk_2` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignant` (`id_enseignant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;