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
		if (($this -> input -> post('login') == "") || ($this -> input -> post('password') == "")) {
			$msg = array();
			$msg[0] = "Login ou Mot de Passe manquant(s)";
			$msg[1] = "info";
			$msg[2] = "icon-info-sign";
			$this -> connexion($msg);
		}
		else if (($this -> input -> post('login') == "test") && ($this -> input -> post('password') == "test")) {
			$data['uti_login'] = $this -> input -> post('login');
			var_dump($data);

			$this -> session -> set_userdata('isLogged', TRUE);
			redirect('index/index/');
		} else {
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