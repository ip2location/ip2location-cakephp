<?php
namespace IP2LocationCakePHP\Controller;

// Web Service Settings
if(!defined('IP2LOCATION_API_KEY')) {
	define('IP2LOCATION_API_KEY', 'demo');
}

if(!defined('IP2LOCATION_PACKAGE')) {
	define('IP2LOCATION_PACKAGE', 'WS1');
}

if(!defined('IP2LOCATION_USESSL')) {
	define('IP2LOCATION_USESSL', false);
}

if(!defined('IP2LOCATION_ADDONS')) {
	define('IP2LOCATION_ADDONS', []);
}

if(!defined('IP2LOCATION_LANGUAGE')) {
	define('IP2LOCATION_LANGUAGE', 'en');
}

/**
 * IP2LocationCores Controller
 */
class IP2LocationCoresController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        //
    }

    public function get($ip, $query = array())
    {
        $obj = new \IP2Location\Database(ROOT . DS . 'vendor' . DS . 'ip2location' . DS . 'ip2location-cakephp' . DS . 'src' . DS . 'Data' . DS . 'IP2LOCATION.BIN', \IP2Location\Database::FILE_IO);

        try {
            $records = $obj->lookup($ip, \IP2Location\Database::ALL);
        } catch (Exception $e) {
            return null;
        }
        return $records;
    }

    public function getWebService($ip)
    {
        $ws = new \IP2Location\WebService(IP2LOCATION_API_KEY, IP2LOCATION_PACKAGE, IP2LOCATION_USESSL);

        try {
            $records = $ws->lookup($ip, IP2LOCATION_ADDONS, IP2LOCATION_LANGUAGE);
        } catch (Exception $e) {
            return null;
        }

        return $records;
    }

}
