<?php
return array(
	'doctrine' => array(
		'connection' => array(
			'orm_default' => array(
				'params' => array(
					'dbname'   => 'app-logger-tests'
				)
			)
		)
	),
	'router' => array(
		'routes' => array(
			'Test' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route' => '/test',
					'defaults' => array(
						'controller' => 'BoilerAppLoggerTest\Controller\Test',
						'action' => 'test'
					)
				)
			),
			'Exception' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route' => '/exception',
					'defaults' => array(
						'controller' => 'BoilerAppLoggerTest\Controller\Test',
						'action' => 'exception'
					)
				)
			)
		)
	),
	'controllers' => array(
		'invokables' => array(
			'BoilerAppLoggerTest\Controller\Test' => 'BoilerAppLoggerTest\Controller\TestController',
		)
	),
	'view_manager' => array(
		'display_not_found_reason' => false,
		'display_exceptions' => false,
		'not_found_template' => null,
		'exception_template' => null,
		'template_map' => array(
			'layout/layout' => __DIR__ . '/_files/view/layout.phtml',
			'404' => __DIR__ . '/_files/view/error.phtml',
			'error' => __DIR__ . '/_files/view/error.phtml'
		),
	)
);