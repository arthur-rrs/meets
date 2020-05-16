<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Controller\CarController;
use Application\Controller\ClassController;
use Application\Controller\Factory\CarControllerFactory;
use Application\Controller\Factory\ClassControllerFactory;
use Application\Controller\Factory\MakeControllerFactory;
use Application\Controller\MakeController;
use Application\InputFilter\CarInputFilter;
use Application\InputFilter\Factory\CarInputFilterFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'make' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/make',
                    'defaults' => [
                        'controller' => MakeController::class,
                    ],
                ],
            ],
            'class' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/class',
                    'defaults' => [
                        'controller' => ClassController::class,
                    ],
                ],
            ],
            'car' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/car',
                    'defaults' => [
                        'controller' => CarController::class,
                    ],
                ],
            ]
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            MakeController::class => MakeControllerFactory::class,
            ClassController::class => ClassControllerFactory::class,
            CarController::class => CarControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
    'input_filters' => [
        'factories' => [
            CarInputFilter::class => CarInputFilterFactory::class,
        ],
    ],
];
