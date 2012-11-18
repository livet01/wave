<?php
class EnvoyerMail extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this -> envoyerMail();
	}

	public function envoyerMail($data = array()) {
		$this -> load -> library('layout');
		$this -> layout -> views('menu_principal') -> view('envoyer_mail', array('error' => ' '));
	}

	public function envoi() {
		
	}

}
?>