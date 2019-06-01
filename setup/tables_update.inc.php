<?php
/**
 * EGroupware - Setup
 * https://www.egroupware.org
 * Created by eTemplates DB-Tools written by ralfbecker@outdoor-training.de
 *
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @package openid
 * @subpackage setup
 */

function openid_upgrade19_1()
{
	$GLOBALS['egw_setup']->db->insert('egw_openid_scopes', [
		'scope_identifier' => 'roles',
		'scope_description' => 'Administration rights or regular user',
		'scope_created'    => time(),
	], false, __LINE__, __FILE__, 'openid');

	return $GLOBALS['setup_info']['openid']['currentver'] = '19.1.001';
}

function openid_upgrade19_1_001()
{
	$GLOBALS['egw_setup']->oProc->AddColumn('egw_openid_clients','client_creator',array(
		'type' => 'int',
		'meta' => 'user',
		'precision' => '4'
	));
	$GLOBALS['egw_setup']->oProc->AddColumn('egw_openid_clients','client_modifier',array(
		'type' => 'int',
		'meta' => 'user',
		'precision' => '4'
	));
	$GLOBALS['egw_setup']->oProc->AddColumn('egw_openid_clients','client_access_token_ttl',array(
		'type' => 'varchar',
		'precision' => '16'
	));
	$GLOBALS['egw_setup']->oProc->AddColumn('egw_openid_clients','client_refresh_token_ttl',array(
		'type' => 'varchar',
		'precision' => '16'
	));

	return $GLOBALS['setup_info']['openid']['currentver'] = '19.1.002';
}

