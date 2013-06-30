<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestController
 *
 * @author gary
 */
class TestController extends Controller
{
    public function actionIndex()
    {
        Yii::app()->end(__METHOD__." (".__LINE__."): You have reached the Test Controller.");
    }
}

?>
