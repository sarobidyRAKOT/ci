<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTRL_Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('Login');
	}


	public function connect_client () {
		$matricule = $this->input->post("matricule");
		$type = $this->input->post("type");

		$id_client = $this->Login->checkloginUser($matricule, $type);
		$this->session->set_userdata('client_id', $id_client);
	}

	public function insert_client () {
		$matricule = $this->input->post("matricule");
		$type = $this->input->post("type");
		$email = $this->input->post("email");
		try {
			$id_client = $this->Login->inscription($email, $matricule, $type);
			$this->session->set_userdata('client_id', $id_client);
			
		} catch (Exception $e) {
			$data = array(
				'content' => 'pages/insertion_client',
				'error' => true,
				'message' => $e->getMessage()
			);
			$this->load->view('index', $data);
		}

	}
}

?>
