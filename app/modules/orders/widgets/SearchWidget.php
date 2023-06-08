<?php


namespace app\modules\orders\widgets;

use yii\base\InvalidArgumentException;

class SearchWidget extends \yii\bootstrap5\Widget
{
    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        return $this->render('search_form');
    }
}
