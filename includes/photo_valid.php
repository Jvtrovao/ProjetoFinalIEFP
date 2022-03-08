<?php
    //código upload foto
    $photo = basename($_FILES["upFile"]["name"]);
    $target_dir = "pics/";
    $target_file = $target_dir . basename($_FILES["upFile"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // verifica se é uma imagem
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
    // verifica se já existe
    if (file_exists($target_file)) {
        echo "File already exists.";
        $uploadOk = 0;
    }

    // verifica o tamanho da imagem
    if ($_FILES["upFile"]["size"] > 5000000) { //5MB
        echo "File size exceed limit. Max 5MB";
        $uploadOk = 0;
    }
    // tipo de ficheiro permitido
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Ca only uploaf JPG, JPEG, PNG & GIF.";
            $uploadOk = 0;
    }
?>