USE db_partners;
LOAD DATA LOCAL INFILE  'partners.csv'
INTO TABLE table_partners
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;