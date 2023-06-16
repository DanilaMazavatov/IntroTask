<?php

/** @var yii\web\View $this */

/** @var yii\web\View $modes */

use yii\helpers\Url;

$lang = (Yii::$app->language == env('APP_LANGUAGE')) ? '' : ('/' . Yii::$app->language);

$service = (Yii::$app->request->get('service') !== null) ? ('&service=' . Yii::$app->request->get('service')) : '';

?>
<th class="dropdown-th">
    <div class="dropdown">
        <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= Yii::t('app', 'user.list.columns.mode') ?>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php foreach ($modes as $key => $mode): ?>
                <?php if ($mode === Yii::$app->request->get('mode')): ?>
                    <li class=\"active\">
                <?php else: ?>
                    <li>
                <?php endif; ?>
                <?php if ($key == 'all'): ?>
                    <a href="<?= Url::to("$lang/orders?page=1$service") ?>"><?= \Yii::t('app', 'user.list.mode.all')?></a>
                <?php elseif ($key == 'manual'): ?>
                    <a href="<?= Url::to("$lang/orders?page=1$service&mode=$mode") ?>"><?= \Yii::t('app', 'user.list.mode.manual')?></a>
                <?php elseif ($key == 'auto'): ?>
                    <a href="<?= Url::to("$lang/orders?page=1$service&mode=$mode") ?>"><?= \Yii::t('app', 'user.list.mode.auto')?></a>
                <?php endif; ?>
                    </li>
            <?php endforeach; ?>
        </ul>
    </div>
</th>