<?php

require 'vendor/autoload.php';

use Elastic\Elasticsearch\Helper\Iterators\SearchResponseIterator;
use Elastic\Elasticsearch\Helper\Iterators\SearchHitIterator;


$client = Elastic\Elasticsearch\ClientBuilder::create()
    ->setHosts(['http://localhost:9222'])
    ->build();



    // 1. Search lập qua từng trang
    // $search_params = [
    //     'scroll'      => '5m', // period to retain the search context
    //     'index'       => 'product', // here the index name
    //     'size'        => 10, // 100 results per page
    //     'body'        => [
    //         'query' => [
    //             'match_all' => new StdClass // {} in JSON
    //         ]
    //     ]
    // ];
    // // $client is Elasticsearch\Client instance
    // $pages = new SearchResponseIterator($client, $search_params);

    // // Sample usage of iterating over page results
    // foreach ($pages as $page) {
    //     // do something with hit e.g. copy its data to another index
    //     // e.g. prints the number of document per page (100)
    //     echo count($page['hits']['hits']), PHP_EOL;

    //     echo '<pre>';
    //     print_r($page);
    //     echo '</pre>';
    // }
    //-----------------------------------------------------------------

    // 2. Search hit iterator
    $search_params = [
        'scroll'      => '5m', // period to retain the search context
        'index'       => 'product', // here the index name
        'size'        => 100, // 100 results per page
        'body'        => [
            'query' => [
                'match_all' => new StdClass // {} in JSON
            ]
        ]
    ];
    // $client is Elasticsearch\Client instance
    $pages = new SearchResponseIterator($client, $search_params);
    $hits = new SearchHitIterator($pages);

    // Sample usage of iterating over hits
    foreach($hits as $hit) {
        // do something with hit e.g. write to CSV, update a database, etc
        // e.g. prints the document id
        echo $hit['_id'], PHP_EOL;
        echo '<pre>';
        print_r($hit);
        echo '</pre>';
    }
