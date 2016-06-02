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
 * @version         $Id: apiconfig.php 1000 2015-06-16 23:11:55Z wishcraft $
 * @subpackage		api
 * @description		Short Link URIs API
 * @link			http://cipher.labs.coop
 * @link			http://sourceoforge.net/projects/chronolabsapis
 */

require_once __DIR__ . '/class/controldb.php';

/**
 * Opens Access Origin Via networking Route NPN
 */
header('Access-Control-Allow-Origin: *');
header('Origin: *');

/**
 * Turns of GZ Lib Compression for Document Incompatibility
 */
ini_set("zlib.output_compression", 'Off');
ini_set("zlib.output_compression_level", -1);

/**
 * 
 * @var constants
 */
define("API_URL_BASE_PATH", "/");
define("_API_LANGUAGE_DEFAULT", "english");



if (!function_exists("getHTMLForm")) {
	/**
	 *
	 * @param unknown_type $mode
	 * @param unknown_type $clause
	 * @param unknown_type $output
	 * @param unknown_type $version
	 * @return string
	 */
	function getHTMLForm($mode = '', $clause = '', $callback = '', $output = '', $version = 'v2', $local = array())
	{
		$ua = substr(sha1($_SERVER['HTTP_USER_AGENT']), mt_rand(0,32), 9);
		$form = array();
		switch ($mode)
		{
			case "create":
				$form[] = "<form name='" . $ua . "' method='POST' style='font-size: 129%;' enctype='multipart/form-data' action='" . $GLOBALS['protocol'] . $_SERVER["HTTP_HOST"] . '/v2/' .$ua . "/create.api'>";
				$form[] = "\t<table class='alias-create' id='alias-create' style='vertical-align: top !important;'>";
				$form[] = "\t\t<tr>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<label for='email'>Prefered Public Email:</label>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<input type='textbox' name='email' id='email' maxlen='198' size='41' />&nbsp;&nbsp;";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t</tr>";
				$form[] = "\t\t<tr>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<label for='name'>Prefered Public Name:</label>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<input type='textbox' name='name' id='name' maxlen='198' size='41' /><br/>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>&nbsp;</td>";
				$form[] = "\t\t</tr>";
				$form[] = "\t\t<tr>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<label for='emails'>Emails to be hidden from the public<strong>To's</strong>:</label>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<textarea name='emails' id='emails' cols='44' rows='11'></textarea>&nbsp;&nbsp;";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t</tr>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\tThese are all the email address you want filtered from the public view<br/><br/>";
				$form[] = "\t\t\t<span style='font-size:73.1831%;'>Seperated List By ie: [,] [;] [:] [/] [?] [\] [|]...</span><br/>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t<tr>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<label for='names'>Naming to avoid in transit:</label>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<textarea name='names' id='names' cols='44' rows='11'></textarea>&nbsp;&nbsp;";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\tThese are all the names you want filtered from the public view<br/><br/>";
				$form[] = "\t\t\t<span style='font-size:73.1831%;'>Seperated List By ie: [,] [;] [:] [/] [?] [\] [|]...</span><br/>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t<tr>";
				$form[] = "\t\t\t<td colspan='3'>";
				$form[] = "\t\t\t<input type='hidden' name='return' value='" . (empty($clause)?$GLOBALS['protocol'] . $_SERVER["HTTP_HOST"]:$clause) ."'>";
				$form[] = "\t\t\t<input type='hidden' name='callback' value='" . (empty($callback)?'':$callback) ."'>";
				foreach($local as $key => $value)
					$form[] = "\t\t\t<input type='hidden' name='local[".$key."]' value='" . (empty($value)?'':$value) ."'>";
				$form[] = "\t\t\t<input type='submit' value='Create email alias' name='submit'>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t</tr>";
				$form[] = "\t</table>";
				$form[] = "</form>";
				break;
			case "delete":
				$form[] = "<form name='" . $ua . "' method='POST' style='font-size: 129%;' enctype='multipart/form-data' action='" . $GLOBALS['protocol'] . $_SERVER["HTTP_HOST"] . '/v2/' .$ua . "/delete.api'>";
				$form[] = "<p>This fprm will when you get your public hidden/controlled email as well as one of the hidden email addresses you will be emailed a link to your specified address to edit or delete the item!";
				$form[] = "\t<table class='alias-edit' id='alias-edit' style='vertical-align: top !important;'>";
				$form[] = "\t\t<tr>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<label for='public'>Stored Public Email:</label>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<input type='textbox' name='public' id='public' maxlen='198' size='41' />&nbsp;&nbsp;";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t</tr>";
				$form[] = "\t\t<tr>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<label for='control'>Stored Controlled Email:</label>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<input type='textbox' name='control' id='control' maxlen='198' size='41' />&nbsp;&nbsp;";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t</tr>";
				$form[] = "\t\t<tr>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<label for='public'>Email me the link to edit to:</label>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<input type='textbox' name='email' id='email' maxlen='198' size='41' />&nbsp;&nbsp;";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t</tr>";
				$form[] = "\t\t<tr>";
				$form[] = "\t\t\t<td colspan='3'>";
				$form[] = "\t\t\t<input type='hidden' name='return' value='" . (empty($clause)?$GLOBALS['protocol'] . $_SERVER["HTTP_HOST"]:$clause) ."'>";
				$form[] = "\t\t\t<input type='hidden' name='callback' value='" . (empty($callback)?'':$callback) ."'>";
				foreach($local as $key => $value)
					$form[] = "\t\t\t<input type='hidden' name='local[".$key."]' value='" . (empty($value)?'':$value) ."'>";
				$form[] = "\t\t\t<input type='submit' value='Delete item/whole group' name='submit'>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t</tr>";
				$form[] = "\t</table>";
				$form[] = "</form>";
				break;

			case "edit":
				$form[] = "<form name='" . $ua . "' method='POST' style='font-size: 129%;' enctype='multipart/form-data' action='" . $GLOBALS['protocol'] . $_SERVER["HTTP_HOST"] . '/v2/' .$ua . "/edit.api'>";
				$form[] = "<p>This fprm will when you get your public hidden/controlled email as well as one of the hidden email addresses you will be emailed a link to your specified address to edit or delete the item!";
				$form[] = "\t<table class='alias-edit' id='alias-edit' style='vertical-align: top !important;'>";
				$form[] = "\t\t<tr>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<label for='public'>Stored Public Email:</label>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<input type='textbox' name='public' id='public' maxlen='198' size='41' />&nbsp;&nbsp;";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t</tr>";
				$form[] = "\t\t<tr>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<label for='control'>Stored Controlled Email:</label>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<input type='textbox' name='control' id='control' maxlen='198' size='41' />&nbsp;&nbsp;";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t</tr>";
				$form[] = "\t\t<tr>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<label for='public'>Email me the link to edit to:</label>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t<input type='textbox' name='email' id='email' maxlen='198' size='41' />&nbsp;&nbsp;";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t\t<td>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t</tr>";
				$form[] = "\t\t<tr>";
				$form[] = "\t\t\t<td colspan='3'>";
				$form[] = "\t\t\t<input type='hidden' name='return' value='" . (empty($clause)?$GLOBALS['protocol'] . $_SERVER["HTTP_HOST"]:$clause) ."'>";
				$form[] = "\t\t\t<input type='hidden' name='callback' value='" . (empty($callback)?'':$callback) ."'>";
				foreach($local as $key => $value)
					$form[] = "\t\t\t<input type='hidden' name='local[".$key."]' value='" . (empty($value)?'':$value) ."'>";
				$form[] = "\t\t\t<input type='submit' value='Delete item/whole group' name='submit'>";
				$form[] = "\t\t\t</td>";
				$form[] = "\t\t</tr>";
				$form[] = "\t</table>";
				$form[] = "</form>";
				break;
				
		}
		return implode("\n", $form);
	}
}

