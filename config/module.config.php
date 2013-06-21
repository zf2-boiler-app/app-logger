<?php
return array(
	'doctrine' => include 'module.config.doctrine.php',
	'BoilerAppLogger' => array(
		'loggers' => array(
			'Mvc' => 'MvcLogger'
		)
	),
	'service_manager' => array(
		'factories' => array(
			'LoggerService' => '\BoilerAppLogger\Factory\LoggerServiceFactory',
			'MvcLogger' => '\BoilerAppLogger\Factory\MvcLoggerFactory'
		)
	)
);