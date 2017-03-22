<?php
$user ='root';
$pass='';
$db = new PDO('mysql:host=localhost;dbname=myBlog', $user, $pass);
$sql =("SELECT count(c.id) as idc
FROM comments c
INNER JOIN users u ON c.id_user = u.id
INNER JOIN posts p ON c.id_post = p.id
WHERE c.id_post =  '{$_POST['postId']}'");
$selectComments = $db -> query($sql);
$sC=$selectComments->fetch();
echo "Comments: <span class='badge'>{$sC['idc']}</span>";
?>
