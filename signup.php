
<?php 
    require "db.php";
    $data = $_POST;

    if( isset($data['do_signup']) )
    {
       //здесь регистрация

     $errors = array();
     if( trim($data['login']) == '' )
     {
      $errors[]= 'Введите логин';
     }
      if( trim($data['email']) == '' )
     {
      $errors[]= 'Введите email';
     }
      
      if($data['password'] == '' )
     {
      $errors[]= 'Введите пароль';
     }
      if(R::count('users', "login = ?", array($data['login']))>0)
     {
      $errors[]= 'Пользователь с таким логином уже зарегистрирован';
     }
     if(R::count('users', "email = ?", array($data['email']))>0)
     {
      $errors[]= 'Пользователь с таким email уже зарегистрирован';
     }
      
      if($data['password_2'] != $data['password'] )
     {
      $errors[]= 'Повторный пароль введён не верно';
     }
      
      if( empty($errors) )
      {
        //всё хорошо, регистрируемся
        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        R::store($user);
        echo '<div id="good"> Вы зарегистрированы!<br> Можете перейти в <a href="login.php">панель входа</a></div>';
      }

         else 
        {
           //нашли ошибку
        echo '<div>'.array_shift($errors).'</div>';
      } 
    }
  }
}
?>