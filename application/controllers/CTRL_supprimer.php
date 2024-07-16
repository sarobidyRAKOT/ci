
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTRL_supprimer extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('Donnees');
		// $this->load->helper(array('form', 'url'));
        // $this->load->library('upload');
    }


	public function page_sup () {
		$sup_succes = $this->Donnees->delete_donnees();
		if ($sup_succes) {
			echo "vita";
		} else {
			echo "pas valide";
		}
	}



}

