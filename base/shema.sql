CREATE DATABASE IF NOT EXISTS garage;
use garage;

create table client (
    id_client int primary key auto_increment,
    e_mail VARCHAR(100) NOT NULL,
    matricule VARCHAR(8) NOT NULL,
    type_voiture VARCHAR(100) NOT NULL
);

create table admin (
    id_admin int primary key,
    e_mail VARCHAR(100),
    mdp VARCHAR(10)
);

create table service (
    id_service int primary key auto_increment,
    nom_service text NOT NULL,
    durre TIME NOT NULL,
    prix_service int NOT NULL
);

create table slot (
    id_slot int primary key auto_increment,
    nom_slot CHAR
);

create table ouverture (
    ouverture TIME NOT NULL,
    fermeture TIMe NOT NULL
);

create table rdv (
    id_rdv int primary key auto_increment,
    id_client int NOT NULL,
    id_slot int NOT NULL,
    id_service int NOT NULL,
    date_rdv_debut DateTime,
    date_rdv_fin DateTime,
    foreign key (id_client) references client(id_client),
    foreign key (id_slot) references slot(id_slot),
    foreign key (id_service) references service(id_service)
);

create table devise (
    id_devise int primary key auto_increment,
    id_client int NOT NULL,
    id_service int NOT NULL,
	id_rdv int NOT NULL,
	prix_service int NOT NULL,
    date_paymant Date,
    foreign key (id_client) references client(id_client),
    foreign key (id_service) references service(id_service),
    foreign key (id_rdv) references rdv (id_rdv)
);
