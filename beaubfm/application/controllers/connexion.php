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
				$this -> load -> view('connexion_form', $data);
			}
		} else {
			$passwordBase=null;
			$loginBase=null;			
			if ($this -> input -> post('login') != "") {
				$this -> load -> model('utilisateur_model', 'utilisateurManager');
				$login = $this -> input -> post('login');
				$loginFound = $this -> utilisateurManager -> loginExist($this -> input -> post('login'));
				if ($loginFound != null) {
					$loginBase = $loginFound['uti_login'];
					if ($this -> input -> post('password') != "") {
						$passwordFound = $this -> utilisateurManager -> getPasswordByLogin($this -> input -> post('login'));
						if ($passwordFound != null) {
							$passwordBase = $passwordFound['uti_mdp'];
						}
					}
				}
			}
			if (($this -> input -> post('login') == "") || ($this -> input -> post('password') == "")) {
				$msg = array();
				$msg[0] = "Login ou Mot de Passe manquant(s)";
				$msg[1] = "info";
				$msg[2] = "icon-info-sign";
			} else {
				if ($loginBase != null && $passwordBase != null) {
					if (($login == $loginBase) && (md5($this -> input -> post('password')) == $passwordBase)) {
						$this -> session -> set_userdata('isLogged', TRUE);
						$username=$this -> utilisateurManager -> getPrenomByLogin($login);
						$username=$username['uti_prenom'];
						$this -> session -> set_userdata('username',$username);
						redirect('index/index/');
					}
				} else {
					$msg = array();
					$msg[0] = "Login ou Mot de Passe incorrect(s)";
					$msg[1] = "error";
					$msg[2] = "icon-exclamation-sign";
				}
			}
			$data['msg'] = $msg;
			$this -> load -> view('connexion_form', $data);
		}
	}

	public function deconnexion() {
		if ($this -> session -> userdata('isLogged') === TRUE) {
			$this->session->sess_destroy();
			redirect('connexion', 'index');
		} else {
			redirect('connexion', 'index');
		}
	}

}
?>