<?php
class ExporterFiche extends MY_Controller {
	
	
	function __construct()
    {
        parent::__construct();
 
        // Here you should add some sort of user validation
        // to prevent strangers from pulling your table data
    }
 
    function index($g_nb_disques = 1, $affichage = 0) {
			
		// Chargement des ressources
		$this -> load -> library('layout');
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
				$tab_result[] = array("dis_id" => $tab -> dis_id, "dis_libelle" => $tab -> dis_libelle, "dis_format" => $tab -> dis_format, "mem_nom" => $tab -> mem_nom, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom, "emp_libelle" => $tab -> emp_libelle, "emb_id" => $emb_id);
			}

			// On passe le tableau de disque
			$data['resultat'] = $tab_result;
		}

		// On passe la valeur d'affichage (sélectionne dans la vue les mode à afficher : erreur, résultat recherche, vue général)
		$data['affichage'] = $affichage;

		// Chargement de la vue
		$this -> layout -> views('menu_principal')->view('exporter', $data);
		
	}
    
    
    
    
    
    /*$data = '')
    {
		$this -> load -> library('layout');
		$this->load->model('index/Info_Disque_Model');
		$data = $this->input->post();
		
		
		$tabs = $this->Info_Disque_Model->GetAll_in($data['choix']);
		
		foreach ($tabs as $tab) {
				if (empty($tab -> emb_id))
					$emb_id = null;
				else {
					$emb_id = $tab -> emb_id;
				}
				$tab_result[] = array("dis_id" => $tab -> dis_id, "dis_libelle" => $tab -> dis_libelle, "dis_format" => $tab -> dis_format, "mem_nom" => $tab -> mem_nom, "art_nom" => $tab -> art_nom, "per_nom" => $tab -> per_nom, "emp_libelle" => $tab -> emp_libelle, "emb_id" => $emb_id);
			}
		
		$data['resultat'] = $tab_result;
		
		$this->layout->views('menu_principal')->view('exporter', $data);
		
    }*/
	public function xls($id = '')
	{
		$this->load->model("exporter_model", "exportManager");
		
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
 		//var_dump($query->result());
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        // Field names in the first row
        //$rest = $query->list_fields();
        $column = array('Titre', 'Artiste', 'Diffuseur', 'Format', 'Ecouté par', 'Date d\'ajout', 'Disponible', 'Mail diffuseur', 'Emplacement', 'Emission Bénévole');
        $fields = array('dis_libelle', 'art_nom', 'lab_nom', 'dis_format', 'uti_prenom', 'dis_date_ajout', 'dis_disponible', 'lab_mail', 'emp_libelle', 'emb_libelle');
		//var_dump($fields);
		//var_dump($query->result());
		//return false;
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
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Products_'.date('dMy').'.xls"');
        header('Cache-Control: max-age=0');
 		
        $objWriter->save('php://output');
	}

	public function csv($value='')
	{
		$this->load->model("exporter_model", "exportManager");
		
		
	   	date_default_timezone_set("Asia/Jakarta");
	   	$table_name = 'Disque';
	    //$query = $this->db->get($table_name);
	    /*$query = $this->createQueryBuilder('d')
					->join('d.Artiste', 'a')
					->getQuery();
		$result = $query->getResult();*/
		$query = $this->exportManager->select_export();
        //var_dump($query->result());
        if(!$query)
            return false;
 		//return false;
        // Starting the PHPExcel library
        $this->load->library('Excel');
        //$this->load->library('PHPExcel/IOFactory');
 
        $objPHPExcel = new PHPExcel_Writer_CSV();
		//$objPHPExcel->setExcelCompatibility(TRUE);
        //$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
        //$objPHPExcel->setActiveSheetIndex(0);
 
        // Field names in the first row
        //$rest = $query->list_fields();
        $column = array('Titre', 'Artiste', 'Diffuseur', 'Format', 'Ecouté par', 'Date d\'ajout','mail ok', 'Disponible', 'Mail diffuseur', 'Emplacement', 'Emission Bénévole');
        $fields = array('dis_libelle', 'art_nom', 'lab_nom', 'dis_format', 'uti_prenom', 'dis_date_ajout','dis_envoi_ok', 'dis_disponible', 'lab_mail', 'emp_libelle', 'emb_libelle');
		//var_dump($fields);
		//var_dump($query->result());
		//return false;
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
 		
		$objPHPExcel->setDelimiter(";");
        $objPHPExcel->setActiveSheetIndex(0);
 		
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        // Sending headers to force the user to download the file
        //header('Content-Type: application/vnd.ms-excel');
		header('Content-type: text/csv');
        header('Content-Disposition: attachment;filename="Products_'.date('dMy').'.csv"');
        header('Cache-Control: max-age=0');
 		
        $objWriter->save('php://output');
	}
 
}