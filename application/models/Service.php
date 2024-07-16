<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Chargement de la base de données dans le constructeur
    }

    public function insert_($nom_service, $durre) {
        $data_service = array(
            'nom_service' => $nom_service,
            'durre' => $durre,
        );
        $this->db->insert('service', $data_service);

        return true;
    }

    public function insert_service($nom_service, $durre, $prix, $date) {
        $data_service = array(
            'nom_service' => $nom_service,
            'durre' => $durre,
        );
        $this->db->insert('service', $data_service);
        
        $id_service = $this->db->insert_id();
        
        $data_montant = array(
            'id_service' => $id_service,
            'montant' => $prix,
            'date_service' => $date,
        );
        $this->db->insert('service_montant', $data_montant);
        
        return true;
    }
    

    public function get_service_by_id($id_service) {
        $query = $this->db->get_where('service', array('id_service' => $id_service));
        return $query->row();
    }

    public function get_all_services() {
		$query = $this->db->get('service_non_sup');
		$result = $query->result();
	
		// Initialiser un tableau pour stocker les résultats
		$services = [];
	
		// Boucle pour remplir le tableau avec les résultats
		foreach ($result as $row) {
			$services[] = [
				'id_service' => $row->id_service,
				'nom_service' => $row->nom_service,
				'durre' => $row->durre,
			];
		}
	
		return $services;
    }

    public function update_service($id_service, $nom_service, $durre, $prix, $date) {
        $data = array(
            'nom_service' => $nom_service,
            'durre' => $durre,
        );
        $this->db->where('id_service', $id_service);
        $this->db->update('service', $data);
    
        $data_montant = array(
            'id_service' => $id_service,
            'montant' => $prix,
            'date_service' => $date,
        );
        $this->db->insert('service_montant', $data_montant);
    
        return true;
    }    

    public function delete_service($id_service) {
        $this->db->insert('service_sup', $id_service);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_all_slots() {
        $query = $this->db->get('slot');
        return $query->result();
    }

    public function get_montant($id_service) {
        $this->db->select('montant');
        $this->db->from('service_montant');
        $this->db->where('id_service', $id_service);
        $this->db->order_by('date_service', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->montant;
        } else {
            return null; // ou une valeur par défaut si nécessaire
        }
    }
}
