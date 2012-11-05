<?
class recherche_model extends CI_Model {
	
	public function check_recherche($recherche) {
	$this->query = $this->db->select('COUNT(*)')->from('artiste')->where(array('art_nom'=>$recherche))->get();
	return $this->query->row_array();
	}
}