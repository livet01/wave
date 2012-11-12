<?php
class Connexion extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> library('form_validation');
		$this -> load -> library('securite');
		$this -> load -> model('log_connexion_model', 'logConnexionManager');
		$this -> load -> model('parametre_model', 'parametreManager');
		$this->load->model('personne_model', 'persManager');
		//$this -> output -> enable_profiler(TRUE);
	}

	public function index() {

		$this -> connexion();
	}

	public function maintenance() {
		$msg = array();
		$msg[0] = "Actuellement en maintenance, veuillez recommencer plus tard.";
		$msg[1] = "info";
		$msg[2] = "icon-info-sign";
		$data['msg'] = $msg;
		$this -> load -> view('connexion_form', $data);
	}

	/*

	 public function _remap($method)
	 {
	 $this->maintenance();
	 }

	 */

	public function connexion($msg = NULL) {
		$est_co = FALSE;
		// Si l'utilisateur est déja connecté
		if ($this -> session -> userdata('isLogged') === TRUE) {
			redirect('index', 'index');
		}
		
		$maintenance = $this->parametreManager->select('maintenance');

		// On test que les champs sont pas false
		if (!$this -> input -> post('password') && !$this -> input -> post('login')) {
			$data['msg'] = $msg;
		} else {

			// Validation formulaire
			$this -> form_validation -> set_rules('login', 'login', 'trim|required|xss_clean');
			$this -> form_validation -> set_rules('password', 'password', 'trim|required|xss_clean');
			$this -> form_validation -> set_message('required', 'Nom d\'utilisateur et mot de passe requis');

			// Champs requis
			if ($this -> form_validation -> run() == FALSE) {
				$msg = array();
				$msg[0] = validation_errors('&nbsp;', '&nbsp;');
				$msg[1] = "info";
				$msg[2] = "icon-info-sign";
			} else {
				// Attribution des variables
				$loginBase = null;
				$login = $this -> input -> post('login');
				$password = $this -> input -> post('password');

				// Model
				$this -> load -> model('membre_model', 'membreManager');

				// On recupère le login si il existe dans la base de donnée
				$loginBase = $this -> membreManager -> loginExist($login);

				if ($loginBase != null) 
				{
					$loginBase = $loginBase['mem_login'];

					$passwordBase = $this -> membreManager -> getPasswordByLogin($login);
					$passwordBase = $passwordBase['mem_mdp'];

					if (($login == $loginBase)) 
					{
						$verrouBase = $this -> membreManager -> getVerrouByLogin($login);

						if ($verrouBase['mem_verrou'] < 10) {
							if ($this -> securite -> crypt($password) == $passwordBase) {
								$est_co = TRUE;
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
							} else {
								$this -> membreManager -> setVerrouByLogin($login, $verrouBase['mem_verrou'] + 1);
								$msg = array();
								$msg[0] = "Nom d'utilisateur ou mot de passe incorrect(s)";
								$msg[1] = "error";
								$msg[2] = "icon-exclamation-sign";
							}
						} else {
							$msg = array();
							$msg[0] = "Votre compte est bloqué, merci de contacter l'administrateur";
							$msg[1] = "error";
							$msg[2] = "icon-exclamation-sign";

						}
					} else {
						$msg = array();
						$msg[0] = "Nom d'utilisateur ou mot de passe incorrect(s)";
						$msg[1] = "error";
						$msg[2] = "icon-exclamation-sign";
					}
				} else {
					$msg = array();
					$msg[0] = "Nom d'utilisateur ou mot de passe incorrect(s)";
					$msg[1] = "error";
					$msg[2] = "icon-exclamation-sign";
				}

				if ($this -> membreManager -> getIdByLogin($login) == null) {
					$per_id = NULL;
				} else {
					$per_id = $this -> membreManager -> getIdByLogin($login);
				}
				$this -> logConnexionManager -> insert(array('reussi' => $est_co, 'ip_adresse' => $this -> input -> ip_address(), 'user_agent' => $this -> input -> user_agent(), 'login' => $login, 'per_id' => $per_id['mem_id']));

			}

		}
		
		if(!empty($maintenance) and $maintenance['param_valeur'] == "1" ) {
			$data = array();
			$msg[0] = "Le site est actuellement en maintenance, réessayez plus tard.";
			$msg[1] = "info";
			$msg[2] = "icon-info-sign";
			$data['msg'] = $msg;
			if ($est_co) 
			{
				$cat_id = $this->persManager->readPersonne('cat_id',array('per_id'=>$per_id['mem_id']));
				if($cat_id['cat_id'] == 1 ) {
					redirect('index', 'index');
				}
				else{
					if ($this -> session -> userdata('isLogged') === TRUE) {
						$this -> session -> sess_destroy();
					}
				}
			}
			
			$this -> load -> view('connexion_form', $data);
		}
		else
		{
			if (!$est_co) {
				$data['msg'] = $msg;
				$this -> load -> view('connexion_form', $data);
			} else {
				redirect('index', 'index');
			}
		}		
	}

	public function deconnexion() {
		if ($this -> session -> userdata('isLogged') === TRUE) {
			$this -> session -> sess_destroy();
		}
		redirect('connexion', 'index');
	}

}
?>