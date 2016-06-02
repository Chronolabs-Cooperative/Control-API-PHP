<?php
/**
 * Chronolabs REST Short Link URIs API
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Chronolabs Cooperative http://labs.coop
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         salty
 * @since           2.0.1
 * @author          Simon Roberts <wishcraft@users.sourceforge.net>
 * @version         $Id: functions.php 1000 2015-06-16 23:11:55Z wishcraft $
 * @subpackage		functions
 * @description		Short Link URIs API
 * @link			http://cipher.labs.coop
 * @link			http://sourceoforge.net/projects/chronolabsapis
 */

require_once __DIR__ . '/constants.php';

if (!function_exists("getCreateHTML")) {

	/* function getPeersSupporting()
	 *
	* 	Get a supporting domain system for the API
	* @author 		Simon Roberts (Chronolabs) simon@labs.coop
	*
	* @return 		array()
	*/
	function getCreateHTML($return = '')
	{
		$forms = array();

		$forms[md5($return)]['html'] = getURIData($GLOBALS['source']."v2/create/forms.api", 83, 83, array('ipaddy' => whitelistGetIP(true), 'return'=>$return, 'callback' => $callback));
		$forms[md5($return)]['timeout'] = time() + mt_rand(3600*3.5,3600*9.5) * mt_rand(4.5,11.511);

		return $forms[md5($return)]['html'];
	}
}

if (!function_exists("getEditForm")) {

	/* function getPeersSupporting()
	 *
	* 	Get a supporting domain system for the API
	* @author 		Simon Roberts (Chronolabs) simon@labs.coop
	*
	* @return 		array()
	*/
	function getEditForm($return = '')
	{
		$forms = array();

		$forms[md5($return)]['html'] = getURIData($GLOBALS['source']."v2/edit/forms.api", 83, 83, array('ipaddy' => whitelistGetIP(true), 'return'=>$return, 'callback' => $callback));
		$forms[md5($return)]['timeout'] = time() + mt_rand(3600*3.5,3600*9.5) * mt_rand(4.5,11.511);

		return $forms[md5($return)]['html'];
	}
}

if (!function_exists("getDeleteForm")) {

	/* function getPeersSupporting()
	 *
	* 	Get a supporting domain system for the API
	* @author 		Simon Roberts (Chronolabs) simon@labs.coop
	*
	* @return 		array()
	*/
	function getDeleteForm($return = '')
	{
		$forms = array();

		$forms[md5($return)]['html'] = getURIData($GLOBALS['source']."v2/delete/forms.api", 83, 83, array('ipaddy' => whitelistGetIP(true), 'return'=>$return, 'callback' => $callback));
		$forms[md5($return)]['timeout'] = time() + mt_rand(3600*3.5,3600*9.5) * mt_rand(4.5,11.511);

		return $forms[md5($return)]['html'];
	}
}


if (!function_exists("getLocalityArray")) {
	function getLocalityArray($ipaddy = '127.0.0.1')
	{

		/**
		 * Default
		 * @var strings
		 */
		$local = array();
		$local['iso'] = 'AU';
		$local['country'] = 'Australia';
		$local['region'] = 'Sydney';
		$local['city'] = 'Marrickville South';
		$local['postcode'] = '2204';
		$local['longitude'] = '151.2';
		$local['latitude'] = '-33.8833';
		$local['timezone'] = "10:00";
		$local['ipaddy'] = '127.0.0.1';
		$local['hostname'] = 'localhost';

		shuffle($lookups = cleanWhitespaces(file(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR .  'lookups.diz')));
		foreach($lookups as $lookup)
		{
			$iplocal = json_decode(@getURIData(sprintf($lookup, $ipaddy), 72, 72), true);
			if ($iplocal['country']['iso']!='-' && !empty($iplocal['country']['iso']))
			{
				$local['iso'] = $iplocal['country']['iso'];
				$local['country'] = $iplocal['country']['name'];
				$local['region'] = $iplocal['location']['region'];
				$local['city'] = $iplocal['location']['city'];
				$local['postcode'] = $iplocal['location']['postcode'];
				$local['longitude'] = $iplocal['location']['coordinates']['longitude'];
				$local['latitude'] = $iplocal['location']['coordinates']['latitude'];
				$local['timezone'] = $iplocal['location']['gmt'];
				$local['ipaddy'] = $iplocal['ip'];
				$local['hostname'] = gethostbyaddr($iplocal['ip']);
				return $local;
			}
		}
		foreach($lookups as $lookup)
		{
			$iplocal = json_decode(@getURIData(sprintf($lookup, 'myself'), 72, 72), true);
			if ($iplocal['country']['iso']!='-' && !empty($iplocal['country']['iso']))
			{
				$local['iso'] = $iplocal['country']['iso'];
				$local['country'] = $iplocal['country']['name'];
				$local['region'] = $iplocal['location']['region'];
				$local['city'] = $iplocal['location']['city'];
				$local['postcode'] = $iplocal['location']['postcode'];
				$local['longitude'] = $iplocal['location']['coordinates']['longitude'];
				$local['latitude'] = $iplocal['location']['coordinates']['latitude'];
				$local['timezone'] = $iplocal['location']['gmt'];
				$local['ipaddy'] = $iplocal['ip'];
				$local['hostname'] = gethostbyaddr($iplocal['ip']);
				return $local;
			}
		}
		return $local;
	}
}

