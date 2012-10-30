<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Test for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace SanCaptcha;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    Zend\Mvc\ModuleRouteListener,
    Zend\ModuleManager\Feature\ConfigProviderInterface,
    Zend\ModuleManager\Feature\ServiceProviderInterface,
    Zend\ModuleManager\ModuleManager;
    
use Zend\EventManager\StaticEventManager;


class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    ServiceProviderInterface
{
    
    protected $dbAdapter;
    
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

  /*  public function onBootstrap($e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
   //     $eventManager        = $e->getApplication()->getEventManager();
        
       // $this->dbAdapter = $e->getApplication()->getServiceManager()->get('Zend\Db\Adapter\Adapter');
        
       // $moduleRouteListener = new ModuleRouteListener();
      //  $moduleRouteListener->attach($eventManager);
        
//        $events = StaticEventManager::getInstance();
///        $events->attach(__NAMESPACE__,'dispatch' array($this, 'setAdapterDb'), 100);
 //       $eventManager->attach('dispatch', array($this, 'setAdapterDb'), 100);
        
  //        $routemach = $e->getRouteMatch();
          
//          echo $routemach->getParam('controller');
        $eventManager        = $e->getApplication()->getEventManager();
     //   $eventManager->attach('dispatch', array($this, 'setAdapterDb' )); 
    }*/
    
    /*public function setAdapterDb($e)
    {
        $dbAdapter = $e->getApplication()->getServiceManager()->get('Zend\Db\Adapter\Adapter');
        
        $routemach = $e->getRouteMatch();
//        echo $routemach->getParam('controller');
        
        
      //  $eventManager = $e->getApplication()->getEventManager()->getSharedManager();
        $controller = $e->getTarget();
//        $controller->layout('test');
        
        
        $controllerNamespace = $e->getRouteMatch()->getParam('__NAMESPACE__');
                

        
        $this->dbAdapter  = $dbAdapter;  
        return $dbAdapter; 
    } */
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                
                'Test\Model\AlbumTable' =>  function($sm)  {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\AlbumTable($dbAdapter);
                    return $table;
                },
                
                'Test\Model\TrackTable' =>  function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\TrackTable($dbAdapter);
                    return $table;
                },
                
/*                'Test\Model\TrackTableNoInject' =>  function($sm) {
                    $table = new Model\TrackTableNoInject();
                    return $table;
                }, */
            ),
            
            'invokables' => array(
                'Test\Model\TrackTableNoInject' => 'Test\Model\TrackTableNoInject'
            ),
            
       );
    }
    
    public function onBootstrap($e)
    {
        // Register a dispatch event
        $app = $e->getParam('application');
        $app->getEventManager()->attach('dispatch', array($this, 'setLayout'), -100);
    }

    public function setLayout($e)
    {
        $matches    = $e->getRouteMatch();
        $controller = $matches->getParam('controller');
        
        if (0 !== strpos($controller, __NAMESPACE__, 0)) {
            // not a controller from this module
            return;
        }
        
        // Set the layout template
        //$viewModel = $e->getViewModel();
        //$viewModel->setTemplate('content/layout');
    }
    
/*    public function init(ModuleManager $moduleManager)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach(__NAMESPACE__, 'dispatch', function($e) {
            // This event will only be fired when an ActionController under the MyModule namespace is dispatched.
            $controller = $e->getTarget();
            $controller->layout('layout/alternativelayout');
        }, 100);
    }
 */   
    
    
    /**
     * @param ModuleManager $moduleManager
    */
    public function init(ModuleManager $moduleManager)
    { 
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
       // $events = $moduleManager->getEventManager();
                
      /*  $sharedEvents->attach(__NAMESPACE__, 'dispatch', function($e) {
            $controller = $e->getTarget(); 
            $controller->layout('layout/testlayout');
            
//            $controller->injectControllerDependencies();

              
        }); */ 
    }
    
    
   
    
    
}
