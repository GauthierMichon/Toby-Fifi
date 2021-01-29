-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 29 jan. 2021 à 13:36
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `toby-fifi`
--

-- --------------------------------------------------------

--
-- Structure de la table `bon_achat`
--

CREATE TABLE `bon_achat` (
  `id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fixe` tinyint(1) DEFAULT NULL,
  `pourcentage` tinyint(1) DEFAULT NULL,
  `reduction` double NOT NULL,
  `date_peremption` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `nom_categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `id_produit`, `nom_categorie`) VALUES
(1, 1, 'Jouets'),
(2, 2, 'Jouets'),
(3, 3, 'Beauté et Santé'),
(4, 4, 'Livres'),
(5, 5, 'Livres'),
(6, 6, 'Livres'),
(7, 7, 'Jeux vidéo et console'),
(8, 8, 'Jouets'),
(9, 9, 'Jouets'),
(10, 10, 'Livres'),
(11, 11, 'Livres'),
(12, 12, 'Musique DVD et Blu-ray'),
(13, 13, 'Musique DVD et Blu-ray'),
(14, 14, 'High-Tech'),
(15, 14, 'Informatique'),
(16, 15, 'Informatique'),
(17, 16, 'Sport et Loisir'),
(18, 17, 'Sport et Loisir'),
(19, 17, 'Vêtements Chaussures et Bijoux'),
(20, 18, 'Cuisine et Maison'),
(21, 19, 'Cuisine et Maison'),
(22, 20, 'Bricolage et jardin'),
(23, 21, 'Épicerie et Boisson'),
(24, 22, 'Animalerie'),
(26, 24, 'Beauté et Santé');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `commentaire` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `id_user`, `id_produit`, `commentaire`) VALUES
(1, 1, 1, 'Très bon produit'),
(2, 4, 6, 'Très bon produit'),
(3, 4, 14, 'Cher mais vaut son prix'),
(4, 5, 6, 'Premier Tome qui annonce une aventure incroyable'),
(5, 5, 14, 'Exellent produit mais un peu trop cher'),
(6, 6, 6, 'Juste parfait'),
(7, 6, 14, 'Produit au delà de mes attentes');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210128153746', '2021-01-28 16:38:05', 367);

-- --------------------------------------------------------

--
-- Structure de la table `les_diff_categories`
--

CREATE TABLE `les_diff_categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `les_diff_categories`
--

INSERT INTO `les_diff_categories` (`id`, `nom`) VALUES
(1, 'Livres'),
(2, 'Musique DVD et Blu-ray'),
(3, 'Jeux vidéo et console'),
(4, 'High-Tech'),
(5, 'Sport et Loisir'),
(6, 'Cuisine et Maison'),
(7, 'Bricolage et jardin'),
(8, 'Animalerie'),
(9, 'Vêtements Chaussures et Bijoux'),
(10, 'Informatique'),
(11, 'Jouets'),
(12, 'Beauté et Santé'),
(13, 'Épicerie et Boisson');

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`id`, `id_user`, `id_produit`, `note`) VALUES
(1, 1, 1, 4),
(2, 4, 6, 5),
(3, 4, 14, 5),
(4, 5, 6, 5),
(5, 5, 14, 4),
(6, 6, 6, 5),
(7, 6, 14, 5);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `parrainage`
--

CREATE TABLE `parrainage` (
  `id` int(11) NOT NULL,
  `id_parrain` int(11) NOT NULL,
  `id_filleul` int(11) NOT NULL,
  `date_parrainage` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `prix` double NOT NULL,
  `reduction` double DEFAULT NULL,
  `duree_livraison` int(11) NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `description`, `stock`, `prix`, `reduction`, `duree_livraison`, `image_name`) VALUES
