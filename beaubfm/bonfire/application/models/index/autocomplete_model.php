<?php 
class Autocomplete_Model extends CI_Model
{
    function GetAutocompleteArtiste($options = array())
    {
	    $this->db->select(array('art_id','art_nom'));
	    $this->db->like('art_nom', $options['keyword'], 'both');
   		$query = $this->db->get('Artiste');
		return $query->result();
    }
    function GetAutocompleteLabel($options = array())
    {
	    $this->db->select(array('lab_id','lab_nom','lab_mail'));
	    $this->db->like('lab_nom', $options['keyword'], 'both');
   		$query = $this->db->get('Label');
		return $query->result();
    }
    function GetAutocompleteMembre($options = array())
    {
	    $this->db->select(array('mem_id','mem_nom'));
	    $this->db->like('mem_nom', $options['keyword'], 'both');
   		$query = $this->db->get('Membre');
		return $query->result();
    }
    function GetAutocompleteDisque($options = array())
    {
	    $this->db->select(array('dis_id','dis_libelle'));
	    $this->db->like('dis_libelle', $options['keyword'], 'both');
   		$query = $this->db->get('Disque');
		return $query->result();
    }	
	function GetAutocompleteArrayDisque($options = array())
    {
	    $this->db->select(array('dis_id'));
	    $this->db->like('dis_libelle', $options['keyword'], 'both');
   		$query = $this->db->get('Disque');
		return $query->result_array();
    }

}