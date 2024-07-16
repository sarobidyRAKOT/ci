<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devise extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Chargement de la base de données dans le constructeur
    }

    public function get_all_devises() {
        $query = $this->db->get('devise');
        return $query->result();
    }

	public function get_allDevise_client ($id_client) {

        $this->db->where('id_client', $id_client);
        $query = $this->db->get('devise');
        $result = $query->result();
		
		$devises = []; //cons tableau
		foreach ($result as $row) {
			$devises[] = [
				'id_devise' => $row->id_devise,
				'id_client' => $row->id_client,
				'id_service' => $row->id_service,
				'id_rdv' => $row->id_rdv,
				'prix_service' => $row->prix_service,
				'date_paymant' => $row->date_paymant
			];
		}
		return $devises;
	}

    public function check_date($id_devise, $date) {
        // Convertir $date en objet DateTime si ce n'est pas déjà le cas
        if (!$date instanceof DateTime) {
            $date = new DateTime($date);
        }

        $this->db->where('id_devise', $id_devise);
        $query = $this->db->get('devise');
        $devise = $query->row();

        if ($devise) {
            $this->db->where('id_rdv', $devise->id_rdv);
            $rdv_query = $this->db->get('rdv');
            $rdv = $rdv_query->row();

            if ($rdv) {
                $date_rdv_debut = new DateTime($rdv->date_rdv_debut);

                if ($date >= $date_rdv_debut) {
                    $this->db->where('id_devise', $id_devise);
                    $this->db->update('devise', array('date_paymant' => $date->format('Y-m-d')));

                    if ($this->db->affected_rows() > 0) {
                        return true;
                    } else {
                        return false;
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
}
