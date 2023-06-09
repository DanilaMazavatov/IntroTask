<?php


namespace app\modules\orders\widgets;

use app\modules\orders\models\OrderModel;
use app\modules\orders\models\SearchOrder;
use Yii;
use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;
use yii\data\Pagination;
use yii\db\Exception;

class PagerWidget extends Widget
{
    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        $searchModel = new SearchOrder();
        $data = $searchModel->search(\Yii::$app->request->queryParams)->count();

        $pages = new Pagination([
            'totalCount' => $data,
            'route' => '/orders',
            'pageSize' => 100,
        ]);

        return $this->render('pager', [
            'pages' => $pages,
        ]);
    }
}
