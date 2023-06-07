<?php

namespace app\modules\orders\controllers;

use app\modules\orders\models\OrderModel;
use yii\base\InvalidArgumentException;
use yii\web\Controller;

/**
 * Default controller for the `orders` module
 */
class FilterController extends Controller
{

    public function getViewPath()
    {
        return '@app/modules/orders/views/orders';
    }

    /**
     * Данный метод отвечает за отображение данных в сыром виде
     * @throws
     */
    public function actionIndex($page = 1, $service = null, $mode = null)
    {
        $orders = new OrderModel();

        $raw_data = $orders->getDataOnPage($page, $service, $mode);

        return $this->render('index', array(
            'raw_data' => $raw_data,
        ));
    }
}
