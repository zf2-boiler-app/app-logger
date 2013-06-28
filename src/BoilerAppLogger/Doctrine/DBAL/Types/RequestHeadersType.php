<?php
namespace BoilerAppLogger\Doctrine\DBAL\Types;
class RequestHeadersType extends \Doctrine\DBAL\Types\JsonArrayType{
	const TYPE_NAME = 'requestheaders';

	/**
	 * @see \Doctrine\DBAL\Types\JsonArrayType::getName()
	 * @return string
	 */
	public function getName(){
		return self::TYPE_NAME;
	}

	/**
	 * @see \Doctrine\DBAL\Types\JsonArrayType::convertToDatabaseValue()
	 * @param string $oValue
	 * @param \Doctrine\DBAL\Platforms\AbstractPlatform $oPlatform
	 * @throws \InvalidArgumentException
	 * @return string
	 */
	public function convertToDatabaseValue($oValue, \Doctrine\DBAL\Platforms\AbstractPlatform $oPlatform){
		if($oValue instanceof \Zend\Http\Headers)return parent::convertToDatabaseValue($oValue->toArray(), $oPlatform);
		throw new \InvalidArgumentException(sprintf(
			__FUNCTION__.' expects an instance of \Zend\Http\Headers as value, "%s" given',
			is_object($oValue)?get_class($oValue):gettype($oValue)
		));
	}

	/**
	 * @see \Doctrine\DBAL\Types\JsonArrayType::convertToPHPValue()
	 * @param string $sValue
	 * @param \Doctrine\DBAL\Platforms\AbstractPlatform $oPlatform
	 * @throws \Doctrine\DBAL\Types\ConversionException
	 * @return \Zend\Http\Headers
	 */
	public function convertToPHPValue($sValue, \Doctrine\DBAL\Platforms\AbstractPlatform $oPlatform){
		$aValue = parent::convertToPHPValue($sValue, $oPlatform);
		if(is_array($aValue)){
			$oHeaders = new \Zend\Http\Headers();
			return $oHeaders->addHeaders($aValue);
		}
		throw \Doctrine\DBAL\Types\ConversionException::conversionFailedFormat($sValue, $this->getName(), 'json encoded array');
	}
}