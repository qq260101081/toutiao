<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/iconfont.css',
        'https://res.wx.qq.com/open/libs/weui/1.1.0/weui.min.css',
        'css/site.css'
    ];
    public $js = [
        'https://res.wx.qq.com/open/libs/weuijs/1.1.1/weui.min.js'
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
