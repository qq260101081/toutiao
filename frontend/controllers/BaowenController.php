<?php
namespace frontend\controllers;

use Yii;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use QL\QueryList;
use frontend\models\Article;

/**
 * Site controller
 */
class BaowenController extends BaseController
{
    public function behaviors()
    {
        return [
            [
                'class' => ContentNegotiator::className(),
                //'only' => ['index', 'view'],
                'formats' => ['application/json' => Response::FORMAT_JSON]
            ]
        ];
    }

    public function actionCreate()
    {
        //检查是否已经授权
        if(!Yii::$app->wechat->isAuthorized()) return $this->resPonse[1];

        $user = Yii::$app->wechat->getUser();
        print_r($urlInfo);die;
        if(! Yii::$app->wechat->isAuthorized())
        {
            //return $this->redirect(['weixin/index','location'=>'site/index']);
            Yii::$app->wechat->oauth->scopes(['snsapi_userinfo']);
            return Yii::$app->wechat->authorizeRequired()->send();
        }



        $wxurl = Yii::$app->request->get('wxurl');
        $urlInfo = parse_url($wxurl);
        //链接不合法
        if(!isset($urlInfo['host']) && $urlInfo['host'] != 'mp.weixin.qq.com') return $this->resPonse[1001];
        $article = Article::find()->select('id')->where(['wxurl' => $wxurl])->one();
        if($article)
        {
            $this->resPonse[0]['data']['id'] = $article->id;
            return $this->resPonse[0];
        }
        //创建文章
        $id = $this->createArticle($wxurl);
        if(!$id) return $this->resPonse[1000];
        $this->resPonse[0]['data']['id'] = $id;
        return $this->resPonse[0];
    }

    /**
     * 创建文章
     * @param $wxurl
     * @return bool
     */
    private function createArticle( $wxurl )
    {
        $html = file_get_contents($wxurl);
        $html = str_replace('<!--headTrap<body></body><head></head><html></html>-->', '', $html);

        $data = QueryList::Query($html, [
            'title' => ['#activity-name', 'text'],
            'content' => ['#js_content', 'html'],
            'html' => ['html', 'html'],
            'msg_cdn_url' => ['script', 'text', '', function ($content, $key)
            {
                if (preg_match('/msg_cdn_url = "(.*)";/', $content, $match))
                {
                    return $match[1];
                }
            }],
            'msg_desc' => ['script', 'text', '', function ($content, $key)
            {
                if (preg_match('/msg_desc = "(.*)";/', $content, $match))
                {
                    return $match[1];
                }
            }]
        ])->data;
        if (!is_array($data) || !isset($data[0]['title']) || !isset($data[0]['content']))
        {
            return $this->resPonse[1000];
        }

        $model = new Article();
        $model->wxurl = $wxurl;
        $model->title = $data[0]['title'];
        $model->msg_cdn_url = $data[10]['msg_cdn_url'];
        $model->msg_desc = $data[10]['msg_desc'];
        $model->content = $data[0]['content'];
        $model->save(false);
        return $model->id;
    }

}
