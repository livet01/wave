<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_style extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'sty_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'sty_couleur' => array(
				'type' => 'VARCHAR',
				'constraint' => 15,
				
			),
			'sty_libelle' => array(
				'type' => 'VARCHAR',
				'constraint' => 45,
				
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('sty_id', true);
		$this->dbforge->create_table('style');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('style');

	}

	//--------------------------------------------------------------------

}