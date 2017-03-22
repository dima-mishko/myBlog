<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]
	
	SELECT COUNT( l.id ) AS id, l.id_post
FROM posts p
INNER JOIN  `like` l ON p.id = l.id_post
GROUP BY id_post


	-->

  </head>
  <body>
  <div class='container'>
	<?php
	if($_SESSION['login']){
		include"authorizedUser.php";
	}else{
		if($_COOKIE['login']){
		include"authorizedUser.php";
		}else{
		include"guest.php";
		}
	}
	?>
	</div>
    <div class='container'>

		<div id='container'>
			<?php
			include"connect.php";
			$sql = $db ->query("SELECT count(l.id) as id, p.id as pid, p.title, p.image, p.text FROM posts p LEFT JOIN `like` l ON p.id = l.id_post GROUP BY p.id ORDER BY id DESC LIMIT 5");
			while($result = $sql->fetch()){
				$newsData[] = $result;
			}
			foreach($newsData as $oneNews):

			$oneNews['text']=substr($oneNews['text'],0,540).'...';
				?>
				<div class='jumbotron'>
					<a href="/myBlog/article.php?id=<?=$oneNews['pid'];?>">
						<div class='container'>
							<h1><?=$oneNews['title'];?></h1>
						</div>
					</a>
					<div class='row col-md-6'>
						<img src = '<?=$oneNews['image'];?>' class='img-rounded' style="width:400px;height:300px;">
					</div>
					<div class='container'>
						<p class='lead'><?=$oneNews['text'];?></p>
					</div>
					<div class='container'>
					<?php
					$sql= $db-> query("SELECT `heshTegs` FROM `heshtegs` WHERE `id_post`='{$oneNews['pid']}'");
					$heshTags = $sql->fetchAll();
					foreach($heshTags as $hesh){
						echo "<a href='/myBlog/heshTags.php?id={$hesh['heshTegs']}'>#{$hesh['heshTegs']}</a>";
					}
					?>
					</div>
					<div class='container col-md-2'>
					<?php
					$sql = $db->query("SELECT count(c.id) as id FROM comments c INNER JOIN posts p ON p.id = c.id_post WHERE c.id_post = '{$oneNews['pid']}'");
					$allC = $sql->fetch();
					echo "<a>Comments: <span class='badge'>".$allC['id']."</span></a>";
					?>
					</div>
					<div class='container'>
					<?php
					$sql = $db->query("SELECT count(l.id) as id FROM posts p INNER JOIN `like` l ON p.id = l.id_post WHERE l.id_post = '{$oneNews['pid']}'");
					$allC = $sql->fetch();
					echo "<a>Like: <span class='badge'>".$allC['id']."</span></a>";
					?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<input id="show_more" count_show="5" count_add="5" type="button" value="show more" class='btn btn-primary' >
	</div>
	<div class='footer'></div>
		    <script>
        $(document).ready(function(){

            $('#show_more').click(function(){
                var btn_more = $(this);
                var count_show = parseInt($(this).attr('count_show'));
                var count_add  = $(this).attr('count_add');
                btn_more.val('waiting...');

                $.ajax({
                    url: "/myBlog/addPopular.php", // куда отправляем
                    type: "POST", // метод передачи
                    dataType: "json", // тип передачи данных
                    data: {count_show:count_show,count_add:count_add},
                    // после получения ответа сервера
                    success: function(data){
                        if(data.result == "success"){
                            $('#container').append(data.html);
                            btn_more.val('show more');
                            btn_more.attr('count_show', (count_show+5));
                        }else{
                            btn_more.val('nosing to shows');
                        }
                    }
                });
            });
        });
    </script>
  </body>
</html>