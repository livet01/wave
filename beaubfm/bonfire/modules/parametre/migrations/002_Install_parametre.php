<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_parametre extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'param_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'param_libelle' => array(
				'type' => 'VARCHAR',
				'constraint' => 100,
				
			),
			'param_valeur' => array(
				'type' => 'VARCHAR',
				'constraint' => 100,
				
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('param_id', true);
		$this->dbforge->create_table('parametre');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('parametre');

	}

	//--------------------------------------------------------------------

}