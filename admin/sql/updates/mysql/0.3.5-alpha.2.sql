# SQL-file for the 0.3.5 update
ALTER TABLE `#__ttlivescore_countries`
ADD `rankingprefix` char(10) NOT NULL default '';
ALTER TABLE `#__ttlivescore_seasondetails`
DROP COLUMN `rankingprefix`;