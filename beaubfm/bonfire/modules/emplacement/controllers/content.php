<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Emplacement.Content.View');
		$this->load->model('emplacement_model', null, true);
		$this->lang->load('emplacement');
		
		Template::set_block('sub_nav', 'content/_sub_nav');
	}

	//--------------------------------------------------------------------



	/*
		Method: index()

		Displays a list of form data.
	*/
	public function index()
	{

		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->emplacement_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('emplacement_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('emplacement_delete_failure') . $this->emplacement_model->error, 'error');
				}
			}
		}

		$records = $this->emplacement_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Emplacement');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

		Creates a Emplacement object.
	*/
	public function create()
	{
		$this->auth->restrict('Emplacement.Content.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_emplacement())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('emplacement_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'emplacement');

				Template::set_message(lang('emplacement_create_success'), 'success');
				Template::redirect(SITE_AREA .'/content/emplacement');
			}
			else
			{
				Template::set_message(lang('emplacement_create_failure') . $this->emplacement_model->error, 'error');
			}
		}
		Assets::add_module_js('emplacement', 'emplacement.js');

		Template::set('toolbar_title', lang('emplacement_create') . ' Emplacement');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

		Allows editing of Emplacement data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('emplacement_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/emplacement');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Emplacement.Content.Edit');

			if ($this->save_emplacement('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('emplacement_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'emplacement');

				Template::set_message(lang('emplacement_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('emplacement_edit_failure') . $this->emplacement_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Emplacement.Content.Delete');

			if ($this->emplacement_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('emplacement_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'emplacement');

				Template::set_message(lang('emplacement_delete_success'), 'success');

				redirect(SITE_AREA .'/content/emplacement');
			} else
			{
				Template::set_message(lang('emplacement_delete_failure') . $this->emplacement_model->error, 'error');
			}
		}
		Template::set('emplacement', $this->emplacement_model->find($id));
		Assets::add_module_js('emplacement', 'emplacement.js');

		Template::set('toolbar_title', lang('emplacement_edit') . ' Emplacement');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_emplacement()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_emplacement($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['emp_id'] = $id;
		}

		
		$this->form_validation->set_rules('emplacement_emp_libelle','libelle emplacement','required|trim|xss_clean|max_length[45]');
		$this->form_validation->set_rules('emplacement_rad_id','identifiant radio','required|trim|xss_clean|is_natural_no_zero|max_length[6]');
		$this->form_validation->set_rules('emplacement_emp_plus','emp_plus egal a 1 si emission benevole sinon 0','required|trim|xss_clean|is_natural|max_length[1]');
		$this->form_validation->set_rules('emplacement_emp_mail','mail emplacement','trim|xss_clean|valid_email');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['emp_libelle']        = $this->input->post('emplacement_emp_libelle');
		$data['rad_id']        = $this->input->post('emplacement_rad_id');
		$data['emp_plus']        = $this->input->post('emplacement_emp_plus');
		$data['emp_mail']        = $this->input->post('emplacement_emp_mail');

		if ($type == 'insert')
		{
			$id = $this->emplacement_model->insert($data);

			if (is_numeric($id))
			{
				$return = $id;
			} else
			{
				$return = FALSE;
			}
		}
		else if ($type == 'update')
		{
			$return = $this->emplacement_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}