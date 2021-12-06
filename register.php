<?php
    session_start();
        $data = array('name' => '',
                  'password' => '',
                  'gender' => '',
                  'comment' => '');

        function isValidateDone(){
            if(!isset($_POST["name"])){
                return false;
            }
            if(!isset($_POST["password"])){
                return false;
            }
            if(!isset($_POST["gender"])){
                return false;
            }
            if(!isset($_POST["comment"])){
                return false;
            }
            return true;
        }
        
        function checkLogin($connect){//Trả về true nếu tên đăng nhập chưa có trong db, ngược lại trả về false
            global $data;
            $sql = "SELECT * FROM users where name = '".$data['name']."'";
            $result = $connect->query($sql);
            if($result->num_rows > 0){
                return false;
            }else{
                return true;
            }
        }
        
        function insert($connect){
            global $data;
            $data['name'] = $_POST['name'];
            $data['password'] = $_POST['password'];
            $data['gender'] = $_POST['gender'];
            $data['comment'] = $_POST['comment'];

            if(checkLogin($connect)==false){
                echo 'tai khoan nay da ton tai';
                return;
            }
            $sql = "INSERT INTO users (name, password, gender, comment) VALUES ('".$data['name']."', '".$data['password']."', '".$data['gender']."', '".$data['comment']."')";
            $connect->query($sql);
        }
        
        function main(){
            global $data;
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
                insert($connect);//insert to database
                $_SESSION['data'] = $data;
                header("Location: done.php");
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
    <title>Document</title>
    <link rel="stylesheet" href="./Register.css">
</head>
<body>
    <form action="register.php" method="POST">
    <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" id="name" required>
        <p><?php ?></p>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" id="password" required>
        
        <label for="password-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="password-repeat" id="password-repeat" required>
        
        <label for="Gender"><b>Gender</b></label><br>
        <input type="radio" name="gender" value="female">Female
        <input type="radio" name="gender" value="male">Male
        <input type="radio" name="gender" value="other">Other
        <hr>
        
        <label for="comment"><b>Comment</b></label>
        <input type="text" placeholder="Enter Comment" name="comment" id="comment" required>

        <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
        <button type="submit" class="registerbtn">Register</button>
    </div>

    <div class="container signin">
        <p>Already have an account? <a href="#">Sign in</a>.</p>
    </div>
    </form>
</body>
</html>
