<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	protected $user;

	public function set_user($user) {
		$this -> user = $user;
	}
	
	public function get_user(){
		return $this->user;
	}
		
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->userdata('isLogged'))
        {
           	redirect('connexion', 'index');	
        } else {
        	if(!$this->session->userdata('user')){
        		$this->load->model('personne_model','managerPersonne');
				$arrayUser=$this->managerPersonne->getUserInfo($this->session->userdata('mem_id'));
				$this->session->set_userdata('user',$arrayUser[0]);
				$this->set_user($this->session->userdata('user'));
        	} else {
        		$this->set_user($this->session->userdata('user'));
        	}
        }
    }
}

?>