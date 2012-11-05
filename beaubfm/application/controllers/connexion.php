<?php
class Connexion extends CI_Controller {
	
	public function __construct() {
		parent::__construct();		
	}

	public function index() {
		$this->connexion();
	}
	
	public function connexion() {
		$this->load->view('connexion_form');
	}
	
	public function connexionOn(){
		$data['uti_login']=$this->input->post('login');
		var_dump($data);
		
		$this->load->model('utilisateur_model', 'utilisateurManager');		
		$this->data = $this->utilisateurManager->readUtilisateurParLogin($data['uti_login']);
		
		$this->session->set_userdata('login', $data['uti_login']);
		$this->session->set_userdata('prenom', $data['uti_prenom']);
		$this->session->set_userdata('isLogged', TRUE);
		
		
	}
}
?>