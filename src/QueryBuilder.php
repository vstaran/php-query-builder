<?php

namespace Vstaran\QueryBuilder;

use Aigletter\Interfaces\Builder\BuilderInterface;
use Aigletter\Interfaces\Builder\QueryBuilderInterface;
use Aigletter\Interfaces\Builder\QueryInterface;

/**
 * Class QueryBuilder
 * @package Vstaran\QueryBuilder
 */
class QueryBuilder implements QueryBuilderInterface
{
    /**
     * @var string Table name
     */
    protected $table = '';

    /**
     * @var array Table colums
     */
    protected $columns = [];

    /**
     * @var array Where conditions
     */
    protected $conditions = [];

    /**
     * @var null Select limit
     */
    protected $limit = null;

    /**
     * @var null Select offset
     */
    protected $offset = null;

    /**
     * @var array Select order
     */
    protected $order = [];

    /**
     * @param array|string $columns
     * @return $this|BuilderInterface
     */
    public function select($columns): BuilderInterface
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * @param array|string $conditions
     * @return $this|BuilderInterface
     */
    public function where($conditions): BuilderInterface
    {
        $this->conditions = $conditions;
        return $this;
    }

    /**
     * @param string $table
     * @return $this|BuilderInterface
     */
    public function table($table): BuilderInterface
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @param int $limit
     * @return $this|BuilderInterface
     */
    public function limit($limit): BuilderInterface
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param int $offset
     * @return $this|BuilderInterface
     */
    public function offset($offset): BuilderInterface
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @param array|string $order
     * @return $this|BuilderInterface
     */
    public function order($order): BuilderInterface
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * @return array
     */
    public function getConditions(): array
    {
        return $this->conditions;
    }

    /**
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @return int|null
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * @return array
     */
    public function getOrder(): array
    {
        return $this->order;
    }

    /**
     * @return QueryInterface
     * @throws \Exception
     */
    public function build(): QueryInterface
    {
        if(empty($this->table)) {
            throw new \Exception('Table name is required');
        }

        /**
         * MySQL documentation
         * @see https://dev.mysql.com/doc/refman/8.0/en/select.html
         */
        if(is_null($this->limit) && !is_null($this->offset)) {
            throw new \Exception('Limit must be supplied.');
        }

        /**
         * If columns not set - select all
         */
        if(empty($this->columns)) {
            $this->columns = ['*'];
        }

        return new Query($this);
    }
}