insert into admin(e_mail,mdp) values ('garage@gmail.com','admin');

insert into service(nom_service, durre) values ('Reparation simple','1:00'),
                                                              ('Reparation standard','2:00'),
                                                              ('Reparation complexe','8:00'),
                                                              ('Entretient','2:30');

insert into service_montant (id_service, montant, date_service) values
(1, 150000, '2024-05-24'),
(2, 250000, '2024-05-24'),
(3, 800000, '2024-05-24'),
(4, 300000, '2024-05-24');

insert into slot(nom_slot) values ('A'),
                                   ('B'),
                                   ('C');

insert into ouverture(ouverture,fermeture) values ('8:00','18:00');
