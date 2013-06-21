<?php
namespace BoilerAppLogger\Logger;
interface EventLoggerInterface extends \Zend\EventManager\EventManagerAwareInterface{
	/**
	 * @param \Zend\EventManager\EventManagerInterface $oEventManager
	 * @return \BoilerAppLogger\Logger\EventLoggerInterface
	 */
	public function attach();

	/**
	 * @param \Zend\EventManager\EventManagerInterface $oEventManager
	 * @return \BoilerAppLogger\Logger\EventLoggerInterface
	 */
	public function detach();
}