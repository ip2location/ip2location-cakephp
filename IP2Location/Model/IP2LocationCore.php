<?php
/**
 * IP2Location Core
 *
 * Model class to find a location using visitor IP address using
 * IP2Location database.
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to the MIT License that is available
 * through the world-wide-web at the following URI:
 * http://www.opensource.org/licenses/mit-license.php.
 *
 * @author     IP2Location <support@ip2location.com>
 * @copyright  Copyright 2014, IP2Location.com (http://www.ip2location.com)
 * @license    MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @version    1.0
 * @since      File available since Release 2.0
 */

App::uses('AppModel', 'Model');

/**
 * Include PEAR Net_GeoIP class
 */
App::import('IP2Location.Lib', 'IP2Location');

/**
 * GeoIP Location class
 */
class IP2LocationCore extends AppModel
{
    /**
     * Container for data returned by the find method
     *
     * @var array
     * @access public
     */
    public $data = array();

    /**
     * The name of the model
     *
     * @var string
     * @access public
     */
    public $name = 'IP2LocationCore';

    public $useTable = false;

    /**
     * Find
     *
     * @param string $ipAddr The IP Address for which to find the location.
     * @return mixed Array of location data or null if no location found.
     * @access public
     */
    public function get($ip, $query = array())
    {
		$obj = new IP2Location(dirname(dirname(__FILE__)) . DS . 'data' . DS . 'IP2LOCATION.BIN', IP2Location::FILE_IO);

        try {
			$records = $obj->lookup($ip, IP2Location::ALL);
        } catch (Exception $e) {
            return null;
        }
        return $records;
    }
}
