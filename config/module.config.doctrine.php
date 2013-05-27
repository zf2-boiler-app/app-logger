<?php
return array(
	'driver' => array(
		'BoilerAppLogger_driver' => array(
			'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
			'cache' => 'array',
			'paths' => array(__DIR__.'/../src/BoilerAppLogger/Entity')
		),
		'orm_default' => array(
			'drivers' => array(
				'BoilerAppLogger\Entity' => 'BoilerAppLogger_driver'
			)
		)
	),
	'configuration' => array(
		'orm_default' => array(
			'types' => array(
				'logrequestmethodenum' => 'BoilerAppLogger\Doctrine\DBAL\Types\LogRequestMethodEnum'
			)
		)
	)
);