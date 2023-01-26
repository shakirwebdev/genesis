<?php

namespace Genesis\Paginations;

use Illuminate\Contracts\Database\Query\Builder;

trait DatabasePagination
{
    /**
     * Attribute for sorting column.
     *
     * @var string
     */
    protected $sortAttribute = 'sort';

    /**
     * The default order.
     *
     * @var string
     */
    protected $defaultOrder = 'asc';

    /**
     * Attribute for limiter.
     *
     * @var string
     */
    protected $limitAttribute = 'limit';

    /**
     * Default limit.
     *
     * @var int
     */
    protected $defaultLimit = 25;

    /**
     * The page name.
     *
     * @var string
     */
    protected $pageName = 'page';

    /**
     * The sortable columns.
     *
     * @var array
     */
    protected $sorts = [];

    /**
     * Paginate records.
     *
     * @param $builder
     * @param array $inputs
     * @param mixed $select
     *
     * @return mixed
     */
    public function paginate(Builder $builder, array $inputs, $select = ['*'])
    {
        if (isset($inputs[$this->sortAttribute])) {
            $sorts = is_array($inputs[$this->sortAttribute])
                        ? $inputs[$this->sortAttribute]
                        : $this->parseSort($inputs[$this->sortAttribute]);
            foreach ($sorts as $column => $direction) {
                if ($direction) {
                    $builder->orderBy($this->getQualifiedColumn($column), $direction);
                }
            }
        }

        $limit = isset($inputs[$this->limitAttribute]) ? $inputs[$this->limitAttribute] : $this->defaultLimit;
        $page = isset($inputs[$this->pageName]) ? $inputs[$this->pageName] : 1;
        $paginated = $builder->paginate($limit, $select, $this->pageName, $page);

        if (!empty($inputs)) {
            $paginated->appends($inputs);
        }

        return $paginated;
    }

    /**
     * Get sort symbols.
     *
     * @return array
     */
    public function getOrderSigns(): array
    {
        return [
            '-' => 'desc',
            '+' => 'asc',
        ];
    }

    /**
     * Get sorting delimeter.
     *
     * @return string
     */
    public function getSortDelimeter(): string
    {
        return ',';
    }

    /**
     * Get qualified column.
     *
     * @param string $column
     *
     * @return string
     */
    protected function getQualifiedColumn(string $column): string
    {
        $qualifiedColumn = $column;
        if (isset($this->sorts[$column])) {
            $table = $this->sorts[$column]['table'] ?? null;
            if (isset($this->sorts[$column]['column'])) {
                $qualifiedColumn = $table
                            ? $table.'.'.$this->sorts[$column]['column']
                            : $this->sorts[$column]['column'];
            }
        }

        return $qualifiedColumn;
    }

    /**
     * Parse sorting.
     *
     * @param string $sortString
     *
     * @return array
     */
    protected function parseSort(string $sortString): array
    {
        $sortColumns = [];
        $sorts = explode($this->getSortDelimeter(), $sortString);
        if ($sorts) {
            $symbols = $this->getOrderSigns();
            foreach ($sorts as $sort) {
                if (array_key_exists($sort[0], $symbols)) {
                    $sortColumns[substr($sort, 1, strlen($sort))] = $symbols[$sort[0]];
                } else {
                    $sortColumns[$sort] = $this->defaultOrder;
                }
            }
        }

        return $sortColumns;
    }
}
