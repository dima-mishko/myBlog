<?php
/*echo "<div><input type='submit' value='asdasdasdas' /></div>";*/

session_start();
$user ='root';
$pass='';
$db = new PDO('mysql:host=localhost;dbname=myBlog', $user, $pass);
$sql= $db-> query("SELECT id_post,`heshTegs` FROM `heshtegs` WHERE `id_post`='{$_POST['postId']}'");
$heshTags = $sql->fetchAll();
foreach($heshTags as $hesh){
	echo "<a href='/myBlog/heshTags.php?id={$hesh['heshTegs']}'>#{$hesh['heshTegs']}</a>";
}
?>