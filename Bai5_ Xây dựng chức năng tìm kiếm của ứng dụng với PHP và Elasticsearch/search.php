<?php

use Elasticsearch\Client;

require 'vendor/autoload.php';

$config = require './config/elastic.php';
$hosts = $config['elasticsearch']['hosts'];

$client = \Elasticsearch\ClientBuilder::create()
    ->setHosts($hosts)
    ->build();

$search = $_POST['search'] ?? null;
$rs = null;

if ($search != null) {
    $params = [
        'index' => 'article',
        'body'  => [
            'query' => [
                'bool' => [
                    'should' => [
                        ['match' => ['title' => $search]],
                        ['match' => ['keywords' => $search]],
                    ]
                ]
            ],
            'highlight' => [
                'pre_tags'     => ["<strong class='text-danger'>"],
                'post_tags'    => ["</strong>"],
                'fields' => [
                    'title'    => new stdClass(),
                    'keywords' => new stdClass()
                ]
            ]
        ]
    ];


    $prs = $client->search($params);

//    echo "<pre>";
//    print_r($prs);
//    echo "</pre>";
    if ((int)$prs['hits']['total']['value'] >= 1) {
        $rs = $prs['hits']['hits'];
    }
//    echo "<pre>";
//    print_r($rs);
//    echo "</pre>";
}
?>
<div class="card m-4">
    <div class="card-header display-4 text-danger">Tìm kiếm</div>
    <div class="card-body">
        <form method="post" class="form-inline">
            <div class="form-group">
                <input name="search" value="<?= $search ?>" class="form-control">
                <input type="submit" value="Tìm kiếm" class="form-control btn btn-danger ml-2">
            </div>
        </form>
        <hr>
        <?php if ($rs != null): ?>
            <h3>Kết quả tìm kiếm: <?php echo htmlspecialchars($search); ?></h3>
            <hr>
            <?php foreach($rs as $r): ?>
                <?php
                $title    = $r['highlight']['title'][0] ?? $r['_source']['title'];
                $keywords = $r['highlight']['keywords'] ?? $r['_source']['keywords'];
                ?>
                <p>
                    <a href="#"><?php echo ($title); ?></a> <br>
                    <?php echo (implode(', ', $keywords)); ?>
                </p>
                <hr>
            <?php endforeach; ?>
        <?php endif; ?>


    </div>
</div>