if (!function_exists("whitelistGetIP")) {

	/* function whitelistGetIPAddy()
	 *
	* 	provides an associative array of whitelisted IP Addresses
	* @author 		Simon Roberts (Chronolabs) simon@labs.coop
	*
	* @return 		array
	*/
	function whitelistGetIPAddy() {
		return array_merge(whitelistGetNetBIOSIP(), file(dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'whitelist.txt'));
	}
}

if (!function_exists("whitelistGetNetBIOSIP")) {

	/* function whitelistGetNetBIOSIP()
	 *
	* 	provides an associative array of whitelisted IP Addresses base on TLD and NetBIOS Addresses
	* @author 		Simon Roberts (Chronolabs) simon@labs.coop
	*
	* @return 		array
	*/
	function whitelistGetNetBIOSIP() {
		$ret = array();
		foreach(file(dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'whitelist-domains.txt') as $domain) {
			$ip = gethostbyname($domain);
			$ret[$ip] = $ip;
		}
		return $ret;
	}
}

if (!function_exists("whitelistGetIP")) {

	/* function whitelistGetIP()
	 *
	* 	get the True IPv4/IPv6 address of the client using the API
	* @author 		Simon Roberts (Chronolabs) simon@labs.coop
	*
	* @param		$asString	boolean		Whether to return an address or network long integer
	*
	* @return 		mixed
	*/
	function whitelistGetIP($asString = true){
		// Gets the proxy ip sent by the user
		$proxy_ip = '';
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$proxy_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else
		if (!empty($_SERVER['HTTP_X_FORWARDED'])) {
			$proxy_ip = $_SERVER['HTTP_X_FORWARDED'];
		} else
		if (! empty($_SERVER['HTTP_FORWARDED_FOR'])) {
			$proxy_ip = $_SERVER['HTTP_FORWARDED_FOR'];
		} else
		if (!empty($_SERVER['HTTP_FORWARDED'])) {
			$proxy_ip = $_SERVER['HTTP_FORWARDED'];
		} else
		if (!empty($_SERVER['HTTP_VIA'])) {
			$proxy_ip = $_SERVER['HTTP_VIA'];
		} else
		if (!empty($_SERVER['HTTP_X_COMING_FROM'])) {
			$proxy_ip = $_SERVER['HTTP_X_COMING_FROM'];
		} else
		if (!empty($_SERVER['HTTP_COMING_FROM'])) {
			$proxy_ip = $_SERVER['HTTP_COMING_FROM'];
		}
		if (!empty($proxy_ip) && $is_ip = preg_match('/^([0-9]{1,3}.){3,3}[0-9]{1,3}/', $proxy_ip, $regs) && count($regs) > 0)  {
			$the_IP = $regs[0];
		} else {
			$the_IP = $_SERVER['REMOTE_ADDR'];
		}
			
		$the_IP = ($asString) ? $the_IP : ip2long($the_IP);
		return $the_IP;
	}
}


if (!function_exists("checkEmail")) {
	/**
	 * checkEmail()
	 *
	 * @param mixed $email
	 * @return bool|mixed
	 */
	function checkEmail($email)
	{
		if (!$email || !preg_match('/^[^@]{1,64}@[^@]{1,255}$/', $email)) {
			return false;
		}
		$email_array = explode("@", $email);
		$local_array = explode(".", $email_array[0]);
		for ($i = 0; $i < sizeof($local_array); $i++) {
			if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/\=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/\=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
				return false;
			}
		}
		if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) {
			$domain_array = explode(".", $email_array[1]);
			if (sizeof($domain_array) < 2) {
				return false; // Not enough parts to domain
			}
			for ($i = 0; $i < sizeof($domain_array); $i++) {
				if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
					return false;
				}
			}
		}
		return $email;
	}
}


/**
 * 
 * @param unknown_type $url
 * @return multitype:number unknown |multitype:string number
 */
function jumpFromShortenURL($hash = '')
{	
	$hostname = array_reverse(explode('.', $_SERVER['HTTP_HOST']));
	if (!is_dir(API_PATH_IO_REFEREE))
		mkdirSecure(API_PATH_IO_REFEREE, 0777);
	if (!is_file($file = API_PATH_IO_REFEREE  . DIRECTORY_SEPARATOR . 'urls-pointeers.json'))
		$jumps = array();
	else 
		$jumps = json_decode(file_get_contents($file), true);
	foreach($jumps as $finger => $values)
	{
		if (strtolower($values['referee']) == strtolower($hash))
		{
			if (!isset($jumps[$finger]['hits']))
				$jumps[$finger]['hits'] = 1;
			else
				$jumps[$finger]['hits']++;
			$jumps[$finger]['last'] = microtime(true);
			writeRawFile($file, json_encode($jumps));
			
			// Redirect to ensourced URI
			header( "HTTP/1.1 301 Moved Permanently" );
			header("Location: ".$values['url']);
			exit(0);
		} else {
			
		}
	}
}


?>
