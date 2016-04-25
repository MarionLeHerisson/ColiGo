INSERT INTO UserType(label) 
VALUES ('Admin'), 
	('PointRelais'), 
	('Livreur'), 
	('Client');

INSERT INTO WeightPrice(min_weight, max_weight, price, delivery_type) 
VALUES
-- 8h --
	(0, 		2,		33.45,	1),
	(2.1, 	5,  	38.50,	1), 
	(5.1, 	10,  	44.05,	1), 
	(10.1, 	15,  	50.65,	1), 
	(15.1, 	20,  	56.90,	1), 
	(20.1, 	25,  	63.15,	1), 
	(25.1, 	30,  	68.70,	1),
-- express --	
	(0, 		0.5,	5,			2),
	(0.6, 	1,  	6.35,		2),
	(1.1, 	2,  	7.20,		2),
	(2.1, 	5,  	10.20,	2), 
	(5.1, 	10,  	15.55,	2), 
	(10.1, 	20,  	19.20,	2), 
	(20.1, 	30,  	22.70,	2),
-- urgence --	
	(0, 		0.5,	5,			3),
	(0.6, 	1,  	6.35,		3),
	(1.1, 	2,  	7.20,		3),
	(2.1, 	5,  	10.20,	3), 
	(5.1, 	10,  	15.55,	3), 
	(10.1, 	20,  	19.20,	3), 
	(20.1, 	30,  	22.70,	3);
-- TODO : fret --

INSERT INTO Extra(label, price) 
VALUES ('papier bulles', 0.60),
	('papier de soie', 0.40),
	('papier craft', 0.20),
	('polystirene', 0.30),
	('ramassage domicile', 8.0),
	('livraison samedi', 5.0),
	('prioritaire', 10.0),
	('par tous les moyens', 37.0),
	('indemnisation', 19.0);

INSERT INTO ParcelStatus(label, description)
VALUES ('dépot', 'Votre colis a bien été déposé. Il est en attente de livraison.'),
	('prise en charge', 'Votre colis a été pris en charge par le livreur et est en cours de livraison.'),
	('livraison', 'Votre colis a été déposé en point relais et peut dès à présent être récupéré.'),
	('distribution', 'Votre colis a bien été distribué.'),
	('perdu', 'Votre colis a malencontreusement été perdu. Nous faisons tout notre possible pour remédier à cette situation.');
	
INSERT INTO DeliveryType(label)
VALUES ('8h'),
	('express'),
	('urgence'),
	('fret');