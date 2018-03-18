<?php

namespace SanCaptcha\Controller;

use Psr\Container\ContainerInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CaptchaControllerFactory
{
    public function __invoke(ContainerInterface $container) : CaptchaController
    {
        return new CaptchaController($container->get('config'));
    }
}
