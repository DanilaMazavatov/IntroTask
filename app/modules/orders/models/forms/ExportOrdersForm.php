<?php

namespace orders\models\forms;

use orders\controllers\OrdersController;
use orders\models\Orders;
use orders\models\search\OrderSearch;
use Yii;
use yii\base\ExitException;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use yii\web\NotFoundHttpException;

/**
 * Form for export data to CSV file
 */
class ExportOrdersForm extends Model
{
    public $search;

    public $mode;

    public $service;

    public $status;

    public $page;

    /**
     * @throws ExitException
     * @throws InvalidArgumentException
     * @throws NotFoundHttpException
     */
    public function export()
    {

        $date = date('d.m.Y');

        $stream = fopen('php://output', 'a');

        ob_start();
        fputcsv(
            $stream,
            [
                'ID',
                Yii::t('app', 'user.list.columns.user'),
                Yii::t('app', 'user.list.columns.link'),
                Yii::t('app', 'user.list.columns.quantity'),
                Yii::t('app', 'user.list.services.services'),
                Yii::t('app', 'user.list.columns.status'),
                Yii::t('app', 'user.list.columns.mode'),
                Yii::t('app', 'user.list.columns.created'),
                "\r\n"
            ]);

        ob_flush();
        flush();

        $searchModel = new OrderSearch();

        if ($scenario = OrdersController::expectScenario())
            $searchModel->setScenario($scenario);

        $searchModel->load($this->getAttributes(), '');

        if(!$searchModel->validate()) {
            $this->addError('error', implode($searchModel->getFirstErrors()));
            return false;
        }

        $searchModel->setPagination(false);

        $searchModel->setReturnArray(false);

        header('Content-Disposition: attachment;filename="export_' . $date . '.csv"');

        foreach ($searchModel->search()->batch() as $search) {
            foreach ($search as $value) {
                fputcsv(
                    $stream,
                    [
                        $value['id'],
                        $value['last_name'] . ' ' . $value['first_name'],
                        $value['link'],
                        $value['quantity'],
                        $value['service_id'] . ' ' . $value['service_name'],
                        Yii::t('app', Orders::findStatus($value['status'])),
                        Yii::t('app', Orders::findMode($value['mode'])),
                        date("Y-m-d h:i:s", $value['created_at'])
                    ]);
                ob_flush();
                flush();
            }
        }

        ob_end_clean();

        exit();
    }
}
