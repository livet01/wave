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

$lang['log_no_logs'] 			= 'Pas de journaux trouvés.';
$lang['log_not_enabled']		= 'La journalisation n\'est actuellement pas activé.';
$lang['log_the_following']		= 'Journaliser ce qui suit:';
$lang['log_what_0']				= '0 - Rien';
$lang['log_what_1']				= '1 - Message d\'Erreur (inclus les erreurs PHP)';
$lang['log_what_2']				= '2 - Messages de débogage';
$lang['log_what_3']				= '3 - Messages d\'Information';
$lang['log_what_4']				= '4 - Tous les Messages';
$lang['log_what_note']			= 'Les valeurs des log les plus élevés inclus tous les messages provenant de numéros inférieurs. Ainsi, la journalisation 2 - messages de débogage avec aussi les journaux 1 - Messages d\'erreur.';

$lang['log_save_button']		= 'Sauvegarder les réglages de Journalisation';
$lang['log_delete_button']		= 'Supprimer les fichiers de Journalisation';
$lang['log_delete1_button']		= 'Supprimer ce fichier de Journalisation?';
$lang['logs_delete_confirm']	= 'Êtes-vous sûr de vouloir supprimer ces journaux?';

$lang['log_big_file_note']		= 'La journalisation peut créer rapidement de très gros fichiers, si vous journalisez trop d\'informations. Pour les sites en direct, vous devriez probablement journaliser uniquement les erreurs.';
$lang['log_delete_note']		= 'La suppression des fichiers journaux est permanente. Il n\'y a pas de retour en arrière, assurez vous que vous voulez bien le faire.';
$lang['log_delete1_note']		= 'La suppression des fichiers journaux est une action définitive. Il n\'y a pas de retour en arrière, assurez vous de savoir ce que vous faites.';
$lang['log_delete_confirm'] = 'Êtes-vous sûr de vouloir supprimer ce fichier de journalisation?';

$lang['log_not_found']			= 'Soit le fichier journal n\'a pas pu être localisé, soit il était vide.';
$lang['log_show_all_entries']	= 'Toutes les entrées';
$lang['log_show_errors']		= 'Erreurs seulement';

$lang['log_date']				= 'Date';
$lang['log_file']				= 'Nom du fichier';
$lang['log_logs']				= 'Journaux';
$lang['log_settings']			= 'Réglages';

$lang['log_title']				= 'Journaux du système';
$lang['log_title_settings']		= 'Réglages des journaux du système';
$lang['log_deleted']			= '%d fichiers journaux supprimés';
$lang['log_filter_label'] = 'Vue';
$lang['log_intro']        = 'Il s\'agit de vos journaux d\'erreurs et de débogages';