<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;

/**
 * Site controller
 */
class WeixinController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */

    public function actionIndex($location = '')
    {
        //是否是微信端访问，并且未授权
        if(Yii::$app->wechat->isWechat && !Yii::$app->wechat->isAuthorized())
        {

            $returnUrl = Yii::$app->request->hostInfo . '/weixin/login';
            Yii::$app->wechat->oauth->scopes(['snsapi_userinfo'])->redirect($returnUrl)->send();
        }
        if(!$location)
        {
            $location = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
        }
        return $this->redirect($location);
    }

    public function actionLogin()
    {
        if(!Yii::$app->wechat->isAuthorized())
        {
            Yii::$app->wechat->authorizeRequired();

            $userInfo = Yii::$app->wechat->getUser()->original;
            if(!$userInfo)
            {
                die('获取用户资料失败');
            }
            $model = new user();
            $user = $model::findByOpenid($userInfo['openid']);
            if($user) $model = $user;

            $model->openid = $userInfo['openid'];
            $model->nickname = $userInfo['nickname'];
            $model->sex = $userInfo['sex'];
            $model->language = $userInfo['language'];
            $model->city = $userInfo['city'];
            $model->province = $userInfo['province'];
            $model->country = $userInfo['country'];
            $model->headimgurl = $userInfo['headimgurl'];
            $model->save(false);
        }
    }
}
