<?php
namespace BoilerAppLogger;
class Module{
	/**
	 * @param \Zend\Mvc\MvcEvent $oEvent
	 */
	public function onBootstrap($oEvent){
		$oServiceManager = $oEvent->getApplication()->getServiceManager();
		//Initialize Logger service
		$oServiceManager->get('LoggerService')->initialize(
			$oEvent,
			$oServiceManager->get('AccessControlAuthenticationService')->hasIdentity()?$oServiceManager->get('AccessControlService')->getAuthenticatedAuthAccess():null,
			$oServiceManager->get('SessionManager')->getId()
		);
	}

	/**
     * @return array
     */
    public function getConfig(){
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @see \Zend\ModuleManager\Feature\AutoloaderProviderInterface::getAutoloaderConfig()
     * @return array
     */
    public function getAutoloaderConfig(){
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            )
        );
    }
}