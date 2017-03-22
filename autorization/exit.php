<?php
session_start();
unset ($_SESSION['login']);
unset ($_SESSION['pass']);
session_destroy();
setcookie ("login", "", time() - 3600,"/");
setcookie ("pass", "", time() - 3600,"/");
header ("Location: /myBlog/index.php");	
?>