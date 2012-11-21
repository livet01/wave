<?php
class ImporterFiche extends MY_Controller {
	private $msgError = "";

	public function __construct() {
		parent::__construct();
		$this -> load -> library('upload');
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

		//Test Import, mettre qu'un fichier xls en premier
		date_default_timezone_set("Asia/Jakarta");
		$this -> load -> library('Excel');

		//On r�cup�re le type du fichier pour charger la bonne librairie
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
		var_dump($objPHPExcel->getSheet()->toArray());

	}

	public function xmlFile($data) {
	}

	public function csvFile($data) {
		$objReader = PHPExcel_IOFactory::createReader('CSV');
		$objPHPExcel = $objReader -> load($data['upload_data']['full_path']);
		var_dump($objPHPExcel->getSheet()->toArray());
	}

}
?>