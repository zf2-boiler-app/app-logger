<?php
namespace BoilerAppLogger;
class LoggerServiceConfiguration extends \Zend\Stdlib\AbstractOptions{
	/**
	 * @var array
	 */
	protected $loggers = array();

	/**
	 * @param array $aLoggers
	 * @return \BoilerAppLogger\LoggerServiceConfiguration
	 */
	public function setLoggers(array $aLoggers){
		foreach($aLoggers as $sLoggerName => $oLogger){
			$this->setLogger($sLoggerName, $oLogger);
		}
		return $this;
	}

	public function setLogger($sLoggerName,\BoilerAppLogger\Logger\LoggerInterface $oLogger){
		return $this;
	}

	/**
	 * @throws \LogicException
	 * @return array
	 */
	public function getLoggers(){
		if(!is_array($this->loggers))throw new \LogicException('Loggers are undefined');
		return $this->loggers;
	}
}