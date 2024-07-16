DROP DATABASE IF EXISTS db_infop16a_ETU002512;
CREATE DATABASE db_infop16a_ETU002512;

use db_infop16a_ETU002512;

create table client (
    id_client int primary key auto_increment,
    e_mail VARCHAR(100),
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
    durre TIME NOT NULL
);

create table service_montant(
    id_service int NOT  NULL,
    montant int,
    date_service date,
    foreign key (id_service) references service(id_service)
);

create table service_sup (
    id_service int,
    foreign key (id_service) references service(id_service)
);

CREATE VIEW service_non_sup AS
SELECT s.id_service, s.nom_service, s.durre
FROM service s
LEFT JOIN service_sup ss ON s.id_service = ss.id_service
WHERE ss.id_service IS NULL;

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
    type_voiture VARCHAR(100) NOT NULL,
    id_rdv int NOT NULL,
    id_service int NOT NULL,
    montant int NOT NULL,
    date_paymant Date,
    foreign key (id_client) references client(id_client),
    foreign key (id_service) references service(id_service),
    foreign key (id_rdv) references rdv(id_rdv)
);

create table reference (
    id_reference int primary key auto_increment,
    reference date
);
