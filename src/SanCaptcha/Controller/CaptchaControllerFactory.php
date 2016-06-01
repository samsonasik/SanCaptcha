<?php

namespace SanCaptcha\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class CaptchaControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return CaptchaController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new CaptchaController($container->get('Config'));
    }
}