if (!function_exists("apiLoadLanguage")) {

	/**
	 * apiLoadLanguage ~ loads a language files
	 * 
	 * @param unknown_type $definition
	 * @param unknown_type $language
	 * @return boolean
	 */
	function apiLoadLanguage($definition = 'help', $language = 'english')
	{
		if (!empty($language)) $language = _API_LANGUAGE_DEFAULT;
		if (file_exists($file = __DIR__ . DIRECTORY_SEPARATOR . 'language' . DIRECTORY_SEPARATOR . $language . DIRECTORY_SEPARATOR . "$definition.php"))
		{
			return include_once($file);
		}
		return false;
	}
}


if (!function_exists("getURIData")) {

	/**
	 * getURIData() ~ get data from a URI/URL
	 * 
	 * @param string $uri
	 * @param array $posts
	 * @param getURIData $headers
	 * @param integer $timeout
	 * @param integer $connectout
	 * @return string
	 */
	function getURIData($uri = '', $posts = array(), $headers = array(), $timeout = 36, $connectout = 44)
	{
		if (!function_exists("curl_init"))
		{
			return file_get_contents($uri);
		}
		if (!$btt = curl_init($uri)) {
			return false;
		}
		if (count($headers)) {
			curl_setopt($btt, CURLOPT_HEADER, true);
			curl_setopt($btt, CURLOPT_HEADERS, $headers);
		} else
			curl_setopt($btt, CURLOPT_HEADER, 0);
		if (count($posts)) {
			curl_setopt($btt, CURLOPT_POST, true);
			curl_setopt($btt, CURLOPT_POSTFIELDS, http_build_query($posts));
		} else
			curl_setopt($btt, CURLOPT_POST, 0);
		curl_setopt($btt, CURLOPT_CONNECTTIMEOUT, $connectout);
		curl_setopt($btt, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($btt, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($btt, CURLOPT_VERBOSE, false);
		curl_setopt($btt, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($btt, CURLOPT_SSL_VERIFYPEER, false);
		$data = curl_exec($btt);
		curl_close($btt);
		return $data;
	}
}



if (!function_exists("readRawFile")) {
	
	/**
	 * Return the contents of this File as a string.
	 *
	 * @param string $file
	 * @param string $bytes where to start
	 * @param string $mode
	 * @param boolean $force If true then the file will be re-opened even if its already opened, otherwise it won't
	 * @return mixed string on success, false on failure
	 * @access public
	 */
	function readRawFile($file = '', $bytes = false, $mode = 'rb', $force = false)
	{
		$success = false;
		if ($bytes === false) {
			$success = file_get_contents($file);
		} elseif ($fhandle = fopen($file, $mode)) {
			if (is_int($bytes)) {
				$success = fread($fhandle, $bytes);
			} else {
				$data = '';
				while (! feof($fhandle)) {
					$data .= fgets($fhandle, 4096);
				}
				$success = trim($data);
			}
			fclose($fhandle);
		}
		return $success;
	}
}

if (!function_exists("writeRawFile")) {
	/**
	 * 
	 * @param string $file
	 * @param string $data
	 */
	function writeRawFile($file = '', $data = '')
	{
		if (!is_dir(dirname($file)))
			mkdir(dirname($file), 0777, true);
		if (is_file($file))
			unlink($file);
		$ff = fopen($file, 'w');
		fwrite($ff, $data, strlen($data));
		return fclose($ff);
	}
}

if (!function_exists("mkdirSecure")) {
	/**
	 *
	 * @param unknown_type $path
	 * @param unknown_type $perm
	 * @param unknown_type $secure
	 */
	function mkdirSecure($path = '', $perm = 0777, $secure = true)
	{
		if (!is_dir($path))
		{
			mkdir($path, $perm, true);
			if ($secure == true)
			{
				writeRawFile($path . DIRECTORY_SEPARATOR . '.htaccess', "<Files ~ \"^.*$\">\n\tdeny from all\n</Files>");
			}
			return true;
		}
		return false;
	}
}

if (!function_exists("writeCache")) {
	/**
	 * Write data for key into cache
	 *
	 * @param string $key Identifier for the data
	 * @param mixed $data Data to be cached
	 * @param mixed $duration How long to cache the data, in seconds
	 * @return boolean True if the data was succesfully cached, false on failure
	 * @access public
	 */
	function writeCache($key, $data = array(), $duration = 3600)
	{
		if (!isset($data)) {
			return false;
		}
	
		if (!empty($key))
			$key .= substr(md5($_SERVER["HTTP_HOST"]), 3, 7) . '--' . $key;
		else
			return false;
		
		if ($duration == null) {
			$duration = 3600;
		}
		$windows = false;
		$lineBreak = "\n";
	
		if (substr(PHP_OS, 0, 3) == "WIN") {
			$lineBreak = "\r\n";
			$windows = true;
		}
		$expires = time() + $duration;
		$contents = $expires . $lineBreak . "return " . var_export($data, true) . ";" . $lineBreak;
		return  writeRawFile(API_PATH_IO_CACHE . DIRECTORY_SEPARATOR . $key . '.php');
	}
}

if (!function_exists("readCache")) {
	/**
	 * Read a key from the cache
	 *
	 * @param string $key Identifier for the data
	 * @return mixed The cached data, or false if the data doesn't exist, has expired, or if there was an error fetching it
	 * @access public
	 */
	function readCache($key)
	{
		if (!empty($key))
			$key .= substr(md5($_SERVER["HTTP_HOST"]), 3, 7) . '--' . $key;
		else
			return false;
	
		$cachetime = readRawFile(API_PATH_IO_CACHE . DIRECTORY_SEPARATOR . $key . '.php', 11);
		if ($cachetime !== false && intval($cachetime) < time()) {
			return false;
		}
		$data = readRawFile(API_PATH_IO_CACHE . DIRECTORY_SEPARATOR . $key . '.php', true);
		if (!empty($data))
			$data = eval($data);
		return $data;
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

if (!function_exists("getBaseDomain")) {
	/**
	 * getBaseDomain
	 * 
	 * @param string $url
	 * @return string|unknown
	 */
	function getBaseDomain($url)
	{
		
		static $strata, $fallout, $stratas;
		
		if (empty($strata))
		{
			if (!$strata = readCache('internets_stratas'))
			{
				if (empty($stratas))
					$stratas = file(API_FILE_IO_STRATA);
				shuffle($stratas);
				$attempts = 0;
				while(empty($strata) || $attempts < (count($strata) * 1.65))
				{
					$attempts++;
					$strata = array_keys(unserialize(getURIData($stratas[mt_rand(0, count($stratas)-1)] ."/v1/strata/serial.api")));
				}
				if (!empty($strata))
					writeCache('internets_stratas', $strata, 3600*24*mt(3.75,11));
			}
		}
		if (empty($fallout))
		{
			if (!$fallout = readCache('internets_fallouts'))
			{
				if (empty($stratas))
					$stratas = file(API_FILE_IO_STRATA);
				shuffle($stratas);
				$attempts = 0;
				while(empty($fallout) || $attempts < (count($strata) * 1.65))
				{
					$attempts++;
					$fallout = array_keys(unserialize(getURIData($stratas[mt_rand(0, count($stratas)-1)] ."/v1/fallout/serial.api")));
				}
				if (!empty($fallout))
					writeCache('internets_fallouts', $fallout, 3600*24*mt(3.75,11));
			}
		}
		
		// Get Full Hostname
		$url = strtolower($url);
		$hostname = parse_url($url, PHP_URL_HOST);
		if (!filter_var($hostname, FILTER_VALIDATE_IP) === true) 
			return $hostname;
	
		// break up domain, reverse
		$elements = explode('.', $hostname);
		$elements = array_reverse($elements);
		
		// Returns Base Domain
		if (in_array($elements[0], $fallout) && in_array($elements[1], $strata))
			return $elements[2] . '.' . $elements[1] . '.' . $elements[0];
		elseif (in_array($elements[0], $fallout) || in_array($elements[0], $strata))
			return $elements[1] . '.' . $elements[0];
		
		// Nothing Found
		return $hostname;
	}
}


if (!class_exists("XmlDomConstruct")) {
	/**
	 * class XmlDomConstruct
	 *
	 * 	Extends the DOMDocument to implement personal (utility) methods.
	 *
	 * @author 		Simon Roberts (Chronolabs) simon@labs.coop
	 */
	class XmlDomConstruct extends DOMDocument {

		/**
		 * Constructs elements and texts from an array or string.
		 * The array can contain an element's name in the index part
		 * and an element's text in the value part.
		 *
		 * It can also creates an xml with the same element tagName on the same
		 * level.
		 *
		 * ex:
		 * <nodes>
		 *   <node>text</node>
		 *   <node>
		 *     <field>hello</field>
		 *     <field>world</field>
		 *   </node>
		 * </nodes>
		 *
		 * Array should then look like:
		 *
		 * Array (
		 *   "nodes" => Array (
		 *     "node" => Array (
		 *       0 => "text"
		 *       1 => Array (
		 *         "field" => Array (
		 *           0 => "hello"
		 *           1 => "world"
		 *         )
		 *       )
		 *     )
		 *   )
		 * )
		 *
		 * @param mixed $mixed An array or string.
		 *
		 * @param DOMElement[optional] $domElement Then element
		 * from where the array will be construct to.
		 *
		 * @author 		Simon Roberts (Chronolabs) simon@labs.coop
		 *
		 */
		public function fromMixed($mixed, DOMElement $domElement = null) {

			$domElement = is_null($domElement) ? $this : $domElement;

			if (is_array($mixed)) {
				foreach( $mixed as $index => $mixedElement ) {

					if ( is_int($index) ) {
						if ( $index == 0 ) {
							$node = $domElement;
						} else {
							$node = $this->createElement($domElement->tagName);
							$domElement->parentNode->appendChild($node);
						}
					}

					else {
						$node = $this->createElement($index);
						$domElement->appendChild($node);
					}

					$this->fromMixed($mixedElement, $node);

				}
			} else {
				$domElement->appendChild($this->createTextNode($mixed));
			}

		}
			
	}
}
?>
