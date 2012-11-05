<?php 
class Info_Disque_Model extends CI_Model
{
    function GetArtiste($numArtiste)
    {
	    $this->db->select('*');
	    $this->db->where('per_id_artiste', $numArtiste);
   		$query = $this->db->get('Disque');
		return $query->result();
    }
}