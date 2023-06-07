<?php

/** @var yii\web\View $this */
/** @var yii\web\View $curr_page */
/** @var yii\web\View $pages */

$params = Yii::$app->requestedParams;

?>
<div class="col-sm-8">
    <nav>
        <ul class="pagination">
            <?php
            $pager = '<li class="disabled"><a href="/index.php?r=orders/orders/index?page='
                . ($curr_page == 1 ? $curr_page . '#' : ($curr_page - 1)) . ((int)$params['service'] !== null ? '&service=' . $params['service'] : '') .
                ((int)$params['mode'] !== null ? '&mode=' . $params['mode'] : '') . '" aria-label="Previous">&laquo;</a></li>';
            $pager .= '<li class="active"><a href="/index.php?r=orders/orders/index?page=' . $curr_page . '">' . $curr_page . '</a></li>';

            $page = $curr_page;
            while ($page < ($curr_page + 10)) {
                if (($page + 1) <= $pages) {
                    $pager .= '<li><a href="/index.php?r=orders/orders/index?page=' . ($page + 1) . ((int)$params['service'] !== null ? '&service=' . $params['service'] : '') .
                        ((int)$params['mode'] !== null ? '&mode=' . $params['mode'] : '') . '">' . ($page + 1) . '</a></li>';
                    $page = $page + 1;
                } else {
                    $page = $page + 10;
                }
            }

            $pager .= '<li class="disabled"><a href="/index.php?r=orders/orders/index?page=' . ($curr_page == $pages ? $curr_page . '#' : ($curr_page + 1))
                . ((int)$params['service'] !== null ? '&service=' . $params['service'] : '') .
                ((int)$params['mode'] !== null ? '&mode=' . $params['mode'] : '') . '" aria-label="Next">&raquo;</a></li>';

            echo $pager;
            ?>
        </ul>
    </nav>

</div>