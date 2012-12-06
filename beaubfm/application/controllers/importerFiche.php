<?php
require_once 'disque.php';

class ImporterFiche extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> library('upload');
		date_default_timezone_set("Europe/Paris");
		$this -> load -> library('excel');
		$this -> load -> model('importer/importer_model', 'importerManager');
	}

	public function index() {
		$this -> load -> library('layout');
		$this -> layout -> views('menu_principal') -> view('importer');
	}

	public function envoi() {
		//On déclare ici le nombre de fichier possible à uploader depuis la vue
		$nombreFichier = array('1', '2', '3', '4', '5', '6', '7');

		//Pour chaque fichier qu'on peut uploader on test si il existe et s'il possède la bonne extension
		foreach ($nombreFichier as $i) {

			//Si le fichier existe on initialise la config
			if (!empty($_FILES['fichier_' . $i]['name'])) {

				//Le nom sera du type "login_fichier_NUMFICHIER"
				$config['file_name'] = $this -> user['uti_login'] . '_fichier_' . $i;
				$config['upload_path'] = './assets/upload';

				//Les extensions acceptées sont les suivantes
				$config['allowed_types'] = 'csv|xls|xlsx';
				$config['max_size'] = '2048';
				$config['overwrite'] = TRUE;
				$this -> upload -> initialize($config);
				$form_name = 'fichier_' . $i;

				//Si l'upload ne fonctionne pas
				if (!$this -> upload -> do_upload($form_name)) {
					//Pour tester le type du fichier
					//$dataTest=$this->upload->data();
					//var_dump($dataTest['file_type']);
					
					//On récupère l'erreur					
					$data['erreur'][$i] = str_replace(array('<p>', '</p>'), "", "Fichier " . $i . " : " . $this -> upload -> display_errors() . " Fichier autorisé : XLS, XLSX, CSV.");
				} else {
					//Sinon on récupère les informations de l'upload
					$data[$i] = array('upload_data' => $this -> upload -> data());
					
					//Pour tester le type du fichier
					//var_dump($data[$i]['upload_data']['file_type']);
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
				unlink($data[$i]['upload_data']['full_path']);
				$arrayDisqueEpure = $this -> getTabFinal($arrayFichier);
				$msgValide = $this -> ctrlTableauFinal($arrayDisqueEpure);
				if ($msgValide === TRUE) {
					$msgRetour = $this -> ctrlAjoutFiche($arrayDisqueEpure);
					$data['reussi'][$i] = "Fichier " . $i . " : " . $msgRetour['reussi'];
					if ($msgRetour['erreur'] !== null) {
						$data['erreur'][$i] = "Fichier" . $i . " : " . $msgRetour['erreur'];
					}
				} else {
					$data['erreur'][$i] = "Fichier" . $i . " : Le fichier est illisible, il lui manque une colonne ou il n'est pas compatible.";
				}
			}
		}

		//On recharge la vue et on affiche les éventuels messages d'erreurs
		parent::__construct();
		$this -> load -> library('layout');
		$this -> layout -> views('menu_principal') -> view('importer', $data);
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
					$arrayEpure[$i][$listeKeysFinal[$j]] = utf8_decode($arrayFichier[$i][$keys[$libelleKeys]]);
				}
				$j++;
			}
		}
		return $arrayEpure;
	}

	public function ctrlTableauFinal($arrayDisque) {
		$valide = TRUE;
		$i = 0;
		$listeKeysCommunes = array("Titre", "Artiste", "Diffuseur", "Format", "Emplacement", "DateAjout", "EcoutePar", "Mail");
		$keys = array_keys($arrayDisque[1]);
		foreach ($listeKeysCommunes as $key) {
			if ($key !== $keys[$i]) {
				$valide = FALSE;
			}
			$i++;
		}
		return $valide;
	}

	public function ctrlAjoutFiche($array) {
		$invalide = 0;
		$doublon = 0;
		$valide = 0;
		$enAttente = 0;
		$dejaEnAttente = 0;
		$nb = 0;
		$nbErreur = null;

		//$array = tableau recensant tous les albums / $i = ligne / $album = tableau contenant informations propres � chaque album
		foreach ($array as $i => $album) {
			$nb++;
			$this -> db -> trans_begin();
			try {
				$result = $this -> verificationAlbum($album);
				$this -> db -> trans_commit();
				if (!$result['valide']) {
					$invalide++;
				}
				if ($result['doublon']) {
					$doublon++;
				}
				if (!$result['doublon'] && $result['valide']) {
					$valide++;
				}
				if ($result['enAttente']) {
					$enAttente++;
				}
				if ($result['dejaEnAttente']) {
					$dejaEnAttente++;
				}
			} catch(Exception $e) {
				$this -> db -> trans_rollback();
				$nbErreur[] = $nb;
			}

		}
		$msgOk = "Sur <b>$nb</b> album(s) <b>testé(s)</b> :<br/>
				<b>$valide valide(s)</b>, ajouté(s) en base.<br/>
				<b>$invalide invalide(s)</b> dont :<br/>
				<b>$doublon doublon(s)</b> déjà rentré(s) en base<br/>
				<b>$enAttente</b> mis <b>en attente</b><br/>
				<b>$dejaEnAttente déjà</b> mis <b>en attente</b>.";

		$msgNonOk = null;
		if ($nbErreur !== null) {
			foreach ($nbErreur as $nb) {
				$msgNonOk = $msgNonOK . "<b>Problème de lecture</b> de la ligne <b>$nb</b>. Cette ligne a été ignorée.<br/>";
			}
		}

		return array('reussi' => $msgOk, 'erreur' => $msgNonOk);
	}

	public function verificationAlbum($disque) {
		$disqueControlleur = new Disque();
		$valide = TRUE;
		$doublon = FALSE;

		//on vérifie si les champs obligatoires sont renseignés
		if (is_null($disque['Artiste']) || is_null($disque['Titre']) || is_null($disque['Diffuseur']) || is_null($disque['Emplacement']) || str_replace(array("/", "!", "?", '"'), "", $disque['Artiste']) == "" || str_replace(array("/", "!", "?", '"'), "", $disque['Diffuseur']) == "") {
			$valide = FALSE;
		} else {
			$search = array('@[éèêëÊË]@i', '@[àâäÂÄ]@i', '@[îïÎÏ]@i', '@[ûùüÛÜ]@i', '@[ôöÔÖ]@i', '@[ç]@i', '@[^a-zA-Z0-9 -_]@');
			$replace = array('e', 'a', 'i', 'u', 'o', 'c', '');
			$disque['Artiste'] = preg_replace($search, $replace, $disque['Artiste']);
			$disque['Diffuseur'] = preg_replace($search, $replace, $disque['Diffuseur']);
			$disque['Titre'] = preg_replace($search, $replace, $disque['Titre']);
			//Insertion de valeurs par défaut sur certains champs non renseignés

			//Format
			if (is_null($disque['Format']) || !$disqueControlleur -> verificationFormat($disque['Format'])) {
				$format = "CD";
			} else {
				$format = $disque['Format'];
			}

			//Mail
			if (!empty($disque['Mail']) && !preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i", $disque['Mail'])) {
				$mail = null;
			} else {
				$mail = $disque['Mail'];
			}

			//Cas d'un fichier exporté depuis gcstar
			if (!isset($disque['EmissionBenevole'])) {
				$style = null;

				//Catégorie
				$cat_id = 3;
				if (strstr(strtolower($disque['Diffuseur']), "auto")) {
					if (strstr(strtolower($disque['Diffuseur']), "prod")) {
						$cat_id = 5;
					}
				}

				//Emplacement & EmissionBenevole
				$valEmp = strtolower($disque['Emplacement']);
				$emb_id = null;
				$emp_id = null;
				try {
					$emp_id = $disqueControlleur -> rechercheEmplacementByNom($valEmp);
				} catch (Exception $e) {
					if (strlen($valEmp) > 0) {
						if ((substr_compare($valEmp, "arch", 0, 4)) == 0) {
							$emp_id = 2;

							if (strstr($valEmp, "rouge")) {
								$style = "rouge";
							} else if (strstr($valEmp, "jaune")) {
								$style = "jaune";
							} else if (strstr($valEmp, "blanc")) {
								$style = "blanc";
							} else if (strstr($valEmp, "vert")) {
								$style = "vert";
							} else if (strstr($valEmp, "bleu")) {
								$style = "bleu";
							} else {
								$valide = FALSE;
							}
						}
					} else {
						$emp_id = 4;
						try {
							$emb_id = $disqueControlleur -> rechercheEmBevByNom($valEmp);
						} catch (Exception $e) {
							$valide = FALSE;
						}
					}

					//Style
					if (!empty($style)) {
						try {
							$style_id = $disqueControlleur -> rechercherStyleByNom($style);
						} catch (Exception $e) {
							$valide = FALSE;
						}
					}
				}
				if ($emp_id == null) {
					$valide = FALSE;
				}

			} else {
				//Dans le cas ou le fichier vient de notre base

				//Catégorie
				if ($disque['Diffuseur'] === $disque['Artiste']) {
					$cat_id = 5;
				} else {
					$cat_id = 3;
				}

				//Emplacement
				try {
					$emp_id = $disqueControlleur -> rechercheEmplacementByNom($disque['Emplacement']);
				} catch (Exception $e) {
					$valide = FALSE;
				}

				//Emission Bénévole
				if (!empty($emp_id)) {
					if ($emp_id === 4) {
						try {
							$emb_id = $disqueControlleur -> rechercheEmBevByNom($disque['EmissionBenevole']);
						} catch (Exception $e) {
							$valide = FALSE;
						}
					} else {
						$emb_id = null;
					}
				} else {
					$valide = FALSE;
				}

				//Style
				if (empty($disque['Style'])) {
					$style_id = null;
				} else {
					try {
						$style_id = $disqueControlleur -> rechercherStyleByNom($disque['Style']);
					} catch (Exception $e) {
						$style_id = null;
					}
				}

			}

			//Titre
			$titre = $disque['Titre'];

			//Artiste
			$art_id = $disqueControlleur -> rechercheArtisteByNom($disque['Artiste'], $this -> user['rad_id'], $cat_id);

			if (!$disqueControlleur -> existeTitreArtiste($disque['Titre'], $art_id)) {
				$this -> db -> trans_begin();
				try {

					//Diffuseur
					if ($cat_id === 5) {
						$dif_id = $disqueControlleur -> rechercheDiffuseurByNom($disque['Artiste'], $this -> user['rad_id'], $mail, $cat_id);
					} else {
						$dif_id = $disqueControlleur -> rechercheDiffuseurByNom($disque['Diffuseur'], $this -> user['rad_id'], $mail, 4);
					}

					//EcoutePar
					try {
						$ecoute_id = $disqueControlleur -> rechercherEcouteParByNom($disque['EcoutePar']);
					} catch (Exception $e) {
						$ecoute_id = $this -> user['per_id'];
					}
					$this -> db -> trans_commit();
				} catch(Exception $e) {
					$this -> db -> trans_rollback();
					$valide = FALSE;
				}
			} else {
				$valide = FALSE;
				$doublon = TRUE;
			}

			if ($valide === TRUE && $doublon === FALSE) {
				$disqueControlleur -> set_dis_libelle($titre);
				$disqueControlleur -> set_dis_format($format);
				$disqueControlleur -> set_mem_id($ecoute_id);
				$disqueControlleur -> set_art_id($art_id);
				$disqueControlleur -> set_dif_id($dif_id);
				$disqueControlleur -> set_dis_envoi_ok(TRUE);
				$disqueControlleur -> set_emp_id($emp_id);
				$disqueControlleur -> set_emb_id($emb_id);

				try {
					$disqueControlleur -> addBDD();
				} catch (Exception $e) {
					$e -> getMessage();
				}

			}
		}

		//A enlever quand Valentin mettra les styles dans l'export//
		$disque['Style'] = null;

		$dejaEnAttente = FALSE;
		$enAttente = FALSE;

		$testDoublonImport = $this -> importerManager -> existImport($disque['Titre'], $disque['Artiste'], $disque['Diffuseur']);

		if ($valide === FALSE && $doublon === FALSE && empty($testDoublonImport)) {
			//Cas d'un fichier exporté depuis gcstar
			if (!isset($disque['EmissionBenevole'])) {
				$enAttente = TRUE;
				$this -> importerManager -> ajoutDisqueImport($disque['Titre'], $disque['Format'], $disque['EcoutePar'], $disque['DateAjout'], $disque['Artiste'], $disque['Diffuseur'], $disque['Mail'], $disque['Emplacement'], $this -> user['per_id'], null, null);
			} else {
				$enAttente = TRUE;
				$this -> importerManager -> ajoutDisqueImport($disque['Titre'], $disque['Format'], $disque['EcoutePar'], $disque['DateAjout'], $disque['Artiste'], $disque['Diffuseur'], $disque['Mail'], $disque['Emplacement'], $this -> user['per_id'], $disque['Style'], $disque['EmissionBenevole']);
			}
		} else {
			if ($doublon === FALSE && $valide === FALSE) {
				$dejaEnAttente = TRUE;
			}
		}
		return array('valide' => $valide, 'doublon' => $doublon, 'enAttente' => $enAttente, 'dejaEnAttente' => $dejaEnAttente);
	}

}
?>