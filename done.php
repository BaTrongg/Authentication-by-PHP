<?php
    session_start();
    $data = $_SESSION['data'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Done</title>
</head>
<body>
    <div style="padding-left: 100px">
        <p>Name: <?php echo $data['name']?></p>
        <p>Password: <?php echo $data['password']?></p>
        <p>Gender: <?php echo $data['gender']?></p>
        <p>Comment: <?php echo $data['comment']?></p>
        <a href="logout.php" class="w3-button w3-black">Logout</a>
    </div>
</body>
</html>