<html lang="en">
<head>
    <title>Short Introduction</title>
</head>
<body>

    <!-- html form -->
    <?php
    if(isset($_POST['submit'])){
        $name = trim($_POST['name']);
        $number = trim($_POST['number']);
        $email = trim($_POST['email']);

        if($name == ""){
            $errorMsg = "error : name is blanked!!";
            $code ="1";

        }elseif($number == ""){
            $errorMsg = "Error: number field cannot be empty!!";
            $code ="2";

        }elseif(is_numeric(trim($number)) == false){
            $errorMsg = "Error: Number should only contain digits!!";
            $code ="2";

        }elseif(strlen($number) < 10){
            $errorMsg = "Number must have at least ten characters. Please try again with a valid!!";
            $code ="2";

        }elseif($email == ""){
            $errorMsg = "Email address can not be left blank!! ";
            $code ="3";

        }elseif(!preg_match("[_\.0-9a-zA-Z]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z{2,6}$/i]", $email)){
            $errorMsg = "Email must be valid!!";
            $code ="3";

        }else{
            echo "success!!";
        }

    }
    ?>
       
</body>
</html>