CREATE TABLE IF NOT EXISTS `candidate` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `directory` varchar(255) NOT NULL,
  `reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `voteres` (
  `vid` int(11) NOT NULL,
  `dirname` varchar(255) NOT NULL,
  `selection` varchar(255) NOT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `choice` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
CREATE TABLE IF NOT EXISTS `voters` (
  `id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `val` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
