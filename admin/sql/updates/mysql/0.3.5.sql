# SQL-file for the 0.3.5 update
ALTER TABLE `#__ttlivescore_countries`
ADD `rankingprefix` char(10) NOT NULL default '';

ALTER TABLE `#__ttlivescore_seasondetails`
DROP COLUMN `rankingprefix`;

INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_BOSNIAANDHERZEGOVINA', 'BIH');
INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_CHINA', 'CHN');
INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_CROATIA', 'CRO');
INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_FRANCE', 'FRA');
INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_ENGLAND', 'ENG');
INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_ITALY', 'ITA');
INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_LITUANIA', 'LTU');
INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_NIGERIA', 'NGR');
INSERT INTO `#__ttlivescore_countries` (name,ioc_code) VALUES ('COM_TTLIVESCORE_COUNTRY_WALES', 'WAL');
