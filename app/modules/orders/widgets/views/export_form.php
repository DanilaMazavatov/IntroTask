<?php

/** @var yii\web\View $filters */

?>
<form class="form-inline" action="/export" method="get">

    <?php foreach ($filters as $key => $filter): ?>
    <input type='hidden' name='<?= $key ?>' value='<?= $filter ?>'>
    <?php endforeach; ?>

    <button type="submit" class="btn btn-default"><?= \Yii::t('app', 'user.list.export.button') ?></button>

</form>


