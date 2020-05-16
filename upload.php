<?php
include ('config.php');
if (! isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Datastore\DatastoreClient;
use Google\Cloud\Storage\StorageClient;
use google\appengine\api\cloud_storage\CloudStorageTools;


$bucket = 'petbookbucket';
$root_path = 'gs://' . $bucket . '/';


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $name = $_FILES['image']['name'];
    $original = $root_path . $name;

    if (isset($_POST["submit"])) {
        move_uploaded_file($_FILES["image"]["tmp_name"], $original);

        $datastore = new DatastoreClient([
            'projectId' => $projectId
        ]);

        $key = $datastore->key('dog');

        $task = $datastore->entity($key, [
            'dogname' => $_POST['dogname'],
            'birthdate' => $_POST['birthdate'],
            'breed' => $_POST['breed'],
            'owner' => $_SESSION['user_name'],
            'location' => $_POST['location'],
            'gender' => $_POST['gender'],
            'profilepic' => $_FILES["image"]["name"]
        ]);
        $_SESSION['dogname'] = $_POST['dogname'];
        $datastore->insert($task);
        $_SESSION['profilepic'] = CloudStorageTools::getImageServingUrl($original);
        echo "<script>window.location = 'https://petbook-2020.appspot.com/home.php';</script>";
    }
}
?>