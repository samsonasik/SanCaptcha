<?php

namespace SanCaptcha\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Traversable;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Stdlib\ArrayUtils;

/**
 * CaptchaController
 *
 * @author
 *
 * @version
 *
 */
class CaptchaMiddleware
{
    /** @var array */
    private $config;

    /**
     * CaptchaMiddleware constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * The default action - show the home page
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $response->withAddedHeader('Content-Type', "image/png");

        $id = $request->getAttribute('id', false);

        if ($id) {
            if ($this->config instanceof Traversable) {
                $this->config = ArrayUtils::iteratorToArray($this->config);
            }

            $spec = $this->config['san_captcha']['options'];

            $image = join(DIRECTORY_SEPARATOR, [
                $spec['imgDir'],
                $id
            ]);

            if (file_exists($image) !== false) {
                $imageread = file_get_contents($image);

                $response = new HtmlResponse($imageread, 200, ['Content-Type' => 'image/png']);

                if ($spec['imgDelete'] && file_exists($image)) {
                    unlink($image);
                }
            }

        }

        return $response;
    }
}