(1, 'Figurine gohan', 'Figurine gohan ssj2', 16, 49.99, NULL, 2, '3bf4617e129bef6d413274a9a05b7d23.jpg'),
(2, 'Peluche Saitama', 'Peluche Saitama 15cm', 7, 19.99, NULL, 1, '0e1e90ad4cc69fd48f53a05e838b71b0.jpg'),
(3, 'Rouge à Lèvres', 'Rouge à lèvres rouge', 21, 25.99, NULL, 3, '2395e3db5e17de65e26c2dbf8b102507.jpg'),
(4, 'Naruto Tome 1', 'Naruto Tome 1', 3, 6.99, NULL, 1, 'abe4a748f265ee9ce43640912439984c.jpg'),
(5, 'Dragon Ball Tome 1', 'Dragon Ball Tome 1', 5, 6.99, NULL, 1, '979b71aa67419ba2a3f94c75c2171e9c.jpg'),
(6, 'One Piece Tome 1', 'One Piece Tome 1', 1, 6.99, NULL, 1, '208681d33d82d8e0d1c434621c25f59c.jpg'),
(7, 'One Piece', 'Jeu One Piece World Seeker', 4, 39.99, NULL, 2, 'ad24d61bf942ee05c7de939028a80752.png'),
(8, 'Lego Baby Yoda', 'Lego Baby Yoda 18cm', 7, 84.99, NULL, 2, '7a0a64b2bfc04d952eeda28c515fad3e.jpg'),
(9, 'Monopoly', 'Jeu de société Monopoly', 7, 24.99, NULL, 3, '145f80679562b095591f9d5a7788e8ae.jpg'),
(10, 'Les Misérables', 'Livre Les Misérables de Victor Hugo', 6, 15.95, NULL, 2, 'c0481664ca4b9d1db06d0cb9feed52d4.jpg'),
(11, 'Harry Potter 1', 'Livre Harry Potter 1 JK.Rowling', 2, 9.99, NULL, 1, '1b0d70ed2ad79b8cd72f519fe4bb49b4.jpg'),
(12, 'DVD La Ligne Verte', 'DVD La Ligne Verte Avec Tom Hanks', 2, 12.99, NULL, 2, 'f58d72fcd081d4c7826ed7d9d8bf658f.jpg'),
(13, 'DVD Shutter Island', 'DVD Shutter Island Avec Leonardo Di Caprio', 9, 10.99, NULL, 1, '30ed69290e1acd0ac6a5ff5476dd1e91.jpg'),
(14, 'GeoForce RTX 3070', 'GeoForce RTX 3070', 4, 449.99, NULL, 2, 'f8e0cd6d55890de1261db470c81fccb2.png'),
(15, 'Souris', 'Souris sans fil', 8, 22.99, NULL, 2, 'dd0e7697fe13426c64f8a5ee185ec411.jpg'),
(16, 'Raquette', 'Raquette de tenis', 12, 76.99, NULL, 1, 'b03cdb7ffa9180af4de5a0fc3a87c5c9.jpg'),
(17, 'Basket Jordan', 'jordan max aura 2', 4, 119.99, NULL, 3, 'f1cd9262ef4d7efe57e4bd7d1008454b.jpg'),
(18, 'Casserole', 'Casserole en inox', 3, 18.99, NULL, 1, '590ae8d2626fbb07ff97ec64aa8aa984.png'),
(19, 'Aspirateur', 'Aspirateur', 1, 46.9, NULL, 3, '69fd3c29c91090d01068b5567a05cc58.png'),
(20, 'Perceuse', 'Perceuse / Visseuse', 7, 46.85, NULL, 1, 'be7279db797e5a206824d3e2749defcd.jpg'),
(21, 'Cannette de Coca', 'Cannette de Coca', 29, 1.5, NULL, 1, '39b151049a73f441688a5fb173ecc154.jpg'),
(22, 'Croquettes Chien', 'Ultima Medium-Maxi Adulte Croquettes Poulet/Riz pour Chien 7,5 kg', 13, 25.99, NULL, 1, 'debe0846cc5551387e7a33b9ed7b0669.jpg'),
(24, 'Tondeuse à barbe', 'Tondeuse à barbe pour hommes', 0, 34.99, NULL, 2, 'db0b6b256b4d786560b713a07b45c358.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `solde` double NOT NULL,
  `depense_avant_bon_achat` double NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `date_naissance`, `solde`, `depense_avant_bon_achat`, `image_name`) VALUES
