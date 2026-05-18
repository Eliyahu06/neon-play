-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 18 mai 2026 à 14:53
-- Version du serveur : 8.4.7
-- Version de PHP : 8.3.28

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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id_article`, `title`, `intro`, `description`, `note`, `critic`, `opinion`, `banner_img`, `card_img`, `date_add`, `id_author`) VALUES
(1, 'Cyberpunk 2077', 'Un RPG futuriste immersif', 'Cyberpunk 2077 plonge le joueur dans Night City, une mégalopole futuriste gangrenée par les corporations et la criminalité. Le jeu mélange exploration en monde ouvert, narration dynamique et personnalisation poussée du personnage. Chaque quartier possède sa propre identité visuelle et ses habitants renforcent l’immersion générale. Les combats alternent entre armes à feu, hacking et améliorations cybernétiques, offrant de nombreuses approches différentes.', 9.0, 'Après un lancement extrêmement compliqué, Cyberpunk 2077 est devenu une expérience bien plus stable et cohérente grâce aux nombreuses mises à jour. La direction artistique est impressionnante et certains personnages, comme Johnny Silverhand ou Panam, restent mémorables longtemps après la fin de l’aventure. Malgré quelques défauts techniques persistants et des systèmes parfois moins profonds qu’annoncé, le jeu propose une immersion rarement atteinte dans un RPG moderne.', 'J’ai énormément apprécié l’univers et l’ambiance générale. Night City est fascinante à explorer et certaines quêtes secondaires sont excellentes. Même si le jeu n’est pas parfait, il reste extrêmement prenant.', 'cyberpunk_banner.jpg', 'cyberpunk_card.jpg', '2026-05-04 15:43:58', 1),
(2, 'The Witcher 3', 'Une aventure épique', 'The Witcher 3 suit Geralt de Riv dans une immense aventure à travers des royaumes ravagés par la guerre et les monstres. Entre contrats de sorceleur, intrigues politiques et recherche de Ciri, le joueur découvre un monde riche et crédible rempli de quêtes mémorables. Chaque région possède sa propre ambiance et les choix du joueur influencent réellement le déroulement de certaines histoires.', 9.5, 'CD Projekt réussit à créer un RPG gigantesque sans sacrifier la qualité de l’écriture. Les dialogues sont excellents et les quêtes secondaires dépassent souvent celles de nombreux jeux principaux concurrents. Le gameplay montre quelques limites aujourd’hui mais l’ensemble reste une référence incontournable du RPG occidental.', 'C’est probablement un des jeux qui m’a le plus marqué. Les personnages sont incroyablement bien écrits et l’univers donne envie d’explorer chaque recoin.', 'witcher_banner.jpg', 'witcher_card.jpg', '2026-05-03 15:43:58', 1),
(3, 'Elden Ring', 'Un monde ouvert exigeant', 'Elden Ring mélange l’approche exigeante des Souls avec un immense monde ouvert rempli de secrets. Le joueur peut explorer librement les Terres Intermédiaires, découvrir des donjons cachés et affronter des boss particulièrement redoutables. La liberté d’exploration encourage constamment la curiosité et la découverte.', 9.0, 'FromSoftware réussit à adapter sa formule à un monde ouvert sans perdre ce qui fait sa force. Le level design est impressionnant et le sentiment de progression reste extrêmement satisfaisant. Quelques problèmes techniques mineurs existent mais l’expérience globale est exceptionnelle.', 'Chaque exploration réserve une surprise. La sensation de découvrir un nouveau lieu ou de vaincre un boss difficile est incroyablement gratifiante.', 'elden_banner.jpg', 'elden_card.jpg', '2026-03-16 16:43:58', 1),
(4, 'Red Dead Redemption 2', 'Western réaliste', 'Red Dead Redemption 2 raconte la chute progressive du gang de Dutch Van Der Linde dans une Amérique en pleine modernisation. Le jeu impressionne par son souci du détail, son monde vivant et son écriture particulièrement mature. Chaque activité, du simple voyage à cheval aux braquages, participe à renforcer l’immersion.', 9.7, 'Rockstar livre ici une œuvre extrêmement ambitieuse. La mise en scène est remarquable et Arthur Morgan devient rapidement un personnage profondément attachant. Certains joueurs pourront trouver le rythme lent mais cette lenteur participe justement à l’identité du jeu.', 'L’immersion est incroyable. On a réellement l’impression de vivre dans cet univers et pas simplement de jouer dans un décor.', 'rdr2_banner.jpg', 'rdr2_card.jpg', '2026-04-21 15:43:58', 1),
(5, 'Hogwarts Legacy', 'Plongée dans Harry Potter', 'Hogwarts Legacy permet enfin d’explorer librement l’univers de Harry Potter dans un RPG en monde ouvert. Le château de Poudlard est reproduit avec énormément de détails et les environs regorgent de secrets à découvrir. Le système de combat magique est dynamique et encourage l’utilisation de différents sorts.', 7.5, 'Le jeu réussit parfaitement son fan service grâce à une direction artistique fidèle et un univers riche à explorer. En revanche, certaines activités deviennent répétitives et le scénario principal manque parfois de profondeur.', 'Explorer Poudlard était exactement ce que j’attendais depuis des années. Même avec ses défauts, le jeu reste très plaisant pour les fans de l’univers.', 'hogwarts_banner.jpg', 'hogwarts_card.jpg', '2026-04-25 15:43:58', 1),
(6, 'Assassin’s Creed Valhalla', 'Raid viking', 'Assassin’s Creed Valhalla plonge le joueur dans l’ère viking à travers les aventures d’Eivor. Entre conquêtes, alliances politiques et exploration de l’Angleterre médiévale, le jeu propose un contenu gigantesque rempli de quêtes et d’activités variées.', 7.8, 'Ubisoft améliore plusieurs aspects du gameplay RPG introduit dans Origins et Odyssey, notamment la progression et les combats. Cependant, la structure générale devient parfois répétitive à cause de la quantité importante de contenu.', 'J’ai beaucoup aimé l’ambiance nordique et certaines régions sont magnifiques à parcourir. Le jeu aurait simplement gagné à être un peu plus condensé.', 'ac_banner.jpg', 'ac_card.jpg', '2026-05-01 15:43:58', 1),
(7, 'Zelda Breath of the Wild', 'Exploration libre', 'Breath of the Wild révolutionne la formule Zelda avec une liberté totale donnée au joueur. Dès les premières minutes, le jeu encourage l’exploration et l’expérimentation. Les mécaniques physiques, l’escalade et la gestion des ressources rendent chaque aventure différente.', 9.8, 'Nintendo réussit à moderniser la série tout en conservant son esprit d’origine. Le monde ouvert est vivant et la sensation d’exploration reste exceptionnelle du début à la fin. Quelques donjons principaux manquent peut-être de personnalité mais l’expérience globale reste magistrale.', 'C’est l’un des rares jeux où je me suis perdu volontairement pendant des heures juste pour explorer.', 'zelda_banner.jpg', 'zelda_card.jpg', '2026-04-30 15:43:58', 1),
(8, 'God of War Ragnarok', 'Mythologie nordique', 'God of War Ragnarok poursuit l’histoire de Kratos et Atreus dans une aventure encore plus spectaculaire. Les royaumes nordiques sont variés et les combats gagnent en profondeur grâce aux nouvelles capacités disponibles.', 9.6, 'Santa Monica Studio livre une suite extrêmement solide avec une réalisation technique impressionnante et une narration maîtrisée. Certains segments sont un peu plus dirigistes mais l’ensemble reste très cohérent.', 'Les relations entre les personnages sont excellentes et certaines scènes sont vraiment marquantes.', 'gow_banner.jpg', 'gow_card.jpg', '2026-04-28 15:43:58', 1),
(9, 'Final Fantasy XVI', 'RPG moderne', 'Final Fantasy XVI adopte une approche plus orientée action tout en conservant les grandes thématiques de la saga. Le jeu suit Clive Rosfield dans un monde médiéval sombre marqué par les conflits politiques et les invocations destructrices appelées Primordiaux.', 8.2, 'Square Enix propose une mise en scène spectaculaire et des combats très dynamiques. Le scénario reste captivant malgré quelques quêtes secondaires moins intéressantes.', 'Les affrontements contre les Primordiaux sont impressionnants et donnent une vraie sensation d’échelle.', 'ff_banner.jpg', 'ff_card.jpg', '2026-04-22 15:43:58', 1),
(10, 'Spider-Man 2', 'Super-héros dynamique', 'Spider-Man 2 permet d’incarner Peter Parker et Miles Morales dans une version encore plus vivante de New York. Les déplacements sont fluides et les combats gagnent en dynamisme grâce aux nouvelles capacités des deux héros.', 8.9, 'Insomniac maîtrise parfaitement sa formule avec une réalisation très solide et un gameplay toujours aussi agréable. Le scénario reste efficace même si certaines missions secondaires sont plus classiques.', 'Se déplacer dans la ville reste un plaisir absolu. Le jeu est fun quasiment en permanence.', 'spider-man-2-banner.jpg', 'spider-man-2-card.jpg', '2026-05-02 15:43:58', 1),
(24, 'Persona 5 Royal', 'Un JRPG stylé et captivant', 'Persona 5 Royal mélange simulation sociale et exploration de donjons avec une identité visuelle unique. Les personnages sont attachants et l’histoire aborde des thèmes plus matures que la moyenne du genre. Chaque journée passée dans Tokyo donne envie de continuer.', 9.4, 'Le contenu supplémentaire de Royal améliore encore une formule déjà excellente. Le jeu souffre parfois d’un rythme un peu lent mais son système de combat reste l’un des meilleurs du JRPG moderne.', 'Impossible de décrocher une fois lancé. Les musiques et les personnages restent mémorables.', 'persona-5-royal-banner.jpg', 'persona-5-royal-card.jpg', '2026-05-17 14:56:39', 1),
(26, 'Resident Evil 4 Remake', 'Une réinvention moderne du survival horror', 'Resident Evil 4 Remake modernise complètement le classique de Capcom tout en conservant son identité originale. L’ambiance est plus oppressante, les environnements sont détaillés et le gameplay gagne énormément en fluidité. Les affrontements deviennent plus nerveux grâce aux nouvelles mécaniques de parade et à une gestion plus dynamique des ennemis.', 9.2, 'Capcom réussit un équilibre impressionnant entre nostalgie et modernité. La direction artistique est excellente et le rythme du jeu reste maîtrisé du début à la fin. Quelques longueurs persistent dans certaines zones secondaires mais l’ensemble reste remarquable.', 'J’ai adoré redécouvrir ce jeu dans cette version. L’atmosphère fonctionne parfaitement et les combats restent extrêmement satisfaisants.', 'resident-evil-4-remake-banner.jpg', 'resident-evil-4-remake-card.jpg', '2026-05-17 14:59:03', 1),
(28, 'Death Stranding', 'Une aventure contemplative et étrange', 'Death Stranding propose une expérience très différente des productions habituelles. Le voyage, l’isolement et la connexion entre les joueurs sont au cœur du gameplay. Les longues traversées créent une sensation unique rarement vue ailleurs.', 8.3, 'Le jeu divise forcément à cause de son gameplay atypique mais sa direction artistique et sa narration sont fascinantes. Certaines phases deviennent répétitives mais l’expérience reste marquante.', 'Je comprends pourquoi certains détestent et d’autres adorent. Personnellement j’ai trouvé l’univers incroyable.', 'death-stranding-banner.jpg', 'death-stranding-card.jpg', '2026-05-17 14:59:03', 1),
(29, 'Hades', 'Un rogue-like mythologique exigeant et addictif', 'Hades est un rogue-like développé par Supergiant Games dans lequel on incarne Zagreus, fils d’Hadès, cherchant à fuir les Enfers. Chaque tentative d’évasion est unique grâce à une génération procédurale intelligente et un système de bénédictions offertes par les dieux de l’Olympe. Le jeu combine action rapide, progression permanente et narration dynamique.', 9.1, 'Hades réussit un exploit rare : rendre la mort intéressante. Chaque échec fait avancer l’histoire et débloque de nouveaux dialogues, ce qui transforme la répétition en moteur narratif. Le gameplay est extrêmement fluide, avec une grande variété de builds possibles. La direction artistique est cohérente et stylisée. Le seul reproche possible concerne une certaine répétitivité sur le très long terme.', 'J’ai été surpris par la profondeur du jeu. Même après plusieurs heures, j’avais encore envie de relancer une partie. Le système de progression est addictif et intelligent.', 'hades_banner.jpg', 'hades_card.jpg', '2026-05-17 14:00:00', 1),
(30, 'Baldur’s Gate 3', 'Le RPG le plus libre de sa génération', 'Baldur’s Gate 3 est un RPG basé sur les règles de Donjons & Dragons. Le joueur crée un personnage et explore un monde riche où chaque choix peut modifier profondément le déroulement de l’histoire. Le jeu propose un système de dialogue extrêmement avancé, des combats tactiques au tour par tour et une liberté rarement atteinte dans le jeu vidéo moderne.', 9.7, 'Le jeu de Larian Studios représente une véritable référence du RPG moderne. La liberté d’action est totale : infiltration, diplomatie, combat ou manipulation, tout est possible. Les personnages compagnons sont écrits avec une grande profondeur psychologique. Les seuls défauts concernent un rythme parfois lent et une complexité qui peut décourager certains joueurs.', 'Chaque partie est différente. J’ai rarement vu un jeu où mes décisions avaient autant de conséquences. C’est un véritable bac à sable narratif.', 'bg3_banner.jpg', 'bg3_card.jpg', '2026-05-17 14:05:00', 1),
(31, 'Starfield', 'Une odyssée spatiale ambitieuse mais imparfaite', 'Starfield est un RPG spatial développé par Bethesda où le joueur explore des centaines de planètes à travers la galaxie. Le jeu propose des combats spatiaux, de l’exploration et une narration centrée sur la découverte de mystères cosmiques.', 7.8, 'Starfield impressionne par son ambition et sa taille gigantesque. Cependant, cette grandeur s’accompagne d’un manque de densité dans certaines zones. Les planètes générées peuvent parfois sembler vides. Malgré cela, les quêtes principales restent intéressantes et les systèmes de gameplay solides.', 'L’univers est fascinant mais inégal. Certaines planètes sont incroyables, d’autres beaucoup trop vides. Le potentiel est énorme mais pas totalement exploité.', 'starfield_banner.jpg', 'starfield_card.jpg', '2026-05-17 14:10:00', 1),
(32, 'Sekiro', 'Un jeu d’action exigeant et technique', 'Sekiro se déroule dans un Japon féodal revisité où le joueur incarne un shinobi cherchant à protéger son maître. Le jeu repose sur un système de combat basé sur la posture et la précision du timing plutôt que sur la simple endurance.', 9.3, 'FromSoftware propose ici son gameplay le plus exigeant. Chaque combat est un duel technique où la moindre erreur est punie. La courbe d’apprentissage est rude mais extrêmement gratifiante. Le level design reste plus linéaire que d’autres jeux du studio mais parfaitement maîtrisé.', 'J’ai rarement ressenti autant de satisfaction après avoir battu un boss. Le jeu demande de la patience mais récompense chaque effort.', 'sekiro_banner.jpg', 'sekiro_card.jpg', '2026-05-17 14:15:00', 1),
(33, 'Diablo IV', 'Un retour aux sources du hack and slash', 'Diablo IV revient à une ambiance sombre et mature après un épisode plus coloré. Le jeu propose un monde ouvert partagé, des donjons générés et un système de loot basé sur la progression du joueur.', 8.1, 'Blizzard propose une formule solide mais sans révolution. L’ambiance est réussie et le gameplay efficace. Cependant, certaines mécaniques de progression peuvent sembler répétitives sur le long terme.', 'Très bon jeu en coop. J’ai aimé l’ambiance plus sombre que Diablo III, même si le gameplay reste assez classique.', 'd4_banner.jpg', 'd4_card.jpg', '2026-05-17 14:20:00', 1),
(34, 'Minecraft', 'Le bac à sable ultime de la créativité', 'Minecraft est un jeu de survie et de construction dans un monde entièrement généré de manière procédurale. Le joueur peut récolter des ressources, construire des structures et explorer des environnements variés.', 9.5, 'Minecraft est un phénomène culturel autant qu’un jeu vidéo. Sa simplicité cache une profondeur incroyable. Les possibilités de création sont quasi infinies, surtout avec les mods et serveurs communautaires.', 'C’est un jeu auquel je reviens toujours. Il n’a pas vraiment d’objectif mais c’est justement ce qui le rend unique.', 'minecraft-banner.jpg', 'minecraft-card.jpg', '2026-05-17 14:25:00', 1),
(35, 'Fortnite', 'Un battle royale devenu phénomène mondial', 'Fortnite est un jeu multijoueur en ligne opposant des joueurs dans une arène où seul le dernier survivant gagne. Le système de construction ajoute une dimension stratégique unique.', 8.0, 'Epic Games a transformé Fortnite en plateforme de divertissement global. Le jeu est régulièrement mis à jour avec de nouveaux événements et collaborations. Toutefois, la construction peut être difficile à maîtriser pour les nouveaux joueurs.', 'Très fun entre amis mais un peu compliqué à haut niveau. Les événements live sont impressionnants.', 'fortnite-banner.jpg', 'fortnite-card.jpg', '2026-05-17 14:30:00', 1),
(36, 'Counter-Strike 2', 'L’évolution du FPS compétitif', 'Counter-Strike 2 modernise le célèbre FPS compétitif avec un nouveau moteur graphique et des améliorations techniques tout en conservant son gameplay original basé sur la précision.', 8.8, 'CS2 conserve l’essence de Counter-Strike tout en améliorant la technique. Le jeu reste extrêmement compétitif et exigeant. La moindre erreur peut coûter une manche.', 'Un jeu toujours aussi stressant mais satisfaisant quand on progresse.', 'counter-strike-2-banner.jpg', 'counter-strike-2-card.jpg', '2026-05-17 14:35:00', 1),
(37, 'League of Legends', 'Le MOBA le plus influent', 'League of Legends oppose deux équipes de cinq joueurs dans un combat stratégique où chaque champion possède des compétences uniques.', 8.6, 'LoL reste une référence du genre MOBA. Sa profondeur stratégique est immense et la scène esport est l’une des plus développées au monde. Cependant, la communauté peut être toxique.', 'Très addictif mais parfois frustrant. Chaque partie est différente.', 'league-of-legends-banner.jpg', 'league-of-legends-card.jpg', '2026-05-17 14:40:00', 1),
(38, 'Hollow Knight', 'Un chef-d’œuvre indépendant', 'Hollow Knight est un jeu de type metroidvania où le joueur explore un monde souterrain rempli de créatures étranges et de secrets.', 9.4, 'Un jeu indépendant d’une qualité exceptionnelle. L’ambiance sonore et visuelle est remarquable. Le gameplay est précis et exigeant.', 'L’un des meilleurs jeux indépendants que j’ai joués. L’atmosphère est incroyable.', 'hollow-knight-banner.jpg', 'hollow-knight-card.jpg', '2026-05-17 14:45:00', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=331 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id_comment`, `content`, `note`, `date_add`, `id_user`, `id_article`) VALUES
(3, 'Super ambiance futuriste', 8.0, '2026-05-05 20:18:30', 1, 1),
(6, 'Plein de quêtes variées. Une histoire prenante. Génial du début à la fin', 9.0, '2026-05-05 20:39:46', 2, 2),
(8, 'J\'adore la customisation du personnage', 6.4, '2026-05-05 21:06:32', 2, 1),
(115, 'Night City est incroyable visuellement, je me suis perdu dedans pendant des heures.', 9.0, '2026-05-17 15:04:22', 5, 1),
(116, 'Le scénario principal est vraiment prenant et certains personnages sont excellents.', 8.5, '2026-05-17 15:04:22', 6, 1),
(117, 'Depuis les mises à jour le jeu est beaucoup plus agréable à jouer.', 8.0, '2026-05-17 15:04:22', 7, 1),
(118, 'Les quêtes secondaires sont parfois meilleures que la quête principale.', 9.2, '2026-05-17 15:04:22', 8, 1),
(119, 'J’adore les possibilités de personnalisation du personnage.', 8.7, '2026-05-17 15:04:22', 9, 1),
(120, 'Geralt reste un des meilleurs personnages du jeu vidéo.', 9.5, '2026-05-17 15:04:22', 10, 2),
(121, 'Les contrats de sorceleur sont super bien écrits.', 9.1, '2026-05-17 15:04:22', 11, 2),
(122, 'Le monde est immense mais reste toujours intéressant à explorer.', 9.4, '2026-05-17 15:04:22', 12, 2),
(123, 'Les extensions sont quasiment des jeux complets.', 9.8, '2026-05-17 15:04:22', 13, 2),
(124, 'Une vraie référence du RPG moderne.', 9.6, '2026-05-17 15:04:22', 14, 2),
(125, 'Chaque zone cache quelque chose d’intéressant.', 9.3, '2026-05-17 15:04:22', 15, 3),
(126, 'Les boss sont difficiles mais très satisfaisants à battre.', 9.0, '2026-05-17 15:04:22', 16, 3),
(127, 'Le monde ouvert fonctionne parfaitement avec la formule Souls.', 9.4, '2026-05-17 15:04:22', 17, 3),
(128, 'Certaines zones sont magnifiques et inquiétantes à la fois.', 8.9, '2026-05-17 15:04:22', 5, 3),
(129, 'Le level design est vraiment impressionnant.', 9.1, '2026-05-17 15:04:22', 6, 3),
(130, 'Arthur Morgan est un personnage incroyable.', 9.8, '2026-05-17 15:04:22', 7, 4),
(131, 'Le jeu est lent mais l’immersion est exceptionnelle.', 9.4, '2026-05-17 15:04:22', 8, 4),
(132, 'Chaque détail du monde donne envie de continuer à explorer.', 9.7, '2026-05-17 15:04:22', 9, 4),
(133, 'Les animations sont ultra réalistes.', 9.1, '2026-05-17 15:04:22', 10, 4),
(134, 'Une des meilleures histoires que j’ai vues dans un jeu.', 9.9, '2026-05-17 15:04:22', 11, 4),
(135, 'Explorer Poudlard était un rêve de gosse.', 8.0, '2026-05-17 15:04:22', 12, 5),
(136, 'Le système de combat est plus fun que prévu.', 7.8, '2026-05-17 15:04:22', 13, 5),
(137, 'Le scénario manque un peu de profondeur mais reste sympa.', 7.2, '2026-05-17 15:04:22', 14, 5),
(138, 'Les décors sont magnifiques.', 8.1, '2026-05-17 15:04:22', 15, 5),
(139, 'Très bon jeu pour les fans de Harry Potter.', 8.4, '2026-05-17 15:04:22', 16, 5),
(140, 'Les paysages nordiques sont super beaux.', 7.9, '2026-05-17 15:04:22', 17, 6),
(141, 'Le jeu est un peu trop long mais reste agréable.', 7.5, '2026-05-17 15:04:22', 5, 6),
(142, 'Les raids vikings sont fun au début.', 7.3, '2026-05-17 15:04:22', 6, 6),
(143, 'Eivor est un personnage plutôt réussi.', 8.0, '2026-05-17 15:04:22', 7, 6),
(144, 'Le gameplay devient répétitif après plusieurs dizaines d’heures.', 6.9, '2026-05-17 15:04:22', 8, 6),
(145, 'La liberté offerte est incroyable.', 9.9, '2026-05-17 15:04:22', 9, 7),
(146, 'Je découvre encore des choses après des dizaines d’heures.', 9.7, '2026-05-17 15:04:22', 10, 7),
(147, 'L’exploration est probablement la meilleure du genre.', 10.0, '2026-05-17 15:04:22', 11, 7),
(148, 'Chaque montagne donne envie d’être escaladée.', 9.5, '2026-05-17 15:04:22', 12, 7),
(149, 'Le jeu récompense constamment la curiosité.', 9.8, '2026-05-17 15:04:22', 13, 7),
(150, 'Kratos et Atreus sont toujours aussi intéressants.', 9.5, '2026-05-17 15:04:22', 14, 8),
(151, 'Les combats sont très satisfaisants.', 9.3, '2026-05-17 15:04:22', 15, 8),
(152, 'La mise en scène est impressionnante.', 9.4, '2026-05-17 15:04:22', 16, 8),
(153, 'Certains boss sont mémorables.', 9.2, '2026-05-17 15:04:22', 17, 8),
(154, 'L’histoire est vraiment touchante par moments.', 9.1, '2026-05-17 15:04:22', 5, 8),
(155, 'Les combats contre les Primordiaux sont spectaculaires.', 8.7, '2026-05-17 15:04:22', 6, 9),
(156, 'Clive est un protagoniste réussi.', 8.2, '2026-05-17 15:04:22', 7, 9),
(157, 'La bande-son est excellente.', 8.9, '2026-05-17 15:04:22', 8, 9),
(158, 'Certaines quêtes secondaires cassent un peu le rythme.', 7.4, '2026-05-17 15:04:22', 9, 9),
(159, 'Très bon épisode malgré son orientation plus action.', 8.1, '2026-05-17 15:04:22', 10, 9),
(160, 'Se balancer dans New York est toujours aussi fun.', 9.0, '2026-05-17 15:04:22', 11, 10),
(161, 'Les combats sont très dynamiques.', 8.8, '2026-05-17 15:04:22', 12, 10),
(162, 'Miles et Peter fonctionnent super bien ensemble.', 8.9, '2026-05-17 15:04:22', 13, 10),
(163, 'Le rythme du jeu est excellent.', 8.7, '2026-05-17 15:04:22', 14, 10),
(164, 'Certaines missions secondaires sont un peu oubliables.', 7.8, '2026-05-17 15:04:22', 15, 10),
(165, 'Les musiques restent dans la tête pendant des jours.', 9.6, '2026-05-17 15:04:22', 16, 24),
(166, 'Les personnages sont ultra attachants.', 9.4, '2026-05-17 15:04:22', 17, 24),
(167, 'Le style visuel du jeu est incroyable.', 9.5, '2026-05-17 15:04:22', 5, 24),
(168, 'Le système de combat est excellent.', 9.2, '2026-05-17 15:04:22', 6, 24),
(169, 'Le jeu est long mais jamais ennuyeux.', 9.3, '2026-05-17 15:04:22', 7, 24),
(170, 'L’ambiance est encore meilleure que dans l’original.', 9.3, '2026-05-17 15:04:22', 8, 26),
(171, 'Le gameplay est vraiment nerveux.', 9.1, '2026-05-17 15:04:22', 9, 26),
(172, 'Capcom a parfaitement modernisé le jeu.', 9.4, '2026-05-17 15:04:22', 10, 26),
(173, 'Les combats contre les villageois sont stressants.', 8.8, '2026-05-17 15:04:22', 11, 26),
(174, 'Très bon remake.', 9.0, '2026-05-17 15:04:22', 12, 26),
(175, 'Le gameplay est spécial mais l’ambiance est unique.', 8.0, '2026-05-17 15:04:22', 13, 28),
(176, 'Les musiques pendant les trajets sont incroyables.', 8.7, '2026-05-17 15:04:22', 14, 28),
(177, 'Le jeu demande de la patience.', 7.5, '2026-05-17 15:04:22', 15, 28),
(178, 'L’univers imaginé par Kojima est fascinant.', 8.9, '2026-05-17 15:04:22', 16, 28),
(179, 'Une expérience très différente des autres jeux AAA.', 8.4, '2026-05-17 15:04:22', 17, 28),
(330, 'J\'aime pas, ça fait un peu trop peur pour moi', 4.0, '2026-05-17 15:56:32', 1, 26);

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
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `role`, `answer`, `date_subscription`) VALUES
(1, 'Eliyahu06', 'elinevermeulen06@gmail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'admin', 'kangoo', '2026-04-25 15:55:33'),
(2, 'GeaiMoqueur18', 'wimmer.lau@gmail.com', '$2y$10$CiIf2JDJFO.pBYwJ1kKPR.IcOxKhrpd18H7jjj7AsWYfKbu091Afa', 'user', 'korra', '2026-04-25 16:33:52'),
(4, 'Eliyahu', 'eline@gmail.com', '$2y$10$4ihX1KCpEAtCkBlUCIX.y.6fo6AklD5E3dKfwkwYnp4dGaoSLnNM.', 'user', 'kangoo', '2026-05-14 17:23:40'),
(5, 'alex92', 'alex92@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Rex Luthor', '2026-05-14 19:42:05'),
(6, 'lina_dev', 'lina@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Miaou Lino', '2026-05-14 19:42:05'),
(7, 'maxgaming', 'max@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Maxi Croc', '2026-05-14 19:42:05'),
(8, 'sophie_b', 'sophie@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Sofi Cat', '2026-05-14 19:42:05'),
(9, 'julienx', 'julien@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Julien Le Chien', '2026-05-14 19:42:05'),
(10, 'emma_art', 'emma@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Emmato', '2026-05-14 19:42:05'),
(11, 'tom_player', 'tom@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Tommy Tiger', '2026-05-14 19:42:05'),
(12, 'lucie89', 'lucie@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Lucie Lupin', '2026-05-14 19:42:05'),
(13, 'nathan_k', 'nathan@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Nathan Croquette', '2026-05-14 19:42:05'),
(14, 'camille77', 'camille@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Camille Caramel', '2026-05-14 19:42:05'),
(15, 'leo_pixel', 'leo@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Léo Pattes', '2026-05-14 19:42:05'),
(16, 'jade_m', 'jade@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Jade Purr', '2026-05-14 19:42:05'),
(17, 'antoine34', 'antoine@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Tony Rex', '2026-05-14 19:42:05'),
(21, 'pixelnova', 'pixelnova@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Moustik', '2026-05-17 14:56:39'),
(22, 'darksave', 'darksave@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Biscotte', '2026-05-17 14:56:39'),
(23, 'lunaris', 'lunaris@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Pikachu', '2026-05-17 14:56:39'),
(24, 'neonblade', 'neonblade@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Cookie', '2026-05-17 14:56:39'),
(25, 'astrobyte', 'astrobyte@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Sushi', '2026-05-17 14:56:39'),
(26, 'retrocat', 'retrocat@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Minou', '2026-05-17 14:56:39'),
(27, 'vortexplay', 'vortexplay@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Patate', '2026-05-17 14:56:39'),
(28, 'frostbyte', 'frostbyte@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Tigrou', '2026-05-17 14:56:39'),
(29, 'shadowlink', 'shadowlink@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Yoshi', '2026-05-17 14:56:39'),
(30, 'crystalfox', 'crystalfox@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Plume', '2026-05-17 14:56:39'),
(31, 'stormrage', 'stormrage@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Rex', '2026-05-17 14:56:39'),
(32, 'arcadia', 'arcadia@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Kira', '2026-05-17 14:56:39'),
(33, 'ghostframe', 'ghostframe@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Nugget', '2026-05-17 14:56:39'),
(34, 'quantumjoy', 'quantumjoy@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Moka', '2026-05-17 14:56:39'),
(35, 'silentarrow', 'silentarrow@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Cactus', '2026-05-17 14:56:39'),
(36, 'meowzilla', 'meowzilla@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Chaussette', '2026-05-17 14:56:39'),
(37, 'ultrakai', 'ultrakai@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Croquette', '2026-05-17 14:56:39'),
(38, 'midnightxp', 'midnightxp@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Pepito', '2026-05-17 14:56:39'),
(39, 'auroragame', 'auroragame@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Bounty', '2026-05-17 14:56:39'),
(40, 'bytehunter', 'bytehunter@mail.com', '$2y$10$56QTVMBvTgRv.9qa3B9YKO0/Od8oFsPBKA92yb7KxFmiQtqa8y.Mq', 'user', 'Shadow', '2026-05-17 14:56:39');

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
