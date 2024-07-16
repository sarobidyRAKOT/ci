
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTRL_dashboard extends CI_Controller {


    public function __construct() {
        parent::__construct();
		$this->load->model('Donnees');
    }

	public function page_dashboard () {
		$dash = $this->Donnees->chiffre_affaire_date ();
		$data = array(
			'content' => 'pages/admin/dashbord',
			'dashboard' => 'active',
			'dash' => $dash
		);
		// var_dump ($dash);
		$data['dash_json'] = json_encode($dash);
		$this->load->view('pages/admin/template', $data);
	}




}

