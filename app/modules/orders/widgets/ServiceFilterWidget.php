<?php

namespace orders\widgets;

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
        if (!$this->model) {
            return;
        }

        $raw_data = $this->model->searchServices();

        $count_services = count($raw_data);

        return $this->render('services', [
            'raw_data' => $raw_data,
            'count_services' => $count_services,
            'curr_page' => Yii::$app->request->get('page'),
        ]);
    }
}
