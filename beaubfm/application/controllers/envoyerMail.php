<?php
class EnvoyerMail extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->output->enable_profiler(TRUE);
		$this->load->library('session');
	}

	public function index() {
		$this -> envoyerMail();
	}

	public function envoyerMail($data = array()) {
		// Helper	
		$this->load->helper('assets');
		//library
		$this->load->library('layout');
		
		// Vues 
		$this->layout->views('menu_principal')
					->view('envoyer_mail', $data);
	}

	public function envoi() {
		$this -> load -> library('email');

		
		$data['email'] = $this->input->post('email');
		
		$this->email->from('beaubfm@mail.com', 'BeaubFM');
		$this->email->to($data['email']);

		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class. <br /> TEST Again <br /> <h1> H1 Heading </h1>');
		 
		$this->email->send();
		
		echo $this->email->print_debugger();
				
	}

}
?>