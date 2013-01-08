<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_emplacement extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'emp_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'emp_libelle' => array(
				'type' => 'VARCHAR',
				'constraint' => 45,
				
			),
			'rad_id' => array(
				'type' => 'SMALLINT',
				'constraint' => 6,
				
			),
			'emp_plus' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
				
			),
			'emp_mail' => array(
				'type' => 'TEXT',
				
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('emp_id', true);
		$this->dbforge->create_table('emplacement');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('emplacement');

	}

	//--------------------------------------------------------------------

}