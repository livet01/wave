<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Style_model extends BF_Model {

	protected $table		= "style";
	protected $key			= "sty_id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= false;
	protected $set_modified = false;
}
