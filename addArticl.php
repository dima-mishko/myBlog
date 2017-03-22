<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/myBlog/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div class='container'>
	<?php
	if($_SESSION['login']){
		include"authorizedUser.php";
	}else{
		if($_COOKIE['login']){
		include"authorizedUser.php";
		}else{
		include"guest.php";
		}
	}
	?>
		<form class="form-horizontal" method='POST' action='addPost.php' enctype='multipart/form-data'>
		  <div class="form-group">
			<label for="title" class="col-sm-2 control-label">title</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name='title' id="title" placeholder="title">
			</div>
		  </div>
		  <div class="form-group">
			<label for="textarea" class="col-sm-2 control-label">text</label>
			<div class="col-sm-10">
			  <textarea class="form-control" name='textarea' rows="3" placeholder='enter the text'></textarea>
			</div>
		  </div>
		  <div class="form-group">
			<label for="tags" class="col-sm-2 control-label">tegs</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name='tags' id="tags" placeholder="hesh tags">
			</div>
		  </div>
		  <div class="form-group">
			<label for="file" class="col-sm-2 control-label">files</label>
			<div class="col-sm-10">
			  <input type="file" class="form-control"name='files' id="file" placeholder="files">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button type="submit" class="btn btn-default">Add</button>
			</div>
		  </div>
		</form>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/myBlog/js/bootstrap.min.js"></script>
  </body>
</html>