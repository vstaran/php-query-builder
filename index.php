<?php

include_once __DIR__ . "/vendor/autoload.php";

use Vstaran\QueryBuilder\Db;
use Vstaran\QueryBuilder\QueryBuilder;

// ================== Level 2 =================
$builder = new QueryBuilder();
$query = $builder->table('users')
    ->select(['first_name', 'age'])
    ->where(['status' => 'active'])
    ->order(['id' => 'ASC'])
    ->limit(20)
    ->offset(40)
    ->build();

echo (string) $query . "<br>";
echo $query->toSql() . "<br>";


// ================== Level 3 =================

$builder = new QueryBuilder();
$query = $builder
    ->table('users')
    ->select(['first_name', 'age'])
    ->build();

$db = new Db("mysql:host=localhost;dbname=test", "root", "root");

$user = $db->one($query);

echo "<pre>";
print_r($user);
echo "</pre>";

/*
 *
[
    'first_name' => 'Ivan',
    'age' => 34
]
 *
 */


$users = $db->all($query);
echo "<pre>";
print_r($users);
echo "</pre>";
/*
 *
[
    [
        'first_name' => 'Ivan',
        'age' => 34
    ],
    [
        'first_name' => 'Oleg',
        'age' => 22
    ],
]
 *
 */
