<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class OrdersAsset extends AssetBundle
{
    public $cssOptions = ['position' => View::POS_HEAD];
    public $jsOptions = ['position' => View::PH_BODY_END];

    public $sourcePath = '@app/modules/orders/web';

    public $css = [
        'css/site.css',
        'css/custom.css',
        'css/bootstrap.min.css',
    ];

    public $depends = [];
}
