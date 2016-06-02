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
 * @version         $Id: databasefactory.php 1000 2015-06-16 23:11:55Z wishcraft $
 * @subpackage		database
 * @description		Blowfish Salts Repository API
 * @link			http://cipher.labs.coop
 * @link			http://sourceoforge.net/projects/chronolabsapis
 */

class ControlDatabaseFactory
{

    /**
     * Get a reference to the only instance of database class and connects to DB
     *
     * if the class has not been instantiated yet, this will also take
     * care of that
     *
     * @static
     * @staticvar ControlDatabase The only instance of database class
     * @return ControlDatabase Reference to the only instance of database class
     */
    static function getDatabaseConnection()
    {
        static $instance;
        if (!isset($instance)) {
            if (file_exists($file = dirname(__FILE__) . '/' . DB_CONTROL_TYPE . 'database.php')) {
                require_once $file;

                if (!defined('DB_CONTROL_PROXY')) {
                    $class = 'Control' . ucfirst(DB_CONTROL_TYPE) . 'DatabaseSafe';
                } else {
                    $class = 'Control' . ucfirst(DB_CONTROL_TYPE) . 'DatabaseProxy';
                }

                /* @var $instance ControlDatabase */
                $instance = new $class();
                $instance->setPrefix(DB_CONTROL_PREF);
                if (!$instance->connect()) {
                    trigger_error('notrace:Unable to connect to database', E_USER_ERROR);
                }
            } else {
                trigger_error('notrace:Failed to load database of type: ' . DB_CONTROL_TYPE . ' in file: ' . __FILE__ . ' at line ' . __LINE__, E_USER_WARNING);
            }
        }
        return $instance;
    }

    /**
     * Gets a reference to the only instance of database class. Currently
     * only being used within the installer.
     *
     * @static
     * @staticvar ControlDatabase The only instance of database class
     * @return ControlDatabase Reference to the only instance of database class
     */
    static function getDatabase()
    {
        static $database;
        if (!isset($database)) {
            if (file_exists($file = dirname(__FILE__) . '/' . DB_CONTROL_TYPE . 'database.php')) {
                include_once $file;
                if (!defined('DB_CONTROL_PROXY')) {
                    $class = 'Control' . ucfirst(DB_CONTROL_TYPE) . 'DatabaseSafe';
                } else {
                    $class = 'Control' . ucfirst(DB_CONTROL_TYPE) . 'DatabaseProxy';
                }
                unset($database);
                $database = new $class();
            } else {
                trigger_error('notrace:Failed to load database of type: ' . DB_CONTROL_TYPE . ' in file: ' . __FILE__ . ' at line ' . __LINE__, E_USER_WARNING);
            }
        }
        return $database;
    }
}