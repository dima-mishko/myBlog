<?php
$db = mysqli_connect('localhost','root','','myBlog');
$countView =$_POST['count_add'];  // количество записей, получаемых за один раз
$startIndex = $_POST['count_show']; // с какой записи начать выборку
$host = $_POST['heshT'];
// запрос к бд
$sql = mysqli_query($db, "SELECT p.id, p.id_user, p.title, p.image, p.`text`, h.heshTegs
			FROM posts p
			INNER JOIN `heshtegs` h ON  p.id=h.id_post
			WHERE h.heshTegs = '$host' LIMIT $startIndex, $countView") or die(mysqli_error());
$newsData = array();
while($result = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
    $newsData[] = $result;
}
if(empty($newsData)){
    // если новостей нет
    echo json_encode(array(
        'result'    => 'finish'
    ));
}else{
    // если новости получили из базы, то сформируем html элементы
    // и отдадим их клиенту
    $html = "";
    foreach($newsData as $oneNews){
        $html .= '
		<div class="jumbotron">
			<a href="/myBlog/article.php?id='.$oneNews["id"].'">
				<div class="container">
					<h1>'.$oneNews["title"].'</h1>
				</div>
			</a>
			<div class="row col-md-6">
				<img src = "'.$oneNews["image"].'" class="img-rounded" style="width:400px;height:300px;">
			</div>
			<div class="container">
				<p class="lead">'.$oneNews["text"].'</p>
			</div>
			<div class="container">
			';
			$sql1 = mysqli_query($db, "SELECT id_post,`heshTegs` FROM `heshtegs` WHERE `id_post`='{$oneNews['id']}'") or die(mysqli_error());
			$newsData1 = array();
			while($result1 = mysqli_fetch_array($sql1, MYSQLI_ASSOC)){
				$newsData1[] = $result1;
			}
			foreach($newsData1 as $hesh){
				$html .= "<a href='/myBlog/heshTags.php?id={$hesh['heshTegs']}'>#{$hesh['heshTegs']}</a>";
			}
			$html .='
			</div><div class="container col-md-2">';
			
			$sql2 = mysqli_query($db, "SELECT count(c.id) as id FROM comments c INNER JOIN posts p ON p.id = c.id_post WHERE c.id_post = '{$oneNews['id']}'") or die(mysqli_error());
			$newsData2 = array();
			while($result2 = mysqli_fetch_array($sql2, MYSQLI_ASSOC)){
				$newsData2 = $result2;
			}
			$html .='<a>Comments: <span class="badge">'.$newsData2['id'].'</span></a>';
					
					$html .='
					</div>
					<div class="container">';
					
			$sql3 = mysqli_query($db, "SELECT count(l.id) as id FROM posts p INNER JOIN `like` l ON p.id = l.id_post WHERE l.id_post = '{$oneNews['id']}'") or die(mysqli_error());
			$newsData3 = array();
			while($result3 = mysqli_fetch_array($sql3, MYSQLI_ASSOC)){
				$newsData3 = $result3;
			}
			$html .='<a>Like: <span class="badge">'.$newsData3['id'].'</span></a>';
					
			$html .='
		</div></div>
        ';
    }
    echo json_encode(array(
        'result'    => 'success',
        'html'      => $html
    ));
}
