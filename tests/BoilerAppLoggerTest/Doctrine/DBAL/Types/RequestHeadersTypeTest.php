<?php
namespace BoilerAppLoggerTest\Doctrine\DBAL\Types;
class RequestHeadersTypeTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{
	/**
	 * @var \BoilerAppLogger\Doctrine\DBAL\Types\RequestHeadersType
	 */
	protected $requestHeadersType;

	/**
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	protected function setUp(){
		parent::setUp();
		$this->requestHeadersType = \Doctrine\DBAL\Types\Type::getType('requestheaders');
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testConvertToDatabaseValueWithWrongValue(){
		$this->requestHeadersType->convertToDatabaseValue(array(), $this->getServiceManager()->get('doctrine.connection.orm_default')->getDatabasePlatform());
	}

	/**
	 * @expectedException \Doctrine\DBAL\Types\ConversionException
	 */
	public function testConvertToPHPValueWithWrongValue(){
		$this->requestHeadersType->convertToPHPValue('false', $this->getServiceManager()->get('doctrine.connection.orm_default')->getDatabasePlatform());
	}
}