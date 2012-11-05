<?php
class ImporterFiche extends CI_Controller {

	public function __construct() {
		parent::__construct();		
	}

	public function index() {
		$this->importerFiche();
	}
	
	public function importerFiche($data = array()) {
		$this->load->library('layout');
		$this->layout->views('menu_principal')
					-> view('importer');
	}
}
?>