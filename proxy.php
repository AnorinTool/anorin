<?php

header('Content-Type: application/json; charset=utf-8');

$mode = isset($_GET['mode']) ? (int)$_GET['mode'] : 1;

if ($mode < 1 || $mode > 13) {
    $mode = 1;
}

$base = "https://5g142.wiremockapi.cloud/menu/";
$url = $base . $mode;

// cURL
$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 10,
]);

$response = curl_exec($ch);
curl_close($ch);

/*
  CHỈ TRẢ DATA, KHÔNG DEBUG, KHÔNG URL, KHÔNG BASE
*/
$data = json_decode($response, true);

if ($data === null) {
    echo json_encode([
        "status" => "error"
    ]);
    exit;
}

echo json_encode([
    "status" => "success",
    "mode" => $mode,
    "data" => $data
]);
