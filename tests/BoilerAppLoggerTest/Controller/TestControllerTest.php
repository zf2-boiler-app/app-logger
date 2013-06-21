<?php
namespace BoilerAppLoggerTest\Controller;
class TestControllerTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractHttpControllerTestCase{

	public function testUnkownRoute(){
		$this->createDatabase();
		$this->dispatch('/unknown-route');

		//Assert Log has been created
		$this->assertCount(1,$aLogs = $this->getServiceManager()->get('\BoilerAppLogger\Repository\LogRepository')->findAll());
		$this->assertInstanceOf('\BoilerAppLogger\Entity\LogEntity', $oLog = current($aLogs));
		$this->assertEquals(1, $oLog->getLogId());
		$this->assertEquals('http:/', $oLog->getLogRequestUri());
		$this->assertEquals(\Zend\Http\Request::METHOD_GET,$oLog->getLogRequestMethod());
		$this->assertEquals(array(),$oLog->getLogRequestHeaders());
		$this->assertNull($oLog->getLogMatchedRouteName());
		$this->assertNull($oLog->getLogControllerName());
		$this->assertNull($oLog->getLogActionName());
		$this->assertNull($oLog->getLogUser());

		//Assert Log has LogError
		$this->assertInstanceOf('\Doctrine\ORM\PersistentCollection', $oLogErrors = $oLog->getLogLogErrors());
		$this->assertEquals(1, $oLogErrors->count());
		$this->assertInstanceOf('\BoilerAppLogger\Entity\LogErrorEntity', $oLogError = $oLogErrors->current());
		$this->assertEquals(1,$oLogError->getLogErrorId());
		$this->assertEquals('error-router-no-match',$oLogError->getLogErrorMessage());
		$this->assertEquals(\Zend\Http\Response::STATUS_CODE_404,$oLogError->getLogErrorCode());
		$this->assertNull($oLogError->getLogErrorFile());
		$this->assertNull($oLogError->getLogErrorLine());
		$this->assertStringStartsWith('#0 [internal function]:',$oLogError->getLogErrorTrace());
		$this->assertEquals($oLog,$oLogError->getLogErrorLog());
	}

	public function testTestAction(){
		//Add authentication fixture
		$this->addFixtures(array('BoilerAppLoggerTest\Fixture\UserLoggedFixture'));

		//Authenticate user
		$this->getServiceManager()->get('AuthenticationService')->authenticate(
			\BoilerAppAccessControl\Service\AuthenticationService::LOCAL_AUTHENTICATION,
			'valid@test.com',
			'valid-credential'
		);

		$this->dispatch('/test');

		//Assert Log has been created
		$this->assertCount(1,$aLogs = $this->getServiceManager()->get('\BoilerAppLogger\Repository\LogRepository')->findAll());
		$this->assertInstanceOf('\BoilerAppLogger\Entity\LogEntity', $oLog = current($aLogs));
		$this->assertEquals(1, $oLog->getLogId());
		$this->assertEquals('http:/', $oLog->getLogRequestUri());
		$this->assertEquals(\Zend\Http\Request::METHOD_GET,$oLog->getLogRequestMethod());
		$this->assertEquals(array(),$oLog->getLogRequestHeaders());
		$this->assertEquals('Test',$oLog->getLogMatchedRouteName());
		$this->assertEquals('BoilerAppLoggerTest\Controller\Test',$oLog->getLogControllerName());
		$this->assertEquals('test',$oLog->getLogActionName());
		$this->assertInstanceOf('\BoilerAppUser\Entity\UserEntity',$oLog->getLogUser());

		//Assert Log has no LogError
		$this->assertInstanceOf('\Doctrine\ORM\PersistentCollection', $oLogErrors = $oLog->getLogLogErrors());
		$this->assertTrue($oLogErrors->isEmpty());
	}

	public function testException(){
		$this->createDatabase();
		$this->dispatch('/exception');

		//Assert Log has been created
		$this->assertCount(1,$aLogs = $this->getServiceManager()->get('\BoilerAppLogger\Repository\LogRepository')->findAll());
		$this->assertInstanceOf('\BoilerAppLogger\Entity\LogEntity', $oLog = current($aLogs));
		$this->assertEquals(1, $oLog->getLogId());
		$this->assertEquals(\Zend\Http\Request::METHOD_GET,$oLog->getLogRequestMethod());
		$this->assertEquals(array(),$oLog->getLogRequestHeaders());
		$this->assertNull($oLog->getLogUser());

		//Assert Log has LogError
		$this->assertInstanceOf('\Doctrine\ORM\PersistentCollection', $oLogErrors = $oLog->getLogLogErrors());
		$this->assertEquals(1, $oLogErrors->count());
		$this->assertInstanceOf('\BoilerAppLogger\Entity\LogErrorEntity', $oLogError = $oLogErrors->current());
		$this->assertEquals(1,$oLogError->getLogErrorId());
		$this->assertEquals('Test exception',$oLogError->getLogErrorMessage());
		$this->assertEquals(0,$oLogError->getLogErrorCode());
		$this->assertStringEndsWith('BoilerAppLoggerTest\Controller\TestController.php', $oLogError->getLogErrorFile());
		$this->assertEquals(9,$oLogError->getLogErrorLine());
		$this->assertContains('BoilerAppLoggerTest\Controller\TestController->exceptionAction()',$oLogError->getLogErrorTrace());
		$this->assertEquals($oLog,$oLogError->getLogErrorLog());
	}
}