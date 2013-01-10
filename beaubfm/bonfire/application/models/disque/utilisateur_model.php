<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Utilisateur_model extends CI_Model {
	private $table1 = "users";
		
	function __construct() {
		parent::__construct();
	}
	
	function select($select,$where) {
		return $this->db->select($select)
							->from($this->table1)
							->where($where)
							->get()
							->row_array();
	}
	
	function insert($id,$login,$mdp,$role_id,$email='') {
		$pass=$this->hash_password($mdp);
		
		
		$resultat = $this->db->set('username', $login)
						->set('password_hash', $pass[0])
						->set('email',$email)
						->set('rad_id',1)
						->set('role_id',$role_id)
						->set('salt',$pass[1])
						->insert($this->table1);
		if(!$resultat) {
			throw new Exception("L'utilisateur n'a pas été ajouté", 1);
		}
		return $this->db->insert_id();
	}
	
	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !AUTH HELPER METHODS
	//--------------------------------------------------------------------

	/**
	 * Generates a new salt and password hash for the given password.
	 *
	 * @access public
	 *
	 * @param string $old The password to hash.
	 *
	 * @return array An array with the hashed password and new salt.
	 */
	public function hash_password($old='')
	{
		if (!function_exists('do_hash'))
		{
			$this->load->helper('security');
		}

		$salt = $this->generate_salt();
		$pass = do_hash($salt . $old);

		return array($pass, $salt);

	}//end hash_password()

	//--------------------------------------------------------------------

	/**
	 * Create a salt to be used for the passwords
	 *
	 * @access private
	 *
	 * @return string A random string of 7 characters
	 */
	private function generate_salt()
	{
		if (!function_exists('random_string'))
		{
			$this->load->helper('string');
		}

		return random_string('alnum', 7);

	}//end generate_salt()
	
	
}