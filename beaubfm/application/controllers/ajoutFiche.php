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
		$this->load->helper('date');
		
		//Création de existsEmBev pour 
		$existsEmBev = "nonvide";
		
		//
		// <-------- Début des contrôles des champs  ----------->
		//
		$this->form_validation->set_rules('titre', '"Titre"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_]*$"]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('artiste', '"Artiste"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_]*$"]|encode_php_tags|xss_clean');
		
		// Vérifiaction de l'existance de l'emission Bénévole si Emission Bénévole est sélectionné
		$emBev = $this->input->post('emplacement');
		if ($emBev == "emissionBenevole"){
			$this->form_validation->set_rules('emBev', '"Emission"', 'trim|required|min_length[5]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_]*$"]|encode_php_tags|xss_clean');
			$existsEmBev = $this->emBevManager->readEmission('emb_id', array('emb_libelle' => $this->input->post('emBev')));
		}
		else
			$this->form_validation->set_rules('emBev', '"Emission"', 'trim|min_length[0]|max_length[0]|alpha_dash|encode_php_tags|xss_clean');
		
		$this->form_validation->set_rules('listenBy', '"Ecouté par"', 'trim|required|min_length[5]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_]*$"]|encode_php_tags|xss_clean');
		
		// Vérifiaction de l'existance de l'emission Bénévole si Emission Bénévole est sélectionné
		$existslisten = $this->persManager->readPersonne('per_id', array('per_nom' => $this->input->post('listenBy'), 'cat_id' => 2));
		
		$this->form_validation->set_rules('diffuseur', '"Diffuseur"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_]*$"]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('email', '"Email de contact"', 'trim|required|min_length[5]|max_length[50]|valid_email|xss_clean');
		//
		// <-------- Fin des contrôles des champs  ----------->
		//
		
		if($this->form_validation->run() && !empty($existsEmBev) && !empty($existslisten))
		{
			
			//	Le formulaire est valide
			$this->load->model('disque_model', 'disqueManager');
			$this->load->model('diffuseur_model', 'diffManager');
			$this->load->model('utilisateur_model', 'utiManager');
			
			// Récupérations des valeurs des champs
			$data = $this->input->post();
			// Défintion de l'Id
			$data['id'] = (string)(rand(31, 99)+rand(800, 1000));
			
			$data['emplacement'] = 1;
			if($existsEmBev != "nonvide")
				$data['emBev'] = $existsEmBev['emb_id'];
			
			$data['listenBy'] = $existslisten['per_id'];
			$data['autoprod'] = ((!$this->input->post('autoprod')) ? "0" : "1");
			$data['envoiMail'] = (($this->input->post('envoiMail') === "0") ? "1" : "0");
			
			// Vérifiaction de l'éxistance de l'artiste
			$artId = $this->persManager->readPersonne('per_id', array('per_nom' => $data['artiste'], 'cat_id' => 5), array('per_nom' => $data['artiste'], 'cat_id' => 3));//"per_nom = '".$data['artiste']."'	AND (cat_id = '4' OR cat_id = '5')");//
			$result_1 = FALSE;
			if (empty($artId)){
				$artId = (string)(rand(31, 99)+rand(800, 1000));
				$result_1 = $this->persManager->ajouterpersonne($artId, $data['artiste'],($data['autoprod']) ? 5 : 3);
			}
			else{
				$artId = $artId['per_id'];	
				$result_1 = TRUE;
			}
			
			$result_2 = FALSE;
			// Vérifiaction de l'éxistance du diffuseur si ce n'est pas un Autoprod !
			if($data['autoprod'])
				$difId = $this->persManager->readPersonne('per_id', array('per_nom' => $data['diffuseur'], 'cat_id' => 4));
			else
				$difId = $this->persManager->readPersonne('per_id', array('per_nom' => $data['artiste'], 'cat_id' => 5));

			$result_3 = FALSE;
			$result_4 = FALSE;
			if (empty($difId)){
				$difId = (string)(rand(31, 99)+rand(800, 1000));
				if(!$data['autoprod'])
					$result_2 = $this->persManager->ajouterpersonne($difId, $data['diffuseur'], 4);
				else
					$result_2 = TRUE;
				$result_3 = $this->utiManager->ajouterUtil((($data['autoprod']) ? $artId : $difId), "",(($data['autoprod']) ? $data['artiste'] : $data['diffuseur']), "lapin");
				$result_4 = $this->diffManager->ajouterDiffuseur((($data['autoprod']) ? $artId : $difId), $data['email']);
			}
			else{
				$difId = $difId['per_id'];	
				$result_2 = TRUE;
				$result_3 = TRUE;
				$result_4 = TRUE;
			}
			
			$data['artiste'] = $artId;
			$data['diffuseur'] = (($data['autoprod']) ? $artId : $difId);
			
			echo "result_2 =  ";
			print_r($result_2);
			echo "   |||||  result_1 =  ";
			print_r($result_1);
			echo "    ||||| result_3 = ";
			print_r($result_3);
			echo "   ###### cond = ";
			print_r(($result_1 && $result_2 && $result_3));
			
			if ($result_1 && $result_2 && $result_3) {
				
				$result = $this->disqueManager->ajouterFiche($data);
				echo "Connard !!!!!!";
			}
			else {
				//echo "Erreur ajout personne";
			}
			
			$this->formulaire(array("erreur" => "¡¡¡¡¡¡¡¡¡¡ Ajout Réééééééuuuuuusssisisisisisisisisisisi !!!!!"));
		}
		else
		{
			//	Le formulaire est invalide ou vide
			$this->formulaire();
			
		}
	}
}
?>