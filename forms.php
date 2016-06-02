<?php
/**
 * Chronolabs Fonting Repository Services REST API API
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Chronolabs Cooperative http://labs.coop
 * @license         General Public License version 3 (http://labs.coop/briefs/legal/general-public-licence/13,3.html)
 * @package         fonts
 * @since           2.1.9
 * @author          Simon Roberts <wishcraft@users.sourceforge.net>
 * @subpackage		api
 * @description		Fonting Repository Services REST API
 * @link			http://sourceforge.net/projects/chronolabsapis
 * @link			http://cipher.labs.coop
 */
	
	
	$parts = explode(".", microtime(true));
	mt_srand(mt_rand(-microtime(true), microtime(true))/$parts[1]);
	mt_srand(mt_rand(-microtime(true), microtime(true))/$parts[1]/2);
	mt_srand(mt_rand(-microtime(true), microtime(true))/$parts[1]/3);
	mt_srand(mt_rand(-microtime(true), microtime(true))/$parts[1]/7);
	$salter = ((float)(mt_rand(0,1)==1?'':'-').$parts[1].'.'.$parts[0]) / sqrt((float)$parts[1].'.'.intval(cosh($parts[0])))*tanh($parts[1]) * mt_rand(1, intval($parts[0] / $parts[1]));
	header('Blowfish-salt: '. $salter);
	
	global $domain, $protocol, $business, $entity, $contact, $referee, $peerings, $source;
	require_once __DIR__ . DIRECTORY_SEPARATOR . 'apiconfig.php';
	require_once __DIR__ . DIRECTORY_SEPARATOR . 'functions.php';
	
	/**
	 * Global API Configurations and Setting from file Constants!
	 */
	$domain = getDomainSupportism('domain', $_SERVER["HTTP_HOST"]);
	$protocol = getDomainSupportism('protocol', $_SERVER["HTTP_HOST"]);
	$business = getDomainSupportism('business', $_SERVER["HTTP_HOST"]);
	$entity = getDomainSupportism('entity', $_SERVER["HTTP_HOST"]);
	$contact = getDomainSupportism('contact', $_SERVER["HTTP_HOST"]);
	$referee = getDomainSupportism('referee', $_SERVER["HTTP_HOST"]);
		/**
	 * URI Path Finding of API URL Source Locality
	 * @var unknown_type
	 */
	$pu = parse_url($_SERVER['REQUEST_URI']);
	$source = (isset($_SERVER['HTTPS'])?'https://':'http://').strtolower($_SERVER['HTTP_HOST']).$pu['path'];
	
	$help=true;
	if (isset($_REQUEST['output']) || !empty($_REQUEST['output'])) {
		$version = isset($_REQUEST['version'])?(string)$_REQUEST['version']:'v2';
		$output = isset($_REQUEST['output'])?(string)$_REQUEST['output']:'';
		$name = isset($_REQUEST['name'])?(string)$_REQUEST['name']:'';
		$clause = isset($_REQUEST['return'])?(string)$_REQUEST['return']:;
		$callback = isset($_REQUEST['callback'])?(string)$_REQUEST['callback']:'';
		$ipaddy = isset($_REQUEST['ipaddy'])?(string)$_REQUEST['ipaddy']:whitelistGetIP(true);
		$mode = isset($_REQUEST['mode'])?(string)$_REQUEST['mode']:'';
		$state = isset($_REQUEST['state'])?(string)$_REQUEST['state']:'';
		switch($output)
		{
			case "forms":
				if (in_array($mode, array('create', 'edit', 'delete')))
				{
					$help=false;
				}
				break;
			default:
				die('Invalid Parameters for Form Production!')	;
				break;
		}
	} else {
		$help=true;
	}
	
	if ($help==true) {
		die('Unexpected Termination of Unknown Output Variable!');
	}
	
	$local = getLocalityArray($ipaddy);
	
	switch($output)
	{
		default:
			die('Unexpected Termination of Unknown Output Variable!')	;
			break;
		case "form":
			if (function_exists('http_response_code'))
				http_response_code(201);
			die(getHTMLForm($mode, $return, $callback, $output, $version, $local));
			break;
	}
	
	die('Unexpected Termination of Forming Script!')	;
?>		