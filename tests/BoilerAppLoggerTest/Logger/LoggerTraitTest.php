<?php
namespace BoilerAppLoggerTest\Logger;
class LoggerTraitTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{
	/**
	 * @var \BoilerAppLogger\Logger\LoggerTrait
	 */
	protected $loggerTraitObject;

	/**
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	protected function setUp(){
		parent::setUp();
		//Retrieve object for trait
		$this->loggerTraitObject = $this->getObjectForTrait('\BoilerAppLogger\Logger\LoggerTrait');
	}

	/**
	 * @expectedException LogicException
	 */
	public function testGetCurrentEventUnset(){
		$this->loggerTraitObject->getCurrentEvent();
	}

	/**
	 * @expectedException LogicException
	 */
	public function testGetCurrentLogUnset(){
		$this->loggerTraitObject->getCurrentLog();
	}

	/**
	 * @expectedException LogicException
	 */
	public function testLogRepositoryUnset(){
		$this->loggerTraitObject->getLogRepository();
	}
}