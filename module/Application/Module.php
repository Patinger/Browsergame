<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Config\SessionConfig;
use Zend\Session\SessionManager;


class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        $application = $e->getTarget();
        $services    = $application->getServiceManager();

        $translator = $services->get('MvcTranslator');
        $translator->addTranslationFile(
            'phpArray',
            'vendor/zendframework/zendframework/resources/languages/de/Zend_Validate.php',
            'default',
            'de_DE'
        );
        \Zend\Validator\AbstractValidator::setDefaultTranslator($translator);

        $this->initAcl($e);
        $e->getApplication()->getEventManager()->attach('route', array($this, 'checkAcl'));


        /**
         * Optional: If you later want to use namespaces, you can already store the 
         * Manager in the shared (static) Container (=namespace) field
         */
        //Container::setDefaultManager($sessionManager);


        $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();
        $this->authService = $e->getApplication()->getServiceManager()->get('AuthService');
        $viewModel->loggedIn = $this->authService->hasIdentity();
        $identity = $this->authService->getIdentity();
        $viewModel->identity = $identity;
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

    public function initAcl(MvcEvent $e) {
 

        $acl = new \Zend\Permissions\Acl\Acl();
        $acls = include __DIR__ . '/../../config/autoload/acl.php';
        $allResources = array();
        $allRoles = array();

        foreach($acls as $resource => $actions)
        {
            foreach($actions as $action => $roles) 
            {
                $resourceString = $resource.'/'.$action;
                if(!$acl->hasResource($resourceString))
                {
                    $acl->addResource(new \Zend\Permissions\Acl\Resource\GenericResource($resourceString));
                }
                foreach($roles as $role)
                {
                    if (!in_array($role, $allRoles))
                    {
                        $allRoles[] = $role;
                        $role = new \Zend\Permissions\Acl\Role\GenericRole($role);
                        $acl->addRole($role);
                        
                        
                    }    
                    $acl->allow($role, $resourceString);
                }

            }
        }

        //setting to view
        $e->getViewModel()->acl = $acl;
    }
     
    public function checkAcl(MvcEvent $e) 
    {
        $userRole = 'guest';
        $app            = $e->getTarget();
        $serviceManager = $app->getServiceManager();
        $authService         = $serviceManager->get('AuthService');

        if ($authService->hasIdentity())
        {
            $user = $authService->getStorage()->read();
            
            $userRole = $user->role;
        }
        $controller = $e->getRouteMatch()->getMatchedRouteName('controller');
        $action = $e->getRouteMatch()->getParam('action');
        $route = $controller.'/'.$action;
        $allAccess = false;
        if ($e->getViewModel()->acl->hasResource($controller.'/all'))
        {
            if ($e->getViewModel()->acl->isAllowed($userRole, $controller.'/all')) 
            {
                $allAccess = true; 
            }
        }

        if (!$allAccess)
        {
            if ($e->getViewModel()->acl->hasResource($route))
            {
                if (!$e->getViewModel()->acl->isAllowed($userRole, $route)) 
                {
                    $e->getRouteMatch()
                    ->setParam('controller', 'Frontend\Controller\Index')
                    ->setParam('action', 'index');  
                }
            
            }
            else
            {
                    $e->getRouteMatch()
                    ->setParam('controller', 'Frontend\Controller\Index')
                    ->setParam('action', 'index');  
            }
        }
    }
}
