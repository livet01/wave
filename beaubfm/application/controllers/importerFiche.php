<?php
class ImporterFiche extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this -> importerFiche();
	}

	public function importerFiche($data = array()) {
		$this -> load -> library('layout');
		$this -> layout -> views('menu_principal') -> view('importer', array('error' => ' '));
	}

	public function envoi() {
		$nombreFichier = array('1', '2', '3', '4', '5', '6', '7');
		$this -> load -> library('upload');

		foreach ($nombreFichier as $i) {
			if (!empty($_FILES['fichier_' . $i]['name'])) {
				$config['file_name'] = $this -> session -> userdata('username') . '_fichier_' . $i;
				$config['upload_path'] = './assets/upload';
				$config['allowed_types'] = 'csv|xml|txt|xls|jpg';
				$config['max_size'] = '2048';
				$config['overwrite'] = TRUE;
				$this -> upload -> initialize($config);
				$form_name = 'fichier_' . $i;
				if (!$this -> upload -> do_upload($form_name)) {
					$error = array('error' => $this -> upload -> display_errors());
					$this -> load -> library('layout');
					$this -> layout -> views('menu_principal') -> view('importer', $error);
				} else {
					$data = array('upload_data' => $this -> upload -> data());
					$this -> load -> library('layout');
					$this -> layout -> views('menu_principal') -> view('importer');
				}
			}
		}
	}

}
?>