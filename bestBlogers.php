<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

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
	</div>
    <div class='container'>
	<div class='jumbotron'>
			<?php
			include"connect.php";
			$sql = $db ->query("SELECT u.login as user, COUNT( l.id ) AS likes
				FROM posts p
				LEFT JOIN  `like` l ON p.id = l.id_post
				INNER JOIN users u ON p.id_user = u.id
				GROUP BY u.login ORDER BY likes DESC");
			while($result = $sql->fetch()){
				$newsData[] = $result;
			}
			foreach($newsData as $oneNews){
				echo "
				<dl class='dl-horizontal'>
					<dt><a href='/myBlog/blogers.php?name={$oneNews['user']}' class='alert-link'>{$oneNews['user']}</a></dt>
					<dd>{$oneNews['likes']}</dd>
				</dl>";
			}
			?>
	</div>
	</div>
	<div class='footer'></div>
  </body>
</html>