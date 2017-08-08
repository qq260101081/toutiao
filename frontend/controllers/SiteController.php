<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */

    public function actionIndex()
    {

        if(! Yii::$app->wechat->isAuthorized())
        {
            //return $this->redirect(['weixin/index','location'=>'site/index']);
            Yii::$app->wechat->oauth->scopes(['snsapi_userinfo']);
            return Yii::$app->wechat->authorizeRequired()->send();
        }

        $user = Yii::$app->wechat->getUser();
        //print_r($user);
        return $this->render('index');
    }

    public function actionError(){
        echo 4;
    }

}
