# SQL-file for the 0.4.0 update
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
	`md.sets` int(1) NOT NULL DEFAULT '5',
	`reservesallowed` varchar(255) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`), UNIQUE `name`
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
