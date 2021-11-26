## QueryBuilder
![License](https://img.shields.io/github/license/aschmelyun/larametrics.svg?style=flat-square)

Implement builder pattern, use PDO.


## Installation
You can install the package via composer:

```
composer require vstaran/php-query-builder
```

## Basic usage
```php
$builder = new QueryBuilder();
$query = $builder->table('users')
    ->select(['first_name', 'age'])
    ->where(['status' => 'active'])
    ->order(['id' => 'ASC'])
    ->limit(20)
    ->offset(40)
    ->build();
```


## Road map
- Add methods `JOIN`, `GROUPBY`, `HAVING` etc...
- Create `INSERT`, `UPDATE` and `DETELE` statement


## Dependencies
- require packagist `aigletter/interfaces`

## License
The MIT License (MIT).
