insert into admin(e_mail,mdp) values ('garage@gmail.com','admin');

insert into service(nom_service, durre) values ('Reparation simple','1:00'),
                                                              ('Reparation standard','2:00'),
                                                              ('Reparation complexe','8:00'),
                                                              ('Entretient','2:30');

insert into slot(nom_slot) values ('A'),
                                   ('B'),
                                   ('C');

insert into ouverture(ouverture,fermeture) values ('8:00','18:00');

insert into type_voiture(nom_type) values ('legere'),
                                            ('4*4'),
                                            ('Utilitaire');