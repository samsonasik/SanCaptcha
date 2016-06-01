<?php

namespace SanCaptcha\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class TestcaptchaControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return TestcaptchaController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new TestcaptchaController($container->get('SanCaptcha'));
    }
}
