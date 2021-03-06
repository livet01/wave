<?php
require_once 'disque.php';

class Importer extends Authenticated_Controller{

	public function __construct() {
		parent::__construct();
		$this -> load -> library('upload');
		date_default_timezone_set("Europe/Paris");
		$this -> load -> library('excel');
		$this -> load -> model('importer/importer_model', 'importerManager');
	}

	public function index() {
		$this->auth->restrict('Wave.Importer.Disque');
		Template::set_view('importer');
		Template::render();
	}

	private function name_file($extension,$i = 1) {
		if(file_exists('./assets/upload/'.$this->current_user->username . '_fichier_'.$i.$extension))
			return $this->name_file($extension,$i+1);
		else
			return $this->current_user->username . '_fichier_'.$i;
	}
	public function envoi() {
		$this->auth->restrict('Wave.Importer.Disque');
		$this->output->enable_profiler(FALSE);
		//Si le fichier existe on initialise la config
		if (!empty($_FILES['file']['name'])) {
			$extension = strrchr($_FILES['file']['name'],'.');
			//Le nom sera du type "login_fichier_NUMFICHIER"
			$config['file_name'] = $this->name_file($extension);
			$config['upload_path'] = './assets/upload/';

			//Les extensions acceptées sont les suivantes
			$config['allowed_types'] = 'csv|xls|xlsx';
			$config['max_size'] = '2048';
			$config['overwrite'] = TRUE;
			$this -> upload -> initialize($config);
			
				
			//Si l'upload ne fonctionne pas
			if (!$this -> upload -> do_upload("file")) {
				//Pour tester le type du fichier
				//$dataTest=$this->upload->data();
				//var_dump('ali',$dataTest['file_type']);
				//exit();
				//On récupère l'erreur		
				$json = array("error"=> true, "message"=>'Fichier ' . $_FILES['file']['name'] . ' : ' . $this -> upload -> display_errors('',''));
							
				
			} else {
				
				if ($extension == '.csv') {
					$arrayFichier = $this -> csvFile($config['upload_path'].$config['file_name'].$extension);
				}
				else if ($extension == '.xls' || $extension == '.xlsx') {
					$arrayFichier = $this -> excelFile($config['upload_path'].$config['file_name'].$extension);
				}
				else {
					$arrayFichier = array();
				}
				//Sinon on récupère les informations de l'upload
				$json = array("error"=> false,"name"=>$config['file_name'].$extension,"nombre"=>count($arrayFichier)-1);
				
				//Pour tester le type du fichier
				//var_dump($data[$i]['upload_data']['file_type']);
			}
		 	die(json_encode($json));
		}
		else
			redirect('importer');
	}

	public function traitement($nameFile) {		
		if(empty($nameFile)) {
			redirect('importer');
			exit();
		}

		$extension = strrchr($nameFile,'.');
		$chemin = './assets/upload/'.$nameFile;
		//Pour chaque fichier téléchargé on récupère le type du fichier pour charger la bonne librairie

		if (isset($extension)) {
			if ($extension == '.csv') {
				$arrayFichier = $this -> csvFile($chemin);
			}
			if ($extension == '.xls' || $extension == '.xlsx') {
				$arrayFichier = $this -> excelFile($chemin);
			}
			unlink($chemin);
			
			$arrayDisqueEpure = $this -> getTabFinal($arrayFichier);
			$msgValide = $this -> ctrlTableauFinal($arrayDisqueEpure);
			if ($msgValide === TRUE) {
				$msgRetour = $this -> ctrlAjoutFiche($arrayDisqueEpure);
				if ($msgRetour['erreur'] !== null) {
					die(json_encode(array("error"=>true,"message"=>$msgRetour['erreur'])));
				}
				else
					die(json_encode(array("error"=>false,"message"=>$msgRetour['reussi'])));
					
			} else {
				die(json_encode(array("error"=>true,"message"=>"Le fichier est illisible, il lui manque une colonne ou il n'est pas compatible.")));
			}
		}
	}

