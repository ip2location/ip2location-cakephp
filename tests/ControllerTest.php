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

	public function testIpv4()
	{
		$IP2Location = new IP2LocationCoresController();
		$this->assertTrue($IP2Location->isIpv4('8.8.8.8'));
	}

	public function testInvalidIpv4()
	{
		$IP2Location = new IP2LocationCoresController();
		$this->assertFalse($IP2Location->isIpv4('8.8.8.555'));
	}

	public function testIpv6()
	{
		$IP2Location = new IP2LocationCoresController();
		$this->assertTrue($IP2Location->isIpv6('2001:4860:4860::8888'));
	}

	public function testInvalidIpv6()
	{
		$IP2Location = new IP2LocationCoresController();
		$this->assertFalse($IP2Location->isIpv6('2001:4860:4860::ZZZZ'));
	}

	public function testIpv4Decimal()
	{
		$IP2Location = new IP2LocationCoresController();
		$this->assertEquals(
			134744072,
			$IP2Location->ipv4ToDecimal('8.8.8.8')
		);
	}

	public function testDecimalIpv4()
	{
		$IP2Location = new IP2LocationCoresController();
		$this->assertEquals(
			'8.8.8.8',
			$IP2Location->decimalToIpv4('134744072')
		);
	}

	public function testIpv6Decimal()
	{
		$IP2Location = new IP2LocationCoresController();
		$this->assertEquals(
			'42541956123769884636017138956568135816',
			$IP2Location->ipv6ToDecimal('2001:4860:4860::8888')
		);
	}

	public function testDecimalIpv6()
	{
		$IP2Location = new IP2LocationCoresController();
		$this->assertEquals(
			'2001:4860:4860::8888',
			$IP2Location->decimalToIpv6('42541956123769884636017138956568135816')
		);
	}

	public function testIpv4ToCidr()
	{
		$IP2Location = new IP2LocationCoresController();
		$this->assertEqualsCanonicalizing(
			['8.0.0.0/8'],
			$IP2Location->ipv4ToCidr('8.0.0.0', '8.255.255.255')
		);
	}

	public function testCidrToIpv4()
	{
		$IP2Location = new IP2LocationCoresController();
		$this->assertEqualsCanonicalizing(
			[
				'ip_start' => '8.0.0.0',
				'ip_end'   => '8.255.255.255',
			],
			$IP2Location->cidrToIpv4('8.0.0.0/8')
		);
	}

	public function testIpv6ToCidr()
	{
		$IP2Location = new IP2LocationCoresController();
		$this->assertEqualsCanonicalizing(
			[
				'2002::1234:abcd:ffff:c0a8:0/109',
				'2002::1234:abcd:ffff:c0b0:0/108',
				'2002::1234:abcd:ffff:c0c0:0/106',
				'2002::1234:abcd:ffff:c100:0/104',
				'2002::1234:abcd:ffff:c200:0/103',
				'2002::1234:abcd:ffff:c400:0/102',
				'2002::1234:abcd:ffff:c800:0/101',
				'2002::1234:abcd:ffff:d000:0/100',
				'2002::1234:abcd:ffff:e000:0/99',
				'2002:0:0:1234:abce::/79',
				'2002:0:0:1234:abd0::/76',
				'2002:0:0:1234:abe0::/75',
				'2002:0:0:1234:ac00::/70',
				'2002:0:0:1234:b000::/68',
				'2002:0:0:1234:c000::/66',
			],
			$IP2Location->ipv6ToCidr('2002:0000:0000:1234:abcd:ffff:c0a8:0000', '2002:0000:0000:1234:ffff:ffff:ffff:ffff')
		);
	}

	public function testCidrToIpv6()
	{
		$IP2Location = new IP2LocationCoresController();
		$this->assertEqualsCanonicalizing(
			[
				'ip_start' => '2002:0000:0000:1234:abcd:ffff:c0a8:0101',
				'ip_end'   => '2002:0000:0000:1234:ffff:ffff:ffff:ffff',
			],
			$IP2Location->cidrToIpv6('2002::1234:abcd:ffff:c0a8:101/64')
		);
	}

	public function testCompressIpv6()
	{
		$IP2Location = new IP2LocationCoresController();
		$this->assertEquals(
			'2002::1234:ffff:ffff:ffff:ffff',
			$IP2Location->compressIpv6('2002:0000:0000:1234:ffff:ffff:ffff:ffff')
		);
	}

	public function testExpandIpv6()
	{
		$IP2Location = new IP2LocationCoresController();
		$this->assertEquals(
			'2002:0000:0000:1234:ffff:ffff:ffff:ffff',
			$IP2Location->expandIpv6('2002::1234:ffff:ffff:ffff:ffff')
		);
	}
}