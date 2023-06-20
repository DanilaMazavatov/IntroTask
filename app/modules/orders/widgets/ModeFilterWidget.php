<?php

namespace orders\widgets;

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
        if (!$this->model) {
            return;
        }

        $modes = $this->model->searchMode();
        array_unshift($modes, null);

        return $this->render('mode', [
            'modes' => $modes,
        ]);
    }
}
