CREATE TABLE club (
    id int PRIMARY KEY AUTO_INCREMENT ,
    name varchar(100) ,
    ville varchar(100) ,
    date datetime DEFAULT CURRENT_TIMESTAMP 
    )

    __________________________________________

CREATE TABLE Equipe (
    id int PRIMARY KEY AUTO_INCREMENT ,
    nom varchar(100) ,
    Jeu varchar(100) ,
    clubid int ,
    date datetime DEFAULT CURRENT_TIMESTAMP ,
    FOREIGN KEY (clubid) REFERENCES club(id)
    )

    __________________________________________

    CREATE TABLE Joueur (
    id int PRIMARY KEY AUTO_INCREMENT ,
    Pseudo varchar(100) ,
    Rôle varchar(100) ,
    Jeu varchar(100) ,
    Salaire decimal(20,10) ,
    equipe_id int ,
    date datetime DEFAULT CURRENT_TIMESTAMP ,
    FOREIGN KEY (equipe_id) REFERENCES equipe(id)
)

    __________________________________________

CREATE TABLE Tournoi (
    id int PRIMARY KEY AUTO_INCREMENT ,
    Titre varchar(100) ,
    Cashprize decimal(20,10) ,
    Format varchar(100) ,
    equipe_id int ,
    date datetime DEFAULT CURRENT_TIMESTAMP ,
    FOREIGN KEY (equipe_id) REFERENCES equipe(id)
)
    __________________________________________

CREATE TABLE matches (
    id int PRIMARY KEY AUTO_INCREMENT ,
    score_a int ,
    score_b int ,
    equipe_a int ,
    equipe_b int ,
    date datetime ,
    FOREIGN KEY (equipe_a) REFERENCES tournoi(id) ,
    FOREIGN KEY (equipe_b) REFERENCES tournoi(id)
)

__________________________________________

CREATE TABLE sponsors (
    id int PRIMARY KEY AUTO_INCREMENT ,
    nom varchar(100) NOT NULL ,
    Contribution varchar(100) ,
    tournoi_id int ,
    date datetime DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tournoi_id) REFERENCES tournoi(id) 
)

__________________________________________
Joueur tournoi sponsors 