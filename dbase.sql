CREATE TABLE IF NOT EXISTS `candidate` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `directory` varchar(255) NOT NULL,
  `reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
