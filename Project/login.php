<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Вход</title>
    <link rel="shortcut icon" href="ToDoList.ico" type="image/x-icon">
</head>

<body>
<?php
if (preg_match("|\s|", $_POST['username']) || preg_match("|\s|", $_POST['password'])){
    if (preg_match("|\s|", $_POST['username'])) {
        $fmsg =  "Логин содержит пробельные символы<br>";
    }
    if (preg_match("|\s|", $_POST['password'])) {
        $fmsg =  $fmsg."Пароль содержит пробельные символы";
    }
}
else if(strlen($_POST['username']>23)||strlen($_POST['password'])>23){
    if (strlen($_POST['username'])>23) {
        $fmsg =  "Логин должен быть меньше 23 символов<br>";
    }
    if (strlen($_POST['password'])>23) {
        $fmsg =  $fmsg."Пароль должен быть меньше 23 символов";
    }
}
else {
    session_start();
    require('connect.php');
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT * FROM users WHERE username='$username' and password='$password'";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        $count = mysqli_num_rows($result);

        if ($count == 1){
            $_SESSION['username'] = $username;
            
        }else{
            $fmsg = "Введен неверный логин или пароль";
        }
    }
    if (isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        ?> <style>.form-signin{
            display: none;          
        } </style>
        <form class="container">
            <h2 align = center>Приветсвуем, <?php echo $username ?>! Вы вошли </h2>
            <a href = 'index.html' class='btn btn-lg btn-primary btn-block'>Перейти к Списку Задач</a>
            <a href = 'logout.php' class='btn btn-lg btn-primary btn-block'>Выйти</a>
        </form>    
        <?php
    }
}
?>
<div class="container">
    <form class="form-signin" method="POST">
        <h2 align = center>Вход</h2>
        <?php if(isset($fmsg)){ ?> <div class="alert alert-danger" role="alert"><?php echo $fmsg; ?></div><?php } ?>
        <input type="text" name="username" class="form-control" placeholder="Введите логин..." required>
        <input type="password" name="password" class="form-control" placeholder="Введите пароль..." required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>  
        <a href="index.php" class="btn btn-lg btn-primary btn-block">Зарегестрироваться</a>
    </form>
</div>
</body>

</html>