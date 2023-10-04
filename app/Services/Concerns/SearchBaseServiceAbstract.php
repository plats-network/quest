<?php

namespace App\Services\Concerns;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

abstract class SearchBaseServiceAbstract
{

    /**
     * Loading relationship
     *
     * @var array
     */
    protected $withLoad = [];

    /**
     * Filter data from request parameters
     *
     * @var array | \Illuminate\Support\Collection
     */
    protected $filter = [];

    /**
     * Query builder
     *
     * @var \Illuminate\Database\Eloquent\Model| \Illuminate\Support\Facades\DB | \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    /**
     * Change simple paginate
     *
     * @var bool
     */
    protected $simplePaginate = false;

    /**
     * Request Http for get parameters
     *
     * @var Request
     */
    protected $requestHttp;

    /**
     * Auto paginate with query parameters
     *
     * @param  array  $conditions
     *
     * @return mixed
     */
    public function search($conditions = [])
    {
        $this->makeBuilder($conditions);

        return $this->endFilter();
    }

    /**
     * Make query builder with repository
     *
     * @param  array  $hasChange
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function makeBuilder($hasChange = [], $request = null)
    {
        $this->requestHttp = (is_null($request)) ? app('request') : $request;

        $this->makeFilter($hasChange);

        return $this->builder = $this->repository->makeModel()->with($this->withLoad);
    }

    /**
     * Make filter from query parameters
     *
     * @param  array  $hasChange
     *
     * @return \Illuminate\Support\Collection
     */
    public function makeFilter($hasChange = [])
    {
        // Parse include relationships
        $this->includeRelationship($hasChange['withLoad'] ?? []);

        return $this->filter = $this->requestParse($hasChange);
    }

    /**
     * Merge whereBuilder and OrderBuilder.
     * Output paginate for auto search with query parameters
     *
     * @return mixed
     */
    public function endFilter()
    {
        /**
         * DO: Merge whereBuilder and OrderBuilder
         */
        $this->builder = $this->repository->whereBuilder($this->filter, $this->builder);
        $this->builder = $this->repository->orderBuilder($this->filter->get('sort'), $this->builder);

        /**
         * DO: Custom select fields database
         */
        if ($this->filter->has('fields')) {
            $this->builder = $this->builder->select($this->filter->get('fields'));
        }

        /**
         * DO: When get all data, skip paginate
         */
        if ($this->filter->has('all')) {
            return $this->builder->get();
        }

        /**
         * DO: skip paginate and limit records for response
         */
        if ($this->filter->has('get')) {
            $limit = $this->filter->get('get', 0);
            if (is_numeric($limit) && $limit > 0) {
                return $this->builder->limit($limit)->get();
            }

            return $this->builder->get();
        }

        /**
         * DO: set limitation for query database and response paginate
         */
        $limitData = $this->filter->get('limit');
        if ($this->simplePaginate) {
            return $this->builder->simplePaginate($limitData)->appends(request()->all());
        }

        return $this->builder->paginate($limitData)->appends(request()->all());
    }

    /**
     * Clean auto query parameters
     *
     * @param  string | array  $key
     *
     * @return \Illuminate\Support\Collection
     */
    public function cleanFilterBuilder($key)
    {
        return $this->filter = $this->filter->forget($key);
    }

    /**
     * Set simple paginate
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Facades\DB
     */
    public function useSimplePage()
    {
        $this->simplePaginate = true;

        return $this->builder;
    }

    /**
     * Parse request query parameters
     *
     * @param  array  $hasChange
     *
     * @return \Illuminate\Support\Collection
     */
    public function requestParse($hasChange = [])
    {
        $allRequest = $this->filterRequest();

        $result = collect($allRequest['filter'])
            ->merge(['sort' => $allRequest['sort'], 'limit' => $allRequest['limit']]);

        /**
         * DO: Merge request loadingMissing eloquent
         */
        if (!empty($hasChange)) {
            unset($hasChange['withLoad']);
            $result = $result->merge($hasChange);
        }

        return $result;
    }

    /**
     * Create paging with default values and empty record
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function makePaginatorEmpty()
    {
        return new LengthAwarePaginator([], 0, request()->input('limit', PAGE_SIZE), request()->input('page', 1), [
            'path'  => request()->url(),
            'query' => request()->query(),
        ]);
    }

    /**
     * Parse soring for query from request parameters
     *
     * @param $string
     *
     * @return array
     */
    protected function parseSorting($string)
    {
        $result = [];

        $sort = array_map(function ($str) {
            return trim(filter_var($str, FILTER_SANITIZE_STRING));
        }, explode(',', $string));

        /**
         * DO: execute sort data
         */
        foreach ($sort as $expr) {
            if (empty($expr)) {
                continue;
            }

            /**
             * DO: define type of sort for query database
             */
            $sortType   = 'ASC';
            $columnName = $expr;
            if (str_starts_with($expr, '-')) {
                $columnName = substr($expr, 1);
                $sortType   = 'DESC';
            }

            $result[$columnName] = $sortType;
        }

        return $result;
    }

    /**
     * Parse request query parameters
     *
     * @return array
     */
    private function filterRequest()
    {
        $request = $this->requestHttp;

        $filterData = [
            'filter'   => [],
            'download' => ($request->input('download', false) === 'true'),
        ];

        /**
         * DO: Get and sanitize filters from the URL
         */
        $filterData['limit'] = $request->get('limit', PAGE_SIZE);
        $rawFilters          = $request->all(); //get query parameters from request
        if ($rawFilters) {
            Arr::forget($rawFilters, ['token', 'sort', 'fields', 'page', 'limit', 'download', 'withLoad', 'include']);

            // Parse raw filter from query request
            foreach ($rawFilters as $k => $v) {
                if (is_array($v)) {
                    $filled = array_filter($v, function ($elm) {
                        return filter_var($elm, FILTER_SANITIZE_ADD_SLASHES);
                    });

                    if (!empty($filled)) {
                        $filterData['filter'][$k] = $filled;
                    }

                    continue;
                }

                if (strlen($v) == 0) {
                    continue;
                }

                $filterData['filter'][$k] = filter_var($v, FILTER_SANITIZE_ADD_SLASHES);
            }
        }

        /**
         * DO: set sort query
         */
        $filterData['sort'] = $this->parseSorting($request->input('sort'));

        /**
         * DO: set fields select database
         */
        $filterData['fields'] = !$request->has('fields')
            ? ['*']
            : array_filter(array_map('trim', explode(',', $request->get('fields'))));

        return $filterData;
    }

    /**
     * Parse request include relationship from request parameter: include
     *
     * @return array | void
     */
    private function includeRelationship($appends)
    {
        $request = $this->requestHttp;
        if (!empty($appends)) {
            $this->withLoad = is_array($appends) ? $appends : [$appends];
        }

        // Include from request parameters
        if (!$request->has('include')) {
            return;
        }

        return $this->withLoad = array_unique(array_merge($this->withLoad, [$request->input('include')]));
    }
}
