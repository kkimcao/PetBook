<?php
$path = $_SERVER['DOCUMENT_ROOT'];

include('header.php');
include('config.php');

require_once __DIR__ .'/vendor/autoload.php';
use Google\Cloud\Datastore\DatastoreClient;
use Google\Cloud\Storage\StorageClient;
use google\appengine\api\cloud_storage\CloudStorageTools;

function upload_object($bucketName, $objectName, $source)
{
    $storage = new StorageClient();
    $file = fopen($source, 'r');
    $bucket = $storage->bucket($bucketName);
    $object = $bucket->upload($file, [
        'name' => $objectName
    ]);
    printf('Uploaded %s to gs://%s/%s' . PHP_EOL, basename($source), $bucketName, $objectName);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
//https://www.w3schools.com/php/php_file_upload.asp
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    
	  $datastore = new DatastoreClient([
        'projectId' => $projectId
    ]);

    $key = $datastore->key('dog');

    $task = $datastore->entity($key, [
        'dogname' => $_POST['dogname'],
        'birthdate' => $_POST['birthdate'],
        'breed' => $_POST['breed'],
        'owner' => $_SESSION['user_name'],
        'colour' => $_POST['colour'],
		'profilepic'=> $_FILES["fileToUpload"]["name"]
    ]);
    $_SESSION['dogname'] = $_POST['dogname'];
    $datastore->insert($task);
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		upload_object("petbookbucket", $_FILES["fileToUpload"]["name"], $target_file);
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
    header("location: index.php");
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}
  
	
	
}
if (!isset($_SESSION['access_token'])) {
    echo'<div class="w3-container" style="max-width: 1400px; margin-top: 80px">
	<div class="w3-panel w3-red w3-margin-top">
		<h3>Error</h3>
		<p>
			You need to be logged into facebook first.<a href=\'/index.php\'> Go
				back </a>
		</p>
	</div>
</div>';
    
}
?>

<div class="w3-container" style="max-width: 1400px; margin-top: 10px">
<form action="" style="margin-top:90px"method="post" enctype="multipart/form-data">
	<label>Dog name: </label><input type="text" name="dogname" class="box" /><br />
	<br> <label>Birthdate: </label><input type="text" name="birthdate"
		class="box" /><br /> <br> <label>Breed: </label><input type="text"
		name="breed" class="box" /><br /> <br> 
		<br /> <br> <label>Colour: </label><input
		type="text" name="colour" class="box" /><br /> <br> 
				Select dog profile picture:
		<input type="file" name="fileToUpload" id="fileToUpload">
	
		<input
		type="submit" name="submit" value=" Submit " /><br />
</form>
</div>
	<?php include 'footer.php'; ?>