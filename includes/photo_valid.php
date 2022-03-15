<?php
    //Receives a file that will receive as a post 'upFile'
    $photo = basename($_FILES["upFile"]["name"]);
    $target_dir = "pics/";
    $target_file = $target_dir . basename($_FILES["upFile"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    //Checks if the received file is a image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["upFile"]["tmp_name"]);
        if($check !== false) {
            echo "File is a image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File isn't a image.";
            $uploadOk = 0;
            }
    }
    //Checks if the file was already inserted into the folder - $target_dir
    if (file_exists($target_file)) {
        echo "File already exists.";
        $uploadOk = 0;
    }

    //Checks if the file is on the correct size allowed - 5MB
    if ($_FILES["upFile"]["size"] > 5000000) {
        echo "File size exceed limit. Max 5MB";
        $uploadOk = 0;
    }
    //Checks if the file is on the accepted types of file - JPG, JPEG, PNG, GIF
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Can only uploaf JPG, JPEG, PNG & GIF.";
            $uploadOk = 0;
    }
?>