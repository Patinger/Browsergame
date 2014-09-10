<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
/*            'backend' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/backend',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Backend\Controller\Book',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/backend/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),*/

            'login' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/backend/login[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Backend\Controller\Login',
                         'action'     => 'login',
                     ),
                 ),
             ),
            'adminlogin' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/backend/adminlogin[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Backend\Controller\Adminlogin',
                         'action'     => 'login',
                     ),
                 ),
             ),
            'backendPreise' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/backendPreise[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Backend\Controller\Preise',
                         'action'     => 'index',
                     ),
                 ),
             ),
            'admin' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/admin[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Backend\Controller\Admin',
                         'action'     => 'index',
                     ),
                 ),
             ),
            'meineautos' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/meineautos[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Backend\Controller\Meineautos',
                         'action'     => 'index',
                     ),
                 ),
             ),
            'user' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/user[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Backend\Controller\User',
                         'action'     => 'index',
                     ),
                 ),
             ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Backend\Controller\Index' => 'Backend\Controller\IndexController',
            'Backend\Controller\Book' => 'Backend\Controller\BookController',
            'Backend\Controller\Author' => 'Backend\Controller\AuthorController',
            'Backend\Controller\Preise' => 'Backend\Controller\PreiseController',
            'Backend\Controller\Adminlogin' => 'Backend\Controller\AdminloginController',
            'Backend\Controller\Meineautos' => 'Backend\Controller\MeineautosController',
            'Backend\Controller\User' => 'Backend\Controller\UserController',
            'Backend\Controller\Admin' => 'Backend\Controller\AdminController',
            'Backend\Controller\Login' => 'Backend\Controller\LoginController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    
);
