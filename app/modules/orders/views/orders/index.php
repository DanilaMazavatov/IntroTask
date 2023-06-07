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

        <?= \app\widgets\ServiceFilterWidget::widget() ?>

        <th>Status</th>
        <th class="dropdown-th">
            <div class="dropdown">
                <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Mode
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li class="active"><a href="">All</a></li>
                    <li><a href="">Manual</a></li>
                    <li><a href="">Auto</a></li>
                </ul>
            </div>
        </th>
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

