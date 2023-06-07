<?php

namespace app\modules\orders\controllers;

use app\modules\orders\models\OrderModel;
use yii\base\InvalidArgumentException;
use yii\web\Controller;

/**
 * Default controller for the `orders` module
 */
class OrdersController extends Controller
{
    private $ordersModel;

    /**
     * Данный метод отвечает за отображение данных в сыром виде
     * @throws
     */
    public function actionIndex($page = 1): string
    {
        $this->ordersModel = new OrderModel();

        /*
         * FIXME: Здесь должна быть валидация...
         */
//        $this->ordersModel->load(\Yii::$app->request->get());
//
//        if ($this->ordersModel->validate()) {
//            dd(1);
//            // все данные корректны
//        } else {
//            dd(2);
//            // данные не корректны: $errors - массив содержащий сообщения об ошибках
//            $errors = $this->ordersModel->errors;
//        }

        $raw_data = $this->ordersModel->getDataOnPage($page);


        return $this->render('index', array(
            'raw_data' => $raw_data,
        ));
    }

}
