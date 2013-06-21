<?php
namespace BoilerAppLogger\Logger;
class MvcLogger extends \BoilerAppLogger\Logger\AbstractLogger implements \BoilerAppLogger\Logger\EventLoggerInterface{
	use \BoilerAppLogger\Logger\EventLoggerTrait;

	/**
	 * @var \BoilerAppLogger\Repository\LogErrorRepository
	 */
	protected $logErrorRepository;

	/**
	 * @see \BoilerAppLogger\Logger\AbstractLogger::initialize()
	 * @param \Zend\Mvc\MvcEvent $oEvent
	 * @param \BoilerAppLogger\Entity\LogEntity $oCurrentLog
	 * @return \BoilerAppLogger\Logger\AbstractLogger
	 */
	public function initialize(\Zend\Mvc\MvcEvent $oEvent, \BoilerAppLogger\Entity\LogEntity $oCurrentLog){
		if(!(($oRequest = $oEvent->getRequest()) instanceof \Zend\Http\Request))throw new \InvalidArgumentException(sprintf(
			'Mvc logger supports Http requests, "%s" given',
			is_object($oRequest)?get_class($oRequest):gettype($oRequest)
		));
		parent::initialize($oEvent, $oCurrentLog);
		$this->setEventManager($this->getCurrentEvent()->getApplication()->getEventManager())->attach();
		return $this;
	}

	/**
	 * @see \BoilerAppLogger\Logger\EventLoggerInterface::attach()
	 * @return \BoilerAppLogger\Logger\MvcLogger
	 */
	public function attach(){
		$oEventManager = $this->getEventManager();
		$this->eventListeners[] = $oEventManager->attach(\Zend\Mvc\MvcEvent::EVENT_ROUTE,array($this,'logRoute'));
		$this->eventListeners[] = $oEventManager->attach(\Zend\Mvc\MvcEvent::EVENT_DISPATCH_ERROR,array($this,'logError'));
		$this->eventListeners[] = $oEventManager->attach(\Zend\Mvc\MvcEvent::EVENT_RENDER_ERROR,array($this,'logError'));
		return $this;
	}


	/**
	 * @param \Zend\Mvc\MvcEvent $oEvent
	 * @return \BoilerAppLogger\Logger\MvcLogger
	 */
	public function logRoute(\Zend\Mvc\MvcEvent $oEvent){
		if(!(($oRouteMatch = $oEvent->getRouteMatch()) instanceof \Zend\Mvc\Router\RouteMatch))throw new \LogicException(sprintf(
			'Route match expects an instance of \Zend\Mvc\Router\RouteMatch, "%s" given',
			is_object($oRouteMatch)?get_class($oRouteMatch):gettype($oRouteMatch)
		));

		$this->getCurrentLog()->setLogMatchedRouteName($oRouteMatch->getMatchedRouteName());

		if($sControllerName = $oRouteMatch->getParam('controller'))$this->getCurrentLog()->setLogControllerName($sControllerName);
		if($sActionName = $oRouteMatch->getParam('action'))$this->getCurrentLog()->setLogActionName($sActionName);

		//Update log entity
		$this->getLogRepository()->update($this->getCurrentLog());

		return $this;
	}

	/**
	 * @param \Zend\Mvc\MvcEvent $oEvent
	 * @return \BoilerAppLogger\Logger\MvcLogger
	 */
	public function logError(\Zend\Mvc\MvcEvent $oEvent){

		//Create log error
		$oLogError = new \BoilerAppLogger\Entity\LogErrorEntity();

		if(!($oException = $oEvent->getParam('exception')) instanceof \Exception){
			if(!($oResponse = $oEvent->getResponse()) instanceof \Zend\Http\Response)throw new \LogicException(sprintf(
				'Response expects an instance of \Zend\Http\Response, "%s" given',
				is_object($oResponse)?get_class($oResponse):gettype($oResponse)
			));
			$oException = new \RuntimeException($oEvent->getError(),$oResponse->getStatusCode());
		}
		else $oLogError->setLogErrorFile($oException->getFile())->setLogErrorLine($oException->getLine());

		$this->getLogErrorRepository()->create($oLogError
			->setLogErrorMessage($oException->getMessage())
			->setLogErrorCode($oException->getCode())
			->setLogErrorTrace($oException->getTraceAsString())
			->setLogErrorLog($this->getCurrentLog())
		);
		return $this;
	}

	/**
	 * @param \BoilerAppLogger\Repository\LogErrorRepository $oLogErrorRepository
	 * @return \BoilerAppLogger\Logger\MvcLogger
	 */
	public function setLogErrorRepository(\BoilerAppLogger\Repository\LogErrorRepository $oLogErrorRepository){
		$this->logErrorRepository = $oLogErrorRepository;
		return $this;
	}

	/**
	 * @throws \LogicException
	 * @return \BoilerAppLogger\Repository\LogErrorRepository
	 */
	public function getLogErrorRepository(){
		if($this->logErrorRepository instanceof \BoilerAppLogger\Repository\LogErrorRepository)return $this->logErrorRepository;
		throw new \LogicException('Log error repository is undefined');
	}
}