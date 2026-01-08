<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Form Login</h2>
    <?php
    $username = "admin";
    $password = "123";
    ?>

    <form method="post" action="">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="pass">
        <br>
        <input type="submit" value="login">
    </form>
    <?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if($_POST['user'] == $Username AND $_POST['pass'] == $password){
            echo '<span style="color:green">User ' .$_POST['user']. ' Berhasil Login</span>';
        } else {
            echo '<span style="color:red">User ' .$_POST['user'] . ' Gagal Login</span>';
        }
    }
    ?>
</body>
</html>