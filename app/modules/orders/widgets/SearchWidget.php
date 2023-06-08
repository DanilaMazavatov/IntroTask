<?php


namespace app\modules\orders\widgets;

use yii\base\InvalidArgumentException;
use yii\bootstrap5\Widget;

class SearchWidget extends Widget
{
    /**
     * @throws InvalidArgumentException
     */
    public function run()
    {
        return $this->render('search_form');
    }
}
