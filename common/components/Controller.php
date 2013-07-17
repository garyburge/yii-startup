<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    /**
     * assetUrl (assets.base_domain)
     */
    static protected $_assetsUrl = false;

    /**
     * initialize the controller
     * @void
     */
    public function init()
    {
        // get asset url
        self::$_assetsUrl = Yii::app()->clientScript->getAssetsBaseUrl();

        // register main css file
        Yii::app()->clientScript->registerCssFile(self::$_assetsUrl.'/css/main.css');

        // register main javascript file
        Yii::app()->clientScript->registerScriptFile(self::$_assetsUrl.'/js/main.js');
    }

    /**
     * return asset url (http://assets.{base_domain})
     * @return string base url
     */
    public function getAssetUrl()
    {
        if (!self::$_assetsUrl) {
            self::$_assetsUrl = Yii::app()->clientScript->getAssetsBaseUrl();
        }

        return self::$_assetsUrl;
    }
}