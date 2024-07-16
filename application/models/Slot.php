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

	public function get_byId ($id_slot) {
		$this->db->where('id_slot =', $id_slot);
		$query = $this->db->get('slot');
		$row = $query->row();
	
		// Initialiser un tableau pour stocker les résultats	
		// Boucle pour remplir le tableau avec les résultats
		$slot = array (
			'id_slot' => $row->id_slot,
			'nom_slot' => $row->nom_slot
		);
	
		return $slot;
    }


	// $resultats_utilisation = $this->Slot->utilisation_slot($jour);
	// foreach ($resultats_utilisation as $nom_slot => $matricules) {
	// 	echo 'Pour le slot ' . $nom_slot . ':<br>';
	// 	foreach ($matricules as $matricule) {
	// 		echo '- Matricule : ' . $matricule . '<br>';
	// 	}
	// 	echo '<br>';
	// }
	public function utilisation_slot($jour) {
		$date_jour = date('Y-m-d', strtotime($jour));
		$slots = $this->Slot->get_all();
	
		$utilisation_slots = [];
	
		foreach ($slots as $slot) {
			$id_slot = $slot['id_slot'];
			$nom_slot = $slot['nom_slot'];
	
			$this->db->select('c.matricule');
			$this->db->from('rdv as r');
			$this->db->join('client as c', 'r.id_client = c.id_client');
			$this->db->where('r.id_slot', $id_slot);
			$this->db->where('DATE(r.date_rdv_debut)', $date_jour);
			$this->db->order_by('r.date_rdv_debut');
			$query = $this->db->get();
	
			$matricules = [];
	
			// Traitement des résultats pour ce slot
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$matricules[] = $row->matricule;
				}
			}
	
			$utilisation_slots[$nom_slot] = $matricules;
		}
		return $utilisation_slots;
	}
}
