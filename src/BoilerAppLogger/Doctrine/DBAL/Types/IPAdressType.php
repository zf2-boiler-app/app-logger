<?php
namespace BoilerAppLogger\Doctrine\DBAL\Types;
class IPAddressType extends \Doctrine\DBAL\Types\StringType{
	/**
	 * @var string
	 */
	const TYPE_NAME = 'ipaddress';

	/**
	 * IP address max length
	 * @var int
	 */
	const IP_ADDRESS_LENGTH = 39;

	/**
	 * @see \Doctrine\DBAL\Types\StringType::getName()
	 * @return string
	 */
	public function getName(){
		return self::TYPE_NAME;
	}

	/**
	 * @see \Doctrine\DBAL\Types\Type::getDefaultLength()
	 * @return int
	 */
	public function getDefaultLength(\Doctrine\DBAL\Platforms\AbstractPlatform $oPlatform){
		return self::IP_ADDRESS_LENGTH;
	}

	/**
	 * @see \Doctrine\DBAL\Types\Type::convertToDatabaseValue()
	 * @param string|null $sValue
	 * @param \Doctrine\DBAL\Platforms\AbstractPlatform $oPlatform
	 * @throws \InvalidArgumentException
	 * @return string
	 */
	public function convertToDatabaseValue($sValue, \Doctrine\DBAL\Platforms\AbstractPlatform $oPlatform){
		if(is_null($sValue))return parent::convertToDatabaseValue($sValue, $oPlatform);
		if(!is_string($sValue))throw new \InvalidArgumentException(sprintf(
			__FUNCTION__.' expects a string as value, "%s" given',
			gettype($sValue)
		));
		if($sFilterValue = filter_var($sValue,FILTER_VALIDATE_IP))return parent::convertToDatabaseValue($sFilterValue, $oPlatform);
		throw new \InvalidArgumentException(__FUNCTION__.' expects a valid IP adress as value, "'.$sValue.'" given');
	}

	/**
	 * @see \Doctrine\DBAL\Types\Type::convertToPHPValue()
	 * @param string|null $sValue
	 * @param \Doctrine\DBAL\Platforms\AbstractPlatform $oPlatform
	 * @return string|null
	 */
	public function convertToPHPValue($sValue, \Doctrine\DBAL\Platforms\AbstractPlatform $oPlatform){
		$sValue = parent::convertToPHPValue($sValue, $oPlatform);
		if(is_null($sValue))return $sValue;
		if($sFilterValue = filter_var($sValue,FILTER_VALIDATE_IP))return $sFilterValue;
		throw \Doctrine\DBAL\Types\ConversionException::conversionFailedFormat($sValue, $this->getName(), 'valid IP adress');
	}
}