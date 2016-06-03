Captcha sample module.
======================

- Install:

```
composer require san/san-captcha:0.*
```

- register at application.config.php
```
'modules' => array(
    'Application', // your app
    'Zend\Form', // for mvc-3
    'Zend\I18n', // for mvc-3
    'Zend\Router', // for mvc-3
    'Zend\Validator', // for mvc-3
    'Zend\Session', // for mvc-3
    'SanCaptcha'
),
```
- call in browser http://localhost/yourzfproject/public/san-captcha
