<?php

    require 'vendor/autoload.php';
    $client = Elastic\Elasticsearch\ClientBuilder::create()
        ->setHosts(['http://localhost:9222'])
        ->build();

try {
    $response = $client->info();

    echo $response->getStatusCode(); // 200
    echo (string) $response->getBody(); // Response body in JSON

    echo '<pre>';
    print_r($response);
    echo '</pre>';

} catch (NoNodesAvailableException $e) {
    printf ("NoNodesAvailableException: %s\n", $e->getMessage());
}
