<?php
class Connexion extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('securite');
	}

	public function index() {
		
		$this -> connexion();
	}
	
	public function maintenance()
	{
		$msg = array();
		$msg[0] = "Actuellement en maintenance, veuillez recommencer plus tard.";
		$msg[1] = "info";
		$msg[2] = "icon-info-sign";
		$data['msg'] = $msg;
		$this -> load -> view('connexion_form', $data);
	}
	
	public function _remap($method)
	{
		$this->maintenance();
	}
	
	public function connexion($msg = NULL) {
		if (!$this -> input -> post('password') && !$this -> input -> post('login')) {
			if ($this -> session -> userdata('isLogged') === TRUE) {
				redirect('index', 'index');
			} else {
				$data['msg'] = $msg;
			}
		} else {	
			$this->form_validation->set_rules('login', 'login', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');
		$this->form_validation->set_message('required', 'Nom d\'utilisateur et mot de passe requis');
			if ($this->form_validation->run() == FALSE) {
				$msg = array();
				$msg[0] = validation_errors('&nbsp;','&nbsp;');
				$msg[1] = "info";
				$msg[2] = "icon-info-sign";
			} else {
				$loginBase = null;
				$login = $this -> input -> post('login');
				$password = $this -> input -> post('password');
				$this -> load -> model('membre_model', 'membreManager');
				$loginBase = $this -> membreManager -> loginExist($login);
				if ($loginBase != null) {
					$loginBase = $loginBase['mem_login'];
					$passwordBase = $this -> membreManager -> getPasswordByLogin($login);
					$passwordBase = $passwordBase['mem_mdp'];
				}
				if (($login == $loginBase) && ($this->securite->crypt($password) == $passwordBase)) {
					$this -> session -> set_userdata('isLogged', TRUE);
					$username = $this -> membreManager -> getPrenomNomByLogin($login);
					$prenom = $username['mem_prenom'];
					$nom = $username['mem_nom'];
					if ($prenom != null && $nom != null) {
						if ($prenom == $nom) {
							$username = $nom;
						} else {

							$username = $prenom . " " . $nom;
						}
					} else {
						if ($prenom == null) {
							$username = $nom;
						}
						if ($nom == null) {
							$username = $prenom;
						}
					}
					$this -> session -> set_userdata('username', $username);
					// Mouchards
					if($username==="admin"){
						$this->load-> model('parametre_model','parametreManager');
						$this->parametreManager->ajouterParam('connexionRodes',time());
					}
					redirect('index', 'index');
				} else {
					$msg = array();
					$msg[0] = "Nom d'utilisateur ou mot de passe incorrect(s)";
					$msg[1] = "error";
					$msg[2] = "icon-exclamation-sign";
				}
			}
		}
		$data['msg'] = $msg;
		$this -> load -> view('connexion_form', $data);
	}

	public function deconnexion() {
		if ($this -> session -> userdata('isLogged') === TRUE) {
			$this -> session -> sess_destroy();
		}
		redirect('connexion', 'index');
	}

}
?>