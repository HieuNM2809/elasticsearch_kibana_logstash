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
    
    // Delete doc at /my_index/_doc_/my_id
    $response = $client->delete($params);


} catch (NoNodesAvailableException $e) {
    printf ("NoNodesAvailableException: %s\n", $e->getMessage());
}
