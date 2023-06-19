<?php

namespace orders\widgets;

use orders\models\Services;
use Yii;
use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;

/**
 * Widget generates a dropdown list with services
 */
class ServiceFilterWidget extends Widget
{
    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        $services = new Services();

        $raw_data = $services->find()->all();
        $count_services = count($raw_data);

        return $this->render('services', [
            'raw_data' => $raw_data,
            'count_services' => $count_services,
            'curr_page' => Yii::$app->request->get('page'),
        ]);
    }
}
