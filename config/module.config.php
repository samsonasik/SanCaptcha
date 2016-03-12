<?php

use SanCaptcha\Middleware;

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

    'service_manager' => [
        'factories' => [
            Middleware\CaptchaMiddleware::class => Middleware\CaptchaMiddlewareFactory::class,
            Middleware\TestcaptchaMiddleware::class => Middleware\TestcaptchaMiddlewareFactory::class
        ],
    ],


    'router' => [

        'routes' => [

            'SanCaptcha' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/san-captcha',
                    'defaults' => [
                        'middleware' => Middleware\TestcaptchaMiddleware::class,
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'captcha_form' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/',
                            'defaults' => [
                                'middleware' => Middleware\TestcaptchaMiddleware::class,
                            ],
                        ],
                    ],

                    'captcha_form_generate' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/captcha/[:id]',
                            'defaults' => [
                                'middleware' => Middleware\CaptchaMiddleware::class,
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
