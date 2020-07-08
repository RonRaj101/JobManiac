<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Logging Out</title>
</head>

<body>
    <?php
    session_start();
    unset($_SESSION['user']);
    header("location:Login.php");
    ?>
</body>
</html>