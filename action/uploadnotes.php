<?php

//uploading main file
$pdf_path = 'notes/pdf';

list($file_name, $error) = upload('main_file', $pdf_path, 'pdf');

if ($error != "") {
    header("Location:index.php?p=uploadnotes&err=pdf_file_required");
    exit;
}
$date = date('Y-m-d H:i:s');
$sql = "INSERT INTO `mn_note`(`mn_note_title`, `mn_note_price`, `mn_note_path`, `mn_note_thumbnail`, `mn_note_week`,`mn_note_course`,`mn_note_chapter`,`mn_note_school`,`mn_note_program`, `mn_note_uploaded_by`, `mn_note_created_date`, `mn_note_modified_date`, `mn_note_status`) VALUES ('{$_POST['note_title']}','{$_POST['note_price']}','{$file_name}','{$_POST['thumb_path']}','{$_POST['note_week']}','{$_POST['note_course']}','{$_POST['note_chapter']}','{$_SESSION['user_school']}','{$_SESSION['user_program']}',{$_SESSION['user_id']},'{$date}','{$date}','1')";
$note_id = $objDB->insert($sql);

if ($note_id) {
    header("Location:index.php?p=browesnotes");
} else {
    echo 'Fatal Error';
}
?>

