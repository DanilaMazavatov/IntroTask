<?php

namespace app\modules\orders\controllers;

use app\modules\orders\models\OrderModel;
use yii\base\InvalidArgumentException;
use yii\db\Exception;
use yii\web\Controller;

/**
 * Default controller for the `orders` module
 */
class OrdersController extends Controller
{

    /**
     * Данный метод отвечает за отображение данных в сыром виде
     * @throws
     */
    public function actionIndex($page = 1, int $service = null, int $mode = null, int $status = null): string
    {
        /*
        * FIXME: Здесь должна быть валидация...
        */

        if ($status !== null) {
            return $this->dataStatus($page, $status);
        } elseif ($service === null && $mode === null) {
            return $this->dataRender($page);
        } else {
            return $this->dataFilter($page, $service, $mode);
        }
    }

    /**
     * @throws InvalidArgumentException|Exception
     */
    private function dataFilter($page = 1, $service = null, $mode = null): string
    {
        $orders = new OrderModel();

        $raw_data = $orders->getDataOnPage($page, $service, $mode);

        return $this->render('index', array(
            'raw_data' => $raw_data,
            'service' => $service,
            'mode' => $mode,
        ));
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     */
    private function dataRender($page): string
    {
        $orders = new OrderModel();

        $raw_data = $orders->getDataOnPage($page);

        return $this->render('index', array(
            'raw_data' => $raw_data,
        ));
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     */
    private function dataStatus(int $page, int $status): string
    {
        $orders = new OrderModel();

        $raw_data = $orders->getDataOnPage($page, null, null, $status);

        return $this->render('index', array(
            'raw_data' => $raw_data,
            'status' => $status,
        ));
    }

}
