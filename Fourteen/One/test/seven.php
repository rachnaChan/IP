<html lang="en">
<head>
    <title>Short Introduction</title>
</head>
<body>

    <!-- session -->
    <?php
    session_start();

    // store session data
    $_SESSION["username"] = "chloris";
    $_SESSION["email"] = "chloris@gmail.com";

    //retrieve session data
    echo $_SESSION["username"];
    echo "<br>";
    echo $_SESSION['email'];
    ?>

</body>
</html>