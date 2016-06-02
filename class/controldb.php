<?php
/**
 * Chronolabs REST Blowfish Salts Repository API
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
 * @package         salty
 * @since           2.0.1
 * @author          Simon Roberts <wishcraft@users.sourceforge.net>
 * @version         $Id: manager.php 1000 2015-06-16 23:11:55Z wishcraft $
 * @subpackage		database
 * @description		Blowfish Salts Repository API
 * @link			http://cipher.labs.coop
 * @link			http://sourceoforge.net/projects/chronolabsapis
 */

/**
 * @var string		Database Name (Database Source One)
 */
define('DB_CONTROL_NAME', 'control_labs_coop');

/**
 * @var string		Database Username (Database Source One)
 */
define('DB_CONTROL_USER', 'controlapi');

/**
 * @var string		Database Password (Database Source One)
 */
define('DB_CONTROL_PASS', '$$$$n0buxa');

/**
 * @var string		Database Host Address/IP (Database Source One)
 */
define('DB_CONTROL_HOST', 'localhost');

/**
 * @var string		Database Character Set (Global)
 */
define('DB_CONTROL_CHAR', 'utf8');

/**
 * @var string		Database Persistency Connection (Global)
 */
define('DB_CONTROL_PERS', false);

/**
 * @var string		Database Types (Global)
 */
define('DB_CONTROL_TYPE', 'mysql');

/**
 * @var string		Database Prefix (Global)
 */
define('DB_CONTROL_PREF', 'control_');

/**
 * @var string		Database Name (Database Source Two)
 */
define('DB_CONTROL_NAME2', 'control_labs_coop');

/**
 * @var string		Database Username (Database Source Two)
 */
define('DB_CONTROL_USER2', 'controlapi_');

/**
 * @var string		Database Password (Database Source Two)
 */
define('DB_CONTROL_PASS2', '$$$$n0buxa');

/**
 * @var string		Database Host Address/IP (Database Source Two)
 */
define('DB_CONTROL_HOST2', 'localhost');


require_once __DIR__ . '/database.php';
require_once __DIR__ . '/databasefactory.php';

/**
 * @var object		Database Handler Object (Globals)
 */
$GLOBALS['controlDB'] = ControlDatabaseFactory::getDatabaseConnection();

?>
