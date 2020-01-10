<?php

namespace SanCaptcha\Controller;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\AbstractPluginManager;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class CaptchaControllerFactory
{
    public function __invoke(ContainerInterface $container) : CaptchaController
    {
        return new CaptchaController($container->get('config'));
    }
}
