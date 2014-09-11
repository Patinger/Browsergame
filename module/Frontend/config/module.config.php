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
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Frontend\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            /*'febook' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/book[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Frontend\Controller\Book',
                         'action'     => 'index',
                     ),
                 ),
             ),*/
            'ueberuns' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/ueberuns[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Frontend\Controller\Ueberuns',
                         'action'     => 'index',
                     ),
                 ),
             ),
            'kontakt' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/kontakt[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Frontend\Controller\Kontakt',
                         'action'     => 'index',
                     ),
                 ),
             ),
            'terrain' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/terrain[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Frontend\Controller\Terrain',
                         'action'     => 'terrainjson',
                     ),
                 ),
             ),
            'dienstleistungen' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/dienstleistungen[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Frontend\Controller\Dienstleistungen',
                         'action'     => 'index',
                     ),
                 ),
             ),
            'impressum' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/impressum[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Frontend\Controller\Impressum',
                         'action'     => 'index',
                     ),
                 ),
             ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Frontend\Controller\Index' => 'Frontend\Controller\IndexController',
            'Frontend\Controller\Book' => 'Frontend\Controller\BookController',
            'Frontend\Controller\Ueberuns' => 'Frontend\Controller\UeberunsController',
            'Frontend\Controller\Kontakt' => 'Frontend\Controller\KontaktController',
            'Frontend\Controller\Terrain' => 'Frontend\Controller\TerrainController',
            'Frontend\Controller\Impressum' => 'Frontend\Controller\ImpressumController',
            'Frontend\Controller\Dienstleistungen' => 'Frontend\Controller\DienstleistungenController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
