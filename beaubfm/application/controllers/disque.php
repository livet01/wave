<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class disque extends MY_Controller {

	//
	// Attributs
	//
	private $dis_id;
	private $dis_libelle;
	private $dis_format;
	private $mem_id;
	private $dis_date_ajout;
	private $art_id;
	private $dif_id;
	private $dis_envoi_ok;
	private $dis_disponible;
	private $emb_id;
	private $emp_id;

	//
	// Constructeur
	//
	public function __construct() {
		parent::__construct();

		//Chargement Librairie
		$this -> load -> library('form_validation');
		$this -> load -> library('securite');

		//Chargement models
		$this -> load -> model('personne_model', 'persManager');
		$this -> load -> model('parametre_model', 'parametreManager');
		$this -> load -> model('disque/disque_model', 'disqueManager');
		$this -> load -> model('disque/artiste_model', 'artisteManager');
		$this -> load -> model('disque/diffuseur_model', 'diffuseurManager');
		$this -> load -> model('disque/utilisateur_model', 'utilisateurManager');
		$this -> load -> model('disque/embenevole_model', 'embManager');
		$this -> load -> model('disque/emplacement_model', 'emplacementManager');
		$this -> load -> model('disque/style_model', 'styleManager');
		$this -> load -> model('disque_model', 'disqueManager');
		$this -> load -> helper(array('form', 'url'));

	}

	//
	// Getteur et Setter
	//
	public function get_dis_id() {
		return $this -> dis_id;
	}

	public function set_dis_id($dis_id) {
		$this -> dis_id = $dis_id;
	}

	public function get_dis_libelle() {
		return $this -> dis_libelle;
	}

	public function set_dis_libelle($dis_libelle) {
		$this -> dis_libelle = $dis_libelle;
	}

	public function get_dis_format() {
		return $this -> dis_format;
	}

	public function set_dis_format($dis_format) {
		$this -> dis_format = $dis_format;
	}

	public function get_mem_id() {
		return $this -> mem_id;
	}

	public function set_mem_id($mem_id) {
		$this -> mem_id = $mem_id;
	}

	public function get_dis_date_ajout() {
		return $this -> dis_date_ajout;
	}

	public function set_dis_date_ajout($dis_date_ajout) {
		$this -> dis_date_ajout = $dis_date_ajout;
	}

	public function get_art_id() {
		return $this -> art_id;
	}

	public function set_art_id($art_id) {
		$this -> art_id = $art_id;
	}

	public function get_dif_id() {
		return $this -> dif_id;
	}

	public function set_dif_id($dif_id) {
		$this -> dif_id = $dif_id;
	}

	public function get_dis_envoi_ok() {
		return $this -> dis_envoi_ok;
	}

	public function set_dis_envoi_ok($dis_envoi_ok) {
		$this -> dis_envoi_ok = $dis_envoi_ok;
	}

	public function get_dis_disponible() {
		return $this -> dis_disponible;
	}

	public function set_dis_disponible($dis_disponible) {
		$this -> dis_disponible = $dis_disponible;
	}

	public function get_emb_id() {
		return $this -> emb_id;
	}

	public function set_emb_id($emb_id) {
		$this -> emb_id = $emb_id;
	}

	public function get_emp_id() {
		return $this -> emp_id;
	}

	public function set_emp_id($emp_id) {
		$this -> emp_id = $emp_id;
	}

	private function verification() {
		// Vérification du titre
		$this -> form_validation -> set_rules('titre', '"Titre"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');
		// Vérification de l'artiste
		$this -> form_validation -> set_rules('artiste', '"Artiste"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');
		// Vérification de l'email
		$this -> form_validation -> set_rules('email', '"Email"', 'trim|required|min_length[5]|max_length[50]|valid_email|xss_clean');
		// Vérification du champs écouté par
		$this -> form_validation -> set_rules('listenBy', '"Ecouté par"', 'trim|required|min_length[5]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');
		// Vérifiaction de l'existance de l'emission Bénévole si Emission Bénévole est sélectionné
		if ($this -> input -> post('emissionBenevole') == "emissionBenevole") {
			$this -> form_validation -> set_rules('emBev', '"Emission"', 'trim|required|min_length[5]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');
		}
		// Vérifiaction du diffuseur si il y n'est pas auto producteur
		if ($this -> input -> post('autopro') != "a")
			$this -> form_validation -> set_rules('dif_id', '"Diffuseur"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');

		// On renvoi le résultats des vérifications
		return $this -> form_validation -> run();

	}

	private function attribution() {
		$est_auto_production = $this -> input -> post('autopro') == "a";
		
		$this->set_dis_libelle($this -> input -> post('titre'));
		$this->set_dis_art_id($this -> rechercheArtisteByNom($this -> input -> post('artiste'), 1, ($est_auto_production)?5:3));
		
		// Si le titre et l'artiste ne sont pas présent en base de données.
		if (!$this -> existeTitreArtiste($this -> dis_libelle, $this -> art_id)) {	
			
			// Vérification si autoproduction
			if ($est_auto_production) {
				$this->set_dif_id($this->rechercheDiffuseurByNom($this -> input -> post('artiste'),1, $this -> input -> post('email'), 5));
			} else {
				$this->set_dif_id($this->rechercheDiffuseurByNom($this -> input -> post('diffuseur'),1, $this -> input -> post('email'), 4));
			}

			//Vérification si emission bénévole coché
			if ($this -> input -> post('emplacement') == "emissionBenevole") {
				$this->set_emb_id($this->rechercheEmbByNom($this -> input -> post('emb'),1));
			} 

			/*if($this->input->post('envoiMail')=="0"){

			 }else{

			 }*/
			
			
			//vérification du format selectionné
			switch ($this->input->post('format')) {
				case 'cd' :
					$this->set_dis_format('CD');
					break;
				case 'numerique' :
					$this->set_dis_format('Numérique');
					break;
				case 'Vinyle' :
					$this->set_dis_format('Vinyle');
				default :
					throw new Exception("Le format n'est pas valide");
					break;
			}

			//Vérification de l'emplacement selectionné
			$this->set_emp_id(rechercherEmplacementByNom($this->input->post('emplacement')));
				
								
			$this->set_mem_id($this->input->post('listenBy'));
		
			$this->set_dis_style(rechercherStyleByCouleur($this->input->post('style')));
		}
		else { // Le titre, artiste est déja en base de données
			throw new Exception("Le disque $this->dis_libelle est déjà présent dans la base de donnée.");
		}
	}

	public function rechercheArtisteByNom($nom, $radio, $categorie) {
		$artId = $this -> artisteManager -> select('art_id', array('art_nom' => $nom));
		if (empty($artId)) {
			$artId = (int)$this -> artisteManager -> insert($nom, $radio, $categorie);
		} else
			$artId = $artId["art_id"];
		return $artId;
	}

	public function rechercheDiffuseurByNom($nom, $radio, $email, $categorie) {
		$difId = $this -> diffuseurManager -> select('Diffuseur.per_id', array('Personne.per_nom' => $nom, ));
		if (empty($difId)) {
			$utiId = (int)$this -> utilisateurManager -> insert($this -> rechercheArtisteByNom($nom, $radio, $categorie), $nom, $this -> securite -> crypt($nom));
			$difId = (int)$this -> diffuseurManager -> insert($utiId, $email);
		} else
			$difId = $difId["per_id"];
		return $difId;
	}

	public function rechercheEmbByNom($nom, $radio) {
		$id = $this -> embManager -> select('emb_id', array('emb_libelle' => $nom));
		if (empty($id)) {
			$id = (int)$this -> embManager -> insert($nom, $radio);
		} else
			$id = $id["emb_id"];
		return $id;
	}
	public function rechercheEmplacementByNom($nom){
		$empId = $this -> emplacementManager -> select('emp_id', array('emp_libelle' => $nom));
		if(empty($empId)){
			throw new Exception("L'emplacement n'existe pas.");
		}
		else {
			$empId = $empId["emp_id"];
		}
		return $empId;
		
	}
	
	public function rechercherStyleByNom($nom){
		$styleId = $this -> styleManager -> select('sty_id', array('sty_couleur' => $nom));
		if(empty($styleId)){

			throw new Exception("Le style n'existe pas.");
		}
		else {
			
			$styleId = $styleId["sty_id"];
		}
		return $styleId;
		
		
	}
	
	public function existeTitreArtiste($titre, $id_artiste) {
		$return = $this -> disqueManager -> select('dis_id', array('per_id_artiste' => $id_artiste, 'dis_libelle' => $titre));
		return !empty($return);
	}
	public function verificationFormat($nom) {
		$result = $this -> parametreManager -> select('format');
		$format = explode(";", $result['param_valeur']);
		$return = false;
		foreach ($format as $format2) {
			if (strtoupper($format2) == strtoupper($nom)) {
				$return = true;
			}
		}
		return $return;
	}
}
?>

