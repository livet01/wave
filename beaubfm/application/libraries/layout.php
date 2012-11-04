<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Layout {
	private $CI;
	private $output = '';
	/*
	 |===============================================================================
	 | Constructeur
	 |===============================================================================
	 */
	public function __construct(){
		$this->CI = get_instance();
		$this->var['output'] = '';

	}
	/*
	 |===============================================================================
	 | Méthodes pour charger les vues
	 | . view
	 | . views
	 |===============================================================================
	 */
	public function view($name, $data = array())
	{
	$this->output .= $this->CI->load->view($name, $data, true);
	$this->CI->load->view('../themes/default', array('output' => $this->output));
	}

	public function views($name, $data = array())
	{
	$this->output .= $this->CI->load->view($name, $data, true);
	return $this;
	}
	
}

/* End of file layout.php */
/* Location: ./application/libraries/layout.php */

