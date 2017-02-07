# SQL-file for the 0.2.3 update
ALTER TABLE `#__ttlivescore_countries` DROP column 'order';
ALTER TABLE `#__ttlivescore_countries` ADD column 'ordering' int(3) NOT NULL DEFAULT '999';