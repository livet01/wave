<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Artiste.Content.View');
		$this->load->model('artiste_model', null, true);
		$this->lang->load('artiste');
		
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
					$result = $this->artiste_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('artiste_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('artiste_delete_failure') . $this->artiste_model->error, 'error');
				}
			}
		}

		$records = $this->artiste_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Gérer les Artistes');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

		Allows editing of Artiste data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('artiste_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/artiste');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Artiste.Content.Edit');

			if ($this->save_artiste('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('artiste_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'artiste');

				Template::set_message(lang('artiste_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('artiste_edit_failure') . $this->artiste_model->error, 'error');
			}
		}
		Template::set('artiste', $this->artiste_model->find($id));
		Assets::add_module_js('artiste', 'artiste.js');

		Template::set('toolbar_title', lang('artiste_edit') . ' Artiste');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_artiste()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_artiste($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['art_id'] = $id;
		}

		
		$this->form_validation->set_rules('artiste_art_nom','Nom de l\'artiste','required|unique[artiste.art_nom,artiste.art_id]|trim|alpha_extra|max_length[150]');
		$this->form_validation->set_rules('artiste_rad_id','Identifiant Radio','max_length[6]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['art_nom']        = $this->input->post('artiste_art_nom');
		$data['rad_id']        = $this->input->post('artiste_rad_id');

		if ($type == 'insert')
		{
			$id = $this->artiste_model->insert($data);

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
			$return = $this->artiste_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}