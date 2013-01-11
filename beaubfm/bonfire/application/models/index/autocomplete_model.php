<?php 
class Autocomplete_Model extends CI_Model
{
    function GetAutocompleteArtiste($options = array())
    {
	    $this->db->select(array('art_id','art_nom'));
	    $this->db->like('art_nom', $options['keyword'], 'both');
   		$query = $this->db->get('artiste');
		return $query->result();
    }
    function GetAutocompleteLabel($options = array())
    {
	    $this->db->select(array('id','username','email'));
		$this->db->where('role_id',4);
	    $this->db->like('username', $options['keyword'], 'both');
   		$query = $this->db->get('users');
		return $query->result();
    }
    function GetAutocompleteMembre($options = array())
    {
	    $this->db->select(array('id','username'));
	    $this->db->like('username', $options['keyword'], 'both');
		$this->db->where('role_id',1);
		$this->db->or_where('role_id',2);
   		$query = $this->db->get('users');
		return $query->result();
    }
    function GetAutocompleteDisque($options = array())
    {
	    $this->db->select(array('dis_id','dis_libelle'));
	    $this->db->like('dis_libelle', $options['keyword'], 'both');
   		$query = $this->db->get('disque');
		return $query->result();
    }	
	function GetAutocompleteArrayDisque($options = array())
    {
	    $this->db->select(array('dis_id'));
	    $this->db->like('dis_libelle', $options['keyword'], 'both');
   		$query = $this->db->get('disque');
		return $query->result_array();
    }

}