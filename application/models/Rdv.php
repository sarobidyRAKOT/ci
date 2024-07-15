<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rdv extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Chargement de la base de données dans le constructeur
        $this->load->database();
    }

    public function check_rdv($id_client, $durre, $id_service) {
        // Convertir $durre en objet DateTime si ce n'est pas déjà le cas
        if (!$durre instanceof DateTime) {
            $durre = new DateTime($durre);
        }
        
        // Récupérer les heures d'ouverture et de fermeture depuis la base de données
        $query = $this->db->get('ouverture');
        $result = $query->row();
    
        if ($result) {
            // Convertir les heures d'ouverture et de fermeture en objets DateTime
            $ouverture = new DateTime($result->ouverture);
            $fermeture = new DateTime($result->fermeture);
    
            // Extraire les heures et minutes uniquement pour la comparaison
            $rdv_time = $durre->format('H:i:s');
            $ouverture_time = $ouverture->format('H:i:s');
            $fermeture_time = $fermeture->format('H:i:s');
    
            // Vérifier que l'heure de $durre est entre ouverture et fermeture
            if ($rdv_time >= $ouverture_time && $rdv_time < $fermeture_time) {
                // Récupérer la durée du service
                $service_query = $this->db->get_where('service', array('id_service' => $id_service));
                $service_result = $service_query->row();
    
                if ($service_result) {
                    // Calculer l'heure de fin du rendez-vous
                    $service_duree = new DateTime($service_result->durre);
                    $rdv_fin = clone $durre;
                    $rdv_fin->add(new DateInterval('PT' . $service_duree->format('H') . 'H' . $service_duree->format('i') . 'M' . $service_duree->format('s') . 'S'));
    
                    // Vérifier s'il y a des rendez-vous existants qui chevauchent globalement
                    $this->db->where('date_rdv_debut <=', $rdv_fin->format('Y-m-d H:i:s'));
                    $this->db->where('date_rdv_fin >=', $durre->format('Y-m-d H:i:s'));
                    $conflict_query = $this->db->get('rdv');
    
                    if ($conflict_query->num_rows() == 0) {
                        // Aucun conflit global trouvé, vérifier les slots disponibles
                        $slots_query = $this->db->get('slot');
                        $slots = $slots_query->result();
    
                        foreach ($slots as $slot) {
                            $this->db->where('date_rdv_debut <=', $rdv_fin->format('Y-m-d H:i:s'));
                            $this->db->where('date_rdv_fin >=', $durre->format('Y-m-d H:i:s'));
                            $this->db->where('id_slot', $slot->id_slot);
                            $slot_conflict_query = $this->db->get('rdv');
    
                            if ($slot_conflict_query->num_rows() == 0) {
                                // Insérer le rendez-vous dans la table rdv
                                $data_rdv = array(
                                    'id_client' => $id_client,
                                    'id_slot' => $slot->id_slot,
                                    'id_service' => $id_service,
                                    'date_rdv_debut' => $durre->format('Y-m-d H:i:s'),
                                    'date_rdv_fin' => $rdv_fin->format('Y-m-d H:i:s')
                                );
                                $this->db->insert('rdv', $data_rdv);
    
                                // Vérifier si l'insertion a réussi
                                if ($this->db->affected_rows() > 0) {
                                    // Insérer une entrée dans la table devise avec date_paymant à null
                                    $data_devise = array(
                                        'id_client' => $id_client,
                                        'id_service' => $id_service,
                                        'id_rdv' => $this->db->insert_id(), // Récupérer l'ID du RDV inséré
                                        'date_paymant' => null
                                    );
                                    $this->db->insert('devise', $data_devise);
    
                                    return array('id_slot' => $slot->id_slot, 'nom_slot' => $slot->nom_slot);
                                } else {
                                    return false; 
                                }
                            }
                        }
    
                        // Si aucun slot disponible
                        return false;
                    } else {
                        // Si un conflit est trouvé, vérifier si tous les slots sont occupés
                        $slots_query = $this->db->get('slot');
                        $slots = $slots_query->result();
                        $occupied_slots = 0;
    
                        foreach ($slots as $slot) {
                            $this->db->where('date_rdv_debut <=', $rdv_fin->format('Y-m-d H:i:s'));
                            $this->db->where('date_rdv_fin >=', $durre->format('Y-m-d H:i:s'));
                            $this->db->where('id_slot', $slot->id_slot);
                            $slot_conflict_query = $this->db->get('rdv');
    
                            if ($slot_conflict_query->num_rows() > 0) {
                                $occupied_slots++;
                            }
                        }
    
                        if ($occupied_slots == count($slots)) {
                            return false; // Tous les slots sont occupés
                        } else {
                            // Il y a au moins un slot disponible, insérer dans rdv et devise
                            foreach ($slots as $slot) {
                                $this->db->where('date_rdv_debut <=', $rdv_fin->format('Y-m-d H:i:s'));
                                $this->db->where('date_rdv_fin >=', $durre->format('Y-m-d H:i:s'));
                                $this->db->where('id_slot', $slot->id_slot);
                                $slot_conflict_query = $this->db->get('rdv');
    
                                if ($slot_conflict_query->num_rows() == 0) {
                                    // Insérer le rendez-vous dans la table rdv
                                    $data_rdv = array(
                                        'id_client' => $id_client,
                                        'id_slot' => $slot->id_slot,
                                        'id_service' => $id_service,
                                        'date_rdv_debut' => $durre->format('Y-m-d H:i:s'),
                                        'date_rdv_fin' => $rdv_fin->format('Y-m-d H:i:s')
                                    );
                                    $this->db->insert('rdv', $data_rdv);
    
                                    // Vérifier si l'insertion a réussi
                                    if ($this->db->affected_rows() > 0) {
                                        // Insérer une entrée dans la table devise avec date_paymant à null
                                        $data_devise = array(
                                            'id_client' => $id_client,
                                            'id_service' => $id_service,
                                            'id_rdv' => $this->db->insert_id(), // Récupérer l'ID du RDV inséré
                                            'date_paymant' => null
                                        );
                                        $this->db->insert('devise', $data_devise);
    
                                        return array('id_slot' => $slot->id_slot, 'nom_slot' => $slot->nom_slot);
                                    } else {
                                        return false;
                                    }
                                }
                            }
                        }
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false; 
        }
    }  
    
    public function get_rdv() {
        $query = $this->db->get('rdv');
        return $query->result();
    }

    public function get_rdv_by_id($id_rdv) {
        $this->db->where('id_rdv', $id_rdv);
        $query = $this->db->get('rdv');
        return $query->row();
    }

    // $data = array(
    //     'id_client' => $this->input->post('id_client'),
    //     'id_slot' => $this->input->post('id_slot'),
    //     'id_service' => $this->input->post('id_service'),
    //     'date_rdv_debut' => $this->input->post('date_rdv_debut'),
    //     'date_rdv_fin' => $this->input->post('date_rdv_fin')
    // );
    public function insert_rdv($data) {
        return $this->db->insert('rdv', $data);
    }
}