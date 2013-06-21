<?php
namespace BoilerAppLoggerTest\factory;
class LoggerServiceFactoryTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase{
	/**
	 * @var \BoilerAppLogger\Factory\LoggerServiceFactory
	 */
	protected $loggerServiceFactory;

	/**
	 * @var array
	 */
	protected $configuration;

	/**
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	protected function setUp(){
		parent::setUp();
		//Save original configuration
		$this->configuration = $this->getServiceManager()->setAllowOverride(true)->get('config');

		//Initialize logger service factory
		$this->loggerServiceFactory = new \BoilerAppLogger\Factory\LoggerServiceFactory();

	}

	public function testCreateServiceWithLoggerArray(){
		$aConfiguration = $this->getServiceManager()->get('config');
		$aConfiguration['BoilerAppLogger']['loggers'] = array('mvc' => array('type' => 'MvcLogger'));
		$this->getServiceManager()->setService('config',$aConfiguration);
		$this->loggerServiceFactory->createService($this->getServiceManager());
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testCreateServiceWithWrongLoggerType(){
		$aConfiguration = $this->getServiceManager()->get('config');
		$aConfiguration['BoilerAppLogger']['loggers'] = array('mvc' => new \stdClass());
		$this->getServiceManager()->setService('config',$aConfiguration);
		$this->loggerServiceFactory->createService($this->getServiceManager());
	}

	/**
	 * @expectedException LogicException
	 */
	public function testCreateServiceWithWrongLoggerName(){
		$aConfiguration = $this->getServiceManager()->get('config');
		$aConfiguration['BoilerAppLogger']['loggers'] = array('mvc' => 'Wrong');
		$this->getServiceManager()->setService('config',$aConfiguration);
		$this->loggerServiceFactory->createService($this->getServiceManager());
	}

	/**
	 * @expectedException LogicException
	 */
	public function testCreateServiceWithWrongLoggerArrayConfig(){
		$aConfiguration = $this->getServiceManager()->get('config');
		$aConfiguration['BoilerAppLogger']['loggers'] = array('mvc' => array('Wrong'));
		$this->getServiceManager()->setService('config',$aConfiguration);
		$this->loggerServiceFactory->createService($this->getServiceManager());
	}

	/**
	 * @expectedException LogicException
	 */
	public function testCreateServiceWithWrongLoggerArrayTypeConfig(){
		$aConfiguration = $this->getServiceManager()->get('config');
		$aConfiguration['BoilerAppLogger']['loggers'] = array('mvc' => array('type' => 'Wrong'));
		$this->getServiceManager()->setService('config',$aConfiguration);
		$this->loggerServiceFactory->createService($this->getServiceManager());
	}

	/**
	 * @expectedException LogicException
	 */
	public function testCreateServiceWithLoggerArrayWrongName(){
		$aConfiguration = $this->getServiceManager()->get('config');
		$aConfiguration['BoilerAppLogger']['loggers'] = array(array('type' => 'Wrong'));
		$this->getServiceManager()->setService('config',$aConfiguration);
		$this->loggerServiceFactory->createService($this->getServiceManager());
	}

	/**
	 * @see \BoilerAppTest\PHPUnit\TestCase\AbstractTestCase::tearDown()
	 */
	public function tearDown(){
		//Restore configuration
		$this->getServiceManager()->setService('config',$this->configuration)->setAllowOverride(false);
		parent::tearDown();
	}
}