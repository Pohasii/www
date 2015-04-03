<!doctype html>
<html lang="ru">
<head>
    <link rel="stylesheet" type="text/css" href="/style/style.css">
    <meta charset="UTF-8" />
    <title><?php echo $title; ?></title>
	
	<link rel="icon" href="/img/favicon2.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/img/favicon2.ico" type="image/x-icon">
	
	
	<script src="/view/jquery-2.1.3.min.js" type="text/javascript"></script>
	<script src="/view/chosen.jquery.js" type="text/javascript"></script>
	<link href="/view/chosen.css" rel="stylesheet">
	
</head>

<body>
<header>
	<div class=line> </div>
    <div class="panel">
	<div style="width:100px; float: left;"><h1>Beta</h1></div>
	<?php 
			$login = $_SESSION["login"];
			$result = call("SELECT * FROM `user` WHERE `email`='$login'");
			if((isset($_SESSION["login"]) && isset($_SESSION["keys"])) && ($_SESSION["login"] == $result[0]["email"] && $_SESSION["keys"] == $result[0]["keys"])) {
				echo "<a id='login_pop' href='/profile/".$_SESSION["login"]."'>Добро пожаловать,".$_SESSION["login"]."</a> <a id='login_pop' href='/layout/exit' > выйти </a>";
			} else { echo '
			<a href="#login_form" id="login_pop">Войти</a>
			<a href="#join_form" id="join_pop">Зарегистрироваться</a>
			';} ?>
        
    </div>

<div class="logo">
<img src="/img/siteimg/logo3.jpg" alt="logo">
</div>
		<div id=menu> 
         <ul id="nav" align=center>
                <li><a href="/">Главная</a></li>
                <!--li><a class="hsubs" href="#">Меню 3</a>
                    <ul class="subs">
                        <li><a href="#">Подменю 3-1</a></li>
                        <li><a href="#">Подменю 3-2</a></li>
                        <li><a href="#">Подменю 3-3</a></li>
                        <li><a href="#">Подменю 3-4</a></li>
                        <li><a href="#">Подменю 3-5</a></li>
                    </ul>
                </li-->
                <li><a href="/tournaments">Турниры</a></li>
                <li><a href="/help">Help</a></li>
				<li><a href="/news">News</a></li>
                <div id="lavalamp"></div>
            </ul>
		</div>
</header>

<div id=content>
	<div class=visibility>
		<?php echo $content;
		//echo print_r(call("SELECT * FROM `links`"));
		?>
	</div>
</div>

<div class="footer">
<footer class="foot">
 Все, всееее пизец!
</footer>
</div>
</body>


<!-- popup form #1 -->
<a href="#x" class="overlay" id="login_form"></a>
<div class="popup">
	<form method="post" action="/authentication" id="authform" name="authform">
    <h2>Добро пожаловать гости!</h2>
    <p>Введите ваш логин и пароль здесь</p>
    <div>
        <label for="login">Логин</label>
        <input type="email" id="login" name="email"/>
    </div>
    <div>
        <label for="password">Пароль</label>
        <input type="password" name="pass" id="password"/>
    </div>
    <input name="sub" type="submit"  value="Sing in">

    <a class="close" href="#close"></a>
	</form>
</div>

<!-- popup form #2 -->
<form method="post" action="/authentication">
<a href="#x" class="overlay" id="join_form"></a>
<div class="popup">
    <h2>Зарегистрироваться</h2>
    <p>Введите здесь детальную информацию о себе</p>
    <div>
        <label for="email">Логин (Email)</label>
        <input type="email" id="email" name="email" autofocus="autofocus" placeholder="e-mail@email.com" required />
    </div>
    <div>
        <label for="pass">Пароль</label>
        <input type="password" name="pass" id="pass" placeholder="password" required />
    </div>
	<div>
        <label for="pass">Повторите</label>
        <input type="password" name="pass2" id="pass" placeholder="password" required />
    </div>
    <div>
        <label for="firstname">Имя</label>
        <input type="text" id="firstname" name="name" placeholder="name" required />
    </div>
    <div>
        <label for="lastname">Игра</label>
    <div class="second-column-block-element">

		<select name="game[]" data-placeholder="Line" class="chosen-select" multiple style="width:300px;" tabindex="1">
					<?php 
					$result = call("SELECT * FROM `game`");
					foreach($result as $value) { 
					echo "<option value='".$value['game']."'>".$value['game']."</option>";
					}
					?>
				</select>
		</div>	  
    </div>
    <input name="sub" type="submit" value="Sing up">&nbsp;&nbsp;&nbsp;или&nbsp;&nbsp;&nbsp;<a href="#login_form" id="login_pop">Войти</a>

    <a class="close" href="#close"></a>
</div>
</form>

<script type="text/javascript">
    var config = {
      '.chosen-select'           : {max_selected_options: 5},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
	  $(".chosen-select").chosen({width: '350px'});
    }
  </script>

</html>