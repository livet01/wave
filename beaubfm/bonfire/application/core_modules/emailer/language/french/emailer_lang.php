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

$lang['em_template']			= 'Modèle';
$lang['em_email_template']		= 'Modèle d\'Email';
$lang['em_emailer_queue']		= 'Queue d\'Email';

$lang['em_system_email']		= 'Email du système';
$lang['em_system_email_note']	= 'L\'email où tous les courriels générés par le système sont envoyés à partir.';
$lang['em_email_server']		= 'Serveur d\'Email';
$lang['em_settings']			= 'Réglages des Email';
$lang['em_settings_note']		= '<b>Mail</b> utilise la fonction mail standard de PHP, donc aucun réglage est nécessaire.';
$lang['em_location']			= 'emplacement';
$lang['em_server_address']		= 'Adresse du serveur';
$lang['em_port']				= 'Port';
$lang['em_timeout_secs']		= 'Temps (secondes)';
$lang['em_email_type']			= 'Type d\'Email';
$lang['em_test_settings']		= 'Tester les réglages d\'Email';

$lang['em_template_note']		= 'Les emails sont envoyés au format HTML. Ils peuvent être personnalisés en éditant l\'en-tête et le pied de page, ci-dessous.';
$lang['em_header']				= 'En-tête de page';
$lang['em_footer']				= 'Pied de page';

$lang['em_test_header']			= 'Tester vos réglages';
$lang['em_test_intro']			= 'Entrez une adresse email ci-dessous pour vérifier que vos paramètres de messagerie fonctionnent. <br/> Veuillez enregistrer les paramètres actuels avant l\'essai.';
$lang['em_test_button']			= 'Envoyez un message de test';
$lang['em_test_result_header']	= 'Résultats des tests';
$lang['em_test_no_results']		= 'Soit le test ne s\'exécute pas, ou ne retourne aucun résultat.';
$lang['em_test_debug_header']	= 'Information de débogage';
$lang['em_test_success']		= 'L\'email semble être réglé correctement. Si vous ne voyez pas le message dans votre boîte de réception, essayez de regarder dans votre boîte de spam ou de courrier indésirable.';
$lang['em_test_error']			= 'L\'email semble ne pas être réglé correctement.';

$lang['em_test_mail_subject']	= 'Félicitations! Votre Emailer Bonfire fonctionne!';
$lang['em_test_mail_body']		= 'Si vous voyez ce message, il semble que votre Emailer Bonfire fonctionne!';

$lang['em_stat_no_queue']		= 'Vous ne possédez aucun emails dans la file d\'attente.';
$lang['em_total_in_queue']		= 'Total des Emails dans la queue:';
$lang['em_total_sent']			= 'Total des Emails expédiés:';

$lang['em_sent']				= 'Expédié';
$lang['em_attempts']			= 'Tentatives';
$lang['em_id']					= 'ID';
$lang['em_to']					= 'Pour';
$lang['em_subject']				= 'Sujet';

$lang['em_missing_data']		= 'Un ou plusieurs champs requis sont manquants.';
$lang['em_no_debug']			= 'L\'Email a été mis en attente. Pas de données de débogage disponible.';

$lang['em_delete_success']      = '%d enregistrements supprimés.';
$lang['em_delete_failure']		= 'Impossible de supprimer les enregistrements:';
$lang['em_delete_error']		= 'Erreur de suppression des enregistrements:';
$lang['em_delete_confirm']		= 'Êtes-vous sûr de vouloir supprimer ces emails?';

$lang['em_create_email']		= 'Envoyer un nouvel email';
$lang['em_create_setting']		= 'Configurer l\'email';
$lang['em_create_email_error']	= 'Erreur dans la création d\'emails:';
$lang['em_create_email_success']= 'Les email(s) sont insérés dans la file d\'attente.';
$lang['em_create_email_failure']= 'Échec dans la création d\'emails:';
$lang['em_create_email_cancel']	= 'Annuler';
