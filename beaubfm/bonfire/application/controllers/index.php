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
		
	}

	//
	// Méthode index : affichage de l'ensemble des disques
	//
	public function index($g_nb_disques = 1, $affichage = 0) {
		// Chargement des ressources		$this -> load -> library('layout');
		$this -> load -> model('index/Info_Disque_Model');
		$this -> load -> library('pagination');
		
		if ($affichage === 0)// Si l'affichage est pour l'ensemble des disques
		{
			// Tableau récoltant des données à envoyer à la vue
			$data = array();

			// On récupère le nombre de disque présent dans la base
			$nb_disques_total = $this -> Info_Disque_Model -> count();
			
			// On vérifie la cohérence de la variable $_GET
			if ($g_nb_disques > 1) {
				// La variable $_GET semblent être correcte. On doit maintenant
				// vérifier s'il y a bien assez de disquess dans la base dedonnées.
				if ($g_nb_disques <= $nb_disques_total) {
					// Il y a assez de disques dans la base de données.
					// La variable $_GET est donc cohérente.
					$nb_disques = intval($g_nb_disques);
				} else {
					// Il n'y pas assez de messages dans la base de données.
					$nb_disques = 1;
				}
			} else {
				// La variable $_GET "nb_disques" est erronée. On lui donne une valeur par défaut
				$nb_disques = 1;
			}

			// Mise en place de la pagination
			//$this -> pagination -> initialize(array('base_url' => base_url() . 'index.php/index/index/', 'total_rows' => $nb_disques_total, 'per_page' => self::NB_DISQUE_PAR_PAGE));
			/*$pag = "";
			for($i = 1 ; $i <= ($nb_disques_total/self::NB_DISQUE_PAR_PAGE)+1 ; $i++)
			{
				$pag = $pag."&nbsp;<a href=\"#\" id=\"p".$i."\">".$i."</a>&nbsp;";
			}
			
			$linkpag = "<a href=\"#\" id=\"begin\">&lt;&lt;</a><a href=\"#\" id=\"pred\">&lt;</a>".$pag."<a href=\"#\" id=\"suiv\">&gt;</a><a href=\"#\" id=\"fin\">&gt;&gt;</a>";
			$data['pagination'] = $linkpag;
			//$data['pagination'] = $this -> pagination -> create_links();*/

			// Récupération de tout les disques pour la page
			$tabs = $this -> Info_Disque_Model -> GetAll();

			// On parcours le tableau, si emb_id n'existe pas on le met à nul et on ajoute chaque disque dans le tableau tab_result.
			foreach ($tabs as $tab) {
				if (empty($tab -> emb_id))
					$emb_id = null;
				else {
					$emb_id = $tab -> emb_id;
				}
				$tab_result[] = array("dis_id" => $tab -> dis_id, "dis_libelle" => $tab -> dis_libelle, "dis_format" => $tab -> dis_format, "mem_nom" => $tab -> mem_nom, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom, "emp_libelle" => $tab -> emp_libelle, "emb_id" => $emb_id);
			}
			if(!empty($tab_result)){
				// On passe le tableau de disque
				$data['resultat'] = $tab_result;		
			}
		}

		// On passe la valeur d'affichage (sélectionne dans la vue les mode à afficher : erreur, résultat recherche, vue général)
		$data['affichage'] = $affichage;

		// Chargement de la vue
		Template::set_view('index/barre_recherche');
		//Template::set_view('index/resultat_recherche');
		Template::set('value',$this -> input -> post('recherche'));
		Template::set('data',$data);
		Template::render();
		//$this -> layout -> views('menu_principal') -> views('index/barre_recherche', array('value' => $this -> input -> post('recherche'))) -> view('index/resultat_recherche', $data);
		
	}

	//
	// Méthode recherche : affichage des résultats de la recherche
	//
	public function recherche($g_nb_disques = 1) {
		// On vérifie si la variable post contient des erreurs
		$this -> form_validation -> set_rules('recherche', 'recherche', 'trim|required|xss_clean');

		if ($this -> form_validation -> run() == FALSE)// Des erreurs on été détecté !
		{
			$this -> index(1, -1);
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

			if (empty($rows) and empty($rowsLabel) and empty($rowsDisque))// Aucun disque, artiste, label a été trouvé
				$this -> index(1, 2);
			// On revoi sur l'index avec un affichage de 2
			else {
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
								$tabs = $this -> Info_Disque_Model -> GetLabel($row -> lab_id);
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
				if (count($tab_resultDisque) == 0 || !isset($tab_resultDisque))
					$this -> index(1, 2);
				// On renvoi sur l'index avec un affichage de 2
				else {
					// On charge la vue avec un affichage de 1
					$this -> load -> library('layout');
					$this -> layout -> views('menu_principal') -> views('index/barre_recherche', array('value' => $this -> input -> post('recherche'))) -> view('index/resultat_recherche', array('resultat' => $tab_resultDisque, 'affichage' => 1));

				}
			}

		}

	}

	//
	// Méthode de suggestion : ajax et auto-completion.
	//
	public function suggestions() {
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
						array_push($json_array, array("label" => $row -> art_nom, "category" => "<i class='icon-group'></i> Artiste"));
					}
					if ($j == 3) {
						array_push($json_array, array("label" => $row -> lab_nom, "category" => "<i class='icon-home'></i> Diffuseur"));
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
		if (!empty($id_disque))// Si le id_disque n'est pas nul
		{
			// On charge le model
			$this -> load -> model('index/Info_Disque_Model', 'infodisque');

			// id_dis doit être >= à 0
			assert($id_disque >= 0);

			// Transtipage en integer
			$id_disque = intval($id_disque);

			// On récupère les infos du disque
			$tabs = $this -> infodisque -> GetDisque($id_disque);

			// Tableau contenant les données à envoyé
			$json_array = array();

			// Parcours du résultat du model et ajout au json_array
			foreach ($tabs as $tab) {
				if (empty($tab -> emb_libelle))
					$emb_id = null;
				else {
					$emb_id = $tab -> emb_libelle;
				}
				$json_array[] = array("dis_id" => $tab -> dis_id, "dis_libelle" => $tab -> dis_libelle, "dis_format" => $tab -> dis_format, "mem_nom" => $tab -> mem_nom, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom, "emp_libelle" => $tab -> emp_libelle, "emb_id" => $emb_id);
			}

			// Envoi des données à la vue
			$this -> load -> view('index/affichage_disque', array('data' => $json_array[0]));
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
