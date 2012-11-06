<?php
class Connexion extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this -> connexion();
	}

	public function connexion($msg = NULL) {
		if ($this -> session -> userdata('isLogged') === TRUE) {
			redirect('index', 'index');			
		} else {
			$data['msg'] = $msg;
			$this -> load -> view('connexion_form', $data);
		}
	}

	public function connexionOn() {
		$this->load->model('utilisateur_model', 'utilisateurManager');
		$login = $this->input->post('login');
		$loginFound = $this->utilisateurManager->loginExist($this -> input -> post('login'));
		$loginBase=$loginFound['uti_login'];
		$passwordFound=$this->utilisateurManager->getPasswordByLogin($this->input->post('login'));
		$passwordBase=$passwordFound['uti_mdp'];
		
		if (($login== "") || ($this -> input -> post('password') == "")) {
			$msg = array();
			$msg[0] = "Login ou Mot de Passe manquant(s)";
			$msg[1] = "info";
			$msg[2] = "icon-info-sign";
			$this -> connexion($msg);
		}
		else if (($login == $loginBase) && ($this -> input -> post('password') == $passwordBase)) {
			$data['uti_login'] = $this -> input -> post('login');
			var_dump($data);


			$this -> session -> set_userdata('isLogged', TRUE);
			redirect('index/index/');
		} else {
			$data['uti_login'] = $this -> input -> post('login');
			var_dump($data);
			echo $this->utilisateurManager->loginExist($login);
			$msg = array();
			$msg[0] = "Login ou Mot de Passe incorrect(s)";
			$msg[1] = "error";
			$msg[2] = "icon-exclamation-sign";
			$this -> connexion($msg);
			//redirect('connexion/connexion');
		}
	}
}
?>