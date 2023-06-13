<?php

namespace app\modules\orders\widgets;

use app\modules\orders\models\SearchOrder;
use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;

class ExportWidget extends Widget
{
    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        return $this->render('export_form', [
            'filters' => \Yii::$app->request->queryParams,
        ]);
    }
}
