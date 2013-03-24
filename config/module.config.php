<?php
return array(
	'logger' => array(
		'adapters' => 'LogAdapter'
	),
	'service_manager' => array(
		'factories' => array(
			//Log adapters
			'LogAdapter' =>  function(\Zend\ServiceManager\ServiceManager $oServiceManager){
            	$oLogAdapter = new \BoilerAppLogger\Service\Adapter\DbLogAdapter('logs',$oServiceManager->get('Zend\Db\Adapter\Adapter'));
            	if($oServiceManager->has('UserAuthenticationService'))$oLogAdapter->setUserAuthenticationService($oServiceManager->get('UserAuthenticationService'));
            	return $oLogAdapter;
            },
			//Services
			'LoggerService' => '\BoilerAppLogger\Service\LoggerServiceFactory'
		)
	)
);