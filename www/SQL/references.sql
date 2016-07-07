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
	(0, 		0.5,	35,			3),
	(0.6, 	1,  	36.20,	3),
	(1.1, 	2,  	37.00,	3),
	(2.1, 	5,  	39.70,	3),
	(5.1, 	10,  	44.30,	3),
	(10.1, 	20,  	47.10,	3),
	(20.1, 	30,  	50.20,	3),
-- fret --
  (0, 		10000,	  0,	4);

INSERT INTO Extra(label, price, explaination)
VALUES ('papier bulles', 0.40, 'Le colis sera emballé de papier bulles. Protège les objets fragiles des gros impacts.'),
	('papier de soie', 0.60, 'Le colis sera emballé dans du papier de soie. Protège les objets très fragiles des faibles impacts.'),
	('papier kraft', 0.20, 'Le colis sera emballé de papier kraft. Protège les objets peu fragiles des faibles impacts.'),
	('polystyrene', 0.30, 'Le colis sera entouré de billes de polystyrène. Protège les objets de grande taille des impacts.'),
	('ramassage domicile', 8.00, 'Ce service vous propose de ramasser votre colis chez vous et vous permet de ne pas le déposer en point relais.'),
	('livraison domicile', 8.00, 'Ce service vous propose de livrer votre colis chez vous au lieu de le livrer en Point Relais.'),
	('livraison samedi', 5.00, 'Ce service permet de livrer votre colis le samedi.'),
	('prioritaire', 10.00, 'Ce service rend votre colis prioritaire.'),
	('par tous les moyens', 37.00, 'En cas de problèmes sur le transport de votre colis, ce service permet la mise en place de tous les moyens possibles pour permettre la livraison de votre colis.'),
	('indemnisation', 19.00, 'Ce service vous rembourse en cas de perte ou d avarie du colis.');

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