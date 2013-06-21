<?php
namespace BoilerAppLogger\Factory;
class MVcLoggerFactory implements \Zend\ServiceManager\FactoryInterface{

    /**
     * @see \Zend\ServiceManager\FactoryInterface::createService()
	 * @param \Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator
     * @return \BoilerAppLogger\Logger\MvcLogger
     */
	public function createService(\Zend\ServiceManager\ServiceLocatorInterface $oServiceLocator){
        $oMvcLogger = new \BoilerAppLogger\Logger\MvcLogger();
        return $oMvcLogger->setLogErrorRepository($oServiceLocator->get('\BoilerAppLogger\Repository\LogErrorRepository'));
    }
}