INSERT INTO UserType(label) 
VALUES ('Admin'), 
	('PointRelais'), 
	('Livreur'), 
	('Client');

INSERT INTO WeightPrice(min_weight, max_weight, price, delivery_type) 
VALUES
-- 8h --
	(0, 		0.5,	27.60,	1),
	(0.6, 	1,  	29.95,	1),
	(1.1, 	2,		33.45,	1),
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
	(10.1, 	15,  	17.85,	2),
	(15.1, 	20,  	19.20,	2),
	(20.1, 	25,  	21.35,	2),
	(25.1, 	30,  	22.70,	2),
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

INSERT INTO Extra(label, price, explaination, is_stockable)
VALUES ('papier bulles', 0.40, 'Le colis sera emballé de papier bulles. Protège les objets fragiles des gros impacts.', 1),
	('papier de soie', 0.60, 'Le colis sera emballé dans du papier de soie. Protège les objets très fragiles des faibles impacts.', 1),
	('papier kraft', 0.20, 'Le colis sera emballé de papier kraft. Protège les objets peu fragiles des faibles impacts.', 1),
	('polystyrene', 0.30, 'Le colis sera entouré de billes de polystyrène. Protège les objets de grande taille des impacts.', 1),
	('ramassage domicile', 8.00, 'Ce service vous propose de ramasser votre colis chez vous et vous permet de ne pas le déposer en point relais.', 0),
	('livraison domicile', 8.00, 'Ce service vous propose de livrer votre colis chez vous au lieu de le livrer en Point Relais.', 0),
	('livraison samedi', 5.00, 'Ce service permet de livrer votre colis le samedi.', 0),
	('prioritaire', 10.00, 'Ce service rend votre colis prioritaire.', 0),
	('par tous les moyens', 37.00, 'En cas de problèmes sur le transport de votre colis, ce service permet la mise en place de tous les moyens possibles pour permettre la livraison de votre colis.', 0),
	('indemnisation', 19.00, 'Ce service vous rembourse en cas de perte ou d avarie du colis.', 0);

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


-- QUELQUES UTILISATEURS (avec différents rôles) ET POINTS RELAIS --------------------
INSERT INTO Address (id, address, zip_code, city, lat, lng) VALUES
(1, '14, Rue Monte-Cristo', 75020, 'Paris', 0, 0),
(2, ', ', 0, '', 0, 0),
(3, '10, Rue Lisfranc', 75020, 'Paris', 48.8618, 2.40236),
(4, '12, Rue de la Mer', 62600, 'Berck', 50.4069, 1.56102),
(5, '3, Rue de Cugnaux', 31300, 'Toulouse', 43.5917, 1.4196);
(7, '16, Boulevard Voltaire', 75011, 'Paris', 0, 0);

INSERT INTO User (id, first_name, last_name, mail, password, type_id, address_id, is_deleted, lost_pwd_key) VALUES
(1, 'Marion', 'Hurteau', 'marion.hurteau1@gmail.com', 'ab4f63f9ac65152575886860dde480a1', 1, 1, 0, NULL),
(2, 'Romain', 'Ouriet', 'romain.ouriet@gmail.com', 'ab4f63f9ac65152575886860dde480a1', 1, 2, 0, NULL),
(3, 'Catherine', 'Dupuy', 'cathy.dupuy-dansac@live.fr', 'ab4f63f9ac65152575886860dde480a1', 2, 1, 0, NULL),
(4, 'Oriane', 'Payen', 'oriane.payen@wanadoo.fr', 'ab4f63f9ac65152575886860dde480a1', 2, 3, 0, NULL),
(5, 'Maxime', 'Cohet', 'maxime.cohet@coligo.fr', 'ab4f63f9ac65152575886860dde480a1', 2, 2, 0, NULL),
(6, 'Michel', 'Maubert', 'michel.maubert@coligo.fr', 'ab4f63f9ac65152575886860dde480a1', 3, 7, 0, NULL);

INSERT INTO RelayPoint (id, address, owner_id, label, is_deleted) VALUES
(1, 4, 3, 'Mon Beau Bateau', 0),
(2, 3, 4, 'Usine à Nuages', 0),
(3, 5, 5, 'La Bonne Pinte', 0);