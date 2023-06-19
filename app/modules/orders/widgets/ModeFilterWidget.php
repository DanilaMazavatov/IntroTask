<?php

namespace orders\widgets;

use orders\models\Orders;
use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;

/**
 * Widget generates a dropdown list with modes
 */
class ModeFilterWidget extends Widget
{
    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        return $this->render('mode', [
            'modes' => array_flip(Orders::getModes())
        ]);
    }
}
