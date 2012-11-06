<?php 
class Autocomplete_Model extends CI_Model
{
    function GetAutocompleteArtiste($options = array())
    {
	    $this->db->select(array('art_id','art_nom'));
	    $this->db->like('art_nom', $options['keyword'], 'after');
   		$query = $this->db->get('Artiste');
		return $query->result();
    }
    function GetAutocompleteLabel($options = array())
    {
	    $this->db->select(array('lab_id','lab_nom'));
	    $this->db->like('lab_nom', $options['keyword'], 'after');
   		$query = $this->db->get('Label');
		return $query->result();
    }
    function GetAutocompleteDisque($options = array())
    {
	    $this->db->select(array('dis_id','dis_libelle'));
	    $this->db->like('dis_libelle', $options['keyword'], 'after');
   		$query = $this->db->get('Disque');
		return $query->result();
    }
}