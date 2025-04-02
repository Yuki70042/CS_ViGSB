-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2025 at 03:18 PM
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
('2025-04-11', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `delegue_regional`
--

CREATE TABLE `delegue_regional` (
  `id_salarie` int(11) NOT NULL,
  `id_region` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delegue_regional`
--

INSERT INTO `delegue_regional` (`id_salarie`, `id_region`) VALUES
(4, 48),
(35, 68),
(36, 72),
(37, 121);

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
(7, 4.99, 'Paracétamol 500mg'),
(8, 7.50, 'Ibuprofène 400mg'),
(9, 12.30, 'Amoxicilline 500mg'),
(10, 5.20, 'Aspirine 100mg'),
(11, 8.99, 'Oméprazole 20mg'),
(12, 15.75, 'Cétirizine 10mg'),
(13, 9.45, 'Loratadine 10mg'),
(14, 18.60, 'Médrol 16mg'),
(15, 22.99, 'Salbutamol 100mcg'),
(16, 30.50, 'Insuline rapide'),
(17, 25.99, 'Metformine 850mg'),
(18, 19.75, 'Atorvastatine 10mg'),
(19, 14.25, 'Simvastatine 20mg'),
(20, 6.80, 'Dafalgan 500mg'),
(21, 27.40, 'Losartan 50mg'),
(22, 33.10, 'Ramipril 5mg'),
(23, 11.99, 'Levothyrox 75mcg'),
(24, 20.99, 'Bétaméthasone 0.5mg'),
(25, 17.50, 'Fluoxetine 20mg'),
(26, 23.99, 'Diazépam 5mg');

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
  `ville_pds` varchar(255) NOT NULL,
  `id_region` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professionnels_de_sante`
--

INSERT INTO `professionnels_de_sante` (`id_pds`, `nom_pds`, `prenom_pds`, `age_pds`, `metier`, `adresse_pds`, `CP_pds`, `ville_pds`, `id_region`) VALUES
(9, 'Dupont', 'Alice', 45, 'Médecin généraliste', '12 rue des Lilas', 75012, 'Paris', 76),
(10, 'Martin', 'Thomas', 38, 'Dentiste', '24 avenue de la République', 33000, 'Bordeaux', 94),
(11, 'Bernard', 'Sophie', 50, 'Pharmacien', '5 boulevard Saint-Michel', 59000, 'Lille', 72),
(12, 'Lefebvre', 'Julien', 42, 'Chirurgien', '18 rue de la Paix', 67000, 'Strasbourg', 68),
(13, 'Morel', 'Camille', 29, 'Infirmier', '9 place Bellecour', 69002, 'Lyon', 38),
(14, 'Girard', 'Lucas', 55, 'Cardiologue', '31 rue du Moulin', 6000, 'Nice', 121),
(15, 'Roux', 'Emma', 47, 'Ophtalmologue', '14 impasse des Acacias', 44000, 'Nantes', 114),
(16, 'Fournier', 'Hugo', 33, 'Pédiatre', '22 rue des Rosiers', 31000, 'Toulouse', 105),
(17, 'Durand', 'Manon', 41, 'Sage-femme', '7 allée des Tilleuls', 13006, 'Marseille', 122),
(18, 'Lambert', 'Nathan', 36, 'Psychologue', '10 boulevard Haussmann', 75009, 'Paris', 76),
(19, 'Dumont', 'Chloé', 52, 'Gynécologue', '8 rue Lafayette', 21000, 'Dijon', 41),
(20, 'Lemoine', 'Maxime', 48, 'Neurologue', '19 avenue des Champs-Élysées', 75008, 'Paris', 76),
(21, 'Perrin', 'Laura', 39, 'Ostéopathe', '25 route de Rennes', 35000, 'Rennes', 51),
(22, 'Marchand', 'Antoine', 34, 'Kinésithérapeute', '4 chemin du Parc', 72000, 'Le Mans', 117),
(23, 'Blanchard', 'Elise', 31, 'Dermatologue', '3 rue du Soleil', 68000, 'Colmar', 68),
(24, 'Tesson', 'Aurélien', 42, 'Dermatologue', '22 Rue de la Gare', 90000, 'Belfort', 48),
(25, 'Giraud', 'Solène', 35, 'Psychologue', '8 Rue de la République', 90000, 'Belfort', 48),
(26, 'Fournier', 'Bastien', 48, 'Cardiologue', '5 Avenue de la Paix', 90000, 'Belfort', 48);

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
(29, 24, 'Ain'),
(30, 24, 'Allier'),
(31, 24, 'Ardèche'),
(32, 24, 'Cantal'),
(33, 24, 'Drôme'),
(34, 24, 'Isère'),
(35, 24, 'Loire'),
(36, 24, 'Haute-Loire'),
(37, 24, 'Puy-de-Dôme'),
(38, 24, 'Rhône'),
(39, 24, 'Savoie'),
(40, 24, 'Haute-Savoie'),
(41, 25, 'Côte-d\'Or'),
(42, 25, 'Doubs'),
(43, 25, 'Jura'),
(44, 25, 'Nièvre'),
(45, 25, 'Haute-Saône'),
(46, 25, 'Saône-et-Loire'),
(47, 25, 'Yonne'),
(48, 25, 'Territoire de Belfort'),
(49, 26, 'Côtes-d\'Armor'),
(50, 26, 'Finistère'),
(51, 26, 'Ille-et-Vilaine'),
(52, 26, 'Morbihan'),
(53, 27, 'Cher'),
(54, 27, 'Eure-et-Loir'),
(55, 27, 'Indre'),
(56, 27, 'Indre-et-Loire'),
(57, 27, 'Loir-et-Cher'),
(58, 27, 'Loiret'),
(59, 28, 'Corse-du-Sud'),
(60, 28, 'Haute-Corse'),
(61, 29, 'Ardennes'),
(62, 29, 'Aube'),
(63, 29, 'Marne'),
(64, 29, 'Haute-Marne'),
(65, 29, 'Meurthe-et-Moselle'),
(66, 29, 'Meuse'),
(67, 29, 'Moselle'),
(68, 29, 'Bas-Rhin'),
(69, 29, 'Haut-Rhin'),
(70, 29, 'Vosges'),
(71, 30, 'Aisne'),
(72, 30, 'Nord'),
(73, 30, 'Oise'),
(74, 30, 'Pas-de-Calais'),
(75, 30, 'Somme'),
(76, 31, 'Paris'),
(77, 31, 'Seine-et-Marne'),
(78, 31, 'Yvelines'),
(79, 31, 'Essonne'),
(80, 31, 'Hauts-de-Seine'),
(81, 31, 'Seine-Saint-Denis'),
(82, 31, 'Val-de-Marne'),
(83, 31, 'Val-d\'Oise'),
(84, 32, 'Calvados'),
(85, 32, 'Eure'),
(86, 32, 'Manche'),
(87, 32, 'Orne'),
(88, 32, 'Seine-Maritime'),
(89, 33, 'Charente'),
(90, 33, 'Charente-Maritime'),
(91, 33, 'Corrèze'),
(92, 33, 'Creuse'),
(93, 33, 'Dordogne'),
(94, 33, 'Gironde'),
(95, 33, 'Landes'),
(96, 33, 'Lot-et-Garonne'),
(97, 33, 'Pyrénées-Atlantiques'),
(98, 33, 'Deux-Sèvres'),
(99, 33, 'Vienne'),
(100, 33, 'Haute-Vienne'),
(101, 34, 'Ariège'),
(102, 34, 'Aude'),
(103, 34, 'Aveyron'),
(104, 34, 'Gard'),
(105, 34, 'Haute-Garonne'),
(106, 34, 'Gers'),
(107, 34, 'Hérault'),
(108, 34, 'Lot'),
(109, 34, 'Lozère'),
(110, 34, 'Hautes-Pyrénées'),
(111, 34, 'Pyrénées-Orientales'),
(112, 34, 'Tarn'),
(113, 34, 'Tarn-et-Garonne'),
(114, 35, 'Loire-Atlantique'),
(115, 35, 'Maine-et-Loire'),
(116, 35, 'Mayenne'),
(117, 35, 'Sarthe'),
(118, 35, 'Vendée'),
(119, 36, 'Alpes-de-Haute-Provence'),
(120, 36, 'Hautes-Alpes'),
(121, 36, 'Alpes-Maritimes'),
(122, 36, 'Bouches-du-Rhône'),
(123, 36, 'Var'),
(124, 36, 'Vaucluse');

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
(6, 25),
(38, 34);

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
(29, 'Durand', 'Paul', 'pauldurand@vigsb.fr', 'paul123', 25, '10 rue des Fleurs, Paris', 'visiteur'),
(30, 'Lemoine', 'Sophie', 'sophielemoine@vigsb.fr', 'sophie456', 30, '15 avenue de la République, Lyon', 'visiteur'),
(31, 'Martin', 'Lucas', 'lucasmartin@vigsb.fr', 'lucas789', 22, '5 place de la Liberté, Marseille', 'visiteur'),
(32, 'Dubois', 'Camille', 'camilledubois@vigsb.fr', 'camille321', 28, '8 boulevard Saint-Michel, Bordeaux', 'visiteur'),
(33, 'Morel', 'Emma', 'emmamorel@vigsb.fr', 'emma654', 24, '12 allée des Acacias, Toulouse', 'visiteur'),
(34, 'Bernard', 'Louis', 'louisbernard@vigsb.fr', 'louis987', 27, '20 chemin du Moulin, Nantes', 'visiteur'),
(35, 'Renaud', 'Maxime', 'maximerenaud@vigsb.fr', 'maxime123', 40, '25 avenue des Champs, Strasbourg', 'delegue'),
(36, 'Simon', 'Claire', 'clairesimon@vigsb.fr', 'claire456', 45, '30 rue de la Paix, Lille', 'delegue'),
(37, 'Girard', 'Antoine', 'antoinegirard@vigsb.fr', 'antoine789', 38, '35 boulevard Haussmann, Nice', 'delegue'),
(38, 'Lefevre', 'Julie', 'julielefevre@vigsb.fr', 'julie321', 42, '40 rue des Lilas, Montpellier', 'responsable');

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
(24, 'Auvergne-Rhône-Alpes'),
(25, 'Bourgogne-Franche-Comté'),
(26, 'Bretagne'),
(27, 'Centre-Val de Loire'),
(28, 'Corse'),
(29, 'Grand Est'),
(30, 'Hauts-de-France'),
(31, 'Île-de-France'),
(32, 'Normandie'),
(33, 'Nouvelle-Aquitaine'),
(34, 'Occitanie'),
(35, 'Pays de la Loire'),
(36, 'Provence-Alpes-Côte d\'Azur');

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
('2025-04-11', 16, 24, 2, NULL, 0);

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
(2, 48),
(29, 48),
(34, 74),
(33, 97),
(32, 106),
(31, 107),
(30, 116);

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
  ADD PRIMARY KEY (`id_salarie`,`id_region`) USING BTREE,
  ADD KEY `delegue_region` (`id_region`);

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
  ADD KEY `idx_prenom_pds` (`prenom_pds`),
  ADD KEY `fk_id_region` (`id_region`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id_region`);

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
  MODIFY `id_medicament` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `professionnels_de_sante`
--
ALTER TABLE `professionnels_de_sante`
  MODIFY `id_pds` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `salarie`
--
ALTER TABLE `salarie`
  MODIFY `id_salarie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `secteur`
--
ALTER TABLE `secteur`
  MODIFY `id_secteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delegue_regional`
--
ALTER TABLE `delegue_regional`
  ADD CONSTRAINT `delegue_region` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`),
  ADD CONSTRAINT `salarie_est_delegue` FOREIGN KEY (`id_salarie`) REFERENCES `salarie` (`id_salarie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `professionnels_de_sante`
--
ALTER TABLE `professionnels_de_sante`
  ADD CONSTRAINT `fk_id_region` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`);

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
