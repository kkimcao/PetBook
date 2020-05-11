<?php
include 'header.php';
require_once __DIR__ . '/vendor/autoload.php';

if (! isset($_SESSION['access_token'])) {
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

?>
<span onclick="this.parentElement.style.display='none'"
	class="w3-button w3-display-topright">&times;</span>
";
<div class="w3-container" style="max-width: 1400px; margin-top: 80px"></div>
<!-- Page Container -->
<div class="w3-container w3-content"
	style="max-width: 1400px; margin-top: 80px">
	<!-- The Grid -->
	<div class="w3-row">
		<!-- Left Column -->
		<div class="w3-col m3">
			<!-- Profile -->
			<?php
use Google\Cloud\Datastore\DatastoreClient;

// grab dog profile
if (isset($_SESSION['user_name'])) {
    $_SESSION['dogname'] = '';
    $datastore = new DatastoreClient([
        'projectId' => $projectId
    ]);

    $query = $datastore->query()
        ->kind('dog')
        ->filter('owner', '=', $_SESSION['user_name']);
    $result = $datastore->runQuery($query);
    foreach ($result as $entity) {
        $_SESSION['dogname'] = $entity['dogname'];
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
			<br>

			<!-- Accordion -->
			<div class="w3-card w3-round">
				<div class="w3-white">
					<button onclick="myFunction('Demo1')"
						class="w3-button w3-block w3-theme-l1 w3-left-align">
						<i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My
						Groups
					</button>
					<div id="Demo1" class="w3-hide w3-container">
						<p>Some text..</p>
					</div>
					<button onclick="myFunction('Demo2')"
						class="w3-button w3-block w3-theme-l1 w3-left-align">
						<i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> My
						Events
					</button>
					<div id="Demo2" class="w3-hide w3-container">
						<p>Some other text..</p>
					</div>
					<button onclick="myFunction('Demo3')"
						class="w3-button w3-block w3-theme-l1 w3-left-align">
						<i class="fa fa-users fa-fw w3-margin-right"></i> My Photos
					</button>
					<div id="Demo3" class="w3-hide w3-container">
						<div class="w3-row-padding">
							<br>
							<div class="w3-half"></div>
						</div>
					</div>
				</div>
			</div>
			<br>

			<!-- Interests -->
			<div class="w3-card w3-round w3-white w3-hide-small">
				<div class="w3-container">
					<p>Interests</p>
					<p>
						<span class="w3-tag w3-small w3-theme-d5">News</span> <span
							class="w3-tag w3-small w3-theme-d4">W3Schools</span> <span
							class="w3-tag w3-small w3-theme-d3">Labels</span> <span
							class="w3-tag w3-small w3-theme-d2">Games</span> <span
							class="w3-tag w3-small w3-theme-d1">Friends</span> <span
							class="w3-tag w3-small w3-theme">Games</span> <span
							class="w3-tag w3-small w3-theme-l1">Friends</span> <span
							class="w3-tag w3-small w3-theme-l2">Food</span> <span
							class="w3-tag w3-small w3-theme-l3">Design</span> <span
							class="w3-tag w3-small w3-theme-l4">Art</span> <span
							class="w3-tag w3-small w3-theme-l5">Photos</span>
					</p>
				</div>
			</div>
			<br>

			<!-- Alert Box -->
			<div
				class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
				<span onclick="this.parentElement.style.display='none'"
					class="w3-button w3-theme-l3 w3-display-topright"> <i
					class="fa fa-remove"></i>
				</span>
				<p>
					<strong>Hey!</strong>
				</p>
				<p>People are looking at your profile. Find out who.</p>
			</div>

			<!-- End Left Column -->
		</div>

		<!-- Middle Column -->
		<div class="w3-col m7">

			<div class="w3-row-padding">
				<div class="w3-col m12">
					<div class="w3-card w3-round w3-white">
						<div class="w3-container w3-padding">
							<h6 class="w3-opacity">Social Media template by w3.css</h6>
							<form action="post.php" method="post"
								enctype="multipart/form-data">
								<input type="text" name="status" class="w3-border w3-padding"
									placeholder="Enter status" /> <br> <input
									class="w3-button w3-theme" type="submit" name="submit"
									value="Post" />

							</form>

							</button>

						</div>
					</div>
				</div>
			</div>
<?php
//Post statuses to datastore and retreive them
use Google\Cloud\Datastore\Query\Query;
$query = $datastore->query()->kind('post')
->order('date', Query::ORDER_DESCENDING);
$result = $datastore->runQuery($query);
foreach ($result as $entity) {
    echo "<div class=\"w3-container w3-card w3-white w3-round w3-margin\">
				<br> <span class=\"w3-right w3-opacity\">1 min</span>
				<h4>".$entity['dogname']."</h4>
				<br>
				<hr class=\"w3-clear\">
				<p>".$entity['status']."</p>
				<div class=\"w3-row-padding\" style=\"margin: 0 -16px\">
					<div class=\"w3-half\"></div>
					<div class=\"w3-half\"></div>
				</div>
				<button type=\"button\" class=\"w3-button w3-theme-d1 w3-margin-bottom\">
					<i class=\"fa fa-thumbs-up\"></i>  Like
				</button>
				<button type=\"button\" class=\"w3-button w3-theme-d2 w3-margin-bottom\">
					<i class=\"fa fa-comment\"></i>  Comment
				</button>
			</div>";
}
?>
			<!-- End Middle Column -->
		</div>

		<!-- Right Column -->
		<div class="w3-col m2">
			<div class="w3-card w3-round w3-white w3-center">
				<div class="w3-container">
					<p>Upcoming Events:</p>

					<p>
						<strong>Holiday</strong>
					</p>
					<p>Friday 15:00</p>
					<p>
						<button class="w3-button w3-block w3-theme-l4">Info</button>
					</p>
				</div>
			</div>
			<br>

			<div class="w3-card w3-round w3-white w3-center">
				<div class="w3-container">
					<p>Friend Request</p>
					<br> <span>Jane Doe</span>
					<div class="w3-row w3-opacity">
						<div class="w3-half">
							<button class="w3-button w3-block w3-green w3-section"
								title="Accept">
								<i class="fa fa-check"></i>
							</button>
						</div>
						<div class="w3-half">
							<button class="w3-button w3-block w3-red w3-section"
								title="Decline">
								<i class="fa fa-remove"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
			<br>





			<!-- End Right Column -->
		</div>

		<!-- End Grid -->
	</div>

	<!-- End Page Container -->
</div>
<br>



<?php include 'footer.php'; ?>