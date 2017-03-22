<?php
session_start();
	if($_SESSION['login']){
		$user ='root';
		$pass='';
		$db = new PDO('mysql:host=localhost;dbname=myBlog', $user, $pass);
		$date = date("Y-n-j");
		$sql= "SELECT `id` FROM `users` WHERE `login`= :login";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':login', $_SESSION['login'], PDO::PARAM_STR);
		$stmt->execute();
		$login = $stmt->fetch();
		$sql1 = "INSERT INTO `comments` (`id_user`, `id_post`, `date`, `comment`) 
						VALUE({$login['0']}, :post, '{$date}', :comment )";
		$stmt1 = $db->prepare($sql1);
		$stmt1->bindParam(':post', $_POST['postId']);     
		$stmt1->bindParam(':comment', $_POST['comment']);
		$stmt1->execute();
	}else{
		if($_COOKIE['login']){
		$user ='root';
		$pass='';
		$db = new PDO('mysql:host=localhost;dbname=myBlog', $user, $pass);
		$date = date("Y-n-j");
		$sql= "SELECT `id` FROM `users` WHERE `login`= :login";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':login', $_COOKIE['login'], PDO::PARAM_STR);
		$stmt->execute();
		$login = $stmt->fetch();
		$sql1 = "INSERT INTO `comments` (`id_user`, `id_post`, `date`, `comment`) 
						VALUE({$login['0']}, :post, '{$date}', :comment )";
		$stmt1 = $db->prepare($sql1);
		$stmt1->bindParam(':post', $_POST['postId']);     
		$stmt1->bindParam(':comment', $_POST['comment']);
		$stmt1->execute();
		}
	}