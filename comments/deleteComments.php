<?php
$user ='root';
$pass='';
$db = new PDO('mysql:host=localhost;dbname=myBlog', $user, $pass);
$sql = $db->query("DELETE FROM `comments` WHERE `id` ='".$_POST["id"]."'");
?>