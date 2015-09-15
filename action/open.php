<?php 
isAlreadyPurchase();
function isAlreadyPurchase() {
    global $objDB;
    $note_id = $_REQUEST['item_number'];
    $sql = "select mn_note_id from mn_transaction where mn_user_id={$_SESSION['user_id']} AND mn_note_id={$note_id}";
    $noteDetails = $objDB->select($sql);
    if (count($noteDetails)>0) {
        $noteDetails = isset($noteDetails[0]) ? $noteDetails[0] : $noteDetails;
        $sql = "select mn_note_path from mn_note where mn_note_id={$noteDetails['mn_note_id']} limit 0,1";
        $data = $objDB->select($sql);
        if ($data && !empty($data)) {
            $name = $data[0]['mn_note_path'];
            $filePath = $AbsoluteURL . "notes/pdf/" . $name;
            header("Location:" . $filePath);
            exit;
        }
    }
}
?>