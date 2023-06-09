<?php

namespace app\modules\orders\widgets;

use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;

class ModeFilterWidget extends Widget
{
    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        return $this->render('mode', [
            'modes' => [
                'all' => null,
                'manual' => 0,
                'auto' => 1
            ]
        ]);
    }
}
