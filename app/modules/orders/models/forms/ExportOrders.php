<?php

namespace app\modules\orders\models\forms;

use app\modules\orders\models\search\SearchOrder;
use Yii;
use yii\base\Model;

class ExportOrders extends Model
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['mode', 'service', 'status'], 'number'],
        ];
    }

    public function export()
    {
//        if (!$this->validate()) {
//            dd(123);
//        }

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

        $searchModel = new SearchOrder();
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
