<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devise extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Chargement de la base de données dans le constructeur
    }
}
