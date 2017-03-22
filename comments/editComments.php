<?php
$user ='root';
$pass='';
$db = new PDO('mysql:host=localhost;dbname=myBlog', $user, $pass);
    $sql = $db->query("UPDATE `comments` SET `".$_POST["comment"]."`='".$_POST["lead"]."' WHERE `id`='".$_POST["id"]."'");
  ?>