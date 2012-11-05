<?php 
class Autocomplete_Model extends CI_Model
{
    function GetAutocomplete($options = array())
    {
	    $this->db->select('art_nom','art_id');
	    $this->db->like('art_nom', $options['keyword'], 'after');
   		$query = $this->db->get('Artiste');
		return $query->result();
    }
}