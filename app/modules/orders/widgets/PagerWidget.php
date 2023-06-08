<?php


namespace app\modules\orders\widgets;

use app\modules\orders\models\OrderModel;
use Yii;
use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;
use yii\data\Pagination;
use yii\db\Exception;

class PagerWidget extends Widget
{
    /**
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function run()
    {
        $orders = new OrderModel();

        $orders->default_fields = 'count(o.id) as count';
        $total_count = $orders->getDataOnPage(Yii::$app->request->get('page'), Yii::$app->request->get('service'),
            Yii::$app->request->get('mode'), Yii::$app->request->get('status'));

        $pages = new Pagination([
            'totalCount' => $total_count[0]['count'],
            'route' => '/orders',
            'pageSize' => 100,
        ]);

        return $this->render('pager', [
            'pages' => $pages,
        ]);
    }
}
