<?php

function loadVariable($var, $default) {
    if (isset($_POST[$var])) {
        return $_POST[$var];
    } elseif (isset($_GET[$var])) {
        return $_GET[$var];
    } else {
        return $default;
    }
}

global $TempArr;

function inserttext($Textvalue) {
    $Textvalue = addslashes($Textvalue);
    $Textvalue = str_replace('�', '"', $Textvalue);
    $Textvalue = str_replace('�', '"', $Textvalue);
    $trans = get_html_translation_table(HTML_ENTITIES);
    $Textvalue = strtr($Textvalue, $trans);
    $Textvalue = trim($Textvalue);
    return $Textvalue;
}

function viewtext($Textvalue) {
    $Textvalue = stripslashes($Textvalue);
    $trans = get_html_translation_table(HTML_ENTITIES);
    $trans = array_flip($trans);
    $Textvalue = strtr($Textvalue, $trans);
    $Textvalue = trim($Textvalue);
    return $Textvalue;
}

function decodeurlstring($UrlString) {
    $UrlString = urldecode($UrlString);
    $UrlString = str_replace('-', ' ', $UrlString);
    return $UrlString;
}

function encodestring($String) {
    $enc1 = base64_encode($String);
    //echo "<br>enc1=".$enc1;
    $enc2 = base64_encode($enc1);
    //echo "<br>enc2=".$enc2;
    $enc3 = base64_encode($enc2);
    //echo "<br>enc3=".$enc3;
    return $enc3;
}

function str_rand($length = 8, $seeds = 'alphanum') {
    // Possible seeds
    $seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
    $seedings['numeric'] = '0123456789';
    $seedings['alphanum'] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $seedings['hexidec'] = '0123456789abcdef';

    // Choose seed
    if (isset($seedings[$seeds])) {
        $seeds = $seedings[$seeds];
    }

    // Seed generator
    list($usec, $sec) = explode(' ', microtime());
    $seed = (float) $sec + ((float) $usec * 100000);
    mt_srand($seed);

    // Generate
    $str = '';
    $seeds_count = strlen($seeds);

    for ($i = 0; $length > $i; $i++) {
        $str .= $seeds{mt_rand(0, $seeds_count - 1)};
    }

    return $str;
}

// Resample Image 
function resampimagejpg($forcedwidth, $forcedheight, $sourcefile, $destfile, $imgcomp) {
    $g_imgcomp = 100 - $imgcomp;
    $g_srcfile = $sourcefile;
    $g_dstfile = $destfile;
    $g_fw = $forcedwidth;
    $g_fh = $forcedheight;
    if (file_exists($g_srcfile)) {
        $g_is = getimagesize($g_srcfile);
        if (($g_is[0] - $g_fw) >= ($g_is[1] - $g_fh)) {
            $g_iw = $g_fw;
            $g_ih = ($g_fw / $g_is[0]) * $g_is[1];
        } else {
            $g_ih = $g_fh;
            $g_iw = ($g_ih / $g_is[1]) * $g_is[0];
        }
        $src = explode(".", $g_srcfile);
        $var = count($src);
        if ($src[$var - 1] == 'gif' || $src[$var - 1] == 'GIF') {
            $img_src = ImageCreateFromGIF($g_srcfile);
            //$img_src= ImageColorAllocate($img_src, 250, 250, 250);
            $img_dst = imagecreate($g_iw, $g_ih);
            $img_dst1 = ImageColorAllocate($img_dst, 255, 255, 255);
        }
        if ($src[$var - 1] == 'png') {
            $img_src = ImageCreateFromPNG($g_srcfile);
            $img_dst = imagecreate($g_iw, $g_ih);
            $img_dst1 = ImageColorAllocate($img_dst, 255, 255, 255);
        }
        if ($src[$var - 1] == 'jpg' || $src[$var - 1] == 'JPG') {
            $img_src = imagecreatefromjpeg($g_srcfile);
            $img_dst = imagecreate($g_iw, $g_ih);
            $img_dst = &imageCreateTrueColor($g_iw, $g_ih);
        }

        imagecopyresampled($img_dst, $img_src, 0, 0, 0, 0, $g_iw, $g_ih, $g_is[0], $g_is[1]);
        if ($src[$var - 1] == 'jpg' || $src[$var - 1] == 'JPG') {
            imagejpeg($img_dst, $g_dstfile, $g_imgcomp);
        }
        if ($src[$var - 1] == 'png') {
            imagepng($img_dst, $g_dstfile, $g_imgcomp);
        }
        if ($src[$var - 1] = 'gif' || $src[$var - 1] == 'GIF') {
            imagegif($img_dst, $g_dstfile, $g_imgcomp);
        }
        imagedestroy($img_dst);
        return true;
    }
    else
        return false;
}

