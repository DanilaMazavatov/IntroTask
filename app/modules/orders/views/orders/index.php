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
        $data.= '        <td>' . $datum['ID'] . '</td>';
        $data.= '        <td>' . $datum['User'] . '</td>';
        $data.= '        <td class="link">' . $datum['Link'] . '</td>';
        $data.= '        <td>' . $datum['Quantity'] . '</td>';
        $data.= '        <td class="service">';
        $data.= '            <span class="label-id">' . $datum['service_id'] . '</span> ' . $datum['Service'];
        $data.= '        </td>';
        $data.= '        <td>' . $datum['Status'] . '</td>';
        $data.= '        <td>' . $datum['Mode'] . '</td>';
        $data.= '        <td><span class="nowrap">' . date("y-m-d", $datum['Created']) . '</span><span class="nowrap">' . date("h:i:s", $datum['Created']) . '</span></td>';
        $data .= ' </tr>';
    }

    echo $data;
    ?>
    </tbody>
</table>

