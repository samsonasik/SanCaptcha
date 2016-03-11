<?php

namespace SanCaptcha\Controller;

class CaptchaControllerFactory
{
    public function __invoke($manager)
    {
        $services = $manager->getServiceLocator();
        $config = $services->get('config');

        return new CaptchaController($config);
    }
}
