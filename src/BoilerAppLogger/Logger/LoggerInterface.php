<?php
namespace BoilerAppLogger\Logger;
interface LoggerInterface{
	/**
	 * @param \Zend\Mvc\MvcEvent $oEvent
	 * @param \BoilerAppLogger\Entity\LogEntity $oCurrentLog
	 * @return \BoilerAppLogger\Logger\LoggerInterface
	 */
	public function initialize(\Zend\Mvc\MvcEvent $oEvent, \BoilerAppLogger\Entity\LogEntity $oCurrentLog);
}