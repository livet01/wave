<?php 
class Info_Disque_Model extends CI_Model
{
    function GetArtiste($numArtiste)
    {
		return $this->db->select('Disque.dis_id')
						->from('Disque')
						->join('Artiste', 'Disque.per_id_artiste=Artiste.art_id', 'LEFT')
						->where('Disque.per_id_artiste', $numArtiste)
						->get()
						->result_array();
    }
	

    function GetLabel($numLabel)
    {
		return $this->db->select('Disque.dis_id')
						->from('Disque')
						->join('Users', 'Disque.dif_id=Users.id', 'LEFT')
						->where('Disque.dif_id', $numLabel)
						->get()
						->result_array();	
    }

    function GetDisque($numDisque)
    {
			$this->db->select(array('Disque.dis_id','dis_libelle','dis_format','u2.username as mem_nom','Artiste.art_nom','u1.username as per_nom','Emplacement.emp_libelle','EmBenevole.emb_libelle'))
						->join('Artiste', 'Disque.per_id_artiste=Artiste.art_id', 'LEFT')
						->join('Emplacement', 'Disque.emp_id=Emplacement.emp_id', 'LEFT')
						->join('Users AS u1', 'Disque.dif_id=u1.id', 'LEFT')
						->join('Users AS u2','Disque.uti_id_ecoute=u2.id', 'LEFT')
						->join('EmBenevole','Disque.emb_id=EmBenevole.emb_id', 'LEFT')
						->where('Disque.dis_id', $numDisque);
		$query = $this->db->get('Disque');
		return $query->result();
    }

  	function GetAllDisqueId()
    {
		$this->db->select('dis_id');
		$query = $this->db->get('Disque');
		return $query->result_array();
    }

 	function GetArrayDisque($numDisque)
    {
			$this->db->select(array('Disque.dis_id','dis_libelle','dis_format','u2.username as mem_nom','Artiste.art_nom','u1.username as per_nom','Emplacement.emp_libelle'))
						->join('Artiste', 'Disque.per_id_artiste=Artiste.art_id', 'LEFT')
						->join('Emplacement', 'Disque.emp_id=Emplacement.emp_id', 'LEFT')
						->join('Users AS u1', 'Disque.dif_id=u1.id', 'LEFT')
						->join('Users AS u2','Disque.uti_id_ecoute=u2.id', 'LEFT')
						->where('Disque.dis_id', $numDisque);
		$query = $this->db->get('Disque');
		return $query->result_array();
    }
	
	function GetOneDisque($numDisque)
    {
		$this->db->select('*')
						->where('Disque.dis_id', $numDisque);
		$query = $this->db->get('Disque');
		return $query->result_array();
    }
	
	function GetAll($nb=0,$debut=0)
    {
			$this->db->select(array('Disque.dis_id','dis_libelle','dis_format','u2.username as mem_nom','Artiste.art_nom','u1.username as per_nom','Emplacement.emp_libelle'))
						->join('Artiste', 'Disque.per_id_artiste=Artiste.art_id', 'LEFT')
						->join('Emplacement', 'Disque.emp_id=Emplacement.emp_id', 'LEFT')
						->join('Users AS u1', 'Disque.dif_id=u1.id', 'LEFT')
						->join('Users AS u2','Disque.uti_id_ecoute=u2.id', 'LEFT')
						->order_by('dis_libelle', 'asc'); //-> limit($nb, $debut);
		$query = $this->db->get('Disque');
		return $query->result();
    }
	
	function GetAll_in($iddisque = array())
    {
		if(empty($iddisque))
		{
			return $this->GetAll();
		}
		else {
			$this->db->select(array('Disque.dis_id','dis_libelle','dis_format','u2.username as mem_nom','Artiste.art_nom','u1.username as per_nom','Emplacement.emp_libelle'))
						->join('Artiste', 'Disque.per_id_artiste=Artiste.art_id', 'LEFT')
						->join('Emplacement', 'Disque.emp_id=Emplacement.emp_id', 'LEFT')
						->join('Users AS u1', 'Disque.dif_id=u1.id', 'LEFT')
						->join('Users AS u2','Disque.uti_id_ecoute=u2.id', 'LEFT')
							->where_in('dis_id', $iddisque)
							->order_by('dis_libelle', 'asc'); //-> limit($nb, $debut);
			$query = $this->db->get('Disque');
			return $query->result();
		}
    }
	
	public function count() {
		return $this -> db -> count_all('Disque');
	}
}