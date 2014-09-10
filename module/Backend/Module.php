<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Backend;

use Backend\Model\User;
use Backend\Model\UserTable;
use Backend\Model\GtueData;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Zend\Authentication\AuthenticationService;
class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
    }

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

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'findstring' => function($sm) {
                    $helper = new View\Helper\Findstring ;
                    return $helper;
                },
                'convertdate' => function($sm) {
                    $helper = new View\Helper\Convertdate ;
                    return $helper;
                }
            ),
            'invokables' => array(
                'formdate' => 'Backend\Form\View\Helper\Datepicker'
            )
        );  
   }

    public function getServiceConfig()
    {
        return array(
            'aliases' => array(
                'Zend\Authentication\AuthenticationService' => 'auth_service',
            ),
            'factories' => array(

                'Backend\Model\GtueData' =>  function($sm) {
                    $fahrzeugGateway = $sm->get('FahrzeugTableGateway');
                    $hauptuntersuchungGateway = $sm->get('HauptuntersuchungTableGateway');
                    $sicherheitsGateway = $sm->get('SicherheitsTableGateway');
                    $aenderungGateway = $sm->get('AenderungTableGateway');
                    $oldtimerGateway = $sm->get('OldtimerTableGateway');
                    $table = new gtueData($fahrzeugGateway, $hauptuntersuchungGateway, $sicherheitsGateway, $aenderungGateway, $oldtimerGateway);
                    return $table;
                },
                'FahrzeugTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    return new TableGateway('fahrzeug', $dbAdapter, null, null);
                },
                'SicherheitsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    return new TableGateway('sp', $dbAdapter, null, null);
                },
                'AenderungTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    return new TableGateway('aenderung', $dbAdapter, null, null);
                },
                'OldtimerTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    return new TableGateway('oldtimer', $dbAdapter, null, null);
                },
                'HauptuntersuchungTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    return new TableGateway('hu', $dbAdapter, null, null);
                },
                'Backend\Model\UserTable' =>  function($sm) {
                    $tableGateway = $sm->get('UserTableGateway');
                    $table = new UserTable($tableGateway);
                    return $table;
                },
                'UserTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new User());
                    return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
                },
                'app_navigation'    => 'Zend\Navigation\Service\DefaultNavigationFactory',
                'member_navigation' => 'Backend\Navigation\Service\MemberNavigationFactory',
                'admin_navigation'  => 'Backend\Navigation\Service\AdminNavigationFactory',
                'AuthService' => function($sm) {
                    //My assumption, you've alredy set dbAdapter
                    //and has users table with columns : user_name and pass_word
                    //that password hashed with md5
                    $dbAdapter           = $sm->get('Zend\Db\Adapter\Adapter');
                    $dbTableAuthAdapter  = new DbTableAuthAdapter($dbAdapter,
                                              'user','username','password', 'MD5(?)');
             

                    $authService = new \Zend\Authentication\AuthenticationService();
                    $authService->setAdapter($dbTableAuthAdapter);
                    $sessionContainer = new \Zend\Session\Container('System_Auth');
                    $sessionContainer->setExpirationSeconds(60*15);
                    $authService->setStorage(new \Zend\Authentication\Storage\Session('System_Auth'));

                    // SQLITE:     
                    /*$dbTableAuthAdapter  = new DbTableAuthAdapter($dbAdapter,
                                              'user','username','password', '?');
             */
                    //$authService = new AuthenticationService();
                    
                    //$authService->setStorage($sm->get('SanAuth\Model\MyAuthStorage'));
              
                    return $authService;
                },
            ),
            
        );
    }

}
