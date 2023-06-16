<?php

namespace app\modules\orders\models\search;

use app\modules\orders\models\Orders;
use app\modules\orders\models\Services;
use app\modules\orders\models\Users;
use yii\base\Model;

/**
 * SearchOrder represents the model behind the search form of `app\modules\orders\models\OrderModel`.
 */
class SearchOrder extends Model
{
    const SCENARIO_FILTER = 'mode';
    const SCENARIO_SEARCH = 'search';

    public $search;

    public $mode;

    public $service;

    public $status;

    public $page;

    public $search_type;
    public $max_page;

    const LIMIT = 100;
    const FIELDS = 'o.id, u.first_name, u.last_name,
             o.link, o.quantity, o.service_id, s.name as service_name, o.status, o.mode, o.created_at';


    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['mode', 'service', 'status'], 'number'],
            [['search', 'search_type'], 'required'],
            [['page'], 'number', 'numberPattern' => '/[^0]/'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(): array
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_FILTER] = ['mode', 'service', 'page'];
        return $scenarios;
    }

    public function count()
    {
        $query = $this->buildQuery();

        $query = $this->applyFilters($query);

        return $query->count();
    }

    public function search()
    {
//        if (!$this->validate()) {
//            dd(123);
//        }

        $query = $this->buildQuery();

        $query
            ->limit(self::LIMIT)
            ->offset(($this->page - 1) * 100);

        $query = $this->selectQuery($query);

        $query = $this->applyFilters($query);

        $query->asArray();

        return $query->all();
    }
    public function searchToExport()
    {
//        if (!$this->validate()) {
//            dd(123);
//        }

        $query = $this->buildQuery();

        $query = $this->selectQuery($query);

        $query = $this->applyFilters($query);

        $query->asArray();

        return $query;
    }

    private function buildQuery ()
    {
        return Orders::find()
            ->from(Orders::tableName() . ' o')
            ->leftJoin(Services::tableName() . ' s', 'o.service_id = s.id')
            ->leftJoin(Users::tableName() . ' u', 'o.user_id = u.id');
    }

    private function selectQuery($query)
    {
        return $query->select(self::FIELDS);
    }

    private function applyFilters ($query)
    {
        switch ($this->search_type) {
            case null:
                break;
            case 1:
                $query->andFilterWhere([
                    '=', 'o.id', $this->search
                ]);
                break;
            case 2:
                $query->andFilterWhere([
                    'like', 'o.link', $this->search
                ]);
                break;
            case 3:
                $query->andFilterWhere([
                    'like', 'concat(u.first_name, \' \', u.last_name)', $this->search
                ]);
                break;
        }


        $query->andFilterWhere([
            'o.mode' => $this->mode,
            'o.service_id' => $this->service,
            'o.status' => $this->status,
        ]);

        return $query;
    }

    private function getMaxPage($query)
    {
        $this->max_page = intval(ceil($query->count() / self::LIMIT));
    }

}
