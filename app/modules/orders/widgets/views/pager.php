<?php

/** @var yii\web\View $this */
/** @var yii\web\View $curr_page */
/** @var yii\web\View $pages */

use yii\bootstrap5\LinkPager;

$params = Yii::$app->requestedParams;

?>
<div class="col-sm-8">
    <nav>
        <ul class="pagination">

            <?php
                echo LinkPager::widget([
                    'pagination' => $pages,
                ]);
            ?>

        </ul>
    </nav>

</div>