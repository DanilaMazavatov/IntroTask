<?php

namespace app\modules\orders\widgets;

use app\modules\orders\models\ServiceModel;
use Yii;
use yii\base\InvalidArgumentException;


class ServiceFilterWidget extends \yii\bootstrap5\Widget
{
    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        $services = new ServiceModel();
        $curr_page = Yii::$app->requestedParams['page'];

        $raw_data = $services->find()->all();
        $count_services = $services->find()->count();

        return $this->render('services', [
            'raw_data' => $raw_data,
            'count_services' => $count_services,
            'curr_page' => $curr_page,
        ]);
    }
}
