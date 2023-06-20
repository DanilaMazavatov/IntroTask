<?php

namespace orders\controllers;

use app\components\exceptions\SearchBadRequestHttpException;
use orders\models\search\OrderSearch;
use yii\web\Controller;
use Yii;
use yii\web\Response;

/**
 * Default controller for the `orders` module
 */
class OrdersController extends Controller
{

    public function actionError()
    {
        $exception = Yii::$app->getErrorHandler()->exception;

        if ($exception) {
            return $this->render('index', [
                'raw_data' => null,
                'count_pages' => null,
                'model' => null,
                'exception' => $exception,
            ]);
        }
    }

    /**
     * Данный метод отвечает за отображение данных в сыром виде
     * @throws
     */
    public function actionIndex(): Response|string
    {
        $searchModel = new OrderSearch();

        if ($scenario = self::expectScenario())
            $searchModel->setScenario($scenario);

        $searchModel->load(Yii::$app->request->get(), '');

        if (!($data = $searchModel->search())) {
            throw new SearchBadRequestHttpException(200, $searchModel->getFirstErrors());
        }

        return $this->render('index', [
            'raw_data' => $data,
            'count_pages' => count($data),
            'model' => $searchModel,
            'exception' => null,
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
