<?php

namespace app\modules\orders\controllers;

use app\modules\orders\models\search\SearchOrder;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `orders` module
 */
class OrdersController extends Controller
{

    /**
     * Данный метод отвечает за отображение данных в сыром виде
     * @throws
     */
    public function actionIndex(): string
    {
        $searchModel = new SearchOrder();
        $searchModel->load(Yii::$app->request->get(), '');
        $data = $searchModel->search();

        return $this->render('index', [
            'raw_data' => $data,
            'count_pages' => count($data),
        ]);
    }
}
