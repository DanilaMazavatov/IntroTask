<?php

namespace app\modules\orders\widgets;

use yii\base\InvalidArgumentException;

class StatusFilterWidget extends \yii\bootstrap5\Widget
{
    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        return $this->render('status', [
            'statuses' => [
                'All orders' => null,
                'Pending' => 0,
                'In progress' => 1,
                'Completed' => 2,
                'Canceled' => 3,
                'Error' => 4,
            ]
        ]);
    }
}