<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTRL_rdv extends CI_Controller {


    public function __construct() {
        parent::__construct();
		$this->load->model('Rdv');
    }


	public function prendre_rdv () {
		$client_id = $this->session->userdata('client_id');

		if (is_object($client_id)) {
			$client_id = $client_id->id_client; // Accéder à la propriété 'id_client'
		}

		$id_slot = $this->input->post("id_slot");
		$id_service = $this->input->post("id_service");
		$dateTime = $this->input->post("dateTime");


		try {
			$valid_rdv = $this->Rdv->check_rdv ($client_id, $dateTime, $id_service);
			// ---> valid rendez - vous
			redirect('acceuil_client');
		} catch (Exception $e) {
			$data = array (
				'message' => $e->getMessage(),
				'page_retour' => "acceuil_client"
			);
			$this->load->view("errors/error", $data);
		}
	}





}

