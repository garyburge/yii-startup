<?php

/**
 * api config file
 */

$apiConfig = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',

    // modules
    'modules'=>array(
        // uncomment the following to enable the Gii tool
//        'gii'=>array(
//            'class'=>'system.gii.GiiModule',
//            'password'=>'gii',
//            // If removed, Gii defaults to localhost only. Edit carefully to taste.
//            'ipFilters'=>array('127.0.0.1','::1'),
//            'generatorPaths'=>array(
//                'bootstrap.gii', // since 0.9.1
//            ),
//        ),
    ),

    // components
    'components'=>array(
//        'log'=>array(
//            'class'=>'CLogRouter',
//            'routes'=>array(
//                array(
//                    'class'=>'CFileLogRoute',
//                    'levels'=>'error, warning',
//                ),
//                array(
//                    'class'=>'CWebLogRoute',
//                    'levels'=>'error, warning, trace',
//                ),
//            ),
//        ),
    ),
);

return CMap::mergeArray(require(dirname(__FILE__).'/../../../common/config/main.php'), $apiConfig);
