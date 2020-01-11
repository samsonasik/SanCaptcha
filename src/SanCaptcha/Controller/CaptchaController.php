<?php

namespace SanCaptcha\Controller;

use Traversable;
use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Stdlib\ArrayUtils;

class CaptchaController extends AbstractActionController
{
    /** @var array */
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * The default action - show the home page
     */
    public function generateAction()
    {
        /** @var Response $response */
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', "image/png");

        $id = $this->params('id', false);

        if ($id) {
            $spec = $this->config['san_captcha']['options'];

            $image = join(DIRECTORY_SEPARATOR, [
                $spec['imgDir'],
                $id
            ]);

            if (file_exists($image) !== false) {
                $imageread = file_get_contents($image);

                $response->setStatusCode(200);
                $response->setContent($imageread);

                if ($spec['imgDelete'] && file_exists($image)) {
                    unlink($image);
                }
            }
        }

        return $response;
    }
}
