<?php

require 'vendor/autoload.php';
$client = Elastic\Elasticsearch\ClientBuilder::create()
    ->setHosts(['http://localhost:9222'])
    ->build();

try {
    $response = $client->info();


    // 1. Thêm điều kiện/ Additional parameters
    // $params = [
    //     'index'     => 'my_index',
    //     'id'        => 'my_id',
    //     'routing'   => 'company_xyz',
    //     'timestamp' => strtotime("-1d"),
    //     'body'      => [ 'testField' => 'abc']
    // ];
    // $response = $client->index($params);
    // echo '<pre>';
    // print_r($response->asArray());
    // echo '</pre>';
    //-----------------------------------------------------------------

    //2. Bulk indexing with PHP arrays
    // for($i = 0; $i < 100; $i++) {
    //     $params['body'][] = [
    //         'index' => [
    //             '_index' => 'my_index',
    //         ]
    //     ];
    
    //     $params['body'][] = [
    //         'my_field'     => 'my_value',
    //         'second_field' => 'some more values'
    //     ];
    // }
    // $responses = $client->bulk($params);
    //-----------------------------------------------------------------


} catch (NoNodesAvailableException $e) {
    printf ("NoNodesAvailableException: %s\n", $e->getMessage());
}
