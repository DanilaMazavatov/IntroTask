<?php

/** @var yii\web\View $this */
/** @var yii\web\View $order_page */
/** @var yii\web\View $count_services */
/** @var yii\web\View $raw_data */

?>
<th class="dropdown-th">
    <div class="dropdown">
        <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Service
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

            <?php
            $data = '<li class="active"><a href="' . $order_page . '">All (<?= $count_services ?>)</a></li>';
            foreach ($raw_data as $datum) {
                $data .= '<li><a href="' . $order_page . 'service/' . $datum->id . '"><span class="label-id">' . $datum->id . '</span> ' . $datum->name . '</a></li>';
            }

            echo $data;
            ?>

        </ul>
    </div>
</th>
