<!DOCTYPE html>
<html>
<head>
  <?php 
    include "views/style.css";
    // include "app/Login.php";
    $enter=new Login;
  ?>
  <title>Вход в систему</title>
  <h1 align=center>Авторизируйтесь</h1>
</head>
<body>
  <form action="" method="post">
  <table align=center>
  <?php       
      $enter->validate();
      echo "<tr><td class='errors'>".Login::$error."</td></tr>";
  ?>
  <tr>
    <td>Логин:</td>
    <td><input type="text" name="login" ></td>
  </tr>
  <tr>
    <td>Пароль:</td>
    <td><input type="password" name="password"></td>
  </tr>
  <tr>
    <td></td>
    <td><button type="submit">Войти</button></td>
  </tr>
  </table>
  </form>
</body>
</html>