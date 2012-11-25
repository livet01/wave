<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class disque extends MY_Controller {
	
		public function __construct() {
		parent::__construct();
		
		
		//Chargement Librairie
		$this->load->library('form_validation');
	
		//Chargement models
		$this->load->model('personne_model', 'persManager');
		$this->load->model('embenevole_model', 'emBevManager');
		$this->load->model('disque_model', 'disqueManager');
		$this->load->helper(array('form', 'url')); 
		
		}
		
		private function verification() {
	
	
		if($this->input->post('login') != "" or $this->input->post('password') !="") {
			
			$this->form_validation->set_rules('titre', '"Titre"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');
			$this->form_validation->set_rules('artiste', '"Artiste"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');
			$this->form_validation->set_rules('email', '"Email"', 'trim|required|min_length[5]|max_length[50]|valid_email|xss_clean');
			$this->form_validation->set_rules('listenBy', '"Ecouté par"', 'trim|required|min_length[5]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');
			
			// Vérifiaction de l'existance de l'emission Bénévole si Emission Bénévole est sélectionné
			$emBev = $this->input->post('emplacement');
			if ($emBev == "emissionBenevole"){
				$this->form_validation->set_rules('emBev', '"Emission"', 'trim|required|min_length[5]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');
				$existsEmBev = $this->emBevManager->readEmission('emb_id', array('emb_libelle' => $this->input->post('emBev')));
			}
			else{ 
				$this->form_validation->set_rules('emBev', '"Emission"', 'trim|min_length[0]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');
			}
				
				
			//Création de existsEmBev pour 
			$existsEmBev = "nonvide";
			$data['autoprod'] = ((!$this->input->post('autoprod')) ? "0" : "1");
			$data['envoiMail'] = (($this->input->post('envoiMail') === "0") ? "1" : "0");		
		
		
		// Vérifiaction de l'existance de l'emission Bénévole si Emission Bénévole est sélectionné
		$existslisten = $this->persManager->readPersonne('per_id', array('per_nom' => $this->input->post('listenBy'), 'cat_id' => 2));
		
		if(!$data['autoprod'])
			$this->form_validation->set_rules('diffuseur', '"Diffuseur"', 'trim|required|min_length[1]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');	
		else
			$this->form_validation->set_rules('diffuseur', '"Diffuseur"', 'trim||min_length[0]|max_length[52]|regex_match["^[a-zA-Z0-9\\s-_\']*$"]|encode_php_tags|xss_clean');
		
		
		
		$artId = $this->persManager->readArtiste('art_id', array('art_nom' => $this->input->post('artiste')));
		//var_dump($artId);
		if(!empty($artId))	
			$disNom = $this->disqueManager->readDisque('dis_id', array('dis_libelle' => $this->input->post('titre'), 'per_id_artiste' => $artId['art_id']));
		}
	}
			
			
			

	
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
	// Getteur et Setter
	//
    public function get_dis_id()
    {
        return $this->dis_id;
    }

    public function set_dis_id($dis_id)
    {
        $this->dis_id = $dis_id;
    }

    public function get_dis_libelle()
    {
        return $this->dis_libelle;
    }

    public function set_dis_libelle($dis_libelle)
    {
        $this->dis_libelle = $dis_libelle;
    }

    public function get_dis_format()
    {
        return $this->dis_format;
    }

    public function set_dis_format($dis_format)
    {
        $this->dis_format = $dis_format;
    }

    public function get_mem_id()
    {
        return $this->mem_id;
    }

    public function set_mem_id($mem_id)
    {
        $this->mem_id = $mem_id;
    }

    public function get_dis_date_ajout()
    {
        return $this->dis_date_ajout;
    }

    public function set_dis_date_ajout($dis_date_ajout)
    {
        $this->dis_date_ajout = $dis_date_ajout;
    }

    public function get_art_id()
    {
        return $this->art_id;
    }

    public function set_art_id($art_id)
    {
        $this->art_id = $art_id;
    }

    public function get_dif_id()
    {
        return $this->dif_id;
    }

    public function set_dif_id($dif_id)
    {
        $this->dif_id = $dif_id;
    }

    public function get_dis_envoi_ok()
    {
        return $this->dis_envoi_ok;
    }

    public function set_dis_envoi_ok($dis_envoi_ok)
    {
        $this->dis_envoi_ok = $dis_envoi_ok;
    }

    public function get_dis_disponible()
    {
        return $this->dis_disponible;
    }

    public function set_dis_disponible($dis_disponible)
    {
        $this->dis_disponible = $dis_disponible;
    }

    public function get_emb_id()
    {
        return $this->emb_id;
    }

    public function set_emb_id($emb_id)
    {
        $this->emb_id = $emb_id;
    }
	
	    public function get_emp_id()
    {
        return $this->emp_id;
    }

    public function set_emp_id($emp_id)
    {
        $this->emp_id = $emp_id;
    }
	

		
		}		
		
?>

			
			
