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

    public $search;

    public $mode;

    public $service;

    public $status;

    public $page;

    public $search_type;

    const LIMIT = 100;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'user_id', 'quantity', 'service', 'status', 'created_at', 'mode', 'search_type',], 'integer'],
            [['search'], 'string'],
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
    public function search(array $params, $without_limit = null): ActiveQuery|null
    {
        $this->mode = $params['mode'] ?? null;
        $this->service = $params['service'] ?? null;
        $this->status = $params['status'] ?? null;
        $this->page = $params['page'] ?? null;
        $this->search = isset($params['search']) ? strtolower(trim($params['search'], ' ')) : null;
        $this->search_type = $params['search_type'] ?? null;
        $operator = 'like';

        switch ($this->search_type) {
            case null:
                $search_value = null;
                break;
            case 1:
                $search_value = 'o.id';
                $operator = '=';
                break;
            case 2:
                $search_value = 'o.link';
                break;
            case 3:
                $search_value = 'concat(u.first_name, \' \', u.last_name)';
                break;
        }

        $query = OrderModel::find()
            ->select('o.id, u.first_name, u.last_name,
             o.link, o.quantity, o.service_id, s.name as service_name, o.status, o.mode, o.created_at')
            ->from('orders o')
            ->leftJoin('services s', 'o.service_id = s.id')
            ->leftJoin('users u', 'o.user_id = u.id')
            ->offset(($this->page - 1) * 100);

        if(!$without_limit)
            $query->limit(self::LIMIT);

        $query->asArray();

//        if (!$this->validate()) {
//            return $query;
//        }

        $query->andFilterWhere([
            $operator, $search_value, $this->search
        ]);

        $query->andFilterWhere([
            'o.mode' => $this->mode,
            'o.service_id' => $this->service,
            'o.status' => $this->status,
        ]);

        return $query;
    }
}
