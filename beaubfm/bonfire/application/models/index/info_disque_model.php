<?php 
class Info_Disque_Model extends CI_Model
{
    function GetArtiste($numArtiste)
    {
		return $this->db->select('disque.dis_id')
						->from('disque')
						->join('artiste', 'disque.per_id_artiste=artiste.art_id', 'LEFT')
						->where('disque.per_id_artiste', $numArtiste)
						->get()
						->result_array();
    }
	

    function GetLabel($numLabel)
    {
		return $this->db->select('disque.dis_id')
						->from('disque')
						->join('users', 'disque.dif_id=Users.id', 'LEFT')
						->where('disque.dif_id', $numLabel)
						->get()
						->result_array();	
    }

    function GetDisque($numDisque)
    {
			$this->db->select(array('col1','col2','col3','col4','col5','col6','disque.dis_id','dis_envoi_ok','sty_libelle','dis_libelle','dis_format','u2.username as mem_nom','artiste.art_nom','u1.username as per_nom', 'u1.email as mail','emplacement.emp_libelle','embenevole.emb_libelle'))
						->join('artiste', 'disque.per_id_artiste=Artiste.art_id', 'LEFT')
						->join('emplacement', 'disque.emp_id=Emplacement.emp_id', 'LEFT')
						->join('users AS u1', 'disque.dif_id=u1.id', 'LEFT')
						->join('users AS u2','disque.uti_id_ecoute=u2.id', 'LEFT')
						->join('embenevole','disque.emb_id=EmBenevole.emb_id', 'LEFT')
						->join('style','disque.sty_id=Style.sty_id', 'LEFT')
						->where('disque.dis_id', $numDisque);
		$query = $this->db->get('disque');
		return $query->result();
    }

  	function GetAllDisqueId()
    {
		$this->db->select('dis_id');
		$query = $this->db->get('disque');
		return $query->result_array();
    }

 	function GetArrayDisque($numDisque)
    {
			$this->db->select(array('disque.dis_id','dis_libelle','dis_format','u2.username as mem_nom','artiste.art_nom','u1.username as per_nom','emplacement.emp_libelle'))
						->join('artiste', 'disque.per_id_artiste=Artiste.art_id', 'LEFT')
						->join('emplacement', 'disque.emp_id=Emplacement.emp_id', 'LEFT')
						->join('users AS u1', 'disque.dif_id=u1.id', 'LEFT')
						->join('users AS u2','disque.uti_id_ecoute=u2.id', 'LEFT')
						->where('disque.dis_id', $numDisque);
		$query = $this->db->get('disque');
		return $query->result_array();
    }
	
	function GetOneDisque($numDisque)
    {
		$this->db->select('*')
						->where('disque.dis_id', $numDisque);
		$query = $this->db->get('disque');
		return $query->result_array();
    }
	
	function GetAll($nb=0,$debut=0)
    {
			$this->db->select(array('disque.dis_id','dis_libelle','dis_format','u2.username as mem_nom','artiste.art_nom','u1.username as per_nom','emplacement.emp_libelle'))
						->join('artiste', 'disque.per_id_artiste=artiste.art_id', 'LEFT')
						->join('emplacement', 'disque.emp_id=emplacement.emp_id', 'LEFT')
						->join('users AS u1', 'disque.dif_id=u1.id', 'LEFT')
						->join('users AS u2','disque.uti_id_ecoute=u2.id', 'LEFT')
						->order_by('dis_libelle', 'asc'); //-> limit($nb, $debut);
		$query = $this->db->get('disque');
		return $query->result();
    }
	
	function GetAll_in($iddisque = array())
    {
		if(empty($iddisque))
		{
			return $this->GetAll();
		}
		else {
			$this->db->select(array('disque.dis_id','dis_libelle','dis_format','u2.username as mem_nom','artiste.art_nom','u1.username as per_nom','emplacement.emp_libelle'))
						->join('artiste', 'disque.per_id_artiste=Artiste.art_id', 'LEFT')
						->join('emplacement', 'disque.emp_id=emplacement.emp_id', 'LEFT')
						->join('users AS u1', 'disque.dif_id=u1.id', 'LEFT')
						->join('users AS u2','disque.uti_id_ecoute=u2.id', 'LEFT')
							->where_in('dis_id', $iddisque)
							->order_by('dis_libelle', 'asc'); //-> limit($nb, $debut);
			$query = $this->db->get('disque');
			return $query->result();
		}
    }
	
	public function count() {
		return $this -> db -> count_all('disque');
	}
}