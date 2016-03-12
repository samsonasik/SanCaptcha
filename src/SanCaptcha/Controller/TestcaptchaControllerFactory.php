<?php

namespace SanCaptcha\Controller;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TestCaptchaControllerFactory implements FactoryInterface
{
    /**
     * @param AbstractPluginManager|ServiceLocatorInterface $serviceLocator
     *
     * @return TestcaptchaController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Zend\Captcha\AdapterInterface $captchaService */
        $captchaService = $serviceLocator->getServiceLocator()->get('SanCaptcha');

        return new TestcaptchaController($captchaService);
    }
}
