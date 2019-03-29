CREATE TABLE Cost(
cost_avg	INTEGER,
	budget_type	VARCHAR(50),
	PRIMARY KEY (cost_avg)
);

CREATE TABLE Person(
	p_ID	INTEGER,
	name	VARCHAR(50),
	password VARCHAR(50),
PRIMARY KEY (p_ID)
);

CREATE TABLE Classification(
	city_population	INTEGER,
	classification	VARCHAR(50),
	PRIMARY KEY (city_population)
);

CREATE TABLE Address(
	address	VARCHAR(500),
	lat		DECIMAL,
	lon		DECIMAL,
	PRIMARY KEY (address)
);

CREATE TABLE StarRating(
	rating		INTEGER, 
	stars	 	INTEGER, 
	PRIMARY KEY (rating)
);

CREATE TABLE Country(
	country_ID	INTEGER NOT NULL AUTO_INCREMENT, 
	name		VARCHAR(50),
	language 	VARCHAR(50),
	population	INTEGER,
	currency	VARCHAR(50),
	PRIMARY KEY (country_ID)
);

CREATE TABLE City(
	city_name		VARCHAR(50),
	country_ID		INTEGER,
	city_population 	INTEGER,
	lat			DECIMAL,
	lon			DECIMAL,
	PRIMARY KEY (country_ID, city_name), 	
FOREIGN KEY (country_ID) REFERENCES Country(country_ID),
	FOREIGN KEY (city_population) REFERENCES Classification(city_population)
);


CREATE TABLE Destination(
	dest_ID		INTEGER NOT NULL AUTO_INCREMENT, 
	city_name		VARCHAR(50),
	country_ID		INTEGER,
	name			VARCHAR(50),
	pic_url		VARCHAR(1000),
	ranking		INTEGER,
	description		VARCHAR(50),
	rating			INTEGER,
	visiting_hours	VARCHAR(50),
	address		VARCHAR(500),
	PRIMARY KEY (dest_ID),
FOREIGN KEY (country_ID, city_name) REFERENCES City(country_ID, city_name),
FOREIGN KEY (country_ID) REFERENCES Country(country_ID),
FOREIGN KEY (address) REFERENCES Address(address),
FOREIGN KEY (rating) REFERENCES StarRating(rating)
);

CREATE TABLE Activity(
	act_ID		INTEGER,
	name		VARCHAR(50),
	cost_avg	INTEGER,
PRIMARY KEY (act_ID),
	FOREIGN KEY (cost_avg) REFERENCES Cost(cost_avg)
);

CREATE TABLE Review(
	rev_ID		INTEGER NOT NULL AUTO_INCREMENT,
	p_ID		INTEGER,
	dest_ID	INTEGER,
	rating 	INTEGER,
	review		VARCHAR(50),
	PRIMARY KEY (rev_ID),
	FOREIGN KEY (p_ID) REFERENCES Person(p_ID),
	FOREIGN KEY (dest_ID) REFERENCES Destination(dest_ID)
		ON DELETE CASCADE
);


CREATE TABLE Recreation(
	act_ID 	INTEGER PRIMARY KEY,
	icon 		CHAR(50),
	FOREIGN KEY (act_ID) REFERENCES Activity(act_ID)
);

CREATE TABLE Tour(
	act_ID		INTEGER PRIMARY KEY,
	provider	CHAR(50),
	url		CHAR(50),
	duration	INTEGER,
	FOREIGN KEY (act_ID) REFERENCES Activity(act_ID) 
);

CREATE TABLE Destination_Activity(
	act_ID		INTEGER,
	dest_ID	INTEGER,
	PRIMARY KEY (act_ID, dest_ID),
	FOREIGN KEY (act_ID) REFERENCES Activity(act_ID),
	FOREIGN KEY (dest_ID) REFERENCES Destination(dest_ID)
  		ON DELETE CASCADE
);

CREATE TABLE Bucket_List(
	bl_ID			INTEGER PRIMARY KEY,
	p_ID 			INTEGER,
	title 			VARCHAR(50),
	date_modified 	DATE,
	FOREIGN KEY (p_ID) REFERENCES Person(p_ID)
);

CREATE TABLE Save_Bucket_List(
	bl_ID			INTEGER PRIMARY KEY,
	dest_ID		INTEGER,
	date_modified	DATE,
	FOREIGN KEY (dest_ID) REFERENCES Destination(dest_ID)
  		ON DELETE CASCADE
);

