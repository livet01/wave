<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Index extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// Chargement des ressources pour tout le contrôleur
		$this -> load -> database();
		$this -> load -> library('form_validation');
		// $this -> load -> helper(array('url', 'assets')); déjà chargé grace au fichier de config
		//$this -> load -> model('recherche_model', 'rechercheManager'); à réfléchir
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function index($affichage=0) {
		if ($this -> session -> userdata('isLogged') === TRUE) {			$this -> load -> library('layout');
			$this -> layout -> views('menu_principal') -> views('barre_recherche') -> view('resultat_recherche',array('affichage'=>$affichage)) ;
		}
		else {
			redirect('connexion','connexion');
		}
	}

	public function recherche() {
		$this -> form_validation -> set_rules('recherche', 'recherche', 'trim|required|xss_clean');
		//$this->output->enable_profiler(TRUE);
		if ($this -> form_validation -> run() == FALSE) {
			$this->index(-1);
		} else {
			$this->load->model('autocomplete_model');
			$this->load->model('Info_Disque_Model');
			$rows = $this -> autocomplete_model->GetAutocomplete(array('keyword' => $this -> input -> post('recherche')));
			if (empty($rows))
				$this->index(2);
			else
				{
					$term = $this->input->post('recherche',TRUE);
				
					if (strlen($term) < 2) break;
					
					$tab_result = array();
					foreach ($rows as $row) {
						$tabs = $this->Info_Disque_Model->GetArtiste($row->art_id);
						
						foreach ($tabs as $tab){
							if(empty($tab->emb_id))
								$emb_id = null;
							else {
								$emb_id = $tab->emb_id;
							}
							$tab_result[] = array(			"dis_libelle"		=>$tab->dis_libelle,
															"dis_format"	=>$tab->dis_format,
															"mem_nom"	=>$tab->mem_nom,
															"art_nom"=>$tab->art_nom,
															"per_nom"		=>$tab->per_nom,
															"emp_libelle"		=>$tab->emp_libelle,
															"emb_id"		=>$emb_id);}
					}
					$this -> load -> library('layout');
					$this -> layout -> views('menu_principal') -> views('barre_recherche') -> view('resultat_recherche',array('affichage'=>'1','resultat'=>$tab_result)) ;
				}
		}
	}
	
	public function suggestions()
	{
		$this->load->model('autocomplete_model');
		$term = $this->input->post('term',TRUE);
	
		if (strlen($term) < 2) break;
	
		$rows = $this->autocomplete_model->GetAutocomplete(array('keyword' => $term));
	
		$json_array = array();
		foreach ($rows as $row)
			 array_push($json_array, $row->art_nom);

		echo json_encode($json_array);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
