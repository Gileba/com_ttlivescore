CREATE TABLE IF NOT EXISTS `#__ttlivescore_players` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT, 
	`firstname` varchar(250) NOT NULL DEFAULT '',
	`lastname` varchar(250) NOT NULL DEFAULT '',
	`middlename` varchar(250),
	`published` tinyint(1) NOT NULL DEFAULT '1',
	`image` varchar(255),
	`country` char(3) NOT NULL DEFAULT '0',
	`dateofbirth` date,
	`publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
	`publish_down` datetime NOT NULL default '0000-00-00 00:00:00',
	`sex` varchar(1) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `#__ttlivescore_clubs` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT, 
	`name` varchar(250) NOT NULL DEFAULT '',
	`published` tinyint(1) NOT NULL DEFAULT '1',
	`emblem` varchar(255),
	`country` char(3) NOT NULL DEFAULT '0',
	`publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
	`publish_down` datetime NOT NULL default '0000-00-00 00:00:00',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `#__ttlivescore_countries` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT, 
	`name` varchar(250) NOT NULL DEFAULT '',
	`published` tinyint(1) NOT NULL DEFAULT '1',
	`ordering` int(3) NOT NULL DEFAULT '1',
	`ioc_code` char(3) NOT NULL DEFAULT '',
	`publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
	`publish_down` datetime NOT NULL default '0000-00-00 00:00:00',
	PRIMARY KEY (`id`), UNIQUE (`ioc_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_BELGIUM', 'BEL');
INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_THENETHERLANDS', 'NED');
CREATE TABLE IF NOT EXISTS `#__ttlivescore_seasons` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT, 
	`name` varchar(250) NOT NULL DEFAULT '',
	`published` tinyint(1) NOT NULL DEFAULT '1',
	`ordering` int(3) NOT NULL DEFAULT '1',
	`country` char(3) NOT NULL DEFAULT '',
	`publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
	`publish_down` datetime NOT NULL default '0000-00-00 00:00:00',
	`startdate` date NOT NULL default '0000-00-00',
	`enddate` date NOT NULL default '0000-00-00',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `#__ttlivescore_seasondetails` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT, 
	`season` int(10) NOT NULL DEFAULT '0',
	`player` int(10) NOT NULL DEFAULT '0',
	`club` int(10) NOT NULL DEFAULT '0',
	`localranking` char(10) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`), CONSTRAINT `SeasonPlayer` UNIQUE (`season`, `player`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
