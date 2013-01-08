<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_style_permissions extends Migration {

	// permissions to migrate
	private $permission_values = array(
		array('name' => 'Style.Context.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Context.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Context.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Context.Delete', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Content.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Content.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Content.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Content.Delete', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Reports.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Reports.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Reports.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Reports.Delete', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Settings.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Settings.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Settings.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Settings.Delete', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Developer.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Developer.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Developer.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Style.Developer.Delete', 'description' => '', 'status' => 'active',),
	);

	//--------------------------------------------------------------------

	public function up()
	{
		$prefix = $this->db->dbprefix;

		// permissions
		foreach ($this->permission_values as $permission_value)
		{
			$permissions_data = $permission_value;
			$this->db->insert("permissions", $permissions_data);
			$role_permissions_data = array('role_id' => '1', 'permission_id' => $this->db->insert_id(),);
			$this->db->insert("role_permissions", $role_permissions_data);
		}
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

        // permissions
		foreach ($this->permission_values as $permission_value)
		{
			$query = $this->db->select('permission_id')->get_where("permissions", array('name' => $permission_value['name'],));
			foreach ($query->result_array() as $row)
			{
				$permission_id = $row['permission_id'];
				$this->db->delete("role_permissions", array('permission_id' => $permission_id));
			}
			$this->db->delete("permissions", array('name' => $permission_value['name']));

		}
	}

	//--------------------------------------------------------------------

}