<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],

    'components' => [
            'authManager' => [
          'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
      ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'JprgKjw6hwGqnJfbHjrlUMkgCG_ya6Cm',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
          'identityClass' => 'app\models\User',
          'loginUrl' => ['site/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '.html',
            'rules' => [

                  //
                  //   'page/index/<page:\d+>' => 'page/index',
                  //   'page/index/<category>' => 'page/index',
                  // // 'page/index/' => 'page/index/<page:\d+>/<per-page:\d+>',
                  // // 'page/index/' => 'page/index',
                  //
                  // // 'page/category/<id:\d+>'=>'page/category',
                  // 'page/category/<slug:[a-zA-Z0-9]+>/<page:\d+>' => 'page/category',
                  // 'page/category/<slug:[a-zA-Z0-9]+>'=>'page/category',
                  //
                  // 'page/article/<id:\d+>'=>'page/article',
                  //
                  // 'page/<slug:[index]+>'=>'page/index',
                  // 'page/<slug:[a-zA-Z0-9]+>'=>'page/article',

                  'admin/article/index/<page:\d+>' => 'admin/article/index',
                  'admin/article/index/' => 'admin/article/index',

                  // '/page/category/<page:\d+>/.html?slug=guestcategory'


                  'page/category/<slug:[a-zA-Z0-9]+>' => 'page/category',
                  'page/category/<slug:[a-zA-Z0-9]+>/<page:\d+>' => 'page/category',
                  'page/category/' => 'page/category',

                  'page/index/<page:\d+>' => 'page/index',
                  'page/index/' => 'page/index',

                  'page/<slug:[index]+>'=>'page/index',
                  'page/<slug:[a-zA-Z0-9]+>'=>'page/article',
                  'page/category/<slug:[a-zA-Z0-9]+>' => 'page/category',

                  'page/tag/<id:\d+>'=>'page/tag',
                  'page/tag/<slug:[a-zA-Z0-9]+>'=>'page/tag',


                 '/' => 'site/index',
                 'about' => 'site/about',
                 'register' => 'site/register',
                  'post' => 'post/index',
                 // 'login' => 'site/login',
                 'admin-panel' => 'admin/users/admin-panel',

                  'retrieve-password' => 'rbac/user/retrieve-password',
                  'reset-password' => 'rbac/user/reset-password',
                  'signup' => 'rbac/user/signup',
                      // 's-page' => 'gii/pagecreate',
            ],
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
              'facebook' => [
                'class' => 'yii\authclient\clients\Facebook',
                'clientId' => '336983073838562',
                'clientSecret' => '47857dac6fb06c7594459057d18f9fdd',
                'attributeNames' => ['id','first_name'],
                    // 'returnUrl' => '/basic/site/index'
    ],
      'vkontakte' => [
                'class' => 'yii\authclient\clients\VKontakte',
                'clientId' => '7210356',
                'clientSecret' => 'M4ALYs404yKYFLOEnlPs',
                'attributeNames' => ['uid', 'first_name'],
                  // 'authUrl' => '/basic/site/auth',
      ],
      'google' => [
                'class'        => 'yii\authclient\clients\Google',
                'clientId'     => '503086609911-iiet3g21mghdp28al8lu966b838g25mn.apps.googleusercontent.com',
                'clientSecret' => '5bf0OiuoxiHFOwagmYZJrYzJ',
                // 'authUrl' => '/basic/site/logingoogle',
    ],
  ],
],
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module'
        ],
        'adminka' => [
            'class' => 'app\modules\adminka\Adminka',
        ],
        'rbac' => [
           'class' => 'mdm\admin\Module',
           'controllerMap' => [
     'assignment' => [
        'class' => 'mdm\admin\controllers\AssignmentController',
        /* 'userClassName' => 'app\models\User', */
        'idField' => 'id',
        'usernameField' => 'username',
    ],
],
'layout' => 'left-menu',
            'mainLayout' => '@app/views/layouts/admin.php',
        ]
    ],
    'as access' => [
    'class' => 'mdm\admin\components\AccessControl',
    'allowActions' => [
        'site/*',
        "page/*",
        'debug/*',
        'rating/*',
        'user/*',


        // '*',
    ]
],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        // 'allowedIPs' => ['127.0.0.1', '::1'],
    ];
    // $config['modules']['debug']['allowedIPs'] = ['*'];

    $config['bootstrap'][] = 'gii';

    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // 'class' => 'yii\protected/gii/widget/WidgetCode',
        // 'class' => 'yii\gii\WidgetCode',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
