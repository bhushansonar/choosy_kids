<?php

$file = $_REQUEST['p'];
$type = $_REQUEST['type'];

// This is just a simple example, not to be used in production!!!
// ------------------------
// Input parameters: optional means that you can ignore it, and required means that you
// must use it to provide the data back to CKEditor.
// ------------------------
// Optional: instance name (might be used to adjust the server folders for example)
$CKEditor = $_GET['CKEditor'];

// Required: Function number as indicated by CKEditor.
$funcNum = $_GET['CKEditorFuncNum'];

// Optional: To provide localized messages
$langCode = $_GET['langCode'];

// ------------------------
// Data processing
// ------------------------
// The returned url of the uploaded file
$url = '';


// Optional message to show to the user (file renamed, invalid file, not authenticated...)
$message = '';

// In FCKeditor the uploaded file was sent as 'NewFile' but in CKEditor is 'upload'
if (isset($_FILES['upload'])) {
    // ToDo: save the file :-)
    // Be careful about all the data that it's sent!!!
    // Check that the user is authenticated, that the file isn't too big,
    // that it matches the kind of allowed resources...
    $filename = $_FILES['upload']['name'];

    // example: Build the url that should be used for this file   
    $url = $AbsoluteURL."uploads/images/" . $filename;


    $file_exts = array("jpg", "bmp", "jpeg", "gif", "png");
    $upload_exts = end(explode(".", $_FILES["upload"]["name"]));
    if ((($_FILES["upload"]["type"] == "image/gif") || ($_FILES["upload"]["type"] == "image/jpeg") || ($_FILES["upload"]["type"] == "image/png") || ($_FILES["upload"]["type"] == "image/pjpeg")) && ($_FILES["upload"]["size"] < 2000000) && in_array($upload_exts, $file_exts)) {
        if ($_FILES["upload"]["error"] > 0) {
            echo "Return Code: " . $_FILES["upload"]["error"] . "<br>";
        } else {
            echo "Upload: " . $_FILES["upload"]["name"] . "<br>";
            echo "Type: " . $_FILES["upload"]["type"] . "<br>";
            echo "Size: " . ($_FILES["upload"]["size"] / 1024) . " kB<br>";
            echo "Temp file: " . $_FILES["upload"]["tmp_name"] . "<br>";
// Enter your path to upload file here
            if (file_exists("../uploads/images/" .
                            $_FILES["upload"]["name"])) {
                echo "<div class='error'>" . "(" . $_FILES["upload"]["name"] . ")" .
                " already exists. " . "</div>";
            } else {
                move_uploaded_file($_FILES["upload"]["tmp_name"], "../uploads/images/" . $_FILES["upload"]["name"]);
                echo "<div class='sucess'>" . "Stored in: " .
                "../uploads/images/" . $_FILES["upload"]["name"] . "</div>";
            }
        }
    } else {
        echo "<div class='error'>Invalid file</div>";
    }

    // Usually you don't need any message when everything is OK.
//    $message = 'new file uploaded';   
} else {
    $message = 'No file has been sent';
}
// ------------------------
// Write output
// ------------------------
// We are in an iframe, so we must talk to the object in window.parent
echo "<script type='text/javascript'> window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message')</script>";
?>