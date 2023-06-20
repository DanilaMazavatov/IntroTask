<?php

namespace orders\widgets;

use orders\controllers\OrdersController;
use orders\models\Orders;
use orders\models\search\OrderSearch;
use Yii;
use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;

/**
 * Widget generates a dropdown list with modes
 */
class ModeFilterWidget extends Widget
{
    public $model;
    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        $modes = $this->model->searchMode();
        array_unshift($modes, null);

        return $this->render('mode', [
            'modes' => $modes,
        ]);
    }
}
