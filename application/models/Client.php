<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Chargement de la base de données dans le constructeur
    }

	public function get_ById ($id_client) {
        
        $this->db->where('id_client', $id_client);
        $query = $this->db->get('client');
        $row = $query->row(); 
		
		$client = array (
			'id_client' => $row->id_client,
			'e_mail' => $row->e_mail,
			'matricule' => $row->matricule,
			'type_voiture' => $row->type_voiture
		);
		return $client;
	}
    
}
