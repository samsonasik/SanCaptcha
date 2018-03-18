<?php

namespace SanCaptcha\Controller;

use Psr\Container\ContainerInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TestcaptchaControllerFactory
{
    public function __invoke(ContainerInterface $container) : TestcaptchaController
    {
        return new TestcaptchaController($container->get('SanCaptcha'));
    }
}
