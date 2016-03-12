<?php

namespace SanCaptcha\Controller;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CaptchaControllerFactory implements FactoryInterface
{
    /**
     * @param AbstractPluginManager|ServiceLocatorInterface $abstractPluginManager
     *
     * @return CaptchaController
     */
    public function createService(ServiceLocatorInterface $abstractPluginManager)
    {
        $config = $abstractPluginManager->getServiceLocator()->get('Config');

        return new CaptchaController($config);
    }
}
