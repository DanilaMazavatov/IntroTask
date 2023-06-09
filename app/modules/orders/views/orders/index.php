<?php

/** @var yii\web\View $this */
/** @var yii\web\View $raw_data */

$this->title = 'IntroTask';

?>

<table class="table order-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Link</th>
        <th>Quantity</th>

        <?= \app\modules\orders\widgets\ServiceFilterWidget::widget() ?>

        <th>Status</th>

        <?= \app\modules\orders\widgets\ModeFilterWidget::widget() ?>

        <th>Created</th>
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

