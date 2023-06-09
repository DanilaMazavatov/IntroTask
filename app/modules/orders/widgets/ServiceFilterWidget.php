<?php

namespace app\modules\orders\widgets;

use app\modules\orders\models\ServiceModel;
use Yii;
use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;

class ServiceFilterWidget extends Widget
{
    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        $services = new ServiceModel();

        $raw_data = $services->find()->all();
        $count_services = count($raw_data);

        return $this->render('services', [
            'raw_data' => $raw_data,
            'count_services' => $count_services,
            'curr_page' => Yii::$app->request->get('page'),
        ]);
    }
}
