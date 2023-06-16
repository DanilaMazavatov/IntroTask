<?php

namespace app\modules\orders\controllers;

use app\modules\orders\models\forms\ExportOrders;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\Controller;
use yii\web\RangeNotSatisfiableHttpException;

class ExportController extends Controller
{

    /**
     */
    public function actionIndex()
    {
        $export = new ExportOrders();
        $export->load(Yii::$app->request->get(), '');
        $export->export();
    }

}
