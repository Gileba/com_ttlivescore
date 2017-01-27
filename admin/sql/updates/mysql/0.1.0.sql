# SQL file for version 0.1.0
ALTER TABLE `#__ttlivescore_players`
ADD `middlename` varchar(250) DEFAULT ``,
ADD `published` tinyint(1) NOT NULL DEFAULT `0`,
ADD `image` varchar(255),
ADD `country` varchar(255) NOT NULL DEFAULT `0`;
