<?php
class ExporterFiche extends Base_Controller {
	
	private $disq = array();
	private $tit = array();
	
	function __construct()
    {
        parent::__construct();
 		date_default_timezone_set("Europe/Paris");
		$this->load->model("parametre_model", "paramManager");
		$this->load->model("exporter_model", "exportManager");
        // Here you should add some sort of user validation
        // to prevent strangers from pulling your table data
    }
 
    function index($g_nb_disques = 1, $affichage = 0) {
		$this->auth->restrict('Wave.Exporter.Disque');
			
		// Chargement des ressources
		$this -> load -> library('layout');
		$this -> load -> model('index/Info_Disque_Model');
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
			$id = $this->input->post('choix');
			
			$tabs = $this -> Info_Disque_Model -> GetAll_in($id);

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
    
    
   
	public function xls($id = '')
	{
		$this->auth->restrict('Wave.Exporter.Disque');
		$this->load->model("exporter_model", "exportManager");
		$this->load->model("parametre_model", "paramManager");
		$this->output->enable_profiler(FALSE);
		date_default_timezone_set("Europe/Paris");
	   	
	   	$table_name = 'Disque';
	    //$query = $this->db->get($table_name);
	    /*$query = $this->createQueryBuilder('d')
					->join('d.Artiste', 'a')
					->getQuery();
		$result = $query->getResult();*/
		
		$query = $this->exportManager->select_export($this->input->post('choix'));
        //var_dump($query->result());
        if(!$query)
            return false;
 		//return false;
        // Starting the PHPExcel library
        $this->load->library('Excel');
        //$this->load->library('PHPExcel/IOFactory');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        // Field names in the first row
		$column = array('Titre', 'Artiste', 'Diffuseur', 'Format', 'Emplacement', 'Date d\'ajout', 'Ecouté par', 'Mail diffuseur', 'Emission Bénévole', 'Style');
        $fields = array('dis_libelle', 'art_nom', 'per_nom', 'dis_format', 'emp_libelle', 'dis_date_ajout', 'uti_login', 'dif_mail', 'emb_libelle', 'sty_libelle');
		$r = $this->paramManager->select('colonnes');
		$i = 1;
		if(!empty($r['param_valeur'])){
			$colonne = explode(";", $r['param_valeur']);
			foreach ($colonne as $colo) {
				array_push($column, $colo);
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
        foreach($query->result() as $data)
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

	public function csv()
	{
		$this->output->enable_profiler(FALSE);
		$this->auth->restrict('Wave.Exporter.Disque');
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="BeaubFm_'.date('dMy').'.csv"');
			
		$query = $this->exportManager->select_export($this->input->post('choix'));
		
		$disq = $query->result();
		
        for($i=0 ; $i<count($disq) ; $i++)
			$disq[$i] = (array)$disq[$i];
        
        if(!$query)
            return false;
		
		$s = "Titre;Artiste;Diffuseur;Format;Ecouté par;Date d'ajout;Mail diffuseur;Emplacement;Emission Bénévole;Style;";
		$column = array('Titre', 'Artiste', 'Diffuseur', 'Format', 'Emplacement', 'Date d\'ajout', 'Ecouté par', 'Mail diffuseur', 'Emission Bénévole', 'Style');
        $fields = array('dis_libelle', 'art_nom', 'per_nom', 'dis_format', 'emp_libelle', 'dis_date_ajout', 'uti_login', 'dif_mail', 'emb_libelle', 'sty_libelle');
		
		$r = $this->paramManager->select('colonnes');
		$s .= $r['param_valeur']."\r\n";
		print $s;
		
		$i = 1;
		if(!empty($r['param_valeur'])){
			$colonne = explode(";", $r['param_valeur']);
			foreach ($colonne as $colo) {
				array_push($column, $colo);
				array_push($fields, 'col'.$i);
				$i++;
			}
		}
		$datas = array();
		
		foreach($disq as $d){
			$o = array();
			for($j=0 ; $j<count($fields) ; $j++)
			{
				$o += array($column[$j] => $d[$fields[$j]]);
			}
			array_push($datas, $o);
		}
		
		$i = 0;

		foreach ($datas as $data) {
			print implode(';', $data)."\r\n";
		}
		
	}
}