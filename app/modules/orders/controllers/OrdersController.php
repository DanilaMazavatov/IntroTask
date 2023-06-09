<?php

namespace app\modules\orders\controllers;

use app\modules\orders\models\SearchOrder;
use yii\base\BaseObject;
use yii\web\Controller;

/**
 * Default controller for the `orders` module
 */
class OrdersController extends Controller
{
    private BaseObject $orders;

    /**
     * Данный метод отвечает за отображение данных в сыром виде
     * @throws
     */
    public function actionIndex()
    {
        $searchModel = new SearchOrder();
        $data = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'raw_data' => $data->all()
        ]);
    }
}
