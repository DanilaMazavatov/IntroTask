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
    public function actionIndex(): string
    {
        $searchModel = new OrderSearch();

        if ($scenario = self::expectScenario())
            $searchModel->setScenario($scenario);

        $searchModel->load(Yii::$app->request->get(), '');

        $data = $searchModel->search();

        return $this->render('index', [
            'raw_data' => $data,
            'count_pages' => count($data),
        ]);
    }

    /**
     * @return string|null
     */
    public static function expectScenario(): ?string
    {
        $attributes = Yii::$app->request->get();

        if (array_key_exists('mode', $attributes) || array_key_exists('service', $attributes)) {
            return OrderSearch::SCENARIO_FILTER;
        } elseif (array_key_exists('status', $attributes)) {
            return OrderSearch::SCENARIO_STATUS;
        } elseif (array_key_exists('search', $attributes) && array_key_exists('search_type', $attributes)) {
            return OrderSearch::SCENARIO_SEARCH;
        } else {
            return null;
        }
    }
}
