<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTRL_Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('Login');
		$this->load->model('Service');
		$this->load->model('Slot');
	}


	public function connect_client () {
		$matricule = $this->input->post("matricule");
		$type = $this->input->post("type");

		$id_client = $this->Login->checkloginUser($matricule, $type);
		$this->session->set_userdata('client_id', $id_client);
		$this->load_acceuil();
	}

	public function insert_client () {
		$matricule = $this->input->post("matricule");
		$type = $this->input->post("type");
		$email = $this->input->post("email");
		try {
			$id_client = $this->Login->inscription($email, $matricule, $type);
			$this->session->set_userdata('client_id', $id_client);
			$this->load_acceuil();
		} catch (Exception $e) {
			$data = array(
				'content' => 'pages/insertion_client',
				'error' => true,
				'message' => $e->getMessage()
			);
			$this->load->view('index', $data);
		}

	}

	private function load_acceuil () {
		$services = $this->Service->get_all_services();
		$slots = $this->Slot->get_all ();

		$data = array(
			'content' => 'pages/acceuil',
			'services' => $services,
			'slots' => $slots
		);
		$this->load->view('pages/template', $data);
	}
}

?>
