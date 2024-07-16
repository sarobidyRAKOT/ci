<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rdv extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Chargement de la base de données dans le constructeur
		$this->load->model('Service');
    }

    public function check_rdv ($id_client, $durre, $id_service) {
        // Convertir $durre en objet DateTime si ce n'est pas déjà le cas
        if (!$durre instanceof DateTime) {
            $durre = new DateTime($durre);
        } 
        
        // Récupérer les heures d'ouverture et de fermeture depuis la base de données
        $query = $this->db->get('ouverture');
        $result = $query->row();
		// Convertir les heures d'ouverture et de fermeture en objets DateTime
		$ouverture = new DateTime($result->ouverture);
		$fermeture = new DateTime($result->fermeture);

		// Extraire les heures et minutes uniquement pour la comparaison
		$rdv_time = $durre->format('H:i:s');
		$ouverture_time = $ouverture->format('H:i:s');
		$fermeture_time = $fermeture->format('H:i:s');

		try {
			$this->valid_heure_rdv($ouverture_time, $fermeture_time, $rdv_time);
			$rdv_fin = $this->verifier_heure_service_complet ($id_service, $durre);
			$slot = $this->verifier_slotDispo ($durre, $durre, $rdv_fin);

			// insertion [rdv, devise] ...
			// ***** Insérer le rendez-vous dans la table rdv
			$data_rdv = array(
				'id_client' => $id_client,
				'id_slot' => $slot->id_slot,
				'id_service' => $id_service,
				'date_rdv_debut' => $durre->format('Y-m-d H:i:s'),
				'date_rdv_fin' => $rdv_fin->format('Y-m-d H:i:s')
			);

			$this->db->insert('rdv', $data_rdv);
			$id_rdv = $this->db->insert_id();
			// var_dump($service);
			var_dump($id_rdv);
			// ***** Vérifier si l'insertion a réussi
			if ($this->db->affected_rows() > 0) {
				/** si l'insertion de rdv est reussi ... */
				// Insérer une entrée dans la table devise avec date_paymant à null
				$service = $this->Service->get_service_by_id($id_service);
				$data_devise = array (
					'id_client' => $id_client,
					'id_service' => $id_service,
					'id_rdv' => $id_rdv,
					'prix_service' => $service->prix_service,
					'date_paymant' => null
				);
				$this->db->insert('devise', $data_devise);

				// return array('id_slot' => $slot->id_slot, 'nom_slot' => $slot->nom_slot);
				return true;
			} else { throw new Exception ("Rendez-vous non inserer ..."); }
		} catch (Exception $e) {
			throw new Exception ($e->getMessage());
		}

    }  

	private function valid_heure_rdv ($h_ouv, $h_ferm, $h_demander) {
		/**
		 * verifier si l'heure de rendez vous est valid
		 */
		if ($h_demander >= $h_ouv && $h_demander < $h_ferm) {
			return true;
		} else {
			throw new Exception("On ne travail plus a cette heure");
		}
	}
	private function verifier_heure_service_complet ($id_service, $durre) {
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
				// s'il ny a pas de conflit ...
				/**
				 * tafiditra fotsin le rendez vous fa mbl tsy mikoty an le
				 * heure restant we mbl vita ve le reparation mandrapa-tapitry ny oran firavana
				 */
				return $rdv_fin;
			} else { throw new Exception ("prennez un autre heure de rendez-vous"); }
		} else {
			throw new Exception ("ce service n'existe pas");
		}
	}
	private function verifier_slotDispo ($rdv_debut, $durre, $rdv_fin) {
		
		$slots_query = $this->db->get('slot');
		$slots = $slots_query->result();
		$slot_dispo = false;
		$slot_afak_miasa = null;

		foreach ($slots as $slot) {
			$this->db->where('date_rdv_debut <=', $rdv_fin->format('Y-m-d H:i:s'));
			$this->db->where('date_rdv_fin >=', $durre->format('Y-m-d H:i:s'));
			$this->db->where('id_slot', $slot->id_slot);

			$slot_conflict_query = $this->db->get('rdv');
			if ($slot_conflict_query->num_rows() == 0) {
				// ra tsy miasa le slot ...
				// ---> on peux passer a l'insertion [rdv, devise]
				$slot_dispo = true; // valide ...
				$slot_afak_miasa = $slot;
				break;
			}
		}
		if ($slot_dispo) {
			return $slot_afak_miasa;
		} else {
			throw new Exception ("Aucnu slot disponible pour cette rendez-vous !!");
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