	public function excelFile($data) {
		$this->auth->restrict('Wave.Importer.Disque');
		//On instancie un objet PHPExcel
		$objPHPExcel = new PHPExcel();

		//On charge le fichier excel correspondant à l'appel de la fonction
		$objPHPExcel = PHPExcel_IOFactory::load($data);

		//On le change en tableau et on le renvoie
		return $objPHPExcel -> getSheet() -> toArray();
	}

	public function csvFile($data) {
		//On charge le fichier CSV selon plusieurs critères avec comme délimiteur ";"
		$objReader = PHPExcel_IOFactory::createReader('CSV') -> setDelimiter(';') -> setLineEnding("\r\n") -> setSheetIndex(0);

		//On charge le fichier CSV correspondant à l'appel de la fonction
		$objPHPExcel = $objReader -> load($data);

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
		$this->auth->restrict('Wave.Importer.Disque');
		
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
			
			// Chargement des colonnes supplémentaires en base			
			$this -> load -> model('parametre_model', 'parametreManager');
			$colonnes=$this -> parametreManager->select('colonnes');
			if($colonnes['param_valeur']!=''){
				$colonnes=explode(";", $colonnes['param_valeur']);
				foreach($colonnes as $colonne) {
					array_push($listeKeys,$colonne);
					array_push($listeKeysFinal,$colonne);
				}
			}
				
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
		$arrayEpure=null;
		$longueurArray = count($arrayFichier) - 1;
		for ($i = 1; $i <= $longueurArray; $i++) {
			$j = 0;
			foreach ($listeKeys as $libelleKeys) {
				if ($keys[$libelleKeys] !== false) {
					$arrayEpure[$i][$listeKeysFinal[$j]] = ucwords(strtolower(utf8_decode($arrayFichier[$i][$keys[$libelleKeys]])));
				}
				$j++;
			}
		}
		
		return $arrayEpure;
	}

	public function ctrlTableauFinal($arrayDisque) {
		$this->auth->restrict('Wave.Importer.Disque');
		$valide = TRUE;
		$i = 0;
		$listeKeysCommunes = array("Titre", "Artiste", "Diffuseur", "Format", "Emplacement", "DateAjout", "EcoutePar", "Mail");
		$keys=null;
		if($arrayDisque!==null){
			$keys = array_keys($arrayDisque[1]);
		}
		foreach ($listeKeysCommunes as $key) {
			if ($key !== $keys[$i]) {
				$valide = FALSE;
			}
			$i++;
		}
		return $valide;
	}

	public function ctrlAjoutFiche($array) {
		$this->auth->restrict('Wave.Importer.Disque');
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
				<b>$doublon doublon(s)</b> déjà rentré(s) en base.<br/>
				<b>$enAttente</b> mis <b>en attente</b>.<br/>
				<b>$dejaEnAttente déjà</b> mis <b>en attente</b>.";

		$msgNonOk = null;
		if ($nbErreur !== null) {
			foreach ($nbErreur as $nb) {
				$msgNonOk = $msgNonOk . "<b>Problème de lecture</b> de la ligne <b>$nb</b>. Cette ligne a été ignorée.<br/>";
			}
		}

		return array('reussi' => $msgOk, 'erreur' => $msgNonOk);
	}

