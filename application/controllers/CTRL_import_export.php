
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTRL_import_export extends CI_Controller {


    public function __construct() {
        parent::__construct();
		$this->load->model('Donnees');
		$this->load->helper(array('form', 'url'));
        $this->load->library('upload');
    }

	public function import_export () {

		$data = array(
			'content' => 'pages/admin/import_export',
			'import_export' => 'active'
		);
		$this->load->view('pages/admin/template', $data);
	}


	public function valid_formImport_export () {

	// Configuration de l'upload pour le premier fichier (service)
		$config_service['upload_path'] = './uploads/';
		$config_service['allowed_types'] = 'csv';
		$config_service['max_size'] = 20480;

		$this->upload->initialize($config_service);
		$service_path = null;
		$travaux_path = null;
		
		if (!$this->upload->do_upload('service')) {
			// En cas d'erreur d'upload
			$data = array (
				'message' => "SERVICE ".$this->upload->display_errors(),
				'page_retour' => "import_export"
			);
			$this->load->view("errors/error", $data);
		} else {
			// Succès de l'upload
			$data_service = $this->upload->data();
			$service_path = $data_service['full_path']; // Chemin complet du fichier uploadé
		}



	// Configuration de l'upload pour le deuxième fichier (travaux)
		$config_travaux['upload_path'] = './uploads/';
		$config_travaux['allowed_types'] = 'csv';
		$config_travaux['max_size'] = 20480;

		$this->upload->initialize($config_travaux);

		if (!$this->upload->do_upload('travaux')) {
			// En cas d'erreur d'upload
			$data = array (
				'message' =>  "TRAVAUX ".$this->upload->display_errors(),
				'page_retour' => "import_export"
			);
			$this->load->view("errors/error", $data);
		} else {
			// Succès de l'upload
			$data_travaux = $this->upload->data();
			$travaux_path = $data_travaux['full_path']; // Chemin complet du fichier uploadé
		}


		$valid_service = $this->Donnees->csv_base_service ($service_path);
		if ($valid_service) {
			$valid_travaux = $this->Donnees->csv_base_traveau ($travaux_path);
			if ($valid_travaux) {
				echo "valide";	
			} else {
				echo "error travaux";
			}		
		} else {
			echo "error service";
		}
		
		// $this->load->view('your_view', $data);
	}


}

