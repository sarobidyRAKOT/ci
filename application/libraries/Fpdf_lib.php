<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require ('fpdf/fpdf.php');

class Fpdf_lib extends FPDF {

	function __construct () {
		parent::__construct();
	}
}
