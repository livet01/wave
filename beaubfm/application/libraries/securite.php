<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class securite {

	public static function crypt($mdp) {
		return md5($mdp);
	}
	
}

?>