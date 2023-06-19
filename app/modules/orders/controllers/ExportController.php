<?php

namespace app\modules\orders\controllers;

use app\modules\orders\models\forms\ExportOrders;
use Yii;
use yii\base\ExitException;
use yii\base\InvalidArgumentException;
use yii\web\Controller;

class ExportController extends Controller
{
    /**
     * @throws ExitException
     * @throws InvalidArgumentException
     */
    public function actionIndex(): void
    {
        $export = new ExportOrders();
        $export->load(Yii::$app->request->get(), '');
        $export->export();
    }
}
