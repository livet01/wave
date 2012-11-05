<?php
class Connexion extends CI_Controller {
	private $login;

	public function __construct() {
		parent::__construct();		
	}

	public function index() {
		$this->connexion();
	}
	
	public function connexion($data = array()) {
		$this->load->view('connexion_form');
		$login=$this->input->post('login');
	}
	
	public function connexionOn(){
		$this->load->model('membre_model', 'membreManager');		
		$data = $this->membreManager->readMembreParLogin($login);
		
		$this->session->set_userdata('login', $login);
		$this->session->set_userdata('nom', $data['mem_nom']);
		$this->session->set_userdata('prenom', $data['mem_prenom']);
		$this->session->set_userdata('isLogged', TRUE);
		
		
	}
}
?>