<?php
class EnvoyerMail extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->output->enable_profiler(TRUE);
		$this->load->library('session');
		$this -> load -> library('email');
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
		
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['newline']    = "\r\n";


		$this->email->initialize($config);
		
		
		$data['email'] = $this->input->post('email');
		$data['corps'] = $this->input->post('corpsemail');
		
		$data['envoiMail'] = $this->input->post('envoiMail');
		$this->email->from('beaubfm@mail.com', 'BeaubFM');
		$this->email->to($data['email']);
		
		$titre='toto';
		$artiste='supertoto';
		
		$this->email->subject('Email automatique BeaubFM');
		$this->email->message("
		Nous avons bien recu l\'album <strong>$titre</strong> de l\'artiste
		<strong>$artiste</strong>...
		
		");
		if($data['envoiMail']=='1'){
			$this->email->send();
		}
		
		
		echo $this->email->print_debugger();
				
	}

}
?>