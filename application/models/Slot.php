<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slot extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	public function get_all () {
		$query = $this->db->get('slot');
		$result = $query->result();
	
		// Initialiser un tableau pour stocker les résultats
		$slot = [];
	
		// Boucle pour remplir le tableau avec les résultats
		foreach ($result as $row) {
			$slot[] = [
				'id_slot' => $row->id_slot,
				'nom_slot' => $row->nom_slot
			];
		}
	
		return $slot;
    }
}
