<?php
namespace BoilerAppLoggerTest;
class ModuleTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractModuleTestCase{

	/**
	 * @var \Zend\Mvc\MvcEvent
	 */
	protected $event;

	/**
	 * @see \BoilerAppTest\PHPUnit\TestCase\AbstractModuleTestCase::setUp()
	 */
	protected function setUp(){
		parent::setUp();
		$aConfiguration = $this->getServiceManager()->get('Config');
		$this->event = new \Zend\Mvc\MvcEvent();
		$this->event
		->setRequest(\Zend\Http\Request::fromString('GET /test HTTP/1.1\r\n\r\nSome Content'))
		->setViewModel(new \Zend\View\Model\ViewModel())
		->setApplication($this->getServiceManager()->get('Application'))
		->setRouter(\Zend\Mvc\Router\Http\TreeRouteStack::factory(isset($aConfiguration['router'])?$aConfiguration['router']:array()))
		->setRouteMatch(new \Zend\Mvc\Router\RouteMatch(array('controller' => 'index','action' => 'index')));
	}

	public function testOnBootstrap(){
		$this->module->onBootstrap($this->event->setName(\Zend\Mvc\MvcEvent::EVENT_BOOTSTRAP));
	}
}