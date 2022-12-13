<?php

/*
 * Created on Thu Feb 22 2018
 * By Heru Arief Wijaya
 * Copyright (c) 2018 belajararief.com
 * This is configuration of your microfw. 
 * Put your database and other configuration here.
 * Don't forget to use different id for better microfw management
 */

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

return [
    'id' => 'micro-app',
    // the basePath of the application will be the `micro-app` directory
    'basePath' => dirname(__DIR__),
    'modules' => [
        'v1' => [
            'class' => 'app\modules\v1\v1',
        ],   
    ],
    // this is where the application will find all controllers
    'controllerNamespace' => 'app\controllers',
    // set an alias to enable autoloading of classes from the 'micro' namespace
    'aliases' => [
        '@app' => __DIR__.'/../',
    ],
    'components' => [
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<alias:\w+>' => 'site/<alias>',            
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\UserIdentity',
            'enableAutoLogin' => false,
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'enableCsrfCookie' => false,
        ],
        'db' => $db,
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://127.0.0.1:27017/corapi',
        ],
        'queue' => [
            'class' => \yii\queue\db\Queue::class,
            'db' => 'db', // DB connection component or its config 
            'tableName' => '{{%queue}}', // Table name
            'channel' => 'default', // Queue channel key
            'mutex' => \yii\mutex\MysqlMutex::class, // Mutex used to sync queries
        ],
        'mailer' => [ 
            'class' => 'common\components\Mailer',
             'useFileTransport'=>false,
             'transport' => [
                 'class' => 'Swift_SmtpTransport',
                 'host' => 'email-smtp.us-east-1.amazonaws.com',// amazon smtp host
                 'username' => 'AKIAQP5CTUKTJKNZ5MHO',// ses user username
                 'password' => 'BD4utMVzJ1y0OIopy6xFOEfbiAqnQO6rCie3c8NvAHNx',// ses user password
                 'port' => '587',
                 'encryption' => 'tls',
             ],
         ],
    ],
    'params' => $params,
];