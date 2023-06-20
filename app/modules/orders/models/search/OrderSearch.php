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

    private bool $pagination = true;
    private bool $checkFilter = true;
    private bool $returnArray = true;
    private bool $selectMode = false;
    private bool $selectService = false;

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

    /**
     * @return int[]
     */
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


    public function count()
    {
        if (!$this->validate()) {
            return false;
        }

        $query = $this->buildQuery();

        $query = $this->applySearchFilters($query);

        if ($this->checkFilter)
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

        if ($this->pagination) {
            $query->limit(static::LIMIT)
                ->offset(($this->page - 1) * static::LIMIT);
        }

        if ($this->selectService) {
            $query = $this->selectServiceQuery($query);
        } elseif ($this->selectMode) {
            $query = $this->selectModeQuery($query);
        } else {
            $query = $this->selectQuery($query);
        }

        $query = $this->applySearchFilters($query);

        if ($this->checkFilter)
            $query = $this->applyCheckFilters($query);

        $query->asArray();

        if (empty($query->all())) {
            $this->addError('error', Yii::t('app', 'user.list.search.empty'));
            return false;
        }

        return $this->returnArray ? $query->all() : $query;
    }

    /**
     * @return mixed
     */
    public function searchServices(): mixed
    {
        $query = $this->buildQuery();

        $query = $this->selectServiceQuery($query);

        $query = $this->applySearchFilters($query);

        $query->asArray();

        return $query->all();
    }

    /**
     * @return mixed
     */
    public function searchMode(): mixed
    {
        $query = $this->buildQuery();

        $query = $this->selectModeQuery($query);

        $query = $this->applySearchFilters($query);

        $query->asArray();

        return $query->column();
    }

    /**
     * @return ActiveQuery
     */
    private function buildQuery(): ActiveQuery
    {
        return Orders::find()
            ->from(Orders::tableName() . ' o')
            ->leftJoin(Services::tableName() . ' s', 'o.service_id = s.id')
            ->leftJoin(Users::tableName() . ' u', 'o.user_id = u.id');
    }

    /**
     * @param $query
     * @return mixed
     */
    private function selectQuery($query): mixed
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

    /**
     * @param $query
     * @return mixed
     */
    private function selectServiceQuery($query): mixed
    {
        return $query->select([
            's.id as id',
            's.name as name'
        ]);
    }

    /**
     * @param $query
     * @return mixed
     */
    private function selectModeQuery($query): mixed
    {
        return $query->select([
            'o.mode'
        ])->distinct();
    }

    /**
     * @param $query
     * @return mixed
     */
    private function applyCheckFilters($query): mixed
    {
        $query->andFilterWhere([
            'o.mode' => $this->mode,
            'o.service_id' => $this->service,
            'o.status' => $this->status,
        ]);

        return $query;
    }

    /**
     * @param $query
     * @return mixed
     */
    private function applySearchFilters($query): mixed
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

    /**
     * @param bool $pagination
     */
    public function setPagination(bool $pagination): void
    {
        $this->pagination = $pagination;
    }

    /**
     * @param bool $checkFilter
     */
    public function setCheckFilter(bool $checkFilter): void
    {
        $this->checkFilter = $checkFilter;
    }

    /**
     * @param bool $returnArray
     */
    public function setReturnArray(bool $returnArray): void
    {
        $this->returnArray = $returnArray;
    }

}
