<?php

use Illuminate\Support\Facades\Route;
use App\Models\Article;
use Elasticsearch\ClientBuilder;

Route::get('/', function () {

    $client = ClientBuilder::create()->setHosts(['localhost:9222'])->build();
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

    return view('welcome');
});

Route::get('/test', function () {
    $dataArticle = Article::all()->toArray();

    dd($dataArticle);

    $client = ClientBuilder::create()->setHosts(['localhost:9222'])->build();

    $params = [
        'index' => 'articles',
        'body' => [
            $dataArticle
        ]
    ];

    $client->indices()->create($params);

    return view('welcome');
});


Route::get('/search', function() {


    $query = 'Dolores'; // Replace with your search term
    $results = Article::searchByQuery($query);

    return $results;
});
