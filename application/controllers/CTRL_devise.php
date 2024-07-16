<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTRL_devise extends CI_Controller {


    public function __construct() {
        parent::__construct();
		$this->load->model('Devise');
		$this->load->model('Client');
		$this->load->model('Service');
    }


	public function devise () {
		// $client_id = $this->session->userdata('client_id');
		// $client_id = $client_id->id_client;
		// $id_slot = $this->input->post("id_slot");
		// $id_service = $this->input->post("id_service");
		// $dateTime = $this->input->post("dateTime");


		// try {
		// 	$valid_rdv = $this->Rdv->check_rdv ($client_id, $dateTime, $id_service);
		// 	// ---> valid rendez - vous
		// 	redirect('acceuil_client');
		// } catch (Exception $e) {
		// 	$data = array (
		// 		'message' => $e->getMessage(),
		// 		'page_retour' => "acceuil_client"
		// 	);
		// 	$this->load->view("errors/error", $data);
		// }
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





}

