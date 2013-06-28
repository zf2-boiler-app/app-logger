<?php
namespace BoilerAppLogger;
class LoggerService{
	/**
	 * @var \BoilerAppLogger\LoggerServiceConfiguration
	 */
	protected $configuration;

	/**
	 * @var \BoilerAppLogger\Entity\LogEntity
	 */
	protected $currentLog;

	/**
	 * @var \BoilerAppLogger\Repository\LogRepository
	 */
	protected $logRepository;

	/**
	 * Constructor
	 * @param \BoilerAppLogger\LoggerServiceConfiguration $oConfiguration
	 */
	private function __construct(\BoilerAppLogger\LoggerServiceConfiguration $oConfiguration = null){
		if($oConfiguration)$this->setConfiguration($oConfiguration);
	}

	/**
	 * Instantiate a Logger service
	 * @param array|Traversable $aOptions
	 * @throws \InvalidArgumentException
	 * @return \BoilerAppLogger\LoggerService
	 */
	public static function factory($aOptions){
		if($aOptions instanceof \Traversable)$aOptions = \Zend\Stdlib\ArrayUtils::iteratorToArray($aOptions);
		elseif(!is_array($aOptions))throw new \InvalidArgumentException(__METHOD__.' expects an array or Traversable object; received "'.(is_object($aOptions)?get_class($aOptions):gettype($aOptions)).'"');
		return new static(new \BoilerAppLogger\LoggerServiceConfiguration($aOptions));
	}

	/**
	 * @param \Zend\Mvc\MvcEvent $oEvent
	 * @param string $sSessionId
	 * @param \BoilerAppAccessControl\Entity\AuthAccessEntity $oAuthenticatedAuthAccess
	 * @return \BoilerAppLogger\LoggerService
	 */
	public function initialize(\Zend\Mvc\MvcEvent $oEvent,$sSessionId, \BoilerAppAccessControl\Entity\AuthAccessEntity $oAuthenticatedAuthAccess = null){
		if(!(($oRequest = $oEvent->getRequest()) instanceof \Zend\Http\Request))return $this;

		//Create and persist log entity
		$oCurrentLog = new \BoilerAppLogger\Entity\LogEntity();
		if($oAuthenticatedAuthAccess)$oCurrentLog->setLogAuthAccess($oAuthenticatedAuthAccess);

		//Retrieve remote address
		$oRemoteAddress = new \Zend\Http\PhpEnvironment\RemoteAddress();

		if($oAuthenticatedAuthAccess)$oCurrentLog->setLogAuthAccess($oAuthenticatedAuthAccess);
		$this->setCurrentLog($this->getLogRepository()->create(
			$oCurrentLog
			->setLogRequestMethod($oRequest->getMethod())
			->setLogRequestUri($oRequest->getUriString())
			->setLogSessionId($sSessionId?:null)
			->setLogIPAddress($oRemoteAddress->getIpAddress()?:null)
			->setLogRequestHeaders($oRequest->getHeaders())
		));

		//Initialize loggers
		foreach($this->getConfiguration()->getLoggers() as $oLogger){
			$oLogger->setLogRepository($this->getLogRepository())->initialize($oEvent,$this->getCurrentLog());
		}
		return $this;
	}

	/**
	 * @param \BoilerAppLogger\LoggerServiceConfiguration $oConfiguration
	 * @return \BoilerAppLogger\LoggerService
	 */
	public function setConfiguration(\BoilerAppLogger\LoggerServiceConfiguration $oConfiguration){
		$this->configuration = $oConfiguration;
		return $this;
	}

	/**
	 * @throws \LogicException
	 * @return \BoilerAppLogger\LoggerServiceConfiguration
	 */
	public function getConfiguration(){
		if($this->configuration instanceof \BoilerAppLogger\LoggerServiceConfiguration)return $this->configuration;
		throw new \LogicException('Configuration is undefined');
	}

	/**
	 * @param \BoilerAppLogger\Entity\LogEntity $oCurrentLog
	 * @return \BoilerAppLogger\LoggerService
	 */
	protected function setCurrentLog(\BoilerAppLogger\Entity\LogEntity $oCurrentLog){
		$this->currentLog = $oCurrentLog;
		return $this;
	}

	/**
	 * @throws \LogicException
	 * @return \BoilerAppLogger\Entity\LogEntity
	 */
	public function getCurrentLog(){
		if($this->hasCurrentLog())return $this->currentLog;
		throw new \LogicException('Current log entity is undefined');
	}

	/**
	 * @return boolean
	 */
	public function hasCurrentLog(){
		return $this->currentLog instanceof \BoilerAppLogger\Entity\LogEntity;
	}

	/**
	 * @param \BoilerAppLogger\Repository\LogRepository $oLogRepository
	 * @return \BoilerAppLogger\LoggerService
	 */
	public function setLogRepository(\BoilerAppLogger\Repository\LogRepository $oLogRepository){
		$this->logRepository = $oLogRepository;
		return $this;
	}

	/**
	 * @throws \LogicException
	 * @return \BoilerAppLogger\Repository\LogRepository
	 */
	public function getLogRepository(){
		if($this->logRepository instanceof \BoilerAppLogger\Repository\LogRepository)return $this->logRepository;
		throw new \LogicException('Log repository is undefined');
	}
}