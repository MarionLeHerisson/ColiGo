CREATE TABLE ParcelStatus(
	id INT NOT NULL AUTO_INCREMENT,
	label VARCHAR(50) NOT NULL,
	description VARCHAR(255) NOT NULL,
	
	PRIMARY KEY (id)
);

CREATE TABLE Extra(
	id INT NOT NULL AUTO_INCREMENT,
	label VARCHAR(50) NOT NULL,
	price DECIMAL(10,2) NOT NULL,
	explaination TINYTEXT,
	
	PRIMARY KEY (id)
);

CREATE TABLE Address(
	id INT NOT NULL AUTO_INCREMENT,
	address VARCHAR(255) NOT NULL,
	zip_code INT NOT NULL,
	city VARCHAR(255) NOT NULL,
	lat FLOAT DEFAULT NULL,
	lng FLOAT DEFAULT NULL,
	
	PRIMARY KEY (id)
);

CREATE TABLE WeightPrice(
	id INT NOT NULL AUTO_INCREMENT,
	delivery_type INT NOT NULL,
	min_weight FLOAT NOT NULL,
	max_weight FLOAT NOT NULL,
	price DECIMAL(10,2) NOT NULL,
	
	PRIMARY KEY (id)
);

CREATE TABLE UserType(
	id INT NOT NULL AUTO_INCREMENT,
	label VARCHAR(50) NOT NULL,
	
	PRIMARY KEY (id)
);

CREATE TABLE User (
	id INT NOT NULL AUTO_INCREMENT,
	first_name VARCHAR(100) NOT NULL,
	last_name VARCHAR(100) NOT NULL,
	mail VARCHAR(100),
	password VARCHAR(32), -- peut être null si n'a pas de compte mais a fait livrer / reçu un colis --
	type_id INT NOT NULL,
	address_id INT,
	is_deleted INT DEFAULT 0,
	
	PRIMARY KEY (id),
	FOREIGN KEY (type_id) REFERENCES UserType (id)
);

CREATE TABLE RelayPoint(
	id INT NOT NULL AUTO_INCREMENT,
	address INT NOT NULL,
	owner_id INT NOT NULL,
	label VARCHAR(255) NOT NULL,
	is_deleted INT DEFAULT 0,

	PRIMARY KEY (id),
	FOREIGN KEY (address) REFERENCES Address (id),
	FOREIGN KEY (owner_id) REFERENCES User (id)
);

CREATE TABLE Orders (
	id INT NOT NULL AUTO_INCREMENT,
	departure_address INT NOT NULL,
	arrival_address INT NOT NULL,
	total_price DECIMAL(10,2) NOT NULL,
	order_date TIMESTAMP NOT NULL,
	delivery_date TIMESTAMP,
	ordered_from INT,
	ordered_by INT NOT NULL,
	deliver_to INT NOT NULL,
	is_deleted INT DEFAULT 0,
	
	PRIMARY KEY (id),
	FOREIGN KEY (departure_address) REFERENCES Address (id),
	FOREIGN KEY (arrival_address) REFERENCES Address (id),
	FOREIGN KEY (ordered_from) REFERENCES RelayPoint (id),
	FOREIGN KEY (ordered_by) REFERENCES User (id),
	FOREIGN KEY (deliver_to) REFERENCES User (id)
);

CREATE TABLE DeliveryType(
	id INT NOT NULL AUTO_INCREMENT,
	label VARCHAR(50),

	PRIMARY KEY(id)
);

CREATE TABLE Parcel(
	id INT NOT NULL AUTO_INCREMENT,
	tracking_number BIGINT NOT NULL,
	weight FLOAT NOT NULL,
	status_id INT NOT NULL,
	is_deleted INT DEFAULT 0,
	delivery_type INT NOT NULL,
	
	PRIMARY KEY (id),
	FOREIGN KEY (status_id) REFERENCES ParcelStatus (id),
	FOREIGN KEY (delivery_type) REFERENCES DeliveryType (id)
);

CREATE TABLE ParcelExtra(
	id INT NOT NULL AUTO_INCREMENT,
	parcel_id INT NOT NULL,
	extra_id INT NOT NULL,
	
	PRIMARY KEY(id),
	FOREIGN KEY (parcel_id) REFERENCES Parcel (id),
	FOREIGN KEY (extra_id) REFERENCES Extra (id)
);

CREATE TABLE OrderParcel(
	id INT NOT NULL AUTO_INCREMENT,
	order_id INT NOT NULL,
	parcel_id INT NOT NULL,
	is_deleted INT DEFAULT 0,
	
	PRIMARY KEY (id),
	FOREIGN KEY (order_id) REFERENCES Orders (id),
	FOREIGN KEY (parcel_id) REFERENCES Parcel (id)
);

CREATE TABLE FovoriteRelayPoint(
	id INT NOT NULL AUTO_INCREMENT,
	user_id INT NOT NULL,
	relay_point_id INT NOT NULL,
	is_deleted INT DEFAULT 0,
	
	PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES User (id),
	FOREIGN KEY (relay_point_id) REFERENCES RelayPoint (id)
);

CREATE TABLE Remuneration(
	id INT NOT NULL AUTO_INCREMENT,
	relay_point_id INT NOT NULL,
	remuneration_date TIMESTAMP NOT NULL,
	xml VARCHAR(255) NOT NULL,
	is_paid INT DEFAULT 0,
	
	PRIMARY KEY (id),
	FOREIGN KEY (relay_point_id) REFERENCES RelayPoint (id)
);

CREATE TABLE Stock(
	id INT NOT NULL AUTO_INCREMENT,
	relay_point_id INT NOT NULL,
	extra_id INT NOT NULL,
	quantity INT NOT NULL,
	
	PRIMARY KEY (id),
	FOREIGN KEY (relay_point_id) REFERENCES RelayPoint (id),
	FOREIGN KEY (extra_id) REFERENCES Extra (id)
);

CREATE TABLE Tracking(
  id INT NOT NULL AUTO_INCREMENT,
  parcel_id INT NOT NULL,
  status_id INT NOT NULL,
  new_status_date TIMESTAMP NOT NULL,

  PRIMARY KEY (id),
  FOREIGN KEY(parcel_id) REFERENCES Parcel(id),
  FOREIGN KEY(status_id) REFERENCES ParcelStatus(id)
);


