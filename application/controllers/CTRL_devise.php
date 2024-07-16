<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTRL_devise extends CI_Controller {


	public function __construct() {
		parent::__construct();
		$this->load->model('Devise');
		$this->load->model('Client');
		$this->load->model('Service');
		$this->load->library('Fpdf_lib'); // Charger la bibliothèque PDF_generateur
	}


	public function devise () {

		$client_id = $this->session->userdata('client_id');
		if (is_object($client_id)) {
			$client_id = $client_id->id_client; // Accéder à la propriété 'id_client'
		}

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


	public function generatePdf($data) {


		$pdf = new Fpdf_lib();
		$pdf->AddPage();

		$pdf->SetFont('Arial','B',25);
		$pdf->Cell(50);
		$pdf->SetTextColor(0,0,110);
		$pdf->Cell(30,10,'Devis de reparation');
		$pdf->Ln(8);

		$pdf->SetFont('Arial','',12);
		$pdf->Cell(32);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(30,10,'Date debut : '.$data["datedebut"].'  -  Date fin : '.$data["datefin"]);
		$pdf->Ln(30);
		
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(8);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(30,10,'Description : ');
		$pdf->Cell(30,10, $data["description"]);
		$pdf->Ln(10);

		$pdf->SetFont('Arial','',12);
		$pdf->Cell(8);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(30,10,'Numero : ');
		$pdf->Cell(30,10, $data["numVoiture"]);
		$pdf->Ln(10);
		
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(8);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(30,10,'Slot : ');
		$pdf->Cell(30,10, $data["slot"]);
		$pdf->Ln(10);
		
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(8);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(30,10,'Duree service : ');
		$pdf->Cell(30,10, $data["durre"]);
		$pdf->Ln(20);

		$pdf->Line(10, 40, 200, 40);
		$pdf->Line(10, 100, 200, 100);
		
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->Cell(8);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(30,30,' Cout total du service: ');
		$pdf->Cell(90);
		$pdf->Cell(30,30, $data["cout"]);
		$pdf->Ln(10);

		$filename = 'devise_' . date('Ymd_His') . '.pdf';
		$pdf->Output('D', $filename);

		// $pdf->Output();
 }

	public function format_pdf () {
        // Exemple de données à passer à la méthode generatePdf()
		$id_devise = $this->input->get("id_devise");

        $data = $this->Devise->get_all_info_pdf ($id_devise);
		$this->generatePdf($data);
    }






}

