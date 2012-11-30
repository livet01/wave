<?php
class AjoutFiche extends MY_Controller {
	private $titre_defaut;

	public function __construct() {
		parent::__construct();
		$this->output->enable_profiler(TRUE);
		
		$this->load->library('session');
	}

	public function index() {
		$this->formulaire();
	}
	
	public function formulaire($data = array('erreur' => "", 'reussi' => "")) {
		
		// Helper	
		$this->load->helper('assets');
		
		/*if(!empty($data))
			echo $data['erreur'];*/
		// Vues 
		$this->load->library('layout');
		
		$this->layout->views('menu_principal')
					->view('ajouter_fiche', $data);
								
	}
	
	public function envoi() {
		
		//	Chargement de la bibliothèque
		$this->load->library('form_validation');
		
		//Chargement models
		$this->load->model('personne_model', 'persManager');
		$this->load->model('embenevole_model', 'emBevManager');
		$this->load->model('disque_model', 'disqueManager');
		$this->load->helper('date');
		
		//Création de existsEmBev pour 
		$existsEmBev = "nonvide";
		$data['autoprod'] = ((!$this->input->post('autoprod')) ? "0" : "1");
		$data['envoiMail'] = (($this->input->post('envoiMail') === "0") ? "1" : "0");
		//
		// <-------- Début des contrôles des champs  ----------->
		//
		$this->form_validation->set_rules('titre', '"Titre"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('artiste', '"Artiste"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');
		
		// Vérifiaction de l'existance de l'emission Bénévole si Emission Bénévole est sélectionné
		$emBev = $this->input->post('emplacement');
		if ($emBev == "emissionBenevole"){
			$this->form_validation->set_rules('emBev', '"Emission"', 'trim|required|min_length[5]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');
			$existsEmBev = $this->emBevManager->readEmission('emb_id', array('emb_libelle' => $this->input->post('emBev')));
		}
		else
			$this->form_validation->set_rules('emBev', '"Emission"', 'trim|min_length[0]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');
		
		$this->form_validation->set_rules('listenBy', '"Ecouté par"', 'trim|required|min_length[5]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');
		
		// Vérifiaction de l'existance de l'emission Bénévole si Emission Bénévole est sélectionné
		$existslisten = $this->persManager->readPersonne('per_id', array('per_nom' => $this->input->post('listenBy'), 'cat_id' => 2));
		
		if(!$data['autoprod'])
			$this->form_validation->set_rules('diffuseur', '"Diffuseur"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');	
		else
			$this->form_validation->set_rules('diffuseur', '"Diffuseur"', 'trim||min_length[0]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('email', '"Email"', 'trim|required|min_length[5]|max_length[50]|valid_email|xss_clean');
		
		$artId = $this->persManager->readArtiste('art_id', array('art_nom' => $this->input->post('artiste')));
		//var_dump($artId);
		if(!empty($artId))	
			$disNom = $this->disqueManager->readDisque('dis_id', array('dis_libelle' => $this->input->post('titre'), 'per_id_artiste' => $artId['art_id']));
		
		//
		// <-------- Fin des contrôles des champs  ----------->
		//
		
		if($this->form_validation->run() && !empty($existsEmBev) && !empty($existslisten) && empty($disNom))
		{
			
			//	Le formulaire est valide
			
			$this->load->model('diffuseur_model', 'diffManager');
			$this->load->model('utilisateur_model', 'utiManager');
			
			// Récupérations des valeurs des champs
			$data = $this->input->post();
			// Défintion de l'Id
			$data['id'] = (string)(rand(31, 99)+rand(800, 1000));
			$data['autoprod'] = ((!$this->input->post('autoprod')) ? "0" : "1");
			$data['envoiMail'] = (($this->input->post('envoiMail') === "0") ? "1" : "0");
		
			$data['emplacement'] = 1;
			if($existsEmBev != "nonvide")
				$data['emBev'] = $existsEmBev['emb_id'];
			
			$data['listenBy'] = $existslisten['per_id'];
			
			
			// Vérifiaction de l'éxistance de l'artiste
			
			$result_1 = FALSE;
			if (empty($artId)){
				$artId = $difId = $this->persManager->last_id();
				$result_1 = $this->persManager->ajouterpersonne($artId, $data['artiste'],($data['autoprod']) ? 5 : 3);
			}
			else{
				$artId = $artId['art_id'];	
				$result_1 = TRUE;
			}
			
			$result_2 = FALSE;
			// Vérifiaction de l'éxistance du diffuseur si ce n'est pas un Autoprod !
			if(!$data['autoprod'])
				$difId = $this->diffManager->readDiffuseur('lab_id', array('lab_nom' => $data['diffuseur']));
			else
				$difId = $this->persManager->readAutoprod('aut_id', array('aut_nom' => $data['artiste']));

			$result_3 = FALSE;
			$result_4 = FALSE;
			
			
			
			if (empty($difId)){
				//var_dump($difId);	
				$difId = $this->persManager->last_id();
				//var_dump($difId);
				if(!$data['autoprod']){
					// Ajout du diffuseur
					$result_2 = $this->persManager->ajouterpersonne($difId, $data['diffuseur'], 4);
				}
				else
					$result_2 = TRUE;
				
				// Ajout du Diffuseur ou de l'Artiste s'il est autoproducteur en tant qu'Utilisateur
				//var_dump($artId);
				$result_3 = $this->utiManager->ajouterUtil((($data['autoprod']) ? $artId : $difId), "",(($data['autoprod']) ? $data['artiste'] : $data['diffuseur']), "lapin");
				$result_4 = $this->diffManager->ajouterDiffuseur((($data['autoprod']) ? $artId : $difId), $data['email']);
			}
			else{
				// Récupération de l'id du Diffuseur ou de l'id de l'Artiste si il est autoproducteur
				$difId = ($data['autoprod']) ? $difId['aut_id'] : $difId['lab_id'];
				$result_2 = TRUE;
				$result_3 = TRUE;
				$result_4 = TRUE;
			}
			
			$data['artiste'] = $artId;
			$data['diffuseur'] = (($data['autoprod']) ? $artId : $difId);

			if ($result_1 && $result_2 && $result_3) {
				//envoi email ?
				

				
				$result = $this -> disqueManager -> ajouterDisque($data);
				$this -> formulaire(array("reussi" => "Ajout réussi", "erreur" => ""));
				
			} else {
				$this -> formulaire(array("erreur" => "Echec de l'ajout", "reussi" => ""));
			}
		} else {
			//	Le formulaire est invalide ou vide
			if (!empty($disNom))
				$this -> formulaire(array("erreur" => "Echec de l'ajout", "reussi" => ""));
			else
				$this -> formulaire();

		}
	}

	////////////////////////////////>>///////////////
	///////////////////////////////////////////////
	//METHODES DE MISE EN PLACE DE L'AUTOCOMPLETION
	///////////////////////////////////////////////
	////////////////////////////////>>///////////////

	//
	// Méthode de suggestion : ajax et auto-completion.
	//
	public function suggestions() {
		$this -> load -> model('index/autocomplete_model');

		//R�cup�ration des valeurs entr�s dans les champs artiste + diffuseur
		$termArtiste = $this -> input -> post('termArtiste', TRUE);
		$termDiffuseur = $this -> input -> post('termDiffuseur', TRUE);
		
		//On regarde quel champ est en cours de saisie(artiste ou diffuseur?)
		$term = NULL;
		$champArtiste = TRUE;
		if ($termArtiste == NULL && $termDiffuseur != NULL) {
			$term = $termDiffuseur;
			$champArtiste = FALSE;
		}
		else if ($termArtiste != NULL && $termDiffuseur == NULL){
			$term = $termArtiste;
		}
		
		if (strlen($term) < 1)
			break;
		
		// Initialisation du tableau de d�clarations des suggestions
		$json_array = array();
		$rowsArray;
		$j = 0;

		//Cas autocompl�tion Champ Artiste
		if ($champArtiste) {
			$rowsArtiste = $this -> autocomplete_model -> GetAutocompleteArtiste(array('keyword' => $term));
			
			$rowsArray = array($rowsArtiste);
			
			
			foreach ($rowsArtiste as $row) {
				if ($j < 4) {
					array_push($json_array, $row->art_nom);
				}
				$j++;
			}
		}
		//Cas autocompl�tion Champ Label
		else {
			$rowsDiffuseur = $this -> autocomplete_model -> GetAutocompleteLabel(array('keyword' => $term));
			
			$rowsArray = array($rowsDiffuseur);
			
			
			foreach ($rowsDiffuseur as $row) {
				if ($j < 4) {
					array_push($json_array, $row->lab_nom);
				}
				$j++;
			}
		}
		echo json_encode($json_array);
	}

	////////////////////////////////<<///////////////
	///////////////////////////////////////////////
	//METHODES DE MISE EN PLACE DE L'AUTOCOMPLETION
	///////////////////////////////////////////////
	////////////////////////////////<<///////////////

}
?>