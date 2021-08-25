<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name' => 'Ozisim.com',
    'basePath' => dirname(__DIR__),
//    'homeUrl'=>array('/site/index'),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',

    'layout' => '@app/views/layouts/bootstrap',


    'modules' => [
        'user' => [
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
            'controllerMap' => [
                'profile' => 'frontend\controllers\user\ProfileController',
                'settings' => 'frontend\controllers\user\SettingsController',
                'security' => 'frontend\controllers\user\SecurityController',
                'registration' => 'frontend\controllers\user\RegistrationController',
                'recovery' => 'frontend\controllers\user\RecoveryController'
            ],
            'enablePasswordRecovery' => true,
        ],
        'main' => [
            'class' => 'app\modules\main\Module',
        ],
        'seller' => [
            'class' => 'app\modules\seller\Module',
        ],
        'indexchecker' => [
            'class' => 'frontend\modules\indexchecker\Module',
        ],
        'productmatcher' => [
            'class' => 'frontend\modules\productmatcher\Module',
        ],
    ],


    'components' => [
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js'=>['/source/js/jquery.min.js']
                ],
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views/profile' => '@frontend/views/user/profile',
                    '@dektrium/user/views/settings' => '@frontend/views/user/settings',
                    '@dektrium/user/views/security' => '@frontend/views/user/security',
                    '@dektrium/user/views/registration' => '@frontend/views/user/registration',
                    '@dektrium/user/views/recovery' => '@frontend/views/user/recovery',
                    '@dektrium/user/views/layouts' => '@frontend/views/user/layouts',
                ],
            ],
        ],


        'request' => [
            'class' => 'common\components\Request',
            'web' => '/frontend/web',
            'csrfParam' => '_csrf-frontend',
        ],

        'urlManager' => [
            'enableLanguageDetection' => false,
            'enableLanguagePersistence' => false,
            'rules' => array(
                'm/<module:\w+>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
                'm/<module:\w+>/<controller:\w+>/<action:[\w\-\/]+>' => '<module>/<controller>/<action>',
                'm/<module:\w+>/<controller:\w+>/<action:[\w\-\/]+>/<id:\d+>' => '<module>/<controller>/<action>',

                '<controller:\w+>/<id:\d+>/<alias:[\w\-]+>' => '<controller>/view',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/a/<action:[\w\-\/]+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/a/<action:[\w\-\/]+>' => '<controller>/<action>',
                '<controller:\w+>/<path:[\w\-\/]+>' => '<controller>/index',
            ),
        ],

//        'user' => [
//            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
//            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
//        ],

        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],

    'params' => $params,
];
