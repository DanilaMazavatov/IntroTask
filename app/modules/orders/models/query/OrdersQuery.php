<?php

namespace app\modules\orders\models;

/**
 * This is the ActiveQuery class for [[Orders]].
 *
 * @see Orders
 */
class OrdersQuery extends \yii\db\ActiveQuery
{
    public function modeAll()
    {
        return $this->andWhere(['mode' => Orders::MODE_ALL] );
    }

    /**
     * {@inheritdoc}
     * @return Orders[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Orders|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
