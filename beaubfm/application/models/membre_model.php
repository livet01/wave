<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Membre_model extends CI_Model {
	
	protected $vue = 'Membre';
	
	function __construct() {
		parent::__construct();
	}
		
	public function readMembre($mem_nom)
	{
		return $this->db->select('mem_id')
						->from($this->vue)
						->where('mem_nom',$mem_nom);
	}
	
	public function loginExist($login){
		return $this->db->select('mem_login')
						->from($this->vue)
						->where(array('mem_login'=>$login))
						->get()
						->row_array();	
	}
	public function loginMdpExist($login,$mdp){
		return $this->db->select('mem_login')
						->from($this->vue)
						->where(array('mem_login'=>$login,'mem_mdp'=>$mdp))
						->get()
						->row_array();	
	}
	public function getPasswordByLogin($login){
		return $this->db->select('mem_mdp')
						->from($this->vue)
						->where(array('mem_login'=>$login))
						->get()
						->row_array();
		
	}
	public function getPrenomNomByLogin($login){
		return $this->db->select(array('mem_prenom','mem_nom'))
						->from($this->vue)
						->where(array('mem_login'=>$login))
						->get()
						->row_array();		
	}
	public function getIdByLogin($login){
		return $this->db->select('mem_id')
						->from($this->vue)
						->where(array('mem_login'=>$login))
						->get()
						->row_array();		
	}
	public function getVerrouByLogin($login){
		return $this->db->select('mem_verrou')
						->from($this->vue)
						->where(array('mem_login'=>$login))
						->get()
						->row_array();		
	}
	public function setVerrouByLogin($login,$verrou){
		return $this->db->where(array('mem_login'=>$login))
						->update($this->vue,array('mem_verrou' => $verrou));	
	}
}