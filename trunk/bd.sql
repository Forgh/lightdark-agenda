USE projetslagenda;

# -----------------------------------------------------------------------------
#       NETTOYAGE
# -----------------------------------------------------------------------------

DROP TABLE IF EXISTS EST_INDISPONIBLE;
DROP TABLE IF EXISTS EST_ABSENT;
DROP TABLE IF EXISTS PARTICIPE;
DROP TABLE IF EXISTS REUNION;
DROP TABLE IF EXISTS SALLE;
DROP TABLE IF EXISTS MOMENT;
DROP TABLE IF EXISTS FAIRE_PARTIE_DE;
DROP TABLE IF EXISTS SERVICE;
DROP TABLE IF EXISTS APPARTENIR_A;
DROP TABLE IF EXISTS EQUIPE;
DROP TABLE IF EXISTS PARTICIPANT;



# -----------------------------------------------------------------------------
#       TABLE : PARTICIPANT
# -----------------------------------------------------------------------------

CREATE TABLE PARTICIPANT
 (
   ID_PARTICIPANT INT(4) UNSIGNED NOT NULL AUTO_INCREMENT ,
   NOM CHAR(32) NOT NULL  ,
   PRENOM CHAR(32) NOT NULL  ,
   PASSWORD CHAR(100) NOT NULL,
   MAIL CHAR(32) NOT NULL, 
   CONSTRAINT pk_participant PRIMARY KEY (ID_PARTICIPANT) 
 ) engine=innodb CHARACTER SET UTF8 COLLATE utf8_unicode_ci;

 
 
# -----------------------------------------------------------------------------
#       TABLE : EQUIPE
# -----------------------------------------------------------------------------

 CREATE TABLE EQUIPE
 (
 ID_EQUIPE INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
 NOM CHAR(32) NOT NULL,
 CONSTRAINT pk_equipe PRIMARY KEY (ID_EQUIPE)
 ) engine=innodb CHARACTER SET UTF8 COLLATE utf8_unicode_ci;
 

# -----------------------------------------------------------------------------
#       TABLE : APPARTENIR_A
# -----------------------------------------------------------------------------

 CREATE TABLE APPARTENIR_A
 (
 ID_PARTICIPANT INT(4) UNSIGNED NOT NULL,
 ID_EQUIPE INT(4) UNSIGNED NOT NULL,
 CONSTRAINT pk_appartenir_aq PRIMARY KEY (ID_PARTICIPANT, ID_EQUIPE),
 CONSTRAINT fk_appartenir_a_participant FOREIGN KEY (ID_PARTICIPANT) REFERENCES PARTICIPANT(ID_PARTICIPANT),
 CONSTRAINT fk_appartenir_a_equipe FOREIGN KEY (ID_EQUIPE) REFERENCES EQUIPE(ID_EQUIPE)
 ) engine=innodb CHARACTER SET UTF8 COLLATE utf8_unicode_ci;

 
# -----------------------------------------------------------------------------
#       TABLE : SERVICE
# -----------------------------------------------------------------------------
 
 CREATE TABLE SERVICE
 (
 ID_SERVICE INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
 NOM CHAR(32) NOT NULL,
 CONSTRAINT pk_service PRIMARY KEY (ID_SERVICE)
 ) engine=innodb CHARACTER SET UTF8 COLLATE utf8_unicode_ci;
 
# -----------------------------------------------------------------------------
#       TABLE : FAIRE_PARTIE_DE
# -----------------------------------------------------------------------------
 
 CREATE TABLE FAIRE_PARTIE_DE
 (
 ID_SERVICE INT(4) UNSIGNED NOT NULL,
 ID_EQUIPE INT(4) UNSIGNED NOT NULL,
 CONSTRAINT pk_faire_partie_de PRIMARY KEY (ID_SERVICE, ID_EQUIPE),
 CONSTRAINT fk_faire_partie_de_service FOREIGN KEY (ID_SERVICE) REFERENCES SERVICE(ID_SERVICE),
 CONSTRAINT fk_faire_partie_de_equipe FOREIGN KEY (ID_EQUIPE) REFERENCES EQUIPE(ID_EQUIPE)
 
 ) engine=innodb CHARACTER SET UTF8 COLLATE utf8_unicode_ci;
 
# -----------------------------------------------------------------------------
#       TABLE : MOMENT
# -----------------------------------------------------------------------------