function upload($file_id, $folder = "", $types = "") {
    if (!$_FILES[$file_id]['name'])
        return array('', 'No file specified');

    $file_title = $_FILES[$file_id]['name'];
    //Get file extension
    $ext_arr = split("\.", basename($file_title));
    $ext = strtolower($ext_arr[count($ext_arr) - 1]); //Get the last extension
    //Not really uniqe - but for all practical reasons, it is
    $uniqer = substr(md5(uniqid(rand(), 1)), 0, 5);
    $file_name = $uniqer . '_' . $file_title; //Get Unique Name

    $all_types = explode(",", strtolower($types));
    if ($types) {
        if (in_array($ext, $all_types))
            ;
        else {
            $result = "'" . $_FILES[$file_id]['name'] . "' is not a valid file."; //Show error if any.
            return array('', $result);
        }
    }

    //Where the file must be uploaded to
    if ($folder)
        $folder .= '/'; //Add a '/' at the end of the folder
    $uploadfile = $folder . $file_name;

    $result = '';
    //Move the file from the stored location to the new location
    if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
        $result = "Cannot upload the file '" . $_FILES[$file_id]['name'] . "'"; //Show error if any.
        if (!file_exists($folder)) {
            $result .= " : Folder not exist.";
        } elseif (!is_writable($folder)) {
            $result .= " : Folder not writable.";
        } elseif (!is_writable($uploadfile)) {
            $result .= " : File not writable.";
        }
        $file_name = '';
    } else {
        if (!$_FILES[$file_id]['size']) { //Check if the file is made
            @unlink($uploadfile); //Delete the Empty file
            $file_name = '';
            $result = "Empty file found - please use a valid file."; //Show the error message
        } else {
            chmod($uploadfile, 0777); //Make it universally writable.
        }
    }

    return array($file_name, $result);
}

