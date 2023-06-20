<?php

/** @var yii\web\View $this */
/** @var yii\web\View $count_services */
/** @var yii\web\View $raw_data */

use yii\helpers\Url;

$curr_service = Yii::$app->request->get('service');

$params = Yii::$app->request->get();

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
                <a href="<?= Url::to(array_merge(["/orders"], $params, ['service' => null])) ?>">
                    <?= \Yii::t('app', 'user.list.services.all') ?><?=  " ($count_services)" ?>
                </a>
            </li>

            <?php foreach ($raw_data as $datum): ?>
                <?php if ($datum['id'] == $curr_service): ?>
                    <li class="active">
                <?php else: ?>
                    <li>
                <?php endif; ?>
                <a href="<?= Url::to(array_merge(["/orders"], $params, ['service' => $datum['id']])) ?>">
                <span class="label-id">
                    <?= $datum['id'] ?>
                </span><?= $datum['name'] ?>
                </a>
                </li>
            <?php endforeach; ?>

        </ul>
    </div>
</th>
