<html lang="en">
<head>
    <title>Decision Making</title>
</head>
<body>

    <!-- if else -->
    <?php
    $date = date("m-d");

    if ($date == "09-01") {
        echo "Wishing you a very Happt Birthday";
    } else {
        echo "<p>$date is not the birthday of me.</p>";
    }
    ?>

    <!-- elseif -->
    <?php
    $date = date("09-01");

    if ($date == "09-01") {
        echo "Wishing you a very Happt Birthday";
    } elseif ($date == "04-24") {
        echo "Happy Independence Day";
    } else {
        echo "$date is neither my birthday nor independance day.";
    }
    ?>
      <br>

    <!-- switch  -->
    <?php
      print "<br>";
    $myfavColor = "Gray";
    switch ($myfavColor) {
        case "Gray":
            echo "I like Gray Color too!";
            break;
        case "Black":
            echo "My favorite color is Black, but I don't want to be that guy :
            ";
            break;
        case "Orange":
            echo "Hmm... Orange looks nice! But still no cigar for me. ;
            ";
            break;
        case "Red":
            echo "No way!! Red? That's just crazy!!!:D";
            break;
        default:
            echo "Sorry!, My Favorite Colour Isn't on this list yet.. Please add it";
    }
    ?>

</body>
</html>