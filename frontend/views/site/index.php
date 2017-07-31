<?php

/* @var $this yii\web\View */

$this->title = '创建我的爆文';
?>
<div class="find-baowen-page">
<div class="header">
    <p>创建我的爆文</p>
</div>

<div class="weui-cells weui-cells_form">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <textarea class="weui-textarea" placeholder="在此粘贴您的文章链接" rows="3"></textarea>
        </div>
    </div>
</div>


<a href="javascript:;" class="weui-btn weui-btn_primary">文章中嵌入我的名片</a>


<div class="weui-tabbar">
    <a href="javascript:;" class="weui-tabbar__item weui-bar__item_on">
            <i class="iconfont icon-shuxie1"></i>
        <p class="weui-tabbar__label">创建爆文</p>
    </a>

    <a href="javascript:;" class="weui-tabbar__item">
        <!--<img src="./images/icon_tabbar.png" alt="" class="weui-tabbar__icon">-->
        <i class="iconfont icon-faxian1"></i>
        <p class="weui-tabbar__label">发现爆文</p>
    </a>

    <a href="javascript:;" class="weui-tabbar__item">
        <i class="iconfont icon-yuedu2"></i>
        <p class="weui-tabbar__label">谁阅读</p>
    </a>

    <a href="javascript:;" class="weui-tabbar__item">
        <i class="iconfont icon-wo"></i>
        <p class="weui-tabbar__label">我</p>
    </a>

</div>
</div>

