<?php
namespace app\modules\orders\models;
use app\models\Comments;
use Yii;
use yii\db\Exception;
use const app\models\__CLASS__;

class OrderModel extends \yii\db\ActiveRecord
{
    private $default_fields = 'o.id as ID, concat(u.first_name , " " , u.last_name) as User, o.link as Link, o.quantity as Quantity, o.service_id, s.name as Service, o.status as Status, o.mode as Mode, o.created_at as Created';
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
     * Данный метод отвечает за постраничную выборку данных из соответствующей таблицы
     * @throws Exception
     */
    public function getDataOnPage($page, $service = null, int $mode = null, int $status = null)
    {
        if ($status !== null) {
            $where = "WHERE o.status = $status";
        } elseif ($service && $mode !== null) {
            $where = "WHERE o.service_id = $service AND o.mode = $mode";
        } elseif ($service && $mode === null) {
            $where = "WHERE o.service_id = $service";
        } elseif (!$service && $mode !== null) {
            $where = "WHERE o.mode = $mode";
        }


        $data = Yii::$app->db->createCommand('SELECT
            ' . $this->default_fields . '
            FROM ' . self::tableName() . ' o
            LEFT JOIN users u on o.user_id = u.id
            Left JOIN services s on o.service_id = s.id
            ' .
            ($where ?? '')
            .  '
            ORDER BY ID DESC
            LIMIT 100 
            OFFSET ' . ($page - 1) * 100 . ' 
            ')->queryAll();

        return $data;
    }

    #TODO: Оформить нормальную валидацию и подключить к ней нужные методы
    public function rules()
    {
        return [
            [['page'], 'integer'],
        ];
    }
}