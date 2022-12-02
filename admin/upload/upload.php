<?php
$dir_subida = 'img/';
$fichero_subido = $dir_subida.date('Y').date('m').date('d').date('His').'-'.basename($_FILES['fileToUpload']['name']);

//echo '<pre>';
if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $fichero_subido)) {
    $msg = $fichero_subido;
} else {
    $msg = "¡Posible ataque de subida de ficheros!\n";
}

/* echo 'Más información de depuración:';
print_r($_FILES);

print "</pre>"; */
echo $msg;
return true;



$target_dir = "img/"; //directorio en el que se subira
$target_file = $target_dir . basename($_FILES["upfile"]["name"]);//se añade el directorio y el nombre del archivo
$uploadOk = 1;//se añade un valor determinado en 1
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
var_dump($imageFileType);
// Comprueba si el archivo de imagen es una imagen real o una imagen falsa
move_uploaded_file($target_dir, $imageFileType);

//echo $target_file . "espacio";

$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

//echo $check;


/* $file = $request->file('file');
$filename = $file->getClientOriginalName();
$filename = pathinfo($filename, PATHINFO_FILENAME);
$name_file = str_replace(" ", "_", $filename);
$extension = $file->getClientOriginalExtension();
$img = date('Y').date('m').date('d').date('His').'-'.$name_file.'.'.$extension;
$file->move(public_path('img_chat/'), $img);
 */



if($check !== false) {//si es falso es una imagen y si no lanza error
    $uploadOk = 1;  
    //echo "Es una imagen";
} else {
    //echo "0";
    $uploadOk = 0;
    exit;
}

// Comprobar si el archivo ya existe
if (file_exists($target_file)) {
    $uploadOk = 0;//si existe lanza un valor en 0
    //echo "el archivo ya existe";
    exit;
}
// Comprueba el peso
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    $uploadOk = 0;
    //echo "Comprueba el peso";
    exit;
}
// Permitir ciertos formatos de archivo
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    $uploadOk = 0;

    echo "No es el formato";
    return;
}
//Comprueba si $ uploadOk se establece en 0 por un error
if ($uploadOk == 0) {
    echo "Hay un error";
    return;
// si todo está bien, intenta subir el archivo
} else {
    if(move(public_path($target_dir), basename($_FILES["fileToUpload"]["name"]))){
    /* if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) { */
        echo basename($_FILES["fileToUpload"]["name"]);
        echo "intento subir el archivo";
    } else {
        echo "Error";
        return;
    }
}
