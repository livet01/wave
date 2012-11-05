<?php
class Deconnexion extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this -> deconnexion();
	}

	public function deconnexion() {
		if ($this -> session -> userdata('isLogged') === TRUE) {
			$this -> session -> set_userdata('isLogged', FALSE);
			redirect('index', 'index');			
		} else {
			$this -> load -> view('connexion_form');
		}
	}
}
?>