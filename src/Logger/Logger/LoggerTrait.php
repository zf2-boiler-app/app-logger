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
	 * @var \BoilerAppLogger\Logger\Adapter\AdapterInterface
	 */
	protected $loggerAdapter;

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
		if($this->currentLog instanceof \BoilerAppLogger\Entity\LogEntity)return $this->currentLog;
		throw new \LogicException('Current log entity is undefined');
	}

	/**
	 * @param \BoilerAppLogger\Logger\Adapter\LoggerAdapterInterface $oLoggerAdapter
	 * @return \BoilerAppLogger\Logger\LoggerTrait
	 */
	public function setLoggerAdapter(\BoilerAppLogger\Logger\Adapter\LoggerAdapterInterface $oLoggerAdapter){
		$this->loggerAdapter = $oLoggerAdapter;
		return $this;
	}

	/**
	 * @return \BoilerAppLogger\Logger\Adapter\LoggerAdapterInterface
	*/
	public function getLoggerAdapter(){
		if($this->loggerAdapter instanceof \BoilerAppLogger\Logger\Adapter\LoggerAdapterInterface)return $this->loggerAdapter;
		throw new \LogicException('Logger adapter is undefined');
	}
}