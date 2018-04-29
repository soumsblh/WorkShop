
CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `siren` varchar(255) NOT NULL,
  `RaisonSocial` VARCHAR(20),
  `username` varchar(100) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Latitude` DECIMAL(9,6),
  `Longitude` DECIMAL(9,6),
  `Tel` VARCHAR(10),
  `role` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token_forget` varchar(250) NOT NULL,
  `date_forget` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
