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
       dd(\Yii::$app->request->queryParams);
    }
}
