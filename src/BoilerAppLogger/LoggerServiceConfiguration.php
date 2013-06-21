<?php
namespace BoilerAppLogger;
class LoggerServiceConfiguration extends \Zend\Stdlib\AbstractOptions{
	/**
	 * @var array
	 */
	protected $loggers = array();

	/**
	 * @param array $aLoggers
	 * @throws \InvalidArgumentException
	 * @return \BoilerAppLogger\LoggerServiceConfiguration
	 */
	public function setLoggers(array $aLoggers){
		foreach($aLoggers as $sLoggerName => $oLogger){
			if(!($oLogger instanceof \BoilerAppLogger\Logger\LoggerInterface))throw new \InvalidArgumentException(sprintf(
				'Logger "%s" should be a instanceof \BoilerAppLogger\Logger\LoggerInterface, "%s" given',
				$sLoggerName,is_object($oLogger)?get_class($oLogger):gettype($oLogger)
			));
			$this->setLogger($sLoggerName, $oLogger);
		}
		return $this;
	}

	/**
	 * @param string $sLoggerName
	 * @param \BoilerAppLogger\Logger\LoggerInterface $oLogger
	 * @throws \InvalidArgumentException
	 * @return \BoilerAppLogger\LoggerServiceConfiguration
	 */
	public function setLogger($sLoggerName,\BoilerAppLogger\Logger\LoggerInterface $oLogger){
		if(!is_string($sLoggerName))throw new \InvalidArgumentException('Logger name expects string, "'.gettype($sLoggerName).'" given');
		$this->loggers[$sLoggerName] = $oLogger;
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