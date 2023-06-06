<?php
namespace app\modules\orders\models;
use app\models\Comments;
use const app\models\__CLASS__;

class OrderModel extends \yii\db\ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Comments the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @return array primary key of the table
     **/
    public static function primaryKey()
    {
        return array('id');
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
    }
}