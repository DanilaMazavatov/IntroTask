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
                'user.list.status.all_orders' => null,
                'user.list.status.pending' => self::PENDING,
                'user.list.status.in_progress' => self::IN_PROGRESS,
                'user.list.status.completed' => self::COMPLETED,
                'user.list.status.canceled' => self::CANCELED,
                'user.list.status.error' => self::ERROR,
            ]
        ]);
    }
}