INSERT INTO `PRODUCTE` (`idProducte`, `nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES (NULL, 'Entrepà de tonyina', 'menjar', '1.80', 'mati',10);
INSERT INTO `PRODUCTE` (`idProducte`, `nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES (NULL, 'Aigua', 'beguda', '0.80', 'tots',10);
INSERT INTO `PRODUCTE` (`idProducte`, `nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES (NULL, 'CocaCola', 'beguda', '1.80', 'tots',10);
INSERT INTO `PRODUCTE` (`idProducte`, `nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES (NULL, 'Entrepà de bacó', 'menjar', '2', 'mati',10);
INSERT INTO `PRODUCTE` (`idProducte`, `nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES (NULL, 'Entrepà de fuet', 'menjar', '1.80', 'mati',10);
INSERT INTO `PRODUCTE` (`idProducte`, `nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES (NULL, 'Panini', 'menjar', '1.80', 'tots',10);
INSERT INTO `PRODUCTE` (`idProducte`, `nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES (NULL, 'Truita de patata', 'menjar', '2.50', 'tarda',10);
INSERT INTO `PRODUCTE` (`idProducte`, `nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES (NULL, 'Macarrons amb tomàquet', 'menjar', '5', 'tarda',10);
INSERT INTO `PRODUCTE` (`idProducte`, `nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES (NULL, 'Entrepà de llom amb formatge', 'menjar', '2.20', 'mati',10);
INSERT INTO `PRODUCTE` (`idProducte`, `nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES (NULL, 'Entrepà de bacó amb formatge', 'menjar', '2.20', 'mati',10);
INSERT INTO `PRODUCTE` (`idProducte`, `nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES (NULL, 'Entrepà de llom', 'menjar', '1.80', 'mati',10);
INSERT INTO `PRODUCTE` (`idProducte`, `nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES (NULL, 'Fanta', 'beguda', '1.80', 'tots',10);
INSERT INTO `PRODUCTE` (`idProducte`, `nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES (NULL, 'Aquarius', 'beguda', '1.80', 'tots',10);
INSERT INTO `PRODUCTE` (`idProducte`, `nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES (NULL, 'Sopa', 'menjar', '5', 'tarda',10);
INSERT INTO `PRODUCTE` (`idProducte`, `nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES (NULL, 'Lasanya', 'menjar', '4.50', 'tarda',10);
INSERT INTO `PRODUCTE` (`nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES ('Entrepà de llonganissa', 'menjar', '2.8', 'mati',10);
INSERT INTO `PRODUCTE` (`nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES ('Entrepà vegetal', 'menjar', '2.2', 'mati',10);
INSERT INTO `PRODUCTE` (`nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES ('Bikini', 'menjar', '1.8', 'mati',10);
INSERT INTO `PRODUCTE` (`nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES ('Suc de pinya', 'beguda', '1.2', 'tots',10);
INSERT INTO `PRODUCTE` (`nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES ('Red Bull', 'beguda', '1.1', 'tots',10);
INSERT INTO `PRODUCTE` (`nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES ('Croquetes', 'menjar', '5', 'tarda',10);
INSERT INTO `PRODUCTE` (`nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES ('Verdures saltejades', 'menjar', '4.2', 'tarda',10);
INSERT INTO `PRODUCTE` (`nomProducte`, `tipus`, `preu`, `horari`, `stock`) VALUES ('Salmorejo', 'menjar', '3.5', 'tarda',10);

-- Insert clients
INSERT INTO `USUARI` (`correu`, `nom`, `cognoms`, `telefon`) VALUES ('client1@inspedralbes.cat', 'Client', 'Primer', '111111111');
INSERT INTO `USUARI` (`correu`, `nom`, `cognoms`, `telefon`) VALUES ('client2@inspedralbes.cat', 'Client', 'Segon', '222222222');
INSERT INTO `USUARI` (`correu`, `nom`, `cognoms`, `telefon`) VALUES ('clien3@inspedralbes.cat', 'Client3', 'Tercer', '333333333');

-- Insert comanda
INSERT INTO `COMANDA` (`idComanda`, `dataComanda`, `correu`, `fet`) VALUES (NULL, '2022-10-17', 'client1@inspedralbes.cat', '0');
INSERT INTO `COMANDA` (`idComanda`, `dataComanda`, `correu`, `fet`) VALUES (NULL, '2022-10-17', 'client2@inspedralbes.cat', '0');
INSERT INTO `COMANDA` (`idComanda`, `dataComanda`, `correu`, `fet`) VALUES (NULL, '2022-10-17', 'clien3@inspedralbes.cat', '0');

-- Insert lineas
INSERT INTO `LINIA_COMANDA` (`idLiniaComanda`, `idProducte`, `idComanda`, `quantitat`, `preuUnitari`, `preuTotal`) VALUES (NULL, '2', '1', '2', '0.8', '2');
INSERT INTO `LINIA_COMANDA` (`idLiniaComanda`, `idProducte`, `idComanda`, `quantitat`, `preuUnitari`, `preuTotal`) VALUES (NULL, '11', '1', '1', '1.8', '1.8');
INSERT INTO `LINIA_COMANDA` (`idLiniaComanda`, `idProducte`, `idComanda`, `quantitat`, `preuUnitari`, `preuTotal`) VALUES (NULL, '6', '1', '1', '1.8', '1.8');

INSERT INTO `LINIA_COMANDA` (`idLiniaComanda`, `idProducte`, `idComanda`, `quantitat`, `preuUnitari`, `preuTotal`) VALUES (NULL, '13', '2', '1', '1.8', '1.8');
INSERT INTO `LINIA_COMANDA` (`idLiniaComanda`, `idProducte`, `idComanda`, `quantitat`, `preuUnitari`, `preuTotal`) VALUES (NULL, '14', '2', '1', '5', '5');

INSERT INTO `LINIA_COMANDA` (`idLiniaComanda`, `idProducte`, `idComanda`, `quantitat`, `preuUnitari`, `preuTotal`) VALUES (NULL, '12', '3', '2', '1.8', '3.6');
INSERT INTO `LINIA_COMANDA` (`idLiniaComanda`, `idProducte`, `idComanda`, `quantitat`, `preuUnitari`, `preuTotal`) VALUES (NULL, '5', '3', '2', '1.8', '3.6');