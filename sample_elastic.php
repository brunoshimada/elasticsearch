<?php
    require 'vendor/autoload.php';
    use Elasticsearch\ClientBuilder;

    $logger  = ClientBuilder::defaultLogger('logs/elasticlog.log');
    $client = ClientBuilder::create()->setLogger($logger)->build();
    //chama serviço de cnpj
    $curl_a = curl_init();
    curl_setopt_array($curl_a, array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_URL => "https://www.receitaws.com.br/v1/cnpj/27865757000102"
        ));
    $response_a = curl_exec($curl_a);
    $err_a = curl_error($curl_a);
    curl_close($curl_a);
    // $j = json_encode($response_a);
    $jsonPOST = json_decode($response_a,true);
    // print_r($jsonPOST);
    // print_r($jsonPOST);
    if ($err_a) {
        print_r("Error: $err_a\n");
    }
    //inserir
    $params = [
        'index' => "tests",
        'type' => "samples",
        'id' => '2',
        'body' => $jsonPOST
    ];

    $response = $client->index($params);
    // $curl_b = curl_init();
    // curl_setopt_array($curl_b, array(
    //     CURLOPT_URL => 'localhost:9200/tests/samples',
    //     CURLOPT_HEADER => array (
    //         "Content-Type" => "application/json"
    //     ),
    //     CURLOPT_CUSTOMREQUEST => "POST",
    //     CURLOPT_POSTFIELDS => $jsonPOST));
    // $response_b = curl_exec($curl_b);
    // $err_b = curl_error($curl_b);
    // curl_close($curl_b);
    // if ($err_b) {
    //     print_r("ERROR: $err_b\n");
    // }