CREATE TABLE MOMENT(
   ID_DATE int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
   JOUR DATE NOT NULL,
   TEMPS char(10)/*'matin' ou 'après-midi'*/ , 
   CONSTRAINT pk_date PRIMARY KEY (ID_DATE)
)  engine=innodb CHARACTER SET UTF8 COLLATE utf8_unicode_ci;


# -----------------------------------------------------------------------------
#       TABLE : SALLE
# -----------------------------------------------------------------------------

CREATE TABLE SALLE
(
   NUM_SALLE int(3) UNSIGNED NOT NULL  ,
   NOM_SALLE CHAR(32) NOT NULL UNIQUE, 
   CONSTRAINT pk_salle PRIMARY KEY (NOM_SALLE) 
)  engine=innodb CHARACTER SET UTF8 COLLATE utf8_unicode_ci;



# -----------------------------------------------------------------------------
#       TABLE : REUNION
# -----------------------------------------------------------------------------

CREATE TABLE REUNION
(
   ID_REUNION int(6) UNSIGNED NOT NULL AUTO_INCREMENT ,
   ID_CHEF_REUNION INT(4) UNSIGNED NOT NULL,
   ID_DATE int(4) UNSIGNED NOT NULL ,
   SUJET VARCHAR(32) NULL ,
   SALLE VARCHAR(32) NOT NULL,
   compte_rendu text(10000) NULL,
   INDEX (ID_CHEF_REUNION),
   INDEX (SALLE),
   INDEX (ID_DATE), 
   CONSTRAINT pk_reunion PRIMARY KEY (ID_REUNION, ID_CHEF_REUNION, ID_DATE, SALLE),
   CONSTRAINT fk_reunion_date FOREIGN KEY (ID_DATE) REFERENCES MOMENT(ID_DATE),
   CONSTRAINT fk_reunion_salle FOREIGN KEY (SALLE) REFERENCES SALLE(NOM_SALLE),
   CONSTRAINT fk_reunion_chef FOREIGN KEY (ID_CHEF_REUNION) REFERENCES PARTICIPANT(ID_PARTICIPANT)
) engine=innodb CHARACTER SET UTF8 COLLATE utf8_unicode_ci;


# -----------------------------------------------------------------------------
#       TABLE : PARTICIPE
# -----------------------------------------------------------------------------

CREATE TABLE PARTICIPE
(
   ID_REUNION int(6) UNSIGNED NOT NULL  ,
   ID_PARTICIPANT INT(4) UNSIGNED NOT NULL ,
   ETAT VARCHAR(20) NOT NULL DEFAULT "En attente", -- autre état : "Décommandé", "Participera", gare aux majuscules
   INDEX (ID_REUNION),
   INDEX (ID_PARTICIPANT),
   CONSTRAINT pk_participe PRIMARY KEY (ID_REUNION, ID_PARTICIPANT),
   CONSTRAINT fk_participe_reun FOREIGN KEY (ID_REUNION) REFERENCES REUNION(ID_REUNION) ON DELETE CASCADE,
   CONSTRAINT fk_participe_part FOREIGN KEY (ID_PARTICIPANT) REFERENCES PARTICIPANT(ID_PARTICIPANT)
) engine=innodb CHARACTER SET UTF8 COLLATE utf8_unicode_ci;
 

# -----------------------------------------------------------------------------
#       TABLE : EST_ABSENT
# -----------------------------------------------------------------------------

CREATE TABLE EST_ABSENT
 (
   ID_PARTICIPANT INT(4) UNSIGNED NOT NULL ,
   ID_DATE int(4) UNSIGNED NOT NULL ,
   INDEX (ID_PARTICIPANT),
   INDEX (ID_DATE),
   CONSTRAINT pk_est_absent_part PRIMARY KEY (ID_PARTICIPANT,ID_DATE),
   CONSTRAINT fk_est_absent_part FOREIGN KEY (ID_PARTICIPANT) REFERENCES PARTICIPANT(ID_PARTICIPANT),
   CONSTRAINT fk_est_absent_date FOREIGN KEY (ID_DATE) REFERENCES MOMENT(ID_DATE)
 ) engine=innodb CHARACTER SET UTF8 COLLATE utf8_unicode_ci;

# -----------------------------------------------------------------------------
#       TABLE : EST_INDISPONIBLE
# -----------------------------------------------------------------------------
 
