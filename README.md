# IP2Location CakePHP Plugin
IP2Location CakePHP plugin enables the user to find the country, region, city, coordinates, zip code, time zone, ISP, domain name, connection type, area code, weather, MCC, MNC, mobile brand name, elevation and usage type that any IP address or hostname originates from. It has been optimized for speed and memory utilization. Developers can use the API to query all IP2Location BIN databases for applications written using CakePHP.


## INSTALLATION
For CakePHP 3.x

1. Run the command: `composer require ip2location/ip2location-cakephp` to download the plugin into the CakePHP 3 platform.
2. Download latest IP2Location BIN database
    - IP2Location free LITE database at http://lite.ip2location.com
    - IP2Location commercial database at http://www.ip2location.com
3. Unzip and copy the BIN file into */vendor/ip2location/ip2location-cakephp/src/Data* folder. 
4. Rename the BIN file to IP2LOCATION.BIN.

**Note:** The plugin has included an old BIN database for your testing and development purpose. 
You may want to download a latest copy of BIN database as the URL stated above.
The BIN database refers to the binary file ended with .BIN extension, but not the CSV format.
Please select the right package for download.


## USAGE
In this tutorial, we will show you on how to create a **TestsController** to display the IP information.

1. Create a **TestsController** in CakePHP 3 using the below command line
```
php bin/cake bake controller Tests
```
2. Create a **Tests** folder in */src/Tempalte* if not exists.
3. Create an empty **index.ctp** file in */src/Template/Tests* folder.
4. Open the **cakephp/src/Controller/TestsController.php** in any text editor.
5. Remove the contents in TestsController.php and add the below lines into the controller file.

Note: You just need to load the IP2Location library with **use IP2LocationCakePHP\Controller\IP2LocationCoresController** to use the functions.
```
<?php
namespace App\Controller;

use App\Controller\AppController;
use IP2LocationCakePHP\Controller\IP2LocationCoresController;

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
    }

}
```
5. Enter the URL <your domain>/Tests and run. You should see the information of **8.8.8.8** IP address.



## DEPENDENCIES (IP2LOCATION BIN DATA FILE)
This library requires IP2Location BIN data file to function. You may download the BIN data file at
* IP2Location LITE BIN Data (Free): http://lite.ip2location.com
* IP2Location Commercial BIN Data (Comprehensive): http://www.ip2location.com

## SUPPORT
Email: support@ip2location.com

Website: http://www.ip2location.com
