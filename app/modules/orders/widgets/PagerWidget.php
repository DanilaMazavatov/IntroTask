<?php


namespace app\modules\orders\widgets;

use app\modules\orders\models\OrderModel;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\Pagination;
use yii\db\Exception;

class PagerWidget extends \yii\bootstrap5\Widget
{
    /**
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function run()
    {
        $orders = new OrderModel();

        $orders->default_fields = 'count(o.id) as count';
        $total_count = $orders->getDataOnPage(Yii::$app->requestedParams['page'], Yii::$app->requestedParams['service'],
            Yii::$app->requestedParams['mode'], Yii::$app->requestedParams['status']);

        $curr_page = Yii::$app->requestedParams['page'];
        $pages = new Pagination([
            'totalCount' => $total_count[0]['count'],
            'route' => '/orders',
            'pageSize' => 100,
        ]);

        return $this->render('pager', [
            'pages' => $pages,
            'curr_page' => $curr_page,
        ]);
    }
}
