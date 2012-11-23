<?php
class ImporterFiche extends MY_Controller {
	private $msgError = "";

	public function __construct() {
		parent::__construct();
		$this -> load -> library('upload');
		date_default_timezone_set("Asia/Jakarta");
		$this -> load -> library('excel');
	}

	public function setMsgError($msgError) {
		$this -> msgError = $msgError;
	}

	public function getMsgError() {
		return $this -> msgError;
	}

	public function index() {
		$this -> load -> library('layout');
		$this -> layout -> views('menu_principal') -> view('importer', array('msgError' => $this -> getMsgError()));
	}

	public function envoi() {
		$nombreFichier = array('1', '2', '3', '4', '5', '6', '7');

		foreach ($nombreFichier as $i) {
			if (!empty($_FILES['fichier_' . $i]['name'])) {
				$config['file_name'] = $this -> session -> userdata('username') . '_fichier_' . $i;
				$config['upload_path'] = './assets/upload';
				$config['allowed_types'] = 'csv|xml|txt|xls|xlsx';
				$config['max_size'] = '2048';
				$config['overwrite'] = TRUE;
				$this -> upload -> initialize($config);
				$form_name = 'fichier_' . $i;
				if (!$this -> upload -> do_upload($form_name)) {
					$this -> setMsgError($this -> getMsgError() . "Fichier " . $i . " : " . $this -> upload -> display_errors() . "\n");
				} else {
					$data[$i] = array('upload_data' => $this -> upload -> data());
				}
			}
		}
		$this -> index();

		//Pour chaque fichier tÃ©lÃ©chargÃ© on rÃ©cupÃ¨re le type du fichier pour charger la bonne librairie
		foreach ($nombreFichier as $i) {
			if (isset($data[$i])) {
				if ($data[$i]['upload_data']['file_ext'] == '.csv')
					$this -> csvFile($data[$i]);
				if ($data[$i]['upload_data']['file_ext'] == '.xls' || $data[$i]['upload_data']['file_ext'] == '.xlsx')
					$this -> excelFile($data[$i]);
				if ($data[$i]['upload_data']['file_ext'] == '.xml')
					$this -> xmlFile($data[$i]);
			}
		}
	}

	public function excelFile($data) {
		$objPHPExcel = new PHPExcel();
		$objPHPExcel = PHPExcel_IOFactory::load($data['upload_data']['full_path']);
		$arrayFichier = $objPHPExcel -> getSheet() -> toArray();

		//$this -> lireTableau($arrayFichier);
		$tabAjout = $this -> getTabFinal($arrayFichier);
		$this -> ctrlAjoutFiche($tabAjout);
	}

	public function xmlFile($data) {
	}

	public function csvFile($data) {
		$objReader = PHPExcel_IOFactory::createReader('CSV')->setDelimiter(';')
															->setLineEnding("\r\n")
															->setSheetIndex(0);		
		$objPHPExcel = $objReader -> load($data['upload_data']['full_path']);
		$arrayFichier = $objPHPExcel -> getSheet() -> toArray();
		$this->lireTableau($arrayFichier);
	}

	public function lireTableau($arrayFichier) {
		$listeKeys = array('Titre', 'Artiste', 'Label', 'Format', 'Emplacement', 'Date d\'ajout', 'Genre', 'Ecoute par', 'email label');
		foreach ($listeKeys as $libelleKeys) {
			$keys[$libelleKeys] = array_search($libelleKeys, $arrayFichier[0]);
		}

		$longueurArray = count($arrayFichier) - 1;
		for ($i = 1; $i <= $longueurArray; $i++) {
			foreach ($listeKeys as $libelleKeys) {
				$arrayEpure[$i][$libelleKeys] = $arrayFichier[$i][$keys[$libelleKeys]];
			}
		}
		var_dump($arrayEpure);
		return $arrayEpure;
	}

	//On constitue un tableau structuré contenant des informations utiles à l'ajout d'une fiche disque
	public function getTabFinal($arrayFichier) {

		//On constitue un tableau associant chaque ligne à 1 album avec toutes les informations le concernant
		$listeKeys = array('Titre', 'Artiste', 'Label', 'Format', 'Emplacement', 'Date d\'ajout', 'Genre', 'Ecoute par', 'email label');
		foreach ($listeKeys as $libelleKeys) {
			$keys[$libelleKeys] = array_search($libelleKeys, $arrayFichier[0]);
		}

		$longueurArray = count($arrayFichier) - 1;
		for ($i = 1; $i <= $longueurArray; $i++) {
			foreach ($listeKeys as $libelleKeys) {
				$arrayEpure[$i][$libelleKeys] = $arrayFichier[$i][$keys[$libelleKeys]];
			}
		}
		//var_dump($arrayEpure);

		return $arrayEpure;
	}

	public function ctrlAjoutFiche($array) {
		$inv = 0;
		$nb = 0;

		//$array = tableau recensant tous les albums / $i = ligne / $album = tableau contenant informations propres à chaque album
		foreach ($array as $i => $album) {
			$nb++;

			$peutAjouter = $this -> traitementAlbum($album);
			if (!$peutAjouter) {
				$inv++;
			}
		}
		echo "$inv album(s) invalides ! ... sur $nb album(s) testés";
	}

	public function traitementAlbum($album) {
		$valide = TRUE;
		$autoprod = FALSE;

		//on vérifie si les champs sont renseignés
		if (is_null($album['Titre']) || is_null($album['Artiste']) || is_null($album['Emplacement']) || is_null($album['Label']) || is_null($album['email label'])) {
			$valide = FALSE;
			var_dump($album);
		} else {

			//Insertion de valeurs par défaut sur certains champs non renseignés
			if (is_null($album['Format'])) {
				$album['Format'] = "CD";
			}

			if (is_null($album['Date d\'ajout'])) {
				$album['Date d\'ajout'] = date('m-d-y');
			}

			//on teste si l'artiste est un auto-producteur
			if ($album['Artiste'] == $album['Label']) {
				$autoprod = TRUE;
			}

			//Chargement des modèles
			//$this -> load -> model('personne_model', 'persManager');
			//
			// VÃ©rifiaction de l'existance de l'utilisateur renseingné dans le champ 'Ecoute par'
			//$existslisten = $this -> persManager -> readPersonne('per_id', array('per_nom' => $album['Ecoute par'], 'cat_id' => 2));
			//var_dump($existslisten);

			//on teste si le disque actuel n'est pas déjà présent en base de données
			if ($this -> testDoublon($album)) {
				$valide = FALSE;
			}
		}

		return $valide;
	}

	public function testDoublon($album) {
		$estDoublon = FALSE;

		//Chargement des modèles
		$this -> load -> model('personne_model', 'persManager');
		$this -> load -> model('diffuseur_model', 'difManager');
		$this -> load -> model('disque_model', 'disqueManager');
		
		$artId = $this -> persManager -> readArtiste('art_id', array('art_nom' => $album('Artiste')));
		
		
		$disId = $this -> disqueManager -> readDisque('dis_id', array('dis_libelle' => $album['Titre'], 'dis_format' => $album['Format'], 
		'dis_date_ajout' => $album['Date d\'ajout'], 'per_id_artiste' => $artId['art_id']));
		var_dump($disId);

		return $estDoublon;
	}

}
?>