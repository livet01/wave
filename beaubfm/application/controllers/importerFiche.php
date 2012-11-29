<?php
class ImporterFiche extends MY_Controller {
	private $msgError = "";

	public function __construct() {
		parent::__construct();
		$this -> load -> library('upload');
		date_default_timezone_set("Europe/Paris");
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
				$config['allowed_types'] = 'csv|xml|xls|xlsx';
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

		//Pour chaque fichier téléchargé on récupère le type du fichier pour charger la bonne librairie
		foreach ($nombreFichier as $i) {
			if (isset($data[$i])) {
				if ($data[$i]['upload_data']['file_ext'] == '.csv') {
					$arrayFichier = $this -> csvFile($data[$i]);
				}
				if ($data[$i]['upload_data']['file_ext'] == '.xls' || $data[$i]['upload_data']['file_ext'] == '.xlsx') {
					$arrayFichier = $this -> excelFile($data[$i]);
				}
				if ($data[$i]['upload_data']['file_ext'] == '.xml') {
					$arrayFichier = $this -> xmlFile($data[$i]);
				}
				$arrayDisqueEpure = $this -> getTabFinal($arrayFichier);
				$this -> ctrlAjoutFiche($arrayDisqueEpure);
			}
		}

		//On recharge l'index et on affiche les éventuels messages d'erreurs
		$this -> index();
	}

	public function excelFile($data) {
		//On instancie un objet PHPExcel
		$objPHPExcel = new PHPExcel();

		//On charge le fichier excel correspondant à l'appel de la fonction
		$objPHPExcel = PHPExcel_IOFactory::load($data['upload_data']['full_path']);

		//On le change en tableau et on le renvoie
		return $objPHPExcel -> getSheet() -> toArray();
	}

	public function xmlFile($data) {
	}

	public function csvFile($data) {
		//On charge le fichier CSV selon plusieurs critères avec comme délimiteur ";"
		$objReader = PHPExcel_IOFactory::createReader('CSV') -> setDelimiter(';') -> setLineEnding("\r\n") -> setSheetIndex(0);

		//On charge le fichier CSV correspondant à l'appel de la fonction
		$objPHPExcel = $objReader -> load($data['upload_data']['full_path']);

		//On le change en tableau et on le renvoie
		return $objPHPExcel -> getSheet() -> toArray();
	}

	/**
	 *	Retourne un tableau épuré contenant que les informations nécessaires à l'ajout d'un disque en base
	 *	Le tableau de retour contient une colonne Emission Bénévole si le fichier provient de notre base,
	 *	et pas de colonne Emission Bénévole s'il provient de la base de gcstar.
	 *
	 *	Si il manque un champ dans le fichier uploadé, la colonne sera ignoré et le tableau retourné ne la
	 *	contiendra pas
	 *
	 * Le tableau retourné possède comme index les valeurs de l'array $listeKeysFinal
	 */
	public function getTabFinal($arrayFichier) {
		//liste de clés utilisées pour le tableau de retour
		$listeKeysFinal = array("Titre", "Artiste", "Diffuseur", "Format", "Emplacement", "DateAjout", "EcoutePar", "Mail", "EmissionBenevole", "Style");

		//on initialise les clés de recherche dans le fichier
		//les clés suivantes sont identiques aux deux fichiers
		$keyTitre = "Titre";
		$keyArtiste = "Artiste";
		$keyFormat = "Format";
		$keyEmplacement = "Emplacement";
		$keyDateAjout = "Date d'ajout";

		//si on trouve diffuseur l'export provient de notre base
		if (array_search("Diffuseur", $arrayFichier[0])) {
			$keyDiffuseur = "Diffuseur";
			$keyEcoutePar = "Ecouté par";
			$keyMail = "Mail diffuseur";
			$keyEmBev = "Emission Bénévole";
			$keyGenre = "Style";
			$listeKeys = array($keyTitre, $keyArtiste, $keyDiffuseur, $keyFormat, $keyEmplacement, $keyDateAjout, $keyEcoutePar, $keyMail, $keyEmBev, $keyGenre);
			//sinon il provient de la base de gcstar
		} else {
			$keyDiffuseur = "Label";
			$keyEcoutePar = "Ecoute par";
			$keyMail = "email label";
			$listeKeys = array($keyTitre, $keyArtiste, $keyDiffuseur, $keyFormat, $keyEmplacement, $keyDateAjout, $keyEcoutePar, $keyMail);
		}

		//On constitue un tableau associant chaque ligne d'un album avec toutes les informations le concernant
		foreach ($listeKeys as $libelleKeys) {
			$keys[$libelleKeys] = array_search($libelleKeys, $arrayFichier[0]);
		}

		$longueurArray = count($arrayFichier) - 1;
		for ($i = 1; $i <= $longueurArray; $i++) {
			$j = 0;
			foreach ($listeKeys as $libelleKeys) {
				if ($keys[$libelleKeys] !== false) {
					$arrayEpure[$i][$listeKeysFinal[$j]] = $arrayFichier[$i][$keys[$libelleKeys]];
				}
				$j++;
			}
		}
		var_dump($arrayEpure);
		return $arrayEpure;
	}

