<?php 
    session_start();
    function isValidateDone(){
        if(!isset($_POST["name"])){
            return false;
        }
        if(!isset($_POST["password"])){
            return false;
        }
        return true;
    }

    function checkLogin($connect){
        $sql = "SELECT * FROM users where name = '".$_POST['name']."' AND password = '".$_POST['password']."' ";
        $result = $connect->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $_SESSION['data'] = $row;
            }
            header("Location: done.php");
        }else{
            echo 'Tài khoản của bạn không hợp lệ';
        }
    }

    function main(){
        $username = "root";
        $password = "";
        $server   = "127.0.0.1";
        $dbname   = "studyphp";

        //connect
        $connect = new mysqli($server, $username, $password, $dbname);
        if ($connect->connect_error) {
            die("Không kết nối :" . $connect->connect_error);
            exit();
        }

        //insert data
        if(isValidateDone()){
            checkLogin($connect);
            return;
        }
    }
    main();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./login.css">
    <title>Document</title>
</head>
<body>
<form action="login.php" method="post">

  <div class="container">
    <label for="name"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="name" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>
</body>
</html>