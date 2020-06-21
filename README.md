# VZPager

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svf?style=flat-square)](LICENSE.md)

A library to split results into multimple pages

## Install

Via Composer

``` bash
$ composer require chame1e0n/pager
```

## Usage

``` php
$obj = new VZPager\DirPager(
    new VZPager\PagesList(),
    'photos',
    3,
    2);

echo "<pre>"; print_r($obj->getItems());  echo "</pre>";

echo "<p>$obj</p>";
```

``` php
$obj = new VZPager\FilePager(
    new VZPager\ItemsRange(),
    'largetextfile.txt');

echo "<pre>"; print_r($obj->getItems()); echo "</pre>";

echo "<p>$obj</p>";
```

``` php
try {
    $pdo = new \PDO(
        'mysql:host=localhost;dbname=test',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $obj = new VZPager\PdoPager(
        new VZPager\ItemsRange(),
        $pdo,
        'table_name');

    echo "<pre>"; print_r($obj->getItems()); echo "</pre>";

    echo "<p>$obj</p>";
} catch (\PDOException $e) {
    echo "Can't connect to database";
}
```

## License

The MIT License (MIT). Please see [License File](https://github.com/dnoegel/php-xdg-base-dir/blob/master/LICENSE) for more information.