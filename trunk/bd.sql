# -----------------------------------------------------------------------------
#       TABLE : PARTICIPANT
# -----------------------------------------------------------------------------

CREATE TABLE PARTICIPANT
 (
   ID_PARTICIPANT INT(4) UNSIGNED NOT NULL AUTO_INCREMENT ,
   NOM CHAR(32) NOT NULL  ,
   PRENOM CHAR(32) NOT NULL  ,
   PASSWORD CHAR(100) NOT NULL,
   MAIL CHAR(32) NOT NULL  
   , CONSTRAINT pk_participant PRIMARY KEY (ID_PARTICIPANT) 
 ) engine=innodb CHARACTER SET UTF8 COLLATE utf8_unicode_ci;


# -----------------------------------------------------------------------------
#       TABLE : DATE
# -----------------------------------------------------------------------------

CREATE TABLE DATE(
	ID_DATE int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
   JOUR DATE NOT NULL,
   TEMPS char(10)  
	CONSTRAINT pk_date PRIMARY KEY (ID_DATE))
 ) engine=innodb CHARACTER SET UTF8 COLLATE utf8_unicode_ci;


# -----------------------------------------------------------------------------
#       TABLE : SALLE
# -----------------------------------------------------------------------------

CREATE TABLE SALLE
 (
   NUM_SALLE int(3) UNSIGNED NOT NULL  ,
   NOM_SALLE CHAR(32) NOT NULL UNIQUE,  
   , CONSTRAINT pk_salle PRIMARY KEY (NUM_SALLE) 
 ) engine=innodb CHARACTER SET UTF8 COLLATE utf8_unicode_ci;


# -----------------------------------------------------------------------------
#       TABLE : REUNION
# -----------------------------------------------------------------------------

CREATE TABLE REUNION
 (
   ID_REUNION int(6) UNSIGNED NOT NULL AUTO_INCREMENT ,
   ID_CHEF_REUNION INT(4) UNSIGNED NOT NULL,
   ID_DATE int(4) UNSIGNED NOT NULL ,
   SUJET CHAR(32) NULL ,
   SALLE NOM_SALLE CHAR(32) NOT NULL,
   INDEX (ID_CHEF_REUNION),
   INDEX (SALLE),
   INDEX (ID_DATE)
   , CONSTRAINT pk_reunion PRIMARY KEY (ID_REUNION) ,
   CONSTRAINT fk_reunion_date FOREIGN KEY (ID_DATE) REFERENCES DATE(ID_DATE),
   CONSTRAINT fk_reunion_salle FOREIGN KEY (SALLE) REFERENCES SALLE(NOM_SALLE),
   CONSTRAINT fk_reunion_chef FOREIGN KEY (ID_CHEF_REUNION) REFERENCES PARTICIPANT(ID_PARTICIPANT)
 ) engine=innodb CHARACTER SET UTF8 COLLATE utf8_unicode_ci;


# -----------------------------------------------------------------------------
#       TABLE : PARTICIPE
# -----------------------------------------------------------------------------

CREATE PARTICIPE
 (
   NOM_SALLE CHAR(32) NOT NULL ,
   ID_REUNION int(6) UNSIGNED NOT NULL  ,
   ID_PARTICIPANT INT(4) UNSIGNED NOT NULL  ,
   INDEX (ID_SALLE),
   INDEX (ID_REUNION),
   INDEX (ID_PARTICIPANT),
   CONSTRAINT pk_participe_salle PRIMARY KEY (ID_SALLE),
   CONSTRAINT pk_participe_reun PRIMARY KEY (ID_REUNION),
   CONSTRAINT pk_participe_part PRIMARY KEY (ID_PARTICIPANT),
   CONSTRAINT fk_participe_salle FOREIGN KEY (NOM_SALLE) REFERENCES SALLE(NOM_SALLE),
   CONSTRAINT fk_participe_reun FOREIGN KEY (ID_REUNION) REFERENCES REUNION(ID_REUNION),
   CONSTRAINT fk_participe_part FOREIGN KEY (ID_PARTICIPANT) REFERENCES PARTICIPANT(ID_PARTICIPANT),
   
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
   CONSTRAINT pk_est_absent_part PRIMARY KEY (ID_PARTICIPANT),
   CONSTRAINT pk_est_absent_date PRIMARY KEY (ID_DATE),
   CONSTRAINT fk_est_absent_part FOREIGN KEY (ID_PARTICIPANT) REFERENCES PARTICIPANT(ID_PARTICIPANT),
   CONSTRAINT fk_est_absent_date FOREIGN KEY (ID_DATE) REFERENCES DATE(ID_DATE)
 ) engine=innodb CHARACTER SET UTF8 COLLATE utf8_unicode_ci;

# -----------------------------------------------------------------------------
#       TABLE : EST_DISPONIBLE
# -----------------------------------------------------------------------------

CREATE TABLE EST_DISPONIBLE
 (
   ID_PARTICIPANT INT(4) UNSIGNED NOT NULL ,
   ID_DATE int(4) UNSIGNED NOT NULL ,
   INDEX (ID_PARTICIPANT),
   INDEX (ID_DATE),
    CONSTRAINT pk_disponible_part PRIMARY KEY (ID_PARTICIPANT),
   CONSTRAINT pk_disponible_date PRIMARY KEY (ID_DATE),
   CONSTRAINT fk_est_disponible_part FOREIGN KEY (ID_PARTICIPANT) REFERENCES PARTICIPANT(ID_PARTICIPANT),
   CONSTRAINT fk_est_disponible_date FOREIGN KEY (ID_DATE) REFERENCES DATE(ID_DATE)
 ) engine=innodb CHARACTER SET UTF8 COLLATE utf8_unicode_ci;


