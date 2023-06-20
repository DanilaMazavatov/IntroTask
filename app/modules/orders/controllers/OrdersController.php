<?php

namespace orders\controllers;

use orders\models\search\OrderSearch;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `orders` module
 */
class OrdersController extends Controller
{
    /**
     * Данный метод отвечает за отображение данных в сыром виде
     * @throws
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();

        if ($scenario = self::expectScenario())
            $searchModel->setScenario($scenario);

        $searchModel->load(Yii::$app->request->get(), '');

        if (!($data = $searchModel->search())) {
            Yii::$app->session->setFlash('error', implode($searchModel->firstErrors));
            return (Yii::$app->request->referrer ?  $this->redirect(Yii::$app->request->referrer) : $this->goHome());
        }

        return $this->render('index', [
            'raw_data' => $data,
            'count_pages' => count($data),
            'model' => $searchModel,
        ]);
    }

    /**
     * @return string|null
     */
    public static function expectScenario(): ?string
    {
        $attributes = Yii::$app->request->get();

        if (array_key_exists('search', $attributes) || array_key_exists('search_type', $attributes)) {
            return OrderSearch::SCENARIO_SEARCH;
        }
        return null;
    }
}
