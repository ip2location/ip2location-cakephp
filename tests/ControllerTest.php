<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use IP2LocationCakePHP\Controller\IP2LocationCoresController;

class ControllerTest extends TestCase
{
	public function testGetDb() {
		$IP2Location = new IP2LocationCoresController();
		$db = new \IP2Location\Database('./src/Data/IP2LOCATION.BIN', \IP2Location\Database::FILE_IO);
		$record = $IP2Location->get('8.8.8.8', $db);

		$this->assertEquals(
			'US',
			$record['countryCode'],
		);
	}

	public function testGetWebService() {
		$IP2Location = new IP2LocationCoresController();
		$record = $IP2Location->getWebService('8.8.8.8');

		$this->assertEquals(
			'US',
			$record['country_code'],
		);
	}
}