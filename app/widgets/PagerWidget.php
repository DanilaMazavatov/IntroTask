<?php


namespace app\widgets;

use app\modules\orders\models\OrderModel;
use Yii;

class PagerWidget extends \yii\bootstrap5\Widget
{
    public function run()
    {
        $orders = new OrderModel();
        $curr_page = Yii::$app->requestedParams['page'];
        $pages =  ceil($orders->find()->count() / 100);

        return $this->render('pager', [
            'pages' => $pages,
            'curr_page' => $curr_page,
        ]);
    }
}
