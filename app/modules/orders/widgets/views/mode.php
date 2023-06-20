<?php

/** @var yii\web\View $this */

/** @var yii\web\View $modes */

use orders\models\Orders;
use yii\helpers\Url;

$params = Yii::$app->request->get();

?>
<th class="dropdown-th">
    <div class="dropdown">
        <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= Yii::t('app', 'user.list.columns.mode') ?>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php foreach ($modes as $mode): ?>
                <?php if ($mode === Yii::$app->request->get('mode')): ?>
                    <li class=\"active\">
                <?php else: ?>
                    <li>
                <?php endif; ?>
                <?php if (Orders::findMode($mode) == 'user.list.mode.all'): ?>
                    <a href="<?=
                    Url::to(array_merge(["/orders"], $params, ['mode' => null]))
                    ?>"><?= Yii::t('app', 'user.list.mode.all')?></a>
                <?php elseif (Orders::findMode($mode) == 'user.list.mode.manual'): ?>
                    <a href="<?= Url::to(array_merge(["/orders"], $params, ['mode' => $mode])) ?>"><?= Yii::t('app', 'user.list.mode.manual')?></a>
                <?php elseif (Orders::findMode($mode) == 'user.list.mode.auto'): ?>
                    <a href="<?= Url::to(array_merge(["/orders"], $params, ['mode' => $mode])) ?>"><?= Yii::t('app', 'user.list.mode.auto')?></a>
                <?php endif; ?>
                    </li>
            <?php endforeach; ?>
        </ul>
    </div>
</th>