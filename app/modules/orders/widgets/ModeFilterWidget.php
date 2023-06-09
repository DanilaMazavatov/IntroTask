<?php

namespace app\modules\orders\widgets;

use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;

class ModeFilterWidget extends Widget
{
    const MANUAL = 0;
    const AUTO = 0;
    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        return $this->render('mode', [
            'modes' => [
                'all' => null,
                'manual' => self::MANUAL,
                'auto' => self::AUTO
            ]
        ]);
    }
}
