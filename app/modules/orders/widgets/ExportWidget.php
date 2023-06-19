<?php

namespace orders\widgets;

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