function generatePassword($l = 8, $c = 0, $n = 0, $s = 0) {
    // get count of all required minimum special chars
    $count = $c + $n + $s;

    // sanitize inputs; should be self-explanatory
    if (!is_int($l) || !is_int($c) || !is_int($n) || !is_int($s)) {
        trigger_error('Argument(s) not an integer', E_USER_WARNING);
        return false;
    } elseif ($l < 0 || $l > 20 || $c < 0 || $n < 0 || $s < 0) {
        trigger_error('Argument(s) out of range', E_USER_WARNING);
        return false;
    } elseif ($c > $l) {
        trigger_error('Number of password capitals required exceeds password length', E_USER_WARNING);
        return false;
    } elseif ($n > $l) {
        trigger_error('Number of password numerals exceeds password length', E_USER_WARNING);
        return false;
    } elseif ($s > $l) {
        trigger_error('Number of password capitals exceeds password length', E_USER_WARNING);
        return false;
    } elseif ($count > $l) {
        trigger_error('Number of password special characters exceeds specified password length', E_USER_WARNING);
        return false;
    }

    // all inputs clean, proceed to build password
    // change these strings if you want to include or exclude possible password characters
    $chars = "abcdefghijklmnopqrstuvwxyz";
    $caps = strtoupper($chars);
    $nums = "0123456789";
    $syms = "!@#$%^&*()-+?";

    // build the base password of all lower-case letters
    for ($i = 0; $i < $l; $i++) {
        $out .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }

    // create arrays if special character(s) required
    if ($count) {
        // split base password to array; create special chars array
        $tmp1 = str_split($out);
        $tmp2 = array();

        // add required special character(s) to second array
        for ($i = 0; $i < $c; $i++) {
            array_push($tmp2, substr($caps, mt_rand(0, strlen($caps) - 1), 1));
        }
        for ($i = 0; $i < $n; $i++) {
            array_push($tmp2, substr($nums, mt_rand(0, strlen($nums) - 1), 1));
        }
        for ($i = 0; $i < $s; $i++) {
            array_push($tmp2, substr($syms, mt_rand(0, strlen($syms) - 1), 1));
        }

        // hack off a chunk of the base password array that's as big as the special chars array
        $tmp1 = array_slice($tmp1, 0, $l - $count);
        // merge special character(s) array with base password array
        $tmp1 = array_merge($tmp1, $tmp2);
        // mix the characters up
        shuffle($tmp1);
        // convert to string for output
        $out = implode('', $tmp1);
    }

    return $out;
}

/*
 * Written By Ravi Sharma
 * Drop Down auto Generation Code
 * report bugs to ravi441988@gmail.com
 * 
 * Usage:
 * Parameters:
 * array $attrib:
 * An array may contain id,name,class or style attributes of select function.
 * $arrib must contain name and id.
 * for example:
 *          $attrib['id'] = 'language';
 *          $attrib['name'] = 'language';
 *          $attrib['style'] = array('margin'=>'20px');
 * 
 * array $options:
 * it may contain key values pair for generating oprions.
 * 
 * $selected can be a strign or integer or anything that is allowed to be key of html option element 
 * 
 * This function requires function parseAttrib($attrib, $key_flag) to work.
 * 
 */

function dropdown(array $attrib, array $options, $selected = null) {
    /*     * * begin the select ** */

    $attrib_string = parseAttrib($attrib);

    $dropdown = "<select {$attrib_string}  >" . "\n";

    $selected = $selected;
    /*     * * loop over the options ** */
    foreach ($options as $key => $option) {
        /*         * * assign a selected value ** */
        $select = strtolower($selected) == strtolower($key) ? ' selected' : null;


        /*         * * add each option to the dropdown ** */
        $dropdown .= '<option value="' . $key . '"' . $select . '>' . $option . '</option>' . "\n";
    }

    /*     * * close the select ** */
    $dropdown .= '</select>' . "\n";

    /*     * * and return the completed dropdown ** */
    return $dropdown;
}

function parseAttrib($attrib, $key_flag = "none") {
    $attrib_str = "";
    if (!is_array($attrib) || empty($attrib)) {
        return $attrib_str;
    }
    foreach ($attrib as $key => $val) {
        if (is_array($val)) {
            $attrib_str.="{$key}='";
            $attrib_str.=parseAttrib($val, $key) . "'";
        } else {
            switch ($key_flag) {
                case 'style':
                    $start_sign = ":";
                    $end_sign = ";";
                    break;
                case 'none':
                    $start_sign = "='";
                    $end_sign = "'";
                    break;
            }
            $attrib_str.="{$key}{$start_sign}{$val}{$end_sign} ";
        }
    }
    return str_replace("'", '"', $attrib_str);
}

/* creates a compressed zip file */

