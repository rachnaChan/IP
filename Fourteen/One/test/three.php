<html lang="en">
<head>
    <title>Operators</title>
</head>
<body>

    <!-- operator in php -->
    <?php
    $var = 1;
    echo $var++;
    // Output: "2" (incremented value of var)
    print "<br>";

    echo ++$var;
    // Output: "3" (post-increment incrementing the original variable by one and returning
    // its new value, which is now three). This also increments the global scope's copy
    // of `$var` to `4`.
    print "<br>";

    echo --$var;
    // Output: "5" (pre-decrement decrementing a local copy of `$var`,
    // then returning it with an updated value.) The post-decrement operator does not affect this.
    print "<br>";

    echo $var--;
    // Outputs: "6". Decrements the current value of `$var` before outputting
    // (`--$var` first decrements `$var`'s internal counter without storing any values
    // in memory or using up resources), but leaves the actual value unchanged at five.
    print "<br><hr>";
    ?>

    <?php
    $var = "value";
    $var = 1;
    $var += 3;
    ?>

    <br>

    <?php
    $name = "Chloris";
    $lastname = "Moon";

    echo $name . " " . $lastname;
    print "<br>";
    $a = "Hello";
    $a .= "World!!";
    echo $a;
    ?>

</body>
</html>