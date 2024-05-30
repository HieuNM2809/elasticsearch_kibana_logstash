<?php

require 'vendor/autoload.php';
$client = Elastic\Elasticsearch\ClientBuilder::create()
    ->setHosts(['http://localhost:9222'])
    ->build();

try {
    $response = $client->info();

//    //1. Match
//    $params = [
//        'index' => 'articles',
//        'body'  => [
//            'query' => [
//                'match' => [
//                    'title' => 'Introduction'
//                ]
//            ]
//        ]
//    ];
//
//    $response = $client->search($params);
//    echo '<pre>';
//    print_r($response->asArray());
//    echo '</pre>';
//-----------------------------------------------------------------

//    //1.1 Search nhiều
//    $params = [
//        'index' => 'my_index',
//        'body'  => [
//            'query' => [
//                'bool' => [
//                    'must' => [
//                        [ 'match' => [ 'testField' => 'abc' ] ],
//                        [ 'match' => [ 'testField2' => 'xyz' ] ],
//                    ]
//                ]
//            ]
//        ]
//    ];
//
//    $results = $client->search($params);
//-----------------------------------------------------------------

//  //1.2. Nâng cao
//    $params = [
//        'index' => 'my_index',
//        'body'  => [
//            'query' => [
//                'bool' => [
//                    'filter' => [
//                        'term' => [ 'my_field' => 'abc' ]
//                    ],
//                    'should' => [
//                        'match' => [ 'my_other_field' => 'xyz' ]
//                    ]
//                ]
//            ]
//        ]
//    ];
//    $results = $client->search($params);
//-----------------------------------------------------------------

//    2. Scrolling
    $params = [
        'scroll' => '10s',          // how long between scroll requests. should be small!
        'size'   => 2,             // how many results *per shard* you want back
        'index'  => 'bank',
        'body'   => [
            'query' => [
                'match_all' => new \stdClass()
            ]
        ]
    ];

    // Execute the search
    // The response will contain the first batch of documents
    // and a scroll_id
    $response = $client->search($params);

    echo '<pre>';
    print_r($response->asArray());
    echo '</pre>';

    // Now we loop until the scroll "cursors" are exhausted
    while (isset($response['hits']['hits']) && count($response['hits']['hits']) > 0) {

        // **
        // Do your work here, on the $response['hits']['hits'] array
        // **

        // When done, get the new scroll_id
        // You must always refresh your _scroll_id!  It can change sometimes
        $scroll_id = $response['_scroll_id'];

        // Execute a Scroll request and repeat
        $response = $client->scroll([
            'body' => [
                'scroll_id' => $scroll_id,  //...using our previously obtained _scroll_id
                'scroll'    => '10s'        // and the same timeout window
            ]
        ]);

        echo '<pre>';
        print_r($response->asArray());
        echo '</pre>';
    }



} catch (NoNodesAvailableException $e) {
    printf ("NoNodesAvailableException: %s\n", $e->getMessage());
}
