<?php

namespace orders\models\search;

use orders\models\Orders;
use orders\models\Services;
use orders\models\Users;
use Yii;
use yii\base\ExitException;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use yii\db\ActiveQuery;
use yii\web\NotFoundHttpException;

/**
 * SearchOrder represents the model behind the search form of `orders\models\OrderModel`.
 */
class OrderSearch extends Model
{
    const SCENARIO_FILTER = 'filter';
    const SCENARIO_SEARCH = 'search';
    const SCENARIO_STATUS = 'status';

    const LIMIT = 100;
    const SEARCH_TYPE_ID = 1;
    const SEARCH_TYPE_LINK = 2;
    const SEARCH_TYPE_USER = 3;
    const FIELDS = 'o.id, u.first_name, u.last_name,
             o.link, o.quantity, o.service_id, s.name as service_name, o.status, o.mode, o.created_at';

    public $search;

    public $mode;

    public $service;

    public $status;

    public $page;

    public $search_type;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            ['mode', 'in', 'range' => [Orders::MODE_MANUAL, Orders::MODE_AUTO], 'on' => self::SCENARIO_FILTER],
            ['service', 'number', 'on' => self::SCENARIO_FILTER],
            ['status', 'in', 'range' => array_keys(Orders::getStatuses()),
                'on' => self::SCENARIO_STATUS],
            ['search_type', 'in', 'range' => self::getSearchTypes(), 'on' => self::SCENARIO_SEARCH],
            ['search', 'string', 'on' => self::SCENARIO_SEARCH],
            ['page', 'number', 'numberPattern' => '/[^0]/'],
        ];
    }

    public static function getSearchTypes(): array
    {
        return [
            self::SEARCH_TYPE_ID,
            self::SEARCH_TYPE_LINK,
            self::SEARCH_TYPE_USER,
        ];
    }

    public static function getRules(): array
    {
        return (new OrderSearch)->rules();
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(): array
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_FILTER] = ['mode', 'service', 'page'];
        $scenarios[self::SCENARIO_SEARCH] = ['search', 'search_type', 'page'];
        $scenarios[self::SCENARIO_STATUS] = ['status', 'page'];
        return $scenarios;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function count()
    {
        if (!$this->validate()) {
           return false;
        }

        $query = $this->buildQuery();

        $query = $this->applyFilters($query);


        return $query->count();
    }

    /**
     * @throws NotFoundHttpException
     * @throws InvalidArgumentException|ExitException
     */
    public function search()
    {
        if (!$this->validate()) {
            return false;
        }

        $query = $this->buildQuery();

        $query->limit(self::LIMIT)
            ->offset(($this->page - 1) * 100);

        $query = $this->selectQuery($query);

        $query = $this->applyFilters($query);

        $query->asArray();

        if (empty($query->all())) {
            Yii::$app->end(Yii::t('app', 'user.list.search.empty'));
        }

        return $query->all();
    }
    public function searchToExport()
    {
        $query = $this->buildQuery();

        $query = $this->selectQuery($query);

        $query = $this->applyFilters($query);

        $query->asArray();

        return $query;
    }

    private function buildQuery (): ActiveQuery
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

}
