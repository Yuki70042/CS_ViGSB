-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 02:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vigsb`
--

-- --------------------------------------------------------

--
-- Table structure for table `date_visite`
--

CREATE TABLE `date_visite` (
  `date_du_jour` date NOT NULL,
  `heure_du_rdv` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `date_visite`
--

INSERT INTO `date_visite` (`date_du_jour`, `heure_du_rdv`) VALUES
('0000-00-00', '13:30:00'),
('2025-01-20', '13:30:00'),
('2025-01-21', '14:23:00'),
('2025-01-23', '14:00:00'),
('2025-02-19', '09:46:00'),
('2025-02-19', '19:30:00'),
('2025-02-20', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `delegue_regional`
--

CREATE TABLE `delegue_regional` (
  `id_salarie` int(11) NOT NULL,
  `id_region` int(11) NOT NULL,
  `id_secteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delegue_regional`
--

INSERT INTO `delegue_regional` (`id_salarie`, `id_region`, `id_secteur`) VALUES
(4, 1, 1),
(26, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `medicaments`
--

CREATE TABLE `medicaments` (
  `id_medicament` int(11) NOT NULL,
  `prix` decimal(15,2) NOT NULL,
  `designation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicaments`
--

INSERT INTO `medicaments` (`id_medicament`, `prix`, `designation`) VALUES
(1, 10.99, 'Doliprane'),
(4, 3.99, 'Medoc_Test'),
(6, 2.18, 'Dafalgan');

-- --------------------------------------------------------

--
-- Table structure for table `professionnels_de_sante`
--

CREATE TABLE `professionnels_de_sante` (
  `id_pds` int(11) NOT NULL,
  `nom_pds` varchar(255) NOT NULL,
  `prenom_pds` varchar(255) NOT NULL,
  `age_pds` int(11) NOT NULL,
  `metier` varchar(255) NOT NULL,
  `adresse_pds` varchar(255) NOT NULL,
  `CP_pds` int(11) NOT NULL,
  `ville_pds` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professionnels_de_sante`
--

INSERT INTO `professionnels_de_sante` (`id_pds`, `nom_pds`, `prenom_pds`, `age_pds`, `metier`, `adresse_pds`, `CP_pds`, `ville_pds`) VALUES
(1, 'pdstest2', 'pdstest', 35, 'testeurMedoc', '1 rue du Medecin', 123456, 'TestLand'),
(2, 'pdstest', 'pdstest', 40, 'testeurMedoc', '1 rue du Medecin', 123456, 'TestLand'),
(8, 'Churlet', 'Florent', 156, 'Technicien de Santé', '56 rue alphonse de Rochas', 90000, 'Belfort');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id_region` int(11) NOT NULL,
  `id_secteur` int(11) NOT NULL,
  `libelle_region` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id_region`, `id_secteur`, `libelle_region`) VALUES
(1, 1, 'Belfort'),
(2, 1, 'Haut-Rhin'),
(3, 2, 'Bas-Rhin');

-- --------------------------------------------------------

--
-- Table structure for table `responsable_secteur`
--

