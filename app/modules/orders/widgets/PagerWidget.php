<?php


namespace app\modules\orders\widgets;

use app\modules\orders\models\OrderModel;
use Yii;
use yii\base\InvalidArgumentException;

class PagerWidget extends \yii\bootstrap5\Widget
{
    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        $orders = new OrderModel();
        $curr_page = Yii::$app->requestedParams['page'];
        $pages =  intval(ceil($orders->find()->count() / 100));

        return $this->render('pager', [
            'pages' => $pages,
            'curr_page' => $curr_page,
        ]);
    }
}