function create_zip($files = array(), $destination = '', $overwrite = false, $maintain_path = false) {
    //if the zip file already exists and overwrite is false, return false
    if (file_exists($destination) && !$overwrite) {
        return false;
    }
    //vars
    $valid_files = array();
    //if files were passed in...
    if (is_array($files)) {
        //cycle through each file
        foreach ($files as $file) {
            //make sure the file exists
            if (file_exists($file)) {
                $valid_files[] = $file;
            }
        }
    }
    //if we have good files...
    if (count($valid_files)) {
        //create the archive
        $zip = new ZipArchive();
        if ($zip->open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
            return false;
        }
        //add the files
        foreach ($valid_files as $file) {
            $localname = "";
            if ($maintain_path) {
                $localname = $file;
            } else {
                $localname = basename($file);
            }

            $zip->addFile($file, $localname);
        }
        //debug
        //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
        //close the zip -- done!
        $zip->close();

        //check to make sure the file exists
        return file_exists($destination);
    } else {
        return false;
    }
}

function force_download_zip($file) {
    header('Content-Description: File Transfer');
//    header('Content-Type: application/octet-stream'); 
    header("Content-Type: application/zip");
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
}

function get_link_content($v, $is_html = TRUE) {
    global $objDB;
    $q = "SELECT `content_id`,`content_title` FROM `site_content` WHERE `content_type` = '$v'";
    $result = $objDB->select($q);
    $str = "";
    $link_content_opt = array("" => "Select");
    foreach ($result as $row) {
        $content_id = $row['content_id'];
        $content_title = $row['content_title'];
        $str.= "<option value=\"$content_id\">$content_title</option>";
        $link_content_opt[$content_id] = $content_title;
    }
    if ($is_html) {
        return $str;
    } else {
        return $link_content_opt;
    }
}

//Menu Related Functions
function getSfMenuOld($ADMINMENU, $selected, $ADMINSUBMENU) {
    $adminMenu = "";
    $adminMenu.='<ul id="nav">';
    foreach ($ADMINMENU as $key => $val) {
        //if (isset([$key])) {
        $mnuclass = "";
        if ($selected == $key)
            $mnuclass = "class='active'";
        if (isset($ADMINSUBMENU[$key])) {
            $sub = $ADMINSUBMENU[$key];
            if (array_key_exists($selected, $sub))
                $mnuclass = "class='active'";
            $adminMenu.='<li  ' . $mnuclass . '><a href="' . $AbsoluteURL . 'index.php?p=' . $key . '">' . $val . '</a>';
            $mnuclass = "";
            $adminMenu.= '<ul>';
            foreach ($sub as $subkey => $subval) {
                $mnuclass = "";
                if ($selected == $subkey)
                    $mnuclass = "class='sub_active'";
                $adminMenu.='<li ' . $mnuclass . '><a href="' . $AbsoluteURL . 'index.php?p=' . $subkey . '">' . $subval . '</a></li>';
            }
            $adminMenu.='</ul>';
            $adminMenu.="</li>";
        }
        else
            $adminMenu.='<li ' . $mnuclass . '><a href="' . $AbsoluteURL . 'index.php?p=' . $key . '">' . $val . '</a></li>';
    }
    //}
    $adminMenu.='</ul>';
    return $adminMenu;
}

