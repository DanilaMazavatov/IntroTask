<?php

namespace orders\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $user_id
 * @property string $link
 * @property int $quantity
 * @property int $service_id
 * @property int $status
 * @property int $created_at
 * @property int $mode
 *
 * @property Services $service
 * @property Users $user
 */
class Orders extends ActiveRecord
{
    const MODE_ALL = null;
    const MODE_MANUAL = 0;
    const MODE_AUTO = 1;
    const STATUS_ALL = null;
    const STATUS_PENDING = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_CANCELED = 3;
    const STATUS_ERROR = 4;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'link', 'quantity', 'service_id', 'status', 'created_at', 'mode'], 'required'],
            [['user_id', 'quantity', 'service_id', 'status', 'created_at', 'mode'], 'integer'],
            [['link'], 'string', 'max' => 300],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Services::class, 'targetAttribute' => ['service_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'link' => 'Link',
            'quantity' => 'Quantity',
            'service_id' => 'Service ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'mode' => 'Mode',
        ];
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Services::class, ['id' => 'service_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    public static function getModes(): array
    {
        return [
            self::MODE_ALL => 'All',
            self::MODE_MANUAL => 'Manual',
            self::MODE_AUTO => 'Auto',
        ];
    }

    public static function getStatuses(): array
    {
        return [
            self::STATUS_ALL => 'All',
            self::STATUS_PENDING => 'Pending',
            self::STATUS_IN_PROGRESS => 'In progress',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELED => 'Canceled',
            self::STATUS_ERROR => 'Error',
        ];
    }

    public static function findStatus($status): bool|string
    {
        foreach (self::getStatuses() as $key => $value) {
            if ($status == $key)
                return $value;
        }
        return false;
    }
    public static function findMode($mode): bool|string
    {
        foreach (self::getModes() as $key => $value) {
            if ($mode == $key)
                return $value;
        }
        return false;
    }
}
