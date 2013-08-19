<?php
namespace BoilerAppLoggerTest\Repository;
class LogRepositoryTest extends \BoilerAppTest\PHPUnit\TestCase\AbstractDoctrineTestCase{
	/**
	 * @var \BoilerAppLogger\Repository\LogRepository
	 */
	protected $logRepository;

	/**
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	protected function setUp(){
		parent::setUp();

		//Initialize logger service
		$this->logRepository = $this->getServiceManager()->get('BoilerAppLogger\Repository\LogRepository');
	}

	public function testGetLatestActivityLogs(){
		//Add authentication fixture
		$this->addFixtures(array('BoilerAppLoggerTest\Fixture\ActivityLogsFixture'));


		//Authenticate user
		$this->getServiceManager()->get('AuthenticationService')->authenticate(
			\BoilerAppAccessControl\Service\AuthenticationService::LOCAL_AUTHENTICATION,
			'valid@test.com',
			'valid-credential',
			false
		);

		$this->assertInstanceOf('\Doctrine\Common\Collections\ArrayCollection',$oLatestActivities = $this->logRepository->getLatestActivityLogs($this->getServiceManager()->get('AccessControlService')->getAuthenticatedAuthAccess()));
		$this->assertCount(5, $oLatestActivities);

		$aExpectedIdOrder = array(1,4,5,7,8);
		foreach($oLatestActivities as $iIndex => $oLog){
			$this->assertInstanceOf('BoilerAppLogger\Entity\LogEntity',$oLog);
			$this->assertEquals($aExpectedIdOrder[$iIndex], $oLog->getLogId());
		}
	}
}