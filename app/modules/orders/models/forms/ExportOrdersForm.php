<?php

namespace orders\models\forms;

use orders\models\search\OrderSearch;
use Yii;
use yii\base\ExitException;
use yii\base\InvalidArgumentException;
use yii\base\Model;

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

    public $search_type;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return OrderSearch::getRules();
    }

    /**
     * @throws ExitException
     * @throws InvalidArgumentException
     */
    public function export()
    {

        $date = date('d.m.Y');

        $stream = fopen('php://output', 'a');

        header('Content-Disposition: attachment;filename="export_' . $date . '.csv"');

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
        $searchModel->load($this->getAttributes(), '');

        foreach ($searchModel->searchToExport()->batch() as $search) {
            foreach ($search as $value) {
                fputcsv(
                    $stream,
                    [
                        $value['id'],
                        $value['last_name'] . ' ' . $value['first_name'],
                        $value['link'],
                        $value['quantity'],
                        $value['service_id'] . ' ' . $value['service_name'],
                        $value['status'],
                        $value['mode'],
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
