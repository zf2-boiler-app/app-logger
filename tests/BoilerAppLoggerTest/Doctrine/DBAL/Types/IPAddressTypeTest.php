<?php
namespace BoilerAppLoggerTest\Doctrine\DBAL\Types;
class IPAddressTypeTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{
	/**
	 * @var \BoilerAppLogger\Doctrine\DBAL\Types\IPAddressType
	 */
	protected $ipAddressType;

	/**
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	protected function setUp(){
		parent::setUp();
		$this->ipAddressType = \Doctrine\DBAL\Types\Type::getType('ipaddress');
	}

	public function testGetDefaultLength(){
		$this->assertEquals(39, $this->ipAddressType->getDefaultLength($this->getServiceManager()->get('doctrine.connection.orm_default')->getDatabasePlatform()));
	}

	public function testConvertToDatabaseValue(){
		$this->ipAddressType->convertToDatabaseValue('127.0.0.1', $this->getServiceManager()->get('doctrine.connection.orm_default')->getDatabasePlatform());
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testConvertToDatabaseValueWithWrongpeValue(){
		$this->ipAddressType->convertToDatabaseValue(array(), $this->getServiceManager()->get('doctrine.connection.orm_default')->getDatabasePlatform());
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testConvertToDatabaseValueWithWrongValue(){
		$this->ipAddressType->convertToDatabaseValue('false', $this->getServiceManager()->get('doctrine.connection.orm_default')->getDatabasePlatform());
	}

	/**
	 * @expectedException \Doctrine\DBAL\Types\ConversionException
	 */
	public function testConvertToPHPValueWithWrongValue(){
		$this->ipAddressType->convertToPHPValue('false', $this->getServiceManager()->get('doctrine.connection.orm_default')->getDatabasePlatform());
	}
}