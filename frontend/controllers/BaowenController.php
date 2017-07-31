<?php
namespace frontend\controllers;

use Yii;

/**
 * Site controller
 */
class BaowenController extends BaseController
{
    public function actionCreate( $wxurl = '' )
    {
        var_dump($wxurl);
        var_dump($_GET);
        $wxurl = Yii::$app->request->get();
        var_dump($wxurl);die;
    }

}
