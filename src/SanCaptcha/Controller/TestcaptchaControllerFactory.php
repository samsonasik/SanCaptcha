<?php

namespace SanCaptcha\Controller;

class TestCaptchaControllerFactory
{
    public function __invoke($manager)
    {
        $services = $manager->getServiceLocator();
        $captchaService = $services->get('SanCaptcha');

        return new TestcaptchaController($captchaService);
    }
}
