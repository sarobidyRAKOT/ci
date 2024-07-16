
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTRL_configDate extends CI_Controller {


    public function __construct() {
        parent::__construct();
		$this->load->model('Donnees');
    }

	public function page_configRef  () {
		$data = array(
			'content' => 'pages/admin/configuration_dateRef',
			'config_date' => 'active'
		);
		$this->load->view('pages/admin/template', $data);
	}

	public function insert_ref () {
		$date_ref = $this->input->post("date_ref");
		$valid = $this->Donnees->insert_reference ($date_ref);
		
		if ($valid) {
			echo "mety";
		} else {
			echo "tsy nety";
		}
	}
}

