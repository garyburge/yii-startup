<?php

/**
 * Common config file
 *
 * Frontend, backend main.php config files should merge this config array with ther own
 */
return array(
	'name'=>'Yii-Startup',

	// preloading 'log' component
	'preload'=>array('log', 'bootstrap'),

    // aliases
    'aliases'=>array(
        'common'=>dirname(__FILE__).'/../../common',
        'vendor'=>dirname(__FILE__).'/../../vendor',
        'bootstrap'=>dirname(__FILE__).'/../../vendor/clevertech/YiiBooster',
        'multidomain'=>dirname(__FILE__).'/../../vendor/garyburge/yii-MultidomainClientScript',
        'user'=>dirname(__FILE__).'/../../vendor/garyburge/yii-user',
        'role'=>dirname(__FILE__).'/../../vendor/garyburge/yii-role',
    ),

	// autoloading model and component classes
	'import'=>array(
        'common.models.*',
        'common.components.*',
		'application.models.*',
		'application.components.*',
	),

    // modules
	'modules'=>array(
        'user'=>array(
            'class'=>'user.UserModule',
        ),
        'role'=>array(
            'class'=>'role.RoleModule',
        ),
	),

	// application components
	'components'=>array(
        'assetManager'=>array(
            'basePath'=>dirname(__FILE__).'/../../assets/assets',
            'baseUrl'=>'http://assets.yii-startup/assets',
        ),
        'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
        ),
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
            'responsiveCss'=>true,
            'fontAwesomeCss'=>true,
        ),
        'clientScript'=>array(
            'class'=>'multidomain.MultidomainClientScript',
            'enableMultidomainAssets'=>true,
            'assetsSubdomain'=>'assets',
            'subdomainsToRemove'=>array('admin.'),
            'indexedAssetsSubdomain'=>false,
            'coreScriptPosition'=>CClientScript::POS_END,
            'defaultScriptFilePosition'=>CClientScript::POS_END,
            'defaultScriptPosition'=>CClientScript::POS_READY,
        ),
		'db'=>array(
            'connectionString'=>'mysql:host=localhost;dbname=yii-startup',
            'username'=>'yii-startup',
            'password'=>'NwdGnYuXjcAGuY23',
            'charset'=>'utf8',
            'tablePrefix'=>'',
            'emulatePrepare'=>true,
            'nullConversion'=>PDO::NULL_EMPTY_STRING,
            'enableParamLogging'=>false,
            'enableProfilling'=>false,
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
        'format'=>array(
            'dateFormat'=>'n/j/Y',
            'timeFormat'=>'g:ia',
            'datetimeFormat'=>'n/j/y g:ia',
        ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
//                array(
//                    'class'=>'CWebLogRoute',
//                ),
            ),
        ),
		'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
            'urlSuffix'=>'.html',
            'rules'=>array(
                //'gii'=>'gii',
                '<action:\w+>'=>'site/<action>',
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);