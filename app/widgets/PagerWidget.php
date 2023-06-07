<?php


namespace app\widgets;

use app\modules\orders\models\OrderModel;
use Yii;

class PagerWidget extends \yii\bootstrap5\Widget
{
    public function run()
    {
        $pager = $this->preparePager();

        return $this->render('pager', [
            'pager' => $pager,
        ]);
    }

    private function preparePager()
    {
        $orders = new OrderModel();
        $curr_page = Yii::$app->requestedParams['page'];
        $pages =  ceil($orders->find()->count() / 100);

        $pager = '<li class="disabled"><a href="/orders/page/' . ($curr_page == 1 ? $curr_page . '#' : ($curr_page - 1)) . '" aria-label="Previous">&laquo;</a></li>';
        $pager .= '<li class="active"><a href="/orders/page/' . $curr_page . '">' . $curr_page . '</a></li>';

        $page = $curr_page;
        while ($page < ($curr_page + 10)) {
            if (($page + 1) <= $pages) {
                $pager .= '<li><a href="/orders/page/' . ($page + 1) . '">' . ($page + 1) . '</a></li>';
                $page = $page + 1;
            } else {
                $page = $page + 10;
            }
        }

        $pager .= '<li class="disabled"><a href="/orders/page/' . ($curr_page == $pages ? $curr_page . '#' : ($curr_page + 1)) . '" aria-label="Next">&raquo;</a></li>';

        return $pager;
    }
}
