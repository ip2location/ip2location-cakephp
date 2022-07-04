# IP2Location CakePHP Plugin
[![Latest Stable Version](https://img.shields.io/packagist/v/ip2location/ip2location-cakephp.svg)](https://packagist.org/packages/ip2location/ip2location-cakephp)
[![Total Downloads](https://img.shields.io/packagist/dt/ip2location/ip2location-cakephp.svg?style=flat-square)](https://packagist.org/packages/ip2location/ip2location-cakephp)

IP2Location CakePHP plugin enables the user to find the country, region, city, coordinates, zip code, time zone, ISP, domain name, connection type, area code, weather, MCC, MNC, mobile brand name, elevation and usage typ, IP address type and IAB advertising category from IP address using IP2Location database. It has been optimized for speed and memory utilization. Developers can use the API to query all IP2Location BIN databases or web service for applications written using CakePHP.


## INSTALLATION
For CakePHP 4.x

1. Run the command: `composer require ip2location/ip2location-cakephp` to download the plugin into the CakePHP 4 platform.
2. Download latest IP2Location BIN database
    - IP2Location free LITE database at https://lite.ip2location.com
    - IP2Location commercial database at https://www.ip2location.com
3. Unzip and copy the BIN file into */vendor/ip2location/ip2location-cakephp/src/Data* folder.
4. Rename the BIN file to IP2LOCATION.BIN.

**Note:** The plugin has included an old BIN database for your testing and development purpose.
You may want to download a latest copy of BIN database as the URL stated above.
The BIN database refers to the binary file ended with .BIN extension, but not the CSV format.
Please select the right package for download.


## USAGE
In this tutorial, we will show you on how to create a **TestsController** to display the IP information.

1. Create a **TestsController** in CakePHP 4 using the below command line
```
php bin/cake bake controller Tests
```
2. Create a **Tests** folder in */cakephp/templates* if not exists.
3. Create an empty **index.php** file in */cakephp/templates/Tests* folder.
4. Open the **cakephp/src/Controller/TestsController.php** in any text editor.
5. Remove the contents in TestsController.php and add the below lines into the controller file.

Note: You just need to load the IP2Location library with **use IP2LocationCakePHP\Controller\IP2LocationCoresController** to use the functions.
```
<?php
namespace App\Controller;

use App\Controller\AppController;
use IP2LocationCakePHP\Controller\IP2LocationCoresController;

// (required) Define IP2Location API key.
define('IP2LOCATION_API_KEY', 'your_api_key');

// (required) Define IP2Location Web service package of different granularity of return information.
define('IP2LOCATION_PACKAGE', 'WS1');

// (optional) Define to use https or http.
define('IP2LOCATION_USESSL', false);

// (optional) Define extra information in addition to the above-selected package. Refer to https://www.ip2location.com/web-service/ip2location for the list of available addons.
define('IP2LOCATION_ADDONS', []);

// (optional) Define Translation information. Refer to https://www.ip2location.com/web-service/ip2location for available languages.
define('IP2LOCATION_LANGUAGE', 'en');

/**
 * Tests Controller
 */
class TestsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $IP2Location = new IP2LocationCoresController();

        $record = $IP2Location->get('8.8.8.8');
        echo 'Result from BIN Database:<br>';
        echo 'IP Address: ' . $record['ipAddress'] . '<br>';
        echo 'IP Number: ' . $record['ipNumber'] . '<br>';
        echo 'ISO Country Code: ' . $record['countryCode'] . '<br>';
        echo 'Country Name: ' . $record['countryName'] . '<br>';
        echo 'Region Name: ' . $record['regionName'] . '<br>';
        echo 'City Name: ' . $record['cityName'] . '<br>';
        echo 'Latitude: ' . $record['latitude'] . '<br>';
        echo 'Longitude: ' . $record['longitude'] . '<br>';
        echo 'ZIP Code: ' . $record['zipCode'] . '<br>';
        echo 'Time Zone: ' . $record['timeZone'] . '<br>';
        echo 'ISP Name: ' . $record['isp'] . '<br>';
        echo 'Domain Name: ' . $record['domainName'] . '<br>';
        echo 'Net Speed: ' . $record['netSpeed'] . '<br>';
        echo 'IDD Code: ' . $record['iddCode'] . '<br>';
        echo 'Area Code: ' . $record['areaCode'] . '<br>';
        echo 'Weather Station Code: ' . $record['weatherStationCode'] . '<br>';
        echo 'Weather Station Name: ' . $record['weatherStationName'] . '<br>';
        echo 'MCC: ' . $record['mcc'] . '<br>';
        echo 'MNC: ' . $record['mnc'] . '<br>';
        echo 'Mobile Carrier Name: ' . $record['mobileCarrierName'] . '<br>';
        echo 'Elevation: ' . $record['elevation'] . '<br>';
        echo 'Usage Type: ' . $record['usageType'] . '<br>';
        echo 'Address Type: ' . $record['addressType'] . '<br>';
        echo 'Category: ' . $record['category'] . '<br>';

        $record = $IP2Location->getWebService('8.8.8.8');
        echo 'Result from Web service:<br>';
        echo '<pre>';
        print_r ($record);
        echo '</pre>';

        var_dump($IP2Location->isIpv4('8.8.8.8'));echo '<br>';
        var_dump($IP2Location->isIpv6('2001:4860:4860::8888'));echo '<br>';
        print_r($IP2Location->ipv4ToDecimal('8.8.8.8'));echo '<br>';
        print_r($IP2Location->decimalToIpv4(134744072));echo '<br>';
        print_r($IP2Location->ipv6ToDecimal('2001:4860:4860::8888'));echo '<br>';
        print_r($IP2Location->decimalToIpv6('42541956123769884636017138956568135816'));echo '<br>';
        print_r($IP2Location->ipv4ToCidr('8.0.0.0', '8.255.255.255'));echo '<br>';
        print_r($IP2Location->cidrToIpv4('8.0.0.0/8'));echo '<br>';
        print_r($IP2Location->ipv6ToCidr('2002:0000:0000:1234:abcd:ffff:c0a8:0000', '2002:0000:0000:1234:ffff:ffff:ffff:ffff'));echo '<br>';
        print_r($IP2Location->cidrToIpv6('2002::1234:abcd:ffff:c0a8:101/64'));echo '<br>';
        print_r($IP2Location->compressIpv6('2002:0000:0000:1234:FFFF:FFFF:FFFF:FFFF'));echo '<br>';
        print_r($IP2Location->expandIpv6('2002::1234:FFFF:FFFF:FFFF:FFFF'));echo '<br>';
    }

}
```
5. Enter the URL <your domain>/Tests and run. You should see the information of **8.8.8.8** IP address.


## DEPENDENCIES
This library requires IP2Location BIN data file or IP2Location API key to function. You may download the BIN data file at
* IP2Location LITE BIN Data (Free): https://lite.ip2location.com
* IP2Location Commercial BIN Data (Comprehensive): https://www.ip2location.com

You can also sign up for [IP2Location Web Service](https://www.ip2location.com/web-service/ip2location) to get one free API key.


## IPv4 BIN vs IPv6 BIN
Use the IPv4 BIN file if you just need to query IPv4 addresses.

Use the IPv6 BIN file if you need to query BOTH IPv4 and IPv6 addresses.


## SUPPORT
Email: support@ip2location.com

Website: https://www.ip2location.com
