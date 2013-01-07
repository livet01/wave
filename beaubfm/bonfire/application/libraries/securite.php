<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class securite {

	public static function crypt($mdp) {
		return (!empty($mdp))? md5($mdp) : NULL ;
	}
	
}

?>