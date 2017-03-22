<?php
$user ='root';
$pass='';
$db = new PDO('mysql:host=localhost;dbname=myBlog', $user, $pass);
$sql = $db->query("
DELETE posts, comments,  `like`, heshtegs
FROM posts
LEFT JOIN comments ON posts.id = comments.id_post
LEFT JOIN  `like` ON posts.id =  `like`.id_post
LEFT JOIN heshtegs ON posts.id = heshtegs.id_post
WHERE posts.id =  '".$_POST["id"]."'");
?>