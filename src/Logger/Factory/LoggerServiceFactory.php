<?php
namespace BoilerAppLogger\Factory;
class LoggerServiceFactory implements \Zend\ServiceManager\FactoryInterface{
    /**
     * @see \Zend\ServiceManager\FactoryInterface::createService()
	 * @param \Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator
	 * @throws \LogicException
     * @return BoilerAppLogger\LoggerService
     */
	public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator){
        $aConfiguration = $oServiceLocator->get('Config');
        $aConfiguration = empty($aConfiguration['BoilerAppLogger'])?array():$aConfiguration['BoilerAppLogger'];

        //Define loggers
        if(isset($aConfiguration['loggers']) && is_array($aConfiguration['loggers'])){
        	$aLoggers = array();
        	foreach($aConfiguration['loggers'] as $sLoggerName => $oLogger){
	        	if(is_callable($oLogger))$oLogger = call_user_func($oLogger,$oServiceLocator);
	        	elseif(is_string($oLogger)){
	        		if(!is_string($sLoggerName))throw new \LogicException('Logger expects its name (string) in the array key, "'.gettype($sLoggerName).'" given');
	        		if(class_exists($oLogger))$oLogger = new $oLogger($oLogger);
	        		elseif($oServiceLocator->has($oLogger))$oLogger = $oServiceLocator->get($oLogger);
	        		else throw new \LogicException('Logger "'.$oLogger.'" is not an existing service or class');
	        	}
	        	elseif(is_array($oLogger)){
	        		if(!isset($oLogger['type']))throw new \LogicException('Logger config expects "type" key, "'.join(', ',array_keys($oLogger)).'" given');
	        		elseif(!is_string($oLogger['type']))throw new \LogicException('Logger "type" config expects string "'.gettype($oLogger['type']).'" given');
	        		elseif(isset($oLogger['name']))$sLoggerName = $oLogger['name'];
	        		elseif(!is_string($sLoggerName))throw new \LogicException(sprintf(
	        			'Logger config expects "name" key, "%s" given, or its name has to be defined in the array key, "%s" given',
	        			join(', ',array_keys($oLogger)),gettype($sLoggerName)
					));

	        		$sLoggerType = $oLogger['logger'];
	        		unset($oLogger['type']);

	        		if(class_exists($sLoggerType))$oLogger = new $sLoggerType($oServiceLocator,$oLogger);
	        		elseif($oServiceLocator->has($sLoggerType))$oLogger = $oServiceLocator->get($sLoggerType);
	        		else throw new \LogicException('Logger "'.$sLoggerType.'" is not an existing service or class');
	        	}
	        	$aLoggers[$sLoggerName] = $oLogger;
        	}
        	$aConfiguration['loggers'] = $aLoggers;
        }
        return \BoilerAppLogger\LoggerService::factory($aConfiguration);
    }
}