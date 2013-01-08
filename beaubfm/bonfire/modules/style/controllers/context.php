<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class context extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Style.Context.View');
		$this->load->model('style_model', null, true);
		$this->lang->load('style');
		
		Template::set_block('sub_nav', 'context/_sub_nav');
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
					$result = $this->style_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('style_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('style_delete_failure') . $this->style_model->error, 'error');
				}
			}
		}

		$records = $this->style_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Style');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

		Creates a Style object.
	*/
	public function create()
	{
		$this->auth->restrict('Style.Context.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_style())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('style_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'style');

				Template::set_message(lang('style_create_success'), 'success');
				Template::redirect(SITE_AREA .'/context/style');
			}
			else
			{
				Template::set_message(lang('style_create_failure') . $this->style_model->error, 'error');
			}
		}
		Assets::add_module_js('style', 'style.js');

		Template::set('toolbar_title', lang('style_create') . ' Style');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

		Allows editing of Style data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('style_invalid_id'), 'error');
			redirect(SITE_AREA .'/context/style');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Style.Context.Edit');

			if ($this->save_style('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('style_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'style');

				Template::set_message(lang('style_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('style_edit_failure') . $this->style_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Style.Context.Delete');

			if ($this->style_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('style_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'style');

				Template::set_message(lang('style_delete_success'), 'success');

				redirect(SITE_AREA .'/context/style');
			} else
			{
				Template::set_message(lang('style_delete_failure') . $this->style_model->error, 'error');
			}
		}
		Template::set('style', $this->style_model->find($id));
		Assets::add_module_js('style', 'style.js');

		Template::set('toolbar_title', lang('style_edit') . ' Style');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_style()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_style($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['sty_id'] = $id;
		}

		
		$this->form_validation->set_rules('style_sty_couleur','couleur du style de musique','required|unique[style.sty_couleur,style.sty_id]|trim|xss_clean|alpha|max_length[15]');
		$this->form_validation->set_rules('style_sty_libelle','libelle du style de musique','required|trim|xss_clean|max_length[45]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['sty_couleur']        = $this->input->post('style_sty_couleur');
		$data['sty_libelle']        = $this->input->post('style_sty_libelle');

		if ($type == 'insert')
		{
			$id = $this->style_model->insert($data);

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
			$return = $this->style_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}