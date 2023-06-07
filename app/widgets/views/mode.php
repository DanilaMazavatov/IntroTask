<?php

/** @var yii\web\View $this */
/** @var yii\web\View $modes */

$params = Yii::$app->requestedParams;
$service = ($params['service'] !== null) ? ('&service=' . $params['service']) : '';

$curr_page = $params['page'];
$curr_mode = $params['mode'];

?>
<th class="dropdown-th">
    <div class="dropdown">
        <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Mode
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php

            $data = '';
            foreach ($modes as $key => $mode) {
                if ($mode === $curr_mode) {
                    $data .= "<li class=\"active\">";
                } else {
                    $data .= "<li>";
                }
                if ($key == 'all') {
                    $data .= "<a href=\"/index.php?r=orders/orders/index?page="
                        . $curr_page . $service . "\">All</a>";
                } elseif ($key == 'manual') {
                    $data .= "<a href=\"/index.php?r=orders/orders/index?page="
                        . $curr_page . $service . "&mode=" . $mode . "\">Manual</a>";
                } elseif ($key == 'auto') {
                    $data .= "<a href=\"/index.php?r=orders/orders/index?page="
                        . $curr_page . $service . "&mode=" . $mode . "\">Auto</a>";
                }
                $data .= "</li>";
            }

            echo $data;
            unset($data);
            ?>
        </ul>
    </div>
</th>