<?php
session_start();
include"connect.php";
$sql = $db ->query("SELECT * FROM `posts` WHERE id = {$_GET['id']}");
$onePost = $sql->fetch();
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
			<div class='container'>
				<h1><?=$onePost['3'];?></h1>
			</div>
			<div class='row col-md-6'>
				<img src = '<?=$onePost['4'];?>' class='img-rounded' style="width:400px;height:300px;">
			</div>
			<div class='container'>
				<p class='lead'><?=$onePost['5'];?></p>
			</div>
			<div class='container' id='heshtags'></div>
			
			
			<div class='container col-md-2' id='countComments'></div>
			<div class='container col-md-2' id='likes'></div>
			<?php
			$sql1 = $db ->query("SELECT login FROM `users` WHERE id = {$onePost['id_user']}");
			$onePost1 = $sql1->fetch();
				if($_SESSION['login']){
					if($_SESSION['login']==$onePost1['login']){
						echo "<div class='container col-md-1'><a href='/myBlog/updatePost.php?id=".$_GET['id']."'><button type='button' class='btn btn-primary'>Update</button></a></div>";
					}
				}else{
					if($_COOKIE['login']){
						if($_COOKIE['login']==$onePost1['login']){
							echo "<div class='container col-md-1'><a href='/myBlog/updatePost.php?id=".$_GET['id']."'><button type='button' class='btn btn-primary'>Update</button></a></div>";
						}
					}
				}
			?>
			
			<div class='container navbar-right col-md-3'>Added:<?=$onePost['2'];?></div>
		</div>
		<input name='postId' id='postId' type='hidden' value='<?=$_GET['id']?>'></input>
		<?php
			if($_SESSION['login']){
				echo "<div class='jumbotron' >
				<form class='form-horizontal' method='POST' >
				<input name='postId' id='postId' type='hidden' value='{$_GET['id']}'></input>
				<div class='form-group'>
					<textarea class='form-control' rows='3' name='comment' id='comment' placeholder='enter text he'></textarea>
				</div>
				<div class='form-group'>
					<button class='btn btn-default' id='btn_add' type='submit'>Send comit</button>
				</div>
				</form></div>";
			}else{
				if($_COOKIE['login']){
								echo "<div class='jumbotron' >
							<form class='form-horizontal' method='POST' >
				<input name='postId' id='postId' type='hidden' value='{$_GET['id']}'></input>
				<div class='form-group'>
					<textarea class='form-control' rows='3' name='comment' id='comment' placeholder='enter text he'></textarea>
				</div>
				<div class='form-group'>
					<button class='btn btn-default' id='btn_add' type='submit'>Send comit</button>
				</div>
			</form></div>
				";
				}else{
				echo "<div class='jumbotron' >To leave a comment please log in or register!</div>";
				}
			}
		?>
		
		<div  id='comments'></div>
			
	</div>
	<script>
	$(document).ready(function(){
	//динамическая манипуляция с выводом данных
	        
            function fetchData(){
				var postId = $('#postId').val();
                $.ajax({
                    url:"/myBlog/comments/selectComments.php",
                    method: "POST",
					data:{postId:postId},
					dataType:"text",
                    success: function(data){
                        $('#comments').html(data);
                    }
                });
            }
            fetchData();
			 $(document).on('click', '#btn_add', function(){  						
			   var postId = $('#postId').val();  							
			   var comment = $('#comment').val();		
			   if(comment == '') {alert("Enter comment");  return false;}  		
			   $.ajax({  
					url:"/myBlog/comments/insertComments.php",  									
					method:"POST",  											
					data:{postId:postId, comment:comment},  							
					dataType:"text",  											
					success:function(data)  
					{   
						 fetchData();  
					}  
			   })  
		  });
		  	 $(document).on('click', '#btn_upd', function(){  						
			   
			   var id = parseInt($(this).attr('forId'));
			   var lead = $('#lead'+id).text();
			   var comment = 'comment';
			   alert(lead);
			   $.ajax({  
					url:"/myBlog/comments/editComments.php",  									
					method:"POST",  											
					data:{lead:lead, id:id, comment:comment},							
					dataType:"text",  											
					success:function(data)  
					{   
						 fetchData();
						
					}  
			   })  
		  });
		  $(document).on('click', '#btn_del', function () {
			  var id = parseInt($(this).attr('forId'));
				alert(id);
                $.ajax({
                    url:"/myBlog/comments/deleteComments.php",
                    method:"POST",
                    data:{id:id},
                    dataType:"text",
                    success: function (data) {
                        fetchData();
						commentData();
                    }
                });
            });
					//script for comments
		function commentData(){
					var postId = $('#postId').val();
					$.ajax({
						url:"/myBlog/countComments.php",
						method: "POST",
						data:{postId:postId},
						dataType:"text",
						success: function(data){
                        $('#countComments').html(data);
						}
					});
				}
				commentData();
		//end script
	//script for likes
				function likeData(){
					var postId = $('#postId').val();
					$.ajax({
						url:"/myBlog/selectLikes.php",
						method: "POST",
						data:{postId:postId},
						dataType:"text",
						success: function(data){
                        $('#likes').html(data);
						}
					});
				}
				likeData();
				$(document).on('click', '#likeBtn', function(){
					var count_like = parseInt($(this).attr('count_like'));
					var postId = $('#postId').val();
						$.ajax({
							url:"/myBlog/likes.php",
							method:"POST",
							data:{count_like:count_like,postId:postId},
							dataType:"text",
							success: function(data){
								likeData();
							}
						});
				});
				//end script
				//heshtags
						function heshTagsData(){
					var postId = $('#postId').val();
					$.ajax({
						url:"/myBlog/selectTags.php",
						method: "POST",
						data:{postId:postId},
						dataType:"text",
						success: function(data){
                        $('#heshtags').html(data);
						}
					});
				}
				heshTagsData();
        });
	</script>
  </body>
</html>