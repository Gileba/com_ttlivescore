# SQL-file for the 0.7.9 update
ALTER TABLE `#__ttlivescore_countries` ALTER COLUMN `ordering` SET DEFAULT '999';
INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_BELARUS', 'BLR');
INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_UKRAINE', 'UKR');
