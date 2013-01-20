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

$lang['role_intro']					= 'Les rôles vous permettent de définir les actions possibles qu\'un utilisateur peut avoir.';
$lang['role_manage']				= 'Gérer les rôles des utilisateurs';
$lang['role_no_roles']				= 'Il n\'y a pas de rôles dans le système.';
$lang['role_create_button']			= 'Créer un nouveau rôle.';
$lang['role_create_note']			= 'Chaque utilisateur a besoin d\'un rôle. Assurez-vous que vous avez tout ce dont vous avez besoin.';
$lang['role_account_type']			= 'Type de compte';
$lang['role_description']			= 'Description';
$lang['role_details']				= 'Détails du rôle';

$lang['role_name']					= 'Nom du Role';
$lang['role_max_desc_length']		= 'Max. 255 caractères.';
$lang['role_default_role']			= 'Rôle par défaut';
$lang['role_default_note']			= 'Ce rôle doit être attribué à tous les nouveaux utilisateurs.';
$lang['role_permissions']			= 'Permissions';
$lang['role_permissions_check_note']= 'Vérifiez toutes les permissions qui s\'appliquent à ce rôle.';
$lang['role_save_role']				= 'Sauvegarder le rôle';
$lang['role_delete_role']			= 'Supprimer ce rôle';
$lang['role_delete_confirm']		= 'Etes vous sur de vouloir supprimer ces journaux?';
$lang['role_delete_note']			= 'La suppression de ce rôle vous permet de convertir tous les utilisateurs qui sont actuellement affectés à ce rôle par le rôle par défaut du site.';
$lang['role_can_delete_role']   	= 'Peut être supprimé';
$lang['role_can_delete_note']    	= 'Ce rôle peut être supprimé?';

$lang['role_roles']					= 'Rôles';
$lang['role_new_role']				= 'Nouveau rôle';
$lang['role_new_permission_message']	= 'Vous serez en mesure de modifier les permissions une fois le rôle créé.';
$lang['role_not_used']				= 'Non utilisé';

$lang['role_login_destination']		= 'Destination de l\'identifiant';
$lang['role_destination_note']		= 'L\'URL de redirection du site lors de la réussite de la connexion.';
$lang['role_default_context']		= 'Contexte de l\'Admin par défaut';
$lang['role_default_context_note']	= 'Le contexte admin à charger lorsque aucun contexte n\'est spécifié (I.E. http://votresite.com/admin/)';

$lang['matrix_header']				= 'Matrice des Permissions';
$lang['matrix_permission']			= 'Permission';
$lang['matrix_role']				= 'Rôle';
$lang['matrix_note']				= 'Édition des permissions instantanée. Basculer une case à cocher pour ajouter ou retirer une permission pour le rôle voulu.';
$lang['matrix_insert_success']		= 'Permission ajoutée pour le rôle.';
$lang['matrix_insert_fail']			= 'Il y a un problème pour ajouter la permission pour le rôle:';
$lang['matrix_delete_success']		= 'Permission supprimée pour le rôle.';
$lang['matrix_delete_fail']			= 'Il y a un problème pour supprimer la permission pour le rôle:';
$lang['matrix_auth_fail']			= 'Authentification: Vous n\'avez pas la capacité de gérer le contrôle d\'accès pour ce rôle.';