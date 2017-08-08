<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class BaseController extends Controller
{
    /**
     * 公共提示信息
     * @var array
     */
    public $resPonse = [
        0 => ['errCode' => 0, 'errMsg' => 'ok'],
        1 => ['errCode' => 1, 'errMsg' => '未授权'],
        1000 => ['errCode' => 1000, 'errMsg' => '创建文章失败'],
        1001 => ['errCode' => 1001, 'errMsg' => '微信文章链接不合法'],
    ];

    /**
     * 允许跨域
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action){
        header("Access-Control-Allow-Origin: http://baowen.com");
        return parent::beforeAction($action);
    }

}
