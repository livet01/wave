<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_artiste extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'art_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'art_nom' => array(
				'type' => 'VARCHAR',
				'constraint' => 150,
				
			),
			'rad_id' => array(
				'type' => 'SMALLINT',
				'constraint' => 6,
				
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('art_id', true);
		$this->dbforge->create_table('artiste');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('artiste');

	}

	//--------------------------------------------------------------------

}