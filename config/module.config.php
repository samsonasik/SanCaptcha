<?php

use SanCaptcha\Controller;

return [

    'san_captcha' => [
        'class' => 'image',
        'options' => [
            // using tmp sys dir to generate Captcha images
            'imgDir' => sys_get_temp_dir(),
            // true => SanCaptcha Module delete the Captcha image, false => Zend delete the Captcha image after some minutes
            'imgDelete' => true,
            // feel free to add fonts in Module's font directory
            'fontDir' => __DIR__ . '/../fonts',
            // if 'font' is not defined, SanCaptcha Module, will pick one randmoly in 'fontDir'
//          'font' => 'arial.ttf',
//          'font' => ['arial.ttf', 'Roboto-Regular.ttf'],
            'width' => 200,
            'height' => 50,
            'dotNoiseLevel' => 40,
            'lineNoiseLevel' => 3,
            "suffix" => ""
        ],
    ],

    'controllers' => [
        'aliases' => [
            'SanCaptcha\Controller\Captcha' => Controller\CaptchaController::class,
            'SanCaptcha\Controller\Testcaptcha' => Controller\TestcaptchaController::class,
        ],
        'factories' => [
            Controller\CaptchaController::class => Controller\CaptchaControllerFactory::class,
            Controller\TestcaptchaController::class => Controller\TestcaptchaControllerFactory::class,
        ],
    ],


    'router' => [

        'routes' => [

            'SanCaptcha' => [
                'type' => 'Literal', // TODO change to Zend\Router\Http\Literal::class router-3 requirement is enforced
                'options' => [
                    'route' => '/san-captcha',
                    'defaults' => [
                        'controller' => 'SanCaptcha\Controller\Testcaptcha',
                        'action' => 'form',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'captcha_form' => [
                        'type' => 'Segment', // TODO change to Zend\Router\Http\Segment::class router-3 requirement is enforced
                        'options' => [
                            'route'    => '/[:action[/]]',
                            'constraints' => [
                                'action' => '[a-zA-Z]+',
                            ],
                            'defaults' => [
                                'controller' => 'SanCaptcha\Controller\Testcaptcha',
                                'action' => 'form',
                            ],
                        ],
                    ],
                    'captcha_form_generate' => [
                        'type' => 'Segment', // TODO change to Zend\Router\Http\Segment::class router-3 requirement is enforced
                        'options' => [
                            'route' => '/captcha/[:id]',
                            'constraints' => [
                                'id' => '[0-9a-zA-Z]+',
                            ],
                            'defaults' => [
                                'controller' => 'SanCaptcha\Controller\Captcha',
                                'action' => 'generate',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'san-captcha' => __DIR__ . '/../view',
        ],


    ],
];
