<?php
class ImporterFiche extends MY_Controller {

	public function __construct() {
		parent::__construct();		
	}

	public function index() {
		$this->importerFiche();
	}
	
	public function importerFiche($data = array()) {
		$this->load->library('layout');
		$this->layout->views('menu_principal')
					-> view('importer',array('error' => ' ' ));
	}
	
	public function envoi(){
		$config['upload_path'] = './assets/upload/';
		$config['allowed_types'] = 'csv|tkt|xls|xml|jpg';
		$config['max_size']	= '10000000';
		$config['max_width']  = '102400000';
		$config['max_height']  = '76800000';
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload('fichier'))
		{
			$error = array('error' => $this->upload->display_errors());			
			$this->load->library('layout');
			$this->layout->views('menu_principal')
					-> view('importer',$error);
		}	
		else
		{
			$data = array('upload_data' => $this->upload->data());			
			$this->load->view('upload_success', $data);
		}
	}
}
?>