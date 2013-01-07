<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('url')){
	function url($text, $uri = ''){
		if( ! is_array($uri)){
			// Suppression de la variable $text
			$uri = func_get_args();
			array_shift($uri);
		}
		echo '<a href="' . site_url($uri) . '">' . htmlentities($text) .'</a>';
		return '';
	}
}
?>