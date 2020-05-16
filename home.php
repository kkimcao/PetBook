<?php
include 'header.php';
require_once __DIR__ . '/vendor/autoload.php';
?>

<section class="site-section">
	<div class="container">
		<div class="row">
			<div class="col-md-4 sidebar">

				<script>
			    $(document).ready(function () {
			        $.ajaxSetup({
			            cache: true
			        });
			        $.getScript('https://connect.facebook.net/en_US/sdk.js', function () {
			            FB.init({
			                appId:  '<?php echo $appid;?>' ,
			                xfbml : true,
			                version : 'v6.0'
			            });
			         

			        });
				
						
			    });

				function logout() {
				   FB.getLoginStatus(function (response) {
		                console.log("User response status is " + response.status);
		                if (response.status === 'connected') {

		                    var uid = response.authResponse.userID;
		                    var accessToken = response.authResponse.accessToken;
		                    console.log("Logging out");
		                    FB.api('/' + uid + '/permissions', 'delete', function (response) {});
		                    window.location.href = 'index.php';
		                 
		                    console.log("Session destroyed");
		                } else if (response.status === 'not_authorized') {
		                    console.log("Logged into facebook but not authorised");
		                } else {
		                    console.log("User isnt logged into facebook");
		                }
		            });
					}
		    //https://www.nivas.hr/blog/2016/10/29/proper-way-include-facebook-sdk-javascript-jquery/
		    
		    </script>
		 	<?php
    // grab dog profile

    use Google\Cloud\Datastore\DatastoreClient;
    use google\appengine\api\cloud_storage\CloudStorageTools;

    if (isset($_SESSION['user_name'])) {
        $_SESSION['dogname'] = '';
        $_SESSION['profilepic'] = '';
        $bucket = 'petbookbucket';
        $root_path = 'gs://' . $bucket . '/';

        $hasdog = false;
        $datastore = new DatastoreClient([
            'projectId' => $projectId
        ]);

        $query = $datastore->query()
            ->kind('dog')
            ->filter('owner', '=', $_SESSION['user_name']);
        $result = $datastore->runQuery($query);
        foreach ($result as $entity) {
            $hasdog = true;
            $name = $entity['profilepic'];
            $original = $root_path . $name;
            $_SESSION['profilepic'] = CloudStorageTools::getImageServingUrl($original);
            $_SESSION['dogname'] = $entity['dogname'];
            // $_SESSION['profilepic'] = $entity['profilepic'];
            // echo "dog name:" . $entity['dogname'] . " colour " . $entity['colour'];

            echo "<div class=\"sidebar-box\">
              <img src=\" " . $_SESSION['profilepic'] . "\" alt=\"Image placeholder\" class=\"img-fluid mb-4\">
              <h3>" . $entity['dogname'] . "</h3>
              <p>DOB: " . $entity['birthdate'] . "</p>
			  <p>Gender: " . $entity['gender'] . "</p>
              <p>Breed: " . $entity['breed'] . "</p>
              <p>Location: " . $entity['location'] . "</p>

              <p><a onclick=\"logout();\" href=\"#\" class=\"btn btn-primary btn-sm\">Sign out</a></p>
            </div>";
        }
        if (! $hasdog) {
            echo "<script>window.location.href = 'register.php';</script>";
        }
    }
    ?>
			

				<div class="sidebar-box">
					<div class="categories">
						<h3>My profile</h3>
						<li><a href="#">Friends <span>(12)</span></a></li>
						<li><a href="#">Photos<span>(22)</span></a></li>
						<li><a href="#">Events<span>(42)</span></a></li>
					</div>
				</div>



				<div class="sidebar-box">
					<h3>Nearby Dog Parks</h3>
					<div class="maparea">
						<iframe
							src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8598355237996!2d144.99850985164912!3d-37.81675194188948!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642f7448d1f65%3A0xf04567605318770!2sCitizens%20Park!5e0!3m2!1sen!2sau!4v1589472852667!5m2!1sen!2sau"
							width="300" height="300" frameborder="0" style="border: 0;"
							allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
					</div>
				</div>
			</div>

			<div class="col-md-8 blog-content">


				<main>
					<section>
						<div class="container">
							<div class="row">
								<div class="card" style="width: 730px;">
									<h5 class="card-header">Dashboard</h5>


									<div class="card-body">
										<form action="post.php" method="post"
											enctype="multipart/form-data">
											<div class="form-group">
												<label for="wallInput" class="sr-only"
													placeholder="Write something">Write something</label>
												<textarea name="status" class="form-control" id="wallInput"
													rows="2" placeholder="Write something.."></textarea>
											</div>
											<button name="submit" type="submit" class="btn btn-dark">Post</button>
										</form>

									</div>
								</div>
								<div class="card post" style="width: 730px;">
								<?php
        // Post statuses to datastore and retreive them
        use Google\Cloud\Datastore\Query\Query;
        $query = $datastore->query()
            ->kind('post')
            ->order('date', Query::ORDER_DESCENDING);
        $result = $datastore->runQuery($query);
        foreach ($result as $entity) {

            echo "	<div class=\"card-body\">
										<div class=\"row\">
											<div class=\"col-sm-2\">
												<a href=\"#\" class=\"post-avatar\"><img class=\"img-thumbnail\"
													src=\"" . $_SESSION['profilepic'] . "\"
													alt=\"profile pic\">
													<p class=\"username text-center\">" . $entity['dogname'] . "</p> </a>
											</div>
											<div class=\"col-sm-10\">
												<div class=\"bubble\">
													<div class=\"pointer\">
														<p>" . $entity['status'] . "</p>
													</div>
													<div class=\"pointer-border\"></div>
												</div>
												<!--end bubble-->

												<div class=\"comment-form\">
													<form class=\"form-inline\">
														<div class=\"form-group mb-2\">
															<label for=\"commentInput\" class=\"sr-only\">Comment</label>
															<input type=\"text\" readonly
																class=\"form-control-plaintext\" id=\"commentInput\"
																placeholder=\"Reply\">
														</div>
														<button type=\"submit\" class=\"btn btn-dark mb-2\">Comment</button>
													</form>
												</div>
											</div>
										</div>
									</div>";
        }
        ?>
									
									 <!-- <div class="comments">
										<div class="card comment offset-sm-1">
											<div class="card-body">
												<div class="row">
													<div class="col-sm-2">
														<a href="#" class="post-avatar"><img class="img-thumbnail"
															src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/Sea_otter_cropped.jpg/200px-Sea_otter_cropped.jpg"
															alt="sea otter">
															<p class="username text-center">Golden</p> </a>
													</div>
													<div class="col-sm-10">
														<div class="bubble">
															<div class="pointer">
																<p>Me too.</p>
															</div>
															<div class="pointer-border"></div>
														</div> -->
									<!--end bubble-->

									<!-- <div class="comment-form">
															<form class="form-inline">
																<div class="form-group mb-2">
																	<label for="commentInput" class="sr-only">Comment</label>
																	<input type="text" readonly
																		class="form-control-plaintext" id="commentInput"
																		placeholder="Reply">
																</div>
																<button type="submit" class="btn btn-dark mb-2">Comment</button>
															</form>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!--end of comment-->

									<!--</div> -->

								</div>
								<!--end of post-->


								<!--end of col-->




							</div>

						</div>
			
			</div>

</section>



<?php include 'footer.php'; ?>