<?php
return array(
	//Adapters
	'BoilerAppLogger\Service\Adapter\DbLogAdapter' => __DIR__.'/src/BoilerAppLogger/Service/Adapter/DbLogAdapter.php',
	'BoilerAppLogger\Service\Adapter\LogAdapterInterface' => __DIR__.'/src/BoilerAppLogger/Service/Adapter/LogAdapterInterface.php',

	//Factories
	'BoilerAppLogger\Service\LoggerServiceFactory' => __DIR__.'/src/BoilerAppLogger/Service/LoggerServiceFactory.php',

	//Services
	'BoilerAppLogger\Service\LoggerService' => __DIR__.'/src/BoilerAppLogger/Service/LoggerService.php'
);