<?php

/** @var yii\web\View $this */
/** @var yii\web\View $curr_page */
/** @var yii\web\View $statuses */

$params = Yii::$app->requestedParams;
$curr_page = $params['page'] ?? null;
$curr_status = $params['status'] ?? null;

?>
<?php

$data = '';
foreach ($statuses as $key => $status) {
    if ($status === $curr_status) {
        $data .= "<li class=\"active\">";
    } else {
        $data .= "<li>";
    }

    if ($key == 'All orders') {
        $data .= "<a href=\"/index.php?r=orders/orders/index?page="
            . $curr_page  . "\">All orders</a>";
    } else {
        $data .= "<a href=\"/index.php?r=orders/orders/index?page="
            . $curr_page . "&status=" . $status . "\">$key</a>";
    }

    $data .= "</li>";
}

echo $data;
unset($data);
?>
