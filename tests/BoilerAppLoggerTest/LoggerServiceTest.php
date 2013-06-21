<?php
namespace BoilerAppLoggerTest;
class LoggerServiceTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{
	/**
	 * @var \BoilerAppLogger\LoggerService
	 */
	protected $loggerService;

	/**
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	protected function setUp(){
		parent::setUp();
		$oLoggerServiceFactory = new \BoilerAppLogger\Factory\LoggerServiceFactory();

		//Initialize logger service
		$this->loggerService = $oLoggerServiceFactory->createService($this->getServiceManager());
	}

	/**
	 * @expectedException LogicException
	 */
	public function testGetConfigurationUnset(){
		$oReflectionClass = new \ReflectionClass('\BoilerAppLogger\LoggerService');
		$oConfiguration = $oReflectionClass->getProperty('configuration');
		$oConfiguration->setAccessible(true);
		$oConfiguration->setValue($this->loggerService, null);

		$oGetConfiguration = $oReflectionClass->getMethod('getConfiguration');
		$oGetConfiguration->setAccessible(true);
		$oGetConfiguration->invokeArgs($this->loggerService,array());
	}

	/**
	 * @expectedException LogicException
	 */
	public function testGetCurrentLogUnset(){
		$oReflectionClass = new \ReflectionClass('\BoilerAppLogger\LoggerService');
		$oCurrentLog = $oReflectionClass->getProperty('currentLog');
		$oCurrentLog->setAccessible(true);
		$oCurrentLog->setValue($this->loggerService, null);

		$oGetCurrentLog = $oReflectionClass->getMethod('getCurrentLog');
		$oGetCurrentLog->setAccessible(true);
		$oGetCurrentLog->invokeArgs($this->loggerService,array());
	}

	/**
	 * @expectedException LogicException
	 */
	public function testGetLogRepositoryUnset(){
		$oReflectionClass = new \ReflectionClass('\BoilerAppLogger\LoggerService');
		$oLogRepository = $oReflectionClass->getProperty('logRepository');
		$oLogRepository->setAccessible(true);
		$oLogRepository->setValue($this->loggerService, null);

		$oGetLogRepository = $oReflectionClass->getMethod('getLogRepository');
		$oGetLogRepository->setAccessible(true);
		$oGetLogRepository->invokeArgs($this->loggerService,array());
	}
}