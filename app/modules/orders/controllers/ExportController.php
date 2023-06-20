<?php

namespace orders\controllers;

use orders\models\forms\ExportOrdersForm;
use Yii;
use yii\base\ExitException;
use yii\base\InvalidArgumentException;
use yii\web\Controller;

/**
 * Default controller for the export to CSV
 */
class ExportController extends Controller
{
    /**
     * @throws ExitException
     * @throws InvalidArgumentException
     */
    public function actionIndex()
    {
        $export = new ExportOrdersForm();
        $export->setAttributes(Yii::$app->request->get(), '');
        if (!$export->export()) {
            Yii::$app->session->setFlash('error', implode($export->firstErrors));
            return $this->goBack();
        }
    }
}
