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

	public function generate_pdf () {
        // Exemple de données à passer à la méthode generatePdf()
        $data = array(
            // 'datedebut' => '2024-07-16',
            // 'datefin' => '2024-07-18',
            // 'numero_voiture' => 'XYZ123',
            // 'idService' => 1,
            'idSlot' => 2
        );
		// $this->Pdf_generator
		// sleep(3);
		// echo "tong";
        // $this->PDF_generateur->generatePdf($data);
		// $this->PDF_generateur->generate_pdf($data);
    }






}

