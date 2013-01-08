<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class EnAttente extends Authenticated_Controller {
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
		$this -> load -> model('importer/importer_model', 'importerManager');
		$this -> load -> library('layout');
		$this -> load -> library('pagination');

	}

	//
	// Méthode index : affichage de l'ensemble des disques
	//
	public function index($g_nb_disques = 1, $affichage = 0) {
		// Chargement des ressources

		if ($affichage === 0)// Si l'affichage est pour l'ensemble des disques
		{
			// Tableau récoltant des données à envoyer à la vue
			$data = array();

			// On récupère le nombre de disque présent dans la base
			$tabs = $this->importerManager->selectImport(); 
			$nb_disques_total = count($tabs);

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

			// Récupération de tout les disques de importdisque pour la page

			
			

			$this -> importerManager -> selectImport();

			// On parcours le tableau, si emb_id n'existe pas on le met à nul et on ajoute chaque disque dans le tableau tab_result.
			foreach ($tabs as $tab) {
				if (empty($tab -> emb_id))
					$emb_id = null;
				else {
					$emb_id = $tab -> emb_id;
				}
				$tab_result[] = array("dis_id" => $tab -> imp_id, "dis_libelle" => $tab -> imp_libelle, "dis_format" => $tab -> imp_format, "mem_nom" => $tab -> imp_ecoute, "art_nom" => $tab -> imp_artiste, "per_nom" => $tab -> imp_diffuseur, "emp_libelle" => $tab -> imp_emplacement, "emb_id" => $tab->imp_em_bev);
			}
			if (!empty($tab_result)) {
				// On passe le tableau de disque
				$data['resultat'] = $tab_result;
			}
		}

		// On passe la valeur d'affichage (sélectionne dans la vue les mode à afficher : erreur, résultat recherche, vue général)
		$data['affichage'] = $affichage;

		// Chargement de la vue
		Template::set_view('index/resultat_recherche');
		//Template::set_view('index/resultat_recherche');
		Template::set('value', $this -> input -> post('recherche'));
		Template::set('data', $data);
		Template::render();
		//$this -> layout -> views('menu_principal') -> views('index/barre_recherche', array('value' => $this -> input -> post('recherche'))) -> view('index/resultat_recherche', $data);

	}

	public function modifDisquesEnAttente() {
		
		// Récupération de tous les disques enAttente de modification
		//Tableau contenant les id des cases des disques s�lectionn�s
		$id = $this -> input -> post('choix');
		
		//Tableau contenant les disques s�lectionn�s pour la modification
		$tabs = $this -> importer_model -> GetAll_in($id);
		
		$data['imp_libelle'] = $tabs[0]['imp_libelle'];

		// Chargement de la vue
		Template::set('data', $data);
		Template::set_view('ajouter_fiche.php');
		Template::render();
	}

}
