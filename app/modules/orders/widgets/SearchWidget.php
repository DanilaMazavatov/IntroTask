<?php

namespace orders\widgets;

use orders\models\search\OrderSearch;
use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;

/**
 * Widget generates form for search data
 */
class SearchWidget extends Widget
{

    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        $model = new OrderSearch(\Yii::$app->request->queryParams);
        return $this->render('search_form', [
            'model' => $model
        ]);
    }
}
