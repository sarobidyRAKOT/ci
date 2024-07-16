insert into admin(e_mail,mdp) values ('garage@gmail.com','admin');
insert into client (e_mail, matricule, type_voiture) values ('moi@info.com', '2512 TBH', '4x4');

insert into service(nom_service, durre, prix_service) values ('Reparation simple', '1:00', 150000),
                                                              ('Reparation standard', '2:00', 250000),
                                                              ('Reparation complexe', '8:00', 800000),
                                                              ('Entretient', '2:30', 300000);

insert into slot(nom_slot) values ('A'),
                                   ('B'),
                                   ('C');

insert into ouverture(ouverture,fermeture) values ('8:00','18:00');
