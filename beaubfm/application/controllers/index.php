<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Index extends MY_Controller {

	const NB_DISQUE_PAR_PAGE = 15;

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

	public function index($g_nb_disques = 1, $affichage = 0) {
		$this -> load -> library('layout');
		$this -> load -> model('Info_Disque_Model');
		$this -> load -> library('pagination');

		$data = array();
		$nb_disques_total = $this -> Info_Disque_Model -> count();

		// On vérifie la cohérence de la variable $_GET
		if ($g_nb_disques > 1) {
			// La variable $_GET semblent être correcte. On doit maintenant
			// vérifier s'il y a bien assez de disquess dans la base dedonnées.
			if ($g_nb_disques <= $nb_disques_total) {
				// Il y a assez de disquess dans la base de données.
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
		$this -> pagination -> initialize(array('base_url' => base_url() . 'index.php/index/index/', 'total_rows' => $nb_disques_total, 'per_page' => self::NB_DISQUE_PAR_PAGE));
		$data['pagination'] = $this -> pagination -> create_links();
		$data['nb_disques'] = $nb_disques_total;

		// Affichage de tout les titres :
		$tabs = $this -> Info_Disque_Model -> GetAll(self::NB_DISQUE_PAR_PAGE, $nb_disques - 1);

		foreach ($tabs as $tab) {
			if (empty($tab -> emb_id))
				$emb_id = null;
			else {
				$emb_id = $tab -> emb_id;
			}
			$tab_result[] = array("dis_id" => $tab -> dis_id, "dis_libelle" => $tab -> dis_libelle, "dis_format" => $tab -> dis_format, "mem_nom" => $tab -> mem_nom, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom, "emp_libelle" => $tab -> emp_libelle, "emb_id" => $emb_id);
		}
		$data['affichage'] = $affichage;
		$data['resultat'] = $tab_result;
		$this -> layout -> views('menu_principal') -> views('barre_recherche', array('value' => $this -> input -> post('recherche'))) -> view('resultat_recherche', $data);

	}

	public function recherche($g_nb_disques = 1) {
		$this -> form_validation -> set_rules('recherche', 'recherche', 'trim|required|xss_clean');
		//$this->output->enable_profiler(TRUE);
		if ($this -> form_validation -> run() == FALSE) {
			$this -> index(1, -1);
		} else {
			$this -> load -> model('autocomplete_model');
			$this -> load -> model('Info_Disque_Model');
			$rows = $this -> autocomplete_model -> GetAutocompleteArtiste(array('keyword' => $this -> input -> post('recherche')));
			$rowsLabel = $this -> autocomplete_model -> GetAutocompleteLabel(array('keyword' => $this -> input -> post('recherche')));
			$rowsDisque = $this -> autocomplete_model -> GetAutocompleteDisque(array('keyword' => $this -> input -> post('recherche')));
			if (empty($rows) and empty($rowsLabel) and empty($rowsDisque))
				$this -> index(1, 2);
			else {
				$term = $this -> input -> post('recherche', TRUE);
				//if (strlen($term) < 2) break;

				$tab_result = array();
				if (!empty($rows)) {
					foreach ($rows as $row) {
						$tabs = $this -> Info_Disque_Model -> GetArtiste($row -> art_id);

						foreach ($tabs as $tab) {
							if (empty($tab -> emb_id))
								$emb_id = null;
							else {
								$emb_id = $tab -> emb_id;
							}
							$tab_result[] = array("dis_id" => $tab -> dis_id, "dis_libelle" => $tab -> dis_libelle, "dis_format" => $tab -> dis_format, "mem_nom" => $tab -> mem_nom, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom, "emp_libelle" => $tab -> emp_libelle, "emb_id" => $emb_id);
						}
					}
				}
				if (!empty($rowsLabel)) {
					foreach ($rowsLabel as $rowLabel) {
						$tabs = $this -> Info_Disque_Model -> GetLabel($rowLabel -> lab_id);

						foreach ($tabs as $tab) {
							if (empty($tab -> emb_id))
								$emb_id = null;
							else {
								$emb_id = $tab -> emb_id;
							}
							$tab_result[] = array("dis_id" => $tab -> dis_id, "dis_libelle" => $tab -> dis_libelle, "dis_format" => $tab -> dis_format, "mem_nom" => $tab -> mem_nom, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom, "emp_libelle" => $tab -> emp_libelle, "emb_id" => $emb_id);
						}
					}
				}
				if (!empty($rowsDisque)) {
					foreach ($rowsDisque as $rowDisque) {
						$tabs = $this -> Info_Disque_Model -> GetDisque($rowDisque -> dis_id);

						foreach ($tabs as $tab) {
							if (empty($tab -> emb_id))
								$emb_id = null;
							else {
								$emb_id = $tab -> emb_id;
							}
							$tab_result[] = array("dis_id" => $tab -> dis_id, "dis_libelle" => $tab -> dis_libelle, "dis_format" => $tab -> dis_format, "mem_nom" => $tab -> mem_nom, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom, "emp_libelle" => $tab -> emp_libelle, "emb_id" => $emb_id);
						}
					}
				}
				if (count($tab_result) == 0)
					$this -> index(1, 2);
				else {
					$this -> load -> library('layout');
					$this -> layout -> views('menu_principal') -> views('barre_recherche', array('value' => $this -> input -> post('recherche'))) -> view('resultat_recherche', array('resultat' => $tab_result, 'affichage' => 1));

				}
			}

		}
	}

	private function resultat_recherche() {
		$this -> load -> model('autocomplete_model');
		$this -> load -> model('Info_Disque_Model');
		$rows = $this -> autocomplete_model -> GetAutocompleteArtiste(array('keyword' => $this -> input -> post('recherche')));
		$rowsLabel = $this -> autocomplete_model -> GetAutocompleteLabel(array('keyword' => $this -> input -> post('recherche')));
		$rowsDisque = $this -> autocomplete_model -> GetAutocompleteDisque(array('keyword' => $this -> input -> post('recherche')));
		if (empty($rows) and empty($rowsLabel) and empty($rowsDisque))
			$this -> index(1, 2);
		else {
			$term = $this -> input -> post('recherche', TRUE);
			//if (strlen($term) < 2) break;

			$tab_result = array();
			if (!empty($rows)) {
				foreach ($rows as $row) {
					$tabs = $this -> Info_Disque_Model -> GetArtiste($row -> art_id);

					foreach ($tabs as $tab) {
						if (empty($tab -> emb_id))
							$emb_id = null;
						else {
							$emb_id = $tab -> emb_id;
						}
						$tab_result[] = array("dis_id" => $tab -> dis_id, "dis_libelle" => $tab -> dis_libelle, "dis_format" => $tab -> dis_format, "mem_nom" => $tab -> mem_nom, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom, "emp_libelle" => $tab -> emp_libelle, "emb_id" => $emb_id);
					}
				}
			}
			if (!empty($rowsLabel)) {
				foreach ($rowsLabel as $rowLabel) {
					$tabs = $this -> Info_Disque_Model -> GetLabel($rowLabel -> lab_id);

					foreach ($tabs as $tab) {
						if (empty($tab -> emb_id))
							$emb_id = null;
						else {
							$emb_id = $tab -> emb_id;
						}
						$tab_result[] = array("dis_id" => $tab -> dis_id, "dis_libelle" => $tab -> dis_libelle, "dis_format" => $tab -> dis_format, "mem_nom" => $tab -> mem_nom, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom, "emp_libelle" => $tab -> emp_libelle, "emb_id" => $emb_id);
					}
				}
			}
			if (!empty($rowsDisque)) {
				foreach ($rowsDisque as $rowDisque) {
					$tabs = $this -> Info_Disque_Model -> GetDisque($rowDisque -> dis_id);

					foreach ($tabs as $tab) {
						if (empty($tab -> emb_id))
							$emb_id = null;
						else {
							$emb_id = $tab -> emb_id;
						}
						$tab_result[] = array("dis_id" => $tab -> dis_id, "dis_libelle" => $tab -> dis_libelle, "dis_format" => $tab -> dis_format, "mem_nom" => $tab -> mem_nom, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom, "emp_libelle" => $tab -> emp_libelle, "emb_id" => $emb_id);
					}
				}
			}
			if (count($tab_result) == 0)
				$this -> index(1, 2);
			else {
				return $tab_result;
			}
		}
	}

	public function suggestions() {
		$this -> load -> model('autocomplete_model');
		$term = $this -> input -> post('term', TRUE);

		if (strlen($term) < 1)
			break;

		$rows = $this -> autocomplete_model -> GetAutocompleteDisque(array('keyword' => $term));

		$json_array = array();
		$i = 0;
		foreach ($rows as $row) {
			if ($i < 4)
				array_push($json_array, array("label" => $row -> dis_libelle, "category" => "Disque"));
			$i++;
		}

		$rows = $this -> autocomplete_model -> GetAutocompleteArtiste(array('keyword' => $term));
		$i = 0;
		foreach ($rows as $row) {
			if ($i < 4)
				array_push($json_array, array("label" => $row -> art_nom, "category" => "Artiste"));
			$i++;
		}

		$i = 0;
		$rows = $this -> autocomplete_model -> GetAutocompleteLabel(array('keyword' => $term));
		foreach ($rows as $row) {
			if ($i < 4)
				array_push($json_array, array("label" => $row -> lab_nom, "category" => "Diffuseur"));
			$i++;
		}

		echo json_encode($json_array);
	}

	public function affichage_disque($id_disque) {
		if (!empty($id_disque)) {
			$this -> load -> model('Info_Disque_Model', 'infodisque');
			assert($id_disque >= 0);
			$id_disque = intval($id_disque);

			$tabs = $this -> infodisque -> GetDisque($id_disque);

			$json_array = array();

			foreach ($tabs as $tab) {
				if (empty($tab -> emb_id))
					$emb_id = null;
				else {
					$emb_id = $tab -> emb_id;
				}
				$json_array[] = array("dis_id" => $tab -> dis_id, "dis_libelle" => $tab -> dis_libelle, "dis_format" => $tab -> dis_format, "mem_nom" => $tab -> mem_nom, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom, "emp_libelle" => $tab -> emp_libelle, "emb_id" => $emb_id);
			}
			$this -> load -> view('affichage_disque', array('data' => $json_array[0]));
			//echo json_encode($json_array);
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
