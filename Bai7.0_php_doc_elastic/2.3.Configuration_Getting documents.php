<?php

require 'vendor/autoload.php';
$client = Elastic\Elasticsearch\ClientBuilder::create()
    ->setHosts(['http://localhost:9222'])
    ->build();

try {
    $response = $client->info();

    $params = [
        'index' => 'my_index',
        'id'    => 'my_id'
    ];
    
    // Get doc at /my_index/_doc/my_id
    $response = $client->get($params);
    echo '<pre>';
    print_r($response->asArray());
    echo '</pre>';


} catch (NoNodesAvailableException $e) {
    printf ("NoNodesAvailableException: %s\n", $e->getMessage());
}
