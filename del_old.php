<?php
$arrFiles = array();
$handle = opendir('uploads/event');
 
$s = "JPEG_202305";
if ($handle) {
    while (($entry = readdir($handle)) !== FALSE) {
        if($entry == "." || $entry == "..") {
            continue;
        }
        preg_match('/^JPEG_202305/', $entry, $v);
        
        //echo $entry ."<br/>";
        if(count($v) > 0) {
            echo "<pre>";
            print_r($v) ;
            echo "</pre>";
            unlink('uploads/event/'.$entry);
            echo  $entry . " xxxxxxx>> ". "del</br>";
           
        }
        
        // $arrFiles[] = $entry;
    }
}
 
closedir($handle);


//--------

$handle = opendir('uploads/business');
 
$s = "JPEG_202305";
if ($handle) {
    while (($entry = readdir($handle)) !== FALSE) {
        if($entry == "." || $entry == "..") {
            continue;
        }
        preg_match('/^JPEG_202305/', $entry, $v);
        
        //echo $entry ."<br/>";
        if(count($v) > 0) {
            echo "<pre>";
            print_r($v) ;
            echo "</pre>";
            unlink('uploads/business/'.$entry);
            echo  $entry . " xxxxxxx>> ". "del</br>";
           
        }
        
        // $arrFiles[] = $entry;
    }
}
 
closedir($handle);
?>