<?php
session_start();
$user ='root';
$pass='';
$db = new PDO('mysql:host=localhost;dbname=myBlog', $user, $pass);
	if($_SESSION['login']){
		$sql = $db->query("select `id` from `users` where `login`='".$_SESSION['login']."'");
	}else{
		if($_COOKIE['login']){
		$sql = $db->query("select `id` from `users` where `login`='".$_COOKIE['login']."'");
		}
	}

$name=$sql->fetch();
$date = date("Y-n-j");
$files = "/myBlog/images/".$_FILES["files"]["name"];
$insert= $db->prepare("insert into `posts` (`id_user`,`date`,`title`,`image`,`text`) value (:user, :date, :title, :image, :text)");
$insert->bindParam(':user',$name['id']);
$insert->bindParam(':date',$date);
$insert->bindParam(':title',$_POST['title']);
$insert->bindParam(':image',$files);
$insert->bindParam(':text',$_POST['textarea']);
$insert->execute();
$sqltags=$db->query("select `id` from `posts` where `id_user`='".$name['id']."' order by `id` desc limit 1");
$tags=$sqltags->fetch();
$tes = explode("#",$_POST['tags']);
foreach($tes as $teg){
	if($teg != ''){
	$insertTags=$db->prepare("insert into `heshtegs` (`id_post`,`heshTegs`) value (:idPost, :hesh)");
	$insertTags->bindParam(':idPost',$tags['id']);
	$insertTags->bindParam(':hesh',$teg);
	$insertTags->execute();
	}
}
$types = array('image/gif','image/jpeg','image/png','image/pjpeg');
if(in_array($_FILES['files']['type'],$types)){
	$file = '/'.$_FILES['files']['name'];
	$adresFoto = 'Z:/home/localhost/www/myBlog/images'.$file;
	move_uploaded_file($_FILES['files']['tmp_name'], $adresFoto);
	header( 'Refresh: 1; url=/myBlog/addArticl.php' );
	echo "added file";
}else{
	echo "Opssss!";
	header( 'Refresh: 1; url=/myBlog/addArticl.php' );
}
?>