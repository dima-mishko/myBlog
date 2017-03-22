<?php
$user ='root';
$pass='';
$db = new PDO('mysql:host=localhost;dbname=myBlog', $user, $pass);
$passs=$_POST['InputPassword'];
if(!preg_match('|^[A-Z0-9]+$|i', $_POST['inputLogin'])){
	header( 'Refresh: 2; url=/myBlog/autorization/login.html' );
	echo "inccorect login!!";
}else{
	$sql = $db ->prepare("SELECT `login` FROM `users` WHERE `login`= ? ");
	$sql -> bindParam(1,$_POST['inputLogin'], PDO::PARAM_STR);
	$sql -> execute();
	$login = $sql->fetch();
	
	if(!preg_match('|^[A-Za-z0-9А]+$|i', $passs)){
		header( 'Refresh: 2; url=/myBlog/autorization/login.html' );
		echo "inccoret password!!";
	}else{
		
		$sql = $db ->prepare("SELECT `login`, `hesh`, `id_status` FROM `users` WHERE `login`= ? ");
		$sql -> bindParam(1,$login['login'], PDO::PARAM_STR);
		$sql -> execute();
		$pass = $sql->fetch();	
		if (password_verify($passs, $pass['hesh'])){
			session_start();
			$_SESSION['login']=$_POST['inputLogin'];
			$_SESSION['password']=$_POST['InputPassword'];
			$_SESSION['id_status'] = $pass['id_status'];
			if(isset($_POST['checkbox'])){
				header ("Location: /myBlog/personalArea.php");
			}else{
				setcookie("login",$_POST['inputLogin'], time()+60*60*24,"/");
				setcookie("pass",$_POST['InputPassword'], time()+60*60*24,"/");
				header ("Location: /myBlog/personalArea.php?t=off");
			}
		}else{
			header ("Location: /myBlog/autorization/login.html");
		}
	}
}