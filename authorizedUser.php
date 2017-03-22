<?php
session_start();
	if($_SESSION['login']){
		$login = $_SESSION['login'];
	}else{
		if($_COOKIE['login']){
		$login = $_COOKIE['login'];
		}
	}
echo "
			<nav class='navbar navbar-default'>
			<div class='container'>
				<div class='navbar-header'>
					<button type='button' class = 'navbar-toggle colapsed' data-toogle='colapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
						<span class='sr-only'></span>
						<span class='icon-bar'></span>
						<span class='icon-bar'></span>
						<span class='icon-bar'></span>
					</button>
					<a class='navbar-brand' href='/myBlog/index.php'>myBlog</a>
				</div>
				<div id ='navbar' class='navbar-collapse collapse'>
					<ul class=' nav navbar-nav'>
						<li id='lastPosts' style='' class=''>
							<a href='/myBlog/index.php'>last articles</a>
						</li>
						<li id='wiewed' style=''>
							<a href='/myBlog/wiewed.php'>populars</a>
						</li>
						<li id='bestBloggers' style=''>
							<a href='/myBlog/bestBlogers.php'>best blogers</a>
						</li>
						<li id='login' style=''>
							<a href='/myBlog/autorization/exit.php'>exit</a>
						</li>
						<li id='user' style=''><a href='/myBlog/personalArea.php'>".$login."</a></li>
					</ul>
				</div>
			</div>
		</nav>
";
 ?>