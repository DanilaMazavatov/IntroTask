<?php

namespace app\modules\orders\controllers;

use app\modules\orders\models\OrderModel;
use yii\base\BaseObject;
use yii\base\InvalidArgumentException;
use yii\db\Exception;
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
    public function actionIndex($page = 1, int $service = null, int $mode = null, int $status = null): string
    {
        /*
        * FIXME: Здесь должна быть валидация...
        */
        $this->orders = new OrderModel();
        $this->orders->orderBy = 'ORDER BY ID DESC';
        $this->orders->limit = 'LIMIT 100';
        $this->orders->offset = 'OFFSET ' . ($page - 1) * 100;

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
        $raw_data = $this->orders->getDataOnPage($page, $service, $mode);

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
        $raw_data = $this->orders->getDataOnPage($page);

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
        $raw_data = $this->orders->getDataOnPage($page, null, null, $status);

        return $this->render('index', array(
            'raw_data' => $raw_data,
            'status' => $status,
        ));
    }

}
