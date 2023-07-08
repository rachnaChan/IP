<html lang="en">
<head>
    <title>Definition and Initialization</title>
</head>
<body>
    <!-- variable definition and initialization -->
    <?php

    $me = "I am Chloris!!";
    echo $me;
    print "<br>";

    $num = 2404;
    echo $num;
    print "<br>";

    $name = "Chloris";
    $_name = "Rachnac";
    // $1name = "Moon"; invalid start with num
    ?>
    
    <br>

    <!-- constant definition  -->
    <?php

    define("Email", "a@gmail.com");
    print "<br>";
    echo Email;
    print "<br>";

    define("myCon", true);
    if (myCon) {
        echo "<h3 style='color:green'>Connection Established!</h3>";
    }

    define("ONECONSTANT", "Some Value");

    define("CONSTANT", "hELLO WORLD!!");
    echo CONSTANT;
    ?>

</body>
</html>