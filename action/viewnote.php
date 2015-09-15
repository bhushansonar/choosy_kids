<?php
$note_id = "";
$pdfContent = "";
$note_title = "";
if (isset($_GET['id']) && $_GET['id'] != "") {
    $note_id = $_GET['id'];
    $sql = "select mn_note_path,mn_note_title,mn_note_uploaded_by,mn_note_created_date from mn_note where mn_note_id={$note_id} limit 0,1";
    $data = $objDB->select($sql);
    if ($data && !empty($data)) {
        $note_title = $data[0]['mn_note_title'];
        $name = $data[0]['mn_note_path'];
        $filePath = 'notes/pdf/' . $name;
        if (file_exists($filePath)) {
            include('libs/class.pdf2text.php');
            $pdfObj = new PDF2Text();
            $pdfObj->setFilename($filePath);
            $pdfObj->setFilename;
            $pdfObj->decodePDF();
            $pdfContent = $pdfObj->output();
            $total_char = strlen($pdfContent);
            $fourty_percent_char = ($total_char * 40) / 100;
            $pdfContent = tokenTruncate($pdfContent, $fourty_percent_char) . "<span>…More</span>";
        }
    } else {
        header("Location:index.php?p=browesnotes&err=file_not_found");
    }
}
if ($pdfContent != "") {
    $table = 'mn_user';
    $key = 'mn_user_id';
    $value = 'mn_user_display_name';
    $orderby = 'mn_user_type ASC';
    $where = " AND mn_user_type='P' ";
    $users = $objDB->getDataArray($table, $key, $value, $orderby, $where);
    ?>
    <style>
        p{
            margin-top: 10px;
        }
        .container{
            width:100%;
        }
        span{
            font-style: italic;
            color:#ff0000;
        }
        .left-container{
            float: left;
            width:50%;
            padding-right:5%; 
            font-size: 12px;
        }
        .right-container{
            float: right;
            width:45%;
            text-align:center; 
            height: 365px;
        }
        .table{display:table;}
        .table-cell{display:table-cell;}
        .align-middle{vertical-align:middle; text-align:center;}
        .full-height{height:100%;}
        .full-width{width:100%;}
        .right-container p{margin-top:5px;}
        .lable{
            font-size: 16px;
            font-weight: bold;
        }
        .values{text-align: right;font-size: 14px;}
        .center-container{
            border: 1px solid black;
            margin: 0 auto;
            padding: 10%;
            text-align: left;
            width: 50%;
        }
        h1{
            font-size: 16px;
            color:#444444;
        }
    </style>
    <div class="full-container">
        <div class="left-container">
            <h1><?php echo ucwords($note_title) ?> Review.</h1>
            <hr/>
            <p>
                <?php echo $pdfContent ?> 
            </p>
        </div>
        <div class="right-container">
            <div class="table full-width full-height">        
                <div class="table-cell align-middle">
                    <div class="center-container">
                        <p class="lable">Note Posted by: </p>
                        <p class="values"> <?php echo $users[$data[0]['mn_note_uploaded_by']] ?></p>
                        <p class="lable">Note Posted: </p>
                        <p class="values"> <?php echo date('M d, Y', strtotime($data[0]['mn_note_created_date'])) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    header("Location:index.php?p=browesnotes&err=pdf_content_not_found");
}

function tokenTruncate($string, $your_desired_width) {
    $parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
    $parts_count = count($parts);

    $length = 0;
    $last_part = 0;
    for (; $last_part < $parts_count; ++$last_part) {
        $length += strlen($parts[$last_part]);
        if ($length > $your_desired_width) {
            break;
        }
    }

    return implode(array_slice($parts, 0, $last_part));
}
?>
