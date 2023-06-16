<?php

/** @var yii\web\View $this */
/** @var yii\web\View $count_services */
/** @var yii\web\View $raw_data */

use yii\helpers\Url;

$lang = (Yii::$app->language == env('APP_LANGUAGE')) ? '' : ('/' . Yii::$app->language);
$mode = (Yii::$app->request->get('mode') !== null) ? ('&mode=' . Yii::$app->request->get('mode')) : '';
$curr_service = Yii::$app->request->get('service');

?>
<th class="dropdown-th">
    <div class="dropdown">
        <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= \Yii::t('app', 'user.list.services.services') ?>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li class="active">
                <a href="<?= Url::to("$lang/orders?page=1$mode") ?>">
                    <?= \Yii::t('app', 'user.list.services.all') ?><?=  " ($count_services)" ?>
                </a>
            </li>

            <?php foreach ($raw_data as $datum): ?>
                <?php if ($datum->id == $curr_service): ?>
                    <li class="active">
                <?php else: ?>
                    <li>
                <?php endif; ?>
                <a href="<?= Url::to("$lang/orders?page=1&service=$datum->id" . "$mode") ?>">
                <span class="label-id">
                    <?= $datum->id ?>
                </span><?= $datum->name ?>
                </a>
                </li>
            <?php endforeach; ?>

        </ul>
    </div>
</th>
