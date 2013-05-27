<?php
namespace BoilerAppLogger\Logger;
abstract class AbstractLogger implements \BoilerAppLogger\Logger\LoggerInterface{
	use \BoilerAppLogger\Logger\LoggerTrait;

	/**
	 * @see \BoilerAppLogger\Logger\LoggerInterface::initialize()
	 * @param \Zend\Mvc\MvcEvent $oEvent
	 * @param \BoilerAppLogger\Entity\LogEntity $oCurrentLog
	 * @return \BoilerAppLogger\Logger\AbstractLogger
	 */
	public function initialize(\Zend\Mvc\MvcEvent $oEvent,\BoilerAppLogger\Entity\LogEntity $oCurrentLog){
		return $this->setCurrentEvent($oEvent)->setCurrentLog($sCurrentLoggerId);
	}
}