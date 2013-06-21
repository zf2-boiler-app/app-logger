<?php
namespace BoilerAppLogger\Logger;
interface LoggerInterface{
	/**
	 * @param \Zend\Mvc\MvcEvent $oEvent
	 * @param \BoilerAppLogger\Entity\LogEntity $oCurrentLog
	 * @return \BoilerAppLogger\Logger\LoggerInterface
	 */
	public function initialize(\Zend\Mvc\MvcEvent $oEvent, \BoilerAppLogger\Entity\LogEntity $oCurrentLog);

	/**
	 * @param \BoilerAppLogger\Repository\LogRepository $oLogRepository
	 * @return \BoilerAppLogger\Logger\LoggerInterface
	 */
	public function setLogRepository(\BoilerAppLogger\Repository\LogRepository $oLogRepository);

	/**
	 * @return \BoilerAppLogger\Repository\LogRepository
	 */
	public function getLogRepository();
}