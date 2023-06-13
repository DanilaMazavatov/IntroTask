<?php

/** @var yii\web\View $this */

/** @var yii\web\View $modes */

use yii\helpers\Url;

$lang = (Yii::$app->language == 'ru') ? '' : ('/' . Yii::$app->language);

$service = (Yii::$app->request->get('service') !== null) ? ('&service=' . Yii::$app->request->get('service')) : '';

?>
<th class="dropdown-th">
    <div class="dropdown">
        <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= \Yii::t('app', 'Mode') ?>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php

            $data = '';
            foreach ($modes as $key => $mode) {
                if ($mode === Yii::$app->request->get('mode')) {
                    $data .= "<li class=\"active\">";
                } else {
                    $data .= "<li>";
                }
                if ($key == 'all') {
                    $data .= "<a href=\"" . Url::to("$lang/orders?page=1$service") . "\">" . \Yii::t('app', 'user.list.mode.all') . "</a>";
                } elseif ($key == 'manual') {
                    $data .= "<a href=\"" . Url::to("$lang/orders?page=1$service&mode=$mode") . "\">" . \Yii::t('app', 'user.list.mode.manual') . "</a>";
                } elseif ($key == 'auto') {
                    $data .= "<a href=\"" . Url::to("$lang/orders?page=1$service&mode=$mode") . "\">" . \Yii::t('app', 'user.list.mode.auto') . "</a>";
                }
                $data .= "</li>";
            }

            echo $data;
            unset($data);

            ?>
        </ul>
    </div>
</th>