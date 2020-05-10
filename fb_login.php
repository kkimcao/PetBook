<?php
// https://www.webslesson.info/2019/10/how-to-implement-login-using-facebook-account-in-php.html
session_start();
include 'config.php';
require_once __DIR__ . '/vendor/facebook/graph-sdk/src/Facebook/autoload.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fb = new Facebook\Facebook([

        'app_id' => $appid,
        'app_secret' => $appsecret,
        'default_graph_version' => 'v6.0'
    ]);

    $_SESSION['user_name'] = '';
    $_SESSION['user_email_address'] = '';
    $_SESSION['user_image'] = '';

    echo "received accesstoken from " . $_POST['accessToken'];
    try {
        $accessToken = $_POST['accessToken'];
        $uid = $_POST['uid'];
        $fb->setDefaultAccessToken($_POST['accessToken']);
        $graph_response = $fb->get("/me?fields=name,email", $access_token);
        $facebook_user_info = $graph_response->getGraphUser();
        if (! empty($facebook_user_info['id'])) {
            $_SESSION['user_image'] = 'https://graph.facebook.com/' . $facebook_user_info['id'] . '/picture';
        }

        if (! empty($facebook_user_info['name'])) {
            $_SESSION['user_name'] = $facebook_user_info['name'];
        }

        if (! empty($facebook_user_info['email'])) {
            $_SESSION['user_email_address'] = $facebook_user_info['email'];
        }
    } catch (Facebook\Exception\ResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit();
    } catch (Facebook\Exception\SDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit();
    }
    if (! isset($accessToken)) {
        echo 'No cookie set or no OAuth data could be obtained from cookie.';
        exit();
    }
    $_SESSION['hometown']='';
    if (! empty($facebook_user_info['hometown'])) {
        $_SESSION['hometown'] = $facebook_user_info['hometown'];
    }
    $_SESSION['access_token'] = (string) $accessToken;
    $_SESSION['uid'] = $uid;
    echo ("<script>console.log('User id is: " . $_POST['uid'] . "');</script>");
} else {}
?>