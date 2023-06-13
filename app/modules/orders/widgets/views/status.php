<?php

/** @var yii\web\View $this */
/** @var yii\web\View $statuses */

use yii\helpers\Url;

$lang = (Yii::$app->language == 'ru') ? '' : ('/' . Yii::$app->language);

?>
<?php

$data = '';
foreach ($statuses as $key => $status) {
    if ($status === Yii::$app->request->get('status')) {
        $data .= "<li class=\"active\">";
    } else {
        $data .= "<li>";
    }

    if ($key == 'user.list.status.all_orders') {
        $data .= "<a href=\"" . Url::to("$lang/orders?page=1") . "\">" . \Yii::t('app', 'user.list.status.all_orders') . "</a>";
    } else {
        $data .= "<a href=\"" . Url::to("$lang/orders?page=1&status=$status") . "\">" . \Yii::t('app', $key) . "</a>";
    }

    $data .= "</li>";
}

echo $data;
unset($data);
?>
