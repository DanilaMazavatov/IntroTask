<?php


namespace app\widgets;

use app\modules\orders\models\ServiceModel;
use Yii;
use yii\helpers\Html;

class ServiceFilterWidget extends \yii\bootstrap5\Widget
{
    public function run()
    {
        $services = new ServiceModel();
        $curr_page = Yii::$app->requestedParams['page'];
        $order_page = '/orders/page/' . $curr_page . '/';

        $raw_data = $services->find()->all();
        $count_services = $services->find()->count();

        /*
         * FIXME
         */
        return $this->render('services', [
            'raw_data' => $raw_data,
            'order_page' => $order_page,
            'count_services' => $count_services,
        ]);
    }
}
