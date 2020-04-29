<?php
echo 'Welcome to PetBook';
?>
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '529847264357591',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v6.0'
    });
  };
</script>
<script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>
<script>



  FB.api('/me', function(response) {
                alert("Name: "+ response.name);
            });

</script>