function getSfMenu($selected) {
//    get active menus from db
    $activeMenusAndLinkContent = getActiveMenuAndLinkContent();
    $activeMenus = $activeMenusAndLinkContent['results'];
    $link_content_id = $activeMenusAndLinkContent['link_contents_id'];
    $link_content_details = getLinkContentDetails($link_content_id);
    
//    Format our active menus for sturcturing a tree for main menu
    $formatedMenus = formatTree($activeMenus, 1);
    $menuStr = "<ul id='nav'>";
    foreach ($formatedMenus as $menu) {
        if (!empty($menu['submenu'])) {
            $mnuclass = "";
            $p = $link_content_details[$menu['link_content']]['content_uri'];
            $link = $AbsoluteURL . 'index.php?p=' . $p;
            if ($menu['type'] == "external") {
                $link = $menu['external_link'];
            }
            if ($p == $selected) {
                $mnuclass = "class='active'";
            } elseif (is_submenu_selected($menu['submenu'], $selected, $link_content_details)) {
                $mnuclass = "class='active'";
            }

            $menuStr.='<li ' . $mnuclass . '><a href = "' . $link . '">' . $menu['menu_name'] . '</a>';
            $menuStr.="<ul>";
            foreach ($menu['submenu'] as $submenu) {
                $submnuclass = "";
                $p = $link_content_details[$submenu['link_content']]['content_uri'];
                $link = $AbsoluteURL . 'index.php?p=' . $p;
                if ($submenu['type'] == "external") {
                    $link = $submenu['external_link'];
                }
                if ($submenu['type'] == "category") {
                    $link = "index.php?p=allproducts&c=".$submenu['menu_id'];
                }
                if ($p == $selected)
                    $submnuclass = "class='sub_active'";

                $menuStr.='<li ' . $submnuclass . '><a href = "' . $link . '">' . $submenu['menu_name'] . '</a></li>';
            }
            $menuStr.="</ul></li>";
        } else {
            $mnuclass = "";
            $p = $link_content_details[$menu['link_content']]['content_uri'];
            $link = $AbsoluteURL . 'index.php?p=' . $p;
            if ($menu['type'] == "external") {
                $link = $menu['external_link'];
            }
            if ($p == $selected)
                $mnuclass = "class='active'";
            $menuStr.='<li ' . $mnuclass . '><a href = "' . $link . '">' . $menu['menu_name'] . '</a><li>';
        }
    }
    $menuStr.="</ul>";
    return $menuStr;
}

function is_submenu_selected($submenu, $page, $link_content_details) {
    foreach ($submenu as $sub) {
        $p = $link_content_details[$sub['link_content']]['content_uri'];
        if ($p == $page) {
            return true;
        }
    }
    return false;
}

function getActiveMenuAndLinkContent() {
    global $objDB;
    $sql = "select parent,menu_id,link_content,menu_name,type,external_link from site_menu where status='1' order by menu_order asc";
    $results = $objDB->select($sql);
    $link_contents_id = array();
    foreach ($results as $menu_details) {
        $link_contents_id[] = $menu_details['link_content'];
    }
    return array('results' => $results, 'link_contents_id' => $link_contents_id);
}

function formatTree($tree, $parent) {
    $tree2 = array();
    foreach ($tree as $i => $item) {
        if ($item['parent'] == $parent) {
            $tree2[$item['menu_id']] = $item;
            $tree2[$item['menu_id']]['submenu'] = formatTree($tree, $item['menu_id']);
        }
    }

    return $tree2;
}

function getLinkContentDetails($link_content_id) {
    global $objDB;
    $where = 'AND content_id in (' . implode(",", $link_content_id) . ' )';
    $sql = "SELECT * FROM `site_content` where status='1' {$where}";
    $site_content_details = array();
    $results = $objDB->select($sql);
    if ($results) {
        foreach ($results as $content_details) {
            $site_content_details[$content_details['content_id']]['content_title'] = $content_details['content_title'];
            $site_content_details[$content_details['content_id']]['content_uri'] = $content_details['content_uri'];
        }
    }
    return $site_content_details;
}

function remove_row($table, $key, $value, $where = "") {
    global $objDB;
    $sql = "update $table set status='-1' where $key='$value' $where";
    if ($objDB->edit($sql)) {
        return true;
    }
    return false;
}

function is_external($p) {
    return preg_match("@^https?://@", $p);
}

function active_deactive($table, $key, $value, $where = "") {
    global $objDB;
    $where = " AND {$key}='{$value}'";
    $sql = "UPDATE {$table} SET status = IF(status='1', '0', '1') where 1 $where";
    if ($objDB->edit($sql)) {
        return true;
    }
    return false;
}


?>