<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

require_once 'disque.php';

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
		$this -> load -> model('parametre_model', 'parametreManager');
		$this -> load -> model('disque/emplacement_model', 'emplacementManager');
		$this -> load -> model('disque/style_model', 'styleManager');
		$this -> load -> library('layout');
		$this -> load -> library('pagination');

	}

	//
	// Méthode index : affichage de l'ensemble des disques
	//
	public function index($g_nb_disques = 1, $affichage = 0) {
		// Chargement des ressources
		
		$this->auth->restrict('Wave.Importer.Disque');
		
		
		
		if ($affichage === 0)// Si l'affichage est pour l'ensemble des disques
		{
			// Tableau récoltant des données à envoyer à la vue
			$data = array();

			// On récupère le nombre de disque présent dans la base
			$tabs = $this -> importerManager -> selectImport();
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
				//var_dump($this->current_user->id, $tab->per_id_import);
				
				if((int)$tab->per_id_import == $this->current_user->id){
					$tab_result1[] = array("dis_id" => $tab -> imp_id, "dis_libelle" => $tab -> imp_libelle, "mem_nom" => $tab -> imp_ecoute, "art_nom" => $tab -> imp_artiste, "per_nom" => $tab->imp_diffuseur);
					//var_dump("==");
				}
				else{
					$tab_result2[] = array("dis_id" => $tab -> imp_id, "dis_libelle" => $tab -> imp_libelle, "mem_nom" => $tab -> imp_ecoute, "art_nom" => $tab -> imp_artiste, "per_nom" => $tab->imp_diffuseur);
					//var_dump("!=");
				}
			}
			if (!empty($tab_result1)) {
				// On passe le tableau de disque
				$data['resultat1'] = $tab_result1;
			}
			if (!empty($tab_result2)) {
				// On passe le tableau de disque
				$data['resultat2'] = $tab_result2;
			}
		}

		// On passe la valeur d'affichage (sélectionne dans la vue les mode à afficher : erreur, résultat recherche, vue général)
		$data['affichage'] = $affichage;
		$data['username'] = $this->current_user->username;
		// Chargement de la vue
		Template::set_view('enAttente/resultat');
		//Template::set_view('index/resultat_recherche');
		Template::set('data', $data);
		Template::render();
		//$this -> layout -> views('menu_principal') -> views('index/barre_recherche', array('value' => $this -> input -> post('recherche'))) -> view('index/resultat_recherche', $data);

	}

	public function supprimmerDisquesEnAttente($idsupp = 0, $g_nb_disques = 1, $affichage = 0) {
		
		$this->auth->restrict('Wave.Importer.Disque');
		// Chargement des ressources

		if ($affichage === 0)// Si l'affichage est pour l'ensemble des disques
		{
			// Tableau récoltant des données à envoyer à la vue
			$data = array();
			$id = $this -> input -> post('choix');
			// Récupération de tout les disques pour la page
			if(empty($id))
				$id = $idsupp;
			
			$tabs = $this -> importerManager -> GetAll_in($id);

			// On parcours le tableau, si emb_id n'existe pas on le met à nul et on ajoute chaque disque dans le tableau tab_result.
			foreach ($tabs as $tab) {
				if (empty($tab -> emb_id))
					$emb_id = null;
				else {
					$emb_id = $tab -> emb_id;
				}
				$tab_result[] = array("dis_id" => $tab -> imp_id, "dis_libelle" => $tab -> imp_libelle, "mem_nom" => $tab -> imp_ecoute, "art_nom" => $tab -> imp_artiste, "per_nom" => $tab->imp_diffuseur);
			}

			// On passe le tableau de disque
			$data['resultat'] = $tab_result;
		}
		$data['liens'][0] = array("id" => "supprAllI", "icon" => "icon-trash", "text" => " Tout supprimer", "href" => "#");
		$data['liens'][1] = array("id" => "", "icon" => "icon-undo", "text" => " Annuler", "href" => site_url("enAttente/"));
		// On passe la valeur d'affichage (sélectionne dans la vue les mode à afficher : erreur, résultat recherche, vue général)
		$data['affichage'] = $affichage;

		// Chargement de la vue
		//$this -> layout -> views('menu_principal')->view('disque/supprimer', $data);
		// Chargement de la vue
		Template::set_view('confirmation');
		//Template::set_view('index/resultat_recherche');
		Template::set('data', $data);
		Template::render();

	}

	public function supprimerAll($choix = null) {
			
		$this->auth->restrict('Wave.Importer.Disque');
		$choix = $this->input->post('choix');
		$ttx = count($choix);
		$suc = $ech = 0;
		if(!empty($choix)) {
			foreach($choix as $id) {
				$r = $this->importerManager->deleteImport($id);
				if($r)
					$suc++;
				else
					$ech++;
			}
		}
		if($suc == $ttx)
			($ttx > 1) ? Template::set_message('Tous les disques ont été correctement supprimé', 'success') : Template::set_message('Le disque a été correctement supprimé', 'success');
		else {
			if($ech == $ttx)
				($ttx > 1) ? Template::set_message('Tous les disques n\'ont pas été correctement supprimé', 'error') : Template::set_message('Le disque n\'a pas été correctement supprimé', 'error');
			else{
				($ttx > 1) ? Template::set_message($suc.' disques ont été cont été correctement supprimé', 'success') : Template::set_message('Le disque a été correctement supprimé', 'success');
				//Template::set_message($s, 'warning');
			}
		}
		Template::redirect('enAttente/');
	}

	
	public function modifDisquesEnAttente($id) {

		$this->auth->restrict('Wave.Importer.Disque');
		// Chargement des formats
		$formats = $this -> parametreManager -> select('format');
		$formats = explode(";", $formats['param_valeur']);
		$data['formats'] = $formats;

		// Chargement des emplacements
		$emp_libelles = $this -> emplacementManager -> select_all(array('emp_libelle', 'emp_plus'));
		$data['emplacements'] = array();
		foreach ($emp_libelles as $emp_libelle) {
			array_push($data['emplacements'], array("emp_libelle" => $emp_libelle -> emp_libelle, "emp_plus" => $emp_libelle -> emp_plus));
		}

		// Chargement des styles
		$styles = $this -> styleManager -> select_all(array('sty_couleur', 'sty_libelle'));
		$data['styles'] = array();
		foreach ($styles as $style) {
			array_push($data['styles'], array("couleur" => $style -> sty_couleur, "libelle" => $style -> sty_libelle));
		}
		
		//Cr�ation d'un objet Disque
		$disqueModif = new Disque();
		
		$id_disque = $id;
		// id_dis doit être >= à 0
		assert($id_disque >= 0);

		// Transtipage en integer
		$id_disque = intval($id_disque);

		// On récupère les infos du disque
		$tabs = $this -> importerManager -> GetDisqueImport($id_disque);

		// Tableau contenant les données à envoyé
		$json_array = array();

		// Parcours du résultat du model et ajout au json_array
		foreach ($tabs as $tab) {
			if (empty($tab -> imp_em_bev))
				$emb_id = null;
			else {
				$emb_id = $tab -> imp_em_bev;
			}
			$json_array[] = array("dis_id" => $tab -> imp_id,"dis_envoi_ok" => $tab->imp_envoi_ok, "sty_libelle" => $tab->imp_style, "mail" => $tab-> imp_email_diffuseur, "dis_libelle" => $tab -> imp_libelle, "dis_format" => $tab -> imp_format, "mem_nom" => $tab -> imp_ecoute, "art_nom" => $tab -> imp_artiste, "per_nom" => $tab -> imp_diffuseur, "emp_libelle" => $tab -> imp_emplacement, "emb_id" => $emb_id);
		}
		if(!empty($json_array[0])) {
			$disque = $json_array[0];
			$data['infoDisque'] = $disque;
			$data['import'] = true;
			if (!$disqueModif -> formulaire_null()) {
				// Formulaire envoyé
				$disqueModif->set_dis_id($id);
				$is_erreur = $disqueModif->ajouter_disque();
				if(empty($is_erreur)) {
					Template::set_message('Le disque a bien été modifié', 'success');
					//On enl�ve de la base import le disque ajout�
					$this->importerManager->deleteImport($id);
					Template::redirect('enAttente/index');
				}
				else {
					Template::set_message($is_erreur, 'error');
					Template::set('data',$data);
					Template::set_view('disque/ajouter_fiche');
					Template::render();
				}
			}
			else {
				Template::set('data',$data);
				Template::set_view('disque/ajouter_fiche');
				Template::render();
			}
		}
		else
		{
			Template::set_message('Le disque à modifier est introuvable.', 'error');
			Template::redirect('enAttente/index');
		}
		
		// Chargement de la vue
		Template::set_view('disque/ajouter_fiche');
		Template::set('data', $data);
		Template::render();
	}
	
}
