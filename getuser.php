<?php 
session_start();
include 'config.php';
require_once __DIR__ . '/vendor/facebook/graph-sdk/src/Facebook/autoload.php';
$fb = new Facebook\Facebook([
    'app_id' => $appid,
    'app_secret' => $appsecret,
    'default_graph_version' => 'v6.0',
]);

try {
    // Returns a `Facebook\Response` object
    $response = $fb->get('/me?fields=id,name', $_SESSION['access_token']);
} catch(Facebook\Exception\ResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exception\SDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$user = $response->getGraphUser();

echo $user['name'];
?>