	public function verificationAlbum($disque) {
		$this->auth->restrict('Wave.Importer.Disque');
		$disqueControlleur = new Disque();
		$valide = TRUE;
		$doublon = FALSE;
		$style_id = null;
		
		//on vérifie si les champs obligatoires sont renseignés
		if (is_null($disque['Artiste']) || is_null($disque['Titre']) || is_null($disque['Diffuseur']) || is_null($disque['Emplacement'])
			|| $disque['Artiste']=="" || $disque['Titre']=="" || $disque['Diffuseur']=="" || $disque['Emplacement']==""
			|| str_replace(array("/", "!", "?", '"', " "), "", $disque['Artiste']) == "" || str_replace(array("/", "!", "?", '"' ," "), "", $disque['Diffuseur']) == ""
			|| str_replace(array("/", "!", "?", '"' ," "), "", $disque['Titre']) == ""){
			$valide = FALSE;
		}
			
			$search = array('@[ÊË]@i', '@[ÂÄ]@i', '@[ÎÏ]@i', '@[ÛÜ]@i', '@[ÔÖ]@i','@[/\s\s+/]@i', '@[_]@i', "@[^éèêëàâäîïûùüôöça-zA-Z0-9 -!?&%#'()]@");
			$replace = array('e', 'a', 'i', 'u', 'o',' ',' ', '');
			$disque['Artiste'] = preg_replace($search, $replace, $disque['Artiste']);
			$disque['Diffuseur'] = preg_replace($search, $replace, $disque['Diffuseur']);
			$disque['Titre'] = preg_replace($search, $replace, $disque['Titre']);
			$disque['Mail'] = strtolower($disque['Mail']);
			//Insertion de valeurs par défaut sur certains champs non renseignés

			//Format
			if (is_null($disque['Format']) || !$disqueControlleur -> verificationFormat($disque['Format'])) {
				$format = "CD";
			} else {
				if($disque['Format']==="Cd"){
					$format="CD";
				} else {
					$format = $disque['Format'];
				}
			}

			//Mail
			if (!empty($disque['Mail']) && !preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i", $disque['Mail'])) {
				$mail = "";
			} else {
				$mail = $disque['Mail'];
			}

			//Cas d'un fichier exporté depuis gcstar
			if (!isset($disque['EmissionBenevole'])) {
				$style=null;
				
				//Catégorie
				$cat_id = 3;
				if (strstr(strtolower($disque['Diffuseur']), "auto")) {
					if (strstr(strtolower($disque['Diffuseur']), "prod")) {
						$cat_id = 5;
					}
				}

				//Emplacement & EmissionBenevole
				if(!is_null($disque['Emplacement']))
				{
					$valEmp = strtolower($disque['Emplacement']);
					$emb_id = null;
					$emp_id = null;
					if($valEmp==='a.d' || $valEmp==='a.d.' || $valEmp==='ad'){
						$emp_id=$disqueControlleur->rechercheEmplacementByNom('Refusé');
					} else {
						try {
							$emp_id = $disqueControlleur -> rechercheEmplacementByNom($valEmp);
						} catch (Exception $e) {
							if (strlen($valEmp) > 0) {
								if ((substr_compare($valEmp, "arch", 0, 4)) == 0) {
									$emp_id = 2;	
									if (strstr($valEmp, "rouge")) {
										$style = "red";
									} else if (strstr($valEmp, "jaune")) {
										$style = "yellow";
									} else if (strstr($valEmp, "blanc")) {
										$style = "white";
									} else if (strstr($valEmp, "vert")) {
										$style = "green";
									} else if (strstr($valEmp, "bleu")) {
										$style = "blue";
									}
								}
							} else {
								$disque['Emplacement'] = NULL;
								$emp_id = 4;
								try {
									$emb_id = $disqueControlleur -> rechercheEmBevByNom($valEmp);
								} catch (Exception $e) {
									$valide = FALSE;
								}
							}
						}
					}
					if ($emp_id == null) {
						$valide = FALSE;
					}
				}
				//Style
				if (!empty($style)) {
					try {
						$style_id = $disqueControlleur -> rechercherStyleByNom($style);
					} catch (Exception $e) {
						$valide = FALSE;
						$style_id = NULL;
					}
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
				$disque['Emplacement']=preg_replace($search, $replace, $disque['Emplacement']);
				
				if($disque['Emplacement']==='Refus' || $disque['Emplacement']==='Refuse'){
					$disque['Emplacement']='Refusé';
				}
								
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
						$style_id = $disqueControlleur -> rechercherStyleByLibelle($disque['Style']);
					} catch (Exception $e) {
						$style_id = null;
					}
				}
			}

			//Titre
			$titre = $disque['Titre'];

