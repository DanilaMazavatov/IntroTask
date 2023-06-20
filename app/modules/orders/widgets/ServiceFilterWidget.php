<?php

namespace orders\widgets;

use orders\controllers\OrdersController;
use orders\models\search\OrderSearch;
use Yii;
use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;

/**
 * Widget generates a dropdown list with services
 */
class ServiceFilterWidget extends Widget
{
    public $model;

    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        $raw_data = $this->model->searchServices();

        $count_services = count($raw_data);

        return $this->render('services', [
            'raw_data' => $raw_data,
            'count_services' => $count_services,
            'curr_page' => Yii::$app->request->get('page'),
        ]);
    }
}