	public function ctrlAjoutFiche($array) {
		$inv = 0;
		$nb = 0;

		//$array = tableau recensant tous les albums / $i = ligne / $album = tableau contenant informations propres � chaque album
		foreach ($array as $i => $album) {
			$nb++;
			$peutAjouter = $this -> verificationAlbum($album);
			if (!$peutAjouter) {
				$inv++;
			}
		}
		echo "$inv album(s) invalides ! ... sur $i album(s) testés";
	}

	public function verificationAlbum($disque) {
		$disqueControlleur = new Disque();
		$valide = TRUE;

		//on v�rifie si les champs sont renseignés
		if (is_null($disque['Artiste']) || is_null($disque['Titre']) || is_null($disque['Diffuseur']) || is_null($disque['Emplacement'])) {
			$valide = FALSE;
		} else {
			if ($disqueControlleur -> testDoublon()) {
				$valide = FALSE;
			} else {
				//Insertion de valeurs par d�faut sur certains champs non renseignés
				
				//Format
				if (is_null($disque['Format']) || !$disqueControlleur -> verificationFormat($disque['Format'])) {
					$disque['Format'] = "CD";
				}
				
				//EcoutePar
				$idEcoutePar = $disqueControlleur -> rechercheEcoutePar($disque['EcoutePar']);

				if (!is_null($disque['EcoutePar']) && !empty($idEcoutePar)) {
					$disque['EcoutePar'] = $idEcoutePar;
				} else {
					$disque['EcoutePar'] = 0;
				}
				
				//Artiste
				$chVerifAUtoProd = strtolower($disque['Diffuseur']);
				$catId = 3;
				
				if (strstr($chVerifAUtoProd, "auto")) {
					if (strstr($chVerifAUtoProd, "prod"))
						$catId = 5;
				}
				$idArt = $disqueControlleur -> rechercheArtisteByNom($disque['Artiste'], $catId);
				
				if ($disque -> existeTitreArtiste($disque['Titre'], $idArt)) {
					$valide = FALSE;
				}
				
				//Emplacement & EmissionBenevole
				if (!empty($disque['EmissionBenevole'])) {
						
					$valEmp = strtolower($disque['Emplacement']);
					$empId;
					$genre;
					$embId;
						
					if ((strcmp($valEmp, "airplay")) == 0) {
						$empId = 1;
					}
					else if ((substr_compare($valEmp, "arch", 0, 4)) == 0) {
						$empId = 2;
						
						if (strstr($valEmp, "rouge")) {
							$genre = "rouge";
						} else if (strstr($valEmp, "jaune")) {
							$genre = "jaune";
						} else if (strstr($valEmp, "blanc")) {
							$genre = "blanc";
						} else if (strstr($valEmp, "vert")) {
							$genre = "vert";
						} else if (strstr($valEmp, "bleu")) {
							$genre = "bleu";
						} else {
							$valide = FALSE;
						}
					} else {
						$empId = 4;
						
						$embId = $disqueControlleur -> rechercheEmbByNom($disque['EmissionBenevole'],1);
					}
					
					genreId;
					try {
						$genreId = $disqueControlleur -> rechercherStyleByNom($genre);
					} catch (Exception $e) {
						echo "Exception re�ue : ", $e->getMessage(), "\n";
					}
					$disque['Emplacement'] = $empId;
					if ($genreId != null) 
						$disque['Style'] = $genreId;
					$disque['EmissionBenevole'] = $embId;
				}
				
				if ($valide == TRUE) {

				}
			}

		}
		return $valide;
	}

}
?>