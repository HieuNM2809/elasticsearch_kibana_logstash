<?php

use Illuminate\Support\Facades\Route;
use App\Models\Article;
use Elasticsearch\ClientBuilder;


Route::get('/', function () {
    $client = ClientBuilder::create()->setHosts(['127.0.0.1:9222'])->build();
    $indexParams = ['index' => 'articles'];

    // Kiểm tra xem chỉ mục có tồn tại hay không
    if (!$client->indices()->exists($indexParams)) {
        $params = [
            'index' => 'articles',
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
    }

    // Thêm một tài liệu mới vào chỉ mục với ID ngẫu nhiên
    $docParams = [
        'index' => 'articles',
        'type' => '_doc', // Chỉ định type
        'body' => [
            'title' => 'Introduction to Elasticsearch',
            'body' => 'Elasticsearch is a powerful search engine.',
            'tags' => 'search, elasticsearch, engine'
        ]
    ];
    $response = $client->index($docParams);

    return view('welcome')->with('response', $response);
});


Route::get('/test', function () {

    $response = [];
    $client = ClientBuilder::create()->setHosts(['127.0.0.1:9222'])->build();

    // Lấy tất cả các bài viết từ cơ sở dữ liệu
    $dataArticle = Article::all()->toArray();

    // Chuyển đổi mỗi bài viết thành tài liệu Elasticsearch và thêm vào chỉ mục
    foreach ($dataArticle as $article) {
        $docParams = [
            'index'     => 'articles',
            'id'        => $article['id'],
            'type'      => '_doc',
            'body'      => [
                'title' => $article['title'],
                'body'  => $article['body'],
                'tags'  => $article['tags']
            ]
        ];
        $response[] = $client->index($docParams);
    }
    return view('welcome')->with('response', $response);
});


Route::get('/search', function() {
    $query = 'tione lala  sint. Similique occaec'; // Replace with your search term
    $results = Article::searchByQuery($query);
    return $results;
});
