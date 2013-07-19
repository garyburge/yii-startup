<?php

/**
 * Based on: Phundament 3 Console Config File
 *
 * Containes predefined yiic console commands
 *
 * Define composer hooks by the following name schema: <vendor>/<packageName>-<action>
 *
 */
return array(
    'basePath'=>dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..',
    'name'=>'Yii-Startup',

    // aliases
    'aliases'=>array(
        'common'=>dirname(__FILE__).'/../../common',
        'vendor'=>dirname(__FILE__).'/../../vendor',
        'bootstrap'=>dirname(__FILE__).'/../../vendor/clevertech/yiibooster',
        'user'=>dirname(__FILE__).'/../../vendor/garyburge/yii-user',
        'role'=>dirname(__FILE__).'/../../vendor/garyburge/yii-role',
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

    // components
    'components'=>array(
        'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
        ),
        'db'=>array(
            'connectionString'=>'mysql:host=localhost;dbname=yii-startup',
            'username'=>'yii-startup',
            'password'=>'qDpP4M4hmW3HEK3T',
            'emulatePrepare' => true,
            'charset' => 'utf8',
            'tablePrefix'=>'',
        ),
    ),

    // params
    'params'=>array(
        'composer.callbacks'=>array(
            // args for Yii command runner
            'post-update'=>array('yiic', 'migrate'),
            'post-install'=>array('yiic', 'migrate'),
        ),
    ),

    'commandMap'=>array(
        'migrate'=>array(
            // alias of the path where you extracted the zip file
            'class'=>'vendor.yiiext.migrate-command.EMigrateCommand',
            // this is the path where you want your core application migrations to be created
            'migrationPath'=>'application.migrations',
            // the name of the table created in your database to save versioning information
            'migrationTable'=>'migration',
            // the application migrations are in a pseudo-module called "core" by default
            'applicationModuleName'=>'core',
            // define all available modules (if you do not set this, modules will be set from yii app config)
            'modulePaths'=>array(
                'user' => 'user.migrations',
                'role' => 'role.migrations',
            ),
            // you can customize the modules migrations subdirectory which is used when you are using yii module config
            'migrationSubPath'=>'migrations',
            // here you can configure which modules should be active, you can disable a module by adding its name to this array
            'disabledModules'=>array(
                #'admin', 'anOtherModule', // ...
            ),
            // the name of the application component that should be used to connect to the database
            'connectionID'=>'db',
            // alias of the template file used to create new migrations
            #'templateFile' => 'system.cli.migration_template',
        ),
        // composer "hooks", will be executed after package install or update
    ),
);