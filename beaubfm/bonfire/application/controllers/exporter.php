<?php
class Exporter extends Base_Controller {
	
	
	function __construct()
    {
        parent::__construct();
 		// Chargement des ressources
		$this -> load -> model('index/Info_Disque_Model');
		$this->load->model("exporter_model", "exportManager");
		date_default_timezone_set("Europe/Paris");
		$this->output->enable_profiler(FALSE);
        // Here you should add some sort of user validation
        // to prevent strangers from pulling your table data
    }
 
    function index($g_nb_disques = 1, $affichage = 0) {
		$this->auth->restrict('Wave.Exporter.Disque');
		
		// Récupération de tout les disques pour la page
		$id = $this->input->post('choix');
		$tabs = $this -> Info_Disque_Model -> GetAll_in($id);
		
		if(!empty($tabs))
		{
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

				// On parcours le tableau, si emb_id n'existe pas on le met à nul et on ajoute chaque disque dans le tableau tab_result.
				foreach ($tabs as $tab) {
					if (empty($tab -> emb_id))
						$emb_id = null;
					else {
						$emb_id = $tab -> emb_id;
					}
					$tab_result[] = array("dis_id" => $tab -> dis_id, "dis_libelle" => $tab -> dis_libelle, "mem_nom" => $tab -> mem_nom, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom);
				}
	
				// On passe le tableau de disque
				$data['resultat'] = $tab_result;
			}
	
			// On passe la valeur d'affichage (sélectionne dans la vue les mode à afficher : erreur, résultat recherche, vue général)
			$data['affichage'] = $affichage;
			$data['liens'][0] = array("id" => "linkCSV", "icon" => "icon-download-alt", "text" => " Exporter en CSV", "href" => "#");
			$data['liens'][1] = array("id" => "linkXLS", "icon" => "icon-download-alt", "text" => " Exporter en XLS", "href" => "#");
			$data['liens'][2] = array("id" => "", "icon" => "icon-repeat", "text" => " Annuler", "href" => site_url("index/"));
			$data['form_id'] = "exportdisque";
			// Chargement de la vue
			Assets::add_js(js_url("exporter"));
			Assets::add_js(js_url("pagination"));
			Template::set('data',$data);
			Template::set_view('confirmation');
			Template::render();
		}
		else
		{
			Template::set_message("Il y a aucun disques à exporter !", 'error');
			Template::redirect("index");
		}
	}
    
    
   
	public function xls($id = '')
	{
		$this->auth->restrict('Wave.Exporter.Disque');
		
		$choix = $this->input->post('choix');
		
		if(!empty($choix))
		{
	        // Starting the PHPExcel library
	        $this->load->library('Excel');
	
	        $objPHPExcel = new PHPExcel();
	        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
	 
	        $objPHPExcel->setActiveSheetIndex(0);
	 
	        // Field names in the first row
			$column = array('Titre', 'Artiste', 'Diffuseur', 'Format', 'Ecouté par', 'Date d\'ajout', 'Mail diffuseur','Emplacement', 'Emission Bénévole', 'Style');
	        $fields = array('dis_libelle', 'art_nom', 'per_nom', 'dis_format', 'uti_login', 'dis_date_ajout', 'dif_mail', 'emp_libelle', 'emb_libelle', 'sty_libelle');
			
			$query = $this->exportManager->select_export($choix);
			$param = $this->exportManager->select_param();
			
			$i = 1;
			if(!empty($param))
			{
				$champsup = explode(';', $param['param_valeur']);
				foreach ($champsup as $champs) {
					array_push($column, $champs);
					array_push($fields, 'col'.$i);
					$i++;
				}
			}
			
			$col = 0;
	        foreach ($column as $field)
	        {
	           	//var_dump($field);
				//var_dump($col);
	           	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
	            $col++;
	        }
			
	        // Fetching the table data
	        $row = 2;
	        foreach($query as $data)
	        {
	           	//var_dump($data);
	            $col = 0;
	            foreach ($fields as $field)
	            {
	               	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
	                $col++;
	            }
	 
	            $row++;
	        }
	 
	        $objPHPExcel->setActiveSheetIndex(0);
	 		
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	 		
	        // Sending headers to force the user to download the file
	        header('Content-Type: application/ms-excel');
	        header('Content-Disposition: attachment; filename="BeaubFm_'.date('dMy').'.xls"');
	 		
	        $objWriter->save('php://output');
		}
		else
		{
			Template::redirect("index");
		}
	}

	public function csv()
	{
		$this->auth->restrict('Wave.Exporter.Disque');
		
		$choix = $this->input->post('choix');
		
		if(!empty($choix))
		{
			header('Content-Type: text/csv;');
			header('Content-Disposition: attachment; filename="BeaubFm_'.date('dMy').'.csv"');
			
			// Récupération des disques selectionnés et des paramètres 
			$query = $this->exportManager->select_export($choix);
			$param = $this->exportManager->select_param();
			
			// Transformation des "stdClass" en "keys"
			for($i=0 ; $i<count($query) ; $i++)
				$query[$i] = (array)$query[$i];
						
			// Entête par défaut
			$enTete = "Titre;Artiste;Diffuseur;Format;Ecouté par;Date d'ajout;Mail diffuseur;Emplacement;Emission Bénévole;Style";
	
			$column = array('Titre', 'Artiste', 'Diffuseur', 'Format', 'Emplacement', 'Date d\'ajout', 'Ecouté par', 'Mail diffuseur', 'Emission Bénévole', 'Style');
	        $fields = array('dis_libelle', 'art_nom', 'per_nom', 'dis_format', 'uti_login', 'dis_date_ajout', 'dif_mail', 'emp_libelle', 'emb_libelle', 'sty_libelle');
			
			//Rajout des colonnes supplémentaire s'il existe des paramètres
			$i = 1;
			if(!empty($param['param_valeur']))
			{
				$enTete .= ";".$param['param_valeur'];
				$champsup = explode(';', $param['param_valeur']);
				foreach ($champsup as $champs) {
					array_push($column, $champs);
					array_push($fields, 'col'.$i);
					$i++;
				}
			}
			
			$enTete .= "\r\n";
			
			print $enTete;
			
			$datas = array();
			foreach($query as $disqueC){
				$disqueK = array();
				for($j=0 ; $j<count($fields) ; $j++)
				{
					$disqueK += array($column[$j] => $disqueC[$fields[$j]]);
				}
				array_push($datas, $disqueK);
			}
			
			foreach ($datas as $data) {
				print implode(';', $data)."\r\n";
			}
		}
		else
		{
			Template::redirect("index");
		}
	}
 
}