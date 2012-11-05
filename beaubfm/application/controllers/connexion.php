<?php
class Connexion extends CI_Controller {

	public function __construct() {
		parent::__construct();		
	}

	public function index() {
		$this->connexion();
	}
	
	public function connexion($data = array()) {
		$this->load->view('connexion_form');
	}
}
?>