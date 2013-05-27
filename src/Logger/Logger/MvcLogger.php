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
			$oEvent->getEventManager()->attach(\Zend\Mvc\MvcEvent::EVENT_ROUTE,array($this,'logMvcAction'));
			$oEvent->getEventManager()->attach(array(\Zend\Mvc\MvcEvent::EVENT_DISPATCH_ERROR,\Zend\Mvc\MvcEvent::EVENT_RENDER_ERROR),array($this,'logError'));
		}
	}

	/**
	 * @param \Zend\Mvc\MvcEvent $oEvent
	 * @return \BoilerAppLogger\Logger\MvcLogger
	 */
	protected function logMvcAction(\Zend\Mvc\MvcEvent $oEvent){
		return $this;
	}

	/**
	 * @param \Zend\Mvc\MvcEvent $oEvent
	 * @return \BoilerAppLogger\Logger\MvcLogger
	 */
	protected function logError(\Zend\Mvc\MvcEvent $oEvent){
		$oLogError = new \BoilerAppLogger\Entity\LogErrorEntity();
		$oLogError->setLogErrorLog($this->getCurrentLog());
		return $this;
	}
}