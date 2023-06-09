<?php

namespace app\modules\orders\widgets;

use app\modules\orders\models\SearchOrder;
use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;

class SearchWidget extends Widget
{
    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        $model = new SearchOrder(\Yii::$app->request->queryParams);
        return $this->render('search_form', [
            'model' => $model
        ]);
    }
}
