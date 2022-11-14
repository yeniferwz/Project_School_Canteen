#USE a21yenwuwzha_cantina2;

CREATE TABLE USUARI(
	correu VARCHAR(50) PRIMARY KEY,
    nom VARCHAR(30),
    cognoms VARCHAR(30),
    telefon INT(9) UNIQUE
);

CREATE TABLE COMANDA (
	idComanda INT(5) PRIMARY KEY AUTO_INCREMENT,
    dataComanda DATE,
    correu VARCHAR(50),
    fet BOOLEAN,
    FOREIGN KEY(correu) REFERENCES USUARI(correu)
);

CREATE TABLE PRODUCTE(
	idProducte INT(3) PRIMARY KEY AUTO_INCREMENT,
    nomProducte VARCHAR(30),
    tipus ENUM('menjar','beguda'),
    preu FLOAT,
    horari ENUM('mati','tarda','tots'),
    stock INT
);

CREATE TABLE LINIA_COMANDA(
	idLiniaComanda INT(5) PRIMARY KEY AUTO_INCREMENT,
    idProducte INT(3),
    idComanda INT(3),
    quantitat TINYINT(3),
    preuUnitari FLOAT,
    preuTotal FLOAT,
    FOREIGN KEY (idProducte) REFERENCES PRODUCTE(idProducte),
    FOREIGN KEY (idComanda) REFERENCES COMANDA(idComanda)
);