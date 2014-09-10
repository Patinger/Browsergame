<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    /*'router' => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/application/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),*/
    'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
              'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
              'cache' => 'array',
              'paths' => array(__DIR__ . '/../src/Application/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Application\Entity' => 'application_entities'
                ),
            )
        )
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'de_DE',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Frontend\Controller\Index' => 'Frontend\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    //global config key for all navigation configurations
    'navigation' => array(
        'member' => array(
            array(
                'label' => 'Home',
                'route' => 'home',
            ),
            array(
                'label' => 'Über Uns',
                'route' => 'ueberuns',
            ),
            array(
                'label' => 'Dienstleistungen',
                'route' => 'dienstleistungen',
                'pages' => array(
                    array(
                         'label' => 'Hauptuntersuchung',
                         'route' => 'dienstleistungen',
                         'action' => 'hauptuntersuchung',
                    ),
                     array(
                         'label' => 'Sicherheitspruefung',
                         'route' => 'dienstleistungen',
                         'action' => 'sicherheitspruefung',
                    ),
                     array(
                         'label' => 'Änderungsabnahme',
                         'route' => 'dienstleistungen',
                         'action' => 'aenderungsabnahme',
                    ),
                     array(
                         'label' => 'Oldtimer-Gutachten',
                         'route' => 'dienstleistungen',
                         'action' => 'oldtimergutachten',
                    ),
                     array(
                         'label' => 'Schadengutachten',
                         'route' => 'dienstleistungen',
                         'action' => 'schadengutachten',
                    ),
                )
            ),
            array(
                'label' => 'Kosten',
                'route' => 'preise',
            ),
            array(
                'label' => 'Kontakt',
                'route' => 'kontakt',
                'pages' => array( //
                     array( // params needed for the china page
                         'label' => 'Kontakt',
                         'route' => 'kontakt',
                    ),
                     array( // params needed for the china page
                         'label' => 'Prüfstelle',
                         'route' => 'kontakt',
                         'action' => 'map',
                    ),
                    array( //
                         'label' => 'Mitarbeiter',
                         'route' => 'kontakt',
                         'action' => 'mitarbeiter',
                    )
                )
            ),
            array(
                'label' => 'Meine Autos',
                'route' => 'meineautos',
            ),
            array(
                'label' => 'Logout',
                'route' => 'login',
                'action' => 'logout',
            )
        ),
        'admin' => array(
            array(
                'label' => 'Home',
                'route' => 'home',
            ),
            array(
                'label' => 'Über Uns',
                'route' => 'ueberuns',
            ),
            array(
                'label' => 'Dienstleistungen',
                'route' => 'dienstleistungen',
                'pages' => array(
                    array(
                         'label' => 'Hauptuntersuchung',
                         'route' => 'dienstleistungen',
                         'action' => 'hauptuntersuchung',
                    ),
                     array(
                         'label' => 'Sicherheitspruefung',
                         'route' => 'dienstleistungen',
                         'action' => 'sicherheitspruefung',
                    ),
                     array(
                         'label' => 'Änderungsabnahme',
                         'route' => 'dienstleistungen',
                         'action' => 'aenderungsabnahme',
                    ),
                     array(
                         'label' => 'Oldtimer-Gutachten',
                         'route' => 'dienstleistungen',
                         'action' => 'oldtimergutachten',
                    ),
                     array(
                         'label' => 'Schadengutachten',
                         'route' => 'dienstleistungen',
                         'action' => 'schadengutachten',
                    ),
                )
            ),
            array(
                'label' => 'Kosten',
                'route' => 'preise',
                'pages' => array(
                     array( // params needed for the china page
                         'label' => 'Normal Anzeigen',
                         'route' => 'preise',
                    ),
                    array( //
                         'label' => 'Preise ändern',
                         'route' => 'backendPreise',
                    )
                )
            ),
            array(
                'label' => 'Kontakt',
                'route' => 'kontakt',
                'pages' => array( //
                     array( // params needed for the china page
                         'label' => 'Kontakt',
                         'route' => 'kontakt',
                    ),
                     array( // params needed for the china page
                         'label' => 'Prüfstelle',
                         'route' => 'kontakt',
                         'action' => 'map',
                    ),
                    array( //
                         'label' => 'Mitarbeiter',
                         'route' => 'kontakt',
                         'action' => 'mitarbeiter',
                    )
                )
            ),
            array(
                'label' => 'Meine Autos',
                'route' => 'meineautos',
            ),
            array(
                'label' => 'Adminbereich',
                'route' => 'admin',
            ),
            array(
                'label' => 'Logout',
                'route' => 'login',
                'action' => 'logout',
            )
        ),
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'home',
            ),
            array(
                'label' => 'Über Uns',
                'route' => 'ueberuns',
            ),
            array(
                'label' => 'Dienstleistungen',
                'route' => 'dienstleistungen',
                'pages' => array(
                    array(
                         'label' => 'Hauptuntersuchung',
                         'route' => 'dienstleistungen',
                         'action' => 'hauptuntersuchung',
                    ),
                     array(
                         'label' => 'Sicherheitspruefung',
                         'route' => 'dienstleistungen',
                         'action' => 'sicherheitspruefung',
                    ),
                     array(
                         'label' => 'Änderungsabnahme',
                         'route' => 'dienstleistungen',
                         'action' => 'aenderungsabnahme',
                    ),
                     array(
                         'label' => 'Oldtimer-Gutachten',
                         'route' => 'dienstleistungen',
                         'action' => 'oldtimergutachten',
                    ),
                     array(
                         'label' => 'Schadengutachten',
                         'route' => 'dienstleistungen',
                         'action' => 'schadengutachten',
                    ),
                )
            ),
            array(
                'label' => 'Kosten',
                'route' => 'preise',
            ),
            array(
                'label' => 'Kontakt',
                'route' => 'kontakt',
                'pages' => array( //
                     array(
                         'label' => 'Kontakt',
                         'route' => 'kontakt',
                    ),
                     array(
                         'label' => 'Prüfstelle',
                         'route' => 'kontakt',
                         'action' => 'map',
                    ),
                    array(
                         'label' => 'Mitarbeiter',
                         'route' => 'kontakt',
                         'action' => 'mitarbeiter',
                    )
                )
            ),
            array(
                'label' => 'Meine Autos',
                'route' => 'login',
            )
        ),
    ),
);
