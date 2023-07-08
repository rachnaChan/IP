<html lang="en">
<head>
    <title>Array</title>
</head>
<body>

<!-- numeric  -->
 <?php
    $age = array("Chloris"=> "91", "Moon"=> "19", "Soo"=>"92");
    foreach($age as $x => $val){
        echo "$x = $val<br>";
    }
    ?>

    <br>
    <?php
    $multiArray = array(
        "A"=> array(0=> "gray", 2=> "blue", 3=>"orange"),
        "B"=> array(1=> "black", 2=> "yellow"),
        "C"=> array(0=> "white", 4=> "green", 8=>"purple"),     
    );

    echo $multiArray["A"][3];
    print "<br>";
    echo $multiArray["C"][8];
    ?>

    
</body>
</html>