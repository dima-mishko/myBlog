<?php
session_start();
$user ='root';
$pass='';
$db = new PDO('mysql:host=localhost;dbname=myBlog', $user, $pass);
	if($_SESSION['login']){
		$logins = $_SESSION['login'];
	}else{
		if($_COOKIE['login']){
		$logins = $_COOKIE['login'];
		}
	}
	$name = $db ->query("SELECT `id` FROM `users` WHERE `login`='{$logins}'");
	$login = $name->fetch();
if( $_POST['count_like']== '0'){
	$date = date("Y-n-j");
	$sql = $db ->query("INSERT INTO `like` (`id_user`, `id_post`, `date`, `like`) VALUES ('{$login['id']}','{$_POST['postId']}','{$date}','{$_POST['count_like']}')");
}else{
	$sql = $db ->query("DELETE FROM `like` WHERE `id_user`='{$login['id']}' AND `id_post`='{$_POST['postId']}'");
	}
?>				