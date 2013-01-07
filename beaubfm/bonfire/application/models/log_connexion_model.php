<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Log_Connexion_model extends CI_Model {
	
	protected $table = 'log_connexion';
	
	function __construct() {
		parent::__construct();
	}
		
	public function insert($data)
	{
		if(!empty($data)){
			$this->db->set('reussi', $data['reussi'])
					->set('ip_address', $data['ip_adresse'])
					->set('user_agent', $data['user_agent'])
					->set('login', $data['login'])
					->set('per_id', $data['per_id'])
					->insert($this->table);
		}
		else {
			return FALSE;
		}
	}
	
	public function count_connexion($ip,$login)
	{
		return (int) $this->db	->where('ip_address', $ip)
								->where('reussi', FALSE)
								->where('login', $login)
								->where('(DAYOFYEAR(CURDATE()) - DAYOFYEAR(date))<=', 1)
	                            ->from($this->table)
	                            ->count_all_results();
	}
}