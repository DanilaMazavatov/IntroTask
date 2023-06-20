<?php

/** @var yii\web\View $this */

/** @var yii\web\View $raw_data */
/** @var yii\web\View $model */
/** @var yii\web\View $exception */

use orders\models\Orders;
use orders\widgets\ModeFilterWidget;
use orders\widgets\PagerWidget;
use orders\widgets\ServiceFilterWidget;

$this->title = \Yii::t('app', 'user.list.title');

?>
<?php if($exception): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <?= $exception->getMessage() ?>
    </div>
<?php endif;?>
<table class="table order-table">
    <thead>
    <tr>
        <th>ID</th>
        <th><?= \Yii::t('app', 'user.list.columns.user') ?></th>
        <th><?= \Yii::t('app', 'user.list.columns.link') ?></th>
        <th><?= \Yii::t('app', 'user.list.columns.quantity') ?></th>

        <?= ServiceFilterWidget::widget(['model' => $model]) ?>

        <th><?= \Yii::t('app', 'user.list.columns.status') ?></th>

        <?= ModeFilterWidget::widget(['model' => $model]) ?>

        <th><?= \Yii::t('app', 'user.list.columns.created') ?></th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($raw_data as $datum): ?>
        <tr>
            <td><?= $datum['id'] ?></td>
            <td><?= $datum['first_name'] . " " . $datum['last_name'] ?></td>
            <td class="link"><?= $datum['link'] ?></td>
            <td><?= $datum['quantity'] ?></td>
            <td class="service">
                <span class="label-id"><?= $datum['service_id'] ?></span><?= $datum['service_name'] ?>
            </td>
            <td><?= Yii::t('app', Orders::findStatus($datum['status'])) ?></td>
            <td><?= Yii::t('app', Orders::findMode($datum['mode'])) ?></td>
            <td>
            <span class="nowrap">
                <?= date("Y-m-d", $datum['created_at']) ?>
            </span>
                <span class="nowrap">
                <?= date("h:i:s", $datum['created_at']) ?>
            </span>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>

<div class="row">

    <?= PagerWidget::widget(['model' => $model]) ?>

</div>

