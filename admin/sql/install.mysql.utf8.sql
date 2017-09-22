CREATE TABLE IF NOT EXISTS `#__ttlivescore_players` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT, 
	`firstname` varchar(250) NOT NULL DEFAULT '',
	`lastname` varchar(250) NOT NULL DEFAULT '',
	`middlename` varchar(250),
	`published` tinyint(1) NOT NULL DEFAULT '1',
	`image` varchar(255),
	`country` char(3) NOT NULL DEFAULT '0',
	`dateofbirth` date DEFAULT '0000-00-00 00:00:00',
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
	`ordering` int(3) NOT NULL DEFAULT '999',
	`ioc_code` char(3) NOT NULL DEFAULT '',
	`publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
	`publish_down` datetime NOT NULL default '0000-00-00 00:00:00',
	`rankingprefix`char(10) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`), UNIQUE (`ioc_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_BELGIUM', 'BEL', 1);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_BOSNIAANDHERZEGOVINA', 'BIH', 2);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_CANADA', 'CAN', 3);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_CHINA', 'CHN', 4);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_CROATIA', 'CRO', 5);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_DENMARK', 'DEN', 6);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_EGYPT', 'EGY', 7);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_ENGLAND', 'ENG', 8);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_FRANCE', 'FRA', 9);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_GERMANY', 'GER', 10);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_GREECE', 'GRE', 11);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_IRAN', 'IRI', 12);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_ITALY', 'ITA', 13);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_LITHUANIA', 'LTU', 14);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_THENETHERLANDS', 'NED', 15);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_NIGERIA', 'NGR', 16);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_POLAND', 'POL', 17);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_PORTUGAL', 'POR', 18);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_RUSSIA', 'RUS', 19);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_SWEDEN', 'SWE', 20);
INSERT INTO `#__ttlivescore_countries` (name,ioc_code, ordering) VALUES ('COM_TTLIVESCORE_COUNTRY_WALES', 'WAL', 21);
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
CREATE TABLE IF NOT EXISTS `#__ttlivescore_matchdefinitions` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT, 
	`name` varchar(250) NOT NULL DEFAULT '',
	`published` tinyint(1) NOT NULL DEFAULT '1',
	`publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
	`publish_down` datetime NOT NULL default '0000-00-00 00:00:00',
	`ordering` int(3) NOT NULL DEFAULT '1',
	`players` int(3) NOT NULL DEFAULT '3',
	`reserves` int(3) NOT NULL DEFAULT '0',
	`matches` int(2) NOT NULL DEFAULT '5',
	`matchorderhome` varchar(255) NOT NULL DEFAULT '',
	`matchorderaway` varchar(255) NOT NULL DEFAULT '',
	`sets` int(1) NOT NULL DEFAULT '5',
	`reservesallowed` varchar(255) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`), UNIQUE (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `#__ttlivescore_clubmatches` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT, 
	`sid` int(10) unsigned NOT NULL DEFAULT '0', 
	`mdid` int(10) unsigned NOT NULL DEFAULT '0', 
	`date` datetime NOT NULL default '0000-00-00 00:00:00',
	`homeclub` int(10) unsigned NOT NULL DEFAULT '0',
	`awayclub` int(10) unsigned NOT NULL DEFAULT '0',
	`homeplayers` varchar(255) NOT NULL DEFAULT '',
	`awayplayers` varchar(255) NOT NULL DEFAULT '',
	`homereserves` varchar(255) NOT NULL DEFAULT '',
	`awayreserves` varchar(255) NOT NULL DEFAULT '',
	`livescorescreated` bool NOT NULL DEFAULT false,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `#__ttlivescore_livescores` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT, 
	`cmid` int(10) unsigned NOT NULL DEFAULT '0', 
	`matchid` tinyint unsigned NOT NULL DEFAULT '0',
	`homeplayerid` int(10) unsigned NOT NULL DEFAULT '0',
	`awayplayerid` int(10) unsigned NOT NULL DEFAULT '0',
	`homepointsset1` tinyint unsigned NOT NULL DEFAULT '0',
	`homepointsset2` tinyint unsigned NOT NULL DEFAULT '0',
	`homepointsset3` tinyint unsigned NOT NULL DEFAULT '0',
	`homepointsset4` tinyint unsigned NOT NULL DEFAULT '0',
	`homepointsset5` tinyint unsigned NOT NULL DEFAULT '0',
	`homepointsset6` tinyint unsigned NOT NULL DEFAULT '0',
	`homepointsset7` tinyint unsigned NOT NULL DEFAULT '0',
	`awaypointsset1` tinyint unsigned NOT NULL DEFAULT '0',
	`awaypointsset2` tinyint unsigned NOT NULL DEFAULT '0',
	`awaypointsset3` tinyint unsigned NOT NULL DEFAULT '0',
	`awaypointsset4` tinyint unsigned NOT NULL DEFAULT '0',
	`awaypointsset5` tinyint unsigned NOT NULL DEFAULT '0',
	`awaypointsset6` tinyint unsigned NOT NULL DEFAULT '0',
	`awaypointsset7` tinyint unsigned NOT NULL DEFAULT '0',
	`service` char(1) NOT NULL DEFAULT 'H',
	`active` bool NOT NULL DEFAULT false,
	PRIMARY KEY (`id`), CONSTRAINT UNIQUE (`cmid`, `matchid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
