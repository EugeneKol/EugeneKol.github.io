<?php
    require "db.php";
     $data = $_POST;
    if( isset($data['do_login'])) 
    {
      $errors  = array();
      $user = R::findOne('users', 'login = ?', array($data['login']));

      if( $user )
      {
      	//логин сушествует
      	if(password_verify($data['password'], $user->password)){
         //всё хорошо, логинем пользователя
      		$_SESSION['logged_user'] = $user;
      		echo '<div id="good"> Вы авторозивоны!<br> Можете перейти на <a href="index.html">главную страницу</a></div>';
        }
      	else{
       $errors[] = "Неверно набран пароль";
         } 
      }
      else
      {
       $errors[] = "Пользователя с таким логином не существует";
      }
      if( ! empty($errors) )
   	    {
   			echo '<div style="color:#c73939;">'.array_shift($errors).'</div>';
   		} 
    }

 ?>