INSERT INTO Cost (cost_avg, budget_type)
VALUES (0, 'free'),
(15, 'cheap'),
(50, 'affordable'),
(100, 'expensive'),
(200, 'luxury');

INSERT INTO Person (p_ID, name, password)
VALUES (1, 'nada', 'pass'),
(2, 'rory', 'pass'),
(3, 'simeon', 'pass'),
(4, 'mayesha', 'pass'),
(5, 'hazra', 'pass');

INSERT INTO Classification (city_population, classification)
VALUES (8000000, 'large city'),
(720000, 'small city'),
(2000000, 'big city'),
(630000, 'small city'),
(9000000, 'large city');

INSERT INTO Address (address, lat, lon)
VALUES ('8 Shibakoen, Minato, Tokyo 105-0011, Japan', 35.7, 139.7),
('London SE1 9RA, UK', 51.53, -0.1),
('5 Avenue Anatole France, 75007 Paris, France', 48.8, 2.3),
('Space Needle, 400 Broad St, Seattle, WA 98109, USA', 47.6, -122.3),
('845 Avison Way, Vancouver, BC V6G 3E2', 49.3, -123.1);

INSERT INTO StarRating (rating, stars)
VALUES (1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

INSERT INTO Country (country_ID, name, language, population, currency)
VALUES (1, 'England', 'English', 55000000, 'Pound'),
(2, 'USA', 'English', 325000000, 'Dollar'),
(3, 'France', 'French',67000000, 'Euro'),
(4, 'Canada', 'English', 36000000, 'Dollar'),
(5, 'Japan', 'Japanese', 127000000, 'Yen');

INSERT INTO City (city_name, country_ID, city_population, lat, lon)
VALUES ('London', 1, 8000000, 51.5, -0.1),
('Seattle', 2, 720000, 47.6, -122.3),
('Paris', 3, 2000000, 48.8, 2.3),
('Vancouver', 4, 630000, 49.3, -123.1), 
('Tokyo', 5, 9000000, 35.7, 139.7);

INSERT INTO Destination (dest_ID, city_name, country_ID, name, pic_url, ranking, description, rating, visiting_hours, address)
VALUES
(NULL, 'Vancouver', 4, 'Delete Test', 'https://www.lifewire.com/thmb/dQbo7Yqlt3LMYGAUtJaHUOI4JPY=/768x0/filters:no_upscale():max_bytes(150000):strip_icc()/delete-gmail-59f2325768e1a2001028de4d.png', 1, 'destination we will delete', 1, '9-21', '845 Avison Way, Vancouver, BC V6G 3E2'), 
(NULL, 'Tokyo', 5, 'Tokyo Tower', 'https://cdn2.veltra.com/ptr/20151019025210_2135428681_10001_0.jpg?imwidth=550&impolicy=custom',4, 'tallest self-supporting steel', 5, '24 hours', '8 Shibakoen, Minato, Tokyo 105-0011, Japan'),
(NULL, 'London', 1, 'London Bridge', 'https://cdn.londonandpartners.com/study/assets/subject-guides/78282-640x360-subject-guide-engineering-640.jpg', 3, 'famous bridge in all of london', 1, '24 hours', 'London SE1 9RA, UK'), 
(NULL, 'Paris', 3, 'Eiffel Tower', 'https://aws-tiqets-cdn.imgix.net/images/content/2e6eebee20804cacab6d5cb9ecac49c6.jpg?auto=format&fit=crop&ixlib=python-1.1.2&q=25&s=8b514dd7d181fc629b68690698e5a79f&w=400&h=320&dpr=2.625', 2,  'a wonder of the word', 3, '9-24', '5 Avenue Anatole France, 75007 Paris, France'),
(NULL, 'Seattle', 2, 'Space Needle', 'https://thebesttravelplaces.com/wp-content/uploads/2016/02/Seattle-Space-Needle.jpg', 5, 'Top observation deck', 2, '9-1', 'Space Needle, 400 Broad St, Seattle, WA 98109, USA'), 
(NULL, 'Vancouver', 4, 'Stanley Park', 'https://newearth.university/wp-content/uploads/sites/13/2016/08/totempoles.jpg', 1, 'natural park', 1, '9-21', '845 Avison Way, Vancouver, BC V6G 3E2');


INSERT INTO Activity (act_ID, name, cost_avg)
VALUES (1, 'hiking', 0),
(2, 'sightseeing', 0),
(3, 'tour of Paris', 50),
(4, 'swimming', 15),
(5, 'snowboarding', 50),
(6, 'biking', 0),
(7, 'tour of Rome', 200),
(8, 'tour of Tokyo', 100),
(9, 'tour of London', 100),
(10, 'tour of Berlin', 100);

INSERT INTO Review (rev_ID, p_ID, dest_ID, review, rating)
VALUES (NULL, 1, 4, 'aight', 2),
(NULL, 2, 1, 'amazing', 4),
(NULL, 3, 2, 'wonderful', 4),
(NULL, 4, 5, 'great place', 5),
(NULL, 5, 5, 'beautiful', 3);

INSERT INTO Recreation (act_ID, icon)
VALUES (1, 'hike.png'),
(2, 'sight.png'),
(6, 'bike.png'),
(4, 'swim.png'),
(5, 'snowboard.png');

INSERT INTO Tour (act_ID, provider, url, duration)
VALUES (3, 'Intrepid Travel', 'www.intrepidtravel.com/france',  7),
(7, 'G Adventures', 'www.gadventures.com/rome', 6),
(8, 'Topdeck', 'www.topdeck.com/tokyo', 4),
(9, 'G Adventures', 'www.gadventures.com/london', 5),
(10, 'Globus', 'www.globus.com/berlin', 6 );

INSERT INTO Destination_Activity (act_ID, dest_ID)
VALUES (2, 1),
(2, 2),
(3, 3),
(2, 4),
(6, 5),
(1, 1),
(4, 1);

INSERT INTO Bucket_List (bl_ID, p_ID, title, date_modified)
VALUES (1, 1, 'Nada’s Bucket List','2019/02/09'),
(2, 2, 'Rory’s Bucket List', '2018/11/19'),
(3, 3, 'Simeon’s Bucket List', '2019/01/05'),
(4, 4, 'Mayesha’s Cool Bucket List','2017/07/09'),
(5, 5, 'Hazra’s Bucket List', '2018/07/20');

INSERT INTO Save_Bucket_List (bl_ID, dest_ID, date_modified)
VALUES (1, 2, '2019/02/09'),
(2, 3, '2018/11/19'),
(3, 4, '2019/01/05'),
(4, 1, '2017/07/09'),
(5, 5, '2018/07/20');

/* World destinations */
INSERT INTO Address (address, lat, lon)
VALUES ('Usce bb, Belgrade, Serbia', 0, 0),
('Ahsan Manzil Museum, Dhaka, Bangladesh', 0, 0),
('Krusedolsca 2a, Belgrade, Serbia', 0, 0),
('Kalemegdan, Belgrade, Serbia', 0, 0),
('Los Angeles, CA 90068, USA', 0, 0),
('100 Universal City Plaza, Universal City, CA 91608, USA', 0, 0),
('1313 Disneyland Dr', 0, 0),
('New York, NY 10004, USA', 0, 0),
('Venice, Los Angeles, CA, USA', 0, 0);

INSERT INTO Country (country_ID, name, language, population, currency)
VALUES (6, 'Serbia', 'Serbian', 8000000, 'Dinar'),
(7, 'Bangladesh', 'Bengali', 165000000, 'Taka');

INSERT INTO City (city_name, country_ID, city_population, lat, lon)
VALUES
('Belgrade', 6, 9000000, 35.7, 139.7),
('Dhaka', 7, 9000000, 0, 0),
('Los Angeles', 2, 9000000, 35.7, 139.7),
('Orlando', 2, 9000000, 35.7, 139.7),
('New York', 2, 9000000, 35.7, 139.7); 

INSERT INTO Destination (dest_ID, city_name, country_ID, name, pic_url, ranking, description, rating, visiting_hours, address)
VALUES 
(NULL, 'Belgrade', 6, 'Sava River', 'https://images8.alphacoders.com/541/541318.jpg',4, 'beautiful river walk', 5, '24 hours', 'Usce bb, Belgrade, Serbia'),
(NULL, 'Belgrade', 6, 'Kalemegdan Fortress', 'https://blog.sljaka.com/wp-content/uploads/2017/05/Kalemegdan-Pobednik.jpg',4, 'ancient city fortress', 5, '24 hours', 'Kalemegdan, Belgrade, Serbia'),
(NULL, 'Belgrade', 6, 'Church of St. Sava', 'http://www.allurecaramelhotel.com/Images/church-st-sava%20.jpg',4, 'one of the largest churches in the world', 5, '24 hours', 'Krusedolsca 2a, Belgrade, Serbia'),
(NULL, 'Dhaka', 7, 'The Pink Palace', 'https://mapio.net/images-p/44042345.jpg',4, 'it is pink :D', 5, '24 hours', 'Ahsan Manzil Museum, Dhaka, Bangladesh'),
(NULL, 'Los Angeles', 	2, 'Hollywood Sign', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5a/Hollywood_Sign_%28Zuschnitt%29.jpg/1280px-Hollywood_Sign_%28Zuschnitt%29.jpg', 6, 'Landmark', 1, '24 hours', 	'Los Angeles, CA 90068, USA'),
(NULL, 'Orlando',  2,'Universal Studios', 'https://media1.fdncms.com/orlando/imager/u/original/2507337/universal_globe.jpg',11,'Theme park with harry potter', 1, '9-21', '100 Universal City Plaza, Universal City, CA 91608, USA'),
(NULL, 'Los Angeles', 	2, 'Disneyland', 'https://cdn1.parksmedia.wdprapps.disney.com/media/blog/wp-content/uploads/2016/09/ksjdnf313.jpg', 10, 'Theme park for everyone', 1, '9-21', '1313 Disneyland Dr'),
(NULL, 'New York', 2, 'Statue of Liberty', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a1/Statue_of_Liberty_7.jpg/250px-Statue_of_Liberty_7.jpg', 8, 'Landmark', 1, '9-21', 'New York, NY 10004, USA'),
(NULL, 'Los Angeles',2,'Venice Beach', 'http://stage.visitcalifornia.com/sites/default/files/styles/welcome_image/public/VC_California101_VeniceBeach_Stock_RF_638340372_1280x640.jpg', 12,
'Popular beach',1, '24 hours','Venice, Los Angeles, CA, USA');

/* Vancouver destinations */
INSERT INTO Address
VALUES ('6344 University Blvd, Vancouver, BC V6T 1Z2, Canada', 49.2, 123.2), ('2329 West Mall, Vancouver, BC V6T 1Z4', 49.2, 123.2), 
('1895 Lower Mall, Vancouver, BC V6T 1Z4, Canada', 49.2, 123.2),
('305 Water St, Vancouver, BC V6B 1B9', 49.2, 123.2),
('6400 Nancy Greene Way, North Vancouver, BC V7R 4K9', 49.2, 123.2);

INSERT INTO Destination
VALUES 
(NULL, 'Vancouver', 4, 'UBC', 'https://you.ubc.ca/wp-content/uploads/2013/06/UBC-vancouver-campus.jpg', 6, 'amazing university', 5, '9-17', '2329 West Mall, Vancouver, BC V6T 1Z4'),
(NULL, 'Vancouver', 4, 'Wreck Beach', 'https://upload.wikimedia.org/wikipedia/commons/9/94/Acadianorth.jpg', 6, 'great beach', 5, '9-17', '6344 University Blvd, Vancouver, BC V6T 1Z2, Canada'),
(NULL, 'Vancouver', 4, 'Nitobe Garden', 'https://pwp.vpl.ca/inspirationpass/files/2012/09/960x400_Nitobe1.jpg', 6, 'very peaceful garden', 5, '10-14', '1895 Lower Mall, Vancouver, BC V6T 1Z4, Canada'),
(NULL, 'Vancouver', 4, 'Steam Clock', 'https://s3-media3.fl.yelpcdn.com/bphoto/oB7PnnVgTNR8bevGPVk6hw/ls.jpg', 7,
'Popular spot in Gastown',   	1, '9-21', '305 Water St, Vancouver, BC V6B 1B9'),
(NULL, 'Vancouver', 4,'Grouse Mountain',
'http://vanmag.com/wp-content/uploads/2017/11/GrouseMountain_001.jpg',   	9,'Popular mountain in BC', 1, '24 hours', '6400 Nancy Greene Way, North Vancouver, BC V7R 4K9');

/* TODO: RUN THIS FIRST*/
INSERT INTO Destination_Activity (act_ID, dest_ID)
VALUES
(3, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1);


