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
		$data['envoiMail'] = (($this->input->post('envoiMail') === "0") ? "1" : "0");
		$data['titre']='toto';
		$data['artiste']='supertoto';
		$emp=$this->input->post('emplacement');
		
		
		switch ($emp){
		    case "airplay":
		        $msg = $this->load->view('email/airplay', $data);
		        break;
		    case "nonDiffuse":
		        $msg = $this->load->view('email/nonDiffuse', $data);
		        break;
		    case "archivage":
		        $msg = $this->load->view('email/archivage', $data);
		        break;
			case "emissionBenevole":
		        $msg = $this->load->view('email/emissionBenevole', $data);
		        break;
		}
		$this->email->subject('Email automatique BeaubFM');
		$this->email->from('beaubfm@mail.com', 'BeaubFM');
		$this->email->to($data['email']);
		//$this->email->to('samir.bouaked@gmail.com');
		$this->email->message($msg);
		
		if($data['envoiMail']=='1'){
			$this->email->send();
			$this->envoyerMail();	
		}
		else{
			$this->envoyerMail();
		}
		//echo $this->email->print_debugger();		
	}

}
?>