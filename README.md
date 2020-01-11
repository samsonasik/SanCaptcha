Captcha sample module.
======================

> This is README for version ^2.0 which uses Laminas components

> For version ^1.0 that support zf, you can browse [v1 readme](https://github.com/samsonasik/SanCaptcha/blob/1.x.x/README.md)

- Install:

```
composer require san/san-captcha
```

- register at application.config.php
```
'modules' => array(
    'Application', // your app
    'Laminas\Form',
    'Laminas\I18n',
    'Laminas\Router',
    'Laminas\Validator',
    'Laminas\Session',
    'SanCaptcha'
),
```
- call in browser http://localhost/yourzfproject/public/san-captcha
