<?php

namespace Vstaran\QueryBuilder;

use Aigletter\Interfaces\Builder\DbInterface;
use Aigletter\Interfaces\Builder\QueryInterface;
use PDO;

/**
 * Class DbMysql
 * @package Vstaran\QueryBuilder
 */
class Db implements DbInterface
{
    /**
     * @var mysqli DB Connection
     */
    private $connection;

    /**
     * DbMysql constructor.
     * @param $dsn
     * @param $user
     * @param $password
     */
    public function __construct($dsn, $user, $password)
    {
        $this->connection = new PDO($dsn, $user, $password);

        // PDO::FETCH_NUM - returns enumerated array
        // PDO::FETCH_ASSOC - returns associative array
        // PDO::FETCH_BOTH - both of the above
        // PDO::FETCH_OBJ - returns object
        // PDO::FETCH_LAZY - allows all three (numeric associative and object) methods without memory overhead.
    }

    /**
     * Fetch one row
     *
     * @param QueryInterface $query
     * @return object
     */
    public function one(QueryInterface $query): object
    {
        $query = $this->connection->prepare((string) $query);
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Fetch all rows
     *
     * @param QueryInterface $query
     * @return array
     */
    public function all(QueryInterface $query): array
    {
        $query = $this->connection->prepare((string) $query);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}