<?php

namespace orders\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Services]].
 *
 * @see Services
 */
class ServicesQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Services[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Services|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
