<?php

namespace SanCaptcha\Controller;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CaptchaControllerFactory implements FactoryInterface
{
    /**
     * @param AbstractPluginManager|ServiceLocatorInterface $serviceLocator
     *
     * @return CaptchaController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->getServiceLocator()->get('Config');

        return new CaptchaController($config);
    }
}
