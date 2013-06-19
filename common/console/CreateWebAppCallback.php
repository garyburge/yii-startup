<?php

/**
 * Class file
 *
 * @author Tobias Munk <schmunk@usrbin.de>
 * @link http://www.phundament.com/
 * @copyright Copyright &copy; 2012 diemeisterei GmbH
 * @license http://www.phundament.com/license
 */

namespace console;
use Composer\Script\Event;

/**
 * CreateWebAppCallback provides composer hooks to create frontend, backend web apps
 *
 * @author Gary Burge <garyburge@garyburge.com> based on ComposerCallback.php by Tobias Munk <schmunk@usrbin.de>
 */
defined('YII_PATH') or define('YII_PATH', dirname(__FILE__).'/../../vendor/yiisoft/yii/framework');
defined('CONSOLE_CONFIG') or define('CONSOLE_CONFIG', dirname(__FILE__).'/console.php');

class CreateWebAppCallback
{
    /**
     * Executes ./yiic <vendor/<packageName>-<action>
     *
     * @static
     * @param \Composer\Script\Event $event
     */
    public static function postPackageInstall(Event $event)
    {
        $installedPackage = $event->getOperation()->getPackage();
        print(__METHOD__." (".__LINE__."): installedPackage='$installedPackage'\n");
        if ('yiisoft/yii-' == substr($installedPackage, 0, 12)) {
            // get yii
            $app = self::getYiiApplication();
            // get yii cli
            $app->commandRunner->addCommands(\Yii::getPathOfAlias('system.cli.commands'));
            // install frontend, backend
            $app->commandRunner->run(array('yiic', 'webapp', dirname(__FILE__).'/../../frontend/www'));
            $app->commandRunner->run(array('yiic', 'webapp', dirname(__FILE__).'/../../backend/www'));
        }
    }

    /**
     * Asks user to confirm by typing y or n.
     *
     * Credits to Yii CConsoleCommand
     *
     * @param string $message to echo out before waiting for user input
     * @return bool if user confirmed
     */
    public static function confirm($message)
    {
        echo $message . ' [yes|no] ';
        return !strncasecmp(trim(fgets(STDIN)), 'y', 1);
    }

    /**
     * Creates console application, if Yii is available
     */
    private static function getYiiApplication()
    {
        if (!is_file(YII_PATH.'/yii.php'))
        {
            return null;
        }

        require_once(YII_PATH.'/yii.php');
        spl_autoload_register(array('YiiBase', 'autoload'));

        if (\Yii::app() === null) {
            if (is_file(CONSOLE_CONFIG)) {
                $app = \Yii::createConsoleApplication(CONSOLE_CONFIG);
            } else {
                throw new \Exception("File from CONSOLE_CONFIG not found");
            }
        } else {
            $app = \Yii::app();
        }
        return $app;
    }

}
