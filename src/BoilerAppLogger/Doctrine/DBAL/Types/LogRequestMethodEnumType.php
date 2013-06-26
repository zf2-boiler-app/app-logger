<?php
namespace BoilerAppLogger\Doctrine\DBAL\Types;
class LogRequestMethodEnumType extends \BoilerAppDb\Doctrine\DBAL\Types\AbstractEnumType{
	/**
	 * @var string
	 */
	protected $name = 'logrequestmethodenum';

	/**
	 * @var array
	 */
    protected $values = array(
    	\Zend\Http\Request::METHOD_POST,
    	\Zend\Http\Request::METHOD_GET
    );
}