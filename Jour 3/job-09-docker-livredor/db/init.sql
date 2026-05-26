-- Dump SQL simplifie pour l'initialisation Docker

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Table structure for table `commentaires`
-- --------------------------------------------------------

CREATE TABLE `commentaires` (
  `id` int NOT NULL,
  `commentaire` text NOT NULL,
  `id_utilisateur` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table `commentaires`

INSERT INTO `commentaires` (`id`, `commentaire`, `id_utilisateur`, `date`) VALUES
(1, 'Dans ce jardin du code où fleurit l’harmonie,\r\nChaque pixel respire un parfum d’alchimie.\r\nSous les doigts des créateurs s’éveille la lumière,\r\nEt l’écran devient l’onde où danse la matière.\r\n\r\nOn y sent la pensée, subtile et généreuse,\r\nTracer des sentiers clairs sur la toile heureuse.\r\nLe détail est poème, la couleur confidence,\r\nChaque page un voyage, chaque clic une danse.\r\n\r\nTout respire équilibre, élégance et justesse,\r\nL’œil s’y perd, charmé, dans tant de politesse.\r\nCe n’est plus un simple site — c’est une œuvre en éveil,\r\nUn lieu où le numérique prend un souffle vermeil.\r\n\r\nLe code, ici, devient langage et prière,\r\nTissée d’or et d’esprit, d’audace et de lumière.\r\nOn sent, à chaque ligne, un cœur qui s’est donné,\r\nUn rêve mis en forme, un monde façonné.\r\n\r\nQue ceux qui passeront laissent trace et mémoire,\r\nDe leur joie, de leur grâce, de leur petit espoir.\r\nCar ce lieu est vivant, vibrant d’émotion pure,\r\nUn écho du futur où l’art et l’âme murmurent.\r\n\r\nBravo, mille fois bravo, aux esprits artisans,\r\nQui font d’un simple clic un instant éclatant.\r\nPuisse ce livre d’or garder longtemps la trace,\r\nDes mots reconnaissants semés dans cet espace.', 1, '2025-11-09 22:38:54'),
(2, 'Jadis, sous le nom de Sylvain, j’avais laissé ici quelques mots d’émerveillement.\r\nAujourd’hui, me voici revenu,\r\ndevenu Silver,\r\npour prolonger cette trace et redire, en vers, tout le bien que j’en pense.\r\n\r\nDans ce jardin du code où fleurit l’harmonie,\r\nChaque pixel respire un parfum d’alchimie.\r\nSous les doigts des créateurs s’éveille la lumière,\r\nEt l’écran devient l’onde où danse la matière.\r\n\r\nOn y sent la pensée, subtile et généreuse,\r\nTracer des sentiers clairs sur la toile heureuse.\r\nLe détail est poème, la couleur confidence,\r\nChaque page un voyage, chaque clic une danse.\r\n\r\nTout respire équilibre, élégance et justesse,\r\nL’œil s’y perd, charmé, dans tant de politesse.\r\nCe n’est plus un simple site — c’est une œuvre en éveil,\r\nUn lieu où le numérique prend un souffle vermeil.\r\n\r\nLe code, ici, devient langage et prière,\r\nTissée d’or et d’esprit, d’audace et de lumière.\r\nOn sent, à chaque ligne, un cœur qui s’est donné,\r\nUn rêve mis en forme, un monde façonné.\r\n\r\nQue ceux qui passeront laissent trace et mémoire,\r\nDe leur joie, de leur grâce, de leur petit espoir.\r\nCar ce lieu est vivant, vibrant d’émotion pure,\r\nUn écho du futur où l’art et l’âme murmurent.\r\n\r\nBravo, mille fois bravo, aux esprits artisans,\r\nQui font d’un simple clic un instant éclatant.\r\nPuisse ce livre d’or garder longtemps la trace,\r\nDes mots reconnaissants semés dans cet espace.\r\n\r\n— Silver (anciennement Sylvain)', 1, '2025-11-09 23:28:17'),
(3, 'Sylvain, va dormir ! :-)', 1, '2025-11-09 23:29:27'),
(4, 'C\'est avec beaucoup de plaisir que je signe ce livre d\'or. Cette visite a été une véritable découverte et je garde un excellent souvenir de l\'accueil chaleureux reçu. L\'atmosphère était agréable, et tous les détails ont été soignés. Merci pour cette belle expérience, c\'est le genre de moment qu\'on n\'oublie pas facilement. Je recommande vivement à tous mes proches !', 1, '2025-11-09 23:30:39'),
(5, 'Je pense donc je suis.', 1, '2025-11-10 11:12:17'),
(6, 'Je pense donc je suis la sœur de Sylvain... ou pas.\r\n\r\nSylvain alias Silver aka Shiruban - pseudo "Stéphanie" (comme ma sœur)', 2, '2025-11-10 11:23:58'),
(7, '<script>alert(\'ok\');</script>', 2, '2025-11-10 14:32:10');

-- --------------------------------------------------------
-- Table structure for table `utilisateurs`
-- --------------------------------------------------------

CREATE TABLE `utilisateurs` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table `utilisateurs`

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'Shiruban', '$2y$10$mENPdh49poBILx3L/T9aH.GzQa9JOhV0hpqLdHa49694R0EPgBgQG'),
(2, 'Stéphanie', '$2y$10$41uZIDOxavSio04mayB7L.Q20tSUkXSnlDTnvgV2Id0croZMGsFo6'),
(3, 'Léo', '$2y$10$u0rchlkFrSU2IBAgT0NUqO/O9e/Y3xOh1KBTC14HGVhURoyuejDgS');

-- --------------------------------------------------------
-- Indexes for dumped tables
-- --------------------------------------------------------

ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------
-- AUTO_INCREMENT for dumped tables
-- --------------------------------------------------------

ALTER TABLE `commentaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `utilisateurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- --------------------------------------------------------
-- Constraints for dumped tables
-- --------------------------------------------------------

ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
