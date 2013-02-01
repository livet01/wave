<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Disque_model extends CI_Model {
	private $table = "disque";
		
	function __construct() {
		parent::__construct();
	}
	
	function select($select,$where) {
		return $this->db->select($select)
							->from($this->table)
							->where($where)
							->get()
							->row_array();
	}

	public function update($data)
	{
		$this->db->trans_start();
		if(!empty($data)){
			if(isset($data['dis_id']))
				$id = $data['dis_id'];
			// Ajout de l'artiste si nécessaire
			if(is_array($data['art_id'])) {
				if($data['art_id']['insert']){
					$resultat = $this->db
							->set('art_nom', $data['art_id']['data']['nom'])
							->set('rad_id', $data['art_id']['data']['radio'])
							->insert('artiste');
					if($resultat)
						$data['art_id'] = $this->db->insert_id();
					else
						return false;
				}
			}
			if(is_array($data['dif_id'])) {
				if($data['dif_id']['insert']) {
					$pass=$this->hash_password($data['dif_id']['data']['mdp']);
					$resultat = $this->db
							->set('username', $data['dif_id']['data']['nom'])
							->set('password_hash', $pass[0])
							->set('email',$data['dif_id']['data']['email'])
							->set('rad_id',$data['dif_id']['data']['radio'])
							->set('role_id',4)
							->set('salt',$pass[1])
							->insert('users'); 
					if($resultat)
						$data['dif_id'] = $this->db->insert_id();
					else
						return false;
				}
			}
			if(is_array($data['emb_id'])) {
				if($data['emb_id']['insert']) {
					$resultat = $this->db
							->set('emb_libelle', $data['emb_id']['data']['nom'])
							->set('rad_id',  $data['emb_id']['data']['radio'])
							->insert('embenevole');
					if($resultat)
						$data['emb_id'] = $this->db->insert_id();
					else
						return false;
				}
			}
			$test = $this->db
					->set('dis_libelle', $data['dis_libelle'])
					->set('dis_format', $data['dis_format'])
					->set('uti_id_ecoute', $data['uti_id_ecoute'])
					->set('dis_date_ajout', 'NOW()',false)
					->set('art_id', $data['art_id'])
					->set('dif_id', $data['dif_id'])
					->set('sty_id', $data['sty_id'])
					->set('dis_envoi_ok', $data['dis_envoi_ok'])
					->set('emp_id', $data['emp_id'])
					->set('emb_id', (empty($data['emb_id']) ? NULL : $data['emb_id']))
					->set('col1', (empty($data['col1']) ? NULL : $data['col1']))
					->set('col2', (empty($data['col2']) ? NULL : $data['col2']))
					->set('col3', (empty($data['col3']) ? NULL : $data['col3']))
					->set('col4', (empty($data['col4']) ? NULL : $data['col4']))
					->set('col5', (empty($data['col5']) ? NULL : $data['col5']))
					->set('col6', (empty($data['col6']) ? NULL : $data['col6']))
					->where('dis_id', $id)
					->update($this->table);
			$this->db->trans_complete();
			return $id;
		}
		else {
			return FALSE;
		}
	}
	
	public function insert($data)
	{
		$this->db->trans_start();
		if(!empty($data)){
			if(isset($data['dis_id']))
				$id = $data['dis_id'];
			else {
				$id = $this->db->insert_id();
			}
			// Ajout de l'artiste si nécessaire
			if(is_array($data['art_id'])) {
				if($data['art_id']['insert']){
					$resultat = $this->db
							->set('art_nom', $data['art_id']['data']['nom'])
							->set('rad_id', $data['art_id']['data']['radio'])
							->insert('artiste');
					if($resultat)
						$data['art_id'] = $this->db->insert_id();
					else
						return false;
				}
			}
			if(is_array($data['dif_id'])) {
				if($data['dif_id']['insert']) {
					$pass=$this->hash_password($data['dif_id']['data']['mdp']);
					$resultat = $this->db
							->set('username', $data['dif_id']['data']['nom'])
							->set('password_hash', $pass[0])
							->set('email',$data['dif_id']['data']['email'])
							->set('rad_id',$data['dif_id']['data']['radio'])
							->set('role_id',4)
							->set('salt',$pass[1])
							->insert('users'); 
					if($resultat)
						$data['dif_id'] = $this->db->insert_id();
					else
						return false;
				}
			}
			if(is_array($data['emb_id'])) {
				if($data['emb_id']['insert']) {
					$resultat = $this->db
							->set('emb_libelle', $data['emb_id']['data']['nom'])
							->set('rad_id',  $data['emb_id']['data']['radio'])
							->insert('embenevole');
					if($resultat)
						$data['emb_id'] = $this->db->insert_id();
					else
						return false;
				}
			}
			$data['dis_envoi_ok'] = (isset($data['dis_envoi_ok']) ? $data['dis_envoi_ok'] : 0);
			$test = $this->db->set('dis_id', $id)
					->set('dis_libelle', $data['dis_libelle'])
					->set('dis_format', $data['dis_format'])
					->set('uti_id_ecoute', $data['uti_id_ecoute'])
					->set('dis_date_ajout', 'NOW()',false)
					->set('art_id', $data['art_id'])
					->set('dif_id', $data['dif_id'])
					->set('sty_id', $data['sty_id'])
					->set('dis_envoi_ok', $data['dis_envoi_ok'])
					->set('emp_id', $data['emp_id'])
					->set('emb_id', (empty($data['emb_id']) ? NULL : $data['emb_id']))
					->set('col1', (empty($data['col1']) ? NULL : $data['col1']))
					->set('col2', (empty($data['col2']) ? NULL : $data['col2']))
					->set('col3', (empty($data['col3']) ? NULL : $data['col3']))
					->set('col4', (empty($data['col4']) ? NULL : $data['col4']))
					->set('col5', (empty($data['col5']) ? NULL : $data['col5']))
					->set('col6', (empty($data['col6']) ? NULL : $data['col6']))
					->insert($this->table);
			$this->db->trans_complete();
			return $id;
		}
		else {
			return FALSE;
		}
	}

	public function nombreArtiste ($artiste, $where)
	{
		return $this -> db->select($artiste)
							->from($this->table)
							->where($where)
							->count_all_results();
							
	}
	
	public function delete ($artiste){
		
		return $this -> db ->delete($this->table, array('dis_id' => $artiste));
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