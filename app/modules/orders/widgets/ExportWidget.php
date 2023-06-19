<?php

namespace orders\widgets;

use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;

/**
 * Widget generates a button to submit the form for export to a csv file
 */
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
