<?php
require(__DIR__ . '/config.php');
require(__DIR__ . '/fb.connect.php');


$response = $fb->get('/me', $accessToken);
$user = $response->getGraphUser();


if($db->exists('fb_users','fb_id',['fb_id'=> $user['id']]) == 0){
	$db->insert('fb_users',['fb_id' => $user['id'],'name' => $user['name'],'email' => $user['email']]);
}

if(isset($_POST) && $_POST['inputMessage'] != ''){
	
	$linkData['link'] = '';
	
	if(isset($_POST['inputLink']) && $_POST['inputLink'] != ''){
		$linkData['link'] = $_POST['inputLink'];
	}
	$linkData['message'] = $_POST['inputMessage'];
	
	try {
		// Returns a `Facebook\FacebookResponse` object
		$response = $fb->post('/me/feed', $linkData, $accessToken);
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	
	$graphNode = $response->getGraphNode();
	
	$db->insert('fb_posts',['post_id' => $graphNode['id'],'link' => $linkData['link'],'email' => $linkData['message']]);

}

?>

<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from getbootstrap.com/examples/starter-template/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Feb 2015 06:51:42 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Test App:- tejrajstha.com.np</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Test App</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <h1>Welcom to My App</h1>
        <p class="lead">Hellou, This is Tej and your name is <?php echo $user['name'];?> Post On Your Wall</p>
        <form class="form-horizontal" method="post">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Link</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputLink" name="inputLink" placeholder="Link">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">message</label>
		    <div class="col-sm-10">
		    	<textarea class="form-control" cols="5" name="inputMessage"> </textarea>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-default">Post</button>
		    </div>
		  </div>
		</form>
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>

<!-- Mirrored from getbootstrap.com/examples/starter-template/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Feb 2015 06:51:42 GMT -->
</html>
