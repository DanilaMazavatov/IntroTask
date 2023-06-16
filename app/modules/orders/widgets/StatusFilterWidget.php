<?php

namespace app\modules\orders\widgets;

use app\modules\orders\models\Orders;
use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;

class StatusFilterWidget extends Widget
{
    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        return $this->render('status', [
            'statuses' => [
                'user.list.status.all_orders' => Orders::STATUS_ALL,
                'user.list.status.pending' => Orders::STATUS_PENDING,
                'user.list.status.in_progress' => Orders::STATUS_IN_PROGRESS,
                'user.list.status.completed' => Orders::STATUS_COMPLETED,
                'user.list.status.canceled' => Orders::STATUS_CANCELED,
                'user.list.status.error' => Orders::STATUS_ERROR,
            ]
        ]);
    }
}