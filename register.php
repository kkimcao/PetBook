<?php
include ('header.php');
include ('config.php');

require_once __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Datastore\DatastoreClient;
use Google\Cloud\Storage\StorageClient;
use google\appengine\api\cloud_storage\CloudStorageTools;

$bucket = 'petbookbucket';
$root_path = 'gs://' . $bucket . '/';

$options = [
    'gs_bucket_name' => $bucket
];
$upload_url = CloudStorageTools::createUploadUrl('/upload.php', $options);

?>

<body data-spy="scroll" data-target=".site-navbar-target"
	data-offset="300" id="home-section">
	<div class="site-wrap">
		<div class="container">
			<form action="<?php echo $upload_url;?>" method="post"
				enctype="multipart/form-data" class="p-5 contact-form">

				<h2 class="h4 mb-5 heading"
					style="text-align: center; padding-top: 50px;">Register your dog</h2>

				<div class="row form-group">
					<div class="col-md-6 mb-3 mb-md-0">
						<label for="name">Name</label> <input type="text" name="dogname"
							class="form-control">
					</div>
					<div class="col-md-6">
						<label for="gender">Gender</label> <input type="text"
							name="gender" class="form-control">
					</div>
				</div>

				<div class="row form-group">

					<div class="col-md-12">
						<label for="dob">Date Of Birth</label> <input type="dob"
							name="birthdate" class="form-control">
					</div>
				</div>

				<div class="row form-group">

					<div class="col-md-12">
						<label for="breed">Breed</label> <input type="breed" name="breed"
							id="breed" class="form-control">
					</div>
				</div>

				<div class="row form-group">

					<div class="col-md-12">
						<label for="location">Location</label> <input type="location"
							name="location" id="location" class="form-control">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-12">
						<label for="message">Upload a picture of your dog:</label> <br />
						<input type="file" name="image">  
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-12" style="padding-top: 20px;">
						<input name="submit" type="submit" value="Register"
							class="btn btn-dark btn-md text-white">
					</div>
				</div>
			</form>

		</div>
	</div>
</body>

<?php include 'footer.php'; ?>