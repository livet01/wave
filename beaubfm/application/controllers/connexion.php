<?php
class Connexion extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this -> connexion();
	}

	public function connexion() {
		$this -> load -> view('connexion_form');
		if ($this -> input -> post('login') == "test" && $this -> input -> post('password') == "test") {
			redirect('connexion/connexionOn');
		}

	}

	public function connexionOn() {
		if (($this -> input -> post('login') == "test") && ($this -> input -> post('password') == "test")) {
			$data['uti_login'] = $this -> input -> post('login');
			var_dump($data);

			$this -> session -> set_userdata('login', $data['uti_login']);
			$this -> session -> set_userdata('isLogged', TRUE);
			redirect('index/index/');
		}
		else {
			redirect('connexion/connexion');
		}
	}

}
?>