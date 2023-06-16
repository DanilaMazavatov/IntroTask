<?php

use app\modules\orders\widgets\SearchWidget;
use app\modules\orders\widgets\StatusFilterWidget;

?>
<ul class="nav nav-tabs p-b">
    <?= StatusFilterWidget::widget() ?>
    <li class="pull-right custom-search">
        <?= SearchWidget::widget() ?>
    </li>
</ul>