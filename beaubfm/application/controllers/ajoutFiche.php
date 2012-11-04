<?php
class AjoutFiche extends CI_Controller {
	private $titre_defaut;

	public function __construct() {
		parent::__construct();
		
	}

	public function index() {
		$this->formulaire();
	}
	
	public function formulaire($data = array()) {
		// Helper	
		$this->load->helper('assets');
		// Vues
		if (empty($data))
			$this->load->view('header');
		else
			$this->load->view('header', $data);
		$this->load->view('ajoutFiche/actions_ajout');
		$this->load->view('ajoutFiche/formulaire');
		$this->load->view('footer');
	}
	
	public function envoi() {
		//	Chargement de la bibliothèque
		$this->load->library('form_validation');
		
		$emBev = $this->input->post('emplacement');
		
		
		$this->form_validation->set_rules('titre', '"Titre"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_]*$"]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('artiste', '"Artiste"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_]*$"]|encode_php_tags|xss_clean');
		if ($emBev == "emissionBenevole")
			$this->form_validation->set_rules('emBev', '"Emission"', 'trim|required|min_length[5]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_]*$"]|encode_php_tags|xss_clean');
		else
			$this->form_validation->set_rules('emBev', '"Emission"', 'trim|min_length[0]|max_length[0]|alpha_dash|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('listenBy', '"Ecouté par"', 'trim|min_length[0]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_]*$"]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('diffuseur', '"Diffuseur"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_]*$"]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('email', '"Email de contact"', 'trim|required|min_length[5]|max_length[50]|valid_email|xss_clean');
		
		if($this->form_validation->run())
		{
			//	Le formulaire est valide
			$this->load->model('disque_model', 'disqueManager');
			$this->load->model('personne_model', 'persManager');
			
			$data = array();
			$data['titre'] = $this->input->post('titre');
			$data['artiste'] = $this->input->post('artiste');
			$data['format'] = $this->input->post('format');
			$data['empl'] = $this->input->post('emplacement');
			$data['emBev'] = $this->input->post('emBev');
			$data['listenBy'] = $this->input->post('listenBy');
			$data['diffuseur'] = $this->input->post('diffuseur');
			$data['email'] = $this->input->post('email');
			$data['autoprod'] = $this->input->post('autoprod');
			$data['envoiMail'] = $this->input->post('envoiMail');
			
			$result = $this->persManager->ajouterpersonne($data);
			
			if ($result) {
				$reslut = $this->disqueManager->ajouterFiche($data);
				var_dump($result);
			}
			else {
				echo "Erreur ajout personne";
			}

			
			$this->load->view('welcome_message');
		}
		else
		{
			//	Le formulaire est invalide ou vide
			$this->formulaire(array("erreur" => "Le formulaire est vide ou invalide."));
		}
	}
}
?>