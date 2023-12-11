<?php
namespace IP2LocationCakePHP\Controller;

// Web Service Settings
if(defined('IP2LOCATION_IO_API_KEY')) {
	define('USE_IO', true);
} else  {
	define('USE_IO', false);
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

    public function get($ip, $db = '')
    {
        if($db == '') {
            $obj = new \IP2Location\Database(ROOT . DS . 'vendor' . DS . 'ip2location' . DS . 'ip2location-cakephp' . DS . 'src' . DS . 'Data' . DS . 'IP2LOCATION.BIN', \IP2Location\Database::FILE_IO);
        } else {
            $obj = $db;
        }

        try {
            $records = $obj->lookup($ip, \IP2Location\Database::ALL);
        } catch (Exception $e) {
            return null;
        }
        return $records;
    }

    public function getWebService($ip)
    {
		if (USE_IO) {
			// Using IP2Location.io API
			$ioapi_baseurl = 'https://api.ip2location.io/?';
			$params = [
				'key'     => IP2LOCATION_IO_API_KEY,
				'ip'      => $ip,
				'lang'    => ((defined('IP2LOCATION_IO_LANGUAGE')) ? IP2LOCATION_IO_LANGUAGE : ''),
			];
			// Remove parameters without values
			$params = array_filter($params);
			$url = $ioapi_baseurl . http_build_query($params);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FAILONERROR, 0);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);

			$response = curl_exec($ch);

			if (!curl_errno($ch)) {
				if (($data = json_decode($response, true)) === null) {
					return false;
				}
				if (array_key_exists('error', $data)) {
					throw new \Exception(__CLASS__ . ': ' . $data['error']['error_message'], $data['error']['error_code']);
				}
				return $data;
			}

			curl_close($ch);

			return false;
		} else {
			$ws = new \IP2Location\WebService(IP2LOCATION_API_KEY, IP2LOCATION_PACKAGE, IP2LOCATION_USESSL);

			try {
				$records = $ws->lookup($ip, IP2LOCATION_ADDONS, IP2LOCATION_LANGUAGE);
			} catch (Exception $e) {
				return null;
			}

			return $records;
		}
    }

    public function isIpv4($ip)
    {
        $ipTools = new \IP2Location\IpTools();
        return $ipTools->isIpv4($ip);
    }

    public function isIpv6($ip)
    {
        $ipTools = new \IP2Location\IpTools();
        return $ipTools->isIpv6($ip);
    }

    public function ipv4ToDecimal($ip)
    {
        $ipTools = new \IP2Location\IpTools();
        return $ipTools->ipv4ToDecimal($ip);
    }

    public function ipv6ToDecimal($ip)
    {
        $ipTools = new \IP2Location\IpTools();
        return $ipTools->ipv6ToDecimal($ip);
    }

    public function decimalToIpv4($num)
    {
        $ipTools = new \IP2Location\IpTools();
        return $ipTools->decimalToIpv4($num);
    }

    public function decimalToIpv6($num)
    {
        $ipTools = new \IP2Location\IpTools();
        return $ipTools->decimalToIpv6($num);
    }

    public function ipv4ToCidr($ipFrom, $ipTo)
    {
        $ipTools = new \IP2Location\IpTools();
        return $ipTools->ipv4ToCidr($ipFrom, $ipTo);
    }

    public function cidrToIpv4($cidr)
    {
        $ipTools = new \IP2Location\IpTools();
        return $ipTools->cidrToIpv4($cidr);
    }

    public function ipv6ToCidr($ipFrom, $ipTo)
    {
        $ipTools = new \IP2Location\IpTools();
        return $ipTools->ipv6ToCidr($ipFrom, $ipTo);
    }

    public function cidrToIpv6($cidr)
    {
        $ipTools = new \IP2Location\IpTools();
        return $ipTools->cidrToIpv6($cidr);
    }

    public function compressIpv6($ipv6)
    {
        $ipTools = new \IP2Location\IpTools();
        return $ipTools->compressIpv6($ipv6);
    }

    public function expandIpv6($ipv6)
    {
        $ipTools = new \IP2Location\IpTools();
        return $ipTools->expandIpv6($ipv6);
    }

}
