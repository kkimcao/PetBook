<?php
include 'vars.php';

require_once __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Datastore\DatastoreClient;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $datastore = new DatastoreClient([
        'projectId' => $projectId
    ]);

    $key = $datastore->key('dog');

    $task = $datastore->entity($key, [
        'dogname' => $_POST['dogname'],
        'birthdate' => $_POST['birthdate'],
        'breed' => $_POST['breed'],
        'owner' => $_POST['owner'],
        'colour' => $_POST['colour']
    ]);
    $datastore->insert($task);
    header("location: index.php");
}

?>
<form action="" method="post">
	<label>Dog name: </label><input type="text" name="dogname" class="box" /><br />
	<br> <label>Birthdate: </label><input type="text" name="birthdate"
		class="box" /><br /> <br> <label>Breed: </label><input type="text"
		name="breed" class="box" /><br /> <br> <label>Name of owner: </label><input
		type="text" name="owner" class="box" /><br /> <br> <label>Colour: </label><input
		type="text" name="colour" class="box" /><br /> <br> <input
		type="submit" value=" Submit " /><br />
</form>