<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class ArticleController extends Controller
{

    public function actionIndex()
    {
        if(! Yii::$app->wechat->isAuthorized())
        {
            Yii::$app->wechat->oauth->scopes(['snsapi_userinfo']);
            return Yii::$app->wechat->authorizeRequired()->send();
        }

        $user = Yii::$app->wechat->getUser();
        print_r($user);die;
        return $this->render('index');
    }

}
