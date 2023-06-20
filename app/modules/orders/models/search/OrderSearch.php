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
    const SCENARIO_SEARCH = 'search';

    const LIMIT = 100;
    const SEARCH_TYPE_ID = 1;
    const SEARCH_TYPE_LINK = 2;
    const SEARCH_TYPE_USER = 3;

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
            ['mode', 'in', 'range' => [Orders::MODE_MANUAL, Orders::MODE_AUTO]],
            ['service', 'number'],
            ['status', 'in', 'range' => array_keys(Orders::getStatuses()),],
            ['search_type', 'in', 'range' => self::getSearchTypes(), 'on' => self::SCENARIO_SEARCH],
            ['search', 'required', 'on' => self::SCENARIO_SEARCH],
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

    /**
     * {@inheritdoc}
     */
    public function scenarios(): array
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SEARCH] = ['search', 'search_type', 'mode', 'status', 'services', 'page'];
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

        $query = $this->applySearchFilters($query);
        $query = $this->applyCheckFilters($query);


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

        $query = $this->applySearchFilters($query);
        $query = $this->applyCheckFilters($query);

        $query->asArray();

        if (empty($query->all())) {
            $this->addError('error', Yii::t('app', 'user.list.search.empty'));
            return false;
        }

        return $query->all();
    }
    public function searchToExport()
    {
        $query = $this->buildQuery();

        $query = $this->selectQuery($query);

        $query = $this->applySearchFilters($query);
        $query = $this->applyCheckFilters($query);

        $query->asArray();

        return $query;
    }

    public function searchServices()
    {
        $query = $this->buildQuery();

        $query = $this->selectServiceQuery($query);

        $query = $this->applySearchFilters($query);

        $query->asArray();

        return $query->all();
    }

    public function searchMode()
    {
        $query = $this->buildQuery();

        $query = $this->selectModeQuery($query);

        $query = $this->applySearchFilters($query);

        $query->asArray();

        return $query->column();
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
        return $query->select([
            'o.id',
            'u.first_name',
            'u.last_name',
            'o.link',
            'o.quantity',
            'o.service_id',
            's.name as service_name',
            'o.status',
            'o.mode',
            'o.created_at'
        ])->distinct();
    }

    private function selectServiceQuery($query)
    {
        return $query->select([
            's.id as id',
            's.name as name'
        ]);
    }
    private function selectModeQuery($query)
    {
        return $query->select([
            'o.mode'
        ])->distinct();
    }

    private function applyCheckFilters($query)
    {
        $query->andFilterWhere([
            'o.mode' => $this->mode,
            'o.service_id' => $this->service,
            'o.status' => $this->status,
        ]);

        return $query;
    }

    private function applySearchFilters ($query)
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

       return $query;
    }

}
