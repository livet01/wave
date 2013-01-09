<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
	Copyright (c) 2011 Lonnie Ezell

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:
	
	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.
	
	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/

$lang['up_toolbar_title']			= 'Manager de mise à jour';

$lang['up_update_off_message']		= 'Les contrôles de mise à jour sont désactivées dans le fichier config/application.php.';
$lang['up_curl_disabled_message']	= 'cURL <strong>n\'est actuellement pas</strong> activé comme une extension PHP. Bonfire ne sera pas en mesure de vérifier les mises à jour jusqu\'à ce qu\'il soit activé.';
$lang['up_edge_commits']			= 'Nouvelle mise à jour engagée';
$lang['up_branch']					= 'Branche: <b>developpement</b>';

$lang['up_author']					= 'Auteur';
$lang['up_committed']				= 'Engagé';
$lang['up_message']					= 'Message';

$lang['up_update_message_bleeding'] = 'Une <b>mise à jour</b> de Bonfire est disponible.';
$lang['up_update_message_new']      = ' Version %s de Bonfire est disponible. Vous fonctionnez actuellement sur la version '; //requires the spaces at the start and end of the string
$lang['up_update_message_latest']   = 'Vous fonctionnez actuellement sur la version %s de Bonfire. Vous avez la dernière version disponible de Bonfire.';
$lang['up_update_message_old']      = 'Vous fonctionnez actuellement sur la version %s de Bonfire. La dernière version <b>stable</b> est la version %s.';
$lang['up_update_message_unable']   = 'Vous fonctionnez actuellement sur la version %s de Bonfire. <b>Impossible de récupérer la dernière version en ce moment.</b>';