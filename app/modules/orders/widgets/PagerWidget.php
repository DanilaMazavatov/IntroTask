<?php


namespace app\modules\orders\widgets;

use app\modules\orders\models\SearchOrder;
use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;
use yii\data\Pagination;
use function PHPUnit\Framework\returnSelf;

class PagerWidget extends Widget
{
    const ROUTE = '/orders';
    const PAGE_SIZE = 100;
    const PAGE_SIZE_PARAM = false;
    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        $searchModel = new SearchOrder();
        $data = $searchModel->search(\Yii::$app->request->queryParams)->count();

        $pages = new Pagination([
            'totalCount' => $data,
            'route' => self::ROUTE,
            'pageSize' => self::PAGE_SIZE,
            'pageSizeParam' => self::PAGE_SIZE_PARAM,
        ]);

        return $this->render('pager', [
            'pages' => $pages,
        ]);
    }
}
