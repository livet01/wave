<?php
class User extends CI_Controller{
	public function accueil(){
		// Chargement du modèle de gestion des news
		// Nous l'appellerons newsManager
		$this->load->model('news_model', 'newsManager');
		$data = array();
		// On lance une requête
		$data['user_info'] = $this->newsManager->get_info();
		// Et on inclut une vue
		$this->layout->view('ma_vue', $data);
	}
}
?>