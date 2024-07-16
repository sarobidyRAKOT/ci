
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTRL_utilisation_slot extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('Slot');
    }

	public function page_utilisation_slot () {
		$jour = date('Y-m-d');
		$resultats_utilisation = $this->Slot->utilisation_slot($jour);
		$data = array(
			'content' => 'pages/admin/utilisation_slot',
			'utilisation_slot' => 'active',
			'resultats_utilisation' => $resultats_utilisation,
		);

		// var_dump ($resultats_utilisation);

        $data['tableRows'] = $this->generateTableRows($resultats_utilisation);
		$this->load->view('pages/admin/template', $data);
	}

	public function vers_filtre_slot () {
		$data = array(
			'content' => 'pages/admin/filtre_slot',
			'utilisation_slot' => 'active'
		);
		$this->load->view('pages/admin/template', $data);
	}

	public function valide_date () {
		
		$jour = $this->input->post("date_filtre");
		$resultats_utilisation = $this->Slot->utilisation_slot($jour);
		$data = array(
			'content' => 'pages/admin/utilisation_slot',
			'utilisation_slot' => 'active',
			'resultats_utilisation' => $resultats_utilisation,
		);

        $data['tableRows'] = $this->generateTableRows($resultats_utilisation);
		$this->load->view('pages/admin/template', $data);
	}

	private function generateTableRows($data) {
        $rows = '';
        $maxRows = max(array_map('count', $data)); // Trouver le nombre maximum d'éléments dans les slots

        for ($i = 0; $i < $maxRows; $i++) {
            $rows .= '<tr>';
            foreach ($data as $slot) {
                $rows .= '<td>' . ($slot[$i] ?? '') . '</td>'; // Utiliser une cellule vide si le slot n'a pas de valeur pour cet index
            }
            $rows .= '</tr>';
        }

        return $rows;
    }

}