			//Artiste
			if($valide!==FALSE){
				$art_id = $disqueControlleur -> rechercheArtisteByNom($disque['Artiste'], $this->current_user->rad_id, $cat_id);		
				if (!$disqueControlleur -> existeTitreArtiste($disque['Titre'], $art_id)) {
					try {
						//Diffuseur
						if ($cat_id === 5) {
							$dif_id = $disqueControlleur -> rechercheDiffuseurByNom($disque['Artiste'], $this->current_user->rad_id, $mail, $cat_id);
						} else {
							$dif_id = $disqueControlleur -> rechercheDiffuseurByNom($disque['Diffuseur'], $this->current_user->rad_id, $mail, 4);
						}
	
						//EcoutePar
						try {
							$ecoute_id = $disqueControlleur -> rechercherEcouteParByNom($disque['EcoutePar']);
						} catch (Exception $e) {
							$ecoute_id = $this->current_user->id;
						}
					} catch(Exception $e) {
						$valide = FALSE;
					}
				} else {
					$valide = FALSE;
					$doublon = TRUE;
				}
			}

			if ($valide === TRUE && $doublon === FALSE) {
				$disqueControlleur -> set_dis_libelle((string)$titre);
				$disqueControlleur -> set_dis_format((string)$format);
				$disqueControlleur -> set_mem_id($ecoute_id);
				$disqueControlleur -> set_art_id($art_id);
				$disqueControlleur -> set_dif_id($dif_id);
				$disqueControlleur -> set_dis_envoi_ok(TRUE);
				$disqueControlleur -> set_emp_id($emp_id);
				$disqueControlleur -> set_emb_id($emb_id);
				$disqueControlleur -> set_sty_id($style_id);
				
				// Chargement des colonnes supplémentaires en base			
				$this -> load -> model('parametre_model', 'parametreManager');
				$colonnes=$this -> parametreManager->select('colonnes');
				if($colonnes['param_valeur']!=''){
					$colonnes=explode(";", $colonnes['param_valeur']);
					$i=1;
					foreach ($colonnes as $colonne) {
						if(isset($disque[$colonne])){
							switch ($i) {
								case 1 :
									$disqueControlleur -> set_col1($disque[$colonne]);
									break;
								case 2 :
									$disqueControlleur -> set_col2($disque[$colonne]);
									break;
								case 3 :
									$disqueControlleur -> set_col3($disque[$colonne]);
									break;
								case 4 :
									$disqueControlleur -> set_col4($disque[$colonne]);
									break;
								case 5 :
									$disqueControlleur -> set_col5($disque[$colonne]);
									break;
								case 6 :
									$disqueControlleur -> set_col6($disque[$colonne]);
									break;
							}
						}
						$i++;
					}
				}
				
				try {
					$disqueControlleur -> addBDD();
				} catch (Exception $e) {
					$e -> getMessage();
				}
			}
			
			$dejaEnAttente = FALSE;
			$enAttente = FALSE;
	
			$testDoublonImport = $this -> importerManager -> existImport($disque['Titre'], $disque['Artiste'], $disque['Diffuseur']);
	
			if ($valide === FALSE && $doublon === FALSE && empty($testDoublonImport)) {
				//Cas d'un fichier exporté depuis gcstar
				if (!isset($disque['EmissionBenevole'])) {
					$enAttente = TRUE;
					$this -> importerManager -> ajoutDisqueImport($disque['Titre'], $disque['Format'], $disque['EcoutePar'], $disque['DateAjout'], $disque['Artiste'], $disque['Diffuseur'], $disque['Mail'], NULL, $this->current_user->id, $style, NULL);
				} else {
					$enAttente = TRUE;
					$this -> importerManager -> ajoutDisqueImport($disque['Titre'], $disque['Format'], $disque['EcoutePar'], $disque['DateAjout'], $disque['Artiste'], $disque['Diffuseur'], $disque['Mail'], NULL, $this->current_user->id, $disque['Style'], $disque['EmissionBenevole']);
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