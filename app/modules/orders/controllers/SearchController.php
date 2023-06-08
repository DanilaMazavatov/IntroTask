<?php

namespace app\modules\orders\controllers;

use app\modules\orders\models\OrderModel;
use yii\base\InvalidArgumentException;
use yii\db\Exception;
use yii\web\Controller;

class SearchController extends Controller
{

    /**
     * Данный метод отвечает за отображение данных в сыром виде
     * @throws
     */
    public function actionIndex()
    {
        /*
        * FIXME: Здесь должна быть валидация...
        */
       dd(\Yii::$app->requestedParams);
    }

}
