<?php

namespace Genesis\Paginations;

use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

trait CollectionPagination
{
    /**
     * Attribute for sorting column.
     *
     * @var string
     */
    protected $sortAttribute = 'sort';

    /**
     * Attribute for ordering.
     *
     * @var string
     */
    protected $orderAttribute = 'order';

    /**
     * Default order.
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
     * Paginate records.
     *
     * @param Builder $prepare
     * @param number  $limit
     * @param mixed   $items
     *
     * @return Builder
     */
    public function paginate($items, array $inputs): Builder
    {
        $page = Paginator::resolveCurrentPage($this->pageName) ?: 1;
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $options['path'] = Paginator::resolveCurrentPath();

        if (isset($inputs[$this->sortAttribute])) {
            $sorts = is_array($inputs[$this->sortAttribute])
                        ? $inputs[$this->sortAttribute]
                        : $this->parseSort($inputs[$this->sortAttribute]);
            foreach ($sorts as $column => $direction) {
                if ($direction) {
                    $items->sortBy($column, SORT_REGULAR, $direction);
                }
            }
        }

        $limit = isset($inputs[$this->limitAttribute]) ? $inputs[$this->limitAttribute] : $this->defaultLimit;
        $paginated = new LengthAwarePaginator($items->forPage($page, $limit), $items->count(), $limit, $page, $options);

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
