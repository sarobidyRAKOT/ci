<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTRL_service extends CI_Controller {


	public function __construct() {
		parent::__construct();
		$this->load->model('Devise');
		$this->load->model('Client');
		$this->load->model('Service');
		// $this->load->library('PDF_generateur'); // Charger la bibliothèque PDF_generateur
	}


	public function devise () {

		$client_id = $this->session->userdata('client_id')->id_client;

		$client = $this->Client->get_ById ($client_id);

		$info_devises = array();
		$devises = $this->Devise->get_allDevise_client ($client_id);
		foreach ($devises as $devise) {
			$id_service = $devise['id_service'];
			$service = $this->Service->get_service_by_id($id_service);
			$info = array (
				'id_devise' => $devise["id_devise"],
				'e_mail' => $client['e_mail'],
				'nom_service' => $service->nom_service,
				'prix_service' => $service->prix_service,
				'payement' => $devise["date_paymant"]
			);
			$info_devises[] = $info;
		}

		
		if (empty($info_devises)) { $info_devises = null; }

		$data = array (
			'content' => 'pages/devise',
			'devise' => 'active',

			'info_devises' => $info_devises
		);
		$this->load->view("pages/template", $data);
	}

	public function modifier_service () {

		$id_service = $this->input->get("id_service");
		$service = $this->Service->get_service_by_id($id_service);
		$montant = $this->Service->get_montant_desc ($id_service);
		$info_service = array (
			'id_service' => $id_service, 
			'nom_service' => $service->nom_service, 
			'durre' => $service->durre,
			'date_service' => $montant->date_service,
			'montant' => $montant->montant
		);

		// if (empty($donnee)) { $donnee = null; }

		$data = array(
			'content' => 'pages/admin/modifier_service',
			'acceuil' => 'active',
			'info_service' => $info_service,
			
		);
		$this->load->view('pages/admin/template', $data);
	}

	public function validation_modification () {
		
		$id_service = $this->input->post("id_service");
		$nom_service = $this->input->post("nom_service");
		$durre = $this->input->post("durre");
		$prix = $this->input->post("prix");
		$date = $this->input->post("date");

		if (
			!empty($id_service) &&
			!empty($nom_service) &&
			!empty($durre) &&
			!empty($prix) &&
			!empty($date)
		) {
			$valid = $this->Service->update_service ($id_service, $nom_service, $durre, $prix, $date);
			// var_dump($valid);
			if ($valid == true) {
				
				redirect('acceuil_admin');
			} else {
				$data = array (
					'message' => "modification invalide [erreur SQL]",
					'page_retour' => "acceuil_admin"
				);
				$this->load->view("errors/error", $data);
			}			
		} else {
			$data = array (
				'message' => "tous les formulaire doit etre complet",
				'page_retour' => "acceuil_admin"
			);
			$this->load->view("errors/error", $data);
		}		
	}

	public function supprimer_service () {

		$id_service = $this->input->get("id_service");
		$valid = $this->Service->delete_service ($id_service);
		if ($valid) {
			redirect('acceuil_admin');
		} else {
			$data = array (
				'message' => "impossible de supprimer",
				'page_retour' => "acceuil_admin"
			);
			$this->load->view("errors/error", $data);
		}
		
	}

	public function ajouter_service () {

		$nom_service = $this->input->post("nom_service");
		$durre = $this->input->post("durre");
		$prix = $this->input->post("prix");
		$date = $this->input->post("date");

		$valid = $this->Service->insert_service($nom_service, $durre, $prix, $date);

		if ($valid) {

			$services = $this->Service->get_all_services();
			$donnee = [];
			foreach ($services as $service) {
				$montant = $this->Service->get_montant($service["id_service"]);
				$donnee[] = array (
					'id_service' => $service["id_service"],
					'nom_service' => $service["nom_service"],
					'durre' => $service["durre"],
					'montant' => $montant
				);
			}
	
			if (empty($donnee)) { $donnee = null; }
	
			$data = array(
				'content' => 'pages/admin/acceuil',
				'acceuil' => 'active',
				'services' => $donnee
			);
			$this->load->view('pages/admin/template', $data);
		} else {
			$data = array (
				'message' => "insetion invalide",
				'page_retour' => "acceuil_admin"
			);
			$this->load->view("errors/error", $data);
		}
	}

	public function page_ajouter_service () {
		$data = array(
			'content' => 'pages/admin/ajouter_service',
			'acceuil' => 'active'
		);
		$this->load->view('pages/admin/template', $data);
	}



}

