<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['module_config'] = array(
	'name'			=> 'Email en attente',
	'description'	=> 'Les files d\'attente des emails à envoyer pendant la journée.',
	'menus'	=> array(
		'settings'	=> 'emailer/settings/menu'
	),
	'author'		=> 'Wave Team'
);