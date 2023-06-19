<?php

namespace orders\widgets;

use orders\models\Orders;
use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;

class ModeFilterWidget extends Widget
{
    const MANUAL = 0;
    const AUTO = 1;
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
