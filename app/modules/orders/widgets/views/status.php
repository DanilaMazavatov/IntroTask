<?php

/** @var yii\web\View $this */
/** @var yii\web\View $statuses */

use yii\helpers\Url;

$lang = (Yii::$app->language == env('APP_LANGUAGE')) ? '' : ('/' . Yii::$app->language);

?>

<?php foreach ($statuses as $key => $status): ?>
    <?php if ((string)$status === (string)Yii::$app->request->get('status')): ?>
        <li class="active">
    <?php else: ?>
        <li>
    <?php endif; ?>
    <?php if ($key == 'user.list.status.all_orders'): ?>
            <a href="<?= Url::to("$lang/orders?page=1") ?>">
                <?= \Yii::t('app', 'user.list.status.all_orders') ?>
            </a>
    <?php else: ?>
            <a href="<?= Url::to("$lang/orders?page=1&status=$status") ?>">
                <?= Yii::t('app', $key) ?>
            </a>
    <?php endif; ?>
        </li>
<?php endforeach; ?>
