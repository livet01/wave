<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_embenevole extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'emb_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'emb_libelle' => array(
				'type' => 'VARCHAR',
				'constraint' => 150,
				
			),
			'rad_id' => array(
				'type' => 'SMALLINT',
				'constraint' => 6,
				
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('emb_id', true);
		$this->dbforge->create_table('embenevole');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('embenevole');

	}

	//--------------------------------------------------------------------

}