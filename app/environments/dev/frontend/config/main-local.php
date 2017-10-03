<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*']
    ];
    $config['components']['assetManager']['hashCallback'] = function($path){
    $mostRecentFileMTime = 0;
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($iterator as $fileinfo) {
        if ($fileinfo->isFile() && $fileinfo->getMTime() > $mostRecentFileMTime) {
            $mostRecentFileMTime = $fileinfo->getMTime();
        }
    }
    $path = (is_file($path) ? dirname($path) : $path) . $mostRecentFileMTime;
    return sprintf('%x', crc32($path . Yii::getVersion()));
    };
}

return $config;
