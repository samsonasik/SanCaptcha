Captcha sample module.
======================

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
