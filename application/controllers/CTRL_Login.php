<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTRL_Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('Login');
		$this->load->model('Service');
	}


	public function connect_client () {
		$matricule = $this->input->post("matricule");
		$type = $this->input->post("type");
		try {
			$id_client = $this->Login->checkloginUser($matricule, $type);
			$this->session->set_userdata('client_id', $id_client);
			$this->load_acceuil();
		} catch (Exception $e) {
			$data = array(
				'content' => 'pages/connect_client',
				'error' => true,
				'message' => $e->getMessage()
			);
			$this->load->view('index', $data);
		}

	}

	public function connect_admin () {
		$email = $this->input->post("email");
		$mdp = $this->input->post("mdp");
		try {
			$id_client = $this->Login->checkloginAdmin ($email, $mdp);
			$this->session->set_userdata('admin_id', $id_client);
			$this->load_acceuil_admin ();
		} catch (Exception $e) {
			$data = array(
				'content' => 'pages/login_admin',
				'error' => true,
				'message' => $e->getMessage()
			);
			$this->load->view('index', $data);
		}

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

	public function load_acceuil () {
		$services = $this->Service->get_all_services();

		$data = array(
			'content' => 'pages/acceuil',
			'acceuil' => 'active',

			'services' => $services
		);
		$this->load->view('pages/template', $data);
	}

	private function load_acceuil_admin () {
		$services = $this->Service->get_all_services();
		if (empty($services)) { $services = null; }

		$data = array(
			'content' => 'pages/admin/acceuil',
			'services' => $services
		);
		$this->load->view('pages/admin/template', $data);
	}
}

?>
