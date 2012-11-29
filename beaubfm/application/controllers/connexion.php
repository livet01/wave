<?php
class Connexion extends CI_Controller {

	private $login;
	private $mdp;
	private $msg = array("Veuillez vous authentifier", "warning", "icon-warning-sign");
	private static $maxConnexion;
	
	public function __construct() {
		parent::__construct();
		$this -> load -> library('form_validation');
		$this -> load -> library('securite');
		$this -> load -> model('log_connexion_model', 'logConnexionManager');
		$this -> load -> model('parametre_model', 'parametreManager');
		$this -> load -> model('personne_model', 'persManager');
		$this -> load -> model('membre_model', 'membreManager');
		$result = $this -> parametreManager -> select('max_connexion');
		self::setMaxConnexion($result['param_valeur']);
		//$this -> output -> enable_profiler(TRUE);
	}
	
	public function index() {
		
		define('TEST','TEST');
		
		if($this->verification()) {
			// Si la connexion s'est bien passé -> page d'accueil
			redirect('index', 'index');
		}
		else {
			// On fais appelle à la vue
			$this -> load -> view('connexion/connexion_form.php',array('msg'=>$this->getMsg()));
		}
	}

	public function ajax() {
		define('TEST','TEST');
		
		if($this->verification()) {
			// Si la connexion s'est bien passé -> page d'accueil
			echo "1";
		}
		else {
			// On fais appelle à la vue
			$this -> load -> view('connexion/connexion_form_erreur.php',array('msg'=>$this->getMsg()));
		}
	}
	
	private function verification() {
		$est_co = false;
		
		// Si l'utilisateur passe directement dans cette méthode
		if(!defined('TEST'))
			redirect('connexion', 'index');
			
		// Si l'utilisateur est déja connecté
		if ($this -> session -> userdata('isLogged') === TRUE) {
			redirect('index', 'index');
		}
		
		// Maintenance
		$maintenance = $this -> parametreManager -> select('maintenance');
		$est_maintenance = (!empty($maintenance) and $maintenance['param_valeur'] == "1");
		
		if($this->input->post('login') != "" or $this->input->post('password') !="") {
			// Validation formulaire
			$this -> form_validation -> set_rules('login', 'login', 'trim|required|xss_clean');
			$this -> form_validation -> set_rules('password', 'password', 'trim|required|xss_clean');
			$this -> form_validation -> set_message('required', 'Nom d\'utilisateur et mot de passe requis');
			
			// Champs requis
			if ($this -> form_validation -> run() == FALSE) {
				$this -> setMsg(array(validation_errors('&nbsp;', '&nbsp;'), "info", "icon-info-sign"));
			} else {
				
				// On insert les logins et mot de passe :
				$this->setLogin($this->input->post('login'));
				$this->setMdp($this->input->post('password')); // Mdp crypter dans le setter
				
				// On lance la connexion
				$est_co = $this -> connexion($est_maintenance);
			}
		}	
		
		// Dans le cas d'une maintenance, on affiche le message :
		if ($est_maintenance) {
			
			// On enregistre le message à afficher 
			$this->setMsg(array("Le site est actuellement en maintenance, réessayez plus tard.","info","icon-info-sign"));
			
		} 
		return $est_co;
	}


	public static function setMaxConnexion($maxConnexion) {
		self::$maxConnexion = $maxConnexion;
	}
	
	public static function getMaxConnexion() {
		return self::$maxConnexion;
	}
	
	public function setLogin($login) {
		$this -> login = $login;
	}

	public function setMdp($mdp) {
		$this -> mdp = $this -> securite -> crypt($mdp);
	}

	public function setMsg($msg) {
		$this -> msg = $msg;
	}

	public function getLogin() {
		return $this -> login;
	}

	public function getMdp() {
		return $this -> mdp;
	}

	public function getMsg() {
		return $this -> msg;
	}

	// La méthode connexion requière d'être appellé par une autre méthode !
	public function connexion($est_maintenance=FALSE) {
		// Si l'utilisateur passe directement dans cette méthode
		if(!defined('TEST'))
			redirect('connexion', 'index');
		
		$est_co = FALSE;

		// Initialisation
		$loginBase = null;

		// On recupère le login si il existe dans la base de donnée
		$id = $this -> membreManager -> getIdByLogin($this->login);

		if (isset($id) and isset($id['mem_id'])) { // Si le membre existe dans la base de donnée
			// Suppression du tableau renvoyé par la bd
			$id = $id['mem_id'];
			
			// Prend les infos du membre en bdd
			$membre = $this -> membreManager -> getMembreById($id);
			$passwordBase = $membre['mem_mdp'];
			$verrouBase = $membre['mem_verrou'];
			
			// Test Verrou
			if ($verrouBase < self::getMaxConnexion()) { // Si le verrou est inférieur au nombre limite de connexion possible
				
				// Test mot de passe
				if ($this -> mdp == $passwordBase) { // Si mdp correcte
						
						// L'utilisateur est t'il administrateur ?
						$cat_id = $this -> persManager -> readPersonne('cat_id', array('per_id' => $id));
						$est_admin = ($cat_id['cat_id'] == 1);
						
						// Si la maintenance est déactivé ou si la maintenance est activé et que c'est un admin
						if (!$est_maintenance or ($est_maintenance and $est_admin)) {
			
							// Booléen de connexion a true
							$est_co = TRUE;
							
							// On enregistre en session qu'il est loggé
							$this -> session -> set_userdata('isLogged', TRUE);
							
							// Enregistrement de l'id en base
							$this -> session -> set_userdata('mem_id', $id);
							
							// On place le verrou à 0
							$this -> membreManager -> setVerrouByLogin($membre['mem_login'], 0);
						}
						else { // La maintenance est activé
						
							// On enregistre le message à afficher 
							$this->setMsg(array("Le site est actuellement en maintenance, réessayez plus tard.","info","icon-info-sign"));
			
						}
				} else { // Dans le cas d'un mdp incorecte
					
					// On incrémente le verrou
					$this -> membreManager -> setVerrouByLogin($membre['mem_login'], $verrouBase + 1);
					
					// On enregistre le message à afficher 
					$this->setMsg(array("Nom d'utilisateur ou mot de passe incorrect(s)","error","icon-exclamation-sign"));
				}
				
			} else { // Dans le cas d'un compte bloqué
				
				// On enregistre le message à afficher 
				$this->setMsg(array("Votre compte est bloqué, contacté l'administrateur","error","icon-exclamation-sign"));
			}
			
			// Enregistrement d'un log de connexion
			$this -> logConnexionManager -> insert(array('reussi' => $est_co, 'ip_adresse' => $this -> input -> ip_address(), 'user_agent' => $this -> input -> user_agent(), 'login' => $this->login, 'per_id' => $id));
			
		} else { // Dans le cas d'un login innexistant
			
			// On enregistre le message à afficher 
			$this->setMsg(array("Nom d'utilisateur ou mot de passe incorrect(s)","error","icon-exclamation-sign"));
			
			// Enregistrement d'un log de connexion
			$this -> logConnexionManager -> insert(array('reussi' => $est_co, 'ip_adresse' => $this -> input -> ip_address(), 'user_agent' => $this -> input -> user_agent(), 'login' => $this->login, 'per_id' => NULL));
			
		}

		return $est_co;
	}

	public function deconnexion() {
		if ($this -> session -> userdata('isLogged') === TRUE) {
			$this -> session -> sess_destroy();
		}
		redirect('connexion', 'index');
	}

}
?>