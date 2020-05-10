<?php
include 'header.php';
require_once __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Datastore\DatastoreClient;
?>

<div class="w3-container" style="max-width: 1400px; margin-top: 80px"></div>
<!-- Page Container -->
<div class="w3-container w3-content"
	style="max-width: 1400px; margin-top: 80px">
	<!-- The Grid -->
	<div class="w3-row">
		<!-- Left Column -->
		<div class="w3-col m3">

<?php

if (! isset($_SESSION['user_name'])) {
    echo '<div class="w3-container" style="max-width: 1400px; margin-top: 80px">
	<div class="w3-panel w3-red w3-margin-top">
		<h3>Error</h3>
		<p>
			You need to be logged into facebook first.<a href=\'/index.php\'> Go
				back </a>
		</p>
	</div>
</div>';
}
//grab dog profile
if (isset($_SESSION['user_name'])) {
    $datastore = new DatastoreClient([
        'projectId' => $projectId
    ]);

    $query = $datastore->query()
        ->kind('dog')
        ->filter('owner', '=', $_SESSION['user_name']);
    $result = $datastore->runQuery($query);
    foreach ($result as $entity) {
        // echo "dog name:" . $entity['dogname'] . " colour " . $entity['colour'];

        echo "<div class=\"w3-card w3-round w3-white\">
				<div class=\"w3-container\">
					<h4 id=name class=\"w3-center\">" . $entity['dogname'] . "</h4>

					<p class=\"w3-center\">
						
					</p>
                 
					<hr>
					<p>
						Breed: " . $entity['breed'] . "
						
					</p>
                    <p>
						Colour: " . $entity['colour'] . "
						
					</p>
					<p>
						Birthday: " . $entity['birthday'] . "
						
					</p>
					<p>
						<i class=\"fa fa-home fa-fw w3-margin-right w3-text-theme\"></i>
						London, UK
					</p>
					
				</div>
			</div><br>";
    }
}
?>
					


			<!-- End Page Container -->
		</div>
		<br>
	</div>
</div>


<?php include 'footer.php'; ?>