<?php


namespace Vstaran\QueryBuilder;

use Aigletter\Interfaces\Builder\QueryBuilderInterface;
use Aigletter\Interfaces\Builder\QueryInterface;

class Query implements QueryInterface
{
    protected  $table;
    protected  $columns;
    protected  $conditions;
    protected  $limit;
    protected  $offset;
    protected  $order;

    /**
     * Query constructor.
     * @param QueryBuilderInterface $builder
     */
    public function __construct(QueryBuilderInterface $builder)
    {
        $this->table = $builder->getTable();
        $this->columns = $builder->getColumns();

        $this->conditions = $builder->getConditions();
        $this->limit = $builder->getLimit();
        $this->offset = $builder->getOffset();
        $this->order = $builder->getOrder();
    }

    /**
     * SQL to string
     * @return string
     */
    public function __toString(): string
    {
        $order = $this->order === [] ? '' : ' ORDER BY ' . implode(', ', array_map(
            function ($order, $sort) { return "$order $sort"; },
            array_keys($this->order),
            array_values($this->order)
        ));

        $limit = is_null($this->limit) ? '' : ' LIMIT ' . ((int) $this->limit);
        $offset = is_null($this->offset) ? '' : ' OFFSET ' . ((int) $this->offset);

        $where = $this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', array_map(
                function ($column, $value) { return "$column = '$value'"; },
                array_keys($this->conditions),
                array_values($this->conditions)
        ));

        return 'SELECT ' . implode(', ', $this->columns)
            . ' FROM ' . $this->table
            . $where
            . $order
            . $limit
            . $offset;
    }

    /**
     * SQL to string
     * @return string
     */
    public function toSql(): string
    {
        return $this->__toString();
    }
}