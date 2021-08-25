<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'tk',
    'timeZone' => 'Asia/Ashgabat',
    'name' => '',
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableRegistration' => true,
            'enableConfirmation' => false,
            'enableUnconfirmedLogin' => true,
            'modelMap' => [
                'Profile' => 'common\models\security\Profile',
                'LoginForm' => 'common\models\security\LoginForm',
                'User' => 'common\models\security\User',
            ],
            'adminPermission' => 'admin',
        ],

        'rbac' => [
            'class' => 'dektrium\rbac\RbacWebModule',
        ],
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '6LfSKZ0UAAAAAHDE7aU5BLotXx6fKeBzhJZZI2Ks',
            'secret' => '6LfSKZ0UAAAAAMMjk39GjiH6BXgvdA5e3gIOnAsI',
        ],
//        'assetManager' => [
//            'bundles' => [
//                'yii\web\JqueryAsset' => [
//                    'sourcePath' => null, // do not publish the bundle
//                    'js' => ['//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js',]
////                    'js' => [ '/roomstorent/backend/js/jquery.min.js', ]
//                ],
//            ],
//        ],
        'mobileDetect' => [
            'class' => '\skeeks\yii2\mobiledetect\MobileDetect'
        ],

        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'app' => 'backend.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],


        'image' => array(
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD',  //GD or Imagick
        ),


        'common' => [
            'class' => 'common\components\Common'
        ],

        'setting' => [
            'class' => 'common\components\SettingService'
        ],


        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => true,//set this property to false to send mails to real email addresses
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.com',
                'username' => 'info@ozisim.com',
                'password' => 'Ozisim@2020',
                'port' => '587',
                'encryption' => 'tls',
                'streamOptions' => [
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => false
                    ],
                ],
            ],
        ],

//        'urlManager' => [
//            'class' => 'codemix\localeurls\UrlManager',
//            'languages' => ['en', 'ru', 'tk'],
////            'class' => 'yii\web\UrlManager',
////            'baseUrl' => 'http://conqueramazon.com/frontend/web/',
//            // Disable index.php
//            'showScriptName' => false,
//            // Disable r= routes
//            'enablePrettyUrl' => true,
//            'rules' => array(
//                '<controller:\w+>/<id:\d+>' => '<controller>/view',
//                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
//            ),
//        ],


        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
//            'class' => 'yii\web\UrlManager',


            // List all supported languages here
            // Make sure, you include your app's default language.
            'languages' => ['tk', 'ru', 'en'],
//            'ignoreLanguageUrlPatterns' => [
//                // route pattern => url pattern
//                '^mobile/*^' => '^mobile/*^',
////                '#^api/#' => '#^api/#',
//            ],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableLanguageDetection' => false,
            // '_defaultLanguage'=>'tk',
//            'enableDefaultLanguageUrlCode' => true,
            'rules' => array(
//                'm/<module:\w+>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
//                'm/<module:\w+>/<controller:\w+>/<action:[\w\-\/]+>' => '<module>/<controller>/<action>',
//                'm/<module:\w+>/<controller:\w+>/<action:[\w\-\/]+>/<id:\d+>' => '<module>/<controller>/<action>',
//
//                '<controller:\w+>/<id:\d+>/<alias:[\w\-]+>' => '<controller>/view',
//                '<controller:\w+>/<id:\d+>' => '<controller>/view',
//                '<controller:\w+>/a/<action:[\w\-\/]+>/<id:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/a/<action:[\w\-\/]+>' => '<controller>/<action>',
//                '<controller:\w+>/<path:[\w\-\/]+>' => '<controller>/index',

//                '<controller:\w+>/<id:\d+>' => '<controller>/view',
//                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',

            ),
        ],
    ],
];
