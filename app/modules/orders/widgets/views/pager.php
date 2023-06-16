<?php

/** @var yii\web\View $this */
/** @var yii\web\View $pages */
/** @var yii\web\View $count */
/** @var yii\web\View $page_count */

use yii\bootstrap5\LinkPager;

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
<div class="col-sm-4 pagination-counters">
    <?= ($count > 0 ) ? 1 : 0 ?> to <?= $page_count ?> of <?= $count ?>
</div>