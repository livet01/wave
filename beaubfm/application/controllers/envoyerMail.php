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
		
	
		$data['email'] = $this->input->post('email');
		$data['envoiMail'] = (($this->input->post('envoiMail') === "0") ? "1" : "0");
		$data['titre']='toto';
		$data['artiste']='supertoto';
		$emp=$this->input->post('emplacement');
		
		
		switch ($emp){
		    case "airplay":
		        $msg = $this->load->view('email/airplay', $data);
				$this->email->message($msg);
		        break;
		    case "nonDiffuse":
		        $msg = $this->load->view('email/nonDiffuse', $data);
				$this->email->message($msg);
		        break;
		    case "archivage":
		        $msg = $this->load->view('email/archivage', $data);
				$this->email->message($msg);
		        break;
			case "emissionBenevole":
		        $msg = $this->load->view('email/emissionBenevole', $data);
				$this->email->message($msg);
		        break;
		}
		$this->email->initialize($config);
		$this->email->subject('Email automatique BeaubFM');
		$this->email->from('beaubfm@mail.com', 'BeaubFM');
		$this->email->to($data['email']);
		
		//$this->email->to('samir.bouaked@gmail.com');
		
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