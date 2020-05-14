<?php
include 'config.php';
include 'header.php';
?>


  
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300" id="home-section">
  

  <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>




  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    


  
<script type="text/javascript">
$(document).ready(function () {

    //https://www.nivas.hr/blog/2016/10/29/proper-way-include-facebook-sdk-javascript-jquery/

    $.ajaxSetup({
        cache: true
    });
    $.getScript('https://connect.facebook.net/en_US/sdk.js', function () {
        FB.init({
            appId:  <?php echo $appid; ?> ,
            xfbml : true,
            version : 'v6.0'
        });
 
        });
    });

    function statusChangeCallback(response) {
        console.log(response);
        if (response.status === 'connected') {
            var accessToken = response.authResponse.accessToken;
            var uid = response.authResponse.userID;
            
            $.ajax({

                url: 'fb_login.php',
                type: 'POST',
                data: {
                    accessToken: response.authResponse.accessToken,
                    uid: response.authResponse.userID
                },
                success: function (result) {

                    console.log("Created accesstoken succesfully " + result);
                    window.location.href = 'home.php';

                },
                error: function (result) {
                    console.log('Connected error');
                    console.log(result);
                }

            });

        } else if (response.status === 'not_authorized') {
            console.log("logged into face book but not the app");
        }

    }
   
    function checkLoginState() { // Called when a person is finished with the Login Button.
        FB.getLoginStatus(function (response) { // See the onlogin handler
            statusChangeCallback(response);
        });
    }



</script>
    <section class="site-blocks-cover overflow-hidden bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-5 mr-auto align-self-center text-center text-md-left">
            <div class="intro-text">
              <h1>THE SOCIAL MEDIA FOR DOGS</h1>
              <p class="mb-4">Log into your Facebook account to get started!</p>
              
			  <div onlogin='checkLoginState()' class="fb-login-button"
		data-size="large" data-button-type="continue_with"
		data-layout="rounded" data-auto-logout-link="false"
		data-use-continue-as="true" data-width=""></div>
	
            </div>
          </div>
          <div class="col-md-5 align-self-center text-center text-md-right">
            <img src="images/dog_1.jpg" alt="Image" class="img-fluid cover-img">
            <img src="images/dog_2.jpg" alt="Image" class="img-fluid cover-img2">
          </div>
        </div>
      </div>
    </section> 


  </div> <!-- .site-wrap -->



  
  </body>

<?php include 'footer.php'; ?>
