<?php

/** @var yii\web\View $this */
/** @var yii\web\View $pages */

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