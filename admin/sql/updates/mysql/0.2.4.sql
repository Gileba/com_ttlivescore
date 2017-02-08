# SQL file for version 0.2.4
ALTER TABLE `#__ttlivescore_players` ALTER COLUMN `country` char(3) NOT NULL DEFAULT '0';
ALTER TABLE `#__ttlivescore_clubs` ALTER COLUMN `country` char(3) NOT NULL DEFAULT '0';