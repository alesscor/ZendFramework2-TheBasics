<?php
namespace VideoManager;

use Zend\ModuleManager\ModuleManager;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function xxxinit(ModuleManager $manager){
    	$events=$manager->getEventManager();
    	$sharedEvents=$events->getSharedManager();
    	// here you listen for your event and injects the layout "video-layout" in the callback
    	$sharedEvents->attach(__NAMESPACE__,"dispatch", function($e){
    		$controller=$e->getTarget();
    		if(get_class($controller)=="VideoManager\Controller\IndexController"){
    			$controller->layout("video-layout");
    		}
    	},100);
    }
}
