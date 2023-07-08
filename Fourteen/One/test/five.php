<html lang="en">
<head>
    <title>Loops</title>
</head>
<body>

    <!-- while loop -->
    <?php
    $i = 1;
    while ($i <= 5) {
        echo "The value of i is: " . $i . "<br>";
        $i++;
    }
    ?>

    <!-- do-while loop -->
    <br>
    <?php
    $i = 0;
    do {
        $i++;
        echo "php do ...while loop $i times" . "<br>";
    } while ($i <= 5);
    ?>

    <br>

    <!-- for loop -->
    <?php
    for ($i = 1; $i <= 8; $i++) {
        echo "PHP for loop print $i times " . "<br>";
    }
    ?>

    <!-- for each loop -->
    <br>
    <?php
    $salary[] = 1000;
    $salary[] = 2000;
    $salary[] = 3000;
    foreach ($salary as $value) {
        // echo "$value". "<br/>";  // output :  1000,
        echo "Salary: $value<br>";
    }
    ?>

</body>
</html>