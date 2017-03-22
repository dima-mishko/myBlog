<?php
session_start();
$user ='root';
$pass='';
$db = new PDO('mysql:host=localhost;dbname=myBlog', $user, $pass);
$sql ="SELECT c.id as idc, u.login, p.id, c.date, c.comment
FROM comments c
INNER JOIN users u ON c.id_user = u.id
INNER JOIN posts p ON c.id_post = p.id
WHERE c.id_post =  '{$_POST['postId']}'";
$selectComments = $db -> query($sql);
while($item = $selectComments->fetch()){
	if($_SESSION['login']=='admin'){
		$comment .= '
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="author">'.$item["login"].'</div>
					<div class="metadata">
						<span class="date">'.$item["date"].'</span>
					</div>
				</div>
				<div class="panel-body">
					<div class="post-description"><p class="lead" id="lead'.$item["idc"].'"  contenteditable>'.$item["comment"].'</p></div>
				</div>
				<div class="panel-footer">
					<button class="btn btn-default" id="btn_upd" type="submit" forId="'.$item["idc"].'">Update</button>
					<button class="btn btn-default" id="btn_del" type="submit" forId="'.$item["idc"].'">Delete comments</button>
				</div>
			</div>';
	}else{
		if ($_COOKIE['login']=='admin'){
			$comment .= '
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="author">'.$item["login"].'</div>
					<div class="metadata">
						<span class="date">'.$item["date"].'</span>
					</div>
				</div>
				<div class="panel-body">
					<div class="post-description"><p class="lead" id="lead'.$item["idc"].'"  contenteditable>'.$item["comment"].'</p></div>
				</div>
				<div class="panel-footer">
					<button class="btn btn-default" id="btn_upd" type="submit" forId="'.$item["idc"].'">Update</button>
					<button class="btn btn-default" id="btn_del" type="submit" forId="'.$item["idc"].'">Delete comments</button>
				</div>
			</div>';
		}else{
		if ($item['login'] == $_SESSION['login'] or $item['login'] == $_COOKIE['login']){
					$comment .= '
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="author">'.$item["login"].'</div>
					<div class="metadata">
						<span class="date">'.$item["date"].'</span>
					</div>
				</div>
				<div class="panel-body">
					<div class="post-description"><p class="lead" id="lead'.$item["idc"].'"  contenteditable>'.$item["comment"].'</p></div>
				</div>
				<div class="panel-footer">
					<button class="btn btn-default" id="btn_upd" type="submit" forId="'.$item["idc"].'">Update</button>
					<button class="btn btn-default" id="btn_del" type="submit" forId="'.$item["idc"].'">Delete comments</button>
				</div>
			</div>';
		}else{
			$comment .='
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="author">'.$item["login"].'</div>
					<div class="metadata">
						<span class="date">'.$item["date"].'</span>
					</div>
				</div>
				<div class="panel-body">
					<div class="post-description"><p class="lead" id="lead'.$item["idc"].'" >'.$item["comment"].'</p></div>
				</div>
			</div>
			';
			}
		}

	}
}
echo $comment;
?>