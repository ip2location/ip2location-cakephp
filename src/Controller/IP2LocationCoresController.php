<?php
namespace IP2LocationCakePHP\Controller;

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
        $obj = new \IP2Location\Database(ROOT . DS . 'vendor' . DS . 'ip2location' . DS . 'ip2location-cakephp' . DS . 'src' . DS . 'data' . DS . 'IP2LOCATION.BIN', \IP2Location\Database::FILE_IO);


        try {
            $records = $obj->lookup($ip, \IP2Location\Database::ALL);
        } catch (Exception $e) {
            return null;
        }
        return $records;
    }

}
