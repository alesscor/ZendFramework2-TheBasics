<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace VideoManager; // @diffs: instead of namespace Application

return array(
    'router' => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'video' => array( // @diffs: video key instead of application key
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/videos',
                    'defaults' => array(
                        '__NAMESPACE__' => 'VideoManager\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
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
    ),
    'service_manager' => array(
    ),  
    'controllers' => array(
        'invokables' => array(
            'VideoManager\Controller\Index' => Controller\IndexController::class 
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
        		"simple-output"=> __DIR__."/../view/video-manager/index/simple-output.phtml",
        		"copyright"=> __DIR__."/../view/video-manager/index/copyright-notice.phtml"
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    )
);
