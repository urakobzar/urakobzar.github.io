<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Авторизация</title>
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
else if(strlen($_POST['username']>23)||strlen($_POST['password'])>23||(strlen($_POST['email'])>23)){
    if (strlen($_POST['username'])>23) {
        $fmsg =  "Логин должен быть меньше 23 символов<br>";
    }
    if (strlen($_POST['email'])>23) {
        $fmsg =  $fmsg."Email должен быть меньше 50 символов<br>";
    }
    if (strlen($_POST['password'])>23) {
        $fmsg =  $fmsg."Пароль должен быть меньше 23 символов";
    }
}
else{
    require('connect.php');
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = "INSERT INTO users(username, email, password) VALUES ('$username','$email','$password')";
        $result = mysqli_query($connection, $query);
        if($result){
            $smsg = "Регистрация прошла успешно";        
        } else{
            $fmsg = "Пользователь $username уже зарегестрирован";
        }
    }
}
?>
<div class="container">
    <form class="form-signin" method="POST">
        <h2 align = center>Регистрация</h2>
        <?php if(isset($smsg)){ ?> <div class="alert alert-success" role="alert"><?php echo $smsg; ?></div><?php } ?>
        <?php if(isset($fmsg)){ ?> <div class="alert alert-danger" role="alert"><?php echo $fmsg; ?></div><?php } ?>
        <input type="text" name="username" class="form-control" placeholder="Логин" required>
        <input type="email" name="email" class="form-control" placeholder="Email" required>
        <input type="password" name="password" class="form-control" placeholder="Пароль" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Регистрация</button>  
        <a href="login.php" class="btn btn-lg btn-primary btn-block">Авторизироваться</a>
    </form>
</div>
</body>

</html>