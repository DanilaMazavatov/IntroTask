<?php

/** @var yii\web\View $this */
/** @var yii\web\View $raw_data */

use app\modules\orders\widgets\ModeFilterWidget;
use app\modules\orders\widgets\ServiceFilterWidget;

$this->title = \Yii::t('app', 'user.list.title');

?>

<table class="table order-table">
    <thead>
    <tr>
        <th>ID</th>
        <th><?= \Yii::t('app', 'user.list.columns.user') ?></th>
        <th><?= \Yii::t('app', 'user.list.columns.link') ?></th>
        <th><?= \Yii::t('app', 'user.list.columns.quantity') ?></th>

        <?= ServiceFilterWidget::widget() ?>

        <th><?= \Yii::t('app', 'user.list.columns.status') ?></th>

        <?= ModeFilterWidget::widget() ?>

        <th><?= \Yii::t('app', 'user.list.columns.created') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $data = '';

    foreach ($raw_data as $datum) {
        $data .= ' <tr>';
        $data.= '        <td>' . $datum['id'] . '</td>';
        $data.= '        <td>' . $datum['first_name'] . " " . $datum['last_name'] . '</td>';
        $data.= '        <td class="link">' . $datum['link'] . '</td>';
        $data.= '        <td>' . $datum['quantity'] . '</td>';
        $data.= '        <td class="service">';
        $data.= '            <span class="label-id">' . $datum['service_id'] . '</span> ' . $datum['service_name'];
        $data.= '        </td>';
        $data.= '        <td>' . $datum['status'] . '</td>';
        $data.= '        <td>' . $datum['mode'] . '</td>';
        $data.= '        <td><span class="nowrap">' . date("y-m-d", $datum['created_at']) . '</span><span class="nowrap">' . date("h:i:s", $datum['created_at']) . '</span></td>';
        $data .= ' </tr>';
    }

    echo $data;
    ?>
    </tbody>
</table>

