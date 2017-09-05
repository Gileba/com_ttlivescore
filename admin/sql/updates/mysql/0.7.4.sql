# SQL-file for the 0.7.4 update
ALTER TABLE `#__ttlivescore_countries` ALTER COLUMN `ordering` SET DEFAULT '999';
INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_RUSSIA', 'RUS');
INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_GREECE', 'GRE');
INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_EGYPT', 'EGY');
INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_POLAND', 'POL');
INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_SWEDEN', 'SWE');
INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_CANADA', 'CAN');
