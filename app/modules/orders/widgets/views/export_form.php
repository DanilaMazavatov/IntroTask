<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $filters */

?>
<form class="form-inline" action="/export" method="get">

    <?php
    foreach ($filters as $key => $filter) {
        echo "<input type='hidden' name='$key' value='$filter'>";
    }
    ?>
    <button type="submit" class="btn btn-default"><?= \Yii::t('app', 'user.list.export.button') ?></button>

</form>


