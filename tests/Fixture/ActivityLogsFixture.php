<?php
namespace BoilerAppLoggerTest\Fixture;
class ActivityLogsFixture extends \BoilerAppLoggerTest\Fixture\UserLoggedFixture{
	public function load(\Doctrine\Common\Persistence\ObjectManager $oObjectManager){
		parent::load($oObjectManager);
		$oAuthAccessEntity = $oObjectManager->find('\BoilerAppAccessControl\Entity\AuthAccessEntity', 1);
		$oDateTime = new \DateTime();

		//Create logs
		foreach(array(
			array('log_action_name' => 'index','log_controller_name' => 'IndexController','log_ip_address' => '127.1.0.1', 'log_auth_access' => $oAuthAccessEntity, 'log_session_id' => '1'),
			array('log_action_name' => 'index2','log_controller_name' => 'IndexController','log_ip_address' => '127.1.0.1', 'log_auth_access' => $oAuthAccessEntity, 'log_session_id' => '1'),
			array('log_action_name' => 'index','log_controller_name' => 'IndexController','log_ip_address' => null, 'log_auth_access' => null, 'log_session_id' => null),
			array('log_action_name' => 'index2','log_controller_name' => 'IndexController','log_ip_address' => '127.1.0.2', 'log_auth_access' => $oAuthAccessEntity, 'log_session_id' => '2'),
			array('log_action_name' => 'index','log_controller_name' => 'IndexController','log_ip_address' => '127.1.0.3', 'log_auth_access' => $oAuthAccessEntity, 'log_session_id' => '3'),
			array('log_action_name' => 'index2','log_controller_name' => 'IndexController','log_ip_address' => null, 'log_auth_access' => null, 'log_session_id' => null),
			array('log_action_name' => 'index','log_controller_name' => 'IndexController','log_ip_address' => '127.1.0.1', 'log_auth_access' => $oAuthAccessEntity, 'log_session_id' => '2'),
			array('log_action_name' => 'index2','log_controller_name' => 'IndexController','log_ip_address' => '127.1.0.1', 'log_auth_access' => $oAuthAccessEntity, 'log_session_id' => '3'),
			array('log_action_name' => 'index','log_controller_name' => 'IndexController','log_ip_address' => null, 'log_auth_access' => null, 'log_session_id' => null),
			array('log_action_name' => 'index2','log_controller_name' => 'IndexController','log_ip_address' => '127.1.0.1', 'log_auth_access' => $oAuthAccessEntity, 'log_session_id' => '4'),
			array('log_action_name' => 'index','log_controller_name' => 'IndexController','log_ip_address' => '127.1.0.5', 'log_auth_access' => $oAuthAccessEntity, 'log_session_id' => '5'),
			array('log_action_name' => 'index2','log_controller_name' => 'IndexController','log_ip_address' => null, 'log_auth_access' => null, 'log_session_id' => null),
			array('log_action_name' => 'index','log_controller_name' => 'IndexController','log_ip_address' => '127.1.0.1', 'log_auth_access' => null, 'log_session_id' => null),
			array('log_action_name' => 'index2','log_controller_name' => 'IndexController','log_ip_address' => '127.1.0.5', 'log_auth_access' => $oAuthAccessEntity, 'log_session_id' => '5'),
			array('log_action_name' => 'index','log_controller_name' => 'IndexController','log_ip_address' => '127.1.0.6', 'log_auth_access' => $oAuthAccessEntity, 'log_session_id' => '6'),
			array('log_action_name' => 'index2','log_controller_name' => 'IndexController','log_ip_address' => null, 'log_auth_access' => null, 'log_session_id' => null)
		) as $aInfosLog){
			$oLogEntity = new \BoilerAppLogger\Entity\LogEntity();
			if($aInfosLog['log_auth_access'])$oLogEntity->setLogAuthAccess($aInfosLog['log_auth_access']);
			$oDateTime->sub(\DateInterval::createFromDateString('1 hour'));
			$oTmpDateTime = clone $oDateTime;

			$oObjectManager->persist($oLogEntity
				->setLogActionName($aInfosLog['log_action_name'])
				->setLogControllerName($aInfosLog['log_controller_name'])
				->setLogIPAddress($aInfosLog['log_ip_address'])
				->setLogRequestMethod(\Zend\Http\Request::METHOD_GET)
				->setLogRequestHeaders(new \Zend\Http\Headers())
				->setLogRequestUri('/')
				->setEntityCreate($oTmpDateTime)
				->setLogSessionId($aInfosLog['log_session_id'])
			);
		}

		//Flush data
		$oObjectManager->flush();
	}
}