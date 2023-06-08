<?php

/** @var yii\web\View $this */
/** @var yii\web\View $count_services */
/** @var yii\web\View $raw_data */
/** @var yii\web\View $curr_page */

$params = Yii::$app->requestedParams;
$mode = ($params['mode'] !== null) ? ('&mode=' . $params['mode']) : '';
$curr_service = $params['service'];

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

            $data = '<li class="active"><a href="/orders?page=1'
                . $mode .
                '">All (' . $count_services . ')</a></li>';
            foreach ($raw_data as $datum) {
                if ($datum->id == $curr_service) {
                    $data .= '<li class="active">';
                } else {
                    $data .= '<li>';
                }

                $data .= '<a href="/orders?page=1'
                    . '&service=' . $datum->id . $mode . '"><span class="label-id">' . $datum->id . '</span> ' . $datum->name . '</a>';

                $data .= '</li>';
            }

            echo $data;
            unset($data);
            ?>

        </ul>
    </div>
</th>