CREATE TABLE `responsable_secteur` (
  `id_salarie` int(11) NOT NULL,
  `id_secteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responsable_secteur`
--

INSERT INTO `responsable_secteur` (`id_salarie`, `id_secteur`) VALUES
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `salarie`
--

CREATE TABLE `salarie` (
  `id_salarie` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `type_utilisateur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salarie`
--

INSERT INTO `salarie` (`id_salarie`, `nom`, `prenom`, `email`, `mot_de_passe`, `age`, `adresse`, `type_utilisateur`) VALUES
(1, 'administrateur', 'admin', 'root@vigsb.fr', 'root', 100, '3 rue du root Rootwiller', 'admin'),
(2, 'visiteur', 'visiteur', 'visiteur@vigsb.fr', 'visiteur', 20, '3 rue du visiteur Normalviller 00000', 'visiteur'),
(4, 'delegue_regional', 'delegue_regional', 'delegueregional@vigsb.fr', 'region', 49, '57 rue du Delegue Regional', 'delegue'),
(6, 'secteur', 'secteur', 'secteur@vigsb.fr', 'secteur', 34, '6 rue du secteur du Bois', 'responsable'),
(15, 'nom_test2', 'prenom_test', 'test@vigsb.fr', 'test', 50, '24 RUE DE MULHOUSE', 'visiteur'),
(16, 'Meyer', 'Jan', 'janmeyer@vigsb.fr', 'jan', 19, '46 RUE DE MULHOUSE', 'visiteur'),
(18, 'visiteursecteur', 'visiteursecteur', 'visiteursecteur@vigsb.fr', 'mdp', 18, '6 rue du test', 'visiteur'),
(26, 'nouveauDeg', 'NouveauDeg', 'nouveaudef@vigsb.fr', 'mdp', 19, '3 du Nouveau', 'delegue'),
(28, 'Blanca', 'Liz', 'lizblanca@vigsb.fr', 'Mot2PasseMerde', 19, '11 Rue du Vicomte de Turenne', 'visiteur');

-- --------------------------------------------------------

--
-- Table structure for table `secteur`
--

CREATE TABLE `secteur` (
  `id_secteur` int(11) NOT NULL,
  `libelle_secteur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `secteur`
--

INSERT INTO `secteur` (`id_secteur`, `libelle_secteur`) VALUES
(1, 'Nord-Est'),
(2, 'Sud-Ouest'),
(3, 'Ile-de-France');

-- --------------------------------------------------------

--
-- Table structure for table `visiter`
--

CREATE TABLE `visiter` (
  `date_du_jour` date NOT NULL,
  `id_medicament` int(11) NOT NULL,
  `id_pds` int(11) NOT NULL,
  `id_salarie` int(11) NOT NULL,
  `commentaire` text DEFAULT NULL,
  `validation` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visiter`
--

INSERT INTO `visiter` (`date_du_jour`, `id_medicament`, `id_pds`, `id_salarie`, `commentaire`, `validation`) VALUES
('2025-01-21', 1, 2, 2, 'Test d\'un compte-rendu', 1),
('2025-01-23', 1, 2, 16, 'Je rédige mon compte-rendu', 1),
('2025-02-19', 1, 2, 2, 'Ceci est le compte-rendu à valider pour tester ma fonctionnalité', 1),
('2025-02-19', 4, 2, 2, '', 0),
('2025-02-20', 4, 8, 28, 'J\'ai présenté le Médicament de test à Monsieur Florent Churlet.\r\nCelui-ci semblait enthousiaste à l\'idée de cette nouvelle méthode.\r\nUn échantillon de 5 pièces lui a été confié.\r\nEn attente de son retour dans les deux semaines à venir.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `visiteur`
--

CREATE TABLE `visiteur` (
  `id_salarie` int(11) NOT NULL,
  `id_region` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visiteur`
--

INSERT INTO `visiteur` (`id_salarie`, `id_region`) VALUES
(2, 1),
(15, 1),
(16, 1),
(28, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `date_visite`
--
ALTER TABLE `date_visite`
  ADD PRIMARY KEY (`date_du_jour`,`heure_du_rdv`);

--
-- Indexes for table `delegue_regional`
--
ALTER TABLE `delegue_regional`
  ADD PRIMARY KEY (`id_salarie`,`id_region`,`id_secteur`),
  ADD KEY `id_region` (`id_region`),
  ADD KEY `id_secteur` (`id_secteur`);

--
-- Indexes for table `medicaments`
--
ALTER TABLE `medicaments`
  ADD PRIMARY KEY (`id_medicament`),
  ADD KEY `idx_designation_medicament` (`designation`);

--
-- Indexes for table `professionnels_de_sante`
--
ALTER TABLE `professionnels_de_sante`
  ADD PRIMARY KEY (`id_pds`),
  ADD KEY `idx_nom_pds` (`nom_pds`),
  ADD KEY `idx_prenom_pds` (`prenom_pds`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id_region`),
  ADD KEY `id_secteur` (`id_secteur`);

--
-- Indexes for table `responsable_secteur`
--
ALTER TABLE `responsable_secteur`
  ADD PRIMARY KEY (`id_salarie`,`id_secteur`),
  ADD KEY `id_secteur` (`id_secteur`);

--
-- Indexes for table `salarie`
--
ALTER TABLE `salarie`
  ADD PRIMARY KEY (`id_salarie`),
  ADD KEY `idx_nom_salarie` (`nom`),
  ADD KEY `idx_prenom_salarie` (`prenom`);

--
-- Indexes for table `secteur`
--
ALTER TABLE `secteur`
  ADD PRIMARY KEY (`id_secteur`);

--
-- Indexes for table `visiter`
--
ALTER TABLE `visiter`
  ADD PRIMARY KEY (`date_du_jour`,`id_medicament`,`id_pds`,`id_salarie`),
  ADD KEY `id_medicament` (`id_medicament`),
  ADD KEY `id_pds` (`id_pds`),
  ADD KEY `id_salarie` (`id_salarie`);

--
-- Indexes for table `visiteur`
--
ALTER TABLE `visiteur`
  ADD PRIMARY KEY (`id_salarie`),
  ADD KEY `fk_visiteur_region` (`id_region`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicaments`
--
ALTER TABLE `medicaments`
  MODIFY `id_medicament` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `professionnels_de_sante`
--
ALTER TABLE `professionnels_de_sante`
  MODIFY `id_pds` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salarie`
--
ALTER TABLE `salarie`
  MODIFY `id_salarie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `secteur`
--
ALTER TABLE `secteur`
  MODIFY `id_secteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delegue_regional`
--
ALTER TABLE `delegue_regional`
  ADD CONSTRAINT `delegue_regional_ibfk_1` FOREIGN KEY (`id_salarie`) REFERENCES `salarie` (`id_salarie`) ON DELETE CASCADE,
  ADD CONSTRAINT `delegue_regional_ibfk_2` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`) ON DELETE CASCADE,
  ADD CONSTRAINT `delegue_regional_ibfk_3` FOREIGN KEY (`id_secteur`) REFERENCES `secteur` (`id_secteur`) ON DELETE CASCADE;

--
-- Constraints for table `responsable_secteur`
--
ALTER TABLE `responsable_secteur`
  ADD CONSTRAINT `responsable_secteur_ibfk_1` FOREIGN KEY (`id_salarie`) REFERENCES `salarie` (`id_salarie`) ON DELETE CASCADE,
  ADD CONSTRAINT `responsable_secteur_ibfk_2` FOREIGN KEY (`id_secteur`) REFERENCES `secteur` (`id_secteur`) ON DELETE CASCADE;

--
-- Constraints for table `visiter`
--
ALTER TABLE `visiter`
  ADD CONSTRAINT `visiter_ibfk_1` FOREIGN KEY (`date_du_jour`) REFERENCES `date_visite` (`date_du_jour`) ON DELETE CASCADE,
  ADD CONSTRAINT `visiter_ibfk_2` FOREIGN KEY (`id_medicament`) REFERENCES `medicaments` (`id_medicament`) ON DELETE CASCADE,
  ADD CONSTRAINT `visiter_ibfk_3` FOREIGN KEY (`id_pds`) REFERENCES `professionnels_de_sante` (`id_pds`) ON DELETE CASCADE,
  ADD CONSTRAINT `visiter_ibfk_4` FOREIGN KEY (`id_salarie`) REFERENCES `visiteur` (`id_salarie`) ON DELETE CASCADE;

--
-- Constraints for table `visiteur`
--
ALTER TABLE `visiteur`
  ADD CONSTRAINT `fk_visiteur_region` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`),
  ADD CONSTRAINT `visiteur_ibfk_1` FOREIGN KEY (`id_salarie`) REFERENCES `salarie` (`id_salarie`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
