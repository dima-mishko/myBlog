<?php
session_start();
$user ='root';
$pass='';
$db = new PDO('mysql:host=localhost;dbname=myBlog', $user, $pass);
echo"	<tr>
		<td>id</td>
		<td>namePost</td>
		<td>user</td>
		<td></td>
		<td></td>
	</tr>";
	if($_SESSION['login']=='admin'){
		$sql = $db->query("select p.id as id, p.title as title, u.login as user from posts p inner join users u on u.id=p.id_user");
	}else{
		if($_COOKIE['login']=='admin'){
		$sql = $db->query("select p.id as id, p.title as title, u.login as user from posts p inner join users u on u.id=p.id_user");
		}else{
		$sql = $db->query("select p.id as id, p.title as title, u.login as user from posts p inner join users u on u.id=p.id_user where u.login='".$_SESSION['login']."'");
		}
	}
	$posts= $sql->fetchAll();
	foreach($posts as $post){
		echo '
		<tr>
			<td>'.$post["id"].'</td>
			<td>'.$post["title"].'</td>
			<td>'.$post["user"].'</td>
			<td><a href="/myBlog/article.php?id='.$post["id"].'"><button type="button" class="btn btn-default" >go</button></a></td>
			<td><button type="button" class="btn btn-default" id="btnDel" forId="'.$post["id"].'">delete</button></td>
		</tr>
		';
	}
?>