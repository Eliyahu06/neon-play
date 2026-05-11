-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 11 mai 2026 à 15:18
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `neon_play`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id_article` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `intro` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `note` decimal(3,1) NOT NULL,
  `critic` longtext NOT NULL,
  `opinion` longtext NOT NULL,
  `banner_img` varchar(255) NOT NULL,
  `card_img` varchar(255) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_author` int NOT NULL,
  PRIMARY KEY (`id_article`),
  KEY `fk_articles_users1_idx` (`id_author`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id_article`, `title`, `intro`, `description`, `note`, `critic`, `opinion`, `banner_img`, `card_img`, `date_add`, `id_author`) VALUES
(1, 'Cyberpunk 2077', 'Un RPG futuriste immersif', 'Description complète du jeu Cyberpunk...', 8.5, 'Critique professionnelle...', 'Mon avis perso...', 'cyberpunk_banner.jpg', 'cyberpunk_card.jpg', '2026-05-04 15:43:58', 1),
(2, 'The Witcher 3', 'Une aventure épique', 'Description complète de Witcher...', 9.5, 'Chef-d’œuvre du RPG...', 'Incroyable expérience...', 'witcher_banner.jpg', 'witcher_card.jpg', '2026-05-04 15:43:58', 1),
(3, 'Elden Ring', 'Un monde ouvert exigeant', 'Description complète de Elden Ring...', 9.0, 'Un défi à la hauteur...', 'Très prenant...', 'elden_banner.jpg', 'elden_card.jpg', '2026-05-04 15:43:58', 1),
(4, 'Red Dead Redemption 2', 'Western réaliste', 'Description complète RDR2...', 9.7, 'Narration exceptionnelle...', 'Magnifique...', 'rdr2_banner.jpg', 'rdr2_card.jpg', '2026-05-04 15:43:58', 1),
(5, 'Hogwarts Legacy', 'Plongée dans Harry Potter', 'Description Hogwarts...', 7.5, 'Bon mais imparfait...', 'Sympa à jouer...', 'hogwarts_banner.jpg', 'hogwarts_card.jpg', '2026-05-04 15:43:58', 1),
(6, 'Assassin’s Creed Valhalla', 'Raid viking', 'Description AC Valhalla...', 7.8, 'Un peu répétitif...', 'Bon jeu...', 'ac_banner.jpg', 'ac_card.jpg', '2026-05-04 15:43:58', 1),
(7, 'Zelda Breath of the Wild', 'Exploration libre', 'Description Zelda...', 9.8, 'Révolution du genre...', 'Exceptionnel...', 'zelda_banner.jpg', 'zelda_card.jpg', '2026-05-04 15:43:58', 1),
(8, 'God of War Ragnarok', 'Mythologie nordique', 'Description GOW...', 9.6, 'Très cinématographique...', 'Top...', 'gow_banner.jpg', 'gow_card.jpg', '2026-05-04 15:43:58', 1),
(9, 'Final Fantasy XVI', 'RPG moderne', 'Description FF16...', 8.2, 'Bon système de combat...', 'Sympa...', 'ff_banner.jpg', 'ff_card.jpg', '2026-05-04 15:43:58', 1),
(10, 'Spider-Man 2', 'Super-héros dynamique', 'Description Spiderman...', 8.9, 'Très fun...', 'Excellent gameplay...', 'spiderman_banner.jpg', 'spiderman_card.jpg', '2026-05-04 15:43:58', 1);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id_comment` int NOT NULL AUTO_INCREMENT,
  `content` longtext NOT NULL,
  `note` decimal(3,1) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int NOT NULL,
  `id_article` int NOT NULL,
  PRIMARY KEY (`id_comment`),
  UNIQUE KEY `unique_user_comment` (`id_user`,`id_article`),
  KEY `fk_comments_users_idx` (`id_user`),
  KEY `fk_comments_articles1_idx` (`id_article`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id_comment`, `content`, `note`, `date_add`, `id_user`, `id_article`) VALUES
(3, 'Super ambiance futuriste', 8.0, '2026-05-05 20:18:30', 1, 1),
(5, 'Mérite vraiment son titre de GOTY, je l\'ai poncé. \r\nLes musiques sont magnifiques', 9.0, '2026-05-05 20:30:39', 1, 2),
(6, 'Plein de quêtes variées. Une histoire prenante. Génial du début à la fin', 9.0, '2026-05-05 20:39:46', 2, 2),
(7, 'Univers sympas mais trop de quêtes répétitives', 7.0, '2026-05-05 20:43:21', 2, 5),
(8, 'J\'adore la customisation du personnage', 6.4, '2026-05-05 21:06:32', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `answer` varchar(150) NOT NULL,
  `date_subscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `role`, `answer`, `date_subscription`) VALUES
(1, 'Eliyahu06', 'elinevermeulen06@gmail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'admin', 'kangoo', '2026-04-25 15:55:33'),
(2, 'GeaiMoqueur19', 'wimmer.lau@gmail.com', '$2y$10$CiIf2JDJFO.pBYwJ1kKPR.IcOxKhrpd18H7jjj7AsWYfKbu091Afa', 'user', 'einstein', '2026-04-25 16:33:52');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_articles_users1` FOREIGN KEY (`id_author`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_articles1` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id_article`),
  ADD CONSTRAINT `fk_comments_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

