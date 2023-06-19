<?php

namespace orders\controllers;

use orders\models\forms\ExportOrdersForm;
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
        $export = new ExportOrdersForm();
        $export->load(Yii::$app->request->get(), '');
        $export->export();
    }
}
