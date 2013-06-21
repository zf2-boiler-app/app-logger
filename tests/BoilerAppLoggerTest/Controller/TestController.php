<?php
namespace BoilerAppLoggerTest\Controller;
class TestController extends \Zend\Mvc\Controller\AbstractActionController{
	public function testAction(){
		return false;
	}

	public function exceptionAction(){
		throw new \Exception('Test exception');
	}
}