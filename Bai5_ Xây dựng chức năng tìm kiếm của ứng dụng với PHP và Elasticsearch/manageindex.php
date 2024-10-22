<?php

use Elasticsearch\Client;

require "vendor/autoload.php";

$config = require './config/elastic.php';
$hosts = $config['elasticsearch']['hosts'];

$client = \Elasticsearch\ClientBuilder::create()
    ->setHosts($hosts)
    ->build();

/*
    Document {
        title: data,
        content: data,
        keywords: data
    }
    article_type:
       title: string|analyzer=
 */


$params = [
    'index' => 'article',

];
$indicesAll = $client->cat()->indices();

//echo '<pre>';
//var_dump($indicesAll);
//echo '</pre>';


$act = $_GET['act'] ?? null;
$mgs = 'Chọn lệnh tạo hoặc xóa';
if ($act == 'create') {
    //Tạo Index: article
    $params = [
        'index' => 'article'
    ];

    $exist = $client->indices()->exists($params);

    if ($exist) {
        $mgs = "Index - article đã tồn tại - không cần tạo";
    } else {
        $params = [
            'index' => 'article',
            'body' => [
                'mappings' => [
                    'properties' => [
                        'title' => ['type' => 'text', 'analyzer' => 'standard'],
                        'body' => ['type' => 'text', 'analyzer' => 'standard'],
                        'tags' => ['type' => 'text', 'analyzer' => 'standard'],
                    ]
                ]
            ]
        ];
        $client->indices()->create($params);
        $mgs = "Index - article mới được tạo";
    }
} elseif ($act == 'delete') {
    // Xóa index:article
    $params = [
        'index' => 'article'
    ];

    $exist = $client->indices()->exists($params);
    if ($exist) {
        $rs = $client->indices()->delete($params);
        $mgs = "Đã xóa index - article";
    } else {
        $mgs = "Index - article không tồn tại";
    }
}

$exist = $client->indices()->exists(['index' => 'article']);
?>

<div class="card m-4">
    <div class="card-header display-4 text-danger">Quản lý Index</div>
    <div class="card-body">
        <?php if (!$exist): ?>
            <a href="http://localhost:8888/?page=manageindex&act=create" class="btn btn-primary">Tạo index <strong>article</strong></a>
        <?php else: ?>
            <a href="http://localhost:8888/?page=manageindex&act=delete" class="btn btn-danger">Xóa index <strong>article</strong></a>
        <?php endif; ?>

        <div class="alert alert-danger mt-4"><?= $mgs ?></div>
    </div>
</div>