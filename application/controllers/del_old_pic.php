<?php
$arrFiles = array();
$handle = opendir('uploads/event'); 

$s = "JPEG_20220111_";
if ($handle) {
    while (($entry = readdir($handle)) !== FALSE) {
        preg_match('/^JPEG_202201/', $entry, $v);
 
        if(count($v) > 0) {
          unlink($v);
          echo "xxxxxxx"; 
        }

        // $arrFiles[] = $entry;
    }
}
 
closedir($handle);

?>