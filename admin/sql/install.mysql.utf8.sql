CREATE TABLE IF NOT EXISTS `#__ttlivescore_players` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT, 
	`firstname` varchar(250) NOT NULL DEFAULT ``,
	`lastname` varchar(250) NOT NULL DEFAULT ``,
	`middlename` varchar(250) DEFAULT ``,
	`published` tinyint(1) NOT NULL DEFAULT `0`,
	`image` varchar(255),
	`country` varchar(255) NOT NULL DEFAULT `0`,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;