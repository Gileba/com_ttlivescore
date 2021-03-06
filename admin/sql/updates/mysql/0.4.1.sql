# SQL-file for the 0.4.1 update
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
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
