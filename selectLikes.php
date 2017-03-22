<?php
session_start();
	if($_SESSION['login']){
		$logins = $_SESSION['login']; 
	}else{
		if($_COOKIE['login']){
		$logins = $_COOKIE['login']; 
		}
	}
$user ='root';
$pass='';
$db = new PDO('mysql:host=localhost;dbname=myBlog', $user, $pass);
	$name = $db ->query("SELECT `id` FROM `users` WHERE `login`='{$logins}'");
	$login = $name->fetch();
	$countLikes = $db ->query("SELECT count(`like`) as `cLike` FROM `like` WHERE `id_post`='{$_POST['postId']}'");
	$cL = $countLikes->fetch();
	$insertLikeUser = $db->query("SELECT `like` FROM `like` WHERE `id_post`='{$_POST['postId']}' AND `id_user`='{$login['id']}'");
	$iLU = $insertLikeUser->fetch();
	if($_SESSION['login'] or $_COOKIE['login']){
			if($iLU['like'] == '0'){
		echo '<button class="btn btn-primary" id="likeBtn" type="button" count_like="1">
					Like: <span class="badge">'.$cL["cLike"].'</span>
			</button>';
	}else{
		echo '<button class="btn btn-default" id="likeBtn" type="button" count_like="0">
				Like: <span class="badge">'.$cL["cLike"].'</span>
			</button>';
	}
	}else{
		echo "Like: <span class='badge'>".$cL['cLike']."</span>";
	}

?>
	<?php

	?>