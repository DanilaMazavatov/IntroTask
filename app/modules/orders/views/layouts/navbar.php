<?php

/** @var yii\web\View $language_change */

use orders\widgets\ExportWidget;

?>
<nav class="navbar navbar-fixed-top navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#"><?= \Yii::t('app', 'user.list.header') ?></a></li>
            </ul>
            <div class="custom-search mr-2 mt-2" style="float: right;margin-top: 1ex;margin-right: 1ex">
                <?= ExportWidget::widget() ?>
            </div>
            <a class="btn btn-default mt-2 mr-2" style="float: right;margin: 1ex;" href="<?= "/$language_change/orders" ?>"><?= $language_change ?></a>
        </div>
</nav>