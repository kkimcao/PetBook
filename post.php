<?php
//create a post to datastore
include ('config.php');
session_start();
require_once __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Datastore\DatastoreClient;
if (isset($_POST["submit"])) {
    if (isset($_SESSION['dogname'])) {

        $datastore = new DatastoreClient([
            'projectId' => $projectId
        ]);
        $key = $datastore->key('post');
        $time = date(DATE_RFC3339);
        $task = $datastore->entity($key, [
            'status' => $_POST['status'],
            'dogname' => $_SESSION['dogname'],
			'profilepic' => $_SESSION['profilepic'],
            'date' => $time
        ]);
        $datastore->insert($task);
    } else {
        echo 'Please register a dog first';
    }
    echo "<script>window.location.href = 'home.php'</script>";
}
?>