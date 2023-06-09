<?php

namespace app\modules\orders\widgets;

use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;

class StatusFilterWidget extends Widget
{
    const PENDING = 0;
    const IN_PROGRESS = 1;
    const COMPLETED = 2;
    const CANCELED = 3;
    const ERROR = 4;
    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        return $this->render('status', [
            'statuses' => [
                'All orders' => null,
                'Pending' => self::PENDING,
                'In progress' => self::IN_PROGRESS,
                'Completed' => self::COMPLETED,
                'Canceled' => self::CANCELED,
                'Error' => self::ERROR,
            ]
        ]);
    }
}