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

$lang['db_maintenance']			= 'Maintenance';
$lang['db_backups']				= 'Sauvegardes';

$lang['db_backup_warning']		= 'Remarque: En raison du temps d\'exécution limité et de la mémoire disponible pour PHP, la sauvegarde des bases de données très volumineuses peuvent ne pas être possible. Si votre base de données est très grande, vous pourriez avoir besoin de sauvegarder directement à partir de votre serveur SQL via la ligne de commande, ou demandez à votre administrateur serveur de le faire pour vous si vous n\'avez pas les privilèges root.';
$lang['db_filename']			= 'Nom du fichier';

$lang['db_drop_question']		= 'Ajouter la commande &lsquo;Drop Tables&rsquo pour SQL?';
$lang['db_drop_tables']			= 'Drop Tables';
$lang['db_compress_question']	= 'Type de compression?';
$lang['db_compress_type']		= 'Type de compression';
$lang['db_insert_question']		= 'Ajouter &lsquo;Inserts&rsquo; pour les données en SQL?';
$lang['db_add_inserts']			= 'Ajouter Inserts';

$lang['db_restore_note']		= 'L\'option Restaurer est seulement capable de lire les fichiers non compressés. La compression Gzip et Zip est bonne si vous voulez juste une sauvegarde pour télécharger et stocker sur votre ordinateur.';

$lang['db_apply']				= 'Appliquer';
$lang['db_gzip']				= 'gzip';
$lang['db_zip']					= 'zip';
$lang['db_backup']				= 'Sauvegarde';
$lang['db_tables']				= 'Tables';
$lang['db_restore']				= 'Restaurer';
$lang['db_database']			= 'Base de données';
$lang['db_drop']				= 'Drop';
$lang['db_repair']				= 'Réparer';
$lang['db_optimize']			= 'Optimiser';
$lang['db_migrations']			= 'Migrations';

$lang['db_delete_note']			= 'Supprimer les fichiers de sauvegarde sélectionnées: ';
$lang['db_no_backups']			= 'Aucunes sauvegardes précédentes ont été trouvés.';
$lang['db_backup_delete_confirm']	= 'Voulez-vous vraiment supprimer les fichiers de sauvegarde suivants?';
$lang['db_backup_delete_none']	= 'Aucun fichiers de sauvegarde sélectionnés pour être supprimés';
$lang['db_drop_confirm']		= 'Voulez-vous vraiment supprimer les tables des bases de données suivantes?';
$lang['db_drop_none']			= 'Aucune tables sélectionnées pour être supprimées';
$lang['db_drop_attention']		= '<p>La suppression des tables de la base de données se traduira par la perte de données.</p><p><strong>Cela peut rendre votre application non fonctionnelle.</strong></p>';
$lang['db_repair_none']			= 'Aucune tables sélectionnées pour être réparées';

$lang['db_table_name']			= 'Nom de la Table';
$lang['db_records']				= 'Archives';
$lang['db_data_size']			= 'Taille des données';
$lang['db_index_size']			= 'Taille de l\'Index';
$lang['db_data_free']			= 'Données libres';
$lang['db_engine']				= 'Moteur';
$lang['db_no_tables']			= 'Pas de tables trouvées pour la base de données actuelle.';

$lang['db_restore_results']		= 'Restaurer les résultats';
$lang['db_back_to_tools']		= 'Retour aux Outils de base de données';
$lang['db_restore_file']		= 'Restaurer la base de données à partir du fichier';
$lang['db_restore_attention']	= '<p>La restauration d\'une base de données à partir d\'un fichier de sauvegarde se traduira par une supression d\'une partie ou de la totalité de votre base de données avant la restauration.</p><p><strong>Il peut en résulter une perte de données</strong>.</p>';

$lang['db_database_settings']	= 'Réglages de base de données';
$lang['db_server_type']			= 'Type de Serveur';
$lang['db_hostname']			= 'Nom d\'hôte';
$lang['db_dbname']				= 'Nom de la base de données';
$lang['db_advanced_options']	= 'Options avancées';
$lang['db_persistant_connect']	= 'Connexion persistante';
$lang['db_display_errors']		= 'Afficher les erreurs de base de données';
$lang['db_enable_caching']		= 'Activer la mise en cache de requêtes';
$lang['db_cache_dir']			= 'Répertoire du cache';
$lang['db_prefix']				= 'Préfixe';

$lang['db_servers']				= 'Serveurs';
$lang['db_driver']				= 'Driver';
$lang['db_persistant']			= 'Persistant';
$lang['db_debug_on']			= 'Débogage sur';
$lang['db_strict_mode']			= 'Mode strict';
$lang['db_running_on_1']		= 'Vous êtes en cours d\'exécution sur le';
$lang['db_running_on_2']		= 'serveur.';
$lang['db_serv_dev']			= 'Developpement';
$lang['db_serv_test']			= 'Test';
$lang['db_serv_prod']			= 'Production';

$lang['db_successful_save']		= 'Vos paramètres ont été correctement sauvegardées.';
$lang['db_erroneous_save']		= 'Une erreur s\'est produite lors de l\'enregistrement des paramètres.';
$lang['db_successful_save_act']	= 'Les paramètres de la base de données ont été enregistrés avec succès';
$lang['db_erroneous_save_act']	= 'Les paramètres de la base de données n\'ont pas été enregistrés correctement';

$lang['db_sql_query']			= 'Requête SQL';
$lang['db_total_results']		= 'Total des résultats';
$lang['db_no_rows']				= 'Aucune donnée trouvée pour la table.';
$lang['db_browse']				= 'Naviguer';
$lang['db_apply']               = 'Appliquer';