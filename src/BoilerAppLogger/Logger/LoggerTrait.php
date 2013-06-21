<?php
namespace BoilerAppLogger\Logger;
trait LoggerTrait{

	/**
	 * @var \Zend\Mvc\MvcEvent
	 */
	protected $currentEvent;

	/**
	 * @var \BoilerAppLogger\Entity\LogEntity
	 */
	protected $currentLog;

	/**
	 * @var \BoilerAppLogger\Repository\LogRepository
	 */
	protected $logRepository;

	/**
	 * @param \Zend\Mvc\MvcEvent $oEvent
	 * @return \BoilerAppLogger\Logger\LoggerTrait
	 */
	public function setCurrentEvent(\Zend\Mvc\MvcEvent $oEvent){
		$this->currentEvent = $oEvent;
		return $this;
	}

	/**
	 * @throws \LogicException
	 * @return \Zend\Mvc\MvcEvent
	 */
	public function getCurrentEvent(){
		if($this->currentEvent instanceof \Zend\Mvc\MvcEvent)return $this->currentEvent;
		throw new \LogicException('Current event is undefined');
	}

	/**
	 * @param \BoilerAppLogger\Entity\LogEntity $oCurrentLog
	 * @throws \InvalidArgumentException
	 * @return \BoilerAppLogger\Logger\LoggerTrait
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
		if($this->currentLog instanceof \BoilerAppLogger\Entity\LogEntity)return $this->currentLog;
		throw new \LogicException('Current log entity is undefined');
	}

	/**
	 * @param \BoilerAppLogger\Repository\LogRepository $oLogRepository
	 * @return \BoilerAppLogger\Logger\LoggerTrait
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