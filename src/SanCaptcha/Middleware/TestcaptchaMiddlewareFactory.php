<?php

namespace SanCaptcha\Middleware;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TestCaptchaMiddlewareFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return CaptchaMiddleware
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Zend\Captcha\AdapterInterface $captchaService */
        $captchaService = $serviceLocator->get('SanCaptcha');

        return new TestcaptchaMiddleware($captchaService);
    }
}
