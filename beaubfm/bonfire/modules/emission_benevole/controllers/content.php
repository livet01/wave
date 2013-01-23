<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Emission_Benevole.Content.View');
		$this->load->model('emission_benevole_model', null, true);
		$this->lang->load('emission_benevole');
		
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
					$result = $this->emission_benevole_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('emission_benevole_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('emission_benevole_delete_failure') . $this->emission_benevole_model->error, 'error');
				}
			}
		}

		$records = $this->emission_benevole_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Gérer les Emissions Bénévole');
		Template::render();
	}

	//--------------------------------------------------------------------


	/*
		Method: edit()

		Allows editing of Emission Benevole data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('emission_benevole_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/emission_benevole');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Emission_Benevole.Content.Edit');

			if ($this->save_emission_benevole('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('emission_benevole_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'emission_benevole');

				Template::set_message(lang('emission_benevole_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('emission_benevole_edit_failure') . $this->emission_benevole_model->error, 'error');
			}
		}

		Template::set('emission_benevole', $this->emission_benevole_model->find($id));
		Assets::add_module_js('emission_benevole', 'emission_benevole.js');

		Template::set('toolbar_title', lang('emission_benevole_edit') . ' Emission Bénévole');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_emission_benevole()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_emission_benevole($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['emb_id'] = $id;
		}

		
		$this->form_validation->set_rules('emission_benevole_emb_libelle','Nom de l\'emission bénévole','required|unique[embenevole.emb_libelle,embenevole.emb_id]|trim|alpha_extra|max_length[150]');
		$this->form_validation->set_rules('emission_benevole_rad_id','Identifiant Radio','required|max_length[6]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['emb_libelle']        = $this->input->post('emission_benevole_emb_libelle');
		$data['rad_id']        = $this->input->post('emission_benevole_rad_id');

		if ($type == 'insert')
		{
			$id = $this->emission_benevole_model->insert($data);

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
			$return = $this->emission_benevole_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}