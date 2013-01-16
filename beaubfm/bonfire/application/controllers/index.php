<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Index extends Base_Controller {
	//
	// Constante d'affichage : réglage du nombre de disque par parge à afficher dans le tableau
	//
	const NB_DISQUE_PAR_PAGE = 15;

	//
	// Constructeur
	//
	public function __construct() {
		parent::__construct();
		// Chargement des ressources pour tout le contrôleur
		$this -> load -> database();
		$this -> load -> library('form_validation');
		$this -> load -> model('index/Info_Disque_Model');
		if($this->auth->is_logged_in())
			$this -> Info_Disque_Model -> id = $this->current_user->id;
	}
	
	//
	// Méthode index : affichage de l'ensemble des disques
	//
	public function index() {

		// Chargement de la vue
		Template::set_view('index/index');
		Assets::add_js("cocheTout");
		Template::set('value',$this -> input -> post('recherche'));
		Template::render();
		
	}

	public function index_ajax() {
		
		$this->output->enable_profiler(FALSE);
		
		// Tableau récoltant des données à envoyer à la vue
		$data = array();
	
		if (has_permission('Wave.Modifier.Disque'))
		{
			// Récupération de tout les disques pour la page
			$tabs = $this -> Info_Disque_Model -> GetAllAttente();

			// On parcours le tableau, si emb_id n'existe pas on le met à nul et on ajoute chaque disque dans le tableau tab_result.
			foreach ($tabs as $tab) {
				if (empty($tab -> emb_id))
					$emb_id = null;
				else {
					$emb_id = $tab -> emb_id;
				}
				$tab_result[] = array("dis_id" => $tab -> dis_id,"sty_couleur" => $tab -> sty_couleur, "dis_libelle" => $tab -> dis_libelle, "dis_format" => $tab -> dis_format, "mem_nom" => $tab -> mem_nom, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom, "emp_libelle" => $tab -> emp_libelle, "emb_id" => $emb_id);
			}
			// Récupération de tout les disques pour la page
			$tabs = $this -> Info_Disque_Model -> GetAllNoAttente();

			// On parcours le tableau, si emb_id n'existe pas on le met à nul et on ajoute chaque disque dans le tableau tab_result.
			foreach ($tabs as $tab) {
				if (empty($tab -> emb_id))
					$emb_id = null;
				else {
					$emb_id = $tab -> emb_id;
				}
				$tab_result[] = array("dis_id" => $tab -> dis_id,"sty_couleur" => $tab -> sty_couleur, "dis_libelle" => $tab -> dis_libelle, "dis_format" => $tab -> dis_format, "mem_nom" => $tab -> mem_nom, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom, "emp_libelle" => $tab -> emp_libelle, "emb_id" => $emb_id);
			}
		}
		else{
			// Récupération de tout les disques pour la page
			$tabs = $this -> Info_Disque_Model -> GetAll();

			// On parcours le tableau, si emb_id n'existe pas on le met à nul et on ajoute chaque disque dans le tableau tab_result.
			foreach ($tabs as $tab) {
				if (empty($tab -> emb_id))
					$emb_id = null;
				else {
					$emb_id = $tab -> emb_id;
				}
				$tab_result[] = array("dis_id" => $tab -> dis_id,"sty_couleur" => $tab -> sty_couleur, "dis_libelle" => $tab -> dis_libelle, "dis_format" => $tab -> dis_format, "mem_nom" => $tab -> mem_nom, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom, "emp_libelle" => $tab -> emp_libelle, "emb_id" => $emb_id);
			}
		}
		if(!empty($tab_result)){
			// On passe le tableau de disque
			$data['resultat'] = $tab_result;		
		}
		else
			$data['resultat'] = array();
		
		$this->load->view('index/tableau',$data);
		
	}

	public function rss() {
		$this->output->enable_profiler(FALSE);
		
        $this->load->helper('xml');
		// Récupération de tout les disques pour la page
		$tabs = $this -> Info_Disque_Model -> GetAllRss();

		// On parcours le tableau, si emb_id n'existe pas on le met à nul et on ajoute chaque disque dans le tableau tab_result.
		foreach ($tabs as $tab) {
			if (empty($tab -> emb_id))
				$emb_id = null;
			else {
				$emb_id = $tab -> emb_id;
			}
			$tab_result[] = array( "dis_libelle" => $tab -> dis_libelle, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom);
		}
		if(!empty($tab_result)){
			// On passe le tableau de disque
			$data['resultat'] = $tab_result;		
		}
		else
			$data['resultat'] = array();


        header("Content-Type: application/rss+xml");
        $this->load->view('index/rss', $data);
	}
	//
	// Méthode recherche : affichage des résultats de la recherche
	//
	public function recherche() {
		
		// On vérifie si la variable post contient des erreurs
		$this -> form_validation -> set_rules('recherche', 'recherche', 'trim|required|xss_clean');

		if ($this -> form_validation -> run() == FALSE)// Des erreurs on été détecté !
		{
			Template::set_message("Que voulez vous recherchez ? Réessayez en indiquant votre recherche dans le barre de recherche.","error");
			Template::redirect('index');
			// On revoie sur la méthode index avec un affichage de -1.
		} else// Aucune erreur
		{
			// Chargement des models
			$this -> load -> model('index/autocomplete_model');
			$this -> load -> model('index/Info_Disque_Model');

			// On récupère pour le mot clé saisie, l'id de tout les artistes correspondant
			$rows = $this -> autocomplete_model -> GetAutocompleteArtiste(array('keyword' => $this -> input -> post('recherche')));

			// On récupère pour le mot clé saisie, l'id de tout les labels correspondant
			$rowsLabel = $this -> autocomplete_model -> GetAutocompleteLabel(array('keyword' => $this -> input -> post('recherche')));

			// On récupère pour le mot clé saisie, l'id de tout les disques correspondant
			$rowsDisque = $this -> autocomplete_model -> GetAutocompleteArrayDisque(array('keyword' => $this -> input -> post('recherche')));

			if (empty($rows) and empty($rowsLabel) and empty($rowsDisque)){// Aucun disque, artiste, label a été trouvé
				Template::set_message("La recherche n'a renvoyé aucun résultat","info");
				Template::redirect('index');
			// On revoi sur l'index avec un affichage de 2
			} else {
				// On stoque dans la variable term le mot clé
				$term = $this -> input -> post('recherche', TRUE);

				// Tableau contenant l'ensemble des résultat à envoyer à la vue
				$tab_result = array();

				//On stoque les différents "rows" dans un tableau
				$rowsArray = array($rows, $rowsLabel);

				//Permet de sélectionner la bonne méthode dans le foreach
				$i = 1;

				foreach ($rowsArray as $rows) {

					if (!empty($rows))// Si on a des artistes ou des labels qui correspondent
					{
						foreach ($rows as $row) {
							//Selon $i on les sélectionne tous par leurs id dans la bonne table
							if ($i == 1) {
								$tabs = $this -> Info_Disque_Model -> GetArtiste($row -> art_id);
							}
							if ($i == 2) {
								$tabs = $this -> Info_Disque_Model -> GetLabel($row -> id);
							}

							foreach ($tabs as $tab) {
								// On ajoute charque disque au tab_result correspondant à l'artiste ou le label
								$tab_result[] = $tab['dis_id'];
							}
						}
					}
					$i++;
				}

				foreach ($rowsDisque as $tab) {
					// On ajoute charque disque au tab_result
					$tab_result[] = $tab['dis_id'];
				}

				//On dédoublonne le tableau
				$tab_result = array_unique($tab_result);
				$tab_resultDisque = array();
				foreach ($tab_result as $row) {
					//On va chercher toutes les infos du disque en fonction de son id
					$disque = $this -> Info_Disque_Model -> GetArrayDisque($row);
					foreach ($disque as $dis) {
						// On ajoute charque disque au tab_resultDisque
						$tab_resultDisque[] = $dis;
					}
				}

				// Si il n'y a pas de disque dans tab_resultDisque
				if (count($tab_resultDisque) == 0 || !isset($tab_resultDisque)){
					Template::set_message("La recherche n'a renvoyé aucun résultat","info");
					Template::redirect('index');
				}
					
				// On renvoi sur l'index avec un affichage de 2
				else {
					// On charge la vue avec un affichage de 1
					Template::set_view('index/resultat_recherche');
					Assets::add_js(js_url("pagination"));
					Assets::add_js(js_url("cocheTout"));
					//Template::set_view('index/resultat_recherche');
					Template::set('value',$this -> input -> post('recherche'));
					Template::set('resultat',$tab_resultDisque);
					Template::set('affichage',1);
					
					Template::render();
				}
			}

		}

	}

	//
	// Méthode de suggestion : ajax et auto-completion.
	//
	public function suggestions() {
		
		$this->output->enable_profiler(FALSE);
		$this -> load -> model('index/autocomplete_model');
		$term = $this -> input -> post('term', TRUE);

		if (strlen($term) < 1)
			break;

		$json_array = array();

		$rowsDisque = $this -> autocomplete_model -> GetAutocompleteDisque(array('keyword' => $term));
		$rowsArtiste = $this -> autocomplete_model -> GetAutocompleteArtiste(array('keyword' => $term));
		$rowsLabel = $this -> autocomplete_model -> GetAutocompleteLabel(array('keyword' => $term));
		$rowsArray = array($rowsDisque, $rowsArtiste, $rowsLabel);
		$j = 1;

		foreach ($rowsArray as $rows) {
			$i = 0;
			foreach ($rows as $row) {
				if ($i < 4) {
					if ($j == 1) {
						array_push($json_array, array("label" => $row -> dis_libelle, "category" => " <i class='icon-music'></i> Titre"));
					}
					if ($j == 2) {
						array_push($json_array, array("label" => $row -> art_nom, "category" => "<i class='icon-user'></i> Artiste"));
					}
					if ($j == 3) {
						array_push($json_array, array("label" => $row -> username, "category" => "<i class='icon-home'></i> Diffuseur"));
					}
				}
				$i++;
			}
			$j++;
		}

		echo json_encode($json_array);
	}

	//
	// Méthode d'affichage des renseingements d'un disque : ajax.
	//
	public function affichage_disque($id_disque) {
		
		$this->output->enable_profiler(FALSE);
		$this->auth->restrict('Wave.Recherche.Disque');
		if (!empty($id_disque))// Si le id_disque n'est pas nul
		{

			// id_dis doit être >= à 0
			assert($id_disque >= 0);

			// Transtipage en integer
			$id_disque = intval($id_disque);

			// On récupère les infos du disque
			$tabs = $this -> Info_Disque_Model -> GetDisque($id_disque);

			// Tableau contenant les données à envoyé
			$json_array = array();
							
			$this -> load -> model('parametre_model', 'parametreManager');
			$colonnes = $this -> parametreManager -> select('colonnes');
			$colonnes = explode(";", $colonnes['param_valeur']);

			// Parcours du résultat du model et ajout au json_array
			foreach ($tabs as $tab) {
				if (empty($tab -> emb_libelle))
					$emb_id = null;
				else {
					$emb_id = $tab -> emb_libelle;
				}
				$json_array[] = array("dis_id" => $tab -> dis_id, "dis_envoi_ok" => $tab -> dis_envoi_ok, "sty_couleur" => $tab -> sty_couleur, "sty_libelle" => $tab -> sty_libelle, "mail" => $tab -> mail, "dis_libelle" => $tab -> dis_libelle, "dis_format" => $tab -> dis_format, "mem_nom" => $tab -> mem_nom, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom, "emp_libelle" => $tab -> emp_libelle, "emb_id" => $emb_id, "col1" => $tab -> col1, "col2" => $tab -> col2, "col3" => $tab -> col3, "col4" => $tab -> col4, "col5" => $tab -> col5, "col6" => $tab -> col6);
		}
			// Passage a la vue manquante
			$this -> load -> view('index/affichage_disque', array('data' => $json_array[0], 'colonne' => $colonnes));

		}
	}

	public function spip() {
		$this->output->enable_profiler(FALSE);
		$this -> load -> view('index/spip');
	}
	
	public function erreur($num) {
		switch($num) {
			case 404 :
				Template::set_view('erreurs/erreur404');
				break;
		}
		Template::render();
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
