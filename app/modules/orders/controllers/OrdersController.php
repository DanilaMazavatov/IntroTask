<?php

namespace app\modules\orders\controllers;

use app\modules\orders\models\OrderModel;
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
        $searchModel = new OrderModel();
//        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $data = $searchModel->getDataOnPage(\Yii::$app->request->get('page'), \Yii::$app->request->get('service'), \Yii::$app->request->get('mode'),
            \Yii::$app->request->get('status'));

        return $this->render('index', [
            'raw_data' => $data
        ]);
    }
}
