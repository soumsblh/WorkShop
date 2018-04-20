-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 24 Avril 2017 à 14:25
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `labonnesortie`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `role` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token_forget` varchar(250) NOT NULL,
  `date_forget` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `role`, `email`, `password`, `token_forget`, `date_forget`) VALUES
(1, 'test', 'test', 'test', 'admin', 'test@test.com', '$2y$10$OscyPzEqWpvUpVEBukBz..Ofno0lgR8xStxRJpDhmrlwSlQ2UHMz.', '', '0000-00-00 00:00:00'),
(2, 'test1', 'test1', 'test1', 'admin', 'test1@test1.com', '$2y$10$Khn8wa5EPKbwU0cF//.t6.aIaCl/edM9cYtegCcewGsav9HxXAVay', 'bc1d2016f5ceedce36ed51f74251fb68', '2017-04-25 01:16:04'),
(3, 'mathieu', 'mathieu', 'mathieu', 'admin', 'mathieu@mathieu.com', '$2y$10$jpwWuaiPZn5THiUJngWiNerWrfl/fv66AqitmcRigRnSJtCabjGRS', 'ca93fd44a3d5d1d874a57c27277d3121', '2017-04-25 12:29:10');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
