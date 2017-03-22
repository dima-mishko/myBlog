<?php
$user ='root';
$pass='';
$db = new PDO('mysql:host=localhost;dbname=myBlog', $user, $pass);
$sql = $db->query("UPDATE `posts` SET `title`='".$_POST["title"]."', `text`='".$_POST["textarea"]."' WHERE `id`='".$_GET["id"]."'");
$sql = $db->query("DELETE FROM `heshtegs` WHERE `id_post`='".$_GET["id"]."'");
$tes = explode("#",$_POST['heshTegss']);
foreach($tes as $teg){
	if($teg != ''){
	$insertTags=$db->prepare("insert into `heshtegs` (`id_post`,`heshTegs`) value (:idPost, :hesh)");
	$insertTags->bindParam(':idPost',$_GET["id"]);
	$insertTags->bindParam(':hesh',$teg);
	$insertTags->execute();
	}
}
header( 'Refresh: 0; url=/myBlog/article.php?id='.$_GET["id"].'' );
  ?>