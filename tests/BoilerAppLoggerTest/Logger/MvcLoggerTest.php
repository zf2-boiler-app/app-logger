<?php
namespace BoilerAppLoggerTest\Logger;
class MvcLoggerTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{
	/**
	 * @var \BoilerAppLogger\Logger\MvcLogger
	 */
	protected $mvcLogger;

	/**
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	protected function setUp(){
		parent::setUp();
		//Retrieve object for trait
		$this->mvcLogger = $this->getServiceManager()->get('MvcLogger');
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testInitializeWithWrongRequest(){
		$this->mvcLogger->initialize(new \Zend\Mvc\MvcEvent(), new \BoilerAppLogger\Entity\LogEntity());
	}

	public function testDestruct(){
		$oEvent = new \Zend\Mvc\MvcEvent();
		$this->mvcLogger->initialize(
			$oEvent->setRequest(new \Zend\Http\Request())->setApplication($this->getServiceManager()->get('application')),
			new \BoilerAppLogger\Entity\LogEntity()
		)->__destruct();
	}

	/**
	 * @expectedException \LogicException
	 */
	public function testLogRouteWithWrongRouteMatch(){
		$oEvent = new \Zend\Mvc\MvcEvent();
		$this->mvcLogger->logRoute($oEvent);
	}

	/**
	 * @expectedException \LogicException
	 */
	public function testLogErrorWithWrongResponse(){
		$oEvent = new \Zend\Mvc\MvcEvent();
		$this->mvcLogger->logError($oEvent);
	}

	/**
	 * @expectedException \LogicException
	 */
	public function testGetLogErrorRepositoryUndefined(){
		$oMvcLogger = new \BoilerAppLogger\Logger\MvcLogger();
		$oMvcLogger->getLogErrorRepository();
	}
}