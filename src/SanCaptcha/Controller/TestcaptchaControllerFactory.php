<?php

namespace SanCaptcha\Controller;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\AbstractPluginManager;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class TestcaptchaControllerFactory
{
    public function __invoke(ContainerInterface $container) : TestcaptchaController
    {
        return new TestcaptchaController($container->get('SanCaptcha'));
    }
}
