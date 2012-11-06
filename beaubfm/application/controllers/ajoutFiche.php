<?php
class AjoutFiche extends MY_Controller {
	private $titre_defaut;

	public function __construct() {
		parent::__construct();
		
		$this->load->library('session');
	}

	public function index() {
		$this->formulaire();
	}
	
	public function formulaire($data = array()) {
		// Helper	
		$this->load->helper('assets');
		
		if(!empty($data))
			echo $data['erreur'];
		// Vues
		$this->load->library('layout');
		
		$this->layout->views('menu_principal')
					->view('ajouter_fiche');			
	}
	
	public function envoi() {
		//	Chargement de la bibliothèque
		$this->load->library('form_validation');
		
		//Chargement models
		$this->load->model('personne_model', 'persManager');
		$this->load->model('embenevole_model', 'emBevManager');
		
		
		$existsEmBev = "!empty";
		
		$emBev = $this->input->post('emplacement');
		
		$this->form_validation->set_rules('titre', '"Titre"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_]*$"]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('artiste', '"Artiste"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_]*$"]|encode_php_tags|xss_clean');
		
		if ($emBev == "emissionBenevole"){
			//$this->form_validation->set_rules('emBev', '"Emission"', 'trim|required|min_length[5]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_]*$"]|encode_php_tags|xss_clean');
			$existsEmBev = $this->emBevManager->readEmission('emb_id', array('emb_libelle' => $this->input->post('emBev')));
		}
		else
			$this->form_validation->set_rules('emBev', '"Emission"', 'trim|min_length[0]|max_length[0]|alpha_dash|encode_php_tags|xss_clean');
		
		$this->form_validation->set_rules('listenBy', '"Ecouté par"', 'trim|min_length[5]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_]*$"]|encode_php_tags|xss_clean');
		$existslisten = $this->persManager->readPersonne('per_id', array('per_nom' => $this->input->post('listenBy'), 'cat_id' => 2));
		$this->form_validation->set_rules('diffuseur', '"Diffuseur"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_]*$"]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('email', '"Email de contact"', 'trim|required|min_length[5]|max_length[50]|valid_email|xss_clean');
		
		//$this->form_validation->set_message();
		
		
		if($this->form_validation->run() && !empty($existsEmBev) && !empty($existslisten))
		{
			//	Le formulaire est valide
			$this->load->model('disque_model', 'disqueManager');
			$this->load->model('diffuseur_model', 'diffManager');
			//$this->load->model('emplacement_model', 'empManager');
			
			$data = array();
			$data['id'] = (string)(rand(1, 50)+rand(5, 100));
			$data['titre'] = $this->input->post('titre');
			$data['artiste'] = $this->input->post('artiste');
			$data['format'] = $this->input->post('format');
			$data['empl'] = 1;
			var_dump($existsEmBev);
			if($existsEmBev != "!empty")
				$data['emBev'] = $existsEmBev['emb_id'];
			
			$data['listenBy'] = $existslisten['per_id'];
			
			$data['diffuseur'] = $this->input->post('diffuseur');
			$data['email'] = $this->input->post('email');
			$data['autoprod'] = ((!$this->input->post('autoprod')) ? "0" : "1");
			$data['envoiMail'] = (($this->input->post('envoiMail') === "0") ? "1" : "0");
			
			// Vérifiaction de l'éxistance de l'artiste
			$artId = $this->persManager->readPersonne('per_id', array('per_nom' => $data['artiste']));//"per_nom = '".$data['artiste']."'	AND (cat_id = '4' OR cat_id = '5')");//

			if (empty($artId)){
				$artId = (string)(rand(1, 50)+rand(5, 100));
				$result_1 = $this->persManager->ajouterpersonne($artId, $data['artiste'],($data['autoprod']) ? 5 : 3);
			}
			else{
				$artId = $artId['per_id'];	
				$result_1 = TRUE;
			}
			
			// Vérifiaction de l'éxistance du diffuseur
			$difId = $this->persManager->readPersonne('per_id', array('per_nom' => $data['diffuseur'], 'cat_id' => 4));
			
			if (empty($difId)){
				$difId = (string)(rand(1, 50)+rand(5, 100));	
				$result_2 = $this->persManager->ajouterpersonne($difId, $data['diffuseur'], 4);
				var_dump($data['email']);
				$this->diffManager->ajouterDiffuseur($difId, $data['email']);
			}
			else{
				$difId = $difId['per_id'];	
				$result_2 = TRUE;
			}
			
			$data['artiste'] = $artId;
			$data['diffuseur'] = $difId;
			
			if ($result_1 && $result_2) {
				//$result = $this->disqueManager->ajouterFiche($data);
				echo "Connard !!!!!!";
			}
			else {
				echo "Erreur ajout personne";
			}
			
			$this->load->view('welcome_message');
		}
		else
		{
			//	Le formulaire est invalide ou vide
			//$this->form_validation->set_message();
			//echo validation_errors();
			$this->formulaire(array("erreur" => "Le formulaire est vide ou invalide."));
		}
	}
}
?>