<?php
session_start();
$user ='root';
$pass='';
$db = new PDO('mysql:host=localhost;dbname=myBlog', $user, $pass);
    $sql = $db->query("select * from posts where id={$_GET['id']}");
	$onePost = $sql->fetch();
	$sql1 = $db->query("select * from heshtegs where id_post={$_GET['id']}");
	$onePost1 = $sql1->fetchAll();
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
<link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
 <script src="js/bootstrap.min.js"></script>
   <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
 <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js">
</script>
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
			<form class='form-horizontal' method='POST' action='updateP.php?id=<?php echo $_GET['id'];?>'>
				<div class='form-group'>
					<label class='control-label'>Title</label>
					<input type='text' class='form-control' name='title' value='<?=$onePost['title']?>'>
				</div>
				<div class='form-group'>
					<label class='control-label'>Hesh</label>
					<input type='text' class='form-control' name='heshTegss' value='<?foreach($onePost1 as $s){echo "#".$s['heshTegs'];}?>'>
				</div>
				<div class='form-group'>
					<label class='control-label'></label>
					<textarea class='form-control' rows='3' name='textarea'><?=$onePost['text']?></textarea>
				</div>
				<input type='submit' class='btn btn-primary' value='Save'>
			</form>
		</div>
	</div>
  </body>
</html>