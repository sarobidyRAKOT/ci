<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donnees extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Chargement de la base de données dans le constructeur
        $this->load->database();
    }

    public function delete_donnees() {
        $this->db->empty_table('devise');
        $this->db->empty_table('rdv');
        $this->db->empty_table('client');
        $this->db->empty_table('service');
    }

    public function csv_base_service() {

    }

    public function csv_base_traveau() {
        
    }
}