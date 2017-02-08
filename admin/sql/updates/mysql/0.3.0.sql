#SQL File for version 0.3.0
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
