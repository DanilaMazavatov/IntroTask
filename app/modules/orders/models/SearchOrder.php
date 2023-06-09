<?php

namespace app\modules\orders\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use yii\db\ActiveQuery;

/**
 * SearchOrder represents the model behind the search form of `app\modules\orders\models\OrderModel`.
 */
class SearchOrder extends OrderModel
{

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'user_id', 'quantity', 'service_id', 'status', 'created_at', 'mode'], 'integer'],
            [['link'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(): array
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @return ActiveQuery|null
     * @throws InvalidArgumentException
     */
    public function search(array $params): ActiveQuery|null
    {
        $mode = $params['mode'] ?? null;
        $service_id = $params['service'] ?? null;
        $status = $params['status'] ?? null;
        $page = $params['page'] ?? null;

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return null;
        }

        $query = OrderModel::find()
            ->select('o.id, u.first_name, u.last_name,
             o.link, o.quantity, o.service_id, s.name as service_name, o.status, o.mode, o.created_at')
            ->from('orders o')
            ->leftJoin('services s', 'o.service_id = s.id')
            ->leftJoin('users u', 'o.user_id = u.id')
            ->offset(($page - 1) * 100)
            ->limit(100)
            ->asArray();

        $query->andFilterWhere([
        'o.mode' => $mode,
        'o.service_id' => $service_id,
        'o.status' => $status,
    ]);
        return $query;

        //
//        $this->load($params);
//


        // grid filtering conditions


    }
}
