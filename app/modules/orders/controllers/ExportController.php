<?php

namespace orders\controllers;

use orders\models\forms\ExportOrdersForm;
use Yii;
use yii\base\ExitException;
use yii\base\InvalidArgumentException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Default controller for the export to CSV
 */
class ExportController extends Controller
{
    /**
     * @throws ExitException
     * @throws InvalidArgumentException|NotFoundHttpException
     */
    public function actionIndex(): Response
    {
        $export = new ExportOrdersForm();
        $export->setAttributes(Yii::$app->request->get(), '');
        if (!$export->export()) {
            Yii::$app->session->setFlash('error', implode($export->firstErrors));
        }
        return (Yii::$app->request->referrer ?  $this->redirect(Yii::$app->request->referrer) : $this->goHome());
    }
}
