<html lang="en">
<head>
    <title>Short Introduction</title>
</head>
<body>

    <!-- form from eight.php -->

    <!-- welcome <?php echo $_POST["name"]; ?>!
    <br>
    Your Email Addresse is <?php echo $_POST["email"]; ?>!

    <br> -->

    <!-- welcome <?php echo $_GET["names"]; ?>!
    <br>
    Your Email Addresse is <?php echo $_GET["emails"]; ?>! -->


    <!-- form from nine.php -->

    <form action="nine.php" method="post">
        Name: <input type="text" name="name">
        <br>
        Number: <input type="number">
        <br>
        Email Address: <input type="text" name="email"><br><br>
        <input type="submit">
    </form>

</body>
</html>
