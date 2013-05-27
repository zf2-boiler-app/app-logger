<?php
return array(
	'doctrine' => include 'module.config.doctrine.php',
	'BoilerAppLogger' => array(
		'loggers' => array(
			'Mvc' => 'BoilerAppLogger\Logger\MvcLogger'
		)
	),
	'service_manager' => array(
		'factories' => array(
			'LoggerService' => '\BoilerAppLogger\Factory\LoggerServiceFactory'
		)
	)
);