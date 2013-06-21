<?php
namespace BoilerAppLogger\Logger;
trait EventLoggerTrait{
	use  \Zend\EventManager\EventManagerAwareTrait;

	/**
	 * @var array
	 */
	protected $eventListeners = array();

	/**
	 * @return \BoilerAppLogger\Logger\LoggerTrait
	 */
	public function detach(){
		foreach($this->eventListeners as &$oListener){
			$this->getEventManager()->detach($oListener);
			unset($oListener);
		}
		return $this;
	}

	/**
	 * Destructor
	 */
	public function __destruct(){
		$this->detach();
	}
}