CREATE TABLE EST_INDISPONIBLE
 (
   ID_PARTICIPANT INT(4) UNSIGNED NOT NULL ,
   ID_DATE int(4) UNSIGNED NOT NULL ,
   INDEX (ID_PARTICIPANT),
   INDEX (ID_DATE),
   CONSTRAINT pk_indisponible_part PRIMARY KEY (ID_PARTICIPANT,ID_DATE),
   CONSTRAINT fk_est_indisponible_part FOREIGN KEY (ID_PARTICIPANT) REFERENCES PARTICIPANT(ID_PARTICIPANT),
   CONSTRAINT fk_est_indisponible_date FOREIGN KEY (ID_DATE) REFERENCES MOMENT(ID_DATE)
 ) engine=innodb CHARACTER SET UTF8 COLLATE utf8_unicode_ci;

# -----------------------------------------------------------------------------
#			DONNEES
# -----------------------------------------------------------------------------

INSERT INTO `EQUIPE`(`ID_EQUIPE`, `NOM`) VALUES (1,"EQ1");
INSERT INTO `EQUIPE`(`ID_EQUIPE`, `NOM`) VALUES (2,"EQ2");

INSERT INTO `SALLE`(`NUM_SALLE`, `NOM_SALLE`) VALUES (1, "LaOne");
INSERT INTO `SALLE`(`NUM_SALLE`, `NOM_SALLE`) VALUES (2, "LaTwO");

INSERT INTO `PARTICIPANT`(`ID_PARTICIPANT`, `NOM`, `PRENOM`, `PASSWORD`, `MAIL`) VALUES (1,'LeChat','Felix','croquette','lechat@yopmail.fr');
INSERT INTO `PARTICIPANT`(`ID_PARTICIPANT`, `NOM`, `PRENOM`, `PASSWORD`, `MAIL`) VALUES (2,'LeFruit','Pomme','pepin','lefruit@yopmail.fr');
INSERT INTO `PARTICIPANT`(`ID_PARTICIPANT`, `NOM`, `PRENOM`, `PASSWORD`, `MAIL`) VALUES (3,'LeCarAnglais','Red','London','lecaranglais@yopmail.fr');

INSERT INTO `SERVICE` (`ID_SERVICE`, `NOM`) VALUES (1, 'Informatique');
INSERT INTO `SERVICE` (`ID_SERVICE`, `NOM`) VALUES (2, 'Administration');

INSERT INTO `FAIRE_PARTIE_DE` (`ID_SERVICE`, `ID_EQUIPE`) VALUES (1, 1);
INSERT INTO `FAIRE_PARTIE_DE` (`ID_SERVICE`, `ID_EQUIPE`) VALUES (2, 2);

INSERT INTO `APPARTENIR_A`(`ID_PARTICIPANT`, `ID_EQUIPE`) VALUES (1, 1);
INSERT INTO `APPARTENIR_A`(`ID_PARTICIPANT`, `ID_EQUIPE`) VALUES (2, 1);
INSERT INTO `APPARTENIR_A`(`ID_PARTICIPANT`, `ID_EQUIPE`) VALUES (3, 2);

INSERT INTO `MOMENT` (`JOUR`, `TEMPS`) VALUES ("13/12/13", 'matin');/*format JJ/MM/AAAA ou AAAA-MM-JJ*/
INSERT INTO `MOMENT` (`JOUR`, `TEMPS`) VALUES ("13/12/13", 'après-midi');
INSERT INTO `MOMENT` (`JOUR`, `TEMPS`) VALUES ("14/12/13", 'matin');
INSERT INTO `MOMENT` (`JOUR`, `TEMPS`) VALUES ("14/12/13", 'après-midi');
INSERT INTO `MOMENT` (`JOUR`, `TEMPS`) VALUES ("15/12/13", 'matin');
INSERT INTO `MOMENT` (`JOUR`, `TEMPS`) VALUES ("15/12/13", 'après-midi');


INSERT INTO `REUNION` VALUES (1, 1, 1, 'Commencer cet agenda', 'LaOne', NULL);
INSERT INTO `REUNION` VALUES (2, 1, 3, 'Continuer cet agenda', 'LaTwo', NULL);
INSERT INTO `REUNION` VALUES (3, 2, 6, 'Finir cet agenda', 'LaOne', NULL);

INSERT INTO `PARTICIPE` (`ID_REUNION`, `ID_PARTICIPANT`) VALUES (1, 1);
INSERT INTO `PARTICIPE` (`ID_REUNION`, `ID_PARTICIPANT`) VALUES (2, 1);
INSERT INTO `PARTICIPE` VALUES (1, 2, 'Décommandé');
INSERT INTO `PARTICIPE` VALUES (1, 3, 'Participera');
