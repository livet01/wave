<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Parametre.Content.View');
		$this->load->model('parametre_model', null, true);
		$this->lang->load('parametre');
		
		Template::set_block('sub_nav', 'content/_sub_nav');
	}

	//--------------------------------------------------------------------



	/*
		Method: index()

		Displays a list of form data.
	*/
	public function index()
	{
		$records = $this->parametre_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Gérer les Paramètres');
		Template::render();
	}

	//--------------------------------------------------------------------


	/*
		Method: edit()

		Allows editing of Parametre data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('parametre_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/parametre');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Parametre.Content.Edit');

			if ($this->save_parametre('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('parametre_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'parametre');

				Template::set_message(lang('parametre_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('parametre_edit_failure') . $this->parametre_model->error, 'error');
			}
		}
		Template::set('parametre', $this->parametre_model->find($id));
		Assets::add_module_js('parametre', 'parametre.js');

		Template::set('toolbar_title', lang('parametre_edit') . ' Paramètre');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_parametre()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_parametre($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['param_id'] = $id;
		}

		
		$this->form_validation->set_rules('parametre_param_libelle','Libelle du Parametre','trim|xss_clean|max_length[100]');
		$this->form_validation->set_rules('parametre_param_valeur','Valeur du Parametre','trim|xss_clean|max_length[100]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['param_libelle']        = $this->input->post('parametre_param_libelle');
		$data['param_valeur']        = $this->input->post('parametre_param_valeur');

		if ($type == 'update')
		{
			$return = $this->parametre_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}