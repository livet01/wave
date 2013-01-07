<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Disque extends Base_Controller {

	//
	// Attributs
	//
	private $dis_id;
	private $dis_libelle;
	private $dis_format;
	private $sty_id;
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
		$this -> load -> library('layout');
		$this -> load -> library('layout');

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
		$this -> load -> model('disque/ecoute_model', 'ecouteManager');
		$this -> load -> model('index/Info_Disque_Model', 'infodisque');
		$this -> load -> model('disque_model', 'disqueManager');
		$this -> load -> helper(array('form', 'url'));
		//$this->output->enable_profiler(TRUE);

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

	public function get_sty_id() {
		return $this -> sty_id;
	}

	public function set_sty_id($dis_style) {
		$this -> sty_id = $dis_style;
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

	//
	// Index
	//
	public function index() {
		redirect(site_url("disque/ajouter"));
	}

	//
	// Modifier un disque
	//
	public function modifier($id) {
		// Initialisation des données a envoyer en bd
		$data = array('erreur' => "", 'reussi' => "");
		
		// Chargement des formats
		$formats = $this -> parametreManager -> select('format');
		$formats = explode(";", $formats['param_valeur']);
		$data['formats'] = $formats;
		
		// Chargement des emplacements
		$emp_libelles = $this -> emplacementManager -> select_all(array('emp_libelle','emp_plus'));
		$data['emplacements'] = array();
		foreach($emp_libelles as $emp_libelle) {
			array_push($data['emplacements'],array("emp_libelle" =>$emp_libelle->emp_libelle,"emp_plus"=>$emp_libelle->emp_plus));
		}
		
		// Chargement des styles
		$styles = $this -> styleManager -> select_all(array('sty_couleur','sty_libelle'));
		$data['styles'] = array();
		foreach($styles as $style) {
			array_push($data['styles'],array("couleur" => $style->sty_couleur, "libelle" => $style->sty_libelle));
		}
		
		$disque = $this -> disqueManager -> select(array('dis_id','dis_libelle','dis_format','per_id_artiste', 'uti_id_ecoute','dis_libelle','dis_format','sty_id'), array('dis_id' => $id));
		var_dump($disque);
		if(!empty($disque)) {
			$this->set_dif_id($disque["dif_id"]);
			$this->set_art_id(($disque["per_id_artiste"]));
			$this->set_dis_format(($disque["format"]));
			$this->set_dis_id(($disque["dis_id"]));
			$this->set_dis_libelle(($disque["dis_libelle"]));
			if(isset($disque["emb_id"])) { $this->set_emb_id(($disque["emb_id"])); }
			$this->set_sty_id(($disque["sty_id"]));
			$this->set_mem_id(($disque["uti_id_ecoute"]));
			$this->set_emp_id(($disque["emp_id"]));
			$data['infoDisque'] = $disque;
		}
		if ($this -> formulaire_null()) {
			// Affichage du formulaire 
			var_dump($data);
			$this -> layout -> views('menu_principal') -> view('disque/ajouter_fiche',$data);
		} else {
			// Formulaire envoyé
			$data['erreur'] = $this->ajouter_disque();
			if(empty($data['erreur'])) {
				$data['reussi'] = "Le disque a bien été modifié.";
			}
		}
	}

	//
	// Ajouter un disque
	//
	public function ajouter() {
		// Initialisation des données a envoyer en bd
		$data = array('erreur' => "", 'reussi' => "");
		
		// Chargement des formats
		$formats = $this -> parametreManager -> select('format');
		$formats = explode(";", $formats['param_valeur']);
		$data['formats'] = $formats;
		
		// Chargement des emplacements
		$emp_libelles = $this -> emplacementManager -> select_all(array('emp_libelle','emp_plus'));
		$data['emplacements'] = array();
		foreach($emp_libelles as $emp_libelle) {
			array_push($data['emplacements'],array("emp_libelle" =>$emp_libelle->emp_libelle,"emp_plus"=>$emp_libelle->emp_plus));
		}
		
		// Chargement des styles
		$styles = $this -> styleManager -> select_all(array('sty_couleur','sty_libelle'));
		$data['styles'] = array();
		foreach($styles as $style) {
			array_push($data['styles'],array("couleur" => $style->sty_couleur, "libelle" => $style->sty_libelle));
		}
		
		if ($this -> formulaire_null()) {
			// Affichage du formulaire 
			
			$this -> layout -> views('menu_principal') -> view('disque/ajouter_fiche',$data);
		} else {
			// Formulaire envoyé
			$data['erreur'] = $this->ajouter_disque();
			if(empty($data['erreur'])) {
				$data['reussi'] = "Le disque a bien été ajouté.";
			}
			$this -> layout -> views('menu_principal') -> view('disque/ajouter_fiche', $data);
		}
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

		$emplacement = $this->rechercheEmplacementByNom($this -> input -> post('emplacement'));
		$plus = $this -> parametreManager -> select('emb');
		
		// Vérifiaction de l'existance de l'emission Bénévole si Emission Bénévole est sélectionné
		if ($emplacement == $plus['param_valeur']) {
			$this -> form_validation -> set_rules('emb', '"Emission"', 'trim|required|min_length[5]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');
			$this -> form_validation -> set_rules('autoprod', 'Autoproduction', 'trim|required|min_length[5]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');
			$this -> form_validation -> set_rules('label', 'Label', 'trim|required|min_length[5]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');
			$this -> formulaire($data);
			
		}
		// Vérifiaction du diffuseur si il y n'est pas auto producteur
		if ($this -> input -> post('autoprod') != "a")
			$this -> form_validation -> set_rules('diffuseur', '"Diffuseur"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');
		
		// On renvoi le résultats des vérifications
		return $this -> form_validation -> run();

	}

	private function attribution() {
		$this->db->trans_begin();
		try {
			$est_auto_production = $this -> input -> post('autoprod') == "a";
	
			$this -> set_dis_libelle($this -> input -> post('titre'));
			$this -> set_art_id($this -> rechercheArtisteByNom($this -> input -> post('artiste'), $this -> user['rad_id'], ($est_auto_production) ? 5 : 3));
			
			
			// Si le titre et l'artiste ne sont pas présent en base de données.
			if (!$this -> existeTitreArtiste($this -> dis_libelle, $this -> art_id)) {
	
				// Vérification si autoproduction
				if ($est_auto_production) {
					$this -> set_dif_id($this -> rechercheDiffuseurByNom($this -> input -> post('artiste'), $this -> user['rad_id'], $this -> input -> post('email'), 5));
				} else {
					$this -> set_dif_id($this -> rechercheDiffuseurByNom($this -> input -> post('diffuseur'), $this -> user['rad_id'], $this -> input -> post('email'), 4));
				}
	
				//Vérification de l'emplacement selectionné
				$this -> set_emp_id($this->rechercheEmplacementByNom($this -> input -> post('emplacement')));
				$plus =$this -> parametreManager -> select('emb');
				//Vérification si emission bénévole coché
				if ($this->get_emp_id() == $plus['param_valeur']) {
					$this -> set_emb_id($this -> rechercheEmbByNom($this -> input -> post('emb'), $this -> user['rad_id']));
				}
	
				if($this->input->post('envoiMail')=="1"){
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['newline']    = "\r\n";
	
	
					$this->email->initialize($config);
					$email = $this -> input -> post('email');
					$titre= $this->get_dis_libelle();
					$artiste=$this->get_art_id();
				
					$emp=$this->input->post('emplacement');
					
					$this->email->from('beaubfm@mail.com', 'BeaubFM');
					//$this->email->to($data['email']);
					$this->email->to('samir.bouaked@gmail.com');
			
					//preparation du mail
					$this->email->subject('Email automatique BeaubFM');
			
					$this->email->message($msg);
	
					$this->email->send();
					$this->envoyerMail();		
				 }else{
	
				 }
	
				// Vérification du format selectionné
				if ($this -> verificationFormat($this -> input -> post('format'))) {
					$this -> set_dis_format($this -> input -> post('format'));
				} else {
					throw new Exception("Le format n'est pas valide");
				}
	
				$this -> set_mem_id($this->rechercherEcouteParByNom($this -> input -> post('listenBy')));
	
				$this -> set_sty_id($this->rechercherStyleByNom($this -> input -> post('style')));
			} else {// Le titre, artiste est déja en base de données
				throw new Exception("Le disque $this->dis_libelle est déjà présent dans la base de donnée.");
			}
		    $this->db->trans_commit();
		}
		catch(Exception $e) {
			$this->db->trans_rollback();
		}

		    

	}

	private function ajouter_disque() {
		$erreur = "";
		if (!$this -> formulaire_null()) {
			if ($this -> verification()) {
				try {
					$this -> attribution();
					$this -> addBDD();
				} catch (Exception $e) {
					$erreur = $e -> getMessage();
				}
			} else {
				$erreur = validation_errors('&nbsp;', '&nbsp;');
			}
		} else {
			$erreur = "Le formulaire envoyé est nul.";
		}
		return $erreur;
	}

	public function addBDD() {

		$data['dis_libelle'] = $this -> get_dis_libelle();
		$data['dis_format'] = $this -> get_dis_format();
		$data['uti_id_ecoute'] = $this -> get_mem_id();
		$data['per_id_artiste'] = $this -> get_art_id();
		$data['dif_id'] = $this -> get_dif_id();
		$data['dis_envoi_ok'] = 1;
		$data['emp_id'] = $this -> get_emp_id();
		$data['emb_id'] = $this -> get_emb_id();
		$data['sty_id'] = $this -> get_sty_id();

		if (!$this -> disqueManager -> insert($data)) {
			throw new Exception("Erreur dans l'ajout");
		}
	}

	public function rechercheArtisteByNom($nom, $radio, $categorie, $insertion = TRUE) {
		$artId = $this -> artisteManager -> select('art_id', array('art_nom' => $nom));
		if (empty($artId)) {
			if($insertion)
				$artId = (int)$this -> artisteManager -> insert($nom, $radio, $categorie);
			else {
				$artId = -1;
			}
		} else
			$artId = $artId["art_id"];
		return $artId;
	}

	public function rechercheDiffuseurByNom($nom, $radio, $email, $categorie) {
		$difId = $this -> diffuseurManager -> select('Diffuseur.per_id', array('Personne.per_nom' => $nom, ));
		if (empty($difId)) {
			$this->db->trans_begin();
			try {
				$utiId = (int)$this -> utilisateurManager -> insert($this -> rechercheArtisteByNom($nom, $radio, $categorie), $nom, $this -> securite -> crypt($nom));
				$difId = (int)$this -> diffuseurManager -> insert($utiId, $email);
			    $this->db->trans_commit();
			}
			catch(Exception $e) {
				$this->db->trans_rollback();
			}
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
	
	public function rechercheEmBevByNom($nom) {
		$embId = $this -> embManager -> select('emb_id', array('emb_libelle' => $nom));
		if (empty($embId)) {
			throw new Exception("L'émission bénévole n'existe pas.");
		} else {
			$embId = $embId["emb_id"];
		}
		return $embId;

	}

	public function rechercheEmplacementByNom($nom) {
		$empId = $this -> emplacementManager -> select('emp_id', array('emp_libelle' => $nom));
		if (empty($empId)) {
			throw new Exception("L'emplacement n'existe pas.");
		} else {
			$empId = $empId["emp_id"];
		}
		return $empId;

	}

	public function rechercherStyleByNom($nom) {
		$styleId = $this -> styleManager -> select('sty_id', array('sty_couleur' => $nom));
		if (empty($styleId)) {

			throw new Exception("Le style n'existe pas.");
		} else {

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

	public function rechercherEcouteParByNom($nom) {

		$ecouteId = $this -> ecouteManager -> select('per_id', array('per_nom' => $nom));
		if (empty($ecouteId)) {

			throw new Exception("L'utilisateur n'existe pas.");
		} else {
			$ecouteId = $ecouteId['per_id'];
		}
		return $ecouteId;

	}

	public function formulaire_null() {
		$titre = $this -> input -> post('titre');
		$artiste = $this -> input -> post('artiste');
		$format = $this -> input -> post('format');
		$style = $this -> input -> post('style');
		$emplacement = $this -> input -> post('emplacement');
		$ecoute = $this -> input -> post('listenBy');
		$diffuseur = $this -> input -> post('diffuseur');
		$email = $this -> input -> post('email');

		if (empty($titre) && empty($artiste) && empty($format) && empty($style) && empty($emplacement) && empty($ecoute) && empty($diffuseur) && empty($email)) {

			return true;
		} else {
			return false;
		}
	}

	
	public function suppArtiste($nom=''){
		
		$artiste = $this -> disqueManager -> nombreArtiste('per_id_artiste', array('dis_id' => $nom));
		if($artiste =='0' || '1'){
			
			$sup = $this -> disqueManager -> suppArtiste($artiste);
			var_dump($sup);
		}
		else {
				echo "coucou";
			
			
		}
		
	}
	
	//
	// Méthode de suggestion : ajax et auto-completion.
	//
	public function suggestions_artiste() {
		$this -> load -> model('index/autocomplete_model');
		$term = $this -> input -> post('term', TRUE);

		$json_array = array();
		$rows = $this -> autocomplete_model -> GetAutocompleteArtiste(array('keyword' => $term));
		$i = 0;
		foreach ($rows as $row) {
			if ($i < 6) {
				array_push($json_array, array("label" => $row -> art_nom));
			}
			$i++;
		}

		echo json_encode($json_array);
	}

	//
	// Méthode de suggestion : ajax et auto-completion.
	//
	public function suggestions_diffuseur() {
		$this -> load -> model('index/autocomplete_model');
		$term = $this -> input -> post('term', TRUE);

		$json_array = array();
		$rows = $this -> autocomplete_model -> GetAutocompleteLabel(array('keyword' => $term));
		$i = 0;
		foreach ($rows as $row) {
			if ($i < 6) {
				array_push($json_array, array("label" => $row -> lab_nom));
			}
			$i++;
		}

		echo json_encode($json_array);
	}	
	
	//
	// Méthode de suggestion : ajax et auto-completion.
	//
	public function suggestions_ecoute() {
		$this -> load -> model('index/autocomplete_model');
		$term = $this -> input -> post('term', TRUE);

		$json_array = array();
		$rows = $this -> autocomplete_model -> GetAutocompleteMembre(array('keyword' => $term));
		$i = 0;
		foreach ($rows as $row) {
			if ($i < 6) {
				array_push($json_array, array("label" => $row -> mem_nom));
			}
			$i++;
		}

		echo json_encode($json_array);
	}
	
	//
	// Méthode de suggestion : ajax et auto-completion.
	//
	public function suggestions_email() {
		$this -> load -> model('index/autocomplete_model');
		$term = $this -> input -> post('term', TRUE);

		$json_array = array();
		$rows = $this -> autocomplete_model -> GetAutocompleteLabel(array('keyword' => $term));
		if(!empty($rows))
			echo json_encode($rows[0]->lab_mail);
	}	
	
	
	function supprimer($g_nb_disques = 1, $affichage = 0) {
			
		// Chargement des ressources

		if ($affichage === 0)// Si l'affichage est pour l'ensemble des disques
		{
			// Tableau récoltant des données à envoyer à la vue
			$data = array();

			// Récupération de tout les disques pour la page
			$id = $this->input->post('choix');
			
			$tabs = $this -> infodisque -> GetAll_in($id);

			// On parcours le tableau, si emb_id n'existe pas on le met à nul et on ajoute chaque disque dans le tableau tab_result.
			foreach ($tabs as $tab) {
				if (empty($tab -> emb_id))
					$emb_id = null;
				else {
					$emb_id = $tab -> emb_id;
				}
				$tab_result[] = array("dis_id" => $tab -> dis_id, "dis_libelle" => $tab -> dis_libelle, "dis_format" => $tab -> dis_format, "mem_nom" => $tab -> mem_nom, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom, "emp_libelle" => $tab -> emp_libelle, "emb_id" => $emb_id);
			}

			// On passe le tableau de disque
			$data['resultat'] = $tab_result;
		}

		// On passe la valeur d'affichage (sélectionne dans la vue les mode à afficher : erreur, résultat recherche, vue général)
		$data['affichage'] = $affichage;

		// Chargement de la vue
		$this -> layout -> views('menu_principal')->view('disque/supprimer', $data);
		
	}
	
	public function supprimerAll() {
		$choix = $this->input->post('choix');
		if(!empty($choix)) {
			foreach($choix as $id) {
				// Transtipage en integer
				$id_disque = intval($id);
		
				// On récupère les infos du disque
				$tabs = $this -> infodisque -> GetOneDisque($id_disque);
							
				if(!empty($tabs)) {					
					$sup = $this -> disqueManager -> delete($id_disque);
					
					$tabs = $tabs[0];
					
					if($this->artisteManager->compte(array('per_id_artiste'=>$tabs['per_id_artiste'])) == 0) {
						$this->artisteManager->delete($tabs['per_id_artiste']);
					}
					
					if($this->diffuseurManager->compte(array('dif_id'=>$tabs['dif_id'])) == 0) {
						$this->diffuseurManager->delete($tabs['dif_id']);
					}
				}
			}
		}
		redirect(site_url('index'));
	}
}
?>

