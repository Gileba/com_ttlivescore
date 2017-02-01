CREATE TABLE IF NOT EXISTS `#__ttlivescore_players` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT, 
	`firstname` varchar(250) NOT NULL DEFAULT '',
	`lastname` varchar(250) NOT NULL DEFAULT '',
	`middlename` varchar(250),
	`published` tinyint(1) NOT NULL DEFAULT '1',
	`image` varchar(255),
	`country` varchar(255) NOT NULL DEFAULT '0',
	`dateofbirth` date,
	`publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
	`publish_down` datetime NOT NULL default '0000-00-00 00:00:00',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;