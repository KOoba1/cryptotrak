CREATE DATABASE CryptoTrak ;

/*
CREATE TABLE ScrapedData ( 
  id MEDIUMINT NOT NULL AUTO_INCREMENT,
  CoinName VARCHAR(200),
  CoinId INT, 
  LowestAsk DECIMAL(10,9),
  HighestBid DECIMAL(10,9), 
   PRIMARY KEY (id)

); */  

CREATE TABLE CoinPrice (
	  id INT NOT NULL AUTO_INCREMENT,
  CoinName VARCHAR(200),
  CoinId VARCHAR(200), 
  BitcoinPrice DECIMAL(16,16) ,
  EntryDate  DATETIME DEFAULT CURRENT_TIMESTAMP, 
   PRIMARY KEY (id)

);


CREATE TABLE BitcoinPrice (
	  id INT NOT NULL AUTO_INCREMENT,
  Currency VARCHAR(200), 
  Value DECIMAL(12,2) , 
  Symbol VARCHAR(20), 
  EntryDate  DATETIME DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (id)

);

/*
"BTC_XEM": {
		"id": 112,
		"last": "0.00004079",
		"lowestAsk": "0.00004080",
		"highestBid": "0.00004079",
		"percentChange": "0.14321748",
		"baseVolume": "5558.11015259",
		"quoteVolume": "143190532.32223967",
		"isFrozen": "0",
		"high24hr": "0.00004200",
		"low24hr": "0.00003540"
	},
	
	*/ 

