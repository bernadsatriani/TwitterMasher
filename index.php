<?php
error_reporting(0);
session_start();
require 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
define('CONSUMER_KEY', 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');
define('CONSUMER_SECRET', 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');
define('OAUTH_CALLBACK', 'http://127.0.0.1/callback.php');
?>
<!DOCTYPE html>
<html lang="en">
<!--
Hey What's up ? Looking Under the Hood ! Curious much ..Want to know more
Contact: @aaditya_purani
-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="It is a real time twitter wall">
    <meta name="author" content="Aaditya Purani">
    <title>Twitter Masher</title>
    
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/landing-page.css" rel="stylesheet">

    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
    session_start();
    if(!isset($_SESSION['access_token'])){
    ?>
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="">Twitter Masher</a>
            </div>
        </div>
    </nav>
    <a name="about"></a>
    <div class="intro-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Twitter Masher</h1>
                        <h3>Manage your Social Media Presence <br> #TwitterMasher</h3>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                            <li>
                                <a href="http://127.0.0.1/help.php" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Sign-In with Twitter</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.intro-header -->

    <!-- Page Content -->
            </div>
        </div>
        <!-- /.container -->
    </div>
    <?php
    }
    else {
        //logged in
        ?>
        <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="">Twitter Masher</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container" id="tweetboxapp">
        <div class="row">
            <br>
            <div class="col-md-4 user-info">
                <div style="border: 1px solid #ccc; box-shadow: 1px 1px 1px #ccc; margin-bottom: 20px; padding: 20px;">
                <?php
                $access_token = $_SESSION['access_token'];
                $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
                $user = $connection->get("account/verify_credentials");
                ?>
                <br>
                <img class="img-responsive" src="<?php echo $user->profile_image_url; ?>">
                <h3>
                    <?php
                    echo "@".$user->screen_name;
                    ?>
                    <br>
                    <small>
                        <?php
                        echo $user->name;
                        echo "<br>";
                        echo "Status: ".$user->description;
                        ?>
                    </small>
			<small>
                        <?php
			echo "<br>";
                        echo "Followers: ".$user->followers_count;
                        echo "<br>";
                        echo "Following: ".$user->friends_count;
                        ?>
                    </small>
                </h3>
                <div class="row">
						<div class="alert alert-success" id="error-msg" style="display: none;"></div>
						<form class="form-horizontal" method="post" id="status-update-form">
							<div class="form-group">
								<div class="col-sm-8">
									<textarea class="form-control" rows="2" name="status" id="status" placeholder="Write a Tweet"></textarea>
								</div>
								<div class="col-sm-4">
									<button type="submit" class="btn btn-success" style="padding: 13.4px;">Tweet</button>
								</div>
							</div>
						</form>
            </div>

<!-- It starts from here -->
<h3><small>Post Tweets with Image</small></h3>
<div class="row">
						<div class="alert alert-success" id="error-msg" style="display: none;"></div>
						
						<form class="form-horizontal" method="post" id="status-update-form1">

							<div class="form-group">
								<div class="col-sm-8">
									<textarea class="form-control" rows="2" name="status1" id="status1" placeholder="Write a Tweet"></textarea><br>
<textarea class="form-control" rows="1" name="image" id="image" placeholder="Path to Image like /home/dank.jpg"></textarea>
								</div>
								<div class="col-sm-4">
									<button type="submit" class="btn btn-success" style="padding: 13.4px;">Tweet</button>
								</div>
							</div>
						</form>
            </div>

<!-- ends here -->

                <p class="well">
                    The Lord said magic happens once, every minute.
                </p>
            </div>
            Made with &hearts; by Aaditya Purani
            </div>
            
           <div class="col-md-8">
                <div id="tweets">
                </div>
            </div>
        </div>
    </div>
    
    <?php  
    }
    ?>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <script>
        $('#status-update-form').submit(function(e) {
				e.preventDefault();
				var status = $('#status').val();
				if (status == "") {
					$("#error-msg").html('Hey! Please enter something').slideDown();
					setTimeout(function() {
						$("#error-msg").slideUp();
					}, 1000);
				} else {
                    $('#error-msg').addClass('alert-success').html('Tweeting...').slideDown();
					$.ajax({
						url: 'poststatus.php',
						method: "post",
						data: {
							status: status
						},
						success: function(data) {
							$('#error-msg').removeClass('alert-danger');
							$('#error-msg').addClass('alert-success').html('Successfully Tweeted').slideDown();
							setTimeout(function() {
								$("#error-msg").slideUp();
							}, 1000);
							$('#status').val('');
                            pullPost();
						},
						error: function() {
							$("#error-msg").html('There is some error occured').fadeIn();
							setTimeout(function() {
								$("#error-msg").fadeOut();
							}, 3000);
						},
						complete: function() {
						}
					});
				}
			});



        $('#status-update-form1').submit(function(x) {
				x.preventDefault();
				var status1 = $('#status1').val();
                                var image = $('#image').val();
				if (status == "" && image == "") {
					$("#error-msg").html('Hey! Please enter something').slideDown();
					setTimeout(function() {
						$("#error-msg").slideUp();
					}, 1000);
				}  {
                                        $('#error-msg').addClass('alert-success').html('Tweeting...').slideDown();
					$.ajax({
						url: 'picture.php',
						method: "post",
						data: {
							status1: status1,
							image: image
						},
						success: function(data) {
							$('#error-msg').removeClass('alert-danger');
							$('#error-msg').addClass('alert-success').html('Successfully Tweeted').slideDown();
							setTimeout(function() {
								$("#error-msg").slideUp();
							}, 1000);
							$('#status1').val('');
							$('#image').val('');
                            pullPost();
						},
						error: function() {
							$("#error-msg").html('There is some error occured').fadeIn();
							setTimeout(function() {
								$("#error-msg").fadeOut();
							}, 3000);
						},
						complete: function() {
						}
					});
				}
			});






			function pullPost() {
				$("#tweets").html('<img src="loader.gif"> Loading Tweets...');
				$.ajax({
					url: 'tweets.php',
					method: "get",
					success: function(data) {
						setTimeout(function() {
							$("#error-msg").slideUp();
						}, 3000);
						$('#tweets').html(data);
					},
					error: function() {
						$("#error-msg").html('There is some error occured').fadeIn();
						setTimeout(function() {
							$("#error-msg").fadeOut();
						}, 3000);
					}
				});
			}
			window.onload = function() {
				pullPost();
			};
            
            setInterval(function(){
                pullPost();
            }, 60000);
    </script>
</body>

</html>
