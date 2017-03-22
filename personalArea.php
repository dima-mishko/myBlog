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
	<a href='/myBlog/addArticl.php'><button type="button" class="btn btn-primary btn-lg btn-block">add posts</button></a>
	<table class="table table-bordered" id='tablesInfo'></table>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/myBlog/js/bootstrap.min.js"></script>
	<script>
	$(document).ready(function(){
		function fetchData(){
                $.ajax({
                    url:"/myBlog/selectInfo.php",
                    method: "POST",
					dataType:"text",
                    success: function(data){
                        $('#tablesInfo').html(data);
                    }
                });
            }
            fetchData();
				  $(document).on('click', '#btnDel', function () {
			  var id = parseInt($(this).attr('forId'));
                $.ajax({
                    url:"/myBlog/deleteInfo.php",
                    method:"POST",
                    data:{id:id},
                    dataType:"text",
                    success: function (data) {
                        fetchData();
                    }
                });
            });
	});
	</script>
  </body>
</html>