<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devise extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Chargement de la base de données dans le constructeur
        $this->load->model('Rdv');
        $this->load->model('Client');
        $this->load->model('Service');
        $this->load->model('Slot');
    }

    public function get_all_devises() {
        $query = $this->db->get('devise');
        return $query->result();
    }

    public function get_allDevise_client($id_client) {
        $this->db->where('id_client', $id_client);
        $query = $this->db->get('devise');
        $result = $query->result();
        
        $devises = []; // tableau de résultats
        foreach ($result as $row) {
            $devises[] = [
                'id_devise' => $row->id_devise,
                'id_client' => $row->id_client,
                'id_service' => $row->id_service,
                'id_rdv' => $row->id_rdv,
                'montant' => $row->montant,
                'date_paymant' => $row->date_paymant
            ];
        }
        return $devises;
    }

    public function get_all_info_pdf($id_devise) {
        $this->db->where('id_devise', $id_devise);
        $query = $this->db->get('devise');
        $row = $query->row();
        
        $rdv = $this->Rdv->get_rdv_by_id($row->id_rdv);
        $client = $this->Client->get_ById($row->id_client);
        $service = $this->Service->get_service_by_id($row->id_service);
        $slot = $this->Slot->get_byId($rdv->id_slot);

        $data = array (
            'datedebut' => $rdv->date_rdv_debut,
            'datefin' => $rdv->date_rdv_fin,
            'description' => $service->nom_service,
            'numVoiture' => $client["matricule"],
            'slot' => $slot["nom_slot"],
            'durre' => $service->durre,
            'cout' => $row->montant
        );

        return $data;
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
