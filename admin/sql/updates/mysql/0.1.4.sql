# SQL-file for the 0.1.4 update
UPDATE `#__ttlivescore_players` SET country='BEL' WHERE country='1';
UPDATE `#__ttlivescore_players` SET country='NED' WHERE country='2';
ALTER TABLE `#__ttlivescore_players`
ADD `publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
ADD `publish_down` datetime NOT NULL default '0000-00-00 00:00:00';