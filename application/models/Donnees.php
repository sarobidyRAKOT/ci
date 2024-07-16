<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donnees extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Chargement de la base de données dans le constructeur
        $this->load->database();
        $this->load->model('Service');
    }

    public function delete_donnees() {
        $this->db->empty_table('devise');
        $this->db->empty_table('rdv');
        $this->db->empty_table('client');
        $this->db->empty_table('service');

		return true;
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

    public function csv_base_service($csv_path) {

		/** SERVICE */
        if (!file_exists($csv_path) || !is_readable($csv_path)) {
            return false;
        }

        if (($handle = fopen($csv_path, 'r')) !== FALSE) {
            $header = fgetcsv($handle, 1000, ',');

            while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $data = array(
                    'nom_service' => $row[0],
                    'durre' => $row[1]
                );

                $this->Service->insert_ ($data['nom_service'], $data['durre']);
            }

            fclose($handle);
            return true;
        } else {
            return false;
        }
    }

    public function csv_base_traveau($csv_path) {
		/** TRAVAUX */

        if (!file_exists($csv_path) || !is_readable($csv_path)) {
            return false;
        }

        if (($handle = fopen($csv_path, 'r')) !== FALSE) {
            $header = fgetcsv($handle, 1000, ',');

            while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $matricule = $row[0];
                $type_voiture = $row[1];
                $date_rdv = $row[2];
                $heure_rdv = $row[3];
                $type_service = $row[4];
                $montant = $row[5];
                $date_paiement = isset($row[6]) ? $row[6] : null;

                // Vérifier si le client existe déjà
                $this->db->where('matricule', $matricule);
                $client_query = $this->db->get('client');
                if ($client_query->num_rows() > 0) {
                    $client = $client_query->row();
                    $id_client = $client->id_client;
                } else {
                    $data_client = array(
                        'matricule' => $matricule,
                        'type_voiture' => $type_voiture,
                        'e_mail' => null
                    );
                    $this->db->insert('client', $data_client);
                    $id_client = $this->db->insert_id();
                }

                // Récupérer l'id_service correspondant au nom_service
                $this->db->where('nom_service', $type_service);
                $service_query = $this->db->get('service');
                if ($service_query->num_rows() > 0) {
                    $service = $service_query->row();
                    $id_service = $service->id_service;

                    // Calculer date_rdv_debut et date_rdv_fin
                    $date_rdv_debut = DateTime::createFromFormat('d/m/Y H:i', "$date_rdv $heure_rdv");
                    $durre_service = new DateTime($service->durre);
                    $interval = new DateInterval('PT' . $durre_service->format('H') . 'H' . $durre_service->format('i') . 'M');
                    $date_rdv_fin = clone $date_rdv_debut;
                    $date_rdv_fin->add($interval);

                    $data_rdv = array(
                        'id_client' => $id_client,
                        'id_slot' => 1,
                        'id_service' => $id_service,
                        'date_rdv_debut' => $date_rdv_debut->format('Y-m-d H:i:s'),
                        'date_rdv_fin' => $date_rdv_fin->format('Y-m-d H:i:s')
                    );
                    $this->db->insert('rdv', $data_rdv);
                    $id_rdv = $this->db->insert_id();

                    $data_devise = array(
                        'id_client' => $id_client,
                        'type_voiture' => $type_voiture,
                        'id_rdv' => $id_rdv,
                        'id_service' => $id_service,
                        'montant' => $montant,
                        'date_paymant' => $date_paiement ? DateTime::createFromFormat('d/m/Y', $date_paiement)->format('Y-m-d') : null
                    );
                    $this->db->insert('devise', $data_devise);
                }
            }

            fclose($handle);
            return true;
        } else {
            return false;
        }
    }

    public function insert_reference ($reference_date) {
        $data = array(
            'reference' => $reference_date,
        );
        $this->db->insert('reference', $data);
    
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function chiffre_affaire_date () {
        $this->db->select_max('id_reference');
        $query = $this->db->get('reference');
        $max_id_reference = $query->row()->id_reference;
    
        // Récupérer la date correspondant à l'ID de référence maximum
        $this->db->select('reference');
        $this->db->where('id_reference', $max_id_reference);
        $query = $this->db->get('reference');
        $reference_date = $query->row()->reference;
    
        // Calculer le chiffre d'affaires payé jusqu'à la date limite
        $this->db->select_sum('devise.montant');
        $this->db->from('devise');
        $this->db->join('rdv', 'devise.id_rdv = rdv.id_rdv');
        $this->db->where('rdv.date_rdv_debut <=', $reference_date);
        $this->db->where('devise.date_paymant IS NOT NULL');
        $query_paye = $this->db->get();
        $chiffre_affaire_paye = $query_paye->row()->montant;
    
        // Calculer le chiffre d'affaires non payé jusqu'à la date limite
        $this->db->select_sum('devise.montant');
        $this->db->from('devise');
        $this->db->join('rdv', 'devise.id_rdv = rdv.id_rdv');
        $this->db->where('rdv.date_rdv_debut <=', $reference_date);
        $this->db->where('devise.date_paymant IS NULL');
        $query_non_paye = $this->db->get();
        $chiffre_affaire_non_paye = $query_non_paye->row()->montant;
    
        return array(
            'date_reference' => $reference_date,
            'chiffre_affaire_paye' => $chiffre_affaire_paye,
            'chiffre_affaire_non_paye' => $chiffre_affaire_non_paye
        );
    }    
}
