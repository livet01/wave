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
		//On déclare ici le nombre de fichier possible à uploader depuis la vue
		$nombreFichier = array('1', '2', '3', '4', '5', '6', '7');

		//Pour chaque fichier qu'on peut uploader on test si il existe et s'il possède la bonne extension
		foreach ($nombreFichier as $i) {

			//Si le fichier existe on initialise la config
			if (!empty($_FILES['fichier_' . $i]['name'])) {

				//Le nom sera du type "username_fichier_NUMFICHIER"
				$config['file_name'] = $this -> session -> userdata('username') . '_fichier_' . $i;
				$config['upload_path'] = './assets/upload';

				//Les extensions acceptées sont les suivantes
				$config['allowed_types'] = 'csv|xml|txt|xls|xlsx';
				$config['max_size'] = '2048';
				$config['overwrite'] = TRUE;
				$this -> upload -> initialize($config);
				$form_name = 'fichier_' . $i;

				//Si l'upload ne fonctionne pas
				if (!$this -> upload -> do_upload($form_name)) {
					//On récupère l'erreur
					$this -> setMsgError($this -> getMsgError() . "Fichier " . $i . " : " . $this -> upload -> display_errors() . "\n");
				} else {
					//Sinon on récupère les informations de l'upload
					$data[$i] = array('upload_data' => $this -> upload -> data());
				}
			}
		}
		//On recharge l'index et on affiche les éventuels messages d'erreurs
		$this -> index();

		//Pour chaque fichier téléchargé on récupère le type du fichier pour charger la bonne librairie
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
		//On instancie un objet PHPExcel
		$objPHPExcel = new PHPExcel();

		//On charge le fichier excel correspondant à l'appel de la fonction
		$objPHPExcel = PHPExcel_IOFactory::load($data['upload_data']['full_path']);

		//On le change en tableau
		$arrayFichier = $objPHPExcel -> getSheet() -> toArray();

		//On garde que les informations utiles pour la mise en Base de données
		$tabAjout = $this -> getTabFinal($arrayFichier);

		$this -> ctrlAjoutFiche($tabAjout);
	}

	public function xmlFile($data) {
	}

	public function csvFile($data) {
		//On charge le fichier CSV selon plusieurs critères avec comme délimiteur ";"
		$objReader = PHPExcel_IOFactory::createReader('CSV') -> setDelimiter(';') -> setLineEnding("\r\n") -> setSheetIndex(0);

		//On charge le fichier CSV correspondant à l'appel de la fonction
		$objPHPExcel = $objReader -> load($data['upload_data']['full_path']);

		//On le change en tableau
		$arrayFichier = $objPHPExcel -> getSheet() -> toArray();
	}

	//On constitue un tableau structur� contenant des informations utiles � l'ajout d'une fiche disque
	public function getTabFinal($arrayFichier) {

		//On constitue un tableau associant chaque ligne d'un album avec toutes les informations le concernant
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

		//$array = tableau recensant tous les albums / $i = ligne / $album = tableau contenant informations propres � chaque album
		foreach ($array as $i => $album) {
			$nb++;

			$peutAjouter = $this -> traitementAlbum($album);
			if (!$peutAjouter) {
				$inv++;
			}
		}
		echo "$inv album(s) invalides ! ... sur $i album(s) test�s";
	}

	public function traitementAlbum($disque) {
		$valide = TRUE;

		//on v�rifie si les champs sont renseign�s
		if (is_null($disque['Titre']) || is_null($disque['Artiste']) || is_null($disque['Emplacement']) || is_null($disque['Label']) || is_null($disque['email label'])) {
			$valide = FALSE;
			var_dump($disque);
		} else {

			//Insertion de valeurs par d�faut sur certains champs non renseign�s
			if (is_null($disque['Format'])) {
				$disque['Format'] = "CD";
			}

			if (is_null($disque['Date d\'ajout'])) {
				$disque['Date d\'ajout'] = date('m-d-y');
			}

			if ($this -> testDoublon($disque)) {
				$valide = FALSE;
			}

			if ($valide == TRUE) {
				$this -> load -> model('personne_model', 'persManager');
				$this -> load -> model('embenevole_model', 'emBevManager');
				$this -> load -> model('disque_model', 'disqueManager');
				$this -> load -> model('diffuseur_model', 'diffManager');
				$this -> load -> model('utilisateur_model', 'utiManager');

				// Défintion de l'Id
				$disque['id'] = (string)(rand(31, 99) + rand(800, 1000));
				$disque['autoprod'] = 0;
				if ($disque['Artiste'] == $disque['Label']) {
					$disque['autoprod'] = 1;
				}

				$existEmBev = FALSE;
				if (strtolower($disque['Emplacement']) == "airplay" || strtolower($disque['Emplacement']) == "archivage" || strtoupper($disque['Emplacement']) == "refusé" || is_null($disque['Emplacement'])) {
					if (strtolower($disque['Emplacement']) == "airplay") {
						$disque['Emplacement'] = 1;
					}
					if (strtolower($disque['Emplacement']) == "archivage") {
						$disque['Emplacement'] = 2;
					}
					if (strtolower($disque['Emplacement']) == "refusé" || is_null($disque['Emplacement'])) {
						$disque['Emplacement'] = 3;
					}
				} else {
					$disque['Emplacement'] = 4;
					$existEmBev = $this -> emBevManager -> readEmission('emb_id', array('emb_libelle' => $disque['Emplacement']));
				}

				if ($existEmBev != FALSE) {
					$disque['emBev'] = $existsEmBev['emb_id'];
				}

				$existListen = $this -> persManager -> readPersonne('per_id', array('per_nom' => $disque['Ecoute par'], 'cat_id' => 2));
				$disque['listenBy'] = 0;
				if ($existListen) {
					$disque['listenBy'] = $existListen['per_id'];
				}

				// Vérification de l'éxistance de l'artiste

				$result_1 = FALSE;
				$artId = $this -> persManager -> readArtiste('art_id', array('art_nom' => $disque['Artiste']));
				if (empty($artId)) {
					$artId = $difId = $this -> persManager -> last_id();
					$result_1 = $this -> persManager -> ajouterpersonne($artId, $disque['Artiste'], ($disque['autoprod']) ? 5 : 3);
				} else {
					$artId = $artId['art_id'];
					$result_1 = TRUE;
				}

				$result_2 = FALSE;
				// Vérifiaction de l'éxistance du diffuseur si ce n'est pas un Autoprod !
				if (!$disque['autoprod'])
					$difId = $this -> diffManager -> readDiffuseur('lab_id', array('lab_nom' => $disque['Label']));
				else
					$difId = $this -> persManager -> readAutoprod('aut_id', array('aut_nom' => $disque['Artiste']));

				$result_3 = FALSE;
				$result_4 = FALSE;

				if (empty($difId)) {
					$difId = $this -> persManager -> last_id();

					if (!$disque['autoprod']) {
						// Ajout du diffuseur
						$result_2 = $this -> persManager -> ajouterpersonne($difId, $disque['Label'], 4);
					} else
						$result_2 = TRUE;

					// On contr�le si l'utilisateur n'est pas d�j� pr�sent en base de donn�es
					$resSearchUtil = $this -> utiManager -> readUtilisateur('per_id', array('uti_prenom' => $disque['Label']));
					if (empty($resSearchUtil)) {
						
						var_dump($resSearchUtil);
						// Ajout du Diffuseur ou de l'Artiste s'il est autoproducteur en tant qu'Utilisateur
						$result_3 = $this -> utiManager -> ajouterUtil((($disque['autoprod']) ? $artId : $difId), "", (($disque['autoprod']) ? $disque['Artiste'] : $disque['Label']), "lapin");
						$result_4 = $this -> diffManager -> ajouterDiffuseur((($disque['autoprod']) ? $artId : $difId), $disque['email label']);
					}
				} else {
					// Récupération de l'id du Diffuseur ou de l'id de l'Artiste si il est autoproducteur
					$difId = ($disque['autoprod']) ? $difId['aut_id'] : $difId['lab_id'];
					$result_2 = TRUE;
					$result_3 = TRUE;
					$result_4 = TRUE;
				}

				$disque['artiste'] = $artId;
				$disque['diffuseur'] = (($disque['autoprod']) ? $artId : $difId);

				if ($result_1 && $result_2 && $result_3) {
					$disque['titre'] = $disque['Titre'];
					$disque['format'] = $disque['Format'];
					$disque['envoiMail'] = 0;
					$disque['emplacement'] = $disque['Emplacement'];
					$result = $this -> disqueManager -> ajouterDisque($disque);
					echo "Réussi";
				} else {
					echo "Erreur";
				}
			}

		}

		return $valide;
	}

	public function testDoublon($album) {
		$estDoublon = FALSE;

		//Chargement des mod�les
		$this -> load -> model('personne_model', 'persManager');
		$this -> load -> model('diffuseur_model', 'difManager');
		$this -> load -> model('disque_model', 'disqueManager');

		$artId = $this -> persManager -> readArtiste('art_id', array('art_nom' => $album['Artiste']));
		//var_dump($artId);

		if ($artId != NULL) {

			$disId = $this -> disqueManager -> readDisque('dis_id', array('dis_libelle' => $album['Titre'], 'dis_format' => $album['Format'], 'per_id_artiste' => $artId['art_id']));

			if ($disId != NULL) {
				$estDoublon = TRUE;
			}
		}

		return $estDoublon;
	}

}
?>