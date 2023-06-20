<?php


namespace orders\widgets;

use orders\controllers\OrdersController;
use orders\models\search\OrderSearch;
use Yii;
use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;
use yii\data\Pagination;

/**
 * Pagination widget
 */
class PagerWidget extends Widget
{
    const ROUTE = '/orders';
    const PAGE_SIZE = 100;
    const PAGE_SIZE_PARAM = false;

    public $model;
    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        $data = $this->model->count();

        $pages = new Pagination([
            'totalCount' => $data,
            'route' => self::ROUTE,
            'pageSize' => self::PAGE_SIZE,
            'pageSizeParam' => self::PAGE_SIZE_PARAM,
        ]);

        $tmp_count = ceil($data - (self::PAGE_SIZE * ((\Yii::$app->request->queryParams['page'] ?? 1) - 1)));

        $current_page_count = min($tmp_count, self::PAGE_SIZE);

        return $this->render('pager', [
            'pages' => $pages,
            'count' => $data,
            'page_count' => $current_page_count,
        ]);
    }
}