(1, 'Benjamin.Chancerel@mail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$NDdpL2JVdWo1QnBCSTdQeA$VgqaZAalwkPUymRaJ+iO7q//dQobWjmYjzHNH+t6pgc', 'Chancerel', 'Benjamin', '2001-04-28', 8865.99, -834.01, 'e8f5d9fc095ecf127179306e5250970f.jpg'),
(2, 'TobyFifi@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$dFo2Mmo0YjJrMXNrU1NCSA$ujgDz4AwvqqJdMH53Vmu4vwEeUQ/y8ieFzyuP+7SVU0', 'TobyFifi', 'Admin', '1996-10-16', 1000000, 300, 'b650b17d889ca1cc00490af74eecf325.png'),
(4, 'Victor.garcia@email.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$clFlQjdneGNTUzdnbzJaaw$YyHesgbYpmX8syczSj666TU9F6Xy9wyumwKiY80787g', 'Garcia', 'Victor', '2001-06-21', 2293.02, -156.98, '2e70166d86c52d94f461ad616caff892.jpg'),
(5, 'jules.dupuis@email.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$ZnJCUmVHRWUyTC40dWhxSQ$ZJwz1BsAfYRGNmktmFqcvr1V+Q6pex62khpTD6tzJwM', 'Dupuis', 'Jules', '2001-11-23', 1343.02, -156.98, '764b85df7bde6a75ce7397df7748089c.jpg'),
(6, 'sacha.voisin@email.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$MFNQc0xuMEh6LlA5Qi5wTg$aniSBDyBtjwYJ5tNSOMGXoAwguWWRlMEgARtI75Kew8', 'Voisin', 'Sacha', '1999-09-16', 93.02, -156.98, 'ab97d22cc673bdf4f334b485a74945f9.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

CREATE TABLE `ventes` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ventes`
--

INSERT INTO `ventes` (`id`, `id_user`, `id_produit`, `date`) VALUES
(1, 1, 1, '2021-01-19'),
(2, 1, 2, '2021-01-20'),
(3, 1, 3, '2021-01-28'),
(4, 1, 4, '2021-01-28'),
(5, 1, 5, '2021-01-28'),
(6, 1, 6, '2021-01-28'),
(7, 1, 7, '2021-01-28'),
(8, 1, 8, '2021-01-28'),
(9, 1, 9, '2021-01-28'),
(10, 1, 10, '2021-01-28'),
(11, 1, 11, '2021-01-28'),
(12, 1, 12, '2021-01-28'),
(13, 1, 13, '2021-01-28'),
(14, 1, 14, '2021-01-28'),
(15, 1, 15, '2021-01-28'),
(16, 1, 16, '2021-01-28'),
(17, 1, 17, '2021-01-28'),
(18, 1, 18, '2021-01-28'),
(19, 1, 19, '2021-01-28'),
(20, 1, 20, '2021-01-28'),
(21, 1, 21, '2021-01-28'),
(22, 1, 22, '2021-01-28'),
(23, 1, 6, '2021-01-29'),
(25, 4, 6, '2021-01-29'),
(26, 4, 14, '2021-01-29'),
(27, 5, 6, '2021-01-29'),
(28, 5, 14, '2021-01-29'),
(29, 6, 6, '2021-01-29'),
(30, 6, 14, '2021-01-29');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bon_achat`
--
ALTER TABLE `bon_achat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `les_diff_categories`
--
ALTER TABLE `les_diff_categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parrainage`
--
ALTER TABLE `parrainage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Index pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bon_achat`
--
ALTER TABLE `bon_achat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `les_diff_categories`
--
ALTER TABLE `les_diff_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `parrainage`
--
ALTER TABLE `parrainage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
