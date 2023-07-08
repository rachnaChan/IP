<html lang="en">
<head>
    <title>Short Introduction</title>
</head>
<body>

    <!-- file upload -->
    <?php
    if (isset($_POST["SubmitBtn"])) {
        $fileName = $_FILES["resume"]["name"];
        $fileSize = $_FILES["resume"]["size"];
        $fileType = $_FILES["resume"]["type"];
        $fileTmpName = $_FILES["resume"]["tmpName"];

        if ($fileType == "application/msword") {
            if ($fileSize <= 200) {
                $random = rand(1111, 9999);
                $newFileName = $random . $fileName;

                $uploadPath = "testUpload/" . $newFileName;

                if (move_uploaded_file($fileTmpName, $uploadPath)) {
                    echo "<h3 style='color:green'>File uploaded successfully!</h3>";
                    echo "File Name : " . $newFileName;
                    echo "File Size : " / $fileSize . "kb";
                    echo "File Type :" . $fileType;
                }
            } else {
                echo "<p><strong>Error:</strong> File size should be less than or equal to 200kb</p>";
            }
        } else {
            echo "<p><strong>Error:</strong> Only MS Word files are allowed.</p>";
        }
    }
    ?>

</body>
</html>