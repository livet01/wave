<?php
class Connexion extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this -> connexion();
	}

	public function connexion($msg = NULL) {
		if (!$this -> input -> post('password') && !$this -> input -> post('login')) {
			if ($this -> session -> userdata('isLogged') === TRUE) {
				redirect('index', 'index');
			} else {
				$data['msg'] = $msg;
			}
		} else {
			if (($this -> input -> post('login') == "") || ($this -> input -> post('password') == "")) {
				$msg = array();
				$msg[0] = "Login ou Mot de Passe manquant(s)";
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
				if (($login == $loginBase) && (md5($password) == $passwordBase)) {
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
					redirect('index', 'index');
				} else {
					$msg = array();
					$msg[0] = "Login ou Mot de Passe incorrect(s)";
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