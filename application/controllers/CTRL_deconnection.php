
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTRL_deconnection extends CI_Controller {


    public function __construct() {
        parent::__construct();
		// $this->load->model('Service');
    }


	public function deconnecter () {

		$this->session->sess_destroy();
		
		redirect('/');
		
	}





}

