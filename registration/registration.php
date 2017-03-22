<?php
$user ='root';
$pass='';
$db = new PDO('mysql:host=localhost;dbname=myBlog', $user, $pass);
if(isset($_POST['submit'])){;
	if(!preg_match('|^[A-Z0-9]+$|i', $_POST['inputLogin'])){
		header( 'Refresh: 2; url=/myBlog/registration/registration.html' );
		echo "invalid password!";
		
	}else{
		$sql_r = $db->query ("SELECT * FROM `users` WHERE `login`='{$_POST['inputLogin']}'");
		$sql = $sql_r->fetch();	
		if(!empty($sql)){
			header( 'Refresh: 2; url=/myBlog/registration/registration.html' );
			echo "invalid login!";
			
		}else{
			if(!preg_match("/^[a-z0-9_.-]+@([a-z0-9]+\.)+[a-z]{2,6}$/i", $_POST['inputEmail'])){
				header( 'Refresh: 2; url=/myBlog/registration/registration.html' );
				echo "invalid Email"."\n";
				
			}else{
				$sql_r = $db->query ("SELECT * FROM `users` WHERE `email`='{$_POST['inputEmail']}'");
				$sql = $sql_r->fetch();
				if(!empty($sql)){
					header( 'Refresh: 2; url=/myBlog/registration/registration.html' );
					echo "invalid Email!";
					
				}else{
					if(!preg_match('|^[A-Za-z0-9А]+$|i', $_POST['inputPassword'])){
						header( 'Refresh: 2; url=/myBlog/registration/registration.html' );
						echo "invalid passord!";
						
					}else{
						$hesh = password_hash($_POST['inputPassword'], PASSWORD_DEFAULT);
						$login = $_POST['inputLogin'];
						$email = $_POST['inputEmail'];
						$stmt = $db->prepare("INSERT INTO `users` (`login`, `hesh`, `email`) VALUES(:login, :hesh, :email)");
						$stmt->bindParam(":login",$login, PDO::PARAM_STR);
						$stmt->bindParam(":hesh",$hesh, PDO::PARAM_STR);
						$stmt->bindParam(":email",$email );
						$stmt->execute();
						header( 'Refresh: 2; url=/myBlog/autorization/login.html' );
						echo "You are registered! autorize";
						
					}
				}
			}
		}          
	}
}else{
header ("Location: /myBlog/error.php");
}
?>