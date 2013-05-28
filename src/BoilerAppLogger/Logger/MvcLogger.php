<?php
namespace BoilerAppLogger\Logger;
class MvcLogger extends \BoilerAppLogger\Logger\AbstractLogger{

	/**
	 * @see \BoilerAppLogger\Logger\AbstractLogger::initialize()
	 * @param \Zend\Mvc\MvcEvent $oEvent
	 * @param \BoilerAppLogger\Entity\LogEntity $oCurrentLog
	 * @return \BoilerAppLogger\Logger\AbstractLogger
	 */
	public function initialize(\Zend\Mvc\MvcEvent $oEvent, \BoilerAppLogger\Entity\LogEntity $oCurrentLog){
		parent::initialize($oEvent, $oCurrentLog);

		if(($oRequest = $oEvent->getRequest()) instanceof \Zend\Http\Request){
			$oCurrentLog
				->setLogRequestMethod($oRequest->getMethod())
				->setLogRequestUri($oRequest->getUriString())
				->setLogRequestHeaders($oRequest->getHeaders()->toArray());
			$oEventManager = $oEvent->getApplication()->getEventManager();
			$oEventManager->attach(\Zend\Mvc\MvcEvent::EVENT_ROUTE,array($this,'logMvcAction'));
			$oEventManager->attach(array(\Zend\Mvc\MvcEvent::EVENT_DISPATCH_ERROR,\Zend\Mvc\MvcEvent::EVENT_RENDER_ERROR),array($this,'logError'));
		}
	}

	/**
	 * @param \Zend\Mvc\MvcEvent $oEvent
	 * @return \BoilerAppLogger\Logger\MvcLogger
	 */
	public function logMvcAction(\Zend\Mvc\MvcEvent $oEvent){
		return $this;
	}

	/**
	 * @param \Zend\Mvc\MvcEvent $oEvent
	 * @return \BoilerAppLogger\Logger\MvcLogger
	 */
	public function logError(\Zend\Mvc\MvcEvent $oEvent){
		$oLogError = new \BoilerAppLogger\Entity\LogErrorEntity();
		$oLogError->setLogErrorLog($this->getCurrentLog());
		return $this;
	}
}