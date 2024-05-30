<?php

    require 'vendor/autoload.php';
    $client = Elastic\Elasticsearch\ClientBuilder::create()
        ->setHosts(['http://localhost:9222'])
        ->build();

    try {
        $response = $client->info();

//        //1. Lấy trạng thái/ Get status
//        echo $response->getStatusCode(); // 200
//-----------------------------------------------------------------

//        //2. Lấy thông tin server/ Get info json
//        echo '<pre>';
//        echo (string) $response->getBody(); // Response body in JSON
//        echo '</pre>';
//-----------------------------------------------------------------


//        //3. Tạo index/ Indexing a document
//        $params = [
//            'index' => 'my_index',
//            'id'    => 'my_id',
//            'body'  => ['testField' => 'abc']
//        ];
//
//        $response = $client->index($params);
//        echo '<pre>';
//        print_r($response->asArray());
//        echo '</pre>';
//-----------------------------------------------------------------


//        //4.Gán body là JSON string/ Set the body as JSON string
//        $params = [
//            'index' => 'my_index',
//            'id'    => '1',
//            'body'  => '{"testField" : "abc"}'
//        ];
//
//        $response = $client->index($params);
//        echo '<pre>';
//        print_r($response->asArray());
//        echo '</pre>';
//-----------------------------------------------------------------


//        //5. Lấy một phần tử/ Get document
//        $params = [
//            'index' => 'my_index',
//            'id'    => 'my_id'
//        ];
//
//        $response = $client->get($params);
//        echo '<pre>';
//        print_r($response->asArray());
//        echo '</pre>';
//-----------------------------------------------------------------


//        //6. Tìm kiếm/ search
//        $params = [
//            'index' => 'my_index',
//            'body'  => [
//                'query' => [
//                    'match' => [
//                        'testField' => 'abc'
//                    ]
//                ]
//            ]
//        ];
//
//        $response = $client->search($params);
//        echo '<pre>';
//        print_r($response->asArray());
//        echo '</pre>';
//-----------------------------------------------------------------


//        //7. Xoá document/ delete document
//        $params = [
//            'index' => 'my_index',
//            'id'    => 'my_id'
//        ];
//
//        $response = $client->delete($params);
//        print_r($response->asArray());
//-----------------------------------------------------------------


//        //8. Xoá index/ delete index
//        $deleteParams = [
//            'index' => 'my_index'
//        ];
//        $response = $client->indices()->delete($deleteParams);
//        print_r($response->asArray());
//-----------------------------------------------------------------


//        //9. Tạo index/ Creating an index
//        $params = [
//            'index' => 'my_index',
//            'body' => [
//                'settings' => [
//                    'number_of_shards' => 2,
//                    'number_of_replicas' => 0
//                ]
//            ]
//        ];
//
//        $response = $client->indices()->create($params);
//        print_r($response->asArray());
//-----------------------------------------------------------------









    } catch (NoNodesAvailableException $e) {
        printf ("NoNodesAvailableException: %s\n", $e->getMessage());
    }
