<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Chargement de la base de données dans le constructeur
        $this->load->database();
    }

    public function insert_service($nom_service, $durre, $prix_service) {
        $data = array(
            'nom_service' => $nom_service,
            'durre' => $durre,
            'prix_service' => $prix_service
        );
        $this->db->insert('service', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_service_by_id($id_service) {
        $query = $this->db->get_where('service', array('id_service' => $id_service));
        return $query->row();
    }

    public function get_all_services() {
        $query = $this->db->get('service');
        return $query->result();
    }

    public function update_service($id_service, $nom_service, $durre, $prix_service) {
        $data = array(
            'nom_service' => $nom_service,
            'durre' => $durre,
            'prix_service' => $prix_service
        );
        $this->db->where('id_service', $id_service);
        return $this->db->update('service', $data);
    }

    public function delete_service($id_service) {
        $this->db->where('id_service', $id_service);
        return $this->db->delete('service');
    }
}