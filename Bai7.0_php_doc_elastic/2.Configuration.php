<?php

require 'vendor/autoload.php';
$client = Elastic\Elasticsearch\ClientBuilder::create()
    ->setHosts(['http://localhost:9222'])
    ->build();

try {
    $response = $client->info();

//    //1.0. Tạo index/ Create index
//    $params = [
//        'index' => 'my_index2'
//    ];
//    $response = $client->indices()->create($params);
//    echo '<pre>';
//    print_r($response->asArray());
//    echo '</pre>';
//-----------------------------------------------------------------

//    //1.1. Tạo index/ Create index
//    $params = [
//        'index' => 'my_index3',
//        'body' => [
//            'settings' => [
//                'number_of_shards' => 3,
//                'number_of_replicas' => 2
//            ],
//            'mappings' => [
//                '_source' => [
//                    'enabled' => true
//                ],
//                'properties' => [
//                    'first_name' => [
//                        'type' => 'keyword'
//                    ],
//                    'age' => [
//                        'type' => 'integer'
//                    ]
//                ]
//            ]
//        ]
//    ];
//    $response = $client->indices()->create($params);
//    echo '<pre>';
//    print_r($response->asArray());
//    echo '</pre>';
//-----------------------------------------------------------------


//    //1.3. Tạo index/ Create index
//    $params = [
//        'index' => 'my_index4',
//        'body' => [
//            'settings' => [
//                'number_of_shards' => 1,
//                'number_of_replicas' => 0,
//                'analysis' => [
//                    'filter' => [
//                        'shingle' => [
//                            'type' => 'shingle'
//                        ]
//                    ],
//                    'char_filter' => [
//                        'pre_negs' => [
//                            'type' => 'pattern_replace',
//                            'pattern' => '(\\w+)\\s+((?i:never|no|nothing|nowhere|noone|none|not|havent|hasnt|hadnt|cant|couldnt|shouldnt|wont|wouldnt|dont|doesnt|didnt|isnt|arent|aint))\\b',
//                            'replacement' => '~$1 $2'
//                        ],
//                        'post_negs' => [
//                            'type' => 'pattern_replace',
//                            'pattern' => '\\b((?i:never|no|nothing|nowhere|noone|none|not|havent|hasnt|hadnt|cant|couldnt|shouldnt|wont|wouldnt|dont|doesnt|didnt|isnt|arent|aint))\\s+(\\w+)',
//                            'replacement' => '$1 ~$2'
//                        ]
//                    ],
//                    'analyzer' => [
//                        'reuters' => [
//                            'type' => 'custom',
//                            'tokenizer' => 'standard',
//                            'filter' => ['lowercase', 'stop', 'kstem']
//                        ]
//                    ]
//                ]
//            ],
//            'mappings' => [
//                'properties' => [
//                    'title' => [
//                        'type' => 'text',
//                        'analyzer' => 'reuters',
//                        'copy_to' => 'combined'
//                    ],
//                    'body' => [
//                        'type' => 'text',
//                        'analyzer' => 'reuters',
//                        'copy_to' => 'combined'
//                    ],
//                    'combined' => [
//                        'type' => 'text',
//                        'analyzer' => 'reuters'
//                    ],
//                    'topics' => [
//                        'type' => 'keyword'
//                    ],
//                    'places' => [
//                        'type' => 'keyword'
//                    ]
//                ]
//            ]
//        ]
//    ];
//    $client->indices()->create($params);
//-----------------------------------------------------------------

//    2. Xoá index/ Delete an index
//    $params = ['index' => 'my_index3'];
//    $response = $client->indices()->delete($params);

//    3. Thêm setting/ PUT Settings API
//    $params = [
//        'index' => 'my_index',
//        'body' => [
//            'settings' => [
//                'number_of_replicas' => 0,
//                'refresh_interval' => -1
//            ]
//        ]
//    ];
//
//    $response = $client->indices()->putSettings($params);



} catch (NoNodesAvailableException $e) {
    printf ("NoNodesAvailableException: %s\n", $e->getMessage());
}
