<?php

/** @var yii\web\View $this */
/** @var yii\web\View $content */
/** @var yii\web\View $pages */

use app\modules\orders\widgets\PagerWidget;
use app\modules\orders\widgets\SearchWidget;
use app\modules\orders\widgets\StatusFilterWidget;
use yii\helpers\Url;

$language_change = Yii::$app->language == 'en' ? "ru" : "en";

?>

<?php $this->beginPage(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->title ?></title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">

    <style>
        .label-default{
            border: 1px solid #ddd;
            background: none;
            color: #333;
            min-width: 30px;
            display: inline-block;
        }
    </style>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php $this->beginBody(); ?>
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
            <a class="btn btn-default mt-2 mr-2" style="float: right;margin: 1ex;" href="<?= "/$language_change/orders" ?>"><?= $language_change ?></a>
    </div>
</nav>
<div class="container-fluid">
    <ul class="nav nav-tabs p-b">
        <?= StatusFilterWidget::widget() ?>
        <li class="pull-right custom-search">
            <?= SearchWidget::widget() ?>
        </li>
    </ul>
    <?= $content ?>
    <div class="row">

        <?= PagerWidget::widget() ?>

    </div>
</div>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<?php $this->endBody(); ?>
</body>
<html>

<?php $this->endPage(); ?>
