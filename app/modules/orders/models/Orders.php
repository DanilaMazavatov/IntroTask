<?php

namespace orders\models;

use Yii;
use yii\db\ActiveQuery;
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
     * @return ActiveQuery
     */
    public function getService(): ActiveQuery
    {
        return $this->hasOne(Services::class, ['id' => 'service_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    public static function getModes(): array
    {
        return [
            self::MODE_ALL => 'user.list.mode.all',
            self::MODE_MANUAL => 'user.list.mode.manual',
            self::MODE_AUTO => 'user.list.mode.auto',
        ];
    }

    public static function getStatuses(): array
    {
        return [
            self::STATUS_ALL => 'user.list.status.all_orders',
            self::STATUS_PENDING => 'user.list.status.pending',
            self::STATUS_IN_PROGRESS => 'user.list.status.in_progress',
            self::STATUS_COMPLETED => 'user.list.status.completed',
            self::STATUS_CANCELED => 'user.list.status.canceled',
            self::STATUS_ERROR => 'user.list.status.error',
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
