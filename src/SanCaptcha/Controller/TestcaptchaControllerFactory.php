<?php

namespace SanCaptcha\Controller;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TestCaptchaControllerFactory implements FactoryInterface
{
    /**
     * @param AbstractPluginManager|ServiceLocatorInterface $abstractPluginManager
     *
     * @return TestcaptchaController
     */
    public function createService(ServiceLocatorInterface $abstractPluginManager)
    {
        /** @var \Zend\Captcha\AdapterInterface $captchaService */
        $captchaService = $abstractPluginManager->getServiceLocator()->get('SanCaptcha');

        return new TestcaptchaController($captchaService);
    }
}
