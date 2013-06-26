<?php
namespace BoilerAppLogger\Doctrine\DBAL\Types;
class RequestHeadersType extends \Doctrine\DBAL\Types\JsonArrayType{
	/**
	 * @var string
	 */
	protected $name = 'requestheaders';

	public function convertToDatabaseValue($oValue, \Doctrine\DBAL\Platforms\AbstractPlatform $oPlatform){
		if($oValue instanceof \Zend\Http\Headers)return parent::convertToDatabaseValue($oValue->toArray(), $oPlatform);
		throw new \InvalidArgumentException(sprintf(
			__FUNCTION__.' expects an instance of \Zend\Http\Headers as value, "%s" given',
			is_object($oValue)?get_class($oValue):gettype($oValue)
		));
	}

	public function convertToPHPValue($sValue, \Doctrine\DBAL\Platforms\AbstractPlatform $oPlatform){
		$aValue = parent::convertToPHPValue($sValue, $oPlatform);
		if(is_array($aValue)){
			$oHeaders = new \Zend\Http\Headers();
			return $oHeaders->addHeaders($aValue);
		}
		throw new \InvalidArgumentException(sprintf(
			__FUNCTION__.' expects a json encoded array, "%s" given',
			is_scalar($sValue)?$sValue:gettype($sValue)
		));
	}

}